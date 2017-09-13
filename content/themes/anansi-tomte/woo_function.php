<?php
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10, 0);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    remove_action('woocommerce_archive_description', 'woocommerce_category_image');
    remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout',20);
    //remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals');

    remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
    add_action( 'woocommerce_after_checkout_form', 'woocommerce_checkout_payment', 20 );
    //add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_order_review', 25 );

remove_action( 'woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_desc_tabs', 'woocommerce_output_product_data_tabs', 10 );


    add_action('woocommerce_after_single_product_summary', 'wl_related_upsell_crosssell_products', 15);
    //add_action('woocommerce_after_shop_loop_item_title', 'wl_woocommerce_rating', 5);
    add_action('woocommerce_before_shop_loop', 'wl_grid_list_viewall', 12);
    add_action('woocommerce_before_shop_loop', 'wl_grid_list_trigger', 11);
    add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 10 );
    add_action('woocommerce_archive_description', 'wl_woocommerce_category_image', 20);
    
    add_action('woocommerce_proceed_to_checkout', 'wl_woocommerce_button_proceed_to_checkout');
    add_action('init','wl_woocommerce_clear_cart_url');
    add_action('magikPvc_single_product_pagination', 'magikPvc_single_product_prev_next');
    add_filter('woocommerce_breadcrumb_defaults','wl_woocommerce_breadcrumbs');

    add_filter('add_to_cart_fragments', 'wl_woocommerce_header_add_to_cart_fragment');
    add_filter('loop_shop_per_page', 'wl_loop_product_per_page');

    function wl_related_upsell_crosssell_products() {
        global $product,$pvc_Options;

        if (isset($product) && is_product()) {
            // Related products Slider
            $related_products = get_option('wlc_product_related');
            if (isset($related_products) && !empty($related_products) && $related_products == "on") { ?> 
                <div class="container">
                    <div class="related-pro">
                        <div class="slider-items-products">
                            <div class="related-block">
                                <div id="related-products-slider" class="product-flexslider hidden-buttons">
                                    <div class="home-block-inner">
                                        <div class="block-title">
                                            <h2><?php esc_attr_e('Related Products', 'pvc'); ?></h2>
                                        </div>
                                    </div>
                                    <div class="slider-items slider-width-col4 products-grid block-content">
                                    <?php
                                        $related = $product->get_related(6);
                                        $args = apply_filters('woocommerce_related_products_args', array(
                                            'post_type' => 'product',
                                            'ignore_sticky_posts' => 1,
                                            'no_found_rows' => 1,
                                            'posts_per_page' => 4,
                                            'orderby' => 'rand',
                                            'post__in' => $related,
                                            'post__not_in' => array($product->id)
                                        ));

                                        $loop = new WP_Query($args);
                                        if ($loop->have_posts()) {
                                            while ($loop->have_posts()) : $loop->the_post();
                                                wl_related_upsell_template();
                                            endwhile;
                                        } else {
                                            esc_attr_e('No products found', 'pvc');
                                        }

                                        wp_reset_postdata();
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <?php }
        }

        //Upsell Product Slider
        $upsells = $product->get_upsells();
        if (sizeof($upsells) == 0) {
        } else { ?>
            <div class="container">
                <div class="upsell-pro">
                    <div class="slider-items-products">
                        <div class="upsell-block">
                            <div id="upsell-products-slider" class="product-flexslider hidden-buttons">
                                <div class="home-block-inner">
                                    <div class="block-title">
                                        <h2><?php esc_attr_e('Upsell Product', 'pvc'); ?></h2>
                                    </div>
                                </div>
                                <div class="slider-items slider-width-col4 products-grid block-content">
                                <?php
                                    $meta_query = WC()->query->get_meta_query();
                                    $args = array(
                                        'post_type' => 'product',
                                        'ignore_sticky_posts' => 1,
                                        'no_found_rows' => 1,
                                        //'posts_per_page' => $pvc_Options['upsell_per_page'],
                                        'orderby' => 'rand',
                                        'post__in' => $upsells,
                                        'post__not_in' => array($product->id),
                                        'meta_query' => $meta_query
                                    );

                                    $loop = new WP_Query($args);
                                    if ($loop->have_posts()) {
                                        while ($loop->have_posts()) : $loop->the_post();
                                            wl_related_upsell_template();
                                        endwhile;
                                    } else {
                                        esc_attr_e('No products found', 'pvc');
                                    }
                                    wp_reset_postdata();
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        //Cross sell Product Slider
        $crosssells = $product->get_cross_sells();
        if (sizeof($crosssells) == 0) {
        } else { ?>
            <div class="container">
                <div class="upsell-pro">
                    <div class="slider-items-products">
                        <div class="upsell-block">
                            <div id="upsell-products-slider" class="product-flexslider hidden-buttons">
                                <div class="home-block-inner">
                                    <div class="block-title">
                                        <h2><?php esc_attr_e('Cross sell Product', 'pvc'); ?></h2>
                                    </div>
                                </div>
                                <div class="slider-items slider-width-col4 products-grid block-content">
                                <?php
                                    $meta_query = WC()->query->get_meta_query();
                                    $args = array(
                                        'post_type' => 'product',
                                        'ignore_sticky_posts' => 1,
                                        'no_found_rows' => 1,
                                        //'posts_per_page' => $pvc_Options['upsell_per_page'],
                                        'orderby' => 'rand',
                                        'post__in' => $crosssells,
                                        'post__not_in' => array($product->id),
                                        'meta_query' => $meta_query
                                    );

                                    $loop = new WP_Query($args);
                                    if ($loop->have_posts()) {
                                        while ($loop->have_posts()) : $loop->the_post();
                                            wl_related_upsell_template();
                                        endwhile;
                                    } else {
                                        esc_attr_e('No products found', 'pvc');
                                    }
                                    wp_reset_postdata();
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    }

    function wl_woocommerce_rating() {
    }

    function wl_grid_list_trigger() { ?>
        <div class="sorter">
            <div class="view-mode"><a href="#" class="grid-trigger button-active button-grid"></a> <a href="#" title="<?php esc_attr_e('List', 'anansi-tomtepvc'); ?>" class="list-trigger  button-list"></a></div>
        </div>
    <?php }

    function wl_grid_list_viewall() { ?>
        <div class="paging hidden-xs">
            <?php if (is_paged()) : ?> 
            <div class="viewall"><a href="../../?view=all"><?php esc_attr_e('View All', 'anansi-tomte'); ?></a></div>
            <?php else: ?>
            <div class="viewall"><a href="?view=all"><?php esc_attr_e('View All', 'anansi-tomte'); ?></a></div>
            <?php endif; ?>
        </div>
    <?php }

    function wl_woocommerce_add_to_compare() {
        global $product, $woocommerce_loop, $yith_wcwl;
        if (class_exists('YITH_Woocompare_Frontend')) {
            $mgk_yith_cmp = new YITH_Woocompare_Frontend;
            $mgk_yith_cmp->add_product_url($product->id); ?>
            <li class="pull-left-none"><a class="compare add_to_compare_small link-compare" data-product_id="<?php echo esc_html($product->id); ?>"
                href="<?php echo esc_url($mgk_yith_cmp->add_product_url($product->id)); ?>" title="<?php esc_attr_e('Add to Compare','anansi-tomte'); ?>"><i class="fa fa-signal icons"></i><?php esc_attr_e('Add to Compare','anansi-tomte'); ?>"></a>
        <?php }
    }

    function wl_woocommerce_category_image() {
        global $product, $pvc_Options;
        if (is_product_category()) :
            global $wp_query;
            $cat = $wp_query->get_queried_object();
            $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
            $image = wp_get_attachment_url($thumbnail_id);
            if ($image) :
                echo '<div class="category-description std"><img src="' . esc_url($image) . '" alt="" /></div>';
            endif;
        endif;
    }

    function wl_woocommerce_add_to_whishlist() {
        global $product, $woocommerce_loop, $yith_wcwl;
        if (isset($yith_wcwl) && is_object($yith_wcwl)) :
            $classes = get_option('yith_wcwl_use_button') == 'yes' ? 'class="link-wishlist"' : 'class="link-wishlist"'; ?>
            <li class="pull-left-none"><a href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>"
                data-product-id="<?php echo esc_html($product->id); ?>"
                data-product-type="<?php echo esc_html($product->product_type); ?>" <?php echo htmlspecialchars_decode($classes); ?>
                title="<?php esc_attr_e('Add to WishList','anansi-tomte'); ?>"><i class="fa fa-heart-o icons"></i><?php esc_attr_e('Add to WishList','anansi-tomte'); ?></a>
            </li>
        <?php
        endif;
    }

    function wl_woocommerce_button_proceed_to_checkout() {
        $checkout_url = WC()->cart->get_checkout_url(); ?>
        <a href="<?php echo esc_url($checkout_url); ?>" class="button btn-proceed-checkout">
            <span><?php esc_attr_e('Proceed to Checkout', 'woocommerce'); ?></span>
        </a>
    <?php
    }

    function wl_woocommerce_clear_cart_url() {
        global $woocommerce;
        if (isset($_REQUEST['clear-cart'])) :
            $woocommerce->cart->empty_cart();
        endif;
    }

    //Filter function are here

    /* Breadcrumbs */
    function wl_woocommerce_breadcrumbs() {
        return array(
            'delimiter' => '',
            'wrap_before' => '<ul xmlns:v="http://rdf.data-vocabulary.org/#">',
            'wrap_after' => '</ul>',
            'before' => '<li>',
            'after' => '<span> &frasl; </span></li>',
            'home' => _x('Home', 'breadcrumb', 'woocommerce'),
        );
    }

function magikPvc_single_product_prev_next() {

    global $woocommerce, $post;

    if (!isset($woocommerce) or !is_single()) :
        return;
    endif; ?>

    <div id="prev-next" class="product-next-prev">
    <?php

    $args = array( 'taxonomy' => 'product_cat');
    $terms = wp_get_post_terms($post->ID,'product_cat', $args);

    if (count($terms) > 0) :
        foreach ($terms as $term) :
            if($counter == 0) :
                $categories = $term->term_id;
            else :
                $categories = $categories .','. $term->term_id;
            endif;
            $counter++;
        endforeach;
    endif;

    $next = magikPvc_prev_next_product_object($post->menu_order, $categories);
    if (!empty($next)): ?>
        <a href="<?php echo esc_url(get_permalink($next->ID)) ?>" class="product-next"><span></span></a>
    <?php endif;

    $prev = magikPvc_prev_next_product_object($post->menu_order, $categories, 'prev');
    if (!empty($prev)): ?>
        <a href="<?php echo esc_url(get_permalink($prev->ID)) ?>" class="product-prev"><span></span></a>
    <?php endif; ?>
    </div>

<?php 
}

function magikPvc_prev_next_product_object($menu_order, $category, $dir = 'next') {
    
    global $wpdb;

    if ($dir == 'prev') :
        $sql = $wpdb->prepare(
            "SELECT DISTINCT wposts.* 
            FROM $wpdb->posts wposts
            LEFT JOIN $wpdb->term_relationships ON (wposts.ID = $wpdb->term_relationships.object_id)
	        LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) 
            WHERE wposts.post_type = '%s' 
            AND wposts.post_status = '%s' 
            AND wposts.menu_order < %d 
            AND $wpdb->term_taxonomy.taxonomy = 'product_cat'
	        AND $wpdb->term_taxonomy.term_id IN($category)
            ORDER BY wposts.menu_order DESC LIMIT 0,1", 'product', 'publish', $menu_order);
    else :
        $sql = $wpdb->prepare(
            "SELECT DISTINCT wposts.*
            FROM $wpdb->posts wposts
            LEFT JOIN $wpdb->term_relationships ON (wposts.ID = $wpdb->term_relationships.object_id)
	        LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id) 
            WHERE wposts.post_type = '%s' 
            AND wposts.post_status = '%s'
            AND wposts.menu_order > %d
            AND $wpdb->term_taxonomy.taxonomy = 'product_cat'
	        AND $wpdb->term_taxonomy.term_id IN($category)
            ORDER BY wposts.menu_order ASC LIMIT 0,1", 'product', 'publish', $menu_order);
    endif;
    $result = $wpdb->get_row($sql);

    if (!is_wp_error($result)):
        if (!empty($result)):
            return $result;
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}

    function wl_woocommerce_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce,$pvc_Options;
        ob_start(); ?>
        <div class="mini-cart">
            <div data-hover="dropdown" class="basket dropdown-toggle"> <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>">
                <span class="price"><?php  esc_attr_e('My Cart','anansi-tomte'); ?></span>
                <span class="cart_count"><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span> </a>
            </div>
        <div>
        <div class="top-cart-content">
            <?php if (sizeof(WC()->cart->get_cart()) > 0) : $i = 0; ?>
                <ul class="mini-products-list" id="cart-sidebar">
                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
                <?php
                    $product_price = 0;
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) :
                        $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(array(80, 160)), $cart_item, $cart_item_key);
                        //$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                        $cnt = sizeof(WC()->cart->get_cart());
                        $rowstatus = $cnt % 2 ? 'odd' : 'even';
                ?>
                    <li class="item<?php if ($cnt - 1 == $i) { ?>last<?php } ?>">
                        <div class="item-inner">
                            <a class="product-image" href="<?php echo esc_url($_product->get_permalink($cart_item)); ?>"  title="<?php echo htmlspecialchars_decode($product_name); ?>"> <?php echo str_replace(array('http:', 'https:'), '', htmlspecialchars_decode($thumbnail)); ?> </a>
                            <div class="product-details">
                                <div class="access">
                                    <a class="btn-edit" title="<?php esc_attr_e('Edit item','anansi-tomte') ;?>" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>">
                                        <i class="icon-pencil"></i><span class="hidden"><?php esc_attr_e('Edit item','anansi-tomte') ;?></span>
                                    </a>
                                    <a href="<?php echo esc_url(WC()->cart->get_remove_url($cart_item_key)); ?>" title="<?php esc_attr_e('Remove This Item','anansi-tomte') ;?>" onClick="" class="btn-remove1"><?php esc_attr_e('Remove','pvc') ;?></a>
                                </div>
                                <strong><?php echo esc_html($cart_item['quantity']); ?></strong> x <!--<span class="price"><?php echo htmlspecialchars_decode($product_price); ?></span>-->
                                <p class="product-name"><a href="<?php echo esc_url($_product->get_permalink($cart_item)); ?>" title="<?php echo htmlspecialchars_decode($product_name); ?>"><?php echo htmlspecialchars_decode($product_name); ?></a></p>
                            </div>
                            <?php echo htmlspecialchars_decode(WC()->cart->get_item_data($cart_item)); ?>
                        </div>
                    </li>
                    <?php endif; ?>
                <?php $i++; endforeach; ?>
            </ul>
            <div class="actions">
                <button class="btn-checkout" title="<?php esc_attr_e('Checkout','anansi-tomte') ;?>" type="button" onClick="window.location.assign('<?php echo esc_js(WC()->cart->get_checkout_url()); ?>')">
                    <span><?php esc_attr_e('Checkout','anansi-tomte') ;?></span> 
                </button>
                <a class="view-cart" type="button" onClick="window.location.assign('<?php echo esc_js(WC()->cart->get_cart_url()); ?>')">
                    <span><?php esc_attr_e('View Cart','anansi-tomte') ;?></span> 
                </a>
            </div>
         <?php else:?>
            <p class="a-center noitem">
                <?php esc_attr_e('Sorry, nothing in cart.', 'anansi-tomte');?>
            </p>
        <?php endif; ?>
        </div>
    </div>
    </div>
    <?php
        $fragments['.mini-cart'] = ob_get_clean();
        return $fragments;
    }

    function WL_loop_product_per_page() {
        global $pvc_Options;

        parse_str($_SERVER['QUERY_STRING'], $params);
        // replace it with theme option
        if (isset($pvc_Options['category_item']) && !empty($pvc_Options['category_item'])) :
            $per_page = explode(',', $pvc_Options['category_item']);
        else :
            $per_page = explode(',', '9,18,27');
        endif;
        $item_count = !empty($params['count']) ? $params['count'] : $per_page[0];
        return $item_count;
    } 

    // Add Delivery field
    function wl_woocommerce_add_custom_fields() {
        woocommerce_wp_text_input( array(
            'id' => '_delivery_field',
            'label' => __( 'Delivery', 'anansi-tomte' ),
            'description' => __( 'Enter the delivery time in days.', 'anansi-tomte' ),
            'desc_tip' => 'true'
        ) );
    }
    add_action( 'woocommerce_product_options_general_product_data', 'wl_woocommerce_add_custom_fields' );

    // Save Delivery field
    function wl_woocommerce_save_custom_fields( $post_id ) {
        update_post_meta( $post_id, '_delivery_field', esc_attr( $_POST['_delivery_field'] ) );
    }
    add_action( 'woocommerce_process_product_meta', 'wl_woocommerce_save_custom_fields' );
    
    // Change message for unavailable measurement
    function wl_woocommerce_change_mpc_price_notice( $message ) {
	    $message = __('The selected measurement is not available for this product, Please contact the store for assistance.','anansi-tomte');
	    return $message;
    }
    add_filter( 'wc_measurement_price_calculator_no_price_available_notice_text', 'wl_woocommerce_change_mpc_price_notice' );

    // Remove Title Table Rate Shipping   
    // function wl_woocommerce_remove_shipping_label($full_label, $method) {
	//     $full_label = str_replace("Staffel: ","",$full_label);
    //     $full_label = str_replace("Staffel","",$full_label);
    //     return $full_label;
    // }
    // add_filter( 'woocommerce_cart_shipping_method_full_label', 'wl_woocommerce_remove_shipping_label', 10, 2 );

    // Remove the "via" text in shipping method
    add_filter( 'wpo_wcpdf_woocommerce_totals', 'wpo_wcpdf_woocommerce_totals', 10, 2 );
    function wpo_wcpdf_woocommerce_totals ( $totals, $order ) {
        if (!isset($totals['shipping'])) :
            return $totals;
        endif;

        $totals['shipping']['value'] =  substr($totals['shipping']['value'], 0, strpos( $totals['shipping']['value'], '<small'));
        return $totals;
    }
    
    // Add VAT suffix to price
    function wl_woocommerce_add_price_suffix( $price, $product ) {
        if ( $product->tax_display_cart == 'excl' ) :
            $price = $price . ' <small class="woocommerce-price-suffix"> ' . __('excl. Vat', 'anansi-tomte') . '</small>';
        else :
            $price = $price . ' <small class="woocommerce-price-suffix"> ' . __('incl. Vat', 'anansi-tomte') . '</small>';
        endif;
        return apply_filters( 'woocommerce_get_price', $price );
    }
    //add_filter( 'woocommerce_get_price_html', 'wl_woocommerce_add_price_suffix', 100, 2 );

    // Change display on product "min price - max price" to "From min price"
    function wl_woocommerce_custom_variation_price( $price, $product ) {
        $price = '';
        if ( !$product->min_variation_price || $product->min_variation_price !== $product->max_variation_price ) :
            $price .= '<span class="from">' . _x('From', 'min_price', 'anansi-tomte') . ' </span>';
			if ( $product->tax_display_cart == 'excl' ) :
				$price .= woocommerce_price($product->get_price_excluding_tax());
			else :
				$price .= woocommerce_price($product->get_price_including_tax());
			endif;
	    endif;
	    return $price;
    }
    add_filter('woocommerce_variable_price_html', 'wl_woocommerce_custom_variation_price', 10, 2);

    //Add Free when shipping = 0
    // add_filter('woocommerce_cart_shipping_method_full_label', 'add_free_label', 10, 2);
    // function add_free_label($label, $method) {
	//     if ($method->cost == 0) {
	// 	    $label .= __( 'Free', 'woocommerce' );
	//     }
	//     return $label;
    // }

    // Remove SKU
    add_filter( 'wc_product_sku_enabled', '__return_false' );    



    function action_woocommerce_email_after_order_table( $array ) { 
        global $woocommerce, $post;
        $order = new WC_Order($post->ID);
        $status = $order->get_status();

        if ($status == 'completed' || $status == 'refunded') :
            echo '<h4>'. __('Rewardpoints','anansi-tomte') .'</h4>';
        endif;
    }; 
         
    // add the action 
    add_action( 'woocommerce_email_after_order_table', 'action_woocommerce_email_after_order_table', 10, 1 );
?>