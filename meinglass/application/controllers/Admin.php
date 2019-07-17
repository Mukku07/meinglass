<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email');
    }

    public function index() {
        if ($this->isLogin()) {
            redirect(base_url('admin/dashboard'));
        }
        $this->load->view('admin/login');
    }

    public function checkLogin() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->checkLogin();
        if ($result) {
            $this->session->set_userdata('email', $result['email']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('admin/dashboard'), 'msg' => 'Loading!! Please Wait']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid username or password']));
            return FALSE;
        }
    }

    public function dashboard() {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['title']='Dashboard';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/commons/footer');
    }
    
    public function change_password(){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['title']='Dashboard';
        $this->load->view('admin/commons/header',$data);
        $this->load->view('admin/change-password');
        $this->load->view('admin/commons/footer');
    }
    
    public function doChangePassword() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('newPassword', 'New Password', 'required');
        $this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'required|matches[newPassword]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doChangePassword($this->isLogin());
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Password changes sucessfully.']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Password is not correct']));
            return FALSE;
        }
    }

    public function logout() {
        $this->session->unset_userdata('email');
        redirect(base_url('admin'));
    }

}
