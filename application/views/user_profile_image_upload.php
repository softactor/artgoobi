<?php echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
    $profiler = true;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-10 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                    <div class="row">
                        <!-- here profile left pannel wil go -->
                        <?php echo $profile_left_panel; ?>
                        <!-- Here artwork form block start -->
                        <div class="col-md-9" style="padding: 0">
                            <h3 style="padding-left: 3%; text-decoration: underline; float: left; padding-bottom: 4%;">Profile Image upload</h3>
                            <div class="profile_upload_message_section">
                                <?php
                                    $sm     =   $this->session->flashdata('success_message');
                                    $em     =   $this->session->flashdata('error_message');
                                    if(isset($sm) && !empty($sm)){
                                ?>
                                <div class="alert alert-success">
                                    <?php echo $sm; ?>
                                </div>
                                <?php } ?>
                                <?php 
                                    if(isset($em) && !empty($em)){
                                ?>
                                <div class="alert alert-danger">
                                    <?php echo $em; ?>
                                </div>
                                <?php } ?>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('welcome/user_profile_image_upload_process'); ?>">
                                <div class="row">
                                    <div class="col col-md-12">
                                        <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="price">Image:<span class="required"></span></label>
                                                    <div class="col-sm-8">          
                                                        <input type="file" name='user_profile_image'>
                                                        <span class='alert-danger'><?php echo form_error('user_profile_image'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group pull-right">        
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <input type="hidden" name="user_profile_id" value="<?php echo $user_logged_in; ?>" >
                                                        <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>        
