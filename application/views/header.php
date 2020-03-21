<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/icon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>css/ihover.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>js/global_url.js"></script>
        <link href="<?php echo base_url(); ?>css/artgoobi.css" rel="stylesheet">
        <!---------------------- LightBox --------------------------- -->
        <link href="<?php echo base_url(); ?>lightbox/css/lightbox.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>lightbox/js/lightbox-plus-jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/signup.js"></script>
        <script src="<?php echo base_url(); ?>js/frontside.js"></script>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2 header_logo">
                            <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() ?>logo.png" height="105"/></a>
                        </div>
                        <div class="col-md-8 pull-right" style="margin-top: 3%">
                            <nav class="navbar navbar-default">
                                <div class="container-fluid pull-right">
                                    <ul class="nav navbar-nav">
                                        <li><a href="<?php echo base_url() ?>">Home</a></li>
                                        <li><a href="#">Events</a></li>
                                        <li><a href="#">Journal</a></li>
                                        <li><a href="#">Sell</a></li>
                                    </ul>
                                    <form class="navbar-form navbar-right">
                                        <div class="input-group stylish-input-group">
                                            <input type="text" class="form-control"  placeholder="Search" >
                                            <span class="input-group-addon">
                                                <button type="submit">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>  
                                            </span>
                                        </div>
                                    </form>                                        
                                </div>
                            </nav>
                            <div class="box after_custom_search_box">
                                <div class="box-body">
                                    <div class="row">
                                        <?php
                                            $user_logged_in = $this->session->userdata('user_logged_in_status');
                                            if(isset($user_logged_in) && !empty($user_logged_in)){
                                        ?>
                                        <div id="logged_in_area" class="col-md-12 pull-right" style="margin-right: -11px; text-align: right;">
                                            <a href="<?php echo base_url() ?>welcome/user_profile">
                                                <img src="<?php echo base_url(); ?>images/default_avater.png" class="user-image" alt="User Image" width="25">
                                                <span class="hidden-xs">
                                                    <?php echo $this->session->userdata('user_logged_name'); ?>
                                                </span>
                                            </a>
                                        </div> 
                                        <?php } ?>
                                        <div class="col-md-2 pull-right">
                                            <?php
                                                if(isset($user_logged_in) && !empty($user_logged_in)){
                                            ?>
                                            <a id="logout_link" href="#" class="btn btn-default btn-flat btn-xs profile_link_style" data-toggle="modal" data-target="#modal_user_logout">LOGOUT</a>
                                            <?php }
                                                if(!isset($user_logged_in) && empty($user_logged_in)){
                                            ?>
                                            <a id="login_link" target="_blank" href="#" class="btn btn-default btn-flat btn-xs profile_link_style" data-toggle="modal" data-target="#modal_userloggin">LOGIN</a>
                                            <a id="signup_link" class="btn btn-default btn-flat btn-xs profile_link_style" data-toggle="modal" data-target="#modal_signup">SIGN UP</a>
                                            <?php } ?>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                    <!-- USER LOGGED IN MODAL ----->
                    <div class="modal fade" id="modal_userloggin">
                        <div class="modal-dialog">
                            <form action="" id="userlogin" method="post">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Login</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger alert-dismissible" id="op_alert_sec" style="display: none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                            <span id="op_message"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                            <span class="help-block"></span>
                                        </div>                                      
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Password</label>
                                            <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-primary">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" onclick="user_login_process();">Login</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </form>
                            <!-- /Form-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    
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
                                        <div class="form-group">
                                            <label>Type</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="signup_type" value="6" checked>Artist
                                                </label>
                                                <label>
                                                    <input type="radio" name="signup_type" value="7">Visitor
                                                </label>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
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
                                            <label>Gender</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="gender" value="1" checked>Male
                                                </label>
                                                <label>
                                                    <input type="radio" name="gender" value="2">Female
                                                </label>
                                                <span class="help-block"></span>
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
                                            <select name="country" class="form-control">
                                                <option value="">Please Select</option>
                                                <?php
                                                    $countries = get_all_data_by_table("country");
                                                    foreach($countries as $country){
                                                ?>
                                                <option value="<?php echo $country->id;  ?>"><?php echo $country->name;  ?></option>
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
                                    </div>
                                    <div class="modal-footer bg-primary">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" onclick="signup_process();">Signup</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </form>
                            <!-- /Form-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    
                    <!-- Logout Modal -->
                    <div class="modal modal-danger fade" id="modal_user_logout">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p><b>Are you sure, you want to logout?</b></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-outline" onclick="confirm_userlogged_out();">Confirm</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->



