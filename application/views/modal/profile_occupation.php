<div id="occupation_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Occupation</h4>
            </div>
            <div class="modal-body">
                <?php if($profiler){ ?>
                <!-- Add work place link -->
                <p id="add_work_place"><a href="#" onclick="addWorkPlace();"><span class="glyphicon glyphicon-plus"></span> Add Work Place</a></p>
                <!-- Add work place Form -->
                <div id="add_work_place_form" style="display: none;">
                    <form class="form-horizontal" id="profile_work_history" action="" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="company">Company:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="company" placeholder="Where Have You Worked?" name="company">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="position">Position:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="position" placeholder="What is your Job Title?" name="position">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="town">City/Town:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="location" placeholder="Location" name="location">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Description:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control mceEditor" rows="5" name="description">Ban</textarea>
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-default" onclick="saveWorkHistory('insert', '');">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <?php } ?>
                <div id="works_details">
                    <!-- Get All user work history -->                
                    <?php
                    if(isset($artwork_data->artist_id) && !empty($artwork_data->artist_id)){
                    // We need the following param:
                    $param['where'] = [
                        'type_id' => 1,
                        'user_id' => $artwork_data->artist_id,
                    ];
                    $param['table'] = 'users_profile_details';
                    $works_details = get_user_profile_details($param);
                    if (isset($works_details) && !empty($works_details)) {
                        foreach ($works_details as $works) {
                            $details = json_decode($works->details);
                            ?>
                            <div class="work_details_area" id="work_details_area_<?php echo $works->id; ?>">
                                <h3><?php echo $details->company; ?></h3>
                                <p>
                                    <span class="work_position"><?php echo $details->position; ?>,</span>
                                    <span class="work_location"><?php echo $details->location; ?></span>
                                </p>
                                <p>
                                    <span class="work_description"><?php echo $details->description; ?></span>
                                </p>
                                <?php if($profiler){ ?>
                                <a href="#" onclick="editWorkPlace(<?php echo $works->id; ?>);"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                <a href="#" onclick="deleteWorkPlace(<?php echo $works->id; ?>);"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                                <?php } ?>
                            </div>
                            <span id="work_update_form_area_<?php echo $works->id; ?>"></span>
                            <hr>
                            <?php
                        }
                    }else{ ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <strong>Sorry, currently there is no information to show.</strong>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    }
                    ?>               
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<span id="modal_open_area"></span>
<input type="hidden" id="delete_table_name" />
<input type="hidden" id="delete_id" />