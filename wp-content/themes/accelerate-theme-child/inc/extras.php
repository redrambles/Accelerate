<?php
/**
 * Custom template tags for Accelerate
 *
 * @package WordPress
 * @subpackage Accelerate
 * @since Accelerate 1.0
 */

function accelerate_theme_child_comment_nav() {
	// Do we have lots of comments? LIKE A TON OF COMMENTS?!?!
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'accelerate-theme-child' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'accelerate-theme-child' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'accelerate-theme-child' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}

function accelerate_theme_child_footer_meta() { ?>
  <footer class="entry-footer">
      <span class="entry-terms comments author">
        Written by <?php the_author_posts_link(); ?>
        /
        Posted in <?php the_category(', ') ?>
        /
        <?php echo get_comments_number() ?> comments
      </span>
  </footer>
<?php } ?>