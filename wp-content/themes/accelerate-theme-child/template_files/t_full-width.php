<?php
/**
 * 
 * Template Name: Full Width Page
 * 
 * This is used as a test
 */

get_header(); ?>


<div id="primary" class="site-content">
	<div id="content" role="main">
		<div class="page-content">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_meta(); ?>
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>