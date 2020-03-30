<?php echo $header; ?>    
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
<?php echo $footer; ?>
                