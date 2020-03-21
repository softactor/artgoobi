<?php echo $header; ?>
<!-- Content Content Area Start -->
<div class="col-md-10">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <!-- here profile left pannel wil go -->
                <?php echo $profile_left_panel; ?>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Add work place Form -->
                            <div id="add_work_experience_form">
                                <form class="form-horizontal" id="profile_work_experience" action="<?php echo base_url("welcome/save_user_profile_work_experience") ?>" method="POST">                        
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="description">Description:</label>
                                        <div class="col-sm-10">
                                            <textarea id="experience_description" class="form-control mceEditor" rows="15" name="description" style="height: 250px;"><?php if(isset($experience_details)){ echo $experience_details; } ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">        
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="hidden" name="user_id" value="<?php echo $users_data->id; ?>">
                                            <input type="submit" class="btn btn-default" name="submit" value="Save">
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
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>