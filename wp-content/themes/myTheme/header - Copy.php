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

    <!-- Header -->
    <div id="header" class="header">
        <div class="header-middle p-0 bg-lightest xs-text-center">
            <div class="fixed-width pt-0 pb-0">
                <div class="row mx-0 row-top">
                    <div class="col-xs-12 col-sm-3 col-md-6 col-logo">
                        <div class="widget no-border m-0">
                            <a href="<?php echo get_site_url() ?>"
                               class="menuzord-brand pull-left flip xs-pull-center mt-10 mb-10">
                                <img alt=""
                                     src="<?php echo esc_url(get_template_directory_uri()) ?>/images/logo.png"></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                        <div class="widget no-border m-0">
                            <div class="mt-15 mb-10 text-right flip text-center">
                                <div class="font-15 text-black-333 mb-5 font-weight-600"><i
                                            class="fa fa-envelope text-theme-colored font-18"></i> Email
                                </div>
                                <a href="mailto: gentleromeos@gmail.com" class="font-12 text-gray">
                                    gentleromeos@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                        <div class="widget no-border m-0">
                            <div class="mt-15 mb-10 text-right flip text-center">
                                <div class="font-15 text-black-333 mb-5 font-weight-600"><i
                                            class="fa fa-map-marker text-theme-colored font-18"></i> Địa chỉ
                                </div>
                                <a href="#" class="font-12 text-gray"> R4-64 Mỹ Toàn 2, Phường Tân Phong, Quận
                                    7, TP. HCM</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                        <div class="widget no-border m-0">
                            <div class="mt-15 mb-10 text-right flip text-center">
                                <div class="font-15 text-black-333 mb-5 font-weight-600"><i
                                            class="fa fa-phone-square text-theme-colored font-18"></i> (028) 5412.5427
                                </div>
                                <a href="#" class="font-12 text-gray"> Gọi để biết thêm chi tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav">
            <div class="header-nav-wrapper bg-theme-colored border-bottom-theme-color-2-1px">
                <div class="fixed-width">
                    <nav class="nav-mobile">
                        <?php global $woocommerce; ?>
                        <a href="<?php echo get_site_url() ?>" class="menuzord-brand pull-left">
                            <img alt=""
                                 src="<?php echo esc_url(get_template_directory_uri()) ?>/images/logo.png"></a>
                        <div class="wrapper-nav-mobile">
                            <ul class="list-inline flip container-mini-cart pull-right">
                                <li class="mb-0 pb-0">
                                    <div style="position: relative" class="show-on-mobile" id="icon-cart-mobile">
                                        <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/hd_mainmenu_icon_cart.png"
                                             alt="" style="margin-top: -11px;margin-right: 10px;">
                                        <span class="hd-cart-count total-outer"
                                              id="count-mini-cart "><?php echo $woocommerce->cart->cart_contents_count ?></span>
                                    </div>
                                    <div class="top-dropdown-outer pt-5 pb-10">
                                        <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i
                                                    class="fa fa-shopping-cart font-13"></i>
                                            <span
                                                    class="total-outer"
                                                    id="count-mini-cart ">(<?php echo $woocommerce->cart->cart_contents_count ?>
                                                    Items) </span></a>
                                        <ul class="dropdown " id="mini-cart-container">
                                            <li>
                                                <div class="dropdown-cart">
                                                    <div class="dropdown--content-tbl">
                                                        <table class="table cart-table-list table-responsive">
                                                            <tbody>
                                                            <?php
                                                            $items = $woocommerce->cart->get_cart();
                                                            $totalitem = 0;
                                                            $total_price = 0;
                                                            $haveitems = 0;
                                                            $vt = 0;
                                                            foreach ($items as $item => $values):
                                                                $_product = apply_filters('woocommerce_cart_item_product', $values['data'], $values, $item);
                                                                if ($_product && $_product->exists() && $values['quantity'] > 0):
                                                                    $haveitems = 1;
                                                                    $_product = wc_get_product($values['data']->get_id());
                                                                    if ($_product->get_sale_price() > 0) {
                                                                        $total_price += $_product->get_sale_price() * $values['quantity'];
                                                                    } else {
                                                                        $total_price += $_product->get_regular_price() * $values['quantity'];
                                                                    }
                                                                    $linkpro = get_permalink($values['product_id']);
                                                                    $titlepro = $_product->get_title();
                                                                    $getProductDetail = wc_get_product($values['product_id']);
                                                                    $imgpro = $getProductDetail->get_image(array(80, 80));
                                                                    $pricepro = get_post_meta($values['product_id'], '_price', true);
                                                                    $quantitypro = $values['quantity'];
                                                                    $totalitem += $quantitypro;
                                                                    ?>
                                                                    <tr id="mini-item-<?php echo $vt ?>">
                                                                        <td><a href="<?php echo $linkpro; ?>"><img
                                                                                        alt="<?php echo $titlepro; ?>"
                                                                                <?php echo $imgpro; ?></a></td>
                                                                        <td><a
                                                                                    href="<?php echo $linkpro; ?>"
                                                                                    class="truncate">
                                                                                <?php echo $titlepro ?></a>
                                                                        </td>
                                                                        <td>X
                                                                            <span
                                                                                    class="quantity-head-<?php echo $_product->get_id() ?>"><?php echo $quantitypro; ?></span>
                                                                        </td>
                                                                        <td><?php echo $pricepro; ?></td>
                                                                        <td><a class="close remove-product"
                                                                               data-product_id="<?php echo $_product->get_id() ?>"
                                                                               data-line="<?php echo $vt; ?>"
                                                                               href="#"><i
                                                                                        class="fa fa-close font-13"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $vt++; ?>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="total-cart text-right">
                                                        <table class="table table-responsive">
                                                            <tbody>
                                                            <tr>
                                                                <td> Item Total</td>
                                                                <td>
                                                                    <span class="total-amount-dropdown"
                                                                          data-amount="<?php echo $totalitem; ?>"><?php echo $totalitem; ?></span>
                                                                    Items
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Order Total</td>
                                                                <td><span
                                                                            class="total-price-dropdown"
                                                                            data-total="<?php echo $total_price ?>"><?php echo $total_price ?></span>
                                                                    VND
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="cart-btn text-right">
                                                        <a class="btn btn-theme-colored btn-xs"
                                                           href="<?php echo wc_get_cart_url(); ?>"> View cart</a>
                                                        <a class="btn btn-dark btn-xs"
                                                           href="<?php echo wc_get_checkout_url() ?>">
                                                            Checkout</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                            <i id="toggle-mobile-menu" class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                    </nav>
                    <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
                        <i class="fa fa-times show-on-mobile close-button" aria-hidden="true"></i>
                        <ul class="menuzord-menu">
                            <!-- <li class="menu-item167">
                                <a href="<?php echo site_url() ?>" title="Gọng kính">Trang chủ</a>
                            </li> -->
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
                                            $sub .= '<ul class="dropdown">' . $sub2 . '</ul>';
                                            $sub .= '</li>';
                                        }
                                    }
                                    echo '<ul class="dropdown">' . $sub . '</ul>';
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                        <ul class="list-inline flip container-mini-cart pull-right">
                            <li class="mb-0 pb-0">
                                <?php global $woocommerce; ?>
                                <div class="top-dropdown-outer pt-5 pb-10">
                                    <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i
                                                class="fa fa-shopping-cart font-13"></i>
                                        <span
                                                class="total-outer"
                                                id="count-mini-cart">(<?php echo $woocommerce->cart->cart_contents_count ?>
                                                Items) </span></a>
                                    <ul class="dropdown " id="mini-cart-container">
                                        <li>
                                            <div class="dropdown-cart">
                                                <div class="dropdown--content-tbl">
                                                    <table class="table cart-table-list table-responsive">
                                                        <tbody>
                                                        <?php
                                                        $items = $woocommerce->cart->get_cart();
                                                        $totalitem = 0;
                                                        $total_price = 0;
                                                        $haveitems = 0;
                                                        $vt = 0;
                                                        foreach ($items as $item => $values):
                                                            $_product = apply_filters('woocommerce_cart_item_product', $values['data'], $values, $item);
                                                            if ($_product && $_product->exists() && $values['quantity'] > 0):
                                                                $haveitems = 1;
                                                                $_product = wc_get_product($values['data']->get_id());
                                                                if ($_product->get_sale_price() > 0) {
                                                                    $total_price += $_product->get_sale_price() * $values['quantity'];
                                                                } else {
                                                                    $total_price += $_product->get_regular_price() * $values['quantity'];
                                                                }
                                                                $linkpro = get_permalink($values['product_id']);
                                                                $titlepro = $_product->get_title();
                                                                $getProductDetail = wc_get_product($values['product_id']);
                                                                $imgpro = $getProductDetail->get_image(array(80, 80));
                                                                $pricepro = get_post_meta($values['product_id'], '_price', true);
                                                                $quantitypro = $values['quantity'];
                                                                $totalitem += $quantitypro;
                                                                ?>
                                                                <tr id="mini-item-<?php echo $vt ?>">
                                                                    <td><a href="<?php echo $linkpro; ?>"><img
                                                                                    alt="<?php echo $titlepro; ?>"
                                                                            <?php echo $imgpro; ?></a></td>
                                                                    <td><a
                                                                                href="<?php echo $linkpro; ?>"
                                                                                class="truncate">
                                                                            <?php echo $titlepro ?></a>
                                                                    </td>
                                                                    <td>X
                                                                        <span
                                                                                class="quantity-head-<?php echo $_product->get_id() ?>"><?php echo $quantitypro; ?></span>
                                                                    </td>
                                                                    <td><?php echo $pricepro; ?></td>
                                                                    <td><a class="close remove-product"
                                                                           data-line="<?php echo $vt; ?>"
                                                                           data-product_id="<?php echo $_product->get_id() ?>"
                                                                           href="#"><i
                                                                                    class="fa fa-close font-13"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <?php $vt++; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="total-cart text-right">
                                                    <table class="table table-responsive">
                                                        <tbody>
                                                        <tr>
                                                            <td> Item Total</td>
                                                            <td>
                                                                        <span data-amount="<?php echo $totalitem; ?>"
                                                                              class="total-amount-dropdown"><?php echo $totalitem; ?></span>
                                                                Items
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Order Total</td>
                                                            <td><span
                                                                        class="total-price-dropdown"
                                                                        data-total="<?php echo $total_price ?>"><?php echo $total_price ?></span>
                                                                VND
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="cart-btn text-right">
                                                    <a class="btn btn-theme-colored btn-xs"
                                                       href="<?php echo wc_get_cart_url(); ?>"> View cart</a>
                                                    <a class="btn btn-dark btn-xs"
                                                       href="<?php echo wc_get_checkout_url() ?>">
                                                        Checkout</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="mb-0 pb-0">
                                <div class="top-dropdown-outer pt-5 pb-10">
                                    <a class="top-search-box has-dropdown text-white text-hover-theme-colored"><i
                                                class="fa fa-search font-13"></i> &nbsp;</a>
                                    <ul class="dropdown">
                                        <li>
                                            <div class="search-form-wrapper">
                                                <form method="get" class="mt-10"
                                                      action="<?php esc_url(home_url('/')) ?>">
                                                    <input type="text"
                                                           onfocus="if(this.value =='Enter your search') { this.value = ''; }"
                                                           onblur="if(this.value == '') { this.value ='Enter your search'; }"
                                                           value="Enter your search" id="searchinput" name="s"
                                                           class="">
                                                    <label><input type="submit" name="submit" value=""></label>
                                                </form>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                        <div class="search-form-wrapper show-on-mobile">
                            <form method="get" action="<?php esc_url(home_url('/')) ?>">
                                <input type="text"
                                       onfocus="if(this.value =='Enter your search') { this.value = ''; }"
                                       onblur="if(this.value == '') { this.value ='Enter your search'; }"
                                       value="Enter your search" id="searchinput" name="s" class="">
                                <label></label>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>