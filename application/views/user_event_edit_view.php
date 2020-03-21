<?php
echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
    $profiler = true;
}
?>
<!--style="background-color: #f8f8d9;"-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                    <div class="row">
<?php echo $profile_left_panel; ?>
                        <div class="col-md-9" style="padding: 0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-header">                                            
                                            <div class="box-body table-responsive no-padding">
                                                <form id="exhibition" name="exhibition" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('welcome/process_update_event') ?>">
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
                                                                    <option value="<?php echo $event_type->id; ?>" <?php if(isset($post_data->post_category) && $post_data->post_category==$event_type->id){ echo 'selected'; } ?>><?php echo $event_type->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <span class="help-block"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Event Title<?php echo form_error('title', '<span class="form_fields_error">', '</span>'); ?></label>
                                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php
                                                            $set_val = set_value('title');
                                                            if (isset($post_data->title)) {
                                                                echo $post_data->title;
                                                            } elseif (isset($set_val)) {
                                                                echo set_value('title');
                                                            }
                                                            ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Start Date<?php echo form_error('start_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                                            <input type="text" class="form-control" id="event_start_date" name="start_date" placeholder="Enter Start Date" value="<?php
                                                            $set_val = set_value('start_date');
                                                            if (isset($post_data->start_date)) {
                                                                echo date('d/m/Y', strtotime($post_data->start_date));
                                                            } elseif (isset($set_val)) {
                                                                echo set_value('start_date');
                                                            }
                                                            ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">End Date<?php echo form_error('end_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                                            <input type="text" class="form-control" id="event_end_date" name="end_date" placeholder="Enter End Date" value="<?php
                                                            $set_val = set_value('end_date');
                                                            if (isset($post_data->end_date)) {
                                                                echo date('d/m/Y', strtotime($post_data->end_date));
                                                            } elseif (isset($set_val)) {
                                                                echo set_value('end_date');
                                                            }
                                                            ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="venue_name">Venue Name<?php echo form_error('venue_name', '<span class="form_fields_error">', '</span>'); ?></label>
                                                            <input type="text" class="form-control" id="venue_name" name="venue_name" placeholder="Enter Venue Name" value="<?php
                                                            $set_val = set_value('venue_name');
                                                            if (isset($post_data->venue_name)) {
                                                                echo $post_data->venue_name;
                                                            } elseif (isset($set_val)) {
                                                                echo set_value('venue_name');
                                                            }
                                                            ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Details &nbsp;<?php echo form_error('descriptions', '<span class="form_fields_error">', '</span>'); ?></label>
                                                            <textarea class="form-control" rows="15" name="descriptions" placeholder="Enter descriptions"><?php
                                                                $set_val = set_value('descriptions');
                                                                if (isset($post_data->descriptions)) {
                                                                    echo $post_data->descriptions;
                                                                } elseif (isset($set_val)) {
                                                                    echo set_value('descriptions');
                                                                }
                                                                ?>
                                                            </textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Time &nbsp;<?php echo form_error('post_time', '<span class="form_fields_error">', '</span>'); ?></label>
                                                            <input type="text" class="form-control" id="post_time" name="post_time" placeholder="Enter Event time" value="<?php
                                                            $set_val = set_value('post_time');
                                                            if (isset($post_data->post_time)) {
                                                                echo $post_data->post_time;
                                                            } elseif (isset($set_val)) {
                                                                echo set_value('post_time');
                                                            }
                                                            ?>">
                                                        </div>
                                                        <div class="fetured_images_style_holder">
                                                            <div class="fetured_images_style">
                                                                <img src="<?php echo base_url('images/exhibition/' . $post_data->fetured_image_path) ?>" />
                                                            </div>
                                                        </div>
                                                        <!--</div>-->
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">Featured Image</label>
                                                            <input type="file" id="featured_image" name="featured_image">
                                                            <p class="help-block">(Width: 750px & Height 500px).</p>
                                                        </div>
                                                        <div class="fetured_images_style_holder">
                                                            <?php
                                                            if (isset($post_details_data) && !empty($post_details_data)) {
                                                                foreach ($post_details_data as $img_data) {
                                                                    ?>
                                                                    <div class="fetured_images_style" id="related_image_id_<?php echo $img_data->id; ?>">                                        
                                                                        <img src="<?php echo base_url('images/exhibition/' . $img_data->image_path) ?>" />
                                                                        <div class="ajax_image_delete_container">
                                                                            <button type="button" class="btn btn-flat btn-danger small ajax_image_delete" onclick="loadConfirmDeleteAlert(<?php echo $img_data->id; ?>, 'post_data_details');">
                                                                                <i class="fa fa-remove"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                <?php }
                                                            }
                                                            ?>                                    
                                                        </div>                                
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <input type="hidden" name="event_edit_id" value="<?php echo $post_data->id; ?>" />
                                                        <input type="submit" class="btn btn-primary" name="submit" value="Update" />
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </div>
                                </div>
                            </div>
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
<span id="modal_open_area"></span>
<input type="hidden" id="delete_table_name" />
<input type="hidden" id="delete_id" />
<?php echo $footer; ?>