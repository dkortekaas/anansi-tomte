<?php
/**
 * Change the class for sticky posts to .wp-sticky to avoid conflicts with Foundation's Sticky plugin
 *
 * @package WordPress
 * @subpackage WeblogiqPress
 * @since WeblogiqPress 2.2.0
 */

if ( ! function_exists( 'weblogiqpress_sticky_posts' ) ) :
function weblogiqpress_sticky_posts( $classes ) {
	$classes = array_diff($classes, array('sticky'));
	$classes[] = 'wp-sticky';
	return $classes;
}
add_filter('post_class','weblogiqpress_sticky_posts');

endif;
?>
