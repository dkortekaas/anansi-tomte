<?php
/**
 * Enqueue all styles and scripts
 *
 * @package WordPress
 * @subpackage logiqShop
 */

/** Admin styles and scripts */
// if ( ! function_exists( 'logiqShop_admin_scripts_styles' ) ) :
// function logiqShop_admin_scripts_styles() {  
//     wp_enqueue_script('admin_menu-js', WL_THEME_URI . '/assets/scripts/admin_menu.min.js', array(), '', true);
//     wp_enqueue_style('adminmenu', WL_THEME_URI . '/assets/stylesheet/admin_menu.min.css', array(), '');
// }
// add_action('admin_enqueue_scripts', 'logiqShop_admin_scripts_styles');
// endif;


/** Theme styles and scripts */
if ( ! function_exists( 'logiqShop_scripts_styles' ) ) :
function logiqShop_scripts_styles() {

    // Theme css
    wp_enqueue_style('main-style', WL_THEME_URI. '/assets/css/main.css', array(), '1.1.0', 'all');

    //theme js
    wp_enqueue_script('bootstrap-js', WL_THEME_URI . '/assets/js/bootstrap.min.js', array('jquery'), '', true);      
    wp_enqueue_script('jquery-migrate-js',WL_THEME_URI . '/assets/js/jquery/jquery-migrate.min.js', array('jquery'), '', true);
    wp_enqueue_script('superfish-js',WL_THEME_URI . '/assets/js/superfish.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.colorbox-js', WL_THEME_URI . '/assets/js/jquery.colorbox-min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.easing-js', WL_THEME_URI . '/assets/js/jquery.easing.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.fitvids-js', WL_THEME_URI . '/assets/js/jquery.fitvids.js', array('jquery'), '', true);
    wp_enqueue_script('owl.carousel-js',WL_THEME_URI . '/assets/js/owl.carousel.min.js', array('jquery'), '', true);
    wp_enqueue_script('wow-js', WL_THEME_URI . '/assets/js/wow.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.scrollTo-js', WL_THEME_URI . '/assets/js/jquery.scrollTo.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.localScroll-js',WL_THEME_URI . '/assets/js/jquery.localScroll.min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.viewport-js',WL_THEME_URI . '/assets/js/jquery.viewport.mini.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.flexslider-js',WL_THEME_URI . '/assets/js/jquery.flexslider-min.js', array('jquery'), '', true);
    wp_enqueue_script('jquery.sticky-kit-js',WL_THEME_URI . '/assets/js/jquery.sticky-kit.min.js', array('jquery'), '', true);
    
    wp_enqueue_script('main-js',WL_THEME_URI . '/assets/js/main.js', array('jquery'), '', true);
}
add_action( 'wp_enqueue_scripts', 'logiqShop_scripts_styles' );
endif;
?>