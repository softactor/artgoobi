<?php echo $header; ?>
<?php echo $menu;
    $check_param['user_type'] = $_SESSION['logged_type'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <span id="op_message"></span>
          <div class="box">
            <div class="box-header bg-success">
              <h3 class="box-title">Artwork List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/dashboard/artist_artwork_update/'.$artworks_data->id); ?>">
            <div class="row">
                <div class="col-sm-8">
                    <h2>Upload Option</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <img style="text-align: center" src="<?php echo base_url('uploads/artwork/'.$artworks_data->image_original); ?>" width="300" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="arits_name">Owner Type:</label>
                        <div class="col-sm-8">          
                            <label class="radio-inline">
                                <input type="radio" name="artwork_owner" value="1" <?php if(isset($artworks_data->artwork_owner) && $artworks_data->artwork_owner==1){ ?> checked <?php } ?> onchange="toggle_artist_name_change(1);" />SELF
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="artwork_owner" value="2" <?php if(isset($artworks_data->artwork_owner) && $artworks_data->artwork_owner==2){ ?> checked <?php } ?> onchange="toggle_artist_name_change(2);" />OTHERS
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="arits_name">Artist Name:</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="hidden_artist_id" name="hidden_artist_id" value="<?php echo $artworks_data->artist_id; ?>">
                            <input type="text" class="form-control" id="arits_name" placeholder="arits name" name="arits_name" value="<?php echo $artworks_data->artist_name; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="sel1">Type Of Art:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="type_of_art_id" name="type_of_art_id" onchange="get_subtype_artwork();">
                                <option value="">Select</option>
                                <?php 
                                    $art_type = get_all_data_by_table('artwork_type');
                                    if(isset($art_type) && !empty($art_type)){
                                        foreach($art_type as $type){
                                ?>
                                <option value="<?php echo $type->id; ?>" <?php if(isset($artworks_data->type_of_art_id) && $artworks_data->type_of_art_id==$type->id){ ?> selected <?php } ?>><?php echo $type->name; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="sel1">Sub Type:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="type_of_child_id" name="type_of_child_id">
                                <option value="">Please Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="title">Title:</label>
                        <div class="col-sm-8">          
                            <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?php echo $artworks_data->title; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="media">Media:</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="formate" name="formate">
                                <option value="">Select</option>
                                <?php 
                                    $art_type = get_all_data_by_table('artwork_media');
                                    if(isset($art_type) && !empty($art_type)){
                                        foreach($art_type as $type){
                                ?>
                                <option value="<?php echo $type->id; ?>" <?php if(isset($artworks_data->formate) && $artworks_data->formate==$type->id){ ?> selected <?php } ?>><?php echo $type->name; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>                    
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="unit">Unit:</label>
                        <div class="col-sm-8">          
                            <label class="radio-inline">
                                <input type="radio" name="unit_type" value="2" <?php if(isset($artworks_data->unit_type) && $artworks_data->unit_type==1){ ?> checked <?php } ?> />Pixel
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="unit_type" value="1" <?php if(isset($artworks_data->unit_type) && $artworks_data->unit_type==2){ ?> checked <?php } ?> />Inch
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="unit">Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" name='width' placeholder="width" value="<?php echo $artworks_data->width; ?>" />
                            <span class="input-group-btn" style="width:0px;"></span>
                            <input type="text" class="form-control input-sm" name='height' placeholder="height" value="<?php echo $artworks_data->height; ?>"  />
                            <span class="input-group-btn" style="width:0px;"></span>
                            <input type="text" class="form-control input-sm" name='depth' placeholder="depth" value="<?php echo $artworks_data->depth; ?>"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="price">Year:</label>
                        <div class="col-sm-8">          
                            <input type="date" class="form-control" id="year" placeholder="year" name="year" value="<?php echo $artworks_data->year; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="price">Not For Sale:</label>
                        <div class="col-sm-8">          
                            <div class="checkbox">
                                <label><input type="checkbox" name='not_for_sale' id="not_for_sale" value="1" onchange="togglePriceShowhide();">Not For Sale</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="price">Price:</label>
                        <div class="col-sm-8">          
                            <input type="text" class="form-control" id="price" placeholder="price" value="<?php echo $artworks_data->price; ?>" name="price" onkeyup="calculateActualPrice();">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="price">Actual Price:</label>
                        <div class="col-sm-8">          
                            <input type="text" class="form-control" id="actual_price" placeholder="Actual price" value="<?php echo $artworks_data->price+$artworks_data->price_with_vat+$artworks_data->price_with_ser; ?>" name="actual_price">
                            <span>(With 12% Service Charge & 15% Vat)</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="status">Owner Type:</label>
                        <div class="col-sm-8">          
                            <label class="radio-inline">
                                <input type="radio" name="status" value="0" <?php if(isset($artworks_data->status) && $artworks_data->status==0){ ?> checked <?php } ?>/>Pending
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="1" <?php if(isset($artworks_data->status) && $artworks_data->status==1){ ?> checked <?php } ?>/>Approved
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="2" <?php if(isset($artworks_data->status) && $artworks_data->status==2){ ?> checked <?php } ?> />Withheld
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="status" value="3" <?php if(isset($artworks_data->status) && $artworks_data->status==3){ ?> checked <?php } ?>/>Deny
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="comment">Remarks:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="5" name="remarks" id="comment"></textarea>
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h4>More Options</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <select class="form-control" id="appearence" name="appearence">
                                        <option value="">Appearence</option>
                                        <?php
                                        $art_type = get_all_data_by_table('artwork_appearence');
                                        if (isset($art_type) && !empty($art_type)) {
                                            foreach ($art_type as $type) {
                                                ?>
                                                <option value="<?php echo $type->id; ?>" <?php if(isset($artworks_data->formate) && $artworks_data->formate==$type->id){ ?> selected <?php } ?>><?php echo $type->name; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">          
                                    <select class="form-control" id="frame" name="frame">
                                        <option value="">Frame</option>
                                        <?php
                                        $art_type = get_all_data_by_table('artwork_frame');
                                        if (isset($art_type) && !empty($art_type)) {
                                            foreach ($art_type as $type) {
                                                ?>
                                                <option value="<?php echo $type->id; ?>" <?php if(isset($artworks_data->formate) && $artworks_data->formate==$type->id){ ?> selected <?php } ?>><?php echo $type->name; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <select class="form-control" id="genre" name="genre">
                                        <option value="">Genre</option>
                                        <?php
                                        $art_type = get_all_data_by_table('artwork_genre');
                                        if (isset($art_type) && !empty($art_type)) {
                                            foreach ($art_type as $type) {
                                                ?>
                                                <option value="<?php echo $type->id; ?>" <?php if(isset($artworks_data->formate) && $artworks_data->formate==$type->id){ ?> selected <?php } ?>><?php echo $type->name; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">          
                                    <select class="form-control" id="color_op" name="color">
                                        <option value="">Color</option>
                                        <?php
                                        $art_type = get_all_data_by_table('artwork_basic_color');
                                        if (isset($art_type) && !empty($art_type)) {
                                            foreach ($art_type as $type) {
                                                ?>
                                                <option value="<?php echo $type->id; ?>" <?php if(isset($artworks_data->formate) && $artworks_data->formate==$type->id){ ?> selected <?php } ?>><?php echo $type->name; ?></option>
                                            <?php }
                                        } ?>
                                    </select>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php echo $footer; ?>