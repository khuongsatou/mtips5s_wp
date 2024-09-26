<?php
/**
 * Required plugins
 *
 * @package WD
 * @since WD 1.76.0
 */

// THEME-SUPPORTED PLUGINS
// If plugin not need - remove its settings from next array
//----------------------------------------------------------
$wd_theme_required_plugins_groups = array(
	'core'          => esc_html__( 'Core', 'wd' ),
	'page_builders' => esc_html__( 'Page Builders', 'wd' ),
	'ecommerce'     => esc_html__( 'E-Commerce & Donations', 'wd' ),
	'socials'       => esc_html__( 'Socials and Communities', 'wd' ),
	'events'        => esc_html__( 'Events and Appointments', 'wd' ),
	'content'       => esc_html__( 'Content', 'wd' ),
	'other'         => esc_html__( 'Other', 'wd' ),
);
$wd_theme_required_plugins        = array(
	'trx_addons'                 => array(
		'title'       => esc_html__( 'ThemeREX Addons', 'wd' ),
		'description' => esc_html__( "Will allow you to install recommended plugins, demo content, and improve the theme's functionality overall with multiple theme options", 'wd' ),
		'required'    => true,
		'logo'        => 'trx_addons.png',
		'group'       => $wd_theme_required_plugins_groups['core'],
	),
	'elementor'                  => array(
		'title'       => esc_html__( 'Elementor', 'wd' ),
		'description' => esc_html__( "Is a beautiful PageBuilder, even the free version of which allows you to create great pages using a variety of modules.", 'wd' ),
		'required'    => false,
		'logo'        => 'elementor.png',
		'group'       => $wd_theme_required_plugins_groups['page_builders'],
	),
	'gutenberg'                  => array(
		'title'       => esc_html__( 'Gutenberg', 'wd' ),
		'description' => esc_html__( "It's a posts editor coming in place of the classic TinyMCE. Can be installed and used in parallel with Elementor", 'wd' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'gutenberg.png',
		'group'       => $wd_theme_required_plugins_groups['page_builders'],
	),
	'js_composer'                => array(
		'title'       => esc_html__( 'WPBakery PageBuilder', 'wd' ),
		'description' => esc_html__( "Popular PageBuilder which allows you to create excellent pages", 'wd' ),
		'required'    => false,
		'install'     => false,          // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'js_composer.jpg',
		'group'       => $wd_theme_required_plugins_groups['page_builders'],
	),
	'woocommerce'                => array(
		'title'       => esc_html__( 'WooCommerce', 'wd' ),
		'description' => esc_html__( "Connect the store to your website and start selling now", 'wd' ),
		'required'    => false,
		'logo'        => 'woocommerce.png',
		'group'       => $wd_theme_required_plugins_groups['ecommerce'],
	),
	'elegro-payment'             => array(
		'title'       => esc_html__( 'Elegro Crypto Payment', 'wd' ),
		'description' => esc_html__( "Extends WooCommerce Payment Gateways with an elegro Crypto Payment", 'wd' ),
		'required'    => false,
		'logo'        => 'elegro-payment.png',
		'group'       => $wd_theme_required_plugins_groups['ecommerce'],
	),
	'instagram-feed'             => array(
		'title'       => esc_html__( 'Instagram Feed', 'wd' ),
		'description' => esc_html__( "Displays the latest photos from your profile on Instagram", 'wd' ),
		'required'    => false,
		'logo'        => 'instagram-feed.png',
		'group'       => $wd_theme_required_plugins_groups['socials'],
	),
	'mailchimp-for-wp'           => array(
		'title'       => esc_html__( 'MailChimp for WP', 'wd' ),
		'description' => esc_html__( "Allows visitors to subscribe to newsletters", 'wd' ),
		'required'    => false,
		'logo'        => 'mailchimp-for-wp.png',
		'group'       => $wd_theme_required_plugins_groups['socials'],
	),
	'booked'                     => array(
		'title'       => esc_html__( 'Booked Appointments', 'wd' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => 'booked.png',
		'group'       => $wd_theme_required_plugins_groups['events'],
	),
	'the-events-calendar'        => array(
		'title'       => esc_html__( 'The Events Calendar', 'wd' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'the-events-calendar.png',
		'group'       => $wd_theme_required_plugins_groups['events'],
	),
	'contact-form-7'             => array(
		'title'       => esc_html__( 'Contact Form 7', 'wd' ),
		'description' => esc_html__( "CF7 allows you to create an unlimited number of contact forms", 'wd' ),
		'required'    => false,
		'logo'        => 'contact-form-7.png',
		'group'       => $wd_theme_required_plugins_groups['content'],
	),

	'latepoint'                  => array(
		'title'       => esc_html__( 'LatePoint', 'wd' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => wd_get_file_url( 'plugins/latepoint/latepoint.png' ),
		'group'       => $wd_theme_required_plugins_groups['events'],
	),
	'advanced-popups'                  => array(
		'title'       => esc_html__( 'Advanced Popups', 'wd' ),
		'description' => '',
		'required'    => false,
		'logo'        => wd_get_file_url( 'plugins/advanced-popups/advanced-popups.jpg' ),
		'group'       => $wd_theme_required_plugins_groups['content'],
	),
	'devvn-image-hotspot'                  => array(
		'title'       => esc_html__( 'Image Hotspot by DevVN', 'wd' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => wd_get_file_url( 'plugins/devvn-image-hotspot/devvn-image-hotspot.png' ),
		'group'       => $wd_theme_required_plugins_groups['content'],
	),
	'ti-woocommerce-wishlist'                  => array(
		'title'       => esc_html__( 'TI WooCommerce Wishlist', 'wd' ),
		'description' => '',
		'required'    => false,
		'logo'        => wd_get_file_url( 'plugins/ti-woocommerce-wishlist/ti-woocommerce-wishlist.png' ),
		'group'       => $wd_theme_required_plugins_groups['ecommerce'],
	),
	'woo-smart-quick-view'                  => array(
		'title'       => esc_html__( 'WPC Smart Quick View for WooCommerce', 'wd' ),
		'description' => '',
		'required'    => false,
                'install'     => false,
		'logo'        => wd_get_file_url( 'plugins/woo-smart-quick-view/woo-smart-quick-view.png' ),
		'group'       => $wd_theme_required_plugins_groups['ecommerce'],
	),
	'twenty20'                  => array(
		'title'       => esc_html__( 'Twenty20 Image Before-After', 'wd' ),
		'description' => '',
		'required'    => false,
        'install'     => false,
		'logo'        => wd_get_file_url( 'plugins/twenty20/twenty20.png' ),
		'group'       => $wd_theme_required_plugins_groups['content'],
	),
	'essential-grid'             => array(
		'title'       => esc_html__( 'Essential Grid', 'wd' ),
		'description' => '',
		'required'    => false,
		'install'     => false,
		'logo'        => 'essential-grid.png',
		'group'       => $wd_theme_required_plugins_groups['content'],
	),
	'revslider'                  => array(
		'title'       => esc_html__( 'Revolution Slider', 'wd' ),
		'description' => '',
		'required'    => false,
		'logo'        => 'revslider.png',
		'group'       => $wd_theme_required_plugins_groups['content'],
	),
	'sitepress-multilingual-cms' => array(
		'title'       => esc_html__( 'WPML - Sitepress Multilingual CMS', 'wd' ),
		'description' => esc_html__( "Allows you to make your website multilingual", 'wd' ),
		'required'    => false,
		'install'     => false,      // Do not offer installation of the plugin in the Theme Dashboard and TGMPA
		'logo'        => 'sitepress-multilingual-cms.png',
		'group'       => $wd_theme_required_plugins_groups['content'],
	),
	'wp-gdpr-compliance'         => array(
		'title'       => esc_html__( 'Cookie Information', 'wd' ),
		'description' => esc_html__( "Allow visitors to decide for themselves what personal data they want to store on your site", 'wd' ),
		'required'    => false,
		'logo'        => 'wp-gdpr-compliance.png',
		'group'       => $wd_theme_required_plugins_groups['other'],
	),
	'trx_updater'                => array(
		'title'       => esc_html__( 'ThemeREX Updater', 'wd' ),
		'description' => esc_html__( "Update theme and theme-specific plugins from developer's upgrade server.", 'wd' ),
		'required'    => false,
		'logo'        => 'trx_updater.png',
		'group'       => $wd_theme_required_plugins_groups['other'],
	),
);

if ( WD_THEME_FREE ) {
	unset( $wd_theme_required_plugins['js_composer'] );
	unset( $wd_theme_required_plugins['booked'] );
	unset( $wd_theme_required_plugins['the-events-calendar'] );
	unset( $wd_theme_required_plugins['calculated-fields-form'] );
	unset( $wd_theme_required_plugins['essential-grid'] );
	unset( $wd_theme_required_plugins['revslider'] );
	unset( $wd_theme_required_plugins['sitepress-multilingual-cms'] );
	unset( $wd_theme_required_plugins['trx_updater'] );
	unset( $wd_theme_required_plugins['trx_popup'] );
}

// Add plugins list to the global storage
wd_storage_set( 'required_plugins', $wd_theme_required_plugins );
