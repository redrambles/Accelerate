<?php
/**
 * The template for displaying case studies
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">

	<?php while ( have_posts() ) : the_post(); 
		//$services = get_field('services');
		//$services  = get_post_meta($post->ID, "services", true); - would only need to use this '$post->ID' if outside of the loop and needed to access the global post variable
		$services  = get_field('services');
		$client  = get_field('client');
		$link  = get_field('link');
		$image_1  = get_field('image_1');
		$image_2  = get_field('image_2');
		$image_3  = get_field('image_3');
		$size = "full";
	?>

		<article class="case-study">
			<aside class="case-study-sidebar">

				<h2><?php the_title(); ?></h2>
				<h6><?php echo $services; ?></h6>
				<h6 id="client">Client: <?php echo $client; ?></h6>

				<?php the_content(); ?>

				<p><strong><a href="<?php echo $link; ?>">Site Link</a></strong></p>
			</aside>

			<div class="case-study-images">
				<?php $image_array = array( $image_1, $image_2, $image_3 );
					foreach ( $image_array as $image ){
						if( $image ){
							echo wp_get_attachment_image( $image, $size );
						}
					}
					?>
				
				<?php 
				// if($image_1) { 
				// 	echo wp_get_attachment_image( $image_1, $size );
				// } 
				// 
				// if($image_2) { 
				// 	echo wp_get_attachment_image( $image_2, $size );
				// } 
				// if($image_3) { 
				// 	echo wp_get_attachment_image( $image_3, $size );
				// } ?>
			</div>
		</article>
		
	<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
 

