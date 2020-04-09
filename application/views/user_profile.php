<?php
echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
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
                                        <?php echo $users_info->name." Artwork" ?>
                                    </h1>
                                </div>                    
                            </div>
                        </div>
                        <?php
                        if (isset($artworks_data) && !empty($artworks_data)) {
                            ?>
                            <div class="front_art_work_wrapper">    
                                <?php
                                foreach ($artworks_data as $artwork) {
                                    $custom_url     =   base_url('profile/artwork_details/' . $artwork->artist_id . '/' . $artwork->id."/".url_title($artwork->title, "-", true));
                                    ?>
                                    <div class="artwork_image_holder">
                                        <div class="inner">
                                            <a href="<?php echo $custom_url; ?>">
                                                <img src="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" alt="<?php echo $artwork->title; ?>" title="<?php echo $artwork->title; ?>">
                                            </a>
                                        </div>
                                    </div>
                            <?php } ?>
                            </div>
                        <div class="front_art_work_wrapper_small_device">
                        <div class="row">
                            <?php
                                foreach ($artworks_data as $artwork) {
                                    $custom_url     =   base_url('profile/artwork_details/' . $artwork->artist_id . '/' . $artwork->id."/".url_title($artwork->title, "-", true));
                            ?>
                            <a href="<?php echo $custom_url; ?>" rel="noopener">
                                <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix">
                                    <img class="img img-responsive" src="<?php echo base_url('uploads/artwork/' . $artwork->image_original); ?>" alt="img" />
                                    
                                </div>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
<?php } ?>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div> 
<span id="modal_open_area"></span>
<input type="hidden" id="delete_table_name" />
<input type="hidden" id="delete_id" />
<?php echo $footer; ?>