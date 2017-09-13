<?php
    global $yith_wcwl, $product;
    $posttype = get_post_type( get_the_ID() );
?>

<li id="post-<?php the_ID(); ?>"  class="item col-lg-3 col-md-3 col-sm-3 col-xs-6">
    <div class="product-preview" style="min-height:410px;">
	    <div class="preview">
            <a href="<?php the_permalink(); ?>" class="product-image">
                <?php if( $posttype == 'product' ) : ?>
                <?php
                    do_action('woocommerce_before_shop_loop_item_title');
                ?>
                <?php else : ?>
                <?php
                    $serv_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'wl-product-size-small');
                    if ( $serv_img[0] ) : ?>
                        <img src="<?php echo $serv_img[0]; ?>" alt="<?php the_title(); ?>" width="230" class="woocommerce-placeholder wp-post-image" height="230">
                    <?php else : ?>
                        <img src="https://www.anansi-tomte.nl/wp-content/plugins/woocommerce/assets/images/placeholder.png" alt="<?php the_title(); ?>" width="230" class="woocommerce-placeholder wp-post-image" height="230">
                    <?php endif;
                ?>
                <?php endif; ?>
            </a>

            <div class="product-buttons">
                <a href="<?php the_permalink(); ?>" class="quick-view product-btn" title="<?php _e('More info','anansi-tomte'); ?>"><?php _e('More info','anansi-tomte'); ?> ></a>
                <?php if( $posttype == 'product' ) :
                    do_action('woocommerce_after_shop_loop_item');
                    if (isset($yith_wcwl) && is_object($yith_wcwl)) : ?>
                    <a class="addToWishlist product-btn" href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>" data-product-id="<?php echo esc_html($product->id); ?>" data-product-type="<?php echo esc_html($product->product_type); ?>" <?php echo htmlspecialchars_decode($classes); ?>
                        data-toggle="tooltip" title="<?php esc_attr_e('Add to WishList','anansi-tomte'); ?>?"><img src="<?php echo get_template_directory_uri() ?>/assets/images/wishlist-btn.png" width="35" height="35" />
                    </a>
                    <?php endif; ?>
                <?php endif; ?>
		    </div>
	    </div>

	    <div class="product-info">
		    <h3 class="title" itemprop="name">
			    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		    </h3>
            <?php if (( $posttype == 'page') || ($posttype == 'post' )) : ?>
            <?php else : ?>
                <div class="content_price" itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
                    <?php if( $posttype == 'product' ) :
                        echo $product->get_price_html();
                        else :
                        _e('From', 'anansi-tomte'); ?>
                        <span class="woocommerce-Price-amount amount">
                            <span class="woocommerce-Price-currencySymbol">&euro;</span> <?php echo number_format_i18n( get_field('price_from'), 2 ); ?>
                        </span> <?php _e('incl. VAT', 'anansi-tomte'); ?>
                    <?php endif; ?>
                </div>
                <?php if( $posttype == 'product' ) : ?>
                <div class="loyalty-points">
                    <span class="or"><?php _e('or', 'anansi-tomte'); ?></span>
                    <?php
                        $price = $product->get_price();
                        $buypoints = round(($price * 2), 0, PHP_ROUND_HALF_UP);
                    ?>
                    <span><?php echo $buypoints . ' ' . __('loyalty points', 'anansi-tomte'); ?></span>
                </div>
                <?php endif; ?>
            <?php endif; ?>
	    </div>
    </div>
</li>