<?php
/**
 * Clean up WordPress defaults
 *
 * @package WordPress
 * @subpackage WeblogiqPress
 * @since WeblogiqPress 1.0.0
 */

if ( ! function_exists( 'weblogiqpress_start_cleanup' ) ) :
function weblogiqpress_start_cleanup() {

	// Launching operation cleanup.
	add_action( 'init', 'weblogiqpress_cleanup_head' );

	// Remove WP version from RSS.
	add_filter( 'the_generator', 'weblogiqpress_remove_rss_version' );

	// Remove pesky injected css for recent comments widget.
	add_filter( 'wp_head', 'weblogiqpress_remove_wp_widget_recent_comments_style', 1 );

	// Clean up comment styles in the head.
	add_action( 'wp_head', 'weblogiqpress_remove_recent_comments_style', 1 );

	// Clean up gallery output in wp.
	add_filter( 'weblogiqpress_gallery_style', 'weblogiqpress_gallery_style' );

    // Remove WooCommerce Updater message
    remove_action('admin_notices', 'woothemes_updater_notice');
}
add_action( 'after_setup_theme','weblogiqpress_start_cleanup' );
endif;
/**
 * Clean up head.+
 * ----------------------------------------------------------------------------
 */

if ( ! function_exists( 'weblogiqpress_cleanup_head' ) ) :
function weblogiqpress_cleanup_head() {

	// EditURI link.
	remove_action( 'wp_head', 'rsd_link' );

	// Category feed links.
	remove_action( 'wp_head', 'feed_links_extra', 3 );

	// Post and comment feed links.
	remove_action( 'wp_head', 'feed_links', 2 );

	// Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// Index link.
	remove_action( 'wp_head', 'index_rel_link' );

	// Previous link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );

	// Start link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );

	// Canonical.
	remove_action( 'wp_head', 'rel_canonical', 10, 0 );

	// Shortlink.
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	// Links for adjacent posts.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	// WP version.
	remove_action( 'wp_head', 'wp_generator' );
}
endif;

// Remove WP version from RSS.
if ( ! function_exists( 'weblogiqpress_remove_rss_version' ) ) :
function weblogiqpress_remove_rss_version() { return ''; }
endif;

// Remove injected CSS for recent comments widget.
if ( ! function_exists( 'weblogiqpress_remove_wp_widget_recent_comments_style' ) ) :
function weblogiqpress_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
	  remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}
endif;

// Remove injected CSS from recent comments widget.
if ( ! function_exists( 'weblogiqpress_remove_recent_comments_style' ) ) :
function weblogiqpress_remove_recent_comments_style() {
	global $wp_widget_factory;
	if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
	remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}
endif;

// Remove injected CSS from gallery.
//if ( ! function_exists( 'weblogiqpress_gallery_style' ) ) :
//function weblogiqpress_gallery_style( $css ) {
	//return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
//}
//endif;


// Remove WP update notification for all users except sysadmin
global $user_login;
wp_get_current_user();
if ( ! current_user_can( 'update_plugins' ) ) :
    add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
    add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
endif;


// Disable emojicons introduced with WP 4.2
if ( ! function_exists( 'weblogiqpress_disable_wp_emojicons' ) ) :
function weblogiqpress_disable_wp_emojicons() {
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    //add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}

add_action( 'init', 'weblogiqpress_disable_wp_emojicons' );
endif;

if ( ! function_exists( 'weblogiqpress_disable_emojicons_tinymce' ) ) :
function weblogiqpress_disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
endif;

// Remove WP Version From styles and scripts
add_filter( 'style_loader_src', 'weblogiqpress_remove_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'weblogiqpress_remove_ver_css_js', 9999 );

if ( ! function_exists( 'weblogiqpress_remove_ver_css_js' ) ) :
function weblogiqpress_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
endif;

// Add WooCommerce support for wrappers per http://docs.woothemes.com/document/third-party-custom-theme-compatibility/
//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
//add_action('woocommerce_before_main_content', 'weblogiqpress_before_content', 10);
//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
//add_action('woocommerce_after_main_content', 'weblogiqpress_after_content', 10);
?>
