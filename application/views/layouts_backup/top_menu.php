<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url() ?>">
                            <img id="artgoobi_header_image_logo" class="header_logo_image_text" src="<?php echo base_url() ?>logo.png" height="105"/>
                            <span id="artgoobi_header_image_text" class="header_logo_image_text">Artgoobi</span>
                        </a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_url() ?>">Home</a></li>
                            <li><a href="<?php echo base_url('welcome/about_us'); ?>">About</a></li>
                            <li><a href="<?php echo base_url('welcome/exhibition_list'); ?>">Exhibition</a></li>
                            <li><a href="<?php echo base_url('welcome/event_list'); ?>">Event</a></li>
                            <li><a href="<?php echo base_url('welcome/gallery_list'); ?>">Artgoobi Gallery</a></li>
                            <li><a href="<?php echo base_url('welcome/terms_and_conditions'); ?>">Terms & Conditions</a></li>
                            <li><a href="<?php echo base_url('welcome/contact_us'); ?>">Contact Us</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                                $user_logged_in = $this->session->userdata('user_logged_in_status');
                                if(isset($user_logged_in) && !empty($user_logged_in)){
                            ?>
                            <li>
                                <a href="<?php echo base_url() ?>welcome/user_profile">
                                    <img src="<?php echo base_url(); ?>images/default_avater.png" class="user-image" alt="User Image" width="25">
                                    <span class="hidden-xs">
                                        <?php echo $this->session->userdata('user_logged_name'); ?>
                                    </span>
                                </a>
                            </li>
                            <?php } ?>
                            <li>                        
                                <?php
                                    if (isset($user_logged_in) && !empty($user_logged_in)) {
                                ?>
                                <a href="#" data-toggle="modal" data-target="#modal_user_logout"><span class="glyphicon glyphicon-log-out"></span></a>
                                <?php
                                }
                                    if (!isset($user_logged_in) && empty($user_logged_in)) {
                                ?>
                                    <a href="#" data-toggle="modal" data-target="#modal_userloggin"><span class="glyphicon glyphicon-log-in"></span></a>
                                    <!--<a id="signup_link" class="btn btn-default btn-flat btn-xs profile_link_style" data-toggle="modal" data-target="#modal_signup">SIGN UP</a>-->
                                <?php } ?>
                            </li>
                            <?php
                            if (!isset($user_logged_in) && empty($user_logged_in)) {
                                ?>
                                <li>
                                    <a id="signup_link" href="#" data-toggle="modal" data-target="#modal_signup"><span class="glyphicon glyphicon-user"></span></a>
                                </li>
                        <?php } ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>
        </div>        
    </div>
</div>
