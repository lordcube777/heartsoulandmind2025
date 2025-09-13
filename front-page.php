<?php
add_action( 'wp_enqueue_scripts', 'enqueue_front_page_style' );
function enqueue_front_page_style() {
	wp_enqueue_style( 'front-page', get_theme_file_uri( 'css/front-page.css' ) );
	enqueue_hsm_post_preview_loop_style();
	enqueue_hsm_post_preview_loop_block_style();
}
$args = array(
	'preload' => 'only',
	'ext' => array( 'webp' ),
	'img' => get_theme_file_uri('/assets/images/front-page/hero/front-page-hero'),
	'layouts' => array(
		array(
			'aspect_ratio' => 'super-ultrawide',
			'img_width' => 2048,
			'layout_width' => '96em',
			'widths' => array( 2048, 3072, 4096 )
		)
	)
);
add_action( 'wp_head', function() use ( $args ) {
	picture_element( $args );	
} );
$args = array(
	'preload' => 'only',
	'ext' => array( 'avif' ),
	'img' => get_theme_file_uri('/assets/images/front-page/hero/front-page-hero'),
	'layouts' => array(
		array(
			'aspect_ratio' => 'ultrawide',
			'img_width' => 1536,
			'layout_width' => '64em',
			'widths' => array( 1536, 2048 )
		),
		array(
			'aspect_ratio' => 'landscape',
			'img_width' => 1024,
			'layout_width' => '32em',
			'widths' => array( 1024, 1536, 2048 )
		),
		array(
			'aspect_ratio' => 'portrait-short',
			'img_width' => 512,
			'widths' => array( 512, 768, 1024, 1536, 2048 )
		)
	)
);
add_action( 'wp_head', function() use ( $args ) {
	picture_element( $args );
} );
get_header();
?>
<main class='main-content'>
<section class="section-lvl-1 front-page-hero">
	<h2>Faith Meets Creativity</h2>
	<div class="front-page-hero-container">
		<p class="tagline headline-1">Real Faith<br>For Real Life</p>
	</div>
</section>
	<section id="about-us" class='section-lvl-1 front-page-about'>
		<h2 class='screen-reader-only'>About Us</h2>
		<div class='about-us-container'>
			<div class='about-us-text-container'>
				<p class='headline-4'>Welcome</em></p>
				<p class='about-us-bio'>We are Andrew and Nicole. We are Christian writers and artists in Central Florida. Our passion is to love God with all our heart, soul, and mind. We desire real faith for real life. Join us as we encourage one another in our walk with Jesus.</p>
				<?php hsm_button( array (
					'text' => 'About Us',
					'link' => get_internal_link(array( 'type' => 'page', 'slug' => 'about', 'html' => false ))
				) ); ?>
			</div>
		</div>
	</section>
	<?php google_ad(); ?>
	<section class='section-lvl-1 front-page-social'>
		<h2>Follow Us on Social Media</h2>
		<ul class='front-page-social-list'>
			<li class='front-page-social-list-item front-page-social-facebook'>
				<?php hsm_button( array('class' => 'front-page-social-facebook-link', 'text' => 'Facebook', 'link' => 'https://www.facebook.com/profile.php?id=61559870986355', 'icon' => svg_service('facebook') ) ); ?>
			</li>
			<li class='front-page-social-list-item front-page-social-instagram'>
				<?php hsm_button( array('class' => 'front-page-social-instagram-link', 'text' => 'Instagram', 'link' => 'https://www.instagram.com/heartsoulandmind0/', 'icon' => svg_service('instagram') ) ); ?>
			</li>
			<li class='front-page-social-list-item front-page-social-youtube'>
				<?php hsm_button( array('class' => 'front-page-social-youtube-link', 'text' => 'YouTube', 'link' => 'https://www.youtube.com/channel/UCYaa7fefznYU03mXzVZsG3g', 'icon' => svg_service('youtube') ) ); ?>
			</li>
		</ul>
	</section>
	<section class='section-lvl-1 front-page-latest-post'>
		<h2>Latest Post</h2>
		<?php
			hsm_post_preview_loop( array (
				'header_level' => 'h3',
				'posts_per_page' => 4,
				'layouts' => array(
					array(
						'layout_width' => '32em',
						'img_width' => 256,
					),
					array(
						'img_width' => 512
					)
				)
			) );
		?>
	</section>
	<?php google_ad(); ?>
</main>
<?php get_footer(); ?>