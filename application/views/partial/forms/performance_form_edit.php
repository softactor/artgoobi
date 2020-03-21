<div class="dyna_type_of_art" id="dyna_type_of_art_Performance">
    <div class="form-group">
        <label class="control-label col-sm-4" for="price">Site/Location:</label>
        <div class="col-sm-8">          
            <input type="text" class="form-control" id="site_location" placeholder="Site Or Location" name="site_location" value="<?php echo set_value('site_location', $artwork_data->site_location); ?>">
            <span class='alert-danger'><?php echo form_error('site_location'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="price">Support Elements:</label>
        <div class="col-sm-8">          
            <input type="text" class="form-control" id="support_elements" placeholder="Support Elements" name="support_elements" value="<?php echo set_value('support_elements', $artwork_data->support_elements); ?>">
            <span class='alert-danger'><?php echo form_error('support_elements'); ?></span>
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
        <label class="control-label col-sm-4" for="price">Duration:<span class="required"></span></label>
        <div class="col-sm-8">          
            <input type="text" class="form-control" id="performance_duration" placeholder="Duration" name="performance_duration" value="<?php echo set_value('performance_duration', $artwork_data->performance_duration); ?>">
            <span class='alert-info field_info'>Please follow the format <b>HH:MM:SS</b></span>
            <span class='alert-danger'><?php echo form_error('performance_duration'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="price">Video Link:</label>
        <div class="col-sm-8">          
            <input type="text" class="form-control" id="video_link" placeholder="Video Link" name="video_link" value="<?php echo set_value('video_link', $artwork_data->video_link); ?>">
            <span class='alert-danger'><?php echo form_error('video_link'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="price">Concept Note:<span class="required"></span></label>
        <div class="col-sm-8">          
            <textarea class="form-control" id="short_description" name="short_description"><?php echo set_value('short_description', $artwork_data->short_description); ?></textarea>
            <span class='alert-danger'><?php echo form_error('short_description'); ?></span>
        </div>
    </div>
</div>