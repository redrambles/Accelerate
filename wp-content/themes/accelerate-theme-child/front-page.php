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

<?php
// Testing displaying option field
// $twitter = the_field('twitter', 'option'); 
// echo $twitter;
// 
// // TO-DO: map the href attribute to fontawesome icon - this is a TEST 
// if ( have_rows( 'social-icon', 'option' ) ) : 
//while ( have_rows( 'social-icon', 'option' ) ) : the_row(); ?>
<!-- <a href="<?php //the_sub_field( 'social-media-address', 'option' ); ?>"><?php //the_sub_field( 'social-media-address', 'option' ); ?></a> -->
<?php //endwhile; ?>

<section class="home-page">
		<!-- <div class="site-content"> -->
			<?php while ( have_posts() ) : the_post(); ?>
				<div class='homepage-hero'>
					<?php the_content(); ?>
					<a class="button" href="<?php echo home_url(); ?>/case-studies">View Our Work</a>			
				</div>
			<?php endwhile; // end of the loop. ?>
		<!-- </div --><!-- .site-content -->
</section><!-- .home-page -->

<section class="featured-work">
	<div class="site-content">
		<h4>Featured Work</h4>
		
		<ul class="homepage-featured-work">
			<?php //query_posts('posts_per_page=3&post_type=case_studies&order=DESC'); ?>

			<?php $args = array (
					'posts_per_page' => 3,
					'post_type' => 'case_studies',
					'order' => 'ASC',
					'status' => 'publish'
				);

			$featured = new WP_Query($args);?>

			<?php while ($featured-> have_posts() ) : $featured->the_post();
				//$image_1 = get_field("image_1");
				$image_1  = get_post_meta(get_the_id(), "image_1", true);
				$size = "front-page-featured-work";
			 ?>
			 	<li class="individual-featured-work">	
				 	<figure>
						<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image($image_1, $size); ?></a>
				 	</figure>
					<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				</li>
			<?php endwhile; //end the while loop
			wp_reset_postdata();
			//wp_reset_query(); ?> <!-- reset altered query back to the original -->
		</ul>
	</div>
</section>

<section class="featured-services">
	<div class="site-content">
		<h4><a href="<?php echo home_url(); ?>/about">Services</a></h4>
		<?php $args = array (
			'post_type' => 'services',
			'posts_per_page' => 4,
			'order' => 'ASC',
			'status' => 'publish'
				);
			$services = new WP_Query($args);?>

		<ul class="homepage-featured-services">
			<?php while ( $services->have_posts() ) : $services->the_post(); 
				$cpt_service_image = get_field('cpt_service_image');
				$size = "medium";
			 ?>
		 	<li class="individual-featured-service">	
			 <a href="<?php the_permalink(); ?>">
				 	<figure>
				 		<?php echo wp_get_attachment_image($cpt_service_image, $size); ?>
				 	</figure>
					<h5><?php the_title(); ?></h5>
				</a>
			</li>
			<?php endwhile; //end the while loop
			wp_reset_postdata(); ?>
		</ul>
	</div>
</section>

<section class="recent-posts">
	<div class="site-content">
		<div class="blog-post">
			<h4>From the Blog</h4>
			<?php $args = array (
					'posts_per_page' => 1
				);
			$blog = new WP_Query($args);?>

			<?php while ( $blog->have_posts() ) : $blog->the_post(); ?>
			   <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
                <a class="read-more-link" href="<?php the_permalink(); ?>">Read More <span>&rsaquo;</span></a>
			<?php endwhile; //end the while loop
			wp_reset_postdata(); ?>
		</div><!-- .blog-post -->

		<!-- Sidebar to host the twitter module  -->
		<?php 
		    $twitter_link = get_field('twitter_link');
		    $link_name = get_field('link_name');
		?>
		<!-- The twitter handle is being fetched from the database and appended to the widget title using a filter - in inc/extras.php -->
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		
		<div id="secondary" class="widget-area tweet-module" role="complementary">
		<!-- see inc/extras.php for how the '@Redrambles' was dynamically output -->
		    <a href="<?php echo $twitter_link ?>"><?php dynamic_sidebar( 'sidebar-2' ); ?></a>

				<!-- <a href="<?php //..echo $twitter_link ?>" class="follow-us-link"><?php //echo $link_name; ?><span> &rsaquo;</span></a> -->
				<?php 
					$stt_options = get_option( 'widget_pi_simpletwittertweets' );
					$twitter_handle = $stt_options[2]['name'];
				?>
				<a href="http://twitter.com/<?php echo $twitter_handle; ?>" class="follow-us-link">Follow Us<span> &rsaquo;</span></a>
		</div>
		<?php endif; ?>


<!--Impromptu Slider based on custom taxonomy terms of custom post type (FAQ)-->
<div class="site-content faq-home-section">
	<?php $terms = get_terms("faq_genre"); 
			$home = home_url('/');
			foreach ( $terms as $term ) {
				if ($term->count > 0){
					//echo $term->count;
					echo '<div class="faq-term clearfix"><a href="'.get_term_link($term->slug, 'faq_genre').'">'.$term->name.'</a></div>';
				}
			?>

		<ul class="faq-list slick-slider">
			<?php $args = array(
					'post_type' => 'faq',
					'tax_query' => array(
						array(
							'taxonomy' => 'faq_genre',
							'field'    => 'slug', //needed this
							'terms'    => $term->slug,
						),
					),
				);


			$faqs = new WP_Query($args);
			//var_dump($faqs);
						while ($faqs-> have_posts() ) : $faqs->the_post(); 
						//$terms = wp_get_post_terms($post->ID, 'category', array("fields" => "all"));
						
						if (has_post_thumbnail()) { ?> 
							<li class="faq-list-item slide">
								<figure class="faq-post-thumbnail">
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('front-page-faq-slider'); ?></a>
								</figure>
								<h5 class="faq-front-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							</li>
						<?php } ?>
					<?php endwhile; //end the while loop
					wp_reset_postdata(); ?>
				</ul>
			<?php } ?>


	</div><!-- .site-content -->
</section><!-- .recent-posts -->

<?php get_footer(); ?>