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
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">

		<div class="text_404">
			<h2>That page!</h2>
			<h4>She is nowhere to be found.</h4>
			<p class="forgive">Forgive Us.</p>
		</div>

	 <figure class="image_404">
		</figure>
		<div class="recentposts_404">
			<h2><a href="<?php echo esc_attr( site_url('/blog') );?>">Recent Posts</a></h2>
				<ul>
				<?php
					$args = array( 'numberposts' => '5' );
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
						echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
					}
				?>
				</ul>
		</div>
		<div class="recentwork_404">
			<h2><a href="<?php echo esc_attr( site_url('/case-studies') );?>">Recent Work</a></h2>
				<ul>
				<?php
					$args = array( 'numberposts' => '5', 'post_type' => 'case_studies', 'order' => 'ASC' );
					$recent_posts = wp_get_recent_posts( $args );
					foreach( $recent_posts as $recent ){
						echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
					}
				?>
				</ul>
		</div>
	<!-- <div class="search_404">
			<h2>Looking for something else?</h2>
			<?php //get_search_form();?>
	</div>  -->
</div>

<?php get_footer(); ?>
