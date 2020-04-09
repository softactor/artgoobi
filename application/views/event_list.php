<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
        <div class="row">
            <div id="faq" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                <div class="jumbotron text-center">
                    <div class="page-header">
                        <div class="heading_featured">
                            <h3>art around you</h3>
                        </div>      
                    </div>
                </div>                    
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xl-12">
                <div class="row">
                    <?php
                    if(isset($exhibitions) && !empty($exhibitions)){
                    foreach ($exhibitions as $event_data) {
                        $details_custome_url    =   $event_data->id."/".url_title($event_data->title, "-", true);
                        ?>
                        <div class="col-md-3 col-sm-6 mb-4 col-xs-12">
                            <a href="<?php echo base_url('events/details/' . $details_custome_url); ?>">
                                <div class="center_image_container">
                                    <img class="img-responsive"  src="<?php echo base_url("images/exhibition/" . $event_data->fetured_image_path) ?>"  alt="<?php echo $event_data->title ?>" title="<?php echo $event_data->title ?>">
                                </div>
                            </a>
                            <div class="exi_date_style others_section_exi_date_style related-time-style">
                                <?php
                                echo relative_date(strtotime($event_data->start_date));
                                ?>
                            </div>
                            <h2 class="post-title others_section">
                                <a href="<?php echo base_url('events/details/' . $details_custome_url); ?>"><?php echo $event_data->title; ?></a>
                            </h2>
                            <?php
                            if (isset($event_data->event_by) && !empty($event_data->event_by)) {
                                $event_by = explode(',', $event_data->event_by);
                                ?>
                                <div class="post_owner_by">
                                    <ul class="others_section">
                                        <?php foreach ($event_by as $owner) { ?>
                                            <li><?php echo $owner; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                            <div class="exi_date_style others_section_exi_date_style">
                                <?php
                                echo date("F d, Y", strtotime($event_data->start_date)) . "-" . date("F d, Y", strtotime($event_data->end_date));
                                echo ', ' . $event_data->venue_name . "<br>";
                                ?>
                            </div>
                            <p class="hidden-xs">
                                <?php
                                $url = base_url("events/details/" . $event_data->id);
                                $string = $event_data->descriptions;
                                if (strlen($string) > 25) {
                                    $trimstring = substr($string, 0, 55);
                                } else {
                                    $trimstring = $string;
                                }
                                echo $trimstring;
                                ?>
                            <div class="exi_read_more_style"><a href="<?php echo base_url('events/details/' . $details_custome_url); ?>">Visit</a></div>

                            </p>
                        </div> <!-- End of the column -->
                    <?php }} ?>
                </div>
            </div>
        </div>
        <!-- Content Content Area End -->
    </div>
</div>
<?php echo $footer; ?>