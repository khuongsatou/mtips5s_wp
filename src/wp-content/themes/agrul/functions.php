<?php
/**
 * @Packge     : AGRUL
 * @Version    : 1.0
 * @Author     : AGRUL
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/agrul-constants.php';

//theme setup
require_once AGRUL_DIR_PATH_INC . 'agrul-theme-setup.php';

//essential scripts
require_once AGRUL_DIR_PATH_INC . 'agrul-essential-scripts.php';

//NavWalker
require_once AGRUL_DIR_PATH_INC . 'agrul-navwalker.php';

// plugin activation
require_once AGRUL_DIR_PATH_FRAM . 'plugins-activation/agrul-active-plugins.php';

// meta options
require_once AGRUL_DIR_PATH_FRAM . 'agrul-meta/agrul-config.php';

// page breadcrumbs
require_once AGRUL_DIR_PATH_INC . 'agrul-breadcrumbs.php';

// sidebar register
require_once AGRUL_DIR_PATH_INC . 'agrul-widgets-reg.php';

//essential functions
require_once AGRUL_DIR_PATH_INC . 'agrul-functions.php';

// theme dynamic css
require_once AGRUL_DIR_PATH_INC . 'agrul-commoncss.php';

// helper function
require_once AGRUL_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once AGRUL_DEMO_DIR_PATH . 'demo-import.php';

// AGRUL options
require_once AGRUL_DIR_PATH_FRAM . 'agrul-options/agrul-options.php';

// hooks
require_once AGRUL_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once AGRUL_DIR_PATH_HOOKS . 'hooks-functions.php';

// woocommerce hooks
require_once AGRUL_DIR_PATH_INC . '/woocommerce-hooks/woocommerce-hooks.php';

// woocommerce hooks
require_once AGRUL_DIR_PATH_INC . '/woocommerce-hooks/woocommerce-hooks-functions.php';

function warp_ajax_product_remove()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    woocommerce_mini_cart();

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove' );
add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove' );

