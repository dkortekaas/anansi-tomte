<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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

global $post, $product, $woocommerce , $pvc_Options;

$attachment_ids = $product->get_gallery_attachment_ids();

if ($attachment_ids) :
    $loop = 0;
    $columns = apply_filters('woocommerce_product_thumbnails_columns', 3);
    ?>
                 
    <div class="more-views">
        <div class="slider-items-products">
            <div  id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                <div class="slider-items slider-width-col4 block-content">
                <?php
                if( $loop==0) :
                    $classes = array('cloud-zoom-gallery');

                    if ($loop == 0 || $loop % $columns == 0)
                        $classes[] = 'first';

                    if (($loop + 1) % $columns == 0)
                        $classes[] = 'last';

                        $attachment_id=get_post_thumbnail_id();
                        $image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
                        $image_link = wp_get_attachment_url(get_post_thumbnail_id());
                        $image = get_the_post_thumbnail($post->ID, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'), array(
                            'title' => $image_title
                        ));

                        $image_class = esc_attr(implode(' ', $classes));

                        $rel="useZoom: 'zoom1', smallImage: '".$image_link."'";

                        echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<div class="more-views-items"><a id="product-zoom" href="%s" class="%s" title="%s" rel="%s"  data-image="%s" data-zoom-image="%s" >%s</a></div>', esc_html($image_link), $image_class, esc_html($image_title), $rel,esc_html($image_link),esc_html($image_link), $image), $attachment_id, $post->ID, $image_class);
                        $loop++;
                endif;

                foreach ($attachment_ids as $attachment_id) :

                    $classes = array('cloud-zoom-gallery');

                    if ($loop == 0 || $loop % $columns == 0)
                        $classes[] = 'first';

                    if (($loop + 1) % $columns == 0)
                        $classes[] = 'last';

                    $image_link = wp_get_attachment_url($attachment_id);

                    if (!$image_link)
                        continue;

                    $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'shop_thumbnail'));
                    $image_class = esc_html(implode(' ', $classes));
                    $image_title = esc_html(get_the_title($attachment_id));
                    $rel="useZoom: 'zoom1', smallImage: '".$image_link."'";
                    echo apply_filters('woocommerce_single_product_image_thumbnail_html', sprintf('<div class="more-views-items"><a id="product-zoom" href="%s" class="%s" title="%s" rel="%s" data-image="%s" data-zoom-image="%s">%s</a></div>', esc_html($image_link), $image_class, esc_html($image_title), $rel,esc_html($image_link),esc_html($image_link),$image), $attachment_id, $post->ID, $image_class);
                    ?>
          
                    <?php
                    $loop++;
                endforeach;

                ?>
                </div>
            </div>
        </div>
    </div>
    <?php  endif;
?>