<?php

if ( ! function_exists ( 'magikPvc_product_pagebanner' ) ) {
function magikPvc_product_pagebanner()
{
    global $pvc_Options;
if (isset($pvc_Options['product_banner']) && !empty($pvc_Options['product_banner']['url']))
 {?>
 <div class="product-banner-box">
  <a href="<?php echo !empty($pvc_Options['product_banner_url']) ? esc_url($pvc_Options['product_banner_url']) : '#' ?>">                 
 <img src="<?php echo esc_url($pvc_Options['product_banner']['url']); ?>" alt="<?php esc_attr_e('Product Banner', 'pvc'); ?>">
   </a> 
  </div>          
<?php }
}
}

    if ( ! function_exists ( 'wl_product_social_share' ) ) :
        function wl_product_social_share() {
            global $pvc_Options; ?>
            <div class="social">
                <ul>
                    <li>
                        <a data-toggle="tooltip" title="<?php _e('Share on Facebook','anansi-tomte') ?>" onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo esc_html(urlencode(get_permalink()));?>','sharer', 'toolbar=0,status=0,width=620,height=280');"  href="javascript:;">
                            <img src="<?php get_template_directory_uri() ?>/assets/images/social/facebook.png" alt="facebook logo" width="25" height="25">
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" title="<?php _e('Share on Twitter','anansi-tomte') ?>" onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_html(urlencode(get_the_title())); ?> <?php echo esc_html(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;"  href="javascript:;">
                            <img src="<?php get_template_directory_uri() ?>/assets/images/social/twitter.png" alt="twitter logo" width="25" height="25">
                        </a>
                    </li>
<!--                    <li>
                        <a data-toggle="tooltip" title="<?php _e('Share on Google+','anansi-tomte') ?>" href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_html(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;">
                            <img src="<?php get_template_directory_uri() ?>/assets/images/social/googleplus.png" alt="googleplus logo" width="25" height="25">
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tooltip" title="<?php _e('Share on LinkedIn','anansi-tomte') ?>" onclick="popUp=window.open('http://linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_html(urlencode(get_permalink())); ?>&amp;title=<?php echo esc_html(urlencode(get_the_title())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                            <img src="<?php get_template_directory_uri() ?>/assets/images/social/linkedin.png" alt="linkedin logo" width="25" height="25">
                        </a>
                    </li>-->
                    <li>
                        <a data-toggle="tooltip" title="<?php _e('Pin on Pinterest','anansi-tomte') ?>" onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_html(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_html(urlencode(get_the_title())); ?>&amp;media=<?php $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo has_post_thumbnail() ? esc_html($arrImages[0])  : "" ; ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript:;">
                            <img src="<?php get_template_directory_uri() ?>/assets/images/social/pinterest.png" alt="pinterest logo" width="25" height="25">
                        </a>
                    </li>
                </ul>
            </div>
        <?php }
    endif;