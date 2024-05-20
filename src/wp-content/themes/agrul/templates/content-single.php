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
    agrul_setPostViews( get_the_ID() );
    ?>
    <div <?php post_class(); ?> >
        <div class="blog-item-box">
        <?php
            if( class_exists('ReduxFramework') ) {
                $agrul_post_details_title_position = agrul_opt('agrul_post_details_title_position');
            } else {
                $agrul_post_details_title_position = 'header';
            }

            $allowhtml = array(
                'p'         => array(
                    'class'     => array()
                ),
                'span'      => array(),
                'a'         => array(
                    'href'      => array(),
                    'title'     => array()
                ),
                'br'        => array(),
                'em'        => array(),
                'strong'    => array(),
                'b'         => array(),
            );

            // Blog Post Thumbnail
            do_action( 'agrul_blog_post_thumb' );

            if( $agrul_post_details_title_position != 'header' ) {
                echo '<h3>'.wp_kses( get_the_title(), $allowhtml ).'</h3>';
            }
            echo '<div class="info">';
                // Blog Post Meta
                do_action( 'agrul_blog_post_meta' );

                if( get_the_content() ){
                    echo '<div class="blog-content">';
                        the_content();
                        // Link Pages
                        agrul_link_pages();
                    echo '</div>';
                }
            echo '</div>';        
        echo '</div>';
    echo '</div>';
    /**
    *
    * Hook for Blog Details Author Bio
    *
    * Hook agrul_blog_details_author_bio
    *
    * @Hooked agrul_blog_details_author_bio_cb 10
    *
    */
    do_action( 'agrul_blog_details_author_bio' );

    $agrul_post_tag = get_the_tags();
    if( class_exists('ReduxFramework') ) {
        $agrul_post_details_share_options = agrul_opt('agrul_post_details_share_options');
        $agrul_show_post_tag = agrul_opt( 'agrul_display_post_tags' );
    } else {
        $agrul_show_post_tag = true;
        $agrul_post_details_share_options = false;
    }

    if( ! empty( $agrul_post_tag ) && $agrul_show_post_tag || $agrul_post_details_share_options ){
        echo '<div class="post-tags share">';
            if( $agrul_show_post_tag  && is_array( $agrul_post_tag ) && ! empty( $agrul_post_tag ) ){
                if( count( $agrul_post_tag ) > 1 ){
                    $tag_text = __( 'Tags: ', 'agrul' );
                }else{
                    $tag_text = __( 'Tag: ', 'agrul' );
                }
                echo '<div class="tags">';
                    echo '<h4>'.esc_html( $tag_text ).'</h4>';
                    foreach( $agrul_post_tag as $tags ){
                        echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a> ';
                    }
                echo '</div>';
            }
            /**
            *
            * Hook for Blog Social Share Options
            *
            * Hook agrul_blog_details_share_options
            *
            * @Hooked agrul_blog_details_share_options_cb 10
            *
            */
            do_action( 'agrul_blog_details_share_options' );
            
        echo '</div>';
        
    }

    /**
    *
    * Hook for Blog Navigation
    *
    * Hook agrul_blog_details_post_navigation
    *
    * @Hooked agrul_blog_details_post_navigation_cb 10
    *
    */
    do_action( 'agrul_blog_details_post_navigation' );

    /**
    *
    * Hook for Blog Details Comments
    *
    * Hook agrul_blog_details_comments
    *
    * @Hooked agrul_blog_details_comments_cb 10
    *
    */
    do_action( 'agrul_blog_details_comments' );