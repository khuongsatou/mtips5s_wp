<?php
/**
 * The template to display the side menu
 *
 * @package WD
 * @since WD 1.0
 */
?>
<div class="menu_side_wrap
<?php
echo ' menu_side_' . esc_attr( wd_get_theme_option( 'menu_side_icons' ) > 0 ? 'icons' : 'dots' );
$wd_menu_scheme = wd_get_theme_option( 'menu_scheme' );
$wd_header_scheme = wd_get_theme_option( 'header_scheme' );
if ( ! empty( $wd_menu_scheme ) && ! wd_is_inherit( $wd_menu_scheme  ) ) {
	echo ' scheme_' . esc_attr( $wd_menu_scheme );
} elseif ( ! empty( $wd_header_scheme ) && ! wd_is_inherit( $wd_header_scheme ) ) {
	echo ' scheme_' . esc_attr( $wd_header_scheme );
}
?>
				">
	<span class="menu_side_button icon-menu-2"></span>

	<div class="menu_side_inner">
		<?php
		// Logo
		set_query_var( 'wd_logo_args', array( 'type' => 'side' ) );
		get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'wd_logo_args', array() );
		// Main menu button
		?>
		<div class="toc_menu_item"
			<?php
			if ( wd_mouse_helper_enabled() ) {
				echo ' data-mouse-helper="click" data-mouse-helper-axis="y" data-mouse-helper-text="' . esc_attr__( 'Open main menu', 'wd' ) . '"';
			}
			?>
		>
			<a href="#" class="toc_menu_description menu_mobile_description"><span class="toc_menu_description_title"><?php esc_html_e( 'Main menu', 'wd' ); ?></span></a>
			<a class="menu_mobile_button toc_menu_icon icon-menu-2" href="#"></a>
		</div>		
	</div>

</div><!-- /.menu_side_wrap -->
