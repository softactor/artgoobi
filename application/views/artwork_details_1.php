<?php echo $header; ?>  
<style>
    .check_style{
        width: 208px;
        height: 280px;
        padding: 1px;
        margin: 0 1px 1px;
        text-align: center;
        font-size: 10px;
    } 
</style>
<div class="row">
    <div class="col-md-3">
        <p>
            <img src="<?php echo base_url(); ?>images/default_avater.png" class="img-thumbnail" alt="User Image">
        </p>            
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2"><?php echo $users_data->name; ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Current Occupation</td>
                    <td class="text-right"><a href="#" data-target="#occupation_modal" data-toggle="modal">Details</a></td>
                </tr>
                <tr>
                    <td>Education</td>
                    <td class="text-right">Details</td>
                </tr>
                <tr>
                    <td>Experience</td>
                    <td class="text-right">Details</td>
                </tr>
            </tbody>
        </table>
        <table class="table borderless">
            <tr>
                <td><b>Artist Writes</B></td>
            </tr>
            <tr>
                <td>
                    <p style="text-align: justify;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla orci felis,
                        tristique in arcu ac, faucibus accumsan neque. Cras odio eros, varius vel felis quis,
                        mollis commodo orci. Ut sodales neque eu massa commodo efficitur.
                        Vestibulum scelerisque vestibulum massa ut lobortis. Integer in condimentum lacus. 
                        Phasellus faucibus sed odio tempor fringilla. Maecenas vitae quam vel eros vulputate aliquet. 
                        Nullam volutpat lectus id nibh ultricies posuere eget non mauris. Duis nec justo tempor,
                        convallis velit dapibus, porttitor elit. Vestibulum mauris massa, scelerisque et erat et,
                        egestas fermentum odio.
                    </p>
                </td>
            </tr>
        </table>

    </div> <!-- End of Users Data --->
    <div class="col-md-9" style="padding: 0">
        <div class="row">
            <div class="col-md-12">
                <img class="img-responsive" src="<?php echo base_url(); ?>uploads/<?php echo $artwork_data->image_original; ?>" alt="<?php echo $artwork_data->title; ?>" title="<?php echo $artwork_data->title; ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed">
                    <tr>
                        <th>Artwork Details</th>
                    </tr>
                    <tr>
                        <td>Artist Name:</td>
                        <td><?php echo $artwork_data->artist_name ?></td>
                    </tr>
                    <tr>
                        <td>Type Of Art:</td>
                        <td><?php echo $artwork_data->artist_name ?></td>
                    </tr>
                    <tr>
                        <td>Sub Type</td>
                        <td><?php echo $artwork_data->artist_name ?></td>
                    </tr>
                    <tr>
                        <td>Title:</td>
                        <td><?php echo $artwork_data->title ?></td>
                    </tr>
                    <tr>
                        <td>Media:</td>
                        <td><?php echo $artwork_data->formate ?></td>
                    </tr>
                    <tr>
                        <td>Unit:</td>
                        <td><?php echo $artwork_data->artist_name ?></td>
                    </tr>
                    <tr>
                        <td>Size:</td>
                        <td><?php echo $artwork_data->artist_name ?></td>
                    </tr>
                    <tr>
                        <td>Year:</td>
                        <td><?php echo $artwork_data->year ?></td>
                    </tr>
                    <tr>
                        <td>Appearance:</td>
                        <td><?php echo $artwork_data->year ?></td>
                    </tr>
                    <tr>
                        <td>Frame:</td>
                        <td><?php echo $artwork_data->year ?></td>
                    </tr>
                    <tr>
                        <td>Genre:</td>
                        <td><?php echo $artwork_data->year ?></td>
                    </tr>
                    <tr>
                        <td>Color:</td>
                        <td><?php echo $artwork_data->year ?></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <?php echo ($artwork_data->price+$artwork_data->price_with_vat+$artwork_data->price_with_ser); ?>&nbsp;BDT.
                            <span style="font-weight: bold; font-style: italic;">
                                (With 12% Service Charge & 15% Vat) 
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>  
</div>
</div><!-- End of column 10 -->
<div class="col-md-2">
    <div class="row">
        <div class="col-md-12 align-middle" style="height: 350px; margin: 5px 0;">
            Commercial
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 align-middle" style="height: 350px; margin: 5px 0;">
            Commercial
        </div>
    </div>
</div

<!-- Profile Occupation Modal -->
<div id="occupation_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Work</h4>
            </div>
            <div class="modal-body">
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
                                <textarea class="form-control" rows="5" id="description" name="description"></textarea>
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
                <div id="works_details">
                    <!-- Get All user work history -->                
                    <?php
                    // We need the following param:
                    $param['where'] = [
                        'type_id' => 1,
                        'user_id' => $this->session->userdata('user_logged_id'),
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
                                <a href="#" onclick="editWorkPlace(<?php echo $works->id; ?>);"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                <a href="#" onclick="deleteWorkPlace(<?php echo $works->id; ?>);"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                            </div>
                            <span id="work_update_form_area_<?php echo $works->id; ?>"></span>
                            <hr>
                            <?php
                        }
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
<!-- /Profile Occupation Modal -->
<?php echo $footer; ?>