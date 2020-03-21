<?php echo $header; ?>
<?php echo $menu;
    $check_param['user_type'] = $_SESSION['logged_type'];
    $check_param['menu_id'] = 1;
    $check_param['meny_type'] = 2;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Artwork Media
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Artwork media</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!--all flash message show view-->
                        <?php $this->load->view ('dashboard/message_view_page');  ?>
                        <!--End all flash message show view-->
                        <?php
                        $check_param['sub_menu'] = 'add';
                        if (has_main_menu_access($check_param)) {
                            ?>
                            <div class="box-tools pull-right">
                                <a href="<?php echo base_url() ?>admin/ArtgoobiSetup/index" class="btn btn-flat btn-success small" title="Create List">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <!-- form start -->
                        <form id="exhibition" name="exhibition" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/ArtgoobiSetup/store_artwork_media') ?>">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name<?php echo form_error('type_of_art_id', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <select class="form-control" id="type_of_art_id" name="type_of_art_id" onchange="get_subtype_artwork(this.value);">
                                        <option value="">Select</option>
                                        <?php
                                        $art_type = get_all_data_by_table('artwork_type');
                                        if (isset($art_type) && !empty($art_type)) {
                                            foreach ($art_type as $type) {
                                                ?>
                                                <option value="<?php echo $type->id; ?>" <?php if(isset($art_form_id) && $art_form_id == $type->id){ echo 'selected'; } ?>><?php echo $type->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name<?php echo form_error('name', '<span class="form_fields_error">', '</span>'); ?></label>
                                    <input type="text" class="form-control" id="title" name="name" placeholder="Enter name" value="<?php echo set_value('name'); ?>">
                                </div>                                
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" name="submit" value="Create" />
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                    <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>