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
			<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
				<div class="maintenance-widget" role="complementary">
					<?php dynamic_sidebar( 'sidebar-3' ); ?></a>
				</div>
			<?php endif; ?>
		</div>
  </div>
</div>

<?php get_footer(); ?>
