<?php
/*
    ########################################
    **Discription of Frontview Controller **
      ___________________________________
      ******@Author:- Mukesh Yadav ******
    ########################################
*/
class Frontview extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    private function isLogin() {
        return $this->session->userdata('email');
    }
    
    public function index(){
        return $this->carousel();
    }
    
    public function carousel($id=NULL){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($id)) {
            $data['crouselById'] = $this->admin_model->getCrouselById($id);
            
        }
        $data['title'] = 'Carousel';
        $data['crouselData'] = $this->admin_model->getAllcarousel();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/carousel');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddCarouselData(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('carousel_name', 'Carousel Name', 'required|trim');
        $this->form_validation->set_rules('carousel_title', 'Carousel Title', 'required|trim');
        $this->form_validation->set_rules('carousel_content', 'Carousel Content', 'required|trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['carousel_image']['name'])) {
            $carousel_image = $this->doUploadCarousel();
            if (!$carousel_image) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $carousel_image = '';
        }
        
        $result = $this->admin_model->doAddCarouselData($carousel_image);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Carousel added sucessfully', 'url' => base_url('frontview/carousel')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Carousel did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditCarouselData($carousel_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('carousel_name', 'Carousel Name', 'required|trim');
        $this->form_validation->set_rules('carousel_title', 'Carousel Title', 'required|trim');
        $this->form_validation->set_rules('carousel_content', 'Carousel Content', 'required|trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['carousel_image']['name'])) {
            $carousel_image = $this->doUploadCarousel();
            if (!$carousel_image) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $crouselById = $this->admin_model->getCrouselById($carousel_id);
            $carousel_image = $crouselById['carousel_image'];
        }
        
        $result = $this->admin_model->doEditCarouselData($carousel_id, $carousel_image);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Carousel updated sucessfully', 'url' => base_url('frontview/carousel')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Carousel did not updated sucessfully.']));
            return FALSE;
        }
    }
    
    public function doDeleteCarouselData($carousel_id){
        $result = $this->admin_model->doDeleteCarouselData($carousel_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Carousel Deleted Sucessfully', 'url' => base_url('frontview/carousel')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Carousel did not Deleted sucessfully.']));
            return FALSE;
        }
    }
    
    public function doUploadCarousel() {
        $config = array(
            'upload_path' => "./uploads/carousel/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "2048" 
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('carousel_image')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['carousel_image' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function news(){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        
        $data['title'] = 'News';
        $data['allNews'] = $this->admin_model->getAllNews();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/news-view');
        $this->load->view('admin/commons/footer');
    }
    
    public function addnews($news_id=NULL){
        $data['editor'] = 1;
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($news_id)) {
            $data['newsById'] = $this->admin_model->getnewsById($news_id);
        }
        $data['title'] = 'News';
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/add_news');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddNews(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('news_title', 'Title', 'required|trim');
        $this->form_validation->set_rules('news_content', 'Description', 'required|trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadNews();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $image_url = '';
        }
        
        $result = $this->admin_model->doAddNews($image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'News added sucessfully', 'url' => base_url('frontview/news')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'News did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditNews($news_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('news_title', 'Name', 'required|trim');
        $this->form_validation->set_rules('news_content', 'Description', 'required|trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        if (!empty($_FILES['image_url']['name'])) {
            $image_url = $this->doUploadNews();
            if (!$image_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $newsById = $this->admin_model->getnewsById($news_id);
            $image_url= $newsById['image_url'];
        }
        
        $result = $this->admin_model->doEditNews($news_id, $image_url);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'News updated sucessfully', 'url' => base_url('frontview/news')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'News did not updated sucessfully.']));
            return FALSE;
        }
    }
    
    public function doDeleteNews($news_id){
        $result = $this->admin_model->doDeleteNewsData($news_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'News Deleted Sucessfully', 'url' => base_url('frontview/addnews')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'News did not Deleted sucessfully.']));
            return FALSE;
        }
    }

    public function doUploadNews() {
        $config = array(
            'upload_path' => "./uploads/news/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "2048" 
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['image_url' => $this->upload->display_errors()]);
            return 0;
        }
    }

    public function gallerie($gallerie_id=NULL){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($gallerie_id)) {
            $data['gallerieById'] = $this->admin_model->getGallerieById($gallerie_id);
        }
        $data['title'] = 'Gallerie';
        $data['gallerieData'] = $this->admin_model->getAllGallerie();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/gallerie');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddgallerie(){
        $this->output->set_content_type('application/json');
        
        if (!empty($_FILES['min_size_url']['name'])) {
            $min_size_url = $this->doUploadMinImage();
            if (!$min_size_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $min_size_url = '';
        }
        
        if (!empty($_FILES['max_size_url']['name'])) {
            $max_size_url = $this->doUploadMaxImage();
            if (!$max_size_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $max_size_url = '';
        }
        
        $result = $this->admin_model->doAddgallerie($min_size_url,$max_size_url);
        
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Gallerie added sucessfully', 'url' => base_url('frontview/gallerie')]));
            return FALSE;
        }
        else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Gallerie did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditGallerie($gallerie_id){
        $this->output->set_content_type('application/json');
        
        if (!empty($_FILES['min_size_url']['name'])) {
            $min_size_url = $this->doUploadMinImage();
            if (!$min_size_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $gallerieById = $this->admin_model->getGallerieById($gallerie_id);
            $min_size_url= $gallerieById['min_size_url'];
        }
        
        if (!empty($_FILES['max_size_url']['name'])) {
            $max_size_url = $this->doUploadMaxImage();
            if (!$max_size_url) {
                $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->session->userdata('error')]));
                $this->session->unset_userdata('error');
                return FALSE;
            }
        } else {
            $gallerieById = $this->admin_model->getGallerieById($gallerie_id);
            $max_size_url= $gallerieById['max_size_url'];
        }
        
        $result = $this->admin_model->doEditGallerie($gallerie_id, $min_size_url,$max_size_url);
        
        if($result){
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Gallerie updated sucessfully', 'url' => base_url('frontview/gallerie')]));
            return FALSE;
        }
        else{
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Gallerie did not updated sucessfully.']));
            return FALSE;
        }
    }
    
    public function doDeleteGallerie($gallerie_id){
        $result = $this->admin_model->doDeleteGallerie($gallerie_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Gallerie Deleted Sucessfully', 'url' => base_url('frontview/gallerie')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Gallerie did not Deleted sucessfully.']));
            return FALSE;
        }
    }
        
    public function doUploadMinImage() {
        $config = array(
            'upload_path' => "./uploads/gallerie/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "2048" 
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('min_size_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['min_size_url' => $this->upload->display_errors()]);
            return 0;
        }
    }
    
    public function doUploadMaxImage() {
        $config = array(
            'upload_path' => "./uploads/gallerie/",
            'allowed_types' => "jpeg|jpg|png",
            'file_name' => rand(11111, 99999),
            'max_size' => "2048" 
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('max_size_url')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            $this->session->set_userdata('error', ['max_size_url' => $this->upload->display_errors()]);
            return 0;
        }
    }
    
    public function review($review_id=NULL){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        if (!empty($review_id)) {
            $data['reviewById'] = $this->admin_model->getReviewById($review_id);
        }
        $data['title'] = 'Customer Review';
        $data['reviewData'] = $this->admin_model->getAllReview();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/review');
        $this->load->view('admin/commons/footer');
    }
    
    public function doAddReview(){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('author', 'Author Name', 'required|trim');
        $this->form_validation->set_rules('author_address', 'Address', 'required|trim');
        $this->form_validation->set_rules('author_review', 'Author Review', 'required|trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doAddreview();
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Review added sucessfully', 'url' => base_url('frontview/review')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Review did not added sucessfully.']));
            return FALSE;
        }
    }
    
    public function doEditReview($review_id){
        $this->output->set_content_type('application/json');
        $this->form_validation->set_rules('author', 'Author Name', 'required|trim');
        $this->form_validation->set_rules('author_address', 'Address', 'required|trim');
        $this->form_validation->set_rules('author_review', 'Author Review', 'required|trim');
        
        if ($this->form_validation->run() === FALSE) {
            $this->output->set_output(json_encode(['result' => 0, 'errors' => $this->form_validation->error_array()]));
            return FALSE;
        }
        $result = $this->admin_model->doEditReview($review_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Review updated sucessfully', 'url' => base_url('frontview/review')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Review did not updated sucessfully.']));
            return FALSE;
        }
    }
    
    public function doDeleteReview($review_id){
        $result = $this->admin_model->doDeleteReview($review_id);
        if ($result) {
            $this->output->set_output(json_encode(['result' => 1, 'msg' => 'Review Deleted Sucessfully', 'url' => base_url('frontview/review')]));
            return FALSE;
        } else {
            $this->output->set_output(json_encode(['result' => -1, 'msg' => 'Review did not Deleted sucessfully.']));
            return FALSE;
        }
    }
    
    public function contactData(){
        if (!$this->isLogin()) {
            redirect(base_url('admin'));
        }
        $data['title'] = 'Contact View';
        $data['contactData'] = $this->admin_model->getAllcontact();
        $this->load->view('admin/commons/header', $data);
        $this->load->view('admin/contact-view');
        $this->load->view('admin/commons/footer');
    }
}
