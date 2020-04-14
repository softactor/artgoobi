<?php echo $header; ?>
<?php
echo $menu;
$check_param['user_type'] = $_SESSION['logged_type'];
$check_param['menu_id'] = 3;
$check_param['meny_type'] = 2;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Users Panel</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="alert alert-success alert-dismissible" id='operation_message_box' style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Data Have Successfully <span id='operation_message_txt'></span>.!</h4>                            
                        </div>
                        <?php
                        $check_param['sub_menu'] = 'add';
                        if (has_main_menu_access($check_param)) {
                            ?>
                            <a class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#modal-default">
                                <i class="fa fa-plus"></i>
                            </a>
<?php } ?> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="admin_all_users_list" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="users_list">
                                <?php
                                if (isset($all_data['data']) && !empty($all_data['data'])) {
                                    $sl = 1;
                                    foreach ($all_data['data'] as $data) {
                                        ?>
                                        <tr id="user_row_<?php echo $data->id; ?>">
                                            <td><?php echo $sl; ?></td>
                                            <td><?php echo $data->name; ?></td>
                                            <td><?php echo $data->user_email; ?></td>
                                            <td>
                                                <?php
                                                switch ($data->user_type) {
                                                    case 1:
                                                        echo "Admin";
                                                        break;
                                                    case 2:
                                                        echo "Manager";
                                                        break;
                                                    case 3:
                                                        echo "Receptionist";
                                                        break;
                                                    case 6:
                                                        echo "Artist";
                                                        break;
                                                    default :
                                                        echo "Nothing Matched.";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php if ($data->status == '1') { ?>
                                                    <span class="label label-success">Active</span>
                                                <?php } ?>
                                                <?php if ($data->status == '0') { ?>
                                                    <span class="label label-danger">Inactive</span>
                                                <?php } ?>
                                                <?php if ($data->status == '2') { ?>
                                                    <span class="label label-warning">Pending</span>
        <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $check_param['sub_menu'] = 'edit';
                                                if (has_main_menu_access($check_param)) {
                                                    ?>
                                                    <a title="Edit" class="btn btn-sm btn-default" href="<?php echo base_url() ?>admin/dashboard/users_panel_edit/<?php echo $data->id; ?>"><i class="fa fa-pencil-square"></i></a>
                                                <?php } ?>
                                                <?php
                                                $check_param['sub_menu'] = 'delete';
                                                if (has_main_menu_access($check_param)) {
                                                    ?>
                                                    <a title="Delete" class="btn btn-sm btn-default" href="#" onclick="confirm_user_delete_process(<?php echo $data->id; ?>);"><i class="fa fa-close"></i></a>
                                                    <a title="Login as" class="btn btn-sm btn-default" href="#" onclick="login_as_artist_process(<?php echo $data->id; ?>);"><i class="fa fa-user-circle"></i></a>
        <?php } ?>
                                            </td>
                                        </tr>
        <?php $sl++;
    }
} else { ?>
                                    <tr>
                                        <td colspan="5"><div class="col-md-12 label-warning">There is no Data</div></td>
                                    </tr>
<?php } ?>
                            </tbody>                                
                        </table>
                    </div>
                    <!-- /.box-body -->

                    <!-- /.box -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- *********** Start User Create Form Modal *********** -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add User</h4>
            </div>
            <div class="modal-body">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="user_name">Name</label>
                                <input type="text" class="form-control" id="user_name" placeholder="Enter name">
                            </div>
                            <!-- select -->
                            <div class="form-group">
                                <label>User Type</label>
                                <select class="form-control" id="user_type">
                                    <option value="">Select</option>
                                    <?php
                                    $user_type = get_user_type();
                                    foreach ($user_type as $type) {
                                        ?>
                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
<?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email address</label>
                                <input type="email" class="form-control" id="user_email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="user_pass">Password</label>
                                <input type="password" class="form-control" id="user_pass" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="ip_addr_from">IP Address</label>
                                <br />
                                From &nbsp;<input type="text" class="form-control" style="width: 40%; display: inline-block" id="ip_addr_from" placeholder="IP Address">
                                To &nbsp;<input type="text" class="form-control" style="width: 40%; display: inline-block" id="ip_addr_to" placeholder="IP Address">
                            </div>
                            <!-- radio -->
                            <div class="form-group">
                                <label for="is_ip_address_check">IP address check when Login?</label>  
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_ip_address_check" value="1" checked>
                                        Yes
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="is_ip_address_check" value="0">
                                        No
                                    </label>
                                </div>
                            </div>                              
                        </div>
                    </form>
                    <!-- /.box -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="user_create();">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- *********** End User Create Form Modal *********** -->
<!-- *********** Start User Create Form Modal *********** -->
<div class="modal fade" id="confirm_delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete User</h4>
                <input type="hidden" id="delete_user_id" value="">
            </div>
            <div class="modal-body">
                <!-- general form elements -->
                <h3 class="label-danger" style="padding: 10px;">Are You Sure, You want to Delete?</h3>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirm_user_delete_process();">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>
<!-- *********** End User Create Form Modal *********** -->
<?php echo $footer; ?>