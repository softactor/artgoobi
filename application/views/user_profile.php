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
                        <?php
                        if (isset($artworks_data) && !empty($artworks_data)) {
                            ?>
                            <div class="front_art_work_wrapper">    
                                <?php
                                foreach ($artworks_data as $artwork) {
                                    ?>
                                    <div class="artwork_image_holder">
                                        <div class="inner">
                                            <a href="<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>">
                                                <img src="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" alt="img">
                                            </a>
                                        </div>
                                    </div>
                            <?php } ?>
                            </div>
                        <div class="front_art_work_wrapper_small_device">
                        <div class="row">
                            <?php
                                foreach ($artworks_data as $artwork) {
                            ?>
                                <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix">
                                    <img class="img img-responsive" src="<?php echo base_url('uploads/artwork/' . $artwork->image_original); ?>" alt="img" />
                                    <a class="btn btn-block btn-success" href="<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>" target="_blank" rel="noopener">View Details</a>
                                </div>
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