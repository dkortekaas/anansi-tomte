<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price-block">
    <div class="price-box price<?php echo $addclass ?>">
        <?php echo $product->get_price_html(); ?>
    </div>
    <div class="loyalty-points">
        <span class="or">of</span>
        <?php
            $price = $product->get_price();
            $buypoints = round(($price * 2), 0, PHP_ROUND_HALF_UP);
        ?>
        <span><?php echo $buypoints . ' ' . __('loyalty points', 'anansi-tomte'); ?></span>    
    </div>
    <?php if(get_post_meta( get_the_ID(), '_delivery_field', true )) :
        echo '<p class="delivery"><strong>' . __('Delivery', 'anansi-tomte') . ' ' . get_post_meta( get_the_ID(), '_delivery_field', true ) . ' ' . __('days', 'anansi-tomte') .'</strong></p>';
    endif;?>
    <meta itemprop="price" content="<?php echo esc_attr( $product->get_price() ); ?>" />
    <meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>"/>
    <link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? __('InStock', 'anansi-tomte') : __('OutOfStock', 'anansi-tomte'); ?>"/>
</div>