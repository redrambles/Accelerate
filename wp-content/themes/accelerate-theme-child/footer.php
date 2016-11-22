<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */
?>

		</div><!-- #main -->
		
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">

				<div class="site-description">
					 <!-- <a href="<?php //echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php //bloginfo( 'name' ); ?></a> -->
					<?php if (!empty(get_theme_mod('accelerate_footer_message'))){ 
								do_action('accelerate_footer_customizer'); 
					  } else {
								do_action('modified_footer'); ?>
						<p class="footer-desc"><span class="main-color"><?php bloginfo( 'name' ); ?></span> <?php bloginfo('description'); ?></p>
					<?php } ?>
					<p class="footer-copy">&copy; <?php echo date("Y"); ?> <?php bloginfo('title'); ?>, LLC </p>
				</div>
				<?php if ( has_nav_menu ( 'social-media' ) ) { ?>
					<nav class="social-media-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'social-media', 'menu_class' => 'social-media-menu', //'link_before'     => '<span class="screen-reader-text">',
						//'link_after'      => '</span>', 
					) ); ?>
					</nav>
				<?php } ?>
	
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page --> 

	<?php wp_footer(); ?>
</body>
</html>