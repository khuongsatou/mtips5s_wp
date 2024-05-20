<?php
// Do not allow directly accessing this file.
if (!defined('ABSPATH')) {
	exit();
}
/**
 * @Packge    : agrul
 * @version   : 1.0
 * @Author    : agrul
 * @Author URI: https://themeforest.net/user/validthemes/portfolio
 */

// demo import file
function agrul_import_files()
{

	return array(
		array(
			'import_file_name'             => esc_html__('AGRUL DEMO', 'agrul'),
			'import_file_url'            =>  'https://validthemes.net/themeforest/wp/agrul/demo/content-1.1.xml',
			'import_widget_file_url'     =>  'https://validthemes.net/themeforest/wp/agrul/demo/agrul_widget.wie',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit(get_template_directory()) . '/inc/demo-data/redux_options_demo.json',
					'option_name' => 'agrul_opt',
				),
			),
			'import_notice'                => esc_html__('Install and activate all required plugins before you click on the "Import" button.', 'agrul'),
		),
	);
}
add_filter('pt-ocdi/import_files', 'agrul_import_files');

// demo import setup
function agrul_after_import_setup()
{
	// Assign menus to their locations.
	$main_menu   = get_term_by('name', 'Primary Menu', 'nav_menu');

	set_theme_mod(
		'nav_menu_locations',
		array(
			'primary-menu'   	=> $main_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id 	= agrul_get_page_by_title('Home One');
	$blog_page_id  	= agrul_get_page_by_title('Blog');

	update_option('show_on_front', 'page');
	update_option('page_on_front', $front_page_id->ID);
	update_option('page_for_posts', $blog_page_id->ID);

	//woocommerce
	$woocommerce_shop = agrul_get_page_by_title('Agrul shop');

	update_option('woocommerce_shop_page_id', $woocommerce_shop->ID);
}
add_action('pt-ocdi/after_import', 'agrul_after_import_setup');


//disable the branding notice after successful demo import
add_filter('pt-ocdi/disable_pt_branding', '__return_true');

//change the location, title and other parameters of the plugin page
function agrul_import_plugin_page_setup($default_settings)
{
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__('AGRUL DEMO Import', 'agrul');
	$default_settings['menu_title']  = esc_html__('Import Demo Data', 'agrul');
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'agrul-demo-import';

	return $default_settings;
}
add_filter('pt-ocdi/plugin_page_setup', 'agrul_import_plugin_page_setup');

// Enqueue scripts
function agrul_demo_import_custom_scripts()
{
	if (isset($_GET['page']) && $_GET['page'] == 'agrul-demo-import') {
		// style
		wp_enqueue_style('agrul-demo-import', AGRUL_DEMO_DIR_URI . 'css/agrul.demo.import.css', array(), '1.0', false);
	}
}
add_action('admin_enqueue_scripts', 'agrul_demo_import_custom_scripts');
