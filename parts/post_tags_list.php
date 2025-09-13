<?php
function enqueue_post_tags_list_style() {
    wp_enqueue_style( 'post-tags-list', get_theme_file_uri( 'css/post_tags_list.css' ) );
}
function post_tags_list( $post_id = '' ) {
	echo get_post_tags_list( $post_id );
}
function get_post_tags_list( $post_id = '' ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}
	$tags = wp_get_post_tags($post_id);
	$output = "<ul class='post-tags-list'>";
	foreach ( $tags as $tag ) {
		$url = get_term_link($tag);
		$name = $tag->name;
		$output .= "<li class='$name-tag-list-item post-tag-list-item'>";
		$output .= "<a class='$name-tag-link post-tag-link' href='$url'><span class='$name-tag-link-text post-tag-link-text'>$name</span></a>";
	}
	return $output;
}