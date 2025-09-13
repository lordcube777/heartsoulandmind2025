<?php
function category_list() {
	echo get_category_list();
}
function get_category_list(){
	$category_terms = get_categories();
	$output = '<ul class="category-list">';
	foreach ( $category_terms as $category_term ) {
		$name = $category_term->name;
		$slug = $category_term->slug;
		$url = get_term_link( $category_term );
		$output .= "<li class='category-list-item'>";
		if ( $slug == 'bible-study' ) {
			$icon = 'bible-solid';
		} elseif ( $slug == 'poetry') {
			$icon = 'quill-solid';
		} elseif ( $slug == 'self-improvement' ) {
			$icon = 'seedling-solid';
		}
		$output .= get_hsm_button( array(
			'text' => "$name",
			'icon' => svg_service( $icon, 'category-item-icon' ),
			'class' => 'category-item-link',
			'link' => "$url"
		) );
		$output .= '</li>';
	}
	$output .= '</ul>';
	return $output;
}