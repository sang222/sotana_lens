<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $baseURL = esc_url(get_template_directory_uri()); ?>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="RepairShop | Car Repair & Car Wash HTML Template"/>
    <meta name="keywords" content="car,auto,moto,repair,wash,cleaning,transport,workshop"/>
    <meta name="author" content="ThemeMascot"/>
    <!-- Page Title -->
    <title>Glasses shop | GlassesShop.com</title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <!-- Favicon and Touch Icons -->
    <link href="<?php echo $baseURL ?>/images/favicon.png" rel="shortcut icon" type="image/png">
    <!-- Stylesheet -->
    <link href="<?php echo $baseURL ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $baseURL ?>/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $baseURL ?>/css/animate.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $baseURL ?>/css/css-plugin-collections.css" rel="stylesheet"/>
    <!-- CSS | menuzord megamenu skins -->
    <!--lato font-->
    <!--    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">-->
    <!-- CSS | Main style file -->
    <link href="<?php echo $baseURL ?>/css/style-main.css" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="<?php echo $baseURL ?>/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="<?php echo $baseURL ?>/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- CSS | For Dark Layout -->
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="css/style.css" rel="stylesheet" type=#preloader"text/css"> -->

    <!-- Revolution Slider 5.x CSS settings -->

    <!-- CSS | Theme Color -->
    <link href="<?php echo $baseURL ?>/css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">


    <?php wp_head() ?>
</head>

<body <?php body_class('white'); ?>>

<div id="status">
</div>
<input type="hidden" id="url_admin" value="<?php echo admin_url('admin-ajax.php') ?>">
<div id="wrapper" class="clearfix" style="overflow: hidden;">
    <div>
        <!-- Header -->
        <div class="header fixed-width">
            <div id="menu" aria-controls="page-menu" data-modal-nav-toggle="">
                <span class="icon-menu">
                    <span class="icon-menu__bar icon-menu__bar-1"></span>
                    <span class="icon-menu__bar icon-menu__bar-2"></span>
                    <span class="icon-menu__bar icon-menu__bar-3"></span>
                </span>
            </div>
            <div class="logo">
                <a href="<?php echo get_site_url() ?>"><img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/logo.png" alt=""></a>
            </div>
            <div id="icon-cart-mobile">
                <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/hd_mainmenu_icon_cart.png" />
                <span class="hd-cart-count total-outer" id="count-mini-cart ">0</span>
            </div>
        </div>
        <div class="circle"></div>
        <ul class="menu-main">
            <div class="menu-main-sub">
                <ul class="menu-pri">
                    <li><a href="<?php echo get_site_url() ?>">Home</a></li>
                    <li><a href="<?php echo get_site_url() ?>">sunglesses</a></li>
                    <li><a href="<?php echo get_site_url() ?>">optical</a></li>
                    <li><a href="<?php echo get_site_url() ?>">about</a></li>
                    <li><a href="<?php echo get_site_url() ?>">Stores</a></li>
                    <li id="search"><a href=""><i class="fa fa-search" aria-hidden="true"></i></a></li>
                </ul>
                <div class="search-box">
                    <h4>Search</h4>
                    <form action="">
                        <input type="text" class="form-control">
                        <button class="btn btn-default">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>