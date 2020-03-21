<?php echo $header; ?>
<?php echo $menu; ?>
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
            <li class="active">Pre SMS Template Edit</li>
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
                        <h4 class="modal-title">Edit Pre SMS Template</h4>                        
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
                                                <input type="radio" name="is_general" value="0" checked onchange="toggleActionType(0);" <?php if (isset($edit_data->is_general) && $edit_data->is_general == 0) {
    echo "checked";
} ?>>
                                                General&nbsp;
                                            </label>
                                            <label>
                                                <input type="radio" name="is_general" value="1" onchange="toggleActionType(1);" <?php if (isset($edit_data->is_general) && $edit_data->is_general == 1) {
    echo "checked";
} ?>>
                                                Group&nbsp;
                                            </label>
                                            <label>
                                                <input type="radio" name="is_general" value="2" onchange="toggleActionType(2);" <?php if (isset($edit_data->is_general) && $edit_data->is_general == 2) {
    echo "checked";
} ?>>
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
                                            foreach ($positions as $pos) {
                                                ?>
                                                <option value="<?php echo $pos->id; ?>" <?php if(isset($edit_data->position_id) && $edit_data->position_id==$pos->id){ echo "selected"; } ?>><?php echo $pos->name; ?></option>
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
                                            foreach ($groups as $pos) {
                                                ?>
                                                <option value="<?php echo $pos->id; ?>" <?php if(isset($edit_data->group_id) && $edit_data->group_id==$pos->id){ echo "selected"; } ?>><?php echo $pos->name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="template_id">Template ID</label>
                                        <input value="<?php echo $edit_data->template_id; ?>" type="text" class="form-control" id="template_id" placeholder="Enter ID">
                                    </div>
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Textarea</label>
                                        <textarea id="descriptions" class="form-control" rows="3" placeholder="Enter ..."><?php echo $edit_data->descriptions; ?></textarea>
                                    </div>
                                </div>
                            </form>
                            <!-- /.box -->
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="edit_id" value="<?php echo $edit_data->id; ?>" >
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="pre_sms_edit();">Update changes</button>
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