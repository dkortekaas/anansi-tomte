<?php
/* Template name: Anansi & Tomte */
get_header();
?>

<div class="content-main">

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>

      <div class="row row-eq-height padmob header-slider">
          <div class="col-xs-3 hidden-xs marb30">
              <div class="wow fadeInDown img-left">
              <?php
              $limages = get_field('left_images');
              if( $limages ): ?>
              <div class="flexslider">
                  <ul class="slides">
                      <?php foreach( $limages as $limage ): ?>
                          <li>
                              <img src="<?php echo $limage['sizes']['anansi-banner']; ?>" alt="<?php echo $limage['alt']; ?>" />
                          </li>
                      <?php endforeach; ?>
                  </ul>
              </div>
              <?php endif; ?>
              </div>
          </div>
          <div class="col-xs-12 col-sm-6 colored marb30">
              <div class="wow fadeInDown" data-wow-delay="">
                  <h2 class="title-un"><?php the_title(); ?></h2>
                  <p class="title-un-des"><?php the_content(); ?></p>
              </div>
          </div>
          <div class="col-xs-3 hidden-xs marb30">
              <div class="wow fadeInDown img-right">
              <?php 
              $rimages = get_field('right_images');
              if( $rimages ): ?>
              <div class="flexslider">
                  <ul class="slides">
                      <?php foreach( $rimages as $rimage ): ?>
                          <li>
                              <img src="<?php echo $rimage['sizes']['anansi-banner']; ?>" alt="<?php echo $rimage['alt']; ?>" />
                          </li>
                      <?php endforeach; ?>
                  </ul>
              </div>
              <?php endif; ?>
              </div>
          </div>
      </div>

        <div class="row row-eq-height">

          <div class="col-md-6 marb30">
            <div class="colored bordered">
              <h2 class="title-un"><?php the_field('anansi_title'); ?></h2>
              <?php the_field('anansi_text'); ?>
            </div>
          </div>

          <div class="col-md-6 marb30">
            <div class="colored bordered">
              <h2 class="title-un"><?php the_field('tomte_title'); ?></h2>
              <?php the_field('tomte_text'); ?>
            </div>
          </div>
        </div>

        <div class="row row-eq-height">
          <div class="col-md-6">
            <div class="colored bordered">
              <?php the_field('about_anansi'); ?>
            </div>
          </div>

          <div class="col-md-6 mobmt30">
            <div class="colored bordered">
              <?php the_field('about_tomte'); ?>
            </div>
          </div>
        </div>
        
      <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
