<?php

add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');
function register_user_front_end()
{
    $new_user_name = stripcslashes($_POST['new_user_name']);
    $new_user_email = stripcslashes($_POST['new_user_email']);
    $new_user_password = $_POST['new_user_password'];
    $user_nice_name = strtolower($_POST['new_user_email']);
    $user_data = array(
        'user_login' => $new_user_name,
        'user_email' => $new_user_email,
        'user_pass' => $new_user_password,
        'user_nicename' => $user_nice_name,
        'display_name' => $new_user_name,
        'role' => 'subscriber'
    );
    $user_id = wp_insert_user($user_data);
    if (!is_wp_error($user_id)) {
        echo 'we have Created an account for you.';
    } else {
        if (isset($user_id->errors['empty_user_login'])) {
            $notice_key = 'User Name and Email are mandatory';
            echo $notice_key;
        } elseif (isset($user_id->errors['existing_user_login'])) {
            echo 'User name already exixts.';
        } else {
            echo 'Error Occured please fill up the sign up form carefully.';
        }
    }
    die;
}

//login
add_action('wp_ajax_ajaxlogin', 'ajax_login', 0);
add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login');


function ajax_login()
{

    // First check the nonce, if it fails the function will break
    check_ajax_referer('ajax-login-nonce', 'security');

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...')));
    }

    die();
}
// order history
//add_shortcode( 'my_purchased_products', 'bbloomer_products_bought_by_curr_user' );
//
//function bbloomer_products_bought_by_curr_user() {
//
//    // GET CURR USER
//    $current_user = wp_get_current_user();
//    if ( 0 == $current_user->ID ) return;
//
//    // GET USER ORDERS (COMPLETED + PROCESSING)
//    $customer_orders = get_posts( array(
//        'numberposts' => -1,
//        'meta_key'    => '_customer_user',
//        'meta_value'  => $current_user->ID,
//        'post_type'   => wc_get_order_types(),
//        'post_status' => array_keys( wc_get_is_paid_statuses() ),
//    ) );
//    print_r($customer_orders);
//    // LOOP THROU   GH ORDERS AND GET PRODUCT IDS
//    if ( ! $customer_orders ) return;
//    $product_ids = array();
//    foreach ( $customer_orders as $customer_order ) {
//        $order = wc_get_order( $customer_order->ID );
//
//        $items = $order->get_items();
//        foreach ( $items as $item ) {
//
//            $product_id = $item->get_product_id();
//            $product_ids[] = $product_id;
//        }
//    }
//    $product_ids = array_unique( $product_ids );
//    $product_ids_str = implode( ",", $product_ids );
//
//    // PASS PRODUCT IDS TO PRODUCTS SHORTCODE
//    return do_shortcode("[products ids='$product_ids_str']");
//
//}
//?>