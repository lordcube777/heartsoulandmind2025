<?php
/**
 * Returns a link to a link to CDB product page by ISBN
 * @return string Link to page
 */
add_shortcode( 'cbd_isbn_dynamic_link', 'cbd_isbn_dynamic_link' );
function cbd_isbn_dynamic_link_init() {
	function cbd_isbn_dynamic_link( $atts ) {
		$atts = shortcode_atts(
			array(
				'isbn' => '',
				'stock_num' => ''
			), $atts );
		if ( $atts['isbn'] ) {
			$output = '<div class="affiliate-link"><a href="https://www.christianbook.com/Christian/Books/product?isbn=' . esc_html( $atts['isbn'] ) . '&amp;event=AFF&amp;p=1235840"><img src="https://ag.christianbook.com/dg/product/ingram/b108/' . esc_html($atts['stock_num']) . '.gif"/> <img src="https://ag.christianbook.com/g/affiliate/cbd_small.png"> [affiliate link]</a></div>';
		} else {
			$output = '<div class="affiliate-link"><a href="https://www.christianbook.com/Christian/Books/home?event=AFF&p=1235840"><img src="https://ag.christianbook.com/g/affiliate/cbd_small.png"></a></div>';
		}
		return $output;
	}
}