<section class="comment-section">
    <h2>Comments</h2>
    <?php
    if ( post_password_required() ) {
        return;
    }
    ?>
    <?php
    wp_enqueue_style( 'comments', get_theme_file_uri( 'css/comments.css' ) );
    if ( have_comments() ) :
    $args = array(
        'status' => 'approve',
    );
    $comments = get_comments();
    if ( $comments ) { ?>
        <ul class="comment-list">
            <?php wp_list_comments( 'type=comment&callback=hsm_comment' ); ?>
        </ul>
    <?php } else {
        echo 'No comments found.';
    }
    ?>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav class="nav comment-nav" role="navigation">
        <h2 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h2>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentythirteen' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentythirteen' ) ); ?></div>
    </nav>
    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
    <p><?php _e( 'Comments are closed.', 'twentythirteen' ); ?></p>
    <?php endif; ?>

    <?php endif;?>

    <?php comment_form(); ?>
</section>