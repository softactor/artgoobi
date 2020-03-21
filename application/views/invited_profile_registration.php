<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Artgoobi | Registration</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/favicon_16X16.png" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/sweetalert.css">
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/global_url.js"></script>
        <script src="<?php echo base_url(); ?>js/signup.js"></script>
        <script src="<?php echo base_url(); ?>js/sweetalert2.all.min.js"></script>
    </head>
    <body>
        <form action="" id="invited_signup" method="post">
        <div id="login-overlay" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="<?php echo base_url() ?>logo.png" class="pull-left" /><h4 class="modal-title" id="myModalLabel"><b>Profile registration</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="well">
                                <div id="signup_form_section">                        
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
                                        <input type="hidden" id="secret_id" name="secret_id" value="<?php if(isset($secret_id) && !empty($secret_id)){ echo $secret_id; } ?>">
                                        <input type="hidden" id="secret_key" name="secret_key" value="<?php if(isset($secret_key) && !empty($secret_key)){ echo $secret_key; } ?>">
                                        <input type="hidden" id="push_signup_type" name="signup_type" value="6">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" onclick="invited_signup_process();">Signup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </form>
    </body>
</html>
