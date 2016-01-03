<?php
//* Backstretch

//* Localize backstretch script
add_action( 'genesis_after_entry', 'grvrocks_set_background_image' );
function grvrocks_set_background_image() {
	$image = array( 'src' => has_post_thumbnail() ? genesis_get_image( array( 'format' => 'url' ) ) : '' );
	wp_localize_script( 'grvrocks-backstretch-set', 'BackStretchImg', $image );
}
//* Hook entry background area
add_action( 'genesis_after_header', 'grvrocks_entry_background' );
function grvrocks_entry_background() {
	$postid = get_the_ID();
	if ( ( false == get_post_format($postid) || 'aside' == get_post_format($postid) ) && has_post_thumbnail($postid) ) {
		echo '<div class="entry-background"><div class="wrap">';
		echo genesis_do_post_title();

		echo '</div></div>';

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
