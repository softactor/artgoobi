<?php echo $header; ?>
<?php echo $menu; ?>
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
            <li class="active">Users Panel Edit</li>
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
                        <h4 class="modal-title">Edit User</h4>                        
                    </div>
                    <div class="modal-body">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- form start -->
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="user_name">Name</label>
                                        <input type="text" class="form-control" id="user_name" placeholder="Enter Name" value="<?php echo $edit_data->name; ?>">
                                    </div>
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select class="form-control" id="user_type">
                                            <option value="">Select</option>
                                            <?php
                                                $user_type = get_user_type();
                                                foreach($user_type as $type){
                                            ?>
                                            <option value="<?php echo $type->id; ?>" <?php if (isset($edit_data->user_type) && $edit_data->user_type == $type->id) {
    echo "selected";
} ?>><?php echo $type->name; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="user_email">Email address</label>
                                        <input type="email" class="form-control" id="user_email" placeholder="Enter email" value="<?php echo $edit_data->user_email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_pass">Password</label>
                                        <input type="password" class="form-control" id="user_pass" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="ip_addr_from">IP Address</label>
                                        <br />
                                        From &nbsp;<input value="<?php if (isset($range_from)) {
    echo $range_from;
} ?>" type="text" class="form-control" style="width: 40%; display: inline-block" id="ip_addr_from" placeholder="IP Address">
                                        To &nbsp;<input value="<?php if (isset($range_to)) {
    echo $range_to;
} ?>" type="text" class="form-control" style="width: 40%; display: inline-block" id="ip_addr_to" placeholder="IP Address">
                                    </div>
                                    <!-- radio -->
                                    <div class="form-group">
                                        <label for="is_ip_address_check">IP address check when Login?</label>  
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="is_ip_address_check" value="1" <?php if (isset($edit_data->is_ip_checked) && $edit_data->is_ip_checked == 1) {
    echo "checked";
} ?>>
                                                Yes
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="is_ip_address_check" value="0" <?php if (isset($edit_data->is_ip_checked) && $edit_data->is_ip_checked == 0) {
    echo "checked";
} ?>>
                                                No
                                            </label>
                                        </div>
                                    </div>                              
                                </div>
                            </form>
                            <!-- /.box -->
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="edit_id" value="<?php echo $edit_data->id; ?>" >
                            <button type="button" class="btn btn-primary" onclick="user_edit();">Update changes</button>
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