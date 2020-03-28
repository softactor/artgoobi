<?php
if (isset($users_info->status) && $users_info->status == 1) {
    $profiler = false;
    $user_logged_in = $this->session->userdata('user_logged_id');
    if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
        $profiler = true;
    }
    ?>
    <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 col-xl-3 left_panel_user_profile_details">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                
                <?php
                    if ($profiler) {
                ?>
                <a href="<?php echo base_url() ?>welcome/user_profile_image_upload"> 
                    <?php
                        if(isset($userProfileDetailsData->profile_image) && !empty($userProfileDetailsData->profile_image)){
                    ?>
                    <img src="<?php echo base_url(); ?>images/profile/<?php echo $userProfileDetailsData->profile_image; ?>" class="img-responsive img-thumbnail" alt="User Image" <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                    <?php
                        }else{ 
                    ?>
                    <img src="<?php echo base_url(); ?>images/default_avater.png" class="img-responsive img-thumbnail" alt="User Image"  <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                    <?php
                        }
                    ?>
                </a>
                    <?php }else{ ?>
                <a href="<?php echo base_url() ?>welcome/user_profile/<?php echo $users_data->id; ?>"> 
                    <?php
                        if(isset($userProfileDetailsData->profile_image) && !empty($userProfileDetailsData->profile_image)){
                    ?>
                    <img src="<?php echo base_url(); ?>images/profile/<?php echo $userProfileDetailsData->profile_image; ?>" class="img-responsive img-thumbnail" alt="User Image" <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                    <?php
                        }else{ 
                    ?>
                    <img src="<?php echo base_url(); ?>images/default_avater.png" class="img-responsive img-thumbnail" alt="User Image"  <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                    <?php
                        }
                    ?>
                </a>
                    <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <?php
                    if($profiler){
                ?>
                <div class="row">
                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                        <ul class="profile_menu_style">
                            <li>
                                <a href="#update_signup" data-toggle="modal" onclick="getProfileInfoById(<?php echo $userProfileDetailsData->user_id; ?>);">
                                    <img src="<?php echo base_url('images/icons/profile_edit.png'); ?>">
                                    Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>welcome/user_event_list">
                                    <img src="<?php echo base_url('images/icons/event_edit.png'); ?>">
                                    Manage Event
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>welcome/artist_image_upload">
                                    <img src="<?php echo base_url('images/icons/artwork_edit.png'); ?>">Upload Artwork
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url() ?>welcome/user_profile">
                                    <img src="<?php echo base_url('images/icons/artworks.png'); ?>"> Artworks
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>        
                <?php    }
                ?>
                <h3><?php echo $users_info->name; ?></h3>
                <?php
                    $proWhere['table']   =   'users_details';
                    $proWhere['where']   =   [
                        'user_id'   =>  $users_info->id
                    ];
                    $userData   =   get_user_profile_details($proWhere, $single=true);
                ?>
                    <h4>
                        <?php
                            if(isset($userData->present_desig) && !empty($userData->present_desig)){
                                echo $userData->present_desig;
                            }
                        ?>
                    </h4>
                    <h4>
                        <?php
                            if(isset($userData->present_working_area) && !empty($userData->present_working_area)){
                                echo $userData->present_working_area;
                            }
                        ?>
                    </h4>
                    <br>
                    <h4>
                        <?php
                            if(isset($userData->user_email) && !empty($userData->user_email)){
                                echo $userData->user_email;
                            }
                        ?>
                    </h4>
                    <br>    
                <?php
                    if(isset($userData->short_bio) && !empty($userData->short_bio)){
                ?>
                    <p>
                        <?php
                            echo $userData->short_bio;  
                        ?>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div> <!-- End of Users Data --->
    <?php
} else {
    if ($users_info->status == 2) {
        $info = "";
        $alert_class = "info";
        $info .= "<strong>Pending!</strong><br />";
        $info .= "Your profile active request is now pending.We will be updated shortly.";
    } elseif ($users_info->status == 0) {
        $info = "";
        $alert_class = "danger";
        $info .= "<strong>Inactive!</strong><br />";
        $info .= "Your profile is now In-active state.";
    }
    ?>
    <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 col-xl-3 left_panel_user_profile_details">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <img src="<?php echo base_url(); ?>images/default_avater.png" class="img-responsive img-thumbnail" alt="User Image">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="alert alert-<?php echo $alert_class; ?>">
                        <?php echo $info; ?>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>