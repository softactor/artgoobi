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
?>
<div class="modal fade" id="custom_group_add_form">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Custom Group</h4>
            </div>
            <div class="modal-body">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" id="custom_group_form" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Custom Group Name</label>
                                <input type="text" name="group_name" class="form-control" id="name" placeholder="Enter name" value="">
                            </div>
                            <div class="form-group">
                                <label for="is_ip_address_check">Type</label>  
                                <div class="radio">
                                    <?php
                                        foreach($is_general_type as $val){
                                    ?>
                                    <label>
                                        <input type="radio" name="is_general" value="<?php echo $val['id'] ?>" onchange="toggleCustomGroupActionType(<?php echo $val['id'] ?>);">
                                        <?php echo $val['name'] ?>&nbsp;
                                    </label>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- select -->
                            <div class="form-group alert alert-info" id="type_pos" style="display: none;">
                                <label>Positions</label>
                                    <?php
                                        $positions = get_positions();
                                        foreach($positions as $pos){
                                    ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="positions" value="<?php echo $pos->id; ?>"> <?php echo $pos->name; ?>
                                        </label>
                                    </div>
                                    <?php } ?>
                            </div>
                            <div class="form-group alert alert-info" id="type_grp" style="display: none;">
                                <label>Groups</label>
                                <?php
                                    $groups = get_groups(1); // passing @param 1 == only get general group
                                    foreach($groups as $pos){
                                ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="groups" value="<?php echo $pos->id; ?>"> <?php echo $pos->name; ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="form-group" id="type_emp" style="display: none;">
                                <label>Employee</label>
                                <br>
                                <select class="form-control" id="employee" style="width: 100%" onchange="createFilterEmployee(this.value,'add');">
                                    <option value="">Select</option>
                                    <?php
                                        $user_type = get_all_data_by_table('employes');
                                        foreach($user_type as $type){
                                    ?>
                                    <option value="<?php echo $type->id; ?>"><?php echo $type->first_name.' '.$type->last_name.'('.$type->emp_id.')'; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div id="filterEmp">
                            </div>
                        </div>
                    </form>
                    <!-- /.box -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="custom_group_create();">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</div>