<div class="row">
    <div class="col-md-12">
        <footer class="footer-wrapper">
            <div class="copyright-wrapper">
                <div class="copyright-container container">
                    <div class="copyright-left">
                        <div class="menu-footer-menu-container">
                            <ul id="menu-footer-menu" class="menu">
                                <li id="menu-item-4187" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-4187"><a href="<?php echo base_url() ?>">Home</a></li>
                                <li id="menu-item-4188" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4188"><a href="<?php echo base_url('welcome/about_us'); ?>">About</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('welcome/exhibition_list'); ?>">Exhibition</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('welcome/event_list'); ?>">Event</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('welcome/event_list'); ?>">Gallery</a></li>
                                <li id="menu-item-4201" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4201"><a href="<?php echo base_url('welcome/contact_us'); ?>">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="copyright-right">
                        Copyright <?php echo date("Y"); ?> All Right Reserved
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </footer>
    </div>
</div>
</div>
<!-- Bootstrap core JavaScript
<!-- Footer Font Page
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>lightbox/js/lightbox-plus-jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>js/signup.js"></script>
<script src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>js/offcanvas.js"></script>
<script src="<?php echo base_url(); ?>js/frontside.js"></script>
<script src="<?php echo base_url(); ?>tinymce/tiny_mce.js"></script>
<script src="<?php echo base_url(); ?>tinymce/config.js"></script>
<!--<script src="<?php echo base_url(); ?>js/jquery.tickerNews.min.js"></script>-->
<script src="<?php echo base_url(); ?>js/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>js/lazyload.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery.da-share.js"></script>
<script>

            (function ($) {
                $.fn.menumaker = function (options) {
                    var cssmenu = $(this), settings = $.extend({
                        format: "dropdown",
                        sticky: false
                    }, options);
                    return this.each(function () {
                        $(this).find(".button").on('click', function () {
                            $(this).toggleClass('menu-opened');
                            var mainmenu = $(this).next('ul');
                            if (mainmenu.hasClass('open')) {
                                mainmenu.slideToggle().removeClass('open');
                            } else {
                                mainmenu.slideToggle().addClass('open');
                                if (settings.format === "dropdown") {
                                    mainmenu.find('ul').show();
                                }
                            }
                        });
                        cssmenu.find('li ul').parent().addClass('has-sub');
                        multiTg = function () {
                            cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
                            cssmenu.find('.submenu-button').on('click', function () {
                                $(this).toggleClass('submenu-opened');
                                if ($(this).siblings('ul').hasClass('open')) {
                                    $(this).siblings('ul').removeClass('open').slideToggle();
                                } else {
                                    $(this).siblings('ul').addClass('open').slideToggle();
                                }
                            });
                        };
                        if (settings.format === 'multitoggle')
                            multiTg();
                        else
                            cssmenu.addClass('dropdown');
                        if (settings.sticky === true)
                            cssmenu.css('position', 'fixed');
                        resizeFix = function () {
                            var mediasize = 1000;
                            if ($(window).width() > mediasize) {
                                cssmenu.find('ul').show();
                            }
                            if ($(window).width() <= mediasize) {
                                cssmenu.find('ul').hide().removeClass('open');
                            }
                        };
                        resizeFix();
                        return $(window).on('resize', resizeFix);
                    });
                };
            })(jQuery);

            (function ($) {
                $(document).ready(function () {
                    $("#cssmenu").menumaker({
                        format: "multitoggle"
                    });
                });
            })(jQuery);


        </script>
<script>
    jQuery(document).ready(function ($) {
        $("img.lazy").lazyload();
        $('#myCarousel').carousel({
            interval: 5000
        });
        jQuery('#date_of_birth').datepicker();
//Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
            var id_selector = $(this).attr("id");
            try {
                var id = /-(\d+)$/.exec(id_selector)[1];
                console.log(id_selector, id);
                jQuery('#myCarousel').carousel(parseInt(id));
            } catch (e) {
                console.log('Regex failed!', e);
            }
        });
// When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
            var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-' + id).html());
        });
    });
</script>
<script>
    function updateSize() {
        var width = parseInt($('#width').value, 10);
        var height = parseInt($('#height').value, 10);

        $('#slider-thumbs').style.width = width + 'px';
        $('#slider-thumbs').style.height = height + 'px';

        ps.update();
    }
    
    function viewAboutUsDetails(page_view_id){
        switch(page_view_id){
            case 'service_identity_01':
                $('#artgoobi_about_us').hide();
                $('#service_identity_02').hide();
                $('#service_identity_03').hide();
                $('#service_identity_01').show('slow');
                break;
            case 'service_identity_02':
                $('#artgoobi_about_us').hide();
                $('#service_identity_01').hide();
                $('#service_identity_03').hide();
                $('#service_identity_02').show('slow');
                break;
            case 'service_identity_03':
                $('#artgoobi_about_us').hide();
                $('#service_identity_01').hide();
                $('#service_identity_02').hide();
                $('#service_identity_03').show('slow');
                break;
        }
    }
    function viewAboutUsDetailsHome(){
        $('.individual_service_item').hide('slow');
        $('#artgoobi_about_us').show('slow');
    }
</script>
<script src="<?php echo base_url(); ?>js/capture_gallery/jquery-migrate-3.0.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/jquery.easing.1.3.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/jquery.waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/jquery.stellar.min.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/aos.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/jquery.animateNumber.min.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/scrollax.min.js"></script>
<script src="<?php echo base_url(); ?>js/capture_gallery/main.js"></script>
<script src="<?php echo base_url(); ?>js/artwork_search.js"></script>
<script src="<?php echo base_url(); ?>js/jssor.slider.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/advertise_slider.js"></script>
<script type="text/javascript">jssor_1_slider_init();</script>
</body>
</html>
<?php
$data = [];
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
if (isset($user_logged_in) && !empty($user_logged_in)) {
    if (isset($artwork_data->artist_id) && $user_logged_in == $artwork_data->artist_id) {
        $profiler = true;
    }
}
$data['profiler'] = $profiler;
if (isset($artwork_data) && !empty($artwork_data)) {
    $data['artwork_data'] = $artwork_data;
}
$this->view('modal/user_login');
$this->view('modal/user_logout');
$this->view('modal/user_signin');
$this->load->view('modal/user_forget_password');
$this->view('modal/profile_occupation', $data);
$this->view('modal/profile_education', $data);
$this->view('modal/profile_experience', $data);
?>
<?php 
    $this->load->view('modal/user_signup_update');
    $this->view('modal/advance_search');
?>