<?php
echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
    $profiler = true;
}
?>
<div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <!-- here profile left pannel wil go -->
            <?php echo $profile_left_panel; ?>
            <!-- Here artwork form block start -->
            <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="jumbotron text-center">
                            <h1 class="service_title">
                                <?php echo "Profile Image Upload" ?>
                            </h1>
                        </div>                    
                    </div>
                </div>
                <div class="profile_upload_message_section">
                    <?php
                    $sm = $this->session->flashdata('success_message');
                    $em = $this->session->flashdata('error_message');
                    if (isset($sm) && !empty($sm)) {
                        ?>
                        <div class="alert alert-success">
                            <?php echo $sm; ?>
                        </div>
                    <?php } ?>
                    <?php
                    if (isset($em) && !empty($em)) {
                        ?>
                        <div class="alert alert-danger">
                            <?php echo $em; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="box">
                    <div class="box-header"> 
                        <div class="pull-right">
                            <a href="<?php echo base_url() ?>welcome/user_profile" class="btn btn-xs btn-success" title="Create gallery">
                                <?php echo $users_info->name . " Profile" ?>
                            </a>
                        </div>
                    </div>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('welcome/user_profile_image_upload_process'); ?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="price">Image:<span class="required"></span></label>
                                                <div class="col-sm-8">          
                                                    <input type="file" name='user_profile_image'>
                                                    <span class='alert-danger'><?php echo form_error('user_profile_image'); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="user_profile_id" value="<?php echo $user_logged_in; ?>" >
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>        
