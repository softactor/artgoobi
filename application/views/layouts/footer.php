</div>
    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12">
        <?php $this->view('advertisement'); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <ul class="list-inline">
            <li><a href="<?php echo base_url() ?>">About us</a></li>
            <li><a href="<?php echo base_url() ?>">Contact</a></li>
            <li><a href="<?php echo base_url() ?>">Terms and Policy</a></li>
            <li><a href="<?php echo base_url() ?>">Settings</a></li>
            <li><a href="<?php echo base_url() ?>">Help</a></li>
        </ul>
    </div>
</div>
</div> <!-- End of Container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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