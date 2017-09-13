<?php
/**
 * Cart Page
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.3.8
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $product, $woocommerce;
$qtyloop=0;
wc_print_notices();

do_action('woocommerce_before_cart'); ?>

<div class="col-main">
    <div class="cart">
        <form action="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" method="post">
        <div class="table-responsive">
           
                <?php do_action('woocommerce_before_cart_table'); ?>
                <fieldset>
                    <table class="data-table cart-table" id="shopping-cart-table">
                        <thead>
                        <tr>
                            <th rowspan="1">&nbsp;</th>
                            <th rowspan="1"><span class="nobr">
                                <?php esc_attr_e('Product Name', 'woocommerce'); ?>
                            </span></th>
                            <th colspan="1" class="a-center"><span class="nobr">
                                <?php esc_attr_e('Price', 'woocommerce'); ?>
                            </span></th>
                            <th></th>
                            <th><?php esc_attr_e('Spaarpunten', 'anansi-tomte'); ?></th>
                            <th class="a-center " rowspan="1"><?php esc_attr_e('Qty', 'woocommerce'); ?></th>
                            <th colspan="1" class="a-center"><?php esc_attr_e('Subtotal', 'woocommerce'); ?></th>
                            <th class="a-center" rowspan="1">&nbsp;</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr class="first last">
                            <td class="a-right last" colspan="50">
                                <button
                                    onclick="location.href = '<?php echo esc_url(get_permalink(woocommerce_get_page_id('shop'))); ?>'"
                                    class="button btn-continue" title="<?php esc_attr_e('Continue Shopping', 'woocommerce'); ?>" type="button"><span><?php esc_attr_e('Continue Shopping', 'pvc'); ?></span>
                                </button>
                                <button type="submit" class="button btn-update" name="update_cart" value="<?php esc_attr_e('Update Cart', 'woocommerce'); ?>"><span>
                                    <?php esc_attr_e('Update Cart', 'woocommerce'); ?>
                                </span></button>
                                <?php do_action('woocommerce_cart_actions'); ?>
                                <?php wp_nonce_field('woocommerce-cart'); ?>
                            </td>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php do_action('woocommerce_before_cart_contents'); ?>
                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                ?>
                                <tr class="<?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                    <td class="image" width="10%"><?php
                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(array(80, 80)), $_product->get_image(), $cart_item, $cart_item_key);
                                        if (!$_product->is_visible())
                                            echo $thumbnail;
                                        else
                                            printf('<a href="%s" class="product-image">%s</a>', esc_url($_product->get_permalink($cart_item)), $thumbnail);
                                        ?>
                                    </td>
                                    <td width="30%">
                                        <?php
                                        if (!$_product->is_visible())
                                            echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                                        else
                                            echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', $_product->get_permalink($cart_item), $_product->get_title()), $cart_item, $cart_item_key);

                                        // Meta data
                                        echo WC()->cart->get_item_data($cart_item);

                                        // Backorder notification
                                        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                                            echo '<p class="backorder_notification">' . esc_html__('This product is not currently out of stock. We will reorder the product directly for you and inform you as soon as possible about the expected delivery time. For more information, please contact us.', 'anansi-tomte') . '</p>';
                                        ?>
                                    </td>
                                    <td class="a-center hidden-table" width="15%"><span class="cart-price"> <span class="price">
                                    <?php
                                        //echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                        //echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, 1), $cart_item, $cart_item_key);
                                        echo $_product->get_price_html();
                                    ?>
                                    </span></span>
                                    </td>
                                    <td width="3%"><?php _e('or'); ?></td>
                                    <td width="10%">                                   
                                    <?php
                                        $price = ($_product->get_price() * $cart_item['quantity']);
                                        $buypoints = round(($price * 2), 0, PHP_ROUND_HALF_UP);
                                    ?>
                                    <span><?php echo $buypoints . ' ' . __('loyalty points', 'anansi-tomte'); ?></span> 
                                    </td>
                                    <td class="a-center movewishlist" width="15%"><?php
                                        if ($_product->is_sold_individually()) {
                                            $product_quantity = sprintf('1 <input type="hidden" class="input-text qty name="cart[%s][qty]" value="1" />', $cart_item_key);
                                        } else {
                                            $product_quantity = woocommerce_quantity_input(array(
                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                'min_value' => '0'
                                            ), $_product, false);
                                        }

                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key);
                                        ?>
                                    </td>
                                    <td class="a-center movewishlist" width="15%"><span class="cart-price"> <span class="price">
                                    <?php
                                    //echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key) . ' ' . __('incl. BTW','anansi-tomte');
                                    echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']) . ' ' . __('incl. BTW','anansi-tomte');
                                    ?>
                                    </span> </span></td>
                                    <td class="a-center last"><?php
                                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="button remove-item" title="%s"><span><span><i class="fa fa-trash"></i></span></span></a>', esc_url(WC()->cart->get_remove_url($cart_item_key)), __('Remove this item', 'woocommerce')), $cart_item_key);
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                        }

                        do_action('woocommerce_cart_contents');
                        ?>
                        <?php do_action('woocommerce_after_cart_contents'); ?>
                        </tbody>
                    </table>
                    <hr/>
                </fieldset>
                 </div>
                <?php do_action('woocommerce_after_cart_table'); ?>

                <?php if (!is_user_logged_in()) : ?>
                <div class="sumo_login_first row">
                    
                    <div class="col-sm-12">
                        <p class="pull-left">
                        <span data-toggle="tooltip" title="<?php _e('With our loyalty system you can build loyalty with the order of certain products and return again in a subsequent order. These loyalty points are worth money!','anansi-tomte'); ?>" class="fa fa-question"></span>
                        <?php _e('In order to earn or redeem loyalty points you should log in first','anansi-tomte'); ?>                      
                        </p>
                        <span style="margin-left:15px;margin-top:-10px;display:inline-block;"> <?php echo do_shortcode( '[loginlink]' ); ?></span>
                    </div>
                </div>
                <?php endif; ?>
                <hr/>
                <div class="sumo_points row">
                    <div class="col-sm-6">
                        <?php if (is_user_logged_in()) : ?>
                        <?php
                            $balance = strip_tags(do_shortcode( '[userpoints]' ));
                            if (!$balance) : 
                                $balance = 0;
                            endif;
                            $redeempoints = strip_tags(do_shortcode( '[redeempoints]' ));
                            if (!$redeempoints) : 
                                $redeempoints = 0;
                            endif;
                            $remainder = $balance - $redeempoints;
                            $totalrewards = strip_tags(do_shortcode('[totalrewards]'));
                        ?>
                        <table class="point-totals">
                            <tr>
                                <td><?php _e('Loyalty points balance (before this order)','anansi-tomte'); ?>:</td>
                                <td><?php echo $balance ?></td>
                            </tr>
                            <tr>
                                <td><?php _e('Redeemed loyalty points in this order','anansi-tomte'); ?>:</td>
                                <td class="border-bottom" id="my_redeemed_points"><?php echo $redeempoints ?></td>
                            </tr>
                            <tr>
                                <td><?php _e('Remainder balance loyalty points','anansi-tomte'); ?>:</td>
                                <td><?php echo $remainder ?></td>
                            </tr>
                            <tr>
                                <td><?php _e('Earning loyaltypoints with this order','anansi-tomte'); ?>:</td>
                                <td class="border-bottom"><?php echo $totalrewards ?></td>
                            </tr>
                            <tr>
                                <td><?php _e('Total balance loyalty points','anansi-tomte'); ?>:</td>
                                <td><strong><?php echo $remainder + $totalrewards ?></strong></td>
                            </tr>
                        </table>
                        <?php endif; ?>       
                    </div>
                    <div class="col-sm-6">
                        <div class="cart-collaterals">
                            <?php woocommerce_cart_totals(); ?>
                        </div>                    
                    </div>

                    <div class="col-xs-12">
                        <hr/>                        
                        <div class="pull-left">
                            <div class="wc-proceed-to-checkout">
                                <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>" class="button"><?php _e('Continue shopping','woocommerce') ?></a>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="wc-proceed-to-checkout">
                                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                            </div>
                        </div>
                    <div>
                </div>

            </form>
       
    </div>
    <!-- begin cart-collaterals-->
    <?php //do_action('woocommerce_cart_collaterals'); ?>
    <!--cart-collaterals-->
    <?php do_action('woocommerce_after_cart'); ?>
</div>