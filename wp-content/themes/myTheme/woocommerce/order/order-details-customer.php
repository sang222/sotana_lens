<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">

	<section style="margin-bottom: 30px;" class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
		<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address">

			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>

			<address style="text-transform: capitalize; line-height: 1.8;">
				<?php
					$items = new WC_Order($order->get_id());
					$billingItems = $items->get_data()['billing']
				?>	
				<?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>

				<?php if ( $order->get_billing_phone() ) : ?>
					<div>
						<p class="glyphicon glyphicon-earphone">
							<span><?php echo esc_html( $order->get_billing_phone() ); ?></span>
						</p>
					</div>
				<?php endif; ?>

				<?php if ( $order->get_billing_email() ) : ?>
				<p class="glyphicon glyphicon-envelope d-block" style="text-transform: none;">
					<span><?php echo esc_html( $order->get_billing_email() ); ?></span>
				</p>
				<?php endif; ?>
			</address>


		</div><!-- /.col-1 -->

		

	</section><!-- /.col2-set -->
	<section>
		<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address" style="margin-bottom: 30px;">
			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
			<address style="text-transform: capitalize; line-height: 1.8;">
				<?php //var_dump($order) ?>
				<?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
				<p style="margin: 5px 0"><?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?></p>
			</address>
		</div><!-- /.col-2 -->
	</section>
	<?php 
		$note = new WC_Order($order->get_id());
		if(!empty($note->get_customer_note())) :
	?>
	<section>
		<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address">
			<h2 class="woocommerce-column__title"><?php esc_html_e( 'Note', 'woocommerce' ); ?></h2>
			<address style="text-transform: capitalize; line-height: 1.8;">
				<?php echo $note->get_customer_note() ?>
			</address>
		</div><!-- /.col-2 -->
	</section>
	<?php endif ?>
</section>