<?php
/**
 * The template for displaying case studies
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * differenat template.
 *
 * @package WordPress
 * @subpackage Accelerate Theme
 * @since Accelerate Theme 1.1
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">

	<?php while ( have_posts() ) : the_post(); 
		//$services = get_field('services');
		$services  = get_post_meta($post->ID, "services", true);
		//$client = get_field('client');
		$client  = get_post_meta($post->ID, "client", true);
		//$link = get_field('site_link');
		$link  = get_post_meta($post->ID, "site_link", true);
		$size = "full";
		//$image_1 = get_field('image_1');
		$image_1  = get_post_meta($post->ID, "image_1", true);
		//$image_2 = get_field('image_2');
		$image_2  = get_post_meta($post->ID, "image_2", true);
		//$image_3 = get_field('image_3');
		$image_3  = get_post_meta($post->ID, "image_3", true);

	?>

		<article class="case-study">
			<aside class="case-study-sidebar">

				<h2><?php the_title();?></h2>
				<h6><?php echo $services; ?></h6>
				<h6 id="client">Client: <?php echo $client; ?></h6>

				<?php the_content(); ?>

				<p><strong><a href="<?php echo $link; ?>">Site Link</a></strong></p>
			</aside>

			<div class="case-study-images">
				<?php if($image_1) { 
					echo wp_get_attachment_image( $image_1, $size );
				} ?>

				<?php if($image_2) { 
					echo wp_get_attachment_image( $image_2, $size );
				} ?>

				<?php if($image_3) { 
					echo wp_get_attachment_image( $image_3, $size );
				} ?>
			</div>
		</article>
		
	<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
 

