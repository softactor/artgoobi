<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xs-12 col-sm-12">
        <div class="row">
            <div id="faq" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                <div class="jumbotron text-center">
                    <h1 class="service_title">
                        Artgoobi Gallery
                    </h1>
                </div>                    
            </div>
        </div>
        <?php $this->load->view('artworks/art_gallery'); ?>
    </div>
</div>
<?php echo $footer; ?>