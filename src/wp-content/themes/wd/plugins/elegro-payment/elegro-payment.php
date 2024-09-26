<?php
/* Elegro Crypto Payment support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'wd_elegro_payment_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'wd_elegro_payment_theme_setup9', 9 );
	function wd_elegro_payment_theme_setup9() {
		if ( wd_exists_elegro_payment() ) {
			add_action( 'wp_enqueue_scripts', 'wd_elegro_payment_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_elegro_payment', 'wd_elegro_payment_frontend_scripts', 10, 1 );
			add_filter( 'wd_filter_merge_styles', 'wd_elegro_payment_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'wd_filter_tgmpa_required_plugins', 'wd_elegro_payment_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'wd_elegro_payment_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('wd_filter_tgmpa_required_plugins',	'wd_elegro_payment_tgmpa_required_plugins');
	function wd_elegro_payment_tgmpa_required_plugins( $list = array() ) {
		if ( wd_storage_isset( 'required_plugins', 'woocommerce' ) && wd_storage_isset( 'required_plugins', 'elegro-payment' ) && wd_storage_get_array( 'required_plugins', 'elegro-payment', 'install' ) !== false ) {
			$list[] = array(
				'name'     => wd_storage_get_array( 'required_plugins', 'elegro-payment', 'title' ),
				'slug'     => 'elegro-payment',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'wd_exists_elegro_payment' ) ) {
	function wd_exists_elegro_payment() {
		return class_exists( 'WC_Elegro_Payment' );
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'wd_elegro_payment_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'wd_elegro_payment_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_elegro_payment', 'wd_elegro_payment_frontend_scripts', 10, 1 );
	function wd_elegro_payment_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && wd_need_frontend_scripts( 'elegro_payment' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$wd_url = wd_get_file_url( 'plugins/elegro-payment/elegro-payment.css' );
			if ( '' != $wd_url ) {
				wp_enqueue_style( 'wd-elegro-payment', $wd_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'wd_elegro_payment_merge_styles' ) ) {
	//Handler of the add_filter('wd_filter_merge_styles', 'wd_elegro_payment_merge_styles');
	function wd_elegro_payment_merge_styles( $list ) {
		$list[ 'plugins/elegro-payment/elegro-payment.css' ] = false;
		return $list;
	}
}
