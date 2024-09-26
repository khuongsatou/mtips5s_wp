<?php  
/**
 * Create sections using the WordPress Customizer API.
 * @package Kirki
 */
if(!function_exists('vlogger_kirki_sections')){
function vlogger_kirki_sections( $wp_customize ) {
	
	$wp_customize->add_section( 'vlogger_header_section', array(
		'title'       => esc_html__( 'Header', "vlogger" ),
		'priority'    => 21
	));
	$wp_customize->add_section( 'vlogger_colors_section', array(
		'title'       => esc_html__( 'Colors customization', "vlogger" ),
		'priority'    => 30,
		'description' => esc_html__( 'Colors of your website', "vlogger" ),
	));
	$wp_customize->add_section( 'vlogger_typography', array(
		'title'       => esc_html__( 'Typography', "vlogger" ),
		'priority'    => 31,
		'description' => esc_html__( 'Customize font settings', "vlogger" ),
	));
	$wp_customize->add_section( 'vlogger_social_section', array(
		'title'       => esc_html__( 'Social networks', "vlogger" ),
		'priority'    => 50,
		'description' => esc_html__( 'Social network profiles', "vlogger" ),
	));
	$wp_customize->add_panel( 'vlogger_ads_panel', array(
	   	'title'       => esc_html__( 'Ads Manager', "vlogger" ),
		'priority'    => 90,
		'description' => esc_html__( 'Manage advertisement slots', "vlogger" ),
	));
	$wp_customize->add_section( 'vlogger_post_section', array(
		'title'       => esc_html__( 'Post settings', "vlogger" ),
		'priority'    => 100
	));
	$wp_customize->add_section( 'vlogger_video_section', array(
		'title'       => esc_html__( 'Video settings', "vlogger" ),
		'priority'    => 100
	));
	$wp_customize->add_section( 'vlogger_series_section', array(
		'title'       => esc_html__( 'Series settings', "vlogger" ),
		'priority'    => 100,
		'description' => esc_html__( 'Manage settings for video series', "vlogger" ),
	));
	$wp_customize->add_section( 'vlogger_footer_section', array(
		'title'       => esc_html__( 'Footer Customization', "vlogger" ),
		'priority'    => 122,
		'description' => esc_html__( 'Footer text and functions', "vlogger" ),
	));
	$wp_customize->add_section( 'vlogger_general_section', array(
		'title'       => esc_html__( 'General theme settings', "vlogger" ),
		'priority'    => 800,
		'description' => esc_html__( 'Extra options for debugging', "vlogger" ),
	));
	$wp_customize->add_section( 'vlogger_dev_section', array(
		'title'       => esc_html__( 'Debug settings', "vlogger" ),
		'priority'    => 999,
		'description' => esc_html__( 'Extra options for debugging', "vlogger" ),
	));



	/**
	* 
	* ReActions Settings ============================================================
	* 
	*/
	$wp_customize->add_panel( 'vlogger_reaktions_mods', array(
		'title'       => esc_html__( 'ReAktions plugin display settings', "vlogger" ),
		'priority'    => 50,
		'description' => esc_html__( 'Requires T2G ReAktions Plugin', "vlogger" ),
	));
	$wp_customize->add_section( 'vlogger_reaktions_mods_pages', array(
		'title'       => esc_html__( 'Pages', "vlogger" ),
		'priority'    => 90,
		'description' => esc_html__( 'Requires T2G ReAktions Plugin', "vlogger" ),
		'panel'          => 'vlogger_reaktions_mods', // Not typically needed.
	));
	$wp_customize->add_section( 'vlogger_reaktions_mods_series', array(
		'title'       => esc_html__( 'Series', "vlogger" ),
		'priority'    => 11,
		'description' => esc_html__( 'Requires T2G ReAktions Plugin', "vlogger" ),
		'panel'          => 'vlogger_reaktions_mods', // Not typically needed.
	));
	$wp_customize->add_section( 'vlogger_reaktions_mods_posts', array(
		'title'       => esc_html__( 'Posts', "vlogger" ),
		'priority'    => 11,
		'description' => esc_html__( 'Requires T2G ReAktions Plugin', "vlogger" ),
		'panel'          => 'vlogger_reaktions_mods', // Not typically needed.
	));
	$wp_customize->add_section( 'vlogger_reaktions_mods_tutorials', array(
		'title'       => esc_html__( 'Tutorials', "vlogger" ),
		'priority'    => 11,
		'description' => esc_html__( 'Requires T2G ReAktions Plugin', "vlogger" ),
		'panel'          => 'vlogger_reaktions_mods', // Not typically needed.
	));
	$wp_customize->add_section( 'vlogger_reaktions_mods_videos', array(
		'title'       => esc_html__( 'Videos', "vlogger" ),
		'priority'    => 11,
		'description' => esc_html__( 'Requires T2G ReAktions Plugin', "vlogger" ),
		'panel'          => 'vlogger_reaktions_mods', // Not typically needed.
	));

	/**
	 * Ads sub panels ============================================================
	 */
	$wp_customize->add_section( 'vlogger_ads_menubar', array(
	  	'title'       => __( 'Menu bar', 'vlogger' ),
	   'description' => __( 'Ads setting in menu bar', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_under_header', array(
	  	'title'       => __( 'Below header', 'vlogger' ),
	   'description' => __( 'Ads setting below header', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_before_post', array(
	  	'title'       => __( 'Before post content', 'vlogger' ),
	   	'description' => __( 'Ads setting before post content', 'vlogger' ),
	   	'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   	'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_after_post', array(
	  	'title'       => __( 'After post content', 'vlogger' ),
	   'description' => __( 'Ads setting after post content', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_before_page', array(
	  	'title'       => __( 'Before page content', 'vlogger' ),
	   'description' => __( 'Ads setting before page content', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_after_page', array(
	  	'title'       => __( 'After page content', 'vlogger' ),
	   'description' => __( 'Ads setting after page content', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_before_sidebar', array(
	  	'title'       => __( 'Before sidebar', 'vlogger' ),
	   'description' => __( 'Ads setting before sidebar', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_after_sidebar', array(
	  	'title'       => __( 'After sidebar', 'vlogger' ),
	   'description' => __( 'Ads setting after sidebar', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_before_archive', array(
	  	'title'       => __( 'Before archives', 'vlogger' ),
	   'description' => __( 'Show above archives lists', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_after_archive', array(
	  	'title'       => __( 'After archives', 'vlogger' ),
	   'description' => __( 'Show below archives lists', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_before_footer', array(
	  	'title'       => __( 'Footer', 'vlogger' ),
	   'description' => __( 'Before footer widgets', 'vlogger' ),
	   'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_flyout', array(
	  	'title'       => __( 'Fly Out', 'vlogger' ),
	   	'description' => __( 'Show ads on scroll', 'vlogger' ),
	   	'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   	'priority'       => 0,
	));
	$wp_customize->add_section( 'vlogger_ads_video', array(
	  	'title'       => __( 'Video overlay', 'vlogger' ),
	   	'description' => __( 'Show ads on top of the videos', 'vlogger' ),
	   	'panel'          => 'vlogger_ads_panel', // Not typically needed.
	   	'priority'       => 0,
	));


	/**
	* 
	* Ads end * */


}}
add_action( 'customize_register', 'vlogger_kirki_sections' );
