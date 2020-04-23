<?php
echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
$profile_link_name = $this->session->userdata('profile_link_name');
$profileLink       = (isset($profile_link_name) && !empty($profile_link_name) ? $profile_link_name : $userProfileDetailsData->profile_link_name);
if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
    $profiler = true;
}
?>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-sm-12 col-xs-12">
        <div class="row">
                <?php echo $profile_left_panel; ?>
            <div class="col-md-9 col-xl-9 col-lg-9 col-sm-12 col-xs-12" style="padding: 0">
<?php if ($profiler == true && $users_info->status == 1) { ?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix" style="margin-bottom: 2px;">
                            <div class="alert alert-success" id="success_message" style="display: none;">
                                <strong>Success!</strong> <span id="message"></span>
                            </div>
                            <div class="alert alert-danger" id="error_message" style="display: none;">
                                <strong>Error!</strong> <span id="message"></span>
                            </div>
                            <!--<a href="<?php echo base_url() ?>welcome/artist_image_upload">Upload Image</a>-->
                        </div>
                    </div>
<?php } ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix">
                        <div class="row">
                            <div id="faq" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="jumbotron text-center">
                                    <h1 class="service_title">
                                        <?php echo $users_info->name." Artwork<br>" ?>
                                        <span style="text-transform: lowercase; font-size: 12px; color: #6c8cc7;" class="profile_link_hints"><?php echo base_url().$profileLink; ?></span>
                                    </h1>
                                </div>                    
                            </div>
                        </div>
                        <!--
                        * the following view file is responsible for 
                        * common artwork show.
                        * Need variable name as " $artworks_data "                        
                        -->
                        <?php $this->view('partial/artwork_info/general_artwork_show_view'); ?>                        
                    </div>
                </div>
                <?php if($profiler && (isset($pending_artwork_data) && !empty($pending_artwork_data))){ ?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="alert alert-warning text-center" role="alert">
                                    Pending Artwork For Admin Approval!
                              </div>                   
                            </div>
                        </div>
                        <!--This is a warning alert—check it out!
                              </div>
                        * the following view file is responsible for 
                        * common artwork show.
                        * Need variable name as " $artworks_data "                        
                        -->
                        <?php 
                        $data['artworks_data']  =   $pending_artwork_data;
                        $this->view('partial/artwork_info/general_artwork_show_view', $data); 
                        ?>                        
                    </div>
                </div>
                <?php } ?>
            </div>  
        </div>
    </div>
</div> 
<span id="modal_open_area"></span>
<input type="hidden" id="delete_table_name" />
<input type="hidden" id="delete_id" />
<?php echo $footer; ?>