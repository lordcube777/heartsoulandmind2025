<?php
function enqueue_hsm_post_preview_loop_style() {
    wp_enqueue_style( 'hsm-post-preview-loop', get_theme_file_uri( 'css/hsm-post-preview-loop.css' ) );
	enqueue_hsm_post_meta_style();
}
function enqueue_hsm_post_preview_loop_block_style() {
	wp_enqueue_style( 'hsm-post-preview-loop-block', get_theme_file_uri( 'css/hsm-post-preview-loop-block.css' ) );
}
function enqueue_hsm_post_preview_loop_inline_style() {
	wp_enqueue_style( 'hsm-post-preview-loop-inline', get_theme_file_uri( 'css/hsm-post-preview-loop-inline.css' ) );
}
function get_hsm_post_preview_loop( $args = null ) {
    $args = wp_parse_args( $args, array (
        'author_name' => get_query_var('author_name'),
        'category_name' => get_query_var('category_name'),
        'tag' => get_query_var('tag'),
        's' => get_query_var('s'),
		'p' => '',
        'name' => get_query_var('name'),
		'post__in' => get_query_var('post__in'),
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 12,
        'paged' => (get_query_var('paged')) ? get_query_var('paged') : 1,
		'ignore_sticky_post' => true,
        'year' => get_query_var('year'),
        'monthnum' => get_query_var('monthnum'),
        'date_query' => '',
        'header_level' => 'h2',
        'layouts' => array(
            array(
                'layout_width' => '48em',
                'img_width' => 256
            ),
            array(
                'layout_width' => '32em',
                'img_width' => 256,
                'aspect_ratio' => 'portrait-tall'
            ),
            array(
                'img_width' => 512
            )
        ),
		'type' => null,
        'include' => array( 'image', 'title', 'subtitle', 'excerpt', 'meta' ),
        'ads' => false,
        'ad_class' => ''
    ) );
    $dark_layouts = '';
    $output = '';
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
		$output .= '<ul class="post-preview-list">';
        while ( $the_query->have_posts() ) {
			$output .= '<li class="post-preview-list-item">';
            $the_query->the_post();
			$args['p'] = get_the_ID();
            if ( get_post_meta( $args['p'], 'dark_mode', true ) ) {
                if ( ! $dark_layouts ) {
                    $dark_layouts = add_dark_color_scheme( $args['layouts'] );
                    $og_layouts = $args['layouts'];
                }
                $args['layouts'] = $dark_layouts;
            }
            $output .= get_hsm_post_preview( $args );
            if ( isset( $args['layouts'][0]['color_scheme'] ) ) {
                $args['layouts'] = $og_layouts;
            }
			$output .= '</li>';
        }
		$output .= '</ul>';
    } else {
        $output = '<p>Sorry, no posts matched your criteria.</p>';
    }
    wp_reset_postdata();
    if ( $args['ads'] ) {
        $output = insert_ads( $output, array( 'delimter' => '<li class="post-preview-list-item">', 'repeat_freq' => 3, 'div_class' => $args['ad_class'], 'slot_class' => 'post-preview-list-ad-slot' ) );
    }
    return $output;
}
function hsm_post_preview_loop( $args = '' ){
    echo get_hsm_post_preview_loop( $args );
}
?>