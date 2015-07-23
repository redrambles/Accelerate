<?php
/**
 * Accelerate Marketing Child functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Accelerate Marketing
 * @since Accelerate Marketing 1.0
 */


 //Register Main Sidebar widget area - AND homepage sidebar area (Added the main to override hard-coded stuff in sidebar.php)

function accelerate_theme_child_widget_init() {
	// Register main sidebar - blog (optional) - also called the widget area (defensively) in sidebar.php
		register_sidebar( array(
		'name'          => __( 'Main sidebar', 'accelerate-theme-child' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your main sidebar.', 'accelerate-theme-child' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Register second sidebar - will create a new dynamic widget area in the admin
	register_sidebar( array(
	    'name' =>__( 'Homepage sidebar', 'accelerate-theme-child'),
	    'id' => 'sidebar-2',
	    'description' => __( 'Appears on the static front page template', 'accelerate-theme-child' ),
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title">',
	    'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'accelerate_theme_child_widget_init' );


// Add Theme Support - Post Format and Featured Images
add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
//add_theme_support( 'post-thumbnails', array( 'test_posts' ) );

// Custom Post Type Function
function create_custom_post_types() {
	register_post_type('case_studies', 
		array( 
			// 'supports' => $supports,
			'labels' => array(
				'name' => _( 'Case Studies' ),
				'singular_name' => _( 'Case Study' )
				),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'case-studies'
				),
			)
	 );
}
// Hook this custom post type function into the theme
add_action( 'init', 'create_custom_post_types' );

//Enqueue scripts and styles.
function accelerate_child_scripts() {
	wp_enqueue_style('accelerate-child-google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,600,700,300');
	wp_enqueue_style('accelerate-child-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'accelerate_child_scripts' );

// Display an actual title in the <title> tags in the source code - source: TT Actions & Filters class - local: wp_hooks
function custom_wp_title( $title, $sep ) {
     global $page;

     // Add the site name.
     $title .= get_bloginfo( 'name' );

     // Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

     return $title;
}
add_filter( 'wp_title', 'custom_wp_title', 20, 2 );


// Testing a function to pop in somewhere randomly (in page.php) - July 2015
function red_get_me_some_posts() {
			global $post;
			
			$args = array( 'posts_per_page' => 3 );
			$lastposts = get_posts( $args );
			foreach ( $lastposts as $post ) :
		   	setup_postdata( $post ); ?>

			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt();

		endforeach; 
		wp_reset_postdata(); 
}

// Displaying a Quick Performance Report for Admins in the source code

// add_action( 'wp_footer', 'wp_footer_example' );
 
// function wp_footer_example() {
//     $stat = sprintf( '%d queries in %.3f seconds, using %.2fMB memory',
//         get_num_queries(),
//         timer_stop( 0, 3 ),
//         memory_get_peak_usage() / 1024 / 1024
//     );
//     if( current_user_can( 'manage_options' ) ) {
//         echo "<!-- {$stat} -->";
//     }
// }
 
// Example Source: http://wordpress.stackexchange.com/a/1866


// Warning Logged-in Users About Website Maintenance (using 'error' class) or Success message (using 'updated' class)
// add_action( 'admin_notices', 'admin_message' );
 
// function admin_message() {  
//     echo '<div class="error">
//             <p>Do not change themes or everything will go to hell and you will cry bitter, bitter tears. Thank you.</p>
//           </div>';
// }
 
// Example Source: http://wpsnippy.com/show-notification-message-wordpress-admin-pages/


// Provide a quick link for your clients to reach you in the admin toolbar
add_action( 'wp_before_admin_bar_render', 'wp_before_admin_bar_render_example' ); 
 
function wp_before_admin_bar_render_example() {
    global $wp_admin_bar;
    $wp_admin_bar->add_node( array(
        'id'    => 'contact-developer',
        'title' => 'Contact Developer',
        'href'  => 'http://redrambles.com/contact/',
        'meta'  => array( 'target' => '_blank' )
    ) );
}

// Color separate posts of different statuses in the Dashboard
add_action( 'admin_footer', 'color_my_world' );

function color_my_world() {
 
    echo '<style type="text/css">
    .status-draft, .striped>tbody>:nth-child(odd).status-draft   { background-color: #FCE3F2; }
    .status-pending, .striped>tbody>:nth-child(odd).status-pending { background-color: #87C5D6; }
    .status-future, .striped>tbody>:nth-child(odd).status-future  { background-color: #C6EBF5; }
    .status-private, .striped>tbody>:nth-child(odd).status-private { background-color: #F2D46F; }
    </style>';
     
}

// // customize admin footer text
// add_filter('admin_footer_text', 'accelerate_footer');

// function accelerate_footer($footer_text) {
// 	$footer_text = '<span class="custom-footer">' . __('&copy; ', 'accelerate-theme-child') . date('Y') . ' <a href="' . home_url() .
// 	'">' . get_bloginfo('name') . '</a> &bull; Accelerate Child Theme</span>';
// 	echo $footer_text;
// }

// // Add post meta - format: add_post_meta($post_id, $meta_key, $meta_value, $unique);
// add_post_meta(47372, 'mood', 'adventurous', true);
// add_post_meta(47333, 'sanity', 'good', true);

// In lieu of a 'maintenance mode plugin' - if in a hurry - will shut down the site to everyone but admins

// add_action( 'get_header', 'emergency_repair' );
 
// function emergency_repair() {
 
//     if ( ! current_user_can( 'activate_plugins' ) ) {
//         wp_die( '<h3>Emergency repair underway. The website will be back soon.</h3></br>
//         	<p>In the meantime, how about <a href="http://explosm.net/">something funny</a>?</p>' );
//     }
     
// }

// shortcode for user access content. Format = [user_access cap="read" deny="Log in to view content"] text [/user_access]
// function user_access($attr, $content = null) {
// 	extract(shortcode_atts(array(
// 		'cap' => 'read',
// 		'deny' => '',
// 	), $attr));

// 	if (current_user_can($cap) && !is_null($content) &&
// 	!is_feed()) return $content;

// 	return apply_filters('diy_user_access_filter', $deny); // This hook will permit us to filter the deny message if we need to in the future
// }
// add_shortcode('user_access', 'user_access');

// Callback function - to change deny message - in case you put the shortcode all over the place and you want to change it in one place:
// function diy_modify_user_access($deny) {
// 	$deny = 'Skinnemarinky dinky dink, skinermarinky doooo';
// 	return '<h5>'. $deny .'</h5>';
// }
// add_filter('diy_user_access_filter', 'diy_modify_user_access');
 

?>