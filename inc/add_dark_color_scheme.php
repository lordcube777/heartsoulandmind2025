<?php
function add_dark_color_scheme( $layouts ) {
    $output = [];
	foreach ( $layouts as $layout ) {
        $layout['color_scheme'] = 'dark';
        $output[] = $layout;
        $layout['color_scheme'] = 'light';
        $output[] = $layout;
    }
	return $output;
}