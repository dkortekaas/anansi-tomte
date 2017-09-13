<?php
/**
 * Responsive images
 *
 * @package WordPress
 * @subpackage Weblogiq
 */

function adjust_image_sizes_attr( $sizes, $size ) {
    $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 540px';
    return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'adjust_image_sizes_attr', 10 , 2 );