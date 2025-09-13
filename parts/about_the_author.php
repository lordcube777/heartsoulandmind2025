<?php
function get_about_the_author( $id ) {
	$nickname = get_the_author_meta('nickname');
	$output = '<div class="about-the-author"><hgroup class="about-the-author-heading">';
	$output .=
		get_picture_element( array(
			'img_class' => 'author-avatar ' . $nickname . '-avatar icon',
			'ext' => array('webp','png'),
			'layouts' => array( array( 'color_scheme' => 'dark', 'img_width' => 64, 'widths' => array(64,128,192,256) ), array( 'color_scheme' => 'light', 'img_width' => 64, 'widths' => array(64,128,192,256) ) ),
			'type' => 'author_avatar'
		) );
	$output .= '<h2 class="author-name"><a class="author-link" href="' . get_author_posts_url($id) .'"><span>' . get_the_author_meta('display_name') .'</span></a></h2></hgroup>';
	$output .= '<p class="author-bio '. $nickname . '-bio">' . get_the_author_meta('description') . '</p></div>';
	return $output;
}
function about_the_author( $id ) {
	echo get_about_the_author( $id );
}
function enqueue_about_the_author_style() {
	wp_enqueue_style( 'about-the-author', get_theme_file_uri( 'css/about-the-author.css'));
}
