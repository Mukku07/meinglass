<?php 
/*
    ########################################
      *** Discription of Client Model ***
      ___________________________________
      ******@Author:- Mukesh Yadav ******
    ########################################
*/
class Client_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    public function user_regiter($register){

        $this->db->insert('clients', $register);
        return $this->db->insert_id();
    }

    public function user_login($login){
        $query = $this->db->get_where('clients', $login);
        return $query->row_array();
    }

    public function forgot_password($email){
    	$this->db->select('name,email');
    	$query = $this->db->get_where('clients', $email);
        return $query->row_array();
    }
    
    public function createAddress($client_id){

        $data=array(
            'client_id'=>$client_id
        );
        $this->db->insert('shipping_address',$data);
        $this->db->insert('billing_address',$data);
        return true;
    }
}
?>
  