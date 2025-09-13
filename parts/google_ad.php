<?php
function google_ad( $args = '' ) {
    echo get_google_ad( $args );
}
function get_google_ad( $args = '' ) {
    $default_args = array(
        'pub_id' => '1192506894662625',
        'div_class' => '',
        'ad_class' => '',
        'type' => 'display',
    );
    $args = shortcode_atts( $default_args, $args );
    $args = wp_parse_args( $args, $default_args );
    if ( ! $args['div_class'] ) {
        $div_class = "advertisement";
    } else {
        $div_class = "$args[div_class] advertisement";
    }
    if ( ! $args['ad_class'] ) {
        $ad_class = "adsbygoogle";
    } else {
        $ad_class = "$args[ad_class] adsbygoogle";
    }
    $output = "<div class='$div_class'>";
    $output .= "<ins class='$ad_class' ";
    $output .= "style='display:block;text-align:center;margin-inline-center;' ";
    $output .= "data-ad-client='ca-pub-$args[pub_id]' ";
    switch( $args['type'] ) {
        case 'display':
            $output .= "data-ad-slot='2122901690' ";
            $output .= "data-ad-format='auto' ";
            $output .= "data-full-width-responsive='true'";
            break;
    }
    $output .= "></ins>";
    $output .= "<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>";
    $output .= "</div>";
    return $output;
}
add_shortcode( 'google_ad', 'get_google_ad' );