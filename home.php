<?php
add_action( 'wp_enqueue_scripts', 'enqueue_home_style' );
function enqueue_home_style() {
	wp_enqueue_style( 'home', get_theme_file_uri( 'css/home.css' ) );
	enqueue_archive_style();
}
get_header(); ?>
<main class='main-content'>
	<h1><?php wp_title(); ?></h1>
	<?php
	if ( get_query_var('paged') == 0 ) { ?>
		<section id="featured-post" class='section-lvl-1 home-featured-post'>
			<h2 class='home-featured-post-heading screen-reader-only'>Featured Post</h2>
			<?php hsm_post_preview_loop( array(
				'posts_per_page' => 1,
				'post__in' => get_option( 'sticky_posts' ),
				'type' => 'figure',
				'layouts' => array(
					array(
						'aspect_ratio' => 'landscape',
						'layout_width' => '48em',
						'img_width' => 1024
					),
					array (
						'aspect_ratio' => 'portrait-short',
						'layout_width' => '32em',
						'img_width' => 768
					),
					array ( 'aspect_ratio' => 'portrait-tall' )
				) )
			); ?>
		</section>
		<?php google_ad( array( 'div_class' => 'main-content-ad-slot-1 site-inline-size-ad' ) ); ?>
		<section id="category" class='section-lvl-1 home-categories'>
		<h2 class='home-categories-heading'>Explore these topics</h2>
		<?php category_list(); ?>
		</section>
	<?php } ?>
	<section id="latest-post" class='section-lvl-1 home-latest-post'>
		<h2 class='home-latest-post-heading'>Latest Post</h2>
		<?php hsm_post_preview_loop( array( 'header_level' => 'h3', 'ads' => true, 'ad_class' => 'site-inline-size-ad' ) );
		hsm_paginate_links(); ?>
	</section>
</main>
<?php get_footer(); ?>