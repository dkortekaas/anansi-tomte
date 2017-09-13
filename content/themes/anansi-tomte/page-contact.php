<?php
/* Template name: Contact */
get_header();
$sideleft = false;
$sideright = false;
$colclass = "col-xs-12";

if ( is_active_sidebar( 'sidebar-contact' ) ) :
  $sideright = true;
endif; 
if($sideright == true) :
    $colclass = "col-sm-8";
endif;

?>

<div class="content-main">
    <div class="row-eq-height">
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-xs-12 colored bordered marb30">
            <div class="wow fadeInDown" data-wow-delay="">
                <h2 class="title-un"><?php the_title(); ?></h2>
                <p class="title-un-des"><?php the_content(); ?></p>
            </div>
        </div>
    </div>
   
    <div class="row row-eq-height">

        <div class="<?php echo $colclass ?>">
            <div class="colored bordered">
                <h2 class="title-un a-left"><?php _e('Contactform','anansi-tomte') ?></h2>
                <?php if (ICL_LANGUAGE_CODE=='nl') : ?>
                <?php echo do_shortcode( '[contact-form-7 id="51" title="Contactformulier"]' ); ?>
                <?php elseif (ICL_LANGUAGE_CODE=='en') : ?>
                <?php echo do_shortcode( '[contact-form-7 id="6019" title="Contactformulier EN"]' ); ?>
                <?php else : ?>
                <?php echo do_shortcode( '[contact-form-7 id="6020" title="Contactformulier ES"]' ); ?>
                <?php endif; ?>              
                <span class="orange">*</span> <?php _e('Required Fields', 'anansi-tomte'); ?>
            </div>
        </div>

        <?php if ( $sideright ) : ?>
        <div class="col-sm-4 hidden-xs">
            <div class="colored bordered">
            <?php dynamic_sidebar( 'sidebar-contact' ); ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>