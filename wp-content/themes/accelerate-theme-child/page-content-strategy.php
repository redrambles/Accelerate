<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		<div class="page-content">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

					$title = get_field('title'); ?> 

					<h2><?php echo $title; ?></h2> 

					<?php the_content(); ?> 

				<?php endwhile; endif; ?> 

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>


