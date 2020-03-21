<?php
    $artworkDetailsInfo     =   [];
    if(isset($artwork_data->title) && !empty($artwork_data->title)){
        $artworkDetailsInfo[]       =   "<h4>".$artwork_data->title."</h4>";
    }
    if(isset($artwork_data->artist_name) && !empty($artwork_data->artist_name)){
        $artworkDetailsInfo[]       =   '<p id="artwork_artist_name">'.$artwork_data->artist_name.'</p>';
    }
    if(isset($artwork_data->formate) && !empty($artwork_data->formate)){
        if($format  =   get_artwork_attribute_name($artwork_data->formate, 'artwork_genre')){
            $artworkDetailsInfo[]       =   $format;
        }
    }
    
    $video_duration         =   (isset($artwork_data->video_duration) && !empty($artwork_data->video_duration) ? $artwork_data->video_duration:"");
    $paintyear              =   (isset($artwork_data->year) && !empty($artwork_data->year) ? ",".$artwork_data->year:"");
    $artworkDetailsInfo[]   =   $video_duration.$paintyear;
    
    if(!$artwork_data->not_for_sale){
        if(isset($artwork_data->price) && !empty($artwork_data->price)){
            $artworkDetailsInfo[]       =   '</br> Price BDT: ' .$artwork_data->price;
        }
    }
    if(isset($artwork_data->short_description) && !empty($artwork_data->short_description)){
        $artworkDetailsInfo[]       =   '</br>'.$artwork_data->short_description;
    }
    if(isset($artwork_data->video_link) && !empty($artwork_data->video_link)){
        $artworkDetailsInfo[]       =   '</br><a href='."$artwork_data->video_link".' target="_blank">Click here to watch the video</a>';
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