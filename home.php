<?php


global $post;

/**
 * Blog Intro
 *
 */
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
add_action( 'genesis_before_loop', 'rgc_blog_intro' );
function rgc_blog_intro() {
	$posts_page = get_option( 'page_for_posts' );
	if ( is_null( $posts_page ) ) {
		return;
	}
	$posts_page = get_post( $posts_page );
	$title   = $posts_page->post_title;
	$content = $posts_page->post_content;
	$title_output = $content_output = '';
	if ( $title ) {
		$title_output = sprintf( '<h1 %s>%s</h1>', genesis_attr( 'archive-title' ), $title );
	}
	if ( $content ) {
		$content_output = wpautop( $content );
	}
	if ( $title || $content ) {
		printf( '<div %s>%s</div>', genesis_attr( 'posts-page-description' ), $title_output . $content_output );
	}
}

//* Reposition the entry meta in the entry header
//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
//add_action( 'genesis_entry_header', 'genesis_do_post_title', 13 );
//
////* Add grvrocks grid body class
//add_filter( 'body_class', 'grvrocks_grid_body_class' );
//function grvrocks_grid_body_class( $classes ) {
//
//	$classes[] = 'grvrocks-grid';
//	return $classes;
//
//}
//
////* Remove entry content
//if ( 'link' != get_post_format() || 'quote' != get_post_format() ) {
//	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//}
//
////* Remove entry meta in entry footer
//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
//remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
//remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
//
//
//add_theme_support( 'genesis-structural-wraps', array(
//	'header',
//	'footer',
//	'site-inner'
//) );

genesis();
