<?php echo $header; ?>
<div class="row">
    <div id="faq" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
        <div class="jumbotron text-center">
            <h1 class="service_title">Frequently asked questions</h1>
        </div>
        <div class="panel-group" id="accordion">
            <?php
            if (isset($faq_data['data']) && !empty($faq_data['data'])) {
                foreach ($faq_data['data'] as $faq_key => $faq) {
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                   href="#collapse-<?php echo $faq_key; ?>">
                                    <span class="faq_question_title"><?php echo $faq->title; ?></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse-<?php echo $faq_key; ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>
                                    <?php echo $faq->descriptions; ?>
                                </p>
                            </div>
                            <div class="panel-footer">
                                <div class="btn-group btn-group-xs"><span class="btn">Was this question useful?</span>
                                    <a class="btn btn-success" href="#"><i class="fa fa-thumbs-up"></i> Yes</a> 
                                    <a class="btn btn-danger" href="#"><i class="fa fa-thumbs-down"></i> No</a></div>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            ?>
        </div>
    </div>
</div>
<?php echo $footer; ?>