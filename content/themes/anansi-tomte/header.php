<!DOCTYPE html>
<html <?php language_attributes(); ?> id="parallax_scrolling">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="//gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-101944962-1', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body <?php body_class(); ?>>
    <div class="wrapper">
        <header class="site-header">
            <div class="header-inner have-scroll">
                <div class="container white">
                    <div class="row">
                        <div class="header-table col-md-12">
                            <?php //echo wl_top_navigation(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="brand">
                                        <a href="<?php echo esc_url(get_home_url()); ?>" title="<?php bloginfo('name'); ?>">
                                            <img src="<?php echo get_template_directory_uri()?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" />
                                        </a>
                                    </div>
                                </div>                      
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <nav id="nav-wrap" class="main-nav">
                                        <div id="mobnav-btn"> </div>
                                        <?php echo wl_main_menu(); ?>
                                        <?php if (class_exists('WooCommerce')) : ?>
                                         <div class="mini-menu">
                                            <div class="top-cart-contain">
                                                <?php echo do_action('wpml_add_language_selector'); ?>
                                                <?php if(ICL_LANGUAGE_CODE=='nl'): ?>
                                                <?php wl_mini_cart(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                         <?php endif; ?>
                                   </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="container white">
        <div class="clear"></div>
        <div class="page-content">