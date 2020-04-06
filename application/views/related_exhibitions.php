<!-- Related Projects Row -->
<!--<div class="heading_featured service_item">-->
<!--    <h3><i class="icon-star-empty icon-white"></i>Related Exhibitions</h3>-->
<!--</div>-->
        <!--<h3 class="my-4">Related Exhibitions</h3>-->
<br/>
<div class="clearfix"></div>
        <?php
            // get other featured Exhibition
            $data['limit']  =   4;
            $data['table']  =   "post_data";
            $data['where']  =   [
                'post_type'   =>  1
            ];
            if(isset($where_not_in_id) && !empty($where_not_in_id)){
                $data['where_not_in']  =   [
                    'field'     =>  'id',
                    'values'    =>  $where_not_in_id//$featured_exhibition[0]->id
                ];
            }
            $other_featured_exhibition    = get_all_data_by_joining_table($data);  
            if(isset($other_featured_exhibition) && !empty($other_featured_exhibition)){
        ?>
        <div class="row">
            <?php
                foreach($other_featured_exhibition as $other){
                    $path_parts =   pathinfo($other->fetured_image_path, PATHINFO_FILENAME);
                    $image_path =   $path_parts."500_300image". "." . pathinfo($other->fetured_image_path, PATHINFO_EXTENSION);

            ?>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-4 col-xs-12">
                <a href="<?php echo base_url('welcome/exhibition_details/' . $other->id); ?>">
                    <div class="center_image_container">
                        <img class="img-fluid" src="<?php echo base_url("images/exhibition/resize_images/" . $image_path); ?>" alt="<?php echo $other->title; ?>">
                    </div>
                </a>
                <h2 class="post-title others_section">
                    <a href="<?php echo base_url('welcome/exhibition_details/' . $other->id); ?>"><?php echo $other->title; ?></a>
                </h2>
                <?php
                    if (isset($other->event_by) && !empty($other->event_by)) {
                        ?>
                <div class="exebition-details-unordered-list" style="font-size: 12pt;">
                    <?php echo $other->event_by; ?>
                    </div>
                <?php } ?>
                <div class="exi_date_style others_section_exi_date_style">
                    <?php 
                        echo date("F d, Y", strtotime($other->start_date)) . "-" . date("F d, Y", strtotime($other->end_date));
                        echo ', '.$other->venue_name."<br>"; 
                    ?>
                </div>
                <div class="exi_read_more_style"><a href="<?php echo base_url('welcome/exhibition_details/' . $other->id); ?>">Visit</a></div>
            </div> <!-- End of the column -->
            <?php } ?>

        </div>
            <?php } ?>
        <!-- /.row -->