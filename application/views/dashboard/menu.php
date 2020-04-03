<?php
$activeMenu                 =   (isset($menuName) && !empty($menuName) ? $menuName : '');
$activeSubMenu              =   (isset($subMenuName) && !empty($subMenuName) ? $subMenuName : '');
$check_param['user_type']   =   $_SESSION['logged_type'];
$check_param['meny_type']   =   1;// 1=Main Menu;
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="<?php echo setActiveMenuClass($activeMenu, 'dashboard') ?>">
          <a href="<?php echo base_url() ?>admin/dashboard/">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
          <?php 
            if(isset($_SESSION['logged_type']) && $_SESSION['logged_type']==4){
        ?>
          <li class="<?php echo setActiveMenuClass($activeMenu, 'settings') ?> treeview">
          <a href="#">
            <i class="fa fa-gears"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo setActiveMenuClass($activeSubMenu, 'position') ?>">
                <a href="<?php echo base_url() ?>admin/settings/position">
                    <i class="fa fa-circle-o"></i> Position
                </a>
            </li>
            <li class="<?php echo setActiveMenuClass($activeSubMenu, 'group') ?>">
                <a href="<?php echo base_url() ?>admin/settings/group">
                    <i class="fa fa-circle-o"></i> Group
                </a>
            </li>            
            <li class="<?php echo setActiveMenuClass($activeSubMenu, 'custom_group') ?>">
                <a href="<?php echo base_url() ?>admin/settings/custom_groups">
                    <i class="fa fa-circle-o"></i> Custom Group
                </a>
            </li>            
            <li class="<?php echo setActiveMenuClass($activeSubMenu, 'role_panel') ?>">
                <a href="<?php echo base_url() ?>admin/settings/role_panel">
                    <i class="fa fa-circle-o"></i><span>Role Panel</span>
                </a>
            </li>            
            <li class="<?php echo setActiveMenuClass($activeSubMenu, 'email_template') ?>">
                <a href="<?php echo base_url() ?>admin/settings/mail_template_view">
                    <i class="fa fa-circle-o"></i><span>Email Template</span>
                </a>
            </li>            
          </ul>
        </li>
        <?php } ?>
        <?php            
            $check_param['menu_id'] = 3;
            if(has_main_menu_access($check_param)){
        ?>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'users_panel') ?>">
            <a href="<?php echo base_url() ?>admin/dashboard/users_panel">
                <i class="fa fa-user"></i>
                <span>Users Panel</span>
            </a>
        </li> 
            <?php } ?>         
        <?php            
            $check_param['menu_id'] = 1;
            if(has_main_menu_access($check_param)){
        ?>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'artwork_media') ?>">
          <a  href="<?php echo base_url() ?>admin/ArtgoobiSetup/index">
            <i class="fa fa-desktop" aria-hidden="true"></i>
            <span>Artwork Media</span>
          </a>
        </li>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'profile') ?>">
          <a  href="<?php echo base_url() ?>admin/dashboard/profile_panel">
            <i class="fa fa-picture-o" aria-hidden="true"></i>
            <span>Profile</span>
          </a>
        </li>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'exhibition') ?>">
          <a  href="<?php echo base_url() ?>admin/exhibition">
            <i class="fa fa-object-group" aria-hidden="true"></i>
            <span>Exhibition</span>
          </a>
        </li>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'events') ?>">
          <a  href="<?php echo base_url() ?>admin/events">
            <i class="fa fa-object-ungroup" aria-hidden="true"></i>
            <span>Events</span>
          </a>
        </li>
        <?php } ?>
        <?php            
            $check_param['menu_id'] = 1;
            if(has_main_menu_access($check_param)){
        ?>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'pending_req') ?>">
            <a href="<?php echo base_url() ?>admin/dashboard/pending_artwork_list">
                <i class="fa fa-calendar"></i> <span>Pending Requests</span>
                <span class="pull-right-container">
                    <small class="label pull-right bg-red">
                        <?php
                        $param['where'] = [
                            'status'=>0
                        ];
                        $param['table']='artwork_info';
                        echo table_row_count_by_param($param);
                        ?>
                    </small>
                </span>
            </a>
        </li>
        <?php } ?>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'faq') ?>">
          <a  href="<?php echo base_url() ?>admin/faq">
            <i class="fa fa-graduation-cap"></i>
            <span>FAQ</span>
          </a>
        </li>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'invitation') ?>">
          <a  href="<?php echo base_url() ?>admin/invitation">
            <i class="fa fa-envelope-o"></i>
            <span>Invitation</span>
          </a>
        </li>
        <li class="<?php echo setActiveMenuClass($activeMenu, 'email_feedback') ?>">
          <a  href="<?php echo base_url() ?>admin/dashboard/contact_feedback">
            <i class="fa fa-paper-plane" aria-hidden="true"></i>
            <span>Email Feedback</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>