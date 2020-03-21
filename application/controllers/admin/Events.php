<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends CI_Controller {
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
        $get_data ['table'] = "post_data";
        $get_data ['where']['post_type'] = 3; // Only Events Data;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'events';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/events/all_events',$data);
    } 
    
    public function create_event() {
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'events';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/events/create_event',$data);
    }
    
    public function process_event() {
        // load form validation
        $this->load->library('form_validation');

        // check validation
        $this->form_validation->set_rules('post_category', 'Type', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('descriptions', 'Descriptions', 'required');
        $this->form_validation->set_rules('venue_name', 'Venue Name', 'required');
        $this->form_validation->set_rules('post_time', 'Time', 'required');
        if ($_FILES['featured_image']['size'] > 0) {
            $this->form_validation->set_rules('featured_image', 'featured_image', 'callback_file_selected_test');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menuName']   =   'events';
            $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/events/create_event',$data);
        } else {
            // try to make data for insert into post data table
            $post_data = [
                'post_type' => 3, // 1=means Events
                'post_category' => $this->input->post("post_category"),
                'title' => $this->input->post("title"),
                'descriptions' => $this->input->post("descriptions"),
                'start_date' => $this->input->post("start_date"),
                'end_date' => $this->input->post("end_date"),
                'post_time'     => $this->input->post("post_time"),
                'venue_name'    => $this->input->post("venue_name"),
                'created_by'    => $this->session->unset_userdata('logged_id'),
                'status' => 1,
            ];
            // try to check featured image is comming
            if ($_FILES['featured_image']['size'] > 0) {
                list($width, $height, $type, $attr) = getimagesize($_FILES['featured_image']['tmp_name']); 
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
                if($image_response['status']    ==  'success'){
                    $post_data['fetured_image_path'] = $image_response['data']['upload_data']['file_name'];
                }
            }

            //insert the ready post
            $insert_data['fields'] = $post_data;
            $insert_data['table'] = 'post_data';

            $post_data_insert_id = $this->common_model->common_table_data_insert($insert_data);
            
            $this->session->set_flashdata('success', 'Event has added successfully');
            $redirect_url   =   "admin/events/";
            redirect($redirect_url);
            
        }// end of form validation success
    }
    
    public function file_selected_test(){
        list($width, $height, $type, $attr) = getimagesize($_FILES['featured_image']['tmp_name']);
        if($width  >   750 && $height  >  500){
            $this->form_validation->set_message('file_selected_test', 'Width and Height Need to be Fixed.');
            return false;
        }else{
            return true;
        }
    }

    // general image processing method:
    public function image_uploader($param) {
        $config = [];
        $path           = $param['file_data']['name'];
        $newName        = time().substr(md5(mt_rand()), 0, 7) . "." . pathinfo($path, PATHINFO_EXTENSION);

        // Image upload config area:
        $config['upload_path']      = $param['image_store_path'];
        $config['allowed_types']    = 'gif|jpg|png';
        $config['file_name']        = $newName;
        $config['maintain_ratio']   = TRUE;
        // Initialize lib with config
        $this->upload->initialize($config);

        // image upload method
        if (!$this->upload->do_upload($param['file_name'])) {
            $error = array('error' => $this->upload->display_errors());
            return $feedback_data   =   [
                'status'    =>  "error",
                'message'   =>  "Failed to upload",
                'data'      =>  $error,
            ];
        } else {
            // Now give watermark to the image:
            $uploaded_image_data = array('upload_data' => $this->upload->data());
            if(isset($param['image_resize']) && $param['image_resize']==true){
                $images_resize_ratios   =   $param['image_resize_sizes'];
                foreach($images_resize_ratios as $img_ratio){
                    list($img_width,    $img_height)    =   explode(',', $img_ratio);
                    $resize_name                        =   $uploaded_image_data['upload_data']['raw_name'].$img_width."_".$img_height."image".$uploaded_image_data['upload_data']['file_ext'];
                    $resize_image_path_name             =   $param['resize_image_store_path'].$resize_name;
                    $resize_imge_param  =   [
                        'source_image'  =>  "./images/exhibition/".$newName,
                        'img_width'     =>  $img_width,
                        'img_height'    =>  $img_height,
                        'resize_path'   =>  $resize_image_path_name,
                    ];
                    $this->upload_image_resize($resize_imge_param);
                }// end of mutiple image ratio foreach:
            }// end of checking resize image is enable or not
            return $feedback_data   =   [
                'status'    =>  "success",
                'message'   =>  "Image has uploaded successfully",
                'data'      =>  $uploaded_image_data,
            ];
        }
    }
    
    public function upload_image_resize($param){
        $config = [];
        $config['source_image']     = $param['source_image']; //get original image
        $config['maintain_ratio']   = TRUE;
//        $config['create_thumb']   = TRUE;
        $config['width']            = $param['img_width'];
//        $config['height']         = $param['img_height'];
        $config['new_image']        = $param['resize_path'];
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            print_r($this->image_lib->display_errors());
        }

        //Clear image library settings so we can do some more image 
        //manipulations if we have to
        $this->image_lib->clear();
        unset($config);
    }
    
    public function edit_event($edit_id) {
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
        $data['menuName']   =   'events';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer']     =   $this->load->view('dashboard/footer','',TRUE);
        
        $this->load->view('dashboard/events/edit_event',$data);
    }
    
    public function process_update_event(){
        // load form validation
        $this->load->library('form_validation');

        // check validation
        $this->form_validation->set_rules('post_category', 'Type', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('descriptions', 'Descriptions', 'required');
        $this->form_validation->set_rules('venue_name', 'Venue Name', 'required');
        $this->form_validation->set_rules('post_time', 'Time', 'required');
        if ($_FILES['featured_image']['size'] > 0) {
            $this->form_validation->set_rules('featured_image', 'featured_image', 'callback_file_selected_test');
        }

        if ($this->form_validation->run() == FALSE) {
            $get_data ['table']         =   "post_data";
            $get_data ['where']['id']   =   $this->input->post('exhibition_id');
            $post_data                  =   $this->common_model->common_table_data_read($get_data);
            $data['post_data']          =   $post_data['data'][0];
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menuName']   =   'events';
            $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/events/edit_event',$data);
        } else {
            // try to make data for update post data table
            $post_data = [
                'post_type'     => 3, // 1=means Events
                'post_category' => $this->input->post("post_category"),
                'title'         => $this->input->post("title"),
                'descriptions'  => $this->input->post("descriptions"),
                'start_date'    => $this->input->post("start_date"),
                'end_date'      => $this->input->post("end_date"),
                'venue_name'    => $this->input->post("venue_name"),
                'post_time'     => $this->input->post("post_time"),
                'venue_name'    => $this->input->post("venue_name"),
                'created_by'    => $this->session->unset_userdata('logged_id'),
                'status' => 1
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
                if($image_response['status']    ==  'success'){
                    $post_data['fetured_image_path'] = $image_response['data']['upload_data']['file_name'];
                }
            }
            
            $update_data['where']['id'] = $this->input->post('exhibition_id');
            $update_data['fields'] = $post_data;
            $update_data['table'] = 'post_data';
            $update_result = $this->common_model->common_table_data_update($update_data);
            if($update_result){
                $this->session->set_flashdata('success', 'Event has updated successfully');
                $redirect_url   =   "admin/events/";
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
