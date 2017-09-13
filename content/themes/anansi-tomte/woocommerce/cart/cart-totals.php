<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div class="cart_totals totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

    <?php do_action( 'woocommerce_before_cart_totals' ); ?>

    <h2><?php _e( 'Cart Totals', 'woocommerce' ); ?></h2>

    <table cellspacing="0" class="shop_table shop_table_responsive">

        <tr class="cart-subtotal">
            <th><?php _e( 'Subtotal', 'woocommerce' ); ?></th>
            <td class="amount" data-title="<?php _e( 'Subtotal', 'woocommerce' ); ?>"><?php echo WC()->cart->get_cart_subtotal(); ?> <?php _e('incl. BTW','anansi-tomte'); ?></td>
        </tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>        

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<!--
            <tr class="shipping">
                <th style="font-weight:700 !important;"><?php //_e( 'Shipping', 'woocommerce' ); ?></th>
				<?php //if (strpos(WC()->cart->get_cart_shipping_total(), 'Free') !== false || strpos(WC()->cart->get_cart_shipping_total(), 'Gratis') !== false || strpos(WC()->cart->get_cart_shipping_total(), 'Frei') !== false) : ?>
					<td class="amount" style="font-weight:700 !important;" data-title="<?php //_e( 'Shipping', 'woocommerce' ); ?>"><?php //echo WC()->cart->get_cart_shipping_total(); ?></td>
				<?php //else : ?>
					<td class="amount" style="font-weight:700 !important;" data-title="<?php //_e( 'Shipping', 'woocommerce' ); ?>"><?php //echo WC()->cart->get_cart_shipping_total(); ?> <?php //_e('incl. BTW','anansi-tomte'); ?></td>
				<?php //endif;?>
            </tr>
			-->	

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && 'excl' === WC()->cart->tax_display_cart ) : ?>
			<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th><?php echo esc_html( $tax->label ); ?></th>
						<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
					<td><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="order-total">
			<th><?php _e( 'TOTAL', 'woocommerce' ); ?></th>
			<td style="border-top:1px solid #42210B !important;font-weight:700 !important;padding:6px;">
				<?php echo wp_kses_data( WC()->cart->get_total() ) . ' ' . __('incl. BTW','anansi-tomte'); ?>
			</td>
		</tr>
		<tr><td colspan="2"></td></tr>

        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
            <tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
                <!--<th><?php //echo esc_html( $tax->label ) . $estimated_text; ?></th>-->
				<th><?php echo esc_html( $tax->label ); ?></th>
                <td class="amount" style="padding-right:75px;" data-title="<?php echo esc_html( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
            </tr>
        <?php endforeach; ?>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

        <tr class="order-loyalty-points">
            <?php if (is_user_logged_in()) : ?>
            <th><?php _e('Earned loyalty points','anansi-tomte'); ?></th>
            <?php else : ?>
            <th><span data-toggle="tooltip" title="<?php _e('With this order you can earn loyalty points. If you wish to make use of them, you must first log in via \'my account\'.','anansi-tomte'); ?>" class="fa fa-question"></span> <?php _e('Log in and earn these loyalty points','anansi-tomte'); ?> </th>
            <?php endif; ?>
            <td style="vertical-align:middle;padding-right:93px;" data-title="<?php _e('Earned loyalty points','anansi-tomte'); ?>"><?php echo do_shortcode('[totalrewards]') ?></td>
        </tr>

        <?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

    </table>

    <?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
