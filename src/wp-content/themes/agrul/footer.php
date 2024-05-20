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
    *
    * Hook for Footer Content
    *
    * Hook agrul_footer_content
    *
    * @Hooked agrul_footer_content_cb 10
    *
    */
    do_action( 'agrul_footer_content' );


    wp_footer();
    ?>
</body>
</html>