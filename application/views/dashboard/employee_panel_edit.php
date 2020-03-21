<?php echo $header; ?>
<?php echo $menu; ?>
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
            <li class="active">Employee Panel Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-header">
                        <div class="alert alert-success alert-dismissible" id='operation_message_box' style="display: none">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Data Have Successfully Updated.!</h4>                            
                        </div>
                        <h4 class="modal-title">Edit Employee</h4>                        
                    </div>
                    <div class="modal-body">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- form start -->
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input value="<?php echo $edit_data->first_name; ?>" type="text" class="form-control" id="first_name" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input value="<?php echo $edit_data->last_name; ?>" type="text" class="form-control" id="last_name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="initials">Employee Initials</label>
                                        <input value="<?php echo $edit_data->initials; ?>" type="text" class="form-control" id="initials" placeholder="Employee Initials">
                                    </div>
                                    <div class="form-group">
                                        <label for="emp_id">Employee ID</label>
                                        <input value="<?php echo $edit_data->emp_id; ?>" type="text" class="form-control" id="emp_id" placeholder="Employee ID">
                                    </div>                                                    
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Position</label>
                                        <select class="form-control" id="position_id">
                                            <option>Select</option>
                                            <?php
                                            $positions = get_positions();
                                            foreach ($positions as $pos) {
                                                ?>
                                                <option value="<?php echo $pos->id; ?>" <?php if(isset($edit_data->position_id) && $edit_data->position_id==$pos->id){ echo "selected"; } ?>><?php echo $pos->name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>                                                    
                                    <div class="form-group">
                                        <label for="phone_no">Phone Number</label>
                                        <input value="<?php echo $edit_data->phone_no; ?>" type="text" class="form-control" id="phone_no" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input value="<?php echo $edit_data->email; ?>" type="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Group</label>
                                        <select class="form-control" id="group_id">
                                            <option value="">Select</option>
                                            <?php
                                            $groups = get_groups();
                                            foreach ($groups as $pos) {
                                                ?>
                                                <option value="<?php echo $pos->id; ?>" <?php if(isset($edit_data->group_id) && $edit_data->group_id==$pos->id){ echo "selected"; } ?>><?php echo $pos->name; ?></option>
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
                            <input type="hidden" id="edit_id" value="<?php echo $edit_data->id; ?>" >
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="employee_edit();">Update changes</button>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>