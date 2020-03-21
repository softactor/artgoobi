<div id="update_work_place_form">
    <form class="form-horizontal" id="profile_work_history_update_<?php echo $work_data->id; ?>" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="company">Company:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="company_up" placeholder="Where Have You Worked?" name="company_up" value="<?php echo $details->company; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="position">Position:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="position_up" placeholder="What is your Job Title?" name="position_up" value="<?php echo $details->position; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="town">City/Town:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="location_up" placeholder="Location" name="location_up" value="<?php echo $details->location; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Description:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" id="description_up" name="description_up"><?php echo $details->description; ?></textarea>
            </div>
        </div>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="cancelUpdateWorkHistory(<?php echo $work_data->id; ?>);">Cancel</button>
                <button type="button" class="btn btn-default" onclick="saveWorkHistory('update',<?php echo $work_data->id; ?>);">Update</button>
            </div>
        </div>
        <input type="hidden" name="work_update_id" value="<?php echo $work_data->id; ?>">
    </form>
</div>
