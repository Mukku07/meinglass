<?php

/**
 * Description of Thickness
 *
 * @author Mohit Kant Gupta
 */
class Thickness extends CI_Controller {

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
        if ($id) {
            $data['thickness'] = $this->admin_model->getThicknessById($id);
        }
        $data['title'] = 'Thickness';
        $data['thicknesses'] = $this->admin_model->getAllThickness();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/thickness-view');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddThickness(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness', 'Thickness', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddThickness();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material added sucessfully', 'url' => base_url('thickness')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Material did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditThickness($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness', 'Thickness', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditThickness($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material Edited sucessfully', 'url' => base_url('thickness')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }
    
    public function deleteThickness($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteThickness($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material Deleted Sucessfully', 'url' => base_url('thickness')]));
            return FALSE;
        }
    }

}
