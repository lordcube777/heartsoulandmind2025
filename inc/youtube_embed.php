<?php
function youtube_embed( $atts ) {
	echo get_youtube_embed( $atts );
}
function get_youtube_embed( $args ) {
	$default_args = array(
		'video_id' => '',
		'caption' => ''
	);
	$args = shortcode_atts( $default_args, $args );
	$args = wp_parse_args( $args, $default_args );
	$title = get_the_title();
	if ( !$args['caption'] ) {
		$caption = "<figcaption class='youtube-embed-caption'>The $title video on YouTube.";
	}
	return "<figure class='youtube-embed'><iframe src='https://www.youtube.com/embed/$args[video_id]' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>$caption</figure>";
}