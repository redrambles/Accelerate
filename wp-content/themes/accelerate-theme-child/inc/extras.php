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
		<span class="entry-terms author">Written by <?php the_author_posts_link(); ?></span>
		<span class="entry-terms category">Posted in <?php the_category(', '); ?></span>
		<?php $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'accelerate-theme-child' ) );
		if ( $tags_list ) { ?>
		<span class="entry-terms">
			<?php	printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
					_x( 'Tagged ', 'Used before tag names.', 'accelerate-theme-child' ),
					$tags_list
				);
			} ?></span>
		<span class="entry-terms comments"><?php comments_number( 'No comments yet!', '1 comment', '% comments' ); ?></span>
  </footer>
<?php }  

// Maintenance Page Function
function launch_maintenance_page() {
	
	// Make sure ACF is active and we have something to show
	if ( !function_exists('get_field')) {
		return false;
	}  
	
	// ACF is active!
	// Verify that the check box to launch the maintenance page is indeed checked!
	$activate = get_field('activate', 'option');

	if ( !$activate ) { 
		return false;
	}
	// The client has activated the maintenance page. Let's do this!

	add_filter( 'template_include', 'accelerate_maintenance_template', 99 ); 
	 
	function accelerate_maintenance_template( $template ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			$new_template = locate_template( array( 'template_files/accelerate-maintenance.php' ) );
	  
			if ( '' != $new_template ) {      
	        add_filter( 'body_class','maintenance_body_class' );
	        function maintenance_body_class( $classes ) {
	            $classes[] = 'custom-maintenance';  
	            return $classes;
	          } 
	      }      
			return $new_template ;
		}
		return $template;
	}
	
	// Remind Admins that the maintenance page is active!
	add_action( 'current_screen', 'maintenance_page_active_reminder' );
	function maintenance_page_active_reminder() {

	    $current_screen = get_current_screen();
	    if( $current_screen ->id === "dashboard" ) {

				add_action('admin_notices', 'maintenance_page_active_notice' );
				function maintenance_page_active_notice() {
				  echo '<div class="error">
				          <p>The Maintenance Page is Active!!!</p>
				        </div>';
				}
	    }
		}	
}

launch_maintenance_page();

// Hook into Simple Twitter Tweets widget on Front page and dynamically add handle after title-tag
function add_twitter_handle( $title ) {
		// Fetch handle that is stored in options table but not output by STT widget
    	$stt_options = get_option( 'widget_pi_simpletwittertweets' );
			$twitter_handle = $stt_options[2]['name'];
			if ( !is_front_page() ) {
				return $title;
			}
    	return $title .= '<div class="twitterhandle">@'. $twitter_handle . '</div>';
		}
add_filter('widget_title', 'add_twitter_handle'); 

// Fetch a random sidebar id value for currently active widget areas
function red_random_sidebar() {
	// Fetch info about existing widget areas
	$sidebars = $GLOBALS['wp_registered_sidebars'];

	//Fetch ids of currently active widget areas
	$active_sidebar_ids = [];
	foreach($sidebars as $sidebar) {
		$sidebar_id = $sidebar["id"];
		if (is_active_sidebar($sidebar_id )){
			array_push ($active_sidebar_ids, $sidebar_id);
		}
	} 
	// Give me a random active sidebar
	$random_sidebar_index = array_rand($active_sidebar_ids);
	return ($active_sidebar_ids[$random_sidebar_index]);
}

add_action('dynamic_sidebar', 'red_random_sidebar');
