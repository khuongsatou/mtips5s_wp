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

	/**
	* Hook for preloader
	*/
	add_action( 'agrul_preloader_wrap', 'agrul_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'agrul_main_wrapper_start', 'agrul_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'agrul_header', 'agrul_header_cb', 10 );

	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'agrul_blog_start_wrap', 'agrul_blog_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'agrul_blog_col_start_wrap', 'agrul_blog_col_start_wrap_cb', 10 );

	/**
	* Hook for Service Column Start Wrapper
	*/
    add_action( 'agrul_service_col_start_wrap', 'agrul_service_col_start_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'agrul_blog_col_end_wrap', 'agrul_blog_col_end_wrap_cb', 10 );

	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'agrul_blog_end_wrap', 'agrul_blog_end_wrap_cb', 10 );

	/**
	* Hook for Blog Pagination
	*/
    add_action( 'agrul_blog_pagination', 'agrul_blog_pagination_cb', 10 );

    /**
	* Hook for Blog Content
	*/
	add_action( 'agrul_blog_content', 'agrul_blog_content_cb', 10 );

    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'agrul_blog_sidebar', 'agrul_blog_sidebar_cb', 10 );


    /**
	* Hook for Service Sidebar
	*/
	add_action( 'agrul_service_sidebar', 'agrul_service_sidebar_cb', 10 );

    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'agrul_blog_details_sidebar', 'agrul_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'agrul_blog_details_wrapper_start', 'agrul_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'agrul_blog_post_meta', 'agrul_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'agrul_blog_details_share_options', 'agrul_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'agrul_blog_details_author_bio', 'agrul_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'agrul_blog_details_tags_and_categories', 'agrul_blog_details_tags_and_categories_cb', 10 );
	add_action( 'agrul_blog_details_post_navigation', 'agrul_blog_details_post_navigation_cb', 10 );

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'agrul_blog_details_comments', 'agrul_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('agrul_blog_details_col_start','agrul_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('agrul_blog_details_col_end','agrul_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('agrul_blog_details_wrapper_end','agrul_blog_details_wrapper_end_cb');

	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('agrul_blog_post_thumb','agrul_blog_post_thumb_cb');

	/**
	* Hook for Blog Post Content
	*/
	add_action('agrul_blog_post_content','agrul_blog_post_content_cb');


	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('agrul_blog_postexcerpt_read_content','agrul_blog_postexcerpt_read_content_cb');

	/**
	* Hook for footer content
	*/
	add_action( 'agrul_footer_content', 'agrul_footer_content_cb', 10 );

	/**
	* Hook for main wrapper end
	*/
	add_action( 'agrul_main_wrapper_end', 'agrul_main_wrapper_end_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'agrul_page_start_wrap', 'agrul_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'agrul_page_end_wrap', 'agrul_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'agrul_page_col_start_wrap', 'agrul_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'agrul_page_col_end_wrap', 'agrul_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'agrul_page_sidebar', 'agrul_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'agrul_page_content', 'agrul_page_content_cb', 10 );