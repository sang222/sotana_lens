<?php //theme option
include 'core/init.php';

//customize
include 'include/icon_socail.php';
include 'include/info_web.php';
include 'include/main_menu.php';
include 'include/slider.php';
//woocommerce
include 'include/checkout_func.php';
include 'include/woocommerce.php';
include 'include/auth.php';
add_theme_support('woocommerce');
add_filter('woocommerce_breadcrumb_main_term', 'change_breadcrumb');

function change_breadcrumb($main_term)
{
    // var_dump($main_term);

    return $main_term;
}

//disble warning Yith checkout
// add_filter('woocommerce_cart_needs_shipping_address', '__return_false');
// add_filter('woocommerce_enable_order_notes_field', '__return_false', 9999);
// Remove Order Notes Field
// add_filter('woocommerce_checkout_fields', 'remove_order_notes');


// function remove_order_notes($fields)
// {
//     unset($fields['order']['order_comments']);
//     return $fields;
// }

function add_theme_scripts()
{
    wp_enqueue_script('jquery-js', get_theme_file_uri() . '/js/jquery-2.2.4.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('tween-max-js', get_theme_file_uri() . '/js/TweenMax.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap-datepicker', get_theme_file_uri() . '/js/bootstrap-datepicker.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap-timepicker', get_theme_file_uri() . '/js/bootstrap-timepicker.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('scrollToFixed', get_theme_file_uri() . '/js/jquery-scrolltofixed-min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('wow-js', get_theme_file_uri() . '/js/wow.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap-js', get_theme_file_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('lazy-load', 'https://cdn.rawgit.com/tuupola/jquery_lazyload/0a5e0785a90eb41a6411d67a2f2e56d55bbecbd3/lazyload.js', array('jquery'), '1.0', true);

    if (!is_cart()) {
        wp_enqueue_script('ajax-modal-js', get_theme_file_uri() . '/js/myJs/ajaxModalProduct.js', array('jquery'), '1.1', true);
    }

    if (is_product_category()) {
        wp_enqueue_script('category-js', get_theme_file_uri() . '/js/myJs/category.js', array('jquery'), '1.1', true);
    }

    wp_enqueue_script('account-js', get_theme_file_uri() . '/js/myJs/account.js', array('jquery'), '1.0', true);
    wp_enqueue_script('video-js', get_theme_file_uri() . '/js/video.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('media-video-js', get_theme_file_uri() . '/js/media.youtube.js', array('jquery'), '1.0', true);

    if (is_cart()) {
        wp_enqueue_script('cart-page', get_theme_file_uri() . '/js/myJs/cartPage.js', array('jquery'), '1.0', true);
    }

    if (is_checkout()) {
        wp_enqueue_script('checkouts-js', get_theme_file_uri() . '/js/myJs/checkout.js', array('jquery'), '1.0', true);
    }

    if (is_single()) {
        wp_enqueue_script('jquery-migrate-js', get_theme_file_uri() . '/plugin/slick-master/jquery-migrate-1.2.1.min.js', array('jquery'), '1.1', true);
        wp_enqueue_script('slick-js', get_theme_file_uri() . '/plugin/slick-master/slick/slick.js', array('jquery'), '1.1', true);
        wp_enqueue_script('single-product-js', get_theme_file_uri() . '/js/myJs/single-product.js', array('jquery'), '1.0', true);

    }

    if (is_page('try-eyewear')) {
        wp_enqueue_script('draggable-js', get_theme_file_uri() . '/js/Draggable.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script('webcam-js', get_theme_file_uri() . '/js/webcam.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script('html2canvas', get_theme_file_uri() . '/js/html2canvas.js', array('jquery'), '1.0', true);
        wp_enqueue_script('canvas2image', get_theme_file_uri() . '/js/canvas2image.js', array('jquery'), '1.0', true);
        wp_enqueue_script('try-eyewear', get_theme_file_uri() . '/js/try-eyewear.js', array('jquery'), '1.0', true);
    }

    wp_enqueue_script('auth-js', get_theme_file_uri() . '/js/myJs/auth.js', array('jquery'), '1.1', true);

    //plugin

    wp_enqueue_script('carousel-js', get_theme_file_uri() . '/plugin/OwlCarousel/dist/owl.carousel.min.js', array('jquery'), '1.1', true);

    //    wp_enqueue_script('zoom-plugin-js', get_theme_file_uri('/plugin/zoom-master/jquery.zoom.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('zoom-plugin-js', get_theme_file_uri() . '/plugin/elevatezoom-master/jquery.elevatezoom.js', array('jquery'), '1.0', true);

    wp_enqueue_script('main-js', get_theme_file_uri() . '/js/myJs/index.js', array('jquery'), '1.1', true);
    //    css
    wp_enqueue_style('modal-animate-css', get_template_directory_uri() . '/css/animate.css', array(), '3.2');
    wp_enqueue_style('carousel-css', get_template_directory_uri() . '/plugin/OwlCarousel/dist/assets/owl.carousel.css', array(), '3.2');
    wp_enqueue_style('auth-css', get_template_directory_uri() . '/css/myCss/auth.css', array(), '3.2');
    //account css
    wp_enqueue_style('account-css', get_template_directory_uri() . '/css/myCss/account.css', array(), '3.2');
    // cart css
    wp_enqueue_style('cart-css', get_template_directory_uri() . '/css/myCss/cart.css', array(), '1.0');
    // collection css
    wp_enqueue_style('collection-css', get_template_directory_uri() . '/css/myCss/collection.css', array(), '1.0');
    // order detail css
    wp_enqueue_style('order-css', get_template_directory_uri() . '/css/order-detail.css', array(), '1.0');
    // time picker
    wp_enqueue_style('bootstrap-timepicker', get_template_directory_uri() . '/css/bootstrap-timepicker.min.css', array(), '1.0');
    // menuzord menu
    // wp_enqueue_style('bootstrap-timepicker', get_template_directory_uri() . '/css/menuzord.css', array(), '1.0');
    wp_enqueue_style('notice-css', get_template_directory_uri() . '/css/myCss/notice.css', array(), '1.0');
    wp_enqueue_style('table-responsive-css', get_template_directory_uri() . '/css/myCss/table-responsive.css', array(), '1.0');
    wp_enqueue_style('header-css', get_template_directory_uri() . '/css/header.css', array(), '1.0');
    wp_enqueue_style('product-css', get_template_directory_uri() . '/css/myCss/product.css', array(), '1.0');
    wp_enqueue_style('slider-css', get_template_directory_uri() . '/css/slider.css', array(), '1.0');
    wp_enqueue_style('video-css', get_template_directory_uri() . '/css/video-js.min.css', array(), '1.0');
    wp_enqueue_style('responsive-css', get_template_directory_uri() . '/css/myCss/responsive.css', array(), '1.0');
    wp_enqueue_style('zoom-css', get_template_directory_uri() . '/css/myCss/zoom.css', array(), '1.0');


    if (is_single()) {
        // single product css single-product.css
        wp_enqueue_style('slick-css', get_template_directory_uri() . '/plugin/slick-master/slick/slick-theme.css', array(), '1.0');
        wp_enqueue_style('single-product', get_template_directory_uri() . '/css/myCss/single-product.css', array(), '1.0');
    }

    if (is_checkout()) {
        wp_enqueue_style('checkout-css', get_template_directory_uri() . '/css/myCss/checkout.css', array(), '1.0');
    }

    if (is_product_category()) {
        wp_enqueue_style('category-css', get_template_directory_uri() . '/css/myCss/category.css', array(), '1.0');
    }
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

function push_to_cat($arrs)
{
    $arrTmp = [];

    foreach ($arrs as $key => $arr) {
        if ($key > 0) {
            array_push($arrTmp, ', ' . '<a href="' . get_term_link($arr->term_id) . '" target="_blank">' . $arr->name . '</a>');
        } else array_push($arrTmp, '<a href="' . get_term_link($arr->term_id) . '" target="_blank">' . $arr->name . '</a>');
    }

    return implode($arrTmp);
}

//add url user js
// wp_register_script( 'my-script', 'myscript_url' );
// wp_enqueue_script( 'my-script' );
// $translation_array = array( 'templateUrl' => get_stylesheet_directory_uri() );
// //after wp_enqueue_script
// wp_localize_script( 'my-script', 'object_name', $translation_array );

?>