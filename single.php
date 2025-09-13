<?php
add_action( 'wp_enqueue_scripts', 'enqueue_single_styles' );
function enqueue_single_styles() {
	wp_enqueue_style( 'single', get_theme_file_uri( 'css/single.css' ) );
	enqueue_hsm_post_meta_style();
	enqueue_sidebar_style();
	enqueue_footnotes_style();
	enqueue_bible_citation_style();
	enqueue_post_tags_list_style();
}
$layouts = array(
	array(
		'img_width' => 1024,
		'layout_width' => '48em',
		'aspect_ratio' => 'landscape'
	),
	array(
		'img_width' => 768,
		'layout_width' => '32em',
		'aspect_ratio' => 'landscape'
	),
	array(
		'img_width' => 512
	)
);
if ( get_post_meta($post->ID, 'dark_mode', true) ) {
	$layouts = add_dark_color_scheme( $layouts );
}
get_header(); ?>
<main class="main-content">
	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<nav class="breadcrumbs"><p>','</p></nav>' );
	}?>
	<?php
	google_ad( array( 'div_class' => 'main-content-ad-slot-1 site-inline-size-ad' ) );
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();?>
			<article class="main-post">
				<header class="post-header">
					<hgroup class="post-heading-group">
						<h1 class="post-title"><?php the_title(); ?></h1>
						<p class="post-subtitle"><?php echo get_post_meta($post->ID, 'subtitle', true) ?></p>
					</hgroup>
					<?php hsm_post_meta();?>
					<?php picture_element( array(
						'img_class' => 'post-header-img',
						'layouts' => $layouts
					) );
					if ( get_post_meta($post->ID, 'post_img_attribution', true) ) {
						echo "<p class='attribution'>" . get_post_meta($post->ID, 'post_img_attribution', true) . "</p>";
					}
					?>
				</header>
				<?php get_sidebar( 'single' ); ?>
				<div class="post-content">
				<?php the_content(); ?>
				</div>
				<?php footnotes(); ?>
			</article>
		<?php }
	}
	?>
	<aside class='section-lvl-1 further-reading'>
		<h2 class='further-reading-heading'>Further reading</h2>
		<p class='further-reading-text body-text'>To read more like this post checkout these topics.</p>
		<?php post_tags_list(); ?>
	</aside>
	<?php google_ad( array( 'div_class' => 'main-content-ad-slot-1 site-inline-size-ad' ) ); ?>
	<?php //if ( comments_open() || get_comments_number() ) :
	// comments_template();
	// endif;
	?>
</main>
<?php get_footer(); ?>
