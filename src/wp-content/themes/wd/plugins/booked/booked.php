<?php
/* Booked Appointments support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'wd_booked_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'wd_booked_theme_setup9', 9 );
	function wd_booked_theme_setup9() {
		if ( wd_exists_booked() ) {
			add_action( 'wp_enqueue_scripts', 'wd_booked_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'wd_booked_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'wd_booked_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_booked', 'wd_booked_frontend_scripts_responsive', 10, 1 );
			add_filter( 'wd_filter_merge_styles', 'wd_booked_merge_styles' );
			add_filter( 'wd_filter_merge_styles_responsive', 'wd_booked_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'wd_filter_tgmpa_required_plugins', 'wd_booked_tgmpa_required_plugins' );
			add_filter( 'wd_filter_theme_plugins', 'wd_booked_theme_plugins' );
		}
	}
}


// Filter to add in the required plugins list
if ( ! function_exists( 'wd_booked_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('wd_filter_tgmpa_required_plugins',	'wd_booked_tgmpa_required_plugins');
	function wd_booked_tgmpa_required_plugins( $list = array() ) {
		if ( wd_storage_isset( 'required_plugins', 'booked' ) && wd_storage_get_array( 'required_plugins', 'booked', 'install' ) !== false && wd_is_theme_activated() ) {
			$path = wd_get_plugin_source_path( 'plugins/booked/booked.zip' );
			if ( ! empty( $path ) || wd_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => wd_storage_get_array( 'required_plugins', 'booked', 'title' ),
					'slug'     => 'booked',
					'source'   => ! empty( $path ) ? $path : 'upload://booked.zip',
					'version'  => '2.3',
					'required' => false,
				);
			}
		}
		return $list;
	}
}


// Filter theme-supported plugins list
if ( ! function_exists( 'wd_booked_theme_plugins' ) ) {
	//Handler of the add_filter( 'wd_filter_theme_plugins', 'wd_booked_theme_plugins' );
	function wd_booked_theme_plugins( $list = array() ) {
		return wd_add_group_and_logo_to_slave( $list, 'booked', 'booked-' );
	}
}


// Check if plugin installed and activated
if ( ! function_exists( 'wd_exists_booked' ) ) {
	function wd_exists_booked() {
		return class_exists( 'booked_plugin' );
	}
}


// Return a relative path to the plugin styles depend the version
if ( ! function_exists( 'wd_booked_get_styles_dir' ) ) {
	function wd_booked_get_styles_dir( $file ) {
		$base_dir = 'plugins/booked/';
		return $base_dir
				. ( defined( 'BOOKED_VERSION' ) && version_compare( BOOKED_VERSION, '2.4', '<' ) && wd_get_folder_dir( $base_dir . 'old' )
					? 'old/'
					: ''
					)
				. $file;
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'wd_booked_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'wd_booked_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'wd_booked_frontend_scripts', 10, 1 );
	function wd_booked_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && wd_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$wd_url = wd_get_file_url( wd_booked_get_styles_dir( 'booked.css' ) );
			if ( '' != $wd_url ) {
				wp_enqueue_style( 'wd-booked', $wd_url, array(), null );
			}
		}
	}
}


// Enqueue responsive styles for frontend
if ( ! function_exists( 'wd_booked_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'wd_booked_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_booked', 'wd_booked_frontend_scripts_responsive', 10, 1 );
	function wd_booked_frontend_scripts_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && wd_need_frontend_scripts( 'booked' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$wd_url = wd_get_file_url( wd_booked_get_styles_dir( 'booked-responsive.css' ) );
			if ( '' != $wd_url ) {
				wp_enqueue_style( 'wd-booked-responsive', $wd_url, array(), null, wd_media_for_load_css_responsive( 'booked' ) );
			}
		}
	}
}


// Merge custom styles
if ( ! function_exists( 'wd_booked_merge_styles' ) ) {
	//Handler of the add_filter('wd_filter_merge_styles', 'wd_booked_merge_styles');
	function wd_booked_merge_styles( $list ) {
		$list[ wd_booked_get_styles_dir( 'booked.css' ) ] = false;
		return $list;
	}
}


// Merge responsive styles
if ( ! function_exists( 'wd_booked_merge_styles_responsive' ) ) {
	//Handler of the add_filter('wd_filter_merge_styles_responsive', 'wd_booked_merge_styles_responsive');
	function wd_booked_merge_styles_responsive( $list ) {
		$list[ wd_booked_get_styles_dir( 'booked-responsive.css' ) ] = false;
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( wd_exists_booked() ) {
	require_once wd_get_file_dir( wd_booked_get_styles_dir( 'booked-style.php' ) );
}
