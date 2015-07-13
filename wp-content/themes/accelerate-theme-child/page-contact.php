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
		<div class="page-content">
	
		<?php $method = $_SERVER['REQUEST_METHOD']; ?> 

			<div class="contact-form"> 

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
					<?php //the_meta(); ?>
					<!-- Fooling around with custom fields -->
					<?php //$sanity = get_post_meta(47333, 'sanity'); ?>
					<!-- <p class="sanity">Sanity: <?php //echo implode($sanity); ?></p> -->

					<?php if ($method == 'POST' ): ?> 
					<div class="reply-contact">
					
						<h2>Thanks for Your Message!</h2>

						<p>We'll get back to you shortly.</p>

					</div>

					<?php else: ?> 

					<h3><?php the_title(); ?></h3> 

					<?php the_content(); ?> 

					<?php endif; ?> 

				<?php endwhile; endif; ?> 

			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>


