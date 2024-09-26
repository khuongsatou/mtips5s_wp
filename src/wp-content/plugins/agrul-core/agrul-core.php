<?php

// Blocking direct access to
if( ! defined( 'ABSPATH' ) ) {
   exit();
}

/**
 * Plugin Name: Agrul Core
 * Description: This is a helper plugin of agrul theme
 * Version:     1.0
 * Author:      Validthemes
 * Author URI:  https://themeforest.net/user/validthemes/portfolio
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: agrul
 */

// Define Constant
define( 'AGRUL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'AGRUL_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'AGRUL_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );
define( 'AGRUL_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );
define( 'AGRUL_PLUGDIRURI', plugin_dir_url( __FILE__ ) );
define( 'AGRUL_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );
define( 'AGRUL_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'agrul-template/' );

// load textdomain
load_plugin_textdomain( 'agrul', false, basename( dirname( __FILE__ ) ) . '/languages' );

//include file.
require_once AGRUL_PLUGIN_INC_PATH .'agrulcore-functions.php';
require_once AGRUL_PLUGIN_INC_PATH .'MCAPI.class.php';
require_once AGRUL_PLUGIN_INC_PATH .'agrulajax.php';
require_once AGRUL_PLUGIN_INC_PATH .'builder/builder.php';
require_once AGRUL_PLUGIN_INC_PATH .'agrul-icons.php';
require_once AGRUL_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';

//Widget
require_once AGRUL_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';

//addons
require_once AGRUL_ADDONS . 'addons.php';