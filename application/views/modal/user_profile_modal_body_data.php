<div class="modal-body">
    <div class="form-group">
        <label>Type</label>
        <div class="radio">
            <label>
                <input type="radio" name="signup_type" value="6" <?php if(isset($profile_data->user_type) && $profile_data->user_type == 6){ echo 'checked'; } ?>>Artist
            </label>
            <label>
                <input type="radio" name="signup_type" value="7" <?php if(isset($profile_data->user_type) && $profile_data->user_type == 7){ echo 'checked'; } ?>>Visitor
            </label>
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group">
        <label>Profile Link </label><span class="profile_link_hints"> http://artgoobi.com/<?php if(isset($profile_data->profile_link_name) && !empty($profile_data->profile_link_name)){ echo $profile_data->profile_link_name; } ?></span>
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>First Name</label>
        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" value="<?php if(isset($profile_data->first_name) && !empty($profile_data->first_name)){ echo $profile_data->first_name; } ?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" value="<?php if(isset($profile_data->last_name) && !empty($profile_data->last_name)){ echo $profile_data->last_name; } ?>">
        <span class="help-block"></span>
    </div>                                      
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php if(isset($profile_data->user_email) && !empty($profile_data->user_email)){ echo $profile_data->user_email; } ?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" placeholder="Enter Phone" value="<?php if(isset($profile_data->phone_no) && !empty($profile_data->phone_no)){ echo $profile_data->phone_no; } ?>">
        <span class="help-block"></span>
    </div>
    <!-- Country Drop Down -->
    <div class="form-group">
        <label>Country</label>
        <select name="country_id" id="country_id" class="form-control">
            <option value="">Please Select</option>
            <?php
            $countries = get_all_data_by_table("country");
            foreach ($countries as $country) {
                ?>
                <option value="<?php echo $country->id; ?>"<?php if(isset($profile_data->country_id) && $profile_data->country_id == $country->id){ echo 'selected'; } ?>><?php echo $country->name; ?></option>
            <?php } ?>
        </select>
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Zip Code</label>
        <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code" value="<?php if(isset($profile_data->zip_code) && !empty($profile_data->zip_code)){ echo $profile_data->zip_code; } ?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>present Designation</label>
        <input type="text" name="present_desig" class="form-control" placeholder="Enter present designation" value="<?php if(isset($profile_data->present_desig) && !empty($profile_data->present_desig)){ echo $profile_data->present_desig; } ?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Present Work</label>
        <input type="text" name="present_working_area" class="form-control" placeholder="Enter Present Work" value="<?php if(isset($profile_data->present_working_area) && !empty($profile_data->present_working_area)){ echo $profile_data->present_working_area; } ?>">
        <span class="help-block"></span>
    </div>
    <div class="form-group" style="display: none;">
        <label>Previous Work</label>
        <textarea class="form-control" rows="5" id="previous_working_area" name="previous_working_area"><?php if(isset($profile_data->previous_working_area) && !empty($profile_data->previous_working_area)){ echo $profile_data->previous_working_area; } ?></textarea>
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Short Bio</label>
        <textarea class="form-control" rows="15" id="short_bio" name="short_bio"><?php if(isset($profile_data->short_bio) && !empty($profile_data->short_bio)){ echo $profile_data->short_bio; } ?></textarea>
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password" value="">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword">Confirm Password</label>
        <input type="password" name="re_password" class="form-control" id="re_password" placeholder="Confirm Password" value="">
        <span class="help-block"></span>
    </div>
    <div class="form-group">
        <label>Status</label>
        <?php
            switch($profile_data->status){
                case 0:
                    echo '<span class="label label-danger">Inactive</span>';
                    break;
                case 1:
                    echo '<span class="label label-success">Active</span>';
                    break;
                case 2:
                    echo '<span class="label label-warning">Pending</span>';
                    break;
                default:
                    echo "Undefine";
            }
        ?>
    </div>
</div>
<input type="hidden" name="update_id" id="update_id" value="<?php echo $profile_data->user_id; ?>" />