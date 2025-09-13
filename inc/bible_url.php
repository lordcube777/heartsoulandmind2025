<?php
function get_bible_url( $args ){
    $default_args = array(
        'book' => 'genesis',
        'start_chapter' => 1,
        'start_verse' => 1,
        'translation' =>'esv',
    );
	switch( $args['book'] ) {
    	case 'genesis':
			$book_num = '1';
			break;
		case 'exodus':
			$book_num = '2';
			break;
		case 'leviticus':
			$book_num = '3';
			break;
		case 'numbers':
			$book_num = '4';
			break;
		case 'deuteronomy':
			$book_num = '5';
			break;
		case 'joshua':
			$book_num = '6';
			break;
		case 'judges':
			$book_num = '7';
			break;
		case 'ruth':
			$book_num = '8';
			break;
		case '1-samuel':
			$book_num = '9';
			break;
		case '2-samuel':
			$book_num = '10';
			break;
		case '1-kings':
			$book_num = '11';
			break;
		case '2-kings':
			$book_num = '12';
			break;
		case '1-chronicles':
			$book_num = '13';
			break;
		case '2-chronicles':
			$book_num = '14';
			break;
		case 'ezra':
			$book_num = '15';
			break;
		case 'nehemiah':
			$book_num = '16';
			break;
		case 'esther':
			$book_num = '17';
			break;
		case 'job':
			$book_num = '18';
			break;
		case 'psalms':
			$book_num = '19';
			break;
		case 'proverbs':
			$book_num = '20';
			break;
		case 'ecclesiastes':
			$book_num = '21';
			break;
		case 'song-of-solomon':
		case 'song-of-songs':
			$book_num = '22';
			break;
		case 'isaiah':
			$book_num = '23';
			break;
		case 'jeremiah':
			$book_num = '24';
			break;
		case 'lamentations':
			$book_num = '25';
			break;
		case 'ezekiel':
			$book_num = '26';
			break;
		case 'daniel':
			$book_num = '27';
			break;
		case 'hosea':
			$book_num = '28';
			break;
		case 'joel':
			$book_num = '29';
			break;
		case 'amos':
			$book_num = '30';
			break;
		case 'obadiah':
			$book_num = '31';
			break;
		case 'jonah':
			$book_num = '32';
			break;
		case 'micah':
			$book_num = '33';
			break;
		case 'nahum':
			$book_num = '34';
			break;
		case 'habakkuk':
			$book_num = '35';
			break;
		case 'zephaniah':
			$book_num = '36';
			break;
		case 'haggai':
			$book_num = '37';
			break;
		case 'zechariah':
			$book_num = '38';
			break;
		case 'malachi':
			$book_num = '39';
			break;
		case 'matthew':
			$book_num = '61';
			break;
		case 'mark':
			$book_num = '62';
			break;
		case 'luke':
			$book_num = '63';
			break;
		case 'john':
			$book_num = '64';
			break;
		case 'acts':
			$book_num = '65';
			break;
		case 'romans':
			$book_num = '66';
			break;
		case '1-corinthians':
			$book_num = '67';
			break;
		case '2-corinthians':
			$book_num = '68';
			break;
		case 'galatians':
			$book_num = '69';
			break;
		case 'ephesians':
			$book_num = '70';
			break;
		case 'philippians':
			$book_num = '71';
			break;
		case 'colossians':
			$book_num = '72';
			break;
		case '1-thessalonians':
			$book_num = '73';
			break;
		case '2-thessalonians':
			$book_num = '74';
			break;
		case '1-timothy':
			$book_num = '75';
			break;
		case '2-timothy':
			$book_num = '76';
			break;
		case 'titus':
			$book_num = '77';
			break;
		case 'philemon':
			$book_num = '78';
			break;
		case 'hebrews':
			$book_num = '79';
			break;
		case 'james':
			$book_num = '80';
			break;
		case '1-peter':
			$book_num = '81';
			break;
		case '2-peter':
			$book_num = '82';
			break;
		case '1-john':
			$book_num = '83';
			break;
		case '2-john':
			$book_num = '84';
			break;
		case '3-john':
			$book_num = '85';
			break;
		case 'jude':
			$book_num = '86';
			break;
		case 'revelation':
			$book_num = '87';
			break;
	}
	switch( $args['translation'] ) {
		case 'esv':
			$lls = '1.0.710';
		case 'nasb':
		case 'nasb2020':
			$lls = 'NASB2020';
			$args['translation'] = 'nasb95';
			break;
		case 'niv':
		case 'niv2011':
			$lls = 'NIV2011';
			if ( $args['translation'] == 'niv2011' ) {
				$args['translation'] = 'niv';
			}
			break;
		case 'nlt':
			$lls = '1.0.171';
			break;
		case 'nrsv':
			$lls = '1.0.50';
			break;
	}
	$args = wp_parse_args( $args, $default_args );
    return "https://app.logos.com/books/LLS:$lls/references/bible+$args[translation].$book_num.$args[start_chapter].$args[start_verse]/";
}