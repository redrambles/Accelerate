<?php
/**
 * FAQs
 *
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section class="faq">
	<div class="site-content">

		<?php if ( have_posts() ) :

			the_archive_title( '<h1 class="faq-archive-title">', '</h1>' );
		// Start the Loop.
			while ( have_posts() ) : the_post(); ?>
		
		<article class="post-entry">
			<div class="entry-wrap">
				<header class="entry-header faq-title">
					<h2 class="entry-title"><?php the_title(); ?></h2>
				</header>

				<div class="entry-summary faq-answer">
					<?php the_content(); ?>
				</div>
			</div>
		</article>
	<?php endwhile; endif; ?>
	
	</div>
</section>

<?php get_footer();
