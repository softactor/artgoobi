<?php echo $header; ?>
<!--style="background-color: #f8f8d9;"-->
<div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                    <h1><?php echo $event->title; ?></h1>
                    <div class="exhibition_date"><?php echo date("F d, Y", strtotime($event->start_date)) . "-" . date("F d, Y", strtotime($event->end_date)); ?></div>
                    <div class="exhibition_main_image">
                        <img class="img-responsive" src="<?php echo base_url("images/exhibition/" . $event->fetured_image_path) ?>" alt="<?php echo $event->title; ?>" title="<?php echo $event->title; ?>" />
                    </div>
                    <p class="exhibition_text"><?php echo $event->descriptions; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <?php $this->view('layouts/advertisement'); ?>
        </div>
    </div>    
</div>
<?php echo $footer; ?>