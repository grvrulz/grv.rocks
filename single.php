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
add_action( 'genesis_entry_header', 'grvrocks_entry_background_start', 4 );
function grvrocks_entry_background_start() {
	if ( ( false == get_post_format($postid) || 'aside' == get_post_format($postid) ) && has_post_thumbnail($postid) ) {
		echo '<div class="entry-background"><div class-"dark-gradient"><div class="wrap">';
	}
}

add_action( 'genesis_entry_header', 'grvrocks_entry_background_end', 16 );
function grvrocks_entry_background_end() {
	if ( ( false == get_post_format($postid) || 'aside' == get_post_format($postid) ) && has_post_thumbnail($postid) ) {
		echo '</div></div></div>';
	}
}



//* Add body class if no featured image
add_filter( 'body_class', 'grvrocks_featured_img_body_class' );
function grvrocks_featured_img_body_class( $classes ) {

	if ( is_singular( array( 'post', 'page' ) ) && ! has_post_thumbnail() ) {
		$classes[] = 'no-featured-image';
	}
	return $classes;

}



genesis();
