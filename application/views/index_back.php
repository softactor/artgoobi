<?php echo $header; ?>
    <div class="row">
        <!--        <ul class="caption-style-2">-->
        <?php
        foreach($artwork_info as $artwork) { ?>
            <!--                <div class="lets_try">-->
            <!--                    <img src="--><?php //echo base_url(); ?><!--uploads/--><?php //echo $artwork->image_original; ?><!--">-->
            <!--                </div>-->
            <!--                <li>-->
            <div class="lets_try caption-style-2">
                <img src="<?php echo base_url(); ?>uploads/<?php echo $artwork->image_original; ?>" alt="">
                <div class="caption">
                    <div class="blur"></div>
                    <div class="caption-text">
                        <h1><?php echo $artwork->title; ?></h1>
                        <!--                        <p>Whatever It Is - Always Awesome</p>-->
                    </div>
                </div>
            </div>
            <!--                </li>-->
        <?php } ?>
                </ul>
                <div class="col-md-3 col-md-3-cust" id="<?php //echo $artwork->id; ?>">
                    <div class="text-center">
                        <a class="example-image-link" href="<?php echo base_url(); ?>uploads/<?php echo $artwork->image_original; ?>" data-lightbox="example-set" data-title="<?php echo $artwork->title; ?>">
                            <img class="example-image rounded mx-auto d-block image_show_case" src="<?php //echo base_url(); ?>uploads/<?php //echo $artwork->image_original; ?>" alt=""/>
                        </a>
                    </div>
                    <div class="group_artwork_info">
                        <ul>
                            <li>Title:&nbsp;<?php //echo $artwork->title; ?></li>
                            <li>Artist:&nbsp;<?php //echo $artwork->artist_name; ?></li>
                            <li>BDT:&nbsp;<?php //echo ($artwork->price+$artwork->price_with_vat+$artwork->price_with_ser); ?>(Price)</li>
                            <li><a href="<?php echo base_url('welcome/artwork_details/'.$artwork->artist_id.'/'.$artwork->id); ?>">Click here for Details</a></li>
                        </ul>
                    </div>
                </div>
    </div>
    </div>
    <div class="col-md-2">
        <div class="row">
            <div class="col-md-12 align-middle" style="height: 350px; margin: 5px 0;">
                Commercial
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 align-middle" style="height: 350px; margin: 5px 0;">
                Commercial
            </div>
        </div>
    </div>
<?php echo $footer; ?>