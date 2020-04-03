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
            Email Template
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Settings</li>
            <li class="active">Email Template create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <?php $this->load->view ('dashboard/message_view_page');  ?>
                    <div class="box-header">
                        <h3 class="box-title">Email Template Create Form</h3>
                        <?php
                        $check_param['sub_menu'] = 'add';
                        if (has_main_menu_access($check_param)) {
                            ?>
                            <div class="pull-right">
                                <a href="<?php echo base_url() ?>admin/settings/mail_template_view" class="btn btn-flat btn-success small" title="Create List">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <!-- form start -->
                        <form id="email_template_create" name="email_template_create" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/email_template_store') ?>">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email Type&nbsp;<?php echo form_error('email_type', '<span class="form_fields_error">', '</span>'); ?></label>
                                            <select name="email_type" class="form-control" id="email_type">
                                                <option value="">Please Select</option>
                                                <?php
                                                $orders['field'] = 'name';
                                                $orders['order'] = 'ASC';
                                                $event_types = get_all_data_by_table("email_type", $orders);
                                                foreach ($event_types as $event_type) {
                                                    ?>
                                                    <option value="<?php echo $event_type->id; ?>" <?php if (isset($_POST['email_type']) && $_POST['email_type'] == $event_type->id) {
                                                    echo 'selected';
                                                } ?>><?php echo $event_type->name; ?></option>
<?php } ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Exhibition&nbsp;<?php echo form_error('exhibition_id', '<span class="form_fields_error">', '</span>'); ?></label>
                                            <select name="exhibition_id" class="form-control" id="exhibition_id">
                                                <option value="">Please Select</option>
                                                <?php
                                                $param['table'] = 'post_data';
                                                $param['where']['post_type'] = 1; // Only Event Data;
                                                $param['order'] = "ASC"; // Only Event Data;
                                                $param['field'] = "title"; // Only Event Data;
                                                $event_types = get_table_data_by_param($param);
                                                foreach ($event_types as $event_type) {
                                                    ?>
                                                    <option value="<?php echo $event_type->id; ?>" <?php if (isset($_POST['exhibition_id']) && $_POST['exhibition_id'] == $event_type->id) {
                                                    echo 'selected';
                                                } ?>><?php echo $event_type->title; ?></option>
<?php } ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Event&nbsp;<?php echo form_error('event_id', '<span class="form_fields_error">', '</span>'); ?></label>
                                            <select name="event_id" class="form-control" id="event_id">
                                                <option value="">Please Select</option>
                                                <?php
                                                $param['table'] = 'post_data';
                                                $param['where']['post_type'] = 3; // Only Event Data;
                                                $param['order'] = "ASC"; // Only Event Data;
                                                $param['field'] = "title"; // Only Event Data;
                                                $event_types = get_table_data_by_param($param);
                                                foreach ($event_types as $event_type) {
                                                    ?>
                                                    <option value="<?php echo $event_type->id; ?>" <?php if (isset($_POST['event_id']) && $_POST['event_id'] == $event_type->id) {
                                                    echo 'selected';
                                                } ?>><?php echo $event_type->title; ?></option>
<?php } ?>
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail From Name<?php echo form_error('email_title', '<span class="form_fields_error">', '</span>'); ?></label>
                                            <input type="text" class="form-control" id="email_title" name="email_title" placeholder="Enter Mail From" value="<?php echo set_value('email_title'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail From Address<?php echo form_error('email_from_address', '<span class="form_fields_error">', '</span>'); ?></label>
                                            <input autocomplete="off" type="text" class="form-control" id="email_from_address" name="email_from_address" placeholder="Enter Mail From Address" value="<?php echo set_value('email_from_address'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Mail Subject<?php echo form_error('email_subject', '<span class="form_fields_error">', '</span>'); ?></label>
                                            <input autocomplete="off" type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Enter Mail Subject" value="<?php echo set_value('email_subject'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Salutation<?php echo form_error('salutation', '<span class="form_fields_error">', '</span>'); ?></label>
                                            <input autocomplete="off" type="text" class="form-control" id="salutation" name="salutation" placeholder="Enter Salutation" value="<?php echo set_value('salutation'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email Body &nbsp;<?php echo form_error('email_body', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <textarea class="form-control" rows="3" name="email_body" placeholder="Enter Mail Body"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="venue_name">Email Footer<?php echo form_error('email_footer', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <textarea class="form-control" rows="3" name="email_footer" placeholder="Enter Mail Footer"></textarea>
                                </div>                                
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="edit_id" value="">
                                <input type="submit" class="btn btn-primary" name="email_template_submit" value="Save" />
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