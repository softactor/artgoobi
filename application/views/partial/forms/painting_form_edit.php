<div class="dyna_type_of_art" id="dyna_type_of_art_Painting">
    <div class="form-group">
        <label class="control-label col-sm-4" for="media">Media:<span class="required"></span></label>
        <div class="col-sm-8">
            <select class="form-control" id="formate" name="formate">
                <option value="">Select</option>
                <?php
                $param['where'] =   [
                    'artwork_type_id'   =>  1// as it is default load so assign id manually
                ];
                $param['table'] =   'artwork_media';
                $param['order'] =   'asc';
                $param['field'] =   'name';
                $art_type = get_table_data_by_param($param);
                if (isset($art_type) && !empty($art_type)) {
                    foreach ($art_type as $type) {
                        ?>
                        <option value="<?php echo $type->id; ?>" <?php if(isset($artwork_data->formate) && $artwork_data->formate==$type->id){ echo 'selected'; } ?>><?php echo $type->name; ?></option>
                        <?php
                    }
                }
                ?>
            </select>
            <span class='alert-danger'><?php echo form_error('formate'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="price">Year:<span class="required"></span></label>
        <div class="col-sm-8"> 
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
            <span class='alert-danger'><?php echo form_error('year'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="unit">Unit:</label>
        <div class="col-sm-8">          
            <label class="radio-inline">
                <input type="radio" name="unit_type" value="3" <?php if(isset($artwork_data->unit_type) && $artwork_data->unit_type==3){ echo 'checked'; } ?>/>CM
            </label>
            <label class="radio-inline">
                <input type="radio" name="unit_type" value="1" <?php if(isset($artwork_data->unit_type) && $artwork_data->unit_type==1){ echo 'checked'; } ?> />Inch
            </label>
            <span class='alert-danger'><?php echo form_error('unit_type'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="unit">Size:<span class="required"></span></label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text" class="form-control input-sm" name='width' placeholder="width" value="<?php echo set_value('width',$artwork_data->width); ?>"/>
                <span class="input-group-btn" style="width:0px;"></span>
                <input type="text" class="form-control input-sm" name='height' placeholder="height" value="<?php echo set_value('height', $artwork_data->height); ?>"/>
                
            </div>
            <span class='alert-danger'><?php echo form_error('width'); ?></span>
            <span class='alert-danger'><?php echo form_error('height'); ?></span>
        </div>
    </div>
</div>