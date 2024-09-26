<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WD
 * @since WD 1.0.06
 */

$wd_header_css   = '';
$wd_header_image = get_header_image();
$wd_header_video = wd_get_header_video();
if ( ! empty( $wd_header_image ) && wd_trx_addons_featured_image_override( is_singular() || wd_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$wd_header_image = wd_get_current_mode_image( $wd_header_image );
}

$wd_header_id = wd_get_custom_header_id();
$wd_header_meta = get_post_meta( $wd_header_id, 'trx_addons_options', true );
if ( ! empty( $wd_header_meta['margin'] ) ) {
	wd_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( wd_prepare_css_value( $wd_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $wd_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $wd_header_id ) ) ); ?>
				<?php
				echo ! empty( $wd_header_image ) || ! empty( $wd_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
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

	// Custom header's layout
	do_action( 'wd_action_show_layout', $wd_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
