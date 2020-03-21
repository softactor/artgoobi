<div class="dyna_type_of_art" id="dyna_type_of_art_Design">    
    <div class="form-group">
        <label class="control-label col-sm-4" for="price">Type:<span class="required"></span></label>
        <div class="col-sm-8">          
            <select class="form-control" id="design_type" name="design_type">
                <option value="">Select</option>
                <option value="Card"<?php if(isset($_POST['design_type']) && $_POST['design_type']=='Card'){ echo 'selected'; } ?>>Card</option>
                <option value="Cover"<?php if(isset($_POST['design_type']) && $_POST['design_type']=='Cover'){ echo 'selected'; } ?>>Cover</option>
                <option value="Logo"<?php if(isset($_POST['design_type']) && $_POST['design_type']=='Logo'){ echo 'selected'; } ?>>Logo</option>
                <option value="Poster"<?php if(isset($_POST['design_type']) && $_POST['design_type']=='Poster'){ echo 'selecteds'; } ?>>Poster</option>
            </select>
            <span class='alert-danger'><?php echo form_error('design_type'); ?></span>
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
</div>