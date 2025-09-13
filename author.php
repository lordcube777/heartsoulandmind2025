<?php
add_action( 'wp_enqueue_scripts', 'enqueue_author_style' );
function enqueue_author_style() {
	wp_enqueue_style( 'author', get_theme_file_uri( 'css/author.css' ) );
	enqueue_hsm_post_preview_loop_style();
	enqueue_hsm_post_preview_loop_block_style();
}
$nicename = get_the_author_meta('user_nicename');
$first_name = get_the_author_meta('first_name');
get_header(); ?>
<main class="main-content">
	<?php google_ad( array( 'div_class' => 'site-inline-size-ad main-content-ad-slot-1' ) ) ; ?>
	<section class="author-bio <?php $nicename?>-bio">
		<?php picture_element(array(
			'type' => 'profile_picture',
			'layouts' => array(
				array(
					'img_width' => 512,
					'color_scheme' => 'dark',
					'aspect_ratio' => 'portrait-short'
				),
				array(
					'img_width' => 512,
					'color_scheme' => 'light',
					'aspect_ratio' => 'portrait-short'
				)
			),
		) ); ?>
		<div class="author-bio-text <?php echo $nicename?>-bio-text">
			<h2 class="author-bio-heading"><em>Hi, my name is <?php echo $first_name ?></em></h2>
			<?php
			$the_query = new WP_Query( array( 'pagename' => "author/$nicename" ) );
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					the_content();
				}
			}
			wp_reset_postdata();
			?>
		</div>
	</section>
	<?php google_ad( array( 'div_class' => 'site-inline-size-ad main-content-ad-slot-2' ) ) ; ?>
	<section class="recent-post">
		<h2 class="recent-post-heading">Recent Post by <?php echo $first_name ?></h2>
		<?php
			hsm_post_preview_loop( array(
				'author_name' => "$nicename",
				'posts_per_page' => 4,
				'header_level' => 'h3'
			) );
		?>
	</section>
	<?php google_ad( array( 'div_class' => 'site-inline-size-ad main-content-ad-slot-3' ) ) ; ?>
</main>
<?php get_footer(); ?>
