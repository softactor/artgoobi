<?php
if (isset($galleries) && !empty($galleries)) {
    ?>
    <div class="front_art_work_wrapper">    
        <?php
        foreach ($galleries as $artwork) {
            ?>
            <div class="artwork_image_holder">
                <div class="inner">
                    <a class="example-image-link" href="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork->image_original; ?>" data-lightbox="example-set" data-title="<a href='<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>'><?php echo $artwork->title; ?></a>">
                        <img src="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" alt="img">
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="front_art_work_wrapper_small_device">
        <div class="row">
            <?php
                foreach ($galleries as $artwork) {
            ?>
            <a href="<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>" rel="noopener">
                <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix">
                    <img class="img img-responsive" src="<?php echo base_url('uploads/artwork/' . $artwork->image_original); ?>" alt="img" />
                </div>
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="clearfix"></div>
<?php } ?>
<!-- End of front_art_work_wrapper-->