<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 col-lg-12">
        <div class="row">
            <div id="faq" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                <div class="jumbotron text-center">
                    <div class="page-header">
                        <div class="heading_featured">
                            <h3>Event Details</h3>
                        </div>      
                    </div>
                </div>                    
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 col-lg-12">
                <h1><?php echo $event->title; ?></h1>
                <div class="exhibition_date"><?php echo date("F d, Y", strtotime($event->start_date)) . "-" . date("F d, Y", strtotime($event->end_date)); ?></div>
                <div class="exhibition_main_image">
                    <img class="img-responsive" src="<?php echo base_url("images/exhibition/" . $event->fetured_image_path) ?>" alt="<?php echo $event->title; ?>" title="<?php echo $event->title; ?>" />
                </div>
                <p class="exhibition_text"><?php echo $event->descriptions; ?></p>
            </div>
        </div>        
    </div>
</div>
<?php echo $footer; ?>