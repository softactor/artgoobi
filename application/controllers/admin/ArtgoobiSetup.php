<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ArtgoobiSetup extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $logged_status = $this->session->userdata('logged_in');
        if(!isset($logged_status)){
            $feedback_data = [
                'status' => 'error',
                 'message' => 'Sorry,Unauthorised access.',
                 'data' => ''
            ];
            $this->session->set_flashdata('op_message', $feedback_data);
            $red_url = base_url().'welcome/';
            redirect($red_url);
        }
        $this->load->model('common_model');
        $this->load->library('upload');
        $this->load->library('image_lib');
    } 
    
    public function index(){
        $get_data ['table'] = "artwork_media";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'artwork_media';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/all_artwork_media',$data);
    } 
    
    public function create_artwork_media() {
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'artwork_media';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/setup/artwork/create_artwork_media',$data);
    }
    
    public function store_artwork_media() {
        // load form validation
        $this->load->library('form_validation');

        // check validation
        $this->form_validation->set_rules('type_of_art_id', 'Artwork Type', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menuName']   =   'artwork_media';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/setup/artwork/create_artwork_media',$data);
        } else {
            // try to make data for insert into post data table
            $post_data = [
                'artwork_type_id'   => $this->input->post("type_of_art_id"),
                'name'              => $this->input->post("name")
            ];
            $insert_data['fields'] = $post_data;
            $insert_data['table'] = 'artwork_media';
            $post_data_insert_id = $this->common_model->common_table_data_insert($insert_data);
            
            $this->session->set_flashdata('success', 'Media has added successfully');
            $redirect_url   =   "admin/ArtgoobiSetup/create_artwork_media";
            redirect($redirect_url);
            
        }// end of form validation success
    }
    
    public function edit_exhibition($edit_id) {
        $get_data ['table']         =   "post_data";
        $get_data ['where']['id']   =   $edit_id; // exhibition Data;
        $post_data                  =   $this->common_model->common_table_data_read($get_data);
        $data['post_data']          =   $post_data['data'][0];
        
        // Post related image: 
        $get_data                   =   [];
        $get_data ['table']         =   "post_data_details";
        $get_data ['where']['post_id']   =   $data['post_data']->id; // exhibition Data;
        $post_detail_data                  =   $this->common_model->common_table_data_read($get_data);
        $data['post_details_data']          =   $post_detail_data['data'];
        
        $data['header']     =   $this->load->view('dashboard/header','',TRUE);
        $data['menu']       =   $this->load->view('dashboard/menu','',TRUE);
        $data['footer']     =   $this->load->view('dashboard/footer','',TRUE);
        
        $this->load->view('dashboard/exhibition/edit_exhibition',$data);
    }
    
    public function process_update_exhibition(){
        // load form validation
        $this->load->library('form_validation');

        // check validation
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('venue_address', 'Venue Address', 'required');
        if ($_FILES['featured_image']['size'] > 0) {
            $this->form_validation->set_rules('featured_image', 'featured_image', 'callback_file_selected_test');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/exhibition/create_exhibition',$data);
        } else {
            // try to make data for update post data table
            $post_data = [
                'post_type' => 1, // 1=means Exhibition
                'title' => $this->input->post("title"),
                'descriptions' => $this->input->post("descriptions"),
                'start_date' => $this->input->post("start_date"),
                'end_date' => $this->input->post("end_date"),
                'venue_name' => $this->input->post("venue_name"),
                'event_by' => $this->input->post("event_by"),
                'venue_address' => $this->input->post("venue_address"),
                'lat_address' => $this->input->post("lat_address"),
                'long_address' => $this->input->post("long_address"),
                'category_id' => $this->input->post("category_id"),
                'post_tags' => $this->input->post("post_tags"),
                'status' => 1,
                'is_featured' => $this->input->post("is_fetured"),
            ];
            
            // try to check featured image is comming
            if ($_FILES['featured_image']['size'] > 0) {
                $image_upload_process_param = [
                    'file_name' => 'featured_image',
                    'file_data' => $_FILES['featured_image'],
                    'image_resize' => true,
                    'image_resize_sizes' => ['500,300'],
                    'maintain_ratio' => true,
                    'resize_image_store_path' => "./images/exhibition/resize_images/",
                    'image_store_path' => "./images/exhibition/",
                ];
                $image_response = $this->image_uploader($image_upload_process_param);
                $post_data['fetured_image_path'] = $image_response['data']['upload_data']['file_name'];
            }
            
            $update_data['where']['id'] = $this->input->post('exhibition_id');
            $update_data['fields'] = $post_data;
            $update_data['table'] = 'post_data';
            $update_result = $this->common_model->common_table_data_update($update_data);
            if($update_result){
                // check others image is available or not
                if ($_FILES['other_image']['error'][0] == 0) {
                    $others_images_uploaded_name = [];

                    $others_images = $_FILES;
                    $cpt = count($_FILES['other_image']['name']);
                    for ($i = 0; $i < $cpt; $i++) {
                        $_FILES['other_image']['name'] = $others_images['other_image']['name'][$i];
                        $_FILES['other_image']['type'] = $others_images['other_image']['type'][$i];
                        $_FILES['other_image']['tmp_name'] = $others_images['other_image']['tmp_name'][$i];
                        $_FILES['other_image']['error'] = $others_images['other_image']['error'][$i];
                        $_FILES['other_image']['size'] = $others_images['other_image']['size'][$i];

                        $image_upload_process_param = [
                            'file_name' => 'other_image',
                            'file_data' => $_FILES['other_image'],
                            'image_resize' => TRUE,
                            'image_resize_sizes' => ['200,300', '400,150'],
                            'maintain_ratio' => true,
                            'resize_image_store_path' => "./images/exhibition/resize_images/",
                            'image_store_path' => "./images/exhibition/",
                        ];
                        $image_response = $this->image_uploader($image_upload_process_param);
                        $others_images_uploaded_name[] = $image_response['data']['upload_data']['file_name'];
                    }// end of for loop
                    foreach ($others_images_uploaded_name as $img_path) {
                        $post_details_data = [];
                        $post_details_data = [
                            'post_id' => $this->input->post('exhibition_id'), // last post_data insert id
                            'image_path' => $img_path
                        ];

                        //insert the ready post data details
                        $insert_data['fields'] = $post_details_data;
                        $insert_data['table'] = 'post_data_details';

                        $insert_result = $this->common_model->common_table_data_insert($insert_data);
                    }// end of foreach
                }// end of check other image
                
                $this->session->set_flashdata('success', 'Exhibition has updated successfully');
                $redirect_url   =   "admin/exhibition/";
                redirect($redirect_url);
            }
        }
    }
    
    public function executeDeleteOperation(){
        
        $delete_data['where']['id']     =   $this->input->post('delete_id');
        $delete_data['table']           =   $this->input->post('table');
        $delete_result                  =   $this->common_model->common_table_data_delete($delete_data);
        if($delete_result){
            $feedback_data  =   [
                'status'    =>  'success',
                'message'   =>  'Data have Successfully Deleted.',
                'data'      =>  "",
            ];
        }else{
            $feedback_data  =   [
                'status'    =>  'error',
                'message'   =>  'failed to Delete.',
                'data'      =>  ''
            ];
        }
        echo json_encode($feedback_data);
    }
}
?>
