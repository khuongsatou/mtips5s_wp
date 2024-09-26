<?php
/*
Package: Vlogger
*/
// just a small program to create all the social icons
// 
$textdomain = 'vlogger';
$social = array(
    '_beatport',
	'_facebook',
	'_amazon',
	'_blogger',
	'_behance',
	'_bebo',
	'_flickr',
	'_pinterest',
	'_rss',
	'_tiktok',
	'_strava',
	'_triplevision',
	'_tumblr',
	'_twitter',
	'_twitch',
	'_vimeo',
	'_wordpress',
	'_whatpeopleplay',
	'_youtube',
	'_instagram',
	'_soundcloud',
	'_space',
	'_googleplus',
	'_itunes',
	'_juno',
	'_lastfm',
	'_linkedin',
	'_mixcloud',
	'_resident-advisor',
	'_reverbnation'
);
sort($social);
foreach($social as $s){
	$link = get_theme_mod( $textdomain.$s, false );
	if($link){
		echo '<li class="qt-social-link"><a href="'.esc_url($link).'" class="qw-disableembedding qw_social" target="_blank"><i class="qticon-'.str_replace("_","",$s).' qt-socialicon"></i></a></li>';
	}
}

?>
