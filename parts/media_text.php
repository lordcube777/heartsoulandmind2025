<?php
function enqueue_media_text_style() {
	wp_enqueue_style( 'header', get_theme_file_uri( 'css/media_text.css' ) );
}
function get_media_text( $args ) {
	add_action( 'wp_enqueue_scripts', 'enqueue_media_text_style' );
	$args = wp_parse_args( $args, array(
		'class' => '',
		'media' => '',
		'text' => 'Text goes here.'
	)
	);
	if ( $args['class'] ) {
		$args['class'] = "media-text $args[class]";
	} else {
		$args['class'] = "media-text";
	}
	return '<div class="' . $args['class'] .'">' . $args['media'] .'<div class="text">' . $args['text'] .'</div></div>';
}
function media_text( $args ) {
	echo get_media_text( $args );
}