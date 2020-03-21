<?php echo $header; ?>
<style>

    /* Conatct start */

    .header-title
    {
        text-align: center;
        color:#6c8cc7;
    }

    #tip 
    {
        display:none;  
    }

    .fadeIn
    {
        animation-duration: 3s;
    }

    .form-control
    {
        border-radius:0px;
        border:1px solid #EDEDED;
    }

    .form-control:focus
    {
        border:1px solid #00bfff;
    }

    .textarea-contact
    {
        resize:none; 
    }

    .btn-send
    {
        border-radius: 0px;
        border:1px solid #00bfff;
        background:#6c8cc7;
        color:#fff; 
    }

    .btn-send:hover
    {
        border:1px solid #00bfff;
        background:#fff;
        color:#00bfff;
        transition:background 0.5s;   
    }

    .second-portion
    {
        margin-top:50px; 
        width: 100%;
    }

    @import url('https://fonts.googleapis.com/css?family=Tajawal');
    @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    .box > .icon { text-align: center; position: relative; }
    .box > .icon > .image { position: relative; z-index: 2; margin: auto; width: 88px; height: 88px; border: 8px solid white; line-height: 88px; border-radius: 50%; background: #6c8cc7; vertical-align: middle; }
    .box > .icon:hover > .image { background: #333; }
    .box > .icon > .image > i { font-size: 36px !important; color: #fff !important; }
    .box > .icon:hover > .image > i { color: white !important; }
    .box > .icon > .info { margin-top: -24px; background: rgba(0, 0, 0, 0.04); border: 1px solid #e0e0e0; padding: 15px 0 10px 0; min-height:163px;}
    .box > .icon:hover > .info { background: rgba(0, 0, 0, 0.04); border-color: #e0e0e0; color: white; }
    .box > .icon > .info > h3.title { font-family: "Robot",sans-serif !important; font-size: 16px; color: #222; font-weight: 700; }
    .box > .icon > .info > p { font-family: "Robot",sans-serif !important; font-size: 13px; color: #666; line-height: 1.5em; margin: 20px;}
    .box > .icon:hover > .info > h3.title, .box > .icon:hover > .info > p, .box > .icon:hover > .info > .more > a { color: #222; }
    .box > .icon > .info > .more a { font-family: "Robot",sans-serif !important; font-size: 12px; color: #222; line-height: 12px; text-transform: uppercase; text-decoration: none; }
    .box > .icon:hover > .info > .more > a { color: #fff; padding: 6px 8px; background-color: #63B76C; }
    .box .space { height: 30px; }

    @media only screen and (max-width: 768px)
    {
        .contact-form
        {
            margin-top:25px; 
        }

        .btn-send
        {
            width: 100%;
            padding:10px; 
        }

        .second-portion
        {
            margin-top:25px; 
        }
    }
    /* Conatct end */

</style>
<div class="container">    
    <div class="row">
        <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
            <div class="row">
                <div id="faq" class="col-md-12">
                    <div class="jumbotron text-center">
                        <h1 class="service_title">Frequently asking questions</h1>
                    </div>
                    <div class="panel-group" id="accordion">
                        <?php
                            if(isset($faq_data['data']) && !empty($faq_data['data'])){                                
                                foreach($faq_data['data'] as $faq_key=>$faq){
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
                    <?php }} ?>
                    </div>
                </div>
            </div>
            <!--<div class="container animated fadeIn">-->
            <div class="row">
                <h1 class="header-title"> Contact </h1>
                <hr>
                <div class="col-sm-12" id="parent">
                    <div class="col-sm-6">
                        <iframe width="100%" height="320px;" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJaY32Qm3KWTkRuOnKfoIVZws&key=AIzaSyAf64FepFyUGZd3WFWhZzisswVx2K37RFY" allowfullscreen></iframe>
                    </div>

                    <div class="col-sm-6">
                        <form action="form.php" class="contact-form" method="post">

                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="nm" placeholder="Name" required="" autofocus="">
                            </div>


                            <div class="form-group form_left">
                                <input type="email" class="form-control" id="email" name="em" placeholder="Email" required="">
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" id="phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" placeholder="Mobile No." required="">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control textarea-contact" rows="5" id="comment" name="FB" placeholder="Type Your Message/Feedback here..." required=""></textarea>
                                <br>
                                <button class="btn btn-default btn-send"> <span class="glyphicon glyphicon-send"></span> Send </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <?php $this->view('layouts/advertisement'); ?>
        </div>
    </div>    
</div>
<?php echo $footer; ?>