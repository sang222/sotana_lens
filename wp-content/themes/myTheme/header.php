<!DOCTYPE html>
<html dir="ltr" lang="en">

<!-- Mirrored from html.kodesolution.live/m/repairshop/v3.1/demo/index-dark-mp-layout3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 24 Jun 2019 16:44:40 GMT -->
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
<body class="white" <?php body_class(); ?>>
<!--<script>-->
<!--    // This is called with the results from from FB.getLoginStatus().-->
<!--    function statusChangeCallback(response) {-->
<!--        console.log('statusChangeCallback');-->
<!--        console.log(response);-->
<!--        // The response object is returned with a status field that lets the-->
<!--        // app know the current login status of the person.-->
<!--        // Full docs on the response object can be found in the documentation-->
<!--        // for FB.getLoginStatus().-->
<!--        if (response.status === 'connected') {-->
<!--            // Logged into your app and Facebook.-->
<!--            testAPI();-->
<!--        } else {-->
<!--            // The person is not logged into your app or we are unable to tell.-->
<!--            document.getElementById('status').innerHTML = 'Please log ' +-->
<!--                'into this app.';-->
<!--        }-->
<!--    }-->
<!---->
<!--    // This function is called when someone finishes with the Login-->
<!--    // Button.  See the onlogin handler attached to it in the sample-->
<!--    // code below.-->
<!--    function checkLoginState() {-->
<!--        FB.getLoginStatus(function(response) {-->
<!--            statusChangeCallback(response);-->
<!--        });-->
<!--    }-->
<!---->
<!--    window.fbAsyncInit = function () {-->
<!--        window.fbAsyncInit = function () {-->
<!--            FB.init({-->
<!--                appId: '696519377442949',-->
<!--                xfbml: true,-->
<!--                version: 'v3.3'-->
<!--            });-->
<!--            FB.AppEvents.logPageView();-->
<!--        };-->
<!---->
<!--        // Now that we've initialized the JavaScript SDK, we call-->
<!--        // FB.getLoginStatus().  This function gets the state of the-->
<!--        // person visiting this page and can return one of three states to-->
<!--        // the callback you provide.  They can be:-->
<!--        //-->
<!--        // 1. Logged into your app ('connected')-->
<!--        // 2. Logged into Facebook, but not your app ('not_authorized')-->
<!--        // 3. Not logged into Facebook and can't tell if they are logged into-->
<!--        //    your app or not.-->
<!--        //-->
<!--        // These three cases are handled in the callback function.-->
<!---->
<!--        FB.getLoginStatus(function (response) {-->
<!--            statusChangeCallback(response);-->
<!--        });-->
<!---->
<!--    };-->
<!---->
<!--    // Load the SDK asynchronously-->
<!--    (function(d, s, id) {-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) return;-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = "https://connect.facebook.net/en_US/sdk.js";-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));-->
<!---->
<!--    // Here we run a very simple test of the Graph API after login is-->
<!--    // successful.  See statusChangeCallback() for when this call is made.-->
<!--    function testAPI() {-->
<!--        console.log('Welcome!  Fetching your information.... ');-->
<!--        FB.api('/me', function(response) {-->
<!--            console.log('Successful login for: ' + response.name);-->
<!--            document.getElementById('status').innerHTML =-->
<!--                'Thanks for logging in, ' + response.name + '!';-->
<!--        });-->
<!--    }-->
<!--</script>-->

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
<!---->
<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">-->
<!--</fb:login-button>-->

<div id="status">
</div>
<input type="hidden" id="url_admin" value="<?php echo admin_url('admin-ajax.php') ?>">
<div id="wrapper" class="clearfix">
    <!-- preloader -->
    <!--    <div id="preloader">-->
    <!--        <div id="spinner">-->
    <!--            <img alt="" src="images/preloaders/5.gif">-->
    <!--        </div>-->
    <!--        <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>-->
    <!--    </div>-->

    <!-- Header -->
    <header id="header" class="header">
        <div class="header-top  sm-text-center" style="background: #d85c5c">
            <div class="fixed-width">
                <div class="row">
                    <div class="col-md-4">
                        <div class="widget no-border m-0">
                            <ul class="list-inline font-13 sm-text-center mt-5">
                                <li>
                                    <a class="text-white" href="#">FAQ</a>
                                </li>
                                <li class="text-white">|</li>
                                <li>
                                    <a class="text-white" href="#">Help Desk</a>
                                </li>
                                <li class="text-white">|</li>
                                <li>
                                    <?php
                                    if (is_user_logged_in()) {
                                        ?>
                                        <a  href="<?php echo home_url() ?>/order-history" class="text-white"><i
                                                    class="fa fa-user"></i>
                                            Hello <?php echo wp_get_current_user()->display_name ?> - <a class="text-white"
                                                    href="<?php echo wp_logout_url('index.php'); ?>">Logout</a>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a  class="text-white" href="<?php echo home_url() ?>/dang-nhap">Login</a>
                                        <?php
                                    }
                                    ?>

                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="widget m-0 pull-right sm-pull-none sm-text-center">
                            <ul class="list-inline container-mini-cart pull-right">
                                <li class="mb-0 pb-0">
                                    <?php global $woocommerce; ?>
                                    <div class="top-dropdown-outer pt-5 pb-10">
                                        <a class="top-cart-link has-dropdown text-white text-hover-theme-colored"><i
                                                    class="fa fa-shopping-cart font-13"></i>
                                            <span id="count-mini-cart">(<?php echo $woocommerce->cart->cart_contents_count ?> Items) </span></a>
                                        <ul class="dropdown " id="mini-cart-container">
                                            <li>
                                                <!-- dropdown cart -->
                                                <div class="dropdown-cart">
                                                    <table class="table cart-table-list table-responsive">
                                                        <tbody>
                                                        <?php
                                                        $items = $woocommerce->cart->get_cart();
                                                        $totalitem = 0;
                                                        $haveitems = 0;
                                                        $vt = 0;
                                                        foreach ($items as $item => $values):
                                                            $_product = apply_filters('woocommerce_cart_item_product', $values['data'], $values, $item);
                                                            if ($_product && $_product->exists() && $values['quantity'] > 0):
                                                                $haveitems = 1;
                                                                $_product = wc_get_product($values['data']->get_id());
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
                                                                            <?php echo $imgpro; ?></a>
                                                                    </td>
                                                                    <td><a href="#"> Product Title</a></td>
                                                                    <td>X<?php echo $quantitypro; ?></td>
                                                                    <td><?php echo $pricepro; ?></td>
                                                                    <td><a class="close remove-product"
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
                                                    <div class="total-cart text-right">
                                                        <table class="table table-responsive">
                                                            <tbody>
                                                            <tr>
                                                                <td> Item Total</td>
                                                                <td><?php echo $totalitem; ?> Items</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Order Total</td>
                                                                <td><?php echo WC()->cart->get_cart_subtotal(); ?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="cart-btn text-right">
                                                        <a class="btn btn-theme-colored btn-xs"
                                                           href="<?php echo wc_get_cart_url(); ?>"> View cart</a>
                                                        <a class="btn btn-dark btn-xs" href="shop-checkout.html">
                                                            Checkout</a>
                                                    </div>
                                                </div>
                                                <!-- dropdown cart ends -->
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
                                                    <form method="get" class="mt-10">
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
                        </div>
                        <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
                            <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                                <li><a href="#"><i class="fa fa-facebook text-white"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter text-white"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus text-white"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram text-white"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin text-white"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle p-0 bg-lightest xs-text-center">
            <div class="fixed-width pt-0 pb-0">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-6">
                        <div class="widget no-border m-0">
                            <a href="<?php echo get_site_url() ?>"
                               class="menuzord-brand pull-left flip xs-pull-center mt-10 mb-10"><img alt=""
                                                                                                     src="<?php echo esc_url(get_template_directory_uri()) ?>/images/logo-wide-white.png"></a>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                        <div class="widget no-border m-0">
                            <div class="mt-15 mb-10 text-right flip sm-text-center">
                                <div class="font-15 text-black-333 mb-5 font-weight-600"><i
                                            class="fa fa-envelope text-theme-colored font-18"></i> Mail Us Today
                                </div>
                                <a href="#" class="font-12 text-gray"> info@yourdomain.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                        <div class="widget no-border m-0">
                            <div class="mt-15 mb-10 text-right flip sm-text-center">
                                <div class="font-15 text-black-333 mb-5 font-weight-600"><i
                                            class="fa fa-map-marker text-theme-colored font-18"></i> Company Location
                                </div>
                                <a href="#" class="font-12 text-gray"> 121 King Street, Melbourne</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-2">
                        <div class="widget no-border m-0">
                            <div class="mt-15 mb-10 text-right flip sm-text-center">
                                <div class="font-15 text-black-333 mb-5 font-weight-600"><i
                                            class="fa fa-phone-square text-theme-colored font-18"></i> +(012) 345 6789
                                </div>
                                <a href="#" class="font-12 text-gray"> Call us for more details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-nav">
            <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
                <div class="fixed-width prefix">
                    <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
                        <ul class="menuzord-menu">
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
                        <ul class="pull-right flip hidden-sm hidden-xs">
                            <li>
                                <!-- Modal: Book Now Starts -->
                                <a class="btn btn-colored btn-flat bg-theme-color-2 text-white font-14 bs-modal-ajax-load mt-0 p-25 pr-15 pl-15"
                                   data-toggle="modal" data-target="#BSParentModal"
                                   href="ajax-load/reservation-form.html">Shop Now</a>
                                <!-- Modal: Book Now End -->
                            </li>
                        </ul>
                        <div id="top-search-bar" class="collapse">
                            <div class="fixed-width">
                                <form role="search" action="#" class="search_form_top" method="get">
                                    <input type="text" placeholder="Type text and press Enter..." name="s"
                                           class="form-control" autocomplete="off">
                                    <span class="search-close"><i class="fa fa-search"></i></span>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!--<!DOCTYPE html>-->
    <!--<html>-->
    <!--<head>-->
    <!--    --><?php //wp_head();
    ?>
    <!--    --><?php //$baseURL = esc_url(get_template_directory_uri());
    ?>
    <!--    <base href="--><?php //echo $baseURL . '/';
    ?><!--" target="_blank">-->
    <!--</head>-->
    <!--<div>-->
    <!--    <ul>-->
    <!--        <li>--><?php
    //            $fb = get_theme_mod('Facebook');
    //            if (!empty($fb)) {
    //                echo '<a href="' . $fb . '">Facebook</a>';
    //            }
    //            $logo=get_theme_mod('logo');
    //            var_dump($logo);
    //
    ?><!--</li>-->
    <!--    </ul>-->
    <!--</div>-->
    <!--<body>-->