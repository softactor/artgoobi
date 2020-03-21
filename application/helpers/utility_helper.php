<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function get_positions(){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('id,name')
        ->get('positions');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
}
function get_groups($group_type=null){
    $CI = get_instance();
    $CI->load->database();
    if(isset($group_type)){
        $query = $CI->db->where('group_type',$group_type);
    }
    $query = $CI->db->select('id,name')
        ->get('groups');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
}
function get_user_type(){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('id,name')
            ->where('id!= ',4)
        ->get('user_type');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
}
function get_panel(){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('id,title,icon_class,op_details')
            ->order_by('menu_order','asc')
        ->get('panel');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
}
function get_user_type_name($id){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('name')
            ->where('id',$id)
        ->get('user_type');
    if ($query->num_rows() > 0) {
        return $query->row()->name;
    } else {
        return false;
    }
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function check_user_ip_validity($ip_validit){
    if ($ip_validit['client_ip'] <= $ip_validit['range_to'] && $ip_validit['range_from'] <= $ip_validit['client_ip']) {
        return true;
    }else{
        return false;
    }
}
function has_main_menu_access($data){
    $feedback = false;
    $user_type_id = $data['user_type'];
    if($user_type_id==4){
        return true;
    }
    $menu_id = $data['menu_id'];
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('is_all_access,access_details')
            ->where('user_type',$user_type_id)
        ->get('access_control');
    if ($query->num_rows() > 0) {
        $access =  $query->row();
        if($access->is_all_access){
            return true;
        }
        $access_details = json_decode($access->access_details);
        if(isset($access_details) && !empty($access_details)){
            foreach($access_details as $chk){
                if($chk->menu_id==$menu_id){
                    if($data['meny_type']==1){
                        return true;
                    }
                    if($data['meny_type']==2){
                        foreach($chk->access as $acc){
                            if(isset($acc->Add) && $data['sub_menu']=='add'){
                                return true;
                            }
                            if(isset($acc->Edit) && $data['sub_menu']=='edit'){
                                return true;
                            }
                            if(isset($acc->Delete) && $data['sub_menu']=='delete'){
                                return true;
                            }
                        }
                    }
                }//if menu check end;
            }//end of foreach
        }// end of isset
        return $feedback;
    } else {
        return false;
    }
}
function get_all_data_by_table($table, $orderBy = null){
    $CI = get_instance();
    $CI->load->database();
    if(isset($orderBy) && !empty($orderBy)){
        $query = $CI->db->select('*')
        ->order_by($orderBy['field'],$orderBy['order'])
        ->get($table);
    }else{
        $query = $CI->db->select('*')
        ->get($table);
    }
    
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return false;
    }
}
function all_user_status(){
    $user_type = [
        '1'=>'Active',
        '0'=>'Inctive',
        '2'=>'Pending',
    ];
    return $user_type;
}
function get_user_profile_details($param, $single=false){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('*')
        ->where($param['where'])
        ->get($param['table']);
    if ($query->num_rows() > 0) {
        if($single){
            return $query->row();
        }else{
            return $query->result();
        }        
    } else {
        return false;
    }
}
function get_table_data_by_param($param, $single=false){
    $CI = get_instance();
    $CI->load->database();    
    if(isset($param['order']) && !empty($param['order'])){
        $query = $CI->db->select('*')
                ->where($param['where'])
                ->order_by($param['field'],$param['order'])
                ->get($param['table']);
    }else{
        $query = $CI->db->select('*')
        ->where($param['where'])
        ->get($param['table']);
    }
    if ($query->num_rows() > 0) {
        if($single){
            return $query->row();
        }else{
            return $query->result();
        }        
    } else {
        return false;
    }
}
function profile_authentication_check(){
    $CI = & get_instance();
    $user_logged_in_status = $CI->session->userdata('user_logged_in_status');
    $user_logged_in = $CI->session->userdata('user_logged_id');
    if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
        $red_url = base_url() . 'welcome/';
        redirect($red_url);
    }else{
        return $user_logged_in;
    }
}
function table_row_count_by_param($param){
    $CI = get_instance();
    $CI->load->database();
    if(isset($param['where']) && !empty($param['where'])){
        $CI->db->where($param['where']);
    }
    $CI->db->from($param['table']);
    return $CI->db->count_all_results();
}
function check_duplicate_data($param){
    $CI = get_instance();
    $CI->load->database();
    if(isset($param['where']) && !empty($param['where'])){
        $CI->db->where($param['where']);
    }
    $CI->db->from($param['table']);
    return $CI->db->count_all_results();
}
function human_format_date($timestamp){
    return date("F jS, Y h:i:s", strtotime($timestamp)); //September 30th, 2013
}
//Relative Date Function

function relative_date($time) {

    $today = strtotime(date('M j, Y'));

    $reldays = ($time - $today) / 86400;

    if ($reldays >= 0 && $reldays < 1) {

        return 'Today';
    } else if ($reldays >= 1 && $reldays < 2) {

        return 'Tomorrow';
    } else if ($reldays >= -1 && $reldays < 0) {

        return 'Yesterday';
    }

    if (abs($reldays) < 7) {

        if ($reldays > 0) {

            $reldays = floor($reldays);

            return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
        } else {

            $reldays = abs(floor($reldays));

            return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';
        }
    }

    if (abs($reldays) < 182) {

        return date('l, j F', $time ? $time : time());
    } else {

        return date('l, j F, Y', $time ? $time : time());
    }
}
function get_artwork_attribute_name($id, $table){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('name')
            ->where('id',$id)
        ->get($table);
    if ($query->num_rows() > 0) {
        return $query->row()->name;
    } else {
        return false;
    }
}
function str_short($string, $limit) {
    $len = strlen($string);
    if ($len > $limit) {
        $to_sub = $len - $limit;
        $crop_temp = substr($string, 0, -$to_sub);
        return $crop_len = $crop_temp . "...";
    } else {
        return $string;
    }
}
function userProfileDetailsdataByUserId($user_id){
    $usersTypes = [6,7,8];
        $columns ='
            u.id as user_id,
            u.name,
            u.user_email,
            u.user_type,
            u.status,
            ut.name as user_type_name,
            ud.first_name,
            ud.last_name,            
            ud.gender,            
            ud.country_id, 
            ud.zip_code,
            ud.present_desig,
            ud.present_working_area,
            ud.previous_working_area,
            ud.short_bio,
            ud.profile_image,
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
        $get_data ['where']['u.id'] = $user_id;
        $get_data ['where_in']['values'] = $usersTypes; 
        return get_all_data_by_joining_table($get_data, true);
}
function get_all_data_by_joining_table($data, $single=false, $orderBy = null){
    $CI = get_instance();
    $CI->load->database();
    if(isset($data['join']['table']) && !empty($data['join']['table'])){        
        $table_join_count = count($data['join']['table']);
        for($i=0; $i<$table_join_count;$i++){
            $CI->db->join($data['join']['table'][$i], $data['join']['join_field'][$i], $data['join']['join_type'][$i]);
        }
    }
    if(isset($data['date_range']) && !empty($data['date_range'])){
        if(isset($data['date_range']['from']) && !empty($data['date_range']['from'])){
            $CI->db->where($data['date_range']['from']['field'],$data['date_range']['from']['values']);
        }
        if(isset($data['date_range']['to']) && !empty($data['date_range']['to'])){
            $CI->db->where($data['date_range']['to']['field'],$data['date_range']['to']['values']);
        }
    }
    if(isset($orderBy) && !empty($orderBy)){
        $CI->db->order_by($orderBy['field'],$orderBy['order']);
    }
    if(isset($data['where']) && !empty($data['where'])){
        $CI->db->where($data['where']);
    }
    if(isset($data['where_in']) && !empty($data['where_in'])){
        $CI->db->where_in($data['where_in']['field'],$data['where_in']['values']);
    }    
    if(isset($data['where_not_in']) && !empty($data['where_not_in'])){
        $CI->db->where_not_in($data['where_not_in']['field'],$data['where_not_in']['values']);
    }
    
    if(isset($data['group_by']) && !empty($data['group_by'])){
        $CI->db->group_by($data['group_by']);
    }
    if(isset($data['limit']) && !empty($data['limit'])){
        $CI->db->limit($data['limit']);
    }
    if(isset($data['columns']) && !empty($data['columns'])){
        $query = $CI->db->select($data['columns'])
                ->get($data['table']);
    }else{
        $query = $CI->db->select("*")
                ->get($data['table']);
    }
    if ($query->num_rows() > 0) {   
        if($single){
            return $query->row();
        }else{
            return $query->result();
        }
    } else {
        return false;
    }
}
function get_settings_value_by_key($key){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('setting_value')
            ->where('setting_key',$key)
        ->get('settings');
    if ($query->num_rows() > 0) {
        return $query->row()->setting_value;
    } else {
        return false;
    }
}
function get_artwork_image_details_page($artworkData){
    $CI = get_instance();
    $type_of_art                =   $artworkData->type_of_art_id;
    $type_name                  =   get_artwork_attribute_name($type_of_art, 'artwork_type');
    $data['artwork_type_id']    =   $type_of_art;
    $data['artwork_data']       =   $artworkData;
    switch($type_name){
        case 'Painting':
            $artwork_form   =   $CI->load->view('partial/artwork_info/painting_info', $data, true);
            break;
        case 'Print':
            $artwork_form   =   $CI->load->view('partial/artwork_info/print_info', $data, true);
            break;
        case 'Sclupture':
            $artwork_form   =   $CI->load->view('partial/artwork_info/sculpture_info', $data, true);
            break;
        case 'Design':
            $artwork_form   =   $CI->load->view('partial/artwork_info/design_info', $data, true);
            break;
        case 'Photography':
            $artwork_form   =   $CI->load->view('partial/artwork_info/photography_info', $data, true);
            break;
        case 'Craft':
            $artwork_form   =   $CI->load->view('partial/artwork_info/craft_info', $data, true);
            break;
        case 'Video':
            $artwork_form   =   $CI->load->view('partial/artwork_info/video_info', $data, true);
            break;
        case 'Installation':
            $artwork_form   =   $CI->load->view('partial/artwork_info/installation_info', $data, true);
            break;
        case 'Performance':
            $artwork_form   =   $CI->load->view('partial/artwork_info/performance_info', $data, true);
            break;
        case 'Others':
            $artwork_form   =   $CI->load->view('partial/artwork_info/others_info', $data, true);
            break;
        default:
            $artwork_form   =   null;
    }

    $feedback   =   [
        'status'    => 'success',
        'message'   => 'Data Form Found',
        'data'      => $artwork_form,
        'type_name' => $type_name
    ];
    return $artwork_form;
}
function get_artwork_edit_form($artworkData) {
    $CI = get_instance();
    $type_of_art = $artworkData->type_of_art_id;
    $type_name = get_artwork_attribute_name($type_of_art, 'artwork_type');
    $data['artwork_type_id'] = $type_of_art;
    $data['artwork_data'] = $artworkData;
    switch ($type_name) {
        case 'Painting':
            $artwork_form = $CI->load->view('partial/forms/painting_form_edit', $data, true);
            break;
        case 'Print':
            $artwork_form = $CI->load->view('partial/forms/print_form_edit', $data, true);
            break;
        case 'Sclupture':
            $artwork_form = $CI->load->view('partial/forms/sculpture_form_edit', $data, true);
            break;
        case 'Design':
            $artwork_form = $CI->load->view('partial/forms/design_form_edit', $data, true);
            break;
        case 'Photography':
            $artwork_form = $CI->load->view('partial/forms/photography_form_edit', $data, true);
            break;
        case 'Craft':
            $artwork_form = $CI->load->view('partial/forms/craft_form_edit', $data, true);
            break;
        case 'Video':
            $artwork_form = $CI->load->view('partial/forms/video_form_edit', $data, true);
            break;
        case 'Installation':
            $artwork_form = $CI->load->view('partial/forms/installation_form_edit', $data, true);
            break;
        case 'Performance':
            $artwork_form = $CI->load->view('partial/forms/performance_form_edit', $data, true);
            break;
        case 'Others':
            $artwork_form = $CI->load->view('partial/forms/others_form_edit', $data, true);
            break;
    }

    $feedback = [
        'status' => 'success',
        'message' => 'Data Form Found',
        'data' => $artwork_form,
        'type_name' => $type_name
    ];
    return $artwork_form;
}
function select_data_by_search($search_item) {
    $CI = get_instance();
    $CI->load->database();
    $searcheData    =    $CI->db->like('artist_name', $search_item)
                        ->or_like('title', $search_item)
                        ->or_like('formate', $search_item)
                        ->or_like('year', $search_item)
                        ->or_like('price', $search_item)
                        ->or_like('video_format', $search_item)
                        ->or_like('collector_name', $search_item)
                        ->where('status', 1)
                        ->get('artwork_info')->result();
    if(isset($searcheData) && !empty($searcheData)){
        return $searcheData;
    }else{
        return false;
    }
}
function select_data_by_advance_search($searchParam){
    $CI = get_instance();
    $CI->load->database();
    $query = $CI->db->select('*');
    if(isset($searchParam['artist_id']) && !empty($searchParam['artist_id'])){
        $query = $CI->db->where('artist_id',$searchParam['artist_id']);
    }
    if(isset($searchParam['type']) && !empty($searchParam['type'])){
        $query = $CI->db->where('type_of_art_id',$searchParam['type']);
    }
    if(isset($searchParam['media']) && !empty($searchParam['media'])){
        $query = $CI->db->where('formate',$searchParam['media']);
    }
    if(isset($searchParam['size_start']) && !empty($searchParam['size_start'])){
        $query = $CI->db->where('',$searchParam['size_start']);
    }
    if(isset($searchParam['size_end']) && !empty($searchParam['size_end'])){
        $query = $CI->db->where('',$searchParam['size_end']);
    }
    if(isset($searchParam['price_start']) && !empty($searchParam['price_start'])){
        $query = $CI->db->where('price >= ',$searchParam['price_start']);
    }
    if(isset($searchParam['price_end']) && !empty($searchParam['price_end'])){
        $query = $CI->db->where('price <= ',$searchParam['price_end']);
    }
    if(isset($searchParam['year_start']) && !empty($searchParam['year_start'])){
        $query = $CI->db->where('year >= ',$searchParam['year_start']);
    }
    if(isset($searchParam['year_end']) && !empty($searchParam['year_end'])){
        $query = $CI->db->where('year <= ',$searchParam['year_end']);
    }
    $searcheData = $CI->db->get('artwork_info')->result();
    if(isset($searcheData) && !empty($searcheData)){
        return $searcheData;
    }else{
        return false;
    }
}
//functions to loop day,month,year
function formDay(){
    for($i=1; $i<=31; $i++){
        $selected = ($i==date('n'))? ' selected' :'';
        echo '<option'.$selected.' value="'.$i.'">'.$i.'</option>'."\n";
    }
}
//with the -8/+8 month, meaning june is center month
function formMonth(){
    $month = strtotime(date('Y').'-'.date('m').'-'.date('j').' - 8 months');
    $end = strtotime(date('Y').'-'.date('m').'-'.date('j').' + 8 months');
    while($month < $end){
        $selected = (date('F', $month)==date('F'))? ' selected' :'';
        echo '<option'.$selected.' value="'.date('F', $month).'">'.date('F', $month).'</option>'."\n";
        $month = strtotime("+1 month", $month);
    }
}
function formYear($startYear = false){
    if($startYear){
        $i  =   $startYear;
    }else{
        $i  =   1950;
    }
    for($i; $i<=date('Y'); $i++){
        $selected = ($i==date('Y'))? ' selected' :'';
        echo '<option'.$selected.' value="'.$i.'">'.$i.'</option>'."\n";
    }
}
function setActiveMenuClass($menuName,  $currentMenu){
    if($menuName == $currentMenu){
        return 'active';
    }else{
        return 'inactive';
    }
}
function is_post_eligible_to_show($startdate, $enddate, $timeEnable =   false){
    $todaysDate     =   date('Y-m-d');
    if($todaysDate <= $enddate){
        return true;
    }else{
        return false;
    }
}

function get_invitation_details(){
    $param['table']           =   "artist_invitation_details";    
    $totalInvitation          =   table_row_count_by_param($param);
    $param['where']           =   [
        'is_active'           =>    1
    ];
    $totalActiveInvitation    =   table_row_count_by_param($param);
    
    $feedbackData   =   [
        'total_invitation'      => $totalInvitation,
        'active_invitation'     => $totalActiveInvitation,
        'pending_invitation'   => ($totalInvitation-$totalActiveInvitation),
    ];
    
    return $feedbackData;
}

function generate_secrate_key(){
    $CI             = get_instance();
    $CI->load->helper('string');
    $random_key     = random_string('alnum',10);
    return $random_key;
}
