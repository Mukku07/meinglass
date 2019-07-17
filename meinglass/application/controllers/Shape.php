<?php

/**
 * Description of Shape
 *
 * @author Mohit Kant Gupta
 */
class Shape extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email');
    }

    private function filteredTerm() {
        $list = ['' => '--Select The Term--'];
        $terms = $this->admin_model->getAllTerms();
        foreach ($terms as $term) {
            $list[$term['id']] = $term['term'];
        }
        return $list;
    }

    public function index() {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['title'] = 'Shape';
        $data['shapes'] = $this->admin_model->getAllShapes();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/shape-view');
        $this->load->view('admin/commons/footer');
    }

    public function add_shape($id = null) {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($id)) {
            $data['shape'] = $this->admin_model->getShapeById($id);
        }
        $data['title'] = 'Shape';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/shape-add');
        $this->load->view('admin/commons/footer');
    }

    public function doAddShape() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('percentage', 'Percentage', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $image_url = $this->uploadImage();
        if ($image_url) {
            $result = $this->admin_model->doAddShape($image_url);
            if ($result) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Shape added sucessfully', 'url' => base_url('shape')]));
                return FALSE;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Shape did not added sucessfully.']));
                return FALSE;
            }
        } else {
            $errors = $this->session->userdata('errors');
            $this->session->unset_userdata('errors');
            $this->output->set_output(json_encode(['result' => -2, 'errors' => $errors]));
            return FALSE;
        }
    }

    public function uploadImage() {
        $config = array(
            'upload_path' => "./uploads/shape/",
            'allowed_types' => "jpeg|jpg|png",
            'max_size' => "1024"
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('errors', ['image_url' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function doEditShape($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('percentage', 'Percentage', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->uploadImage();
            if ($image_url == 0) {
                $errors = $this->session->userdata('errors');
                $this->session->unset_userdata('errors');
                $this->output->set_output(json_encode(['result' => -2, 'errors' => $errors]));
                return FALSE;
            }
        } else {
            $shape = $this->admin_model->getShapeById($id);
            $image_url = $shape['image_url'];
        }
        $result = $this->admin_model->doEditShape($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Shape edited sucessfully', 'url' => base_url('shape')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }

    public function deleteShape($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->doDeleteShape($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Shape Deleted Sucessfully', 'url' => base_url('shape')]));
            return FALSE;
        }
    }

    public function dimension($shape_id) {
        $data['shape'] = $this->admin_model->getShapeById($shape_id);
        $data['dimension'] = $dimension = $this->admin_model->getDimensionByShapeId($shape_id);
        $data['mapping'] = $this->admin_model->getTermDimensionMappingByDimensionId($dimension['dimension_id']);
        $data['corners'] = $this->admin_model->getDimensionCornerByDimensionId($dimension['dimension_id']);
        $data['terms'] = $this->filteredTerm();
        $data['title'] = 'Dimension';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/dimension');
        $this->load->view('admin/commons/footer');
    }

    public function doAddDimensionImage($shape_id) {
        $this->output->set_content_type('application/json');
        $config = array(
            'upload_path' => "./uploads/dimension/",
            'allowed_types' => "jpeg|jpg|png",
            'max_size' => "1024"
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image_url')) {
            $data = $this->upload->data();
            $this->admin_model->doAddDimensionImage($shape_id, $data['file_name']);
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Image uploaded Sucessfully', 'url' => base_url('shape/dimension/' . $shape_id)]));
            return FALSE;
        } else {
            $errors['image_url'] = $this->upload->display_errors();
            $this->output->set_output(json_encode(['result' => -2, 'errors' => $errors]));
            return FALSE;
        }
    }

    public function updateDimensionCorner($dimension_id) {
        $corner_name = $this->input->post('corner_name[]');
        $corner_id = $this->input->post('corner_id[]');
        $count = count($corner_name);
        for ($i = 0; $i < $count; $i++) {
            if (!empty($corner_id[$i])) {
                $this->admin_model->updateDimensionCorner($corner_id[$i], $corner_name[$i]);
            } else {
                $this->admin_model->addDimensionCorner($dimension_id, $corner_name[$i]);
            }
        }
        return 1;
    }

    public function removeDimensionCorner() {
        $this->output->set_content_type('application/json');
        $corner_id = $this->input->post('corner_id');
        $result = $this->admin_model->removeDimensionCorner($corner_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        }
    }

     public function UpdateTermDimensionMapping($dimension_id) {
        $mapping_id = $this->input->post('mapping_id[]');
        $term_id = $this->input->post('term_id[]');
        $prefix = $this->input->post('prefix[]');
        $count = count($term_id);
        for ($i = 0; $i < $count; $i++) {
            if (!empty($mapping_id[$i])) {
                $this->admin_model->UpdateTermDimensionMapping($dimension_id, $term_id[$i], $prefix[$i], $mapping_id[$i]);
            } else {
                $this->admin_model->addTermDimensionMapping($dimension_id, $term_id[$i], $prefix[$i]);
            }
        }
        return 1;
    }

    public function doUpdateDimension($shape_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doUpdateDimension($shape_id);
        $this->updateDimensionCorner($result['dimension_id']);
        $this->UpdateTermDimensionMapping($result['dimension_id']);
        $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Dimension Updated sucessfully', 'url' => base_url('shape/dimension/' . $shape_id)]));
        return FALSE;
    }

    public function removeDimension() {
        $this->output->set_content_type('application/json');
        $mapping_id = $this->input->post('mapping_id');
        $result = $this->admin_model->removeDimension($mapping_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1]));
            return FALSE;
        }
    }

    public function formula($shape_id) {
        $data['editor'] = 1;
        $data['shape'] = $this->admin_model->getShapeById($shape_id);
        $data['dimension'] = $dimension = $this->admin_model->getDimensionByShapeId($shape_id);
        $data['mapping'] = $this->admin_model->getTermDimensionMappingByDimensionId($dimension['dimension_id']);
        $data['corners'] = $this->admin_model->getDimensionCornerByDimensionId($dimension['dimension_id']);
        $data['terms'] = $this->filteredTerm();
        $data['title'] = 'Formula';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/formula');
        $this->load->view('admin/commons/footer');
    }

    public function doAddFormula($shape_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('formula', 'Formula', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddFormula($shape_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Formula added sucessfully', 'url' => base_url('shape/formula/'.$shape_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Formula did not added sucessfully.']));
            return FALSE;
        }
    }

}

