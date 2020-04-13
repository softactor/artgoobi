<?php
// get featured Exhibition
$data['table'] = "post_data";
$data['where'] = [
    'is_featured' => 1,
    'post_type' => 1,
];
$featured_exhibition = get_all_data_by_joining_table($data);
if (isset($featured_exhibition) && !empty($featured_exhibition)) {
    $data['where_not_in_id'] = $featured_exhibition[0]->id;
    $startdate = date('Y-m-d', strtotime($featured_exhibition[0]->start_date));
    $enddate = date('Y-m-d', strtotime($featured_exhibition[0]->end_date));
    $details_custome_url    =   $featured_exhibition[0]->id."/".url_title($featured_exhibition[0]->title, "-", true);
    if (is_post_eligible_to_show($startdate, $enddate)) {
        ?>
        <!-- Portfolio Item Heading -->
        <div class="page-header">
            <div class="heading_featured">
                <h3>Exhibitions Now</h3>
            </div>      
        </div>   
        <!-- Portfolio Item Row -->
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <img class="img-responsive" src="<?php echo base_url("images/exhibition/" . $featured_exhibition[0]->fetured_image_path) ?>" alt="<?php echo $featured_exhibition[0]->title; ?>" title="<?php echo $featured_exhibition[0]->title; ?>">
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <h2 class="post-title">
                    <a href="<?php echo base_url('exhibitions/details/' . $details_custome_url); ?>"><?php echo $featured_exhibition[0]->title; ?></a>
                </h2>
                <div class="exi_date_style">
                    <?php
                    echo $featured_exhibition[0]->venue_address . "<br>";
                    ?>
                </div>
                <?php
                if (isset($featured_exhibition[0]->event_by) && !empty($featured_exhibition[0]->event_by)) {
                    $event_by = explode(',', $featured_exhibition[0]->event_by);
                    ?>
                    <div class="post_owner_by">
                        <ul>
                            <?php foreach ($event_by as $owner) { ?>
                                <li><?php echo $owner; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <p class="text-left"><?php echo $featured_exhibition[0]->front_description; ?></p>
                <div class="exi_read_more_style"><a href="<?php echo base_url('exhibitions/details/' . $details_custome_url); ?>">Visit</a></div>
            </div>
        </div>
        <!-- /.row -->
        <!-- Related exhibition Row -->
        <?php
    }
}// end of is_post_eligible_to_show check;
$this->load->view('related_exhibitions', $data);
?>
<!--<a class="btn btn-info pull-right" href="/testing/welcome/exhibition_list">See more</a>-->