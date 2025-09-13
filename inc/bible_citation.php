<?php
function enqueue_bible_citation_style() {
	wp_enqueue_style( 'bible_citation', get_theme_file_uri( 'css/bible-citation.css' ) );
}
add_shortcode( 'bible_citation', 'get_bible_citation' );
function bible_citation( $args ){
	echo get_bible_citation( $args );
}
function scripture_citation( $args ){
	echo get_bible_citation( $args );
}
function get_scripture_citation( $args ){
	return get_bible_citation( $args );
}
function get_bible_citation( $args ) {
	$default_args = array(
		'book' => 'genesis',
		'start_chapter' => '',
		'end_chapter' => null,
		'start_verse' => '',
		'end_verse' => null,
		'translation' => 'esv',
		'display_translation' => false,
		'url' => ''
	);
	$args = shortcode_atts( $default_args, $args );
	$args = wp_parse_args( $args, $default_args );
	switch( $args['book'] ){
		case 'genesis':
			$book_display = 'Genesis';
			break;
		case 'exodus':
			$book_display = 'Exodus';
			break;
		case 'leviticus':
			$book_display = 'Leviticus';
			break;
		case 'numbers':
			$book_display = 'Numbers';
			break;
		case 'deuteronomy':
			$book_display = 'Deuteronomy';
			break;
		case 'joshua':
			$book_display = 'Joshua';
			break;
		case 'judges':
			$book_display = 'Judges';
			break;
		case 'ruth':
			$book_display = 'Ruth';
			break;
		case '1-samuel':
			$book_display = '1 Samuel';
			break;
		case '2-samuel':
			$book_display = '2 Samuel';
			break;
		case '1-kings':
			$book_display = '1 Kings';
			break;
		case '2-kings':
			$book_display = '2 Kings';
			break;
		case '1-chronicles':
			$book_display = '1 Chronicles';
			break;
		case '2-chronicles':
			$book_display = '2 Chronicles';
			break;
		case 'ezra':
			$book_display = 'Ezra';
			break;
		case 'nehemiah':
			$book_display = 'Nehemiah';
			break;
		case 'esther':
			$book_display = 'Esther';
			break;
		case 'job':
			$book_display = 'Job';
			break;
		case 'psalms':
			$book_display = 'Psalms';
			break;
		case 'proverbs':
			$book_display = 'Proverbs';
			break;
		case 'ecclesiastes':
			$book_display = 'Ecclesiastes';
			break;
		case 'song-of-solomon':
		case 'song-of-songs':
			switch( $args['translation'] ) {
				case 'esv':
				case 'nasb':
				case 'nasb2020':
					$book_display = 'Song of solomon';
				case 'niv':
				case 'niv2011':
				case 'nlt':
					$book_display = 'Song of Songs';
			}
			break;
		case 'isaiah':
			$book_display = 'Isaiah';
			break;
		case 'jeremiah':
			$book_display = 'Jeremiah';
			break;
		case 'lamentations':
			$book_display = 'Lamentations';
			break;
		case 'ezekiel':
			$book_display = 'Ezekiel';
			break;
		case 'daniel':
			$book_display = 'Daniel';
			break;
		case 'hosea':
			$book_display = 'Hosea';
			break;
		case 'joel':
			$book_display = 'Joel';
			break;
		case 'amos':
			$book_display = 'Amos';
			break;
		case 'obadiah':
			$book_display = 'Obadiah';
			break;
		case 'jonah':
			$book_display = 'Jonah';
			break;
		case 'micah':
			$book_display = 'Micah';
			break;
		case 'nahum':
			$book_display = 'Nahum';
			break;
		case 'habakkuk':
			$book_display = 'Habakkuk';
			break;
		case 'zephaniah':
			$book_display = 'Zephaniah';
			break;
		case 'haggai':
			$book_display = 'Haggai';
			break;
		case 'zechariah':
			$book_display = 'Zechariah';
			break;
		case 'malachi':
			$book_display = 'Malachi';
			break;
		case 'matthew':
			$book_display = 'Matthew';
			break;
		case 'mark':
			$book_display = 'Mark';
			break;
		case 'luke':
			$book_display = 'Luke';
			break;
		case 'john':
			$book_display = 'John';
			break;
		case 'acts':
			$book_display = 'Acts';
			break;
		case 'romans':
			$book_display = 'Romans';
			break;
		case '1-corinthians':
			$book_display = '1 Corinthians';
			break;
		case '2-corinthians':
			$book_display = '2 Corinthians';
			break;
		case 'galatians':
			$book_display = 'Galatians';
			break;
		case 'ephesians':
			$book_display = 'Ephesians';
			break;
		case 'philippians':
			$book_display = 'Philippians';
			break;
		case 'colossians':
			$book_display = 'Colossians';
			break;
		case '1-thessalonians':
			$book_display = '1 Thessalonians';
			break;
		case '2-thessalonians':
			$book_display = '2 Thessalonians';
			break;
		case '1-timothy':
			$book_display = '1 Timothy';
			break;
		case '2-timothy':
			$book_display = '2 Timothy';
			break;
		case 'titus':
			$book_display = 'Titus';
			break;
		case 'philemon':
			$book_display = 'Philemon';
			break;
		case 'hebrews':
			$book_display = 'Hebrews';
			break;
		case 'james':
			$book_display = 'James';
			break;
		case '1-peter':
			$book_display = '1 Peter';
			break;
		case '2-peter':
			$book_display = '2 Peter';
			break;
		case '1-john':
			$book_display = '1 John';
			break;
		case '2-john':
			$book_display = '2 John';
			break;
		case '3-john':
			$book_display = '3 John';
			break;
		case 'jude':
			$book_display = 'Jude';
			break;
		case 'revelation':
			$book_display = 'Revelation';
			break;
	}
	if ( "$args[start_chapter]" ) {
		if ( "$args[end_chapter]" ) {
			if ( "$args[start_verse]" ) {
				$span = "<cite class='bible'>$book_display</cite> $args[start_chapter]:$args[start_verse]–$args[end_chapter]:$args[end_verse]";
			} else {
				$args['start_verse'] = '1';
				$span = "<cite class='bible'>$book_display</cite> $args[start_chapter]–$args[end_chapter]";
			}
		} else if ( "$args[start_verse]" ) {
			if ( "$args[end_verse]" ) {
				$verse = "$args[start_verse]–$args[end_verse]";
			} else {
				$verse = "$args[start_verse]";
			}
			$span = "<cite class='bible'>$book_display</cite> $args[start_chapter]:$verse";
		} else {
			$args['start_verse'] = '1';
			$span = "<cite class='bible'>$book_display</cite> $args[start_chapter]";
		}
	} else {
		$args['start_chapter'] = '1';
		$args['start_verse'] = '1';
		$span = "<cite class='bible'>$book_display</cite>";
	}
	if ( $args['display_translation'] ) {
		switch( $args['translation'] ){
			case 'esv':
				$translation_display = "<dfn><abbr class='translation-abbr' title='English Standard Version'>ESV</abbr></dfn>";
				break;
			case 'nasb':
			case 'nasb2020':
				$args['translation'] = 'nasb95';
				$translation_display = "<dfn><abbr class='translation-abbr' title='New American Standard Bible 2020'>NASB</abbr></dfn>";
				break;
			case 'niv':
			case 'niv2011':
				$translation_display = "<dfn><abbr class='translation-abbr' title='New International Version 2011'>NIV</abbr></dfn>";
				break;
			case 'nlt':
				$translation_display = "<dfn><abbr class='translation-abbr' title='New Living Translation'>NLT</abbr></dfn>";
				break;
			case 'nrsv':
				$translation_display = "<dfn><abbr class='translation-abbr' title='New Revised Standard Version'>NRSV</abbr></dfn>";
				break;
		}
		$span = "$span $translation_display";
	}
	$output = '<a class="bible-citation-link" target="_blank" rel="external" href="';
	if ( !$args['url'] ) {
		$output .= get_bible_url( array(
			'book' => $args['book'],
			'start_chapter' => $args['start_chapter'],
			'start_verse' => $args['start_verse'],
			'translation' => $args['translation']
		) );
	} else {
		$output .= $args['url'];
	}
	$output .= '">';
	$output .= '<span class=bible-citation-text>' . $span . '</span>';
	$output .= '</a>';
	return "$output";
}