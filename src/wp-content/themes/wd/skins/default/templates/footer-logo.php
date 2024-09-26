<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WD
 * @since WD 1.0.10
 */

// Logo
if ( wd_is_on( wd_get_theme_option( 'logo_in_footer' ) ) ) {
	$wd_logo_image = wd_get_logo_image( 'footer' );
	$wd_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $wd_logo_image['logo'] ) || ! empty( $wd_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $wd_logo_image['logo'] ) ) {
					$wd_attr = wd_getimagesize( $wd_logo_image['logo'] );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $wd_logo_image['logo'] ) . '"'
								. ( ! empty( $wd_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $wd_logo_image['logo_retina'] ) . ' 2x"' : '' )
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'wd' ) . '"'
								. ( ! empty( $wd_attr[3] ) ? ' ' . wp_kses_data( $wd_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $wd_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $wd_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
