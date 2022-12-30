<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 

$current_cat = get_queried_object();
?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class('c-equipment'); ?>>

		<?php astra_primary_content_top(); ?>

		<?php astra_archive_header(); ?>

		<?php astra_content_loop(); ?>

		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

		<?php 
		$sticky = get_field('sticky_posts', $current_cat);
		if($sticky):
		?>
			<section class="c-related-header ast-archive-description">
				<h2 class="page-title">Selected Products Reviews</h2>
			</section>

			<section class="c-related-content site-main">
			    <div class="ast-row">
					<?php foreach($sticky as $post): setup_postdata($post); ?>

						<article <?php post_class() ?>>
							<div class="blog-layout-1">
								<div class="post-content ast-grid-common-col">
									<div class="ast-blog-featured-section post-thumb ast-grid-common-col ast-float">
										<div class="post-thumb-img-content post-thumb">
											<a href="<?php the_permalink() ?>">
												<?php the_post_thumbnail() ?>
											</a>
										</div>
									</div>
									<header class="entry-header">
										<h2 class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
									</header>
								</div>
							</div>
						</article>
							
					<?php endforeach; wp_reset_postdata() ?>
			    </div>
			</section>
		<?php endif; ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
