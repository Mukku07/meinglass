<?php

/**
 * Description of Thickness
 *
 * @author Mohit Kant Gupta
 */
class Material extends CI_Controller {

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
            $data['material'] = $this->admin_model->getMaterialById($id);
        }
        $data['title'] = 'Material Type';
        $data['materials'] = $this->admin_model->getAllMaterials();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/material-view');
        $this->load->view('admin/commons/footer');
    }

    public function doAddMaterial() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('material_name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddMaterial();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material added sucessfully', 'url' => base_url('material')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Material did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditMaterial($id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('material_name', 'Name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditMaterial($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material Edited sucessfully', 'url' => base_url('material')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }
    
    public function deleteMaterial($id) {
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteMaterial($id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material Deleted Sucessfully', 'url' => base_url('material')]));
            return FALSE;
        }
    }
    
    public function material_thickness($material_id,$thickness_id=null){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if(!empty($thickness_id)){
            $data['thick']= $this->admin_model->getMaterialThicknessById($thickness_id);
        }
        $data['material']= $this->admin_model->getMaterialById($material_id);
        
        $data['thickness']= $this->filteredThickness();
        $data['material_thickness']= $this->admin_model->getMaterialThicknessByMaterialId($material_id);
        $data['title'] = 'Material Type';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/material-thickness-view');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddMaterialThickness($material_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness_id', 'Thickness', 'required');
        $this->form_validation->set_rules('cost', 'Cost', 'required|numeric');
        $this->form_validation->set_rules('mbf', 'MBF', 'required|numeric');
        $this->form_validation->set_rules('additional', 'Additional', 'required|numeric');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddMaterialThickness($material_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material Thickness added sucessfully', 'url' => base_url('material/material_thickness/'.$material_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Thickness did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditMaterialThickness($thickness_id,$material_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('thickness_id', 'Thickness', 'required');
        $this->form_validation->set_rules('cost', 'Cost', 'required|numeric');
        $this->form_validation->set_rules('mbf', 'MBF', 'required|numeric');
        $this->form_validation->set_rules('additional', 'Additional', 'required|numeric');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditMaterialThickness($thickness_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Material Thickness Edited sucessfully', 'url' => base_url('material/material_thickness/'.$material_id)]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'No changes were made.']));
            return FALSE;
        }
    }
    
    public function deleteThickness($thickness_id,$material_id){
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteThickness($thickness_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Thickness Deleted Sucessfully', 'url' => base_url('material/material_thickness/'.$material_id)]));
            return FALSE;
        }
    }

}
