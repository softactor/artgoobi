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
            Artwork Details
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Artwork Details</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <!--all flash message show view-->
                        <?php $this->load->view ('dashboard/message_view_page');  ?>
                        <!--End all flash message show view-->
                        <?php
                        $check_param['sub_menu'] = 'add';
                        if (has_main_menu_access($check_param)) {
                            ?>
                            <div class="pull-right">
                                <?php 
                                    $redirectLink   = base_url().'admin/dashboard/profile_artwork_list/'.$artwork_data->artist_id;
                                ?>
                                <a href="<?php echo $redirectLink; ?>" class="btn btn-flat btn-success small" title="Event List">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- form start -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('welcome/artist_artwork_modify_process'); ?>">
                            <div class="row">
                                <div class="col col-md-10">
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="arits_name">Owner Type:</label>
                                                <div class="col col-md-8">          
                                                    <label class="radio-inline">
                                                        <input type="radio" name="artwork_owner" value="1" checked onchange="toggle_artist_name_change(1);" />SELF
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="artwork_owner" value="2" onchange="toggle_artist_name_change(2);" />OTHERS
                                                    </label>
                                                    <span class='alert-danger'><?php echo form_error('artwork_owner'); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="arits_name">Artist Name:</label>
                                                <div class="col-sm-6">
                                                    <input type="hidden" id="hidden_artist_id" name="hidden_artist_id" value="<?php echo $users_info->id; ?>">
                                                    <input type="hidden" id="hidden_artist_name" value="<?php echo $users_info->name; ?>">
                                                    <input type="text" class="form-control" id="arits_name" placeholder="arits name" name="arits_name" value="<?php echo $users_info->name; ?>">
                                                    <span class='alert-danger'><?php echo form_error('arits_name'); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="sel1">Type Of Art:</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" id="type_of_art_id" name="type_of_art_id" onchange="get_subtype_artwork(this.value);">
                                                        <option value="">Select</option>
                                                        <?php
                                                        $orderBy = [
                                                            'field' => "name",
                                                            'order' => "asc",
                                                        ];
                                                        $art_type = get_all_data_by_table('artwork_type', $orderBy);
                                                        if (isset($art_type) && !empty($art_type)) {
                                                            foreach ($art_type as $type) {
                                                                ?>
                                                                <option value="<?php echo $type->id; ?>" <?php if (isset($artwork_data->type_of_art_id) && $artwork_data->type_of_art_id == $type->id) {
                                                            echo 'selected';
                                                        } ?>><?php echo $type->name; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class='alert-danger'><?php echo form_error('type_of_art_id'); ?></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-10 col-xs-10 col-md-10 col-lg-10 col-xl-10">
                                                    <img class="img-responsive" src="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork_data->image_original; ?>" alt="<?php echo $artwork_data->title; ?>" title="<?php echo $artwork_data->title; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-md-6">
                                            <div id="dyna_load_form_section">
<?php echo $art_form; ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="title">Title:<span class="required"></span></label>
                                                <div class="col-sm-8">          
                                                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?php echo set_value('title', $artwork_data->title); ?>">
                                                    <span class='alert-danger'><?php echo form_error('title'); ?></span>
                                                </div>
                                            </div>                                                
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="price">Price:<span class="required"></span></label>
                                                <div class="col-sm-8">          
                                                    <input type="text" class="form-control" id="price" placeholder="price" name="price" value="<?php echo set_value('price', $artwork_data->price); ?>" onkeyup="calculateActualPrice();" autocomplete="off" <?php if ($artwork_data->not_for_sale) {
    echo 'disabled';
} ?>>
                                                    <span class='alert-danger'><?php echo form_error('price'); ?></span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="price"></label>
                                                <div class="col-sm-8">          
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name='not_for_sale' id="not_for_sale" value="1" onchange="togglePriceShowhide();"<?php if ($artwork_data->not_for_sale) {
    echo 'checked';
} ?>>Not For Sale</label>
                                                    </div>
                                                </div>
                                            </div>
<?php
if (isset($artwork_data->not_for_sale) && !empty($artwork_data->not_for_sale)) {
    ?>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="title">Collector:</label>
                                                    <div class="col-sm-8">          
                                                        <input type="text" class="form-control" id="title" placeholder="Collector Name" name="collector_name" value="<?php echo set_value('collector_name', $artwork_data->collector_name); ?>">
                                                        <span class='alert-danger'><?php echo form_error('collector_name'); ?></span>
                                                    </div>
                                                </div>
                                                    <?php } ?>
                                            <div class="form-group">
                                                <label class="control-label col-sm-4" for="price">You will get:</label>
                                                <div class="col-sm-8">
<?php
$actual_get_price = $artwork_data->price_with_vat;
?>
                                                    <input type="text" class="form-control" id="actual_price" placeholder="Actual price" name="actual_price" value="<?php echo $actual_get_price; ?>"<?php if ($artwork_data->not_for_sale) {
    echo 'disabled';
} ?>>
                                                    <span>(after service Charge & tax)</span>
                                                </div>
                                            </div>
                                            <div class="form-group pull-right">        
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="hidden" name="image_original" value="<?php echo $artwork_data->image_original; ?>" />
                                                    <input type="hidden" name="artwork_status" value="<?php echo $artwork_data->status; ?>" />
                                                    <input type="hidden" name="artwork_edit_id" value="<?php echo $artwork_data->id; ?>" />
                                                    <input type="hidden" name="hidden_artist_id" value="<?php echo $artwork_data->artist_id; ?>" />
                                                    <!--<button type="submit" class="btn btn-sm btn-primary">Update</button>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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