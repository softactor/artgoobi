<?php echo $header; ?>
<?php
echo $menu;
$check_param['user_type'] = $_SESSION['logged_type'];
$check_param['menu_id'] = 1;
$check_param['meny_type'] = 2;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contact Feedback
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Settings</li>
            <li class="active">Contact Feedback Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <form action="<?php echo base_url('admin/dashboard/contact_feedback_reply') ?>" method="post">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Read Mail</h3>

                            <div class="box-tools pull-right">
                                <a href="<?php echo base_url() ?>admin/dashboard/contact_feedback" class="btn btn-flat btn-success small" title="Create List">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="mailbox-read-info">
                                <h3>Name: <?php echo $post_data->name; ?></h3>
                                <h3>Mobile: <?php echo $post_data->mobile; ?></h3>
                                <h5>From: <?php echo $post_data->email; ?>
                                    <span class="mailbox-read-time pull-right"><?php echo human_format_date($post_data->receive_time); ?></span></h5>
                            </div>
                            <!-- /.mailbox-read-info -->
                            <div class="mailbox-controls with-border text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                                        <i class="fa fa-trash-o"></i></button>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                                        <i class="fa fa-share"></i></button>
                                </div>
                                <!-- /.btn-group -->
                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                                    <i class="fa fa-print"></i></button>
                            </div>
                            <!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <p>
                                    <?php echo $post_data->feedback; ?>
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail From Name<?php echo form_error('email_title', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input type="text" class="form-control" id="email_title" name="email_title" placeholder="Enter Mail From" value="<?php
                                        $set_val = set_value('email_title');
                                        if (isset($mail_template_data->email_title)) {
                                            echo $mail_template_data->email_title;
                                        } elseif (isset($set_val)) {
                                            echo set_value('email_title');
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail From Address<?php echo form_error('email_from_address', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input autocomplete="off" type="text" class="form-control" id="email_from_address" name="email_from_address" placeholder="Enter Mail From Address" value="<?php
                                        $set_val = set_value('email_from_address');
                                        if (isset($mail_template_data->email_from_address)) {
                                            echo $mail_template_data->email_from_address;
                                        } elseif (isset($set_val)) {
                                            echo set_value('email_from_address');
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mail Subject<?php echo form_error('email_subject', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input autocomplete="off" type="text" class="form-control" id="email_subject" name="email_subject" placeholder="Enter Mail Subject" value="<?php
                                        $set_val = set_value('email_subject');
                                        if (isset($mail_template_data->email_subject)) {
                                            echo $mail_template_data->email_subject;
                                        } elseif (isset($set_val)) {
                                            echo set_value('email_subject');
                                        }
                                        ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Salutation<?php echo form_error('salutation', '<span class="form_fields_error">', '</span>'); ?></label>
                                        <input autocomplete="off" type="text" class="form-control" id="salutation" name="salutation" placeholder="Enter Salutation" value="<?php
                                        $set_val = set_value('salutation');
                                        if (isset($mail_template_data->salutation)) {
                                            echo $mail_template_data->salutation;
                                        } elseif (isset($set_val)) {
                                            echo set_value('salutation');
                                        }
                                        ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Body &nbsp;<?php echo form_error('email_body', '<span class="form_fields_error">', '</span>'); ?></label>
                                <textarea class="form-control" rows="3" name="email_body" placeholder="Enter Mail Body"><?php
                                    $set_val = set_value('email_body');
                                    if (isset($mail_template_data->email_body)) {
                                        echo $mail_template_data->email_body;
                                    } elseif (isset($set_val)) {
                                        echo set_value('email_body');
                                    }
                                    ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="venue_name">Email Footer<?php echo form_error('email_footer', '<span class="form_fields_error">', '</span>'); ?></label>
                                <textarea class="form-control" rows="3" name="email_footer" placeholder="Enter Mail Footer"><?php
                                    $set_val = set_value('email_footer');
                                    if (isset($mail_template_data->email_footer)) {
                                        echo $mail_template_data->email_footer;
                                    } elseif (isset($set_val)) {
                                        echo set_value('email_footer');
                                    }
                                    ?></textarea>
                            </div>
                            <!-- /.mailbox-read-message -->
                        </div>
                        <!-- /.box-body -->

                        <!-- /.box-footer -->
                        <div class="box-footer">
                            <input type="hidden" name="edit_id" value="<?php echo $post_data->id; ?>">
                            <input type="hidden" name="email_to" value="<?php echo $post_data->email; ?>">
                            <button type="submit" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                            <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /. box -->
                </div>
            </div>
        </form>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>