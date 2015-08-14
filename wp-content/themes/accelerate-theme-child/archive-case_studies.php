<?php
/**
 * The template for displaying the landing page for the work archive
 *
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">
	<?php while ( have_posts() ) : the_post(); 
			// 'get_field' is a shortcut that is provided by ACF - using 'get_post_meta' uses a function inherent within WP and so if for some reason ACF breaks, you're not looking at a broken site.
			//$image_1 = get_field('image_1');
			$image_1  = get_post_meta($post->ID, "image_1", true);
			$size = "full";
			//$services = get_field('services');
			$services = get_post_meta($post->ID, "services", true); ?>

	<article class="case-study">
		<aside class="case-study-sidebar">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
			<h6><?php echo $services; ?></h6>

			<?php the_excerpt(); ?>
			
			<p class="view-project"><a href="<?php the_permalink(); ?>">View Project &#x276f;</a></p>
		</aside>

		<div class="case-study-images">
			<a href="<?php the_permalink(); ?>">
				<?php if($image_1) { 
					echo wp_get_attachment_image( $image_1, $size );
				} ?>
			</a>
		</div>
	</article>
	<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>







