<?php
    // get featured Exhibition
    $data['table']  =   "post_data";
    $data['where']  =   [
        'post_type'   =>  3,
    ];
    $all_events    =   get_all_data_by_joining_table($data);  
    
?>
<div class="row">
    <div class="col-md-12">
        <div class="heading_featured service_item">
            <h3><i class="icon-star-empty icon-white"></i>Art Around you</h3>
        </div>
        <ul class="thumbnails">
            <?php
                foreach ($all_events as $event_data) {
                    ?>
            <li class="span3">
                <div id="image1" class="thumbnail">
                    <img class="img-style row1"  src="<?php echo base_url("images/exhibition/".$event_data->fetured_image_path) ?>"  alt="<?php echo $event_data->title ?>" title="<?php echo $event_data->title ?>">
                    <div class="caption">
                        <h3><a href="<?php echo base_url('welcome/event_details/'.$event_data->id); ?>"><?php echo $event_data->title ?></a></h3>
                        <p><?php
                        if (strlen($event_data->descriptions) > 100){
                            $str = substr($event_data->descriptions, 0, 50) . '...';
                            echo $str;
                            }
                        ?>
                        
                        </p>
                        <br>
                        <p>
                            <a href="<?php echo base_url('welcome/event_details/'.$event_data->id); ?>" class="btn btn-warning">More info</a>
                        </p>
                    </div>
                </div>
            </li>
                <?php } ?>
        </ul>
        <!-- End Featured Listings -->
        <a class="btn btn-info pull-right" href="/testing/welcome/event_list">See more</a>
    </div>
</div>