<div class="box box-primary">
    <div class="box-body box-profile">
        <ul class="list-group list-group-unbordered art_gallery_search">
            <li class="list-group-item" title="Total Artwork">
                <b><span class="fa fa-picture-o"></span></b> <a class="pull-right"><?php echo getDataRowByTable('artwork_info'); ?>&nbsp;Artwork</a>
            </li>
            <li class="list-group-item">
                <select class="form-control" id="artist_id" name="artist_id">
                    <option value="">Artist Name</option>
                    <?php
                    $param['order'] =   'ASC';
                    $param['field'] =   'name';
                    $param['table'] =   'users';
                    $param['where'] =   [
                        'user_type'=> 6
                    ];
                    $artistData = get_table_data_by_param($param);   
                    if(isset($artistData) && !empty($artistData)){
                        foreach($artistData as $artists){
                    ?>
                    <option value="<?php echo $artists->id; ?>"><?php echo $artists->name; ?></option>
                    <?php }} ?>
                </select>
            </li>
            <li class="list-group-item">
                <select class="form-control" id="type" name="type" onchange="getTypeWiswMedia(this.value);">
                    <option value="">Artwork Type</option>
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
            </li>
            <li class="list-group-item">
                <select class="form-control" id="media_selector" name="media">
                    <option value="">Artwork Media</option>
                    <?php
                        $param['where'] =   [
                            'artwork_type_id'   =>  1// as it is default load so assign id manually
                        ];
                        $param['table'] =   'artwork_media';
                        $param['order'] =   'asc';
                        $param['field'] =   'name';
                        $art_type = get_table_data_by_param($param);
                        if (isset($art_type) && !empty($art_type)) {
                            foreach ($art_type as $type) {
                                ?>
                                <option value="<?php echo $type->id; ?>" <?php if(isset($_POST['formate']) && $_POST['formate']==$type->id){ echo 'selected'; } ?>><?php echo $type->name; ?></option>
                                <?php
                            }
                        }
                        ?>
                </select>
            </li>
        </ul>
    </div>
    <!-- /.box-body -->
</div>