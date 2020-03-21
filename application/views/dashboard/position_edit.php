<?php echo $header; ?>
<?php echo $menu; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Group
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Group Edit</li>
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
                        <h4 class="modal-title">Edit Group</h4>                        
                    </div>
                    <div class="modal-body">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- form start -->
                            <form role="form">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" placeholder="Enter name" value="<?php echo $edit_data->name; ?>">
                                    </div>                              
                                </div>
                            </form>
                            <!-- /.box -->
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="edit_id" value="<?php echo $edit_data->id; ?>" >
                            <button type="button" class="btn btn-primary" onclick="position_edit();">Update changes</button>
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