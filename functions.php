<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Mobile First Theme' );
define( 'CHILD_THEME_URL', 'http://briangardner.com/themes/mobile-first/' );
define( 'CHILD_THEME_VERSION', '1.0.4' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'mobile_first_scripts_styles' );
function mobile_first_scripts_styles() {

	wp_enqueue_script( 'mobile-first-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:700|Libre+Baskerville:400italic,400,700', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 114,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );


//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer'
) );

//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mobile_first_remove_comment_form_allowed_tags' );
function mobile_first_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'mobile_first_author_box_gravatar' );
function mobile_first_author_box_gravatar( $size ) {

	return 160;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'mobile_first_comments_gravatar' );
function mobile_first_comments_gravatar( $args ) {

	$args['avatar_size'] = 100;
	return $args;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'sticky-message',
	'name'        => __( 'Sticky Message', 'bg-mobile-first' ),
	'description' => __( 'This is the sticky message widget area.', 'bg-mobile-first' ),
) );


//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}


//* Reposition the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 9 );
