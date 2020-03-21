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
              <h3 class="box-title">Artwork List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Artwork Owner</th>
                  <th>Name</th>
                  <th>Title</th>
                  <th>Not For Sale</th>
                  <th>Price</th>
                  <th>Create Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($artworks_data) && !empty($artworks_data)){
                            foreach($artworks_data as $d){
                    ?>
                    <tr>
                        <td><?php echo ((isset($d->artwork_owner) && $d->artwork_owner==1)? 'Self':'Others'); ?></td>
                        <td><?php echo $d->artist_name; ?></td>
                        <td><?php echo $d->title; ?></td>
                        <td><?php echo ((isset($d->not_for_sale))? 'Yes':'No'); ?></td>
                        <td><?php echo $d->price+$d->price_with_vat+$d->price_with_ser; ?></td>
                        <td><?php echo $d->create_time; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/dashboard/artwork_details/'.$d->id); ?>">Details</a>
                        </td>
                    </tr>
                    <?php }} ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Artwork Owner</th>
                  <th>Name</th>
                  <th>Title</th>
                  <th>Not For Sale</th>
                  <th>Price</th>
                  <th>Create Time</th>
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
<?php echo $footer; ?>