<!-- USER LOGGED IN MODAL ----->
<div class="modal" id="advance_search_modal">
    <div class="modal-dialog">
        <form action="" id="advance_search_form" method="post">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Advance Search</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible" id="op_alert_sec" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <span id="op_message"></span>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Artist:</label>
                        <select class="form-control" id="artist_id" name="artist_id">
                            <option value="">Select</option>
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
                    </div>                                      
                    <div class="form-group">
                        <label for="sel1">Type:</label>
                        <select class="form-control" id="type" name="type" onchange="getTypeWiswMedia(this.value);">
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
                    </div>                                      
                    <div class="form-group">
                        <label for="sel1">Media:</label>
                        <select class="form-control" id="media_selector" name="media">
                            <option value="">Select</option>
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
                    </div>                                      
<!--                    <div class="form-group">
                        <label for="sel1">Size:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Start" id="size_start" name="size_start"/>
                            <span class="input-group-addon">-</span>
                            <input type="text" class="form-control" placeholder="End" id="size_end" name="size_end"/>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label for="sel1">Price:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Start" name="price_start"/>
                            <span class="input-group-addon">-</span>
                            <input type="text" class="form-control" placeholder="End" name="price_end"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sel1">Year:</label>
                        <div class="input-group">
                            <select class="form-control" id="year_start" name="year_start">
                                <option value="">Start Date</option>
                                <?php
                                    $sy =    date('Y');
                                    for($sy; $sy > '1970'; $sy--){ ?>
                                <option value="<?php echo $sy ?>"><?php echo $sy ?></option>
                                <?php  }
                                ?>
                            </select>
                            <span class="input-group-addon">-</span>
                            <select class="form-control" id="year_end" name="year_end">
                                <option value="">Start End</option>
                                <?php
                                    $sy =    date('Y');
                                    for($sy; $sy > '1970'; $sy--){ ?>
                                <option value="<?php echo $sy ?>"><?php echo $sy ?></option>
                                <?php  }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-primary">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="artwork_advance_search_process();">Search</button>

                </div>
            </div>
            <!-- /.modal-content -->
        </form>
        <!-- /Form-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->