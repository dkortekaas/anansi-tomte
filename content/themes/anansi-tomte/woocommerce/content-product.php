<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$MagikPvc = new MagikPvc();
global $product, $woocommerce_loop, $yith_wcwl,$pvc_Options;

// Store loop count we're currently on
if (empty($woocommerce_loop['loop']))
    $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if (empty($woocommerce_loop['columns']))
    $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);

// Ensure visibility
if (!$product || !$product->is_visible())
    return;


// Increase loop count
$woocommerce_loop['loop']++;
if($woocommerce_loop['loop']==1) {
 $pgrid='wide-first'; 
} else {
 $pgrid='wide-next'; 
}

// Extra post classes
$classes = array();
if (is_cart()) {
    $classes[] = 'item col-md-3 col-sm-6 col-xs-12';
} elseif (is_search()) {
    $classes[] = 'item col-lg-3 col-md-3 col-sm-3 col-xs-12 '. $pgrid;
} else {
    $classes[] = 'item col-lg-4 col-md-4 col-sm-4 col-xs-12 '. $pgrid;
}
?>

<li <?php post_class($classes); ?>>

    <div class="product-preview ">
	    <div class="preview">
            <?php do_action('woocommerce_before_shop_loop_item'); ?>
            <a href="<?php the_permalink(); ?>" class="product-image">
            <?php
                /**
                * woocommerce_before_shop_loop_item_title hook
                *
                * @hooked woocommerce_show_product_loop_sale_flash - 10
                * @hooked woocommerce_template_loop_product_thumbnail - 10
                */
                do_action('woocommerce_before_shop_loop_item_title');
                ?>
            </a>
            <?php if ($product->is_on_sale()) : ?>
                <?php echo apply_filters('woocommerce_sale_flash', ' <div class="sale-label sale-top-left">' . esc_html__('Sale', 'woocommerce') . '</div>', $post, $product); ?>
            <?php endif; ?>

            <div class="product-buttons hidden-xs">
                <a href="<?php the_permalink(); ?>" class="quick-view product-btn hidden-xs" title="<?php _e('More info','anansi-tomte'); ?>"><?php _e('More info','anansi-tomte'); ?> ></a>
                <?php
                /**
                * woocommerce_after_shop_loop_item hook
                *
                * @hooked woocommerce_template_loop_add_to_cart - 10
                */
                do_action('woocommerce_after_shop_loop_item');
                ?>
                <?php if (isset($yith_wcwl) && is_object($yith_wcwl)) : ?>
                <a class="addToWishlist product-btn hidden-xs" href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>" data-product-id="<?php echo esc_html($product->id); ?>" data-product-type="<?php echo esc_html($product->product_type); ?>"
                    data-toggle="tooltip" title="<?php esc_attr_e('Add to WishList','anansi-tomte'); ?>?"><img src="<?php echo get_template_directory_uri() ?>/assets/images/wishlist-btn.png" width="35" height="35" />
                </a>
                <?php endif; ?>
		    </div>
	    </div>
	    <div class="product-info">
		    <h3 class="title" itemprop="name">
			    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		    </h3>
			<div class="content_price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">			
                <?php echo $product->get_price_html(); ?>
		    </div>
            <div class="loyalty-points">
                <span class="or"><?php _e('or', 'anansi-tomte'); ?></span>
                <?php
                    $price = $product->get_price();
                    $buypoints = round(($price * 2), 0, PHP_ROUND_HALF_UP);
                ?>
                <span><?php echo $buypoints . ' ' . __('loyalty points', 'anansi-tomte'); ?></span>
            </div>            
	    </div>
    </div>
</li>