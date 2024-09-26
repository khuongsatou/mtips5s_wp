<?php
/**
 * The template to display Admin notices
 *
 * @package WD
 * @since WD 1.0.64
 */

$wd_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$wd_skins_args = get_query_var( 'wd_skins_notice_args' );
?>
<div class="wd_admin_notice wd_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins available', 'wd' ); ?>
	</h3>
	<?php

	// Description
	$wd_total      = $wd_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$wd_skins_msg  = $wd_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $wd_total, 'wd' ), $wd_total ) . '</strong>'
							: '';
	$wd_total      = $wd_skins_args['free'];
	$wd_skins_msg .= $wd_total > 0
							? ( ! empty( $wd_skins_msg ) ? ' ' . esc_html__( 'and', 'wd' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $wd_total, 'wd' ), $wd_total ) . '</strong>'
							: '';
	$wd_total      = $wd_skins_args['pay'];
	$wd_skins_msg .= $wd_skins_args['pay'] > 0
							? ( ! empty( $wd_skins_msg ) ? ' ' . esc_html__( 'and', 'wd' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $wd_total, 'wd' ), $wd_total ) . '</strong>'
							: '';
	?>
	<div class="wd_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'wd' ), $wd_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="wd_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $wd_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'wd' );
			?>
		</a>
	</div>
</div>
