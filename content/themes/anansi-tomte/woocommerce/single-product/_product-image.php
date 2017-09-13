<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product,$pvc_Options;

?>

    <div class="product-image">  
        <?php if ($product->is_on_sale()) : ?>
        <div class="sale-label sale-top-left">
            <?php esc_html__('Sale', 'pvc'); ?>
        </div>
        <?php endif; ?>
        <div class="product-full">
        <?php
        if (has_post_thumbnail()) :

            $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
            $image_title = esc_html(get_the_title(get_post_thumbnail_id()));
            $image_link = wp_get_attachment_url(get_post_thumbnail_id(), apply_filters( 'wl-product-size-zoom' ));
            $attachment_count = count($product->get_gallery_attachment_ids());

            if ($attachment_count > 0) :
                $gallery = '[product-gallery]';
            else :
                $gallery = '';
            endif;
            ?>
                      
            <?php echo apply_filters('woocommerce_single_product_image_html', sprintf('<img   src="%s" alt="%s"   id="product-zoom" data-zoom-image="%s" title="%s" />', esc_url($image_link), esc_html($image_alt), esc_url($image_link), esc_html($image_title), __('Placeholder', 'woocommerce')), $post->ID); ?>

        <?php
        else :
                echo apply_filters('woocommerce_single_product_image_html', sprintf('<img   src="%s" alt="%s" />', esc_url(wc_placeholder_img_src()), __('Placeholder', 'woocommerce')), $post->ID);
        endif;
        ?>
        </div>
           
        <?php do_action('woocommerce_product_thumbnails'); ?>
    </div>