<?php
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access
if (!defined('ABSPATH')) {
    exit;
}

if ( ! is_active_sidebar( 'agrul-page-sidebar' ) ) {
    return;
}
?>

<div class="sidebar col-lg-4 col-md-12">
    <aside>
    <?php 
        dynamic_sidebar( 'agrul-page-sidebar' );
    ?>               
	</aside>>
</div>