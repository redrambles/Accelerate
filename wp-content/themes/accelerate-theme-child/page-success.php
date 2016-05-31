<?php
/**
 * Custom Contact Page Success message - used with the 'redirect' option for Ninja Forms
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		<div class="narrow-contact">
	
	<?php 
		$success_title_redirect = get_field('success_title_redirect');
		$success_body_redirect = get_field('success_body_redirect');
	?>
	
			<div class="contact-form"> 

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 

					<div class="reply-contact">
					
						<h2><?php echo $success_title_redirect; ?></h2>

						<p><?php echo $success_body_redirect; ?></p>

					</div>
          
        <?php endwhile; endif; ?> 
		  </div>
	  </div>
  </div>
</div>

<?php get_footer(); ?>
