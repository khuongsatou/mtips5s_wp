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
      exit;
    }
    
    //header
    get_header();

    /**
    * 
    * Hook for Page Start Wrapper
    *
    * Hook agrul_page_start_wrap
    *
    * @Hooked agrul_page_start_wrap_cb 10
    *  
    */
    do_action( 'agrul_page_start_wrap' );

    /**
    * 
    * Hook for Column Start Wrapper
    *
    * Hook agrul_page_col_start_wrap
    *
    * @Hooked agrul_page_col_start_wrap_cb 10
    *  
    */
    if (class_exists('WooCommerce') && is_cart()) {
      if(is_active_sidebar('agrul-shop-sidebar')){
        do_action( 'agrul_woocommerce_sidebar' );
        echo '<div class="col-lg-9 shop-right-elements">';
      }else{
        echo '<div class="col-lg-12">';
      }
      
    }else{
      do_action( 'agrul_page_col_start_wrap' );
    }
    
    if( have_posts() ){
      while( have_posts() ){
        the_post();
        // Post Contant
        get_template_part( 'templates/content', 'page' );
      }
      // Reset Data
      wp_reset_postdata();
    }else{
      get_template_part( 'templates/content', 'none' );
    }

    /**
    * 
    * Hook for Column End Wrapper
    *
    * Hook agrul_page_col_end_wrap
    *
    * @Hooked agrul_page_col_end_wrap_cb 10
    *  
    */
    if (class_exists('WooCommerce')) {
        if ( is_cart() || is_active_sidebar('agrul-shop-sidebar')) {
          echo '</div>';
        }
    }else{
      do_action( 'agrul_page_col_end_wrap' );
    }
    

    /**
    * 
    * Hook for Page Sidebar
    *
    * Hook agrul_page_sidebar
    *
    * @Hooked agrul_page_sidebar_cb 10
    *  
    */
    do_action( 'agrul_page_sidebar' );

    /**
    * 
    * Hook for Page End Wrapper
    *
    * Hook agrul_page_end_wrap
    *
    * @Hooked agrul_page_end_wrap_cb 10
    *  
    */
    do_action( 'agrul_page_end_wrap' );

    //footer
    get_footer();