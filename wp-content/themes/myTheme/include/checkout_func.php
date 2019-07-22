<?php
/**
 * Add the field to the checkout page
 */
add_action('woocommerce_after_order_notes', 'customise_checkout_field');
function customise_checkout_field($checkout)
{
    echo '<div id="customise_checkout_field"><h2>' . __('Heading') . '</h2>';
    woocommerce_form_field('customised_field_name', array(
        'type' => 'text',
        'class' => array(
            'my-field-class form-row-wide'
        ),
        'label' => __('Customise Additional Field'),
        'placeholder' => __('Guidence'),
        'required' => true,
    ), $checkout->get_value('customised_field_name'));
    echo '</div>';
}

add_action('woocommerce_checkout_process', 'customise_checkout_field_process');
function customise_checkout_field_process()
{
    // if the field is set, if not then show an error message.
    if (!$_POST['customised_field_name']) wc_add_notice(__('Please enter value.'), 'error');
}

add_action('woocommerce_checkout_update_order_meta', 'customise_checkout_field_update_order_meta');
function customise_checkout_field_update_order_meta($order_id)
{
    if (!empty($_POST['customised_field_name'])) {
        update_post_meta($order_id, 'Some Field', sanitize_text_field($_POST['customised_field_name']));
    }
}

// add fild name
add_filter( 'woocommerce_checkout_fields' , 'woocommerce_checkout_field_editor' );
// Our hooked in function - $fields is passed via the filter!
function woocommerce_checkout_field_editor( $fields ) {
    $fields['shipping']['shipping_field_value'] = array(
        'label'     => __('Field Value', 'woocommerce'),
        'placeholder'   => _x('Field Value', 'placeholder', 'woocommerce'),
        'required'  => true
    );
    return $fields;
}