<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WD
 * @since WD 1.0
 */

$wd_args = get_query_var( 'wd_logo_args' );

// Site logo
$wd_logo_type   = isset( $wd_args['type'] ) ? $wd_args['type'] : '';
$wd_logo_image  = wd_get_logo_image( $wd_logo_type );
$wd_logo_text   = wd_is_on( wd_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$wd_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $wd_logo_image['logo'] ) || ! empty( $wd_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $wd_logo_image['logo'] ) ) {
            if ( empty( $wd_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric($wd_logo_image['logo']) && (int) $wd_logo_image['logo'] > 0 ) {
				the_custom_logo();
			} else {
				$wd_attr = wd_getimagesize( $wd_logo_image['logo'] );
				echo '<img src="' . esc_url( $wd_logo_image['logo'] ) . '"'
						. ( ! empty( $wd_logo_image['logo_retina'] ) ? ' srcset="' . esc_url( $wd_logo_image['logo_retina'] ) . ' 2x"' : '' )
						. ' alt="' . esc_attr( $wd_logo_text ) . '"'
						. ( ! empty( $wd_attr[3] ) ? ' ' . wp_kses_data( $wd_attr[3] ) : '' )
						. '>';
			}
		} else {
			wd_show_layout( wd_prepare_macros( $wd_logo_text ), '<span class="logo_text">', '</span>' );
			wd_show_layout( wd_prepare_macros( $wd_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
