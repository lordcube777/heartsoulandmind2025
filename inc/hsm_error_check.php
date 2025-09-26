<?php
function hsm_error_check( $thing ){
    if ( is_wp_error( $thing ) ) {
        $error_code = array_key_first( $thing->errors );
        $error_message = $thing->errors[$error_code][0];
        error_log( $error_code . $error_message );
        return true;
    } else {
        return false;
    }
}