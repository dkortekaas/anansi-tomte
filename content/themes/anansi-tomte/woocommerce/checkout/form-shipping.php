<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
		<h3 id="ship-to-different-address">
			<?php _e( 'Shipping information', 'woocommerce' ); ?>
		</h3>
		
		<p id="ship-to-different-address">
		<label for="ship-to-different-address-checkbox" class="checkbox" style="margin-left:20px;clear:both;"><?php _e( 'Ship to a different address?', 'woocommerce' ); ?>
			<input id="ship-to-different-address-checkbox" class="input-checkbox" style="left:0;top:0;" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
		</label>
		</p>

		<div class="shipping_address">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<?php foreach ( $checkout->checkout_fields['shipping'] as $key => $field ) : ?>

				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

			<?php endforeach; ?>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>

</div>
