<?php
add_filter( 'shortcode_atts_hebrew_text', 'shortcode_lang', 10, 4 );
add_filter( 'shortcode_atts_greek_text', 'shortcode_lang', 10, 4 );
function shortcode_lang( $out, $pairs, $atts, $shortcode ) {
	if ( $shortcode == 'hebrew_text' ) {
		$out['og_lang'] = 'hebrew';
	} elseif ( $shortcode == 'greek_text' ){
		$out['og_lang'] = 'greek';
	}
	return $out;
}
function get_translit( $atts, $content = null, $tag = null ) {
	$default_args = array(
		'og_lang' => null,
		'og_script' => null,
		'translit_lang' => 'english',
		'translit_script' => null,
		'define' => false
	);
	$args = shortcode_atts( $default_args, $atts, $tag );
	$args = wp_parse_args( $args, $default_args );
	if ( $args['og_lang'] == 'hebrew' ) {
		$og_lang_att = 'he';
	} elseif ( $args[ 'og_lang' ] == 'greek' ) {
		$og_lang_att = 'el';
	}
	if ( $args['translit_lang'] == 'english' ) {
		$translit_lang_att = 'en';
	}
	if ( ! $args['translit_script'] ) {
		$args['translit_script'] = transliterator_transliterate("$og_lang_att-$translit_lang_att", $args['og_script']);
	}
	$output = '<i class="' . $args['og_lang'] . '-script" lang="' . $og_lang_att . '">' . $args['og_script'] . '</i>';
	if ( $args['define'] ) {
		$output = "<dfn>$output</dfn>";
	}
	$output .= ' (<i class="' . $args['translit_lang'] . '-translit" lang="' . $translit_lang_att . '">' . $args['translit_script'] . '</i>)';
	return $output;
}