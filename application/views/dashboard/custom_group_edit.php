<?php echo $header; ?>
<?php echo $menu; ?>
<?php
    $is_general_type = [
        [
            'id'=>1,
            'name'=>'Position Wise'
        ],
        [
           'id'=>2,
            'name'=>'Group Wise' 
        ],
        [
           'id'=>3,
            'name'=>'Employee Wise' 
        ],
    ];
    $pos_display = "none";
    $grp_display = "none";
    $emp_display = "none";
switch ($edit_data->custom_type) {
    case 1:
        $pos_display = 'block';
        break;
    case 2:
        $grp_display = 'block';
        break;
    case 3:
        $emp_display = 'block';
        break;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Custom Group
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Custom Group Edit</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-header">
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
                        <h4 class="modal-title">Edit Custom Group</h4>                        
                    </div>
                    <!-- form start -->
                    <form role="form" id="custom_group_form" action="<?php echo base_url() ?>settings/custom_group_edit_process" method="post">
                    <div class="modal-body">
                        <!-- general form elements -->
                        <div class="box box-primary">                            
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Custom Group Name</label>
                                        <input type="text" name="group_name" class="form-control" id="name" placeholder="Enter name" value="<?php echo $edit_data->name; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="is_ip_address_check">Type</label>  
                                        <div class="radio">
                                            <?php                                            
                                            foreach($is_general_type as $val){                                                
                                            ?>
                                            <label>
                                                <input <?php if(isset($edit_data->custom_type) && $edit_data->custom_type==$val['id']){ echo "checked"; } ?> type="radio" name="is_general" value="<?php echo $val['id'] ?>" onchange="toggleCustomGroupActionType(<?php echo $val['id'] ?>);">
                                                <?php echo $val['name'] ?>&nbsp;
                                            </label>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- select -->
                                    <div class="form-group alert alert-info" id="type_pos" style="display: <?php echo $pos_display ?>;">
                                        <label>Positions</label>
                                        <?php
                                        $positions = get_positions();
                                        foreach ($positions as $pos) {
                                            ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input <?php if(isset($positions_info) && in_array($pos->id, $positions_info)){ echo "checked"; } ?> type="checkbox" name="positions[]" value="<?php echo $pos->id; ?>"> <?php echo $pos->name; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group alert alert-info" id="type_grp" style="display: <?php echo $grp_display ?>;">
                                        <label>Groups</label>
                                        <?php
                                        $groups = get_groups(1); // Passing param @ 1= general Group 
                                        foreach ($groups as $pos) {
                                            ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input <?php if(isset($groups_info) && in_array($pos->id, $groups_info)){ echo "checked"; } ?>  type="checkbox" name="groups[]" value="<?php echo $pos->id; ?>"> <?php echo $pos->name; ?>
                                                </label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group" id="type_emp" style="display: <?php echo $emp_display ?>;">
                                        <label>Employee</label>
                                        <br>
                                        <select class="form-control" id="employee" style="width: 100%" onchange="createFilterEmployee(this.value,'edit');">
                                            <option value="">Select</option>
                                            <?php
                                            $user_type = get_all_data_by_table('employes');
                                            foreach ($user_type as $type) {
                                                ?>
                                                <option value="<?php echo $type->id; ?>"><?php echo $type->first_name . ' ' . $type->last_name . '(' . $type->emp_id . ')'; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div id="filterEmp">
                                        <?php 
                                            if(isset($emp_groups_info) && !empty($emp_groups_info)){
                                                foreach($emp_groups_info as $emp){
                                        ?>
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input <?php if(isset($emp_groups) && in_array($emp->id, $emp_groups)){ echo 'checked'; } ?> type="checkbox" name="filter_emp[]" value="<?php echo $emp->id; ?>">
                                                        <?php echo $emp->first_name.' '.$emp->last_name."(".$emp->emp_id.")"; ?>
                                                    </label>
                                                </div>
                                            </div>        
                                        <?php }} ?>
                                    </div>
                                </div>                            
                            <!-- /.box -->
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="custom_grp_edit_id" value="<?php echo $edit_data->id; ?>">
                            <!--<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                            <!--<button type="button" class="btn btn-primary" onclick="custom_group_create();">Save changes</button>-->
                            <input type="submit" class="btn btn-primary" name="custom_edit_process" value="update">
                        </div>
                    </div>
                    </form>
                    <!-- /.modal-content -->
                    <!-- /.box -->
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>