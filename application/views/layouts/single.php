<?php echo $header; ?>
    <div class="row">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                    <?php $this->load->view('artworks/art_gallery'); ?>                    
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <?php $this->view('layouts/advertisement'); ?>
        </div>
    </div>
<?php echo $footer; ?>
                