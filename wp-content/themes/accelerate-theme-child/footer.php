<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->

		<?php // Remove 'Accelerate' in the description in the footer page ONLY
			add_filter( 'option_blogdescription', 'accelerate_change_description_footer', 10, 2 );
			function accelerate_change_description_footer( $description )
			{
					$description = str_replace('Accelerate', '', $description);
			    return $description;
			} 
		?>
		
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">

				<div class="site-description">
					<!-- To make link <a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a> -->
					<p class="footer-desc"><span class="main-color"><?php bloginfo( 'name' ); ?></span> <?php bloginfo('description'); ?></p>
					<p class="footer-copy">&copy; <?php echo date("Y"); ?> <?php bloginfo('title'); ?>, LLC </p>
				</div>
				<?php if ( has_nav_menu ( 'social-media' ) ) { ?>
					<nav class="social-media-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'social-media', 'menu_class' => 'social-media-menu' ) ); ?>
					</nav>
				<?php } ?>
	
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>