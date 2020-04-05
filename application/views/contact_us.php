<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12" id="parent">
        <div class="row">
            <div id="faq" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
                <div class="jumbotron text-center">
                    <div class="page-header">
                        <div class="heading_featured">
                            <h3>Contact</h3>
                        </div>      
                    </div>
                </div>                    
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12 col-xl-6">
                <iframe width="100%" height="320px;" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJaY32Qm3KWTkRuOnKfoIVZws&key=AIzaSyAf64FepFyUGZd3WFWhZzisswVx2K37RFY" allowfullscreen></iframe>
            </div>

            <div class="col-md-6 col-sm-12 col-lg-6 col-xs-12 col-xl-6">
                <form id="artgoogi_contact_form">

                    <div class="form-group">
                        <input type="text" class="form-control" id="feedback_name" name="name" placeholder="Name" autofocus="">
                    </div>


                    <div class="form-group form_left">
                        <input type="email" class="form-control" id="feedback_email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="feedback_phone" name="mobile" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" placeholder="Mobile No.">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control textarea-contact" rows="5" id="feedback_comment" name="comment" placeholder="Type Your Message/Feedback here..."></textarea>
                        <br>
                    <button type="button" class="btn btn-default btn-send" onclick="sendArtgoobiContactFeedback();"> <span class="glyphicon glyphicon-send"></span> Send </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>