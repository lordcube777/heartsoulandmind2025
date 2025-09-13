<?php
function internal_link( $atts ){
	echo get_internal_link( $atts );
}
function get_internal_link( $atts, $content = null ) {
	$default_args = array(
		'type' => '',
		'id' => '',
		'slug' => '',
		'class' => '',
		'text_tag' => 'span',
		'text_class' => '',
		'html' => true,
	);
	$args = shortcode_atts( $default_args, $atts, 'internal_link' );
	$args = wp_parse_args( $atts, $default_args );
	if ( $args['type'] == 'post' || !$args['type'] ) {
		$query_args = array(
			'p' => $args['id'],
			'name' => $args['slug'],
			'post_type' => array( 'post' ),
			'post_status' => array( 'publish' ),
			'nopaging' => true,
			'posts_per_page' => '1',
		);
		$query = get_posts( $query_args );
		$url = get_permalink($query[0]);
	} elseif ( $args['type'] == 'page' ) {
		$query_args = array(
			'page_id' => $args['id'],
			'pagename' => $args['slug'],
			'post_type' => array( 'page' ),
			'post_status' => array( 'publish' ),
			'nopaging' => true,
			'posts_per_page' => '1',
		);
		$query = get_posts( $query_args );
		$url = get_permalink($query[0]);
	} elseif ( $args['type'] == 'category' ) {
		$query_args = array(
			'taxonomy' => array( 'category' ),
			'slug' => $args['slug'],
			'number' => 1,
			'fields' => 'ids',
		);
		$term_query = get_terms( $query_args );
		$url = get_term_link($term_query[0]);
	} elseif ( $args['type'] == 'tag' ) {
		$query_args = array(
			'taxonomy' => array( 'post_tag' ),
			'slug' => $args['slug'],
			'number' => 1,
		);
		$term_query = get_terms( $query_args );
		$url = get_term_link($term_query[0]);
	} elseif ( $args['type'] == 'author' ) {
		$query_args = array(
			'exclude'        => array( 1 ),
			'number'         => '1',
			'capability' => array( 'edit_posts' ),
			'fields'         => array( 'id' ),
		);
		if ( $args['id'] ) {
			$query_args['include'] = array( $args['id'] );
		} else {
			$query_args += [
				'search'         => $args['slug'],
				'search_columns' => array( 'user_login', 'user_nicename' )
			];
		}
		$user_query = get_users( $query_args );
		$url = get_author_posts_url( $user_query[0]->ID );
	}
	if ( $args['html'] ) {
		if ( $args['class'] ) {
			$args['class'] = "$args[class] internal-link";
		} else {
			$args['class'] = 'internal-link';
		}
		if ( $args['text_class'] ) {
			$args['text_class'] = "$args[text_class] internal-link-text";
		} else {
			$args['text_class'] = "internal-link-text";
		}
		$output = "<a class='$args[class]'href='$url'>";
		if ( $args['text_tag'] == 'none' ) {
			$output .= "$content</a>";
		} else {
			$output .= "<$args[text_tag] class='$args[text_class]'>$content</$args[text_tag]></a>";
		}
	} else {
		$output = $url;
	}
	return $output;
}