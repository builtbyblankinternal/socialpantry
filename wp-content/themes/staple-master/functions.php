<?php
/**
 * Twenty Sixteen functions and definitions
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
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
define( 'NO_HEADER_TEXT', true );
/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1920, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'footer-menu' => __( 'Footer Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Instagram', 'twentysixteen' ),
		'id'            => 'instagram-widget',
		'description'   => __( 'Add widgets here to appear in your Instagram section.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Raleway:400,300,300italic,400italic,500italic,500,600,600italic,700,700italic,800,800italic,900,900italic';
	}
	
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
	
	wp_enqueue_style( 'style.scss', get_template_directory_uri() . '/style.scss' );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style',get_template_directory_uri() . '/style.css?v='.time(), array(), false, 'all');

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

// Our custom post type function
function create_postslider() {

	register_post_type( 'slider-post',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Slider' ),
				'singular_name' => __( 'Slider' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'slider-post'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_postslider' );

function custom_post_type_slider() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Slider', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Slider', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Slider', 'twentysixteen' ),
		'all_items'           => __( 'All Slider', 'twentysixteen' ),
		'view_item'           => __( 'View Slider', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New Slider', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit Slider', 'twentysixteen' ),
		'update_item'         => __( 'Update Slider', 'twentysixteen' ),
		'search_items'        => __( 'Search Slider', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'slider', 'twentysixteen' ),
		'description'         => __( 'Slider news and reviews', 'twentysixteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'slider-post', $args );

}
add_action( 'init', 'custom_post_type_slider', 0 );


// Our custom post type function
function create_posttype() {

	register_post_type( 'portfolio-post',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Portfolio' ),
				'singular_name' => __( 'Portfolio' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio-post'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function custom_post_type_portfolio() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Portfolio', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'Portfolio', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Portfolio', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Portfolio', 'twentysixteen' ),
		'all_items'           => __( 'All Portfolio', 'twentysixteen' ),
		'view_item'           => __( 'View Portfolio', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New Portfolio', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit Portfolio', 'twentysixteen' ),
		'update_item'         => __( 'Update Portfolio', 'twentysixteen' ),
		'search_items'        => __( 'Search Portfolio', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'portfolio', 'twentysixteen' ),
		'description'         => __( 'Portfolio news and reviews', 'twentysixteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'portfolio-post', $args );
$_labels = array(
		'name'              => _x( 'Portfolio Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Portfolio Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Portfolio Categories' ),
		'all_items'         => __( 'All Portfolio Categories' ),
		'parent_item'       => __( 'Parent Portfolio Category' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:' ),
		'edit_item'         => __( 'Edit Portfolio Category' ), 
		'update_item'       => __( 'Update Portfolio Category' ),
		'add_new_item'      => __( 'Add New Portfolio Category' ),
		'new_item_name'     => __( 'New Portfolio Category' ),
		'menu_name'         => __( 'Portfolio Categories' ),
	  );
	  $_args = array(
		'labels' => $_labels,
		'hierarchical' => true,
	  );
	  register_taxonomy( 'portfolio_cat', 'portfolio-post', $_args );
}
add_action( 'init', 'custom_post_type_portfolio', 0 );
// Our custom post type function
function create_postservices() {

	register_post_type( 'services-post',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'Services' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'services-post'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_postservices' );

function custom_post_type_services() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Services', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'Services', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Services', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Services', 'twentysixteen' ),
		'all_items'           => __( 'All Services', 'twentysixteen' ),
		'view_item'           => __( 'View Services', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New Services', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit Services', 'twentysixteen' ),
		'update_item'         => __( 'Update Services', 'twentysixteen' ),
		'search_items'        => __( 'Search Services', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'services', 'twentysixteen' ),
		'description'         => __( 'Services news and reviews', 'twentysixteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'comments'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'services-post', $args );

}
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type_services', 0 );


// Our custom post type function
function create_postpress() {

	register_post_type( 'press-post',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Press' ),
				'singular_name' => __( 'Press' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'press-post'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_postpress' );

function custom_post_type_press() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Press', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'Press', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Press', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Press', 'twentysixteen' ),
		'all_items'           => __( 'All Press', 'twentysixteen' ),
		'view_item'           => __( 'View Press', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New Press', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit Press', 'twentysixteen' ),
		'update_item'         => __( 'Update Press', 'twentysixteen' ),
		'search_items'        => __( 'Search Press', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'press', 'twentysixteen' ),
		'description'         => __( 'Press news and reviews', 'twentysixteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'comments'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'press-post', $args );

}
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type_press', 0 );

/***
Functions for Comment form temaplate
**/

function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields', 'remove_comment_fields');

function wpsites_change_comment_form_submit_label($arg) {
$arg['label_submit'] = 'Submit';
     return $arg;
}
add_filter('comment_form_defaults', 'wpsites_change_comment_form_submit_label');




function postlike() {
	
	//Load more function
	wp_localize_script( 'twentysixteen-script', 'ajax_posts', array(
			'ajaxurl' =>  admin_url( 'admin-ajax.php' ),
			'noposts' => __('No older posts found', 'twentysixteen'),
	));
	if( !is_admin() ){

		wp_register_script( 'myfun_haha', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', array(), date('ymdhis') );
		wp_enqueue_script( 'myfun_haha' );	
		wp_register_script( 'myfun_slick', get_template_directory_uri().'/js/slick.min.js', array(), date('ymdhis') );
		wp_enqueue_script( 'myfun_slick' );
		wp_register_script( 'myfun_bs', get_template_directory_uri().'/js/bootstrap.min.js', array(), date('ymdhis') );
		wp_enqueue_script( 'myfun_bs' );
		
		wp_enqueue_style( 'twentysixteen-slick', get_template_directory_uri() . '/css/slick.css', array(), date('ymdhis') );
		wp_enqueue_style( 'twentysixteen-slicktheme', get_template_directory_uri() . '/css/slick-theme.css', array(), date('ymdhis') );
		wp_enqueue_style( 'twentysixteen-bs', get_template_directory_uri() . '/css/bootstrap.css', array(), date('ymdhis') );
	}

	wp_enqueue_style( 'twentysixteen-c-admin', get_template_directory_uri() . '/css/admin.css', array(), date('ymdhis') );
	
	global $pagenow;
	//die($pagenow);
	if( $pagenow == 'themes.php' || !is_admin() ){
		wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_register_script( 'myfun_js', get_template_directory_uri().'/js/ajax_function.js', array(), date('ymdhis') );
		// Localize the script with new data
		$translation_array = array(
	 		'ajaxurl' =>  admin_url( 'admin-ajax.php' ),
			 'a_value' => '10'
			);
		wp_localize_script( 'myfun_js', 'ajax_posts', $translation_array );
		// Enqueued script with localized data.
		wp_enqueue_script( 'myfun_js' );
	}
}
	
add_action('wp_enqueue_scripts','postlike'); 
add_action('admin_enqueue_scripts','postlike'); 

add_filter( 'comment_form_default_fields', 'wpse_62742_comment_placeholders' );

/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param  array $fields 
 * @return array
 */
function wpse_62742_comment_placeholders( $fields )
{

	$fields['email'] = str_replace(
        '<input id="email" name="email" type="email"',
        /* We use a proper type attribute to make use of the browser's
         * validation, and to get the matching keyboard on smartphones.
         */
        '<input type="email" placeholder="Email"  id="email" name="email"',
        $fields['email']
    );
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'
        /* Replace 'theme_text_domain' with your theme's text domain.
         * I use _x() here to make your translators life easier. :)
         * See http://codex.wordpress.org/Function_Reference/_x
         */
            . _x(
                'Name',
                'comment form placeholder',
                'theme_text_domain'
                )
            . '"',
        $fields['author']
    );
    
    return $fields;
}

/* Add Placehoder in comment Form Field (Comment) */
add_filter( 'comment_form_defaults', 'help4cms_textarea_placeholder' );

 function help4cms_textarea_placeholder( $fields )
 {
  
         $fields['comment_field'] = str_replace(
            '<textarea',
             '<textarea placeholder="Comment"',
             $fields['comment_field']
         );
   
 
     return $fields;
 }
//Google Font called
include( get_template_directory() . '/gwf-options.php');

include( get_template_directory() . '/theme-options.php');


function custom_social_links() {	
	ob_start(); ?> 
    <!--<h4>SHARE THIS POST</h4>--> 
	<ul class="list-inline">
		<li><a class="genericon genericon-facebook-alt" onClick='window.open("http://www.facebook.com/share.php?u=<?php the_permalink() ?>&title=share-on-page","Ratting","width=550,height=550,0,status=0,");' href="javascript:void(0);"></a></li>
		<li><a class="genericon genericon-twitter" onClick='window.open("http://twitter.com/intent/tweet?status=share-on-page+<?php the_permalink() ?>","Ratting","width=550,height=550,0,status=0,");' href="javascript:void(0);"></a></li>
		<li><a class="genericon genericon-instagram" onClick='window.open("https://www.instagram.com/?status=share-on-page+<?php the_permalink() ?>","Ratting","width=547,height=551,0,status=0,");' href="javascript:void(0);"></a></li>
	</ul>
    
	<?php return ob_get_clean();
}
add_shortcode('custom_social_links', 'custom_social_links');


add_image_size( '1920x1080', 1920, 1080, true );
add_image_size( '550x700', 550, 700, true );
add_image_size( '360x440', 360, 440, true );
add_image_size( '360x340', 360, 340, true );
add_image_size( '400x520', 400, 520, true );
add_image_size( '300x300', 300, 300, true );
/*add_action( 'after_setup_theme','remove_twentyeleven_options', 100 );*/

function binary_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
if ( !$crop ) return null; // let the WordPress default function handle this
 
$aspect_ratio = $orig_w / $orig_h;
$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
 
$crop_w = round($new_w / $size_ratio);
$crop_h = round($new_h / $size_ratio);
 
$s_x = floor( ($orig_w - $crop_w) / 2 );
$s_y = floor( ($orig_h - $crop_h) / 2 );
 
return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'binary_thumbnail_upscale', 10, 6 );
/*function remove_twentyeleven_options() {

	remove_custom_background();

}*/
function my_admin_scripts() {    
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
	 wp_enqueue_style('thickbox');
    
}

function my_admin_styles() {

    wp_enqueue_style('thickbox');
}

// better use get_current_screen(); or the global $current_screen
if (isset($_GET['page']) && $_GET['page'] == 'my_plugin_page') {

    add_action('admin_print_scripts', 'my_admin_scripts');
    add_action('admin_print_styles', 'my_admin_styles');
}
add_action( 'init', 'my_add_excerpts_to_pages' );
 function my_add_excerpts_to_pages() {
      add_post_type_support( 'page', 'excerpt' );

 }

//get image id 
function rnd_get_image_id($image_url) {
  global $wpdb;
  $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}

//excerpt length 
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
function admin_init_fun(){
  add_meta_box("gallery_images_field1", "Blog Images", "gallery_images_blog", "post", "normal", "high");
  add_meta_box("gallery_images_field2", "Press Images", "gallery_images_press", "press-post", "normal", "high");
}

//  Custom Field 
add_action("admin_init", "admin_init_fun");
// Add fields to gallery_images_blog
function gallery_images_blog(){
  global $post;
  $imgs_meta = get_post_meta( $post->ID, 'gallery_images_blog', true );
  	echo '<div class="input_fields_wrap"><label>Gallery Images:</label><button class="add_field_button">Add More Fields</button>';
  	if($imgs_meta == ""){
  		echo '<div><input class="upload" id="upload_one" type="text" size="36" name="gallery_images_blog[]" value="" />
			<input id="upload_image_button_" type="button" value="Upload Image" class="upload-button" /></div>';
		}else{
			foreach ( $imgs_meta as $src ){
				echo '<div><input class="upload" id="upload_one" type="text" size="36" name="gallery_images_blog[]" value="'.esc_url( $src ) .'" />
					<input id="upload_image_button_" type="button" value="Upload Image" class="upload-button" /></div>';
		 	}
		}
  echo '</div>'; ?>
	<script type="text/javascript">
    jQuery(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = jQuery(".input_fields_wrap"); //Fields wrapper
        var add_button      = jQuery(".add_field_button"); //Add button ID
       
        var x = 1; //initlal text box count
        jQuery(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                jQuery(wrapper).append('<div><input class="upload" id="upload_one" type="text" size="36" name="gallery_images_blog[]" value="" /><input id="upload_image_button_" type="button" value="Upload Image" class="upload-button" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
            }
        });
       
        jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); jQuery(this).parent('div').remove(); x--;
        });
        jQuery(document.body).on('click', '.upload-button' ,function(){
        //jQuery('.upload-button').on('click',function(e) {
    		//e.preventDefault();
            uploadID = jQuery(this).prev('input');  
            formfield = jQuery('.upload').attr('name');
            tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
            window.send_to_editor = function(html) {
            
                var regex = /src="(.+?)"/;
                var rslt =html.match(regex);
                var imgurl = rslt[1];
               //var imgurl = jQuery('img',html).attr('src');
               uploadID.val(imgurl);
                //jQuery('#testimonial_bg_img_url').val(imgurl);
                tb_remove();
            
            }
            return false;
        });
    });
</script>

<?php }
 add_action('save_post', 'save_gallery_images_blog');
function save_gallery_images_blog(){
  global $post;
  update_post_meta($post->ID, "gallery_images_blog", $_POST["gallery_images_blog"]);
  //delete_post_meta($post->ID, "gallery_images_about");
}

// Add fields to gallery_images_press
function gallery_images_press(){
  global $post;
  $imgs_meta = get_post_meta( $post->ID, 'gallery_images_press', true );
  	echo '<div class="input_fields_wrap"><label>Gallery Images:</label><button class="add_field_button">Add More Fields</button>';
  	if($imgs_meta == ""){
  		echo '<div><input class="upload" id="upload_one" type="text" size="36" name="gallery_images_press[]" value="" />
			<input id="upload_image_button_" type="button" value="Upload Image" class="upload-button" /></div>';
		}else{
			foreach ( $imgs_meta as $src ){
				echo '<div><input class="upload" id="upload_one" type="text" size="36" name="gallery_images_press[]" value="'.esc_url( $src ) .'" />
					<input id="upload_image_button_" type="button" value="Upload Image" class="upload-button" /></div>';
		 	}
		}
  echo '</div>'; ?>
	<script type="text/javascript">
    jQuery(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = jQuery(".input_fields_wrap"); //Fields wrapper
        var add_button      = jQuery(".add_field_button"); //Add button ID
       
        var x = 1; //initlal text box count
        jQuery(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                jQuery(wrapper).append('<div><input class="upload" id="upload_one" type="text" size="36" name="gallery_images_press[]" value="" /><input id="upload_image_button_" type="button" value="Upload Image" class="upload-button" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
            }
        });
       
        jQuery(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); jQuery(this).parent('div').remove(); x--;
        });
        jQuery(document.body).on('click', '.upload-button' ,function(){
        //jQuery('.upload-button').on('click',function(e) {
    		//e.preventDefault();
            uploadID = jQuery(this).prev('input');  
            formfield = jQuery('.upload').attr('name');
            tb_show( '', 'media-upload.php?type=image&amp;TB_iframe=true' );
            window.send_to_editor = function(html) {
            
                var regex = /src="(.+?)"/;
                var rslt =html.match(regex);
                var imgurl = rslt[1];
               //var imgurl = jQuery('img',html).attr('src');
               uploadID.val(imgurl);
                //jQuery('#testimonial_bg_img_url').val(imgurl);
                tb_remove();
            
            }
            return false;
        });
    });
</script>

<?php }
 add_action('save_post', 'save_gallery_images_press');
function save_gallery_images_press(){
  global $post;
  update_post_meta($post->ID, "gallery_images_press", $_POST["gallery_images_press"]);
  //delete_post_meta($post->ID, "gallery_images_about");
}


//Blog Page Load more
add_action( 'wp_ajax_load_more_posts_blog_call', 'load_more_posts_blog_call' );
add_action( 'wp_ajax_nopriv_load_more_posts_blog_call', 'load_more_posts_blog_call' );

function load_more_posts_blog_call() {
	$ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    header("Content-Type: text/html");
    
	$args = array(
        'suppress_filters' => true,
        'posts_per_page' => $ppp,
		'order' => 'DESC',
        'paged'    => $page,

    );
    

    $loop = new WP_Query($args);

    $out = '';
	$response = array();
    if ($loop -> have_posts()) :  
	$response['status'] = 1;
	while ($loop -> have_posts()) : $loop -> the_post();
		$cats = get_the_category();
		$cat_name = $cats[0]->name;
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'360x440', true);
		$excerpt = get_the_excerpt();
        $excerpt = string_limit_words($excerpt,10);
		
		$response[] = array(
			'cat_name' => $cat_name,
 			'thumbnail' => $image_url[0],
			'permalink' => get_the_permalink(),
			'title' => get_the_title(),
			'excerpt' => $excerpt
		);

    endwhile;
	else: 
		$response['status'] = 0;
    endif;
    wp_reset_postdata();
	
	
    echo json_encode($response);
	die();
}
//Press Page Load more

add_action( 'wp_ajax_load_more_posts_press_callback', 'load_more_posts_press_callback' );
add_action( 'wp_ajax_nopriv_load_more_posts_press_callback', 'load_more_posts_press_callback' );

function load_more_posts_press_callback() {
	 $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;
	 $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	 header("Content-Type: text/html");

    $args = array(
        'suppress_filters' => true,
		'order' => 'DESC',
        'posts_per_page' => $ppp,
		'post_type' => 'press-post',
        'paged'    => $page
    );

    $loop = new WP_Query($args);

    $out = '';
	$response = array();
    if ($loop -> have_posts()) :  
	$response['status'] = 1;
	while ($loop -> have_posts()) : $loop -> the_post();
		$cats = get_the_category();
		$cat_name = $cats[0]->name;
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id,'360x440', true);
		//echo $image_url[0];
		
		$response[] = array(
			'cat_name' => $cat_name,
 			'thumbnail' => $image_url[0],
			'permalink' => get_the_permalink(),
			'title' => get_the_title()
		);

    endwhile;
	else: 
		$response['status'] = 0;
    endif;
    wp_reset_postdata();
	
	
    echo json_encode($response);
	die();
}

//protfolio Page Load more

add_action( 'wp_ajax_load_more_posts_protfolio_callback', 'load_more_posts_protfolio_callback' );
add_action( 'wp_ajax_nopriv_load_more_posts_protfolio_callback', 'load_more_posts_protfolio_callback' );

function load_more_posts_protfolio_callback() {
	 $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;
	 $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	 header("Content-Type: text/html");

    $args = array(
        'suppress_filters' => true,
        'posts_per_page' => $ppp,
		'post_type' => 'portfolio-post',
        'paged'    => $page,
    );$loop_count = 1;

    $loop = new WP_Query($args);

    $out = '';
	$response = array();
    if ($loop -> have_posts()) :  
	$response['status'] = 1;
	
	while ($loop -> have_posts()) : $loop -> the_post();
		$image_id = get_post_thumbnail_id();

		if( !has_post_thumbnail() ){
			$image_url[0] = 'http://placehold.it/360x440';
		}else{
			$image_url = wp_get_attachment_image_src($image_id,'360x440', true);
		}
		$cats = get_the_category();
		$cat_name = $cats[0]->name;

		
		$response[] = array(
			'cat_name' => $cat_name,
 			'thumbnail' => $image_url[0],
			'permalink' => get_the_permalink(),
			'title' => get_the_title(),
			'excerpt' => get_the_excerpt(),
			'time' => get_the_time('d M y')
		);

    endwhile;
	else: 
		$response['status'] = 0;
    endif;
    wp_reset_postdata();
    echo json_encode($response);
	die();
}
function wpb_move_comment_field_to_bottom( $fields ) {
$comment_field = $fields['comment'];
unset( $fields['comment'] );
$fields['comment'] = $comment_field;
return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

add_action( 'wp_ajax_load_more_posts_gallery_callback', 'load_more_posts_gallery_callback' );
add_action( 'wp_ajax_nopriv_load_more_posts_gallery_callback', 'load_more_posts_gallery_callback' );
function load_more_posts_gallery_callback() {
	 $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 6;
	 $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
	 header("Content-Type: text/html");

    $terms = get_terms( 'portfolio_cat', array( 'hide_empty' => 1, 'exclude' => $_POST['exclude'], 'number' => 6 ) );
	
	$__posts = array();
	$_found_terms = array();
	$_obj_found_terms = array();
	if( empty($terms) ){
		$response['status'] = 0;
		 echo json_encode($response);
		die();
	}
	foreach( $terms as $tkey => $tvalue ){
		$_found_terms[] = $tvalue->term_id;
		$_obj_found_terms[] = $tvalue;
		$args = array(
			'posts_per_page' => 1,
			'order' => 'DESC',
			'post_type'	=> 'portfolio-post',
			'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_cat',
					'field' => 'term_id',
					'terms' => array( $tvalue->term_id )
				)
			),
			'order' => 'DESC'
		);
		$loop = new WP_Query($args);
		while ($loop->have_posts()) : $loop->the_post();
			$__posts[] = get_the_ID();
			
		endwhile; wp_reset_postdata();
		
	}
	
	$args = array(
        'suppress_filters' => true,
        'posts_per_page' => 6,
		'orderby' => 'post__in',
		'post_type' => 'portfolio-post',
        'post__in' => $__posts
    );$loop_count = 1;

    $loop = new WP_Query($args);

    $out = '';
	$response = array();
    if ($loop -> have_posts()) :  
	$response['status'] = 1;
	$response['exclude'] = implode( ',', $_found_terms );
	$counter = 0;
	while ($loop->have_posts()) : $loop->the_post();
		$image_id = get_post_thumbnail_id();

		$image_url = array();
		if( !has_post_thumbnail() ){
			$image_url[0] = 'http://placehold.it/360x440';
		} else {
			$image_url = wp_get_attachment_image_src($image_id,'360x440', true);
		}
		$loop_count++;
		
		$response[] = array(
			'cat_name' => $_obj_found_terms[$counter]->name,
 			'thumbnail' => $image_url[0],
			'permalink' => get_term_link($_obj_found_terms[$counter]->term_id),
			'title' => $_obj_found_terms[$counter]->name,
			'excerpt' => get_the_excerpt(),
			'time' => $_obj_found_terms[$counter]->description
		);
		$counter++;

    endwhile;
	else: 
		$response['status'] = 0;
    endif;
    wp_reset_postdata();
    echo json_encode($response);
	die();
} 

// Our custom post type function
function create_postsocialpantry() {

	register_post_type( 'socialpantry-post',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Social Pantry' ),
				'singular_name' => __( 'Social Pantry' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'socialpantry-post'),
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_postsocialpantry' );

function custom_post_type_socialpantry() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Social Pantry', 'Post Type General Name', 'twentysixteen' ),
		'singular_name'       => _x( 'Social Pantry', 'Post Type Singular Name', 'twentysixteen' ),
		'menu_name'           => __( 'Social Pantry', 'twentysixteen' ),
		'parent_item_colon'   => __( 'Parent Social Pantry', 'twentysixteen' ),
		'all_items'           => __( 'All Social Pantries', 'twentysixteen' ),
		'view_item'           => __( 'View Social Pantry', 'twentysixteen' ),
		'add_new_item'        => __( 'Add New Social Pantry', 'twentysixteen' ),
		'add_new'             => __( 'Add New', 'twentysixteen' ),
		'edit_item'           => __( 'Edit Social Pantry', 'twentysixteen' ),
		'update_item'         => __( 'Update Social Pantry', 'twentysixteen' ),
		'search_items'        => __( 'Search Social Pantry', 'twentysixteen' ),
		'not_found'           => __( 'Not Found', 'twentysixteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentysixteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'social pantry', 'twentysixteen' ),
		'description'         => __( 'social pantry news and reviews', 'twentysixteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields', 'comments'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'socialpantry-post', $args );

}
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type_socialpantry', 0 );

?>


