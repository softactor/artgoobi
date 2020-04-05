<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 col-xs-12 col-sm-12">
        <div class="row">
            <div id="faq" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                <div class="jumbotron text-center">
                    <div class="page-header">
                        <div class="heading_featured">
                            <h3>Artgoobi Gallery</h3>
                        </div>      
                    </div>
                </div>                    
            </div>
        </div>
        <?php $this->load->view('artworks/art_gallery'); ?>
    </div>
</div>
<?php echo $footer; ?>