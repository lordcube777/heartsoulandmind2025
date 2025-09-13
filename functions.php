<?php
add_action('init', 'shortcodes_init');
function shortcodes_init(){
	add_shortcode( 'file_download_link', 'get_file_download_link' );
	add_shortcode( 'greek_text', 'get_translit' );
	add_shortcode( 'hebrew_text', 'get_translit' );
	add_shortcode( 'internal_link', 'get_internal_link' );
	add_shortcode( 'youtube_embed', 'get_youtube_embed' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_hsm_2025_stylesheet' );
function enqueue_hsm_2025_stylesheet() {
	wp_enqueue_style( 'hsm-2025', get_stylesheet_uri() );
	wp_enqueue_style( 'header', get_theme_file_uri( 'css/header.css' ) );
	wp_enqueue_style( 'search', get_theme_file_uri( 'css/search_form.css' ) );
	wp_enqueue_style( 'advertisement', get_theme_file_uri( 'css/advertisement.css'));
	wp_enqueue_style( 'footer', get_theme_file_uri( 'css/footer.css'));
}
function enqueue_archive_style() {
	wp_enqueue_style( 'archive', get_theme_file_uri( 'css/archive.css' ) );
	enqueue_hsm_post_preview_loop_style();
	enqueue_hsm_post_preview_loop_inline_style();
	enqueue_hsm_paginate_links_style();
}
function enqueue_sidebar_style() {
	wp_enqueue_style( 'sidebar-single', get_theme_file_uri( 'css/sidebar.css' ) );
	enqueue_about_the_author_style();
	enqueue_section_nav_style();
	enqueue_hsm_post_preview_loop_style();
}
add_filter( 'big_image_size_threshold', '__return_false' );
remove_filter( 'the_content', 'wpautop' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'widgets' );
add_theme_support( 'yoast-seo-breadcrumbs' );

include get_theme_file_path( 'inc/add_dark_color_scheme.php');
include get_theme_file_path( 'inc/bible_citation.php' );
include get_theme_file_path( 'inc/bible_quote.php' );
include get_theme_file_path( 'inc/bible_url.php' );
include get_theme_file_path( 'inc/disable-gutenberg.php');
include get_theme_file_path( 'inc/disable_emoji.php');
include get_theme_file_path( 'inc/disable_rss.php');
include get_theme_file_path( 'inc/disable_image_generation.php');
include get_theme_file_path( 'inc/file_download_link.php');
include get_theme_file_path( 'inc/insert_ads.php');
include get_theme_file_path( 'inc/internal_link.php');
include get_theme_file_path( 'inc/quote.php');
include get_theme_file_path( 'inc/svg-service.php' );
include get_theme_file_path( 'inc/tetragrammaton.php' );
include get_theme_file_path( 'inc/transliterate.php' );
include get_theme_file_path( 'inc/youtube_embed.php' );
include get_theme_file_path( 'parts/about_the_author.php');
include get_theme_file_path( 'parts/category_list.php');
include get_theme_file_path( 'parts/footnotes.php');
include get_theme_file_path( 'parts/google_ad.php');
include get_theme_file_path( 'parts/hsm_button.php');
include get_theme_file_path( 'parts/hsm_comment.php');
include get_theme_file_path( 'parts/hsm_paginate_links.php');
include get_theme_file_path( 'parts/hsm_post_meta.php');
include get_theme_file_path( 'parts/hsm_post_preview.php');
include get_theme_file_path( 'parts/hsm_post_preview_loop.php');
include get_theme_file_path( 'parts/hsm_search_form.php');
include get_theme_file_path( 'parts/media_text.php');
include get_theme_file_path( 'parts/my_post_queries.php');
include get_theme_file_path( 'parts/picture_element.php' );
include get_theme_file_path( 'parts/post_tags_list.php');
include get_theme_file_path( 'parts/section_nav.php');
