<?php
/**
 * The Template for displaying all services.
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header(); ?>


<?php while (have_posts()) : the_post(); ?>

    <?php get_template_part('content', 'single-service'); ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>