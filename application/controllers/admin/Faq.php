<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Faq extends CI_Controller {
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
        $get_data ['table']                 = "post_data";
        $get_data ['where']['post_type']    = 4; // Only FAQ Data;
        $data['all_data']                   = $this->common_model->common_table_data_read($get_data);
        $data['header']                     = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'faq';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer']                     = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/faq/all_faq',$data);
    } 
    
    public function create_faq() {
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'faq';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/faq/create_faq',$data);
    }
    
    public function process_faq() {
        // load form validation
        $this->load->library('form_validation');

        // check validation
        $this->form_validation->set_rules('title', 'Question', 'required');
        $this->form_validation->set_rules('descriptions', 'Answer', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menuName']   =   'faq';
            $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/events/create_event',$data);
        } else {
            // try to make data for insert into post data table
            $post_data = [
                'post_type'     => 4, // 4=means FAQ
                'title'         => $this->input->post("title"),
                'descriptions'  => $this->input->post("descriptions"),
                'status'        => 1,
            ];

            //insert the ready post
            $insert_data['fields'] = $post_data;
            $insert_data['table'] = 'post_data';

            $post_data_insert_id = $this->common_model->common_table_data_insert($insert_data);
            $this->session->set_flashdata('success', 'FAQ has added successfully');
            $redirect_url   =   "admin/faq/";
            redirect($redirect_url);
            
        }// end of form validation success
    }
    public function edit_faq($edit_id) {
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
        $data['menuName']   =   'faq';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer']     =   $this->load->view('dashboard/footer','',TRUE);
        
        $this->load->view('dashboard/faq/edit_faq',$data);
    }    
    public function process_update_faq(){
        // load form validation
        $this->load->library('form_validation');

        // check validation
        $this->form_validation->set_rules('title', 'Question', 'required');
        $this->form_validation->set_rules('descriptions', 'Answer', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menuName']   =   'faq';
            $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/exhibition/create_exhibition',$data);
        } else {
            // try to make data for update post data table
            $post_data = [
                'post_type'     => 4, // 4=means FAQ
                'title'         => $this->input->post("title"),
                'descriptions'  => $this->input->post("descriptions"),
                'status'        => 1,
            ];
            
            // try to check featured image is comming
            $update_data['where']['id'] = $this->input->post('exhibition_id');
            $update_data['fields']      = $post_data;
            $update_data['table']       = 'post_data';
            $update_result              = $this->common_model->common_table_data_update($update_data);
            if($update_result){
                // check others image is available or not
                $this->session->set_flashdata('success', 'FAQ has updated successfully');
                $redirect_url   =   "admin/faq/";
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
