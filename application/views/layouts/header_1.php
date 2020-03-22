<!DOCTYPE html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html lang="en">
    <head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/favicon_16X16.png" />
        <?php
            if(isset($isShared) && !empty($isShared)){ ?>
                <meta property="og:url"                content="<?php echo base_url('welcome/artwork_details/' . $artist_id . '/' . $artwork_id); ?>" />
                <meta property="og:type"               content="article" />
                <meta property="og:title"              content="<?php echo $artwork_data->title; ?>" />
                <meta property="og:image"              content="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork_data->image_original; ?>" />
        <?php   
        
            }
        ?>
        <title><?php echo $title; ?></title>

        <!-- ihover-css -->
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/ihover.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap -->
        <!-- Global Url js -->
        <script src="<?php echo base_url(); ?>js/global_url.js"></script>
        <!-- offcanvas-css -->
        <!--<link href="<?php echo base_url(); ?>css/offcanvas.css" rel="stylesheet">-->
        <!-- artgoobi custom-css -->
        <link href="<?php echo base_url(); ?>css/artgoobi.css" rel="stylesheet">
                <!--gallery Details-->
        <link href="<?php echo base_url(); ?>css/gallery_details.css" rel="stylesheet">
        <!-- artgoobi nav custom-css -->
        <link href="<?php echo base_url(); ?>css/navbar_artgoobi.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/exhibition_details.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/perfect-scrollbar.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/sweetalert.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/artgoobi_menu.css" rel="stylesheet">
    </head>

    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
            <!-- Top Menu Area Start -->
            <?php echo $top_menu;?>
            <div class="container" class="search_section">
                <div class="row">
                    <div class="col-md-10 col-sm-12 col-lg-10 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-xl-12">
                                <div id="dynamic_search_impose"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div id="dynamic_search_filter_impose"></div>
                    </div>
                </div>
            </div>
            <div id="page_artgoobi_content_area">