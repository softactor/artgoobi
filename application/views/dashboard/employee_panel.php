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
            Employee
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Employee Panel</li>
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
                            if(has_main_menu_access($check_param)){
                        ?>
                        <a class="btn btn-app" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-plus"></i>
                        </a>
                        <?php } ?>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Add Employee</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- general form elements -->
                                        <div class="box box-primary">
                                            <!-- form start -->
                                            <form role="form">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="first_name">First Name</label>
                                                        <input type="text" class="form-control" id="first_name" placeholder="First Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="last_name">Last Name</label>
                                                        <input type="text" class="form-control" id="last_name" placeholder="Last Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="initials">Employee Initials</label>
                                                        <input type="text" class="form-control" id="initials" placeholder="Employee Initials">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="emp_id">Employee ID</label>
                                                        <input type="text" class="form-control" id="emp_id" placeholder="Employee ID">
                                                    </div>                                                    
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label>Position</label>
                                                        <select class="form-control" id="position_id">
                                                            <option value="">Select</option>
                                                            <?php
                                                                $positions = get_positions();
                                                                foreach($positions as $pos){
                                                            ?>
                                                            <option value="<?php echo $pos->id; ?>"><?php echo $pos->name; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>                                                    
                                                    <div class="form-group">
                                                        <label for="phone_no">Phone Number</label>
                                                        <input type="text" class="form-control" id="phone_no" placeholder="Phone Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email address</label>
                                                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                                                    </div>
                                                    <!-- select -->
                                                    <div class="form-group">
                                                        <label>Group</label>
                                                        <select class="form-control" id="group_id">
                                                            <option value="">Select</option>
                                                            <?php
                                                                $groups = get_groups(1);// passing @param 1 means only normal group
                                                                foreach($groups as $pos){
                                                            ?>
                                                            <option value="<?php echo $pos->id; ?>"><?php echo $pos->name; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- /.box -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="employee_create();">Save</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>EMP ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="users_list">
                                    <?php 
                                        if(isset($all_data['data']) && !empty($all_data['data'])){
                                        $sl = 1;
                                        foreach($all_data['data'] as $data){                                            
                                    ?>
                                    <tr id="user_row_<?php echo $data->id; ?>">
                                        <td><?php echo $sl; ?></td>
                                        <td><?php echo $data->emp_id; ?></td>
                                        <td><?php echo $data->first_name.' '.$data->last_name; ?></td>
                                        <td><?php echo $data->email; ?></td>
                                        <td><?php echo $data->phone_no; ?></td>
                                        <td>
                                            <?php if($data->status=='1'){ ?>
                                                <span class="label label-success">Active</span>
                                            <?php } ?>
                                            <?php if($data->status=='0'){ ?>
                                                <span class="label label-warning">Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php                                                
                                                $check_param['sub_menu'] = 'edit';
                                                if(has_main_menu_access($check_param)){
                                            ?>
                                            <a href="<?php echo base_url() ?>dashboard/employee_panel_edit/<?php echo $data->id; ?>">Edit</a>
                                            <?php } ?>
                                            <?php                                                
                                                $check_param['sub_menu'] = 'delete';
                                                if(has_main_menu_access($check_param)){
                                            ?>
                                             | <a href="#" onclick="confirm_employee_delete(<?php echo $data->id; ?>);">Delete</a>
                                            <?php } ?>
                                        </td>
                                    <?php $sl++;}}else{ ?>
                                    <tr>
                                        <td colspan="7"><div class="col-md-12 label-warning">There is no Data</div></td>
                                    </tr>
                                        <?php } ?>
                                </tbody>                                
                            </table>
                            <!-- *********** Start User Create Form Modal *********** -->
                        <div class="modal fade" id="confirm_delete_modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Delete Employee</h4>
                                            <input type="hidden" id="delete_user_id" value="">
                                    </div>
                                    <div class="modal-body">
                                        <!-- general form elements -->
                                        <h3 class="label-danger" style="padding: 10px;">Are You Sure, You want to Delete?</h3>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onclick="confirm_employee_delete_process();">Delete</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                        <!-- *********** End User Create Form Modal *********** -->
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