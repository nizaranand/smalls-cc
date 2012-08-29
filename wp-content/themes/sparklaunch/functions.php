<?php
/**
 * @package WordPress
 * @subpackage Spark Launch
 */

// Include Options Framework - builds theme options panel 
if ( !function_exists( 'optionsframework_init' ) ) {
	define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/_functions/options/');
	define('OPTIONS_FRAMEWORK_DIRECTORY', get_bloginfo('template_directory') . '/_functions/options/');
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');
}


// Import all custom functions and plugins
$functions_path = TEMPLATEPATH . '/_functions/';
require_once ($functions_path . 'sl_writepanels.php');
require_once ($functions_path . 'sl_widget-faq.php');
require_once ($functions_path . 'sl_widget-team.php');
require_once ($functions_path . 'sl_widget-testimonial.php');


// Add support for custom menus
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu' )
			// we can add more menus here
		)
	);
}


// Add support for post thumbnails
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    add_image_size('slide', 960, 350, true);
    add_image_size('teammember', 300, 300, true);
    add_image_size('teammember_small', 60, 60, true);
}


// Add widget areas
if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
		'name' => 'Homepage',
		'before_widget' => '<div id="%1$s" class="widget group %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<div id="%1$s" class="widget group %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget group %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));

}


// Register Slides post type
add_action('init', 'slides_register');

function slides_register() {
	$args = array(
    	'label' => __('Slides'),
    	'singular_label' => __('Slide'),
    	'public' => true,
    	'show_ui' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'rewrite' => true,
    	'supports' => array('title', 'thumbnail', 'editor')
    );

	register_post_type( 'slide' , $args );
}


// Register FAQs post type
add_action('init', 'faq_register');

function faq_register() {
	$args = array(
    	'label' => __('FAQs'),
    	'singular_label' => __('FAQ'),
    	'public' => true,
    	'show_ui' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'rewrite' => true,
    	'supports' => array('title', 'thumbnail', 'editor')
    );

	register_post_type( 'faq' , $args );
}

add_action('init', 'create_faq_categories', 0);

function create_faq_categories() {
	register_taxonomy( 'faqcategory', 'faq', array( 'hierarchical' => true, 'label' => 'FAQ Category', 'query_var' => true, 'rewrite' => true ) );
}


// Register Testimonials post type
add_action('init', 'testimonial_register');

function testimonial_register() {
	$args = array(
    	'label' => __('Testimonials'),
    	'singular_label' => __('Testimonial'),
    	'public' => true,
    	'show_ui' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'rewrite' => true,
    	'supports' => array('editor', 'title')
    );

	register_post_type( 'testimonial' , $args );
}


// Register Team Members post type
add_action('init', 'team_member_register');

function team_member_register() {
	$args = array(
    	'label' => __('Team Members'),
    	'singular_label' => __('Team Member'),
    	'public' => true,
    	'show_ui' => true,
    	'capability_type' => 'post',
    	'hierarchical' => false,
    	'rewrite' => true,
    	'supports' => array('title', 'thumbnail', 'editor')
    );

	register_post_type( 'team' , $args );
}


// Custom post types icons for the menu in WordPress backend
add_action('admin_head', 'sl_icons');
function sl_icons() { ?>
    <style type="text/css" media="screen">
    	#menu-posts-slide .wp-menu-image { 
    		background: url(<?php bloginfo('template_url') ?>/_assets/img/backend/type-slide.png) no-repeat 6px -17px !important;
    	}
    	
		#menu-posts-slide:hover .wp-menu-image, #menu-posts-slide.wp-has-current-submenu .wp-menu-image { 
			background-position: 6px 7px !important; 
		}
		
		#menu-posts-faq .wp-menu-image { 
			background: url(<?php bloginfo('template_url') ?>/_assets/img/backend/type-faq.png) no-repeat 6px -17px !important;
		}
		
		#menu-posts-faq:hover .wp-menu-image, #menu-posts-slide.wp-has-current-submenu .wp-menu-image { 
			background-position: 6px 7px !important; 
		}
		
		#menu-posts-testimonial .wp-menu-image { 
			background: url(<?php bloginfo('template_url') ?>/_assets/img/backend/type-testimonial.png) no-repeat 6px -17px !important;
		}
		
		#menu-posts-testimonial:hover .wp-menu-image, #menu-posts-slide.wp-has-current-submenu .wp-menu-image { 
			background-position: 6px 7px !important; 
		}
		
		#menu-posts-team .wp-menu-image { 
			background: url(<?php bloginfo('template_url') ?>/_assets/img/backend/type-team.png) no-repeat 6px -17px !important;
		}
		
		#menu-posts-team:hover .wp-menu-image, #menu-posts-slide.wp-has-current-submenu .wp-menu-image { 
			background-position: 6px 7px !important; 
		}
    </style>
<?php }


// Register custom JS scripts
function sl_admin_scripts() {
	if (!is_admin()) {
		// Use jQuery from Google instead the one included with WP
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js');
        wp_enqueue_script( 'jquery' );
        
        wp_register_script('cycle', get_bloginfo('template_directory').'/_assets/js/jquery.cycle.all.min.js', 'jquery');
        wp_register_script('sl_scripts', get_bloginfo('template_directory').'/_assets/js/scripts.js', 'jquery');
        
        if (is_front_page()) wp_enqueue_script('cycle');   
        wp_enqueue_script('sl_scripts');
    }

}

add_action('init', 'sl_admin_scripts');

?>