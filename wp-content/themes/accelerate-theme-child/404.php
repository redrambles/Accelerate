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
 * 
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		<div class="text_404">
		
		<?php //$pic  = get_post_meta(47333, "pic_404", true); // stored this in the contact page - just a test
		//$size = 'full'; 
		
		//if($pic) { //worked! ?>
				<!-- <img src="<?php //echo $pic; ?>"/>  -->
			<?php // } ?>

	<!-- <img src="<?php //echo get_stylesheet_directory_uri(); ?>/img/taxi-photo-about.jpg"/> --> <!-- Worked! -->
	
	<?php //$image_src = wp_get_attachment_url(47459, 'full'); ?> <!-- Fetch the attachment directly with its id -->

	<!-- <img src="<?php //echo $image_src; ?>"/> --> <!-- worked -->

	<!-- <iframe src="https://cloudup.com/cL3NbLNWqAY?chromeless" width="500" height="500"></iframe>
 -->
			<h2>That page!</h2>
			<h4>She is nowhere to be found.</h4>
			<p class="forgive">Forgive Us.</p>
		</div>
		<figure class="image_404">
		</figure>
	</div>
</div>

<?php get_footer(); ?>