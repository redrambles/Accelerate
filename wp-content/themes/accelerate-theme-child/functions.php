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


// Media - set default image link location to 'None' 
 update_option('image_default_link_type','none');

// Always Show Kitchen Sink in WYSIWYG Editor

 function reveal_kitchensink( $args ) {
 	$args['wordpress_adv_hidden'] = false;
 	return $args;
 }

 add_filter( 'tiny_mce_before_init', 'reveal_kitchensink' );

 //add_filter( 'wp_title', 'red_wp_title_for_home' );
  
 /**
  * Customize the title for the home page, if one is not set.
  *
  * @param string $title The original title.
  * @return string The title to use.
  */
 // function red_wp_title_for_home( $title )
 // {
 //   if ( empty( $title ) && ( is_home() || is_front_page() ) ) {
 //     $title = __( 'Home', 'textdomain' ) . ' | ' . get_bloginfo( 'description' );
 //   }
 //   return $title;
 // }

 // Register homepage sidebar area 
function accelerate_theme_child_widget_init() {
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

// Ann testing theme support stuff
function accelerate_theme_support() {
  // post formats
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	
  // title
  add_theme_support( 'title-tag');
  
  // post thumbnails and images
  add_theme_support('post-thumbnails');
  add_image_size('archive-case-studies', 514, 379, array( 'left', 'top' ) ); 
  add_image_size('front-page-featured-work', 300, 200, true);
  add_image_size('front-page-faq-slider', 300, 150, true);
  
	}
add_action( 'after_setup_theme', 'accelerate_theme_support' );

add_filter( 'document_title_separator', 'accelerate_title_separator' );
function accelerate_title_separator( $sep ) {

    $sep = " | ";
	
    return $sep;
}

add_filter( 'pre_get_document_title', 'case_studies_custom_title', 10 );
/* Create a title tag for the case studies archive that says 'WORK' */
function case_studies_custom_title($title) {

	if ( is_post_type_archive( 'case_studies' ) ) {
		$work_title = "WORK";
		$site_title = get_bloginfo('name');
		$sep = " | ";
		$title = $work_title . $sep . $site_title;
		return $title;  
	}
}


// Testing the addition of excerpts for pages
function accelerate_add_excerpt_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'accelerate_add_excerpt_for_pages' );


// Reverse Case Studies Archive order
function reverse_archive_order( $query ){

	if( !is_admin() && $query->is_post_type_archive('case_studies')  && $query->is_main_query() ) {
		$query->set('order', 'ASC');
	}
}

add_action( 'pre_get_posts', 'reverse_archive_order' );

// Custom Post Type Function
function accelerate_create_custom_post_types() {

	register_post_type('case_studies',
		array(
			// 'supports' => $supports,
			'labels' => array(
				'name' => __( 'Case Studies' ),
				'singular_name' => __( 'Case Study' ),
				'add_new_item'  => __( 'Add New Case Study'),
				'new_item'      => __( 'New Case Study' ),
				'search_items'  => __( 'Search Case Studies')
				),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'case-studies'
				),
      'supports' => array('title', 'editor', 'page-attributes') // So it's possible to sort by menu order
			)
	 );
	// Testing a CPT approach for the About page
	register_post_type('services',
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'Service' )
				),
			'public' => true,
			'has_archive' => false,
      'supports' => array('title', 'editor', 'page-attributes') // So it's possible to sort by menu order
			)
	 );

	// FAQ section
	register_post_type('faq',
		array(
			// 'supports' => $supports,
			'labels' => array(
				'name' => __( 'FAQ' ),
				'singular_name' => __( 'FAQ' )
				),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'faqs'
				),
			'supports' => array('title', 'editor', 'thumbnail')
			)
	 );

	 // private documentation post type
	 $labels = array(
		'name' => __( 'Documentation' ),
		'singular_name' => __( 'Doc' )
		);
	 $args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capabilities' => array(
			'publish_posts' => 'administrator',
			'edit_posts' => 'administrator',
			'edit_others_posts' => 'administrator',
			'delete_posts' => 'administrator',
			'delete_others_posts' => 'administrator',
			'read_private_posts' => 'administrator',
			'edit_post' => 'administrator',
			'delete_post' => 'administrator',
			'read_post' => 'administrator',
		),
		'hierarchical' => false,
		'menu_position' => null,
		'has_archive' => true,
			'rewrite' => array(
				'slug' => 'documentation'
				),
		'supports' => array('title','editor','thumbnail')
	); 
	register_post_type('documentation', $args);

}
// Hook this custom post type function into the theme
add_action( 'init', 'accelerate_create_custom_post_types' );

add_action( 'init', 'faq_taxonomy');
function faq_taxonomy() {
    register_taxonomy( 'faq_genre', 'faq', 
	array( 
		'labels' => array(
			'name'	=> 'Genre',
		),
		'hierarchical' => true,  
		'sort' => true,
		'args' => array('orderby' => 'term_order'),
		'show_admin_column' => true
		)
	);
}


//Enqueue scripts and styles.
function accelerate_child_scripts() {
	wp_enqueue_style( 'parent-theme-css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-theme-css' ));
	// The above would not be necessary if the parent theme were using functions.php to enqueue its style.css file. (It is in the header) This won't be an issue for anyone using @import in the child theme style.css.
	wp_enqueue_style('accelerate-child-google-fonts', '//fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:300italic,400italic,600italic,400,600,700,300');
	wp_enqueue_style('accelerate-child-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

	//Scripts
	wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array('jquery'), '20160105', false );
	if ( is_404() ) {
		wp_enqueue_script('404', get_stylesheet_directory_uri() . '/js/test-404.js', array('jquery'), '20160603', false );
	}

	// Slick Slider
	wp_enqueue_script( 'slick-js', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array('jquery'), '1.3.1' );
	wp_enqueue_script( 'slick-activate', trailingslashit( get_stylesheet_directory_uri() ) . 'js/slidorama.js', 'jquery', '20160121', true );
	wp_enqueue_style( 'slick-css', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css', '', '1.6.0' );
	wp_enqueue_style( 'slick-theme-css', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css', array( 'slick-css' ), '1.6.0' );

}
add_action( 'wp_enqueue_scripts', 'accelerate_child_scripts' );

// Testing a function to pull in 3 latest blog posts
function red_get_me_some_posts() {
			global $post;

			$args = array( 'posts_per_page' => 3 );
			$lastposts = get_posts( $args );
			foreach ( $lastposts as $post ) :
		   	setup_postdata( $post );

			echo '<h2><a href="'. get_permalink() .'">'. get_the_title() .'</a></h2>'; 
			the_excerpt();

		endforeach;
		wp_reset_postdata();
}

// Remove 'Accelerate' in the description - call in footer.php ONLY
function green_accelerate_footer(){
	
	add_filter( 'option_blogdescription', 'accelerate_change_description_footer', 10, 2 );
	function accelerate_change_description_footer( $description ) {
			$description = str_replace('Accelerate', '', $description);
			return $description;
	} 

};
add_action('modified_footer', 'green_accelerate_footer');
	
// Refresh those permalinks message on main Dashboard page only
// add_action( 'current_screen', 'message_dashboard_screen' );
// function message_dashboard_screen() {
// 
//     $current_screen = get_current_screen();
//     if( $current_screen ->id === "dashboard" ) {
// 
// 			add_action('admin_notices', 'admin_notice_refresh_permalinks' );
// 			function admin_notice_refresh_permalinks() {
// 			  echo '<div class="error">
// 			          <p>Do not forget to refresh those permalinks! :)</p>
// 			        </div>';
// 				}
//     }
// }


// Add a body class for about page so that the padding on '.site-main won't mess up the hero-image at @media max-width 1000px
add_filter( 'body_class','accelerate_body_classes' );
function accelerate_body_classes( $classes ) {
 
  if ( is_page( 'about' ) ) {
    $classes[] = 'about-page';
  }
  if ( is_page( 'about-flexible' ) ) {
    $classes[] = 'about-flexible';
  }
  if (is_page('success') ) {
    $classes[] = 'success-form-message';
  }
    
    return $classes;
     
}


// Warning Logged-in Users About Website Maintenance (using 'error' class) or Success message (using 'updated' class)
// add_action( 'admin_notices', 'admin_message' );

// function admin_message() {
//     echo '<div class="error">
//             <p>Do not change themes or everything will go to hell and you will cry bitter, bitter tears. Thank you.</p>
//           </div>';
// }

// Change Accelerate using a filter for about page
add_filter( 'the_content', 'about_Accelerate_green' );
function about_Accelerate_green( $content ) {
	    if ( is_page('about') ) {
        	$content = str_replace('Accelerate', '<span class="main-color">Accelerate</span>', $content);
    	}
   	return $content;
}

// Provide a quick link for your clients to reach you in the admin toolbar
add_action( 'wp_before_admin_bar_render', 'your_awesome_admin_contact_info_of_wow' );

function your_awesome_admin_contact_info_of_wow() {
    global $wp_admin_bar;

    $wp_admin_bar->add_node( array(
        'id'    => 'contact-developer',
        'title' => 'Contact Developer',
        'href'  => 'http://redrambles.com/#call-to-action',
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

// Test in order to see if we can run raw JS from inside a posts
add_filter( 'the_content', 'accelerate_no_wpautop_front_page', 9 );

function accelerate_no_wpautop_front_page( $content ) {

    if ( is_single('test-post') ) {
        remove_filter( 'the_content', 'wpautop' );
        //$content = str_replace('mandolin', '<span class="blue">spicy dogs</span>', $content);
        return $content;
    } else {
        return $content;
    }
}
  
// In lieu of a 'maintenance mode plugin' - if in a hurry - will shut down the site to everyone but admins

// add_action( 'get_header', 'emergency_repair' );
// 
// function emergency_repair() {
// 
//     if ( ! current_user_can( 'activate_plugins' ) ) {
//         wp_die( '<h3>Emergency repair underway. The website will be back soon.</h3></br>
//         	<p>In the meantime, how about <a href="http://explosm.net/">something funny</a>?</p>' );
//     }
// 
// }

// Use ACF Pro to Generate an Options page

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' => 'Options',
		'menu_title' => 'Options',
		'menu_slug' => 'accelerate-theme-child-options',
		'capability' => 'edit_posts',
		'redirect' => false
	));
  
  acf_add_options_sub_page(array(
    'page_title' => 'Social Media Profiles',
    'menu_title' => 'Social Media',
    'parent_slug'	=> 'accelerate-theme-child-options',
  ));
	
	acf_add_options_sub_page(array(
	'page_title' 	=> 'Maintenance',
	'menu_title'	=> 'Maintenance',
	'parent_slug'	=> 'accelerate-theme-child-options',
));

acf_add_options_sub_page(array(
	'page_title' 	=> 'Help',
	'menu_title'	=> 'Help',
	'parent_slug'	=> 'options-general.php',
));

}
/// Security measures
// Remove WP version from the source code

// remove version from head
remove_action('wp_head', 'wp_generator');

// remove version from rss
add_filter('the_generator', '__return_empty_string');

// Remove WP Version From Styles	
add_filter( 'style_loader_src', 'red_remove_ver_css_js', 9999 );
// Remove WP Version From Scripts
add_filter( 'script_loader_src', 'red_remove_ver_css_js', 9999 );

// Function to remove version numbers 
function red_remove_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
  }
	return $src;
}
/// end security measures

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



// remove_filter('get_the_excerpt', 'wp_trim_excerpt'); 
// add_filter('get_the_excerpt', 'accelerate_link_excerpt');
 
// function accelerate_link_excerpt($text = '') { // Fakes an excerpt if needed
//     global $post;
// 	$raw_excerpt = $text;
//     if ( '' == $text ) {
//         $text = get_the_content('');
//         $text = apply_filters('the_content', $text);
//         $text = str_replace('\]\]\>', ']]&gt;', $text);
//         $text = strip_tags($text,'<a>'); // list of tags to allow
//         $excerpt_length = 55; 
//         $words = explode(' ', $text, $excerpt_length + 1);
//         if (count($words)> $excerpt_length) {
//             array_pop($words);
//             array_push($words, '. . .<p><a href="' . get_permalink($post->ID) . '">Read More &raquo;</a></p>');
//             $text = implode(' ', $words);
//         }
//     }
//     return $text;
// }

// function accelerate_child_excerpt_more( $more ) {
// 	if ( is_home() ) {
// 	return ' <a class="read-more-link" href="'. get_permalink() . '">' . __('Read More', 'accelerate-theme-child') . '</a>';
// 	}
// }
// add_filter( 'excerpt_more', 'accelerate_child_excerpt_more', 100 );

/**
 * Custom template tags for this theme.
 *
 * @since Accelerate Theme Child 1.0
 */
require get_stylesheet_directory() . '/inc/extras.php';
include get_stylesheet_directory() . '/inc/customizer.php';
