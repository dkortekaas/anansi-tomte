<?php get_header(); ?>
<?php
// $sideleft = false;
// $sideright = false;
// $colclass = "col-xs-12";

// if ( is_active_sidebar( 'sidebar-content-right' ) ) :
//   $sideright = true;
// endif; 
// if ( is_active_sidebar( 'sidebar-content-left' ) ) :
//   $sideleft = true;
// endif;
// if($sideleft == true) :
//   $colclass = "col-xs-9";
//   if($sideright == true) :
//     $colclass = "col-xs-6";
//   endif;  
// else :
//   if($sideright == true) :
//     $colclass = "col-xs-9";
//   else :
//     $colclass = "col-xs-12";
//   endif;
// endif;
?>

<div class="content-main">
  <div class="row">
    <?php while (have_posts()) : the_post(); ?>

      <?php if( get_field('content_1') ): ?>
        <div class="col-xs-12 marb30">
      <?php else : ?>
        <div class="col-xs-12">
      <?php endif; ?>
      <?php if ( is_checkout() ) : ?>
        <div>
      <?php else : ?>
        <div class="wow fadeInDown colored bordered animated " data-wow-delay="">      
      <?php endif; ?>
        <?php if (is_search()) : // Only display Excerpts for Search ?>
          <p><?php the_excerpt(); ?></p>
        <?php else : ?>
          <?php the_content(); ?>
          <?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'pvc'), 'after' => '</div>')); ?>
        <?php endif; ?>
      </div>
    </div>

    <?php if( get_field('content_1') ): ?>
      <?php if( get_field('content_2') ): ?>
      <div class="col-xs-12 marb30">
      <?php else : ?>
      <div class="col-xs-12">
      <?php endif; ?>
        <div class="wow fadeInDown animated colored bordered" data-wow-delay="">
          <?php the_field('content_1'); ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if( get_field('content_2') ): ?>
        <?php if( get_field('content_3') ): ?>
        <div class="col-xs-12 marb30">
        <?php else : ?>
        <div class="col-xs-12">
        <?php endif; ?>
          <div class="wow fadeInDown animated colored bordered" data-wow-delay="">
            <?php the_field('content_2'); ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if( get_field('content_3') ): ?>
        <div class="col-xs-12">
          <div class="wow fadeInDown animated colored bordered" data-wow-delay="">
            <?php the_field('content_3'); ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
    <?php endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>