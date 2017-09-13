<?php  
get_header();

$sideleft = false;
$colclass = "col-xs-12";

if ( is_active_sidebar( 'sidebar-blog' ) ) :
  $sideleft = true;
  $colclass = "col-xs-9";
endif;

$categories = get_the_category();
$cat_id = $categories[0]->cat_ID;
?>

<div class="content-main">
    <div class="row row-eq-height">

      <?php if ( $sideleft ) : ?>
        <div class="col-xs-3">
          <div class="colored bordered">      
            <div class="product-categories">
            <h4 class="block-title"><?php _e('Categories', 'anansi-tomte'); ?></h4>
            <?php

                $args = array( 
                    'posts_per_page' => -1
                );

                $query = new WP_Query($args);   
                $q = array();

                while ( $query->have_posts() ) :

                    $query->the_post(); 

                    $a = '<a class="post" href="'. get_permalink() .'">' . get_the_title() .'</a>';

                    $categories = get_the_category();

                    foreach ( $categories as $key=>$category ) :
                        $b = '<a class="category '. ($cat_id == $category->term_id ? 'active' : '') .'" href="' . get_category_link( $category ) . '">' . $category->name . '</a>';
                    endforeach;

                    $q[$b][] = $a; // Create an array with the category names and post titles
                endwhile;

                /* Restore original Post Data */
                wp_reset_postdata();

                foreach ($q as $key=>$values) :
                    echo $key;

                    echo '<ul class="children">';
                        foreach ($values as $value) :
                            echo '<li>' . $value . '</li>';
                        endforeach;
                    echo '</ul>';
                endforeach;

            ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

        <div class="<?php echo $colclass; ?>">
            <div class="colored bordered">

            <?php
            $args = array(
    				  'orderby' => 'post_date', // this comes from a select, options of date, title, menu_order, and random currently
    				  'order' => $order, // this comes from a select, ASC and DESC are the options
    				  'posts_per_page' => $posts_per_page,
    				  'paged' => $paged
  				  );

  				// The Loop
  				$loop = new WP_Query( $args );
    			if ( $loop->have_posts() ) : ?>

            <form action="" method="get" name="postsorder">
            	<div class='post-filters'>
                <?php _e('Order:', 'anansi-tomte'); ?>
              	<select name="order" id="order">
                	<?php
                  	$order_options = array(
                    	'ASC' => __('Ascending', 'anansi-tomte'),
                    	'DESC' => __('Descending', 'anansi-tomte'),
                  	);
                  	foreach ($order_options as $value => $label) {
                    	echo "<option ".selected( $_GET['order'], $value )." value='$value'>$label</option>";
                  	}

                  ?>
              	</select>
              	<input type="submit" value="<?php _e('Submit', 'anansi-tomte'); ?>" />
              </div>
          	</form>
            <?php endif; ?>
            <h2 class="page-title"><?php single_cat_title(); ?></h2>
            <?php //$posts = query_posts( $query_string . '&orderby=date&order=desc' ); ?>
            <?php if( $posts ) : ?>
            <?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
                <article  id="post-<?php echo esc_html($post->ID); ?>" <?php post_class(); ?>>
                  <div class="post-container">
                    <div class="title">
                      <h2 class="entry-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>
                    </div>
              
                    <?php
                      $imgoverview = get_field('overview_image');
                    ?>
                    <div class="row">

                      <div class="col-md-9">
                        <ul class="list-info">
                          <li><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date('d M Y')); ?></li>
                          <li class="divider">|</li>
                          <li><i class="fa fa-user"></i><?php esc_attr_e('By', 'anansi-tomte'); ?>  <?php the_author(); ?></li>
                          <li class="divider">|</li>
                          <?php if(has_category()) :
                            $cats_list = get_the_category_list(', ');
                          endif; ?>
                          <li class="under-category">
                            <i class="fa fa-tag"></i>
                            <?php echo htmlspecialchars_decode($cats_list);?>
                          </li>
                          <li class="divider">|</li>
                          <li><i class="fa fa-eye"></i><?php echo esc_html($MagikPvc->magikPvc_getPostViews(get_the_ID())); ?></li>
                          <!--
                          <li class="divider">|</li>
                          <li><i class="fa fa-comment"></i><a href="<?php comments_link(); ?>"><?php comments_number('0 Comment', '1 Comment', '% Comments'); ?></a></li>
                          -->
                        </ul>
                        
                          <div class="post-detail-container">

                            <div class="row">
                              <div class="col-l col-md-12 col-lg-12">
                                <div class="blogdesc">
                          
                                  <?php echo get_the_excerpt(); ?>    
                                
                                </div>
                                <?php
                                  wp_link_pages(array('before' => '<div class="post_paginate">' . esc_html__('Pages:&nbsp;', 'pvc'), 'after' => '</div>', 'next_or_number' => 'number', 'nextpagelink' => '<span class="next">' . esc_html__('Next &raquo;', 'pvc').'</span>', 'previouspagelink' => '', 'link_before' => '<span>', 'link_after' => '</span>'));
                                ?>
                                <a href="<?php the_permalink(); ?>" class="btn-mega"><?php esc_attr_e('Read More', 'pvc') ?></a>
                              </div>
                            </div>
                          </div>
                        </div>
              
                      <div class="col-md-3">
                        <div class="post-img <?php if ($imgoverview){?> has-img <?php } ?>">                    
                        <?php
                          if( !empty($imgoverview) ): 

                            // vars
                            $url = $imgoverview['url'];
                            $title = $imgoverview['title'];
                            $alt = $imgoverview['alt'];

                            // thumbnail
                            $size = 'blog-overview';
                            $thumb = $imgoverview['sizes'][ $size ];
                            $width = $imgoverview['sizes'][ $size . '-width' ];
                            $height = $imgoverview['sizes'][ $size . '-height' ];
                          ?>

                          <figure>
                              <img class="pull-right" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
                          </figure>
                        <?php endif; ?>
                        </div>
                      </div>
              
              
              </div>
                </div>
              </div>
      </article>
      <?php endforeach; ?>
      <div class="pagination">
        <?php
            $big = 999999999; // need an unlikely integer
            echo paginate_links(array(
              'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
              'format' => '?paged=%#%',
              'current' => max(1, get_query_var('paged')),
              'total' => $wp_query->max_num_pages,
              'type' => 'list'
            ));
            ?>
      </div>
      <?php else: ?>
        <div><?php esc_attr_e("Sorry, What you are looking isn't here.",'pvc') ;?>. </div>
      <?php endif; ?>
      </div>

  </div>
</div>

<?php get_footer(); ?>
