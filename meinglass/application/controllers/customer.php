<?php
/*
    ########################################
    **Discription of Customer Controller **
      ___________________________________
      ******@Author:- Mukesh Yadav ******
    ########################################
*/
class Customer extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    private function isLogin() {
        return $this->session->userdata('email');
    }
    
    public function index(){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
//        if (!empty($id)) {
//            $data['crouselById'] = $this->admin_model->getCrouselById($id);
//            
//        }
        $data['title'] = 'Customer';
        //$data['crouselData'] = $this->admin_model->getAllcarousel();
        $this->load->view('admin/commons/header', $data);
        //$this->load->view('admin/carousel');
        $this->load->view('admin/commons/footer');
    }
}