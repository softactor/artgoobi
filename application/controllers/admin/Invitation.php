<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invitation extends CI_Controller {
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
        $data['header'] = $this->load->view('dashboard/header','',TRUE);
        $data['menuName']   =   'Invitation';
        $data['menu'] = $this->load->view('dashboard/menu',$data,TRUE);
        $data['footer'] = $this->load->view('dashboard/footer','',TRUE);
        $this->load->view('dashboard/invitation/all_invitation',$data);
    }
    
    public function process_invitation(){

        $fileHaveError      = false;
        $importSuccess      = 0;
        $importError        = 0;
        $fileErrorMessage   = [];
        $allowed            = array('csv');
        $filename           = $_FILES['invitation_csv_email']['name'];
        $invited_email      =   $this->input->post("invited_email");
        if(isset($filename) && !empty($filename)){
            if ($_FILES['invitation_csv_email']['error'] > 0) {
                $fileHaveError                      = true;
                $this->session->set_flashdata('file_error', 'Please select an import file first');
            }
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed)) {
                $fileHaveError = true;
                $this->session->set_flashdata('file_error', 'Please import only CSV file');
            }
            if (!$fileHaveError) {
                $event_business_owners_details_procced = true;
                $unsuccessEmailContainer = [];
                $csv_data = [];
                $company_data_check = [];
                $profiler = [];
                $file = $_FILES['invitation_csv_email']['tmp_name'];
                $csvdata = $this->csvToArray($file);
                if (isset($csvdata) && !empty($csvdata)) {
                    foreach ($csvdata as $d) {
                        $dupData['table']                   =   "artist_invitation_details";
                        $dupData['where']['is_active']      =   1;
                        $dupData['where']['invited_email']  =   $d[1];
                        $isDuplicate    =   check_duplicate_data($dupData, 'created_at');
                        if(!$isDuplicate){
                            $invitation_details[]  = [
                                'invited_email'         => $d[1],
                                'is_sent'               => 0,
                                'is_approve'            => 1,
                                'secret_key'            => generate_secrate_key(),
                                'created_at'            => date('Y-m-d H:i:s')
                            ];
                            $total_data++;
                        }                        
                    }

                    $this->db->insert_batch('artist_invitation_details', $invitation_details);                        
                } else {
                    $this->session->set_flashdata('error', 'Error in csv file.');
                    $redirect_url   =   "admin/invitation";
                    redirect($redirect_url);
                }
            }
        }
        if(isset($invited_email) && !empty($invited_email)){
            $invitation_details     =   [];
            $dupData['table']                   =   "artist_invitation_details";
            $dupData['where']['is_active']      =   1;
            $dupData['where']['invited_email']  =   $invited_email;
            $isDuplicate    =   check_duplicate_data($dupData);
            if(!$isDuplicate){
                $invitation_details[]  = [
                    'invited_email'         => $invited_email,
                    'is_sent'               => 0,
                    'is_approve'            => 1,
                    'secret_key'            => generate_secrate_key(),
                    'created_at'            => date('Y-m-d H:i:s')
                ];
                $total_data++;
            }
            $this->db->insert_batch('artist_invitation_details', $invitation_details);
        }
        $this->session->set_flashdata('success', 'Invitation is processing');
        $redirect_url   =   "admin/invitation";
        redirect($redirect_url);
    }
    
    public function csvToArray($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        $count = 1;
        if (($handle = fopen($filename, 'r')) !== false) {
            while ($row = fgetcsv($handle)) {
                if ($count == 1) {
                    $count++;
                    continue;
                }
                $data[] = $row;
            }
            fclose($handle);
        }
        return $data;
    }
    
    public function send_invitation(){
        $cronjob_key =  "email_invitation";
        $this->db->select('id,is_status');
        $this->db->where(array('cronjob_key' => $cronjob_key));
        $query  =   $this->db->get('cronjobs');
        $cronjobData = $query->row();
        if(!$cronjobData->is_status){
            $fields_data = [
                'is_status' => 1,
            ];
            $updateData['where']['id']  =   $cronjobData->id;
            $updateData['table']        =   "cronjobs";
            $updateData['fields']       =   $fields_data;
            
            $this->common_model->common_table_data_update($updateData);
            
            $get_data ['table']                 = "artist_invitation_details";
            $get_data ['where']['is_approve']   = 1; // Only Events Data;
            $get_data ['where']['is_sent']      = 0; // Only Events Data;
            $get_data ['where']['is_status']    = 0; // Only Events Data;
            $limit                              =   10;
            $all_data = $this->common_model->common_table_data_read($get_data, $limit);
            if(isset($all_data['data']) && !empty($all_data['data'])){
                foreach($all_data['data'] as $data){
                    $emailParam['to_email']     =   $data->invited_email;
                    $emailParam['secret_key']   =   $data->secret_key;
                    $emailParam['id']           =   $data->id;
                    $this->send_invitation_email($emailParam);
                    
                }
            }
            $fields_data = [
                'is_status' => 0,
            ];
            $updateData['where']['id']  =   $cronjobData->id;
            $updateData['table']        =   "cronjobs";
            $updateData['fields']       =   $fields_data;
            
            $this->common_model->common_table_data_update($updateData);
        }
        
        $feedback   =   [
            'status'=> "success",
            'message'=> "success"
        ];
        
        echo json_encode($feedback);
    }
    
    public function send_invitation_email($emailParam) {
        $htmlContent = '';
        $config = Array(
            'protocol' => 'mail',
            'smtp_host' => 'sg3plcpnl0094.prod.sin3.secureserver.net',
            'smtp_port' => 465,
            'smtp_user' => 'admin.info@artgoobi.com',
            'smtp_pass' => ')WjSavN27ULe',
            'mailtype' => 'html',
            'newline' => "\r\n",
            'crlf' => "\r\n",
            'wordwrap' => "TRUE",
            'validate' => "FALSE",
        );
        $data['link'] = base_url() . 'profile/registration?secret_key=' . $emailParam['secret_key'];
        $this->email->initialize($config);
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        //Email content
        $htmlContent    =   $this->load->view('dashboard/invitation/invitation_email_template', $data, true);
        $this->email->to($emailParam['to_email']);
        $this->email->from('info@artgoobi.com', 'Artgoobi');
        $this->email->subject('Artgoobi Artist Registration');
        $this->email->message($htmlContent);

//Send email
        $checkEmail = $this->email->send();
        $eData = $this->email->print_debugger();
        if (!$checkEmail) {
            $message    =   $this->email->print_debugger();            
        }else{
            $message    =  "Invitation email have been successfully send.";
            $fields_data = [
                'remarks'       => $message,
                'is_sent'       => 1,
                'is_active'     => 0,
                'is_status'     => 1,
                'invited_time'  => date("Y-m-d H:i:s"),
            ];
            $updateData['fields']       =   $fields_data;
        }
            
        $updateData['where']['id']  =   $emailParam['id'];
        $updateData['table']        =   "artist_invitation_details";                        
        $this->common_model->common_table_data_update($updateData);
        return true;
    }

    public function test_email_template(){
        $this->load->view('dashboard/invitation/invitation_email_template');
    }
}
?>
