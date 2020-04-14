<?php
    if (isset($artworks_data) && !empty($artworks_data)) {
        ?>
        <div class="front_art_work_wrapper">    
            <?php
            foreach ($artworks_data as $artwork) {
                $artwork_url    =   'uploads/artwork/resize/' . $artwork->image_original;
                $custom_url     =   base_url('profile/artwork_details/' . $artwork->artist_id . '/' . $artwork->id."/".url_title($artwork->title, "-", true));
                ?>
                <div class="artwork_image_holder">
                    <div class="inner">
                        <?php
                                if(file_exists($artwork_url)){
                            ?>
                        <a href="<?php echo $custom_url; ?>">
                            <img src="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" alt="<?php echo $artwork->title; ?>" title="<?php echo $artwork->title; ?>">
                        </a>
                        <?php }else{ ?>
                                    <img src="<?php echo base_url('images/icons/image_not_found.png'); ?>" alt="<?php echo $artwork->title ?>" title="<?php echo $artwork->title ?>">
                                <?php } ?>
                    </div>
                </div>
        <?php 

            } 
        ?>
        </div>
        <div class="front_art_work_wrapper_small_device">
            <div class="row">
                <?php
                foreach ($artworks_data as $artwork) {
                    $artwork_url = 'uploads/artwork/resize/' . $artwork->image_original;
                    $custom_url = base_url('profile/artwork_details/' . $artwork->artist_id . '/' . $artwork->id . "/" . url_title($artwork->title, "-", true));
                    if (file_exists($artwork_url)) {
                        ?>
                        <a href="<?php echo $custom_url; ?>" rel="noopener">
                            <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix">
                                <img class="img img-responsive" src="<?php echo base_url('uploads/artwork/' . $artwork->image_original); ?>" alt="img" />

                            </div>
                        </a>
                    <?php } else { ?>
                        <div class="col-md-12 col-sm-12 col-xl-12 col-lg-12 clearfix">
                            <img class="img img-responsive" src="<?php echo base_url('images/icons/image_not_found.png'); ?>"  alt="<?php echo $artwork->title ?>" title="<?php echo $artwork->title ?>" />
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
        <div class="clearfix"></div>
<?php 

    } 
?>