<?php
if (isset($users_info->status) && $users_info->status == 1) {
    $profiler = false;
    $user_logged_in = $this->session->userdata('user_logged_id');
    if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
        $profiler = true;
    }
    ?>
    <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3 col-xl-3">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <?php
                if ($profiler) {
                    ?>
                    <a href="<?php echo base_url() ?>profile/image_upload"> 
                        <?php
                        if (isset($userProfileDetailsData->profile_image) && !empty($userProfileDetailsData->profile_image)) {
                            ?>
                            <img src="<?php echo base_url(); ?>images/profile/<?php echo $userProfileDetailsData->profile_image; ?>" class="img-responsive img-thumbnail" alt="User Image" <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url(); ?>images/default_avater.png" class="img-responsive img-thumbnail" alt="User Image"  <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                            <?php
                        }
                        ?>
                    </a>
                <?php } else { ?>
                    <a href="<?php echo base_url() ?>profile/<?php echo $users_data->id; ?>"> 
                        <?php
                        if (isset($userProfileDetailsData->profile_image) && !empty($userProfileDetailsData->profile_image)) {
                            ?>
                            <img src="<?php echo base_url(); ?>images/profile/<?php echo $userProfileDetailsData->profile_image; ?>" class="img-responsive img-thumbnail" alt="User Image" <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                            <?php
                        } else {
                            ?>
                            <img src="<?php echo base_url(); ?>images/default_avater.png" class="img-responsive img-thumbnail" alt="User Image"  <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) { ?> title="Click to Upload profile image" <?php } ?>>
                            <?php
                        }
                        ?>
                    </a>
                <?php } // End of Profile check; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                <?php
                if ($profiler) {
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
                                    <a href="<?php echo base_url() ?>profile/events">
                                        <img src="<?php echo base_url('images/icons/event_edit.png'); ?>">
                                        Manage Event
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>profile/artwork_upload">
                                        <img src="<?php echo base_url('images/icons/artwork_edit.png'); ?>">Upload Artwork
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url() ?>profile">
                                        <img src="<?php echo base_url('images/icons/artworks.png'); ?>"> Artworks
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>        
                <?php }
                ?>
                <h3><?php echo $users_info->name; ?></h3>
                <?php
                $proWhere['table'] = 'users_details';
                $proWhere['where'] = [
                    'user_id' => $users_info->id
                ];
                $userData = get_user_profile_details($proWhere, $single = true);
                ?>
                <h4>
                    <?php
                    if (isset($userData->present_desig) && !empty($userData->present_desig)) {
                        echo $userData->present_desig;
                    }
                    ?>
                </h4>
                <h4>
                    <?php
                    if (isset($userData->present_working_area) && !empty($userData->present_working_area)) {
                        echo $userData->present_working_area;
                    }
                    ?>
                </h4>
                <br>
                <h4>
                    <?php
                    if (isset($userData->user_email) && !empty($userData->user_email)) {
                        echo $userData->user_email;
                    }
                    ?>
                </h4>
                <br>    
                <?php
                if (isset($userData->short_bio) && !empty($userData->short_bio)) {
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
    <?php }
?>