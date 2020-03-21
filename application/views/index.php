<?php //echo $header; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <?php
                foreach($artwork_info as $artwork) {
            ?>
                <div class="col-md-3">
                    <div class="ih-item square effect3 bottom_to_top">
                        <a href="#">
                            <div class="img"><img src="<?php echo base_url(); ?>uploads/<?php echo $artwork->image_original; ?>" alt="img"></div>
                            <div class="info">
                                <h3>Heading here</h3>
                                <p>Description goes here</p>
                            </div>
                        </a>
                    </div>
                </div>
                <?php } ?>
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