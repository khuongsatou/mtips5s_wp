<?php
/**
 * The template to display default site header
 *
 * @package WD
 * @since WD 1.0
 */

$wd_header_css   = '';
$wd_header_image = get_header_image();
$wd_header_video = wd_get_header_video();
if ( ! empty( $wd_header_image ) && wd_trx_addons_featured_image_override( is_singular() || wd_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$wd_header_image = wd_get_current_mode_image( $wd_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $wd_header_image ) || ! empty( $wd_header_video ) ? ' with_bg_image' : ' without_bg_image';
	if ( '' != $wd_header_video ) {
		echo ' with_bg_video';
	}
	if ( '' != $wd_header_image ) {
		echo ' ' . esc_attr( wd_add_inline_css_class( 'background-image: url(' . esc_url( $wd_header_image ) . ');' ) );
	}
	if ( is_single() && has_post_thumbnail() ) {
		echo ' with_featured_image';
	}
	if ( wd_is_on( wd_get_theme_option( 'header_fullheight' ) ) ) {
		echo ' header_fullheight wd-full-height';
	}
	$wd_header_scheme = wd_get_theme_option( 'header_scheme' );
	if ( ! empty( $wd_header_scheme ) && ! wd_is_inherit( $wd_header_scheme  ) ) {
		echo ' scheme_' . esc_attr( $wd_header_scheme );
	}
	?>
">
	<?php

	// Background video
	if ( ! empty( $wd_header_video ) ) {
		get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-video' ) );
	}

	// Main menu
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-navi' ) );

	// Mobile header
	if ( wd_is_on( wd_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	if ( ! is_single() ) {
		get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-title' ) );
	}

	// Header widgets area
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-widgets' ) );
	?>
</header>
