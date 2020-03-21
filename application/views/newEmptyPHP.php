<?php echo $header; ?>
<!-- Content Content Area Start -->
<div class="col-md-10">    
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/welcome/event_list">Event List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Event Details</li>
            </ol>
        </nav>
        <div class="col-md-12">
            <div class="exhibition_details_style">
                <h1><?php echo $event->title; ?></h1>
                <div class="exhibition_date"><?php echo date("F d, Y",strtotime($event->start_date))."-".date("F d, Y",strtotime($event->end_date)); ?></div>
                <div class="exhibition_main_image">
                    <img class="img-responsive" src="<?php echo base_url("images/exhibition/".$event->fetured_image_path) ?>" alt="<?php echo $event->title; ?>" title="<?php echo $event->title; ?>" />
                </div>
                <p class="exhibition_text"><?php echo $event->descriptions; ?></p>
                <div class="other_exhibitions">
                    <?php
                        $data['where_not_in_id']    =   $event->id;
                        $this->load->view('related_exhibitions',$data);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>