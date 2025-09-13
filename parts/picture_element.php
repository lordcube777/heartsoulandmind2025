<?php
function get_srcset( $img, $color_scheme, $aspect_ratio, $img_width, $widths, $ext, $type ) {
	$output = "srcset='";
	$first = true;
	foreach ( $widths as $width ) {
		if ( $type == 'img' && $img_width >= $width ) {
			continue;
		} elseif ( $type == 'source' && $img_width > $width ) {
			continue;
		} else {
			if ( is_string($img_width) ) {
				$img_width = intval($img_width);
			}
			$density = $width / $img_width;
			if ( $density > 4 ) {
				break;
			}
			if ( ! $first ) {
				$output .= ',';
			} else {
				$first = false;
			}
			$output .= "$img$color_scheme-$aspect_ratio-{$width}w.$ext {$density}x";
		}
	}
	$output .= "'";
	return $output;
}
function get_img_link_tag( $img, $aspect_ratio, $img_width, $widths, $ext, $color_scheme = '', $layout_width = '', $prev_layout_width = '' ) {
	$output = "<link rel='preload' as='image' fetchpriority='high' type='image/$ext' ";
	$output .= "media='";
	if ( $layout_width && ! $prev_layout_width ) {
		$output .= "(width >= $layout_width)";
	} elseif ( $layout_width && $prev_layout_width ) {
		$output .= "($layout_width <= width < $prev_layout_width)";
	} elseif ( ! $layout_width && $prev_layout_width ) {
		$output .= "(width < $prev_layout_width)";
	}
	if ( !in_array( $color_scheme, [ '-light', '' ], true ) ) {
		$output .= " and ";
		switch( $color_scheme ) {
			case "-dark":
				$output .= "(prefers-color-scheme: dark)";
				break;
		}
	}
	$output .= "' ";
	$output .= "image";
	$output .= get_srcset( $img, $color_scheme, $aspect_ratio, $img_width, $widths, $ext, 'source' );
	$output .= "'";
	return $output;
}
function get_picture_element( $args ) {
	$default_args = array(
		'alt' => '',
		'ext' => array( 'avif', 'jpg' ),
		'img_class' => '',
		'img' => '',
		'layouts' => array(array()),
		'picture_class' => '',
		'type' => '',
		'preload' => ''	
	);
	$args = shortcode_atts( $default_args, $args );
	$args = wp_parse_args( $args, $default_args );
	if ( $args['picture_class'] ) {
		$picture_class = "class='$args[picture_class]'";
	} else {
		$picture_class = "class='picture'";
	}
	if ( is_single() && empty($args['type']) ) {
		$args['type'] = 'single';
	}
	switch ($args['type']) {
		case 'post_preview':
		case 'single':
			$upload_dir = wp_upload_dir(get_the_date('Y/m'));
			$slug = get_post_field( 'post_name', get_post() );
			$args['img'] = "$upload_dir[url]/$slug/$slug";
			break;
		case 'author_avatar':
			$upload_dir = wp_upload_dir();
			$author = get_the_author_meta('user_nicename');
			$args['img'] = get_theme_file_uri("assets/images/authors/$author/avatar/avatar-$author");
			break;
		case 'category':
			$upload_dir = wp_upload_dir();
			$args['img'] = "$upload_dir[baseurl]/category-$args[img]";
			break;
		case 'profile_picture':
			$upload_dir = wp_upload_dir();
			$author = get_the_author_meta('user_nicename');
			$args['img'] = get_theme_file_uri("assets/images/authors/$author/profile-picture/profile-picture-$author");
			$args['img_class'] = "profile-picture-$author profile-picture";
			break;
	}
	if ( is_string($args['layouts']) ) {
		$args['layouts'] = explode(';', $args['layouts']);
		$index = 0;
		foreach ( $args['layouts'] as $layout ){
			$args['layouts'][$index] = array();
			foreach (explode( ',', $layout ) as $property ) {
				$part = explode( '=', $property );
				$args['layouts'][$index][$part[0]] = $part[1];
			}
			$index++;
		};
	}
	if ( is_string($args['ext']) ) {
		$args['ext'] = explode( ',', $args['ext'] );
	}
	if ( str_starts_with( $args['img'], '$theme') ) {
		$args['img'] = preg_replace('/\$theme/i', get_theme_file_uri(), $args['img'] );
	} elseif ( str_starts_with( $args['img'], '$uploads') ) {
		$upload_dir = wp_upload_dir();
		$args['img'] = preg_replace('/\$uploads/i', $upload_dir['baseurl'], $args['img'] );
	}
	$output = "<picture $picture_class>";
	if ( $args['preload'] ) {
		$link_tag ='';
	}
	$prev_layout_width = '';
	foreach ( $args['layouts'] as $layout ) {
		$layout = wp_parse_args($layout, array(
			'aspect_ratio' => 'square',
			'color_scheme' => '',
			'img_width' => 512,
			'layout_width' => '',
			'widths' => array( 128, 256, 512, 768, 1024, 1536, 2048)
		) );
		if ( $layout['color_scheme'] ){
			$layout['color_scheme'] = "-$layout[color_scheme]";
		}
		foreach ( $args['ext'] as $ext ) {
			if ( $args['preload'] ) {
				$link_tag .= get_img_link_tag( $args['img'], $layout['aspect_ratio'], $layout['img_width'], $layout['widths'], $ext, $layout['color_scheme'], $layout['layout_width'], $prev_layout_width );
				$link_tag .= ">";
				if ($args['preload'] == 'only' ) {
					continue;
				}
			}
			if ( ( $ext == 'jpg' || $ext == 'png' ) && ! $layout['layout_width'] && $layout['color_scheme'] != '-dark' ) {
				if ( $args['img_class'] ){
					$img_class = "class='$args[img_class]'";
				} else {
					$img_class = '';
				}
				if ( $args['alt'] ) {
					$alt = "alt='$args[alt]'";
				} else {
					$alt = "alt=''";
				}
				$output .= "<img $img_class$alt";
				$output .= "src='$args[img]$layout[color_scheme]-$layout[aspect_ratio]-$layout[img_width]w.$ext' ";
				$output .= get_srcset( $args['img'], $layout['color_scheme'],$layout['aspect_ratio'], $layout['img_width'], $layout['widths'], $ext, 'img' );
				$output .= '/>';
			} else {
				$output .= "<source type='image/$ext' ";
				if ( $layout['layout_width'] || $layout['color_scheme'] ) {
					$output .= "media='";
					if ( $layout['layout_width'] ) {
						$output .= "(min-width:$layout[layout_width])";
					}
					if ( $layout['layout_width'] && !in_array($layout['color_scheme'], ['-light', ''], true ) ) {
						$output .= " and ";
					}
					switch( $layout['color_scheme'] ) {
						case '-dark':
							$output .= "(prefers-color-scheme: dark)' ";
							break;
						default :
							$output .= "' ";
					}
				}
				$output .= get_srcset( $args['img'], $layout['color_scheme'], $layout['aspect_ratio'], $layout['img_width'], $layout['widths'], $ext, 'source' );
				$output .= '/>';
			}
		}
		$prev_layout_width = $layout['layout_width'];
	}
	$output .= '</picture>';
	if ( $args['preload'] == 'only' )  {
		$output = $link_tag;
	} elseif ( $args['preload'] == 'true' ) {
		$output = array( "$link_tag", "$output" );
	}
	return $output;
}
function picture_element( $args ) {
	echo get_picture_element( $args );
}
add_shortcode( 'picture_element', 'get_picture_element');
