<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 col-lg-12">
        <!-- Portfolio Item Heading -->
        <div class="page-header">
            <div class="heading_featured">
                <h3>Exibitions Now</h3>
            </div>      
        </div> 
        <?php
        if (isset($exhibitions) && !empty($exhibitions)) {
            foreach ($exhibitions as $exhibition) {
                ?>
                <!-- Portfolio Item Row -->
                <div class="row exhibition_row_bottom_gap">
                    <div class="col-md-7 col-sm-12 col-xs-12 col-lg-7 col-xl-7">
                        <img class="img-responsive" src="<?php echo base_url("images/exhibition/" . $exhibition->fetured_image_path) ?>" alt="<?php echo $exhibition->title; ?>" title="<?php echo $exhibition->title; ?>">
                    </div>
                    <div class="col-md-5 col-sm-12 col-xs-12 col-lg-5 col-xl-5 exhibition_coloumn_top_gap">
                        <h2 class="post-title">
                            <a href="<?php echo base_url('welcome/exhibition_details/' . $exhibition->id); ?>"><?php echo $exhibition->title; ?></a>
                        </h2>
                        <div class="exi_date_style">
                            <?php
                            echo $exhibition->venue_address . "<br>";
                            ?>
                        </div>
                        <?php
                        if (isset($exhibition->event_by) && !empty($exhibition->event_by)) {
                            $event_by = explode(',', $exhibition->event_by);
                            ?>
                            <div class="post_owner_by">
                                <ul>
                                    <?php foreach ($event_by as $owner) { ?>
                                        <li><?php echo $owner; ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <p style="text-align: left;">
                            <?php
                            echo str_short(html_entity_decode($exhibition->descriptions), 350);
                            ?>
                        </p>
                        <div class="exi_read_more_style"><a href="<?php echo base_url('welcome/exhibition_details/' . $exhibition->id); ?>">Visit</a></div>
                    </div>
                </div>
                <!-- /.row -->
                <?php
            }
        }
        ?>
        <!-- Content Content Area End -->
    </div>
</div>
<?php echo $footer; ?>