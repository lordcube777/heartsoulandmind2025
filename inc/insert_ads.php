<?php
function insert_ads( $content, $args = '' ) {
    $default_args = array(
        'delimter' => '<section',
        'start_index' => 1,
        'repeat_freq' => 2,
        'div_class' => '',
        'slot_class'=> 'advertisement-slot',
        'ad_class' => ''
    );
    $args = wp_parse_args( $args, $default_args );
    $sections = explode( $args['delimter'], $content );
    $slot_num = 1;
    if ( $args['div_class'] ) {
        $args['div_class'] .= ' ';
    }
    for ( $i = $args['start_index']; $i < count( $sections ); $i++ ) {
            $sections[$i] = $args['delimter'] . $sections[$i];
            if ( $i % $args['repeat_freq'] == 0 || ( $args['repeat_freq'] == 0 && $i == $args['start_index'] ) ) {
                $ad_code = get_google_ad( array( 'div_class' => "$args[div_class]$args[slot_class]-$slot_num", 'ad_class' => $args['ad_class'] ) );
                $sections[$i] .= $ad_code;
                $slot_num++;
            } else {
                continue;
            }
        }
        $content = implode ( '', $sections );
        return $content;
}
add_filter( 'the_content', 'insert_ads_in_single' );
function insert_ads_in_single( $content ) {
    if ( is_single() ) {
        insert_ads( $content, array( 'div_class' => "content-inline-size-ad", 'slot_class' => 'main-post-ad-slot' ) );
    }
    return $content;
}