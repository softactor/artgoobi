<form action="<?php echo base_url() ?>settings/process_access_role" method="post">
    <div class="row">
        <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
        <?php if(isset($role_id)){ ?>
            <input type="hidden" name="role_id" value="<?php echo $role_id; ?>">
        <?php } ?>
        <?php
        $panel = get_panel();
        foreach ($panel as $p) {
            ?>                                
            <div class="col-md-4">
                <h4 class="text-bold">
                    <i class="<?php echo $p->icon_class; ?>"></i>
                    <?php echo $p->title; ?>
                </h4>
                <div class="col-md-12 alert alert-info" style="padding: 0 7%;">
                    <?php
                    $op_details = json_decode($p->op_details);
                    foreach ($op_details as $detls_key => $detls_val) {
                        ?>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input <?php if(isset($role_data[$p->id]) && in_array($detls_val, $role_data[$p->id]['access'])){ echo 'checked'; } ?> type="checkbox" name="access_controll[<?php echo $p->id; ?>][]" value="<?php echo $detls_val; ?>">
                                    <?php echo $detls_val; ?>
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>                            
        <?php } ?>            
    </div> <!-- End of Row -->
    <div class="row">
        <div class="col-md-12 text-right">
            <input type="submit" class="btn btn-success" name="sumit" value="Save Changes">
        </div>
    </div>
</form>