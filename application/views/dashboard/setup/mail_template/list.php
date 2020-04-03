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
            Email Template
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Settings</li>
            <li class="active">Email Template</li>
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
<?php $this->load->view('dashboard/message_view_page'); ?>
                        <!--End all flash message show view-->
                        <div class="pull-right">
                            <a href="<?php echo base_url() ?>admin/settings/mail_template_create" class="btn btn-flat btn-success small" title="Create gallery">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <?php
                        if (isset($all_data['data']) && !empty($all_data['data'])) {
                            ?>
                            <table id="all_event_list_admin" class="table table-hover table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Email Type</th>
                                        <th>Exhibition</th>
                                        <th>Event</th>
                                        <th>Email Title</th>
                                        <th>Email Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="users_list">
                                    <?php
                                    $sl = 1;
                                    foreach ($all_data['data'] as $data) {
                                        ?>
                                        <tr id="user_row_<?php echo $data->id; ?>">
                                            <td><?php echo $sl; ?></td>
                                            <td><?php echo getNameByIdAndTable('email_type', $data->email_type)->name; ?></td>
                                            <td><?php echo (isset($data->exhibition_id) && !empty($data->exhibition_id) ? getNameByIdAndTable('post_data', $data->exhibition_id)->title : "No Data"); ?></td>
                                            <td><?php echo (isset($data->exhibition_id) && !empty($data->exhibition_id) ? getNameByIdAndTable('post_data', $data->event_id)->title : "No Data"); ?></td>
                                            <td><?php echo $data->email_title; ?></td>
                                            <td><?php echo $data->email_subject; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/settings/mail_template_edit/' . $data->id) ?>"><button type="button" class="btn btn-flat btn-success small">Edit</button></a>
                                                <a href="#" onclick="deleteDataByIdAndTable(<?php echo $data->id; ?>,'mail_template');"><button type="button" class="btn btn-flat btn-danger small">Delete</button></a>
                                            </td>
                                        </tr>
        <?php $sl++;
    } ?>
                                </tbody>                                
                            </table>
                        <?php } else { ?>
                            <div class="col-md-12 alert alert-warning">There is no Data</div>
<?php } ?>
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