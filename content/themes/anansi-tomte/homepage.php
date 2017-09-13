<?php
/* Template name: Home */
get_header();
?>

<div class="content-main">
    <div class="row row-eq-height header-slider">
        <div class="col-xs-3 hidden-xs">
            <div class="wow fadeInDown img-left">
            <?php 

            $limages = get_field('left_images');

            if( $limages ): ?>
            <div class="flexslider">
                <ul class="slides">
                    <?php foreach( $limages as $limage ): ?>
                        <li>
                            <img src="<?php echo $limage['sizes']['home-banner']; ?>" alt="<?php echo $limage['alt']; ?>" />
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 colored">
            <div class="wow fadeInDown" data-wow-delay="">
                <h2 class="title-un"><?php the_title(); ?></h2>
                <p class="title-un-des"><?php the_content(); ?></p>
            </div>
        </div>
        <div class="col-xs-3 hidden-xs">
            <div class="wow fadeInDown img-right">
            <?php 

            $rimages = get_field('right_images');

            if( $rimages ): ?>
            <div class="flexslider">
                <ul class="slides">
                    <?php foreach( $rimages as $rimage ): ?>
                        <li>
                            <img src="<?php echo $rimage['sizes']['home-banner']; ?>" alt="<?php echo $rimage['alt']; ?>" />
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="home-blocks mobmt30">
    <div class="row row-eq-height">
        <div class="col-xs-12 col-sm-12">
            <div class="wow fadeInDown colored bordered" data-wow-delay="0.2s">
                <div class="img-banner">
                    <h3 class="img-banner-title title-un-two "><?php the_field('product_title'); ?></h3>
                    <div class="img-banner-desc title-un-des-two">
                        <?php the_field('producten'); ?>
                        <?php
                            $taxonomy     = 'product_cat';
                            $orderby      = 'name';  
                            $show_count   = 0;      // 1 for yes, 0 for no
                            $pad_counts   = 0;      // 1 for yes, 0 for no
                            $hierarchical = 0;      // 1 for yes, 0 for no  
                            $title        = '';  
                            $empty        = 1;
                            $depth        = 0;

                            $args = array(
                                    'taxonomy'     => $taxonomy,
                                    'orderby'      => $orderby,
                                    'show_count'   => $show_count,
                                    'pad_counts'   => $pad_counts,
                                    'hierarchical' => $hierarchical,
                                    'title_li'     => $title,
                                    'hide_empty'   => $empty,
                                    'depth'        => $depth
                            );
                            $all_categories = get_categories( $args );
                            echo '<ul class="home-product-cats row">';
                            foreach ($all_categories as $cat) :
                                if ($cat->category_parent == 0) :
                                    $category_id = $cat->term_id;
                                    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                                    $image = wp_get_attachment_url( $thumbnail_id );
                                    $metaArray = get_option('taxonomy_' . $category_id);
                                    if (isset($metaArray)) :
                                        $productCatMetaTitle = $metaArray['wl_subtitle'];
                                    endif;
                                    echo '<li class="col-xs-6 col-sm-3 cat-item">';
                                        echo '<a href="'. get_term_link($cat->slug, 'product_cat') .'">';
                                            echo '<img src="'. $image .'" alt="'. $cat->name .'" width="280" height="280" />';
                                        echo  '</a>';
                                        echo '<div class="cat-title"><a href="'. get_term_link($cat->slug, 'product_cat') .'" data-toggle="tooltip" title="'. $cat->name .'">'. $productCatMetaTitle .'</a></div>';
                                    echo '</li>';
                                endif;
                            endforeach;
                            echo '</ul>';
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <!--
        <div class="col-xs-12 col-sm-6">
            <div class="wow fadeInDown colored bordered" data-wow-delay="0.2s">
                <div class="img-banner">
                    <h3 class="img-banner-title title-un-two "><?php the_field('service_title'); ?></h3>
                    <div class="img-banner-desc title-un-des-two">
                        <?php the_field('diensten'); ?>
                        <?php
                            $taxonomy     = 'service_type';
                            $orderby      = 'name';  
                            $show_count   = 0;      // 1 for yes, 0 for no
                            $pad_counts   = 0;      // 1 for yes, 0 for no
                            $hierarchical = 0;      // 1 for yes, 0 for no  
                            $title        = '';  
                            $empty        = 1;
                            $depth        = 0;

                            $args = array(
                                    'taxonomy'     => $taxonomy,
                                    'orderby'      => $orderby,
                                    'show_count'   => $show_count,
                                    'pad_counts'   => $pad_counts,
                                    'hierarchical' => $hierarchical,
                                    'title_li'     => $title,
                                    'hide_empty'   => $empty,
                                    'depth'        => $depth
                            );

                            $categories = get_terms($args);
                            echo '<ul class="home-product-cats row">';
                            foreach ($categories as $servcat) :
                                if ($servcat->category_parent == 0) :
                                    $category_id = $servcat->term_id;
                                    $thumbnail_id = get_term_thumbnail_id( $servcat->term_id );
                                    $thumbnail_src = wp_get_attachment_image_src( $thumbnail_id );
                                    $serviceCatMetaTitle = get_field('subtitle', $servcat->taxonomy.'_'.$servcat->term_id);
                                    echo '<li class="col-xs-12 col-sm-4 cat-item">';
                                        echo '<a href="'. get_category_link( $category_id ) .'">';
                                            echo '<img src="'. $thumbnail_src[0] .'" alt="'. $cat->name .'" width="280" height="280" />';
                                        echo  '</a>';
                                        echo '<div class="cat-title"><a href="'. get_category_link( $category_id ) .'" data-toggle="tooltip" title="'. $servcat->name .'">'. $serviceCatMetaTitle .'</a></div>';
                                    echo '</li>';
                                endif;
                            endforeach;
                            echo '</ul>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
        -->
    </div>

</div>

<?php get_footer(); ?>