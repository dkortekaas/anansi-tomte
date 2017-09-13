<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="content-main woocommerce">
	<div class="row">
		<div class="col-xs-12">
			<div class="colored bordered marb30">
				<h2><?php _e('Search', 'anansi-tomte'); ?></h2>
			</div>
		</div>
	</div>

	<div class="row row-eq-height grid">

		<div class="col-xs-12">
			<div class="colored bordered">          
				<div class="col-main">
				<?php if ( have_posts() ) : ?>
					<div class="display-product-option">
						<div class="toolbar">
							<div class="row">
								<div class="col-xs-6" style="vertical-align:bottom;">
									<p class="woocommerce-result-count" style="margin-bottom: 0;margin-top: 15px;">
										<?php
										$paged = max(1, $wp_query->get('paged'));
										$per_page = 12; //$wp_query->get('posts_per_page');
										$total = $wp_query->found_posts;
										$first = ($per_page * $paged) - $per_page + 1;
										$last = min($total, $wp_query->get('posts_per_page') * $paged);
										if (1 == $total) :
											_e('Showing the single result', 'woocommerce');
										elseif ($total <= $per_page || -1 == $per_page) :
											printf(__('Showing all %d results', 'woocommerce'), $total);
										else :
											printf(_x('Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce'), $first, $last, $total);
										endif;
										?>
									</p>
								</div>
								<div class="col-xs-6">
									<div class="searchform pull-right" style="margin-bottom: 0;">
										<?php echo do_shortcode('[yith_woocommerce_ajax_search]');?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="category-products">
						<h2 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'pvc' ), esc_html( get_search_query())); ?></h2>
						<ul class="products-grid row">
						<?php while ( have_posts() ) : the_post();
							echo wc_get_template_part( 'content', 'search' );
						endwhile; ?>
						</ul>
					</div>
				</div>
				<?php wp_reset_postdata(); ?>                       
				<?php else: ?>
					<div class="display-product-option">
						<div class="toolbar">
							<div class="row">
								<div class="col-xs-6" style="vertical-align:bottom;">
									<p class="woocommerce-result-count" style="margin-bottom: 0;margin-top: 15px;">
										<?php
										$paged = max(1, $wp_query->get('paged'));
										$per_page = 12; //$wp_query->get('posts_per_page');
										$total = $wp_query->found_posts;
										$first = ($per_page * $paged) - $per_page + 1;
										$last = min($total, $wp_query->get('posts_per_page') * $paged);
										if (1 == $total) :
											_e('Showing the single result', 'woocommerce');
										elseif ($total <= $per_page || -1 == $per_page) :
											printf(__('Showing all %d results', 'woocommerce'), $total);
										else :
											printf(_x('Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce'), $first, $last, $total);
										endif;
										?>
									</p>
								</div>
								<div class="col-xs-6">
									<div class="searchform pull-right" style="margin-bottom: 0;">
										<?php echo do_shortcode('[yith_woocommerce_ajax_search]');?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="category-products">
						<h2 class="entry-title"><?php printf( esc_html__( 'Nothing Found for: %s', 'pvc' ), esc_html( get_search_query())); ?></h2>
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?></p>
					</div>
				<?php endif; ?>	
				</div>
			</div>		
		</div>
	</div>
</div>

<?php get_footer();