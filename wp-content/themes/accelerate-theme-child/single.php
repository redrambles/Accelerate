<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<!-- This is not part of the original assignment -->
				
	<section class="blog-page">
		<div class="site-content">
			<div class="main-content">
	
	<?php
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>

				<article class="post-entry individual-post">
					<div class="entry-wrap">
						<header class="entry-header">
							<div class="entry-meta">
								<?php //the_meta(); ?>
								<time class="entry-time"><?php the_time('F j, Y');?></time>
							</div>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header>

						<div class="entry-summary">
							<?php the_content(); ?>
						</div>
						
						<?php accelerate_theme_child_footer_meta(); ?>
					
					</div>
				</article>
			<?php 	// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>

			</div> <!-- main-content -->
		<?php get_sidebar(); ?>

	<!-- END blog page -->

			<footer class="navigation container">
				<div class="left">&larr;<a href="<?php echo esc_url( home_url() ); ?>/blog">Back to posts</a></div>
			</footer>
	
				<?php endwhile; ?>
			</div> <!-- site-content -->
		</section>
<?php
get_footer();