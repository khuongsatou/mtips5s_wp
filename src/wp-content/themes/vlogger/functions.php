<?php  
/**
 *	@package    vlogger
 *	@author 	Themes2go <team@themes2go.xyz>
 *  @version 	0.0.0
 *  @textdoman 	vlogger
 */

/**==========================================================================================
 *
 *
 *	Themes2go Warranty Notice:
 * 	Theme's support doesn't cover any code customizations. You are free to edit any theme's code at your own risk.
 *  For any customization please use the provided child theme instead of editing core files.
 *  https://codex.wordpress.org/Child_Themes
 *
 * 
 ==========================================================================================*/

/**
 *
 *	Theme version definition to prevent caching of old files
 *  =============================================
 */
if(!function_exists('vlogger_theme_version')){
	function vlogger_theme_version(){
		$my_theme = wp_get_theme( );
		return $my_theme->get( 'Version' );
	}
}

/**
 *
 *	TGM Plugins Activation
 * 	Automatic plugins installation
 *  =============================================
 */
require_once get_template_directory() . '/TGM-Plugin-Activation/vlogger-plugins-activation-CONNECTOR.php';


/**==========================================================================================
 *
 *
 *	Connector settings
 *
 * 
 ==========================================================================================*/
if ( class_exists( 'T2gConnectorClient' ) ) {
	include(get_template_directory().'/T2G-connector-client/t2gconnectorclient-config.php');
}




/**
 *
 *	content_width
 *  =============================================
 */
if ( ! isset( $content_width ) ) $content_width = 1170;

/**
 *
 *	TTG CORE DATA
 * 	For custom types fields and appearance customizer
 *  =============================================
 */
if(function_exists('ttg_core_active')){

	/* types settings */
	include(get_template_directory().'/ttgcore-setup/custom-types/pages-special/pages-special.php');
	include(get_template_directory().'/ttgcore-setup/custom-types/post-special/post-special.php');
	include(get_template_directory().'/ttgcore-setup/custom-types/series/series-type.php');

	/* Customizer */
	// Early exit if Kirki is not installed
	if ( class_exists( 'Kirki' ) ) {
		include(  get_template_directory().'/ttgcore-setup/customizer/kirki-configuration/sections.php' );
		include(  get_template_directory().'/ttgcore-setup/customizer/kirki-configuration/fields.php' );
		include(  get_template_directory().'/ttgcore-setup/customizer/kirki-configuration/configuration.php' ); 
		include(  get_template_directory().'/phpincludes/customizations.php' ); 
	}
	
	/* Shortcode settings */
	include(get_template_directory()."/ttgcore-setup/short/short-carousel-videos.php");
	include(get_template_directory()."/ttgcore-setup/short/short-post-grid.php");
	include(get_template_directory()."/ttgcore-setup/short/short-buttons.php");
	include(get_template_directory()."/ttgcore-setup/short/short-captions.php");
	include(get_template_directory()."/ttgcore-setup/short/short-spacer.php");
	include(get_template_directory()."/ttgcore-setup/short/short-carousel-posts.php");
	include(get_template_directory()."/ttgcore-setup/short/short-carousel-medium.php");
	include(get_template_directory()."/ttgcore-setup/short/short-customcard.php");
	include(get_template_directory()."/ttgcore-setup/short/short-slideshow-3d.php");
	include(get_template_directory()."/ttgcore-setup/short/short-slideshow.php");
	include(get_template_directory()."/ttgcore-setup/short/short-carousel-series.php");
	include(get_template_directory()."/ttgcore-setup/short/short-post-hero.php");
	include(get_template_directory()."/ttgcore-setup/short/short-series-grid.php");
}


/*
*
*	Setup 
* 	=============================================
*/
if ( ! function_exists( 'vlogger_setup' ) ) {
function vlogger_setup() {
	load_theme_textdomain( "vlogger", get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'editor_style');
	
	//add_theme_support( 'vlogger' );

	/* = We have to add the required images sizes
	==============================================*/
	set_post_thumbnail_size( 170, 170, true );
	add_image_size( 'vlogger-m', 670, 670, true );

	/* = post formats support
	==============================================*/
	add_theme_support( 'post-formats', array( 'video' ) );

	/* = Register the menu after_menu_locations_table
	==============================================*/
	register_nav_menus( array(
		'vlogger_menu_primary' => esc_html__( 'Primary Menu', "vlogger" ),
	));
	register_nav_menus( array(
		'vlogger_menu_secondary' => esc_html__( 'Secondary Menu', "vlogger" ),
	));
	register_nav_menus( array(
		'vlogger_menu_footer' => esc_html__( 'Footer Menu', "vlogger" ),
	));
}}
add_action( 'after_setup_theme', 'vlogger_setup' );


/*
*
*	Change default thumbnails sizes 
* 	=============================================	
*/
add_action('after_switch_theme', 'vlogger_setup_options');
function vlogger_setup_options () {
  	update_option( 'medium_size_w', 670 );
	update_option( 'medium_size_h', 670 );
	update_option( 'large_size_w', 1170 );
	update_option( 'large_size_h', 658 );
}


/**
 * 
 * 	Register sidebars
 * 	=============================================
 */
if(!function_exists('vlogger_widgets_init')){
function vlogger_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', "vlogger" ),
		'id'            => 'vlogger-right-sidebar',
		'before_widget' => '<aside id="%1$s" class="col s12 m3 l12 qt-widget qt-content-aside %2$s">',
		'before_title'  => '<h5 class="qt-widget-title qt-caption-small"><span>',
		'after_title'   => '</span></h5>',
		'after_widget'  => '</aside>'
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar', "vlogger" ),
		'id'            => 'vlogger-footersidebar',
		'before_widget' => '<aside id="%1$s" class="qt-widget col s12 m4 l3 qt-ms-item %2$s">',
		'before_title'  => '<h5 class="qt-widget-title qt-caption-small"><span>',
		'after_title'   => '</span></h5>',
		'after_widget'  => '</aside>'
		
	));

	/**
	 * Series sidebar
	 */
	register_sidebar( array(
		'name'          => esc_html__( 'Series Sidebar', "vlogger" ),
		'id'            => 'vlogger-seriessidebar',
		'before_widget' => '<aside id="%1$s" class="col s12 m3 l12 qt-widget qt-content-aside %2$s">',
		'before_title'  => '<h5 class="qt-widget-title qt-caption-small"><span>',
		'after_title'   => '</span></h5>',
		'after_widget'  => '</aside>'
	));
}}
add_action( 'widgets_init', 'vlogger_widgets_init' );


/*
Register Fonts
*/
function vlogger_fonts_url() {
    $font_url = '';
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'vlogger' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Montserrat:700,400|Open+Sans:300,400,700' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}


/**
 * 	CSS and Js loading
 * 	=============================================
 */
if(!function_exists('vlogger_files_inclusion')){
function vlogger_files_inclusion() {
	// CSS
	wp_enqueue_style( "dripicons", get_template_directory_uri().'/fonts/dripicons/webfont.css', false, vlogger_theme_version(), "all" );
	wp_enqueue_style( "qticons", get_template_directory_uri().'/fonts/qticons/qticons.css', false, vlogger_theme_version(), "all" );
	wp_enqueue_style( "google-icons", get_template_directory_uri().'/fonts/google-icons/material-icons.css', false, vlogger_theme_version(), "all" );
	wp_enqueue_style( "socicons", get_template_directory_uri().'/fonts/socicon/style.css' );
	wp_enqueue_style( "slick", get_template_directory_uri().'/components/slick/slick.css', false, vlogger_theme_version(), "all" );
	wp_enqueue_style( "vlogger_main", get_template_directory_uri().'/css/ttg-main.css', false, vlogger_theme_version(), "all" );
	if(!function_exists('ttg_core_active')){
		wp_enqueue_style( 'vlogger-fonts', vlogger_fonts_url(), array(), '1.0.0' );
		add_action( 'wp_enqueue_scripts', 'vlogger_scripts' );
		wp_enqueue_style( "vlogger_typography", get_template_directory_uri().'/css/ttg-typography.css', false, vlogger_theme_version(), "all" );
	}
	// js
	$deps = array("jquery","jquery-migrate", "imagesloaded", "masonry" );
	/**
	 * Twitch API can't be embedded in the theme's JS minified file as it relies on the js URL
	 */
	if(get_theme_mod( 'vlogger_enable_twitch', false )){
		wp_enqueue_script( 'twitch', 'http://player.twitch.tv/js/embed/v1.js', $deps, vlogger_theme_version(), true ); $deps[] = 'twitch';
	}
	/**
	 * Import youtube google api only if I'm using the channel tag
	 */
	if(get_theme_mod( 'vlogger_yt_channel', false )){
		wp_enqueue_script( 'googleapi', 'https://apis.google.com/js/platform.js', $deps, vlogger_theme_version(), true ); $deps[] = 'googleapi';
	}
	if(get_theme_mod('vlogger_sticky_sidebar', false )){

	}
	if(get_theme_mod("vlogger_enable_debug", 0) == "1"){
		wp_enqueue_script( 'plyr', get_template_directory_uri().'/components/plyr/src/js/plyr.js', $deps, vlogger_theme_version(), true ); $deps[] = 'plyr';
		wp_enqueue_script( 'materializecss', get_template_directory_uri().'/js/materialize-src/js/bin/materialize.min.js', $deps, vlogger_theme_version(), true ); $deps[] = 'materializecss';
		wp_enqueue_script( 'slick', get_template_directory_uri().'/components/slick/slick.min.js', $deps, vlogger_theme_version(), true ); $deps[] = 'slick';
		wp_enqueue_script( 'waypoints', get_template_directory_uri().'/components/waypoints/jquery.waypoints.js', $deps, vlogger_theme_version(), true ); $deps[] = 'waypoints';
		wp_enqueue_script( 'skrollr', get_template_directory_uri().'/components/skrollr/skrollr.min.js', $deps, vlogger_theme_version(), true ); $deps[] = 'skrollr';
		wp_enqueue_script( 'vlogger_main', get_template_directory_uri().'/js/ttg-main.js', $deps, vlogger_theme_version(), true ); $deps[] = 'vlogger_main';
	} else {
		wp_enqueue_script( 'vlogger_main', get_template_directory_uri().'/js/min/ttg-main-min.js', $deps, vlogger_theme_version(), true ); $deps[] = 'vlogger_main';
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}}
add_action( 'wp_enqueue_scripts', 'vlogger_files_inclusion' );


/**
 * 
 * Editor style
 * =============================================
 * 
 */
function vlogger_add_editor_styles() {
    add_editor_style(  get_template_directory_uri().'/css/editor.css' );
}
add_action( 'init', 'vlogger_add_editor_styles' );

/**
 * 
 * Get universal page id
 * =============================================
 * 
 */
if ( ! function_exists( 'vlogger_universal_page_id' ) ) {
function vlogger_universal_page_id() {
	$pageid = get_the_ID();
	if(function_exists('is_shop') && function_exists('is_checkout') && function_exists('is_account_page') && function_exists('is_wc_endpoint_url')){
		if(is_shop()){
			$pageid = get_option( 'woocommerce_shop_page_id' ); 
		} elseif (is_cart()){
			$pageid = get_option( 'woocommerce_cart_page_id' ); 
		}elseif (is_checkout()){
			$pageid = get_option( 'woocommerce_checkout_page_id' ); 
		}elseif (is_account_page()){
			$pageid = get_option( 'woocommerce_myaccount_page_id' ); 
		}elseif (is_wc_endpoint_url( 'order-pay' )){
			$pageid = get_option( 'woocommerce_pay_page_id' ); 
		}elseif (is_wc_endpoint_url( 'order-received' )){
			$pageid = get_option( 'woocommerce_thanks_page_id' ); 
		}elseif (is_wc_endpoint_url( 'view-order' ) ){
			$pageid = get_option( 'woocommerce_view_order_page_id' ); 
		}elseif (is_wc_endpoint_url( 'edit-account' ) ){
			$pageid = get_option( 'woocommerce_myaccount_page_id' ); 
		}elseif (is_wc_endpoint_url( 'edit-address' )){
			$pageid = get_option( 'woocommerce_edit_address_page_id' ); 
		}elseif (is_wc_endpoint_url( 'lost-password' )){
			$pageid = get_option( 'woocommerce_checkout_page_id' ); 
		}elseif (is_wc_endpoint_url( 'customer-logout' )){
			$pageid = get_option( 'woocommerce_checkout_page_id' ); 
		}elseif (is_wc_endpoint_url( 'add-payment-method' )){
			$pageid = get_option( 'woocommerce_shop_page_id' ); 
		}
	}
	return $pageid;
}}

/**
 * 
 * Get universal header transparency
 * =============================================
 * 
 */
if ( ! function_exists( 'vlogger_get_universal_header_transparency' ) ) {
function vlogger_get_universal_header_transparency() {
	$pageid = vlogger_universal_page_id();
	$header_transparency =  "qt-header-opaque";
	if( (get_theme_mod("vlogger_header_transparent") == "1" || get_post_meta($pageid,"vlogger_header_transparent", true) == "1" ) ){
		if(get_post_meta($pageid,"vlogger_header_transparent", true) !== "0") {
			$header_transparency = "qt-header-transparent";
		}
	}
	if(is_search() || vlogger_get_paged() > 1){
		$header_transparency = "qt-header-opaque";
	}
	return $header_transparency;
}}



/**
 * 
 * Add class right to secondary menu items
 * =============================================
 * 
 */
function vlogger_secondary_menu_classes( $classes, $item, $args ) {
    // Only affect the menu placed in the 'secondary' wp_nav_bar() theme location
    if ( 'vlogger_menu_secondary' === $args->theme_location ) {
        // Make these items 3-columns wide in Bootstrap
        $classes[] = 'right';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'vlogger_secondary_menu_classes', 10, 3 ); 



/**
 * 
 * Add class right to footer menu items
 * =============================================
 * 
 */
function vlogger_footer_menu_classes( $classes, $item, $args ) {
    // Only affect the menu placed in the 'secondary' wp_nav_bar() theme location
    if ( 'vlogger_menu_footer' === $args->theme_location ) {
        // Make these items 3-columns wide in Bootstrap
        $classes[] = 'qt-right';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'vlogger_footer_menu_classes', 10, 3 ); 


/**
 * 
 * User special fields
 * =============================================
 */
if ( ! function_exists( 'vlogger_playicon' ) ) {
function vlogger_playicon ( $id = false) {
	if('video' == get_post_format( $id )){
		return '<a href="'.get_permalink( $id ).'" class="qt-hovericon"><i class="qticon-play"></i></a>';
	}
	return;
}}


/**
 * 
 * Icon by post format
 * =============================================
 * 
 */
if ( ! function_exists( 'vlogger_format_icon_class' ) ) {
function vlogger_format_icon_class ( $id = false) {
	if ( false === $id ) {
	    return;
	} else {
		$format = get_post_format( $id );
		if ( false === $format ) {
		    $format = 'post';
		}
		switch ($format){
		    case "video":
		     	echo 'dripicons-media-play';
		        break;
		    case "audio":
		     	echo 'dripicons-music';
		        break;
		    case "gallery":
		       	echo 'dripicons-camera';
		        break;
		    case "image":
		    	echo 'dripicons-camera';
		        break;
		    case "link":
		    	echo 'dripicons-link';
		    	break;
		    case "chat":
		    	echo 'dripicons-conversation';
		    	break;
		    case "post": 
		    case "aside":
		    case "quote":
		    default:
		    	echo 'dripicons-align-justify';
		    break;
		}
	}
}}





/**
 *  Create the proper date formatted text
 * 	=============================================
 */
if(!function_exists('vlogger_international_date')) {
function vlogger_international_date(){
    the_time( get_option( "date_format", "d M Y" ), '', '', true );
}}



/**
 * 
 * User special fields
 * =============================================
 */
function vlogger_get_qt_user_social(){
	$qt_user_social = array(
		"twitter" => array(
						'label' => esc_html__( 'Twitter Url' , "vlogger" ),
						'icon' => "qticon-twitter" )
		,"facebook" => array(
						'label' => esc_html__( 'Facebook Url' , "vlogger" ),
						'icon' => "qticon-facebook" ) 
		,"google" => array(
						'label' => esc_html__( 'Google Url' , "vlogger" ),
						'icon' => "qticon-google" )
		,"flickr" => array(
						'label' => esc_html__( 'Flickr Url' , "vlogger" ),
						'icon' => "qticon-flickr" )
		,"pinterest" => array(
						'label' => esc_html__( 'Pinterest Url' , "vlogger" ),
						'icon' => "qticon-pinterest" )
		,"amazon" => array(
						'label' => esc_html__( 'Amazon Url' , "vlogger" ),
						'icon' => "qticon-amazon" )
		,"github" => array(
						'label' => esc_html__( 'Github Url' , "vlogger" ),
						'icon' => "fa fa-github-alt" )
		,"soundcloud" => array(
						'label' => esc_html__( 'Soundcloud Url' , "vlogger" ),
						'icon' => "qticon-cloud" )
		,"vimeo" => array(
						'label' => esc_html__( 'Vimeo Url' , "vlogger" ),
						'icon' => "qticon-vimeo" )
		,"tumblr" => array(
						'label' => esc_html__( 'Tumblr Url' , "vlogger" ),
						'icon' => "qticon-tumblr" )
		,"youtube" => array(
						'label' => esc_html__( 'Youtube Url' , "vlogger" ),
						'icon' => "qticon-youtube" )
		,"wordpress" => array(
						'label' => esc_html__( 'WordPress Url' , "vlogger" ),
						'icon' => "qticon-wordpress" )
		,"wikipedia" => array(
						'label' => esc_html__( 'Wikipedia Url' , "vlogger" ),
						'icon' => "qticon-wikipedia" )
		,"instagram" => array(
						'label' => esc_html__( 'Instagram Url' , "vlogger" ),
						'icon' => "qticon-instagram" )
	);
	return $qt_user_social;
}



$qt_user_social = vlogger_get_qt_user_social();

/**
 * 
 * Create user social icons
 * =============================================
 */
if(!function_exists('vlogger_user_social_icons')) {
function vlogger_user_social_icons($id = null){
	if(null === $id){
		return;
	}
	$qt_user_social = vlogger_get_qt_user_social();

	foreach($qt_user_social as $var => $val){

		$link = get_the_author_meta( $var , $id);
		if(!empty($link)){
			?>
			<a href="<?php echo esc_url($link); ?>" class="qt-social-author"><span class="<?php echo esc_attr($val['icon']); ?>"></span></a>
			<?php
		}
	}
}}



/**
 * 
 * Reading time calculation
 * =============================================
 */
if(!function_exists('vlogger_readingtime')) {
function vlogger_readingtime($id = null){
	/**
	 * If is a video and I know time, show time, or readingtime
	 */
	
	if(!isset($id) || $id == null){
		$id = vlogger_universal_page_id();
	}
	if( !$id ){
		$id = get_the_id();
	}



	$format = get_post_format( $id );
	if($format == "video"){
		return get_post_meta( $id, "vlogger_video_duration", true);
	}

	$content = get_post_field('post_content', $id);
	$word = str_word_count(strip_tags($content));

	//words read per minute
	$wpm = 240;
	//words read per second
	$wps = $wpm/60;
	$secs_to_read = ceil($word/$wps);
	return gmdate("i:s", $secs_to_read);
}}



/**
 * 
 * 	Get current page. 
 *  Role: Fix for using archives as home page
 *  =============================================
 */
if(!function_exists('vlogger_get_paged')){
function vlogger_get_paged() {
	if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {  $paged = 1; }
	return intval($paged);
}}


/**
 * 
 * 	Pagination
 *  Role: Function to add special pagination template
 * 	=============================================
 */
if(!function_exists('vlogger_page_navi')){
function vlogger_page_navi($wp_query) {
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = vlogger_get_paged();
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	if ($paged > 1) { ?>
		<li class="item waves-effect"><a href="<?php echo get_pagenum_link(); ?>" ><i class="dripicons-chevron-left"></i></a></li>
	<?php } 

	if ($paged < $max_page) { 
	?>
		<li class="item waves-effect"><a href="<?php echo get_pagenum_link($paged+1); ?>" ><i class="dripicons-chevron-right"></i></a></li>
	<?php 
	}

	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="active item waves-effect hide-on-large-and-down"><a href="#" class="maincolor-text">'.esc_attr($i).'</a></li>';
		} else {
			echo '<li class="item waves-effect hide-on-large-and-down"><a href="'.esc_url(get_pagenum_link($i)).'">'.esc_attr($i).'</a></li>';
		}
	}
}}


/**
 * 
 * Excerpt length
 * =============================================
 */
add_filter( 'excerpt_length', 'vlogger_excerpt_length', 999 );
if(!function_exists('vlogger_excerpt_length')){
function vlogger_excerpt_length( $length ) {
	return 20;
}}

if(!function_exists('vlogger_excerpt_length_50')){
function vlogger_excerpt_length_50( $length ) {
	return 50;
}}



/**
 * 
 * Extract header image
 * =============================================
 */
if(!function_exists('vlogger_header_image_url')){
function vlogger_header_image_url($id = null, $print = true) {
	$image_url = false;
	if( (is_singular() || is_home() || is_page() || is_front_page()) && has_post_thumbnail()){
		if(!isset($id)){
			$id = vlogger_universal_page_id();
		}
		$image_url = get_the_post_thumbnail_url($id, 'full' );
	/**
	 * since 2.1.1 category bg plugin required
	 */
	} else if( is_category() ){
		if(is_category()){
			// $category = get_category( get_query_var( 'cat' ) );
			$catid = get_query_var( 'cat' );
		}
		/**
		 * since 2.0.5 // support for custom images in podcast categories
		 */
		if( !empty( $catid ) ){
			$image_id =  get_term_meta($catid, 'ttg_category_img_id', true);
			if($image_id){
				$image_url = wp_get_attachment_url ( $image_id, 'full' ); 
			}
		}
	} else {
		$image_url = get_theme_mod( 'vlogger_header_backgroundimage', '' );
	}
	if($image_url){
		if($print){
			echo esc_url($image_url);
		} else {
			return esc_url($image_url);
		}
	}

	return false;
}}



/*
*
*	Gets the taxonomy associated with any post type for other queries
* 	=============================================
*/
if(!function_exists('vlogger_get_type_taxonomy')){
function vlogger_get_type_taxonomy($posttype){
	if($posttype != ''){
		switch($posttype){
			case "vlogger_serie":
				$taxonomy = 'vlogger_seriescategory';
				break;
			default:
				$taxonomy = 'category';
		}
	}
	return $taxonomy;
}}



/**
 * 
 * Add classes to body
 * 
 */
if ( ! function_exists( 'vlogger_class_names' ) ) {
function vlogger_class_names($classes) {
	/* Custom qantumthemes classes for the theme */
	$classes[] = "qt-body";


	if(wp_is_mobile()) $classes[] = 'mobile';
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false) $classes[] = 'is_iphone';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) $classes[] = 'is_ipad';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false) $classes[] = 'is_android';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false) $classes[] = 'is_kindle';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false) $classes[] = 'is_blackberry';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false) $classes[] = 'is_opera-mini';
	else if(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false) $classes[] = 'is_opera-mobi';
	
	if ( stristr( $_SERVER['HTTP_USER_AGENT'],'mac') ) $classes[] = 'is_osx';
	else if ( stristr( $_SERVER['HTTP_USER_AGENT'],'linux') ) $classes[] = 'is_linux';
	else if ( stristr( $_SERVER['HTTP_USER_AGENT'],'windows') ) $classes[] = 'is_windows';



	if(get_theme_mod('vlogger_mod_lazyload')){
		$classes[] = 'qt-lazyload';
	}

	if(get_theme_mod('vlogger_mod_parallax')){
		$classes[] = 'qt-parallax-on';
	}


	if(is_singular()) {
		$classes[] = "qt-template-".esc_attr ( get_page_template_slug ( get_the_ID() ) );
	} else {
		$classes[] =  "qt-template-archive";
	}
	if(get_theme_mod("vlogger_enable_debug", 0)){
		$classes[] = 'qt-debug';
	}	



	if( get_theme_mod('vlogger_enable_autoplay', false ) ){
		$classes[] = 'qt-video-autoplay';
	}

	return $classes;
}}

add_filter('body_class','vlogger_class_names');



/**
 * Add category custom field
 * ============================================= */
function vlogger_addTitleFieldToCat($termId){
	$cat_id = $termId->term_id;
    $qt_cat_template = get_term_meta($cat_id, 'qt_cat_template', true);
    ?> 
    <tr class="form-field">
        <th scope="row" valign="top"><label for="qt_cat_template"><?php esc_html_e('Category template', "vlogger"); ?></label></th>
        <td>
        <input type="hidden" name="termID" value="<?php echo esc_attr($cat_id ); ?>">
        <select name="qt_cat_template" id="qt_cat_template">
        	<option><?php esc_html_e('Default', "vlogger"); ?></option>
        	<option value="grid" <?php if($qt_cat_template == "grid"){ ?>selected<?php } ?>><?php esc_html_e('Grid', "vlogger"); ?></option>
        </select>
    </tr>
    <?php

}
add_action ( 'category_edit_form_fields', 'vlogger_addTitleFieldToCat');

function vlogger_saveCategoryFields( $term_id, $tt_id) {
    if ( isset( $_POST['qt_cat_template'] ) ) {
        update_term_meta($tt_id, 'qt_cat_template', $_POST['qt_cat_template']);
    } 
}
add_action ( 'edited_category', 'vlogger_saveCategoryFields', 99, 2);


/**
 * Template for comments and pingbacks.
 * 	=============================================
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
if ( ! function_exists( 'vlogger_s_comment' ) ) :
function vlogger_s_comment( $comment, $args, $depth ) {
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class("comment qt-comment-item"); ?>>
		<article class="comment-body">
			<p class="qw-commentheader qw-small qw-caps">
				<?php esc_attr_e( 'Pingback:', "vlogger" ); ?> <?php edit_comment_link( '<i class="glyphicon  glyphicon-pencil"></i>', '<span class="edit-link">', '</span>' ); ?>
			</p>
			<div class="comment-text">
			 	<?php comment_author_link(); ?> 
			</div>
		</article>
	<?php else : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'comment qt-comment-item' : 'comment qt-comment-item parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body ">
			<div class="comment-content">
				<div class="qt-comment-image">
					<?php 
						$avatar = get_avatar( $comment, $args['avatar_size'] );
						if ( 0 != $args['avatar_size'] && $avatar != '' ){
					 		echo get_avatar( $comment, $args['avatar_size'] );
					 	}else{
					 		?><i class="fa fa-user"></i><?php
					 	}
					?>
				</div>
				<div class="qt-comment-text">
					<div class="comment-content">
						
						<h5 class="qt-commentheader qt-capfont"><?php printf( esc_html__( '%s', "vlogger" ), sprintf( '%s', get_comment_author_link() ) ); ?></h5>
						<p class="qt-small qt-commentdetails"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( _x( '%1$s at %2$s', '1: date, 2: time', "vlogger" ), get_comment_date(), get_comment_time() ); ?></a></p>
						
						<?php edit_comment_link( '<i class="glyphicon  glyphicon-pencil"></i>', '<span class="edit-link">', '</span>' ); ?>

						<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', "vlogger" ); ?></p>
						<?php endif; ?>
						<div class="comment-text qt-content">
							<?php comment_text(); ?>							
						</div>
						<?php
						comment_reply_link( array_merge( $args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						) ) );
						?>					
					</div><!-- .comment-content -->
				</div>
			</div>			
		</article><!-- .comment-body -->
	<?php
	/* Yes, the LI is open and is correct in this way. */
	endif;
}
endif; // ends check for vlogger_s_comment()

/**
 * This is to add our own classes to the comment reply link in comments section
 */
add_filter('comment_reply_link', 'vlogger_replace_reply_link_class');
if(!function_exists('vlogger_replace_reply_link_class')){
function vlogger_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='comment-reply-link qt-btn qt-btn qt-btn-secondary", $class);
    return $class;
}}



// Featured Video
// =============================================================================

if ( ! function_exists( 'vlogger_featured_video' ) ) {
function vlogger_featured_video($id = null) {
	if(!isset($id)){
		return false;
	}
	$post = get_post($id);
	$pattern = get_shortcode_regex();
	preg_match('/'.$pattern.'/s', $post->post_content, $matches);
	$autoplay = get_theme_mod('vlogger_enable_autoplay', false );

	// echo 'vlogger_featured_video';
	/**
	 * Check if the video is already in custom fields
	 * @embed [string]
	 */
	$customarray = get_post_custom($post->ID);
	$embed = '';
	// print_r($customarray);
	foreach ($customarray as $var=>$val){
		if(preg_match('/_oembed_/', $var)){
			// print_r( $val );
			if(array_key_exists(0, $val)){
				$toremove =  strip_tags($val[0]);
				$toembed = str_replace($toremove, '', $val[0]);
				$code = $val[0];
				if(!is_numeric($code)) {
					$embed = print_r( $code, true );
					break;
				}
			}
		}
	}




	if ( isset( $matches[2] ) && is_array($matches) && ($matches[2] == 'embed' ||  $matches[2] == 'video')) {
		echo do_shortcode($matches[0]); 
		return true;
	} elseif ($embed != '' && $embed !== '{{unknown}}') {
		if(preg_match('/youtube/', $embed) || preg_match('/ted/', $embed)|| preg_match('/flickr/', $embed) || preg_match('/wpvideo/', $embed) || preg_match('/bandcamp/', $embed) || preg_match('/blip.tv/', $embed) || preg_match('/vimeo/', $embed) || preg_match('/twitch/', $embed) || preg_match('/dailymotion/', $embed) || preg_match('/wordpress/', $embed) || preg_match('/videopress/', $embed)){
			if (preg_match('/youtube/', $embed)) {
				preg_match('/\/v\/(.{11})|\/embed\/(.{11})/', $embed, $matches);
				$video_id = $matches[2];
				?>
				<div data-type="youtube" data-hideControls="true" data-plyr='{ "hidecontrols": true, "autoplay":<?php if($autoplay){ ?>true<?php } else{ ?>false<?php  } ?>}' data-video-id="<?php echo esc_attr($video_id); ?>"></div>
				<?php
			} elseif (preg_match('/vimeo/', $embed)) {
				preg_match('/player\.vimeo\.com\/video\/([0-9]{1,10})/', $embed, $matches);
				$video_id = $matches[1];
				?>
				<div data-type="vimeo" data-hideControls="true" data-plyr='{ "hidecontrols": true, "autoplay":<?php if($autoplay){ ?>true<?php } else{ ?>false<?php  } ?>}' data-video-id="<?php echo esc_attr($video_id); ?>"></div>
				<?php
			} elseif (preg_match('/twitch/', $embed)){

				// New URL contains more parameters
				// https://player.twitch.tv/?%21branding=&amp;autoplay=false&amp;video=v292406898
				// Added 2018 August 05
				$embed = str_replace('%21branding=&amp;autoplay=false&amp;', '', $embed);
				
				// Updated 2018 August 05
				preg_match('/player\.twitch\.tv\/\?video=v([0-9]{1,10})/', $embed, $matches); // Get the ID from the iframe URL
				$video_id = false;

				if(is_array($matches) ) {
					if( array_key_exists(1, $matches)){
						$video_id = $matches[1];
						?>
							<div id="qtTwitchPlayer" data-videoid="<?php echo esc_attr($video_id); ?>"></div>
						<?php
					}
				} 

				return true;
			} else {
				echo do_shortcode($embed);
			}
			return true;
		}
	} else {
		/**
		 * We search if the content has a video URL
		 */
		$content = get_the_content();
		$searchYoutube = '/(http(s)??\:\/\/)?(www\.)?((youtube\.com\/watch\?v=)|(youtu.be\/))(([a-zA-Z0-9\-_])?)+/';
		$searchVimeo = '/(http(s)??\:\/\/)?(www\.)?(vimeo\.com\/([0-9]{1,10}))+/';
		$matches = preg_match($searchYoutube, $content, $matchesYoutube);
		$matchesVimeo = preg_match($searchVimeo, $content, $matchesVimeo);
		if(count($matchesYoutube) > 0){
			$url = $matchesYoutube[0];
			preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $video_id);
			?>
			<div data-type="youtube" data-hideControls="true" data-plyr='{ "hidecontrols": true, "autoplay":<?php if($autoplay){ ?>true<?php } else{ ?>false<?php  } ?>}' data-video-id="<?php echo esc_attr($video_id[0]); ?>"></div>
			<?php
		} elseif (count($matchesVimeo) > 0){
			echo do_shortcode('[embed width="320" height="150"]'.$matchesVimeo[0].'[embed]'); 
		} else {
			echo 'Missing embed code';
		}
		return true;
	}
}}



/**
 * Check if is a post format video (can work only if chosen manually otherwise is too performance-expensive to check content)
 */

if ( ! function_exists( 'vlogger_is_post_format_video' ) ) {
function vlogger_is_post_format_video($id) {

	
	if(!isset($id)){
		return false;
	}
	if('video' == get_post_format( $id )){
		return true;
	}

	if(!get_theme_mod('vlogger_auto_video_format', '0' )){
		return false;
	}

	$post = get_post($id);
	$pattern = get_shortcode_regex();
	preg_match('/'.$pattern.'/s', $post->post_content, $matches);

	/**
	 * Check if the video is already in custom fields
	 * @embed [string]
	 */
	$content = $post->post_content;
	$searchYoutube = '/(http(s)??\:\/\/)?(www\.)?((youtube\.com\/watch\?v=)|(youtu.be\/))([a-zA-Z0-9\-_])+/';
	$searchVimeo = '/(http(s)??\:\/\/)?(www\.)?(vimeo\.com\/([0-9]{1,10}))+/';
	$matches = preg_match($searchYoutube, $content, $matches);
	$matchesVimeo = preg_match($searchVimeo, $content, $matchesVimeo);
	if ( has_shortcode( $content, 'video' ) ) { 
	 	return true;
	}
	if($matches > 0 || $matchesVimeo > 0){
		// return 'case 1';
		return true;
	}
	if ( isset( $matches[2] ) && is_array($matches) && $matches[2] == 'video') {
		// return 'case 2';
		return true;
	} else {
		$customarray = get_post_custom($post->ID);
		$embed = '';
		/**
		 * When embedding a video WordPress makes a custom meta and we find it by preg_match "oembed", 
		 * then we have to see if it is a vide by making a preg_match on video portals keywords
		 */
		foreach ($customarray as $var=>$val){
			if(preg_match('/_oembed_/', $var)){
				if(array_key_exists(0, $val)){
					$toremove =  strip_tags($val[0]);
					$toembed = str_replace($toremove, '', $val[0]);
					$code = $val[0];
					if(!is_numeric($code)) {
						$embed = print_r( $code, true );
						if(preg_match('/youtube/', $embed) || preg_match('/ted/', $embed)|| preg_match('/flickr/', $embed) || preg_match('/wpvideo/', $embed) || preg_match('/bandcamp/', $embed) || preg_match('/blip.tv/', $embed) || preg_match('/vimeo/', $embed) || preg_match('/twitch/', $embed) || preg_match('/dailymotion/', $embed)){
							// return 'case 3';
							return true;
						}
					}
				}
			}
		}
	}
	return false;
}}

function vlogger_add_column_classes($classes){
	$classes[] = ' col s12 m4 l3';
	return $classes;
}
function vlogger_add_active_class($classes){
	$classes[] = ' qt-element-active qt-content-primary-light';
	return $classes;
}


/**
 * Extract serie episodes
 * $is = ID of the serie we need to extrac episodes from
 */
if(!function_exists("vlogger_extract_serie_episodes")){
function vlogger_extract_serie_episodes($serie_id = null, $current_video_id = null, $template = null, $args = array() ){

	if(!$serie_id) return;
	$episodes = get_post_meta( $serie_id, 'vlogger_seriesvideos', true ); 
	$ep_id = array();
	if(!is_array($episodes)) return;
	foreach($episodes as $e){
		$ep_id[] = $e['vlogger_episodes'][0];
	}
	extract( $args );
	if(isset($container_open)){
		echo wp_kses( $container_open, array( 'div' => array(
	        'class' => array(),
	        'id' => array()
	    )) );
	}

	$argsList = array(
		'post__in'=> $ep_id,
		'ignore_sticky_posts' => 1,
		'posts_per_page' => -1,
		'orderby' => 'post__in'
	);  


	$custom_posts = new WP_Query($argsList);
	/**
	 * If in series we add filters to permalink and post classes
	 */
	
	// filter permalink adding series ID
	add_filter("the_permalink", $vlogger_filter_x = function( $url ) use ( $serie_id ){
		return add_query_arg("vlogger_serie_in", $serie_id, $url);
	}, 99, 2);
	switch( $template ){
		case "list":
			add_filter( 'excerpt_length', $excerpt_l_func = function($length){ return 80; }, 999 );
			$mytemplate = 'phpincludes/part-archive-item-serie-large';
			break;
		case "grid":
			add_filter("post_class", 'vlogger_add_column_classes', 12, 1);
			$mytemplate = 'phpincludes/part-archive-item-medium' ;

			break;
		case "listfull":
			$mytemplate = 'phpincludes/part-archive-item-listfull' ;
			break;
		default: 
			$mytemplate = 'phpincludes/part-archive-item-inline';
	}
	if ( $custom_posts->have_posts() ) :while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); 
		// filter post-class adding "active"
		if($current_video_id  == get_the_id()){
			add_filter("post_class", 'vlogger_add_active_class', 12, 1);
		}
		get_template_part($mytemplate);
	 	remove_filter("post_class", "vlogger_add_active_class", 12);
	endwhile; endif;
	wp_reset_query();
	/**
	 * If in series we REMOVE filters to permalink and post classes
	 */
	if(isset($vlogger_filter_x))remove_filter("the_permalink", $vlogger_filter_x, 99);
	remove_filter("post_class", 'vlogger_add_column_classes', 12);
	if(isset($excerpt_l_func))remove_filter( 'excerpt_length', $excerpt_l_func, 999 );
	if(isset($container_close)){
		$allowed_tags = array(
			'div' => array(
		        'id' => array(),
		        'class' => array()
			)
		);
		echo wp_kses( $container_close, $allowed_tags );
	}
	return true;
}}



/**
 * Return related series from given ID. no ID no related.
 * $is = ID of the serie we need to extrac related from
 */
function vlogger_related_series_mini($id = false){
	$related_posttype = 'vlogger_serie';
	$related_taxonomy = 'vlogger_seriescategory';
	$related_post_per_page = 6;
	$current_id = $id;
	$argsList = array(
		'posts_per_page' => $related_post_per_page ,
		'paged' => 1,
		'ignore_sticky_posts' => true,
		'post_type' => $related_posttype,
		'orderby' => array(  'menu_order' => 'ASC' ,    'post_date' => 'DESC'),
		'post_status' => 'publish',
		'post__not_in'=> array( $current_id )
	);  
	$secondaryQuery = $argsList;
	if($current_id){
		$terms = get_the_terms( $current_id  , $related_taxonomy, 'string');
		$term_ids = false;
		if( !is_wp_error( $terms ) ) {
			if(is_array($terms)) {
				$term_ids = wp_list_pluck($terms,'term_id');
				if ($term_ids) {
					$argsList['tax_query'] =  array(
						array(
							'taxonomy' => $related_taxonomy,
							'field' => 'id',
							'terms' => $term_ids,
							'operator'=> 'IN'
						)
					);
				}
			}
		}
	}
	$the_query_related_series = new WP_Query($argsList);
	$total_results = $the_query_related_series->found_posts;

	// we store found posts and current one in a temporary array for the EXCLUDE in the new query
	$found_array = array( $current_id);
	if ( $the_query_related_series->have_posts() ) :
	 	while ( $the_query_related_series->have_posts() ) : $the_query_related_series->the_post(); 
	 		$found_array[] = $the_query_related_series->post->ID;
		 	?>
			<div class="col s4 m2 l4">
				<?php get_template_part('phpincludes/part-archive-item-card-mini' ); ?>
			</div>
			<?php 
		endwhile;
	endif;
	wp_reset_query();

	/**
	 * 
	 * If we don't find any related result let's just make a new query
	 * @var WP_Query
	 * 
	 */
	if($total_results < 12){
		$secondaryQuery['post__not_in'] = $found_array;
		$secondaryQuery['posts_per_page'] = $related_post_per_page - $total_results;
		$the_query_other_series = new WP_Query($secondaryQuery);
		while ( $the_query_other_series->have_posts() ) : $the_query_other_series->the_post(); 
		 	?>
			<div class="col s4 m2 l4">
				<?php get_template_part('phpincludes/part-archive-item-card-mini' ); ?>
			</div>
			<?php 
		endwhile;
	}
	wp_reset_query();
}





/**
 * 
 * Return related series from given ID. no ID no related.
 * $is = ID of the serie we need to extrac related from
 * 
 */
function vlogger_related_videos_list($id = false){
	$related_posttype = 'post';
	$related_taxonomy = 'category';
	$related_post_per_page = 6;
	$current_id = $id;
	$argsList = array(
		'posts_per_page' => $related_post_per_page ,
		'paged' => 1,
		'ignore_sticky_posts' => true,
		'post_type' => $related_posttype,
		'orderby' => array(  'menu_order' => 'ASC' ,    'post_date' => 'DESC'),
		'post_status' => 'publish',
		'post__not_in'=> array( $current_id )
	);  
	$secondaryQuery = $argsList;
	if($current_id){
		$terms = get_the_terms( $current_id  , $related_taxonomy, 'string');
		$term_ids = false;
		if( !is_wp_error( $terms ) ) {
			if(is_array($terms)) {
				$term_ids = wp_list_pluck($terms,'term_id');
				if ($term_ids) {
					$argsList['tax_query'] =  array(
						array(
							'taxonomy' => $related_taxonomy,
							'field' => 'id',
							'terms' => $term_ids,
							'operator'=> 'IN'
						)
					);
				}
			}
		}
	}
	$the_query_related_series = new WP_Query($argsList);
	$total_results = $the_query_related_series->found_posts;

	// we store found posts and current one in a temporary array for the EXCLUDE in the new query
	$found_array = array( $current_id);
	if ( $the_query_related_series->have_posts() ) :
	 	while ( $the_query_related_series->have_posts() ) : $the_query_related_series->the_post(); 
	 		$found_array[] = $the_query_related_series->post->ID;
		 	?>
				<?php get_template_part('phpincludes/part-archive-item-inline' ); ?>
			<?php 
		endwhile;
	endif;
	wp_reset_query();

	/**
	 * 
	 * If we don't find any related result let's just make a new query
	 * @var WP_Query
	 * 
	 */
	

	if($total_results < $related_post_per_page){
		$secondaryQuery['post__not_in'] = $found_array;
		$secondaryQuery['posts_per_page'] = $related_post_per_page - $total_results;
		$the_query_other_series = new WP_Query($secondaryQuery);
		while ( $the_query_other_series->have_posts() ) : $the_query_other_series->the_post(); 
		 	?>
				<?php get_template_part('phpincludes/part-archive-item-inline' ); ?>
			<?php 
		endwhile;
	}
	wp_reset_query();
}

/**
 * 
 * retrieve the meta field of views counts
 * =============================================
 */
function vlogger_the_post_views($id = null){
	if(!$id) return;
	$views = get_post_meta($id, 'vlogger_views_count', true);
	if(!$views) {
		$views = 0;
	}
	return $views;
}

/**
 * 
 * Get total amount of videos in one playlist serie
 * =============================================
 */
if(!function_exists('vlogger_get_ep_count')){
function vlogger_get_ep_count($serie_id){
	if(!$serie_id) return false;
	$episodes = get_post_meta( $serie_id, 'vlogger_seriesvideos', true ); 
	if(!is_array($episodes)){
		return 0;
	}
	return count($episodes);
}}



/**
 * 
 * Query args filter:
 * we add here the parameter that are needed in custom functions of the theme.
 * =============================================
 */
add_filter('query_vars', 'vlogger_parameter_queryvars' );
if(!function_exists('vlogger_parameter_queryvars')){
function vlogger_parameter_queryvars( $qvars ){
	$qvars[] = 'vlogger_serie_in';
	return $qvars;
}}






/* Visual composer extension
=============================================*/
if(defined( 'WPB_VC_VERSION' )){
	add_action( 'vc_after_init', 'vlogger_vc_after_init_actions' );
	function vlogger_vc_after_init_actions() {
		if(defined( 'WPB_VC_VERSION' )){
			wp_enqueue_script( 'wpb_composer_front_js' );
			wp_enqueue_style( 'js_composer_front' );
			// vc_disable_frontend();
		}
	    /**
	     * Adding theme custom parameters
	     */
	    if( function_exists('vc_add_param') ){ 
			// vc_remove_param( "vc_row", "parallax_speed_bg" );
			vc_add_param(
				"vc_row", 
				array(
				   	'type' => 'checkbox',
				   	'weight' => 1,
				   	'heading' => esc_html__( 'Add container', "vlogger" ),
				   	'param_name' => 'qt_container',
				   	'description' => esc_html__( "Add a container box to the content to limit width", "vlogger" )
				)
			);
			vc_add_param(
				"vc_row", 
				array(
				   	'type' => 'checkbox',
				   	'weight' => 1,
				   	'heading' => esc_html__( 'Negative colors', "vlogger" ),
				   	'param_name' => 'qt_negative',
				   	'description' => esc_html__( "Use for dark backgrounds", "vlogger" )
				)
			);
			vc_add_param(
				"vc_row", 
				array(
				   	'type' => 'checkbox',
				   	'weight' => 1,
				   	'heading' => esc_html__( 'Tile column', "vlogger" ),
				   	'param_name' => 'qt_tilecolumn',
				   	'description' => esc_html__( "Remove any space between inner columns", "vlogger" )
				)
			);

			vc_add_param(
				"vc_row_inner", 
				array(
				   	'type' => 'checkbox',
				   	'weight' => 1,
				   	'heading' => esc_html__( 'Add container', "vlogger" ),
				   	'param_name' => 'qt_container',
				   	'description' => esc_html__( "Add a container box to the content to limit width", "vlogger" )
				)
			);
	    }
	}
}



/* Ads display

=============================================*/
if(!function_exists('vlogger_ads_display')){
function vlogger_ads_display($slot){
	$content = get_theme_mod($slot.'_content', '');
	if($content == ''){ return; }
	$container = get_theme_mod($slot.'_container', '0');
	$verticalpadding = get_theme_mod($slot.'_verticalpadding', '0' );
	$center = get_theme_mod($slot.'_center', '0' );
	$desktoponly = 	 get_theme_mod($slot.'_hide_in_mobile', '0' );
	if($desktoponly == '1' && wp_is_mobile()){
		return;
	}
	?>
	<div class="<?php echo esc_attr($slot); ?>">
		<?php
		if($container == '1'){ ?>
			<div class="qt-container <?php if($desktoponly == '1'){ ?>hide-on-large-and-down<?php } ?>">
		<?php } ?>
			<div class="qt-ads-container  <?php if($verticalpadding == '1'){ ?>qt-vertical-padding-m<?php } ?> <?php if($center == '1'){ ?>qt-center<?php } ?>">
				<?php  echo do_shortcode( $content); ?>
			</div>
		<?php 
		if($container == '1'){ ?>
			</div>
		<?php } ?>
	</div>
	<?php
}}


/**
 * 
 * Way to execute shortcodes in the theme checking the existence
 * =============================================
 */
if(!function_exists('vlogger_do_shortcode')){
function vlogger_do_shortcode($shortcode){
	if(shortcode_exists( str_replace(array("[","]") , '', $shortcode)  )) {
		return do_shortcode($shortcode );
	}
	return;
}}


/**
 * 
 * Let the [video] shortcode output "almost" nothing (just a single space) for specific attributes
 * =============================================
 */
add_filter( 'wp_video_shortcode_override', function ( $output, $attr, $content, $instance ) {  
	//print_r( $attr );
	$url = false;
	if(array_key_exists('mp4',$attr)){
		$url = $attr['mp4'];
	} elseif (array_key_exists('webm',$attr)){
		$url = $attr['webm'];
	}
	if($url !== false){
		$output ='
		
		<video controls>
		  <source src="'.$url.'" type="video/mp4">
		</video>';
	}
	return $output;
}, 10, 4 );


/**
 * 
 * Add twtich to oembed wp list
 * =============================================
 */
function vlogger_add_oembed_twitch(){
	wp_oembed_add_provider( 'http://*twitch.tv/*', 'https://api.twitch.tv/v4/oembed');
	wp_oembed_add_provider( 'http://*twitch.tv/*/b/*', 'https://api.twitch.tv/v4/oembed');
}
add_action('init','vlogger_add_oembed_twitch');


/**
 * 
 * Watch later function
 * 
 */
function vlogger_watchlater(){
	if(function_exists('ttg_watchlater_button') && get_theme_mod('vlogger_watch_later', '0' )){
		ttg_watchlater_button();
	}
}
/**
 * 
 * Add header menu buttons
 * Is made like this so it can be modified via plugins
 * =============================================
 */
add_action("qt_menu_actions", "vlogger_menu_actionbuttons", 10, 0);
function vlogger_menu_actionbuttons(){
	/**
	 * 
	 * Watch later
	 * 
	 */
	if(get_theme_mod('vlogger_header_search', '0' ) == '1'){
		get_template_part ("phpincludes/menu-search");
	}
}


/**
 * 
 * Creates a custom excerpt of titles
 * 
 */
function vlogger_shorten($string, $your_desired_width) {
  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
  $parts_count = count($parts);
  $length = 0;
  $last_part = 0;
  $ellipsis = '';
  for (; $last_part < $parts_count; ++$last_part) {
    $length += strlen($parts[$last_part]);
    if ($length > $your_desired_width) {   $ellipsis = '...'; break; }
  }
  return implode(array_slice($parts, 0, $last_part)).$ellipsis;
}



/* Content nav template tag
=============================================*/
if ( ! function_exists( 'vlogger_content_nav' ) ) :
function vlogger_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<div class="qw-padded qw-glassbg">
		<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo esc_attr($nav_class); ?> ">

		<?php if ( is_single() ) : // navigation links for single posts ?>

			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '<span class="qticon-arrow-left"></span>', 'Previous post link', "vlogger" ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '<span class="qticon-arrow-right"></span>', 'Next post link', "vlogger" ) . '</span>' ); ?>

		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="qticon-arrow-left"></span> Older posts', "vlogger" ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="qticon-arrow-right"></span>', "vlogger" ) ); ?></div>
			<?php endif; ?>

		<?php endif; ?>
		<div class="canc"></div>
		</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->

	</div>
	<?php
}
endif; // qantumthemes_content_nav




/**
 * 	Customize number of posts depending on the archive post type
 * 	=============================================
 */
if(!function_exists('vlogger_custom_number_of_posts')){
function vlogger_custom_number_of_posts( $query ) {
	$query->set( 'suppress_filters',false ); // for wpml
	if($query->is_main_query() && !is_admin()){
		if ( $query->is_post_type_archive( 'vlogger_serie' ) 
			|| $query->is_post_type_archive('vlogger_seriescategory')
		) {
			$query->set( 'posts_per_page','9' );
			$query->set( 'orderby', array ('menu_order' => 'ASC', 'date' => 'DESC'));
		}
	}
}}
add_action( 'pre_get_posts', 'vlogger_custom_number_of_posts', 1, 999 );

/**
 * 	Check if featured is vertical
 * 	=============================================
 */
function vlogger_vertical_check() {
    $thumb_id   = get_post_thumbnail_id();
    $image_data = wp_get_attachment_image_src( $thumb_id , 'tp-thumbnail' );
    $width  = $image_data[1];
    $height = $image_data[2];

    if ( $width < $height ) {
        return true;
    }
    return false;
}
