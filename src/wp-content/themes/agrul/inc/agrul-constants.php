<?php
/**
 * @Packge     : AGRUL
 * @Version    : 1.0
 * @Author     : AGRUL
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant
 *
 */

// Base URI
if ( ! defined( 'AGRUL_DIR_URI' ) ) {
    define('AGRUL_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'AGRUL_DIR_ASSIST_URI' ) ) {
    define( 'AGRUL_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'AGRUL_DIR_CSS_URI' ) ) {
    define( 'AGRUL_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Skin Css File
if ( ! defined( 'AGRUL_DIR_SKIN_CSS_URI' ) ) {
    define( 'AGRUL_DIR_SKIN_CSS_URI', get_theme_file_uri('/assets/css/skins/') );
}


// Js File URI
if (!defined('AGRUL_DIR_JS_URI')) {
    define('AGRUL_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// External PLugin File URI
if (!defined('AGRUL_DIR_PLUGIN_URI')) {
    define('AGRUL_DIR_PLUGIN_URI', get_theme_file_uri( '/assets/plugins/'));
}

// Base Directory
if (!defined('AGRUL_DIR_PATH')) {
    define('AGRUL_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('AGRUL_DIR_PATH_INC')) {
    define('AGRUL_DIR_PATH_INC', AGRUL_DIR_PATH . 'inc/');
}

//AGRUL framework Folder Directory
if (!defined('AGRUL_DIR_PATH_FRAM')) {
    define('AGRUL_DIR_PATH_FRAM', AGRUL_DIR_PATH_INC . 'agrul-framework/');
}

//Classes Folder Directory
if (!defined('AGRUL_DIR_PATH_CLASSES')) {
    define('AGRUL_DIR_PATH_CLASSES', AGRUL_DIR_PATH_INC . 'classes/');
}

//Hooks Folder Directory
if (!defined('AGRUL_DIR_PATH_HOOKS')) {
    define('AGRUL_DIR_PATH_HOOKS', AGRUL_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'AGRUL_DEMO_DIR_PATH' ) ){
    define( 'AGRUL_DEMO_DIR_PATH', AGRUL_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'AGRUL_DEMO_DIR_URI' ) ){
    define( 'AGRUL_DEMO_DIR_URI', AGRUL_DIR_URI.'inc/demo-data/' );
}