<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Exhibition extends CI_Controller {
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
        $get_data ['where']['post_type'] = 1; // Only Event Data;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'exhibition';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/exhibition/all_exhibition',$data);
    } 
    
    public function create_exhibition() {
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'exhibition';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/exhibition/create_exhibition',$data);
    }
    
    public function process_exhibition() {
        // load form validation
        $this->load->library('form_validation');

        // check validation
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('venue_address', 'Venue Address', 'required');
        $this->form_validation->set_rules('front_description', 'Front Details', 'required');
        if ($_FILES['featured_image']['size'] > 0) {
            $this->form_validation->set_rules('featured_image', 'featured_image', 'callback_file_selected_test');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please first solve the following red colored Error!');
            $data['header'] = $this->load->view('dashboard/header', '', TRUE);
            $data['menuName'] = 'exhibition';
            $data['menu'] = $this->load->view('dashboard/menu', $data, TRUE);
            $data['footer'] = $this->load->view('dashboard/footer', '', TRUE);
            $this->load->view('dashboard/exhibition/create_exhibition', $data);
        } else {
            // try to make data for insert into post data table
            $is_featured = $this->input->post("is_fetured");
            if (isset($is_featured) && !empty($is_featured)) {
                $update_is_fetured_data = [
                    'is_featured' => 0,
                ];
                $update_data['where']['post_type'] = 1;
                $update_data['fields'] = $update_is_fetured_data;
                $update_data['table'] = 'post_data';
                $update_result = $this->common_model->common_table_data_update($update_data);
            } else {
                $is_featured = 0;
            }
            $des = htmlentities($this->input->post("descriptions"));
            $post_data = [
                'post_type' => 1, // 1=means Exhibition
                'title' => $this->input->post("title"),
                'front_description' => $this->input->post("front_description"),
                'descriptions' => $des,
                'event_by' => $this->input->post("event_by"),
                'start_date' => $this->input->post("start_date"),
                'end_date' => $this->input->post("end_date"),
                'venue_name' => $this->input->post("venue_name"),
                'venue_address' => $this->input->post("venue_address"),
                'lat_address' => $this->input->post("lat_address"),
                'long_address' => $this->input->post("long_address"),
                'category_id' => $this->input->post("category_id"),
                'post_tags' => $this->input->post("post_tags"),
                'status' => 1,
                'is_featured' => $is_featured,
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

            $otherImage['other_image'] = [];
            if (!empty($_FILES['other_image']['name'][0])) {
                $others_images_uploaded_name = [];
                $others_images = $_FILES;
                $numberOfOtherImage = count($_FILES['other_image']['name']);
                for ($i = 0; $i < $numberOfOtherImage; $i++) {
                    if ($others_images['other_image']['error'][$i] == 0 && $others_images['other_image']['size'][$i] > 0) {
                        $_FILES['other_image']['name']      = $others_images['other_image']['name'][$i];
                        $_FILES['other_image']['type']      = $others_images['other_image']['type'][$i];
                        $_FILES['other_image']['tmp_name']  = $others_images['other_image']['tmp_name'][$i];
                        $_FILES['other_image']['error']     = $others_images['other_image']['error'][$i];
                        $_FILES['other_image']['size']      = $others_images['other_image']['size'][$i];

                        $image_upload_process_param = [
                            'file_name'                 => 'other_image',
                            'file_data'                 => $_FILES['other_image'],
                            'image_resize'              => TRUE,
                            'image_resize_sizes'        => ['200,300', '400,150'],
                            'maintain_ratio'            => true,
                            'resize_image_store_path'   => "./images/exhibition/resize_images/",
                            'image_store_path'          => "./images/exhibition/",
                        ];
                        $image_response                 = $this->image_uploader($image_upload_process_param);
                        if($image_response['status']    ==  'success'){
                            $others_images_uploaded_name[]  = $image_response['data']['upload_data']['file_name'];
                        }
                    }
                } // End of for loop
                foreach ($others_images_uploaded_name as $img_path) {
                    $post_details_data = [];
                    $post_details_data = [
                        'post_id'       => $post_data_insert_id, // last post_data insert id
                        'image_path'    => $img_path
                    ];

                    //insert the ready post data details
                    $insert_data['fields']  = $post_details_data;
                    $insert_data['table']   = 'post_data_details';

                    $insert_result = $this->common_model->common_table_data_insert($insert_data);
                }// end of foreach
            }// end of check other image

            $this->session->set_flashdata('success', 'Exhibition has added successfully');
            $redirect_url = "admin/exhibition/";
            redirect($redirect_url);
        }// end of form validation success
    }

    public function file_selected_test(){
        list($width, $height, $type, $attr) = getimagesize($_FILES['featured_image']['tmp_name']);
        if($width  <   750 && $height  <  500){
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
        $data['menuName']   =   'exhibition';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
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
        $this->form_validation->set_rules('front_description', 'Front Details', 'required');
        if ($_FILES['featured_image']['size'] > 0) {
            $this->form_validation->set_rules('featured_image', 'featured_image', 'callback_file_selected_test');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please first solve the following red colored Error!');
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menuName']   =   'exhibition';
            $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/exhibition/create_exhibition',$data);
        } else {
            // try to make data for update post data table
            $is_featured = $this->input->post("is_fetured");
            if(isset($is_featured) && !empty($is_featured)){
                $update_is_fetured_data = [
                    'is_featured' => 0,
                ];
                $update_data['where']['post_type'] = 1;
                $update_data['fields']      = $update_is_fetured_data;
                $update_data['table']       = 'post_data';
                $update_result              = $this->common_model->common_table_data_update($update_data);
            }else{
                $is_featured    =   0;
            }
            $des    =   htmlentities($this->input->post("descriptions"));
            $post_data = [
                'post_type' => 1, // 1=means Exhibition
                'title' => $this->input->post("title"),
                'front_description' => $this->input->post("front_description"),
                'descriptions' => $des,
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
                if($image_response['status']    ==  'success'){
                    $post_data['fetured_image_path'] = $image_response['data']['upload_data']['file_name'];
                }
            }
            
            $update_data['where']['id'] = $this->input->post('exhibition_id');
            $update_data['fields']      = $post_data;
            $update_data['table']       = 'post_data';
            $update_result              = $this->common_model->common_table_data_update($update_data);
            if($update_result){
                // check others image is available or not
                $otherImage['other_image'] = [];
                if (!empty($_FILES['other_image']['name'][0])) {
                    $others_images_uploaded_name = [];
                    $others_images = $_FILES;
                    $numberOfOtherImage = count($_FILES['other_image']['name']);
                    for ($i = 0; $i < $numberOfOtherImage; $i++) {
                        if ($others_images['other_image']['error'][$i] == 0 && $others_images['other_image']['size'][$i] > 0) {
                            $_FILES['other_image']['name']      = $others_images['other_image']['name'][$i];
                            $_FILES['other_image']['type']      = $others_images['other_image']['type'][$i];
                            $_FILES['other_image']['tmp_name']  = $others_images['other_image']['tmp_name'][$i];
                            $_FILES['other_image']['error']     = $others_images['other_image']['error'][$i];
                            $_FILES['other_image']['size']      = $others_images['other_image']['size'][$i];

                            $image_upload_process_param = [
                                'file_name'                 => 'other_image',
                                'file_data'                 => $_FILES['other_image'],
                                'image_resize'              => TRUE,
                                'image_resize_sizes'        => ['200,300', '400,150'],
                                'maintain_ratio'            => true,
                                'resize_image_store_path'   => "./images/exhibition/resize_images/",
                                'image_store_path'          => "./images/exhibition/",
                            ];
                            $image_response                 = $this->image_uploader($image_upload_process_param);
                            if($image_response['status']    ==  'success'){
                                $others_images_uploaded_name[]  = $image_response['data']['upload_data']['file_name'];
                            }
                        }
                    } // End of for loop
                    foreach ($others_images_uploaded_name as $img_path) {
                        $post_details_data = [];
                        $post_details_data = [
                            'post_id'       => $this->input->post('exhibition_id'), // last post_data insert id
                            'image_path'    => $img_path
                        ];

                        //insert the ready post data details
                        $insert_data['fields']  = $post_details_data;
                        $insert_data['table']   = 'post_data_details';

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
