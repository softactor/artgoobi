<?php
echo $header;
$profiler = false;
$user_logged_in = $this->session->userdata('user_logged_id');
if (isset($user_logged_in) && !empty($user_logged_in) && $user_logged_in == $users_data->id) {
    $profiler = true;
}
?>
<div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <!-- here profile left pannel wil go -->
<?php echo $profile_left_panel; ?>
            <!-- Here artwork form block start -->
            <div class="col-lg-9 col-xl-9 col-md-9 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                        <div class="jumbotron text-center">
                            <h1 class="service_title">
                                <?php echo "Artwork Update" ?>
                            </h1>
                        </div>                    
                    </div>
                </div>
                <?php
                $sm = $this->session->flashdata('success_message');
                $em = $this->session->flashdata('error_message');
                if (isset($sm) && !empty($sm)) {
                    ?>
                    <div class="alert alert-success">
                    <?php echo $sm; ?>
                    </div>
                <?php } ?>
                <?php
                if (isset($em) && !empty($em)) {
                    ?>
                    <div class="alert alert-danger">
                    <?php echo $em; ?>
                    </div>
<?php } ?>
                <div class="box box-primary">
                    <div class="box-header with-border"> 
                        <div class="pull-left">
                            <h3>Artwork upload</h3>
                            <span class="notes_style">All (*) fields are required</span>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo base_url() ?>welcome/user_profile" class="btn btn-xs btn-success" title="Create gallery">
                                <?php echo $users_info->name." Profile" ?>
                            </a>
                        </div>
                    <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('welcome/artist_image_upload_process'); ?>">
                        <div class="box-body">
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
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
                                                                    <option value="<?php echo $type->id; ?>" <?php if (isset($art_form_id) && $art_form_id == $type->id) {
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
                                            </div>
                                            <div class="col-lg-6 col-xl-6 col-md-6 col-sm-12 col-xs-12">
                                                <div id="dyna_load_form_section">
    <?php echo $art_form; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="title">Title:<span class="required"></span></label>
                                                    <div class="col-sm-8">          
                                                        <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?php echo set_value('title'); ?>">
                                                        <span class='alert-danger'><?php echo form_error('title'); ?></span>
                                                    </div>
                                                </div>                                                
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="price">Price:<span class="required"></span></label>
                                                    <div class="col-sm-8">          
                                                        <input type="text" class="form-control" id="price" placeholder="price" name="price" value="<?php echo set_value('price'); ?>" onkeyup="calculateActualPrice();" autocomplete="off">
                                                        <span id="errmsg" class='alert-danger'><?php echo form_error('price'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="price"></label>
                                                    <div class="col-sm-8">          
                                                        <div class="checkbox">
                                                            <label><input type="checkbox" name='not_for_sale' id="not_for_sale" value="1" onchange="togglePriceShowhide();">Not For Sale</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="collector_name_form">
                                                    <label class="control-label col-sm-4" for="title">Collector:</label>
                                                    <div class="col-sm-8">          
                                                        <input type="text" class="form-control" id="title" placeholder="Collector Name" name="collector_name" value="<?php echo set_value('collector_name'); ?>">
                                                        <span class='alert-danger'><?php echo form_error('collector_name'); ?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="price">You will get:</label>
                                                    <div class="col-sm-8">          
                                                        <input type="text" class="form-control" id="actual_price" placeholder="Actual price" name="actual_price" readonly>
                                                        <input type="hidden" class="form-control" id="actual_price_hidden" name="actual_price_hidden">
                                                        <span>(after service Charge & tax)</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="price">Image:<span class="required"></span></label>
                                                    <div class="col-sm-8">          
                                                        <input type="file" id="image" name='userfile' accept="image/*" onChange="artworkFilevalidate(this.value)">
                                                        <span class='alert-danger'><?php echo form_error('userfile'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Content Area End -->
<?php echo $footer; ?>        
