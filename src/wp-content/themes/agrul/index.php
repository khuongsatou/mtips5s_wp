<?php
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// Block direct access op
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}   
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook agrul_blog_start_wrap
    *
    * @Hooked agrul_blog_start_wrap_cb 10
    *  
    */
    do_action( 'agrul_blog_start_wrap' );
    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook agrul_blog_col_start_wrap
    *
    * @Hooked agrul_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'agrul_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook agrul_blog_content
    *
    * @Hooked agrul_blog_content_cb 10
    *  
    */
    do_action( 'agrul_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook agrul_blog_pagination
    *
    * @Hooked agrul_blog_pagination_cb 10
    *  
    */
    do_action( 'agrul_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook agrul_blog_col_end_wrap
    *
    * @Hooked agrul_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'agrul_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook agrul_blog_sidebar
    *
    * @Hooked agrul_blog_sidebar_cb 10
    *  
    */
    do_action( 'agrul_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook agrul_blog_end_wrap
    *
    * @Hooked agrul_blog_end_wrap_cb 10
    *  
    */
    do_action( 'agrul_blog_end_wrap' );

    //footer
    get_footer();