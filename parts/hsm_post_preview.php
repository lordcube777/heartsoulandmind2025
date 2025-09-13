<?php
function open_text_container() {
	return "<div class='post-preview-text-container'>";
}
function get_hsm_post_preview( $args ) {
	$default_args = array(
		'p' => '',
		'name' => '',
		'header_level' => 'h2',
		'layouts' => array( array( 'layout_width' => '32em', 'img_width' => 256 ), array( 'img_width' => 512 ) ),
		'include' => array( 'image', 'title', 'subtitle', 'excerpt', 'meta' )
	);
	wp_parse_args( $args, $default_args );
	$text_container_opened = false;
	$output = "<div class='post-preview'>";
	foreach ( $args['include'] as $element ) {
		switch( $element ) {
			case 'image':
				$image = get_picture_element( array(
					'type' => 'post_preview',
					'picture_class' => 'post-preview-picture',
					'img_class' => 'post-preview-img',
					'layouts' => $args['layouts']
				) );
				$output .= get_internal_link( array(
					'class' => 'post-preview-img-link',
					'type' => 'post',
					'id' => $args['p'],
					'text_tag' => 'none'
				), $image );
				break;
			case 'title':
				if ( ! $text_container_opened ) {
					$output .= open_text_container();
					$text_container_opened = true;
				}
				$output .= get_internal_link( array(
					'class' => 'post-preview-title-link',
					'type' => 'post',
					'id' => $args['p'],
					'text_tag' => $args['header_level'],
					'text_class' => 'post-preview-title',
				), get_the_title($args['p']) );
				break;
			case 'subtitle':
				if ( ! $text_container_opened ) {
					$output .= open_text_container();
					$text_container_opened = true;
				}
				$subtitle = get_post_meta($args['p'], 'subtitle', true);
				$output .= "<p class='post-preview-subtitle'>$subtitle</p>";
				break;
			case 'excerpt':
				if ( ! $text_container_opened ) {
					$output .= open_text_container();
					$text_container_opened = true;
				}
				$excerpt = get_the_excerpt($args['p']);
				$output .= "<p class='post-preview-excerpt'>$excerpt</p>";
				break;
			case 'meta':
				if ( ! $text_container_opened ) {
					$output .= open_text_container();
					$text_container_opened = true;
				}
				$output .= get_hsm_post_meta($args['p']);
				break;
		}
	}
	if ( $text_container_opened ) {
		$output .= "</div>";
	}
	$output .= "</div>";
	return $output;
}
function hsm_post_preview( $args ) {
	echo get_hsm_post_preview( $args );
}