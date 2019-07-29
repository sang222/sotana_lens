<?php
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');

function custom_override_checkout_fields($fields)
{
//    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
//    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
//    unset($fields['billing']['billing_state']);
//    unset($fields['billing']['billing_phone']);
//    unset($fields['order']['order_comments']);
//    unset($fields['billing']['billing_email']);
//    unset($fields['account']['account_username']);
//    unset($fields['account']['account_password']);
//    unset($fields['account']['account_password-2']);
    return $fields;
}

//Change label
add_filter('woocommerce_checkout_fields', 'misha_labels_placeholders', 9999);

function misha_labels_placeholders($f)
{

    // first name can be changed with woocommerce_default_address_fields as well
    $f['billing']['billing_first_name']['label'] = 'Tên của bạn';
    $f['billing']['billing_first_name']['placeholder'] = 'Nhập tên';
    // Change address
    $f['billing']['billing_address_1']['label'] = 'Địa chỉ';
    $f['billing']['billing_address_1']['placeholder'] = 'Nhập địa chỉ';
    // Change Phone
    $f['billing']['billing_phone']['label'] = 'Phone';
    $f['billing']['billing_phone']['placeholder'] = 'Nhập số điện thoại';
    //Change email
    $f['billing']['billing_email']['label'] = 'Email';
    $f['billing']['billing_email']['placeholder'] = 'Nhập Email';
    return $f;

}
//Change Billing detail
function wc_billing_field_strings($translated_text, $text, $domain)
{
    switch ($translated_text) {
        case 'Billing details' :
            $translated_text = __('Proceed to payment', 'shop-glass');
            break;
        case 'Your order' :
            $translated_text = __('', 'shop-glass');
            break;
    }
    return $translated_text;
}

add_filter('gettext', 'wc_billing_field_strings', 20, 3);
//end Chage label
///**
// * Add the field to the checkout page
// */
//add_action('woocommerce_after_order_notes', 'customise_checkout_field');
//function customise_checkout_field($checkout)
//{
//    echo '<div id="customise_checkout_field"><h2>' . __('Heading') . '</h2>';
//    woocommerce_form_field('customised_field_name', array(
//        'type' => 'text',
//        'class' => array(
//            'my-field-class form-row-wide'
//        ),
//        'label' => __('Customise Additional Field'),
//        'placeholder' => __('Guidence'),
//        'required' => true,
//    ), $checkout->get_value('customised_field_name'));
//    echo '</div>';
//}
//
//add_action('woocommerce_checkout_process', 'customise_checkout_field_process');
//function customise_checkout_field_process()
//{
//    // if the field is set, if not then show an error message.
//    if (!$_POST['customised_field_name']) wc_add_notice(__('Please enter value.'), 'error');
//}
//
//add_action('woocommerce_checkout_update_order_meta', 'customise_checkout_field_update_order_meta');
//function customise_checkout_field_update_order_meta($order_id)
//{
//    if (!empty($_POST['customised_field_name'])) {
//        update_post_meta($order_id, 'Some Field', sanitize_text_field($_POST['customised_field_name']));
//    }
//}
//
//// add fild name
//add_filter( 'woocommerce_checkout_fields' , 'woocommerce_checkout_field_editor' );
//// Our hooked in function - $fields is passed via the filter!
//function woocommerce_checkout_field_editor( $fields ) {
//    $fields['shipping']['shipping_field_value'] = array(
//        'label'     => __('Field Value', 'woocommerce'),
//        'placeholder'   => _x('Field Value', 'placeholder', 'woocommerce'),
//        'required'  => true
//    );
//    return $fields;
//}