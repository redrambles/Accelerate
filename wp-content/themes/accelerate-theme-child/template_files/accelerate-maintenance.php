<?php
/**
 * The emergency maintenance page :)
 *
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php 	
		$title = get_field('title', 'option');
		$content = get_field('body', 'option');
		?>
		
		<div class="text_404">
			<h2><?php echo $title; ?></h2>
			<?php echo $content; ?>
			<?php 
			//Mailchimp 'Coming Soon' form - would like to add a conditional to check if it exists - TODO
			echo do_shortcode	('[mc4wp_form id="47681"]'); ?>
		</div>
  </div>
</div>

<?php get_footer(); ?>
