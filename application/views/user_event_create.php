<?php
echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
    $profiler = true;
}
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
        <div class="row">
            <?php echo $profile_left_panel; ?>
            <div class="col-md-9 col-sm-12 col-xs-12 col-xl-9 col-xl-9">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                        <?php $this->load->view ('message_view_page');  ?>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                                <div class="jumbotron text-center">
                                    <h1 class="service_title">
                                        <?php echo "Create Event" ?>
                                    </h1>
                                </div>                    
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header"> 
                                <div class="pull-right">
                                    <a href="<?php echo base_url() ?>welcome/user_event_list" class="btn btn-xs btn-success" title="Create gallery">
                                        List
                                    </a>
                                </div>
                            </div>
                            <form id="exhibition" name="exhibition" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('welcome/process_event') ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Event Type&nbsp;<?php echo form_error('post_category', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <select name="post_category" class="form-control" id="post_category">
                                            <option value="">Please Select</option>
                                            <?php
                                            $orders['field']    =   'name';
                                            $orders['order']    =   'ASC';
                                            $event_types = get_all_data_by_table("event_types", $orders);
                                            foreach ($event_types as $event_type) {
                                                ?>
                                                <option value="<?php echo $event_type->id; ?>" <?php if(isset($_POST['post_category']) && $_POST['post_category']==$event_type->id){ echo 'selected'; } ?>><?php echo $event_type->name; ?></option>
                                            <?php } ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Event Title &nbsp;<?php echo form_error('title', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php echo set_value('title'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Start Date &nbsp;<?php echo form_error('start_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input type="text" class="form-control" id="event_start_date" name="start_date" autocomplete="off" placeholder="Enter Start Date" value="<?php echo set_value('start_date'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">End Date &nbsp;<?php echo form_error('end_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input type="text" class="form-control" id="event_end_date" name="end_date" autocomplete="off" placeholder="Enter End Date" value="<?php echo set_value('end_date'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="venue_name">Venue name &nbsp;<?php echo form_error('venue_name', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input type="text" class="form-control" id="venue_name" name="venue_name" placeholder="Enter Venue Name" value="<?php echo set_value('venue_name'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Details &nbsp;<?php echo form_error('descriptions', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <textarea class="form-control" rows="3" name="descriptions" placeholder="Enter descriptions"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Time &nbsp;<?php echo form_error('post_time', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input type="text" class="form-control" id="post_time" name="post_time" placeholder="Enter Event time" value="<?php echo set_value('post_time'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Cover Image<?php echo form_error('featured_image', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input type="file" id="featured_image" name="featured_image">
                                        <p class="help-block">(Width: 750px & Height 500px).</p>
                                    </div>                                
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Create" />
                                </div>
                            </form>
                        </div>
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
