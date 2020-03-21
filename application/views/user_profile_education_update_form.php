<div id="update_education_form">
    <form class="form-horizontal" id="profile_education_history_update_<?php echo $work_data->id; ?>" action="" method="post">
        <div class="form-group">
            <label class="control-label col-sm-4" for="institution">Institution:</label>
            <div class="col-sm-8">
                <input value="<?php echo $details->institution; ?>" type="text" class="form-control" id="institution_update" placeholder="Name of Institution" name="institution_update">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="concentrations">Concentrations:</label>
            <div class="col-sm-8">
                <input value="<?php echo $details->concentrations; ?>" type="text" class="form-control" id="concentrations_update" placeholder="Concentrations" name="concentrations_update">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="attend_for">Attend for:</label>
            <div class="col-sm-8">
                <input value="<?php echo $details->attend_for; ?>" type="text" class="form-control" id="attend_for_update" placeholder="Attend For" name="attend_for_update">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="obtain">Obtain:</label>
            <div class="col-sm-8">
                <input value="<?php echo $details->obtain; ?>" type="text" class="form-control" id="obtain_update" placeholder="Obtain" name="obtain_update">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-4" for="description">Description:</label>
            <div class="col-sm-8">
                <textarea class="form-control" rows="5" id="description" name="description_update"><?php echo $details->description; ?></textarea>
            </div>
        </div>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" onclick="cancelUpdateEducationHistory(<?php echo $work_data->id; ?>);">Cancel</button>
                <button type="button" class="btn btn-default" onclick="saveEducationHistory('update',<?php echo $work_data->id; ?>);">Update</button>
            </div>
        </div>
        <input type="hidden" name="work_update_id" value="<?php echo $work_data->id; ?>">
    </form>
</div>
