<?php
function get_file_download_link( $atts, $content = null ) {
	$args = array(
		'filename' => '',
		'baseurl' => '',
		'class' => ''
	);
	$args = shortcode_atts( $args, $atts );
	if ( ! $args['filename'] ) {
		exit;
	}
	if (  $args['baseurl'] ) {
		$baseurl = $args['baseurl'];
	} elseif ( is_single() ) {
		$upload_dir = wp_upload_dir(get_the_date('Y/m'));
		$baseurl = "$upload_dir[url]/";
		$baseurl .= get_post_field( 'post_name' );
	} else {
		$upload_dir = wp_upload_dir();
		$baseurl = $upload_dir['baseurl'];
	}
	$url = "$baseurl/$args[filename]";
	if ( $args['class'] ) {
		$class = "$args[class] file-download-link";
	} else {
		$class = 'file-download-link';
	}
	return '<a class="' . $class . '" download href="' . $url . '"><span>' . $content . '</span></a>';
}