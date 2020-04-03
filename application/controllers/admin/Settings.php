<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
    
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
    
    public function custom_groups(){
        // Read All User Data
        $get_data ['table'] = "groups";
        $get_data ['where']['group_type'] = 2; // 2 means custom Group
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $data['add_form'] = $this->load->view('dashboard/custom_group_add_form',$data,TRUE);
        $this->load->view('dashboard/custom_groups',$data);
    }
    public function custom_group_create(){
        $form_data = $this->input->post('form_data');
        $status = false;
        $is_general = '';
        $group_name = '';
        $posions = [];
        $gropups = [];
        $emp_groups = [];
        if(isset($form_data) && !empty($form_data)){
            foreach($form_data as $data){
                if(isset($data['name']) && $data['name']=='group_name'){
                    $group_name = $data['value'];
                }
                if(isset($data['name']) && $data['name']=='is_general'){
                    $is_general = $data['value'];
                }
                if(isset($data['name']) && $data['name']=='positions'){
                    $posions[] = $data['value'];
                    $status = true;
                }
                if(isset($data['name']) && $data['name']=='groups'){
                    $gropups[] = $data['value'];
                    $status = true;
                }
                if(isset($data['name']) && $data['name']=='filter_emp'){
                    $emp_groups[] = $data['value'];
                    $status = true;
                }
            }
        }
        if($status){
            $details = [
                'posions'=>$posions,
                'groups'=>$gropups,
                'emp_groups'=>$emp_groups,
            ];
            $users_data = [
                'group_type'=>2,
                'custom_type'=>$is_general,
                'name'=>$group_name,
                'details'=>  json_encode($details)
            ];
            
            //make data for insert
            $insert_data['fields'] = $users_data;
            $insert_data['table'] = 'groups';
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
        }
    }
    public function custom_group_edit($id){
        // Read All User Data
        $where['id']    = $id;
        $get_data ['where'] = $where;
        $get_data ['table'] = "groups";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['edit_data'] = $data['all_data']['data'][0];
        $details = json_decode($data['edit_data']->details);
        $data['positions_info'] = $details->posions;
        $data['groups_info'] = $details->groups;
        
        if(isset($details->emp_groups) && !empty($details->emp_groups)){
            $data['emp_groups']   =  $details->emp_groups;
            $get_data = [];
            $get_data ['where_in']['field'] = 'id';
            $get_data ['where_in']['values'] = $details->emp_groups;
            $get_data ['table'] = "employes";
            $employee_details = $this->common_model->common_table_data_read($get_data);
            $data['emp_groups_info'] =    $employee_details['data'];     
        }
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/custom_group_edit',$data);
    }    
    public function custom_group_edit_process(){
        $id = $this->input->post('custom_grp_edit_id');
        $is_general = $this->input->post('is_general');
        $positions = $this->input->post('positions[]');
        $groups = $this->input->post('groups[]');
        $filter_emp = $this->input->post('filter_emp[]');
        
        $status = false;
        $group_name = $this->input->post('group_name');
        $posions_arr = [];
        $gropups_arr = [];
        $emp_groups_arr = [];
        
        if(isset($positions) && !empty($positions)){
            foreach($positions as $pos){
                $posions_arr[] = $pos;
                $status = true;
            }
        }
        
        if(isset($groups) && !empty($groups)){
            foreach($groups as $pos){
                $gropups_arr[] = $pos;
                $status = true;
            }
        }
        
        if(isset($filter_emp) && !empty($filter_emp)){
            foreach($filter_emp as $pos){
                $emp_groups_arr[] = $pos;
                $status = true;
            }
        }
        if($status){
            $details = [
                'posions'=>$posions_arr,
                'groups'=>$gropups_arr,
                'emp_groups'=>$emp_groups_arr,
            ];
            $users_data = [
                'group_type'=>2,
                'custom_type'=>$is_general,
                'name'=>$group_name,
                'details'=>  json_encode($details)
            ];
            
            $update_data['where']['id'] = $this->input->post('custom_grp_edit_id');
            $update_data['fields'] = $users_data;
            $update_data['table'] = 'groups';
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
            $this->session->set_flashdata('op_message',$feedback_data);
            $red_url = base_url().'settings/custom_group_edit/'.$this->input->post('custom_grp_edit_id');
            redirect($red_url);
        }
        
    }
    public function custom_group_delete_process(){
        // get the data
        $users_data['id'] =   $this->input->post('delete_id');
        $delete_data['where']['id'] = $users_data['id'];
        $delete_data['table'] = 'groups';
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
    
    public function group(){
        // Read All User Data
        $get_data ['table'] = "groups";
        $get_data ['where']['group_type'] = 1; // 1= normal groups;
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'settings';
        $data['subMenuName']=   'group';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/groups',$data);
    }
    public function group_create(){
        // get the data
        $users_data['name'] =   $this->input->post('name');       

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'groups';
            $duplicate_check['where']['name'] = $this->input->post('name');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);

            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){                    

                //make data for insert
                $insert_data['fields'] = $users_data;
                $insert_data['table'] = 'groups';
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
    public function group_edit($id){
        // Read All User Data
        $where['id']    = $id;
        $get_data ['where'] = $where;
        $get_data ['table'] = "groups";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['edit_data'] = $data['all_data']['data'][0];
        
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/group_edit',$data);
    }  
    public function group_edit_process(){
        // get the data
        $users_data['id'] =   $this->input->post('user_id');
        $users_data['name'] =   $this->input->post('name');       

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'groups';
            $duplicate_check['where']['name'] = $this->input->post('name');
            $duplicate_check['where_not_in'] = $this->input->post('user_id');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);
            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){
                
                $update_data['where']['id'] = $users_data['id'];
                $update_data['fields'] = $users_data;
                $update_data['table'] = 'groups';
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
    public function group_delete_process(){
        // get the data
        $users_data['id'] =   $this->input->post('delete_id');
        $delete_data['where']['id'] = $users_data['id'];
        $delete_data['table'] = 'groups';
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

    public function position(){
        // Read All User Data
        $get_data ['table'] = "positions";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'settings';
        $data['subMenuName']=   'position';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/positions',$data);
    }
    public function position_create(){
        // get the data
        $users_data['name'] =   $this->input->post('name');       

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'positions';
            $duplicate_check['where']['name'] = $this->input->post('name');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);

            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){                    

                //make data for insert
                $insert_data['fields'] = $users_data;
                $insert_data['table'] = 'positions';
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
    public function position_edit($id){
        // Read All User Data
        $where['id']    = $id;
        $get_data ['where'] = $where;
        $get_data ['table'] = "positions";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['edit_data'] = $data['all_data']['data'][0];
        
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/position_edit',$data);
    }  
    public function position_edit_process(){
        // get the data
        $users_data['id'] =   $this->input->post('user_id');
        $users_data['name'] =   $this->input->post('name');       

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'positions';
            $duplicate_check['where']['name'] = $this->input->post('name');
            $duplicate_check['where_not_in'] = $this->input->post('user_id');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);
            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){
                
                $update_data['where']['id'] = $users_data['id'];
                $update_data['fields'] = $users_data;
                $update_data['table'] = 'positions';
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
    public function position_delete_process(){
        // get the data
        $users_data['id'] =   $this->input->post('delete_id');
        $delete_data['where']['id'] = $users_data['id'];
        $delete_data['table'] = 'positions';
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
    
    public function pre_sms_template(){
        // Read All User Data
        $get_data ['table'] = "sms_template";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/pre_sms_template',$data);
    }
    public function pre_sms_template_create(){
        // get the data        
        $users_data['template_id'] =   $this->input->post('template_id');       
        $users_data['descriptions'] =   $this->input->post('descriptions');       

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);

        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'sms_template';
            $duplicate_check['where']['template_id'] = $this->input->post('template_id');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);

            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){                    

                //make data for insert
                $users_data['is_general'] =   $this->input->post('is_general');
                $users_data['group_id'] =   $this->input->post('group_id');       
                $users_data['position_id'] =   $this->input->post('position_id');
                $insert_data['fields'] = $users_data;
                $insert_data['table'] = 'sms_template';
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
    public function pre_sms_template_edit($id){
        // Read All User Data
        $where['id']    = $id;
        $get_data ['where'] = $where;
        $get_data ['table'] = "sms_template";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['edit_data'] = $data['all_data']['data'][0];
        
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/pre_sms_temp_edit',$data);
    }  
    public function pre_sms_template_edit_process(){
        // get the data
        $users_data['id'] =   $this->input->post('user_id');
        $users_data['template_id'] =   $this->input->post('template_id');       
        $users_data['descriptions'] =   $this->input->post('descriptions');      

        // Check Empty data
        $empty_check_result = $this->empty_value_check($users_data);
        // If all data are availale
        if(isset($empty_check_result['status']) && $empty_check_result['status']=='success'){

            // Duplicate check
            $duplicate_check['table'] = 'sms_template';
            $users_data['template_id'] =   $this->input->post('template_id');
            $duplicate_check['where_not_in'] = $this->input->post('user_id');
            $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);
            // If Duplicate Data Not Found
            if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){
                
                $users_data['is_general'] =   $this->input->post('is_general');
                $users_data['group_id'] =   $this->input->post('group_id');       
                $users_data['position_id'] =   $this->input->post('position_id');
                $update_data['where']['id'] = $users_data['id'];
                $update_data['fields'] = $users_data;
                $update_data['table'] = 'sms_template';
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
    public function pre_sms_template_delete_process(){
        // get the data
        $users_data['id'] =   $this->input->post('delete_id');
        $delete_data['where']['id'] = $users_data['id'];
        $delete_data['table'] = 'sms_template';
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
    
    public function role_panel($user_type=''){
        // Read All User Data
        $get_data ['table'] = "panel";
        $data['panel_data'] = $this->common_model->common_table_data_read($get_data);        
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'settings';
        $data['subMenuName']=   'role_panel';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        if(isset($user_type) && !empty($user_type)){
            $data['selected_user_type'] = $user_type;
            $data['user_type_role_data'] = $this->get_role_details_by_user_id($user_type);
        }
        $this->load->view('dashboard/role_settings',$data);
    }
    public function process_access_role(){
        $checkData = $this->input->post('access_controll[]');
        $user_type = $this->input->post('user_type');        
        $access_details=[];
        foreach($checkData as $checkKey=>$checkval){
            $detials = [];
            foreach($checkval as $val){
                $detials[]=[
                    "$val"=>true
                ];                
            }
            $access_details[]=[
                'menu_id'=>$checkKey,
                'access'=>$detials
            ];
        }
        // Duplicate check
        $duplicate_check['table'] = 'access_control';
        $duplicate_check['where']['user_type'] =   $user_type;
        $duplicate_entry_result = $this->duplicate_entry_check($duplicate_check);
        if(isset($duplicate_entry_result['status']) && $duplicate_entry_result['status']=='success'){
            // there is no data into role tale
            // so need to insert data
            //make data for insert
            $users_data['is_all_access'] =   null;
            $users_data['user_type'] =   $user_type;       
            $users_data['access_details'] = json_encode($access_details);
            $insert_data['fields'] = $users_data;
            $insert_data['table'] = 'access_control';
            
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
        }else{
            //need to update data
            $users_data['is_all_access'] =   null;
            $users_data['user_type'] =   $user_type;       
            $users_data['access_details'] = json_encode($access_details);
            $update_data['fields'] = $users_data;
            $update_data['where']['id'] = $this->input->post('role_id');;//$users_data['id'];
            $update_data['table'] = 'access_control';
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
        }// End Of Update        
        $this->session->set_flashdata('op_message',$feedback_data);
        $red_url = base_url().'settings/role_panel/'.$user_type;
        redirect($red_url);
    }   
    
    public function get_role_details_by_user_id($redirect_user_type=''){
        $data = [];
        if(isset($redirect_user_type) && !empty($redirect_user_type)){
            $user_type = $redirect_user_type;
        }else{            
            $user_type = $this->input->post('user_type');
        }
        // Read All User Data
        $get_data ['table'] = "access_control";
        $get_data ['where']['user_type'] = $user_type;
        $all_data = $this->common_model->common_table_data_read($get_data);
        if(isset($all_data['status']) && $all_data['status']=='success'){
            $data['role_id']  =   $all_data['data'][0]->id;
            $data['user_type']  =   $user_type;
            $data['is_all_access']  =   $all_data['data'][0]->is_all_access;
            if(isset($data['is_all_access']) && !empty($data['is_all_access'])){
                
            }else{ 
                $menu_array = [];
                $crude_array = [];
                $access_details = json_decode($all_data['data'][0]->access_details);
                foreach($access_details as $access){                    
                    $crude_array = [];
                    foreach($access->access as $det){
                        if(isset($det->Add) && $det->Add==1){
                            array_push($crude_array,'Add');
                        }
                        if(isset($det->Edit) && $det->Edit==1){
                            array_push($crude_array,'Edit');
                        }
                        if(isset($det->Delete) && $det->Delete==1){
                            array_push($crude_array,'Delete');
                        }
                    }// End of Loop
                    $menu_array[$access->menu_id] = [
                        'menu_id'=>$access->menu_id,
                        'access'=>$crude_array
                    ];
                }
            }
            
        }
        if(isset($menu_array) && !empty($menu_array)){
            $data['role_data'] = $menu_array;
        }
        if(isset($user_type) && !empty($user_type)){
            $data['user_type']  =   $user_type;
            $role_details = $this->load->view('dashboard/role_details_by_user_type',$data,TRUE);
            if(isset($redirect_user_type) && !empty($redirect_user_type)){
                return $role_details;
            }else{
                echo $role_details;
            }
        }else{
            if(isset($redirect_user_type) && !empty($redirect_user_type)){
                return "Please Select A Type";
            }else{
                echo "Please Select A Type";
            }
            
        }        
    }
    
    public function mail_template_view(){
        // Read All User Data
        $get_data ['table'] = "mail_template";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/setup/mail_template/list',$data);
    }
    public function mail_template_create(){
        // Read All User Data
        $get_data ['table'] = "mail_template";
        $data['all_data'] = $this->common_model->common_table_data_read($get_data);
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menu'] = $this->load->view('dashboard/menu','',TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/setup/mail_template/create',$data);
    }
    public function mail_template_edit($edit_id){
        $get_data ['table']         =   "mail_template";
        $get_data ['where']['id']   =   $edit_id; // exhibition Data;
        $post_data                  =   $this->common_model->common_table_data_read($get_data);
        $data['post_data']          =   $post_data['data'][0];
        
        $data['header']     =   $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'events';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer']     =   $this->load->view('dashboard/footer','',TRUE);
        
        $this->load->view('dashboard/setup/mail_template/edit',$data);
    }
    
    public function email_template_store(){
        // load form validation
        $this->load->library('form_validation');

        // check validation        
        $this->form_validation->set_rules('email_type', 'Email Type', 'required');
        $this->form_validation->set_rules('email_title', 'Mail From', 'required');
        $this->form_validation->set_rules('email_from_address', 'Mail From Address', 'required');
        $this->form_validation->set_rules('email_subject', 'Mail Subject', 'required');
        $this->form_validation->set_rules('salutation', 'Salutation', 'required');
        $this->form_validation->set_rules('email_body', 'Mail Body', 'required');
        $this->form_validation->set_rules('email_footer', 'Mail Footer', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['header'] = $this->load->view('dashboard/header','',TRUE);
            $data['menuName']   =   'events';
            $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
            $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
            $this->load->view('dashboard/events/create_event',$data);
        } else {
            $edit_id    =   $this->input->post("edit_id");
            // try to make data for insert into post data table
            $post_data = [
                'email_type'    => $this->input->post("email_type"),
                'exhibition_id' => $this->input->post("exhibition_id"),
                'event_id'      => $this->input->post("event_id"),
                'email_from_address'   => trim($this->input->post("email_from_address")),
                'email_title'   => trim($this->input->post("email_title")),
                'email_subject' => trim($this->input->post("email_subject")),
                'salutation'    => trim($this->input->post("salutation")),
                'email_body'    => htmlentities($this->input->post("email_body")),
                'email_footer'  => htmlentities($this->input->post("email_footer"))
            ];

            //insert the ready post
            $insert_data['fields']  = $post_data;
            $insert_data['table']   = 'mail_template';
            
            if(isset($edit_id) && !empty($edit_id)){
                $insert_data['where']['id']   = $edit_id;
                $post_data_insert_id = $this->common_model->common_table_data_update($insert_data);            
                $this->session->set_flashdata('success', 'Email Template Data has been successfully updated');
            }else{
                $post_data_insert_id = $this->common_model->common_table_data_insert($insert_data);            
                $this->session->set_flashdata('success', 'Email Template Data has been successfully added');
            }
            $redirect_url   =   "admin/settings/mail_template_view";
            redirect($redirect_url);
            
        }// end of form validation success
    }
}
