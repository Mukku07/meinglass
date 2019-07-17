<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin_model
 *
 * @author Mohit Kant Gupta
 */
class Admin_model extends CI_Model {

    public function checkLogin() {
        $data = array(
            'email' => $this->security->xss_clean($this->input->post('email')),
            'password' => $this->security->xss_clean(hash('sha256', $this->input->post('password')))
        );
        $query = $this->db->get_where('admin', $data);
        return $query->row_array();
    }

    public function doChangePassword($email) {
        $data = array(
            'password' => hash('sha256', $this->security->xss_clean($this->input->post('password')))
        );
        $query = $this->db->get_where('admin', $data);
        if ($query->num_rows() > 0) {
            $this->db->update('admin', ['password' => hash('sha256', $this->security->xss_clean($this->input->post('confirmPassword')))], ['email' => $email]);
            return $this->db->affected_rows();
        } else {
            return 0;
        }
        return $query->row_array();
    }

    public function doAddShape($image_url) {
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'percentage' => $this->security->xss_clean($this->input->post('percentage')),
            'image_url' => $image_url
        );
        $this->db->insert('shape', $data);
        $this->db->insert('dimension', ['shape_id' => $this->db->insert_id()]);
        return $this->db->insert_id();
    }

    public function getAllShapes() {
        $query = $this->db->get('shape');
        return $query->result_array();
    }

    public function getShapeById($id) {
        $query = $this->db->get_where('shape', ['shape_id' => $id]);
        return $query->row_array();
    }

    public function doEditShape($id, $image_url) {
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'percentage' => $this->security->xss_clean($this->input->post('percentage')),
            'image_url' => $image_url
        );
        $this->db->update('shape', $data, ['shape_id' => $id]);
        return $this->db->affected_rows();
    }

    public function doDeleteShape($id) {
        $this->db->delete('shape', ['shape_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getAllTerms() {
        $query = $this->db->get('dimensional_terms');
        return $query->result_array();
    }

    public function doAddTerm() {
        $data = array(
            'term' => $this->security->xss_clean($this->input->post('term'))
        );
        $this->db->insert('dimensional_terms', $data);
        return $this->db->insert_id();
    }

    public function getTermById($id) {
        $query = $this->db->get_where('dimensional_terms', ['id' => $id]);
        return $query->row_array();
    }

    public function doEditTerm($id) {
        $data = array(
            'term' => $this->security->xss_clean($this->input->post('term'))
        );
        $this->db->update('dimensional_terms', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTerm($id) {
        $this->db->delete('dimensional_terms', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function doAddDimensionImage($shape_id, $image_url) {
        $this->db->update('dimension', ['image_url' => $image_url], ['shape_id' => $shape_id]);
        return $this->db->affected_rows();
    }

    public function getDimensionByShapeId($shape_id) {
        $query = $this->db->get_where('dimension', ['shape_id' => $shape_id]);
        return $query->row_array();
    }

    public function doUpdateDimension($shape_id) {
        $data = array(
            'description' => $this->security->xss_clean($this->input->post('description')),
            'special_note' => $this->security->xss_clean($this->input->post('special_note')),
            'is_corner' => $this->security->xss_clean($this->input->post('is_corner'))
        );
        $this->db->update('dimension', $data, ['shape_id' => $shape_id]);
        $this->db->select('dimension_id');
        $query = $this->db->get_where('dimension', ['shape_id' => $shape_id]);
        return $query->row_array();
    }

    public function addTermDimensionMapping($dimension_id, $term_id, $prefix) {
        $data = array(
            'dimension_id' => $dimension_id,
            'term_id' => $term_id,
            'prefix' => $prefix
        );
        $this->db->insert('term_dimension_mapping', $data);
        return $this->db->insert_id();
    }

    public function UpdateTermDimensionMapping($dimension_id, $term_id, $prefix, $mapping_id) {
        $data = array(
            'dimension_id' => $dimension_id,
            'term_id' => $term_id,
            'prefix' => $prefix
        );
        $this->db->update('term_dimension_mapping', $data, ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function getTermDimensionMappingByDimensionId($dimension_id) {
        $query = $this->db->get_where('term_dimension_mapping', ['dimension_id' => $dimension_id]);
        return $query->result_array();
    }

    public function removeDimension($mapping_id) {
        $this->db->delete('term_dimension_mapping', ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function addDimensionCorner($dimension_id, $corner_name) {
        $data = array(
            'dimension_id' => $dimension_id,
            'corner_name' => $corner_name
        );
        $this->db->insert('dimension_corner', $data);
        return $this->db->insert_id();
    }

    public function getDimensionCornerByDimensionId($dimension_id) {
        $query = $this->db->get_where('dimension_corner', ['dimension_id' => $dimension_id]);
        return $query->result_array();
    }

    public function updateDimensionCorner($corner_id, $corner_name) {
        $data = array(
            'corner_name' => $corner_name
        );
        $this->db->update('dimension_corner', $data, ['id' => $corner_id]);
        return $this->db->affected_rows();
    }

    public function removeDimensionCorner($corner_id) {
        $this->db->delete('dimension_corner', ['id' => $corner_id]);
        return $this->db->affected_rows();
    }

    public function getAllCorners() {
        $query = $this->db->get('corners');
        return $query->result_array();
    }

    public function getCornerById($id) {
        $query = $this->db->get_where('corners', ['corner_id' => $id]);
        return $query->row_array();
    }

    public function doAddCorner() {
        $data = array(
            'type' => $this->security->xss_clean($this->input->post('type'))
        );
        $this->db->insert('corners', $data);
        return $this->db->insert_id();
    }

    public function doEditCorner($id) {
        $data = array(
            'type' => $this->security->xss_clean($this->input->post('type'))
        );
        $this->db->update('corners', $data, ['corner_id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteCorner($id) {
        $this->db->delete('corners', ['corner_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getAllGlassType() {
        $query = $this->db->get('glass_type');
        return $query->result_array();
    }

    public function getGlassTypeById($id) {
        $query = $this->db->get_where('glass_type', ['glass_type_id' => $id]);
        return $query->row_array();
    }

    public function doAddGlassType($image_url) {
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'image_url' => $image_url,
            'description' => $this->security->xss_clean($this->input->post('description'))
        );
        $this->db->insert('glass_type', $data);
        return $this->db->insert_id();
    }

    public function doEditGlassType($id, $image_url) {
        $data = array(
            'name' => $this->security->xss_clean($this->input->post('name')),
            'image_url' => $image_url,
            'description' => $this->security->xss_clean($this->input->post('description'))
        );
        $this->db->update('glass_type', $data, ['glass_type_id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteGlassType($id) {
        $this->db->delete('glass_type', ['glass_type_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getAllMaterials() {
        $query = $this->db->get('material');
        return $query->result_array();
    }

    public function getMaterialById($id) {
        $query = $this->db->get_where('material', ['id' => $id]);
        return $query->row_array();
    }

    public function doAddMaterial() {
        $data = array(
            'material_name' => $this->security->xss_clean($this->input->post('material_name'))
        );
        $this->db->insert('material', $data);
        return $this->db->insert_id();
    }

    public function doEditMaterial($id) {
        $data = array(
            'material_name' => $this->security->xss_clean($this->input->post('material_name'))
        );
        $this->db->update('material', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteMaterial($id) {
        $this->db->delete('material', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function getMaterialThicknessByMaterialId($material_id) {
        $this->db->select('m.*,t.thickness');
        $this->db->from('material_thickness m');
        $this->db->join('thickness t', 't.thickness_id=m.thickness_id');
        $this->db->where('m.material_id', $material_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddMaterialThickness($material_id) {
        $data = array(
            'material_id' => $material_id,
            'thickness_id' => $this->security->xss_clean($this->input->post('thickness_id')),
            'cost' => $this->security->xss_clean($this->input->post('cost')),
            'mbf' => $this->security->xss_clean($this->input->post('mbf')),
            'additional' => $this->security->xss_clean($this->input->post('additional'))
        );
        $this->db->insert('material_thickness', $data);
        return $this->db->insert_id();
    }

    public function getMaterialThicknessById($thickness_id) {
        $query = $this->db->get_where('material_thickness', ['material_thickness_id' => $thickness_id]);
        return $query->row_array();
    }

    public function doEditMaterialThickness($thickness_id) {
        $data = array(
            'thickness_id' => $this->security->xss_clean($this->input->post('thickness_id')),
            'cost' => $this->security->xss_clean($this->input->post('cost')),
            'mbf' => $this->security->xss_clean($this->input->post('mbf')),
            'additional' => $this->security->xss_clean($this->input->post('additional'))
        );
        $this->db->update('material_thickness', $data, ['material_thickness_id' => $thickness_id]);
        return $this->db->affected_rows();
    }

    public function deleteMaterialThickness($thickness_id) {
        $this->db->delete('material_thickness', ['thickness_id' => $thickness_id]);
        return $this->db->affected_rows();
    }

    public function getAllEdges() {
        $query = $this->db->get('edge');
        return $query->result_array();
    }

    public function doAddEdge() {
        $data = array(
            'type' => $this->security->xss_clean($this->input->post('type'))
        );
        $this->db->insert('edge', $data);
        return $this->db->insert_id();
    }

    public function getEdgeById($id) {
        $query = $this->db->get_where('edge', ['edge_id' => $id]);
        return $query->row_array();
    }

    public function doEditEdge($id) {
        $data = array(
            'type' => $this->security->xss_clean($this->input->post('type'))
        );
        $this->db->update('edge', $data, ['edge_id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteEdge($edge_id) {
        $this->db->delete('edge', ['edge_id' => $edge_id]);
        return $this->db->affected_rows();
    }

    public function getEdgeTypeByEdgeId($edge_id) {
        $query = $this->db->get_where('edge_type', ['edge_id' => $edge_id]);
        return $query->result_array();
    }

    public function doAddEdgeType($edge_id) {
        $data = array(
            'edge_id' => $edge_id,
            'edge_type_value' => $this->security->xss_clean($this->input->post('edge_type_value'))
        );
        $this->db->insert('edge_type', $data);
        return $this->db->insert_id();
    }

    public function deleteEdgeType($edge_type_id) {
        $this->db->delete('edge_type', ['edge_type_id' => $edge_type_id]);
        return $this->db->affected_rows();
    }

    public function getAllSurfaceTreatment() {
        $query = $this->db->get('treatment');
        return $query->result_array();
    }

    public function getTreatmentById($id) {
        $query = $this->db->get_where('treatment', ['treatment_id' => $id]);
        return $query->row_array();
    }

    public function doAddTreatment() {
        $data = array(
            'type' => $this->security->xss_clean($this->input->post('type'))
        );
        $this->db->insert('treatment', $data);
        return $this->db->insert_id();
    }

    public function doEditTreatment($id) {
        $data = array(
            'type' => $this->security->xss_clean($this->input->post('type'))
        );
        $this->db->update('treatment', $data, ['treatment_id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteTreatment($id) {
        $this->db->delete('treatment', ['treatment_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getAllThickness() {
        $query = $this->db->get('thickness');
        return $query->result_array();
    }

    public function getThicknessById($id) {
        $query = $this->db->get_where('thickness', ['thickness_id' => $id]);
        return $query->row_array();
    }

    public function doAddThickness() {
        $data = array(
            'thickness' => $this->security->xss_clean($this->input->post('thickness'))
        );
        $this->db->insert('thickness', $data);
        return $this->db->insert_id();
    }

    public function doEditThickness($id) {
        $data = array(
            'thickness' => $this->security->xss_clean($this->input->post('thickness'))
        );
        $this->db->update('thickness', $data, ['thickness_id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteThickness($id) {
        $this->db->delete('thickness', ['thickness_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getEdgeElement() {
        $query = $this->db->get_where('edge_element');
        return $query->result_array();
    }

    public function doAddEdgeElement() {
        $data = array(
            'edge_element_name' => $this->security->xss_clean($this->input->post('edge_element_name'))
        );
        $this->db->insert('edge_element', $data);
        return $this->db->insert_id();
    }

    public function deleteEdgeElement($edge_element_id) {
        $this->db->delete('edge_element', ['edge_element_id' => $edge_element_id]);
        return $this->db->affected_rows();
    }

    public function getEdgeThicknessMapping($edge_id, $edge_element_id) {
        $this->db->select('etm.mapping_id,e.type,em.edge_element_name,t.thickness,et.edge_type_value,etm.price');
        $this->db->from('edge_thickness_mapping etm');
        $this->db->join('edge e', 'e.edge_id=etm.edge_id');
        $this->db->join('edge_element em', 'em.edge_element_id=etm.edge_element_id');
        $this->db->join('thickness t', 't.thickness_id=etm.thickness_id');
        $this->db->join('edge_type et', 'et.edge_type_id=etm.edge_type_id');
        $this->db->where('etm.edge_id', $edge_id);
        $this->db->where('etm.edge_element_id', $edge_element_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEdgeThicknessMappingById($mapping_id) {
        $query = $this->db->get_where('edge_thickness_mapping', ['mapping_id' => $mapping_id]);
        return $query->row_array();
    }

    public function doAddEdgeThicknessMap() {
        $data = array(
            'edge_id' => $this->security->xss_clean($this->input->post('edge_id')),
            'edge_element_id' => $this->security->xss_clean($this->input->post('edge_element_id')),
            'thickness_id' => $this->security->xss_clean($this->input->post('thickness_id')),
            'edge_type_id' => $this->security->xss_clean($this->input->post('edge_type_id')),
            'price' => $this->security->xss_clean($this->input->post('price')),
        );
        $this->db->insert('edge_thickness_mapping', $data);
        return $this->db->insert_id();
    }

    public function doEditEdgeThicknessMap($mapping_id) {
        $data = array(
            'edge_id' => $this->security->xss_clean($this->input->post('edge_id')),
            'edge_element_id' => $this->security->xss_clean($this->input->post('edge_element_id')),
            'thickness_id' => $this->security->xss_clean($this->input->post('thickness_id')),
            'edge_type_id' => $this->security->xss_clean($this->input->post('edge_type_id')),
            'price' => $this->security->xss_clean($this->input->post('price')),
        );
        $this->db->update('edge_thickness_mapping', $data, ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function deleteEdgeThicknessMapping($mapping_id) {
        $this->db->delete('edge_thickness_mapping', ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function getAllTreatmentThicknessMapping($treatment_id) {
        $this->db->select('ttm.mapping_id,t.type,th.thickness,ttm.mbf,ttm.price');
        $this->db->from('treatment_thickness_mapping ttm');
        $this->db->join('treatment t', 'ttm.treatment_id=t.treatment_id');
        $this->db->join('thickness th', 'th.thickness_id=ttm.thickness_id');
        $this->db->where('ttm.treatment_id', $treatment_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function doAddTreatmentMapping() {
        $data = array(
            'treatment_id' => $this->security->xss_clean($this->input->post('treatment_id')),
            'thickness_id' => $this->security->xss_clean($this->input->post('thickness_id')),
            'mbf' => $this->security->xss_clean($this->input->post('mbf')),
            'price' => $this->security->xss_clean($this->input->post('price')),
        );
        $this->db->insert('treatment_thickness_mapping', $data);
        return $this->db->insert_id();
    }

    public function getTreatmentThicknessMappingById($mapping_id) {
        $query = $this->db->get_where('treatment_thickness_mapping', ['mapping_id' => $mapping_id]);
        return $query->row_array();
    }

    public function doEditTreatmentMapping($mapping_id) {
        $data = array(
            'treatment_id' => $this->security->xss_clean($this->input->post('treatment_id')),
            'thickness_id' => $this->security->xss_clean($this->input->post('thickness_id')),
            'mbf' => $this->security->xss_clean($this->input->post('mbf')),
            'price' => $this->security->xss_clean($this->input->post('price')),
        );
        $this->db->update('treatment_thickness_mapping', $data, ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function deleteTreatmentMapping($mapping_id) {
        $this->db->delete('treatment_thickness_mapping', ['mapping_id' => $mapping_id]);
        return $this->db->affected_rows();
    }

    public function doAddFormula($shape_id) {
        $data = array(
            'formula' => $this->input->post('formula')
        );
        $this->db->update('shape', $data, ['shape_id' => $shape_id]);
        return $this->db->affected_rows();
    }

    /* @start  {Discription of Code ->@Author Mukesh Yadav} */

    public function getAllShippingCost() {
        $query = $this->db->get('shipping_cost');
        return $query->row_array();
    }

    public function doAddShippingCost() {
        $data = array(
            'value1' => $this->security->xss_clean($this->input->post('value1')),
            'value2' => $this->security->xss_clean($this->input->post('value2')),
            'value3' => $this->security->xss_clean($this->input->post('value3'))
        );
        $this->db->insert('shipping_cost', $data);
        return $this->db->insert_id();
    }

    public function getShippingCostById($id) {
        $query = $this->db->get_where('shipping_cost', ['shippingcost_id' => $id]);
        return $query->row_array();
    }

    public function doEditShippingCost($id) {
        $data = array(
            'value1' => $this->security->xss_clean($this->input->post('value1')),
            'value2' => $this->security->xss_clean($this->input->post('value2')),
            'value3' => $this->security->xss_clean($this->input->post('value3'))
        );
        $this->db->update('shipping_cost', $data, ['shippingcost_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getAllMassDensity() {
        $query = $this->db->get('mass_density');
        return $query->row_array();
    }

    public function doAddMassDensity() {
        $data = array(
            'mvalue' => $this->security->xss_clean($this->input->post('mvalue')),
            'cmvalue' => $this->security->xss_clean($this->input->post('cmvalue')),
            'mmvalue' => $this->security->xss_clean($this->input->post('mmvalue')),
            'weight' => $this->security->xss_clean($this->input->post('weight'))
        );
        $this->db->insert('mass_density', $data);
        return $this->db->insert_id();
    }

    public function getMassDensityById($id) {
        $query = $this->db->get_where('mass_density', ['mass_density_id' => $id]);
        return $query->row_array();
    }

    public function doEditMassDensity($id) {
        $data = array(
            'mvalue' => $this->security->xss_clean($this->input->post('mvalue')),
            'cmvalue' => $this->security->xss_clean($this->input->post('cmvalue')),
            'mmvalue' => $this->security->xss_clean($this->input->post('mmvalue')),
            'weight' => $this->security->xss_clean($this->input->post('weight'))
        );
        $this->db->update('mass_density', $data, ['mass_density_id' => $id]);
        return $this->db->affected_rows();
    }

    public function getPriceCalculate() {
        $query = $this->db->get('price_calculate');
        return $query->result_array();
    }

    public function doAddFixedData() {
        $data = array(
            'circumference' => $this->security->xss_clean($this->input->post('circumference')),
            'minweight' => $this->security->xss_clean($this->input->post('minweight')),
            'maxweight' => $this->security->xss_clean($this->input->post('maxweight')),
            'price' => $this->security->xss_clean($this->input->post('price'))
        );
        $this->db->insert('price_calculate', $data);
        return $this->db->insert_id();
    }

    public function getPriceDataById($id) {
        $query = $this->db->get_where('price_calculate', ['id' => $id]);
        return $query->row_array();
    }

    public function doEditFixedData($id) {
        $data = array(
            'circumference' => $this->security->xss_clean($this->input->post('circumference')),
            'minweight' => $this->security->xss_clean($this->input->post('minweight')),
            'maxweight' => $this->security->xss_clean($this->input->post('maxweight')),
            'price' => $this->security->xss_clean($this->input->post('price'))
        );
        $this->db->update('price_calculate', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function getAllcarousel() {
        $query = $this->db->get('carousel');
        return $query->result_array();
    }

    public function getCrouselById($id) {
        $query = $this->db->get_where('carousel', ['carousel_id' => $id]);
        return $query->row_array();
    }

    public function doAddCarouselData($carousel_image) {
        $data = array(
            'carousel_name' => $this->security->xss_clean($this->input->post('carousel_name')),
            'carousel_title' => $this->security->xss_clean($this->input->post('carousel_title')),
            'carousel_content' => $this->security->xss_clean($this->input->post('carousel_content')),
            'carousel_image' => $carousel_image
        );
        $this->db->insert('carousel', $data);
        return $this->db->insert_id();
    }

    public function doEditCarouselData($carousel_id, $carousel_image) {
        $data = array(
            'carousel_name' => $this->security->xss_clean($this->input->post('carousel_name')),
            'carousel_title' => $this->security->xss_clean($this->input->post('carousel_title')),
            'carousel_content' => $this->security->xss_clean($this->input->post('carousel_content')),
            'carousel_image' => $carousel_image
        );
        $this->db->update('carousel', $data, ['carousel_id' => $carousel_id]);
        return $this->db->affected_rows();
    }

    public function doDeleteCarouselData($carousel_id) {
        $this->db->delete('carousel', ['carousel_id' => $carousel_id]);
        return $this->db->affected_rows();
    }

    public function getAllNews() {
        $query = $this->db->get('news');
        return $query->result_array();
    }

    public function getnewsById($news_id) {
        $query = $this->db->get_where('news', ['news_id' => $news_id]);
        return $query->row_array();
    }

    public function doAddNews($image_url) {
        $data = array(
            'image_url' => $image_url,
            'news_title' => $this->security->xss_clean($this->input->post('news_title')),
            'news_content' => $this->security->xss_clean($this->input->post('news_content'))
        );
        $this->db->insert('news', $data);
        return $this->db->insert_id();
    }

    public function doEditNews($news_id, $image_url) {
        $data = array(
            'image_url' => $image_url,
            'news_title' => $this->security->xss_clean($this->input->post('news_title')),
            'news_content' => $this->security->xss_clean($this->input->post('news_content'))
        );

        $this->db->update('news', $data, ['news_id' => $news_id]);
        return $this->db->affected_rows();
    }

    public function doDeleteNewsData($news_id) {
        $this->db->delete('news', ['news_id' => $news_id]);
        return $this->db->affected_rows();
    }

    public function getAllGallerie() {
        $query = $this->db->get('gallerie');
        return $query->result_array();
    }

    public function getGallerieById($gallerie_id) {
        $query = $this->db->get_where('gallerie', ['gallerie_id' => $gallerie_id]);
        return $query->row_array();
    }

    public function doAddgallerie($min_size_url, $max_size_url) {
        $data = array(
            'min_size_url' => $min_size_url,
            'max_size_url' => $max_size_url
        );
        $this->db->insert('gallerie', $data);
        return $this->db->insert_id();
    }

    public function doEditGallerie($gallerie_id, $min_size_url, $max_size_url) {
        $data = array(
            'min_size_url' => $min_size_url,
            'max_size_url' => $max_size_url
        );
        $this->db->update('gallerie', $data, ['gallerie_id' => $gallerie_id]);
        return $this->db->affected_rows();
    }

    public function doDeleteGallerie($gallerie_id) {
        $this->db->delete('gallerie', ['gallerie_id' => $gallerie_id]);
        return $this->db->affected_rows();
    }

    public function getAllReview() {
        $query = $this->db->get('customer_review');
        return $query->result_array();
    }

    public function getReviewById($review_id) {
        $query = $this->db->get_where('customer_review', ['review_id' => $review_id]);
        return $query->row_array();
    }

    public function doAddreview() {
        $data = array(
            'author' => $this->security->xss_clean($this->input->post('author')),
            'author_address' => $this->security->xss_clean($this->input->post('author_address')),
            'author_review' => $this->security->xss_clean($this->input->post('author_review')),
        );
        $this->db->insert('customer_review', $data);
        return $this->db->insert_id();
    }

    public function doEditReview($review_id) {
        $data = array(
            'author' => $this->security->xss_clean($this->input->post('author')),
            'author_address' => $this->security->xss_clean($this->input->post('author_address')),
            'author_review' => $this->security->xss_clean($this->input->post('author_review')),
        );
        $this->db->update('customer_review', $data, ['review_id' => $review_id]);
        return $this->db->affected_rows();
    }

    public function doDeleteReview($review_id) {
        $this->db->delete('customer_review', ['review_id' => $review_id]);
        return $this->db->affected_rows();
    }

    public function getAllcontact() {
        $query = $this->db->get('contact');
        return $query->result_array();
    }

    public function getAllProducts() {
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getProductsData($products_id) {
        $query = $this->db->get_where('products', ['product_id' => $products_id]);
        return $query->row_array();
    }

    public function insertProductId() {
        $data = array(
            'status' => 'Inactive',
            'created' => date("d-M-Y H:i:s")
        );
        $this->db->insert('products',$data);
        return $this->db->insert_id();
    }

    public function getActiveAllShape() {
        $query = $this->db->get_where('shape', ['is_active' => 'Active']);
        return $query->result_array();
    }

    public function updateUserShape($products_id, $shape_id) {
        $data = array(
            'shape_id' => $shape_id
        );

        $this->db->update('products', $data, ['product_id' => $products_id]);
        return $this->db->affected_rows();
    }

    public function getShapeByShape_id($shape_id) {
        $query = $this->db->get_where('shape', ['shape_id' => $shape_id]);
        return $query->row_array();
    }

    public function getTermDimentionMapping($dimension_id) {
        $query = $this->db->get_where('term_dimension_mapping', ['dimension_id' => $dimension_id]);
        return $query->result_array();
    }

    public function updateUserDimension($data, $product_id) {
        $this->db->update('products', $data, ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }

    public function updateUserGlassType($glass_type_id, $product_id) {
        $this->db->update('products', ['glass_type_id' => $glass_type_id], ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }

    public function getThicknessByMaterialId($id) {
        $this->db->select('t.thickness_id,t.thickness');
        $this->db->from('material_thickness mt');
        $this->db->join('thickness t', 't.thickness_id=mt.thickness_id');
        $this->db->where('mt.material_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateUserGlassThickness($product_id) {
        $data = array(
            'material_id' => $this->input->post('material_id'),
            'thickness_id' => $this->input->post('thickness_id')
        );
        $this->db->update('products', $data, ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }

    public function updateUserEdge($product_id) {
        $data = array(
            'edge_id' => $this->input->post('edge_id'),
            'edge_element_id' => $this->input->post('edge_element_id'),
            'edge_type_id' => $this->input->post('edge_type_id')
        );

        $this->db->update('products', $data, ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }

    public function updateSurfaceTreatment($product_id) {
//        $sel = $this->db->get_where('products',['shape_id' => 0,'status' => 'Inactive']);
//        $row = $sel->row_array();
//        if(!empty($row['product_id'])){
//            $this->db->delete('products', ['product_id' => $row['product_id']]);
//        return $this->db->affected_rows();
//        }
        $data = array(
            'treatment_id' => $this->input->post('treatment_id')
        );
        $this->db->update('products', $data, ['product_id' => $product_id]);
        return $this->db->affected_rows();
    }
    
    public function getSelectedDimension($dimension_id){
        $this->db->select('d.dimension_id,d.is_corner,d.image_url,d.special_note');
        $this->db->from('dimension d');
        $this->db->where('d.dimension_id', $dimension_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getSelectedDimensionMapping($dimension_id){
        $this->db->select('tdm.mapping_id,tdm.term_id,tdm.prefix,dt.term');
        $this->db->from('term_dimension_mapping tdm');
        $this->db->join('dimensional_terms dt', 'dt.id=tdm.term_id');
        $this->db->where('tdm.dimension_id', $dimension_id);
        $query = $this->db->get();
        return $query->result_array();
    }
   
    public function getSelectedGlassType($glass_type_id)
    {
        $this->db->select('glass_type_id,name,image_url');
        $query = $this->db->get_where('glass_type',['glass_type_id'=>$glass_type_id]);
        return $query->row_array();
    }
    
    public function getSelectedMaterial($material_id)
    {
        $this->db->select('id,material_name');
        $query = $this->db->get_where('material',['id'=>$material_id]);
        return $query->row_array();
    }

    public function getSelectedThickness($thickness_id)
    {
        $this->db->select('thickness_id,thickness');
        $query = $this->db->get_where('thickness',['thickness_id'=>$thickness_id]);
        return $query->row_array();
    }
    
    public function getSelectedMaterialThickness($material_id, $thickness_id)
    {
        $this->db->select('*');
        $query = $this->db->get_where('material_thickness',['material_id'=>$material_id,'thickness_id'=>$thickness_id]);
        return $query->row_array();
    }
    public function getSelectedEdgeData($edge_id)
    {
        $this->db->select('edge_id,type');
        $query = $this->db->get_where('edge',['edge_id'=>$edge_id]);
        return $query->row_array();
    }

    public function getSelectedEdgeElementData($edge_element_id)
    {
        $this->db->select('edge_element_id,edge_element_name');
        $query = $this->db->get_where('edge_element',['edge_element_id'=>$edge_element_id]);
        return $query->row_array();
    }

    public function getSelectedEdgeType($edge_id, $edge_type_id)
    {
        $this->db->select('edge_id,edge_type_id,edge_type_value');
        $query = $this->db->get_where('edge_type',['edge_id'=>$edge_id, 'edge_type_id'=>$edge_type_id]);
        return $query->row_array();
    }

    public function getSelectEdgeProcessing($edge_id,$edge_element_id,$thickness_id,$edge_type_id)
    {
        $this->db->select('mapping_id,price');
        $query = $this->db->get_where('edge_thickness_mapping',['edge_id'=>$edge_id,'edge_element_id'=>$edge_element_id,'thickness_id'=>$thickness_id,'edge_type_id'=>$edge_type_id]);
        return $query->row_array();
    }
    
    public function getSelectedTreatmentData($treatment_id)
    {
        $this->db->select('treatment_id,type');
        $query = $this->db->get_where('treatment',['treatment_id'=>$treatment_id]);
        return $query->row_array();
    }

    public function getSelectedSurfaceTreatmentMap($treatment_id,$thickness_id)
    {
        $this->db->select('mapping_id,mbf,price');
        $query = $this->db->get_where('treatment_thickness_mapping',['treatment_id'=>$treatment_id,'thickness_id'=>$thickness_id]);
        return $query->row_array();
    }

    public function deleteproduct($product_id){
        $this->db->delete('products', ['product_id'=>$product_id]);
        return $this->db->affected_rows();
    }
    
    public function editstatus($product_id, $status){
        $data = array('status'=>$status);
        $this->db->update('products',$data, ['product_id'=>$product_id]);
        return $this->db->affected_rows();
    }

    public function submitPriceofProduct($product_id, $price){
        $data = array('price'=>$price);
        $this->db->update('products',$data, ['product_id'=>$product_id]);
        return $this->db->affected_rows();
    }

    /* @end  {Discription of Code ->@Author Mukesh Yadav} */
}
