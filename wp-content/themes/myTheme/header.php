<!DOCTYPE html>
<html dir="ltr" lang="<?php echo get_locale() ?>" id="language_current">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php $baseURL = esc_url(get_template_directory_uri()); ?>
    <meta name="google-site-verification" content="05Zf8Oosra7d clwPY4po12vxX3EkmCL8h6COpebOID4"/>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="<?php echo get_bloginfo('description') ?>"/>
    <meta name="keywords" content="car,auto,moto,repair,wash,cleaning,transport,workshop"/>
    <meta name="author" content="ThemeMascot"/>
    <!-- Page Title -->
    <title><?php echo the_title() ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <!-- Favicon and Touch Icons -->
    <link href="<?php echo $baseURL ?>/images/favicon.png" rel="shortcut icon" type="image/png">
    <!-- Stylesheet -->
    <link href="<?php echo $baseURL ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $baseURL ?>/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $baseURL ?>/css/animate.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $baseURL ?>/css/css-plugin-collections.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap&subset=vietnamese" rel="stylesheet">
    <link href="<?php echo $baseURL ?>/css/style-main.css" rel="stylesheet" type="text/css">
    <!-- CSS | Preloader Styles -->
    <!-- CSS | Custom Margin Padding Collection -->
    <link href="<?php echo $baseURL ?>/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
    <!-- CSS | Responsive media queries -->
    <link href="<?php echo $baseURL ?>/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- CSS | For Dark Layout -->
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="css/style.css" rel="stylesheet" type=#preloader"text/css"> -->
    <?php if (is_product()): ?>

        <?php global $wp;
        global $product;

        ?>
        <meta property="og:title" content="<?php echo the_title() ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:description" content="<?php echo wp_trim_words(get_the_excerpt()) ?>"/>
        <meta property="og:url" content="<?php echo home_url($wp->request) ?>"/>
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
        <meta property="og:image" content="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>"/>
        <script src="https://sp.zalo.me/plugins/sdk.js"></script>
        <!--        <script type='text/javascript' src="--><?php //echo get_template_directory_uri() ?><!--/assets/js/loader.js"></script>-->
    <?php endif; ?>

    <!-- Revolution Slider 5.x CSS settings -->

    <!-- CSS | Theme Color -->
    <link href="<?php echo $baseURL ?>/css/colors/theme-skin-color-set-1.css" rel="stylesheet" type="text/css">


    <?php wp_head() ?>
</head>

<body <?php body_class('white'); ?>>
<input type="hidden" id="url_public" value="<?php echo get_theme_file_uri() ?>">
<div id="status">
</div>
<input type="hidden" id="url_admin" value="<?php echo admin_url('admin-ajax.php') ?>">
<div id="wrapper" class="clearfix  <?php if (is_front_page()) {
    echo 'home-header';
} ?> ">
    <div style="position: relative;height: 100%;max-width: 1500px;margin: 0 auto;">
        <!-- Header -->
        <div class="header">

            <div class="logo">
                <a href="<?php echo get_site_url() ?>">
                    <img style="max-width: 150px; margin: 0" src="<?php echo get_field('logo', 'option')['url'] ?>"
                         alt="">
                </a>
            </div>
            <!--            <div id="menu" aria-controls="page-menu" data-modal-nav-toggle="">-->
            <!--                <span class="icon-menu">-->
            <!--                    <span class="icon-menu__bar icon-menu__bar-1"></span>-->
            <!--                    <span class="icon-menu__bar icon-menu__bar-2"></span>-->
            <!--                    <span class="icon-menu__bar icon-menu__bar-3"></span>-->
            <!--                </span>-->
            <!--            </div>-->

            <div class="space">

            </div>
            <div class="right-head d-flex align-items-center">
                <div class="menu-primary active">
                    <ul class="menu-main-head" id="nav-top">
                        <li class="search-mobile">
                            <form method="get" action="<?php esc_url(home_url('/')) ?>" class="form-search-menu">
                                <input type="text" name="s" class="form-control search-frm" placeholder="Search product">
                                <button class="btn btn-default"><?php echo __('Search', 'localFile') ?></button>
                            </form>
                        </li>
                        <?php
                        $menuLocations = get_nav_menu_locations();
                        $menuID = $menuLocations['main-nav'];
                        $primaryNav = wp_get_nav_menu_items($menuID);
                        $id_parent = 0;
                        foreach ($primaryNav as $navItem) {
                            if ($navItem->menu_item_parent == $id_parent) {
                                echo '<li class="menu-item' . $navItem->ID . '"> <a href="' . $navItem->url . '" >' . $navItem->title . '</a>';

                                $sub = "";
                                foreach ($primaryNav as $navItem2) {
                                    if ($navItem2->menu_item_parent == $navItem->ID) {
                                        $sub .= '<li class="menu-item' . $navItem2->ID . '"> <a href="' . $navItem2->url . '" >' . $navItem2->title . '</a>';

                                        $sub2 = "";
                                        foreach ($primaryNav as $navItem3) {
                                            if ($navItem3->menu_item_parent == $navItem2->ID) {
                                                $sub2 .= '<li class="menu-item' . $navItem3->ID . '"> <a href="' . $navItem3->url . '" >' . $navItem3->title . '</a></li>';

                                            }
                                        }
                                        $sub .= '<ul class="dropdown ">' . $sub2 . '</ul>';

                                        $sub .= '</li>';
                                    }
                                }
                                echo '<ul class="dropdown ">' . $sub . '</ul>';
                                echo '</li>';
                            }
                        }
                        ?>
                        <!--                    <li id="search" style="flex-direction: row; display: flex; justify-content: center;">-->
                        <!---->
                        <!--                    </li>-->
                    </ul>
                </div>
                <div class="search-box-container">
                    <span class="label-search" style="margin-right:30px">
                        <img src="https://theme.hstatic.net/1000269337/1000458651/14/hd_mainmenu_icon_search.png?v=101">
                    </span>
                    <div class="content-search">
                        <h5 class="label-search">Search</h5>
                        <div class="search-box">
                            <form method="get" action="<?php esc_url(home_url('/')) ?>" class="form-search-menu">
                                <input type="text" name="s" class="form-control search-frm" placeholder="Search product">
                                <button class="btn btn-default"><?php echo __('Search', 'localFile') ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="container-mini-cart"></div>
                    <div>
                        <div class="menu-toggle">
                            <div class="one"></div>
                            <div class="two"></div>
                            <div class="three"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="circle"></div>
        <ul class="menu-main">
            <div class="menu-main-sub">
                <ul class="menu-pri" id="nav">
                    <?php
                    $menuLocations = get_nav_menu_locations();
                    $menuID = $menuLocations['main-nav'];
                    $primaryNav = wp_get_nav_menu_items($menuID);
                    $id_parent = 0;
                    foreach ($primaryNav as $navItem) {
                        if ($navItem->menu_item_parent == $id_parent) {
                            echo '<li class="menu-item' . $navItem->ID . '"> <a href="' . $navItem->url . '" title="' . $navItem->title . '">' . $navItem->title . '</a>';

                            $sub = "";
                            foreach ($primaryNav as $navItem2) {
                                if ($navItem2->menu_item_parent == $navItem->ID) {
                                    $sub .= '<li class="menu-item' . $navItem2->ID . '"> <a href="' . $navItem2->url . '" title="' . $navItem2->title . '">' . $navItem2->title . '</a>';

                                    $sub2 = "";
                                    foreach ($primaryNav as $navItem3) {
                                        if ($navItem3->menu_item_parent == $navItem2->ID) {
                                            $sub2 .= '<li class="menu-item' . $navItem3->ID . '"> <a href="' . $navItem3->url . '" title="' . $navItem3->title . '">' . $navItem3->title . '</a></li>';

                                        }
                                    }
                                    $sub .= '<ul class="dropdown d-none">' . $sub2 . '</ul>';

                                    $sub .= '</li>';
                                }
                            }
                            echo '<ul class="dropdown d-none parent">' . $sub . '</ul>';

                            echo '</li>';
                        }
                    }
                    ?>
                    <!--                    <li id="search" style="flex-direction: row; display: flex; justify-content: center;">-->
                    <!---->
                    <!--                    </li>-->
                </ul>
                <div class="language-content">
                    <div id="search" style="flex-direction: row; display: flex; justify-content: center;">
                        <?php qtranxf_generateLanguageSelectCode(
                            array(
                                'type' => 'image'
                            ));
                        ?>
                        <a href=""><i class="fa fa-search" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="search-box">
                    <form method="get" action="<?php esc_url(home_url('/')) ?>" class="form-search-menu">
                        <input type="text" name="s" class="form-control" placeholder="Search product">
                        <button class="btn btn-default"><?php echo __('Search', 'localFile') ?></button>
                    </form>
                </div>
            </div>
    </div>
</div>