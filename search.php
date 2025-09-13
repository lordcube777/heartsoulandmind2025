<?php
add_action( 'wp_enqueue_scripts', 'enqueue_archive_style' );
get_header() ?>
<main class='main-content'>
   <h1>Search results for: <?php the_search_query(); ?></h1>
   <section id='search' class='anchor section-lvl-1'
   <?php hsm_search_form(); ?>
   </section>
   <section id='search-results' class='anchor section-lvl-1'>
      <?php hsm_post_preview_loop();
      hsm_paginate_links(); ?>
   </section>
</main>
<?php get_footer() ?>