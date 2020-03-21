<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Artgoobi || Artwork</title>
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

<!--</div>-->
<div class="container bootstrap snippet">
    <div class="row" style="margin-top: 100px">

        <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
            <?php
            $flass = $this->session->flashdata('op_message');
            if(isset($flass)){ ?>
                <div class="row" style="padding-top: 10%;">
                    <div class="col-md-12">
                        <div class="alert alert-danger alert-dismissible text-center" id='operation_message_box'>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> <?php echo $flass; ?>!</h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <form class="form-signin" action="<?php echo base_url()."welcome/reset_password"; ?>" method="post">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <span class="glyphicon glyphicon-th"></span>
                        Change password
                    </h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 separator social-login-box"> <br>
                            <img alt="" class="img-thumbnail" src="<?php echo base_url(); ?>logo.png">
                        </div>
                        <div style="margin-top:80px;" class="col-xs-6 col-sm-6 col-md-6 login-box">

                                <div class="form-group">
                                    <span id="reauth-email" class="reauth-email"></span>
                                    <input type="hidden" name="secret_key" id="secret_key" class="form-control" value="<?php if($this->input->get('secret_key')){echo $this->input->get('secret_key');}; ?>">
                                    <input type="hidden" name="user_name" id="inputEmail" class="form-control" value="<?php echo $user_email; ?>">
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                        <input required style="margin-bottom:0" class="form-control" type="password" placeholder="New Password" name="password">
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <a class="btn icon-btn-save btn-info" href="<?php echo base_url(); ?>">Back</a>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <button style="width: 60px" class="btn icon-btn-save btn-success pull-right" type="submit">save</button>
                        </div>

                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>