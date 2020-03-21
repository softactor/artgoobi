<h4><?php echo $artwork_data->title; ?></h4>
<p>
    <?php echo get_artwork_attribute_name($artwork_data->formate, 'artwork_genre'); ?>,
    <?php echo $artwork_data->width . 'X' . $artwork_data->height . ' ' . get_artwork_attribute_name($artwork_data->unit_type, 'unit_type'); ?>,
    <?php echo $artwork_data->year; ?>
    <br/>
    <?php 
        if(!$artwork_data->not_for_sale){
            echo 'Price BDT: ' .$artwork_data->price;
        }else{
            if(isset($artwork_data->collector_name) && !empty($artwork_data->collector_name)){
                echo 'Collector: '.$artwork_data->collector_name;
            }
        }
        ?> 
    <?php echo $artwork_data->artist_name; ?>
</p>