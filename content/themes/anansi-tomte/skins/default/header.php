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
  <header>
    <div class="header-container">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 logo-block"> 
          
            <div class="logo">
             <?php magikPvc_logo_image();?>
            </div>
        
          </div>
          <div class="col-lg-4 col-md-3 col-sm-4 col-xs-3 hidden-xs category-search-form">
            <div class="search-box">
              <?php echo magikPvc_search_form(); ?>
            </div>
          </div>
          
          <div class="col-xs-12 col-sm-6 col-md-7 col-lg-6 pull-right hidden-xs">
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
  <!-- end header -->

  <nav>
    <div class="container">
      <div class="mm-toggle-wrap">
        <a class="mobile-toggle mm-toggle"><i class="fa fa-align-justify"><span class="mm-label"><?php esc_attr_e('Menu','pvc');?></span></i></a>
      </div>
      <div class="nav-inner"> 
         <div class="mgk-main-menu">
              <div id="main-menu">
                  <?php echo magikPvc_main_menu(); ?>                       
                 
                 <?php
                    if (class_exists('WooCommerce')) {
                      ?>
                      <div class="top-cart-contain"> 
                    <?php
                          magikPvc_mini_cart();
                        ?>
                        </div> 
                              
                          <?php }
                     ?>
                    
              </div>
          </div> 
         
      
    </div>
    </div>
  </nav>
  <!-- end nav -->
  
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