<?php
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $agrul404title        = agrul_opt( 'agrul_fof_title' );
        $agrul404subtitle     = agrul_opt( 'agrul_fof_subtitle' );
        $agrul404description  = agrul_opt( 'agrul_fof_description' );
        $agrul404btntext      = agrul_opt( 'agrul_fof_btn_text' );
    } else {
        $agrul404title        = __( '404', 'agrul' );
        $agrul404subtitle     = __( 'Oops! That page can’t be found', 'agrul' );
        $agrul404description  = __( 'Sorry, but the page you are looking for does not existing', 'agrul' );
        $agrul404btntext      = __( ' Back To Home', 'agrul');    
    }


    // get header
    get_header();

    echo '<div class="error-page-area text-center default-padding">';
        echo '<div class="container">';
            echo '<div class="row align-center">';
                echo '<div class="col-lg-8 offset-lg-2">';
                    echo '<div class="error-box">';
                        echo '<h1>'.esc_html( $agrul404title ).'</h1>';
                        echo '<h2>'.esc_html( $agrul404subtitle ).'</h2>';
                        echo '<p>'.esc_html( $agrul404description ).'</p>';
                        echo '<a class="btn circle btn-theme effect btn-md" href="'.esc_url( home_url('/') ).'">'.esc_html( $agrul404btntext ).'</a>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';

    //footer
    get_footer();