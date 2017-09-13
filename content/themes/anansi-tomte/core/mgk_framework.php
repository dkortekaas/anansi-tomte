<?php 
require_once(WL_THEME_PATH . '/includes/layout.php');
require_once(WL_THEME_PATH . '/core/resize.php');
require_once(WL_THEME_PATH . '/includes/mgk_menu.php');
require_once(WL_THEME_PATH . '/includes/widget.php');
require_once(WL_THEME_PATH . '/includes/mgk_widget.php');
require_once(WL_THEME_PATH .'/core/social_share.php');

add_action('wp_head','magikPvc_apple_touch_icon');

if ( ! function_exists ( 'magikPvc_apple_touch_icon' ) ) {
 function magikPvc_apple_touch_icon()
  {
    printf(
      '<link rel="apple-touch-icon" href="%s" />',
      esc_url(WL_THEME_URI). '/images/apple-touch-icon.png'
    );
    printf(
      '<link rel="apple-touch-icon" href="%s" />',
      esc_url(WL_THEME_URI). '/images/apple-touch-icon57x57.png'
    );
    printf(
      '<link rel="apple-touch-icon" href="%s" />',
       esc_url(WL_THEME_URI). '/images/apple-touch-icon72x72.png'
    );
    printf(
      '<link rel="apple-touch-icon" href="%s" />',
      esc_url(WL_THEME_URI). '/images/apple-touch-icon114x114.png'
    );
    printf(
      '<link rel="apple-touch-icon" href="%s" />',
      esc_url(WL_THEME_URI). '/images/apple-touch-icon144x144.png'
    );
  }
}

 /* Include theme variation functions */  
 if ( ! function_exists ( 'magikPvc_theme_layouts' ) ) {
 function magikPvc_theme_layouts()
 {
 global $pvc_Options;   
 if (isset($pvc_Options['theme_layout']) && !empty($pvc_Options['theme_layout'])) {
require_once (get_template_directory(). '/skins/' . $pvc_Options['theme_layout'] . '/functions.php');   
} else {
require_once (get_template_directory(). '/skins/default/functions.php');   
}
 }
}

// call theme skins function
magikPvc_theme_layouts();



/* Include theme variation homepage */ 
if ( ! function_exists ( 'magikPvc_theme_homepage' ) ) {
  function magikPvc_theme_homepage()
 {  
 global $pvc_Options;  

 if (isset($pvc_Options['theme_layout']) && !empty($pvc_Options['theme_layout'])) {
load_template(get_template_directory() . '/skins/' . $pvc_Options['theme_layout'] . '/homepage.php', true);
} else {
load_template(get_template_directory() . '/skins/default/homepage.php', true);
}
 }
}

 /* Include theme variation footer */
if ( ! function_exists ( 'magikPvc_theme_footer' ) ) {  
function magikPvc_theme_footer()
{
     
 global $pvc_Options;   
  if (isset($pvc_Options['theme_layout']) && !empty($pvc_Options['theme_layout'])) {
load_template(get_template_directory() . '/skins/' . $pvc_Options['theme_layout'] . '/footer.php', true);
} else {
load_template(get_template_directory() . '/skins/default/footer.php', true);
} 
}
}

 /* Include theme  backtotop */

 if ( ! function_exists ( 'magikPvc_backtotop' ) ) {  
  function magikPvc_backtotop()
 {
    
 global $pvc_Options;   
 if (isset($pvc_Options['back_to_top']) && !empty($pvc_Options['back_to_top'])) {
    ?>
   <script type="text/javascript">
    jQuery(document).ready(function($){ 
        jQuery().UItoTop();
    });
    </script>
<?php
}
 }
}

 if ( ! function_exists ( 'magikPvc_layout_breadcrumb' ) ) { 
function magikPvc_layout_breadcrumb() {
$MagikPvc = new MagikPvc();
 global $pvc_Options; 

?>


 <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
          <?php $MagikPvc->magikPvc_breadcrumbs(); ?>
          </div>
          <!--col-xs-12--> 
        </div>
        <!--row--> 
      </div>
      <!--container--> 
    </div>
<?php

}
}

 if ( ! function_exists ( 'magikPvc_singlepage_breadcrumb' ) ) { 
function magikPvc_singlepage_breadcrumb() {
 $MagikPvc = new MagikPvc();
 global $pvc_Options; 

?>
 <div class="breadcrumbs">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
          <?php $MagikPvc->magikPvc_breadcrumbs(); ?>
          </div>
          <!--col-xs-12--> 
        </div>
        <!--row--> 
      </div>
      <!--container--> 
    </div>
<?php

}
}

    if ( ! function_exists ( 'wl_simple_product_link' ) ) :
        function wl_simple_product_link() {
            global $product,$class;
            $product_type = $product->product_type;
            $product_id=$product->id;
            if($product->price=='') : ?>
                <a class="button btn-cart" title='<?php echo esc_html($product->add_to_cart_text()); ?>' onClick='window.location.assign("<?php echo esc_js(get_permalink($product_id)); ?>")' >
                    <span><?php echo esc_html($product->add_to_cart_text()); ?> </span>
                </a>
            <?php else : ?>
                <a class="single_add_to_cart_button add_to_cart_button  product_type_simple ajax_add_to_cart button btn-cart" title='<?php echo esc_html($product->add_to_cart_text()); ?>' data-quantity="1" data-product_id="<?php echo esc_attr($product->id); ?>" href='<?php echo esc_url($product->add_to_cart_url()); ?>'>
                    <!--<span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>-->
                    <span><?php _e('Add to Shoppingcart','woocommerce') ?></span>
                </a>
            <?php endif;
        }
    endif;

 if ( ! function_exists ( 'magikPvc_allowedtags' ) ) {
function magikPvc_allowedtags() {
    // Add custom tags to this string
        return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>,<h1>,<h2>,<h3>,<h4>,<h5>,<h6>,<b>,<blockquote>,<strong>,<figcaption>'; 
    }
  }

if ( ! function_exists( 'magikPvc_wp_trim_excerpt' ) ) : 
    function magikPvc_wp_trim_excerpt($wpse_excerpt) {
    $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            $wpse_excerpt = strip_tags($wpse_excerpt, magikPvc_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
                $excerpt_word_count = 75;
                $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
                $tokens = array();
                $excerptOutput = '';
                $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
                preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

                foreach ($tokens[0] as $token) { 

                    if ($count >= $excerpt_length && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
                    // Limit reached, continue until , ; ? . or ! occur at the end
                        $excerptOutput .= trim($token);
                        break;
                    }

                    // Add words to complete sentence
                    $count++;

                    // Append what's left of the token
                    $excerptOutput .= $token;
                }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

                $excerpt_end = ' '; 
                $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 

                $wpse_excerpt .= $excerpt_more; /*Add read more in new paragraph */

            return $wpse_excerpt;   

        }
        return apply_filters('magikPvc_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

endif; 

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'magikPvc_wp_trim_excerpt');


//if ( ! function_exists ( 'magikPvc_disable_srcset' ) ) {
//function magikPvc_disable_srcset( $sources ) {
//return false;
//}
//}
//add_filter( 'wp_calculate_image_srcset', 'magikPvc_disable_srcset' );


 if ( ! function_exists ( 'magikPvc_body_classes' ) ) {
function magikPvc_body_classes( $classes ) 
{
  // Adds a class to body.
global $pvc_Options; 
 

$classes[] = 'cms-index-index cms-home-page';


  return $classes;
}
}

add_filter( 'body_class', 'magikPvc_body_classes');

 if ( ! function_exists ( 'magikPvc_post_classes' ) ) {
function magikPvc_post_classes( $classes ) 
{
  // add custom post classes.
if(class_exists('WooCommerce') && is_woocommerce())
{ 
$classes[]='notblog';
if(is_product_category())
{
 $classes[]='notblog'; 
} 
}
else if(is_category() || is_archive() || is_search() || is_tag() || is_home())
{
$classes[] = 'blog-post container-paper';
}
else
{
$classes[]='notblog';
} 

  return $classes;
}
}
add_filter( 'post_class', 'magikPvc_post_classes');


//add to cart function
if (!function_exists( 'wl_mini_cart' )) {
function wl_mini_cart() {
    global $woocommerce;

    if ( is_cart() || is_checkout() ) :
        $shopclass = ' active';
    else : 
        $shopclass = '';
    endif;

    if ( is_account_page() ) :
        $accountclass = ' active';
    else :
        $accountclass = '';
    endif;
?>

    <ul id="menu-top-menu" class="customer-nav hidden-sm hidden-xs">
        <li class="menu-item my-account<?php echo $accountclass ?>">
        <?php if ( is_user_logged_in() ) : ?>
 	        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','anansi-tomte'); ?>"><?php _e('My Account','anansi-tomte'); ?></a>
        <?php else : ?>
 	        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','anansi-tomte'); ?>"><?php _e('My Account','anansi-tomte'); ?></a>
        <?php endif; ?>
        </li>
        <li class="menu-item widget_shopping_cart<?php echo $shopclass ?>">
            <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>">
                <span class="mini-cart-link">
                    <span class="cart-title"><?php  esc_attr_e('Cart','anansi-tomte'); ?>: </span>
                </span>
                <span class="cart-quantity">
                    <?php echo esc_html($woocommerce->cart->cart_contents_count) . ' '; 
                    if($woocommerce->cart->cart_contents_count == 1) :
                        _e('Product', 'anansi-tomte');
                    else :
                        _e('Products', 'anansi-tomte');
                    endif;
                    ?>
                </span>
            </a>
            <div class="mini_cart_content" style="height: 450x;">
                <div class="mini_cart_inner">
                    <div class="mini_cart_arrow"></div>
                    <?php if (sizeof(WC()->cart->get_cart()) > 0) : $i = 0; ?>
                    <ul class="cart_list product_list_widget ">
                        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
                        <?php
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                        
                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0
                            && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)
                        ) :
                        
                            $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(array(80, 160)), $cart_item, $cart_item_key);
                            $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                            $cnt = sizeof(WC()->cart->get_cart());
                            $rowstatus = $cnt % 2 ? 'odd' : 'even';
                            ?>
                        <li class="item<?php if ($cnt - 1 == $i) { ?>last<?php } ?>">
                        <div class="item-inner">
                        <a class="product-image"
                            href="<?php echo esc_url($_product->get_permalink($cart_item)); ?>"  title="<?php echo htmlspecialchars_decode($product_name); ?>"> <?php echo str_replace(array('http:', 'https:'), '', htmlspecialchars_decode($thumbnail)); ?> </a>
                            <div class="product-details">
                                <div class="access">
                                    <!--
                                    <a class="btn-edit" title="<?php esc_attr_e('Edit item','anansi-tomte') ;?>"
                                    href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>"><i
                                    class="icon-pencil"></i><span
                                    class="hidden"><?php esc_attr_e('Edit item','anansi-tomte') ;?></span></a>-->
                                    <a href="<?php echo esc_url(WC()->cart->get_remove_url($cart_item_key)); ?>"
                                    title="<?php esc_attr_e('Remove This Item','anansi-tomte') ;?>" onClick="" 
                                    class="btn-remove1"><i class="fa fa-trash"></i></a>
                                </div>
                                <p class="product-name"><a href="<?php echo esc_url($_product->get_permalink($cart_item)); ?>"
                                    title="<?php echo htmlspecialchars_decode($product_name); ?>"><?php echo htmlspecialchars_decode($product_name); ?></a> 
                                </p>
                                <p class="product-price"><?php echo esc_html($cart_item['quantity']); ?></strong> x <span class="price"><?php echo htmlspecialchars_decode($product_price); ?></p>
                            </div>
                            <?php echo htmlspecialchars_decode(WC()->cart->get_item_data($cart_item)); ?>
                                </div>
                        
                        </li>
                        <?php endif; ?>
                        <?php $i++; endforeach; ?>
                    </ul>
                    <p class="total">Subtotaal: 
                       <?php echo WC()->cart->get_cart_subtotal();?>                        
                    </p>
                    <p class="buttons">
                        <button class="button checkout wc-forward" title="<?php esc_attr_e('Checkout','anansi-tomte') ;?>" type="button" onClick="window.location.assign('<?php echo esc_js(WC()->cart->get_checkout_url()); ?>')">
                            <span><?php esc_attr_e('Checkout','anansi-tomte') ;?></span> 
                        </button>
                    </p>
                    <?php else:?>
                    <p class="a-center noitem">
                        <?php esc_attr_e('Sorry, nothing in cart.', 'anansi-tomte');?>
                    </p>
                    <?php endif; ?>                    
                </div>
                <div class="loading"></div>
            </div>                                            
        </li>
    </ul>
<?php
}
}

 

 
    //Social links
    if (!function_exists('wl_social_media_links')) :
        function wl_social_media_links() {
            $facebook_url = get_option('wlc_social_facebook_url');
            $twitter_url = get_option('wlc_social_twitter_url');
            $google_url = get_option('wlc_social_googleplus_url');
            $linkedin_url = get_option('wlc_social_linkedin_url');
            $pinterest_url = get_option('wlc_social_pinterest_url');
            $instagram_url = get_option('wlc_social_instagram_url');
            $youtube_url = get_option('wlc_social_youtube_url'); ?>

            <h4 class="footer-widget-title"><?php _e('Social Media', 'anansi-tomte') ?></h4>
            <div class="menu-footer-container">
                <ul class="social-media">
                    <?php
                    if (isset($facebook_url) && !empty($facebook_url)) :
                        echo '<li class="menu-item"><a href="'. esc_url($facebook_url) .'" target="_blank" rel="nofollow" data-toggle="tooltip" title="'. __('Share us!','anansi-tomte') .'"><img src="'.get_template_directory_uri().'/assets/images/social/facebook.png" alt="facebook logo" width="25" height="25"></a></li>';
                    endif;
                    if (isset($twitter_url) && !empty($twitter_url)) :
                        echo '<li class="menu-item"><a href="'.esc_url($twitter_url).'" target="_blank" rel="nofollow" data-toggle="tooltip" title="'. __('Follow us!','anansi-tomte') .'"><img src="'.get_template_directory_uri().'/assets/images/social/twitter.png" alt="twitter logo" width="25" height="25"></a></li>';
                    endif;
                    if (isset($google_url) && !empty($google_url)) :
                        echo '<li class="menu-item"><a href="'.esc_url($google_url).'" target="_blank" rel="nofollow" data-toggle="tooltip" title="'. __('Get inspired!','anansi-tomte') .'"><img src="'.get_template_directory_uri().'/assets/images/social/google.png" alt="pinterest logo" width="25" height="25"></a></li>';
                    endif;
                    if (isset($linkedin_url) && !empty($linkedin_url)) :
                        echo '<li class="menu-item"><a href="'.esc_url($linkedin_url).'" target="_blank" rel="nofollow" data-toggle="tooltip" title="'. __('Follow us!','anansi-tomte') .'"><img src="'.get_template_directory_uri().'/assets/images/social/linkedin.png" alt="pinterest logo" width="25" height="25"></a></li>';
                    endif;
                    if (isset($pinterest_url) && !empty($pinterest_url)) :
                        echo '<li class="menu-item"><a href="'.esc_url($pinterest_url).'" target="_blank" rel="nofollow" data-toggle="tooltip" title="'. __('Get inspired!','anansi-tomte') .'"><img src="'.get_template_directory_uri().'/assets/images/social/pinterest.png" alt="pinterest logo" width="25" height="25"></a></li>';
                    endif;
                    if (isset($instagram_url) && !empty($instagram_url)) :
                        echo '<li class="menu-item"><a href="'.esc_url($instagram_url).'" target="_blank" rel="nofollow" data-toggle="tooltip" title="'. __('See us!','anansi-tomte') .'"><img src="'.get_template_directory_uri().'/assets/images/social/instagram.png" alt="instagram logo" width="25" height="25"></a></li>';
                    endif;
                    if (isset($youtube_url) && !empty($youtube_url)) :
                        echo '<li class="menu-item"><a href="'.esc_url($youtube_url).'" target="_blank" rel="nofollow" data-toggle="tooltip" title="'. __('Follow us!','anansi-tomte') .'"><img src="'.get_template_directory_uri().'/assets/images/social/youtube.png" alt="youtube logo" width="25" height="25"></a></li>';
                    endif;
                    ?>
                </ul><br/>
            </div>
        <?php }
    endif;

    //Payment methods
    if (!function_exists('wl_payment_methods')) :
        function wl_payment_methods() {
            // $ideal = get_option('wlc_apm_ideal');
            // $creditcard = get_option('wlc_apm_creditcard');
            // $sofort = get_option('wlc_apm_sofort');
            // $paypal = get_option('wlc_apm_paypal');
            // $mrcash = get_option('wlc_apm_mrcash');
            // $banktransfer = get_option('wlc_apm_banktransfer'); ?>
<!--            <div class="payment">
                <?php

                if (isset($ideal) && !empty($ideal) && $ideal == "on") : ?>
                    <img class="ideal pull-left" src="<?php echo get_template_directory_uri() ?>/assets/images/payment-methods/ideal.png" alt="iDeal" title="iDeal" width="40" height="40" />
                <?php endif;
                if (isset($creditcard) && !empty($creditcard) && $creditcard == "on") : ?>
                    <img class="creditcard pull-left" src="<?php echo get_template_directory_uri() ?>/assets/images/payment-methods/creditcard.png" alt="Creditcard" title="Creditcard" width="40" height="40" />
                <?php endif;
                if (isset($sofort) && !empty($sofort) && $sofort == "on") : ?>
                    <img class="sofort pull-left" src="<?php echo get_template_directory_uri() ?>/assets/images/payment-methods/sofort.png" alt="Sofort Banking" title="Sofort Banking" width="40" height="40" />
                <?php endif;
                if (isset($mrcash) && !empty($mrcash) && $mrcash == "on") : ?>
                    <img class="paypal pull-left" src="<?php echo get_template_directory_uri() ?>/assets/images/payment-methods/mistercash.png" alt="Bancontact / Mister Cash" title="Bancontact / Mister Cash" width="40" height="40" />
                <?php endif;
                if (isset($paypal) && !empty($paypal) && $paypal == "on") : ?>
                    <img class="paypal pull-left" src="<?php echo get_template_directory_uri() ?>/assets/images/payment-methods/paypal.png" alt="PayPal" title="PayPal" width="40" height="40" />
                <?php endif;
                if (isset($banktransfer) && !empty($banktransfer) && $banktransfer == "on") : ?>
                    <img class="banktransfer pull-left" src="<?php echo get_template_directory_uri() ?>/assets/images/payment-methods/banktransfer.png" alt="Banktransfer" title="Banktransfer" width="40" height="40" />
                <?php endif; ?>
            </div>-->
            <h4 class="footer-widget-title"><?php _e('Payment and shipping', 'anansi-tomte') ?></h4>
            <div class="menu-footer-container">
                <ul class="payment-transport">
                    <li class="menu-item"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ideal.png" alt="iDeal logo" width="65" height="35"></li>
                    <li class="menu-item"><img src="<?php echo get_template_directory_uri() ?>/assets/images/postnl.png" alt="PostNL logo" width="65" height="35"></li>
                </ul>
                <ul class="saletext">
                    <li>GRATIS verzending binnen Nederland bij een bestelling vanaf € 75,-</li>
                    <li><a href="https://www.anansi-tomte.nl/algemene-voorwaarden-spaarpunten/" title="Spaar punten">SPAAR PUNTEN</a> om mee te betalen!</li>
                </ul>
            </div>
     <?php }
    endif;

    //Shipping methods
    if (!function_exists('wl_shipping_methods')) :
        function wl_shipping_methods() {
            $dhl = get_option('wlc_sm_dhl');
            $ups = get_option('wlc_sm_ups');
            $dpd = get_option('wlc_sm_dpd');
            $postnl = get_option('wlc_sm_postnl');
            ?>
            <div class="shipment">
                <?php
                if (isset($dhl) && !empty($dhl) && $dhl == "on") : ?>
                    <img class="dhl" src="<?php echo get_template_directory_uri() ?>/assets/images/shipment-methods/dhl.png" alt="DHL" title="DHL" width="181" height="40" />
                <?php endif;
                if (isset($ups) && !empty($ups) && $ups == "on") : ?>
                    <img class="ups" src="<?php echo get_template_directory_uri() ?>/assets/images/shipment-methods/ups.png" alt="UPS" title="UPS" width="33" height="40" />
                <?php endif;
                if (isset($dpd) && !empty($dpd) && $dpd == "on") : ?>
                    <img class="dpd" src="<?php echo get_template_directory_uri() ?>/assets/images/shipment-methods/dpd.png" alt="DPD" title="DPD" width="90" height="40" />
                <?php endif;
                if (isset($postnl) && !empty($postnl) && $postnl == "on") : ?>
                    <img class="postnl" src="<?php echo get_template_directory_uri() ?>/assets/images/shipment-methods/postnl.png" alt="PostNL" title="PostNL" width="41" height="40" />
                <?php endif; ?>
            </div>
     <?php }
    endif;

    // bottom cpyright text 
    if (!function_exists('magikPvc_footer_text')){
    function magikPvc_footer_text()
    {
        global $pvc_Options;
        if (isset($pvc_Options['bottom-footer-text']) && !empty($pvc_Options['bottom-footer-text'])) {
          ?>
          <div class="footer-bottom">
          <div class="container">
          <div class="row">
          <?php
          echo htmlspecialchars_decode ($pvc_Options['bottom-footer-text']);
          ?>
          </div>
          </div>
        </div>
          <?php
        }
      }
    }

    if (!function_exists('wl_woocommerce_product_add_to_cart_text')) :
        function wl_woocommerce_product_add_to_cart_text() {
            global $product;
            $product_type = $product->product_type;
            $product_id=$product->id;
            if($product->is_in_stock()) :
                switch ( $product_type ) :
                    case 'external': ?>
                        <a class="button btn-cart" title='<?php echo esc_html($product->add_to_cart_text()); ?>' onClick='window.location.assign("<?php echo esc_js(get_permalink($product_id)); ?>")'>
                            <span> <?php echo esc_html($product->add_to_cart_text()); ?></span>
                        </a>
                        <?php break;
                    case 'grouped': ?>
                        <a class="button btn-cart" title='<?php echo esc_html($product->add_to_cart_text()); ?>' onClick='window.location.assign("<?php echo esc_js(get_permalink($product_id)); ?>")' >
                            <span><?php echo esc_html($product->add_to_cart_text()); ?> </span>
                        </a>
                        <?php break;
                    case 'simple': ?>
                        <?php wl_simple_product_link();?>
                        <?php break;
                    case 'variable': ?>
                        <a class="button btn-cart"  title='<?php echo esc_html($product->add_to_cart_text()); ?>' onClick='window.location.assign("<?php echo esc_js(get_permalink($product_id)); ?>")'>
                            <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                        </a>
                        <?php break;
                    default: ?>
                        <a class="button btn-cart" title='<?php esc_attr_e("Read more",'pvc'); ?>' onClick='window.location.assign("<?php echo esc_js(get_permalink($product_id)); ?>")'>
                            <span><?php esc_attr_e('Read more', 'pvc'); ?></span>
                        </a>
                        <?php break;
                endswitch;
            else : ?>
                <a type='button' class="button btn-cart" title='<?php esc_attr_e('Out of stock', 'pvc'); ?> ' onClick='window.location.assign("<?php echo esc_js(get_permalink($product_id)); ?>")' class='button btn-cart'>
                    <span> <?php esc_attr_e('Out of stock', 'pvc'); ?> </span>
                </a>
            <?php 
            endif;
        }
    endif;
?>