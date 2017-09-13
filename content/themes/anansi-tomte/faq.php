<?php
/* Template name: FAQs */
get_header();
?>

<div class="content-main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

        <div class="row">
            <div class="col-md-12 marb30">
                <div class="colored bordered">
                    <h2 class="title-un"><?php the_title(); ?></h2>
                    <p class="title-un-des"><?php the_content(); ?></p>
                </div>
            </div>

             <div class="col-md-12">
                <div class="colored bordered">
                <?php
                if( have_rows('faqs') ):
                    while ( have_rows('faqs') ) : the_row();
                         echo'<div id="faq_container"> 
                            <div class="faq">
                                <div class="faq_question"> <span class="question">' . get_sub_field('faq_question') . '</span><span class="accordion-button-icon fa fa-plus"></span></div>
                                    <div class="faq_answer_container">
                                        <div class="faq_answer"><span>' . get_sub_field('faq_answer') . '</span></div>
                                    </div>
                                </div>
                            </div>';
                    endwhile;
                endif;
                ?>
                </div>
            </div>           
        </div>

        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>