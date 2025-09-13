<?php get_header(); ?>
<main class="main-content">
	<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			the_content();
		};
		if ( get_next_posts_link() ) {
		next_posts_link();
		}
		if ( get_previous_posts_link() ) {
			previous_posts_link();
		} else {
		echo '<p>No posts found.</p>';
		}
	}; ?>
</main>
<?php get_footer(); ?>
