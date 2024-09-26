<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WD
 * @since WD 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
$wd_copyright_scheme = wd_get_theme_option( 'copyright_scheme' );
if ( ! empty( $wd_copyright_scheme ) && ! wd_is_inherit( $wd_copyright_scheme  ) ) {
	echo ' scheme_' . esc_attr( $wd_copyright_scheme );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$wd_copyright = wd_get_theme_option( 'copyright' );
			if ( ! empty( $wd_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$wd_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $wd_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$wd_copyright = wd_prepare_macros( $wd_copyright );
				// Display copyright
				echo wp_kses( nl2br( $wd_copyright ), 'wd_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
