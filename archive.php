<?php
add_action( 'wp_enqueue_scripts', 'enqueue_archive_style' );
get_header(); ?>
<main class="main-content">
	<h1><?php wp_title(); ?></h1>
	<?php hsm_post_preview_loop();
	hsm_paginate_links(); ?>
</main>
<?php get_footer(); ?>