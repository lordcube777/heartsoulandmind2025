<?php
function get_hsm_button( $args ) {
	$args = wp_parse_args( $args, array (
		'text'   => '',
		'link'   => '#',
		'id'     => '',
		'class'  => '',
		'title' => '',
		'target' => '_self',
		'alt' => '',
		'rel'    => '',
		'icon'   => '',
		'icon_position' => 'left',
		'text_tag' => 'span'
	)
	);
	if ( $args['id'] ) {
		$id = 'id="' . $args['id'] .'" ';
	} else {
		$id = '';
	}
	if ( $args['class'] ) {
		$class = '' . $args['class'] . ' button';
	} else {
		$class = 'button';
	}
	if ( $args['alt'] ){
		$alt = "alt='$args[alt]' ";
	} else {
		$alt = '';
	}
	if ( $args['title'] ) {
		$title = "title='$args[title]'";
	} else {
		$title = '';
	}
	if ( $args['text'] ) {
		$text = '<' . $args['text_tag'] . ' class="text">' . $args['text'] . '</' . $args['text_tag'] . '>';
	}
	if ( $args['text'] && !$args['icon'] ) {
		$output = $text;
	} elseif ( $args['icon'] && !$args['text'] ) {
		$output = $args['icon'];
	} elseif ( $args['text'] && $args['icon'] ) {
		if ( $args['icon_position'] == 'left' ) {
			$output = '' . $args['icon'] . '' . $text . '';
		} else {
			$output = '' . $text . '' . $args['icon'] . '';
		}
	}
	return "<a $id class='$class'$alt$title href='$args[link]' target='$args[target]' rel='$args[rel]'>$output</a>";
}
function hsm_button( $args ) {
	echo get_hsm_button( $args );
}