<!-- Related Projects Row -->
<!--<div class="heading_featured service_item">-->
<!--    <h3><i class="icon-star-empty icon-white"></i>Related Exhibitions</h3>-->
<!--</div>-->
        <!--<h3 class="my-4">Related Exhibitions</h3>-->
<br/>
        <?php
            // get other featured Exhibition
            $data['limit']  =   4;
            $data['table']  =   "post_data";
            $data['where']  =   [
                'post_type'   =>  1
            ];
            $data['where_not_in']  =   [
                'field'     =>  'id',
                'values'    =>  $where_not_in_id//$featured_exhibition[0]->id
            ];
            $other_featured_exhibition    = get_all_data_by_joining_table($data);            
        ?>
        <div class="row">
            <?php
                foreach($other_featured_exhibition as $other){
                    $path_parts =   pathinfo($other->fetured_image_path, PATHINFO_FILENAME);
                    $image_path =   $path_parts."500_300image". "." . pathinfo($other->fetured_image_path, PATHINFO_EXTENSION);

            ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <a href="<?php echo base_url('welcome/exhibition_details/'.$other->id); ?>">
                    <img class="img-fluid" src="<?php echo base_url("images/exhibition/resize_images/".$image_path); ?>" alt="<?php echo $other->title; ?>">
                </a>
                <h5><?php echo $other->title ?></h5>
            </div>
            <?php } ?>

        </div>
        <!-- /.row -->