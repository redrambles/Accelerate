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
		<div class="page-content <?php if (is_page('testing')) { echo 'testing-page kittens'; } ?>"> <!-- Testing pulling in class conditionally - works! -->

		<!-- Testing the same function detailed below - put in functions.php and called here - WORKS! -->
		<?php //red_get_me_some_posts(); ?>

		<!-- Testing calling some info OUTSIDE of a loop and playing with get_posts - WORKS! -->
		<?php
			//$args = array( 'posts_per_page' => 3 );
			//$lastposts = get_posts( $args );
			//foreach ( $lastposts as $post ) :
		   	//setup_postdata( $post ); ?>

			<!-- <h2><a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a></h2> -->
			<?php //the_excerpt(); ?>

		<?php //endforeach; 
		//wp_reset_postdata(); ?>
		<!-- End test-->

			<?php while ( have_posts() ) : the_post(); ?>
				<?php //the_meta(); ?> <!-- Will echo out all custom fields -->
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>