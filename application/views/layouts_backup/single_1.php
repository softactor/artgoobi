<?php echo $header; ?>
 <!--style="background-color: #f8f8d9;"-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                    <?php $this->load->view('artworks/art_gallery'); ?>                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                    <?php $this->load->view('exhibition/front_exhibition'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php $this->load->view('events/front_event'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <?php $this->view('layouts/advertisement'); ?>
        </div>
    </div>    
</div>
<?php echo $footer; ?>
                