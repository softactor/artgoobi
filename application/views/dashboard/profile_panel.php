<?php echo $header; ?>
<?php echo $menu;
    $check_param['user_type'] = $_SESSION['logged_type'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <span id="op_message"></span>
          <div class="box">
            <div class="box-header bg-success">
              <h3 class="box-title">Profile List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($table_data) && !empty($table_data)){
                            foreach($table_data as $d){
                    ?>
                    <tr>
                        <td><?php echo $d->first_name; ?></td>
                        <td><?php echo $d->last_name; ?></td>
                        <td><?php echo $d->user_email; ?></td>
                        <td><?php echo $d->phone_no; ?></td>
                        <td>
                            <?php
                                switch($d->status){
                                    case 0:
                                        echo '<span class="label label-danger">Inactive</span>';
                                        break;
                                    case 1:
                                        echo '<span class="label label-success">Active</span>';
                                        break;
                                    case 2:
                                        echo '<span class="label label-warning">Pending</span>';
                                        break;
                                    default:
                                        echo "Undefine";
                                }
                            ?>
                        </td>
                        <td>
                            <!--<a href="#update_signup" data-toggle="modal" onclick="getProfileInfoById(<?php echo $d->user_id; ?>);">Edit</a> |--> 
                            <!--<a href="#">Delete</a> |-->
                            <a href="<?php echo base_url() ?>admin/dashboard/profile_artwork_list/<?php echo $d->user_id; ?>">
                                Artwork Details
                                <span class="pull-right-container">
                                    <small class="label pull-right bg-green">
                                        <?php
                                        $param['where'] = [
                                            'artist_id'=>$d->user_id
                                        ];
                                        $param['table']='artwork_info';
                                        echo table_row_count_by_param($param);
                                        ?>
                                    </small>
                                </span>
                            </a>
                            
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- SIGNUP MODAL ----->
<?php 
    $this->load->view('modal/user_signup_update');
?>
<!-- /.modal -->
<?php echo $footer; ?>