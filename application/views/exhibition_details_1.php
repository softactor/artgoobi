<?php echo $header; ?>
<!-- Content Content Area Start -->
<div class="col-md-10">
    <div class="col-xs-12" id="slider">
        <!-- Top part of the slider -->
        <div class="row">
            <div class="col-md-2" id="slider-thumbs">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                    <?php
                    $count  =   0;
                    foreach($post_details_data as $others_img){
                        ?>
                        <li class="col-sm-12">
                            <a class="thumbnail" id="carousel-selector-<?php echo $count; ?>">
                                <img src="<?php echo base_url("images/exhibition/".$others_img->image_path) ?>">
                            </a>
                        </li>
                        <?php $count++;} ?>
                </ul>
            </div>
            <div class="col-sm-10" id="carousel-bounding-box">
                <?php
                if($post_details_data){
                ?>
                <div class="carousel slide" id="myCarousel">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <?php
                            $count = 0;
                            foreach ($post_details_data as $others_img) {
                                ?>
                                <div class="<?php if(!$count){  echo "active ";} ?>item" data-slide-number="<?php echo $count; ?>">
                                    <img src="<?php echo base_url("images/exhibition/".$others_img->image_path) ?>">
                                </div>

                                <?php $count++; }

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
                    <?php }else{
                    echo 'Details not found for this item!';
                }; ?>
            </div>
        </div>
    </div>

    <?php if(isset($post_details_data) && !empty($post_details_data)){ ?>
    <div id="main_area" style="margin-left: 1%">
        <!-- Slider -->
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">
                        <div class="jumbotron text-center">
                            <h1 class="service_title"><?php echo $exhibition->title; ?></h1>
                            <div class="exhibition_date">
                                <?php echo date("F d, Y",strtotime($exhibition->start_date))."-".date("F d, Y",strtotime($exhibition->end_date)); ?>
                            </div>
                            <p class="sub_title">
                                <?php echo $exhibition->descriptions; ?>
                            </p>
                            <img class="img-responsive" src="<?php echo base_url("images/exhibition/".$exhibition->fetured_image_path) ?>" alt="<?php echo $exhibition->title; ?>" title="<?php echo $exhibition->title; ?>" />
                        </div>
                    </div>
                </div><!-- end row -->

            </div>
            <!--/Slider-->
        </div>

    </div>
    <?php } ?>
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>