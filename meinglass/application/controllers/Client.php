<?php 
/*
    ########################################
     ** Discription of Client Controller **
      ___________________________________
      ******@Author:- Mukesh Yadav ******
    ########################################
*/
class Client extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['client_model']);
    }
   
    public function user_regiter(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('emailId', 'Email', 'trim|required|valid_email|is_unique[clients.email]');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        
        $register= array(
        	'name' => $this->security->xss_clean($this->input->post('name')),
        	'email' => $this->security->xss_clean($this->input->post('emailId')),
        	'phone' => $this->security->xss_clean($this->input->post('phone')),
        	'password' => $this->security->xss_clean(hash('sha256',$this->input->post('password'))),
        	'created' => date("d-M-Y")
        );
        $inserted_client_id = $this->client_model->user_regiter($register);
        $result = $this->client_model->createAddress($inserted_client_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('home/'), 'msg' => 'Congratulations!! Successfully Registered...']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Sorry!! Some Error Occurs!']));
            return FALSE;
        }
    }

    public function user_login(){
       
        $page_url = $this->session->userdata('page_url');
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('login_emailId', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('login_password', 'Password', 'trim|required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $login = array(
        	'email' => $this->security->xss_clean($this->input->post('login_emailId')),
        	'password' => $this->security->xss_clean(hash('sha256',$this->input->post('login_password')))
        );
    	$result = $this->client_model->user_login($login);
        
        if ($result) {
            $this->session->set_userdata('client_id', $result['client_id']);
            $this->session->set_userdata('client_email', $result['email']);
            $this->output->set_output(json_encode(['result' => 1, 'url' => $page_url, 'msg' => 'Successfully Login..! Welcome '.$result['email'] ]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Email Id or Password! Try Again...']));
            return FALSE;
        }
    	
    }
    
    public function forgot_password(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $email = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
        );
        $result = $this->client_model->forgot_password($email); 
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Successfully Verify Your Email ID' ]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Invalid Email ID. Enter Valid Email Id ...']));
            return FALSE;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
?>