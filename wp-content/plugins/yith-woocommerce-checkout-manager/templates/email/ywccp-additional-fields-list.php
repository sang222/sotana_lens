<?php
/**
 * Additional Fields List for order email
 *
 * @since 1.0.0
 * @author Francesco Licandro
 * @context email
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<h2><?php _e( 'Additional info', 'yith-woocommerce-checkout-manager' ); ?></h2>
<ul>
	<?php foreach ( $fields as $field ) : ?>
		<li><strong><?php echo wp_kses_post( $field['label'] ); ?>:</strong> <span class="text"><?php echo wp_kses_post( $field['value'] ); ?></span></li>
	<?php endforeach; ?>
</ul>