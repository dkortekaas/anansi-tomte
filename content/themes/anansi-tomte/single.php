<?php get_header();
$MagikPvc->magikPvc_setPostViews(get_the_ID());
 $design = get_post_meta($post->ID, 'magikPvc_post_layout', true);
 $leftbar = $rightbar = $main = '';

$leftbar = $rightbar = $main = '';

switch ((int)$design) {
    case 1:
        $rightbar ='hidesidebar';
        $main = 'col2-left-layout';
        $col = 'col-sm-9 col-md-9 col-lg-9 col-xs-12';
        break;
    case 3:
        $leftbar = $rightbar = 'hidesidebar';
        $main = 'col1-layout';
        $col = 'col-sm-12 col-md-12 col-lg-12 col-xs-12';
        break;

    default:
        $leftbar = 'hidesidebar';
        $main = 'col2-right-layout';
        $col = 'col-sm-9 col-md-9 col-lg-9 col-xs-12';
        break;

}

$maincat = get_the_category();
$cat_id = $maincat[0]->cat_ID;
$post_id = get_the_ID();
?>

<div class="content-main">
  <div class="row">

    <div class="blog-wrapper <?php echo esc_html($main) ?>">
        <div class="container">
            <div class="row row-eq-height">

                <?php if (empty($rightbar) && $rightbar != 'hidesidebar') : ?>
                <aside id="column-right" class="col-right sidebar col-lg-3 col-sm-3 col-xs-12 hidden-xs <?php echo esc_html($rightbar) ?>">
                    <div class="colored bordered">
                        <div class="product-categories">
                        <h4 class="block-title"><?php _e('Categories', 'anansi-tomte'); ?></h4>
                        <?php

                            $args = array( 
                                'posts_per_page' => -1
                            );

                            $query = new WP_Query($args);   
                            $q = array();

                            while ( $query->have_posts() ) { 

                                $query->the_post(); 

                                $a = '<a class="post '. ($post_id == get_the_ID() ? 'active' : '') .'" href="'. get_permalink() .'">' . get_the_title() .'</a>';

                                $categories = get_the_category();

                                foreach ( $categories as $key=>$category ) {

                                    $b = '<a class="category '. ($cat_id == $category->term_id ? 'active' : '') .'" href="' . get_category_link( $category ) . '">' . $category->name . '</a>';    

                                }

                                $q[$b][] = $a; // Create an array with the category names and post titles
                            }

                            /* Restore original Post Data */
                            wp_reset_postdata();

                            foreach ($q as $key=>$values) {
                                echo $key;

                                echo '<ul class="children">';
                                    foreach ($values as $value){
                                        echo '<li>' . $value . '</li>';
                                    }
                                echo '</ul>';
                            }

                        ?>
                        </div>
                    </div>
                </aside>
                <?php endif; ?>

                <div class="<?php echo esc_html($col); ?>">
                    <div class="col-main colored bordered">
                        <h2 class="breadcrumb">
                            <a href="/blog/"><?php _e('Blog', 'anansi-tomte'); ?></a> / <a href="<?php echo get_category_link($maincat[0]->cat_ID ) ?>"><?php echo $maincat[0]->name ?></a>
                        </h2>
                        <?php  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        get_query_var('page') ?>
                    
                        <?php while (have_posts()) : the_post(); ?>
                        <div class="blog-post container-paper singlepost">
                           
                            <div class="post-container">
                                <div class="title">   
                                    <h2 class="entry-title"><?php the_title(); ?></h2>                                     
                                </div>
                                <ul class="list-info">
                                    <li><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date('d M Y')); ?></li>
                                    <li class="divider">|</li>                                    
                                <?php if (isset($pvc_Options)) {
                                    if(isset($pvc_Options['blog_show_post_by']) && $pvc_Options['blog_show_post_by'] == 1 ) { ?>
                                    <li><i class="fa fa-user"></i><?php esc_attr_e('By', 'anansi-tomte'); ?>  <?php the_author(); ?>  </li>
                                    <li class="divider">|</li>
                                    <?php }
                                } else { ?>
                                    <li><i class="fa fa-user"></i><?php esc_attr_e('By', 'anansi-tomte'); ?>  <?php the_author(); ?>  </li>
                                    <li class="divider">|</li>
                                <?php } ?>
                                <?php if(isset($pvc_Options)) { 
                                if(isset($pvc_Options['blog_display_category']) && $pvc_Options['blog_display_category']==1) { 
                                    if(has_category()){
                                    $cats_list = get_the_category_list(', ');
                                    ?>
                                    <li class="under-category">
                                        <i class="fa fa-tag"></i>
                                        <?php echo htmlspecialchars_decode($cats_list);?>
                                    </li>
                                    <li class="divider">|</li>
                                <?php } 
                                }
                            } else {
                                if(has_category()){
                                    $cats_list = get_the_category_list(', ');
                                ?>
                      <li class="under-category">
                      <i class="fa fa-tag"></i>
                       <?php echo htmlspecialchars_decode($cats_list);?>
                      </li>
                      <li class="divider">|</li>
                    <?php 
                      } 
                      } 

                      ?>

                       
                        
                      <?php 
                      if (isset($pvc_Options))
                      {
                       if(isset($pvc_Options['blog_display_view_counts']) && $pvc_Options['blog_display_view_counts'] == 1) 
                      { ?>
                      <li><i class="fa fa-eye"></i><?php  echo esc_html($MagikPvc->magikPvc_getPostViews(get_the_ID())); ?> </li>
                      <!--<li class="divider">|</li>-->
                      <?php }
                      }
                      else{
                      ?>
                      <li><i class="fa fa-eye"></i><?php  echo esc_html($MagikPvc->magikPvc_getPostViews(get_the_ID())); ?> </li>
                      <!--<li class="divider">|</li>-->
                      <?php

                      } ?>

                      <?php 
                      if (isset($pvc_Options))
                      { 
                       if(isset($pvc_Options['blog_display_comments_count']) && $pvc_Options['blog_display_comments_count'] == 1) 
                      { ?>
                      <!--
                      <li><i class="fa fa-comment"></i><a href="<?php comments_link(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>
                      </a></li>
                      <li class="divider">|</li>
                      -->
                        <?php 
                      } 
                    }
                    else
                    {
                    ?>
                        <!--
                      <li><i class="fa fa-comment"></i><a href="<?php comments_link(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?>
                      </a></li>
                      <li class="divider">|</li>
                      -->
                        <?php 
                      }   

                      ?>


                      </ul>
   
                      <?php if (get_field('intro_tekst')) :
                        the_field('intro_tekst');
                      endif; ?>
                              
                        <?php if (has_post_thumbnail()) : ?>
                                      <div class="post-img <?php if (has_post_thumbnail()){?> has-img <?php } ?>">
                                    <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail'); ?>
                                    <a href="<?php the_permalink(); ?>"> 
                                     <figure>     
                     <img src="<?php echo esc_url($image[0]); ?>"
                                alt="<?php the_title(); ?>">  </figure>  
                                 </a>
                                 </div>
                               <?php endif; ?>
                                   
              
                                    
                              
                                <div class="post-detail-container">
                              
                                <div class="detaildesc">
                                <?php the_content(); ?>
                            </div>
                       

                                <?php
                                 wp_link_pages(array('before' => '<div class="post_paginate">' . esc_html__('Pages:&nbsp;', 'anansi-tomte'), 'after' => '</div>', 'next_or_number' => 'number', 'nextpagelink' => '<span class="next">' . esc_html__('Next &raquo;', 'anansi-tomte').'</span>', 'previouspagelink' => '', 'link_before' => '<span>', 'link_after' => '</span>'));
                                ?>


                                    
                                <?php
                                 $tag = get_the_tags();
                                 if ($tag) 
                                {
                                 if (isset($pvc_Options))
                                {
                                 if(isset($pvc_Options['blog_display_tags']) && $pvc_Options['blog_display_tags'] == 1) 
                                 { 
                                    ?>
                                 <footer class="entry-meta clearfix">
                                    <div class="line-divider"></div>

                                    <?php  the_tags('<ul class="post-tags"><li>', '</li><li>', '</li></ul>');
                                     ?>

                                </footer>
                                <?php 
                                 }

                                  }
                                
                                else
                                 {
                                ?>
                                 <footer class="entry-meta clearfix">
                                    <div class="line-divider"></div>

                                    <?php  the_tags('<ul class="post-tags"><li>', '</li><li>', '</li></ul>');
                                     ?>

                                </footer>
                                <?php 

                                 }
                               }
                                 ?>
                              </div>  
                            </div>
                        </div>
                        <?php
                        // Author bio.
                    if (isset($pvc_Options))
                    {
                     if(isset($pvc_Options['blog_show_authors_bio']) && $pvc_Options['blog_show_authors_bio']== 1) 
                     {
                            //get_template_part('author-bio');
                    }
                    }
                   else
                   {
                      //get_template_part('author-bio');
                   }
                        ?>
                    <?php endwhile; ?>
                    <?php
                
                    // Don't print empty markup if there's nowhere to navigate.
                    $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
                    $next = get_adjacent_post(false, '', false);

                    ?>
                    <div class="post-navigation">
                        <?php if ($previous) {
                            ?>
                            <div class="pull-left btn-mega1">
                                <?php previous_post_link('%link', _x('<i class="fa fa-chevron-left" aria-hidden="true"></i>', 'Previous post link', 'anansi-tomte')); ?>
                            </div>
                        <?php } ?>
                        <?php if ($next) {
                            ?>
                            <div class="pull-right btn-mega1">
                                <?php next_post_link('%link', _x('<i class="fa fa-chevron-right" aria-hidden="true"></i>', 'Next post link', 'anansi-tomte')); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        //if (comments_open() || get_comments_number()) :
                            //comments_template('', true);
                        //endif;                    
                    ?>
                </div>

            </div>
                <?php if (empty($rightbar) && $rightbar != 'hidesidebar') : ?>
                <aside id="column-right" class="col-right sidebar col-lg-3 col-sm-3 col-xs-12 visible-xs <?php echo esc_html($rightbar) ?>">
                    <div class="colored bordered">
                        <div class="product-categories">
                        <h4 class="block-title"><?php _e('Categories', 'anansi-tomte'); ?></h4>
                        <?php

                            $args = array( 
                                'posts_per_page' => -1
                            );

                            $query = new WP_Query($args);   
                            $q = array();

                            while ( $query->have_posts() ) { 

                                $query->the_post(); 

                                $a = '<a class="post '. ($post_id == get_the_ID() ? 'active' : '') .'" href="'. get_permalink() .'">' . get_the_title() .'</a>';

                                $categories = get_the_category();

                                foreach ( $categories as $key=>$category ) {

                                    $b = '<a class="category '. ($cat_id == $category->term_id ? 'active' : '') .'" href="' . get_category_link( $category ) . '">' . $category->name . '</a>';    

                                }

                                $q[$b][] = $a; // Create an array with the category names and post titles
                            }

                            /* Restore original Post Data */
                            wp_reset_postdata();

                            foreach ($q as $key=>$values) {
                                echo $key;

                                echo '<ul class="children">';
                                    foreach ($values as $value){
                                        echo '<li>' . $value . '</li>';
                                    }
                                echo '</ul>';
                            }

                        ?>
                        </div>
                    </div>
                </aside>
                <?php endif; ?>
        </div>
    </div>
    </div>
</div>
</div>
<?php get_footer(); ?>