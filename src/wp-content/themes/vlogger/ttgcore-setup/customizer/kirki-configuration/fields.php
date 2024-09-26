<?php  
/**
 * Create customizer fields for the kirki framework.
 * @package Kirki
 */




Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => 'vlogger_general_section',
	'settings'    => 'vlogger_mod_lazyload', // this has to be like the main
	'label'       => esc_html__( 'Lazy load deferred pictures loading', "vlogger" ),
));




Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => 'vlogger_general_section',
	'settings'    => 'vlogger_mod_parallax', // this has to be like the main
	'label'       => esc_html__( 'Parallax headers', "vlogger" ),
));

/* = Interactions POST
=============================================*/

$sections = array(
	'vlogger_reaktions_mods_posts',
	'vlogger_reaktions_mods_pages',
	'vlogger_reaktions_mods_videos',
	'vlogger_reaktions_mods_tutorials',
	'vlogger_reaktions_mods_series',
	);

foreach ($sections as $section){
	Kirki::add_field( 'vlogger_config', array(
	   	'type'        => 'switch',
	   	'section'     => $section,
		'settings'    => $section.'_headerdata', // this has to be like the main
		'label'       => esc_html__( 'Add ReAktions data to header', "vlogger" ),
	));
	Kirki::add_field( 'vlogger_config', array(
	   	'type'        => 'switch',
	   	'section'     =>  $section,
		'settings'    =>  $section.'_beforecontent', // this has to be like the main
		'label'       => esc_html__( 'Add ReAktions before content', "vlogger" ),
	));
	Kirki::add_field( 'vlogger_config', array(
	   	'type'        => 'switch',
	   	'section'     =>  $section,
		'settings'    =>  $section.'_aftercontent', // this has to be like the main
		'label'       => esc_html__( 'Add ReAktions after content', "vlogger" ),
	));
}



/* = Ads Manager
=============================================*/


/**
* ADS 1: IN MENU
* 
* ================ 
* 
*/

$slot = 'vlogger_ads_menubar';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Main menu slot', "vlogger" ),
	'description' => esc_html__("Max 70px height. No mobile. use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));


/**
* ADS 2: BELOW HEADER
* 
* ================ 
* 
*/



$slot = 'vlogger_ads_under_header';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Header ads slot', "vlogger" ),
	'description' => esc_html__("Max 70px height. May occupy lot of space. No mobile allowed. use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_container', // this has to be like the main
	'label'       => esc_html__( 'Add container', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_verticalpadding', // this has to be like the main
	'label'       => esc_html__( 'Add vertical padding', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'color',
   	'section'     => $slot,
	'settings'    => $slot.'_background', // this has to be like the main
	'label'       => esc_html__( 'Background color', "vlogger" ),
));


/**
* ADS 3: BEFORE POST
* 
* ================ 
* 
*/

$slot = 'vlogger_ads_before_post';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Before posts content', "vlogger" ),
	'description' => esc_html__("Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));


/**
* ADS 4: AFTER POST
* 
* ================ 
* 
*/

$slot = 'vlogger_ads_after_post';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'After posts content', "vlogger" ),
	'description' => esc_html__("Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));



/**
* ADS 5: BEFORE PAGE
* 
* ================ 
* 
*/

$slot = 'vlogger_ads_before_page';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Before page content', "vlogger" ),
	'description' => esc_html__("Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));


/**
* ADS 6: AFTER PAGE
* 
* ================ 
* 
*/

$slot = 'vlogger_ads_after_page';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'After page content', "vlogger" ),
	'description' => esc_html__("Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));


/**
* ADS 7: BEFORE SIDEBAR
* 
* ================ 
* 
*/

$slot = 'vlogger_ads_before_sidebar';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Before sidebar', "vlogger" ),
	'description' => esc_html__("Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));


/**
* ADS 8: AFTER SIDEBAR
* 
* ================ 
* 
*/
$slot = 'vlogger_ads_after_sidebar';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'After sidebar content', "vlogger" ),
	'description' => esc_html__("Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));

/**
* ADS 9: BEFORE FOOTER
* 
* ================ 
* 
*/

$slot = 'vlogger_ads_before_footer';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Before footer widgets', "vlogger" ),
	'description' => esc_html__("Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_container', // this has to be like the main
	'label'       => esc_html__( 'Add container', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_verticalpadding', // this has to be like the main
	'label'       => esc_html__( 'Add vertical padding', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'color',
   	'section'     => $slot,
	'settings'    => $slot.'_background', // this has to be like the main
	'label'       => esc_html__( 'Background color', "vlogger" ),
));

/**
* 
* ADS 10: FLYOUT
* ================ 
* 
*/

$slot = 'vlogger_ads_flyout';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'FlyOut ads', "vlogger" ),
	'description' => esc_html__("Desktop only, appearing on scroll. Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));



/**
* 
* ADS 11: BEFORE ARCHIVES
* ================ 
* 
*/

$slot = 'vlogger_ads_before_archive';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Archive ads', "vlogger" ),
	'description' => esc_html__("Ads placement below archives list Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));

Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));


/**
* 
* ADS 12: AFTER ARCHIVES
* ================ 
* 
*/
$slot = 'vlogger_ads_after_archive';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Archive ads', "vlogger" ),
	'description' => esc_html__("Ads placement below archives list Use html, images or shortcodes. No javascript!","vlogger"),
	'priority'    => 10,
));

Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_center', // this has to be like the main
	'label'       => esc_html__( 'Center horizontally', "vlogger" ),
));
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));

/**
* 
* ADS 12: AFTER ARCHIVES
* ================ 
* 
*/
$slot = 'vlogger_ads_video';
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'editor',
   	'section'     => $slot,
	'settings'    => $slot.'_content',
	'label'       => esc_html__( 'Video ads', "vlogger" ),
	'description' => esc_html__("Ads will appear on top of the main videos, for the video posts","vlogger"),
	'priority'    => 10,
));
/*
Kirki::add_field( 'vlogger_config', array(
   	'type'        => 'switch',
   	'section'     => $slot,
	'settings'    => $slot.'_hide_in_mobile', // this has to be like the main
	'label'       => esc_html__( 'Hide in mobile', "vlogger" ),
));
*/










/* = Video Series
=============================================*/
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'radio',
	'settings'    => 'vlogger_series_playlist_position',
	'label'       => esc_html__( 'Playlist position', "vlogger" ),
	'section'     => 'vlogger_series_section',
	'description' => esc_html__( 'Choose where to display the playlist', "vlogger" ),
	'choices'     => array(
		'after' => esc_html__( 'After content', "vlogger" ),
		'before' => esc_html__( 'Before content', "vlogger" )
	),
	'default'     => 'after',
	'priority'    => 1
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'radio',
	'settings'    => 'vlogger_series_playlist_design',
	'label'       => esc_html__( 'Playlist design', "vlogger" ),
	'section'     => 'vlogger_series_section',
	'description' => esc_html__( 'Choose a layout for the playlists in series page', "vlogger" ),
	'choices'     => array(
		'list' => esc_html__( 'List', "vlogger" ),
		'grid' => esc_html__( 'Grid', "vlogger" )
	),
	'default'     => 'list',
	'priority'    => 1
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'radio',
	'settings'    => 'vlogger_series_global_layout',
	'label'       => esc_html__( 'Content layout', "vlogger" ),
	'section'     => 'vlogger_series_section',
	'description' => esc_html__( 'Choose a layout for the text content in a serie page. Does not affect the playlist.', "vlogger" ),
	'choices'     => array(
		'boxed' => esc_html__( 'Boxed', "vlogger" ),
		'boxed-sidebar' => esc_html__( 'Boxed widh sidebar', "vlogger" ),
		'unboxed' => esc_html__( 'Unboxed', "vlogger" ),
		'hidden' => esc_html__( 'Hidden', "vlogger" ),
	),
	'default'     => 'boxed',
	'priority'    => 1
));

/* = Post
=============================================*/
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_show_author',
	'label'       => esc_html__( 'Show post author', "vlogger" ),
	'description' => esc_html__("Display an author box below post contents","vlogger"),
	'section'     => 'vlogger_post_section',
	'priority'    => 10,
	'default'     => '1',
));

/* = Videos
=============================================*/
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_auto_video_format',
	'label'       => esc_html__( 'Auto video post detect', "vlogger" ),
	'description' => esc_html__("Automatically use video format template for posts containing videos","vlogger"),
	'section'     => 'vlogger_video_section',
	'priority'    => 10,
	'default'     => '0',
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_auto_video_header',
	'label'       => esc_html__( 'Add video header for video post formats', "vlogger" ),
	'description' => esc_html__("Automatically put the first video in the header","vlogger"),
	'section'     => 'vlogger_video_section',
	'priority'    => 10,
	'default'     => '0',
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_hide_first_video',
	'label'       => esc_html__( 'Hide first video from contents', "vlogger" ),
	'description' => esc_html__("For the templates with featured video in header","vlogger"),
	'section'     => 'vlogger_video_section',
	'priority'    => 10,
	'default'     => '0',
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_enable_twitch',
	'label'       => esc_html__( 'Enable twitch support', "vlogger" ),
	'description' => esc_html__("Add twitch javascript libraries","vlogger"),
	'section'     => 'vlogger_video_section',
	'priority'    => 10,
	'default'     => '0',
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_enable_autoplay',
	'label'       => esc_html__( 'Enable autoplay in single video pages', "vlogger" ),
	'section'     => 'vlogger_video_section',
	'priority'    => 10,
	'default'     => '0',
));

/* = Header section
=============================================*/
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'image',
	'settings'    => 'vlogger_logo_header',
	'label'       => esc_html__( 'Logo header', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'description' => esc_html__( 'Max outer height: 70px. Make a PNG with some transparent space around to center vertically.', "vlogger" ),
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_header_transparent',
	'label'       => esc_html__( 'Transparent header', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'description' => esc_html__( 'Search results and other pages will still have normal header color', "vlogger" ),
	'default'     => '0',
	'priority'    => 3
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'radio',
	'settings'    => 'vlogger_menu_layout',
	'label'       => esc_html__( 'Menu layout', "vlogger" ),
	'section'     => 'vlogger_header_section',

	'default'     =>  0,
	'priority'    => 2,
	'choices'     => array(
		0 => esc_html__( 'Logo and normal menu', "vlogger" ),
		1 => esc_html__( 'Logo on the left, burger menu', "vlogger" ),
		2 => esc_html__( 'Burger menu, logo on the left', "vlogger" ),
		3 => esc_html__( 'Burger menu, centered logo', "vlogger" ),
	)
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'image',
	'settings'    => 'vlogger_offcanvas_bg',
	'label'       => esc_html__( 'Off canvas background', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'description' => esc_html__( 'Image for the off canvas background', "vlogger" ),
	'priority'    => 10
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_watch_later',
	'label'       => esc_html__( 'Enable Watch Later function', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'description' => esc_html__( 'Add the watch later function to posts and in header', "vlogger" ),
	'default'     => '0',
	'priority'    => 50
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_header_search',
	'label'       => esc_html__( 'Add Search to Header', "vlogger" ),
	'section'     => 'vlogger_header_section',
	//'description' => esc_html__( 'Add the watch later function to posts and in header', "vlogger" ),
	'default'     => '0',
	'priority'    => 50
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_secondary_header',
	'label'       => esc_html__( 'Secondary header', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'description' => esc_html__( 'Display a secondary header containing menu and call to action', "vlogger" ),
	'default'     => '0',
	'priority'    => 50
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'switch',
	'settings'    => 'vlogger_secondary_header_hideonscroll',
	'label'       => esc_html__( 'Hide secondary header on scroll', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'description' => esc_html__( 'When scrolling the secondary header gets hidden', "vlogger" ),
	'default'     => '0',
	'priority'    => 50
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'text',
	'settings'    => 'vlogger_header_cta_text',
	'label'       => esc_html__( 'Call To Action Text', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'default'     => '',
	'priority'    => 51
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'text',
	'settings'    => 'vlogger_header_cta_link',
	'label'       => esc_html__( 'Call To Action Link', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'default'     => '',
	'priority'    => 51
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'text',
	'settings'    => 'vlogger_header_cta_anchor',
	'label'       => esc_html__( 'Call To Action Anchor', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'default'     => '',
	'priority'    => 51
));

Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'image',
	'settings'    => 'vlogger_header_backgroundimage',
	'label'       => esc_html__( 'Default header background image', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'description' => esc_html__( 'JPG min 1600x500px / max 250Kb', "vlogger" ),
	'priority'    => 2
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'text',
	'settings'    => 'vlogger_yt_channel',
	'label'       => esc_html__( 'Youtube channel follow', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'default'     => '',
	'priority'    => 52
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'text',
	'settings'    => 'vlogger_yt_user',
	'label'       => esc_html__( 'Youtube user follow', "vlogger" ),
	'section'     => 'vlogger_header_section',
	'default'     => '',
	'priority'    => 52
));

/* = Footer section
=============================================*/


Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'code',
	'settings'    => 'vlogger_footer_text',
	'label'       => esc_html__( 'Copyright text content', "proradio" ),
	'section'     => 'vlogger_footer_section',
	'choices'     => [
		'language' => 'html',
	],
	'priority'    => 10
));


Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'toggle',
	'settings'    => 'vlogger_footer_widgets',
	'label'       => esc_html__( 'Show footer widgets', "vlogger" ),
	'section'     => 'vlogger_footer_section',
	'default'     => '0',
	'priority'    => 11
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'image',
	'settings'    => 'vlogger_footer_backgroundimage',
	'label'       => esc_html__( 'Footer widgets background image', "vlogger" ),
	'section'     => 'vlogger_footer_section',
	'description' => esc_html__( 'JPG 1600x500px', "vlogger" ),
	'priority'    => 10
));


/* = Social section
=============================================*/
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_amazon', 'type' => 'text', 'label' => esc_html__( 'Amazon', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_beatport', 'type' => 'text', 'label' => esc_html__( 'Beatport', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_bebo', 'type' => 'text', 'label' => esc_html__( 'Bebo', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_behance', 'type' => 'text', 'label' => esc_html__( 'Behance', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_blogger', 'type' => 'text', 'label' => esc_html__( 'Blogger', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_facebook', 'type' => 'text', 'label' => esc_html__( 'Facebook', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_flickr', 'type' => 'text', 'label' => esc_html__( 'Flickr', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_googleplus', 'type' => 'text', 'label' => esc_html__( 'Googleplus', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_instagram', 'type' => 'text', 'label' => esc_html__( 'Instagram', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_itunes', 'type' => 'text', 'label' => esc_html__( 'Itunes', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_juno', 'type' => 'text', 'label' => esc_html__( 'Juno', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_lastfm', 'type' => 'text', 'label' => esc_html__( 'Lastfm', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_linkedin', 'type' => 'text', 'label' => esc_html__( 'Linkedin', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_mixcloud', 'type' => 'text', 'label' => esc_html__( 'Mixcloud', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_space', 'type' => 'text', 'label' => esc_html__( 'Myspace', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_pinterest', 'type' => 'text', 'label' => esc_html__( 'Pinterest', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_reverbnation', 'type' => 'text', 'label' => esc_html__( 'Reverbnation', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_resident-advisor', 'type' => 'text', 'label' => esc_html__( 'Resident-advisor', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_rss', 'type' => 'text', 'label' => esc_html__( 'RSS', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_soundcloud', 'type' => 'text', 'label' => esc_html__( 'Soundcloud', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_strava', 'type' => 'text', 'label' => esc_html__( 'Strava', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_tiktok', 'type' => 'text', 'label' => esc_html__( 'TikTok', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_triplevision', 'type' => 'text', 'label' => esc_html__( 'Triplevision', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_tumblr', 'type' => 'text', 'label' => esc_html__( 'Tumblr', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_twitter', 'type' => 'text', 'label' => esc_html__( 'Twitter', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_twitch', 'type' => 'text', 'label' => esc_html__( 'Twitch', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_vimeo', 'type' => 'text', 'label' => esc_html__( 'Vimeo', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_whatpeopleplay', 'type' => 'text', 'label' => esc_html__( 'Whatpeopleplay', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_wordpress', 'type' => 'text', 'label' => esc_html__( 'WordPress', "vlogger" ), 'section' => 'vlogger_social_section',));
Kirki2_Kirki::add_field( 'vlogger_config', array( 'settings' => 'vlogger_youtube', 'type' => 'text', 'label' => esc_html__( 'Youtube', "vlogger" ), 'section' => 'vlogger_social_section',));


/* = Advanced settings
=============================================*/
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'toggle',
	'settings'    => 'vlogger_enable_debug',
	'label'       => esc_html__( 'Enable debug settings', "vlogger" ),
	'description' => esc_html__( 'Load separated JS instead of minified version and enable console output for javascript. Use in case of issues or custom theme versions', "vlogger" ),
	'section'     => 'vlogger_dev_section',
	'default'     => 0,
	'priority'    => 100
));


/* = Typography section
=============================================*/

Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'typography',
	'settings'    => 'vlogger_typography_text',
	'label'       => esc_html__( 'Basic ', "vlogger" ),
	'section'     => 'vlogger_typography',
	'default'     => array(
		'font-family'    => 'Open Sans',
		'variant'        => 'regular',
		'subsets'        => array( 'latin-ext' ),
	),
	'priority'    => 1,
	'output'      => array(
		array(
			'element' => 'body, html',
			'property' => 'font-family'
		),
	),
) );
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'typography',
	'settings'    => 'vlogger_typography_text_bold',
	'label'       => esc_html__( 'Bold texts ', "vlogger" ),
	'section'     => 'vlogger_typography',
	'default'     => array(
		'font-family'    => 'Open Sans',
		'variant'        => '700',
		'subsets'        => array( 'latin-ext' ),
	),
	'priority'    => 2,
	'output'      => array(
		array(
			'element' => 'strong',
			'property' => 'font-family'
		),
	),
) );


Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'typography',
	'settings'    => 'vlogger_typography_headings',
	'label'       => esc_html__( 'Headings', "vlogger" ),
	'section'     => 'vlogger_typography',
	'default'     => array(
		'font-family'    => 'Montserrat',
		'variant'        => '700',
		'letter-spacing' => '-0.02em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => ''
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => 'h1, h2, h3, h4, h5, h6, .qt-capfont ',
			'property' => 'font-family'
		),
	),
) );



Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'typography',
	'settings'    => 'vlogger_typography_menu',
	'label'       => esc_html__( 'Menu, buttons and captions', "vlogger" ),
	'section'     => 'vlogger_typography',
	'default'     => array(
		'font-family'    => 'Montserrat',
		'variant'        => '700',
		'letter-spacing' => '0em',
		'subsets'        => array( 'latin-ext' ),
		'text-transform' => 'uppercase'
	),
	'priority'    => 10,
	'output'      => array(
		array(
			'element' => '.qt-desktopmenu, .qt-side-nav, .qt-menu-footer, .qt-capfont , .qt-btn, .qt-caption-small, .qt-item-metas',
			'property' => 'font-family'
		),
	),
) );


/* = Colors section
=============================================*/
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_primary_color',
	'label'       => esc_html__( 'Primary', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#0e1d29',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_primary_color_light',
	'label'       => esc_html__( 'Primary light', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#192935',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_primary_color_dark',
	'label'       => esc_html__( 'Primary dark', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#091219',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_color_accent',
	'label'       => esc_html__( 'Accent', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#01dfba',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_color_accent_hover',
	'label'       => esc_html__( 'Accent hover', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#01b799',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_color_secondary',
	'label'       => esc_html__( 'Secondary', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#EF4763',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_color_secondary_hover',
	'label'       => esc_html__( 'Secondary hover', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#ef5f77',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_color_background',
	'label'       => esc_html__( 'Page background', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#fafefd',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_color_paper',
	'label'       => esc_html__( 'Paper background', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#ffffff',
	'priority'    => 0
));
Kirki2_Kirki::add_field( 'vlogger_config', array(
	'type'        => 'color',
	'settings'    => 'vlogger_textcolor_original',
	'label'       => esc_html__( 'Text', "vlogger" ),
	'section'     => 'vlogger_colors_section',
	'default'     => '#000000',
	'priority'    => 0
));


