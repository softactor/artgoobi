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
              <h3 class="box-title">Pending Artwork List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Total Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($table_data) && !empty($table_data)){
                            foreach($table_data as $d){
                    ?>
                    <tr>
                        <td><?php echo $d->name; ?></td>
                        <td><?php echo $d->total_artwork; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/dashboard/pending_artwork_details/'.$d->id); ?>">Details</a>
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Total Art Work</th>
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
<div class="modal fade" id="modal_signup">
    <div class="modal-dialog">
        <form action="" id="signup_update" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Signup Update</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Type</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="signup_type" value="6" checked>Artist
                            </label>
                            <label>
                                <input type="radio" name="signup_type" value="7">Visitor
                            </label>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="1" checked>Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2">Female
                            </label>
                            <span class="help-block"></span>
                        </div>
                    </div>                                        
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                        <span class="help-block"></span>
                    </div>
                    <!-- Country Drop Down -->
                    <div class="form-group">
                        <label>Country</label>
                        <select name="country" id="country_id" class="form-control">
                            <option value="">Please Select</option>
                            <?php
                                $countries = get_all_data_by_table("country");
                                foreach($countries as $country){
                            ?>
                            <option value="<?php echo $country->id;  ?>"><?php echo $country->name;  ?></option>
                                <?php } ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code">
                        <span class="help-block"></span>
                    </div>                                        
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Re Type Password</label>
                        <input type="password" name="re_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">Please Select</option>
                            <?php
                                $status = all_user_status();
                                foreach($status as $key=>$s){
                            ?>
                            <option value="<?php echo $key;  ?>"><?php echo $s;  ?></option>
                                <?php } ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <input type="hidden" name="update_id" id="update_id" />
                <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="signup_process_update();">Update</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
        <!-- /Form-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php echo $footer; ?>