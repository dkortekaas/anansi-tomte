<?php

if ( ! function_exists ( 'magikPvc_currency_language' ) ) {
function magikPvc_currency_language()
{ 
     global $pvc_Options;


        if(isset($pvc_Options['enable_header_language']) && ($pvc_Options['enable_header_language']!=0))
        { ?>
          <div class="dropdown block-language-wrapper"> 
            <a role="button" data-toggle="dropdown" data-target="#" class="block-language dropdown-toggle" href="#"> 
              <img src="<?php echo esc_url(get_template_directory_uri()) ;?>/images/english.png" alt="<?php esc_attr_e('English', 'pvc');?>">  
              <?php esc_attr_e('English', 'pvc');?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="<?php echo esc_url(get_template_directory_uri()) ;?>/images/english.png" alt="<?php esc_attr_e('English', 'pvc');?>">    <?php esc_attr_e('English', 'pvc');?></a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="<?php echo esc_url(get_template_directory_uri()) ;?>/images/francais.png" alt="<?php esc_attr_e('French', 'pvc');?>"> <?php esc_attr_e('French', 'pvc');?> </a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="<?php echo esc_url(get_template_directory_uri()) ;?>/images/german.png" alt="<?php esc_attr_e('German', 'pvc');?>">   <?php esc_attr_e('German', 'pvc');?></a></li>
            </ul>
          </div>
        <?php  
        } ?>
        
        <?php if(isset($pvc_Options['enable_header_currency']) && ($pvc_Options['enable_header_currency']!=0))
        { ?>
          <div class="dropdown block-currency-wrapper"> 
            <a role="button" data-toggle="dropdown" data-target="#" class="block-currency dropdown-toggle" href="#">  
              <?php esc_attr_e('USD', 'pvc');?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">
                <?php esc_attr_e('$ - Dollar', 'pvc');?>
                </a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">
                <?php esc_attr_e('&pound; - Pound', 'pvc');?>
                </a>
              </li>
              <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">
                <?php esc_attr_e('&euro; - Euro', 'pvc');?>
                </a>
              </li>
            </ul>
          </div>
        <?php  
        } 
}
}


if ( ! function_exists ( 'magikPvc_msg' ) ) {
function magikPvc_msg()
{ 
     global $pvc_Options;
    if(isset($pvc_Options['enable_welcome_msg']) && !empty($pvc_Options['enable_welcome_msg'])) {
 ?>
  <div class="welcome-msg hidden-xs">
 <?php

           if (is_user_logged_in()) {
            global $current_user;
       
            if(isset($pvc_Options['enable_welcome_msg'])) {
            echo esc_attr_e('Logged in as', 'pvc'). '   <b>'. esc_attr($current_user->display_name) .'</b>';
          }
          }
          else{
            if(isset($pvc_Options['enable_welcome_msg']) && ($pvc_Options['welcome_msg']!='')){
            echo htmlspecialchars_decode($pvc_Options['welcome_msg']);
            }
          }
          ?>
          </div>
          <?php 
        }
}
}


if ( ! function_exists ( 'magikPvc_logo_image' ) ) {
function magikPvc_logo_image()
{ 
     global $pvc_Options;
    
        $logoUrl = get_template_directory_uri() . '/images/logo.png';
        
        if (isset($pvc_Options['header_use_imagelogo']) && $pvc_Options['header_use_imagelogo'] === 0) {           ?>
        <a title="<?php bloginfo('name'); ?>" href="<?php echo esc_url(get_home_url()); ?> ">
        <?php bloginfo('name'); ?>
        </a>
        <?php
        } else if (isset($pvc_Options['header_logo']['url']) && !empty($pvc_Options['header_logo']['url'])) { 
                  $logoUrl = $pvc_Options['header_logo']['url'];
                  ?>
        <a title="<?php bloginfo('name'); ?>" href="<?php echo esc_url(get_home_url()); ?> "> <img
                      alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url($logoUrl); ?>"
                      height="<?php echo !empty($pvc_Options['header_logo_height']) ? esc_html($pvc_Options['header_logo_height']) : ''; ?>"
                      width="<?php echo !empty($pvc_Options['header_logo_width']) ? esc_html($pvc_Options['header_logo_width']) : ''; ?>"> </a>
        <?php
        } else { ?>
        <a title="<?php bloginfo('name'); ?>" href="<?php echo esc_url(get_home_url()); ?> "> 
          <img src="<?php echo esc_url($logoUrl) ;?>" alt="<?php bloginfo('name'); ?>"> </a>
        <?php }  

}
}


if ( ! function_exists ( 'magikPvc_mobile_search' ) ) {
function magikPvc_mobile_search() {

    global $pvc_Options;
    $MagikPvc = new MagikPvc();
    if (isset($pvc_Options['header_remove_header_search']) && !$pvc_Options['header_remove_header_search']) : 
        echo'<div class="mobile-search">';
         echo wl_mobile_search_form();
         echo'<div class="search-autocomplete" id="search_autocomplete1" style="display: none;"></div></div>';
         endif;
    }
}


if ( ! function_exists ( 'magikPvc_search_form' ) ) {
 function magikPvc_search_form()
  {  
    global $pvc_Options;
  $MagikPvc = new MagikPvc();
  ?>
 <?php if (isset($pvc_Options['header_remove_header_search']) && !$pvc_Options['header_remove_header_search']) : ?>           
  <form name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
    
    <?php if (class_exists('WooCommerce')) : ?>
      <?php 
      
             $args = array(
                        'show_option_all' => esc_html__( 'All Categories', 'pvc' ),
                        'hierarchical' => 1,
                        'class' => 'cat',
                        'echo' => 1,
                        'value_field' => 'slug',
                        'selected' => 0
                    );
              $args['taxonomy'] = 'product_cat';
              $args['name'] = 'product_cat';              
              $args['class'] = 'cate-dropdown hidden-xs';
              wp_dropdown_categories($args);

       ?>
      <input type="hidden" value="product" name="post_type">
    <?php endif; ?>
               <input type="text"  name="s" class="searchbox mgksearch" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search entire store here...', 'pvc'); ?>">
    
    <button type="submit" title="<?php esc_attr_e('Search', 'pvc'); ?>" class="search-btn-bg"><span><?php esc_attr_e('Search','pvc');?></span></button>
  </form>
   <?php  endif; ?>
  <?php
  }
}


if ( ! function_exists ( 'magikPvc_mobile_search_form' ) ) {
   function magikPvc_mobile_search_form()
  {  
    global $pvc_Options;
  $MagikPvc = new MagikPvc();
  ?>
 <?php if (isset($pvc_Options['header_remove_header_search']) && !$pvc_Options['header_remove_header_search']) : ?>           
  <form name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
    
    <?php if (class_exists('WooCommerce')) : ?>
      <input type="hidden" value="product" name="post_type">
    <?php endif; ?>
               <input type="text"  name="s" class="searchbox mgksearch" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search entire store here...', 'pvc'); ?>">
    
    <button type="submit" title="<?php esc_attr_e('Search', 'pvc'); ?>" class="search-btn-bg"><span><?php esc_attr_e('Search','pvc');?></span></button>
  </form>
   <?php  endif; ?>
  <?php
  }
}



if ( ! function_exists ( 'magikPvc_home_page_banner' ) ) {
function magikPvc_home_page_banner()
{
    global $pvc_Options;
     
        ?>
  <div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
      <div class="row">
        <div class="col-md-9">

        <?php  if(isset($pvc_Options['enable_home_gallery']) && $pvc_Options['enable_home_gallery']  && isset($pvc_Options['home-page-slider']) && !empty($pvc_Options['home-page-slider'])) { ?>
        
        <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
            <div id='rev_slider_4' class='rev_slider fullwidthabanner'>

            <ul>
                            <?php foreach ($pvc_Options['home-page-slider'] as $slide) : ?>
                                  <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='<?php echo esc_url($slide['thumb']); ?>'>
                                       <img
                                        src="<?php echo esc_url($slide['image']); ?>" data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat'
                                        alt="<?php echo esc_attr($slide['title']); ?>"/> <?php echo htmlspecialchars_decode($slide['description']); ?>
                                        <a class="s-link" href="<?php echo !empty($slide['url']) ? esc_url($slide['url']) : '#' ?>"></a>
                                </li>
                           
  <?php endforeach; ?>


   </ul>
            <div class="tp-bannertimer"></div>
          </div>
        </div>
    
      <?php } ?>
           </div>
         <div class="col-md-3 hot-deal">
        
              <?php magikPvc_hotdeal_product();?> 
            
        </div>
 
    
</div>
</div>

<!-- end Slider --> 
<script type='text/javascript'>
jQuery(document).ready(function() {
  jQuery('#rev_slider_4').show().revolution({
  dottedOverlay: 'none',
  delay: 5000,
  startwidth: 915,
  startheight: 497,
  hideThumbs: 200,
  thumbWidth: 200,
  thumbHeight: 50,
  thumbAmount: 2,
  navigationType: 'thumb',
  navigationArrows: 'solo',
  navigationStyle: 'round',
  touchenabled: 'on',
  onHoverStop: 'on',
  swipe_velocity: 0.7,
  swipe_min_touches: 1,
  swipe_max_touches: 1,
  drag_block_vertical: false,
  spinner: 'spinner0',
  keyboardNavigation: 'off',
  navigationHAlign: 'center',
  navigationVAlign: 'bottom',
  navigationHOffset: 0,
  navigationVOffset: 20,
  soloArrowLeftHalign: 'left',
  soloArrowLeftValign: 'center',
  soloArrowLeftHOffset: 20,
  soloArrowLeftVOffset: 0,
  soloArrowRightHalign: 'right',
  soloArrowRightValign: 'center',
  soloArrowRightHOffset: 20,
  soloArrowRightVOffset: 0,
  shadow: 0,
  fullWidth: 'on',
  fullScreen: 'off',
  stopLoop: 'off',
  stopAfterLoops: -1,
  stopAtSlide: -1,
  shuffle: 'off',
  autoHeight: 'off',
  forceFullWidth: 'on',
  fullScreenAlignForce: 'off',
  minFullScreenHeight: 0,
  hideNavDelayOnMobile: 1500,
  hideThumbsOnMobile: 'off',
  hideBulletsOnMobile: 'off',
  hideArrowsOnMobile: 'off',
  hideThumbsUnderResolution: 0,
  hideSliderAtLimit: 0,
  hideCaptionAtLimit: 0,
  hideAllCaptionAtLilmit: 0,
  startWithSlide: 0,
  fullScreenOffsetContainer: ''
});
});
</script> 
</div>

<?php 
   
}
}


if ( ! function_exists ( 'magikPvc_sub_banner' ) ) {
function magikPvc_sub_banner()
{
  global $pvc_Options;
  
    ?>
    <div class="container">
    <div class="row"> 
      <!-- Testimonials Box -->
     <?php  if(isset($pvc_Options['enable_testimonial']) && !empty($pvc_Options['enable_testimonial']) && isset($pvc_Options['all_testimonial']) && !empty($pvc_Options['all_testimonial'])) { ?>
      <div class="col-md-6 col-sm-12 testimonials">
        <?php magikPvc_home_testimonial();?>
      </div>
      <?php } ?>
<?php
      if(isset($pvc_Options['enable_home_bottom_slider']) && $pvc_Options['enable_home_bottom_slider']  && isset($pvc_Options['home_page_bottom_slider']) && !empty($pvc_Options['home_page_bottom_slider'])) { 
       
        ?>
      <div class="col-md-6 col-sm-12 custom-slider-wrap">
        <div class="custom-slider-inner">
          <div class="home-custom-slider">
            <div>
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <?php $j=0; ?>
                  <?php foreach ($pvc_Options['home_page_bottom_slider'] as $slide) : ?>
                  <li class="<?php if($j==0){ ?> active <?php }?>" data-target="#carousel-example-generic" data-slide-to="<?php echo esc_html($j) ;?>"></li>
                   <?php 
                     $j++;
                    endforeach; ?>
                </ol>

                <div class="carousel-inner">

                <?php 
                 $i=0;
                foreach ($pvc_Options['home_page_bottom_slider'] as $slide) : ?>

                  <div class="item <?php if($i==0){ ?> active <?php }?>">    
                    <img src="<?php echo esc_url($slide['image']); ?>" alt="<?php echo esc_attr($slide['title']); ?>"/> 
                   
                      <div class="carousel-caption">
                        <?php echo htmlspecialchars_decode($slide['description']); ?>
                      </div>
                  

                  </div>
                 
                    <?php 
                     $i++;
                    endforeach; ?>
                </div>
                
                <a class="left carousel-control" href="#" data-slide="prev"> <span class="sr-only"><?php esc_attr_e('Previous','pvc');?></span> </a> <a class="right carousel-control" href="#" data-slide="next"> <span class="sr-only">
                <?php esc_attr_e('Next','pvc');?></span> </a></div>
            </div>
          </div>
        </div>
      </div>

      <?php } ?>
    </div>
  </div>
    <?php

}
}


if ( ! function_exists ( 'magikPvc_header_service' ) ) {
function magikPvc_header_service()
{
    global $pvc_Options;

if (isset($pvc_Options['header_show_info_banner']) && !empty($pvc_Options['header_show_info_banner'])) :
                  ?>
    <div class="our-features-box hidden-xs">
    <div class="container">
      <div class="features-block">

          <?php if (isset($pvc_Options['header_shipping_banner']) && !empty($pvc_Options['header_shipping_banner'])) : ?>
          <div class="col-md-3 col-xs-12 col-sm-6">
          <div class="feature-box first"> <span class="fa fa-truck"></span>
            <div class="content">
              <?php echo htmlspecialchars_decode($pvc_Options['header_shipping_banner']); ?>
            </div>
          </div>
        </div>
        
         <?php endif; ?>
                 
         <?php if (isset($pvc_Options['header_customer_support_banner']) &&  !empty($pvc_Options['header_customer_support_banner'])) : ?>
          <div class="col-md-3 col-xs-12 col-sm-6">
          <div class="feature-box"> <span class="fa fa-headphones"></span>
            <div class="content">
              <?php echo htmlspecialchars_decode($pvc_Options['header_customer_support_banner']); ?>
            
          </div>
         </div>
       </div>

        <?php endif; ?>
                    
      <?php if (isset($pvc_Options['header_moneyback_banner']) &&  !empty($pvc_Options['header_moneyback_banner'])) : ?>
      <div class="col-md-3 col-xs-12 col-sm-6">
          <div class="feature-box"> <span class="fa fa-dollar"></span>
            <div class="content">
             <?php echo htmlspecialchars_decode($pvc_Options['header_moneyback_banner']); ?>
             </div>
          </div>
        </div>
        
         <?php endif; ?>
       <?php if (isset($pvc_Options['header_returnservice_banner']) &&  !empty($pvc_Options['header_returnservice_banner'])) : ?>
       <div class="col-md-3 col-xs-12 col-sm-6">
          <div class="feature-box last"> <span class="fa fa-mobile"></span>
            <div class="content">
               <?php echo htmlspecialchars_decode($pvc_Options['header_returnservice_banner']); ?>
           </div>
          </div>
        </div>
        
         <?php endif; ?>
      </div>

       
        </div>
        </div>

    <?php
   
     endif;
}
}



if ( ! function_exists ( 'magikPvc_home_offer_banners' ) ) {
function magikPvc_home_offer_banners()
{
    global $pvc_Options;

  if ($pvc_Options['enable_home_offer_banners'] && !empty($pvc_Options['enable_home_offer_banners'])){
        ?>
        <!-- banner -->
 <div class="promotion-banner">
    <div class="container">
      <div class="row">

        <?php if (isset($pvc_Options['home-offer-banner1']) && !empty($pvc_Options['home-offer-banner1']['url'])) : ?>
          <div class="col-lg-4 col-sm-4">         
          <a href="<?php echo !empty($pvc_Options['home-offer-banner1-url']) ? esc_url($pvc_Options['home-offer-banner1-url']) : '#' ?>" title="<?php esc_attr_e('link', 'pvc');?>">
            
                <img alt="<?php esc_attr_e('offer banner1', 'pvc'); ?>" src="<?php echo esc_url($pvc_Options['home-offer-banner1']['url']); ?>">
          </a>        
        </div>
        <?php endif; ?>
        <?php if (isset($pvc_Options['home-offer-banner2']) && !empty($pvc_Options['home-offer-banner2']['url'])) : ?>
          <div class="col-lg-5 col-sm-5 last">     
          <a href="<?php echo !empty($pvc_Options['home-offer-banner2-url']) ? esc_url($pvc_Options['home-offer-banner2-url']) : '#' ?>" title="<?php  esc_attr_e('link', 'pvc');?>">
            
                <img alt="<?php esc_attr_e('offer banner2', 'pvc'); ?>" src="<?php echo esc_url($pvc_Options['home-offer-banner2']['url']); ?>">
          </a>    
        </div>
        <?php endif; ?>
        
        <?php if (isset($pvc_Options['home-offer-banner3']) && !empty($pvc_Options['home-offer-banner3']['url'])) : ?>
          <div class="col-lg-3 col-sm-3 last">
          <a href="<?php echo !empty($pvc_Options['home-offer-banner3-url']) ? esc_url($pvc_Options['home-offer-banner3-url']) : '#' ?>" title="<?php esc_attr_e('link', 'pvc');?>">
            
                <img alt="<?php esc_attr_e('offer banner3', 'pvc'); ?>" src="<?php echo esc_url($pvc_Options['home-offer-banner3']['url']); ?>">
          </a>
        </div>
        <?php endif; ?>
          
            </div>
        </div>
    </div>
    <!-- end banner -->

    <?php } 
} } //function ends here


if ( ! function_exists ( 'magikPvc_footer_signupform' ) ) {
function magikPvc_footer_signupform()
{
  global $pvc_Options;
if (isset($pvc_Options['enable_mailchimp_form']) && !empty($pvc_Options['enable_mailchimp_form'])) {
 if(function_exists('mc4wp_show_form'))
  {
  ?> 
<div class="newsletter-wrap">
<div class="container">
<div class="row">
<div class="col-xs-12">      
 <div class="newsletter">
  <?php
    mc4wp_show_form();
   ?>
           
   </div>
</div>
</div>
</div>
 </div>

  <?php
    } 
    }  

}
}


if ( ! function_exists ( 'magikPvc_footer_middle' ) ) {
function magikPvc_footer_middle()
{
  global $pvc_Options;
 
 if (isset($pvc_Options['enable_footer_middle']) && !empty($pvc_Options['footer_middle']))
  {?>
<div class="payment-accept">
     
  <?php echo htmlspecialchars_decode($pvc_Options['footer_middle']);?>
</div>       
   <?php  
    } 
}
}



if ( ! function_exists ( 'magikPvc_featured_products' ) ) {
function magikPvc_featured_products()
{
    global $pvc_Options;
    if (isset($pvc_Options['enable_home_featured_products']) && !empty($pvc_Options['enable_home_featured_products'])) {
        ?>

  <div class="new-arrivals-pro">
    <div class="container">
      <div class="row">
      
        <div class="col-md-3 col-sm-4 col-xs-12 featured-add-box">
          <div class="featured-add-inner"> 
            <?php if (isset($pvc_Options['featured_image']) &&  !empty($pvc_Options['featured_image']['url']))
                  { ?>
                  <a href="<?php echo !empty($pvc_Options['featured_product_url']) ? esc_url($pvc_Options['featured_product_url']) : '#' ?>">
                    <img src="<?php echo esc_url($pvc_Options['featured_image']['url']); ?>" 
                    alt="<?php esc_attr_e('featured_image', 'pvc'); ?>"> 
                   </a>
                 <div class="banner-content">
                   <?php if (isset($pvc_Options['featured_image-text']) &&  !empty($pvc_Options['featured_image-text']))
                  { ?>
                  <?php echo htmlspecialchars_decode($pvc_Options['featured_image-text']);?>
                    <?php } ?>
                  <a href="<?php echo !empty($pvc_Options['featured_product_url']) ? esc_url($pvc_Options['featured_product_url']) : '#' ?>" class="view-bnt">
                    <?php esc_attr_e('Shop now','pvc'); ?></a>
                 </div> 
                <?php } ?> 
          </div>
        </div>
        
        <div class="col-md-9 col-sm-8 col-xs-12 featured-pro-block">
          <div class="slider-items-products">
            <div class="new-arrivals-block">
              <div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
                <div class="home-block-inner">
                  <div class="block-title">
                    <h2><?php esc_attr_e('Featured Product', 'pvc'); ?></h2>
                  </div>
                </div>
                <div class="slider-items slider-width-col4 products-grid block-content">

                <?php
                $args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'meta_key' => '_featured',
                    'meta_value' => 'yes',                   
                    'posts_per_page' => $pvc_Options['featured_per_page']
                  
                );
                $loop = new WP_Query($args);
                if ($loop->have_posts()) {
                    while ($loop->have_posts()) : $loop->the_post();
                        magikPvc_productitem_template();
                    endwhile;
                } else {
                    esc_attr_e('No products found','pvc');
                }

                wp_reset_postdata();
                ?>

            </div>
           </div>
          </div>
         </div>
        </div>
      </div>
   </div>
   </div>
    <?php
    }
}
}


if ( ! function_exists ( 'magikPvc_bestseller_products' ) ) {
function magikPvc_bestseller_products()
{
   global $pvc_Options;

if (isset($pvc_Options['enable_home_bestseller_products']) && !empty($pvc_Options['enable_home_bestseller_products'])) { 
  ?>
  <div class="bestsell-pro">
    <div class="container">
      <div class="slider-items-products">
        <div class="bestsell-block">
          <div id="bestsell-slider" class="product-flexslider hidden-buttons">
            <div class="home-block-inner">
                
                    <?php if (isset($pvc_Options['bestseller_image']) &&  !empty($pvc_Options['bestseller_image']['url']))
                  {?>
                   
                  <a href="<?php echo !empty($pvc_Options['bestseller_product_url']) ? esc_url($pvc_Options['bestseller_product_url']) : '#' ?>">
                    <img src="<?php echo esc_url($pvc_Options['bestseller_image']['url']); ?>" 
                    alt="<?php esc_attr_e('bestseller_image', 'pvc'); ?>"></a>  
                   
              <div class="banner-content">
                   <?php  if (isset($pvc_Options['bestseller_image-text']) && !empty($pvc_Options['bestseller_image-text'])) { ?>
                  <?php echo htmlspecialchars_decode($pvc_Options['bestseller_image-text']);?>
                  <?php } ?>
                  <a href="<?php echo !empty($pvc_Options['bestseller_product_url']) ? esc_url($pvc_Options['bestseller_product_url']) : '#' ?>" class="view-bnt">
                    <?php esc_attr_e('Shop now','pvc'); ?></a>
           
            </div>
                    
                    <?php } ?>
                 
            </div>
            <div class="block-title">
             <h2><?php esc_attr_e('Best Sellers', 'pvc'); ?></h2>
              <div class="hidden-xs hidden-sm">
                  <?php  if (isset($pvc_Options['home_bestseller_products-text']) && !empty($pvc_Options['home_bestseller_products-text'])) { ?>

                   <?php echo htmlspecialchars_decode($pvc_Options['home_bestseller_products-text']);?>
                     <?php } ?>
              </div>
            </div>
            
            <div class="slider-items slider-width-col4 products-grid block-content">

        <!-- best seller category fashion -->
     
<?php
                
                              $args = array(
                              'post_type'       => 'product',
                              'post_status'       => 'publish',
                              'ignore_sticky_posts'   => 1,
                              'posts_per_page' => $pvc_Options['bestseller_per_page'],      
                              'meta_key'        => 'total_sales',
                              'orderby'         => 'meta_value_num',
                              
                              );

                                $loop = new WP_Query( $args );
                             
                                if ( $loop->have_posts() ) {
                                while ( $loop->have_posts() ) : $loop->the_post();                  
                                magikPvc_productitem_template();
                                endwhile;
                                } else {
                                esc_attr_e('No products found','pvc');
                                }

                               wp_reset_postdata();
                             
                             
?>
 </div>
</div>
</div>
</div>
</div>
</div>

 <?php  } ?>

<?php 

}
}



if ( ! function_exists ( 'magikPvc_new_products' ) ) {
function magikPvc_new_products()
{
   global $pvc_Options;

if (isset($pvc_Options['enable_home_new_products']) && !empty($pvc_Options['enable_home_new_products']) && !empty($pvc_Options['home_newproduct_categories'])) { 
  ?>
 <div class="content-page">
    <div class="container"> 
      <!-- new product category product -->
      <div class="category-product">
        <div class="navbar nav-menu">
          <div class="navbar-collapse">
            <ul class="nav navbar-nav">
              <li>
                <div class="new_title">
                 <h2><?php esc_attr_e('New products', 'pvc'); ?></h2>
                </div>
              </li>
            
          
<?php
$catloop=1;
 foreach($pvc_Options['home_newproduct_categories'] as $category)
 {
  $term = get_term_by( 'id', $category, 'product_cat', 'ARRAY_A' );
  
  ?>
   <li class="<?php if($catloop==1){?> active <?php } ?>">
    <a href="#newcat-<?php echo esc_html($category) ?>" data-toggle="tab"><?php echo esc_html($term['name']); ?>
    </a>
  </li>

  <?php 
  $catloop++;
  } 
  ?>

 </ul>
    
  </div>
</div>

  <!-- Tab panes -->
  <div class="product-bestseller">
          <div class="product-bestseller-content">
            <div class="product-bestseller-list">
              <div class="tab-container"> 

    <?php 
    $contentloop=1;
  foreach($pvc_Options['home_newproduct_categories'] as $catcontent)
 {
   $term = get_term_by( 'id', $catcontent, 'product_cat', 'ARRAY_A' );
?>
     <div class="tab-panel <?php if($contentloop==1){?> active <?php } ?>" id="newcat-<?php echo esc_html($catcontent); ?>">
      <div class="category-products">
       <ul class="products-grid">
<?php

 $args = array(
            'post_type'    => 'product',
            'post_status' => 'publish',
            'ignore_sticky_posts'    => 1,
            'posts_per_page' => 4,
            
             'orderby' => 'date',
            'order' => 'DESC',
            'tax_query' => array(
                
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $catcontent
                )
            ),

                
        );

                                $loop = new WP_Query( $args );
                             
                                if ( $loop->have_posts() ) {
                                while ( $loop->have_posts() ) : $loop->the_post();                  
                                magikPvc_newproduct_template();
                                endwhile;
                                } else {
                                esc_attr_e('No products found', 'pvc' );
                                }

                               wp_reset_postdata();
                               $contentloop++;
                             
?>

        </ul>
            </div>   
            </div>
 <?php  } ?>

    </div>
                        
  </div>
</div>
</div>
</div>
</div>
</div>


<?php 
}
}
}


if ( ! function_exists ( 'magikPvc_hotdeal_product' ) ) {
function magikPvc_hotdeal_product()
{
   global $pvc_Options;
if (isset($pvc_Options['enable_home_hotdeal_products']) && !empty($pvc_Options['enable_home_hotdeal_products'])) { 
  
  ?>
    <ul class="products-grid">

<?php
       $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 1,
            'meta_key' => 'hotdeal_on_home',
            'meta_query'     => array(
          
              array(
                    'relation' => 'OR',
                    array( // Simple products type
                        'key'           => '_sale_price',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    ),
                  
                    array( // Variable products type
                        'key'           => '_min_variation_sale_price',
                        'value'         => 0,
                        'compare'       => '>',
                        'type'          => 'numeric'
                    )
                    )
                 
                )
        );

        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) {
            while ( $loop->have_posts() ) : $loop->the_post();
              magikPvc_hotdeal_template();
            
            endwhile;
        } else {
             esc_attr_e('No products found','pvc');
        }
        wp_reset_postdata();
    ?>

      </ul>
         
  <?php
}
}
}




if ( ! function_exists ( 'magikPvc_newproduct_template' ) ) {
function magikPvc_newproduct_template()
{
  $MagikPvc = new MagikPvc();
  global $product, $woocommerce_loop, $yith_wcwl,$post;
   $imageUrl = woocommerce_placeholder_img_src();
   if (has_post_thumbnail())
      $imageUrl =  wp_get_attachment_image_src(get_post_thumbnail_id(),'magikPvc-product-size-large');
   
   ?>
 <li class="item col-lg-3 col-md-3 col-sm-4 col-xs-6">
     <div class="item-inner">
      <div class="item-img">
         <div class="item-img-info">
            <a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars_decode($post->post_title); ?>" class="product-image">
               <figure class="img-responsive">
            <img alt="<?php echo htmlspecialchars_decode($post->post_title); ?>" src="<?php echo esc_url($imageUrl[0]); ?>">
             </figure>

             </a>
            <?php if ($product->is_on_sale()) : ?>
            <div class="sale-label sale-top-left">
               <?php esc_attr_e('Sale', 'pvc'); ?>
            </div>
            <?php endif; ?>

            <div class="box-hover">
                  <ul class="add-to-links">
                     
                  <?php if (class_exists('YITH_WCQV_Frontend')) { ?>
                        <li><a class="yith-wcqv-button link-quickview" href="#"
                                        data-product_id="<?php echo esc_html($product->id); ?>"><?php esc_attr_e('Quick View', 'pvc'); ?></a> </li>
                 <?php } ?>
                   
                   
                              <?php
                               if (isset($yith_wcwl) && is_object($yith_wcwl)) {
                            $classes = get_option('yith_wcwl_use_button') == 'yes' ? 'class="link-wishlist"' : 'class="link-wishlist"';
                            ?>
                               <li>
                            <a href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>"  data-product-id="<?php echo esc_html($product->id); ?>"
                              data-product-type="<?php echo esc_html($product->product_type); ?>" <?php echo htmlspecialchars_decode($classes); ?>
                                ><?php esc_attr_e('Wishlist', 'pvc'); ?></a> 
                                 </li>
                             <?php
                               }
                               ?>
                   
                   
                              <?php if (class_exists('YITH_Woocompare_Frontend')) {
                               $mgk_yith_cmp = new YITH_Woocompare_Frontend; ?>      
                              <li> <a href="<?php echo esc_url($mgk_yith_cmp->add_product_url($product->id)); ?>" class="compare link-compare add_to_compare" data-product_id="<?php echo esc_html($product->id); ?>"
                                ><?php esc_attr_e('Compare', 'pvc'); 
                              ?></a></li>
                              <?php
                              }
                             ?> 
                    
                </ul>
            </div>

            
         </div>
      </div>
      <div class="item-info">
         <div class="info-inner">
            <div class="item-title"><a href="<?php the_permalink(); ?>"
               title="<?php echo htmlspecialchars_decode($post->post_title); ?>"> <?php echo htmlspecialchars_decode($post->post_title); ?> </a>
            </div>
            <div class="item-content">
               <div class="rating">
                  <div class="ratings">
                     <div class="rating-box">
                        <?php $average = $product->get_average_rating(); ?>
                        <div style="width:<?php echo esc_html(($average / 5) * 100); ?>%" class="rating"> </div>
                     </div>
                  </div>
               </div>
               <div class="item-price">
                  <div class="price-box">
                    <span class="regular-price"> 
                          <?php echo htmlspecialchars_decode($product->get_price_html()); ?>
                     </span>
                    
                  </div>
               </div>
               <div class="action">
                     <?php magikPvc_woocommerce_product_add_to_cart_text() ;?>
                  </div>
            </div>
         </div>
      </div>
   </div>
</li>
<?php

}
}


if ( ! function_exists ( 'magikPvc_productitem_template' ) ) {
function magikPvc_productitem_template()
{
  
  $MagikPvc = new MagikPvc();
  global $product, $woocommerce_loop, $yith_wcwl,$post;
   $imageUrl = woocommerce_placeholder_img_src();
   if (has_post_thumbnail())
      $imageUrl =  wp_get_attachment_image_src(get_post_thumbnail_id(),'magikPvc-product-size-large');
   
   ?>

 <div class="item">
     <div class="item-inner">
      <div class="item-img">
         <div class="item-img-info">
            <a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars_decode($post->post_title); ?>" class="product-image">
               <figure class="img-responsive">
            <img alt="<?php echo htmlspecialchars_decode($post->post_title); ?>" src="<?php echo esc_url($imageUrl[0]); ?>">
             </figure>
             </a>
            <?php if ($product->is_on_sale()) : ?>
             <div class="sale-label sale-top-left">
               <?php esc_attr_e('Sale', 'pvc'); ?>
            </div>
            <?php endif; ?>
                <div class="box-hover">
                  <ul class="add-to-links">
                    
                                    <?php if (class_exists('YITH_WCQV_Frontend')) { ?>
                                        <li> <a class="yith-wcqv-button link-quickview" href="#"
                                        data-product_id="<?php echo esc_html($product->id); ?>"><?php esc_attr_e('Quick View', 'pvc'); ?></a>  </li>
                                     <?php } ?>
                    
                 
                                        <?php
                               if (isset($yith_wcwl) && is_object($yith_wcwl)) {
                            $classes = get_option('yith_wcwl_use_button') == 'yes' ? 'class="link-wishlist"' : 'class="link-wishlist"';
                            ?>
                                 <li><a href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>"  data-product-id="<?php echo esc_html($product->id); ?>"
                              data-product-type="<?php echo esc_html($product->product_type); ?>" <?php echo htmlspecialchars_decode($classes); ?>
                                ><?php esc_attr_e('Wishlist', 'pvc'); ?></a>  
                                  </li>
                             <?php
                               }
                               ?>
                 
                  
                              <?php if (class_exists('YITH_Woocompare_Frontend')) {
                               $mgk_yith_cmp = new YITH_Woocompare_Frontend; ?>      
                               <li> <a href="<?php echo esc_url($mgk_yith_cmp->add_product_url($product->id)); ?>" class="compare link-compare add_to_compare" data-product_id="<?php echo esc_html($product->id); ?>"
                                ><?php esc_attr_e('Compare', 'pvc'); 
                              ?></a>
                              </li>
                              <?php
                              }
                             ?> 
                    
                </ul>
            </div>
         </div>
      </div>
      <div class="item-info">
         <div class="info-inner">
            <div class="item-title"><a href="<?php the_permalink(); ?>"
               title="<?php echo htmlspecialchars_decode($post->post_title); ?>"> <?php echo htmlspecialchars_decode($post->post_title); ?> </a>
            </div>
            <div class="item-content">
               <div class="rating">
                  <div class="ratings">
                     <div class="rating-box">
                        <?php $average = $product->get_average_rating(); ?>
                        <div style="width:<?php echo esc_html(($average / 5) * 100); ?>%" class="rating"> </div>
                     </div>
                  </div>
               </div>
               <div class="item-price">
                  <div class="price-box">
                    <?php echo htmlspecialchars_decode($product->get_price_html()); ?>
                  </div>
               </div>
               <div class="action">
                     <?php wl_woocommerce_product_add_to_cart_text() ;?>
                  </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php

}
}



if ( ! function_exists ( 'magikPvc_related_upsell_template' ) ) {
function magikPvc_related_upsell_template()
{
  $MagikPvc = new MagikPvc();
 global $product, $woocommerce_loop, $yith_wcwl,$post;

 echo "DEZE!";
$imageUrl = woocommerce_placeholder_img_src();
if (has_post_thumbnail())
    $imageUrl =  wp_get_attachment_image_src(get_post_thumbnail_id(),'magikPvc-product-size-large');  
    
?>
<!-- Item -->
<div class="item">
<div class="item-inner">
   <div class="item-img">
      <div class="item-img-info">
         <a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars_decode($post->post_title); ?>" class="product-image">
           <figure class="img-responsive">
          <img alt="<?php echo htmlspecialchars_decode($post->post_title); ?>" src="<?php echo esc_url($imageUrl[0]); ?>">
          </figure>
           </a>
             <?php if ($product->is_on_sale()) : ?>
            <div class="sale-label sale-top-left">
               <?php esc_attr_e('Sale', 'pvc'); ?>
            </div>
            <?php endif; ?>
                <div class="box-hover">
                  <ul class="add-to-links">
                      <li>
                                    <?php if (class_exists('YITH_WCQV_Frontend')) { ?>
                                       <a class="yith-wcqv-button link-quickview" href="#"
                                        data-product_id="<?php echo esc_html($product->id); ?>"><?php esc_attr_e('Quick View', 'pvc'); ?></a>
                                     <?php } ?>
                      </li>
                      <li>
                                        <?php
                               if (isset($yith_wcwl) && is_object($yith_wcwl)) {
                            $classes = get_option('yith_wcwl_use_button') == 'yes' ? 'class="link-wishlist"' : 'class="link-wishlist"';
                            ?>
                            <a href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>"  data-product-id="<?php echo esc_html($product->id); ?>"
                              data-product-type="<?php echo esc_html($product->product_type); ?>" <?php echo htmlspecialchars_decode($classes); ?>
                                ><?php esc_attr_e('Wishlist', 'pvc'); ?></a> 
                             <?php
                               }
                               ?>
                    </li>
                    <li>
                              <?php if (class_exists('YITH_Woocompare_Frontend')) {
                               $mgk_yith_cmp = new YITH_Woocompare_Frontend; ?>      
                              <a href="<?php echo esc_url($mgk_yith_cmp->add_product_url($product->id)); ?>" class="compare link-compare add_to_compare" data-product_id="<?php echo esc_html($product->id); ?>"
                                ><?php esc_attr_e('Compare', 'pvc'); 
                              ?></a>
                              <?php
                              }
                             ?> 
                    </li>
                </ul>
            </div>
      </div>
   </div>
   <div class="item-info">
      <div class="info-inner">
         <div class="item-title"><a href="<?php the_permalink(); ?>"
                                               title="<?php echo htmlspecialchars_decode($post->post_title); ?>"> <?php echo htmlspecialchars_decode($post->post_title); ?> </a> </div>
         <div class="item-content">
            <div class="rating">
               <div class="ratings">
                  <div class="rating-box">
                    <?php $average = $product->get_average_rating(); ?>
                     <div class="rating"  style="width:<?php echo esc_html(($average / 5) * 100); ?>%"></div>
                  </div>
                  
               </div>
            </div>
            <div class="item-price">
               <div class="price-box"><?php echo htmlspecialchars_decode($product->get_price_html()); ?></div>
            </div>
            <div class="action">
                     <?php magikPvc_woocommerce_product_add_to_cart_text() ;?>
                  </div>
         </div>
      </div>
   </div>
</div>
</div>
<?php
}
}



if ( ! function_exists ( 'magikPvc_hotdeal_template' ) ) {
function magikPvc_hotdeal_template()
{
$MagikPvc = new MagikPvc();
 global $product, $woocommerce_loop, $yith_wcwl,$post;
   $imageUrl = woocommerce_placeholder_img_src();
   if (has_post_thumbnail())
        $imageUrl = wp_get_attachment_url(get_post_thumbnail_id());

             $product_type = $product->product_type;
            
              if($product_type=='variable')
              {
               $available_variations = $product->get_available_variations();
               $variation_id=$available_variations[0]['variation_id'];
                $newid=$variation_id;
              }
              else
              {
                $newid=$post->ID;
           
              }                                    
               $sales_price_to = get_post_meta($newid, '_sale_price_dates_to', true);  
               if(!empty($sales_price_to))
               {
               $sales_price_date_to = date("Y/m/d", $sales_price_to);
               } 
               else{
                $sales_price_date_to='';
              } 
               $curdate=date("m/d/y h:i:s A");                         
?> 
         
        <li class="right-space two-height item">
          <div class="item-inner">

            <div class="item-img">
            <div class="item-img-info">
            <a href="<?php the_permalink(); ?>" title="<?php echo htmlspecialchars_decode($post->post_title); ?>" class="product-image">
            <figure class="img-responsive">
            <img alt="<?php echo htmlspecialchars_decode($post->post_title); ?>" src="<?php echo esc_url($imageUrl); ?>">
              </figure>
             </a>
            <?php if ($product->is_on_sale()) : ?>
            <div class="hot-label hot-top-left">
               <?php esc_attr_e('Hot Deal', 'pvc'); ?>
            </div>
            <?php endif; ?>

                    
              <div class="box-hover">
                 <ul class="add-to-links">
                     <?php if (class_exists('YITH_WCQV_Frontend')) { ?>
                                        <li>
                                       <a class="yith-wcqv-button link-quickview" href="#"
                                        data-product_id="<?php echo esc_html($product->id); ?>"><?php esc_attr_e('Quick View', 'pvc'); ?></a>
                                           </li>
                      <?php } ?>
                   
                
                            <?php
                               if (isset($yith_wcwl) && is_object($yith_wcwl)) {
                            $classes = get_option('yith_wcwl_use_button') == 'yes' ? 'class="link-wishlist"' : 'class="link-wishlist"';
                            ?>
                           <li>
                            <a href="<?php echo esc_url($yith_wcwl->get_addtowishlist_url()) ?>"  data-product-id="<?php echo esc_html($product->id); ?>"
                              data-product-type="<?php echo esc_html($product->product_type); ?>" <?php echo htmlspecialchars_decode($classes); ?>
                                ><?php esc_attr_e('Wishlist', 'pvc'); ?></a> 
                                  </li>
                             <?php
                               }
                               ?>
                  
                  
                              <?php if (class_exists('YITH_Woocompare_Frontend')) {
                               $mgk_yith_cmp = new YITH_Woocompare_Frontend; ?>  
                                 <li>    
                              <a href="<?php echo esc_url($mgk_yith_cmp->add_product_url($product->id)); ?>" class="compare link-compare add_to_compare" data-product_id="<?php echo esc_html($product->id); ?>"
                                ><?php esc_attr_e('Compare', 'pvc'); 
                              ?></a>
                            </li>
                              <?php
                              }
                             ?> 
                  
                </ul>
            </div>

           <div class="box-timer">
         <div class="countbox_1 timer-grid"  data-time="<?php echo esc_html($sales_price_date_to) ;?>">
          </div>
         </div>

        </div>
        </div>


         <div class="item-info">
         <div class="info-inner">
            <div class="item-title"><a href="<?php the_permalink(); ?>"
               title="<?php echo htmlspecialchars_decode($post->post_title); ?>"> <?php echo htmlspecialchars_decode($post->post_title); ?> </a>
            </div>
            <div class="item-content">
               <div class="rating">
                  <div class="ratings">
                     <div class="rating-box">
                        <?php $average = $product->get_average_rating(); ?>
                        <div style="width:<?php echo esc_html(($average / 5) * 100); ?>%" class="rating"> </div>
                     </div>
                  </div>
               </div>
               <div class="item-price">
                  <div class="price-box">
                    <?php echo htmlspecialchars_decode($product->get_price_html()); ?>
                  </div>
               </div>
               <div class="action">
               <?php magikPvc_woocommerce_product_add_to_cart_text() ;?>
              </div>
          </div>
         </div>
      </div>


                 
   </div>
</li>
<?php
}
}

if ( ! function_exists ( 'magikPvc_footer_brand_logo' ) ) {
function magikPvc_footer_brand_logo()
  {
    global $pvc_Options;
    if (isset($pvc_Options['enable_brand_logo']) && $pvc_Options['enable_brand_logo'] && !empty($pvc_Options['all-company-logos'])) : ?>
    
    <div class="brand-logo">
    <div class="container">
      <div class="slider-items-products">
        <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col6"> 
            
            <!-- Item -->
            
                   <?php foreach ($pvc_Options['all-company-logos'] as $_logo) : ?>
                  <div class="item">
                    <a href="<?php echo esc_url($_logo['url']); ?>" target="_blank"> <img
                        src="<?php echo esc_url($_logo['image']); ?>" 
                        alt="<?php echo esc_attr($_logo['title']); ?>"> </a>
                  </div>
                  <?php endforeach; ?>
                
      </div>
    </div>
  </div>
  </div>
  </div>

    
  <?php endif;
  }
}

if ( ! function_exists ( 'magikPvc_home_testimonial' ) ) {
function magikPvc_home_testimonial()
{
 global $pvc_Options;
?>
        <div class="ts-testimonial-widget"> 
          <div class="slider-items-products">
            <div id="testimonials-slider" class="product-flexslider hidden-buttons home-testimonials">
              <div class="slider-items slider-width-col4 fadeInUp">

  <?php foreach ($pvc_Options['all_testimonial'] as $testimono) :?>

                <div class="holder">
                  <div class="thumb"> 
                      <img src="<?php echo esc_url($testimono['image']); ?>" data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat'
                                        alt="<?php echo esc_html($testimono['title']); ?>"/> 
                  </div>
                  <p><?php echo htmlspecialchars_decode($testimono['description']); ?></p>  

                  <div class="line"></div>
                 
                   <strong class="name">
                      <a href="<?php echo !empty($slide['url']) ? esc_url($testimono['url']) : '#' ?>" target="_blank">
                      <?php echo htmlspecialchars_decode($testimono['title']); ?>       </a>
                  </strong>

                 </div>
    
    <?php endforeach; ?>
               </div>
            </div>
          </div>
        </div>

<?php

}
}




if ( ! function_exists ( 'magikPvc_home_blog_posts' ) ) {
function magikPvc_home_blog_posts()
{
    $count = 0;
    global $pvc_Options;
    $MagikPvc = new MagikPvc();
    if (isset($pvc_Options['enable_home_blog_posts']) && !empty($pvc_Options['enable_home_blog_posts'])) {
        ?>

      <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="blog-outer-container">
          <div class="block-title">
            <h2><?php esc_attr_e('Latest Blog', 'pvc'); ?></h2>
            <div class="hidden-xs">
              <?php echo htmlspecialchars_decode($pvc_Options['home_blog-text']);?>
            </div>
           </div>
          <div class="blog-inner">
            
           
            
        <?php

        $args = array('posts_per_page' => 3, 'post__not_in' => get_option('sticky_posts'));
        $the_query = new WP_Query($args);
           $i=1;  
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) : $the_query->the_post(); ?>
            
                
            <div class="col-lg-4 col-md-4 col-sm-4 blog-preview_item">
              <h4 class="blog-preview_title">
                <a href="<?php the_permalink(); ?>"><?php esc_html(the_title()); ?></a>
              </h4>
              <div class="entry-thumb image-hover2"> 
                    <a href="<?php the_permalink(); ?>">
                                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail'); ?>
                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
                      </a>
              </div>
              <div class="blog-preview_info">
                <ul class="post-meta">
                  <li><i class="fa fa-user"></i><?php esc_attr_e('posted by', 'pvc'); ?>
                     <a href="<?php comments_link(); ?>"><?php the_author(); ?></a> 
                   </li>
                  <li><i class="fa fa-comments"></i><a href="<?php comments_link(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>
                          </a>
                  </li>
                 <li><i class="fa fa-clock-o"></i><?php esc_html(the_time(get_option('date_format'))); ?>
                  </li>
                </ul>
                <div class="blog-preview_desc"><?php the_excerpt(); ?></div>
              <a class="blog-preview_btn" href="<?php the_permalink(); ?>"><?php esc_attr_e('READ MORE','pvc'); ?></a>
            </div>
            </div>

              
            <?php    $i++;
             endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else: ?>
            <p>
                <?php esc_attr_e('Sorry, no posts matched your criteria.', 'pvc'); ?>
            </p>
        <?php endif;
        ?>

            
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
    }
}
}
