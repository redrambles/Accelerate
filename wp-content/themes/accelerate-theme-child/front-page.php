<?php
/**
 * The template for displaying the homepage
 *
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */

get_header(); ?>

<section class="home-page">
		<!-- <div class="site-content"> -->
			<?php while ( have_posts() ) : the_post(); ?>
				<div class='homepage-hero'>
					<?php the_content(); ?>
					<a class="button" href="<?php echo home_url(); ?>/case-studies">View Our Work</a>
				</div>
			<?php endwhile; // end of the loop. ?>
		<!-- </div -->><!-- .site-content -->
</section><!-- .home-page -->

	<!-- Testing -->
<?php //print_r($wp_query); exit; ?>

<section class="featured-work">
	<div class="site-content">
		<h4>Featured Work</h4>
		
		<ul class="homepage-featured-work">
			<?php //query_posts('posts_per_page=3&post_type=case_studies&order=DESC'); ?>

			<?php $args = array (
					'posts_per_page' => 3,
					'post_type' => 'case_studies'
				);

			$featured = new WP_Query($args);?>

			<?php while ($featured-> have_posts() ) : $featured->the_post();
				//$image_1 = get_field("image_1");
				$image_1  = get_post_meta(get_the_id(), "image_1", true);
				$size = "medium";
			 ?>
			 	<li class="individual-featured-work">	
				 	<figure>
				 		<?php echo wp_get_attachment_image($image_1, $size); ?>
				 	</figure>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				</li>
			<?php endwhile; //end the while loop
			wp_reset_postdata();
			//wp_reset_query(); ?> <!-- reset altered query back to the original -->
		</ul>
	</div>
</section>

	<?php //testing a different way to fetch the info from the about page - it works as well but I think below is more clear
	// and we can't really benefit form using a loop because it's all custom fields - the only advantage is that you don't have
	// to enter the post ID - you would let the loop figure it out
	//$args = array (
	// 		'pagename' => 'about'
	// 	);

	// $test = new WP_Query($args);
	// if while ($test-> have_posts() ) : $test->the_post(); 
	// 	$service_1_title = get_field('service_1_title');
	// 	echo $service_1_title;
	// endwhile;
	?>

<section class="featured-services">
	<div class="site-content">
		<h4><a href="<?php echo home_url(); ?>/about">Services</a></h4>
		<ul class="homepage-featured-services">
			<?php
				// You could also create a new custom query fetching pagename="about" info and then use the variables exactly 
				$service_1_image = get_field('service_1_image', 47331); 
				//$service_1_image  = get_post_meta(47331, "service_1_image", true); - This would be the NON ACF dependant method
				$service_2_image = get_field('service_2_image', 47331);
				$service_3_image = get_field('service_3_image', 47331);
				$service_4_image = get_field('service_4_image', 47331);
				$service_1_title = get_field('service_1_title', 47331);
				$service_2_title = get_field('service_2_title', 47331);
				$service_3_title = get_field('service_3_title', 47331);
				$service_4_title = get_field('service_4_title', 47331);
				$size = "medium";
			 ?>
		 	<li class="individual-featured-service">	
			 	<figure>
			 		<?php echo wp_get_attachment_image($service_1_image, $size); ?>
			 	</figure>
				<h5><a href="<?php the_permalink(); ?>"><?php echo $service_1_title; ?></a></h5>
			</li>
			<li class="individual-featured-service">	
			 	<figure>
			 		<?php echo wp_get_attachment_image($service_2_image, $size); ?>
			 	</figure>
				<h5><a href="<?php the_permalink(); ?>"><?php echo $service_2_title; ?></a></h5>
			</li>
			<li class="individual-featured-service">	
			 	<figure>
			 		<?php echo wp_get_attachment_image($service_3_image, $size); ?>
			 	</figure>
				<h5><a href="<?php the_permalink(); ?>"><?php echo $service_3_title; ?></a></h5>
			</li>
			<li class="individual-featured-service">	
			 	<figure>
			 		<?php echo wp_get_attachment_image($service_4_image, $size); ?>
			 	</figure>
				<h5><a href="<?php the_permalink(); ?>"><?php echo $service_4_title; ?></a></h5>
			</li>
		</ul>
	</div>
</section>

<section class="recent-posts">
	<div class="site-content">
		<div class="blog-post">
			<h4>From the Blog</h4>
			<?php //query_posts('posts_per_page=1'); ?>
			<?php $args = array (
					'posts_per_page' => 1
				);
			$blog = new WP_Query($args);?>

			<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
			   <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="read-more-link">Read More <span>&rsaquo;</span></a>
			<?php endwhile; //end the while loop
			wp_reset_postdata();
			//wp_reset_query(); ?> <!-- reset altered query back to the original -->
		</div><!-- .blog-post -->

		<!-- Sidebar to host the twitter module  -->
		<?php 
		    $twitter_link = get_field('twitter_link');
		    $link_name = get_field('link_name');
		?>
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="secondary" class="widget-area tweet-module" role="complementary">
		    <a href="<?php echo $twitter_link ?>"><?php dynamic_sidebar( 'sidebar-2' ); ?></a>

		    <a href="<?php echo $twitter_link ?>" class="follow-us-link"><?php echo $link_name; ?><span> &rsaquo;</span></a>
		</div>
		<?php endif; ?>

	</div><!-- .site-content -->
</section><!-- .recent-posts -->

<?php get_footer(); ?>
