<?php echo $header; ?>
 <!--style="background-color: #f8f8d9;"-->
 <div class="container">
     <div class="row">
         <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
             <div class="row">
                 <div class="col-md-12">
                     <div class="row">
                         <!-- here profile left panel will go -->
                         <?php echo $profile_left_panel; ?>
                         <div class="col-sm-12 col-xs-12 col-md-9 col-lg-9 col-xl-9">
                             <div class="row">
                                 <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12">
                                     <img class="img-responsive" src="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork_data->image_original; ?>" alt="<?php echo $artwork_data->title; ?>" title="<?php echo $artwork_data->title; ?>"/>
                                     <ul class="list-inline">
                                         <li><img class="img-responsive center-block" src="<?php echo base_url() ?>images/icons/shopping_cart.png"></li>
                                         <li><img class="img-responsive center-block" src="<?php echo base_url() ?>images/icons/facebook.png"></li>
                                         <li><img class="img-responsive center-block" src="<?php echo base_url() ?>images/icons/Instagram.png"></li>

                                     </ul>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <table class="table table-condensed">
                                         <tr>
                                             <td><strong>Title:</strong></td>
                                             <td><?php echo $artwork_data->title; ?></td>
                                             <td><strong>Media:</strong></td>
                                             <td><?php echo $artwork_data->formate; ?></td>
                                             <td><strong>Size:</strong></td>
                                             <td><?php echo $artwork_data->artist_name; ?></td>
                                             <td><strong>Year:</strong></td>
                                             <td><?php echo $artwork_data->year; ?></td>
                                         </tr>
                                         <tr>
                                             <td><strong>Price:</strong></td>
                                             <td colspan="8">
                                                 <?php echo ($artwork_data->price + $artwork_data->price_with_vat + $artwork_data->price_with_ser); ?>&nbsp;BDT.
                                                 <span style="font-weight: bold; font-style: italic;">
                                                     (With 12% Service Charge & 15% Vat)
                                                 </span>
                                             </td>
                                         </tr>



<!--                                <tr>-->
<!--                                    <th colspan="2">Artwork Details</th>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Artist Name:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->artist_name  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Type Of Art:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->artist_name  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Sub Type</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->artist_name  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Title:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->title  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Media:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->formate  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Unit:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->artist_name  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Size:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->artist_name  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Year:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->year  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Appearance:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->year  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Frame:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->year  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Genre:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->year  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Color:</td>-->
                                         <!--                                    <td>--><?php //echo $artwork_data->year  ?><!--</td>-->
                                         <!--                                </tr>-->
                                         <!--                                <tr>-->
                                         <!--                                    <td>Price:</td>-->
                                         <!--                                    <td>-->
                                         <!--                                        --><?php //echo ($artwork_data->price + $artwork_data->price_with_vat + $artwork_data->price_with_ser);  ?><!--&nbsp;BDT.-->
                                         <!--                                        <span style="font-weight: bold; font-style: italic;">-->
                                         <!--                                            (With 12% Service Charge & 15% Vat) -->
                                         <!--                                        </span>-->
                                         <!--                                    </td>-->
                                         <!--                                </tr>-->
                                     </table>
                                     <?php
                                     if (isset($artwork_data_details) && !empty($artworks_data)) {
                                         ?>
                                         <ul class="caption-style-4" id="artwork_details_gallery">
                                             <?php
                                             $height = 0;
                                             $width = 0;
                                             foreach ($artworks_data as $artwork) {
                                                 $height = 0;
                                                 $width = 0;
                                                 $image = base_url('uploads/artwork/resize/' . $artwork->image_original);
                                                 list($width, $height) = getimagesize($image);
                                                 if ($width > $height) {
                                                     $height = "";
                                                 } else {
                                                     $width = "";
                                                 }
                                                 ?>
                                                 <li>
                                                     <div class="artwork_image_holder" style="width: 170px">
                                                         <!--<div class="trick">-->
                                                         <img src="<?php echo base_url('uploads/artwork/resize/' . $artwork->image_original); ?>" alt="img" height="<?php echo $height; ?>" width="<?php echo $width; ?>">
                                                         <!--</div>-->
                                                     </div>
                                                     <a class="example-image-link" href="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork->image_original; ?>" data-lightbox="example-set" data-title="<?php echo $artwork->title; ?>">
                                                         <div class="caption">
                                                             <div class="blur"></div>
                                                             <div class="caption-text">
                                                                 <h3><?php echo $artwork->title; ?></h3>
                                                                 <p>
                                                                     <a class="example-image-link" href="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork->image_original; ?>" data-lightbox="example-set" data-title="<?php echo $artwork->title; ?>">
                                                                         Large View
                                                                     </a>
                                                                     <br>
                                                                     <a href="<?php echo base_url('welcome/artwork_details/' . $artwork->artist_id . '/' . $artwork->id); ?>">Click here for Details</a>
                                                                     <br>
                                                                     <?php
                                                                     if ($profiler) {
                                                                         ?>
                                                                         <a href="<?php echo base_url('welcome/artist_image_upload_edit/' . $artwork->id) ?>">Edit</a> | <a href="#" onclick="deleteConfirmationModal('artwork_info',<?php echo $artwork->id; ?>);">Delete</a>
                                                                     <?php } ?>
                                                                 </p>
                                                             </div>
                                                         </div>
                                                     </a>
                                                 </li>
                                             <?php } ?>
                                         </ul>
                                     <?php } ?>
                                 </div>
                             </div>
                         </div>  
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-md-2">
             <?php $this->view('layouts/advertisement'); ?>
         </div>
     </div>    
 </div>
<?php echo $footer; ?>