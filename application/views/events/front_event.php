<?php
// get featured Exhibition
$data['limit']  =   8;
$data['table'] = "post_data";
$data['where'] = [
    'post_type' => 3,
];
$orderBy['field']   =   'start_date';
$orderBy['order']    =   'DESC';
$all_events = get_all_data_by_joining_table($data, '', $orderBy);
if(isset($all_events) && !empty($all_events)){
?>
<div class="page-header">
    <div class="heading_featured">
        <h3>art around you</h3>
    </div>      
</div> 
<div class="row">
    <div class="col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <?php
            foreach ($all_events as $event_data) {
                ?>
                <div class="col-md-3 col-sm-6 mb-4 col-xs-12">
                    <a href="<?php echo base_url('welcome/event_details/' . $event_data->id); ?>">
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
                        <a href="<?php echo base_url('welcome/event_details/' . $event_data->id); ?>"><?php echo $event_data->title; ?></a>
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
                    <div class="exi_read_more_style"><a href="<?php echo base_url('welcome/event_details/' . $event_data->id); ?>">Visit</a></div>
                </div> <!-- End of the column -->
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>