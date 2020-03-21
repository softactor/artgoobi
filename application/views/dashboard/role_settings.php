<?php echo $header; ?>
<?php echo $menu; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Start box) -->
        <div class="row">
            <?php
                $flass = $this->session->flashdata('op_message');
                if(isset($flass['status']) && $flass['status']=='success'){ ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible" id='operation_message_box'>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> <?php echo $flass['message']; ?>!</h4>                            
                            </div>
                        </div>
                    </div>
            <?php } ?>
            <div class="col-md-4">                
                <!-- select -->
                <div class="form-group">
                    <h4>User Type <span class="text-sm">(Select user type and assign type wise menu access.)</span></h4>
                    <select class="form-control" id="user_type" onchange="getRoleDetailsByuserType();" onblur="getRoleDetailsByuserType();">
                        <option value="">Select</option>
                        <?php
                            $user_type = get_user_type();
                            foreach($user_type as $type){
                        ?>
                        <option <?php if(isset($selected_user_type) && $selected_user_type==$type->id){ echo 'selected'; } ?> value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                            <?php } ?>
                    </select>
                </div>                
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div id="type_wise_role">
                    <?php
                        if(isset($user_type_role_data) && !empty($user_type_role_data)){
                            echo $user_type_role_data;
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>