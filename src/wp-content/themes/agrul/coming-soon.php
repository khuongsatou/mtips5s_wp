<?php
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 * Template Name: Coming Soon Page
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) ) {
        $agrulcoming_soontitle     = agrul_opt( 'agrul_coming_soon_title' );
        $agrulcoming_soonsubtitle  = agrul_opt( 'agrul_coming_soon_subtitle' );
        $agrulcoming_soonbtntext   = agrul_opt( 'agrul_coming_soon_btn_text' );
    } else {
        $agrulcoming_soontitle     = __( 'Website Under Construction', 'agrul' );
        $agrulcoming_soonsubtitle  = __( 'Website Under Construction. Work Is Going On For The Website Please Stay With Us.', 'agrul' );
        $agrulcoming_soonbtntext   = __( 'Return To Home', 'agrul' );
    }


    // get header
    get_header();

    echo '<section class="vs-error-wrapper space">';
        echo '<div class="container">';
            echo '<div class="error-content text-center">';
                if( ! empty( agrul_opt( 'agrul_coming_soon_image', 'url' ) ) ){
                    echo '<div class="error-img">';
                        echo agrul_img_tag( array(
                            'url'   => esc_url( agrul_opt( 'agrul_coming_soon_image', 'url' ) ),
                        ) );
                    echo '</div>';
                }
                echo '<div class="row justify-content-center">';
                    echo '<div class="col-xl-9">';
                        if( ! empty( $agrulcoming_soontitle ) ){
                            echo '<h2 class="error-title">'.esc_html( $agrulcoming_soontitle ).'</h2>';
                        }
                        if( ! empty( $agrulcoming_soonsubtitle ) ){
                            echo '<p class="error-text px-xl-5">'.esc_html( $agrulcoming_soonsubtitle ).'</p>';
                        }
                        echo '<a href="'.esc_url( home_url('/') ).'" class="vs-btn mask-btn"><span class="btn-text">'.esc_html( $agrulcoming_soonbtntext ).'</span><span class="btn-text-mask">'.esc_html( $agrulcoming_soonbtntext ).'</span></a>';

                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</section>';

    //footer
    get_footer();