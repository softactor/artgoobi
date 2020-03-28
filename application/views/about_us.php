<?php echo $header; ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12 col-lg-12">
        <div class="jumbotron text-center">
            <p class="sub_title">
                Artgoobi, a concern of ‘180 Degrees’, defines itself as a online platform with an express goal of empowering artists with efficacious tools to connect
                with the global art scene and to promote art as social business. In the same vein it makes it a prerogative to arouse the slumbering art market into being a socially
                supportive and sustainable force to leverage art in a way that helps nourish and manifest the potentials of change and growth that points
                to new beginnings. We are aware that many a talented artist veers away
                into other fields to eke out a living compromising their passion for art. Moreover, an art market that has shown a steady decline over recent years does very little
                to encourage artists to try and break new grounds and experiment with styles and techniques in search of a language of their own. 180 Degrees, with the support
                of like-minded people and organizations working with similar goals, seeks to initiate programmmes and events to advantage the artists
            </p>
        </div>
        <!-- Example row of columns -->
        <div class="row service_item artgoobi_about_us" id="artgoobi_about_us">
            <div class="col-md-4">
                <h3 style="font-size: 19px; font-weight: bold;"><span>W</span>hat is Artgoobi</h3>
                <p class="para-min-height">
                    Artgoobi, an art-based social web portal conceived as an interactive site, provides a free virtual space to artists/art collectors to share their artworks and profiles individually and independently.
                    A concern of ‘180 Degrees’, it is focused on people involved in art practice and art collection, who can join this site to exhibit his/her own creations and thoughts as well as collections.
                </p>
                <p><a href="javascript:void(0);" role="button" onclick="viewAboutUsDetails('service_identity_01')">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h3 style="font-size: 19px; font-weight: bold;"><span>A</span>rtgoobi Features</h3>
                <div class="para-min-height">
                    <ul>
                        <li>
                            Artist/collector or gallery profile should contain artworks, writeups, news and reviews.

                        </li>
                        <li>
                            Exhibition(s) should contain slideshow of a particular exhibition content during the period its being showcased at any gallery. Sale of the works will not commence before the end of the exhibition in an actual gallery space.  

                        </li>
                    </ul>
                </div>
                <p><a href="javascript:void(0);" role="button" onclick="viewAboutUsDetails('service_identity_02')">View details &raquo;</a></p>
            </div>
            <div class="col-md-4">
                <h3 style="font-size: 19px; font-weight: bold;"><span>A</span>rtgoobi Beneficiaries</h3>
                <div class="para-min-height">
                    <h4>Artists/Collectors or Galleries</h4>
                    <ul>
                        <li>
                            Can create and manage own profile
                        </li>
                        <li>
                            Can upload own (or own collection) artworks for display and sale at own profile
                        </li>
                        <li>
                            Can create event(s)
                        </li>
                        <li>
                            Can donate picture to public profile
                        </li>
                        <li>
                            Can put on sale and buy artwork
                        </li>
                        <li>
                            Can write a blog at own profile
                        </li>
                        <li>
                            Can share news/review link at own profile
                        </li>
                    </ul>
                </div>
                <p><a href="javascript:void(0);" role="button" onclick="viewAboutUsDetails('service_identity_03')">View details &raquo;</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 individual_service_item" id="service_identity_01">
                <?php $this->load->view('pages/what_is_artgoobi'); ?>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 individual_service_item" id="service_identity_02">
                <?php $this->load->view('pages/artgoobi_features'); ?>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12 individual_service_item" id="service_identity_03">
                <?php $this->load->view('pages/artgoobi_beneficiaries'); ?>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-12" id="service_identity_04">
                <?php $this->load->view('pages/artgoobi_team'); ?>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>