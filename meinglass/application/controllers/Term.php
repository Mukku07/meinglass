<?php

/**
 * Description of Dimension
 *
 * @author Mohit Kant Gupta
 */
class Term extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email');
    }

    public function index($id = null) {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($id)) {
            $data['term'] = $this->admin_model->getTermById($id);
        }
        $data['title'] = 'Term';
        $data['tems'] = $this->admin_model->getAllTerms();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/term-view');
        $this->load->view('admin/commons/footer');
    }

    public function doAddTerm() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('term', 'Term', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddTerm();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Term added sucessfully', 'url' => base_url('term')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Term did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditTerm($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('dimension_name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditTerm($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Term Edit sucessfully', 'url' => base_url('term')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes were made.']));
            return FALSE;
        }
    }

    public function deleteTerm($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteTerm($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Term Deleted Sucessfully', 'url' => base_url('term')]));
            return FALSE;
        }
    }

    public function corner($id = null) {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($id)) {
            $data['corner'] = $this->admin_model->getCornerById($id);
        }
        $data['title'] = 'Corner';
        $data['corners'] = $this->admin_model->getAllCorners();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/corner-view');
        $this->load->view('admin/commons/footer');
    }

    public function doAddCorner() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddCorner();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Corner added sucessfully', 'url' => base_url('term/corner')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Corner did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditCorner($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditCorner($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Corner Updated sucessfully', 'url' => base_url('term/corner')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes were made.']));
            return FALSE;
        }
    }

    public function deleteCorner($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteCorner($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Corner Deleted Sucessfully', 'url' => base_url('term/corner')]));
            return FALSE;
        }
    }

    public function glass_type() {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['title'] = 'Glass Type';
        $data['types'] = $this->admin_model->getAllGlassType();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/glass-type-view');
        $this->load->view('admin/commons/footer');
    }

    public function add_glass_type($id = null) {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($id)) {
            $data['type'] = $this->admin_model->getGlassTypeById($id);
        }
        $data['title'] = 'Glass Type';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/glass-type-add');
        $this->load->view('admin/commons/footer');
    }

    public function doAddGlassType() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $image_url = $this->uploadImage();
        if ($image_url) {
            $result = $this->admin_model->doAddGlassType($image_url);
            if ($result) {
                $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Term added sucessfully', 'url' => base_url('term/glass_type')]));
                return FALSE;
            } else {
                $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Term did not added sucessfully.']));
                return FALSE;
            }
        } else {
            $errors = $this->session->userdata('errors');
            $this->session->unset_userdata('errors');
            $this->output->set_output(json_encode(['result' => -2, 'errors' => $errors]));
            return FALSE;
        }
    }

    public function doEditGlassType($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->uploadImage();
            if (!empty($this->session->userdata('errors'))) {
                $errors = $this->session->userdata('errors');
                $this->session->unset_userdata('errors');
                $this->output->set_output(json_encode(['result' => -2, 'errors' => $errors]));
                return FALSE;
            }
        } else {
            $type = $this->admin_model->getGlassTypeById($id);
            $image_url = $type['image_url'];
        }
        $result = $this->admin_model->doEditGlassType($id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Term edited sucessfully', 'url' => base_url('term/glass_type')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }

    public function uploadImage() {
        $config = array(
            'upload_path' => "./uploads/type/",
            'allowed_types' => "jpeg|jpg|png|gif",
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
    
    public function deleteGlassType($id){
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteGlassType($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Glass Type Deleted Sucessfully', 'url' => base_url('term/glass_type')]));
            return FALSE;
        }
    }

}

