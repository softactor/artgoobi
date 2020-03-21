<?php echo $header; ?>
<?php echo $menu;
    $check_param['user_type'] = $_SESSION['logged_type'];
    $check_param['menu_id'] = 1;
    $check_param['meny_type'] = 2;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Event
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Event Panel</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!--all flash message show view-->
                        <?php $this->load->view ('dashboard/message_view_page');  ?>
                        <!--End all flash message show view-->
                        <?php
                        $check_param['sub_menu'] = 'add';
                        if (has_main_menu_access($check_param)) {
                            ?>
                            <div class="box-tools pull-right">
                                <a href="<?php echo base_url() ?>admin/events" class="btn btn-flat btn-success small" title="Event List">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <!-- form start -->
                        <form id="exhibition" name="exhibition" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/events/process_update_event') ?>">
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
                                    <label for="exampleInputEmail1">Title<?php echo form_error('title', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php
                                            $set_val    =   set_value('title');
                                            if(isset($post_data->title)){
                                                echo $post_data->title;
                                            }elseif(isset($set_val)){
                                                echo set_value('title');
                                            }
                                        ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Date<?php echo form_error('start_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date" value="<?php
                                            $set_val    =   set_value('start_date');
                                            if(isset($post_data->start_date)){
                                                echo $post_data->start_date;
                                            }elseif(isset($set_val)){
                                                echo set_value('start_date');
                                            }
                                        ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Date<?php echo form_error('end_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date" value="<?php
                                            $set_val    =   set_value('end_date');
                                            if(isset($post_data->end_date)){
                                                echo $post_data->end_date;
                                            }elseif(isset($set_val)){
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
                                    <label>Details</label>
                                    <textarea class="form-control" rows="3" name="descriptions" placeholder="Enter descriptions"><?php
                                            $set_val    =   set_value('descriptions');
                                            if(isset($post_data->descriptions)){
                                                echo $post_data->descriptions;
                                            }elseif(isset($set_val)){
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

                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                                <div class="fetured_images_style_holder">
                                    <?php if(isset($post_details_data) && !empty($post_details_data)){
                                        foreach($post_details_data as $img_data){
                                    ?>
                                    <div class="fetured_images_style" id="related_image_id_<?php echo $img_data->id; ?>">                                        
                                        <img src="<?php echo base_url('images/exhibition/' . $img_data->image_path) ?>" />
                                        <div class="ajax_image_delete_container">
                                            <button type="button" class="btn btn-flat btn-danger small ajax_image_delete" onclick="loadConfirmDeleteAlert(<?php echo $img_data->id; ?>, 'post_data_details');">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <?php }} ?>                                    
                                </div>                                
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="exhibition_id" value="<?php echo $post_data->id; ?>" />
                                <input type="submit" class="btn btn-primary" name="submit" value="Update" />
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                    <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>