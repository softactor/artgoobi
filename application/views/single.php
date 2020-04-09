<?php echo $header; ?>    
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
        <?php $this->load->view('artworks/art_gallery'); ?> 
        <div class="page-header view-more-style">
        <div class="heading_featured">
            <h4 class="text-center"><a href="<?php echo base_url(); ?>gallery">Explore Gallery</a></h4>
        </div>
    </div>
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
<?php echo $footer; ?>
                