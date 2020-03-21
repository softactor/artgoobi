<?php echo $header; ?>
<!-- Content Content Area Start -->
<div class="col-md-10">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <!-- here profile left pannel wil go -->
                <?php echo $profile_left_panel; ?>
                <!-- Here artwork form block start -->
                <div class="col-md-9 bg-success">
                    <h3>Artwork upload Form</h3>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('welcome/artist_image_upload_process'); ?>">
                        <table class="table no-border">
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="arits_name">Owner Type:</label>
                                        <div class="col-sm-6">          
                                            <label class="radio-inline">
                                                <input type="radio" name="artwork_owner" value="1" checked onchange="toggle_artist_name_change(1);" />SELF
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="artwork_owner" value="2" onchange="toggle_artist_name_change(2);" />OTHERS
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="arits_name">Artist Name:</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" id="hidden_artist_id" name="hidden_artist_id" value="<?php echo $users_info->id; ?>">
                                            <input type="hidden" id="hidden_artist_name" value="<?php echo $users_info->name; ?>">
                                            <input type="text" class="form-control" id="arits_name" placeholder="arits name" name="arits_name" value="<?php echo $users_info->name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="sel1">Type Of Art:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="type_of_art_id" name="type_of_art_id" onchange="get_subtype_artwork();">
                                                <option value="">Select</option>
                                                <?php
                                                $art_type = get_all_data_by_table('artwork_type');
                                                if (isset($art_type) && !empty($art_type)) {
                                                    foreach ($art_type as $type) {
                                                        ?>
                                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="sel1">Sub Type:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="type_of_child_id" name="type_of_child_id">
                                                <option value="">Please Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="title">Title:</label>
                                        <div class="col-sm-6">          
                                            <input type="text" class="form-control" id="title" placeholder="Title" name="title">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="media">Media:</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="formate" name="formate">
                                                <option value="">Select</option>
                                                <?php
                                                $art_type = get_all_data_by_table('artwork_media');
                                                if (isset($art_type) && !empty($art_type)) {
                                                    foreach ($art_type as $type) {
                                                        ?>
                                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="price">Year:</label>
                                        <div class="col-sm-6">          
                                            <input type="date" class="form-control" id="year" placeholder="year" name="year">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="unit">Unit:</label>
                                        <div class="col-sm-6">          
                                            <label class="radio-inline">
                                                <input type="radio" name="unit_type" value="2" />Pixel
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="unit_type" value="1" />Inch
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="unit">Size:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control input-sm" name='width' placeholder="width" />
                                            <span class="input-group-btn" style="width:0px;"></span>
                                            <input type="text" class="form-control input-sm" name='height' placeholder="height"  />
                                            <span class="input-group-btn" style="width:0px;"></span>
                                            <input type="text" class="form-control input-sm" name='depth' placeholder="depth"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="price">Artwork:</label>
                                        <div class="col-sm-6">          
                                            <input type="file" name='userfile'>
                                        </div>
                                    </div>                                    
                                </td>
                                <td style="width: 40%">
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="arits_name">Appearence:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="appearence" name="appearence">
                                                <option value="">Appearence</option>
                                                <?php
                                                $art_type = get_all_data_by_table('artwork_appearence');
                                                if (isset($art_type) && !empty($art_type)) {
                                                    foreach ($art_type as $type) {
                                                        ?>
                                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="arits_name">Frame:</label>
                                        <div class="col-sm-8">          
                                            <select class="form-control" id="frame" name="frame">
                                                <option value="">Frame</option>
                                                <?php
                                                $art_type = get_all_data_by_table('artwork_frame');
                                                if (isset($art_type) && !empty($art_type)) {
                                                    foreach ($art_type as $type) {
                                                        ?>
                                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="arits_name">Genre:</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="genre" name="genre">
                                                <option value="">Genre</option>
                                                <?php
                                                $art_type = get_all_data_by_table('artwork_genre');
                                                if (isset($art_type) && !empty($art_type)) {
                                                    foreach ($art_type as $type) {
                                                        ?>
                                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="arits_name">Color:</label>
                                        <div class="col-sm-8">         
                                            <select class="form-control" id="color_op" name="color">
                                                <option value="">Color</option>
                                                <?php
                                                $art_type = get_all_data_by_table('artwork_basic_color');
                                                if (isset($art_type) && !empty($art_type)) {
                                                    foreach ($art_type as $type) {
                                                        ?>
                                                        <option value="<?php echo $type->id; ?>"><?php echo $type->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="price">Not For Sale:</label>
                                        <div class="col-sm-6">          
                                            <div class="checkbox">
                                                <label><input type="checkbox" name='not_for_sale' id="not_for_sale" value="1" onchange="togglePriceShowhide();">Not For Sale</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="price">Price:</label>
                                        <div class="col-sm-6">          
                                            <input type="text" class="form-control" id="price" placeholder="price" name="price" onkeyup="calculateActualPrice();">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-4" for="price">Actual Price:</label>
                                        <div class="col-sm-6">          
                                            <input type="text" class="form-control" id="actual_price" placeholder="Actual price" name="actual_price">
                                            <span>(With 12% Service Charge & 15% Vat)</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="form-group pull-right">        
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-default">Upload</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>        
