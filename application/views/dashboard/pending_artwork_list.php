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
                    <form id="pending_artwork_list" method="post">
                        <div class="row">                   
                            <?php
                            if (isset($artworks_data) && !empty($artworks_data)) {
                                ?>  
                                <div class="front_art_work_wrapper">    
                                    <?php
                                    foreach ($artworks_data as $artwork) {
                                        ?>
                                        <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12" id="pending_artwork_operation_process_<?php echo $artwork->id; ?>">
                                            <div class="artwork_image_authentication_section">
                                                <div class="artwork_image_holder">
                                                    <div class="inner">
                                                        <a class="example-image-link" href="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork->image_original; ?>" data-lightbox="example-set" data-title="<a href='<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>'><?php echo $artwork->title; ?></a>">
                                                            <img src="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork->image_original; ?>" alt="img">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pending_artwork_details">
                                                    <?php
                                                    $a = get_artwork_image_details_page($artwork);
                                                    echo $a;
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="status">AT:</label>
                                                        <div class="col-sm-10"> 
                                                            <div class="radio">
                                                                <input type="radio" name="status[<?php echo $artwork->id; ?>]" value="0" <?php if (isset($artwork->status) && $artwork->status == 0) { ?> checked <?php } ?>/>Pending
                                                            </div>
                                                            <div class="radio">
                                                                <input type="radio" name="status[<?php echo $artwork->id; ?>]" value="1" <?php if (isset($artwork->status) && $artwork->status == 1) { ?> checked <?php } ?>/>Approved
                                                            </div>
                                                            <div class="radio">
                                                                <input type="radio" name="status[<?php echo $artwork->id; ?>]" value="2" <?php if (isset($artwork->status) && $artwork->status == 2) { ?> checked <?php } ?> />Withheld
                                                            </div>
                                                            <div class="radio">
                                                                <input type="radio" name="status[<?php echo $artwork->id; ?>]" value="3" <?php if (isset($artwork->status) && $artwork->status == 3) { ?> checked <?php } ?>/>Deny
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="comment">R:</label>
                                                        <div class="col-sm-10">
                                                            <textarea class="form-control" rows="5" name="remarks[<?php echo $artwork->id; ?>]" id="comment"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">        
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="button" class="btn btn-default" onclick="updateArtworkAuthentication();">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /col -->
                                    <?php } // end of foreach ?>
                                </div>
                                <?php
                            }// end of isset
                            ?>
                        </div> <!-- /row -->
                    </form>
                </div> <!-- /.box-body -->
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