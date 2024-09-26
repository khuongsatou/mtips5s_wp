<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WD
 * @since WD 1.0
 */

							do_action( 'wd_action_page_content_end_text' );
							
							// Widgets area below the content
							wd_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'wd_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'wd_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'wd_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'wd_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$wd_body_style = wd_get_theme_option( 'body_style' );
					$wd_widgets_name = wd_get_theme_option( 'widgets_below_page' );
					$wd_show_widgets = ! wd_is_off( $wd_widgets_name ) && is_active_sidebar( $wd_widgets_name );
					$wd_show_related = wd_is_single() && wd_get_theme_option( 'related_position' ) == 'below_page';
					if ( $wd_show_widgets || $wd_show_related ) {
						if ( 'fullscreen' != $wd_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $wd_show_related ) {
							do_action( 'wd_action_related_posts' );
						}

						// Widgets area below page content
						if ( $wd_show_widgets ) {
							wd_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $wd_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'wd_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'wd_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! wd_is_singular( 'post' ) && ! wd_is_singular( 'attachment' ) ) || ! in_array ( wd_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="wd_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'wd_action_before_footer' );

				// Footer
				$wd_footer_type = wd_get_theme_option( 'footer_type' );
				if ( 'custom' == $wd_footer_type && ! wd_is_layouts_available() ) {
					$wd_footer_type = 'default';
				}
				get_template_part( apply_filters( 'wd_filter_get_template_part', "templates/footer-" . sanitize_file_name( $wd_footer_type ) ) );

				do_action( 'wd_action_after_footer' );

			}
			?>

			<?php do_action( 'wd_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'wd_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'wd_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>