<?php
function enqueue_hsm_paginate_links_style() {
	wp_enqueue_style( 'paginate_links', get_theme_file_uri( 'css/paginate_links.css' ) );
}
function get_hsm_paginate_links() {
	return '<nav class="paginate-links">' . paginate_links( array( 'mid_size' => 5, 'prev_text' => 'Prev', 'next_text' => 'Next', 'type' => 'list' ) ) . '</nav>';
}
function hsm_paginate_links(){
	echo get_hsm_paginate_links();
}
