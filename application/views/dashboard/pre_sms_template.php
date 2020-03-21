<?php echo $header; ?>
<?php echo $menu;
    $check_param['user_type'] = $_SESSION['logged_type'];
    $check_param['menu_id'] = 2;
    $check_param['meny_type'] = 2;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pre SMS Template
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Pre SMS Template Settings</li>
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
                        <!-- *********** Start User Create Form Modal *********** -->
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Add Pre SMS Text</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- general form elements -->
                                        <div class="box box-primary">
                                            <!-- form start -->
                                            <form role="form">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="is_ip_address_check">Type</label>  
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="is_general" value="0" checked onchange="toggleActionType(0);">
                                                                General&nbsp;
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="is_general" value="1" onchange="toggleActionType(1);">
                                                                Group&nbsp;
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="is_general" value="2" onchange="toggleActionType(2);">
                                                                Position
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!-- select -->
                                                    <div class="form-group" id="type_pos">
                                                        <label>Position</label>
                                                        <select class="form-control" id="position_id" disabled>
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
                                                    <div class="form-group" id="type_grp">
                                                        <label>Group</label>
                                                        <select class="form-control" id="group_id" disabled>
                                                            <option value="">Select</option>
                                                            <?php
                                                                $groups = get_groups();
                                                                foreach($groups as $pos){
                                                            ?>
                                                            <option value="<?php echo $pos->id; ?>"><?php echo $pos->name; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="template_id">Template ID</label>
                                                        <input type="text" class="form-control" id="template_id" placeholder="Enter ID">
                                                    </div>
                                                    <!-- textarea -->
                                                    <div class="form-group">
                                                      <label>Textarea</label>
                                                      <textarea id="descriptions" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- /.box -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="pre_sms_create();">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                        <!-- *********** End User Create Form Modal *********** -->
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>SL No.</th>
                                        <th>Type</th>
                                        <th>Template ID</th>
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
                                        <td>
                                            <?php
                                                switch($data->is_general){
                                                    case 0:
                                                        echo "General";
                                                        break;
                                                    case 2:
                                                        echo "Position";
                                                        break;
                                                    case 1:
                                                        echo "Group";
                                                        break;
                                                    default :
                                                        echo "Nothing Matched.";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $data->template_id; ?></td>
                                        <td>
                                            <?php                                                
                                                $check_param['sub_menu'] = 'edit';
                                                if(has_main_menu_access($check_param)){
                                            ?>
                                            <a href="<?php echo base_url() ?>settings/pre_sms_template_edit/<?php echo $data->id; ?>">Edit</a>
                                            <?php } ?>
                                            <?php                                                
                                                $check_param['sub_menu'] = 'delete';
                                                if(has_main_menu_access($check_param)){
                                            ?>
                                            <a href="#" onclick="confirm_pre_sms_delete(<?php echo $data->id; ?>);">Delete</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                        <?php $sl++;}}else{ ?>
                                    <tr>
                                        <td colspan="4"><div class="col-md-12 label-warning">There is no Data</div></td>
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
                                            <h4 class="modal-title">Delete Pre SMS Template</h4>
                                            <input type="hidden" id="delete_user_id" value="">
                                    </div>
                                    <div class="modal-body">
                                        <!-- general form elements -->
                                        <h3 class="label-danger" style="padding: 10px;">Are You Sure, You want to Delete?</h3>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onclick="confirm_pre_sms_delete_process();">Delete</button>
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