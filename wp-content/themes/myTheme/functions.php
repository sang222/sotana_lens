<?php
//theme option
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
add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_breadcrumb_main_term', 'change_breadcrumb' );
function change_breadcrumb( $main_term ) {
    var_dump( $main_term );

    return $main_term;
}
//disble warning Yith checkout
add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false');
add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );
// Remove Order Notes Field
add_filter( 'woocommerce_checkout_fields' , 'remove_order_notes' );

function remove_order_notes( $fields ) {
    unset($fields['order']['order_comments']);
    return $fields;
}
function add_theme_scripts()
{
    wp_enqueue_script('jquery-js', get_theme_file_uri() . '/js/jquery-2.2.4.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap-datepicker', get_theme_file_uri() . '/js/bootstrap-datepicker.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap-timepicker', get_theme_file_uri() . '/js/bootstrap-timepicker.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('scrollToFixed', get_theme_file_uri() . '/js/jquery-scrolltofixed-min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('wow-js', get_theme_file_uri() . '/js/wow.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap-js', get_theme_file_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('main-js', get_theme_file_uri() . '/js/myJs/index.js', array('jquery'), '1.1', true);
    wp_enqueue_script('ajax-cart', get_theme_file_uri() . '/js/myJs/ajaxCart.js', array('jquery'), '1.0', true);
    wp_enqueue_script('ajax-modal-js', get_theme_file_uri() . '/js/myJs/ajaxModalProduct.js', array('jquery'), '1.1', true);
    wp_enqueue_script('account-js', get_theme_file_uri()  . '/js/myJs/account.js', array('jquery'), '1.0', true);
    if (is_single()) {
        wp_enqueue_script('slick-js', get_theme_file_uri() . '/plugin/slick-master/slick/slick.js', array('jquery'), '1.1', true);
        wp_enqueue_script('single-product-js', get_theme_file_uri() . '/js/myJs/single-product.js', array('jquery'), '1.0', true);

    }

    wp_enqueue_script('auth-js', get_theme_file_uri() . '/js/myJs/auth.js', array('jquery'), '1.1', true);

    //plugin

    wp_enqueue_script('carousel-js', get_theme_file_uri() . '/plugin/OwlCarousel/dist/owl.carousel.min.js', array('jquery'), '1.1', true);

//    wp_enqueue_script('zoom-plugin-js', get_theme_file_uri('/plugin/zoom-master/jquery.zoom.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('zoom-plugin-js', get_theme_file_uri() . '/plugin/elevatezoom-master/jquery.elevatezoom.js', array('jquery'), '1.0', true);


    //    css
    wp_enqueue_style('modal-animate-css',get_template_directory_uri() . '/css/animate.css', array(), '3.2');
    wp_enqueue_style('carousel-css', get_template_directory_uri() . '/plugin/OwlCarousel/dist/assets/owl.carousel.css', array(), '3.2');
    wp_enqueue_style('auth-css', get_template_directory_uri() . '/css/myCss/auth.css', array(), '3.2');
    //account css
    wp_enqueue_style('account-css', get_template_directory_uri() . '/css/myCss/account.css', array(), '3.2');
    // cart css
    wp_enqueue_style('cart-css', get_template_directory_uri() . '/css/myCss/cart.css', array(), '1.0');
    // collection css
    wp_enqueue_style('collection-css', get_template_directory_uri() . '/css/myCss/collection.css', array(), '1.0');
    // time picker
    wp_enqueue_style('bootstrap-timepicker', get_template_directory_uri() . '/css/bootstrap-timepicker.min.css', array(), '1.0');
    // menuzord menu
    // wp_enqueue_style('bootstrap-timepicker', get_template_directory_uri() . '/css/menuzord.css', array(), '1.0');
    wp_enqueue_style('notice-css', get_template_directory_uri() . '/css/myCss/notice.css', array(), '1.0');
    if (is_single()) {
        // single product css single-product.css
        wp_enqueue_style('slick-css', get_template_directory_uri() . '/plugin/slick-master/slick/slick-theme.css', array(), '1.0');
        wp_enqueue_style('single-product', get_template_directory_uri() . '/css/myCss/single-product.css', array(), '1.0');
    }

}

add_action('wp_enqueue_scripts', 'add_theme_scripts');
/** Disable Ajax Call from WooCommerce */
//add_action('wp_enqueue_scripts', 'dequeue_woocommerce_cart_fragments', 11);
//function dequeue_woocommerce_cart_fragments()
//{
//    if (is_front_page()) wp_dequeue_script('wc-cart-fragments');
//}

//add_filter('woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_loop_ajax_add_to_cart', 10, 2);
//function quantity_inputs_for_loop_ajax_add_to_cart($html, $product)
//{
//    if ($product && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock() && !$product->is_sold_individually()) {
//        // Get the necessary classes
//        $class = implode(' ', array_filter(array(
//            'button',
//            'product_type_' . $product->get_type(),
//            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
//            $product->supports('ajax_add_to_cart') ? 'ajax_add_to_cart' : '',
//        )));
//
//        // Adding embeding <form> tag and the quantity field
//        $html = sprintf('%s%s<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>%s',
//            '<form class="cart">',
//            woocommerce_quantity_input(array(), $product, false),
//            esc_url($product->add_to_cart_url()),
//            esc_attr(isset($quantity) ? $quantity : 1),
//            esc_attr($product->get_id()),
//            esc_attr($product->get_sku()),
//            esc_attr(isset($class) ? $class : 'button'),
//            esc_html($product->add_to_cart_text()),
//            '</form>'
//        );
//    }
//    return $html;
//}

// update mini
