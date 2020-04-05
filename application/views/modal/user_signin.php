<!-- SIGNUP MODAL ----->
<div class="modal fade" id="modal_signup">
    <div class="modal-dialog">
        <form action="" id="signup" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Signup</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="artwork_signup_option" id="artwork_signup_option_artist" onclick="showSignupFormFields('artist');">
                                <h2>artist</h2>
                                <p>
                                    Want to create my own profile and show my artworks
                                </p>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="artwork_signup_option" id="artwork_signup_option_collector" onclick="showSignupFormFields('collector');">
                                <h2>collector</h2>
                                <p>
                                    Want to show artworks from my collection and collect more
                                </p>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="artwork_signup_option" id="artwork_signup_option_visitor" onclick="showSignupFormFields('visitor');">
                                <h2>visitor</h2>
                                <p>
                                    Want to visit and and collect artworks
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-12">
                            <h3 class="signup_welcome" id="signup_welcome">Welcome to artgoobi</h3>
                        </div>
                    </div>
                    <div id="signup_form_section" style="display: none;">                        
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Profile Link Name</label><span> like artgoobi.com/your.profile.link.name</span>
                            <input onkeyup="check_profile_name_availability(this.value);" type="text" id="profile_link_name" name="profile_link_name" class="form-control" placeholder="Enter Profile Link name">
                            <span class="help-block"></span>
                            <span id="profile_link_name_status"></span>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-12">Date of Birth</label>
                            <div class="col-md-4">
                                <label for="ex1">Day</label>
                                <select name="birth_day" id="birth_day" class="form-control">
                                    <option value="">Please Select</option>
                                    <?php formDay(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="ex2">Month</label>
                                <select name="birth_month" id="birth_month" class="form-control">
                                    <option value="">Please Select</option>
                                    <?php formMonth(); ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="ex3">Year</label>
                                <select name="birth_year" id="birth_year" class="form-control">
                                    <option value="">Please Select</option>
                                    <?php formYear(get_settings_value_by_key('year_start')); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                            <span class="help-block"></span>
                        </div>
                        <!-- Country Drop Down -->
                        <div class="form-group">
                            <label>Country</label>
                            <select name="country_id" class="form-control">
                                <option value="">Please Select</option>
                                <?php
                                $countries = get_all_data_by_table("country");
                                foreach ($countries as $country) {
                                    ?>
                                    <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label>Zip Code</label>
                            <input type="text" name="zip_code" class="form-control" placeholder="Enter Zip Code">
                            <span class="help-block"></span>
                        </div>                                        
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Re Type Password</label>
                            <input type="password" name="re_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            <span class="help-block"></span>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="push_signup_type" name="signup_type">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" onclick="signup_process();">Signup</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </form>
        <!-- /Form-content -->
    </div>
    <!-- /.modal-dialog -->
</div>