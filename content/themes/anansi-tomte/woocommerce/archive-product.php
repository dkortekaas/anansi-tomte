<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $pvc_Options;
get_header('shop');

$plugin_url = plugins_url();

 do_action('woocommerce_before_main_content'); 

/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */

?>

<div class="content-main">
    <div class="row">
        <div class="col-xs-12">
            <div class="colored bordered marb30">
                <?php
                if (is_tax('product_cat')) :
                    $curr_cat = get_queried_object();
                    $cateID = $curr_cat->term_id;
                    $product_parent_categories_all_hierachy = get_ancestors( $curr_cat->term_id, 'product_cat' );  

                    $last_parent_cat = array_slice($product_parent_categories_all_hierachy, -1, 1, true);
                    if (empty($last_parent_cat)) :
                        if( $term = get_term_by( 'id', $cateID, 'product_cat' ) ) :
                            $metaArray = get_option('taxonomy_' . $cateID);
                            if (isset($metaArray)) :
                                $productCatMetaTitle = $metaArray['wl_subtitle'];
                                echo '<h2 class="title-un">' . __('Anansi & Tomte', 'anansi-tomte') . ' ' . $productCatMetaTitle . '</h2>';
                            else :
                                echo '<h2 class="title-un">' . $term->name . '</h2>';
                            endif;
                            echo wpautop($term->description);
                        endif;
                    else :
                        foreach ( $last_parent_cat as $last_parent_cat_value ) :
                            if( $term = get_term_by( 'id', $last_parent_cat_value, 'product_cat' ) ) :
                                $metaArray = get_option('taxonomy_' . $last_parent_cat_value);
                                if (isset($metaArray)) :
                                    $productCatMetaTitle = $metaArray['wl_subtitle'];
                                    echo '<h2 class="title-un">' . __('Anansi & Tomte', 'anansi-tomte') . ' ' . $productCatMetaTitle . '</h2>';
                                else :
                                    echo '<h2 class="title-un">' . $term->name . '</h2>';
                                endif;
                                echo wpautop($term->description);
                            endif;
                        endforeach;
                    endif;
                else :
                    ?>
                    <h2 class="entry-title"><?php esc_html(woocommerce_page_title()); ?></h2>
                    <?php do_action('woocommerce_archive_description');
                endif;
                ?>
            </div>
        </div>
    </div>

    <div class="row row-eq-height grid">

        <div class="sidebar col-sm-3 col-xs-12 sidebar1 hidden-xs">
        
            <div class="colored bordered scrollable">
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

        <div class="col-sm-9 col-xs-12" style="float: right;">
            <div class="colored bordered">          
                <div class="col-main">
                    <div class="display-product-option">
                        <div class="toolbar">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="searchform pull-right">
                                        <?php echo do_shortcode('[yith_woocommerce_ajax_search]');?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            /**
                            * woocommerce_before_shop_loop hook
                            *
                            * @hooked woocommerce_result_count - 20
                            * @hooked woocommerce_catalog_ordering - 30
                            */
                            do_action('woocommerce_before_shop_loop');
                            ?>                   
                        </div>
                    </div>
                <?php if (have_posts()) : ?>
                    <div class="category-products">
                    <?php if(apply_filters('woocommerce_show_page_title', true)) : ?>
                        <h2 class="entry-title"><?php esc_html(woocommerce_page_title()); ?></h2>
                    <?php endif; ?>
                        <?php woocommerce_product_loop_start(); ?>
                        <?php woocommerce_product_subcategories(); ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php wc_get_template_part('content', 'product'); ?>
                        <?php endwhile; // end of the loop. ?>
                        <?php woocommerce_product_loop_end(); ?>
                        <?php
                            /**
                            * woocommerce_after_shop_loop hook
                            *
                            * @hooked woocommerce_pagination - 10
                            */
                        ?>
                        <div class="after-loop">
                        <?php do_action('woocommerce_after_shop_loop'); ?>
                        </div>
                    </div> 
                <?php elseif (!woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>
                    <div class="category-products">
                        <h2 class="entry-title"><?php _e('No products found', 'anansi-tomte') ?></h2>
                        <?php wc_get_template('loop/no-products-found.php'); ?>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="sidebar col-sm-3 col-xs-12 visible-xs sidebar2">
        
            <div class="colored bordered scrollable">
            <?php
            /**
                * woocommerce_sidebar hook
                *
                * @hooked woocommerce_get_sidebar - 10
                */
            dynamic_sidebar( 'sidebar-shop' );
            ?>
            </div>
        </div>
    
    </div>
</div>
<?php
/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');
?>

<?php get_footer('shop'); ?>