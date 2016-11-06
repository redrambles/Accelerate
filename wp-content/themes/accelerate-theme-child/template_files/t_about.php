<?php
/**
 *
 * Template Name: CPT About
 *
 * Alternate Version of About Page Using CPTs and a Template
 */

get_header(); ?>

	<?php
	// About CPT Page variables and two fields from the original About Page (id# 47331)
	$cpt_services_intro_title = get_field('cpt_services_intro_title'); //in CPT ABOUT field group - available to this page
	$cpt_services_intro_text = get_field('cpt_services_intro_text'); // in CPT ABOUT field group - available to this page
	$about_contact_title = get_field('about_contact_title', 47331); // Pulled this value and the next from the original about page
	$contact_button_text = get_field('contact_button_text', 47331); 
	?>
	
	<section class="hero-about">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="hero-text">
				<h3><?php the_content(); ?></h3>
			</div>
			<?php endwhile; // end of the loop. ?>
	</section>
	
	<div class="site-content">
		
		<section class="about-intro">

			<h5><?php echo $cpt_services_intro_title; ?></h5>
			<?php echo $cpt_services_intro_text; ?>

		</section>
		
		<div class="all-services">
	
			<?php 
			// Pull in our Services CPT
			$args = array (
					'post_type' => 'services',
					'order' => 'ASC'
				);

			$services_query = new WP_Query($args);
			//$entry = 0;
			?>

			<?php while ($services_query-> have_posts() ) : $services_query->the_post();
				// Variables from our 'services' CPT 
				$cpt_service_description = get_field('cpt_service_description'); // in CPT SERVICES field group
				$cpt_service_image = get_field('cpt_service_image'); // in CPT SERVICES field group
				$size = "small";
				$alignment = " ";
				$align_radio_button = get_field('alignment');
				$align_radio_button == "Left" ? $alignment = "alignleft" : $alignment = "alignright";
				//$entry++;
				//$align = ($entry % 2 == 0) ? 'align-right' : 'align-left';
			?>

				<section class="service-section">
					<figure class="service-image <?php echo $alignment; ?>">
						<?php echo wp_get_attachment_image( $cpt_service_image, $size ); ?>
					</figure>
					<div class="service-description">
						<h2><?php the_title(); ?></h2>
						<p><?php echo $cpt_service_description; ?></p>
					</div>
				</section>
				
				<?php endwhile; //end the while loop
					wp_reset_postdata(); ?>
				
		</div><!-- .all-services -->
		
		
		<section class="about-contact">
			<div class="contact-description">
				<h4><?php echo $about_contact_title; ?></h4>
			</div>
			<div class="contact-button">
				<a class="button" href="<?php echo esc_url( home_url() ); ?>/contact"><?php echo $contact_button_text; ?></a>
			</div>
		</section>

	</div><!-- .site-content -->

	<?php get_footer(); ?>
