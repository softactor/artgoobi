<?php echo $header; ?>
<!-- Content Content Area Start -->
<div class="col-md-10">
    <div class="row">
        <div class="col-md-10">
            <ul class="caption-style-4">
                    <?php
                    $height = 0;
                    $width = 0;
                    foreach ($galleries['gallery_data'] as $gallery_data) {
                        $height = 0;
                        $width = 0;
                        $image = base_url('images/exhibition/' . $gallery_data->image_path);
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
                                <img src="<?php echo base_url('images/exhibition/' . $gallery_data->image_path); ?>" alt="img" height="<?php echo $height; ?>" width="<?php echo $width; ?>">
                                <!--</div>-->
                            </div>
                            <div class="caption">
                                <div class="blur"></div>
                                <div class="caption-text">
                                    <ul class="front_artwork_image_ul">
                                        <li class="front_artwork_list">
                                            <a class="example-image-link" href="<?php echo base_url(); ?>images/exhibition/<?php echo $gallery_data->image_path; ?>" data-lightbox="example-set">
                                                Large View
                                            </a>
                                        </li>
                                    </ul>                                    
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
        </div>
    </div>
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>