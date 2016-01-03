<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'GrvRocks theme' );
define( 'CHILD_THEME_URL', 'https://grv.rocks/' );
define( 'CHILD_THEME_VERSION', '1.0.4' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'grvrocks_scripts_styles' );
function grvrocks_scripts_styles() {

	wp_enqueue_script( 'grvrocks-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,800|Libre+Baskerville:400italic,400,700', array(), CHILD_THEME_VERSION );

	if ( is_singular( array( 'post', 'page' ) ) && has_post_thumbnail() ) {
		wp_enqueue_script( 'grvrocks-backstretch', get_bloginfo( 'stylesheet_directory' ) . '/js/backstretch.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'grvrocks-backstretch-set', get_bloginfo( 'stylesheet_directory' ) . '/js/backstretch-set.js' , array( 'jquery', 'grvrocks-backstretch' ), '1.0.0', true );
	}

//	if ( is_singular( array( 'post', 'page' ) ) ) {
//		wp_enqueue_script( 'grvrocks-singular', get_bloginfo( 'stylesheet_directory' ) . '/js/singular-script.js', array( 'jquery' ), '1.0.0', true );
//	}
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

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'footer',
) );

//* Remove the sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar' );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove Genesis Layout Settings
remove_theme_support( 'genesis-inpost-layouts' );

//* Force full-width-content layout setting
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'grvrocks_remove_comment_form_allowed_tags' );
function grvrocks_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'grvrocks_author_box_gravatar' );
function grvrocks_author_box_gravatar( $size ) {

	return 160;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'grvrocks_comments_gravatar' );
function grvrocks_comments_gravatar( $args ) {

	$args['avatar_size'] = 100;
	return $args;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'sticky-message',
	'name'        => __( 'Sticky Message', 'grvrocks' ),
	'description' => __( 'This is the sticky message widget area.', 'grvrocks' ),
) );


//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );


//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
	$post_info = '[post_date]';
	return $post_info;
}

//* Customize the entry meta in the entry footer (requires HTML5 theme support)
add_filter( 'genesis_post_meta', 'sp_post_meta_filter' );
function sp_post_meta_filter($post_meta) {
	$post_meta = '[post_categories BEFORE=""] [post_tags]';
	return $post_meta;
}

//* Add support for post formats
add_theme_support( 'post-formats', array(
	'aside',
	'audio',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video'
) );

//remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );


//* Add theme support for footer widgets
add_theme_support( 'genesis-footer-widgets', 1);
remove_action( 'genesis_footer', 'genesis_do_footer' );


// do NOT include the opening line! Just add what's below to the end of your functions.php file
add_action( 'edit_form_after_title', 'grvrocks_posts_page_edit_form' );
function grvrocks_posts_page_edit_form() {
	global $post, $post_type, $post_ID;
	if ( $post_ID == get_option( 'page_for_posts' ) && empty( $post->post_content ) ) {
		add_post_type_support( $post_type, 'editor' );
	}
}


// Filter the title with a custom function
add_filter('genesis_seo_title', 'grvrocks_site_title' );

// Add additional custom style to site header
function grvrocks_site_title( $title ) {

		// Change $custom_title text as you wish
	$custom_title = 'Gaurav <span class="thin">Pareek</span>';

	// Don't change the rest of this on down

	// If we're on the front page or home page, use `h1` heading, otherwise us a `p` tag
	$tag = ( is_home() || is_front_page() ) ? 'h1' : 'p';

	// Compose link with title
	$inside = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $custom_title );

	// Wrap link and title in semantic markup
	$title = sprintf ( '<%s class="site-title" itemprop="headline">%s</%s>', $tag, $inside, $tag );
	return $title;

}

//* Add editor styles
add_editor_style( 'editor-style.css' );


//* Remove Content and Excerpt options from content archive metabox
add_filter( 'genesis_archive_display_options', 'grvrocks_add_content_archive_display_option' );
function grvrocks_add_content_archive_display_option( $options ) {
	unset( $options['full'] );
	unset( $options['excerpts'] );
	$options['nocontent'] = __( 'No Content', 'grvrocks' );

	return $options;
}
