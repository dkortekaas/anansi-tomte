<?php
/**
 * Checkout Form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

wc_print_notices();
?>

<?php
do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
    return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters('woocommerce_get_checkout_url', WC()->cart->get_checkout_url()); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url($get_checkout_url); ?>" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-8">
            <div class="colored bordered">
            <?php if (sizeof($checkout->checkout_fields) > 0) : ?>

                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                <div class="col2-set" id="customer_details">
                    <div class="col-1">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>

                    <div class="col-2">
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                    </div>
                </div>

                <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                <?php do_action('woocommerce_after_checkout_form', $checkout); ?>

            <?php endif; ?>
                <span class="orange">*</span> <?php _e('Required Fields', 'anansi-tomte'); ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="colored-brown bordered">
                <h3 id="order_review_heading"><?php _e('My order', 'woocommerce'); ?></h3>

                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>

                <?php if (is_user_logged_in()) : ?>
                <table id="loyalty-points" class="shop_table">
                    <tr>
                        <th><?php _e('Earned loyalty points','anansi-tomte'); ?></th>
                        <td><?php echo strip_tags(do_shortcode('[totalrewards]')) ?></td>
                    </tr>
                </table>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php do_action('woocommerce_checkout_after_order_review'); ?>
        </div>
    </div>
</form>
