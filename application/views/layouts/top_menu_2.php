<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!--<a class="navbar-brand" href="#">Brand</a>-->
                    <a class="navbar-brand navbar_brand_custom" href="<?php echo base_url() ?>">
                        <img alt="Brand" src="<?php echo base_url() ?>logo.png">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div id='cssmenu'>
                    <ul>
                        <li class="<?php if($active_menu=='home'){ echo 'active'; } ?>"><a href="<?php echo base_url() ?>">Home <span class="sr-only">(current)</span></a></li>
                        <li class="<?php if($active_menu=='about'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/about_us'); ?>">About</a></li>
                        <li class="<?php if($active_menu=='exhibition'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/exhibition_list'); ?>">Exhibition</a></li>
                        <li class="<?php if($active_menu=='event'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/event_list'); ?>">Event</a></li>
                        <li class="<?php if($active_menu=='gallery'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('welcome/gallery_list'); ?>">
                                Gallery
                            </a>
                        </li>
                        <li class="<?php if($active_menu=='terms'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/terms_and_conditions'); ?>">Terms & Conditions</a></li>
                        <li class="<?php if($active_menu=='contact'){ echo 'active'; } ?>"><a href="<?php echo base_url('welcome/contact_us'); ?>">Contact Us</a></li>
                    </ul>            
                </div><!-- /.navbar-collapse -->        

            </nav>
        </div>        
    </div>
</div>
