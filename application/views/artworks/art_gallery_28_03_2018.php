<?php
if (isset($galleries) && !empty($galleries)) {
    ?>
    <div class="front_art_work_wrapper">    
        <ul class="caption-style-4">
            <?php
            foreach ($galleries as $data) {
                ?>
                <li>
                    <div class="artwork_image_holder">
                        <!--<div class="trick">-->
                        <img src="<?php echo base_url('uploads/artwork/resize/' . $data->image_original); ?>" alt="img">
                        <!--</div>-->
                    </div>
                    <a class="example-image-link" href="<?php echo base_url(); ?>uploads/artwork/<?php echo $data->image_original; ?>" data-lightbox="example-set" data-title="<?php echo $data->title; ?>">
                        <div class="caption">
                            <div class="blur"></div>
                            <div class="caption-text">
                                <ul class="front_artwork_image_ul">
                                    <li class="front_artwork_list"><h3>Title:&nbsp;<?php echo $data->title; ?></h3></li>
                                    <li class="front_artwork_list"><h2>Artist:&nbsp;<?php echo $data->artist_name; ?></h2></li>
                                    <li class="front_artwork_list"><h2>Price:&nbsp;<?php echo $data->price; ?></h2></li>
                                    <li class="front_artwork_list">
                                        <a class="example-image-link" href="<?php echo base_url(); ?>uploads/artwork/<?php echo $data->image_original; ?>" data-lightbox="example-set" data-title="<?php echo $data->title; ?>">
                                            Large View
                                        </a>
                                        <br>
                                        <a href="<?php echo base_url('welcome/artwork_details/' . $data->artist_id . '/' . $data->id); ?>">Details View</a>
                                    </li>
                                </ul>
                                <div class="other_links text-center">
                                    <img class="img-responsive center-block" src="<?php echo base_url() ?>images/icons/shopping_cart.png">
                                    <img class="img-responsive center-block" src="<?php echo base_url() ?>images/icons/facebook.png">
                                    <img class="img-responsive center-block" src="<?php echo base_url() ?>images/icons/Instagram.png">
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
<!-- End of front_art_work_wrapper-->