<?php
/**
 * Description of Glass_model
 *
 * @author Mohit Kant Gupta
 */
class Glass_model extends CI_Model{
    public function __construct() {
        parent::__construct();
    }

    
    public function getActiveAllShape(){
        $query=$this->db->get_where('shape',['is_active'=>'Active']);
        return $query->result_array();
    }
    
    public function getDimensionByShapeId($shape_id){
        $query=$this->db->get_where('dimension',['shape_id'=>$shape_id]);
        return $query->row_array();
    }
    
    public function getShapeByShape_id($shape_id) {
        $query=$this->db->get_where('shape',['shape_id'=>$shape_id]);
        return $query->row_array();
    }
    
    public function getAllTerms(){
        $query= $this->db->get('dimensional_terms');
        return $query->result_array();
    }
    
    public function getTermDimentionMapping($dimension_id){
        $query= $this->db->get_where('term_dimension_mapping',['dimension_id'=>$dimension_id]);
        return $query->result_array();
    }
    
    public function getDimensionCornerByDimensionId($dimension_id){
        $query=$this->db->get_where('dimension_corner',['dimension_id'=>$dimension_id]);
        return $query->result_array();
    }
    
    public function getAllCorners(){
        $query=$this->db->get('corners');
        return $query->result_array();
    }
    
    public function getSessionData($session_id){
        $query=$this->db->get_where('user',['session_id'=>$session_id]);
        return $query->row_array();
    }
    
    public function getUserData($user_id){
        
        $query=$this->db->get_where('user',['user_id'=>$user_id]);
        return $query->row_array();
    }
    
    public function insertSessionData($session_id){
        $data=array(
            'session_id'=>$session_id
        );
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }
    
    public function updateUserShape($shape_id){
        $data=array(
            'shape_id'=>$shape_id
        );
        
        $this->db->update('user',$data,['session_id'=>$this->session->userdata('session_id')]);
        return $this->db->affected_rows();
    }
    
    public function updateUserDimension($data,$session_id){
        $this->db->update('user',$data,['session_id'=>$session_id]);
        return $this->db->affected_rows();
    }
    
    public function getAllGlassType(){
        $query=$this->db->get('glass_type');
        return $query->result_array();
    }
    
    public function updateUserGlassType($glass_type_id,$session_id){
        $this->db->update('user',['glass_type_id'=>$glass_type_id],['session_id'=>$session_id]);
        return $this->db->affected_rows();
    }
    
    public function getAllMaterial(){
        $query= $this->db->get('material');
        return $query->result_array();
    }
    
    public function getThicknessByMaterialId($id){
        $this->db->select('t.thickness_id,t.thickness');
        $this->db->from('material_thickness mt');
        $this->db->join('thickness t','t.thickness_id=mt.thickness_id');
        $this->db->where('mt.material_id',$id);
        $query= $this->db->get();
        return $query->result_array();
    }
    
    public function updateUserGlassThickness($session_id){
        $data=array(
            'material_id'=> $this->input->post('material_id'),
            'thickness_id'=> $this->input->post('thickness_id')
        );
        $this->db->update('user',$data,['session_id'=>$session_id]);
        return $this->db->affected_rows();
    }
    
    public function getAllEdge(){
        $query= $this->db->get('edge');
        return $query->result_array();
    }
    
    public function getEdgeTypeByEdgeId($edge_id){
        $query= $this->db->get_where('edge_type',['edge_id'=>$edge_id]);
        return $query->result_array();
    }
    
    public function updateUserEdge($session_id){
        $data=array(
            'edge_id'=> $this->input->post('edge_id'),
            'edge_element_id' => $this->input->post('edge_element_id'),
            'edge_type_id'=> $this->input->post('edge_type_id')
        );
        
        $this->db->update('user',$data,['session_id'=>$session_id]);
        return $this->db->affected_rows();
    }
    
    public function getAllSurfaceTreatment(){
        $query= $this->db->get('treatment');
        return $query->result_array();
    }
    
    public function updateSurfaceTreatment($session_id){
        $data=array(
            'treatment_id'=> $this->input->post('treatment_id')
        );
        $this->db->update('user',$data,['session_id'=>$session_id]);
        return $this->db->affected_rows();
    }
    
    public function getEdgeElement(){
        $data= $this->db->get('edge_element');
        return $data->result_array();
    }
    
    public function getSelectedShapeData($shape_id){
        $this->db->select('shape_id,name,image_url,percentage,formula');
        $query = $this->db->get_where('shape', ['shape_id'=>$shape_id]);
        return $query->row_array();
    }
    
    public function getSelectedDimension($dimension_id){
        $this->db->select('d.dimension_id,d.is_corner,d.image_url,d.special_note,dc.corner_name');
        $this->db->from('dimension d');
        $this->db->join('dimension_corner dc', 'd.dimension_id = dc.dimension_id');
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
    /*@start  {Discription of Code ->@Author Mukesh Yadav} */
    public function getSelectedAddress($client_id)
    {
        $this->db->select('zip, country, address_type');
        $query = $this->db->get_where('shipping_address',['client_id'=>$client_id]);
        return $query->row_array();
    }

    public function getBillingAddress($client_id){
        $this->db->select('*');
        $query = $this->db->get_where('billing_address',['client_id'=>$client_id]);
        return $query->row_array();
    }
    public function getShippingAddress($client_id){
        $this->db->select('*');
        $query = $this->db->get_where('shipping_address',['client_id'=>$client_id]);
        return $query->row_array();
    }

    public function doAddBillingAddress($client_id, $billingAddressData)
    {
        $this->db->update('billing_address',$billingAddressData,['client_id'=>$client_id]);
        return $this->db->affected_rows();
    }

    public function doAddShippingAddress($client_id, $shippingAddressData)
    {
        $this->db->update('shipping_address',$shippingAddressData,['client_id'=>$client_id]);
        return $this->db->affected_rows();
    }

//    public function createAddress($session_id){
//
//        $query=$this->db->get_where('user',['session_id'=>$session_id]);
//        $user=$query->row_array();
//        $data=array(
//            'user_id'=>$user['user_id']
//        );
//        $this->db->insert('shipping_address',$data);
//        $this->db->insert('billing_address',$data);
//    }

    public function updateBillingAddress($client_id, $billingAddressData)
    {
        $this->db->update('billing_address',$billingAddressData,['client_id'=>$client_id]);
        return $this->db->affected_rows();
    }

    public function updateShippingAddress($client_id, $shippingAddressData)
    {
        $this->db->update('shipping_address',$shippingAddressData,['client_id'=>$client_id]);
        return $this->db->affected_rows();
    }

    public function getAllShippingCost() {
        $query = $this->db->get('shipping_cost');
        return $query->row_array();
    }

    public function getAllMassDensity() {
        $query = $this->db->get('mass_density');
        return $query->row_array();
    }
    
    public function getcarousel(){
        $query = $this->db->get('carousel');
        return $query->result_array();
    }
    
    public function gellerie(){
        $query = $this->db->get('gallerie');
        return $query->result_array();
    }
    
    public function getreview(){
        $query = $this->db->get('customer_review');
        return $query->result_array();
    }
    
    public function getnews(){
        $query = $this->db->get('news');
        return $query->row_array();
    }
    
    public function doAddContact(){
        $data = array(
            'name'=> $this->security->xss_clean($this->input->post('name')),
            'email'=> $this->security->xss_clean($this->input->post('email')),
            'message'=> $this->security->xss_clean($this->input->post('message'))
        );
        $this->db->insert('contact', $data);
        return $this->db->insert_id();
    }

        // public function getPriceFixedData() {
    //     $query = $this->db->get('price_calculate');
    //     return $query->result_array();

    //     // $query = $this->db->get_where('price_calculate', ['weight <='=> $weight]);
    //     // return $query->result_array();
    // }
    
    public function insertCart($cart){
        $this->db->insert('cart', $cart);
        return $this->db->insert_id();
    }
    
    public function getCartById(){
        $query = $this->db->get_where('cart', ['id'=>$this->session->userdata('session_id')]);
        return $query->result_array();
    }
    
    public function getDetailsByCartId($user_id){
        $query = $this->db->get_where('cart', ['user_id'=>$user_id]);
        return $query->row_array();
    }

    public function deleteSomeCart($cartdata){
        print_r($cartdata);
        //$this->db->delete('cart', ['id'=>$this->session->userdata('session_id')]);
    }

    public function getCartBySessionId($cart_id){
        $query = $this->db->get_where('cart', ['cart_id'=>$cart_id]);
        return $query->row_array();
    }
    
    public function updateCartData($data, $user_id){
        $this->db->update('cart', $data, ['user_id'=>$user_id]);
        return $this->db->affected_rows();
    }
    
    public function deleteCartItem($session_id){
        
        $this->db->delete('cart', ['id'=>$session_id]);
        $this->db->delete('user', ['session_id'=>$session_id]);
        return $this->db->affected_rows();
    }
    public function getCartid($userid){
        $query = $this->db->get_where('cart', ['user_id'=>$userid]);
        return $query->row_array();
    }

    public function cartUpdate($rowid, $data){
        $this->db->update('cart',$data,['cart_id'=>$rowid]);
        return $this->db->affected_rows();
    }
    
    public function getcart(){
        $query = $this->db->get_where('cart',['id'=>$this->session->userdata('session_id')]);
        return $query->row_array();
    }
    /*@end  {Discription of Code ->@Author Mukesh Yadav} */
}
