<?php
/**
 * Description of Home
 *
 * @author Mohit Kant Gupta
 */
class Home extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){

        $data['title'] = "Home";
        $data['carousels'] = $this->glass_model->getcarousel();
        $data['galleries'] = $this->glass_model->gellerie();
        $data['reviews'] = $this->glass_model->getreview();        
        $this->load->view('glass/commons/header',$data);
        $this->load->view('glass/home');
        $this->load->view('glass/commons/footer');
    }
    
    public function gallery(){

        $data['title'] = "gallerie";
        $data['newss'] = $this->glass_model->getnews();
        $data['galleries'] = $this->glass_model->gellerie();
        $this->load->view('glass/commons/header',$data);
        $this->load->view('glass/news');
        $this->load->view('glass/commons/footer');
    }
    
    public function shop(){

        $data['title'] = "Shop";
        $productDetails = array();
        $data['productinfo'] = $productinfo = $this->admin_model->getAllProducts();
        foreach($productinfo as $info){
            $product_id = $info['product_id'];
            $product_price = $info['price'];
            $shapes = $this->admin_model->getShapeById($info['shape_id']);
            $dimension_data = $this->admin_model->getSelectedDimension($info['dimension_id']);
            $dimension_mapping = $this->admin_model->getSelectedDimensionMapping($info['dimension_id']);
            $glass_type = $this->admin_model->getSelectedGlassType($info['glass_type_id']);
            $material = $this->admin_model->getSelectedMaterial($info['material_id']);
            $thickness = $this->admin_model->getSelectedThickness($info['thickness_id']);
            $material_thickness = $this->admin_model->getSelectedMaterialThickness($info['material_id'], $info['thickness_id']);
            $edge = $this->admin_model->getSelectedEdgeData($info['edge_id']);
            $edge_element = $this->admin_model->getSelectedEdgeElementData($info['edge_element_id']);
            $edge_type = $this->admin_model->getSelectedEdgeType($info['edge_id'], $info['edge_type_id']);
            $edge_processing = $this->admin_model->getSelectEdgeProcessing($info['edge_id'], $info['edge_element_id'], $info['thickness_id'], $info['edge_type_id']);
            $surface_treatment = $this->admin_model->getSelectedTreatmentData($info['treatment_id']);
            $surface_treatment_mapping = $this->admin_model->getSelectedSurfaceTreatmentMap($info['treatment_id'], $info['thickness_id']);
            $product_status = $info['status'];
            array_push($productDetails, ['product_id'=>$product_id, 'product_price'=>$product_price, 'shape_data'=>$shapes, 'dimension_data'=>$dimension_data,'dimension_mapping'=>$dimension_mapping,'glass_type'=>$glass_type,'material'=>$material,'thickness'=>$thickness,'material_thickness'=>$material_thickness,'edge'=>$edge,'edge_element'=>$edge_element,'edge_type'=>$edge_type,'edge_processing'=>$edge_processing,'surface_treatment'=>$surface_treatment,'surface_treatment_mapping'=>$surface_treatment_mapping, 'status'=>$product_status]);
        }
        $data['allProducts']=$productDetails;
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/shop');
        $this->load->view('glass/commons/footer');
    }
    
    /*@start  {Discription of Code ->@Author Mukesh Yadav} */
    public function doAddContact(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('message', 'Message', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->glass_model->doAddContact();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('home/gallery'), 'msg' => 'Your Message Successfully Submitted!!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Some Error Found Here']));
            return FALSE;
        }
    }
    
    /*@end  {Discription of Code ->@Author Mukesh Yadav} */
}
