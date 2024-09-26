<?php
/**
 * The template to display default site footer
 *
 * @package WD
 * @since WD 1.0.10
 */

?>
<footer class="footer_wrap footer_default
<?php
$wd_footer_scheme = wd_get_theme_option( 'footer_scheme' );
if ( ! empty( $wd_footer_scheme ) && ! wd_is_inherit( $wd_footer_scheme  ) ) {
	echo ' scheme_' . esc_attr( $wd_footer_scheme );
}
?>
				">
	<?php

	// Footer widgets area
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/footer-widgets' ) );

	// Logo
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/footer-logo' ) );

	// Socials
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/footer-socials' ) );

	// Copyright area
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/footer-copyright' ) );

	?>
</footer><!-- /.footer_wrap -->
