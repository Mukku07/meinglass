<?php

/**
 * Description of 'Konfigurator
 *
 * @author Mohit Kant Gupta
 */
class Konfigurator extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model(['glass_model']);
        
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

    private function random_code($limit) {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    public function index() {
        if ($this->session->userdata('session_id') !== NULL) {
            
            $user = $this->glass_model->getSessionData($this->session->userdata('session_id'));
            // if (!empty($user['treatment_id'])) {
            //     redirect(site_url('konfigurator/surface_treatment'));
            // }
            // if (!empty($user['edge_id'])) {
            //     redirect(site_url('konfigurator/edge'));
            // }
            // if (!empty($user['thickness_id'])) {
            //     redirect(site_url('konfigurator/thickness'));
            // }
            // if (!empty($user['glass_type_id'])) {
            //     redirect(site_url('konfigurator/glass_type'));
            // }
            // if (!empty($user['dimension_id'])) {
            //     redirect(site_url('konfigurator/dimension'));
            // }
            // if (!empty($user['shape_id'])) {
            //     redirect(site_url('konfigurator/shape'));
            // }

            if(!empty($user['treatment_id'])){
                redirect(base_url('konfigurator/surface_treatment'));
            }
            else if(!empty($user['edge_id'])){
                redirect(base_url('konfigurator/edge'));
            }
            else if(!empty($user['thickness_id'])){
                redirect(base_url('konfigurator/thickness'));
            }
            else if(!empty($user['glass_type_id'])){
                redirect(base_url('konfigurator/glass_type'));
            }
            else if(!empty($user['dimension_id'])){
                redirect(base_url('konfigurator/dimension'));
            }
            else if(!empty($user['shape_id'])){
                redirect(base_url('konfigurator/shape'));
            }else{
                redirect(base_url('konfigurator/shape'));
            }
        } else {
            $session_id = $this->random_code(10);
            $this->session->set_userdata('session_id', $session_id);
            $this->glass_model->insertSessionData($session_id);
           // $this->glass_model->createAddress($session_id);
            // return base_url('konfigurator/shape');
            redirect(base_url('konfigurator/shape'));
        }
    }

    public function shape() {
        if (!empty($this->session->userdata('session_id'))) {
            $data['user'] = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        } else {
            redirect(base_url('konfigurator'));
            die;
        }
        $data['title'] = 'Shape';
        $data['shapes'] = $this->glass_model->getActiveAllShape();
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/shape', $data);
        $this->load->view('glass/commons/footer');
    }

    public function shapeCal() {
        $this->output->set_content_type('application/json');
        $shape_id = $this->input->post('shape_id');
        $this->glass_model->updateUserShape($shape_id);
        $session_id = $this->session->userdata('session_id');
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/dimension')]));
        return FALSE;
    }

    public function dimension() {
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator/shape'));
            die;
        }
        $session_id = $this->session->userdata('session_id');
        $data['user'] = $user = $this->glass_model->getSessionData($session_id);
        $data['title'] = 'Dimension';
        $data['terms'] = $this->filteredTerm();
        $data['shape'] = $this->glass_model->getShapeByShape_id($user['shape_id']);
        $data['dimension'] = $dimension = $this->glass_model->getDimensionByShapeId($user['shape_id']);
        $data['mappings'] = $this->glass_model->getTermDimentionMapping($dimension['dimension_id']);
        $data['dimension_corners'] = $this->glass_model->getDimensionCornerByDimensionId($dimension['dimension_id']);
        $data['corners'] = $this->filteredCorner();
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/dimension', $data);
        $this->load->view('glass/commons/footer');
    }

    public function dimensionCal() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('term_size[]', 'Dimention Size', 'required|trim');
        $session_id = $this->session->userdata('session_id');
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
        $this->glass_model->updateUserDimension($data, $session_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/glass-type')]));
        return FALSE;
    }

    public function glass_type() {
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
        $data['user'] = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $data['glasses'] = $this->glass_model->getAllGlassType();
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/glass-type', $data);
        $this->load->view('glass/commons/footer');
    }

    public function glassTypeCal() {
        $this->output->set_content_type('application/json');
        $session_id = $this->session->userdata('session_id');
        $glass_type_id = $this->input->post('glass_type_id');
        $this->glass_model->updateUserGlassType($glass_type_id, $session_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/thickness')]));
        return FALSE;
    }

    public function thickness() {
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
        $data['user'] = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $data['material'] = $this->filteredMaterial();
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/material', $data);
        $this->load->view('glass/commons/footer');
    }

    public function getThickness() {
        $this->output->set_content_type('application/json');
        $id = $this->input->post('id');
        $data['thickness'] = $this->glass_model->getThicknessByMaterialId($id);
        $data['user'] = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $thickness_list = $this->load->view('glass/include/thickness-list', $data, true);
        $this->output->set_output(json_encode(['thickness_list' => $thickness_list]));
        return FALSE;
    }

    public function thicknessCal() {
        $this->output->set_content_type('application/json');
        $session_id = $this->session->userdata('session_id');
        $this->glass_model->updateUserGlassThickness($session_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/edge')]));
        return FALSE;
    }

    public function edge() {
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
        $data['user'] = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $data['edge'] = $this->filteredEdge();
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/edge', $data);
        $this->load->view('glass/commons/footer');
    }

    public function getEdgeType() {
        $this->output->set_content_type('application/json');
        $edge_id = $this->input->post('edge_id');
        $data['edge_type'] = $this->filteredEdgeType($edge_id);
        $data['edge_element'] = $this->filteredEdgeElement();
        $data['user'] = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $edge_list = $this->load->view('glass/include/edge-type-list', $data, true);
        $this->output->set_output(json_encode(['edge_list' => $edge_list]));
        return FALSE;
    }

    public function edgeCal() {
        $this->output->set_content_type('application/json');
        $session_id = $this->session->userdata('session_id');
        $this->glass_model->updateUserEdge($session_id);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/surface-treatment')]));
        return FALSE;
    }

    public function surface_treatment() {
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
        $data['user'] = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $data['treatment'] = $this->filteredSurfaceTreatment();
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/treatment', $data);
        $this->load->view('glass/commons/footer');
    }

    public function treatmentCal() {
        $this->output->set_content_type('application/json');
        $session_id = $this->session->userdata('session_id');
        $this->glass_model->updateSurfaceTreatment($session_id);
        $uniqid = $this->glass_model->getSessionData($session_id);
        $shape_data = $this->glass_model->getSelectedShapeData($uniqid['shape_id']);
        $this->insertCart($shape_data);
        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/summary')]));
        return FALSE;
    }

    /* @start  {Discription of Code ->@Author Mukesh Yadav} */    

    public function summary() {
        
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
        
        $productDetails = array();
        $productCalculation = array();
        $productPrice = array();
        $productqtys = array();
        $cartdata = $this->cart->contents(); 
        $i = 1;
        foreach($cartdata as $carts){
            $uniqid = $this->glass_model->getUserData($carts['user_id']);
   
            $shape_data = $this->glass_model->getSelectedShapeData($uniqid['shape_id']);      
            $dimension_data = $this->glass_model->getSelectedDimension($uniqid['dimension_id']);
            $dimension_mapping = $this->glass_model->getSelectedDimensionMapping($uniqid['dimension_id']);
            $glass_type = $this->glass_model->getSelectedGlassType($uniqid['glass_type_id']);
            $material = $this->glass_model->getSelectedMaterial($uniqid['material_id']);
            $thickness = $this->glass_model->getSelectedThickness($uniqid['thickness_id']);
            $material_thickness = $this->glass_model->getSelectedMaterialThickness($uniqid['material_id'], $uniqid['thickness_id']);
            $edge = $this->glass_model->getSelectedEdgeData($uniqid['edge_id']);
            $edge_element = $this->glass_model->getSelectedEdgeElementData($uniqid['edge_element_id']);
            $edge_type = $this->glass_model->getSelectedEdgeType($uniqid['edge_id'], $uniqid['edge_type_id']);
            $edge_processing = $this->glass_model->getSelectEdgeProcessing($uniqid['edge_id'], $uniqid['edge_element_id'], $uniqid['thickness_id'], $uniqid['edge_type_id']);
            $surface_treatment = $this->glass_model->getSelectedTreatmentData($uniqid['treatment_id']);
            $surface_treatment_mapping = $this->glass_model->getSelectedSurfaceTreatmentMap($uniqid['treatment_id'], $uniqid['thickness_id']);
            
            $data['address'] = $address = $this->glass_model->getSelectedAddress($this->session->userdata('client_id'));
            $data['shipping_cost'] = $shipping_cost = $this->glass_model->getAllShippingCost();
            $data['mass_density'] = $mass_density = $this->glass_model->getAllMassDensity();
            // $data['priceFixed'] = $this->glass_model->getPriceFixedData(); 


            $materialThickCost = $this->calculateMaterialThicknessCost($thickness, $material_thickness);
            $shapeDimension = $this->calculateDimensionOfShape($uniqid, $dimension_mapping, $shape_data);
            $edgeProcessing = $this->calculateEdgeProcessing($shapeDimension, $material_thickness, $materialThickCost, $edge_processing);
            $surfaceTreatment = $this->calculateSurfaceTreatment($edgeProcessing, $surface_treatment_mapping);
            $shapeCircumferencewithPrice = $this->calculateShapeCircumference($dimension_mapping, $thickness, $shipping_cost, $uniqid, $mass_density);
            $userid = $carts['user_id'];
            $cartid  = $this->glass_model->getCartid($userid); 
            $rowid = $cartid['cart_id'];
            $data['row_id'] = $row_id = $carts['rowid'];
            $updated = $this->cartUpdate($shapeCircumferencewithPrice,$shape_data,$rowid,$row_id);
            $productqty = $this->glass_model->getCartBySessionId($rowid);
            array_push($productDetails, ['user'=>$uniqid, 'shape_data'=>$shape_data, 'dimension_data'=>$dimension_data,'dimension_mapping'=>$dimension_mapping,'glass_type'=>$glass_type,'material'=>$material,'thickness'=>$thickness,'material_thickness'=>$material_thickness,'edge'=>$edge,'edge_element'=>$edge_element,'edge_type'=>$edge_type,'edge_processing'=>$edge_processing,'surface_treatment'=>$surface_treatment,'surface_treatment_mapping'=>$surface_treatment_mapping]);
            array_push($productCalculation, ['materialThickCost'=>$materialThickCost, 'shapeDimension'=>$shapeDimension, 'edgeProcessing'=>$edgeProcessing,'surfaceTreatment'=>$surfaceTreatment]);
            array_push($productPrice, ['shapeCircumferencewithPrice'=>$shapeCircumferencewithPrice]);
            array_push($productqtys, ['productqty'=>$productqty]);
            $i++;  
        }
        $data['allUserdata']=$productDetails;
        $data['productCalculation']=$productCalculation;
        $data['productPrice']=$productPrice;
        $data['productqty'] = $productqtys;  
//        print_r($this->cart->contents()); 
        
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/summary');
        $this->load->view('glass/commons/footer');
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

    public function insertCart($shape_data) {
        
        $this->load->library('cart');
        $list = $this->cart->contents();
        $uniqid = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $session_id = $this->session->userdata('session_id');
        $carts = $this->glass_model->getcart();
        
        if (empty($carts['id'])) {
        $data = array(
            'id' => $session_id,
            'qty' => 1,
            'name' => $shape_data['name'],
            'price' => 'NULL',
            'image' => $shape_data['image_url'],
            'user_id' => $uniqid['user_id'],
        );
        
        $this->cart->insert($data);
            $result = $this->glass_model->insertCart($data);
            if(!empty($result)){
                return TRUE;
            }
        }
    }
    function cartUpdate($shapeCircumferencewithPrice,$shape_data,$rowid,$row_id){
        
        $this->load->library('cart');
        $cart = array(
            'rowid' => $row_id,
            'price' => $shapeCircumferencewithPrice,
        );
        $this->cart->update($cart);

        $data = array(
            'price' => $shapeCircumferencewithPrice,
        );
        return $this->glass_model->cartUpdate($rowid, $data);
    }
    
    function updateCartData($row_id, $user_id) {
//        echo "Hey Row id".$row_id; echo "User_id".$user_id;
        $this->output->set_content_type('application/json');
        $this->load->library('cart');
        //$cartdetail = $this->glass_model->getDetailsByCartId($user_id);
        $qty = $this->input->post('qty');
        //print_r($cartdetail);
        //$price = $cart['price']*$qty;
        
        $cart = array(
            'rowid' => $row_id,
            'qty' => $qty,
        );
        $this->cart->update($cart);
        
        $data = array(
            'user_id' => $user_id,
            'qty' => $qty,

        );
        $result = $this->glass_model->updateCartData($data, $user_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Cart Successfull Updated.!!!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => 0, 'msg' => 'Cart Not Successfull Updated.!!!']));
            return FALSE;
        }
    }

    public function deleteCartItem($session_id=NULL) {
        $this->load->library('cart');
        $this->output->set_content_type('application/json');
        $this->cart->destroy();
        $result = $this->glass_model->deleteCartItem($this->session->userdata('session_id'));
        $this->output->clear_all_cache();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'url'=>base_url('konfigurator/shape'), 'msg' => 'Cart Successfull Deleted.!!!']));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => 0, 'msg' => 'Cart Not Successfull Deleted.!!!']));
            return FALSE;
        }
    }

    public function addMoreItems() {
        if (!empty($this->session->userdata('session_id'))) {
            $unset = $this->session->unset_userdata('session_id');
            if (empty($unset)) {
                redirect(base_url('konfigurator/shape'));
            }
        }
    }

    public function doAddAddress() {
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('country', 'Country Name', 'trim|required');
        $this->form_validation->set_rules('zip_code', 'Zip Code', 'trim|required');
        $this->form_validation->set_rules('address_type', 'Address Type', 'trim|required');
        if ($this->form_validation->run() === FAlSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $billingAddressData = array(
            'country' => $this->input->post('country'),
            'zip' => $this->input->post('zip_code'),
            'client_id' => $this->session->userdata('client_id')
        );

        $shippingAddressData = array(
            'country' => $this->input->post('country'),
            'zip' => $this->input->post('zip_code'),
            'address_type' => $this->input->post('address_type'),
            'client_id' => $this->session->userdata('client_id')
        );
//        print_r($billingAddressData);print_r($shippingAddressData);exit;
        $billingAddressAdded = $this->glass_model->doAddBillingAddress($this->session->userdata('client_id'), $billingAddressData);
        $shippingAddressAdded = $this->glass_model->doAddShippingAddress($this->session->userdata('client_id'), $shippingAddressData);

        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/order')]));
        return FALSE;
    }

    public function order() {
        $this->load->library('cart');
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
        $productqtys = array();
        $cartdata = $this->cart->contents(); 
        $i = 1;
        foreach($cartdata as $carts){
            $userid = $carts['user_id'];
            $cartid  = $this->glass_model->getCartid($userid); 
            $rowid = $cartid['cart_id'];
            $productqty = $this->glass_model->getCartBySessionId($rowid);
            $i++;
            array_push($productqtys, ['productqty'=>$productqty]);
        }
        $data['productqty'] = $productqtys;  
        $data['user'] = $uniqid = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $data['billingAddress'] = $billingAddress = $this->glass_model->getBillingAddress($this->session->userdata('client_id'));
        $data['shippingAddress'] = $shippingAddress = $this->glass_model->getShippingAddress($this->session->userdata('client_id'));
        
        $this->load->view('glass/commons/header', $data);
        $this->load->view('glass/order', $data);
        $this->load->view('glass/commons/footer');
    }

    public function doEditAddress() {
        $this->output->set_content_type('application/json');

        $this->form_validation->set_rules('billing_comp_name', 'Company Name', 'trim');
        $this->form_validation->set_rules('billing_first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('billing_last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('billing_email', 'Email Id', 'trim|required|valid_email');
        $this->form_validation->set_rules('billing_conf_email', 'Confirm Email Id', 'trim|valid_email|matches[billing_email]');
        $this->form_validation->set_rules('billing_country', 'Country Name', 'trim|required');
        $this->form_validation->set_rules('billing_address1', 'Address', 'trim|required');
        $this->form_validation->set_rules('billing_address2', 'Address', 'trim');
        $this->form_validation->set_rules('billing_zip_code', 'Zip Code', 'trim|required');
        $this->form_validation->set_rules('billing_city', 'City Name', 'trim|required');
        $this->form_validation->set_rules('billing_state', 'State Name', 'trim|required');
        $this->form_validation->set_rules('billing_phone', 'Phone Number', 'trim|required');

        $this->form_validation->set_rules('shipping_comp_name', 'Company Name', 'trim');
        $this->form_validation->set_rules('shipping_first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('shipping_last_name', 'Last Name', 'trim');
        $this->form_validation->set_rules('shipping_country', 'Country Name', 'trim|required');
        $this->form_validation->set_rules('shipping_address1', 'Address', 'trim|required');
        $this->form_validation->set_rules('shipping_address2', 'Address', 'trim');
        $this->form_validation->set_rules('shipping_zip_code', 'Zip Code', 'trim|required');
        $this->form_validation->set_rules('shipping_city_name', 'City Name', 'trim|required');
        $this->form_validation->set_rules('shipping_state', 'State Name', 'trim|required');
        $this->form_validation->set_rules('address_type', 'Address Type', 'trim|required');
        $this->form_validation->set_rules('shipping_phone', 'Phone Number', 'trim|required');

        if ($this->form_validation->run() === FAlSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }

        $billingAddressData = array(
            'comp_name' => $this->input->post('billing_comp_name'),
            'first_name' => $this->input->post('billing_first_name'),
            'last_name' => $this->input->post('billing_last_name'),
            'email' => $this->input->post('billing_email'),
            'country' => $this->input->post('billing_country'),
            'address1' => $this->input->post('billing_address1'),
            'address2' => $this->input->post('billing_address2'),
            'zip' => $this->input->post('billing_zip_code'),
            'city' => $this->input->post('billing_city'),
            'state' => $this->input->post('billing_state'),
            'phone' => $this->input->post('billing_phone')
        );

        $shippingAddressData = array(
            'comp_name' => $this->input->post('shipping_comp_name'),
            'first_name' => $this->input->post('shipping_first_name'),
            'last_name' => $this->input->post('shipping_last_name'),
            'country' => $this->input->post('shipping_country'),
            'address1' => $this->input->post('shipping_address1'),
            'address2' => $this->input->post('shipping_address2'),
            'zip' => $this->input->post('shipping_zip_code'),
            'city' => $this->input->post('shipping_city_name'),
            'state' => $this->input->post('shipping_state'),
            'address_type' => $this->input->post('address_type'),
            'phone' => $this->input->post('shipping_phone')
        );
        $data['user'] = $uniqid = $this->glass_model->getSessionData($this->session->userdata('session_id'));
        $data['billingAddress'] = $billingAddress = $this->glass_model->updateBillingAddress($this->session->userdata('client_id'), $billingAddressData);
        $data['shippingAddress'] = $shippingAddress = $this->glass_model->updateShippingAddress($this->session->userdata('client_id'), $shippingAddressData);

        $this->output->set_output(json_encode(['result' => 1, 'url' => base_url('konfigurator/payment')]));
        return FALSE;
    }
    
    public function payment(){
        $this->load->library('cart');
        $this->load->library('paypal_lib');
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
//        $this->output->set_content_type('application/json');
//        
        // Set variables for paypal form
        $returnURL = base_url().'konfigurator/success';
        $cancelURL = base_url().'konfigurator/cancel';
        $notifyURL = base_url().'konfigurator/ipn';
        
        // Get product data from the database
//        print_r($this->cart->contents());exit;
        $product_price = $this->cart->total();
        $product_name = "Square/Rectangle";
        
        $product_qty = $this->cart->total_items();
        // Get current user ID from the session
        $userID = $this->session->userdata('email');
        
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $product_name);
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  $product_qty);
        $this->paypal_lib->add_field('amount',  $product_price);
        $this->paypal_lib->paypal_auto_form();
        

//        $this->load->view('glass/commons/header');
//        $this->load->view('glass/payment');
//        $this->load->view('glass/commons/footer');
    }
    
    public function success(){
        if (empty($this->session->userdata('session_id'))) {
            redirect(base_url('konfigurator'));
            die;
        }
        // Get the transaction data
//        $paypalInfo = $this->input->get();
        
//        $data['item_name']      = $paypalInfo['item_name'];
//        $data['item_number']    = $paypalInfo['item_number'];
//        $data['txn_id']         = $paypalInfo["tx"];
//        $data['payment_amt']    = $paypalInfo["amt"];
//        $data['currency_code']  = $paypalInfo["cc"];
//        $data['status']         = $paypalInfo["st"];
        
//        $this->output->set_content_type('application/json');
        $this->load->view('glass/commons/header');
        $this->load->view('glass/order_success');
        $this->load->view('glass/commons/footer');
    }
        
    public function cancel(){
        // Load payment failed view
        $this->load->view('glass/cancel');
     }
     
    public function ipn(){
        // Paypal posts the transaction data
        $paypalInfo = $this->input->post();
        
        if(!empty($paypalInfo)){
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if($ipnCheck){
                // Insert the transaction data in the database
                $data['user_id']        = $paypalInfo["custom"];
                $data['product_id']        = $paypalInfo["item_number"];
                $data['txn_id']            = $paypalInfo["txn_id"];
                $data['payment_gross']    = $paypalInfo["mc_gross"];
                $data['currency_code']    = $paypalInfo["mc_currency"];
                $data['payer_email']    = $paypalInfo["payer_email"];
                $data['payment_status'] = $paypalInfo["payment_status"];

                $this->product->insertTransaction($data);
            }
        }
    }
    /* @end  {Discription of Code ->@Author Mukesh Yadav} */
}
