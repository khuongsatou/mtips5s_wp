<?php
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue scripts and styles.
 */
function agrul_essential_scripts() {

	wp_enqueue_style( 'agrul-style', get_stylesheet_uri() ,array(), wp_get_theme()->get( 'Version' ) );

    // google font
    wp_enqueue_style( 'agrul-fonts', agrul_google_fonts() ,array(), null );

    // Swiper-bundle------------
    wp_enqueue_style( 'swiper-bundle', get_theme_file_uri( '/assets/css/swiper-bundle.min.css' ) ,array(), '1.0' );
    // Shop------------
    wp_enqueue_style( 'shop', get_theme_file_uri( '/assets/css/shop.css' ) ,array(), '1.0' );
    // Animate------------
    wp_enqueue_style( 'agrul-animate', get_theme_file_uri( '/assets/css/animate.css' ) ,array(), '1.0' );
    // Bootstrap Min ---------------
    wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.min.css' ) ,array(), '4.3.1' );
    // elegant icons---------------
    wp_enqueue_style( 'elegant', get_theme_file_uri( '/assets/css/elegant-icons.css' ), array(), '1.0' );
    // flaticon icons---------------
    wp_enqueue_style( 'flaticon', get_theme_file_uri( '/assets/css/flaticon-set.css' ), array(), '1.0' );
    // Font Awesome Five ----------
    wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/css/font-awesome.min.css' ) ,array(), '5.9.0' );  
    // Magnific Popup------------
    wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/magnific-popup.css' ), array(), '1.0' );
    // themify icons-----------
    wp_enqueue_style( 'themify', get_theme_file_uri( '/assets/css/themify-icons.css' ), array(), '1.0' );
    // validnavs------------
    wp_enqueue_style( 'agrul-validnavs', get_theme_file_uri( '/assets/css/validnavs.css' ), array(), '1.0' );
    // Helper Css-------
    wp_enqueue_style( 'agrul-helper', get_theme_file_uri( '/assets/css/helper.css' ), array(), '1.0' );
    // agrul app style---------
    wp_enqueue_style( 'agrul-main-style', get_theme_file_uri('/assets/css/style.css') ,array(), wp_get_theme()->get( 'Version' ) );
    // unittest-----------
    wp_enqueue_style( 'agrul-unittest', get_theme_file_uri( '/assets/css/unit-test.css' ), array(), '1.0' );


    // Load Js

    // Bootstrap
    wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '1.0.0', true );
    // Count To
    wp_enqueue_script( 'count-to', get_theme_file_uri( '/assets/js/count-to.js' ), array( 'jquery' ), '1.0.0', true );
    // swiper-bundle
    wp_enqueue_script( 'swiper-bundle', get_theme_file_uri( '/assets/js/swiper-bundle.min.js' ), array( 'jquery' ), '1.0.0', true );
    // circle-progress
    wp_enqueue_script( 'circle-progress', get_theme_file_uri( '/assets/js/circle-progress.js' ), array( 'jquery' ), '1.0.0', true );
    // nice-select
    wp_enqueue_script( 'nice-select', get_theme_file_uri( '/assets/js/jquery.nice-select.min.js' ), array( 'jquery' ), '1.0.0', true );
    // TweenMax
    wp_enqueue_script( 'TweenMax', get_theme_file_uri( '/assets/js/TweenMax.min.js' ), array( 'jquery' ), '1.0.0', true );
    // scrolla
    wp_enqueue_script( 'scrolla', get_theme_file_uri( '/assets/js/jquery.scrolla.min.js' ), array( 'jquery' ), '1.0.0', true );
    // isotope pkgd
    wp_enqueue_script( 'isotope-pkgd', get_theme_file_uri( '/assets/js/isotope.pkgd.min.js' ), array( 'jquery' ), '1.0.0', true );
    // jquery appear
    wp_enqueue_script( 'appear', get_theme_file_uri( '/assets/js/jquery.appear.js' ), array( 'jquery' ), '1.0.0', true );
    // jquery easing
    wp_enqueue_script( 'easing', get_theme_file_uri( '/assets/js/jquery.easing.min.js' ), array( 'jquery' ), '1.0.0', true );
    // jquery magnific popup
    wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/assets/js/jquery.magnific-popup.min.js' ), array( 'jquery' ), '1.0.0', true );
    // modernizr
    wp_enqueue_script( 'modernizr', get_theme_file_uri( '/assets/js/modernizr.js' ), array( 'jquery' ), '1.0.0', true );
    // progress
    wp_enqueue_script( 'progress', get_theme_file_uri( '/assets/js/progress-bar.min.js' ), array( 'jquery' ), '1.0.0', true );
    // loopcounter
    wp_enqueue_script( 'loopcounter', get_theme_file_uri( '/assets/js/loopcounter.js' ), array( 'jquery' ), '1.0.0', true );
    // validnavs
    wp_enqueue_script( 'agrul-validnavs', get_theme_file_uri( '/assets/js/validnavs.js' ), array( 'jquery' ), '1.0.0', true );
    // wow
    wp_enqueue_script( 'wow', get_theme_file_uri( '/assets/js/wow.min.js' ), array( 'jquery' ), '1.0.0', true );
    // Imagesloaded for default enabalig from wordpress
    wp_enqueue_script( 'imagesloaded' );
    // YTPlayer
    wp_enqueue_script( 'YTPlayer', get_theme_file_uri( '/assets/js/YTPlayer.min.js' ), array( 'jquery' ), '1.0.0', true );
    // main script
    wp_enqueue_script( 'agrul-main-script', get_theme_file_uri( '/assets/js/main.js' ), array('jquery'), wp_get_theme()->get( 'Version' ), true );

    // comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'agrul_essential_scripts', 88 );


function agrul_block_editor_assets( ) {
    // Add custom fonts.
	wp_enqueue_style( 'agrul-editor-fonts', agrul_google_fonts(), array(), null );
}

add_action( 'enqueue_block_editor_assets', 'agrul_block_editor_assets' );


function agrul_google_fonts() {
    $fonts_url = '';

	/*
	 * translators: If there are characters in your language that are not supported
	 * by Libre Franklin, translate this to 'off'. Do not translate into your own language.
	 */
	$Handlee   = _x( 'on', 'Handlee font: on or off', 'agrul' );

	if ( 'off' !== $Handlee ) {
        $fonts_url = 'https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&family=Handlee&display=swap';
	}

	return esc_url_raw( $fonts_url );
}