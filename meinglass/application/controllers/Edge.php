<?php

/**
 * Description of Edge
 *
 * @author Mohit Kant Gupta
 */
class Edge extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model']);
    }

    private function isLogin() {
        return $this->session->userdata('email');
    }
    
    public function filteredEdgeType($edge_id){
        $list=[''=>'--Select Edge Type--'];
        $edges=$this->admin_model->getEdgeTypeByEdgeId($edge_id);
        foreach ($edges as $edge) {
            $list[$edge['edge_type_id']] = $edge['edge_type_value'];
        }
        return $list;
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
            $data['edge'] = $this->admin_model->getEdgeById($id);
        }
        $data['title'] = 'Edge Processing';
        $data['edges'] = $this->admin_model->getAllEdges();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/edge-view');
        $this->load->view('admin/commons/footer');
    }

    public function doAddEdge() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddEdge();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge added sucessfully', 'url' => base_url('edge')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Edge did not added sucessfully.']));
            return FALSE;
        }
    }

    public function doEditEdge($id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('type', 'Type', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditEdge($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge updated sucessfully', 'url' => base_url('edge')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }

    public function deleteEdge($edge_id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteEdge($edge_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Deleted Sucessfully', 'url' => base_url('edge')]));
            return FALSE;
        }
    }

    public function edge_type($edge_id) {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['edge'] = $this->admin_model->getEdgeById($edge_id);
        $data['edge_types'] = $this->admin_model->getEdgeTypeByEdgeId($edge_id);
        $data['title'] = 'Edge Processing';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/edge-type-view');
        $this->load->view('admin/commons/footer');
    }

    public function doAddEdgeType($edge_id) {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('edge_type_value', 'Edge Type Value', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddEdgeType($edge_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Type added sucessfully', 'url' => base_url('edge/edge_type/' . $edge_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Edge Type did not added sucessfully.']));
            return FALSE;
        }
    }

    public function deleteEdgeType($edge_type_id,$edge_id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteEdgeType($edge_type_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Type Deleted Sucessfully', 'url' => base_url('edge/edge_type/' . $edge_id)]));
            return FALSE;
        }
    }
    
    public function edge_element() {
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['edge_elements'] = $this->admin_model->getEdgeElement();
        $data['title'] = 'Edge Element';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/edge-element-view');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddEdgeElement(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('edge_element_name', 'Edge Element Value', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddEdgeElement();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Element added sucessfully', 'url' => base_url('edge/edge_element')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Edge Element did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function deleteEdgeElement($edge_element_id){
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteEdgeElement($edge_element_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Element Deleted Sucessfully', 'url' => base_url('edge/edge_element')]));
            return FALSE;
        }
    }
    
    public function map_edge_element($edge_id){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['edge_elements'] = $this->admin_model->getEdgeElement();
        $data['edge_id']=$edge_id;
        $data['title'] = 'Edge Processing';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/map-edge-element-view');
        $this->load->view('admin/commons/footer');
    }
    
    public function map_edge_thickness($edge_id,$edge_element_id){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['edge_id']=$edge_id;
        $data['edge_element_id'] = $edge_element_id;
        $data['mappings'] = $this->admin_model->getEdgeThicknessMapping($edge_id,$edge_element_id);
        $data['title'] = 'Edge Processing';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/map-edge-thickness-view');
        $this->load->view('admin/commons/footer');
    }
    
    public function add_edge_thickness_map($edge_id,$edge_element_id,$mapping_id=null){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['edge_id']=$edge_id;
        $data['edge_element_id'] = $edge_element_id;
        $data['edge_type']= $this->filteredEdgeType($edge_id);
        $data['thickness']= $this->filteredThickness();
        if(!empty($mapping_id)){
            $data['mapping'] = $this->admin_model->getEdgeThicknessMappingById($mapping_id);
        }
        $data['title'] = 'Edge Processing';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/map-edge-thickness-add');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddEdgeThicknessMap(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness_id', 'Thickness', 'required');
        $this->form_validation->set_rules('edge_type_id', 'Edge Type', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $edge_id= $this->input->post('edge_id');
        $edge_element_id= $this->input->post('edge_element_id');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddEdgeThicknessMap();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Thickness Mapping added sucessfully', 'url' => base_url('edge/map_edge_thickness/'.$edge_id.'/'.$edge_element_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Edge Thickness Mapping did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditEdgeThicknessMap($mapping_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness_id', 'Thickness', 'required');
        $this->form_validation->set_rules('edge_type_id', 'Edge Type', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $edge_id= $this->input->post('edge_id');
        $edge_element_id= $this->input->post('edge_element_id');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditEdgeThicknessMap($mapping_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Thickness Mapping Updated sucessfully', 'url' => base_url('edge/map_edge_thickness/'.$edge_id.'/'.$edge_element_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No Changes were made']));
            return FALSE;
        }
    }
    
    public function deleteEdgeThicknessMapping($edge_id,$edge_element_id,$mapping_id){
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteEdgeThicknessMapping($mapping_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Edge Thickness Mapping Deleted Sucessfully', 'url' => base_url('edge/map_edge_thickness/'.$edge_id.'/'.$edge_element_id)]));
            return FALSE;
        }
    }

}
