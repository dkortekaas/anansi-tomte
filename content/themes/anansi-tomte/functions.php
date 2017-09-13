<?php

/** Define Constants */
define('WL_VERSION', '1.1');
define('WL_THEME_PATH', get_template_directory());
define('WL_THEME_URI', get_template_directory_uri());
define('WL_THEME_NAME', 'anansi-tomte');
define('LOGIN_BMC', false);

/** Various clean up functions */
require_once( WL_THEME_PATH. '/includes/cleanup.php' );

/** Include required tgm activation */
require_once (WL_THEME_PATH. '/includes/activation/install-required.php');

/** Include theme variation functions */
require_once(WL_THEME_PATH . '/core/mgk_framework.php');

/** Responsive Images */
//  require_once( WL_THEME_PATH. '/includes/responsive-images.php' );

/** Register all navigation menus */
require_once( WL_THEME_PATH. '/includes/navigation.php' );

/** Register Options page */
require_once( WL_THEME_PATH. '/includes/options.php' );

/** Create widget areas in sidebar and footer */
require_once( WL_THEME_PATH. '/includes/widget-areas.php' );

/** Return entry meta information for posts */
require_once( WL_THEME_PATH. '/includes/entry-meta.php' );

/** Enqueue scripts */
require_once( WL_THEME_PATH. '/includes/enqueue-scripts.php' );

/** Add theme support */
require_once( WL_THEME_PATH. '/includes/theme-support.php' );

/** Change WP's default login page */
require_once( WL_THEME_PATH. '/includes/custom-login.php' );

/** Features */
require_once( WL_THEME_PATH. '/includes/features.php' );

/** Custom Post Type - Services */
require_once( WL_THEME_PATH. '/includes/custom-posttype.php' );

/** Woocommerce */
require_once( WL_THEME_PATH. '/includes/woocommerce.php' );

//remove_filter('the_content', 'wpautop');

// Allow span tags etc. in mce
function wl_override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'wl_override_mce_options');




// Custom style button to wysiwyg
function wl_mce_buttons($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wl_mce_buttons');

// Add custom styling to wysiwyg editor
function wl_add_custom_styling_mce( $init_array ) {  

    // Define the style_formats array
	$style_formats = array(  
/*
* Each array child is a format with it's own settings
* Notice that each array has title, block, classes, and wrapper arguments
* Title is the label which will be visible in Formats menu
* Block defines whether it is a span, div, selector, or inline style
* Classes allows you to define CSS classes
* Wrapper whether or not to add a new block-level element around any selected elements
*/
		array(  
			'title' => 'Brown button',
			'selector' => 'a',
			'classes' => 'button',
		),  
		array(  
			'title' => 'Orange text',  
			'inline' => 'span',  
			'classes' => 'orange',
			'wrapper' => true,
		),
		array(  
			'title' => 'Red Button',  
			'block' => 'span',  
			'classes' => 'red-button',
			'wrapper' => true,
		),
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
add_filter( 'tiny_mce_before_init', 'wl_add_custom_styling_mce' ); 

add_editor_style( 'editor-style.css' );

class MagikPvc {

    /*** Constructor */
    function __construct() {
        // Register action/filter callbacks
        add_action( 'init', array($this, 'magikPvc_theme'));
        //add_action('add_meta_boxes', array($this,'magikPvc_reg_page_meta_box'));
        //add_action('save_post',array($this, 'magikPvc_save_page_layout_meta_box_values'));
        //add_action('add_meta_boxes', array($this,'magikPvc_reg_post_meta_box'));
        //add_action('save_post',array($this, 'magikPvc_save_post_layout_meta_box_values'));
    }

    function magikPvc_theme() {
        global $pvc_Options;
    }

    // page title code
    function magikPvc_page_title() {
        global  $post, $wp_query, $author,$pvc_Options;
        $home = esc_html__('Home', 'pvc');
        if ( ( ! is_home() && ! is_front_page() && ! (is_post_type_archive()) ) || is_paged() ) :
            if ( is_home() ) :
                echo htmlspecialchars_decode(single_post_title('', false));
            elseif ( is_category() ) :
                echo esc_html(single_cat_title( '', false ));
            elseif ( is_tax() ) :
                $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                echo htmlspecialchars_decode(esc_html( $current_term->name ));
            elseif ( is_day() ) :
                printf( esc_html__( 'Daily Archives: %s', 'pvc' ), get_the_date() );
            elseif ( is_month() ) :
                printf( esc_html__( 'Monthly Archives: %s', 'pvc' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'pvc' ) ) );
            elseif ( is_year() ) :
                printf( esc_html__( 'Yearly Archives: %s', 'pvc' ), get_the_date( _x( 'Y', 'yearly archives date format', 'pvc' ) ) );
            elseif ( is_post_type_archive() ) :
                sprintf( esc_html__( 'Archives: %s', 'pvc' ), post_type_archive_title( '', false ) );
            elseif ( is_single() && ! is_attachment() ) :
                echo esc_html(get_the_title());
            elseif ( is_404() ) :
                echo esc_html__( 'Error 404', 'pvc' );
            elseif ( is_attachment() ) :
                echo esc_html(get_the_title());
            elseif ( is_page() && !$post->post_parent ) :
                echo esc_html(get_the_title());
            elseif ( is_page() && $post->post_parent ) :
                echo esc_html(get_the_title());
            elseif ( is_search() ) :
                echo htmlspecialchars_decode(esc_html__( 'Search results for &ldquo;', 'pvc' ) . get_search_query() . '&rdquo;');
            elseif ( is_tag() ) :
                echo htmlspecialchars_decode(esc_html__( 'Posts tagged &ldquo;', 'pvc' ) . single_tag_title('', false) . '&rdquo;');
            elseif ( is_author() ) :
                $userdata = get_userdata($author);
                echo htmlspecialchars_decode(esc_html__( 'Author:', 'pvc' ) . ' ' . $userdata->display_name);
            elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) :
                $post_type = get_post_type_object( get_post_type() );
                if ( $post_type ) :
                    echo htmlspecialchars_decode($post_type->labels->singular_name);
                endif;
            endif;
            if ( get_query_var( 'paged' ) ) :
                echo htmlspecialchars_decode( ' (' . esc_html__( 'Page', 'pvc' ) . ' ' . get_query_var( 'paged' ) . ')');
            endif;
        else :
            if ( is_home() && !is_front_page() ) :
                if ( ! empty( $home ) ) :
                    echo htmlspecialchars_decode(single_post_title('', false));
                endif;
            endif;
        endif;
    }

    // page breadcrumbs code
    function magikPvc_breadcrumbs() {
        global $post, $pvc_Options,$wp_query, $author;
        $delimiter = '<span> &frasl; </span>';
        $before = '<li>';
        $after = '</li>';
        $home = esc_html__('Home', 'pvc');
        $linkbefore='<strong>';
        $linkafter='</strong>';

        // breadcrumb code
        if ( ( ! is_home() && ! is_front_page() && ! (is_post_type_archive()) ) || is_paged() ) :
            echo '<ul>';
            if ( ! empty( $home ) ) :
                echo htmlspecialchars_decode($before . '<a class="home" href="' . esc_url(home_url() ) . '">' . $home . '</a>' . $delimiter . $after);
            endif;
            if ( is_home() ) :
                echo htmlspecialchars_decode($before .$linkbefore. single_post_title('', false) .$linkafter. $after);
            elseif ( is_category() ) :
                if ( get_option( 'show_on_front' ) == 'page' ) :
                    echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . esc_html(get_the_title( get_option('page_for_posts', true) )) . '</a>' . $delimiter . $after);
                endif;
                $cat_obj = $wp_query->get_queried_object();
                if ($cat_obj) :
                    $this_category = get_category( $cat_obj->term_id );
                    if ( 0 != $this_category->parent ) :
                        $parent_category = get_category( $this_category->parent );
                        if ( ( $parents = get_category_parents( $parent_category, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) :
                            echo htmlspecialchars_decode($before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $delimiter . $after);
                        endif;
                    endif;
                    echo htmlspecialchars_decode($before .$linkbefore. single_cat_title( '', false ) .$linkafter. $after);
                endif;
            elseif ( is_tax()) :
                $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );
                foreach ( $ancestors as $ancestor ) :
                    $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );
                    echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) )) . '">' . esc_html( $ancestor->name ) . '</a>' . $delimiter . $after);
                endforeach;
                echo htmlspecialchars_decode($before .$linkbefore. esc_html( $current_term->name ) .$linkafter. $after);
            elseif ( is_day() ) :
                echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>' . $delimiter . $after);
                echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a>' . $delimiter . $after);
                echo htmlspecialchars_decode($before .$linkbefore. get_the_time('d') .$linkafter. $after);
            elseif ( is_month() ) :
                echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>' . $delimiter . $after);
                echo htmlspecialchars_decode($before .$linkbefore. get_the_time('F') .$linkafter. $after);
            elseif ( is_year() ) :
                echo htmlspecialchars_decode($before .$linkbefore. get_the_time('Y') .$linkafter. $after);
            elseif ( is_single() && ! is_attachment() ) :
                if ( 'post' != get_post_type() ) :
                    $post_type = get_post_type_object( get_post_type() );
                    $slug = $post_type->rewrite;
                    echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_post_type_archive_link( get_post_type() )) . '">' . esc_html($post_type->labels->singular_name) . '</a>' . $delimiter . $after);
                    echo htmlspecialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);
                else :
                    if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) :
                        echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . esc_html(get_the_title( get_option('page_for_posts', true) )) . '</a>' . $delimiter . $after);
                    endif;
                    $cat = current( get_the_category() );
                    if ( ( $parents = get_category_parents( $cat, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) :
                        $getitle=get_the_title();
                        if(empty($getitle)) :
                            $newdelimiter ='';
                        else :
                            $newdelimiter=$delimiter;
                        endif;
                        echo htmlspecialchars_decode($before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $newdelimiter . $after);
                    endif;
                    echo htmlspecialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);
                endif;
            elseif ( is_404() ) :
                echo htmlspecialchars_decode($before .$linkbefore. esc_html__( 'Error 404', 'pvc' ) .$linkafter. $after);
            elseif ( is_attachment() ) :
                $parent = get_post( $post->post_parent );
                $cat = get_the_category( $parent->ID );
                $cat = $cat[0];
                if ( ( $parents = get_category_parents( $cat, TRUE, $delimiter . $after . $before ) ) && ! is_wp_error( $parents ) ) :
                    echo htmlspecialchars_decode($before . substr( $parents, 0, strlen($parents) - strlen($delimiter . $after . $before) ) . $delimiter . $after);
                endif;
                echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_permalink( $parent )) . '">' . esc_html($parent->post_title) . '</a>' . $delimiter . $after);
                echo htmlspecialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);
            elseif ( is_page() && !$post->post_parent ) :
                echo htmlspecialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);
            elseif ( is_page() && $post->post_parent ) :
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ( $parent_id ) :
                    $page = get_post( $parent_id );
                    $breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title( $page->ID )) . '</a>';
                    $parent_id  = $page->post_parent;
                endwhile;
                $breadcrumbs = array_reverse( $breadcrumbs );
                foreach ( $breadcrumbs as $crumb ) :
                    echo htmlspecialchars_decode($before . $crumb . $delimiter . $after);
                endforeach;
                echo htmlspecialchars_decode($before .$linkbefore. get_the_title() .$linkafter. $after);
            elseif ( is_search() ) :
                echo htmlspecialchars_decode($before .$linkbefore. esc_html__( 'Search results for &ldquo;', 'pvc' ) . get_search_query() . '&rdquo;' .$linkafter. $after);
            elseif ( is_tag() ) :
                if ( 'post' == get_post_type() && get_option( 'show_on_front' ) == 'page' ) :
                    echo htmlspecialchars_decode($before . '<a href="' . esc_url(get_permalink( get_option('page_for_posts' ) )) . '">' . esc_html(get_the_title( get_option('page_for_posts', true) )) . '</a>' . $delimiter . $after);
                endif;
                echo htmlspecialchars_decode($before .$linkbefore. esc_html__( 'Posts tagged &ldquo;', 'pvc' ) . single_tag_title('', false) . '&rdquo;' .$linkafter. $after);
            elseif ( is_author() ) :
                $userdata = get_userdata($author);
                echo htmlspecialchars_decode($before .$linkbefore. esc_html__( 'Author:', 'pvc' ) . ' ' . $userdata->display_name .$linkafter. $after);
            elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' ) :
                $post_type = get_post_type_object( get_post_type() );
                if ( $post_type ) :
                    echo htmlspecialchars_decode($before .$linkbefore. $post_type->labels->singular_name .$linkafter. $after);
                endif;
            endif;
            if ( get_query_var( 'paged' ) ) :
                echo htmlspecialchars_decode($before .$linkbefore. '&nbsp;(' . esc_html__( 'Page', 'pvc' ) . ' ' . get_query_var( 'paged' ) . ')' .$linkafter. $after);
            endif;
            echo '</ul>';
        else :
            if ( is_home() && !is_front_page() ) :
            echo '<ul>';
                if ( ! empty( $home ) ) :
                    echo htmlspecialchars_decode($before . '<a class="home" href="' . esc_url(home_url()) . '">' . $home . '</a>' . $delimiter . $after);
                    echo htmlspecialchars_decode($before .$linkbefore. single_post_title('', false) .$linkafter. $after);
                endif;
            echo '</ul>';
            endif;
        endif;
    }

    function magikPvc_getPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return '0 ' . __('View');
        }
        return $count . ' ' . __('Views');
    }

    function magikPvc_setPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if ($count == '') {
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        } else {
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }

    function magikPvc_is_blog() {
        global  $post;
        $posttype = get_post_type($post );
        return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
    }
 
    // comment display 
    function magikPvc_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>

        <li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
            <div class="comment-body">
                <div class="img-thumbnail">
                    <?php echo get_avatar($comment, 80); ?>
                </div>
                <div class="comment-block">
                    <div class="comment-arrow"></div>
                    <span class="comment-by">
                        <strong><?php echo get_comment_author_link() ?></strong>
                        <span class="pt-right">
                            <span> <?php edit_comment_link('<i class="fa fa-pencil"></i> ' . esc_html__('Edit', 'pvc'),'  ','') ?></span>
                            <span> <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-reply"></i> ' . esc_html__('Reply', 'pvc'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
                        </span>
                    </span>
                    <div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php echo esc_html__('Your comment is awaiting moderation.', 'pvc') ?></em><br />
                    <?php endif; ?>
                    <?php comment_text() ?>
                    </div>
                    <span class="date pt-right"><?php printf(esc_html__('%1$s at %2$s', 'pvc'), get_comment_date(),  get_comment_time()) ?></span>
                </div>
            </div>
        </li>
    <?php }

}

    // Instantiate theme
    $MagikPvc = new MagikPvc();

    if ( ! function_exists ( 'wl_mobile_search' ) ) :
        function wl_mobile_search() {
            global $pvc_Options;
            $MagikPvc = new MagikPvc();
            if (isset($pvc_Options['header_remove_header_search']) && !$pvc_Options['header_remove_header_search']) :
                echo'<div class="mobile-search">';
                    echo wl_mobile_search_form();
                    echo'<div class="search-autocomplete" id="search_autocomplete1" style="display: none;"></div></div>';
            endif;
        }
    endif;

    if ( ! function_exists ( 'wl_mobile_search_form' ) ) :
        function wl_mobile_search_form() {
            global $pvc_Options;
            $MagikPvc = new MagikPvc();
            if (isset($pvc_Options['header_remove_header_search']) && !$pvc_Options['header_remove_header_search']) : ?>
                <form name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">
                <?php if (class_exists('WooCommerce')) : ?>
                    <input type="hidden" value="product" name="post_type">
                <?php endif; ?>
                <input type="text"  name="s" class="searchbox mgksearch" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search entire store here...', 'pvc'); ?>">
                <button type="submit" title="<?php esc_attr_e('Search', 'pvc'); ?>" class="search-btn-bg"><span><?php esc_attr_e('Search','pvc');?></span></button>
                </form>
            <?php endif;
        }
    endif;

    // Homepage Blog
    if ( ! function_exists ( 'wl_home_blog_posts' ) ) :
        function wl_home_blog_posts() {
            $count = 0;
            global $pvc_Options;
            $MagikPvc = new MagikPvc(); ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="blog-outer-container">
                            <div class="block-title">
                                <h2><?php esc_attr_e('Latest Blog', 'pvc'); ?></h2>
                                <div class="hidden-xs">
                                    <?php echo htmlspecialchars_decode($pvc_Options['home_blog-text']);?>
                                </div>
                            </div>
                            <div class="blog-inner">
                            <?php
                                $args = array('posts_per_page' => 3, 'post__not_in' => get_option('sticky_posts'));
                                $the_query = new WP_Query($args);
                                $i=1;
                                if ($the_query->have_posts()) :
                                    while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                        <div class="col-lg-4 col-md-4 col-sm-4 blog-preview_item">
                                            <h4 class="blog-preview_title">
                                                <a href="<?php the_permalink(); ?>"><?php esc_html(the_title()); ?></a>
                                            </h4>
                                            <div class="entry-thumb image-hover2">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'home-post-thumbnail'); ?>
                                                </a>
                                            </div>
                                            <div class="blog-preview_info">
                                                <ul class="post-meta">
                                                    <li><i class="fa fa-user"></i><?php esc_attr_e('posted by', 'pvc'); ?>
                                                        <a href="<?php comments_link(); ?>"><?php the_author(); ?></a> 
                                                    </li>
                                                    <li><i class="fa fa-comments"></i>
                                                        <a href="<?php comments_link(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a>
                                                    </li>
                                                    <li><i class="fa fa-clock-o"></i><?php esc_html(the_time(get_option('date_format'))); ?></li>
                                                </ul>
                                                <div class="blog-preview_desc"><?php the_excerpt(); ?></div>
                                                <a class="blog-preview_btn" href="<?php the_permalink(); ?>"><?php esc_attr_e('READ MORE','pvc'); ?></a>
                                            </div>
                                        </div>
                                        <?php $i++;
                                    endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php else: ?>
                                    <p><?php esc_attr_e('Sorry, no posts matched your criteria.', 'pvc'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    endif;

    // Homepage slider
    if ( ! function_exists ( 'wl_home_page_banner' ) ) :
        function wl_home_page_banner() {
            echo "<div class='container'>";
                echo "<div class='row'>";
                    echo "<div class='col-xs-12'>";
                        echo "<div class='home-slider full-width'>";
                            putRevSlider("homeslider");
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
    endif;

    // Change OpenGraph Type
    function wl_yoast_change_opengraph_type( $type ) {
        if ( is_product() ) :
            return 'product';
        elseif ( is_product_category() ) :
            return 'product.group';
        else :
            return 'article';
        endif;
    }
    add_filter( 'wpseo_opengraph_type', 'wl_yoast_change_opengraph_type', 10, 1 );


  add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );
	
	function add_current_nav_class($classes, $item) {
		
		// Getting the current post details
		// global $post;
		
		// // Getting the post type of the current post
        // $current_post_type = get_post_type($post->ID);
		// $current_post_type_object = get_post_type_object($current_post_type);
		// $current_post_type_slug = $current_post_type_object->rewrite[slug];
			
		// // Getting the URL of the menu item
		// $menu_slug = strtolower(trim($item->url));
		
        // $index = array_search('current_page_parent', $classes);
        // if($index !== FALSE){
        //     unset($classes[$index]);
        // }

		// If the menu item URL contains the current post types slug add the current-menu-item class
		// if (strpos($menu_slug,$current_post_type_slug) !== false || strpos($menu_slug,'diensten') !== false) {
		

		//    $classes[] = 'current-menu-item';
		
		// }
		
		// Return the corrected set of classes to be added to the menu item
		return $classes;
	
	}