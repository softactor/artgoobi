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
                                <a href="<?php echo base_url() ?>admin/events" class="btn btn-flat btn-success small" title="Create List">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <!-- form start -->
                        <form id="exhibition" name="exhibition" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/events/process_event') ?>">
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
                                    <label for="exampleInputEmail1">Event Title<?php echo form_error('title', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php echo set_value('title'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Date<?php echo form_error('start_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input autocomplete="off" type="text" class="form-control" id="start_date" name="start_date" placeholder="Enter Start Date" value="<?php echo set_value('start_date'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Date<?php echo form_error('end_date', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input autocomplete="off" type="text" class="form-control" id="end_date" name="end_date" placeholder="Enter End Date" value="<?php echo set_value('end_date'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="venue_name">Venue name<?php echo form_error('venue_name', '<span class="form_fields_error">', '</span>'); ?></label>
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
                                    <label for="exampleInputFile">Featured Image<?php echo form_error('featured_image', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="file" id="featured_image" name="featured_image">

                                    <p class="help-block">(Width: 750px && Height 500px).</p>
                                </div>                                
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" name="submit" value="Create" />
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