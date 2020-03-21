<div class="ads_container">
    <div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:165px;height:297px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo base_url('images/icons/spin.svg') ?>" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:165px;height:297px;overflow:hidden;">
            <?php for($i=1;$i<=8;$i++){ ?>
            <div>
                <img data-u="image" src="<?php echo base_url('images/advertise/addv_0'.$i.'.jpg') ?>" />
            </div>
            <?php } ?>
        </div>
    </div>
</div>