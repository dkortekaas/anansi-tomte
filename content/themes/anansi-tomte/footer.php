
        <div class="wrapper">
            <div class="white">
                <div class="footer-area-container">
                    <div class="row">                
                    
                        <?php if (is_active_sidebar('footer-sidebar-1')) : ?>
                        <div class="col-lg-3 col-sm-6">
                            <?php dynamic_sidebar('footer-sidebar-1'); ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(ICL_LANGUAGE_CODE=='nl'): ?>
                            <?php if (is_active_sidebar('footer-sidebar-2')) : ?>
                                <div class="col-lg-3 col-sm-6">
                                    <?php dynamic_sidebar('footer-sidebar-2'); ?>
                                    <?php if ( get_option('wlc_footer_image') ) : ?>
                                    <img src="<?php echo get_option('wlc_footer_image') ?>" alt="Anansi &amp; Tomte" class="img-responsive aligncenter hidden-xs" style="height:70px;margin-top:-40px!important;margin-right:-5px!important;"/>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="col-lg-3 col-sm-6">
                                <div class="footer-widget widget_nav_menu">
                                    <h4 class="footer-widget-title"><?php _e('Latest blogs','anansi-tomte') ?></h4>
                                    <div class="menu-footer-container equal">
                                        <ul class="menu">
                                        <?php
                                            $args = array( 'numberposts' => '7' );
                                            $recent_posts = wp_get_recent_posts( $args );
                                            foreach( $recent_posts as $recent ) :
                                                echo '<li class="menu-item">';
                                                    echo '<a href="'.get_permalink($recent["ID"]).'"><span class="date">'.date_i18n( 'd-m-Y', strtotime( $recent['post_date'] ) ).' - </span> <span class="footer-post-title">'.$recent["post_title"].'</span></a>';
                                                echo '</li>';
                                            endforeach;
                                            wp_reset_query();
                                        ?>
                                        </ul>
                                    </div>
                                </div>                            
                            </div>
                        <?php else : ?>
                            <div class="col-lg-6 col-sm-6">
                                <?php if ( get_option('wlc_footer_image') ) : ?>
                                <img src="<?php echo get_option('wlc_footer_image') ?>" alt="Anansi &amp; Tomte" class="img-responsive aligncenter hidden-xs" style="height:100px;margin-top:10%!important;"/>
                                <?php endif; ?>
                            </div>                          
                        <?php endif; ?>

                        <div class="col-lg-3 col-sm-6">
                            <div id="nav_menu-3" class="footer-widget widget_nav_menu">
                            <?php wl_social_media_links(); ?>
                            <?php if(ICL_LANGUAGE_CODE=='nl'): ?>
                            <?php wl_payment_methods(); ?>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="footer-holder">
                <footer class="site-footer">
                    <div class="row">
                        <div class="col-xs-8 copyright">
                            <p>&copy; Copyright <?php echo date("Y"); ?> Anansi &amp; Tomte</p>
                        </div>
                        <div class="col-xs-4 design">
                            <a href="https://weblogiq.nl" title="Weblogiq Internetbureau">Weblogiq</a>
                        </div>                    
                    </div>
                </footer>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
<script>
    
    //Mini Cart
    if(jQuery(window).width() > 1024){
        jQuery('.widget_shopping_cart').on('mouseover', function(){
            var mCartHeight = jQuery('.mini_cart_inner').outerHeight();
            var cCartHeight = jQuery('.mini_cart_content').outerHeight();
            
            if(cCartHeight < mCartHeight) {
                jQuery('.mini_cart_content').stop(true, false).animate({'height': mCartHeight});
            }
        });
        jQuery('.widget_shopping_cart').on('mouseleave', function(){
            jQuery('.mini_cart_content').animate({'height':'0'});
        });
        
        jQuery(function () {
            jQuery('[data-toggle="tooltip"]').tooltip();
        });
    }

    /* Slider */
    jQuery(window).load(function() {
        jQuery('.flexslider').flexslider({
            animation: "slide",
            directionNav: false
        });
    });

    /* Blog */
    jQuery(document).ready(function($) {
        jQuery('#order').on('change', function() {
            document.forms["postsorder"].submit();
        });
    });

    /* FAQ */
    jQuery(document).ready(function($) {
        $('.faq_question').click(function() {
            if ($(this).parent().is('.open')){
                $(this).closest('.faq').find('.faq_answer_container').animate({'height':'0'},500);
                $(this).closest('.faq').removeClass('open');
                $(this).parent().find('.accordion-button-icon').removeClass('fa-minus').addClass('fa-plus');
            } else {
                var newHeight =$(this).closest('.faq').find('.faq_answer').height() +'px';
                $(this).closest('.faq').find('.faq_answer_container').animate({'height':newHeight},500);
                $(this).closest('.faq').addClass('open');
                $(this).parent().find('.accordion-button-icon').removeClass('fa-plus').addClass('fa-minus');
            }
        });
    });

    $title = '<?php _e('View Wishlist','anansi-tomte'); ?>';
    jQuery('.yith-wcwl-wishlistexistsbrowse a').attr('title',$title).attr('data-toggle', 'tooltip');
    jQuery('.yith-wcwl-wishlistaddedbrowse a').attr('title',$title).attr('data-toggle', 'tooltip');
    if ( !jQuery( 'a.woocommerce-remove-coupon i.fa-trash' ).length ) {
        jQuery('a.woocommerce-remove-coupon').html('<i class="fa fa-trash"></i>').addClass('pull-right').css('position', 'absolute').css('right', '15px');
    }
    if ( !jQuery( 'span#vat' ).length ) {
        jQuery('.cart_totals .cart-discount .woocommerce-Price-amount').append('<span id="vat"> <?php _e('incl. VAT','anansi-tomte'); ?></span>').css('margin-right', '-70px');
    }

    jQuery( document ).ajaxComplete(function() {
        if ( !jQuery( 'span#vat' ).length ) {
            jQuery('.cart_totals .cart-discount .woocommerce-Price-amount').append('<span id="vat"> <?php _e('incl. VAT','anansi-tomte'); ?></span>').css('margin-right', '-70px');
            jQuery('.woocommerce-checkout-review-order-table .cart-discount .woocommerce-Price-amount').append('<span id="vat"> <?php _e('incl. VAT','anansi-tomte'); ?></span>');
        }
    
        if ( !jQuery( 'a.woocommerce-remove-coupon i.fa-trash' ).length ) {
            jQuery('a.woocommerce-remove-coupon').html('<i class="fa fa-trash"></i>').addClass('pull-right').css('position', 'absolute').css('right', '15px');
        }

        jQuery('.calculated_shipping a.woocommerce-remove-coupon').html('<i class="fa fa-trash"></i>').addClass('pull-right').css('position', 'absolute').css('right', '15px');
        jQuery('.woocommerce-checkout-review-order-table a.woocommerce-remove-coupon').html('<i class="fa fa-trash"></i>').addClass('pull-right').css('position', 'absolute').css('right', '22px');
    });

    //Tabs
    jQuery('#service-detail-tab a:first').tab('show');    
    jQuery( 'a.product-register' ).click(function(e) {
        e.preventDefault();
        jQuery('#service-detail-tab a[href="#tab-calendar-register"]').tab('show');
    });

    jQuery('.woocommerce-remove-coupon').click(function(){
        //e.preventDefault();
        jQuery('#my_redeemed_points').html('0');
    });

    /* Product equal */
    jQuery(document).ready(function($) {
        $productcontent = jQuery('.productcontent').height();
        $productsidebar = jQuery('.sidebar').height();
        $productinfo = $productsidebar - $productcontent;
        jQuery('.productinfo').height($productinfo - 67);
    });

    jQuery(document).ready(function($) {
        $('#yith-searchsubmit').addClass("fa").val("\uf002");
    });

    jQuery(function() {
        var loc = window.location.href; // returns the full URL
        if(/view-order/.test(loc)) {
            jQuery('.woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link--orders').addClass('is-active');
        }
        if(/diensten/.test(loc) || /services/.test(loc) || /servicios/.test(loc)) {
            jQuery('#menu-main-menu li').removeClass('current_page_parent');
            jQuery('#menu-main-menu li.diensten a').addClass('current');
        }
        if(/post_type=any/.test(loc)) {
            jQuery('#menu-main-menu li').removeClass('current_page_parent');
        }

        jQuery('.woocommerce-account a.woocommerce-Button--next').each(function() {
            jQuery(this).text('');
        });
        jQuery('.woocommerce-account a.woocommerce-Button--previous').each(function() {
            jQuery(this).text('');
        });
    });

</script>
</body>
</html>