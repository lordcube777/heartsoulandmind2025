<?php
function enqueue_footnotes_style() {
    wp_enqueue_style( 'footnotes', get_theme_file_uri( 'css/footnotes.css' ) );
}
global $footnotes;
$footnotes = [];
global $footnote_index;
$footnote_index = 1;
add_shortcode( 'footnote', 'add_footnote' );
function add_footnote( $args, $contents = null ){
    $default_args = array(
        'type' => 'text',
        'book' => 'genesis',
		'start_chapter' => '',
		'end_chapter' => null,
		'start_verse' => '',
		'end_verse' => null,
		'translation' => 'esv',
		'display_translation' => true,
		'url' => '',
        'link_only' => false
    );
    $args = shortcode_atts( $default_args, $args );
    $args = wp_parse_args( $args, $default_args );
    global $footnotes, $footnote_index;
    if ( $args['link_only'] ) {
        return "#fn$footnote_index";
    }
    $return_link = get_hsm_button( array(
        'icon' => svg_service( 'turn-up' ),
        'link' => "#fnref$footnote_index",
        'class' => 'footnote-reference-link',
        'alt' => "Return to footnote reference $footnote_index",
        'title' => "Return to footnote reference $footnote_index"
    ) );
    if ( $args['type'] == 'bible_citation' ) {
        $contents = get_bible_citation( array(
            'book' => $args['book'],
		    'start_chapter' => $args['start_chapter'],
		    'end_chapter' => $args['end_chapter'],
		    'start_verse' => $args['start_verse'],
		    'end_verse' => $args['end_verse'],
		    'translation' => $args['translation'],
		    'display_translation' => $args['display_translation'],
		    'url' => $args['url']
        ) );
    } elseif ( $args['type'] == 'text' ) {
        $contents = do_shortcode( $contents );
    }
    $contents = "<p class=footnote-text>$contents</p>";
    $footnotes[$footnote_index] = "$contents$return_link";
    $output = "<sup id='fnref$footnote_index' class='footnote-reference'><a class='footnote-link' href='#fn$footnote_index'>$footnote_index</a></sup>";
    $footnote_index++;
    return $output;
}
function footnotes() {
    echo get_footnotes();
}
function get_footnotes() {
    global $footnotes;
    if ( count($footnotes) == 0 ) {
        return;
    }
    $output = "<section class='footnotes'><h2 class='footnotes-heading'>Notes</h2>";
    $output .= "<ol class='footnotes-list'>";
    foreach( $footnotes as $index => $footnote ) {
        $output .= "<li id='fn$index' class='footnote-list-item'><div class='footnote-container'>$footnote</div></li>";
    }
    $output .= "</ol></section>";
    return $output;
}