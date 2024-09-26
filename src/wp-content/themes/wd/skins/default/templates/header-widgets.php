<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WD
 * @since WD 1.0
 */

// Header sidebar
$wd_header_name    = wd_get_theme_option( 'header_widgets' );
$wd_header_present = ! wd_is_off( $wd_header_name ) && is_active_sidebar( $wd_header_name );
if ( $wd_header_present ) {
	wd_storage_set( 'current_sidebar', 'header' );
	$wd_header_wide = wd_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $wd_header_name ) ) {
		dynamic_sidebar( $wd_header_name );
	}
	$wd_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $wd_widgets_output ) ) {
		$wd_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $wd_widgets_output );
		$wd_need_columns   = strpos( $wd_widgets_output, 'columns_wrap' ) === false;
		if ( $wd_need_columns ) {
			$wd_columns = max( 0, (int) wd_get_theme_option( 'header_columns' ) );
			if ( 0 == $wd_columns ) {
				$wd_columns = min( 6, max( 1, wd_tags_count( $wd_widgets_output, 'aside' ) ) );
			}
			if ( $wd_columns > 1 ) {
				$wd_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $wd_columns ) . ' widget', $wd_widgets_output );
			} else {
				$wd_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $wd_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<?php do_action( 'wd_action_before_sidebar_wrap', 'header' ); ?>
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $wd_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $wd_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'wd_action_before_sidebar', 'header' );
				wd_show_layout( $wd_widgets_output );
				do_action( 'wd_action_after_sidebar', 'header' );
				if ( $wd_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $wd_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
			<?php do_action( 'wd_action_after_sidebar_wrap', 'header' ); ?>
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
