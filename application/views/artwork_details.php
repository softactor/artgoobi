<?php echo $header; ?>
<?php
if (isset($users_info->status) && $users_info->status == 1) {
    $profiler = false;
    $user_logged_in = $this->session->userdata('user_logged_id');
    if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
        $profiler = true;
    }
}
?>
<!--style="background-color: #f8f8d9;"-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
            <div class="row">
                <div class="col-sm-12 col-lg-12 col-xs-12 col-md-12 col-xl-12">
                    <div class="row">
                        <!-- here profile left panel will go -->
                        <?php echo $profile_left_panel; ?>
                        <!-- End profile left panel will go -->
                        <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9 col-xl-9">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <img class="img-responsive" src="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork_data->image_original; ?>" alt="<?php echo $artwork_data->title; ?>" title="<?php echo $artwork_data->title; ?>"/>
                                    <div class="pull-right edit_n_delete_link">
                                        <?php if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $userProfileDetailsData->user_id) { ?>
                                            <a href="<?php echo base_url('welcome/artwork_details_modify/' . $artist_id . '/' . $artwork_id); ?>">
                                                <img src="<?php echo base_url(); ?>images/icons/edit.png" title="Edit">
                                            </a>
                                            <a href="javascript:void(0)" onclick="deleteDataByIdAndTable('<?php echo $artwork_id; ?>', 'artwork_info')">
                                                <img src="<?php echo base_url(); ?>images/icons/delete.png" title="Delete">
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-artwork-details">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9 col-xl-9">
                                        <div class="blank-txt">
                                            <?php if (isset($artworkImageInfo) && !empty($artworkImageInfo)) {
                                                echo $artworkImageInfo;
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12 col-md-3 col-lg-3 col-xl-3">
                                        <div class="pull-right">
<!--                                            <div class="fb-share-button" data-href="<?php echo base_url('welcome/artwork_details/' . $artist_id . '/' . $artwork_id); ?>" data-layout="button" data-size="small">
                                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('welcome/artwork_details/' . $artist_id . '/' . $artwork_id); ?>;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a>
                                            </div>-->
                                            <!-- AddToAny BEGIN -->
                                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                                <a class="a2a_button_facebook"></a>
                                                <a class="a2a_button_twitter"></a>
                                                <a class="a2a_button_email"></a>
                                                <a class="a2a_button_pinterest"></a>
                                            </div>
                                            <script async src="https://static.addtoany.com/menu/page.js"></script>
                                            <!-- AddToAny END -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End of artwork large view-->

                            <!--Start artist other artwork block-->      
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                    <?php
                                    if (isset($galleries) && !empty($galleries)) {
                                        ?>
                                        <div class="front_art_work_wrapper">    
                                            <?php
                                            foreach ($galleries as $artwork) {
                                                if ($artwork_data->id != $artwork->id) {
                                                    ?>
                                                    <div class="artwork_image_holder">
                                                        <div class="inner">
                                                            <a href="<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>">
                                                                <img src="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" alt="img">
                                                            </a>
                                                        </div>
                                                    </div>
                                            <?php }
                                        } ?>
                                        </div>
<?php } ?>
                                </div>
                            </div>
                            <!--End artist other artwork block-->                             
                        </div>  
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-2">
<?php $this->view('layouts/advertisement'); ?>
        </div>
    </div>    
</div>
<?php echo $footer; ?>