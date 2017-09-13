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

<div class="main-container col1-layout woocommerce">
    <div class="main">
        <div class="col-main">
            <div class="product-view">
                <div class="product-essential marb30">
                    <div itemscope itemtype="service" id="service-<?php the_ID(); ?>" <?php post_class('service product'); ?>>
                        <div class="row row-eq-height">
                            <div class="col-sm-9 col-sm-push-3">
                                <div class="full-width">
                                    <div class="colored bordered">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <?php 
                                                    $post = get_post();
                                                    $CurPostID = $post->ID;
                                                    $primary_term = get_post_meta( $post_ID, WPSEO_Meta::$meta_prefix . 'primary_' . 'service_type', true ); 
                                                    $terms = get_the_terms( $post->ID, 'service_type' );

                                                    foreach ($terms  as $term  ) :
                                                        $service_cat_name = $term->name;
                                                        $cateID = $term->term_id;
                                                        break;
                                                    endforeach;
                                                    echo "<h2 class='breadcrumb'><a href='" . get_category_link( $term->term_id ) . "'>" . $service_cat_name . "</a> / ";
                                                    echo "<a href='" . get_permalink( $post->ID ) . "'>" . $post->post_title . "</a></h2>";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                                                <div class="images">
                                                    <?php
                                                        if ( has_post_thumbnail() ) {
                                                            $attachment_count = count( get_children( array( 'post_parent' => $post->ID ) ) );
                                                            $gallery          = $attachment_count > 0 ? '[service-gallery]' : '';
                                                            $props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
                                                            $image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                                                                'title'	 => $props['title'],
                                                                'alt'    => $props['alt'],
                                                            ) );
                                                            echo apply_filters(
                                                                'woocommerce_single_product_image_html',
                                                                sprintf(
                                                                    '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
                                                                    esc_url( $props['url'] ),
                                                                    esc_attr( $props['caption'] ),
                                                                    $gallery,
                                                                    $image
                                                                ),
                                                                $post->ID
                                                            );
                                                        } else {
                                                            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
                                                        }
                                                    ?>

                                                    <?php 
                                                    $images = get_field('servicegalery');
                                                    $counter = 0;
                                                    if( $images ): ?>
                                                        <div class="thumbnails columns-3">
                                                        <?php foreach( $images as $image ):
                                                            $firstclass = ($counter == 0) ? ' first' : '';
                                                        ?>
                                                            <a href="<?php echo $image['url']; ?>" class="zoom<?php echo $firstclass ?>" title="" data-rel="prettyPhoto[service-gallery]">
                                                                <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
                                                            </a>
                                                        <?php $counter++; ?>
                                                        <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="product-shop col-lg-8 col-sm-7 col-xs-12">
                                                <div class="product-name">
                                                    <h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
                                                </div>                 
                                                <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer" class="price-block">
                                                    <div class="price-box price">
                                                        <?php _e('From', 'anansi-tomte'); ?>
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">&euro;</span> <?php echo number_format_i18n( get_field('price_from'), 2 ); ?>
                                                        </span> <?php _e('incl. VAT', 'anansi-tomte'); ?>
                                                    </div>
                                                    <meta itemprop="price" content="<?php echo number_format_i18n( get_field('price_from'), 2 ); ?>">
                                                    <meta itemprop="priceCurrency" content="EUR">
                                                </div>
                                                <?php the_content(); ?>
                                            </div>
                                            <a href="" title="<?php _e('Contact','anansi-tomte'); ?>" class="button product-register pull-right"><?php _e('Register','anansi-tomte'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="full-width mart30">
                                    <?php if ( get_field('more_info') || get_field('calendar_register') || get_field('executor') ) : ?>
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="add_info">
                                                <div class="woocommerce-tabs">
                                                    <div class="tabs">
                                                        <ul class="tabs nav nav-tabs service-tabs" id="service-detail-tab" role="tablist">
                                                            <?php if ( get_field('more_info') ) : ?>
                                                            <li role="presentation" class="more_information_tab">
                                                                <a href="#tab-more-information" aria-controls="tab-more-information" role="tab" data-toggle="tab">
                                                                    <?php _e('More information') ?>
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <?php if ( get_field('calendar_register') ) : ?>
                                                            <li role="presentation" class="calendar_register_tab">
                                                                <a href="#tab-calendar-register" aria-controls="tab-calendar-register" role="tab" data-toggle="tab">
                                                                    <?php _e('Calendar & Register') ?>
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                            <?php if ( get_field('executor') ) : ?>
                                                            <li role="presentation" class="executor_tab">
                                                                <a href="#tab-executor" aria-controls="tab-executor" role="tab" data-toggle="tab">
                                                                    <?php _e('Executor') ?>
                                                                </a>
                                                            </li>
                                                            <?php endif; ?>
                                                        </ul>

                                                        <div id="serviceTabContent" class="tab-content colored bordered">
                                                            <?php if ( get_field('more_info') ) : ?>
                                                            <div role="tabpanel" class="tab-pane panel entry-content" id="tab-more-information">
                                                                <?php the_field('more_info') ?>
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if ( get_field('calendar_register') ) : ?>
                                                            <div role="tabpanel" class="tab-pane panel entry-content" id="tab-calendar-register">
                                                                <?php the_field('calendar_register') ?>
                                                                <span class="orange">*</span> <?php _e('Required Fields', 'anansi-tomte'); ?>
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if ( get_field('executor') ) : ?>
                                                            <div role="tabpanel" class="tab-pane panel entry-content" id="tab-executor">
                                                                <?php the_field('executor') ?>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="sidebar widget_product_categories col-sm-3 col-xs-12 col-sm-pull-9">
                                <div class="colored bordered">
                                <?php 
                                $terms = get_terms( 'service_type' );
                                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                                    echo '<h4 class="block-title">'. __('Categories', 'anansi-tomte') .'</h4>';
                                    echo '<ul class="product-categories">';
                                    foreach ( $terms as $term ) :
                                        $term_link = get_term_link( $term );
                                        if ( is_wp_error( $term_link ) ) :
                                            continue;
                                        endif;

                                        $activeclass = '';
                                        if ( $term->term_id == $cateID ) :
                                            $activeclass = ' current-cat';
                                        endif;

                                        echo '<li class="cat-item cat-item-'.$term->term_id.' cat-parent'. $activeclass .'"><a href="' . esc_url( $term_link ) . '" title="' . $term->name . '">' . $term->name . '</a>';
                                            echo '<ul class="children">';
                                            global $post;
 
                                            $args = array(
                                                'post_type' => 'service',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'service_type',
                                                        'field' => 'id',
                                                        'terms' => $term->term_id
                                                    )
                                                )
                                            );
                                            $query = new WP_Query( $args );
                                            if ( $query->have_posts() ) :
                                                while ( $query->have_posts() ) : $query->the_post(); ?>
                                                <?php $activeproduct = '';
                                                    if ( $CurPostID == get_the_ID() ) :
                                                        $activeproduct = ' current-cat';
                                                    endif; ?>

                                                    <li class="cat-item cat-item-<?php the_ID(); ?><?php echo $activeproduct ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                                <?php endwhile;
                                            endif;
                                            wp_reset_postdata();
                                            echo '</ul>';
                                        echo '</li>';
                                    endforeach;
                                    echo '</ul>';
                                endif;
                                ?>
                                </div>
  
                            </div>
                        </div>

                    </div>
                </div>
                <meta itemprop="url" content="<?php the_permalink(); ?>"/>
            </div>
        </div>
        <div class="row">
            <div class="product-collateral col-xs-12">
            <?php
            /**
                * woocommerce_after_single_product_summary hook
                *
                * @hooked woocommerce_output_product_data_tabs - 10
                * @hooked woocommerce_upsell_display - 15
                * @hooked woocommerce_output_related_products - 20
                */

            ?>
        </div>
    </div>
</div>