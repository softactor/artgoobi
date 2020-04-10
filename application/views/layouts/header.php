<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Bangladesh Artist Associasion">
        <meta name="author" content="artgoobi">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/favicon_16X16.png" />
        <!--for facebook share-->
        <?php if (isset($isShared) && !empty($isShared)) { ?>
            <meta property="og:url"                content="<?php echo base_url('welcome/artwork_details/' . $artist_id . '/' . $artwork_id); ?>" />
            <meta property="og:type"               content="article" />
            <meta property="og:title"              content="<?php echo $artwork_data->title; ?>" />
            <meta property="og:image"              content="<?php echo base_url(); ?>uploads/artwork/<?php echo $artwork_data->image_original; ?>" />
            <?php
        }
        ?>
        <title><?php echo (isset($title) && !empty($title) ? $title : "Artgoobi") ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/ihover.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/perfect-scrollbar.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/sweetalert.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/select2.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/exhibition_details.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/artgoobi.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/artgoobi_menu.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>css/artgoobi_responsive.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>
            <!-- Top Menu Area Start -->
            <?php echo $top_menu;?>
            <!--Advance search option showing area-->
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
        <div id="page_artgoobi_content_area" class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-12 col-md-10 col-sm-12">