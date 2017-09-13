<?php
/* Template name: Merken & Partners */
get_header();
?>

<div class="content-main">
  <div class="row">
  <?php while (have_posts()) : the_post(); ?>

    <?php if( get_field('content_1') ): ?>
    <div class="col-xs-12 marb30">
    <?php else : ?>
    <div class="col-xs-12">
    <?php endif; ?>
      <div class="wow fadeInDown animated colored bordered" data-wow-delay="">
        <?php the_content(); ?>
      </div>
    </div>
  </div>

  <div class="row row-eq-height">    
    <?php if( get_field('content_1') ): ?>
      <div class="col-sm-6">
        <div class="wow fadeInDown animated colored bordered" data-wow-delay="">
          <?php the_field('content_1'); ?>
        </div>
      </div>
      <?php endif; ?>

      <?php if( get_field('content_2') ): ?>
        <div class="col-sm-6">
          <div class="wow fadeInDown animated colored bordered" data-wow-delay="">
            <?php the_field('content_2'); ?>
          </div>
        </div>
      <?php endif; ?>

    </div>
    <?php endwhile; ?>
  </div>
</div>
<?php get_footer(); ?>