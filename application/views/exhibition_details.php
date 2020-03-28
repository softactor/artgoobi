<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
        <?php if (isset($post_details_data) && !empty($post_details_data)) { ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 col-xl-12" id="slider">
                    <!-- Top part of the slider -->
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-2 col-lg-2 col-xl-2" id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="hide-bullets">
                                <?php
                                $count = 0;
                                foreach ($post_details_data as $others_img) {
                                    ?>
                                    <li class="col-sm-12">
                                        <a class="thumbnail" id="carousel-selector-<?php echo $count; ?>">
                                            <img src="<?php echo base_url("images/exhibition/" . $others_img->image_path) ?>">
                                        </a>
                                    </li>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-sm-10 col-sm-12 col-xs-10 col-lg-10 col-xl-10" id="carousel-bounding-box">
                            <?php
                            if ($post_details_data) {
                                ?>
                                <div class="carousel slide" id="myCarousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <?php
                                        $count = 0;
                                        foreach ($post_details_data as $others_img) {
                                            ?>
                                            <div class="<?php
                                            if (!$count) {
                                                echo "active ";
                                            }
                                            ?>item" data-slide-number="<?php echo $count; ?>">
                                                <img src="<?php echo base_url("images/exhibition/" . $others_img->image_path) ?>">
                                            </div>

                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </div>
                                    <!-- Carousel nav -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
<?php if (isset($exhibition) && !empty($exhibition)) { ?>
            <!-- Slider -->
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 col-xl-12">
                    <div class="exebition-details">
                        <h1 class="text-center"><?php echo $exhibition->title; ?></h1>
                        <?php
                        if (isset($exhibition->event_by) && !empty($exhibition->event_by)) {
                            ?>
                            <h4 class="text-center">
                            <?php echo $exhibition->event_by; ?>
                            </h4>
                        <?php } ?>
                        <?php
                        if (isset($exhibition->event_by) && !empty($exhibition->event_by)) {
                            $event_by = explode(',', $exhibition->event_by);
                            ?>
                            <div class="text-center exi_date_style">
                                <?php
                                echo $exhibition->venue_address . "<br>";
                                ?>
                            </div>
                        <?php } ?>
                        <div class="exebition-details-description">
                            <?php echo html_entity_decode($exhibition->descriptions); ?>
                        </div>
                    </div>
                </div>
                <!--/Slider-->
            </div>
    <?php } ?>
    </div>
</div>
<?php echo $footer; ?>