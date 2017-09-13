<?php
/**
 * The Template for displaying single services in category.
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();
?>

<div class="content-main woocommerce">
    <div class="row">
        <div class="col-xs-12">
            <div class="colored bordered marb30">
                <?php
                if (is_tax('service_type')) :
                    $curr_cat = get_queried_object();
                    $cateID = $curr_cat->term_id;
                    $service_parent_categories_all_hierachy = get_ancestors( $curr_cat->term_id, 'service_type' );  
                    $last_parent_cat = array_slice($service_parent_categories_all_hierachy, -1, 1, true);
                    if (empty($last_parent_cat)) :
                        if( $term = get_term_by( 'id', $cateID, 'service_type' ) ) :
                            if (isset($term)) :
                                $subtitle = get_field('subtitle', 'service_type_'.$cateID);
                                echo '<h2 class="title-un">Anansi &amp; Tomte ' . $subtitle . '</h2>';
                            else :
                                echo '<h2 class="title-un">Anansi &amp; Tomte ' . $term->name . '</h2>';
                            endif;
                            echo wpautop($term->description);
                        endif;
                    else :
                        echo 'not empty';
                        foreach ( $last_parent_cat as $last_parent_cat_value ) :
                            if( $term = get_term_by( 'id', $last_parent_cat_value, 'service_type' ) ) :
                                //echo "term: ".$term;
                                //$metaArray = get_option('taxonomy_' . $last_parent_cat_value);
                                //var_dump($metaArray);
                                if (isset($term)) :
                                    $subtitle = get_field('subtitle', 'service_type_'.$cateID);
                                    echo '<h2 class="title-un">' . $subtitle . '</h2>';
                                else :
                                    echo '<h2 class="title-un">' . $term->name . '</h2>';
                                endif;
                                echo wpautop($term->description);
                            endif;
                        endforeach;
                    endif;
                else :
                    $servicepost = get_post( 11 );
                    ?>
                    <h2 class="entry-title"><?php echo esc_html($servicepost->post_title); ?></h2>
                    <?php echo apply_filters( 'the_content', $servicepost->post_content );
                endif;                
                ?>
            </div>
        </div>
    </div>

    <div class="row row-eq-height grid">
        <div class="sidebar widget_product_categories col-sm-3 col-xs-12">
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

                        echo '<li class="cat-item cat-item-'.$term->term_id.' cat-parent'. $activeclass .'"><a href="' . get_category_link( $term->term_id ) . '" title="' . $term->name . '">' . $term->name . '</a>';
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
                                    <li class="cat-item cat-item-<?php the_ID(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
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

        <div class="col-sm-9 col-xs-12">
            <div class="colored bordered">
                <div class="col-main">
                    <?php 

                        // $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                        // $args = array(
                        //     'post_type' => 'service',
                        //     'cat' => get_query_var('cat'),
                        //     'orderby' => 'title',
                        //     'order' => 'ASC',
                        //     'posts_per_page' => 12,
                        //     'paged' => $paged
                        // );

                        //$the_query = new WP_Query($args);

                        //if( $the_query->have_posts() ) : ?>
                        <?php if (have_posts()) : ?>
                        <div class="display-product-option">
                            <div class="toolbar">
                                <p class="woocommerce-result-count">
                                    <?php
                                    $paged = max(1, $wp_query->get('paged'));
                                    $per_page = $wp_query->get('posts_per_page');
                                    $total = $wp_query->found_posts;
                                    $first = ($per_page * $paged) - $per_page + 1;
                                    $last = min($total, $wp_query->get('posts_per_page') * $paged);

                                    if (1 == $total) {
                                        _e('Showing the single result', 'woocommerce');
                                    } elseif ($total <= $per_page || -1 == $per_page) {
                                        printf(__('Showing all %d results', 'woocommerce'), $total);
                                    } else {
                                        printf(_x('Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce'), $first, $last, $total);
                                    }
                                    ?>
                                </p>
                                <div class="paging hidden-xs">
                                    <div class="viewall"><a href="?view=all"><?php _e('View All', 'anansi-tomte'); ?></a></div>
                                </div>
                                <form class="woocommerce-ordering" method="get">
                                    <div id="sort-by">
                                        <label class="left"><?php _e('Sort By', 'anansi-tomte'); ?>: </label>
                                        <select name="orderby" class="orderby">
                                            <option value="menu_order"><?php _e('Default sorting', 'woocommerce'); ?></option>
                                            <option value="date" <?php echo ($orderby == 'date') ? 'selected="selected"' : ''; ?>><?php _e('Sort by most recent', 'woocommerce'); ?></option>
                                            <option value="price" <?php echo ($orderby == 'price') ? 'selected="selected"' : ''; ?>><?php _e('Sort by price: high to low', 'woocommerce'); ?></option>
                                            <option value="price-desc" <?php echo ($orderby == 'price-desc') ? 'selected="selected"' : ''; ?>><?php _e('Sort by price: low to high', 'woocommerce'); ?></option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="category-products">
                            <h2 class="entry-title"><?php single_cat_title(); ?></h2>
                            <ul class="products-grid row nano-content">
                            <?php   while (have_posts()) : the_post(); ?>
                                <li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="product-preview">
                                        <div class="preview">
                                            <a href="<?php the_permalink() ?>" class="product-image">
                                            <?php
                                                $serv_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wl-product-size-small');
                                                if ( $serv_img[0] ) : ?>
                                                    <img src="<?php echo $serv_img[0]; ?>" alt="<?php the_title(); ?>" width="230" class="woocommerce-placeholder wp-post-image" height="230">
                                                <?php else : ?>
                                                    <img src="https://www.anansi-tomte.nl/wp-content/plugins/woocommerce/assets/images/placeholder.png" alt="<?php the_title(); ?>" width="230" class="woocommerce-placeholder wp-post-image" height="230">
                                                <?php endif;
                                            ?>
                                            </a>
                                            <div class="product-buttons">
                                                <a href="<?php echo get_permalink( $post->ID ) ?>" class="quick-view product-btn" title="<?php _e('More info','anansi-tomte'); ?>"><?php _e('More info','anansi-tomte'); ?> &gt;</a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <h3 class="title" itemprop="name">
                                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                                            </h3>
                                            <div class="content_price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                                                <?php _e('From', 'anansi-tomte'); ?>
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">&euro;</span> <?php echo number_format_i18n( get_field('price_from'), 2 ); ?>
                                                </span> <?php _e('incl. VAT', 'anansi-tomte'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                            </ul>
                            <div class="after-loop">
                                <?php
                                global $wp_query;

                                if ($wp_query->max_num_pages <= 1) :
                                ?>
                                <div class="woocommerce-pagination pager pages">
                                    <?php
                                       echo paginate_links(array(
                                            'base' => get_pagenum_link(1) . '%_%',
                                            'format' => 'page/%#%',
                                            'current' => max(1, get_query_var('paged')),
                                            'total' => $wp_query->max_num_pages,
                                            'prev_text' => '<div class="page-separator-prev">&laquo;</div>',
                                            'next_text' => '<div class="page-separator-next">&raquo;</div>',
                                            'type' => 'list',
                                            'end_size' => 3,
                                            'mid_size' => 3
                                        ));
                                    ?>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php wp_reset_postdata(); ?>                       
                            <?php endif; ?>
                        </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>