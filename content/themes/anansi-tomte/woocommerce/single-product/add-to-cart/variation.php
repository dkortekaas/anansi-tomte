<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see 	https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<script type="text/template" id="tmpl-variation-template">
    <div class="woocommerce-variation-description">
        {{{ data.variation.variation_description }}}
    </div>

    <div class="woocommerce-variation-price">
        <span class="price"><?php _e('Price') ?></span>
        {{{ data.variation.price_html }}}
    </div>

    <div class="woocommerce-variation-max_length" id="max_length">
        {{{ data.variation.max_length }}}
    </div>

    <div class="woocommerce-variation-max_width" id="max_width">
        {{{ data.variation.max_width }}}
    </div>

    <div class="woocommerce-variation-availability">
        {{{ data.variation.availability_html }}}
    </div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
    <p><?php _e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
</script>