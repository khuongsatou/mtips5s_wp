<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WD
 * @since WD 1.0
 */

// Page (category, tag, archive, author) title

if ( wd_need_page_title() ) {
	wd_sc_layouts_showed( 'title', true );
	wd_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								wd_show_post_meta(
									apply_filters(
										'wd_filter_post_meta_args', array(
											'components' => join( ',', wd_array_get_keys_by_value( wd_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', wd_array_get_keys_by_value( wd_get_theme_option( 'counters' ) ) ),
											'seo'        => wd_is_on( wd_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$wd_blog_title           = wd_get_blog_title();
							$wd_blog_title_text      = '';
							$wd_blog_title_class     = '';
							$wd_blog_title_link      = '';
							$wd_blog_title_link_text = '';
							if ( is_array( $wd_blog_title ) ) {
								$wd_blog_title_text      = $wd_blog_title['text'];
								$wd_blog_title_class     = ! empty( $wd_blog_title['class'] ) ? ' ' . $wd_blog_title['class'] : '';
								$wd_blog_title_link      = ! empty( $wd_blog_title['link'] ) ? $wd_blog_title['link'] : '';
								$wd_blog_title_link_text = ! empty( $wd_blog_title['link_text'] ) ? $wd_blog_title['link_text'] : '';
							} else {
								$wd_blog_title_text = $wd_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $wd_blog_title_class ); ?>">
								<?php
								$wd_top_icon = wd_get_term_image_small();
								if ( ! empty( $wd_top_icon ) ) {
									$wd_attr = wd_getimagesize( $wd_top_icon );
									?>
									<img src="<?php echo esc_url( $wd_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'wd' ); ?>"
										<?php
										if ( ! empty( $wd_attr[3] ) ) {
											wd_show_layout( $wd_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $wd_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $wd_blog_title_link ) && ! empty( $wd_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $wd_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $wd_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'wd_action_breadcrumbs' );
						$wd_breadcrumbs = ob_get_contents();
						ob_end_clean();
						wd_show_layout( $wd_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
