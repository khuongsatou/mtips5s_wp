<?php
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $agrul_post_id = get_the_ID();

            // Get the page settings manager
            $agrul_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $agrul_page_settings_model = $agrul_page_settings_manager->get_model( $agrul_post_id );

            // Retrieve the color we added before
            $agrul_header_style = $agrul_page_settings_model->get_settings( 'agrul_header_style' );
            $agrul_header_builder_option = $agrul_page_settings_model->get_settings( 'agrul_header_builder_option' );

            if( $agrul_header_style == 'header_builder'  ) {

                if( !empty( $agrul_header_builder_option ) ) {
                    $agrulheader = get_post( $agrul_header_builder_option );
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $agrulheader->ID );
                }
            } else {
                // global options
                $agrul_header_builder_trigger = agrul_opt('agrul_header_options');
                if( $agrul_header_builder_trigger == '2' ) {
                    $agrul_global_header_select = get_post( agrul_opt( 'agrul_header_select_options' ) );
                    $header_post = get_post( $agrul_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                } else {
                    // wordpress Header
                    agrul_global_header_option();
                }
            }
        } else {
            $agrul_header_options = agrul_opt('agrul_header_options');
            if( $agrul_header_options == '1' ) {
                agrul_global_header_option();
            } else {
                $agrul_header_select_options = agrul_opt('agrul_header_select_options');
                $agrulheader = get_post( $agrul_header_select_options );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $agrulheader->ID );
            }
        }
    } else {
        agrul_global_header_option();
    }