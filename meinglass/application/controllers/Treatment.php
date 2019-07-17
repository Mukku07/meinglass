<?php

/**
 * Description of Treatment
 *
 * @author Mohit kant gupta
 */
class Treatment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email');
    }
    
    private function filteredThickness(){
        $list=[''=>'--Select Thickness--'];
        $thickness= $this->admin_model->getAllThickness();
        foreach($thickness as $thick){
            $list[$thick['thickness_id']] = $thick['thickness'];
        }
        return $list;
    }

    public function index($id = null) {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if ($id) {
            $data['treatment'] = $this->admin_model->getTreatmentById($id);
        }
        $data['title'] = 'Surface Treatment';
        $data['treatments'] = $this->admin_model->getAllSurfaceTreatment();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/treatment-view');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddTreatment() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddTreatment();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Surface Treatment added sucessfully', 'url' => base_url('treatment')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Surface Treatment did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditTreatment($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditTreatment($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Surface Treatment updated sucessfully', 'url' => base_url('treatment')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }
    
    public function deleteTreatment($id){
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteTreatment($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Surface Treatment Deleted Sucessfully', 'url' => base_url('treatment')]));
            return FALSE;
        }
    }
    
    public function treatment_thickness_mapping($treatment_id,$mapping_id=null){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($mapping_id)) {
            $data['map'] = $this->admin_model->getTreatmentThicknessMappingById($mapping_id);
        }
        $data['title'] = 'Surface Treatment';
        $data['treatment']=$this->admin_model->getTreatmentById($treatment_id);
        $data['thickness']= $this->filteredThickness();
        $data['mappings'] = $this->admin_model->getAllTreatmentThicknessMapping($treatment_id);
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/treatment-thickness-mapping-view',$data);
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddTreatmentMapping(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness_id', 'Thickness', 'required');
        $this->form_validation->set_rules('mbf', 'MBF', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddTreatmentMapping();
        if ($result) {
            $treatment_id= $this->input->post('treatment_id');
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Surface Treatment Mapping added sucessfully', 'url' => base_url('treatment/treatment-thickness-mapping/'.$treatment_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Surface Treatment Mapping did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditTreatmentMapping($mapping_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness_id', 'Thickness', 'required');
        $this->form_validation->set_rules('mbf', 'MBF', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditTreatmentMapping($mapping_id);
        if ($result) {
            $treatment_id= $this->input->post('treatment_id');
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Surface Treatment Mapping Edited sucessfully', 'url' => base_url('treatment/treatment-thickness-mapping/'.$treatment_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes were made.']));
            return FALSE;
        }
    }
    
    public function deleteTreatmentMapping($treatment_id,$mapping_id){
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteTreatmentMapping($mapping_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Surface Treatment Deleted Sucessfully', 'url' => base_url('treatment/treatment-thickness-mapping/'.$treatment_id)]));
            return FALSE;
        }
    }
    
    /*@start  {Discription of Code ->@Author Mukesh Yadav} */
    public function shipping_cost($id="null"){

        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if ($id) {
            $data['shipping_cost'] = $this->admin_model->getShippingCostById($id);
        }
        $data['title'] = 'Shipping Cost';
        $data['shipping_costs'] = $this->admin_model->getAllShippingCost();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/shipping_cost');
        $this->load->view('admin/commons/footer');
    }

    public function doAddShippingCost() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('value1', 'Value X1', 'required');
        $this->form_validation->set_rules('value2', 'Value X2', 'required');
        $this->form_validation->set_rules('value3', 'Value X3', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddShippingCost();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Shipping Cost added sucessfully', 'url' => base_url('treatment/shipping_cost')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Shipping Cost did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditShippingCost($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('value1', 'Value X1', 'required');
        $this->form_validation->set_rules('value2', 'Value X2', 'required');
        $this->form_validation->set_rules('value3', 'Value X3', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditShippingCost($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Shipping Cost updated sucessfully', 'url' => base_url('treatment/shipping_cost')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }

    public function mass_density($id="null"){

        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if ($id) {
            $data['mass_density'] = $this->admin_model->getMassDensityById($id); 
        }
        $data['title'] = 'Mass Density';
        $data['mass_densitys'] = $this->admin_model->getAllMassDensity();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/mass_density');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddMassDensity(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('mvalue', 'Value kg/m<sup>3</sup>', 'required');
        // $this->form_validation->set_rules('cmvalue', 'Value g/cm<sup>3</sup>', 'required');
        // $this->form_validation->set_rules('mmvalue', 'Value g/mm<sup>3</sup>', 'required');
        // $this->form_validation->set_rules('weight', 'Weight', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddMassDensity();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Mass density added sucessfully', 'url' => base_url('treatment/mass_density')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Mass Density did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditMassDensity($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('mvalue', 'Value kg/m<sup>3</sup>', 'required');
        // $this->form_validation->set_rules('cmvalue', 'Value g/cm<sup>3</sup>', 'required');
        // $this->form_validation->set_rules('mmvalue', 'Value g/mm<sup>3</sup>', 'required');
        // $this->form_validation->set_rules('weight', 'Weight', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditMassDensity($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Mass density updated sucessfully', 'url' => base_url('treatment/mass_density')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }

    public function priceCalculate($id="null"){

        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if ($id) {
            $data['priceDataById'] = $this->admin_model->getPriceDataById($id); 
        }
        $data['title'] = 'Price Calculate';
        $data['priceData'] = $this->admin_model->getPriceCalculate();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/pricecal');
        $this->load->view('admin/commons/footer');
    }

    public function doAddFixedData(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('circumference', 'Gurtmaß Value', 'required');
        $this->form_validation->set_rules('minweight', 'Weight kg', 'required');
        $this->form_validation->set_rules('maxweight', 'Weight kg', 'required');
        $this->form_validation->set_rules('price', 'Price €', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddFixedData();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Price calculation added sucessfully', 'url' => base_url('treatment/priceCalculate')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Price calculation did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditFixedData($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('circumference', 'Gurtmaß Value', 'required');
        $this->form_validation->set_rules('minweight', 'Weight kg', 'required');
        $this->form_validation->set_rules('maxweight', 'Weight kg', 'required');
        $this->form_validation->set_rules('price', 'Price €', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditFixedData($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Price calculation updated sucessfully', 'url' => base_url('treatment/priceCalculate')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }
    
    /*@end  {Discription of Code ->@Author Mukesh Yadav} */
}

