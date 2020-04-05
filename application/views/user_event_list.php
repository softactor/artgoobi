<?php echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
    $profiler = true;
}
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">        
        <div class="row">
                <?php echo $profile_left_panel; ?>
            <div class="col-md-9 col-sm-12 col-xs-12 col-xl-9">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="jumbotron text-center">
                            <h1 class="service_title">
                                <?php echo "Event List" ?>
                            </h1>
                        </div>                    
                    </div>
                </div>
                <?php $this->load->view ('message_view_page');  ?>
                <div class="box box-success">
                    <div class="box-header"> 
                        <div class="pull-right">
                            <a href="<?php echo base_url() ?>welcome/user_event_create" class="btn btn-xs btn-success" title="Create gallery">
                                Create
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-body">
                        <?php
                            if (isset($events) && !empty($events)) {
                        ?>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#.</th>
                                        <th>Title</th>
                                        <th>Start</th>
                                        <th>End</th>
                                        <th>Venue</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="users_list">
                                    <?php
                                        $sl = 1;
                                        foreach ($events as $data) {
                                            ?>
                                            <tr id="user_row_<?php echo $data->id; ?>">
                                                <td><?php echo $sl; ?></td>
                                                <td><?php echo $data->title; ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($data->start_date)); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($data->end_date)); ?></td>
                                                <td><?php echo $data->venue_address; ?></td>
                                                <td>
                                                    <?php
                                                    //user_event_list
                                                        $redirectUrl    =   base_url('welcome/user_event_list');
                                                    ?>
                                                    <a href="<?php echo base_url('welcome/edit_user_event_data/' . $data->id) ?>"><button type="button" class="btn btn-xs btn-success">Edit</button></a>
                                                    <a href="#" onclick="deleteDataByIdAndTable(<?php echo $data->id; ?>, 'post_data', '<?php echo $redirectUrl; ?>');"><button type="button" class="btn btn-xs btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                        <?php $sl++; } ?>
                                </tbody>                                
                            </table>
                        </div>
                        <?php }else{ ?>
                        <div class="alert alert-warning">
                            <strong>Found No Data!</strong>
                        </div>
                            <?php } ?>
                    </div>
                    <!-- /.box-body -->
                </div><!-- /.box -->
            </div>  
        </div>
    </div>
</div>
<span id="modal_open_area"></span>
<input type="hidden" id="delete_table_name" />
<input type="hidden" id="delete_id" />
<?php echo $footer; ?>