<?php
add_shortcode( 'bible_quote', 'get_bible_quote' );
function bible_quote( $args, $contents = null ) {
    echo get_bible_quote( $args, $contents = null );
}
function scripture_quote( $args, $contents = null ) {
    echo get_bible_quote( $args, $contents = null );
}
function get_scripture_quote( $args, $contents = null ){
    return get_bible_quote( $args, $contents = null );
}
function get_bible_quote( $args, $contents = null ){
    $default_args = array(
        'type' => 'inline',
        'translation' => 'esv',
        'book' => 'genesis',
        'start_chapter' => '',
        'end_chapter' => '',
        'start_verse' => '',
        'end_verse' => '',
        'display_translation' => '',
        'url' => ''
    );
    $args = shortcode_atts( $default_args, $args, 'bible_quote' );
    $args = wp_parse_args( $args, $default_args );
    if ( !$args['url'] ) {
        $args['url'] = get_bible_url( array(
            'book' => $args['book'],
            'start_chapter' => $args['start_chapter'],
            'start_verse' => $args['start_verse'],
            'translation' => $args['translation'],
        ) );
    }
    $citation = get_bible_citation( array(
        'book' => $args['book'],
        'start_chapter' => $args['start_chapter'],
        'end_chapter' => $args['end_chapter'],
        'start_verse' => $args['start_verse'],
        'end_verse' => $args['end_verse'],
        'translation' => $args['translation'],
        'display_translation' => true,
        'url' => $args['url']
    ) );
    if ( $args['type'] == 'figure' ) {
        $output = "<figure class='bible-quote-figure'>";
    } else {
        $output = '';
    }
    if ( $args['type'] == 'inline' ) {
        $output .= "<q class='bible-quote-inline' cite='$args[url]'>";
    } elseif ( $args['type'] == 'block' || $args['type'] == 'figure' ) {
        $output .= "<blockquote class='bible-quote-block' cite='$args[url]'>";
    }
    $contents = do_shortcode( $contents );
    $output .= $contents;
    if ( $args['type'] == 'inline' ) {
        $output .= "</q>";
        $output .= add_footnote( '', $citation );
    } elseif ( $args['type'] == 'block' || $args['type'] == 'figure' ) {
        $output .= "</blockquote>";
        if ( $args['type'] == 'block' ) {
            $output .= add_footnote( '', $citation );
        }
    }
    if ( $args['type'] == 'figure' ) {
        $output .= "<figcaption class='bible-quote-figcaption'>($citation)</figcaption></figure>";
    }
    return $output;
}