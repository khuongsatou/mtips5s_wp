<?php
/**
 * The template to display the background video in the header
 *
 * @package WD
 * @since WD 1.0.14
 */
$wd_header_video = wd_get_header_video();
$wd_embed_video  = '';
if ( ! empty( $wd_header_video ) && ! wd_is_from_uploads( $wd_header_video ) ) {
	if ( wd_is_youtube_url( $wd_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $wd_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php wd_show_layout( wd_get_embed_video( $wd_header_video ) ); ?></div>
		<?php
	}
}
