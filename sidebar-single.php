<div class='sidebar-container'>
	<div class='sidebar-start-container'>
		<?php section_nav(get_the_content());
		google_ad( array( 'div_class' => 'sidebar-inline-size-ad', 'ad_class' => 'sidebar-start-ad-1' ) ); ?>
	</div>
	<div class='sidebar-end-container'>
		<aside class='about-the-author sidebar-item'>
			<?php about_the_author(get_the_author_meta('ID')); ?>
		</aside>
		<?php google_ad( array( 'div_class' => 'sidebar-inline-size-ad', 'ad_class' => 'sidebar-end-ad-1' ) ); ?>
		<aside class='recommended sidebar-item'>
			<h2 class='recommended-heading side-bar-item-heading'>Recommended</h2>
			<?php
			hsm_post_preview_loop( array(
				'name' => '',
				'year' => '',
				'monthnum' => '',
				'date_query' => array( array( 'before' => get_the_date() ) ),
				'posts_per_page' => 4,
				'header_level' => 'h3',
				'include' => array( 'image', 'title' ),
				'layouts' => array(
					array(
						'layout_width' => '32em',
						'img_width' => 256,
						'aspect_ratio' => 'landscape'
					),
					array(
						'img_width' => 512,
						'aspect_ratio' => 'landscape'
					)
				)
			) ); ?>
		</aside>
	</div>
</div>