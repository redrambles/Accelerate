<?php
/**
 * Template: About Page
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
		<section class="about-intro">
			<h5>Our Services</h5>
			<p>We take pride in our clients and the content we create for them.
			Here's a brief overview of our offered services.</p>
		</section>
		<section class="about-section">
			<div class="service-image align-left bulls_eye">
			</div>
			<div class="service-description">
					<?php 
					$query = new WP_Query('pagename=content-strategy');
					// The Loop
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post(); ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
							<p class="service-text"><?php the_excerpt(); ?></p>
						<? }
					}
					/* Restore original Post Data */
					wp_reset_postdata();
					?>
			</div>
		</section>
		<section class="about-section">
			<div class="service-description">
				<?php 
				$query = new WP_Query('pagename=influencer-mapping');
				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post(); ?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						<p class="service-text"><?php the_excerpt(); ?></p>
					<? }
				}
				/* Restore original Post Data */
				wp_reset_postdata();
				?>
			</div>
			<div class="service-image align-right atom">
			</div>
		</section>

		<section class="about-section">
			<div class="service-image align-left thumbs_up">
			</div>
			<div class="service-description">
				<h2>Social Media Strategy</h2>

				<p class="service-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
				Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi.
				Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. 
				Nullam mollis. Ut justo. Suspendisse potenti.</p>
			</div>
		</section>

		<section class="about-section">
			<div class="service-description">
				<h2>Design & Development</h2>

				<p class="service-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. 
				Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi.
				Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. 
				Nullam mollis. Ut justo. Suspendisse potenti.</p>
			</div>

			<div class="service-image align-right magic_wand">
			</div>
		</section>

		<section class="about-contact">
			<div class="contact-description">
				<h4>Interested in working with us?</h4>
			</div>
			<div class="contact-button">	
				<a class="button" href="<?php echo home_url(); ?>/contact">Contact Us</a>
			</div>
		</section>
	</div>
</div>

<?php get_footer(); ?>