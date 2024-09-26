<?php
/**
 * The template to display default site footer
 *
 * @package WD
 * @since WD 1.0.10
 */

$wd_footer_id = wd_get_custom_footer_id();
$wd_footer_meta = get_post_meta( $wd_footer_id, 'trx_addons_options', true );
if ( ! empty( $wd_footer_meta['margin'] ) ) {
	wd_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( wd_prepare_css_value( $wd_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $wd_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $wd_footer_id ) ) ); ?>
						<?php
						$wd_footer_scheme = wd_get_theme_option( 'footer_scheme' );
						if ( ! empty( $wd_footer_scheme ) && ! wd_is_inherit( $wd_footer_scheme  ) ) {
							echo ' scheme_' . esc_attr( $wd_footer_scheme );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'wd_action_show_layout', $wd_footer_id );
	?>
</footer><!-- /.footer_wrap -->
