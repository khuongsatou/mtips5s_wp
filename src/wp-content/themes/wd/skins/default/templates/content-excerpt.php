<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WD
 * @since WD 1.0
 */

$wd_template_args = get_query_var( 'wd_template_args' );
$wd_columns = 1;
if ( is_array( $wd_template_args ) ) {
	$wd_columns    = empty( $wd_template_args['columns'] ) ? 1 : max( 1, $wd_template_args['columns'] );
	$wd_blog_style = array( $wd_template_args['type'], $wd_columns );
	if ( ! empty( $wd_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $wd_columns > 1 ) {
	    $wd_columns_class = wd_get_column_class( 1, $wd_columns, ! empty( $wd_template_args['columns_tablet']) ? $wd_template_args['columns_tablet'] : '', ! empty($wd_template_args['columns_mobile']) ? $wd_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $wd_columns_class ); ?>">
		<?php
	}
}
$wd_expanded    = ! wd_sidebar_present() && wd_get_theme_option( 'expand_content' ) == 'expand';
$wd_post_format = get_post_format();
$wd_post_format = empty( $wd_post_format ) ? 'standard' : str_replace( 'post-format-', '', $wd_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $wd_post_format ) );
	wd_add_blog_animation( $wd_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$wd_hover      = ! empty( $wd_template_args['hover'] ) && ! wd_is_inherit( $wd_template_args['hover'] )
							? $wd_template_args['hover']
							: wd_get_theme_option( 'image_hover' );
	$wd_components = ! empty( $wd_template_args['meta_parts'] )
							? ( is_array( $wd_template_args['meta_parts'] )
								? $wd_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $wd_template_args['meta_parts'] ) )
								)
							: wd_array_get_keys_by_value( wd_get_theme_option( 'meta_parts' ) );
	wd_show_post_featured( apply_filters( 'wd_filter_args_featured',
		array(
			'no_links'   => ! empty( $wd_template_args['no_links'] ),
			'hover'      => $wd_hover,
			'meta_parts' => $wd_components,
			'thumb_size' => ! empty( $wd_template_args['thumb_size'] )
							? $wd_template_args['thumb_size']
							: wd_get_thumb_size( strpos( wd_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $wd_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$wd_template_args
	) );

	// Title and post meta
	$wd_show_title = get_the_title() != '';
	$wd_show_meta  = count( $wd_components ) > 0 && ! in_array( $wd_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $wd_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			if ( apply_filters( 'wd_filter_show_blog_title', true, 'excerpt' ) ) {
				do_action( 'wd_action_before_post_title' );
				if ( empty( $wd_template_args['no_links'] ) ) {
					the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
				} else {
					the_title( '<h3 class="post_title entry-title">', '</h3>' );
				}
				do_action( 'wd_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	if ( apply_filters( 'wd_filter_show_blog_excerpt', empty( $wd_template_args['hide_excerpt'] ) && wd_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
		?>
		<div class="post_content entry-content">
			<?php

			// Post meta
			if ( apply_filters( 'wd_filter_show_blog_meta', $wd_show_meta, $wd_components, 'excerpt' ) ) {
				if ( count( $wd_components ) > 0 ) {
					do_action( 'wd_action_before_post_meta' );
					wd_show_post_meta(
						apply_filters(
							'wd_filter_post_meta_args', array(
								'components' => join( ',', $wd_components ),
								'seo'        => false,
								'echo'       => true,
							), 'excerpt', 1
						)
					);
					do_action( 'wd_action_after_post_meta' );
				}
			}

			if ( wd_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'wd_action_before_full_post_content' );
					the_content( '' );
					do_action( 'wd_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'wd' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'wd' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				wd_show_post_content( $wd_template_args, '<div class="post_content_inner">', '</div>' );
			}

			// More button
			if ( apply_filters( 'wd_filter_show_blog_readmore',  ! isset( $wd_template_args['more_button'] ) || ! empty( $wd_template_args['more_button'] ), 'excerpt' ) ) {
				if ( empty( $wd_template_args['no_links'] ) ) {
					do_action( 'wd_action_before_post_readmore' );
					if ( wd_get_theme_option( 'blog_content' ) != 'fullpost' ) {
						wd_show_post_more_link( $wd_template_args, '<p>', '</p>' );
					} else {
						wd_show_post_comments_link( $wd_template_args, '<p>', '</p>' );
					}
					do_action( 'wd_action_after_post_readmore' );
				}
			}

			?>
		</div><!-- .entry-content -->
		<?php
	}
	?>
</article>
<?php

if ( is_array( $wd_template_args ) ) {
	if ( ! empty( $wd_template_args['slider'] ) || $wd_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
