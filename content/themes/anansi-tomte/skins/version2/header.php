<!DOCTYPE html>
<html <?php language_attributes(); ?> id="parallax_scrolling">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
 <?php wp_head(); ?>
</head>
<?php
 $MagikPvc = new MagikPvc(); ?>
<body <?php body_class(); ?> >
  <div id="page" class="page">

 <!-- Header -->
  <header>
    <div class="header-container">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-2 col-sm-3 col-xs-12 logo-block"> 
            <!-- Header Logo -->
            <div class="logo">
             <?php magikPvc_logo_image();?>
            </div>
            <!-- End Header Logo --> 
          </div>
          <!-- Header Language -->
          <div class="col-xs-12 col-sm-9 col-md-9 col-lg-8 pull-right hidden-xs">
           <?php echo magikPvc_currency_language(); ?>
            
            
   
            <?php echo magikPvc_msg(); ?>
       
            
            <!-- Header Top Links -->
            <div class="toplinks">
              <div class="links">
                <?php echo magikPvc_top_navigation(); ?>
             </div>
            </div>
            <!-- End Header Top Links --> 
          </div>
        </div>
      </div>
    </div>
  </header>
      
<nav>
    <div class="container">
      <div>
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 hidden-xs nav-icon">
          <div class="mega-container visible-lg visible-md visible-sm">
            <?php  if ( has_nav_menu('main_menu') )
             { ?>
            <div class="navleft-container">

                <div class="mega-menu-title">
                <h3><i class="fa fa-navicon"></i>
                 <?php esc_attr_e('All Categories', 'pvc'); ?></h3>
              </div>
              
              <div class="mega-menu-category">
                               
                  <?php echo magikPvc_home_mobile_menu(); ?>                       
                                               
             
             </div>
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-7 col-md-5 col-sm-5 col-xs-3 hidden-xs category-search-form">
          <div class="search-box">
            <?php echo magikPvc_search_form(); ?>
          </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 card_wishlist_area">
  
            <div class="mm-toggle-wrap">
              <div class="mm-toggle mobile-toggle"><i class="fa fa-align-justify "></i>
                <span class="mm-label"><?php esc_attr_e('Menu','pvc');?></span> </div>
              </div>
        
                         <?php
                          if (class_exists('WooCommerce')) {
                          ?>
                          <div class="top-cart-contain">
                          <?php magikPvc_mini_cart(); ?>
                          </div>
                          <?php
                          }
                          ?>

           
          <!-- mgk wishlist -->
          
          <?php
            if (class_exists('YITH_WCQV_Frontend')) {
              if (function_exists('YITH_WCWL')) {
                   $wishlist_url = YITH_WCWL()->get_wishlist_url();
                            
                            ?>
        <div class="mgk-wishlist"><a href="<?php echo esc_url($wishlist_url); ?>"><i class="fa fa-heart"></i><span class="title-wishlist hidden-xs"><?php esc_attr_e('Wishlist', 'pvc'); ?></span></a> </div>
        <?php }
      }
         ?>

        </div>
      </div>
    </div>
  </nav>

    
    <!-- end header -->
    <?php if (class_exists('WooCommerce') && is_woocommerce()) : ?>
    
   <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
              <?php woocommerce_breadcrumb(); ?>
          </div>
          <!--col-xs-12--> 
        </div>
        <!--row--> 
      </div>
      <!--container--> 
    </div>

    <?php endif; ?>

