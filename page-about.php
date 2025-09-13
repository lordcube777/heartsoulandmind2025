<?php
add_action( 'wp_enqueue_scripts', 'enqueue_about_style' );
function enqueue_about_style(){
	wp_enqueue_style( 'hsm-about', get_theme_file_uri( 'css/about.css' ) );
}
get_header(); ?>
<main class='main-content'>
	<?php if ( have_posts() ) {
		while ( have_posts() ) {
			the_post(); ?>
			<article class='main-article'>
				<header class='main-article-header'>
					<?php the_title( "<h1 class='main-article-heading'>", "</h1>" ); ?>
				</header>
				<?php //get_sidebar( 'about' ); ?>
				<div class="main-article-content">
					<section id='our-desire' class='anchor section-lvl-1'>
						<h2>Our Desire</h2>
						<section id='desire-statement' class='anchor section-lvl-2'>
							<h3 class='desire-statement-heading'>Desire Statement</h3>
							<div class='desire-statement-container image-text-container'>
								<div class='desire-statement-headline-container text-container'>
									<p class='desire-statement headline-1'>Loving God Others and Self<br>With Heart Soul and Mind</p>
								</div>
							</div>
						</section>
						<?php google_ad( array( 'div_class' => 'site-inline-size-ad main-article-ad-slot-1' ) ) ; ?>
						<section id='introduction' class='anchor section-lvl-2'>
							<h3 class='introduction-heading'>Introduction</h3>
							<div class='introduction-container image-text-container'>
								<div class='introduction-headline-container text-container'>
									<p class='introduction-headline headline-2'>Hi, we are Andrew and Nicole</p>
								</div>
							</div>
							<p class='introduction-body body-text'>We are Christian writers and artists. Our desire is to love God, others, and ourselves as a part of our everyday lives.</p>
						</section>
						<section id='heart-soul-and-mind' class='anchor section-lvl-2'>
							<h3 class='heart-soul-and-mind-heading'>Heart, soul and, mind</h3>
							<div class='heart-soul-and-mind-container image-text-container'>
								<div class='heart-soul-and-mind-headline-container text-container'>
									<p class='heart-soul-and-mind-headline headline-2'>Loving with Heart Soul and Mind</p>
								</div>
							</div>
							<p class='heart-soul-and-mind-text body-text'>Jesus tells us that the greatest thing we can do is to love God with all of our heart, soul and mind, and love others like we love ourselves. This means we look for ways to honor God with all we say, think, and do. God is good, and we want his love to flow into and through every part of our lives.</p>
						</section>
						<?php google_ad( array( 'div_class' => 'site-inline-size-ad main-article-ad-slot-2' ) ) ; ?>
						<section id='genuine-love' class='anchor section-lvl-2'>
							<h3 class='genuine-love-heading'>Genuine Love</h3>
							<div class='genuine-love-container image-text-container'>
								<div class='genuine-love-headline-container text-container'>
									<p class='genuine-love-headline headline-2'>A Love That Is Real</p>
								</div>
							</div>
							<p class='genuine-love-text body-text'>We desire a genuine love that overflows from a personal relationship with Jesus, and not from duty or obligation. God is love, he loved us first, and now we are to love.</p>
						</section>
						<section id='real-faith-for-real-life' class='anchor section-lvl-2'>
							<h3 class='real-faith-for-real-life-heading'>Real Faith for Real Life</h3>
							<div class='real-faith-for-real-life-container image-text-container'>
								<div class='real-faith-for-real-life-headline-container text-container'>
									<p class='real-faith-for-real-life-headline headline-2'>Real Faith for Real Life</p>
								</div>
							</div>
							<p class='real-faith-for-real-life-text body-text'>Life is messy, and we are not perfect. Loving God, others, and ourselves is challenging. But, God is faithful and shows us grace. Life and faith are processes of growth. Rather than perfection, we desire grace and growth as a part of our everyday lives. Mature love lets go of fear.</p>
						</section>
					</section>
					<?php google_ad( array( 'div_class' => 'site-inline-size-ad main-content-ad-slot-1' ) ) ; ?>
					<section id='values' class='anchor section-lvl-1'>
						<h2 class='value-heading'>Values</h3>
						<p class='values-introduction body-text'>These are some of the values which we try to center our lives around as individuals and as a couple. They are listed in alphabetical order because we see them as being equally important; just in different ways and at different times.</p>
						<ul class='values-list'>
							<li class='community-list-item values-list-item'>
								<div class='community-heading-container value-heading-container'>
									<?php echo svg_service('users-solid', 'community-icon value-icon') ?>
									<h3 class='community-heading value-heading'>Community</h3>
								</div>
								<p class='community-text value-text'>God is three-in-one, and He did not make us to go through life alone.</p>
							</li>
							<li class='creativity-list-item values-list-item'>
								<div class='creativity-heading-container value-heading-container'>
									<?php echo svg_service('palette-solid', 'creativity-icon value-icon') ?>
									<h3 class='creativity-heading value-heading'>Creativity</h3>
								</div>
								<p class='creativity-text value-text'>When we encounter God, our imaginations are left full of creative ways to express what we think and feel.</p>
							</li>
							<li class='family-list-item values-list-item'>
								<div class='family-heading-container value-heading-container'>
									<?php echo svg_service('person-breastfeeding', 'family-icon value-icon') ?>
									<h3 class='family-heading value-heading'>Family</h3>
								</div>
									<p class='family-text value-text'>God is a good father. We are apart of his family, and our families reflect him.</p>
							</li>
							<li class='growth-list-item values-list-item'>
								<div class='growth-heading-container value-heading-container'>
									<?php echo svg_service('seedling-solid', 'growth-icon value-icon') ?>
									<h3 class='growth-heading value-heading'>Growth</h3>
								</div>
									<p class='growth-text value-text'>God is unchanging, but he is always active. He is constantly causing us to grow in heart, mind, and soul.</p>
							</li>
							<li class='harmony-list-item values-list-item'>
								<div class='harmony-heading-container value-heading-container'>
									<?php echo svg_service('dove-solid', 'harmony-icon value-icon') ?>
									<h3 class='harmony-heading value-heading'>Harmony</h3>
								</div>
									<p class='harmony-text value-text'>Not only should we strive to live at peace with others, but we strive for peace within ourselves.</p>
							</li>
							<li class='reverence-list-item values-list-item'>
								<div class='reverence-heading-container value-heading-container'>
									<?php echo svg_service('person-praying-solid', 'reverence-icon value-icon') ?>
									<h3 class='reverence-heading value-heading'>Reverence</h3>
								</div>
									<p class='reverence-text value-text'>The fear of the Lord is the beginning of wisdom. God is almighty and He deserves respect.</p>
							</li>
							<li class='thoughtfulness-list-item values-list-item'>
								<div class='thoughtfulness-heading-container value-heading-container'>
									<?php echo svg_service('thought-cloud-solid', 'thoughtfulness-icon value-icon') ?>
									<h3 class='thoughtfulness-heading value-heading'>Thoughtfulness</h3>
								</div>
									<p class='thoughtfulness-text value-text'>Balancing skill, feelings, and intention, We are never mindless or half-hearted with our creations.</p>
							</li>
							<li class='truth-list-item values-list-item'>
								<div class='truth-heading-container value-heading-container'>
									<?php echo svg_service('bible-solid', 'truth-icon value-icon') ?>
									<h3 class='truth-heading value-heading'>Truth</h3>
								</div>
									<p class='truth-text value-text'>We believe in absolute truth. We don't believe in relativism. Truth is at the core of all we create. We seek the one who is the way, the truth, and the life.</p>
							</li>
						</ul>
					</section>
					<?php google_ad( array( 'div_class' => 'site-inline-size-ad main-content-ad-slot-2' ) ) ; ?>
				</div>
			</article>
		<?php }
	} ?>
</main>
<?php get_footer(); ?>
