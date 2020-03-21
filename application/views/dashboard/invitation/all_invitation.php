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
            Invitation
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Invitation Panel</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-envelope-o"></i>
                        <h3 class="box-title">Invitation Email CSV</h3>
                        <a href="<?php echo base_url(); ?>csv/invitation.csv">
                            <span class="pull-right"><i class="fa fa-download"> CSV</i></span>
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="<?php echo base_url('admin/invitation/process_invitation') ?>" enctype='multipart/form-data' class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="email">Date:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="uplaod_date_readonly" placeholder="Enter Date" name="uplaod_date_readonly" value="<?php echo date('d-m-Y'); ?>" readonly>
                                    <input type='hidden' name='uplaod_date' value="<?php echo date("d-m-Y"); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="email">Email:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="invitation_email" placeholder="Enter Email" name="invitation_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="pwd">CSV:</label>
                                <div class="col-sm-8">          
                                    <input class="control-label" type="file" name='invitation_csv_email' id="invitation_csv_email">
                                </div>
                            </div>
                            <div class="form-group">        
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary btn-block" name="personnel_invitation_sender" value="Invite">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <?php
            $invitation_details = get_invitation_details();
            $total_invitation = $invitation_details['total_invitation'];
            $active_invitation = $invitation_details['active_invitation'];
            $pending_invitation = $invitation_details['pending_invitation'];
            if ($total_invitation) {
                ?>
                <div class="col-md-8 col-xl-8">
                    <div class="row">
                        <div class="col-lg-4 col-xs-4 col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3><?php echo $total_invitation; ?></h3>
                                    <p>Total Invited</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                            </div>
                        </div>
    <?php if ($active_invitation) { ?>
                            <div class="col-lg-4 col-xs-4 col-md-4">
                                <!-- small box -->
                                <div class="small-box bg-green">
                                    <div class="inner">
                                        <h3><?php echo $total_invitation; ?></h3>
                                        <p>Total Activated</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                                </div>
                            </div>
                        <?php } ?>
    <?php if ($pending_invitation) { ?>
                            <div class="col-lg-4 col-xs-4 col-md-4">
                                <!-- small box -->
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3><?php echo $pending_invitation; ?></h3>
                                        <p>Pending</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <!--<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>-->
                                </div>
                            </div>
    <?php } ?>                        
                    </div>
                </div>
<?php } ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-envelope"></i>
                        <h3 class="box-title">Invited Email List</h3>
                        <span class="pull-right" style="cursor: pointer;" onclick="processInvitation();"><i class="fa fa-telegram"></i> Process Invitation</span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $invitedEmailData = get_all_data_by_table('artist_invitation_details');
                        if (isset($invitedEmailData) && !empty($invitedEmailData)) {
                            ?>
                            <div class="table-responsive">          
                                <table id="e_invitation_data_table_id" class="table list-table-custom-style table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Send Time</th>
                                            <th>Activated Status</th>
                                            <th>Activated Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($invitedEmailData as $exhibitor) {
                                            $tdClass = (($exhibitor->is_active) ? "exhibitor_active" : "exhibitor_inactive");
                                            ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $exhibitor->invited_email; ?></td>
                                                <td><?php echo (isset($exhibitor->invited_time) ? human_format_date($exhibitor->invited_time) : ""); ?></td>
                                                <td class="<?php echo $tdClass; ?>"><?php echo (($exhibitor->is_active) ? "Activated" : "Pending"); ?></td>
                                                <td><?php echo (isset($exhibitor->activated_time) ? human_format_date($exhibitor->activated_time) : ""); ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-small" onclick="confirm_delete_operation('<?php echo $exhibitor->id; ?>', 'artist_invitation_details');"><i class="fa fa-close"></i></button>
                                                </td>
                                            </tr>
    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
<?php } else { ?>
                            <div class="alert alert-warning">
                                <strong>No Data Found.</strong>
                            </div>
<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>