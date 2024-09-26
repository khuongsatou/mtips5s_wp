<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WD
 * @since WD 1.0.10
 */

// Footer sidebar
$wd_footer_name    = wd_get_theme_option( 'footer_widgets' );
$wd_footer_present = ! wd_is_off( $wd_footer_name ) && is_active_sidebar( $wd_footer_name );
if ( $wd_footer_present ) {
	wd_storage_set( 'current_sidebar', 'footer' );
	$wd_footer_wide = wd_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $wd_footer_name ) ) {
		dynamic_sidebar( $wd_footer_name );
	}
	$wd_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $wd_out ) ) {
		$wd_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $wd_out );
		$wd_need_columns = true;   //or check: strpos($wd_out, 'columns_wrap')===false;
		if ( $wd_need_columns ) {
			$wd_columns = max( 0, (int) wd_get_theme_option( 'footer_columns' ) );			
			if ( 0 == $wd_columns ) {
				$wd_columns = min( 4, max( 1, wd_tags_count( $wd_out, 'aside' ) ) );
			}
			if ( $wd_columns > 1 ) {
				$wd_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $wd_columns ) . ' widget', $wd_out );
			} else {
				$wd_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $wd_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<?php do_action( 'wd_action_before_sidebar_wrap', 'footer' ); ?>
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $wd_footer_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $wd_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'wd_action_before_sidebar', 'footer' );
				wd_show_layout( $wd_out );
				do_action( 'wd_action_after_sidebar', 'footer' );
				if ( $wd_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $wd_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
			<?php do_action( 'wd_action_after_sidebar_wrap', 'footer' ); ?>
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
