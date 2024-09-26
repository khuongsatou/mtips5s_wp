<?php
/**
 * The template to display the socials in the footer
 *
 * @package WD
 * @since WD 1.0.10
 */


// Socials
if ( wd_is_on( wd_get_theme_option( 'socials_in_footer' ) ) ) {
	$wd_output = wd_get_socials_links();
	if ( '' != $wd_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php wd_show_layout( $wd_output ); ?>
			</div>
		</div>
		<?php
	}
}
