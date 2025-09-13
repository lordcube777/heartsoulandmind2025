<?php
function get_hsm_comment_before( $comment, $args, $depth ) {
	$comment_class = comment_class( $css_class = empty( $args['has_children'] ) ? '' : 'parent', $comment = null, $post = null, $display = false );
	$comment_id= "comment-" . get_comment_ID() . "";
	return '<li ' . $comment_class . ' id="' . $comment_id. '">';
}
function hsm_comment_before( $comment, $args, $depth ) {
	echo get_hsm_comment_before( $comment, $args, $depth );
}
function get_hsm_comment_after() {
	return '</li>';
}
function hsm_comment_after() {
	echo get_hsm_comment_after();
}
function get_hsm_comment($comment, $args, $depth) {
	$comment_date = get_comment_date( 'Y-m-d' );
	$comment_date_display = get_comment_date();
	$comment_time = get_comment_time( 'H:i:s' );
	$comment_time_display = get_comment_time();
	$comment_link = get_comment_link();
	$comment_text = get_comment_text();
	$avatar = get_avatar( $comment, 32, 'mystery' );
	$comment_author_link = get_comment_author_link();
	if ( $comment->comment_approved == '0' ) {
		$moderation = '<em class="comment-awaiting-moderation">' . _e( 'Your comment is awaiting moderation.' ) . '</em><br/>';
	} else {
		$moderation = '';
	}
	$comment_edit_button = get_hsm_button( array(
		'icon' => 'pen',
		'link' => get_edit_comment_link( $comment, 'url' ),
		'class' => 'comment-edit-link'
		)
	);
	$comment_reply_button = get_hsm_button( array(
		'icon' => 'reply',
		'link' => '#',
		'class' => 'comment_reply_link'
	) );
	$output ='';
	$output = ''. get_hsm_comment_before( $comment, $args, $depth ) . '<article class="comment-article"><header class="comment-header">' . $avatar . '<h3 class="comment-author"><cite>' . $comment_author_link . '</cite></h3>' . $moderation . '<time class="comment-datetime" datetime="' . $comment_date . 'T' . $comment_time . '"><a href="' . $comment_link . '">' . $comment_date_display . ' at ' . $comment_time_display . '</a></time></header><p class="comment-body">' . $comment_text . '</p><footer class="comment-footer">' . $comment_edit_button . '' . $comment_reply_button .'</footer></article>' . get_hsm_comment_after() . '';
	return $output;
}
function hsm_comment( $comment, $args, $depth ) {
	echo get_hsm_comment( $comment, $args, $depth );
}