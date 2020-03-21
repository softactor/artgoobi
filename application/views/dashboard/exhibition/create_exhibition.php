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
            Exhibition
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Exhibition Panel</li>
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
                                <a href="<?php echo base_url() ?>admin/exhibition" class="btn btn-flat btn-success small" title="Create List">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <!-- form start -->
                        <form id="exhibition" name="exhibition" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/exhibition/process_exhibition') ?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Exhibition Title<?php echo form_error('title', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?php echo set_value('title'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Artist(s) name</label>
                                    <textarea class="form-control" rows="3" name="event_by" placeholder="Enter persons"><?php echo set_value('event_by'); ?></textarea>
                                    <i style="color:red; font-weight: bold;">Must be comma separated values</i>
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
                                    <label for="exampleInputEmail1">Date and Venue<?php echo form_error('venue_address', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="text" class="form-control" id="venue_address" name="venue_address" placeholder="Enter Date & Venue" value="<?php echo set_value('venue_address'); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Front Details<?php echo form_error('front_description', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <textarea class="form-control" rows="3" name="front_description" placeholder="Enter Front Details"><?php echo set_value('front_description'); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control" id="exhibition_details" rows="3" name="descriptions" placeholder="Enter details"><?php echo set_value('descriptions'); ?></textarea>
                                </div>                                
                                <div class="form-group">
                                    <label for="exampleInputFile">Featured Image<?php echo form_error('featured_image', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="file" id="featured_image" name="featured_image">

                                    <p class="help-block">(Width: 750px && Height 500px).</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Other Images</label>
                                    <input type="file" id="other_image" name="other_image[]" multiple>

                                    <p class="help-block">Example block-level help text here.</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Is Fetured?</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="is_fetured" value="1"> Yes
                                        </label>
                                    </div>
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