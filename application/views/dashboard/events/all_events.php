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
            Events
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Events Panel</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        
                        <!--all flash message show view-->
                        <?php $this->load->view ('dashboard/message_view_page');  ?>
                        <!--End all flash message show view-->
                        
                        <?php                                                
                            $check_param['sub_menu'] = 'add';
                            if(has_main_menu_access($check_param)){
                        ?>
<!--                        <a class="btn btn-app" href="<?php echo base_url() ?>admin/exhibition/create_exhibition">
                            <i class="fa fa-plus"></i>
                        </a>-->
                        <div class="pull-right">
                            <a href="<?php echo base_url() ?>admin/events/create_event" class="btn btn-flat btn-success small" title="Create gallery">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="all_event_list_admin" class="table table-hover table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SL No.</th>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Venue Address</th>
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
                                    <td><?php echo $data->title; ?></td>
                                    <td><?php echo human_format_date($data->start_date); ?></td>
                                    <td><?php echo human_format_date($data->end_date); ?></td>
                                    <td><?php echo $data->venue_address; ?></td>
                                    <td>
                                        <?php if($data->status=='1'){ ?>
                                            <span class="label label-success">Active</span>
                                        <?php } ?>
                                        <?php if($data->status=='0'){ ?>
                                            <span class="label label-warning">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/events/edit_event/'.$data->id) ?>"><button type="button" class="btn btn-flat btn-success small">Edit</button></a>
                                        <a href="#" onclick="confirm_events_delete_process(<?php echo $data->id; ?>);"><button type="button" class="btn btn-flat btn-danger small">Delete</button></a>
                                    </td>
                                <?php $sl++;}}else{ ?>
                                <tr>
                                    <td colspan="7"><div class="col-md-12 label-warning">There is no Data</div></td>
                                </tr>
                                    <?php } ?>
                            </tbody>                                
                        </table>
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