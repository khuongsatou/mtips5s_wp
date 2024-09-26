<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package WD
 * @since WD 1.0
 */

$wd_template = apply_filters( 'wd_filter_get_template_part', wd_blog_archive_get_template() );

if ( ! empty( $wd_template ) && 'index' != $wd_template ) {

	get_template_part( $wd_template );

} else {

	wd_storage_set( 'blog_archive', true );

	get_header();

	if ( have_posts() ) {

		// Query params
		$wd_stickies   = is_home()
								|| ( in_array( wd_get_theme_option( 'post_type' ), array( '', 'post' ) )
									&& (int) wd_get_theme_option( 'parent_cat' ) == 0
									)
										? get_option( 'sticky_posts' )
										: false;
		$wd_post_type  = wd_get_theme_option( 'post_type' );
		$wd_args       = array(
								'blog_style'     => wd_get_theme_option( 'blog_style' ),
								'post_type'      => $wd_post_type,
								'taxonomy'       => wd_get_post_type_taxonomy( $wd_post_type ),
								'parent_cat'     => wd_get_theme_option( 'parent_cat' ),
								'posts_per_page' => wd_get_theme_option( 'posts_per_page' ),
								'sticky'         => wd_get_theme_option( 'sticky_style' ) == 'columns'
															&& is_array( $wd_stickies )
															&& count( $wd_stickies ) > 0
															&& get_query_var( 'paged' ) < 1
								);

		wd_blog_archive_start();

		do_action( 'wd_action_blog_archive_start' );

		if ( is_author() ) {
			do_action( 'wd_action_before_page_author' );
			get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/author-page' ) );
			do_action( 'wd_action_after_page_author' );
		}

		if ( wd_get_theme_option( 'show_filters' ) ) {
			do_action( 'wd_action_before_page_filters' );
			wd_show_filters( $wd_args );
			do_action( 'wd_action_after_page_filters' );
		} else {
			do_action( 'wd_action_before_page_posts' );
			wd_show_posts( array_merge( $wd_args, array( 'cat' => $wd_args['parent_cat'] ) ) );
			do_action( 'wd_action_after_page_posts' );
		}

		do_action( 'wd_action_blog_archive_end' );

		wd_blog_archive_end();

	} else {

		if ( is_search() ) {
			get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		} else {
			get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/content', 'none-archive' ), 'none-archive' );
		}
	}

	get_footer();
}
