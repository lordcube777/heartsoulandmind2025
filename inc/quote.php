<?php
add_shortcode( 'quote', 'get_quote' );
function quote( $args, $contents = null ) {
    echo get_quote( $args, $contents = null );
}
function get_quote( $args, $contents = null ) {
    $default_args = array(
        'type' => 'inline',
        'citation' => ''
    );
    $args = shortcode_atts( $default_args, $args, 'quote' );
    $args = wp_parse_args( $args, $default_args );
    if ( $args['citation'] ) {
        $cite = "cite='$args[citation]' ";
    }
    if ( $args['type'] == 'inline' ) {
        $class = 'inline';
        $output = "<q class='$class' cite='";
    } elseif ( $args['type'] == 'block' ) {
        $class = 'block';
        $output = "<blockquote class='$class' cite='";
    }
    $output .= add_footnote( array( 'link_only' => true ) );
    $contents = do_shortcode( $contents );
    $output .= "'>$contents";
    if ( $args['type'] == 'inline' ) {
        $output .= "</q>";
    } elseif ( $args['type'] == 'block' ) {
        $output .= "</blockquote>";
    }
    $output .= add_footnote( '', $args['citation'] );
    return $output;
}