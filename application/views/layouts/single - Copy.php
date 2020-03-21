<?php echo $header; ?>
<!-- Content Content Area Start -->
<div class="col-md-10">    
    <!--Artwork front page start here-->
    <?php $this->load->view ('artworks/front_artwork');  ?>
    <!--Artwork front page end here-->    
    
    <!--Exhibition front page start here-->
    <?php $this->load->view ('exhibition/front_exhibition');  ?>
    <!--Exhibition front page end here-->
    
    <!--Event front page start here-->
    <?php $this->load->view ('events/front_event');  ?>
    <!--Event front page end here-->
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>
                