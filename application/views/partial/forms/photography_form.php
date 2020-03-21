<div class="dyna_type_of_art" id="dyna_type_of_art_Photography">
    <div class="form-group">
        <label class="control-label col-sm-4" for="media">Format:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control input-sm" name='formate' placeholder="formate" value="<?php echo set_value('formate'); ?>"/>
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
                <option value="<?php echo $start; ?>"<?php if(isset($_POST['year']) && $_POST['year']==$start){ echo 'selected'; } ?>><?php echo $start; ?></option>
                <?php } ?>
            </select>
            <span class='alert-danger'><?php echo form_error('year'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="unit">Filter:</label>
        <div class="col-sm-8">
            <div class="radio">
                <label><input type="radio" name="photography_filter" value="Camera" <?php if(isset($_POST['photography_filter']) && $_POST['photography_filter']=='Camera'){ echo 'checked'; } ?>/>Camera</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="photography_filter" value="Lens" <?php if(isset($_POST['photography_filter']) && $_POST['photography_filter']=='Lens'){ echo 'checked'; } ?>/>Lens</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="photography_filter" value="Photoshop" <?php if(isset($_POST['photography_filter']) && $_POST['photography_filter']=='Photoshop'){ echo 'checked'; } ?>/>Photoshop</label>
            </div>
            <div class="radio">
                <label><input type="radio" name="photography_filter" value="None" <?php if(isset($_POST['photography_filter']) && $_POST['photography_filter']=='None'){ echo 'checked'; } ?>/>None</label>
            </div>
            <span class='alert-danger'><?php echo form_error('photography_filter'); ?></span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="unit">Size:<span class="required"></span></label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text" class="form-control input-sm" name='width' placeholder="width" value="<?php echo set_value('width'); ?>"/>
                <span class="input-group-btn" style="width:0px;"></span>
                <input type="text" class="form-control input-sm" name='height' placeholder="height" value="<?php echo set_value('height'); ?>"/>
            </div>
            <span>(size should be in pixel)</span>
            <span class='alert-danger'><?php echo form_error('width'); ?></span>
            <span class='alert-danger'><?php echo form_error('height'); ?></span>
            <span class='alert-danger'><?php echo form_error('depth'); ?></span>
        </div>
    </div>
</div>