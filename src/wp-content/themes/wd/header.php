<?php
/**
 * The Header: Logo and main menu
 *
 * @package WD
 * @since WD 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js<?php
	// Class scheme_xxx need in the <html> as context for the <body>!
	echo ' scheme_' . esc_attr( wd_get_theme_option( 'color_scheme' ) );
?>">

<head>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
	do_action( 'wd_action_before_body' );
	?>

	<div class="<?php echo esc_attr( apply_filters( 'wd_filter_body_wrap_class', 'body_wrap' ) ); ?>" <?php do_action('wd_action_body_wrap_attributes'); ?>>

		<?php do_action( 'wd_action_before_page_wrap' ); ?>

		<div class="<?php echo esc_attr( apply_filters( 'wd_filter_page_wrap_class', 'page_wrap' ) ); ?>" <?php do_action('wd_action_page_wrap_attributes'); ?>>

			<?php do_action( 'wd_action_page_wrap_start' ); ?>

			<?php
			$wd_full_post_loading = ( wd_is_singular( 'post' ) || wd_is_singular( 'attachment' ) ) && wd_get_value_gp( 'action' ) == 'full_post_loading';
			$wd_prev_post_loading = ( wd_is_singular( 'post' ) || wd_is_singular( 'attachment' ) ) && wd_get_value_gp( 'action' ) == 'prev_post_loading';

			// Don't display the header elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ! $wd_full_post_loading && ! $wd_prev_post_loading ) {

				// Short links to fast access to the content, sidebar and footer from the keyboard
				?>
				<a class="wd_skip_link skip_to_content_link" href="#content_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to content", 'wd' ); ?></a>
				<?php if ( wd_sidebar_present() ) { ?>
				<a class="wd_skip_link skip_to_sidebar_link" href="#sidebar_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to sidebar", 'wd' ); ?></a>
				<?php } ?>
				<a class="wd_skip_link skip_to_footer_link" href="#footer_skip_link_anchor" tabindex="1"><?php esc_html_e( "Skip to footer", 'wd' ); ?></a>

				<?php
				do_action( 'wd_action_before_header' );

				// Header
				$wd_header_type = wd_get_theme_option( 'header_type' );
				if ( 'custom' == $wd_header_type && ! wd_is_layouts_available() ) {
					$wd_header_type = 'default';
				}
				get_template_part( apply_filters( 'wd_filter_get_template_part', "templates/header-" . sanitize_file_name( $wd_header_type ) ) );

				// Side menu
				if ( in_array( wd_get_theme_option( 'menu_side' ), array( 'left', 'right' ) ) ) {
					get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-navi-side' ) );
				}

				// Mobile menu
				get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/header-navi-mobile' ) );

				do_action( 'wd_action_after_header' );

			}
			?>

			<?php do_action( 'wd_action_before_page_content_wrap' ); ?>

			<div class="page_content_wrap<?php
				if ( wd_is_off( wd_get_theme_option( 'remove_margins' ) ) ) {
					if ( empty( $wd_header_type ) ) {
						$wd_header_type = wd_get_theme_option( 'header_type' );
					}
					if ( 'custom' == $wd_header_type && wd_is_layouts_available() ) {
						$wd_header_id = wd_get_custom_header_id();
						if ( $wd_header_id > 0 ) {
							$wd_header_meta = wd_get_custom_layout_meta( $wd_header_id );
							if ( ! empty( $wd_header_meta['margin'] ) ) {
								?> page_content_wrap_custom_header_margin<?php
							}
						}
					}
					$wd_footer_type = wd_get_theme_option( 'footer_type' );
					if ( 'custom' == $wd_footer_type && wd_is_layouts_available() ) {
						$wd_footer_id = wd_get_custom_footer_id();
						if ( $wd_footer_id ) {
							$wd_footer_meta = wd_get_custom_layout_meta( $wd_footer_id );
							if ( ! empty( $wd_footer_meta['margin'] ) ) {
								?> page_content_wrap_custom_footer_margin<?php
							}
						}
					}
				}
				do_action( 'wd_action_page_content_wrap_class', $wd_prev_post_loading );
				?>"<?php
				if ( apply_filters( 'wd_filter_is_prev_post_loading', $wd_prev_post_loading ) ) {
					?> data-single-style="<?php echo esc_attr( wd_get_theme_option( 'single_style' ) ); ?>"<?php
				}
				do_action( 'wd_action_page_content_wrap_data', $wd_prev_post_loading );
			?>>
				<?php
				do_action( 'wd_action_page_content_wrap', $wd_full_post_loading || $wd_prev_post_loading );

				// Single posts banner
				if ( apply_filters( 'wd_filter_single_post_header', wd_is_singular( 'post' ) || wd_is_singular( 'attachment' ) ) ) {
					if ( $wd_prev_post_loading ) {
						if ( wd_get_theme_option( 'posts_navigation_scroll_which_block' ) != 'article' ) {
							do_action( 'wd_action_between_posts' );
						}
					}
					// Single post thumbnail and title
					$wd_path = apply_filters( 'wd_filter_get_template_part', 'templates/single-styles/' . wd_get_theme_option( 'single_style' ) );
					if ( wd_get_file_dir( $wd_path . '.php' ) != '' ) {
						get_template_part( $wd_path );
					}
				}

				// Widgets area above page
				$wd_body_style   = wd_get_theme_option( 'body_style' );
				$wd_widgets_name = wd_get_theme_option( 'widgets_above_page' );
				$wd_show_widgets = ! wd_is_off( $wd_widgets_name ) && is_active_sidebar( $wd_widgets_name );
				if ( $wd_show_widgets ) {
					if ( 'fullscreen' != $wd_body_style ) {
						?>
						<div class="content_wrap">
							<?php
					}
					wd_create_widgets_area( 'widgets_above_page' );
					if ( 'fullscreen' != $wd_body_style ) {
						?>
						</div>
						<?php
					}
				}

				// Content area
				do_action( 'wd_action_before_content_wrap' );
				?>
				<div class="content_wrap<?php echo 'fullscreen' == $wd_body_style ? '_fullscreen' : ''; ?>">

					<?php do_action( 'wd_action_content_wrap_start' ); ?>

					<div class="content">
						<?php
						do_action( 'wd_action_page_content_start' );

						// Skip link anchor to fast access to the content from keyboard
						?>
						<a id="content_skip_link_anchor" class="wd_skip_link_anchor" href="#"></a>
						<?php
						// Single posts banner between prev/next posts
						if ( ( wd_is_singular( 'post' ) || wd_is_singular( 'attachment' ) )
							&& $wd_prev_post_loading 
							&& wd_get_theme_option( 'posts_navigation_scroll_which_block' ) == 'article'
						) {
							do_action( 'wd_action_between_posts' );
						}

						// Widgets area above content
						wd_create_widgets_area( 'widgets_above_content' );

						do_action( 'wd_action_page_content_start_text' );
