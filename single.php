<?php
//* Backstretch
$postid = get_the_ID();
//* Localize backstretch script
add_action( 'genesis_after_entry', 'grvrocks_set_background_image' );
function grvrocks_set_background_image() {
	$image = array( 'src' => has_post_thumbnail($postid) ? genesis_get_image( array( 'format' => 'url' ) ) : '' );
	wp_localize_script( 'grvrocks-backstretch-set', 'BackStretchImg', $image );
}
//* Hook entry background area
add_action( 'genesis_after_header', 'grvrocks_entry_background' );
function grvrocks_entry_background() {
	if ( ( false == get_post_format($postid) || 'aside' == get_post_format($postid) ) && has_post_thumbnail($postid) ) {
		echo '<div class="entry-background"><div class="dark-gradient"><div class="wrapper">';
		echo genesis_post_meta();
		echo genesis_do_post_title();
		if ( function_exists( 'the_subtitle' ) ) {
			the_subtitle( '<p class="entry-subtitle">', '</p>' );
		}
		echo genesis_post_info();
		echo '</div></div>';
		echo '</div>';
	}
}

//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

//* Remove the entry meta in the entry header (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the entry title (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

//* Add body class if no featured image
add_filter( 'body_class', 'grvrocks_featured_img_body_class' );
function grvrocks_featured_img_body_class( $classes ) {

	if ( is_singular( array( 'post', 'page' ) ) && ! has_post_thumbnail() ) {
		$classes[] = 'no-featured-image';
	}
	return $classes;

}



genesis();
