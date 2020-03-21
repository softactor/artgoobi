<?php
if (isset($artwork_info) && !empty($artwork_info)) {
    ?>
    <div id="colorlib-page">
        <a href="#" class="js-colorlib-nav-toggle"><i></i></a>
        <div id="colorlib-main">                
            <section class="ftco-section-2">
                <div class="photograhy">
                    <div class="row no-gutters">
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
                            <div class="col-md-4 col-sm-12 col-xs-12 ftco-animate">
                                <a href="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" class="photography-entry img image-popup d-flex justify-content-center align-items-center" style="background-image: url(<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>);">
                                    <div class="overlay"></div>
                                    <div class="text text-center">
                                        <h3><?php echo $artwork->title; ?></h3>
                                        <span class="tag"><?php echo $artwork->artist_name; ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </div><!-- END COLORLIB-MAIN -->
    </div><!-- END COLORLIB-PAGE -->
<?php } ?>