<div class="front_page_section front_page_section_contacts<?php
	$wd_scheme = wd_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! empty( $wd_scheme ) && ! wd_is_inherit( $wd_scheme ) ) {
		echo ' scheme_' . esc_attr( $wd_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( wd_get_theme_option( 'front_page_contacts_paddings' ) );
	if ( wd_get_theme_option( 'front_page_contacts_stack' ) ) {
		echo ' sc_stack_section_on';
	}
?>"
		<?php
		$wd_css      = '';
		$wd_bg_image = wd_get_theme_option( 'front_page_contacts_bg_image' );
		if ( ! empty( $wd_bg_image ) ) {
			$wd_css .= 'background-image: url(' . esc_url( wd_get_attachment_url( $wd_bg_image ) ) . ');';
		}
		if ( ! empty( $wd_css ) ) {
			echo ' style="' . esc_attr( $wd_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$wd_anchor_icon = wd_get_theme_option( 'front_page_contacts_anchor_icon' );
	$wd_anchor_text = wd_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $wd_anchor_icon ) || ! empty( $wd_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $wd_anchor_icon ) ? ' icon="' . esc_attr( $wd_anchor_icon ) . '"' : '' )
									. ( ! empty( $wd_anchor_text ) ? ' title="' . esc_attr( $wd_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( wd_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' wd-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$wd_css      = '';
			$wd_bg_mask  = wd_get_theme_option( 'front_page_contacts_bg_mask' );
			$wd_bg_color_type = wd_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $wd_bg_color_type ) {
				$wd_bg_color = wd_get_theme_option( 'front_page_contacts_bg_color' );
			} elseif ( 'scheme_bg_color' == $wd_bg_color_type ) {
				$wd_bg_color = wd_get_scheme_color( 'bg_color', $wd_scheme );
			} else {
				$wd_bg_color = '';
			}
			if ( ! empty( $wd_bg_color ) && $wd_bg_mask > 0 ) {
				$wd_css .= 'background-color: ' . esc_attr(
					1 == $wd_bg_mask ? $wd_bg_color : wd_hex2rgba( $wd_bg_color, $wd_bg_mask )
				) . ';';
			}
			if ( ! empty( $wd_css ) ) {
				echo ' style="' . esc_attr( $wd_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$wd_caption     = wd_get_theme_option( 'front_page_contacts_caption' );
			$wd_description = wd_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $wd_caption ) || ! empty( $wd_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $wd_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $wd_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $wd_caption, 'wd_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $wd_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $wd_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $wd_description ), 'wd_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$wd_content = wd_get_theme_option( 'front_page_contacts_content' );
			$wd_layout  = wd_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $wd_layout && ( ! empty( $wd_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $wd_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $wd_content ) ? 'filled' : 'empty'; ?>">
					<?php
					echo wp_kses( $wd_content, 'wd_kses_content' );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $wd_layout && ( ! empty( $wd_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$wd_sc = wd_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $wd_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $wd_sc ) ? 'filled' : 'empty'; ?>">
					<?php
					wd_show_layout( do_shortcode( $wd_sc ) );
					?>
				</div>
				<?php
			}

			if ( 'columns' == $wd_layout && ( ! empty( $wd_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
