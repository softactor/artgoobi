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
    <div class="clearfix"></div>
    <div class="page-header view-more-style">
        <div class="heading_featured">
            <h4 class="text-center"><a href="<?php echo base_url(); ?>welcome/gallery_list">view more</a></h4>
        </div>
    </div>
<?php } ?>
<!-- End of front_art_work_wrapper-->