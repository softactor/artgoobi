<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome to SMS</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/icon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/login.css" rel="stylesheet">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>js/login.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <?php
                $flass = $this->session->flashdata('op_message');
                if(isset($flass['status']) && $flass['status']=='error'){ ?>
            <div class="row" style="padding-top: 10%;">
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible text-center" id='operation_message_box'>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> <?php echo $flass['message']; ?>!</h4>                            
                            </div>
                        </div>
                    </div>
            <?php } ?>
            <?php
                if(isset($flass['status']) && $flass['status']=='success'){ ?>
                    <div class="row" style="padding-top: 10%;">
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible text-center" id='operation_message_box'>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> <?php echo $flass['message']; ?>!</h4>                            
                            </div>
                        </div>
                    </div>
            <?php } ?>
            <div class="card card-container">
                <img id="profile-img" class="profile-img-card" src="<?php echo base_url(); ?>logo.png" />
                <form class="form-signin" action="<?php echo base_url()."welcome/logging_attempt"; ?>" method="post">
                    <span id="reauth-email" class="reauth-email"></span>
                    <input type="email" name="user_name" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    <input type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="submit" value="login">
                </form><!-- /form -->
<!--                <a href="#" class="forgot-password">
                    Forgot the password?
                </a>-->
            </div><!-- /card-container -->
        </div>
    </body>
</html>