<?php
/*
Package: vlogger
Description: Archive title
Version: 1.2.2
Author: QantumThemes
Author URI: http://qantumthemes.com
*/




if ( is_category() ) : single_cat_title();
elseif (is_page() || is_singular() ) : the_title();
elseif ( is_search() ) : printf( esc_attr(__( 'Search Results for: %s', "vlogger" )), '<span>' . esc_attr(get_search_query()) . '</span>' );
elseif ( is_tag() ) : single_tag_title();
elseif ( is_author() ) :
    the_post();
    the_author_meta('nickname');
    rewind_posts();
elseif ( is_day() ) : printf( esc_html__( 'Day: %s', "vlogger" ), '<span>' . esc_attr(get_the_date()) . '</span>' );
elseif ( is_month() ) : printf( esc_html__( 'Month: %s', "vlogger" ), '<span>' . esc_attr(get_the_date( 'F Y' )) . '</span>' );
elseif ( is_year() ) :  printf( esc_html__( 'Year: %s', "vlogger" ), '<span>' . esc_attr(get_the_date( 'Y' )) . '</span>' );
elseif ( is_tax( 'post_format', 'post-format-aside' ) ) : esc_attr_e( 'Asides', "vlogger" );
elseif ( is_tax( 'post_format', 'post-format-image' ) ) : esc_attr_e( 'Images', "vlogger");
elseif ( is_tax( 'post_format', 'post-format-video' ) ) : esc_attr_e( 'Videos', "vlogger" );
elseif ( is_tax( 'post_format', 'post-format-quote' ) ) : esc_attr_e( 'Quotes', "vlogger" );
elseif ( is_tax( 'post_format', 'post-format-link' ) ) : esc_attr_e( 'Links', "vlogger" );
elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) : esc_attr_e( 'Galleries', "vlogger" );
elseif ( is_tax( 'post_format', 'post-format-audio' ) ) : esc_attr_e( 'Sounds', "vlogger" );
/*
*
*   Custom post type titles
*
*/
elseif(is_post_type_archive( 'show' ) || is_tax('genre')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name).' ';
            } 
            esc_html_e("Shows","vlogger");

elseif(is_post_type_archive( 'chart' ) || is_tax('chartcategory')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name).' ';
            } 
            esc_html_e("charts","vlogger");            
elseif(is_post_type_archive( 'qtvideo' ) || is_tax('vdl_filters')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name).' ';
            } 
            esc_html_e("videos","vlogger");    

elseif (is_post_type_archive( 'members' ) || is_tax('membertype')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name).' ';
            } else {
                esc_html_e("Team Members","vlogger");  
            }

elseif (is_post_type_archive( 'podcast' ) || is_tax('podcastfilter')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name);
            } else {
                esc_html_e("Podcast","vlogger"); 
            }
elseif (is_post_type_archive( 'testimonial' ) || is_tax('testimonial-category')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name);
            } else {
                esc_html_e("Testimonials","vlogger"); 
            }
elseif (is_post_type_archive( 'event' ) || is_tax('eventtype')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name).' ';
            } else {
                esc_html_e("Events","vlogger"); 
            }

elseif (is_post_type_archive( 'vlogger_serie' ) || is_tax('vlogger_seriescategory')):      
            $termname = '';
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(is_object($term)){
                echo esc_attr($term->name).' ';
            } else {
                esc_html_e("Series","vlogger"); 
            }

else: esc_attr_e( 'Blog', "vlogger" );
endif;
?>