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

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( agrul_meta('page_breadcrumb_area') ) ) {
            $agrul_page_breadcrumb_area  = agrul_meta('page_breadcrumb_area');
        } else {
            $agrul_page_breadcrumb_area = '1';
        }
    }else{
        $agrul_page_breadcrumb_area = '1';
    }

    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );

    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $agrul_page_breadcrumb_area == '1' ) {
            if( class_exists( 'ReduxFramework' )  ){
                $class = '';
            }else{
                $class = 'thumb-less';
            }
            echo '<!-- Page title -->';
            echo '<div class="breadcrumb-area custom-breadcrumb shadow dark bg-cover text-center text-light '.esc_attr($class).'">';
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="col-lg-12 col-md-12">';
                            if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                                if( agrul_meta('page_breadcrumb_settings') == 'page' ) {
                                    $agrul_page_title_switcher = agrul_meta('page_title');
                                } elseif( agrul_opt('agrul_page_title_switcher') == true ) {
                                    $agrul_page_title_switcher = agrul_opt('agrul_page_title_switcher');
                                }else{
                                    $agrul_page_title_switcher = '1';
                                }
                            } else {
                                $agrul_page_title_switcher = '1';
                            }

                            if( $agrul_page_title_switcher == '1' ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    $agrul_page_title_tag    = agrul_opt('agrul_page_title_tag');
                                }else{
                                    $agrul_page_title_tag    = 'h1';
                                }

                                if( defined( 'CMB2_LOADED' )  ){
                                    if( !empty( agrul_meta('page_title_settings') ) ) {
                                        $agrul_custom_title = agrul_meta('page_title_settings');
                                    } else {
                                        $agrul_custom_title = 'default';
                                    }
                                }else{
                                    $agrul_custom_title = 'default';
                                }

                                if( $agrul_custom_title == 'default' ) {
                                    echo agrul_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $agrul_page_title_tag ),
                                            "text"  => esc_html( get_the_title( ) ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    echo agrul_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $agrul_page_title_tag ),
                                            "text"  => esc_html( agrul_meta('custom_page_title') ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }

                            }
                            if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                                if( agrul_meta('page_breadcrumb_settings') == 'page' ) {
                                    $agrul_breadcrumb_switcher = agrul_meta('page_breadcrumb_trigger');
                                } else {
                                    $agrul_breadcrumb_switcher = agrul_opt('agrul_enable_breadcrumb');
                                }

                            } else {
                                $agrul_breadcrumb_switcher = '1';
                            }

                            if( $agrul_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                                agrul_breadcrumbs(
                                    
                                );
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
        }
    } else {
        if( class_exists( 'ReduxFramework' )  ){
            $class = '';
        }else{
            $class = 'thumb-less';
        }
        echo '<!-- Page title -->';
        echo '<div class="breadcrumb-area shadow dark bg-cover text-center text-light '.esc_attr($class).'">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-lg-12 col-md-12">';
                        if( class_exists( 'ReduxFramework' )  ){
                            $agrul_page_title_switcher  = agrul_opt('agrul_page_title_switcher');
                        }else{
                            $agrul_page_title_switcher = '1';
                        }

                        if( $agrul_page_title_switcher ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $agrul_page_title_tag    = agrul_opt('agrul_page_title_tag');
                            }else{
                                $agrul_page_title_tag    = 'h1';
                            }
                            if ( is_archive() ){
                                echo agrul_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $agrul_page_title_tag ),
                                        "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif ( is_home() ){
                                $agrul_blog_page_title_setting = agrul_opt('agrul_blog_page_title_setting');
                                $agrul_blog_page_title_switcher = agrul_opt('agrul_blog_page_title_switcher');
                                $agrul_blog_page_custom_title = agrul_opt('agrul_blog_page_custom_title');
                                if( class_exists('ReduxFramework') ){
                                    if( $agrul_blog_page_title_switcher ){
                                        echo agrul_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $agrul_page_title_tag ),
                                                "text"  => !empty( $agrul_blog_page_custom_title ) && $agrul_blog_page_title_setting == 'custom' ? esc_html( $agrul_blog_page_custom_title) : esc_html__( 'Blog', 'agrul' ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }else{
                                    echo agrul_heading_tag(
                                        array(
                                            "tag"   => "h1",
                                            "text"  => esc_html__( 'Blog', 'agrul' ),
                                            'class' => 'breadcumb-title',
                                        )
                                    );
                                }
                            }elseif( is_search() ){
                                echo agrul_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $agrul_page_title_tag ),
                                        "text"  => esc_html__( 'Search Result', 'agrul' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }elseif( is_404() ){
                                echo agrul_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $agrul_page_title_tag ),
                                        "text"  => esc_html__( '404 PAGE', 'agrul' ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }else{
                                $posttitle_position  = agrul_opt('agrul_post_details_title_position');
                                $postTitlePos = false;
                                if( is_single() ){
                                    if( class_exists( 'ReduxFramework' ) ){
                                        if( $posttitle_position && $posttitle_position != 'header' ){
                                            $postTitlePos = true;
                                        }
                                    }else{
                                        $postTitlePos = false;
                                    }
                                }
                                if( $postTitlePos != true ){
                                    echo agrul_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $agrul_page_title_tag ),
                                            "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                } else {
                                    if( class_exists( 'ReduxFramework' ) ){
                                        $agrul_post_details_custom_title  = agrul_opt('agrul_post_details_custom_title');
                                    }else{
                                        $agrul_post_details_custom_title = __( 'Blog Details','agrul' );
                                    }

                                    if( !empty( $agrul_post_details_custom_title ) ) {
                                        echo agrul_heading_tag(
                                            array(
                                                "tag"   => esc_attr( $agrul_page_title_tag ),
                                                "text"  => wp_kses( $agrul_post_details_custom_title, $allowhtml ),
                                                'class' => 'breadcumb-title'
                                            )
                                        );
                                    }
                                }
                            }
                        }
                        if( class_exists('ReduxFramework') ) {
                            $agrul_breadcrumb_switcher = agrul_opt( 'agrul_enable_breadcrumb' );
                        } else {
                            $agrul_breadcrumb_switcher = '1';
                        }
                        if( $agrul_breadcrumb_switcher == '1' ) {
                            agrul_breadcrumbs(
                                array(
                                    'breadcrumbs_classes' => 'nav',
                                )
                            );
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }