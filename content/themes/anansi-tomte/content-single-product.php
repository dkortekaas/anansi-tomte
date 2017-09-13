<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>
<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */


if (post_password_required()) {
    echo get_the_password_form();
    return;
}
?>

<div class="main-container col1-layout">
    <div class="main">
        <div class="col-main">
            <div class="product-view">
                <div class="product-essential marb30">
                <?php
                    /**
                    * woocommerce_before_single_product hook
                    *
                    * @hooked wc_print_notices - 10
                    */
                    do_action( 'woocommerce_before_single_product' );
                    ?>
                <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="row row-eq-height">
                        <div class="col-sm-9 col-sm-push-3">
                            <div class="full-width productcontent">
                                <div class="colored bordered">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <?php 
                                                $post = get_post();
                                                $terms = get_the_terms( $post->ID, 'product_cat' );                                               
                                                foreach ($terms  as $term  ) :
                                                    //$product_cat_id = $term->term_id;
                                                    $product_cat_name = $term->name;
                                                    break;
                                                endforeach;
                                                echo "<h2 class='breadcrumb'><a href='" . get_category_link( $term->term_id ) . "'>" . $product_cat_name . "</a> / ";
                                                echo "<a href='" . get_permalink( $post->ID ) . "'>" . $post->post_title . "</a></h2>";
                                            ?>
                                        </div>
                                        <div class="row">
                                            <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                                                <?php
                                                /**
                                                * woocommerce_before_single_product_summary hook
                                                *
                                                * @hooked woocommerce_show_product_sale_flash - 10
                                                * @hooked woocommerce_show_product_images - 20
                                                */
                                                do_action('woocommerce_before_single_product_summary');
                                                ?>                                               
                                            </div>
                                            <div class="product-shop col-lg-8 col-sm-7 col-xs-12">
                                                <?php
                                                /**
                                                    * woocommerce_single_product_summary hook
                                                    *
                                                    * @hooked woocommerce_template_single_title - 5
                                                    * @hooked woocommerce_template_single_rating - 10
                                                    * @hooked woocommerce_template_single_price - 10
                                                    * @hooked woocommerce_template_single_excerpt - 20
                                                    * @hooked woocommerce_template_single_add_to_cart - 30
                                                    * @hooked woocommerce_template_single_meta - 40
                                                    * @hooked woocommerce_template_single_sharing - 50
                                                    */
                                                do_action('woocommerce_single_product_summary');

                                                    $product = wc_get_product($post->ID);
                                                    $price = $product->get_price();
                                                    $earnpoints = round(($price / 10), 0, PHP_ROUND_HALF_DOWN);
                                                ?>
                                                <ul class="product-options">
                                                    <?php if($product->is_in_stock()) :
                                                    $stock = $product->get_stock_quantity(); ?>
                                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php printf( esc_html__( 'in stock (%d pieces)', 'anansi-tomte' ), $stock ); ?>
                                                        <?php if ( $stock <= 0) : ?>
                                                        <span data-toggle="tooltip" title="<?php _e('Unfortunately, the product is currently not in stock. Please contact us so we can inform you of the period within which the product is available again.','anansi-tomte'); ?>" class="fa fa-question"></span>
                                                        <?php endif; ?>
                                                    </li>
                                                    <?php else : ?>
                                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php printf( esc_html__( 'out of stock', 'anansi-tomte' ), $stock ); ?></li>
                                                    <?php endif; ?>
                                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php _e('Free shipping from € 75,-', 'anansi-tomte'); ?></li>
                                                    <?php if ($earnpoints == 1) : ?>
                                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php printf( esc_html__( 'Earn %d loyalty point', 'anansi-tomte' ), $earnpoints ); ?>
                                                        <span data-toggle="tooltip" title="<?php _e('This is the number of points you accumulate if you order this product only, checkout as a registered customer and not redeem loyalty points. Therefore, if you order more products, do not checkout as a registered customer awards and / or redeem loyalty points at checkout, the actual number of savings points may differ from the number listed here. No rights can be derived from this number.','anansi-tomte'); ?>" class="fa fa-question"></span>
                                                    </li>
                                                    <?php else : ?>
                                                    <li><i class="fa fa-check" aria-hidden="true"></i> <?php printf( esc_html__( 'Earn %d loyalty points', 'anansi-tomte' ), $earnpoints ); ?>
                                                        <span data-toggle="tooltip" title="<?php _e('This is the number of points you accumulate if you order this product only, checkout as a registered customer and not redeem loyalty points. Therefore, if you order more products, do not checkout as a registered customer awards and / or redeem loyalty points at checkout, the actual number of savings points may differ from the number listed here. No rights can be derived from this number.','anansi-tomte'); ?>" class="fa fa-question"></span>
                                                    </li>
                                                    <?php endif; ?>
                                                </ul>
                                                <?php //wl_product_social_share();?>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="row">
                                                <?php
                                                function ShowLinkToProduct($post_id, $categories_as_array, $label) {
                                                    // get post according post id
                                                    $query_args = array( 'post__in' => array($post_id), 'posts_per_page' => 1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'product_cat',
                                                            'field' => 'id',
                                                            'terms' => $categories_as_array
                                                        )));
                                                    $r_single = new WP_Query($query_args);
                                                    if ($r_single->have_posts()) {
                                                        $r_single->the_post();
                                                        global $product;
                                                    ?>

                                                        <?php if ($label == 'prev') : ?>
                                                        <div class="col-xs-2 pull-left text-left">
                                                            <a class="btn-small" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                                                                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <?php endif; ?>

                                                        <?php if ($label == 'next') : ?>
                                                        <div class="col-xs-2 pull-right text-right">
                                                            <a class="btn-small" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>">
                                                                <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <?php endif; ?>
                                                    <?php
                                                        wp_reset_query();
                                                    }
                                                }
                                                if ( is_singular('product') ) {
                                                    global $post;
                                                    // get categories
                                                    $terms = wp_get_post_terms( $post->ID, 'product_cat' );
                                                    foreach ( $terms as $term ) $cats_array[] = $term->term_id;
                                                    // get all posts in current categories
                                                    $query_args = array('posts_per_page' => -1, 'post_status' => 'publish', 'post_type' => 'product', 'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'product_cat',
                                                            'field' => 'id',
                                                            'terms' => $cats_array
                                                        )));
                                                    $r = new WP_Query($query_args);
                                                    // show next and prev only if we have 3 or more
                                                    if ($r->post_count > 2) {
                                                        $first_product_index = 0;
                                                        $prev_product_id = -1;
                                                        $next_product_id = -1;
                                                        $found_product = false;
                                                        $i = 1;
                                                        $current_product_index = $i;
                                                        $current_product_id = get_the_ID();
                                                        if ($r->have_posts()) {
                                                            while ($r->have_posts()) {
                                                                $r->the_post();
                                                                $current_id = get_the_ID();
                                                                if ($current_id == $current_product_id) {
                                                                    $found_product = true;
                                                                    $current_product_index = $i;
                                                                }
                                                                $is_first = ($current_product_index == $first_product_index);
                                                                if ($is_first) {
                                                                    $prev_product_id = get_the_ID(); // if product is first then 'prev' = last product
                                                                } else {
                                                                    if (!$found_product && $current_id != $current_product_id) {
                                                                        $prev_product_id = get_the_ID();
                                                                    }
                                                                }
                                                                if ($i == 0) { // if product is last then 'next' = first product
                                                                    $next_product_id = get_the_ID();
                                                                }
                                                                if ($found_product && $i == $current_product_index + 1) {
                                                                    $next_product_id = get_the_ID();
                                                                }
                                                                $i++;
                                                            }
                                                            
                                                            if ($prev_product_id != -1) { 
                                                                ShowLinkToProduct($prev_product_id, $cats_array, "prev");
                                                            } else {
                                                                echo '<div class="col-xs-2 pull-left text-left"></div>';
                                                            }
                                                            echo '<div class="col-xs-8 text-center"><div class="btn-small" style="display:inline;"><span>'. $current_product_index .'</span> / <span>'. $r->post_count .'</span></div></div>';
                                                            if ($next_product_id != -1) { 
                                                                ShowLinkToProduct($next_product_id, $cats_array, "next");
                                                            } else {
                                                                echo '<div class="col-xs-2 pull-left text-left"></div>';
                                                            }
                                                            
                                                        }
                                                        wp_reset_query();
                                                    }
                                                }
                                                ?>
                                                <?php do_action('woocommerce_after_single_product'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="full-width productinfo mart30">
                                <div class="product-collateral col-xs-12">
                                    <div class="row">                                        
                                    <?php
                                    /**
                                        * woocommerce_after_single_product_summary hook
                                        *
                                        * @hooked woocommerce_output_product_data_tabs - 10
                                        * @hooked woocommerce_upsell_display - 15
                                        * @hooked woocommerce_output_related_products - 20
                                        */

                                    do_action('woocommerce_after_single_product_summary');
                                    ?>
                                    <?php //do_action('woocommerce_after_single_product'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                            <div class="colored bordered">
                            <?php
                            /**
                                * woocommerce_sidebar hook
                                *
                                * @hooked woocommerce_get_sidebar - 10
                                */
                            do_action('woocommerce_sidebar');
                            ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <meta itemprop="url" content="<?php the_permalink(); ?>"/>
        </div>
    </div>
</div>