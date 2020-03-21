<div class="dyna_type_of_art" id="dyna_type_of_art_Sclupture">
    <div class="form-group">
        <label class="control-label col-sm-4" for="media">Media:<span class="required"></span></label>
        <div class="col-sm-8">         
            <input type="text" class="form-control" id="formate" placeholder="Please Specify" name="formate" value="<?php if(isset($artwork_data->formate) && !empty($artwork_data->formate)){ echo $artwork_data->formate;} ?>">
            <span class='alert-danger'><?php echo form_error('format'); ?></span>
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
                <input type="radio" name="unit_type" value="3" checked/>CM
            </label>
            <label class="radio-inline">
                <input type="radio" name="unit_type" value="1" <?php if(isset($_POST['unit_type']) && $_POST['unit_type']==1){ echo 'checked'; } ?>/>Inch
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