<?php
/**
 * Blog Intro
 *
 */
add_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
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
genesis();
