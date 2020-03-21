<?php echo $header; ?>
<?php echo $menu; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Groups
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Groups Settings</li>
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
                        <a class="btn btn-app" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-plus"></i>
                        </a>
                        <!-- *********** Start User Create Form Modal *********** -->
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Add Group</h4>
                                    </div>
                                    <div class="modal-body">
                                        <!-- general form elements -->
                                        <div class="box box-primary">
                                            <!-- form start -->
                                            <form role="form">
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                                                    </div>                              
                                                </div>
                                            </form>
                                            <!-- /.box -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="group_create();">Save changes</button>
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
                                        <th>Name</th>
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
                                        <td><?php echo $data->name; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() ?>settings/group_edit/<?php echo $data->id; ?>">Edit</a> |
                                            <a href="#" onclick="confirm_group_delete(<?php echo $data->id; ?>);">Delete</a>
                                        </td>
                                    </tr>
                                        <?php $sl++;}}else{ ?>
                                    <tr>
                                        <td colspan="3"><div class="col-md-12 label-warning">There is no Data</div></td>
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
                                            <h4 class="modal-title">Delete Group</h4>
                                            <input type="hidden" id="delete_user_id" value="">
                                    </div>
                                    <div class="modal-body">
                                        <!-- general form elements -->
                                        <h3 class="label-danger" style="padding: 10px;">Are You Sure, You want to Delete?</h3>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" onclick="confirm_group_delete_process();">Delete</button>
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