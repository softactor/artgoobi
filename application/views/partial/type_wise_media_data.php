<option value="">Select</option>
<?php
if(isset($mediaData) && !empty($mediaData)){
    foreach($mediaData as $media){ ?>
        <option value="<?php echo $media->id; ?>"><?php echo $media->name; ?></option>
<?php }} ?>
