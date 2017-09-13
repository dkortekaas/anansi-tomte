<?php
/**
 * Register widget areas
 *
 * @package WordPress
 * @subpackage Weblogiq
 */

if ( ! function_exists( 'logiqShop_widgets_init' ) ) :
function logiqShop_widgets_init() {
    register_sidebar(array(
      'name' => esc_html__('Blog Sidebar', 'anansi-tomte'),
      'id' => 'sidebar-blog',
      'description' => esc_html__('Sidebar that appears on the right of Blog and Search page.', 'anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h3 class="block-title">',
      'after_title' => '</h3>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Contact Sidebar', 'anansi-tomte'),
      'id' => 'sidebar-contact',
      'description' => esc_html__('Sidebar that appears on the right of Contact page.', 'anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h3 class="block-title">',
      'after_title' => '</h3>',
    ));    
    register_sidebar(array(
      'name' => esc_html__('Shop Sidebar','anansi-tomte'),
      'id' => 'sidebar-shop',
      'description' => esc_html__('Main sidebar that appears on the left.', 'anansi-tomte'),
      'before_widget' => '<div id="%1$s" class="block %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="block-title">',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Content Sidebar Left', 'anansi-tomte'),
      'id' => 'sidebar-content-left',
      'description' => esc_html__('Additional sidebar that appears on the left.','anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="block-title">',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Content Sidebar Right', 'anansi-tomte'),
      'id' => 'sidebar-content-right',
      'description' => esc_html__('Additional sidebar that appears on the right.', 'anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="block-title">',
      'after_title' => '</h4>',
    ));
   
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 1','anansi-tomte'),
      'id' => 'footer-sidebar-1',
      'description' => esc_html__('Appears in the footer section of the site.','anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="footer-widget-title">',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 2', 'anansi-tomte'),
      'id' => 'footer-sidebar-2',
      'description' => esc_html__('Appears in the footer section of the site.', 'anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="footer-widget-title">',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 3', 'anansi-tomte'),
      'id' => 'footer-sidebar-3',
      'description' => esc_html__('Appears in the footer section of the site.','anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="footer-widget widget_nav_menu %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="footer-widget-title">',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 4', 'anansi-tomte'),
      'id' => 'footer-sidebar-4',
      'description' => esc_html__('Appears in the footer section of the site.', 'anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="footer-widget widget_nav_menu %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="footer-widget-title">',
      'after_title' => '</h4>',
    ));
    register_sidebar(array(
      'name' => esc_html__('Footer Widget Area 5', 'anansi-tomte'),
      'id' => 'footer-sidebar-5',
      'description' => esc_html__('Appears in the footer section of the site.', 'anansi-tomte'),
      'before_widget' => '<aside id="%1$s" class="footer-widget widget_nav_menu %2$s">',
      'after_widget' => '</aside>',
      'before_title' => '<h4 class="footer-widget-title">',
      'after_title' => '</h4>',
    ));

  }

add_action( 'widgets_init', 'logiqShop_widgets_init' );
endif;
?>
