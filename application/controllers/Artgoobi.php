<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Artgoobi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }
    
    public function get_artgoobi_url($url_name){
        
        switch($url_name){
            case 'home':
                echo $url_name;
                break;
            case 'about_us':
                $data  = $this->load_about_us();
                $this->load->view('about_us', $data);
                break;
            case 'exhibitions':
                $data = $this->load_exhibition_list();
                $this->load->view('exhibition_list', $data);
                break;
            case 'events':
                $data = $this->load_event_list();
                $this->load->view('event_list', $data);
                break;
            case 'gallery':
                $data = $this->load_gallery_list();
                $this->load->view('gallery/gallery_list', $data);
                break;
            case 'faq':
                $data  = $this->load_faq();
                $this->load->view('faq', $data);
                break;
            case 'contact_us':
                $data  = $this->load_contact_us();
                $this->load->view('contact_us', $data);
                break;
            case 'terms_and_conditions':
                $data  = $this->load_terms_and_conditions();
                $this->load->view('terms_condition', $data);
                break;
            case 'profile':
                $data  = $this->load_user_profile();
                $this->load->view('user_profile', $data);
                break;
            case 'admin':
                $this->load->view('login');
                break;
            default:
                $data  = $this->load_user_profile($url_name);
                $this->load->view('user_profile', $data);
                break;
        }
        
    }    
    
    /*
     * ***********************LOAD ABOUT US*************************************
     */
    public function load_about_us(){
        $data['title'] = "Artgoobi | About Us";
        $data['active_menu'] = "about";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', '', true);
        return $data;
    }
    
    /*
     * ***********************LOAD Exhibition***********************************
     */
    public function load_exhibition_list(){
        $data['title'] = "Artgoobi | Exhibition";
        $data['active_menu'] = "exhibition";
        $get_data ['table'] = "post_data";
        $get_data ['where']['post_type'] = 1;
        $artwork_data = $this->common_model->common_table_data_read($get_data);
        $data['exhibitions'] =   $artwork_data['data'];
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        return $data;
    }
    
    /*
     * ***********************LOAD Events***************************************
     */
    public function load_event_list(){        
        $get_data ['table'] = "post_data";
        $get_data ['where']['post_type'] = 3;
        $artwork_data = $this->common_model->common_table_data_read($get_data);
        $data['exhibitions'] =   $artwork_data['data'];
        $data['title']                  = "Artgoobi | Art around you";
        $data['active_menu'] = "event";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        return $data;
    }
    
    public function load_gallery_list(){   
        $data['title']                  = "Artgoobi | Gallery";
        $data['active_menu'] = "gallery";
        // Read All User Data
        
        $gallery_sql                    = "SELECT * FROM `artwork_info` WHERE status=1 ORDER BY RAND(), create_time DESC";
        $query                          = $this->db->query($gallery_sql);
        $data['galleries']              = $query->result();
        
        $data['title'] = "Artgoobi | Artwork Details";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        return $data;
    }
    /*
     * ***********************LOAD FAQ******************************************
     */
    public function load_faq() {
        $data['title'] = "Artgoobi | FAQ";
        $data['active_menu'] = "contact";
        $get_data ['table']                 = "post_data";
        $get_data ['where']['post_type']    = 4; // Only FAQ Data;
        $data['faq_data']                   = $this->common_model->common_table_data_read($get_data);
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        return $data;        
    }
    /*
     * ***********************LOAD CONTACT US***********************************
     */
    public function load_contact_us() {
        $data['title'] = "Artgoobi | Contact Us";
        $data['active_menu'] = "contact";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', $data, true);
        return $data;
    }
    /*
     * ***********************LOAD TERMS AND CONDITION**************************
     */
    public function load_terms_and_conditions(){
        $data['active_menu'] = "terms";
        $data['title'] = "Artgoobi | About Us";
        $data['top_menu'] = $this->load->view('layouts/top_menu', $data, true);
        $data['header'] = $this->load->view('layouts/header', $data, true);
        $data['footer'] = $this->load->view('layouts/footer', '', true);
        return $data;
    }
    
    /*
     * ***********************LOAD User Profile*********************************
     */
    public function load_user_profile($artist_id = null) {
        $user_logged_in_status = $this->session->userdata('user_logged_in_status');
        $user_logged_in = $this->session->userdata('user_logged_id');
        if (isset($artist_id) && !empty($artist_id)) {
            if(is_numeric($artist_id)){
                $artist_id  = $artist_id;
            }else{
                $artist_id_res  = get_artist_id_by_profile_link_name($artist_id);
                if($artist_id_res){
                    $artist_id  = $artist_id_res;
                }else{
                    $red_url = base_url();
                    redirect($red_url);
                }
            }
            $user_logged_in = $artist_id;
        } else {
            if (!isset($user_logged_in_status) && empty($user_logged_in_status)) {
                $red_url = base_url();
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
        return $data;
    }
}
