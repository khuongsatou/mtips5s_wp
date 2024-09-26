<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WD
 * @since WD 1.0
 */

if ( wd_sidebar_present() ) {
	
	$wd_sidebar_type = wd_get_theme_option( 'sidebar_type' );
	if ( 'custom' == $wd_sidebar_type && ! wd_is_layouts_available() ) {
		$wd_sidebar_type = 'default';
	}
	
	// Catch output to the buffer
	ob_start();
	if ( 'default' == $wd_sidebar_type ) {
		// Default sidebar with widgets
		$wd_sidebar_name = wd_get_theme_option( 'sidebar_widgets' );
		wd_storage_set( 'current_sidebar', 'sidebar' );
		if ( is_active_sidebar( $wd_sidebar_name ) ) {
			dynamic_sidebar( $wd_sidebar_name );
		}
	} else {
		// Custom sidebar from Layouts Builder
		$wd_sidebar_id = wd_get_custom_sidebar_id();
		do_action( 'wd_action_show_layout', $wd_sidebar_id );
	}
	$wd_out = trim( ob_get_contents() );
	ob_end_clean();
	
	// If any html is present - display it
	if ( ! empty( $wd_out ) ) {
		$wd_sidebar_position    = wd_get_theme_option( 'sidebar_position' );
		$wd_sidebar_position_ss = wd_get_theme_option( 'sidebar_position_ss' );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $wd_sidebar_position );
			echo ' sidebar_' . esc_attr( $wd_sidebar_position_ss );
			echo ' sidebar_' . esc_attr( $wd_sidebar_type );

			$wd_sidebar_scheme = apply_filters( 'wd_filter_sidebar_scheme', wd_get_theme_option( 'sidebar_scheme' ) );
			if ( ! empty( $wd_sidebar_scheme ) && ! wd_is_inherit( $wd_sidebar_scheme ) && 'custom' != $wd_sidebar_type ) {
				echo ' scheme_' . esc_attr( $wd_sidebar_scheme );
			}
			?>
		" role="complementary">
			<?php

			// Skip link anchor to fast access to the sidebar from keyboard
			?>
			<a id="sidebar_skip_link_anchor" class="wd_skip_link_anchor" href="#"></a>
			<?php

			do_action( 'wd_action_before_sidebar_wrap', 'sidebar' );

			// Button to show/hide sidebar on mobile
			if ( in_array( $wd_sidebar_position_ss, array( 'above', 'float' ) ) ) {
				$wd_title = apply_filters( 'wd_filter_sidebar_control_title', 'float' == $wd_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'wd' ) : '' );
				$wd_text  = apply_filters( 'wd_filter_sidebar_control_text', 'above' == $wd_sidebar_position_ss ? esc_html__( 'Show Sidebar', 'wd' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $wd_title ); ?>"><?php echo esc_html( $wd_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'wd_action_before_sidebar', 'sidebar' );
				wd_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $wd_out ) );
				do_action( 'wd_action_after_sidebar', 'sidebar' );
				?>
			</div>
			<?php

			do_action( 'wd_action_after_sidebar_wrap', 'sidebar' );

			?>
		</div>
		<div class="clearfix"></div>
		<?php
	}
}
