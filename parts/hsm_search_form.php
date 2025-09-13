<?php
function get_hsm_search_form( $id ) {
    $output = "<form ";
    $output .= "id='{$id}-form' ";
    $output .= "class='search-form' role='search' action='";
    $output .= home_url();
    $output .= "' method='get'>";
    $output .= "<button id='{$id}-submit' class='search-submit' type='submit'>";
    $output .= svg_service('search');
    $output .= "</button>";
    $output .= "<input id='{$id}-field' class='search-field' type='search' placeholder='Search' name='s' value='";
    $output .= get_search_query();
    $output .= "'></form>";
    return $output;
}
function hsm_search_form( $id = '' ){
    echo get_hsm_search_form( $id );
}
//add_filter( 'get_search_form', 'get_hsm_search_form' );