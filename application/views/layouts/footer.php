</div>
<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
    <?php
        if(isset($gallery_information) && $gallery_information  ==  1){
            $this->view('partial/gallery_information');
        }
        $this->view('advertisement');
    ?>
</div>
</div>
<div class="row">
    <div class="col-md-12">
        <footer class="footer-wrapper">
            <div class="copyright-wrapper">
                <div class="copyright-container container">
                    <div class="copyright-left">
                        <div class="menu-footer-menu-container">
                            <ul id="menu-footer-menu" class="menu">
                                <li id="menu-item-4187" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-4187"><a href="<?php echo base_url() ?>">Home</a></li>
                                <li id="menu-item-4188" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4188"><a href="<?php echo base_url('about_us'); ?>">About</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('exhibitions'); ?>">Exhibition</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('events'); ?>">Event</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('gallery'); ?>">Artgoobi Gallery</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('faq'); ?>">FAQ</a></li>
                                <li id="menu-item-4189" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4189"><a href="<?php echo base_url('terms_and_conditions'); ?>">Terms & Conditions</a></li>
                                <li id="menu-item-4201" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4201"><a href="<?php echo base_url('contact_us'); ?>">Contact Us</a></li>
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
</div> <!-- End of Container -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>js/global_url.js"></script>
<script src="<?php echo base_url(); ?>lightbox/js/lightbox-plus-jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>js/jssor.slider.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>js/offcanvas.js"></script>
<script src="<?php echo base_url(); ?>tinymce/tiny_mce.js"></script>
<script src="<?php echo base_url(); ?>tinymce/config.js"></script>
<script src="<?php echo base_url(); ?>js/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>js/signup.js"></script>
<script src="<?php echo base_url(); ?>js/artwork_search.js"></script>
<script src="<?php echo base_url(); ?>js/advertise_slider.js"></script>
<script src="<?php echo base_url(); ?>js/frontside.js"></script>
</body>
</html>
<?php
$this->view('modal/user_login');
$this->view('modal/user_logout');
$this->view('modal/user_signin');
$this->view('modal/user_forget_password');
$this->view('modal/user_signup_update');
$this->view('modal/advance_search');
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
    $this->view('modal/profile_occupation', $data);
    $this->view('modal/profile_education', $data);
    $this->view('modal/profile_experience', $data);
}
?>