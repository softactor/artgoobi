<?php
    $artworkDetailsInfo     =   [];
    if(isset($artwork_data->title) && !empty($artwork_data->title)){
        $artworkDetailsInfo[]       =   "<h4>".$artwork_data->title."</h4>";
    }
    if(isset($artwork_data->artist_name) && !empty($artwork_data->artist_name)){
        $artworkDetailsInfo[]       =   '<p id="artwork_artist_name">'.$artwork_data->artist_name.'</p>';
    }
    $paintWidth             =   (isset($artwork_data->width) && !empty($artwork_data->width) ? $artwork_data->width . 'X':"");
    $paintHeight            =   (isset($artwork_data->height) && !empty($artwork_data->height) ? $artwork_data->height:"");
    $paintyear              =   (isset($artwork_data->year) && !empty($artwork_data->year) ? ",".$artwork_data->year:"");
    $ut                     =   get_artwork_attribute_name($artwork_data->unit_type, 'unit_type');
    $paintunit_type         =   (($ut) ? " ".$ut:"");
    $artworkDetailsInfo[]   =   $paintWidth.$paintHeight.$paintunit_type.$paintyear;
    
    if(!$artwork_data->not_for_sale){
        if(isset($artwork_data->price) && !empty($artwork_data->price)){
            $artworkDetailsInfo[]       =   '</br> Price BDT: ' .$artwork_data->price;
        }
    }
    if(isset($artwork_data->collector_name) && !empty($artwork_data->collector_name)){
        $artworkDetailsInfo[]       =   '</br> Collector: '.$artwork_data->collector_name;
    }
  if(isset($artworkDetailsInfo) && !empty($artworkDetailsInfo)){  
?>
<div class="artwork_image_info_style">
    <?php
        foreach($artworkDetailsInfo as $data){
            echo $data;
        }
    ?>
</div>
  <?php } ?>