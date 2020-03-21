<div id="education_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Education</h4>
            </div>
            <div class="modal-body">
                <?php if($profiler){ ?>
                <!-- Add work place link -->
                <p id="add_education_details"><a href="#" onclick="addEducationDetails();"><span class="glyphicon glyphicon-plus"></span> Add Education Details</a></p>
                <!-- Add work place Form -->
                <div id="add_education_details_form" style="display: none;">
                    <form class="form-horizontal" id="profile_education_history" action="" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="institution">Institution:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="institution" placeholder="Name of Institution" name="institution">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="concentrations">Concentrations:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="concentrations" placeholder="Concentrations" name="concentrations">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="attend_for">Attend for:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="attend_for" placeholder="Attend For" name="attend_for">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="obtain">Obtain:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="obtain" placeholder="Obtain" name="obtain">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-4" for="description">Description:</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="button" class="btn btn-default" onclick="saveEducationHistory('insert', '');">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr>
                <?php } ?>
                <div id="education_details">
                    <!-- Get All user work history -->                
                    <?php
                    // We need the following param:
                    $param['where'] = [
                        'type_id' => 2,
                        'user_id' => $artwork_data->artist_id,
                    ];
                    $param['table'] = 'users_profile_details';
                    $works_details = get_user_profile_details($param);
                    if (isset($works_details) && !empty($works_details)) {
                        foreach ($works_details as $works) {
                            $details = json_decode($works->details);
                            ?>
                            <div class="educauion_details_area" id="educauion_details_area_<?php echo $works->id; ?>">
                                <h3><?php echo $details->attend_for; ?></h3>
                                <p>
                                    <span class="work_position"><?php echo $details->obtain; ?>,</span>
                                    <span class="work_location"><?php echo $details->institution; ?></span>
                                </p>
                                <p>
                                    <span class="work_description"><?php echo $details->description; ?></span>
                                </p>
                                <?php if($profiler){ ?>
                                <a href="#" onclick="editEducationDetails(<?php echo $works->id; ?>);"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                <a href="#" onclick="deleteWorkPlace(<?php echo $works->id; ?>);"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                                <?php } ?>
                            </div>
                            <span id="education_update_form_area_<?php echo $works->id; ?>"></span>
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