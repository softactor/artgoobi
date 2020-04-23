<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index() {
        $data['title'] = "Artgoobi | Home";
        $data['active_menu'] = "home";
        // Read All User Data
        $gallery_sql                    = "SELECT * FROM `artwork_info` WHERE status=1 ORDER BY RAND(), create_time DESC LIMIT 0,15";
        $query                          = $this->db->query($gallery_sql);
        $data['galleries']              = $query->result();
        $data['top_menu']               = $this->load->view('layouts/top_menu', $data, true);
        $data['header']                 = $this->load->view('layouts/header', $data, true);
        $data['footer']                 = $this->load->view('layouts/footer', '', true);
        $this->load->view('single', $data);
    }

    public function logging_attempt() {
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['user_email'] = htmlentities($this->input->post('user_name'));
        $get_data ['where']['password'] = md5(htmlentities($this->input->post('password')));
        $user_info = $this->common_model->common_table_data_read($get_data);
        if (isset($user_info['status']) && $user_info['status'] == 'success') {
            $logged['id'] = $user_info['data'][0]->id;
            $logged['user_email'] = $user_info['data'][0]->user_email;
            $logged['user_type'] = $user_info['data'][0]->user_type;
            $logged['ip_adress'] = json_decode($user_info['data'][0]->ip_adress);
            $logged['is_ip_checked'] = $user_info['data'][0]->is_ip_checked;
            if ($logged['is_ip_checked']) {
                $ip_valid['client_ip'] = ip2long('192.168.10.5'); //ip2long(get_client_ip());
                $ip_valid['range_from'] = ip2long($logged['ip_adress']->range_from);
                $ip_valid['range_to'] = ip2long($logged['ip_adress']->range_to);

                $ip_validity = check_user_ip_validity($ip_valid);
                if (!$ip_validity) {
                    $feedback_data = [
                        'status' => 'error',
                        'message' => 'IP address validation Failed.',
                        'data' => ''
                    ];
                    $this->session->set_flashdata('op_message', $feedback_data);
                    $red_url = base_url() . 'welcome/';
                    redirect($red_url);
                }// End of ip address validity;
            }   // end of ip address check enale  

            $logged_data = array(
                'logged_user_id' => $logged['id'],
                'logged_type' => $logged['user_type'],
                'logged_type_name' => get_user_type_name($logged['user_type']),
                'logged_email' => $logged['user_email'],
                'logged_in' => TRUE
            );

            $this->session->set_userdata($logged_data);
            $feedback_data = [
                'status' => 'success',
                'message' => 'You Have Successfully Loggedin.',
                'data' => ''
            ];
            $this->session->set_flashdata('op_message', $feedback_data);
            $red_url = base_url() . 'admin/dashboard';
            redirect($red_url);
        } else {
            $feedback_data = [
                'status' => 'error',
                'message' => 'Login credential was not currect.',
                'data' => ''
            ];
            $this->session->set_flashdata('op_message', $feedback_data);
            $red_url = base_url() . 'welcome/';
            redirect($red_url);
        }
    }

    public function signup_process() {
        $validation = $this->_signup_validation();
        if (!$validation['status']) {
            echo json_encode($validation);
            exit;
        }
        //Check email has already exist or not
        // Duplicate check
        $duplicate_check['table'] = 'users';
        $duplicate_check['where']['user_email']     = $this->input->post('email');        
        $email_check = $this->duplicate_entry_check($duplicate_check);
        if ($email_check['status'] == 'error') {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror']   = array();
            $data['status']       = TRUE;
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email has already exist !';
            $data['status'] = FALSE;
            echo json_encode($data);
            exit;
        }
        
        // First need to insert data into users Table
        $users_data = [
            'name'          => $this->input->post('first_name') . " " . $this->input->post('last_name'),
            'user_email'    => $this->input->post('email'),
            'password'      => md5($this->input->post('password')),
            'user_type'     => $this->input->post('signup_type'),
            'status'        => 1, // by default active as the discussion on 14th april-2019
            'create_time'   => date("Y-m-d h:i:s", time())
        ];
        $insert_data['fields'] = $users_data;
        $insert_data['table'] = 'users';
        $user_insert_result = $this->common_model->common_table_data_insert($insert_data);
        // if success need to insert data into users_details table
        if ($user_insert_result) {
            $user_id = $user_insert_result;
            $birth_string_date  = $this->input->post('birth_day');
            $birth_string_month = $this->input->post('birth_month');
            $birth_string_year  = $this->input->post('birth_year');
            $birth_string       = $birth_string_month.' '.$birth_string_date.' '.$birth_string_year;
            $usersdet_data = [
                'profile_link_name' => trim($this->input->post('profile_link_name')),
                'first_name'        => $this->input->post('first_name'),
                'last_name'         => $this->input->post('last_name'),
                'phone_no'          => $this->input->post('phone'),
                'date_of_birth'     => date('Y-m-d', strtotime($birth_string)),
                'country_id'        => $this->input->post('country_id'),
                'zip_code'          => $this->input->post('zip_code'),
                'user_id'           => $user_id,
                'created_time'      => date("Y-m-d h:i:s", time())
            ];
            $insert_data['fields'] = $usersdet_data;
            $insert_data['table'] = 'users_details';
            $insert_result = $this->common_model->common_table_data_insert($insert_data);
            
            $secretKey      =   $this->input->post('secret_key');
            if(isset($secretKey) && !empty($secretKey)){
                $fields_data = [
                    'is_active'         => 1,
                    'activated_time'    => date("Y-m-d H:i:s")
                ];
                $updateData['where']['secret_key']  =   $secretKey;
                $updateData['table']        =   "artist_invitation_details";
                $updateData['fields']       =   $fields_data;

                $this->common_model->common_table_data_update($updateData);
            }
            
            if ($insert_result) {
                $logged_data = array(
                    'user_logged_id' => $user_id,
                    'user_logged_name' => $this->input->post('first_name') . " " . $this->input->post('last_name'),
                    'user_logged_type' => $this->input->post('signup_type'),
                    'user_logged_type_name' => get_user_type_name($this->input->post('signup_type')),
                    'user_logged_email' => $this->input->post('email'),
                    'user_logged_in_status' => TRUE
                );

                $this->session->set_userdata($logged_data);
                $feedback_data = [
                    'status'        => true,
                    'message'       => 'Profile has been successfully created.',
                    'redirect_url'  => base_url('welcome/user_profile'),
                    'data'          => $insert_result, // Last Inserted ID
                ];
            } else {
                $feedback_data = [
                    'status' => false,
                    'message' => 'failed to Inserted.',
                    'data' => ''
                ];
            }
        } else {
            $feedback_data = [
                'status' => false,
                'message' => 'failed to Inserted.',
                'data' => ''
            ];
        }
        echo json_encode($feedback_data);
    }

    private function _signup_validation($passwordCheck  =   true) {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('first_name') == '') {
            $data['inputerror'][] = 'first_name';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('last_name') == '') {
            $data['inputerror'][] = 'last_name';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('signup_type') == '') {
            $data['inputerror'][] = 'signup_type';
            $data['error_string'][] = 'Signup Type is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('profile_link_name') == '') {
            $data['inputerror'][] = 'profile_link_name';
            $data['error_string'][] = 'Please Enter Profile Link Name';
            $data['status'] = FALSE;
        }

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('phone') == '') {
            $data['inputerror'][] = 'phone';
            $data['error_string'][] = 'Phone is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('country_id') == '') {
            $data['inputerror'][] = 'country';
            $data['error_string'][] = 'Country is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('zip_code') == '') {
            $data['inputerror'][] = 'zip_code';
            $data['error_string'][] = 'Zip Code is required';
            $data['status'] = FALSE;
        }
        if ($passwordCheck) {
            if ($this->input->post('password') == '') {
                $data['inputerror'][] = 'password';
                $data['error_string'][] = 'Password is required';
                $data['status'] = FALSE;
            }
            if ($this->input->post('re_password') == '') {
                $data['inputerror'][] = 're_password';
                $data['error_string'][] = 'Password Re-Type is required';
                $data['status'] = FALSE;
            }

            if ($this->input->post('re_password') != $this->input->post('password')) {
                $data['inputerror'][] = 're_password';
                $data['error_string'][] = 'Password Matched is required';
                $data['status'] = FALSE;
            }
        }
        return $data;
    }

    public function duplicate_entry_check($chck_data) {
        $status = "success";
        $error_message = '';
        $check = $this->common_model->duplicate_entry_check($chck_data);
        if ($check) {
            $status = "error";
            $error_message = 'Duplicate Entry Found!';
        }
        return $feedback = [
            'status' => $status,
            'message' => $error_message
        ];
    }

    public function signout_process() {
        $this->session->unset_userdata('user_logged_id');
        $this->session->unset_userdata('user_logged_name');
        $this->session->unset_userdata('user_logged_type');
        $this->session->unset_userdata('user_logged_type_name');
        $this->session->unset_userdata('user_logged_email');
        $this->session->unset_userdata('user_logged_in_status');
        $feedback_data = [
            'status' => 'success',
            'message' => 'You have successfully logged out.',
            'data' => ''
        ];
        $this->session->set_flashdata('op_message', $feedback_data);
        echo json_encode($feedback_data);
    }

    public function user_login_process() {
        $validation = $this->_userlogin_validation();
        if (!$validation['status']) {
            echo json_encode($validation);
            exit;
        }
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['user_email'] = htmlentities($this->input->post('email'));
        $get_data ['where']['password'] = md5(htmlentities($this->input->post('password')));
        $user_info = $this->common_model->common_table_data_read($get_data);
        if (isset($user_info['status']) && $user_info['status'] == 'success') {
            $logged['id'] = $user_info['data'][0]->id;
            $logged['user_email'] = $user_info['data'][0]->user_email;
            $logged['user_type'] = $user_info['data'][0]->user_type;
            
            $get_data           = [];
            $get_data ['table'] = "users_details";
            $get_data ['where']['user_id'] = $user_info['data'][0]->id;
            $users_details = $this->common_model->common_table_data_read($get_data, null, true);
            
            $logged_data = array(
                'user_logged_id' => $user_info['data'][0]->id,
                'user_logged_name' => $user_info['data'][0]->name,
                'user_logged_type' => $user_info['data'][0]->user_type,
                'user_logged_type_name' => get_user_type_name($this->input->post('user_type')),
                'user_logged_email' => $user_info['data'][0]->user_email,
                'profile_link_name' => $users_details['data']->profile_link_name,
                'user_logged_in_status' => TRUE
            );

            $this->session->set_userdata($logged_data);
            $feedback_data = [
                'status' => true,
                'message' => 'You Have Successfully Loggedin.',
                'data' => ''
            ];
            $this->session->set_flashdata('op_message', $feedback_data);
        } else {
            $feedback_data = [
                'status' => 'error',
                'message' => 'Login credential was not correct.',
                'data' => ''
            ];
            $this->session->set_flashdata('op_message', $feedback_data);
        }
        echo json_encode($feedback_data);
    }

    public function password_recover_process(){
        $htmlContent    =   '';
        $get_data ['table'] = "users";
        $get_data ['where']['user_email'] = htmlentities($this->input->post('email'));
        $user_info = $this->common_model->common_table_data_read($get_data, null, true);

        if($user_info['status']=='error'){
            $message = 'Your email '. $user_info['data']->user_email.' is not registered.Please signup..';;
        }else{
            $random_key = md5(rand(0,4));
            $this->load->helper('string');
            $random_key = random_string('alnum',10);
            $users_data = [
                'secret_key' => $random_key,
                'update_time' => date('Y-m-d H:i:s'),
            ];
            $update_data['where']['user_email'] = $user_info['data']->user_email;
            $update_data['fields'] = $users_data;
            $update_data['table'] = 'users';
            $update_result = $this->common_model->common_table_data_update($update_data);
            $message = 'An email has been sent to '. $this->input->post('email').'.Please check your mail';


        // email sending mechanism
        //Load email library
        //SMTP & mail configuration
        $config = Array(
            'protocol'  => 'mail',
            'smtp_host' => 'sg3plcpnl0094.prod.sin3.secureserver.net',
            'smtp_port' => 465,
            'smtp_user' => 'admin.info@artgoobi.com',
            'smtp_pass' => ')WjSavN27ULe',
            'mailtype'  => 'html',
            'newline'   => "\r\n",
            'crlf'      => "\r\n",
            'wordwrap'  => "TRUE",
            'validate'  => "FALSE",
        );
        $link = base_url().'welcome/get_recover_password?secret_key='. $random_key;
        $this->email->initialize($config);
        $this->load->library('email',$config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent = '<h1>Recover Password Process ..</h1>';
        $htmlContent.= '<p>Dear User,To reset your password please click this ' . $link . '</p>';

        $this->email->to($user_info['data']->user_email);
        $this->email->from('info@artgoobi.com','Artgoobi');
        $this->email->subject('Password recover process');
        $this->email->message($htmlContent);

//Send email
        $checkEmail =   $this->email->send();
        $eData  =   $this->email->print_debugger();
        if(!$checkEmail){
            $eData  =   $this->email->print_debugger();
            print '<pre>';
            print_r($eData);
            print '</pre>';
            exit;
            
        }
    }

        $feedback_data = [
            'status' =>$user_info['status'],
            'message' => $message,
        ];
        $this->session->set_flashdata('op_message', $feedback_data);
        echo json_encode($feedback_data);
    }
    public function get_recover_password(){
        $get_data ['table']                 = "users";
        $get_data ['where']['secret_key']   = htmlentities($this->input->get('secret_key'));
        $user_info                          = $this->common_model->common_table_data_read($get_data, null, true);
        if($user_info['status']=='success'){
            $data['user_email']             =   $user_info['data']->user_email;
            $this->load->view('reset_password', $data);
        }else{
            $this->session->set_flashdata('op_message', 'Your session has been expired!');
            $this->load->view('reset_password', $data);
        }
    }
    public function reset_password(){
        $users_data = [
            'password' => md5(htmlentities($this->input->post('password'))),
            'update_time' => date('Y-m-d H:i:s'),
        ];
        $update_data['where']['user_email'] = $this->input->post('user_name');
        $update_data['where']['secret_key'] = $this->input->post('secret_key');
        $update_data['fields'] = $users_data;
        $update_data['table'] = 'users';
        $update_result = $this->common_model->common_table_data_update($update_data);
        $users_data = [
            'secret_key'    => '',
            'update_time'   => date('Y-m-d H:i:s'),
        ];
        $update_data['fields']  = $users_data;
        $update_result          = $this->common_model->common_table_data_update($update_data);

        $get_data ['table']                 = "users";
        $get_data ['where']['user_email']   = htmlentities($this->input->post('user_name'));
        $get_data ['where']['password']     = md5(htmlentities($this->input->post('password')));
        $user_info                          = $this->common_model->common_table_data_read($get_data);
        if (isset($user_info['status']) && $user_info['status'] == 'success') {
            $logged['id']           = $user_info['data'][0]->id;
            $logged['user_email']   = $user_info['data'][0]->user_email;
            $logged['user_type']    = $user_info['data'][0]->user_type;

            $logged_data = array(
                'user_logged_id'        => $user_info['data'][0]->id,
                'user_logged_name'      => $user_info['data'][0]->name,
                'user_logged_type'      => $user_info['data'][0]->user_type,
                'user_logged_type_name' => get_user_type_name($this->input->post('user_type')),
                'user_logged_email'     => $user_info['data'][0]->user_email,
                'user_logged_in_status' => TRUE
            );

            $this->session->set_userdata($logged_data);
            $feedback_data = [
                'status'    => true,
                'message'   => 'You Have Successfully Loggedin.',
                'data'      => ''
            ];
            $this->session->set_flashdata('op_message', $feedback_data);
        } else {
            $feedback_data = [
                'status' => 'error',
                'message' => 'Login credential was not correct.',
                'data' => ''
            ];
            $this->session->set_flashdata('op_message', $feedback_data);
        }
        redirect(base_url());

    }
    private function _userlogin_validation() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('password') == '') {
            $data['inputerror'][] = 'password';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }
        return $data;
    }

    public function user_profile($artist_id = null) {
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        
        // Read All artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['artist_id= '] = $user_logged_in; // Exclude Super Admin;
        $get_data ['where']['status= '] = 1; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data'] = $data['all_data']['data'];
        $data['artwork_data'] = isset($data['all_data']['data'][0])?$data['all_data']['data'][0]:'';
        
        // Peding artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['artist_id= '] = $user_logged_in; // Exclude Super Admin;
        $get_data ['where']['status= '] = 0; // Exclude Super Admin;
        $data['pending_artwork_response'] = $this->common_model->common_table_data_read($get_data);
        $data['pending_artwork_data'] = (isset($data['pending_artwork_response']['data'][0])?$data['pending_artwork_response']['data']:'');
        
        $data['artworks_data'] = $data['all_data']['data'];
        $data['artwork_data'] = isset($data['all_data']['data'][0])?$data['all_data']['data'][0]:'';
        
        $data['title'] = "Artgoobi | User Profile";
        $data['active_menu'] = "gallery";
        
        // get user details data
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $this->load->view('user_profile', $data);
    }
    public function get_artist_profile_data(){
        // need to work here after breakfast 
        // first check ajax call
        $user_logged_in = $this->input->post('profile_id');
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        // get user details data
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
        $profile_body_data        = $this->load->view('partial/profile_details_by_ajax_request', $data, true);
        $feedbackData   =   [
            'status'    => 'success',
            'data'      => $profile_body_data
        ];
        echo json_encode($feedbackData);
    }
    public function get_profile_info_by_id(){
        $data['profile_data']   = userProfileDetailsdataByUserId($this->input->post('id'));
        $modal_body_data        = $this->load->view('modal/user_profile_modal_body_data', $data, true);
        $feedbackData   =   [
            'status'    => 'success',
            'data'      => $modal_body_data
        ];
        echo json_encode($feedbackData);    
    }    
    public function user_profile_update(){
        $passwordCheck      =   false;
        $pass   =   $this->input->post('password');
        if(isset($pass) && !empty($pass)){
            $passwordCheck      =   true;
        }
        $validation = $this->_signup_validation($passwordCheck);
        if (!$validation['status']) {
            echo json_encode($validation);
            exit;
        }
        //Check email has already exist or not
        // Duplicate check
        $duplicate_check['table'] = 'users';
        $duplicate_check['where']['user_email']     = $this->input->post('email');
        $duplicate_check['where_not_in']   = $this->input->post('update_id');
        $email_check = $this->duplicate_entry_check($duplicate_check);
        if ($email_check['status'] == 'error') {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email has already exist !';
            $data['status'] = FALSE;
            echo json_encode($data);
            exit;
        }
        $pass   =   $this->input->post('password');
        if(isset($pass) && !empty($pass)){
            $users_data['password']     =  md5($this->input->post('password'));        
            $users_data['update_time']  = date('Y-m-d H:i:s');
            $update_data['where']['id'] = $this->input->post('update_id');
            $update_data['fields']      = $users_data;
            $update_data['table']       = 'users';
            $update_result              = $this->common_model->common_table_data_update($update_data);
        }
        
        $update_data                        = [];
        $users_det_data['profile_link_name']       =   $this->input->post('profile_link_name');        
        $users_det_data['first_name']       =   $this->input->post('first_name');        
        $users_det_data['last_name']        =   $this->input->post('last_name');        
        $users_det_data['gender']           =   $this->input->post('gender');        
        $users_det_data['phone_no']         =   $this->input->post('phone');        
        $users_det_data['country_id']       =   $this->input->post('country_id');       
        $users_det_data['zip_code']         =   $this->input->post('zip_code');        
        $users_det_data['present_desig']         =   $this->input->post('present_desig');        
        $users_det_data['present_working_area']     =   $this->input->post('present_working_area');        
        $users_det_data['previous_working_area']    =   $this->input->post('previous_working_area');        
        $users_det_data['short_bio']        =   $this->input->post('short_bio');        
        $users_det_data['updated_time']     =   date('Y-m-d H:i:s');
        $update_data['where']['user_id']    =   $this->input->post('update_id');
        $update_data['fields']              =   $users_det_data;
        $update_data['table']               =   'users_details';
        $update_result                      =   $this->common_model->common_table_data_update($update_data);
        
        $msg = '';
        $msg.= '<div class="alert alert-success">';
        $msg.= '<strong>Success!</strong> Data have been successfully Updated.';
        $msg.= '</div>';
        $feedack = [
            'status'=>'success',
            'message'=>$msg
        ];
        echo json_encode($feedack);
    }
    public function save_user_profile_work_history() {
        $user_id = $this->session->userdata('user_logged_id');
        $work_update_id = $this->input->post('work_update_id');
        if (!isset($work_update_id) && empty($work_update_id)) {
            // Insert artist work history data

            $works_data = [
                'company' => $this->input->post('company'),
                'position' => $this->input->post('position'),
                'location' => $this->input->post('location'),
                'description' => $this->input->post('description'),
            ];
            $users_data = [
                'type_id' => 1,
                'details' => json_encode($works_data),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id,
                'user_id' => $user_id,
            ];
            $insert_data['fields'] = $users_data;
            $insert_data['table'] = 'users_profile_details';
            $insert_id = $this->common_model->common_table_data_insert($insert_data);

            // Read Last inserted Data
            $get_data ['table'] = "users_profile_details";
            $get_data ['where']['id'] = $insert_id; // Exclude Super Admin;
            $last_data = $this->common_model->common_table_data_read($get_data);
            $details = json_decode($last_data['data'][0]->details);
            $det_id = $last_data['data'][0]->id;
            $new_insert = '';
            $new_insert .= '<div class="work_details_area" id="work_details_area_' . $det_id . '">';
            $new_insert .= '<h3>' . $details->company . '</h3>';
            $new_insert .= '<p>';
            $new_insert .= '<span class="work_position">' . $details->position . '</span>,';
            $new_insert .= '<span class="work_location">' . $details->location . '</span>';
            $new_insert .= '</p>';
            $new_insert .= "<a href='#' onclick='editWorkPlace(" . $det_id . ");'><span class='glyphicon glyphicon-pencil'></span> Edit</a>";
            $new_insert .= "<a href='#' onclick='deleteWorkPlace(" . $det_id . ");'><span class='glyphicon glyphicon-remove'></span> Delete</a>";
            $new_insert .= '</div>';
            $new_insert .= '<span id="work_update_form_area_' . $det_id . '"></span>';

            $feedack = [
                "status" => 'success',
                'message' => 'Successfully saved',
                'data' => $new_insert,
            ];
            echo json_encode($feedack);
        } else {
            $works_data = [
                'company' => $this->input->post('company_up'),
                'position' => $this->input->post('position_up'),
                'location' => $this->input->post('location_up'),
                'description' => $this->input->post('description_up'),
            ];
            $users_data = [
                'details' => json_encode($works_data),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id
            ];
            $update_data['where']['id'] = $work_update_id;
            $update_data['fields'] = $users_data;
            $update_data['table'] = 'users_profile_details';
            $update_result = $this->common_model->common_table_data_update($update_data);
            // Read Last inserted Data
            $get_data ['table'] = "users_profile_details";
            $get_data ['where']['id'] = $work_update_id; // Exclude Super Admin;
            $last_data = $this->common_model->common_table_data_read($get_data);
            $details = json_decode($last_data['data'][0]->details);
            $det_id = $last_data['data'][0]->id;
            $new_insert = '';
            $new_insert .= '<h3>' . $details->company . '</h3>';
            $new_insert .= '<p>';
            $new_insert .= '<span class="work_position">' . $details->position . '</span>,';
            $new_insert .= '<span class="work_location">' . $details->location . '</span>';
            $new_insert .= '</p>';
            $new_insert .= "<a href='#' onclick='editWorkPlace(" . $det_id . ");'><span class='glyphicon glyphicon-pencil'></span> Edit</a>";
            $new_insert .= "<a href='#' onclick='deleteWorkPlace(" . $det_id . ");'><span class='glyphicon glyphicon-remove'></span> Delete</a>";
//                $new_insert.= '<span id="work_update_form_area_'.$det_id.'"></span>';
            $feedack = [
                "status" => 'success',
                'message' => 'Successfully Updated',
                'data' => $new_insert,
            ];
            echo json_encode($feedack);
        }
    }

    public function get_work_update_form() {
        // Read Data
        $get_data ['table'] = "users_profile_details";
        $get_data ['where']['id'] = $this->input->post('id');
        $last_data = $this->common_model->common_table_data_read($get_data);
        $data['work_data'] = $last_data['data'][0];
        $data['details'] = json_decode($last_data['data'][0]->details);
        $update_form = $this->load->view('user_profile_work_update_form', $data, true);
        $feedack = [
            'status' => 'success',
            'message' => 'Successfully get data',
            'data' => $update_form,
        ];
        echo json_encode($feedack);
    }

    public function artist_image_upload() {
        // Authentication Check
        $user_logged_in = profile_authentication_check();
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
        $data['title'] = "Artgoobi | User Profile";
        $data['active_menu'] = "gallery";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', '', true);
        $data['art_form'] = $this->load->view('partial/forms/painting_form', $data, true);
        $data['art_form_id'] = 1;
        $this->load->view('profile_image_upload', $data);
    }

    public function artist_image_upload_process() {
        $all    =   $this->input->post();
        // get value for not for sale:
        $nfs    =   $this->input->post('not_for_sale');
        $this->load->library('form_validation'); 
        $get_rules_data['type_of_art_id']    =   $this->input->post('type_of_art_id');
        $data['artwork_type_id']    =   $this->input->post('type_of_art_id');
        $rules_data     =   $this->get_artwork_upload_rules($get_rules_data);
        $common_rules   =   $rules_data['rules'];
        $type_name      =   $rules_data['type_name'];      
        $this->form_validation->set_rules($common_rules);
        $this->form_validation->set_rules('userfile', 'artwork', 'callback_file_selected_test');
        if(!$nfs){
            $this->form_validation->set_rules('price', '', 'required|greater_than[0]');
        }
        if ($this->form_validation->run() == FALSE) {
            //$error  =   validation_errors();
            $this->session->set_flashdata('error_message','Failed to upload artwork. Please fix the following issue.');
            // Authentication Check
            $user_logged_in = profile_authentication_check();
            // Read All User Data
            $get_data ['table'] = "users";
            $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
            $data['all_data'] = $this->common_model->common_table_data_read($get_data);
            $data['users_info'] = $data['all_data']['data'][0];
            $data['users_data'] = $data['all_data']['data'][0];
            $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
            $data['title'] = "Artgoobi | User Profile";
            $data['active_menu'] = "gallery";
            $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
            $data['header'] = $this->load->view('layouts/header', $data, true);
            $data['profile_left_panel'] = $this->load->view('profile_left_panel', $data, true);
            $data['footer'] = $this->load->view('layouts/footer', '', true);
            if($type_name == 'Painting'){
                $data['art_form']      = $this->load->view('partial/forms/painting_form', $data, true);
            }
            if($type_name == 'Print'){
                $data['art_form']      = $this->load->view('partial/forms/print_form', $data, true);
            }
            if($type_name == 'Sclupture'){
                $data['art_form']      = $this->load->view('partial/forms/sculpture_form', $data, true);
            }
            if($type_name == 'Design'){
                $data['art_form']      = $this->load->view('partial/forms/design_form', $data, true);
            }
            if($type_name == 'Photography'){
                $data['art_form']      = $this->load->view('partial/forms/photography_form', $data, true);
            }
            if($type_name == 'Craft'){
                $data['art_form']      = $this->load->view('partial/forms/craft_form', $data, true);
            }
            if($type_name == 'Video'){
                $data['art_form']      = $this->load->view('partial/forms/video_form', $data, true);
            }
            if($type_name == 'Installation'){
                $data['art_form']      = $this->load->view('partial/forms/installation_form', $data, true);
            }
            if($type_name == 'Performance'){
                $data['art_form']      = $this->load->view('partial/forms/performance_form', $data, true);
            }
            if($type_name == 'Others'){
                $data['art_form']      = $this->load->view('partial/forms/others_form', $data, true);
            }
            $data['art_form_id'] = $rules_data['art_form_id'];
            $this->load->view('profile_image_upload', $data);
            
        }else{
           /**
         * Image upload & watermark area
         */
        // rename for watermark image
        $path = $_FILES['userfile']['name'];
        $newName = time() . $this->input->post('hidden_artist_id') . substr(md5(mt_rand()), 0, 7) . "." . pathinfo($path, PATHINFO_EXTENSION);
        // rename for original image
        $neworiginName = time() . "_ORG_" . $this->input->post('hidden_artist_id') . substr(md5(mt_rand()), 0, 7) . "." . pathinfo($path, PATHINFO_EXTENSION);

        // Image upload config area:
        $config['upload_path'] = './uploads/artwork/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = $newName;
        $config['maintain_ratio'] = TRUE;

        // Initialize lib with config
        $this->load->library('upload', $config);

        // image upload method
        if (!$this->upload->do_upload('userfile')) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error_message','Failed to upload artwork '.$error);
            // Authentication Check
            $user_logged_in = profile_authentication_check();
            // Read All User Data
            $get_data ['table'] = "users";
            $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
            $data['all_data'] = $this->common_model->common_table_data_read($get_data);
            $data['users_info'] = $data['all_data']['data'][0];
            $data['users_data'] = $data['all_data']['data'][0];
            $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
            $data['title'] = "Artgoobi | User Profile";
            $data['active_menu'] = "gallery";
            $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
            $data['header'] = $this->load->view('layouts/header', $data, true);
            $data['profile_left_panel'] = $this->load->view('profile_left_panel', $data, true);
            $data['footer'] = $this->load->view('layouts/footer', '', true);
            if($type_name == 'Painting'){
                $data['art_form']      = $this->load->view('partial/forms/painting_form', $data, true);
            }
            if($type_name == 'Print'){
                $data['art_form']      = $this->load->view('partial/forms/print_form', $data, true);
            }
            if($type_name == 'Sclupture'){
                $data['art_form']      = $this->load->view('partial/forms/sculpture_form', $data, true);
            }
            if($type_name == 'Design'){
                $data['art_form']      = $this->load->view('partial/forms/design_form', $data, true);
            }
            if($type_name == 'Photography'){
                $data['art_form']      = $this->load->view('partial/forms/photography_form', $data, true);
            }
            if($type_name == 'Craft'){
                $data['art_form']      = $this->load->view('partial/forms/craft_form', $data, true);
            }
            if($type_name == 'Video'){
                $data['art_form']      = $this->load->view('partial/forms/video_form', $data, true);
            }
            if($type_name == 'Installation'){
                $data['art_form']      = $this->load->view('partial/forms/installation_form', $data, true);
            }
            if($type_name == 'Performance'){
                $data['art_form']      = $this->load->view('partial/forms/performance_form', $data, true);
            }
            if($type_name == 'Others'){
                $data['art_form']      = $this->load->view('partial/forms/others_form', $data, true);
            }
            $data['art_form_id'] = $rules_data['art_form_id'];
            $this->load->view('profile_image_upload', $data);
        } else {

            // Now give watermark to the image:
            $data = array('upload_data' => $this->upload->data());
            $image_data         = $data['upload_data'];
            $resizeImageInfo    =   $this->image_creation($image_data);
            
            //$this->resize_image($image_data);
            //$this->watermark_image($image_data);
            // if everything goes ok, then upload the original image:
            //move_uploaded_file($_FILES['userfile']['tmp_name'], $config['upload_path'] . $neworiginName);
            // Now prepared to insert data into artwork_info table:
            $artwork_data = [
                'artwork_owner'     => $this->input->post('artwork_owner'),
                'artist_id'         => $this->input->post('hidden_artist_id'),
                'artist_name'       => $this->input->post('arits_name'),
                'type_of_art_id'    => $this->input->post('type_of_art_id'),
                'type_of_child_id'  => $this->input->post('type_of_child_id'),
                'title'             => htmlentities($this->input->post('title')),
                'formate'           => $this->input->post('formate'),
                'video_format'      => $this->input->post('video_format'),
                'height'            => $this->input->post('height'),
                'width'             => $this->input->post('width'),
                'depth'             => $this->input->post('depth'),
                'unit_type'         => $this->input->post('unit_type'),
                'design_type'       => $this->input->post('design_type'),
                'tnop'              => $this->input->post('tnop'),
                'year'              => $this->input->post('year'),
                'video_link'        => $this->input->post('video_link'),
                'video_duration'    => $this->input->post('video_duration'),
                'short_description' => $this->input->post('short_description'),
                'photography_filter'=> $this->input->post('photography_filter'),
                'site_location'     => $this->input->post('site_location'),
                'support_elements'  => $this->input->post('support_elements'),
                'performance_duration'=> $this->input->post('performance_duration'),
                'not_for_sale'      => $this->input->post('not_for_sale'),
                'collector_name'    => $this->input->post('collector_name'),
                'price'             => $this->input->post('price'),
                'price_with_vat'    => (($this->input->post('price') * 85) / 100),
                'price_with_ser'    => 0,
                'image_original'    => $newName,
                'image_watermark'   => $neworiginName,
                'status'            => 0, // Pending
                'create_time'       => date("Y-m-d h:i:s", time())
            ];
            $insert_data['fields'] = $artwork_data;
            $insert_data['table'] = 'artwork_info';
            $user_insert_result = $this->common_model->common_table_data_insert($insert_data);
            // if success need to insert data into artwork_attrib table
            $artwork_attrib = [];
            if ($user_insert_result) {
                $appearence = $this->input->post('appearence');
                $frame_info = $this->input->post('frame');
                $genre_info = $this->input->post('genre');
                $color_info = $this->input->post('color');
                //appearence data
                if (isset($appearence) && !empty($appearence)) {
                    $artwork_attrib[] = [
                        'pro_id' => $user_insert_result,
                        'attrib_id' => 1,
                        'attrib_val_id' => $appearence,
                    ];
                }
                //appearence data
                if (isset($frame_info) && !empty($frame_info)) {
                    $artwork_attrib[] = [
                        'pro_id' => $user_insert_result,
                        'attrib_id' => 2,
                        'attrib_val_id' => $frame_info,
                    ];
                }
                //appearence data
                if (isset($genre_info) && !empty($genre_info)) {
                    $artwork_attrib[] = [
                        'pro_id' => $user_insert_result,
                        'attrib_id' => 3,
                        'attrib_val_id' => $genre_info,
                    ];
                }
                //appearence data
                if (isset($color_info) && !empty($color_info)) {
                    $artwork_attrib[] = [
                        'pro_id' => $user_insert_result,
                        'attrib_id' => 4,
                        'attrib_val_id' => $color_info,
                    ];
                }
                if(isset($artwork_attrib) && !empty($artwork_attrib)){                    
                    $this->db->insert_batch('artwork_attrib', $artwork_attrib);
                }                
            }
        $this->session->set_flashdata('success_message','Artwork have been successfully uploaded. Now, it is pending for admin approval. You can see the pending artwork in your profile');
        }
        $redirect_url = base_url() . "welcome/artist_image_upload";
        redirect($redirect_url);
        }
    }   
    public function file_selected_test(){

        $this->form_validation->set_message('file_selected_test', 'Please select file.');
        if (empty($_FILES['userfile']['name'])) {
                return false;
            }else{
                return true;
            }
    }
    public function image_creation($image){
        //let's have an array to return
        $new_images     = array();

        //some parameters
        $image_width    = 178;
        $image_height   = 178;
        $thumb_width    = 178;
        $thumb_height   = 178;
        $thumb_name     = '-thumb';
        // let's put the gallery images and thumbnails in a different directory (which will be public, of course... and writable)
        $gallery_path = FCPATH.'uploads/artwork/resize/';

        // PROCESS THE MAIN IMAGE

        // load the library
        $this->load->library('image_lib');
        // let's be prepared for any errors we may encounter
        $errors = array();
        // we set the image library that we want to be used
        $config['image_library'] = 'gd2';
        // we will take the source image from the $image array having the same source for the new image and the new thumbnail, we set the source here. of course you could use the new image as source for the thumbnail image, but after you've created the new image
        $config['source_image'] = $image['full_path'];
        // we set maintain_ratio to FALSE because we want do do a crop for the images
        $config['maintain_ratio'] = FALSE;


        //calculate the source image's ratio
        $source_ratio = $image['image_width'] / $image['image_height'];
        //calculate the ratio of the new image
        $new_ratio = $image_width / $image_height;
        //if the source image's ratio is not the same with the new image's ratio, then we do the cropping. else we just do a resize
        if($source_ratio!=$new_ratio)
        {
            // if the new image' ratio is bigger than the source image's ratio or the new image is a square and the source image's height is bigger than it's width, we will take source's width as the width of the image
            if($new_ratio > $source_ratio | (($new_ratio == 1) && ($source_ratio < 1)))
            {
                $config['width']    = $image['image_width'];
                $config['height']   = round($image['image_width']/$new_ratio);
                // now we will tell the library to crop from a certain y axis coordinate so that the new image is taken from the vertical center of the source image
                $config['y_axis']   = round(($image['image_height'] - $config['height'])/2);
                $config['x_axis']   = 0;
            }
            else
            {
                $config['width']    = round($image['image_height'] * $new_ratio);
                $config['height']   = $image['image_height'];
                // now we will tell the library to crop from a certain x axis coordinate so that the new image is taken from the horizontal center of the source image
                $size_config['x_axis'] = round(($image['image_width'] - $config['width'])/2);
                $size_config['y_axis'] = 0;
            }
        }

        // how will we name the image? and what if the image name already exists in the gallery?
        $image_path = $gallery_path.$image['file_name'];
        $thumb_path = $gallery_path.$image['raw_name'].$thumb_name.$image['file_ext'];
        $new_file   = $image['file_name'];
        $new_thumb  = $image['raw_name'].$thumb_name.$image['file_ext'];
        if(file_exists($image_path) | file_exists($thumb_path))
        {
            // we will give it 100 tries. if after 100 tries it can't find a suitable name, then the problem is your imagination in naming the files that you've uploaded
            for($i=1;$i<=100;$i++)
            {
                $new_file = $image['raw_name'].'-'.$i.$image['file_ext'];
                $new_thumb = $image['raw_name'].'-'.$i.$thumb_name.$image['file_ext'];
                if(!file_exists($new_file))
                {
                    $image_path = $gallery_path.$new_file;
                    $thumb_path = $gallery_path.$new_thumb;
                }
            }
        }
        $config['new_image'] = $image_path;
        // for cropping we want 100% image quality
        $config['quality'] = '100%';

        //now we initialize the library providing it with the configuration
        $this->image_lib->initialize($config);
        // doing the cropping
        if(!$this->image_lib->crop())
        {
            // if errors occured, we must see what those errors were
            $errors[] = $this->image_lib->display_errors();
        }

        //let's clear the setting because we will need the library again
        $this->image_lib->clear();

        $config['maintain_ratio']   = TRUE;
        $config['source_image']     = $image_path;
        $config['width']            = $image_width;
        $config['height']           = $image_height;
        //for resising we want 70% image quality
        $config['quality']          = '100%';
        $this->image_lib->initialize($config);
        if(!$this->image_lib->resize())
        {
            $errors[] = $this->image_lib->display_errors();
        }
        $this->image_lib->clear();

        $new_images['image'] = array('file_name'=>$new_file,'path'=>$config['new_image'],'errors'=>$errors);
        return $new_images;
    }
    public function artist_image_update_process($edit_id) {
        if (isset($_FILES['userfile']) && $_FILES['userfile']['size'] > 0) {
            $path = $_FILES['userfile']['name'];
            $newName = time() . $this->input->post('hidden_artist_id') . substr(md5(mt_rand()), 0, 7) . "." . pathinfo($path, PATHINFO_EXTENSION);
            // rename for original image
            $neworiginName = time() . "_ORG_" . $this->input->post('hidden_artist_id') . substr(md5(mt_rand()), 0, 7) . "." . pathinfo($path, PATHINFO_EXTENSION);

            // Image upload config area:
            $config['upload_path']      = './uploads/artwork/';
            $config['allowed_types']    = 'gif|jpg|png';
            $config['file_name']        = $newName;
            $config['maintain_ratio']   = TRUE;

            // Initialize lib with config
            $this->load->library('upload', $config);

            // image upload method
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
                print "<pre>";
                print_r($error);
                print "<pre>";
                exit;
            } else {

                // Now give watermark to the image:
                $data = array('upload_data' => $this->upload->data());
                $image_data = [
                    'up'                => $data['upload_data'],
                    'img_name'          => $newName,
                    'resize_path'       => './uploads/artwork/resize/' . $newName,
                    'watermark_path'    => './uploads/artwork/watermark/' . $newName
                ];
                $this->resize_image($image_data);
                $this->watermark_image($image_data);
                $img_data['image_original'] = $newName;
                $img_data['image_watermark'] = $neworiginName;
                // Read All artwork data
                $get_data = [];
                $get_data ['table'] = "artwork_info";
                $get_data ['where']['id= '] = $edit_id; // Exclude Super Admin;
                $data['all_data'] = $this->common_model->common_table_data_read($get_data);
                $data['artworks_data'] = $data['all_data']['data'][0];

                // delete the previous one
                if (isset($data['artworks_data']->image_original)) {
                    $org_img = base_url() . 'uploads/artwork/resize/' . $data['artworks_data']->image_original;
                    unlink($org_img);
                    $org_img = base_url() . 'uploads/artwork/watermark/' . $data['artworks_data']->image_original;
                    unlink($org_img);
                    $org_img = base_url() . 'uploads/artwork/' . $data['artworks_data']->image_original;
                    unlink($org_img);
                }

                $insert_data['fields'] = $img_data;
                $insert_data['table'] = 'artwork_info';
                $insert_data['where']['id'] = $edit_id;
                $user_insert_result = $this->common_model->common_table_data_update($insert_data);
                $insert_data = [];
            }
        }// End of image isset
        // Now prepared to update data into artwork_info table:
        $artwork_data = [
            'artwork_owner' => $this->input->post('artwork_owner'),
            'artist_id' => $this->input->post('hidden_artist_id'),
            'artist_name' => $this->input->post('arits_name'),
            'type_of_art_id' => $this->input->post('type_of_art_id'),
            'type_of_child_id' => $this->input->post('type_of_child_id'),
            'title' => $this->input->post('title'),
            'formate' => $this->input->post('formate'),
            'formate' => $this->input->post('formate'),
            'height' => $this->input->post('height'),
            'width' => $this->input->post('width'),
            'depth' => $this->input->post('depth'),
            'unit_type' => $this->input->post('unit_type'),
            'year' => $this->input->post('year'),
            'not_for_sale' => $this->input->post('not_for_sale'),
            'collector_name'    => $this->input->post('collector_name'),
            'price' => $this->input->post('price'),
            'status' => 0, // Pending
            'price_with_vat' => (($this->input->post('price') * 85) / 100),
            'price_with_ser' => 0,
            'update_time' => date("Y-m-d h:i:s", time())
        ];
        $insert_data['fields'] = $artwork_data;
        $insert_data['table'] = 'artwork_info';
        $insert_data['where']['id'] = $edit_id;
        print '<pre>';
        print_r($insert_data);
        print '</pre>';
        exit;
        
        $user_insert_result = $this->common_model->common_table_data_update($insert_data);
        // if success need to insert data into artwork_attrib table
        $artwork_attrib = [];
        if ($user_insert_result) {
            $appearence = $this->input->post('appearence');
            $frame_info = $this->input->post('frame');
            $genre_info = $this->input->post('genre');
            $color_info = $this->input->post('color');
            //appearence data
            $update_id = $edit_id;
            if (isset($appearence) && !empty($appearence)) {
                $artwork_attrib[] = [
                    'pro_id' => $update_id,
                    'attrib_id' => 1,
                    'attrib_val_id' => $appearence,
                ];
            }
            //appearence data
            if (isset($frame_info) && !empty($frame_info)) {
                $artwork_attrib[] = [
                    'pro_id' => $update_id,
                    'attrib_id' => 2,
                    'attrib_val_id' => $frame_info,
                ];
            }
            //appearence data
            if (isset($genre_info) && !empty($genre_info)) {
                $artwork_attrib[] = [
                    'pro_id' => $update_id,
                    'attrib_id' => 3,
                    'attrib_val_id' => $genre_info,
                ];
            }
            //appearence data
            if (isset($color_info) && !empty($color_info)) {
                $artwork_attrib[] = [
                    'pro_id' => $update_id,
                    'attrib_id' => 4,
                    'attrib_val_id' => $color_info,
                ];
            }
            $this->db->delete('artwork_attrib', array('pro_id' => $update_id));
            $this->db->insert_batch('artwork_attrib', $artwork_attrib);
        }
        $redirect_url = base_url() . "welcome/user_profile";
        redirect($redirect_url);
    }
    public function get_subtype_artwork() {
        $type_of_art                =   $this->input->post('id');
        $type_name                  =   get_artwork_attribute_name($type_of_art, 'artwork_type');
        $data['artwork_type_id']    =   $type_of_art;
        switch($type_name){
            case 'Painting':
                $artwork_form   =   $this->load->view('partial/forms/painting_form', $data, true);
                break;
            case 'Print':
                $artwork_form   =   $this->load->view('partial/forms/print_form', $data, true);
                break;
            case 'Sclupture':
                $artwork_form   =   $this->load->view('partial/forms/sculpture_form', $data, true);
                break;
            case 'Design':
                $artwork_form   =   $this->load->view('partial/forms/design_form', $data, true);
                break;
            case 'Photography':
                $artwork_form   =   $this->load->view('partial/forms/photography_form', $data, true);
                break;
            case 'Craft':
                $artwork_form   =   $this->load->view('partial/forms/craft_form', $data, true);
                break;
            case 'Video':
                $artwork_form   =   $this->load->view('partial/forms/video_form', $data, true);
                break;
            case 'Installation':
                $artwork_form   =   $this->load->view('partial/forms/installation_form', $data, true);
                break;
            case 'Performance':
                $artwork_form   =   $this->load->view('partial/forms/performance_form', $data, true);
                break;
            case 'Others':
                $artwork_form   =   $this->load->view('partial/forms/others_form', $data, true);
                break;
        }
        
        $feedback   =   [
            'status'    => 'success',
            'message'   => 'Data Form Found',
            'data'      => $artwork_form,
            'type_name'=> $type_name
        ];
        echo json_encode($feedback);
    }
    public function get_artwork_upload_rules($data){
        $type_of_art_id =   $data['type_of_art_id'];
        $type_name      =   get_artwork_attribute_name($type_of_art_id, 'artwork_type');
        
        $common_rules   =   [
            [
                'field' => 'artwork_owner',
                'label' => 'Artwork Owner',
                'rules' => 'required'
            ],
            [
                'field' => 'arits_name',
                'label' => 'Artist Name',
                'rules' => 'required'
            ],
            [
                'field' => 'type_of_art_id',
                'label' => 'Type of art',
                'rules' => 'required'
            ],
            [
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required'
            ]
        ];
        
        if($type_name == 'Painting'){
            $painting_rules = $this->get_painting_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Print'){
            $painting_rules = $this->get_print_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Sclupture'){
            $painting_rules = $this->get_sclupture_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Design'){
            $painting_rules = $this->get_design_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Photography'){
            $painting_rules = $this->get_photography_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Craft'){
            $painting_rules = $this->get_craft_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Video'){
            $painting_rules = $this->get_video_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Installation'){
            $painting_rules = $this->get_installation_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Performance'){
            $painting_rules = $this->get_performance_rules();
            foreach($painting_rules as $r){
                array_push($common_rules,$r);
            }
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
        if($type_name == 'Others'){
            $fdata['art_form_id']   = $type_of_art_id;
            $fdata['rules']         = $common_rules;
            $fdata['type_name']     = $type_name;
            return $fdata;
        }
    }
    // get painting rules:
    public function get_painting_rules(){
        $rules = [
            [
                    'field' => 'formate',
                    'label' => 'Media',
                    'rules' => 'required'
            ],
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'unit_type',
                    'label' => 'Unit',
                    'rules' => 'required'
            ],
            [
                    'field' => 'width',
                    'label' => 'Width',
                    'rules' => 'required'
            ],
            [
                    'field' => 'height',
                    'label' => 'Height',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    // get Print rules:
    public function get_print_rules(){
        $rules = [
            [
                    'field' => 'formate',
                    'label' => 'Media',
                    'rules' => 'required'
            ],
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'unit_type',
                    'label' => 'Unit',
                    'rules' => 'required'
            ],
            [
                    'field' => 'width',
                    'label' => 'Width',
                    'rules' => 'required'
            ],
            [
                    'field' => 'height',
                    'label' => 'Height',
                    'rules' => 'required'
            ],
            [
                    'field' => 'tnop',
                    'label' => 'Total Number Of Prints',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    // get Sclupture rules:
    public function get_sclupture_rules(){
        $rules = [
            [
                    'field' => 'formate',
                    'label' => 'Media',
                    'rules' => 'required'
            ],
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'width',
                    'label' => 'Width',
                    'rules' => 'required'
            ],
            [
                    'field' => 'height',
                    'label' => 'Height',
                    'rules' => 'required'
            ],
            [
                    'field' => 'depth',
                    'label' => 'Depth',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    // get Design rules:
    public function get_design_rules(){
        $rules = [
            [
                    'field' => 'design_type',
                    'label' => 'Type',
                    'rules' => 'required'
            ],
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    // get Photography rules:
    public function get_photography_rules(){
        $rules = [
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'width',
                    'label' => 'Width',
                    'rules' => 'required'
            ],
            [
                    'field' => 'height',
                    'label' => 'Height',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    // get Craft rules:
    public function get_craft_rules(){
        $rules = [
            [
                    'field' => 'formate',
                    'label' => 'Media',
                    'rules' => 'required'
            ],
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'unit_type',
                    'label' => 'Unit',
                    'rules' => 'required'
            ],
            [
                    'field' => 'width',
                    'label' => 'Width',
                    'rules' => 'required'
            ],
            [
                    'field' => 'height',
                    'label' => 'Height',
                    'rules' => 'required'
            ],
            [
                    'field' => 'depth',
                    'label' => 'Depth',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    // get Video rules:
    public function get_video_rules(){
        $rules = [
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'video_duration',
                    'label' => 'Video Duration',
                    'rules' => 'required'
            ],
            [
                    'field' => 'video_link',
                    'label' => 'Video Link',
                    'rules' => 'required'
            ],
            [
                    'field' => 'short_description',
                    'label' => 'Short Description',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    // get Installation rules:
    public function get_installation_rules(){
        $rules = [
            [
                    'field' => 'formate',
                    'label' => 'Media',
                    'rules' => 'required'
            ],
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'unit_type',
                    'label' => 'Unit',
                    'rules' => 'required'
            ],
            [
                    'field' => 'width',
                    'label' => 'Width',
                    'rules' => 'required'
            ],
            [
                    'field' => 'height',
                    'label' => 'Height',
                    'rules' => 'required'
            ],
            [
                    'field' => 'depth',
                    'label' => 'Depth',
                    'rules' => 'required'
            ],
            [
                    'field' => 'short_description',
                    'label' => 'Short Description',
                    'rules' => 'required'
            ],
        ];
        return $rules;
    }
    // get Performance rules:
    public function get_performance_rules(){
        $rules = [
            [
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ],
            [
                    'field' => 'performance_duration',
                    'label' => 'Performance Duration',
                    'rules' => 'required'
            ],
            [
                    'field' => 'short_description',
                    'label' => 'Short Description',
                    'rules' => 'required'
            ]
        ];
        return $rules;
    }
    public function artist_image_upload_edit($edit_id) {
        // Authentication Check
        $user_logged_in = profile_authentication_check();
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];

        // Read All artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['id= '] = $edit_id; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data'] = $data['all_data']['data'][0];

        $data['title'] = "Artgoobi | User Profile";
        $data['active_menu'] = "gallery";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $data['footer'] = $this->load->view('layouts/footer', '', true);
        $this->load->view('profile_image_upload_edit', $data);
    }

    public function delete_confirmation_modal() {
        $delete_modal = $this->load->view('delete_confirmation_modal', '', true);
        echo $delete_modal;
    }

    public function delete_confirmation_process() {
        $param['where'] = [
            'id' => $this->input->post('delete_id'),
        ];
        $param['table'] = $this->input->post('table');

        $response = $this->common_model->common_table_data_delete($param);
        if ($response) {
            $feedback_data = [
                'status' => 'success',
                'message' => 'Data have successfully deleted.',
            ];
        } else {
            $feedback_data = [
                'status' => 'error',
                'message' => 'Failed to delete.',
            ];
        }
        echo json_encode($feedback_data);
    }
    
    public function deleteDataByIdAndTable() {
        $param['where'] = [
            'id' => $this->input->post('id'),
        ];
        $redirect_url       = $this->input->post('redirect_url');;
        if(isset($redirect_url) && !empty($redirect_url)){
            $redirect_url   =   $redirect_url;
        }else{
            $redirect_url   =   base_url() . "welcome/user_profile";
        }
        $param['table']     = $this->input->post('table');
        $response           = $this->common_model->common_table_data_delete($param);
        if ($response) {
            $feedback_data  = [
                'status'        => 'success',
                'message'       => 'Data have successfully deleted.',
                'redirect_url'  => $redirect_url,
            ];
        } else {
            $feedback_data = [
                'status'    => 'error',
                'message'   => 'Failed to delete.',
            ];
        }
        echo json_encode($feedback_data);
    }

    public function artwork_details($artist_id, $artwork_id) {
        // Authentication Check
        //$user_logged_in = profile_authentication_check();
        $get_data ['table'] = "artwork_info";
        $data['active_menu'] = "gallery";
        $get_data ['where']['id'] = $artwork_id; // Exclude Super Admin;
        $artwork_data = $this->common_model->common_table_data_read($get_data);

        $get_data = [];
        $get_data ['table'] = "users";
        $get_data ['where']['id'] = $artist_id; // Exclude Super Admin;
        $users_data = $this->common_model->common_table_data_read($get_data);
//        $get_data = [];
//        $get_data ['table'] = "artwork_info";
//        $get_data ['where']['artist_id= '] = $artist_id; // Exclude Super Admin;
//        $get_data ['where']['id!= '] = $artwork_id; // Exclude Super Admin;
//        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $gallery_sql                    = "SELECT * FROM `artwork_info` WHERE status=1 AND artist_id=$artist_id ORDER BY create_time DESC";
        $query                          = $this->db->query($gallery_sql);
        $data['galleries']              = $query->result();
//        $data['galleries'] = $data['all_data']['data'];
        $data['artwork_data_details'] = (isset($data['all_data']['data'][0]) && !empty($data['all_data']['data'][0]) ? $data['all_data']['data'][0] : "");


        $data['users_info'] = $users_data['data'][0];
        $data['users_data'] = $users_data['data'][0];
        $data['artwork_data'] = $artwork_data['data'][0];
        $data['artworkImageInfo']   =   $this->get_artwork_image_details_page($data['artwork_data']);
        $get_data   =   [];
        $get_data ['table'] = "post_data";
        $get_data ['where']['post_type'] = 3;
        $get_data ['where']['created_by'] = $artist_id;
        $event_data = $this->common_model->common_table_data_read($get_data);
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($artist_id);

        $data['artist_id']  = $artist_id;
        $data['artwork_id'] = $artwork_id;
        $data['isShared'] = true;
        $data['title'] = "Artgoobi | Artwork Details";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $this->load->view('artwork_details', $data);

    }
    public function artwork_details_modify($artist_id, $artwork_id) {
        // Authentication Check
        $user_logged_in = profile_authentication_check();
        $get_data ['table'] = "artwork_info";
        $data['active_menu'] = "gallery";
        $get_data ['where']['id'] = $artwork_id; // Exclude Super Admin;
        $artwork_data = $this->common_model->common_table_data_read($get_data);
        $get_data = [];
        $get_data ['table'] = "users";
        $get_data ['where']['id'] = $artist_id; // Exclude Super Admin;
        $users_data = $this->common_model->common_table_data_read($get_data);
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['artist_id= '] = $artist_id; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['galleries'] = $data['all_data']['data'];
        $data['artwork_data_details'] = $data['all_data']['data'][0];


        $data['users_info'] = $users_data['data'][0];
        $data['users_data'] = $users_data['data'][0];
        $data['artwork_data'] = $artwork_data['data'][0];
        $data['art_form']   =   get_artwork_edit_form($data['artwork_data']);
        $get_data   =   [];
        $get_data ['table'] = "post_data";
        $get_data ['where']['post_type'] = 3;
        $get_data ['where']['created_by'] = $artist_id;
        $event_data = $this->common_model->common_table_data_read($get_data);
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($artist_id);

        $data['title'] = "Artgoobi | Artwork Details";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $this->load->view('artwork_details_modify', $data);

    }
    public function get_artwork_image_details_page($artworkData){
        $type_of_art                =   $artworkData->type_of_art_id;
        $type_name                  =   get_artwork_attribute_name($type_of_art, 'artwork_type');
        $data['artwork_type_id']    =   $type_of_art;
        $data['artwork_data']       =   $artworkData;
        switch($type_name){
            case 'Painting':
                $artwork_form   =   $this->load->view('partial/artwork_info/painting_info', $data, true);
                break;
            case 'Print':
                $artwork_form   =   $this->load->view('partial/artwork_info/print_info', $data, true);
                break;
            case 'Sclupture':
                $artwork_form   =   $this->load->view('partial/artwork_info/sculpture_info', $data, true);
                break;
            case 'Design':
                $artwork_form   =   $this->load->view('partial/artwork_info/design_info', $data, true);
                break;
            case 'Photography':
                $artwork_form   =   $this->load->view('partial/artwork_info/photography_info', $data, true);
                break;
            case 'Craft':
                $artwork_form   =   $this->load->view('partial/artwork_info/craft_info', $data, true);
                break;
            case 'Video':
                $artwork_form   =   $this->load->view('partial/artwork_info/video_info', $data, true);
                break;
            case 'Installation':
                $artwork_form   =   $this->load->view('partial/artwork_info/installation_info', $data, true);
                break;
            case 'Performance':
                $artwork_form   =   $this->load->view('partial/artwork_info/performance_info', $data, true);
                break;
            case 'Others':
                $artwork_form   =   $this->load->view('partial/artwork_info/others_info', $data, true);
                break;
        }
        
        $feedback   =   [
            'status'    => 'success',
            'message'   => 'Data Form Found',
            'data'      => $artwork_form,
            'type_name'=> $type_name
        ];
        return $artwork_form;
    }
    public function artist_artwork_modify_process() { 
        $artwork_id   = $this->input->post('artwork_edit_id');
        $all    =   $this->input->post();
        $nfs    =   $this->input->post('not_for_sale');
        $this->load->library('form_validation'); 
        $get_rules_data['type_of_art_id']    =   $this->input->post('type_of_art_id');
        $rules_data     =   $this->get_artwork_upload_rules($get_rules_data);
        $common_rules   =   $rules_data['rules'];      
        $type_name      =   $rules_data['type_name'];  
        $artworkStatus  =   $this->input->post('artwork_status');
        $this->form_validation->set_rules($common_rules);
        if(!$nfs){
            $this->form_validation->set_rules('price', '', 'required|greater_than[0]');
        }
        //$this->form_validation->set_rules('userfile', 'artwork', 'callback_file_selected_test');
        if ($this->form_validation->run() == FALSE) {
            //$error  =   validation_errors();
            $this->session->set_flashdata('error_message','Failed to upload artwork. Please fix the following issue.');
            // Authentication Check
            $user_logged_in = profile_authentication_check();
            // Read All User Data
            $get_data ['table']                 = "users";
            $get_data ['where']['id= ']         = $user_logged_in; // Exclude Super Admin;
            $data['all_data']                   = $this->common_model->common_table_data_read($get_data);
            $get_data                 = [];
            $get_data ['table']                 = "artwork_info";
            $get_data ['where']['id'] = $artwork_id; // Exclude Super Admin;
            $artwork_data = $this->common_model->common_table_data_read($get_data);
            $data['artwork_data'] = $artwork_data['data'][0];
            $data['artwork_type_id'] = $this->input->post('type_of_art_id');
            $data['users_info']                 = $data['all_data']['data'][0];
            $data['users_data']                 = $data['all_data']['data'][0];
            $data['userProfileDetailsData']     =   userProfileDetailsdataByUserId($user_logged_in);
            $data['title']                      = "Artgoobi | User Profile";
            $data['active_menu']                = "gallery";
            $data['top_menu']                   = $this->load->view('layouts/top_menu', $data, true);
            $data['header']                     = $this->load->view('layouts/header', $data, true);
            $data['profile_left_panel']         = $this->load->view('profile_left_panel', $data, true);
            $data['footer'] = $this->load->view('layouts/footer', '', true);
            if($type_name == 'Painting'){
                $data['art_form']      = $this->load->view('partial/forms/painting_form_edit', $data, true);
            }
            if($type_name == 'Print'){
                $data['art_form']      = $this->load->view('partial/forms/print_form_edit', $data, true);
            }
            if($type_name == 'Sclupture'){
                $data['art_form']      = $this->load->view('partial/forms/sculpture_form_edit', $data, true);
            }
            if($type_name == 'Design'){
                $data['art_form']      = $this->load->view('partial/forms/design_form_edit', $data, true);
            }
            if($type_name == 'Photography'){
                $data['art_form']      = $this->load->view('partial/forms/photography_form_edit', $data, true);
            }
            if($type_name == 'Craft'){
                $data['art_form']      = $this->load->view('partial/forms/craft_form_edit', $data, true);
            }
            if($type_name == 'Video'){
                $data['art_form']      = $this->load->view('partial/forms/video_form_edit', $data, true);
            }
            if($type_name == 'Installation'){
                $data['art_form']      = $this->load->view('partial/forms/installation_form_edit', $data, true);
            }
            if($type_name == 'Performance'){
                $data['art_form']      = $this->load->view('partial/forms/performance_form_edit', $data, true);
            }
            if($type_name == 'Others'){
                $data['art_form']      = $this->load->view('partial/forms/others_form_edit', $data, true);
            }
            $data['art_form_id'] = $rules_data['art_form_id'];
            $this->load->view('artwork_details_modify', $data);
            
        }else{
           /**
         * Image upload & watermark area
         */
        // rename for watermark image
        if (isset($_FILES['userfile']['size']) && $_FILES['userfile']['size'] > 0) {
                $path = $_FILES['userfile']['name'];
                $newName = time() . $this->input->post('hidden_artist_id') . substr(md5(mt_rand()), 0, 7) . "." . pathinfo($path, PATHINFO_EXTENSION);
                // rename for original image
                $neworiginName = time() . "_ORG_" . $this->input->post('hidden_artist_id') . substr(md5(mt_rand()), 0, 7) . "." . pathinfo($path, PATHINFO_EXTENSION);

                // Image upload config area:
                $config['upload_path'] = './uploads/artwork/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = $newName;
                $config['maintain_ratio'] = TRUE;

                // Initialize lib with config
                $this->load->library('upload', $config);

                // image upload method
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('error' => $this->upload->display_errors());
                    print "<pre>";
                    print_r($error);
                    print "<pre>";
                    exit;
                } else {
                    $artworkStatus  =   0;// status change to default pending;
                    // Now give watermark to the image:
                    $data = array('upload_data' => $this->upload->data());
                    $image_data = $data['upload_data'];
                    $resizeImageInfo = $this->image_creation($image_data);
                }
            }
            //$this->resize_image($image_data);
            //$this->watermark_image($image_data);
            // if everything goes ok, then upload the original image:
            //move_uploaded_file($_FILES['userfile']['tmp_name'], $config['upload_path'] . $neworiginName);
            // Now prepared to insert data into artwork_info table:
            $artwork_data = [
                'artwork_owner'     => $this->input->post('artwork_owner'),
                'artist_id'         => $this->input->post('hidden_artist_id'),
                'artist_name'       => $this->input->post('arits_name'),
                'type_of_art_id'    => $this->input->post('type_of_art_id'),
                'type_of_child_id'  => $this->input->post('type_of_child_id'),
                'title'             => htmlentities($this->input->post('title')),
                'formate'           => $this->input->post('formate'),
                'video_format'      => $this->input->post('video_format'),
                'height'            => $this->input->post('height'),
                'width'             => $this->input->post('width'),
                'depth'             => $this->input->post('depth'),
                'unit_type'         => $this->input->post('unit_type'),
                'design_type'       => $this->input->post('design_type'),
                'tnop'              => $this->input->post('tnop'),
                'year'              => $this->input->post('year'),
                'video_link'        => $this->input->post('video_link'),
                'video_duration'    => $this->input->post('video_duration'),
                'short_description' => $this->input->post('short_description'),
                'photography_filter'=> $this->input->post('photography_filter'),
                'site_location'     => $this->input->post('site_location'),
                'support_elements'  => $this->input->post('support_elements'),
                'performance_duration'=> $this->input->post('performance_duration'),
                'not_for_sale'      => $this->input->post('not_for_sale'),
                'collector_name'    => $this->input->post('collector_name'),
                'price'             => $this->input->post('price'),
                'price_with_vat'    => (($this->input->post('price') * 85) / 100),
                'price_with_ser'    => 0,
                'image_original'    => ((isset($newName) && !empty($newName)) ? $newName : $this->input->post('image_original')),
                'status'            => $artworkStatus, // artwork_status
                'update_time'       => date("Y-m-d h:i:s", time())
            ];
            $update_data['where']['id'] = $this->input->post('artwork_edit_id');//artwork_edit_id
            $update_data['fields'] = $artwork_data;
            $update_data['table'] = 'artwork_info';
            $update_result = $this->common_model->common_table_data_update($update_data);
        $this->session->set_flashdata('success_message','Artwork have been successfully updated.');
        $redirect_url = base_url() . "welcome/artwork_details_modify/".$this->input->post('hidden_artist_id').'/'.$this->input->post('artwork_edit_id');
        redirect($redirect_url);
        }
    }
    public function resize_image($param) {
        $config = [];
        $config['source_image'] = $param['up']['full_path']; //get original image
        $config['maintain_ratio'] = TRUE;
        $config['height'] = 250;
//        $config['thumb_marker'] = '_thumb';
        $config['new_image'] = $param['resize_path'];
        $this->load->library('image_lib', $config);
        if (!$this->image_lib->resize()) {
            $this->handle_error($this->image_lib->display_errors());
        }

        //Clear image library settings so we can do some more image 
        //manipulations if we have to
        $this->image_lib->clear();
        unset($config);
    }
    public function watermark_image($param) {
        $config = [];
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $param['resize_path'];
        $config['wm_text'] = 'Copyright ' . date('Y') . ' - ARTGOOBI';
        $config['wm_type'] = 'text';
        $config['wm_font_path'] = './system/fonts/texb.ttf';
        $config['wm_font_size'] = '8';
        $config['wm_font_color'] = 'ffffff';
        $config['wm_vrt_alignment'] = 'middle';
        $config['wm_hor_alignment'] = 'center';
        $config['wm_padding'] = '2';
        $config['new_image'] = $param['watermark_path'];

        $this->image_lib->initialize($config);

        $this->image_lib->watermark();
        $this->load->library('image_lib', $config);
        if (!$this->image_lib->watermark()) {
            //here we need to unlink the uploaded image
            // Show the proper error message
            $this->handle_error($this->image_lib->display_errors());
        }

        //Clear image library settings so we can do some more image 
        //manipulations if we have to
        $this->image_lib->clear();
        unset($config);
    }
    public function save_user_profile_education_history() {
        $user_id = $this->session->userdata('user_logged_id');
        $work_update_id = $this->input->post('work_update_id');
        if (!isset($work_update_id) && empty($work_update_id)) {
            // Insert artist work history data

            $works_data = [
                'institution' => $this->input->post('institution'),
                'concentrations' => $this->input->post('concentrations'),
                'attend_for' => $this->input->post('attend_for'),
                'obtain' => $this->input->post('obtain'),
                'description' => $this->input->post('description'),
            ];
            $users_data = [
                'type_id' => 2,
                'details' => json_encode($works_data),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id,
                'user_id' => $user_id,
            ];
            $insert_data['fields'] = $users_data;
            $insert_data['table'] = 'users_profile_details';
            $insert_id = $this->common_model->common_table_data_insert($insert_data);

            // Read Last inserted Data
            $get_data ['table'] = "users_profile_details";
            $get_data ['where']['id'] = $insert_id; // Exclude Super Admin;
            $last_data = $this->common_model->common_table_data_read($get_data);
            $details = json_decode($last_data['data'][0]->details);
            $det_id = $last_data['data'][0]->id;
            $new_insert = '';
            $new_insert .= '<div class="educauion_details_area" id="educauion_details_area_' . $det_id . '">';
            $new_insert .= '<h3>' . $details->attend_for . '</h3>';
            $new_insert .= '<p>';
            $new_insert .= '<span class="work_position">' . $details->obtain . '</span>,';
            $new_insert .= '<span class="work_location">' . $details->institution . '</span>';
            $new_insert .= '</p>';
            $new_insert .= "<a href='#' onclick='editEducationDetails(" . $det_id . ");'><span class='glyphicon glyphicon-pencil'></span> Edit</a>";
            $new_insert .= "<a href='#' onclick='deleteWorkPlace(" . $det_id . ");'><span class='glyphicon glyphicon-remove'></span> Delete</a>";
            $new_insert .= '</div>';
            $new_insert .= '<span id="work_update_form_area_' . $det_id . '"></span>';

            $feedack = [
                "status" => 'success',
                'message' => 'Successfully saved',
                'data' => $new_insert,
            ];
            echo json_encode($feedack);
        } else {
            $works_data = [
                'institution' => $this->input->post('institution_update'),
                'concentrations' => $this->input->post('concentrations_update'),
                'attend_for' => $this->input->post('attend_for_update'),
                'obtain' => $this->input->post('obtain_update'),
                'description' => $this->input->post('description_update'),
            ];
            $users_data = [
                'details' => json_encode($works_data),
                'updated_time' => date('Y-m-d H:i:s'),
                'updated_by' => $user_id
            ];
            $update_data['where']['id'] = $work_update_id;
            $update_data['fields'] = $users_data;
            $update_data['table'] = 'users_profile_details';
            $update_result = $this->common_model->common_table_data_update($update_data);
            // Read Last inserted Data
            $get_data ['table'] = "users_profile_details";
            $get_data ['where']['id'] = $work_update_id; // Exclude Super Admin;
            $last_data = $this->common_model->common_table_data_read($get_data);
            $details = json_decode($last_data['data'][0]->details);
            $det_id = $last_data['data'][0]->id;
            $new_insert = '';
            $new_insert .= '<h3>' . $details->attend_for . '</h3>';
            $new_insert .= '<p>';
            $new_insert .= '<span class="work_position">' . $details->obtain . '</span>,';
            $new_insert .= '<span class="work_location">' . $details->institution . '</span>';
            $new_insert .= '</p>';
            $new_insert .= "<a href='#' onclick='editEducationDetails(" . $det_id . ");'><span class='glyphicon glyphicon-pencil'></span> Edit</a>";
            $new_insert .= "<a href='#' onclick='deleteWorkPlace(" . $det_id . ");'><span class='glyphicon glyphicon-remove'></span> Delete</a>";
            $feedack = [
                "status" => 'success',
                'message' => 'Successfully Updated',
                'data' => $new_insert,
            ];
            echo json_encode($feedack);
        }
    }    
    public function get_education_update_form() {
        // Read Data
        $get_data ['table'] = "users_profile_details";
        $get_data ['where']['id'] = $this->input->post('id');
        $last_data = $this->common_model->common_table_data_read($get_data);
        $data['work_data'] = $last_data['data'][0];
        $data['details'] = json_decode($last_data['data'][0]->details);
        $update_form = $this->load->view('user_profile_education_update_form', $data, true);
        $feedack = [
            'status' => 'success',
            'message' => 'Successfully get data',
            'data' => $update_form,
        ];
        echo json_encode($feedack);
    }    
    public function user_profile_work_experience($artist_id){
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        // Read All artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['artist_id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data'] = $data['all_data']['data'];
        $data['artwork_data'] = $data['all_data']['data'][0];
        $data['title'] = "Artgoobi | User Profile";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        
        // Read Last inserted Data
        $get_data   =   [];
        $get_data ['table'] = "users_profile_details";
        $get_data ['where']['type_id'] = 3; // Exclude Super Admin;
        $get_data ['where']['user_id'] = $artist_id; // Exclude Super Admin;
        $last_data = $this->common_model->common_table_data_read($get_data);
        if(isset($last_data['status']) && $last_data['status']=='success'){
            $data['experience_details'] =   $last_data['data'][0]->details;
        }
        $this->load->view('user_profile_work_experience', $data);
    }    
    public function save_user_profile_work_experience(){
        $users_data = [
            'type_id' => 3,
            'details' => $this->input->post('description'),
            'updated_time' => date('Y-m-d H:i:s'),
            'updated_by' => $this->input->post('user_id'),
            'user_id' => $this->input->post('user_id'),
        ];
        // Read Last inserted Data
        $get_data ['table'] = "users_profile_details";
        $get_data ['where']['type_id'] = 3; // Exclude Super Admin;
        $get_data ['where']['user_id'] = $this->input->post('user_id'); // Exclude Super Admin;
        $last_data = $this->common_model->common_table_data_read($get_data);
        if(isset($last_data['status']) && $last_data['status']=='error'){            
            $insert_data['fields'] = $users_data;
            $insert_data['table'] = 'users_profile_details';
            $insert_id = $this->common_model->common_table_data_insert($insert_data);
        }else{
            $edit_id    =   $last_data['data'][0]->id;
            $insert_data['fields'] = $users_data;
            $insert_data['table'] = 'users_profile_details';
            $insert_data['where']['id'] = $edit_id;
            $user_insert_result = $this->common_model->common_table_data_update($insert_data);
        }
        
        $redirect_url = base_url() . "welcome/user_profile_work_experience/".$this->input->post('user_id');
        redirect($redirect_url);
        
    } 
        
    // exhibition details area
    public function exhibition_details($exhibition_id){
        
        $get_data ['table'] = "post_data";
        $get_data ['where']['id'] = $exhibition_id; // Exclude Super Admin;
        $artwork_data = $this->common_model->common_table_data_read($get_data);
        $data['exhibition'] =   $artwork_data['data'][0];
        
        // Post related image: 
        $get_data                   =   [];
        $get_data ['table']         =   "post_data_details";
        $get_data ['where']['post_id']   =   $data['exhibition']->id; // exhibition Data;
        $post_detail_data                  =   $this->common_model->common_table_data_read($get_data);
        $data['post_details_data']          =   $post_detail_data['data'];
        
        
        $data['active_menu'] = "exhibition";
        $data['title'] = "Artgoobi | Artwork Details";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $this->load->view('exhibition_details', $data);
    }
        
    public function gallery_details($gallery_id){
        $gallery_array  =   [];
        $get_data ['table'] = "post_data";
        $get_data ['where']['id'] = $gallery_id;
        $artwork_data = $this->common_model->common_table_data_read($get_data);
        foreach($artwork_data['data'] as $gallery){
            $get_data   =   [];
            $get_data ['table'] = "post_data_details";
            $get_data ['where']['post_id'] = $gallery->id;
            $gallery_other_data = $this->common_model->common_table_data_read($get_data);
            if(isset($gallery_other_data['data']) && !empty($gallery_other_data['data'])){
                $gallery_array    =   [
                    'gallery'   =>  $gallery,
                    'gallery_data'   =>  $gallery_other_data['data'],
                ];
                
            }            
        }
        $data['galleries'] =   $gallery_array;
        $data['title'] = "Artgoobi | Artwork Details";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $this->load->view('gallery/gallery_details', $data);
    }    
    // event details area
    public function event_details($event_id){
        
        $get_data ['table'] = "post_data";
        $get_data ['where']['id'] = $event_id; // Exclude Super Admin;
        $artwork_data = $this->common_model->common_table_data_read($get_data);
        $data['event'] =   $artwork_data['data'][0];
        $data['active_menu'] = "event";
        $data['title'] = "Artgoobi | Artwork Details";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $this->load->view('event_details', $data);
    }    
        
    public function user_event_list($artist_id = null){
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        
        $get_data   =   [];
        $get_data ['table'] = "post_data";
        $get_data ['where']['post_type'] = 3;
        $get_data ['where']['created_by'] = $user_logged_in;
        $event_data = $this->common_model->common_table_data_read($get_data);
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
        $data['events'] =   $event_data['data'];
        $data['title'] = "Artgoobi | User Events";
        $data['active_menu'] = "gallery";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $this->load->view('user_event_list', $data);
    }    
    public function edit_user_event_data($event_id){
        // Read Data
        $get_data ['table']         = "post_data";
        $get_data ['where']['id']   = $event_id;
        $event_data                 = $this->common_model->common_table_data_read($get_data, '', true);
        $data['post_data']          = $event_data['data'];
        
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // Read All User Data
        $get_data = [];
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
        $data['events'] =   $event_data['data'];
        $data['title'] = "Artgoobi | User Events";
        $data['active_menu'] = "gallery";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $this->load->view('user_event_edit_view', $data);
    }    
    public function user_event_create($artist_id = null){
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
        $data['title'] = "Artgoobi | User Events Create";
        $data['active_menu'] = "gallery";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $this->load->view('user_event_create', $data);
    }
    public function process_event() {
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // load form validation
        $this->load->library('form_validation');
        // check validation
        $this->form_validation->set_rules('post_category', 'Event Type', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('post_time', 'Time', 'required');
        $this->form_validation->set_rules('venue_name', 'Venue Name', 'required');
        $this->form_validation->set_rules('descriptions', 'Descriptions', 'required');
//        if ($_FILES['featured_image']['size'] > 0) {
//            $this->form_validation->set_rules('featured_image', 'featured_image', 'callback_file_selected_test');
//        }

        if ($this->form_validation->run() == FALSE) { 
            // Read All User Data
            $get_data ['table'] = "users";
            $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
            $data['all_data'] = $this->common_model->common_table_data_read($get_data);
            $data['users_info'] = $data['all_data']['data'][0];
            $data['users_data'] = $data['all_data']['data'][0];
            $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
            $data['title'] = "Artgoobi | User Events Create";
            $data['active_menu'] = "gallery";
            $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
            $data['header'] = $this->load->view('layouts/header', $data, true);
            $data['footer'] = $this->load->view('layouts/footer', $data, true);
            $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
            $this->load->view('user_event_create', $data);
        } else {
            // try to make data for insert into post data table
            $start_date_string     = explode('/', $this->input->post("start_date"));
            $end_date_string       = explode('/', $this->input->post("end_date"));
            $post_data = [
                'post_type'     => 3, // 1=means Events
                'post_category' => $this->input->post("post_category"),
                'title'         => $this->input->post("title"),
                'descriptions'  => $this->input->post("descriptions"),
                'start_date'    => $start_date_string[2].'-'.$start_date_string[1].'-'.$start_date_string[0],
                'end_date'      => $end_date_string[2].'-'.$end_date_string[1].'-'.$end_date_string[0],
                'post_time'     => $this->input->post("post_time"),
                'venue_name'    => $this->input->post("venue_name"),
                'created_by'    => $user_logged_in,
                'status'        => 1,
            ];
            // try to check featured image is comming
            if ($_FILES['featured_image']['size'] > 0) {
                list($width, $height, $type, $attr) = getimagesize($_FILES['featured_image']['tmp_name']); 
                $image_upload_process_param = [
                    'file_name'                 => 'featured_image',
                    'file_data'                 => $_FILES['featured_image'],
                    'image_resize'              => true,
                    'image_resize_sizes'        => ['500,300'],
                    'maintain_ratio'            => true,
                    'resize_image_store_path'   => "./images/exhibition/resize_images/",
                    'image_store_path'          => "./images/exhibition/",
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
            $this->session->set_flashdata('success', 'Event has been added successfully');
            $redirect_url   =   "welcome/user_event_create";
            redirect($redirect_url);
            
        }// end of form validation success
    }
    public function process_update_event(){
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // load form validation
        $this->load->library('form_validation');
        // check validation
        $this->form_validation->set_rules('post_category', 'Event Type', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        $this->form_validation->set_rules('post_time', 'Time', 'required');
        $this->form_validation->set_rules('venue_name', 'Venue Name', 'required');
        $this->form_validation->set_rules('descriptions', 'Descriptions', 'required');
        if ($this->form_validation->run() == FALSE) {
            $get_data ['table']         = "post_data";
            $get_data ['where']['id']   = $this->input->post('event_edit_id');
            $event_data                 = $this->common_model->common_table_data_read($get_data, '', true);
            $data['post_data']          = $event_data['data'];
            // Read All User Data
            $get_data = [];
            $get_data ['table'] = "users";
            $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
            $data['all_data'] = $this->common_model->common_table_data_read($get_data);
            $data['users_info'] = $data['all_data']['data'][0];
            $data['users_data'] = $data['all_data']['data'][0];

            $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
            $data['events'] =   $event_data['data'];
            $data['title'] = "Artgoobi | User Events";
            $data['active_menu'] = "gallery";
            $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
            $data['header'] = $this->load->view('layouts/header', $data, true);
            $data['footer'] = $this->load->view('layouts/footer', $data, true);
            $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
            $this->load->view('user_event_edit_view', $data);
        } else {
            $start_date_string     = explode('/', $this->input->post("start_date"));
            $end_date_string       = explode('/', $this->input->post("end_date"));
            $post_data = [
                'post_type'     => 3, // 1=means Events
                'post_category' => $this->input->post("post_category"),
                'title'         => $this->input->post("title"),
                'descriptions'  => $this->input->post("descriptions"),
                'start_date'    => $start_date_string[2].'-'.$start_date_string[1].'-'.$start_date_string[0],
                'end_date'      => $end_date_string[2].'-'.$end_date_string[1].'-'.$end_date_string[0],
                'post_time'     => $this->input->post("post_time"),
                'venue_name'    => $this->input->post("venue_name"),
                'created_by'    => $user_logged_in,
                'status'        => 1,
            ];
            
            // try to check featured image is comming
            if ($_FILES['featured_image']['size'] > 0) {
                $image_upload_process_param = [
                    'file_name'                 => 'featured_image',
                    'file_data'                 => $_FILES['featured_image'],
                    'image_resize'              => true,
                    'image_resize_sizes'        => ['500,300'],
                    'maintain_ratio'            => true,
                    'resize_image_store_path'   => "./images/exhibition/resize_images/",
                    'image_store_path'          => "./images/exhibition/",
                ];
                $image_response                  = $this->image_uploader($image_upload_process_param);
                if($image_response['status']    ==  'success'){
                    $update_data['fetured_image_path'] = $image_response['data']['upload_data']['file_name'];
                }
            }
            
            $update_data['where']['id']         = $this->input->post('event_edit_id');
            $update_data['fields']              = $post_data;
            $update_data['table']               = 'post_data';
            $update_result                      = $this->common_model->common_table_data_update($update_data);
            if($update_result){                
                $this->session->set_flashdata('success', 'Event has been updated successfully');
                $redirect_url   =   "welcome/user_event_list/";
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
        //$this->upload->initialize($config);
        $this->load->library('upload', $config);

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
                        'source_image'  =>  $param['image_store_path'].$newName,
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
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        if (!$this->image_lib->resize()) {
            print_r($this->image_lib->display_errors());
        }

        //Clear image library settings so we can do some more image 
        //manipulations if we have to
        $this->image_lib->clear();
        unset($config);
    }    
    public function user_profile_image_upload($artist_id = null) {
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url() . 'welcome/';
                redirect($red_url);
            }
        }
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['users_info'] = $data['all_data']['data'][0];
        $data['users_data'] = $data['all_data']['data'][0];
        // Read All artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['artist_id= '] = $user_logged_in; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data'] = $data['all_data']['data'];
        $data['artwork_data'] = isset($data['all_data']['data'][0])?$data['all_data']['data'][0]:'';
        $data['title'] = "Artgoobi | User Profile";
        $data['active_menu'] = "gallery";
        
        // get user details data
        $data['userProfileDetailsData']   =   userProfileDetailsdataByUserId($user_logged_in);
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        $data['profile_left_panel'] = $this->load->view('profile_left_panel', '', true);
        $this->load->view('user_profile_image_upload', $data);
    }
    public function user_profile_image_upload_process() {

        // try to check featured image is comming
        if ($_FILES['user_profile_image']['size'] > 0) {
            $image_upload_process_param = [
                'file_name'               => 'user_profile_image',
                'file_data'               => $_FILES['user_profile_image'],
                'image_resize'            => true,
                'image_resize_sizes'      => ['500,300'],
                'maintain_ratio'          => true,
                'resize_image_store_path' => "./images/profile/resize_image/",
                'image_store_path'        => "./images/profile/",
            ];
            $image_response = $this->image_uploader($image_upload_process_param);
            if($image_response['status']    ==  'success'){
                $post_data['profile_image'] = $image_response['data']['upload_data']['file_name'];
            }
            
            $update_data['where']['user_id'] = $this->input->post('user_profile_id');
            $update_data['fields'] = $post_data;
            $update_data['table'] = 'users_details';
            $update_result = $this->common_model->common_table_data_update($update_data);
            $this->session->set_flashdata('success_message', 'Profile Image has been updated successfully');
            $redirect_url   =   "welcome/user_profile_image_upload/";
            redirect($redirect_url);
        }else{
            $this->session->set_flashdata('error_message', 'Please select a file!');
            $redirect_url   =   "welcome/user_profile_image_upload/";
            redirect($redirect_url);
        }
    }
    public function get_artwork_search_result(){
        $artworkinfo   =  '';
        $feedback   =  '';
        $status     =  'error';
        $message    =  'Did not found any artwork';
        $searchItem =   $this->input->post('search_string');
        $searchData     =   select_data_by_search($searchItem);
        if(isset($searchData) && !empty($searchData)){
            $data['galleries']   =   $searchData;
            $artworkinfo = $this->load->view('artworks/art_gallery', $data, true);
            $status     =  'success';
            $message    =  'Artwork found';
        }
        $feedback   =   [
            'status'    => $status,
            'message'   => $message,
            'data'      => $artworkinfo
        ];
        echo json_encode($feedback);
    }
    
    public function get_artwork_advance_search_result(){
        $artworkinfo=  '';
        $feedback   =  '';
        $status     =  'error';
        $message    =  'Did not found any artwork';
        $searchParam['artist_id']      =   $this->input->post('artist_id');
        $searchParam['type']           =   $this->input->post('type');
        $searchParam['media']          =   $this->input->post('media');
        $searchParam['size_start']     =   $this->input->post('size_start');
        $searchParam['size_end']       =   $this->input->post('size_end');
        $searchParam['price_start']    =   $this->input->post('price_start');
        $searchParam['price_end']      =   $this->input->post('price_end');
        $searchParam['year_start']     =   $this->input->post('year_start');
        $searchParam['year_end']       =   $this->input->post('year_end');
        $searchData                    =   select_data_by_advance_search($searchParam);
        if(isset($searchData) && !empty($searchData)){
            $data['galleries']   = $searchData;
            $artworkinfo         = $this->load->view('artworks/art_gallery', $data, true);
            $status              = 'success';
            $message             = 'Artwork found';
        }
        $feedback   =   [
            'status'    => $status,
            'message'   => $message,
            'data'      => $artworkinfo
        ];
        echo json_encode($feedback);
    }
    
    public function get_type_wise_media(){
        $type_id    =   $this->input->post('type_id');
        // Read All User Data
        $get_data ['table'] = "artwork_media";
        $get_data ['where']['artwork_type_id= '] = $type_id; // Exclude Super Admin;
        $mediaData          = $this->common_model->common_table_data_read($get_data);
        $data['mediaData']  =   $mediaData['data'];
        $mediainfo        = $this->load->view('partial/type_wise_media_data', $data, true);
        $feedback   =   [
            'status'    => 'success',
            'message'   => 'Data found',
            'data'      => $mediainfo
        ];
        echo json_encode($feedback);
    }
    
    function email_test(){
        //SMTP & mail configuration
        $config = Array(
            'protocol'  => 'mail',
            'smtp_host' => 'sg3plcpnl0094.prod.sin3.secureserver.net',
            'smtp_port' => 465,
            'smtp_user' => 'admin.info@artgoobi.com',
            'smtp_pass' => ')WjSavN27ULe',
            'mailtype'  => 'html',
            'newline'   => "\r\n",
            'crlf'      => "\r\n",
            'wordwrap'  => "TRUE",
            'validate'  => "FALSE",
        );
        
        $this->email->initialize($config);
        $this->load->library('email',$config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent = '<h1>Test Email</h1>';

        $this->email->to('tanveerqureshee1@gmail.com');
        $this->email->from('info@artgoobi.com','Artgoobi');
        $this->email->subject('Artgoobi Test Email');
        $this->email->message($htmlContent);

//Send email
        $checkEmail =   $this->email->send();
        //$eData  =   $this->email->print_debugger();
        if(!$checkEmail){
            $eData  =   $this->email->print_debugger();
            print '<pre>';
            print_r($eData);
            print '</pre>';
            exit;
            
        }
    }
    
    public function profile($profile_id){
        print '<pre>';
        print_r($profile_id);
        print '</pre>';
        exit;
        
    }
    
    public function invited_profile_registration(){
        $data['secret_key']     =   $this->input->get('secret_key', TRUE);
        $dupData['table']                   =   "artist_invitation_details";
        $dupData['where']['is_active']      =   0;
        $dupData['where']['is_approve']     =   1;
        $dupData['where']['secret_key']     =   $data['secret_key'];
        $isDuplicate    =   check_duplicate_data($dupData);
        if($isDuplicate){
            $this->load->view('invited_profile_registration', $data);
        }else{
            $this->session->set_flashdata('error', "Sorry, You are not invited!");
            $red_url = base_url() . 'welcome/';
            redirect($red_url);
        }
    }
    
    public function check_profile_name_availability(){
        $is_available   =   false;
        $profile_name   =   $this->input->post('profile_name');
        $is_profile_name_valid    =   is_profile_name_valid($profile_name);
        if($is_profile_name_valid){
            $dupData['table']                   =   "users_details";
            $dupData['where']['profile_link_name']      =   trim($profile_name);
            $isDuplicate    =   check_duplicate_data($dupData, 'created_at');
            if(!$isDuplicate){
                $status     =   "success";
                $message    =   "<div class='alert alert-success'>Your profile link name is available</div>";
            }else{
                $status     =   "error";
                $message    =   "<div class='alert alert-warning'>Your profile link name is not available!</div>";
            }
        }else{
            $status     =   "error";
            $message    =   "<div class='alert alert-warning'>Your given profile link name was not valid. Please try another.</div>";
        }
        $feedback = [
            'status'  => $status,
            'message' => $message
        ];
        echo json_encode($feedback); 
    }
    
    public function send_artgoobi_contact_feedback(){ 
        $name       =   $this->input->post('name');
        $email      =   $this->input->post('email');
        $mobile     =   $this->input->post('mobile');
        $feedback   =   $this->input->post('comment');
        
        $fields_empty_error_message     =   "<ol class='swal_error_message_order_list'>";
        $fields_empty_error             =   false;
        if(empty($name)){
            $fields_empty_error     =   true;
            $fields_empty_error_message.=   "<li>Name is required</li>";
        }        
        if(empty($email)){
            $fields_empty_error     =   true;
            $fields_empty_error_message.=   "<li>Email is required</li>";
        }        
        if(empty($mobile)){
            $fields_empty_error     =   true;
            $fields_empty_error_message.=   "<li>Mobile is required</li>";
        }        
        if(empty($feedback)){
            $fields_empty_error     =   true;
            $fields_empty_error_message.=   "<li>Feedback/Message is required</li>";
        }
        $fields_empty_error_message.=   "</ol>";
        if(!$fields_empty_error){
            
            /*
             *  Get Mail Body:
             */
            
            $paramData['table']                     =   "mail_template";
            $paramData['where']['email_type']       =   1;
            $paramData['where']['email_type']       =   1;
            $is_single                              =   true;
            $mailConfig                             =   get_table_data_by_param($paramData, $is_single);
            $postData   =   [
                'name'          =>  htmlentities($name),
                'mobile'        =>  htmlentities($mobile),
                'email'         =>  htmlentities($email),
                'feedback'      =>  htmlentities($feedback),
                'receive_time'  =>  date("Y-m-d H:i:s"),
            ];
            //insert the ready post
            $insert_data['fields'] = $postData;
            $insert_data['table'] = 'feedback_details';
            $post_data_insert_id = $this->common_model->common_table_data_insert($insert_data);
            
            if(isset($mailConfig) && !empty($mailConfig)){
                $data['emailParam']  =   $mailConfig;
                $emailBody        = $this->load->view('partial/feedback_mail_body_auto_mail', $data, true);
                $emailData['email_to']                  =   $email;
                $emailData['email_from_address']        =   $mailConfig->email_from_address;
                $emailData['email_from']                =   $mailConfig->email_title;
                $emailData['email_subject']             =   $mailConfig->email_subject;
                $emailData['email_content']             =   $emailBody;
                $emailResponse                          =   send_email($emailData);
            }    
            
            $status     =   "success";
            $message    =   "Your feedback have been successfully received";
            $data       =   "";
            
        }else{
            $status     =   "error";
            $message    =   "Please give the required data.";
            $data       =   $fields_empty_error_message;
        }        
        $feedback       =   [
            'status'    =>  $status,    
            'message'   =>  $message,
            'data'      =>  $data
        ];
        
        echo json_encode($feedback);
    }
    
    public function send_email($emailParam) {
        $htmlContent = '';
        $config = Array(
            'protocol'  => 'mail',
            'smtp_host' => 'sg3plcpnl0094.prod.sin3.secureserver.net',
            'smtp_port' => 465,
            'smtp_user' => 'admin.info@artgoobi.com',
            'smtp_pass' => ')WjSavN27ULe',
            'mailtype'  => 'html',
            'newline'   => "\r\n",
            'crlf'      => "\r\n",
            'wordwrap'  => "TRUE",
            'validate'  => "FALSE",
        );
        $this->email->initialize($config);
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $this->email->to($emailParam['email_to']);
        $this->email->from($emailParam['email_from_address'], $emailParam['email_from']);
        $this->email->subject($emailParam['email_subject']);
        $this->email->message($emailParam['email_content']);

        //Send email
        $checkEmail = $this->email->send();
        $eData = $this->email->print_debugger();
        if (!$checkEmail) {
            $status     =   "error";
            $is_email   =   0;
            $message    =   $eData;            
        }else{
            $status     =   "success";
            $is_email   =   1;
            $message    =  "Email has been successfully send.";
        }
        
        return $feedback   =   [
            'status'        =>  $status,
            'is_email'      =>  $is_email,
            'message'       =>  $message,
        ];
    }
}
