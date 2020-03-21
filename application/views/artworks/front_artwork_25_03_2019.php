<div class="front_art_work_wrapper">
    <?php
    if (isset($artwork_info) && !empty($artwork_info)) {
        ?>
        <ul class="caption-style-4">
            <?php
            $height = 0;
            $width = 0;
            foreach ($artwork_info as $artwork) {
                $height = 0;
                $width = 0;
                $image = base_url('uploads/artwork/resize/' . $artwork->image_original);
                list($width, $height) = getimagesize($image);
                if ($width > $height) {
                    $height = "";
                } else {
                    $width = "";
                }
                ?>
                <li>
                    <div class="artwork_image_holder">
                        <!--<div class="trick">-->
                        <img src="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" alt="img" height="<?php echo $height; ?>" width="<?php echo $width; ?>">
                        <!--</div>-->
                    </div>
                    <a class="example-image-link" href="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork->image_original; ?>" data-lightbox="example-set" data-title="<a href='<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>'><?php echo $artwork->title; ?></a>">
                        <div class="caption">
                            <div class="blur"></div>
                            <div class="caption-text">
                                <ul class="front_artwork_image_ul">
                                    <li class="front_artwork_list"><h3>Title:&nbsp;<?php echo $artwork->title; ?></h3></li>
                                    <li class="front_artwork_list"><h2>Artist:&nbsp;<?php echo $artwork->artist_name; ?></h2></li>
                                </ul>
                            </div>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
    <!--<a class="btn btn-info pull-right" href="/testing/welcome/gallery_list">See more</a>-->
</div>