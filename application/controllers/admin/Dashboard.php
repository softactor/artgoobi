<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct()
    {
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
    }
    
    public function index(){
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'dashboard';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/dashboard',$data);
    }

    public function users_panel(){
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['user_type!= '] = 4; // Exclude Super Admin;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'users_panel';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/users_panel',$data);
    }
    public function users_panel_edit($id){
        // Read All User Data
        $where['id']    = $id;
        $get_data ['where'] = $where;
        $get_data ['table'] = "users";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['edit_data'] = $data['all_data']['data'][0];
        if(isset($data['edit_data']->ip_adress) && !empty($data['edit_data']->ip_adress)){
            $ip_addr = json_decode($data['edit_data']->ip_adress);
            $data['range_from'] =   $ip_addr->range_from;
            $data['range_to'] =   $ip_addr->range_to;
            
        }
        
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'users_panel';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/users_panel_edit',$data);
    }    
    public function user_create(){
        // get the data
        $users_data['name'] =   $this->input->post('name');
        $users_data['user_type'] =   $this->input->post('user_type');
        $users_data['user_email'] =   $this->input->post('user_email');
        $users_data['password'] =   $this->input->post('user_pass');
        $users_data['ip_addr_from'] =   $this->input->post('ip_addr_from');
        $users_data['ip_addr_to'] =   $this->input->post('ip_addr_to');        

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'users';
            $duplicate_check['where']['user_email'] = $this->input->post('user_email');
            $duplicate_check['where']['user_type'] = $this->input->post('user_type');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);

            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){                    

                //make data for insert
                $users_data['password'] = md5($users_data['password']);
                $users_data['create_time'] = date('Y-m-d H:i:s');
                $ip_data = [
                    'range_from'=>$users_data['ip_addr_from'],
                    'range_to'=>$users_data['ip_addr_to']
                ];

                // Unset The two irrelated table field
                unset($users_data['ip_addr_from']);
                unset($users_data['ip_addr_to']);
                
                $users_data['is_ip_checked'] =   $this->input->post('is_ip_checked');
                $users_data['ip_adress'] = json_encode($ip_data);
                $insert_data['fields'] = $users_data;
                $insert_data['table'] = 'users';
                $insert_result = $this->common_model->common_table_data_insert($insert_data);
                if($insert_result){
                    $feedback_data = [
                        'status'=>'success',
                        'message'=>'Data have Successfully Inserted.',
                        'data'=>$insert_result,// Last Inserted ID
                    ];
                }else{
                    $feedback_data = [
                        'status'=>'error',
                        'message'=>'failed to Inserted.',
                        'data'=>''
                    ];
                }
                echo json_encode($feedback_data);
            }else{
                echo json_encode($empty_check_result);
            }
        }else{
            echo json_encode($empty_check_result);
        }
    }    
    public function user_panel_edit_process(){
        // get the data
        $users_data['id'] =   $this->input->post('user_id');
        $users_data['name'] =   $this->input->post('name');
        $users_data['user_type'] =   $this->input->post('user_type');
        $users_data['user_email'] =   $this->input->post('user_email');        
        $users_data['ip_addr_from'] =   $this->input->post('ip_addr_from');
        $users_data['ip_addr_to'] =   $this->input->post('ip_addr_to');        

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'users';
            $duplicate_check['where']['user_email'] = $this->input->post('user_email');
            $duplicate_check['where']['user_type'] = $this->input->post('user_type');
            $duplicate_check['where_not_in'] = $this->input->post('user_id');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);
            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){                    

                //make data for insert
                $users_data['password'] =   $this->input->post('user_pass');
                if(isset($users_data['password']) && !empty($users_data['password'])){
                    $users_data['password'] = md5($users_data['password']);
                }else{
                    unset($users_data['password']);
                }
                $users_data['update_time'] = date('Y-m-d H:i:s');;
                $ip_data = [
                    'range_from'=>$users_data['ip_addr_from'],
                    'range_to'=>$users_data['ip_addr_to']
                ];

                // Unset The two irrelated table field
                unset($users_data['ip_addr_from']);
                unset($users_data['ip_addr_to']);
                
                $users_data['is_ip_checked'] =   $this->input->post('is_ip_checked');
                $users_data['ip_adress'] = json_encode($ip_data);
                $update_data['where']['id'] = $users_data['id'];
                $update_data['fields'] = $users_data;
                $update_data['table'] = 'users';
                $update_result = $this->common_model->common_table_data_update($update_data);
                if($update_result){
                    $feedback_data = [
                        'status'=>'success',
                        'message'=>'Data have Successfully Updated.',
                        'data'=>"",
                    ];
                }else{
                    $feedback_data = [
                        'status'=>'error',
                        'message'=>'failed to Update.',
                        'data'=>''
                    ];
                }
                echo json_encode($feedback_data);
            }else{
                echo json_encode($empty_check_result);
            }
        }else{
            echo json_encode($empty_check_result);
        }
    }       
    public function user_panel_delete_process(){
        // get the data
        $users_data['id']                   = $this->input->post('delete_id');
        $delete_data['where']['id']         = $users_data['id'];
        $delete_data['table']               = 'users';
        $delete_result                      = $this->common_model->common_table_data_delete($delete_data);
        
        $delete_data['where']['created_by'] = $users_data['id'];
        $delete_data['table'] = 'post_data';
        $delete_result = $this->common_model->common_table_data_delete($delete_data);
        
        if($delete_result){
            $feedback_data = [
                'status'=>'success',
                'message'=>'Data have been Successfully Deleted.',
                'data'=>"",
            ];
        }else{
            $feedback_data = [
                'status'=>'error',
                'message'=>'failed to Delete Data',
                'data'=>''
            ];
        }
        echo json_encode($feedback_data);
    }
    
    public function profile_panel(){
        // define columns
        $usersTypes = [6,7];
        $columns ='
            u.id as user_id,
            u.name,
            u.user_email,
            u.user_type,
            u.status,
            ut.name as user_type_name,
            ud.first_name,
            ud.last_name,            
            ud.phone_no';        
        //Join users_details
        $join['join']['table'][] = 'users_details ud';
        $join['join']['join_field'][] = 'u.id=ud.user_id';
        $join['join']['join_type'][] = 'left';   
        
        //Join user_type
        $join['join']['table'][] = 'user_type ut';
        $join['join']['join_field'][] = 'ut.id=u.user_type';
        $join['join']['join_type'][] = 'left';
        
        $get_data = $join;   
        
        //************ get data by joining Table*************
        
        $get_data['table'] = 'users u';
        $get_data['columns'] = $columns;
        $get_data ['where_in']['field'] = 'u.user_type';
        $get_data ['where_in']['values'] = $usersTypes; 
        $data['table_data'] = get_all_data_by_joining_table($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'profile';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/profile_panel',$data);
    }
    public function employee_create(){
        // get the data
        $users_data['first_name'] =   $this->input->post('first_name');
        $users_data['last_name'] =   $this->input->post('last_name');
        $users_data['initials'] =   $this->input->post('initials');
        $users_data['emp_id'] =   $this->input->post('emp_id');
        $users_data['position_id'] =   $this->input->post('position_id');        
        $users_data['phone_no'] =   $this->input->post('phone_no');        
        $users_data['email'] =   $this->input->post('email');        
        $users_data['group_id'] =   $this->input->post('group_id');        

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'employes';
            $duplicate_check['where']['email'] = $this->input->post('email');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);

            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){                    

                //make data for insert
                $users_data['created_time'] = date('Y-m-d H:i:s');
                $insert_data['fields'] = $users_data;
                $insert_data['table'] = 'employes';
                $insert_result = $this->common_model->common_table_data_insert($insert_data);
                if($insert_result){
                    $feedback_data = [
                        'status'=>'success',
                        'message'=>'Data have Successfully Inserted.',
                        'data'=>$insert_result,// Last Inserted ID
                    ];
                }else{
                    $feedback_data = [
                        'status'=>'error',
                        'message'=>'failed to Inserted.',
                        'data'=>''
                    ];
                }
                echo json_encode($feedback_data);
            }else{
                echo json_encode($empty_check_result);
            }
        }else{
            echo json_encode($empty_check_result);
        }
    }
    public function employee_panel_edit($id){
        // Read All User Data
        $where['id']    = $id;
        $get_data ['where'] = $where;
        $get_data ['table'] = "employes";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['edit_data'] = $data['all_data']['data'][0];
        
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'dashboard';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/employee_panel_edit',$data);
    }
    public function employee_panel_edit_process(){
        // get the data
        $users_data['id'] =   $this->input->post('user_id');
        $users_data['first_name'] =   $this->input->post('first_name');
        $users_data['last_name'] =   $this->input->post('last_name');
        $users_data['initials'] =   $this->input->post('initials');
        $users_data['emp_id'] =   $this->input->post('emp_id');
        $users_data['position_id'] =   $this->input->post('position_id');        
        $users_data['phone_no'] =   $this->input->post('phone_no');        
        $users_data['email'] =   $this->input->post('email');        
        $users_data['group_id'] =   $this->input->post('group_id'); 

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'employes';
            $duplicate_check['where']['email'] = $this->input->post('email');
            $duplicate_check['where_not_in'] = $this->input->post('user_id');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);
            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){                    

                //make data for insert
                $users_data['updated_time'] = date('Y-m-d H:i:s');
                $update_data['where']['id'] = $users_data['id'];
                $update_data['fields'] = $users_data;
                $update_data['table'] = 'employes';
                $update_result = $this->common_model->common_table_data_update($update_data);
                if($update_result){
                    $feedback_data = [
                        'status'=>'success',
                        'message'=>'Data have Successfully Updated.',
                        'data'=>"",
                    ];
                }else{
                    $feedback_data = [
                        'status'=>'error',
                        'message'=>'failed to Update.',
                        'data'=>''
                    ];
                }
                echo json_encode($feedback_data);
            }else{
                echo json_encode($empty_check_result);
            }
        }else{
            echo json_encode($empty_check_result);
        }
    }
    public function employee_panel_delete_process(){
        // get the data
        $users_data['id'] =   $this->input->post('delete_id');
        $delete_data['where']['id'] = $users_data['id'];
        $delete_data['table'] = 'employes';
        $delete_result = $this->common_model->common_table_data_delete($delete_data);
        if($delete_result){
            $feedback_data = [
                'status'=>'success',
                'message'=>'Data have Successfully Deleted.',
                'data'=>"",
            ];
        }else{
            $feedback_data = [
                'status'=>'error',
                'message'=>'failed to Delete.',
                'data'=>''
            ];
        }
        echo json_encode($feedback_data);
    }
    
    public function empty_value_check($chck_data){
        $status =   "success";
        $error_fields = [];
        if(isset($chck_data) && !empty($chck_data)){
            foreach($chck_data as $field_name=>$field_value){
                if(empty($field_value)){
                    $status =   "error";
                    $error_fields[] = $field_name;
                }
            }
        }// End of loop
        return $feedback = [
            'status'=>$status,
            'data'=>$error_fields
        ];
    }
    public function duplicate_entry_check($chck_data){
        $status =   "success";
        $error_message = '';
        $check   =   $this->common_model->duplicate_entry_check($chck_data);
        if($check){
            $status =   "error";
            $error_message = 'Duplicate Entry Found!';
        }
        return $feedback = [
            'status'=>$status,
            'message'=>$error_message
        ];
    }    
    public function form_example_code(){
        $params = array(
            'columns' => 'trans_route.id, trans_route.code',
            'table' => 'trans_route',
            'join_table' => 'snf_glo_campus as campus',
            'join_by' => 'trans_route.branch_id = campus.id AND campus.institution_id=' . $this->institution_id,
            'where_array' => array('trans_route.is_active' => 1)
        );
        $result = $this->common_model->get_all_data($params);
        if ($this->is_default) {
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
    }
    
    public function logged_out(){
        $this->session->unset_userdata('logged_id');
        $this->session->unset_userdata('logged_type');
        $this->session->unset_userdata('logged_type_name');
        $this->session->unset_userdata('logged_email');
        $this->session->unset_userdata('logged_in');
        $feedback_data = [
                        'status'=>'success',
                        'message'=>'You have successfully logged out.',
                        'data'=>''
                    ];
        $this->session->set_flashdata('op_message',$feedback_data);
        $red_url = base_url().'welcome/';
        redirect($red_url);
    } 
    
    public function get_profile_info_by_id(){
        $table_data = userProfileDetailsdataByUserId($this->input->post('id'));       
        echo json_encode($table_data);    
    }
    
    public function signup_process_update(){        
        $users_data['status']       =   $this->input->post('status');        
        $users_data['update_time']  = date('Y-m-d H:i:s');
        $update_data['where']['id'] = $this->input->post('update_id');
        $update_data['fields']      = $users_data;
        $update_data['table']       = 'users';
        $update_result              = $this->common_model->common_table_data_update($update_data);
        
        $update_data                        = [];
        $users_det_data['zip_code']         =   $this->input->post('zip_code');        
        $users_det_data['first_name']       =   $this->input->post('first_name');        
        $users_det_data['last_name']        =   $this->input->post('last_name');        
        $users_det_data['gender']           =   $this->input->post('gender');        
        $users_det_data['phone_no']         =   $this->input->post('phone');        
        $users_det_data['country_id']       =   $this->input->post('country_id');       
        $users_det_data['updated_time']     =   date('Y-m-d H:i:s');
        $update_data['where']['user_id']    =   $this->input->post('update_id');
        $update_data['fields']              =   $users_det_data;
        $update_data['table']               =   'users_details';
        $update_result                      =   $this->common_model->common_table_data_update($update_data);
        /*
         * <div class="alert alert-success">
            <strong>Success!</strong> Indicates a successful or positive action.
          </div>
         */
        $msg = '';
        $msg.= '<div class="alert alert-success">';
        $msg.= '<strong>Success!</strong> Data Have Successfully Updated.';
        $msg.= '</div>';
        $feedack = [
            'status'=>'success',
            'message'=>$msg
        ];
        echo json_encode($feedack);
    }
    
    public function artwork_pending_request() {
        // define columns
        $where = [
            'art.status'=>0
        ];
        $columns ='u.id,u.name,COUNT(art.id) as total_artwork';        
        //Join users_details
        $join['join']['table'][] = 'users u';
        $join['join']['join_field'][] = 'u.id=art.artist_id';
        $join['join']['join_type'][] = 'inner';        
        
        $get_data = $join;   
        
        //************ get data by joining Table*************
        
        $get_data['table'] = 'artwork_info art';
        $get_data['columns'] = $columns;
        $get_data['group_by'] = ['art.artist_id'];
        $get_data ['where'] = $where;
        $data['table_data'] = get_all_data_by_joining_table($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'dashboard';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/pending_artist_artwork',$data);
    }
    public function pending_artwork_details($user_id) {
        // Read All artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['artist_id= '] = $user_id;
        $get_data ['where']['status= '] = 0;// Status = 0 = pending;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data'] = $data['all_data']['data'];
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'dashboard';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/artist_all_artwork',$data);
    }
    
    public function artwork_details($artwork_id) {
        // Read All artwork data
        $get_data                   = [];
        $get_data ['table']         = "artwork_info";
        $get_data ['where']['id= '] = $artwork_id;
        $data['all_data']           = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data']      = $data['all_data']['data'][0];
        $data['header']             = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'dashboard';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer']             = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/artwork_details',$data);
    }
    
    public function artist_artwork_update($update_id) {
        
        // Now prepared to update data into artwork_info table:
        $artwork_data = [
            'artwork_owner' => $this->input->post('artwork_owner'),
            'artist_id' => $this->input->post('hidden_artist_id'),
            'artist_name' => $this->input->post('arits_name'),
            'type_of_art_id' => $this->input->post('type_of_art_id'),
            'type_of_child_id' => $this->input->post('type_of_child_id'),
            'title' => $this->input->post('title'),
            'formate' => $this->input->post('formate'),
            'height' => $this->input->post('height'),
            'width' => $this->input->post('width'),
            'depth' => $this->input->post('depth'),
            'unit_type' => $this->input->post('unit_type'),
            'year' => $this->input->post('year'),
            'not_for_sale' => $this->input->post('not_for_sale'),
            'price' => $this->input->post('price'),
            'price_with_vat' => (($this->input->post('price') * 15) / 100),
            'price_with_ser' => (($this->input->post('price') * 12) / 100),
            'status' => $this->input->post('status'), // Pending
            'remarks' => $this->input->post('remarks'), // Pending
            'update_time' => date("Y-m-d h:i:s", time())
        ];
        $insert_data['fields'] = $artwork_data;
        $insert_data['table'] = 'artwork_info';
        $insert_data['where']['id'] = $update_id;
        $user_insert_result = $this->common_model->common_table_data_update($insert_data);
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
        $redirect_url = base_url()."admin/dashboard/pending_artwork_details/".$this->input->post('hidden_artist_id');
        redirect($redirect_url);
    }
    
    // Pending artwork list details:
    public function pending_artwork_list() {
        // Read All artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['status= '] = 0;// Status = 0 = pending;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data'] = $data['all_data']['data'];
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'pending_req';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/pending_artwork_list',$data);
    }
    
    // Profile artwork list details:
    public function profile_artwork_list($artist_id) {
        // Read All artwork data
        $get_data = [];
        $get_data ['table'] = "artwork_info";
        $get_data ['where']['status= '] = 1;// Status = 0 = pending;
        $get_data ['where']['artist_id= '] = $artist_id;// Status = 0 = pending;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['artworks_data'] = $data['all_data']['data'];
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'profile';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/profile_artwork_list',$data);
    }
    
    // Profile artwork details:
    public function profile_artwork_details($artist_id, $artwork_id) {
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
        
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'dashboard';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/artwork_details_modify', $data);
    }
    
    public function executeArtworkAuthenticationUpdate(){
        if(isset($_POST['status']) && !empty($_POST['status'])){
            foreach($_POST['status'] as $akey=>$aupdateStatus){
                $artwork_data = [
                    'status'        => $aupdateStatus, // Pending
                    'remarks'       => $_POST['remarks'][$akey], // Pending
                    'update_time'   => date("Y-m-d h:i:s", time())
                ];
                $insert_data['fields'] = $artwork_data;
                $insert_data['table'] = 'artwork_info';
                $insert_data['where']['id'] = $akey;
                $user_insert_result = $this->common_model->common_table_data_update($insert_data);                
            }
        }
        
        $feedbackData   =   [
            'status'    =>  'success',
            'message'   =>  'Data have been successfully updated',
            'data'      =>  ''
        ];
        echo json_encode($feedbackData);
    } 
    
    public function exhibition_delete_process(){
        // get the data
        $users_data['id']                   = $this->input->post('delete_id');
        $delete_data['where']['id']         = $users_data['id'];
        $delete_data['table']               = 'post_data';
        $delete_result                      = $this->common_model->common_table_data_delete($delete_data);
        if($delete_result){
            $feedback_data = [
                'status'=>'success',
                'message'=>'Data have been Successfully Deleted.',
                'data'=>"",
            ];
        }else{
            $feedback_data = [
                'status'=>'error',
                'message'=>'failed to Delete Data',
                'data'=>''
            ];
        }
        echo json_encode($feedback_data);
    }
    public function event_delete_process(){
        // get the data
        $users_data['id']                   = $this->input->post('delete_id');
        $delete_data['where']['id']         = $users_data['id'];
        $delete_data['table']               = 'post_data';
        $delete_result                      = $this->common_model->common_table_data_delete($delete_data);
        if($delete_result){
            $feedback_data = [
                'status'=>'success',
                'message'=>'Data have been Successfully Deleted.',
                'data'=>"",
            ];
        }else{
            $feedback_data = [
                'status'=>'error',
                'message'=>'failed to Delete Data',
                'data'=>''
            ];
        }
        echo json_encode($feedback_data);
    }
    
    public function faq_delete_process(){
        // get the data
        $users_data['id']                   = $this->input->post('delete_id');
        $delete_data['where']['id']         = $users_data['id'];
        $delete_data['table']               = 'post_data';
        $delete_result                      = $this->common_model->common_table_data_delete($delete_data);
        if($delete_result){
            $feedback_data = [
                'status'=>'success',
                'message'=>'Data have been Successfully Deleted.',
                'data'=>"",
            ];
        }else{
            $feedback_data = [
                'status'=>'error',
                'message'=>'failed to Delete Data',
                'data'=>''
            ];
        }
        echo json_encode($feedback_data);
    }
    public function confirm_delete_operation(){
        // get the data
        $users_data['id']                   = $this->input->post('delete_id');
        $table                   = $this->input->post('table');
        $delete_data['where']['id']         = $users_data['id'];
        $delete_data['table']               = $table;
        $delete_result                      = $this->common_model->common_table_data_delete($delete_data);
        if($delete_result){
            $feedback_data = [
                'status'=>'success',
                'message'=>'Data have been Successfully Deleted.',
                'data'=>"",
            ];
        }else{
            $feedback_data = [
                'status'=>'error',
                'message'=>'failed to Delete Data',
                'data'=>''
            ];
        }
        echo json_encode($feedback_data);
    }
    
    // login as process:
    public function login_as_artist_process() {
        // Read All User Data
        $get_data ['table'] = "users";
        $get_data ['where']['id'] = htmlentities($this->input->post('artist_id'));
        $user_info = $this->common_model->common_table_data_read($get_data);
        if (isset($user_info['status']) && $user_info['status'] == 'success') {
            $logged['id'] = $user_info['data'][0]->id;
            $logged['user_email'] = $user_info['data'][0]->user_email;
            $logged['user_type'] = $user_info['data'][0]->user_type;

            $logged_data = array(
                'user_logged_id' => $user_info['data'][0]->id,
                'user_logged_name' => $user_info['data'][0]->name,
                'user_logged_type' => $user_info['data'][0]->user_type,
                'user_logged_type_name' => get_user_type_name($this->input->post('user_type')),
                'user_logged_email' => $user_info['data'][0]->user_email,
                'user_logged_in_status' => TRUE
            );

            $this->session->set_userdata($logged_data);
            $feedback_data = [
                'status'    => "success",
                'message'   => 'You Have Successfully Loggedin.',
                'login_as'  => "You have been successfully logging as ".$user_info['data'][0]->name,
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
        echo json_encode($feedback_data);
    }
}
