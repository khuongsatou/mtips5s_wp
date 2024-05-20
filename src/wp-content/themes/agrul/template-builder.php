<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : agrul
 * @version   : 1.0
 * @Author    : agrul
 * @Author URI: https://themeforest.net/user/validthemes/portfolio
 * Template Name: Template Builder
 */

//Header
get_header();

// Container or wrapper div
$agrul_layout = agrul_meta( 'custom_page_layout' );

if( $agrul_layout == '1' ){
	echo '<div class="agrul-main-wrapper">';
		echo '<div class="container">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
}elseif( $agrul_layout == '2' ){
    echo '<div class="agrul-main-wrapper">';
		echo '<div class="container-fluid">';
			echo '<div class="row">';
				echo '<div class="col-sm-12">';
}else{
	echo '<div class="agrul-fluid">';
}
	echo '<div class="builder-page-wrapper">';
	// Query
	if( have_posts() ){
		while( have_posts() ){
			the_post();
			the_content();
		}
        wp_reset_postdata();
	}

	echo '</div>';
if( $agrul_layout == '1' ){
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}elseif( $agrul_layout == '2' ){
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}else{
	echo '</div>';
}

//footer
get_footer();