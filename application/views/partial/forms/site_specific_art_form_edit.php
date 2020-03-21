<div class="dyna_type_of_art" id="dyna_type_of_art_Site_specific">
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
                        <option value="<?php echo $type->id; ?>"<?php if(isset($artwork_data->artwork_media) && $artwork_data->artwork_media==$type->id){ echo 'selected'; } ?>><?php echo $type->name; ?></option>
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
            <select class="form-control" class="form-control" id="year" placeholder="year" name="year">
                <option value="">Please select</option>
                <?php
                    $start  =   date('Y');
                    $end    =   get_settings_value_by_key('year_start');
                    for($i=$start; $end <= $start; $start--){
                ?>
                <option value="<?php echo $start; ?>"<?php if(isset($artwork_data->year) && $artwork_data->year==$start){ echo 'selected'; } ?>><?php echo $start; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="unit">Unit:</label>
        <div class="col-sm-6">          
            <label class="radio-inline">
                <input type="radio" name="unit_type" value="2" <?php if(isset($artwork_data->unit_type) && $artwork_data->unit_type==2){ echo 'checked'; } ?>/>Pixel
            </label>
            <label class="radio-inline">
                <input type="radio" name="unit_type" value="1" <?php if(isset($artwork_data->unit_type) && $artwork_data->unit_type==1){ echo 'checked'; } ?>/>Inch
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="unit">Size:</label>
        <div class="input-group">
            <input type="text" class="form-control input-sm" name='width' placeholder="width" value="<?php echo set_value('width', $artwork_data->width); ?>"/>
            <span class="input-group-btn" style="width:0px;"></span>
            <input type="text" class="form-control input-sm" name='height' placeholder="height" value="<?php echo set_value('width', $artwork_data->height); ?>"/>
            <span class="input-group-btn" style="width:0px;"></span>
            <input type="text" class="form-control input-sm" name='depth' placeholder="depth" value="<?php echo set_value('width', $artwork_data->depth); ?>"/>
        </div>
    </div>
</div>