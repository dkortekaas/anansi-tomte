<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         http://docs.woothemes.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
    return;
}

?>

<?php
    // Availability
    //$availability      = $product->get_availability();
    //$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

    //echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

    <?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
<div class="add-to-box">
    <form class="cart" method="post" enctype='multipart/form-data'>
        <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

        <?php
            if ( ! $product->is_sold_individually() ) {
                woocommerce_quantity_input( array(
                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
                    'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
                ) );
            }
        ?>

        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

        <button type="submit" class="single_add_to_cart_button button alt button btn-cart"><span><?php echo esc_html( $product->single_add_to_cart_text() ); ?></span></button>

        <?php if (isset($yith_wcwl) && is_object($yith_wcwl)) : ?>
        <a  class="addToWishlist product-btn" href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>" data-product-id="<?php echo esc_html($product->id); ?>" data-product-type="<?php echo esc_html($product->product_type); ?>" <?php echo htmlspecialchars_decode($classes); ?>
            data-toggle="tooltip" title="<?php esc_attr_e('Add to WishList','anansi-tomte'); ?>?"><img src="<?php echo get_template_directory_uri() ?>/assets/images/wishlist-btn.png" width="35" height="35" />
        </a>
        <?php endif; ?>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form>
  </div>

    <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
