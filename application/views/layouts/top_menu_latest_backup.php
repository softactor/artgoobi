<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="#">Brand</a>-->
            <a class="navbar-brand" href="<?php echo base_url() ?>">
                <img alt="Brand" src="<?php echo base_url() ?>logo.png">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="<?php if($active_menu=='home'){ echo 'active'; } ?>"><a href="<?php echo base_url() ?>">Home <span class="sr-only">(current)</span></a></li>
                <li class="<?php if($active_menu=='about'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/about_us'); ?>">About</a></li>
                <li class="<?php if($active_menu=='exhibition'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/exhibition_list'); ?>">Exhibition</a></li>
                <li class="<?php if($active_menu=='event'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/event_list'); ?>">Event</a></li>
                <li class="<?php if($active_menu=='gallery'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/gallery_list'); ?>">Artgoobi Gallery</a></li>
                <li class="<?php if($active_menu=='terms'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/terms_and_conditions'); ?>">Terms & Conditions</a></li>
                <li class="<?php if($active_menu=='contact'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/contact_us'); ?>">Contact Us</a></li>
            </ul>
            <div class="artgoobi_search_box_container">
                <div class="form-group">
                    <input type="text" class="form-control search_input_style" placeholder="Search" id="artworksearching">
                    <button type="button" class="search_button" onclick="searchArtistArtworks();"><i class="glyphicon glyphicon-search"></i></button> 
                </div>
                <?php
                    $user_logged_in = $this->session->userdata('user_logged_in_status');
                    if(isset($user_logged_in) && !empty($user_logged_in)){
                ?>
                    <a href="<?php echo base_url() ?>welcome/user_profile">
                        <img src="<?php echo base_url(); ?>images/default_avater.png" class="user-image" alt="User Image" width="25" title="<?php echo $this->session->userdata('user_logged_name'); ?>">
                         <?php echo $this->session->userdata('user_logged_name'); ?>
                    </a>
                <?php } ?>
                <div class="custom_search" onclick="openAdvanceCustomSearch();" title="advance search">Custom search</div>
            </div>             
            <ul class="nav navbar-nav navbar-right">                    
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
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>