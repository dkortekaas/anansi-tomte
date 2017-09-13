<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @package WordPress
 * @subpackage logiqShop
 */
    // Theme support
    if ( ! function_exists( 'wl_theme_support' ) ) :
        function wl_theme_support() {
	        // Add language support
            load_theme_textdomain('pvc', get_template_directory() . '/languages');
            load_theme_textdomain('woocommerce', get_template_directory() . '/languages');

	        // Add menu support
	        add_theme_support( 'menus' );

	        // Let WordPress manage the document title
	        add_theme_support( 'title-tag' );

	        // Add post thumbnail support: http://codex.wordpress.org/Post_Thumbnails
	        add_theme_support( 'post-thumbnails' );
            add_image_size( 'wl-product-size-large', 291, 353, true );
            add_image_size( 'wl-product-size-small', 250, 250, array( 'center', 'top' )  );
            add_image_size( 'wl-product-size-zoom', 600, 600, true );
            add_image_size( 'home-deal', 615, 440, true );
            add_image_size( 'home-banner', 278, 228, true );
            add_image_size( 'anansi-banner', 278, 284, true );
            add_image_size( 'background-banner', 278, 278, true );
            add_image_size( 'home-large-banner', 585, 206, true );
            add_image_size( 'home-post-thumbnail', 359, 156, true );
            add_image_size( 'blog-overview', 150, 150, true );
    
            // RSS thingy
	        add_theme_support( 'automatic-feed-links' );

            // Styles the visual editor to resemble the theme style, specifically font, colors, icons, and column width.
            add_editor_style('css/editor-style.css' );

            // Add post formarts support
            add_theme_support( 'html5', array (
                'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
            ) );
    
            // Setup the WordPress core custom background feature.
            //$default_color = trim( 'ffffff', '#' );
            //$default_text_color = trim( '333333', '#' );
    
            //add_theme_support( 'custom-background', apply_filters( 'magikPvc_custom_background_args', array(
            //  'default-color'      => $default_color,
            //  'default-attachment' => 'fixed',
            //) ) );
    
            //add_theme_support( 'custom-header', apply_filters( 'magikPvc_custom_header_args', array(
            //  'default-text-color'     => $default_text_color,
            //  'width'                  => 1170,
            //  'height'                 => 450,
      
            //) ) );
        }
        add_action( 'after_setup_theme', 'wl_theme_support' );
    endif;

    // Add excerpt to pages
    if ( ! function_exists( 'wl_add_excerpts_to_pages' ) ) :
        function wl_add_excerpts_to_pages() {
            add_post_type_support( 'page', 'excerpt' );
        }
        add_action( 'init', 'wl_add_excerpts_to_pages' );
    endif;

    // Add title to images
    if ( ! function_exists( 'wl_add_title_to_attachment_image' ) ) :
        function wl_add_title_to_attachment_image( $attr, $attachment ) {
            if(esc_attr( $attachment->post_title )) :
                $attr['title'] = esc_attr( $attachment->post_title );        
            endif;
            return $attr;
        }
        add_filter( 'wp_get_attachment_image_attributes', 'wl_add_title_to_attachment_image', 10, 2 );
    endif;
?>