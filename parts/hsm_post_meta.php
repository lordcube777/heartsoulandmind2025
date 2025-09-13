<?php
function enqueue_hsm_post_meta_style() {
	wp_enqueue_style( 'hsm_post_meta', get_theme_file_uri( 'css/hsm-post-meta.css' ) );
}
function get_hsm_post_meta( $post_id = '' ) {
	if ( ! $post_id ) {
		global $post;
		$post_id = $post->ID;
	}
	$author_id = get_post_field( 'post_author', $post_id );
	$author_display_name = get_the_author_meta( 'display_name', $author_id );
	$author_post_url = get_author_posts_url( $author_id );
	$post_categories = get_the_category( $post_id );
	$post_datetime = get_post_datetime($post_id);
	$post_datetime_html = date_format( $post_datetime, 'Y-m-d\TH-i-s' );
	$post_datetime_display = date_format( $post_datetime, 'F d, Y' );
	$post_datetime_text = '<time class="post-datetime" datetime="' . $post_datetime_html .'">' . $post_datetime_display . '</time>';
	$post_month_archive_url = get_month_link( date_format( $post_datetime, 'Y' ), date_format( $post_datetime, 'm' ) );
	$output = '<ul class="post-meta-list"><li class="post-meta-item post-author-item">' . get_hsm_button( array( 'class' => 'post-meta-link author-post-link', 'link' => "$author_post_url", 'text' => "$author_display_name", 'icon' => svg_service( 'pen' ) ) ) . '</li><li class="post-meta-item post-datetime-item">' . get_hsm_button( array( 'class' => 'post-meta-link post-datetime-link', 'link' => "$post_month_archive_url", 'text' => "$post_datetime_text", 'icon' => svg_service( 'calendar' ) ) ) . '</li><li class="post-meta-item post-category-item">';
	foreach ( $post_categories as $category ) {
		$output .= get_hsm_button( array( 'class' => "post-meta-link category-link taxonomy-link $category->slug-link", 'link' => get_category_link( $category->term_id ), 'text' => "$category->name", 'icon' => svg_service( 'tag' ) ) );
	}
	$output .= '</li></ul>';
	return $output;
}
function hsm_post_meta( $post_id = '' ) {
	if ( ! $post_id ) {
		global $post;
		$post_id = $post->ID;
	}
	echo get_hsm_post_meta( $post_id );
}