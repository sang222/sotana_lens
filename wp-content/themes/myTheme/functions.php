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

function add_theme_scripts()
{
    wp_enqueue_script('jquery-js', get_theme_file_uri('/js/jquery-2.2.4.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('bootstrap-js', get_theme_file_uri('/js/bootstrap.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('main-js', get_theme_file_uri('/js/myJs/index.js'), array('jquery'), '1.1', true);
    wp_enqueue_script('ajax-cart', get_theme_file_uri('/js/myJs/ajaxCart.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('ajax-modal-js', get_theme_file_uri('/js/myJS/ajaxModalProduct.js'), array('jquery'), '1.1', true);
    wp_enqueue_script('account-js', get_theme_file_uri('/js/myJs/account.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('auth-js', get_theme_file_uri('/js/myJs/auth.js'), array('jquery'), '1.1', true);

    //plugin
    wp_enqueue_script('zoom-image', get_theme_file_uri('/js/myJs/zoom.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('carousel-js', get_theme_file_uri('/plugin/OwlCarousel/dist/owl.carousel.min.js'), array('jquery'), '1.1', true);


    //    css
    wp_enqueue_style('modal-animate-css', get_template_directory_uri() . 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css', array(), '3.2');
    wp_enqueue_style('carousel-css', get_template_directory_uri() . '/plugin/OwlCarousel/dist/assets/owl.carousel.css', array(), '3.2');
    wp_enqueue_style('auth-css', get_template_directory_uri() . '/css/myCss/auth.css', array(), '3.2');
    //account css
    wp_enqueue_style('account-css', get_template_directory_uri() . '/css/myCss/account.css', array(), '3.2');
    // cart css
    wp_enqueue_style('cart-css', get_template_directory_uri() . '/css/myCss/cart.css', array(), '1.0');
    // collection css
    wp_enqueue_style('collection-css', get_template_directory_uri() . '/css/myCss/collection.css', array(), '1.0');
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
