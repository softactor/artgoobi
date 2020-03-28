<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!--<a class="navbar-brand" href="#">Brand</a>-->
        <a class="navbar-brand" href="<?php echo base_url() ?>">
            <img class="header-image-mobile" src="<?php echo base_url() ?>logo.png" height="105"/>
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url() ?>">Home</a></li>
            <li><a href="<?php echo base_url('welcome/about_us'); ?>">About</a></li>
            <li><a href="<?php echo base_url('welcome/exhibition_list'); ?>">Exhibition</a></li>
            <li><a href="<?php echo base_url('welcome/event_list'); ?>">Event</a></li>
            <li><a href="<?php echo base_url('welcome/gallery_list'); ?>">Artgoobi Gallery</a></li>
            <li><a href="<?php echo base_url('welcome/terms_and_conditions'); ?>">Terms & Conditions</a></li>
            <li><a href="<?php echo base_url('welcome/contact_us'); ?>">Contact Us</a></li>
            <li>
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
            </li>
            
        </ul>
    </div><!-- /.navbar-collapse -->
</nav><!-- /.navbar -->
<div class="pull-right">
    <div class="TickerNews" id="example">
        <div class="ti_wrapper">
            <div class="ti_slide">
                <div class="ti_content">
                    <div class="ti_news"><a href="#">1:00 US fisherman rescued by tanker after 66 days lost at sea</a></div>
                    <div class="ti_news"><a href="#">2:00 Overseas aid must rise by £1bn in next two years, says Europe</a></div>
                    <div class="ti_news"><a href="#">3:00 Muslim population looks likely to double in size </a></div>
                    <div class="ti_news"><a href="#">4:00 Heathrow cuts passenger levy to boost domestic flights</a></div>
                    <div class="ti_news"><a href="#">5:00 Couple plotted to sell their new baby online for €5,000 </a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix" style="margin: 2% 0;"></div>
<!-- Modal -->
