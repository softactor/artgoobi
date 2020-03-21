<?php echo $header; ?>
<style>
    a {
        color: #03a1d1;
        text-decoration: none!important;
    }

    /**** LAYOUT ****/
    .list-inline>li {
        padding: 0 10px 0 0;
    }
    .container-pad {
        padding: 30px 15px;
    }


    /**** MODULE ****/
    .bgc-fff {
        background-color: #fff!important;
    }
    .box-shad {
        -webkit-box-shadow: 1px 1px 0 rgba(0,0,0,.2);
        box-shadow: 1px 1px 0 rgba(0,0,0,.2);
    }
    .brdr {
        border: 1px solid #ededed;
    }

    /* Font changes */
    .fnt-smaller {
        font-size: .9em;
    }
    .fnt-lighter {
        color: #bbb;
    }

    /* Padding - Margins */
    .pad-10 {
        padding: 23px!important;
    }
    .mrg-0 {
        margin: 0!important;
    }
    .btm-mrg-10 {
        margin-bottom: 10px!important;
    }
    .btm-mrg-20 {
        margin-bottom: 20px!important;
    }

    /* Color  */
    .clr-535353 {
        color: #535353;
    }




    /**** MEDIA QUERIES ****/
    @media only screen and (max-width: 991px) {
        #property-listings .property-listing {
            padding: 5px!important;
        }
        #property-listings .property-listing a {
            margin: 0;
        }
        #property-listings .property-listing .media-body {
            padding: 10px;
        }
    }

    @media only screen and (min-width: 992px) {
        #property-listings .property-listing img {
            max-width: 160px;
        }
    }

</style>
<!-- Content Content Area Start -->
<div class="col-md-10">
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron text-center">
                <h1 class="service_title">Event List</h1>      
                <p class="sub_title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc auctor leo efficitur nibh egestas, at imperdiet est venenatis.
                    Vivamus maximus odio in ante dignissim, eu blandit turpis sodales.
                    Nullam in facilisis erat. Maecenas placerat justo sed dolor sodales pharetra. Morbi lobortis efficitur sem, et ullamcorper elit molestie ut
                </p>
            </div>
            <div id="property-listings">
                <div class="row">
                    <div class="col-md-12">
                        <h1>All Event</h1>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        if(isset($exhibitions) && !empty($exhibitions)){
                            foreach($exhibitions as $exhibition){
                    ?>
                    <div class="col-sm-6">
                        <!-- Begin Listing: 609 W GRAVERS LN-->
                        <div class="brdr bgc-fff pad-10 box-shad btm-mrg-20 property-listing">
                            <div class="media">
                                <a class="pull-left" href="<?php echo base_url('welcome/event_details/'.$exhibition->id); ?>">
                                    <img alt="image" class="img-responsive" src="<?php echo base_url("images/exhibition/".$exhibition->fetured_image_path) ?>" alt="<?php echo $exhibition->title; ?>" title="<?php echo $exhibition->title; ?>"></a>

                                <div class="clearfix visible-sm"></div>

                                <div class="media-body fnt-smaller">
                                    <h4 class="media-heading">
                                        <a href="<?php echo base_url('welcome/event_details/'.$exhibition->id); ?>"><?php echo $exhibition->title; ?></a>
                                    </h4>


                                    <ul class="list-inline mrg-0 btm-mrg-10 clr-535353">
                                        <li><?php echo date("M d, Y",strtotime($exhibition->start_date))." to ".date("M d, Y",strtotime($exhibition->end_date)); ?></li>
                                    </ul>

                                    <p class="hidden-xs">
                                        <?php
                                        $url    =   base_url("welcome/event_details/".$exhibition->id);
                                        $string     =   $exhibition->descriptions;
                                        if (strlen($string) > 25) {
                                            $trimstring = substr($string, 0, 25)."<br><a href='$url'>readmore...</a>";
                                        } else {
                                            $trimstring = $string;
                                        }
                                            echo $trimstring;
                                            //Output : Lorem Ipsum is simply dum [readmore...][1]
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End Listing-->
                    </div>
                    <?php }}; ?>
                </div><!-- End row -->
            </div><!-- End row -->
        </div>
    </div>
</div>
<!-- Content Content Area End -->
<?php echo $footer; ?>