<?php
/**
 * The template to display Admin notices
 *
 * @package WD
 * @since WD 1.0.1
 */

$wd_theme_slug = get_option( 'template' );
$wd_theme_obj  = wp_get_theme( $wd_theme_slug );
?>
<div class="wd_admin_notice wd_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$wd_theme_img = wd_get_file_url( 'screenshot.jpg' );
	if ( '' != $wd_theme_img ) {
		?>
		<div class="wd_notice_image"><img src="<?php echo esc_url( $wd_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'wd' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="wd_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'wd' ),
				$wd_theme_obj->get( 'Name' ) . ( WD_THEME_FREE ? ' ' . __( 'Free', 'wd' ) : '' ),
				$wd_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="wd_notice_text">
		<p class="wd_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $wd_theme_obj->description ) );
			?>
		</p>
		<p class="wd_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'wd' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="wd_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=wd_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'wd' );
			?>
		</a>
	</div>
</div>
