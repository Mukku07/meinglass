<?php 
/*
    ########################################
    ** Discription of Products Controller **
      ___________________________________
      ******@Author:- Mukesh Yadav ******
    ########################################
*/
class Products extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model(['admin_model','glass_model']);
    }
    
    private function isLogin() {
        return $this->session->userdata('email');
    }
    
     private function filteredTerm() {
        $terms = $this->glass_model->getAllTerms();
        foreach ($terms as $term) {
            $list[$term['id']] = $term['term'];
        }
        return $list;
    }

    private function filteredCorner() {
        $corners = $this->glass_model->getAllCorners();
        foreach ($corners as $corner) {
            $list[$corner['corner_id']] = $corner['type'];
        }
        return $list;
    }

    private function filteredMaterial() {
        $materials = $this->glass_model->getAllMaterial();
        foreach ($materials as $material) {
            $list[$material['id']] = $material['material_name'];
        }
        return $list;
    }

    private function filteredEdge() {
        $edges = $this->glass_model->getAllEdge();
        foreach ($edges as $edge) {
            $list[$edge['edge_id']] = $edge['type'];
        }
        return $list;
    }

    public function filteredEdgeType($edge_id) {
        $list = [];
        $edges = $this->glass_model->getEdgeTypeByEdgeId($edge_id);
        foreach ($edges as $edge) {
            $list[$edge['edge_type_id']] = $edge['edge_type_value'];
        }
        return $list;
    }

    public function filteredEdgeElement() {
        $list = [];
        $elements = $this->glass_model->getEdgeElement();
        foreach ($elements as $element) {
            $list[$element['edge_element_id']] = $element['edge_element_name'];
        }
        return $list;
    }

    private function filteredSurfaceTreatment() {
        $list = [];
        $treatments = $this->glass_model->getAllSurfaceTreatment();
        foreach ($treatments as $treatment) {
            $list[$treatment['treatment_id']] = $treatment['type'];
        }
        return $list;
    }
    
    public function index(){
       if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $productDetails = array();
        $data['title'] = 'Products Details';
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
        //print_r($data['allProducts']);exit;
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/products/product-view');
        $this->load->view('admin/commons/footer');  
    }
    
    public function addProduct($product_id = NULL ){

        if (!empty($product_id)) {
            $data['products'] = $this->admin_model->getProductsData($product_id);
        }else{ 
            $data['inserted'] = $this->admin_model->insertProductId(); 
        }
        $data['title'] = 'Add Product';
        $data['shapes'] = $this->admin_model->getActiveAllShape();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/products/add-shape');
        $this->load->view('admin/commons/footer');  
    }
    
    public function shapeCal($products_id) {
        
        $this->output->set_content_type('application/json');
        $shape_id = $this->input->post('shape_id');
        $this->admin_model->updateUserShape($products_id, $shape_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('products/dimension/'.$products_id)]));
        return FALSE;
    }
    
    public function dimension($product_id = NULL ) {

        if (empty($product_id)) {
            redirect(base_url('products/addProduct'));
            die;
        }
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
        $data['title'] = 'Add Product';
        $data['terms'] = $this->filteredTerm();
        $data['shape'] = $this->admin_model->getShapeByShape_id($products['shape_id']);
        $data['dimension'] = $dimension = $this->admin_model->getDimensionByShapeId($products['shape_id']);
        $data['mappings'] = $this->admin_model->getTermDimentionMapping($dimension['dimension_id']);
        $data['dimension_corners'] = $this->admin_model->getDimensionCornerByDimensionId($dimension['dimension_id']);
        $data['corners'] = $this->filteredCorner();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/products/add-dimension', $data);
        $this->load->view('admin/commons/footer');  
    }
    
    public function dimensionCal($product_id =NULL) {
        
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('term_size[]', 'Dimention Size', 'required|trim');
        $dimension_id = $this->input->post('dimension_id');
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => 'The Dimention Size field is required.']));
            return FALSE;
        }
        if (!empty($this->input->post('term_size[]'))) {
            $term_size = implode(',', $this->input->post('term_size[]'));
        }
        if (!empty($this->input->post('corner[]'))) {
            $corner = implode(',', $this->input->post('corner[]'));
        } else {
            $corner = '';
        }
        $data = array(
            'dimension_id' => $dimension_id,
            'term_size' => $term_size,
            'corner' => $corner
        );
        $this->admin_model->updateUserDimension($data, $product_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('products/glass-type/'.$product_id)]));
        return FALSE;
    }
    
    public function glass_type($product_id = NULL) {
        if (empty($product_id)) {
            redirect(base_url('products/addProduct'));
            die;
        }
        $data['title'] = 'Add Product';
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
        $data['glasses'] = $this->admin_model->getAllGlassType();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/products/glass-type');
        $this->load->view('admin/commons/footer');
    }

    public function glassTypeCal($product_id = NULL) {
        $this->output->set_content_type('application/json');
        $glass_type_id = $this->input->post('glass_type_id');
        $this->admin_model->updateUserGlassType($glass_type_id, $product_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('products/thickness/'.$product_id)]));
        return FALSE;
    }

    public function thickness($product_id = NULL) {
        if (empty($product_id)) {
            redirect(base_url('products/addProduct'));
            die;
        }
        $data['title'] = 'Add Product';
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
        $data['material'] = $this->filteredMaterial();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/products/material');
        $this->load->view('admin/commons/footer');
    }

    public function getThickness($product_id =NULL) {
        
        $this->output->set_content_type('application/json');
        $id = $this->input->post('id');
        $data['thickness'] = $this->admin_model->getThicknessByMaterialId($id);
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
        $thickness_list = $this->load->view('admin/include/thickness-list', $data, true);
        $this->output->set_output(json_encode(['thickness_list' => $thickness_list]));
        return FALSE;
    }

    public function thicknessCal($product_id = NULL) {
        $this->output->set_content_type('application/json');
        $this->admin_model->updateUserGlassThickness($product_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('products/edge/'.$product_id)]));
        return FALSE;
    }

    public function edge($product_id = NULL) {
        if (empty($product_id)) {
            redirect(base_url('products/addProduct'));
            die;
        }
        $data['title'] = 'Add Product';
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
        $data['edge'] = $this->filteredEdge();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/products/edge');
        $this->load->view('admin/commons/footer');  
    }

    public function getEdgeType($product_id = NULL) {
        $this->output->set_content_type('application/json');
        $edge_id = $this->input->post('edge_id');
        $data['edge_type'] = $this->filteredEdgeType($edge_id);
        $data['edge_element'] = $this->filteredEdgeElement();
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
        $edge_list = $this->load->view('admin/include/edge-type-list', $data, true);
        $this->output->set_output(json_encode(['edge_list' => $edge_list]));
        return FALSE;
    }

    public function edgeCal($product_id = NULL) {
        
        $this->output->set_content_type('application/json');
        $this->admin_model->updateUserEdge($product_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('products/surface-treatment/'.$product_id)]));
        return FALSE;
    }

    public function surface_treatment($product_id = NULL) {
        if (empty($product_id)) {
            redirect(base_url('products/addProduct'));
            die;
        }
        $data['title'] = 'Add Product';
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
        $data['treatment'] = $this->filteredSurfaceTreatment();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/products/treatment', $data);
        $this->load->view('admin/commons/footer');  
    }

    public function treatmentCal($product_id = NULL) {
        $this->output->set_content_type('application/json');
        $this->admin_model->updateSurfaceTreatment($product_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('products/summary/'.$product_id)]));
        return FALSE;
    }
    
    public function summary($product_id = NULL) {
        
        $data['title'] = 'Add Product';
        $data['products'] = $products = $this->admin_model->getProductsData($product_id);
         
            $data['shapes'] = $shapes = $this->admin_model->getShapeById($products['shape_id']);
            $data['dimension_data'] = $dimension_data = $this->admin_model->getSelectedDimension($products['dimension_id']);
            $data['dimension_mapping'] = $dimension_mapping = $this->admin_model->getSelectedDimensionMapping($products['dimension_id']);
            $data['glass_type'] = $glass_type = $this->admin_model->getSelectedGlassType($products['glass_type_id']);
            $data['material'] = $material = $this->admin_model->getSelectedMaterial($products['material_id']);
            $data['thickness'] = $thickness = $this->admin_model->getSelectedThickness($products['thickness_id']);
            $data['material_thickness'] = $material_thickness = $this->admin_model->getSelectedMaterialThickness($products['material_id'], $products['thickness_id']);
            $data['edge'] = $edge = $this->admin_model->getSelectedEdgeData($products['edge_id']);
            $data['edge_element'] = $edge_element = $this->admin_model->getSelectedEdgeElementData($products['edge_element_id']);
            $data['edge_type'] = $edge_type = $this->admin_model->getSelectedEdgeType($products['edge_id'], $products['edge_type_id']);
            $data['edge_processing'] = $edge_processing = $this->admin_model->getSelectEdgeProcessing($products['edge_id'], $products['edge_element_id'], $products['thickness_id'], $products['edge_type_id']);
            $data['surface_treatment'] = $surface_treatment = $this->admin_model->getSelectedTreatmentData($products['treatment_id']);
            $data['surface_treatment_mapping'] = $surface_treatment_mapping = $this->admin_model->getSelectedSurfaceTreatmentMap($products['treatment_id'], $products['thickness_id']);

            $data['shipping_cost'] = $shipping_cost = $this->glass_model->getAllShippingCost();
            $data['mass_density'] = $mass_density = $this->glass_model->getAllMassDensity();
            
            
            $data['materialThickCost'] = $materialThickCost = $this->calculateMaterialThicknessCost($thickness, $material_thickness);
            $data['shapeDimension'] = $shapeDimension = $this->calculateDimensionOfShape($products, $dimension_mapping, $shapes);
            $data['edgeProcessing'] = $edgeProcessing = $this->calculateEdgeProcessing($shapeDimension, $material_thickness, $materialThickCost, $edge_processing);
            $data['surfaceTreatment'] = $surfaceTreatment = $this->calculateSurfaceTreatment($edgeProcessing, $surface_treatment_mapping);
            $data['shapeCircumferencewithPrice'] = $shapeCircumferencewithPrice = $this->calculateShapeCircumference($dimension_mapping, $thickness, $shipping_cost, $products, $mass_density);
           
       $this->load->view('admin/commons/header', $data);
       $this->load->view('admin/products/summary');
       $this->load->view('admin/commons/footer'); 
    }
    

    public function submitPriceofProduct($product_id) {
        $this->output->set_content_type('application/json');
        $this->admin_model->submitPriceofProduct($product_id, $this->input->post('product_price'));
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('products/')]));
        return FALSE;
    }

    public function editstatus($product_id, $status){

        $this->output->set_content_type('application/json');
        $result = $this->admin_model->editstatus($product_id, $status);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Product Updated Sucessfully', 'url' => base_url('products')]));
            return FALSE;
        }
    }

    public function deleteproduct($product_id){
       
        $this->output->set_content_type('application/json');
        $result = $this->admin_model->deleteproduct($product_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Product Deleted Sucessfully', 'url' => base_url('products')]));
            return FALSE;
        }
    }

    function calculateMaterialThicknessCost($thickness, $material_thickness) {

        return $thickness['thickness'] * $material_thickness['cost'];
    }

    function calculateDimensionOfShape($uniqid, $dimension_mapping, $shape_data) {
        $term_size = explode(',', $uniqid['term_size']);

        $value = array();
        $i = 0;

        foreach ($dimension_mapping as $tdm) {
            //  echo '$'.$tdm['prefix'].'='.$term_size[$i]."<br>";
            $value[$tdm['prefix']] = $term_size[$i];

            $i++;
        }

        $formula = $shape_data['formula'];

        extract($value);
        eval("\$formula= \"$formula\";");

        return $cal_shape = eval('return ' . $formula . ';');
    }

    function calculateEdgeProcessing($shapeDimension, $material_thickness, $materialThickCost, $edge_processing) {
        $cal = $shapeDimension * $material_thickness['mbf'];
        $calculate = $materialThickCost + $cal + $material_thickness['additional'];
        return $calculate + $edge_processing['price'];
    }

    function calculateSurfaceTreatment($edgeProcessing, $surface_treatment_mapping) {
        $cal_surface = $edgeProcessing * $surface_treatment_mapping['mbf'];
        return $cal_surface + $surface_treatment_mapping['price'];
    }

    function calculateShapeCircumference($dimension_mapping, $thickness, $shipping_cost, $uniqid, $mass_density) {
        $X1 = $shipping_cost['value1'];
        $X2 = $shipping_cost['value2'];
        $X3 = $shipping_cost['value3'];
        $thickness = $thickness['thickness'];

        if (!empty($uniqid['dimension_id'])) {
            $term_size = explode(',', $uniqid['term_size']);
            $i = 0;
            $term = '';
            $shapeData = array();
            foreach ($dimension_mapping as $tdm) {
                //echo $value =  $tdm['term']." (".$tdm['prefix'].'): '.$term_size[$i].'<br>';
                $data = $tdm['term'] . "(" . $tdm['prefix'] . ')=' . $term_size[$i];
                array_push($shapeData, $data);
                $i++;
            }
        }

        if (!empty($shapeData)) {
            $size = sizeof($shapeData);
            if ($size == 1) {
                $radious = substr(strstr($shapeData['0'], "="), 1) * 2;
                $cal_cost = (2 * 3.14 * $radious) + (2 * $thickness);
                $mass_density = $mass_density['mvalue'] / (1000 * 1000);
                $shape_weight = $radious * $thickness * $mass_density / 1000 . " kg ";
            }
            if ($size == 2) {
                $s1 = substr(strstr($shapeData['0'], "="), 1);
                $s2 = substr(strstr($shapeData['1'], "="), 1);

                if ($s2 <= $s1) {
                    $longest = $s1;
                    $smallest = $s2;
                } else {
                    $longest = $s2;
                    $smallest = $s1;
                }
                $cal_cost = 2 * ($smallest + $X1) + 2 * ($thickness + $X2) + ($longest + $X3);
                $mass_density = $mass_density['mvalue'] / (1000 * 1000);
                $shape_weight = $longest * $smallest * $thickness * $mass_density / 1000 . " kg ";
            }
            if ($size == 3) {
                //print_r($shapeData);
                $s1 = strtok($shapeData[0], '(');
                $s2 = strtok($shapeData[1], '(');
                $s3 = strtok($shapeData[2], '(');
                if (($s1 != $s2) && ($s2 != $s3)) {
                    $val1 = substr(strstr($shapeData['0'], "="), 1);
                    $val2 = substr(strstr($shapeData['1'], "="), 1);
                    $val3 = substr(strstr($shapeData['2'], "="), 1);
                    $longest = max($val1, $val2, $val3);
                    $arr = array($val1, $val2, $val3);
                    $n = sizeof($arr);
                    $smallest = $this->print2largest($arr, $n);
                }
                if ($s1 === $s2) {
                    $longer1 = substr(strstr($shapeData['0'], "="), 1);
                    $longer2 = substr(strstr($shapeData['1'], "="), 1);
                    $smallest = substr(strstr($shapeData['2'], "="), 1);
                    $longest = $this->checkValue($longer1, $longer2);
                } else if ($s2 === $s3) {
                    $longer1 = substr(strstr($shapeData['1'], "="), 1);
                    $longer2 = substr(strstr($shapeData['2'], "="), 1);
                    $smallest = substr(strstr($shapeData['0'], "="), 1);
                    $longest = $this->checkValue($longer1, $longer2);
                } else if ($s1 === $s3) {
                    $longer1 = substr(strstr($shapeData['0'], "="), 1);
                    $longer2 = substr(strstr($shapeData['2'], "="), 1);
                    $smallest = substr(strstr($shapeData['1'], "="), 1);
                    $longest = $this->checkValue($longer1, $longer2);
                }
                $cal_cost = 2 * ($smallest + $X1) + 2 * ($thickness + $X2) + ($longest + $X3);
                $mass_density = $mass_density['mvalue'] / (1000 * 1000);
                $shape_weight = $longest * $smallest * $thickness * $mass_density / 1000 . " kg ";
            }

            if ($size == 4) {
                $s1 = strtok($shapeData[0], '(');
                $s2 = strtok($shapeData[1], '(');
                $s3 = strtok($shapeData[2], '(');
                $s4 = strtok($shapeData[3], '(');
                if (($s1 = $s2 = $s3) || ($s1 = $s2 = $s4) || ($s1 = $s3 = $s4) || ($s2 = $s3 = $s4)) {

                    if (($s1 == $s2) && ($s1 == $s3)) {

                        $longer1 = substr(strstr($shapeData['0'], "="), 1);
                        $longer2 = substr(strstr($shapeData['1'], "="), 1);
                        $longer3 = substr(strstr($shapeData['2'], "="), 1);
                        $smallest = substr(strstr($shapeData['3'], "="), 1);
                        $longest = $this->checkEquality($longer1, $longer2, $longer3);
                    }
                    if (($s1 == $s2) && ($s1 == $s4)) {

                        $longer1 = substr(strstr($shapeData['0'], "="), 1);
                        $longer2 = substr(strstr($shapeData['1'], "="), 1);
                        $longer4 = substr(strstr($shapeData['3'], "="), 1);
                        $smallest = substr(strstr($shapeData['2'], "="), 1);
                        $longest = $this->checkEquality($longer1, $longer2, $longer4);
                    }
                    if (($s1 == $s3) && ($s1 == $s4)) {

                        $longer1 = substr(strstr($shapeData['0'], "="), 1);
                        $longer3 = substr(strstr($shapeData['2'], "="), 1);
                        $longer4 = substr(strstr($shapeData['3'], "="), 1);
                        $smallest = substr(strstr($shapeData['1'], "="), 1);
                        $longest = $this->checkEquality($longer1, $longer3, $longer4);
                    }
                    if (($s2 == $s3) && ($s2 == $s4)) {

                        $longer1 = substr(strstr($shapeData['1'], "="), 1);
                        $longer3 = substr(strstr($shapeData['2'], "="), 1);
                        $longer4 = substr(strstr($shapeData['3'], "="), 1);
                        $smallest = substr(strstr($shapeData['0'], "="), 1);
                        $longest = $this->checkEquality($longer1, $longer3, $longer4);
                    }
                }
                if (($s1 == $s2) || ($s1 == $s3) || ($s1 == $s4) || ($s2 == $s3) || ($s2 == $s4) || ($s3 == $s4)) {
                    if ($s1 == $s2) {
                        $longer1 = substr(strstr($shapeData['0'], "="), 1);
                        $longer2 = substr(strstr($shapeData['1'], "="), 1);
                        if ($s1 = $s2 = "Width") {
                            $smallest = checkValue($longer1, $longer2);
                        }
                        $longest = checkValue($longer1, $longer2);
                    } else if ($s1 == $s3) {
                        $longer1 = substr(strstr($shapeData['0'], "="), 1);
                        $longer3 = substr(strstr($shapeData['2'], "="), 1);
                        if ($s1 = $s3 = "Width") {
                            $smallest = checkValue($longer1, $longer3);
                        }
                        $longest = checkValue($longer1, $longer3);
                    } else if ($s1 == $s4) {
                        $longer1 = substr(strstr($shapeData['0'], "="), 1);
                        $longer4 = substr(strstr($shapeData['3'], "="), 1);
                        if ($s1 = $s4 = "Width") {
                            $smallest = checkValue($longer1, $longer4);
                        }
                        $longest = checkValue($longer1, $longer4);
                    } else if ($s2 == $s3) {
                        $longer2 = substr(strstr($shapeData['1'], "="), 1);
                        $longer3 = substr(strstr($shapeData['2'], "="), 1);
                        if ($s2 = $s3 = "Width") {
                            $smallest = checkValue($longer2, $longer3);
                        }
                        $longest = checkValue($longer2, $longer3);
                    } else if ($s2 == $s4) {
                        $longer2 = substr(strstr($shapeData['1'], "="), 1);
                        $longer4 = substr(strstr($shapeData['2'], "="), 1);
                        if ($s2 = $s4 = "Width") {
                            $smallest = checkValue($longer2, $longer4);
                        }
                        $longest = checkValue($longer2, $longer4);
                    } else if ($s3 == $s4) {
                        $longer3 = substr(strstr($shapeData['2'], "="), 1);
                        $longer4 = substr(strstr($shapeData['3'], "="), 1);
                        if ($s3 = $s4 = "Width") {
                            $smallest = checkValue($longer3, $longer4);
                        }
                        $longest = checkValue($longer3, $longer4);
                    }
                }
                $cal_cost = 2 * ($smallest + $X1) + 2 * ($thickness + $X2) + ($longest + $X3);
                $mass_density = $mass_density['mvalue'] / (1000 * 1000);
                $shape_weight = $longest * $smallest * $thickness * $mass_density / 1000 . " kg ";
            }
        }

        $ci = & get_instance();
        $query = $ci->db->get('price_calculate');
        $fixedresult = $query->row_array();
        $fixed_value = $fixedresult['circumference'];
        if ((!empty($cal_cost)) <= ($fixed_value)) {
            $result = $this->getprice(!empty($shape_weight));
            if (!empty($result)) {
                return $result['price'] . ",00 €";
            }
        } else if ((!empty($cal_cost)) >= ($fixed_value)) {
            $result = $this->getprice(!empty($shape_weight));
            if (!empty($result)) {
                return $result['price'] . ",00 €";
            }
        }
    }

    function checkValue($value1, $value2) {
        if ($value1 >= $value2) {
            return $value1;
        } else {
            return $value2;
        }
    }

    function checkEquality($value1, $value2, $value3) {
        if (($value1 > $value2) && ($value1 > $value3)) {
            return $value1;
        } else if ($value2 > $value3) {
            return $value2;
        } else {
            return $value3;
        }
    }

    function getprice($shape_weight) {

        $ci = & get_instance();
        $query = $ci->db->get_where('price_calculate', ['minweight <=' => $shape_weight, 'maxweight >=' => $shape_weight]);
        // echo $ci->db->last_query();
        // $ci->db->select('*');
        // $ci->db->from('price_calculate');
        // $where = '(minweight="'.$shape_weight.'" or maxweight ="'.$shape_weight.'")';
        // $ci->db->where($where);
        // $query = $ci->db->get();
        // echo $ci->db->last_query();
        //print_r($query->row_array());
        return $query->row_array();
    }

    function print2largest($arr, $arr_size) {
        if ($arr_size < 2) {
            echo(" Invalid Input ");
            return;
        }

        $first = $second = PHP_INT_MIN;
        for ($i = 0; $i < $arr_size; $i++) {
            if ($arr[$i] > $first) {
                $second = $first;
                $first = $arr[$i];
            } else if ($arr[$i] > $second &&
                    $arr[$i] != $first)
                $second = $arr[$i];
        }
        if ($second != PHP_INT_MIN)
            return $second;
        //     echo("There is no second largest element\n"); 
        // else
        //     echo("The second largest element is " . $second . "\n"); 
    }
}