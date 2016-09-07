<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */

get_header(); ?>

	<!-- This is not part of the original assignment -->

	<!-- BLOG PAGE -->
	<section class="blog-page">
		<div class="site-content">
			<div class="main-content">

				<?php if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post(); ?>
				
				<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry'); ?>>
					<div class="entry-wrap">
						<header class="entry-header">
							<div class="entry-meta"> <!-- Modified the time -->
								<time class="entry-time"><?php the_time('F j, Y');?></time>
							</div>
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</header>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div>
						<?php if ( is_home() ) {
							echo do_shortcode('[ssba]'); 
						} ?>
						
						<?php accelerate_theme_child_footer_meta(); ?>
						
					</div>
				</article>
			<?php endwhile; endif; ?>

			</div>
			
			<?php get_sidebar(); ?>

			<div class="clearfix"></div>
			
				<div id="navigation" class="container"> 
			        <div class="left"><?php next_posts_link('&larr; <span>Older Posts</span>'); ?></div>
			        <div class="right"><?php previous_posts_link('<span>Newer Posts</span> &rarr;'); ?></div>
			  </div>
			
		</div>


	</section>
	<!-- END blog page -->
<?php get_footer();
