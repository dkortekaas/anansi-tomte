<?php
/**
 * Entry meta information for posts
 *
 * @package WordPress
 * @subpackage WeblogiqPress
 * @since WeblogiqPress 1.0.0
 */

if ( ! function_exists( 'weblogiqpress_entry_meta' ) ) :
	function weblogiqpress_entry_meta() {
		echo '<time class="updated" datetime="'. get_the_time( 'c' ) .'">'. sprintf( __( 'Posted on %s at %s.', 'weblogiqpress' ), get_the_date(), get_the_time() ) .'</time>';
		echo '<p class="byline author">'. __( 'Written by', 'weblogiqpress' ) .' <a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ) .'" rel="author" class="fn">'. get_the_author() .'</a></p>';
	}
endif;
?>
