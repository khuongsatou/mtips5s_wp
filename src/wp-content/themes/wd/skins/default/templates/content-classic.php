<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WD
 * @since WD 1.0
 */

$wd_template_args = get_query_var( 'wd_template_args' );

if ( is_array( $wd_template_args ) ) {
	$wd_columns    = empty( $wd_template_args['columns'] ) ? 2 : max( 1, $wd_template_args['columns'] );
	$wd_blog_style = array( $wd_template_args['type'], $wd_columns );
    $wd_columns_class = wd_get_column_class( 1, $wd_columns, ! empty( $wd_template_args['columns_tablet']) ? $wd_template_args['columns_tablet'] : '', ! empty($wd_template_args['columns_mobile']) ? $wd_template_args['columns_mobile'] : '' );
} else {
	$wd_blog_style = explode( '_', wd_get_theme_option( 'blog_style' ) );
	$wd_columns    = empty( $wd_blog_style[1] ) ? 2 : max( 1, $wd_blog_style[1] );
    $wd_columns_class = wd_get_column_class( 1, $wd_columns );
}
$wd_expanded   = ! wd_sidebar_present() && wd_get_theme_option( 'expand_content' ) == 'expand';

$wd_post_format = get_post_format();
$wd_post_format = empty( $wd_post_format ) ? 'standard' : str_replace( 'post-format-', '', $wd_post_format );

?><div class="<?php
	if ( ! empty( $wd_template_args['slider'] ) ) {
		echo ' slider-slide swiper-slide';
	} else {
		echo ( wd_is_blog_style_use_masonry( $wd_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $wd_columns ) : esc_attr( $wd_columns_class ) );
	}
?>"><article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $wd_post_format )
				. ' post_layout_classic post_layout_classic_' . esc_attr( $wd_columns )
				. ' post_layout_' . esc_attr( $wd_blog_style[0] )
				. ' post_layout_' . esc_attr( $wd_blog_style[0] ) . '_' . esc_attr( $wd_columns )
	);
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
								: explode( ',', $wd_template_args['meta_parts'] )
								)
							: wd_array_get_keys_by_value( wd_get_theme_option( 'meta_parts' ) );

	wd_show_post_featured( apply_filters( 'wd_filter_args_featured',
		array(
			'thumb_size' => ! empty( $wd_template_args['thumb_size'] )
				? $wd_template_args['thumb_size']
				: wd_get_thumb_size(
				'classic' == $wd_blog_style[0]
						? ( strpos( wd_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $wd_columns > 2 ? 'big' : 'huge' )
								: ( $wd_columns > 2
									? ( $wd_expanded ? 'square' : 'square' )
									: ($wd_columns > 1 ? 'square' : ( $wd_expanded ? 'huge' : 'big' ))
									)
							)
						: ( strpos( wd_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $wd_columns > 2 ? 'masonry-big' : 'full' )
								: ($wd_columns === 1 ? ( $wd_expanded ? 'huge' : 'big' ) : ( $wd_columns <= 2 && $wd_expanded ? 'masonry-big' : 'masonry' ))
							)
			),
			'hover'      => $wd_hover,
			'meta_parts' => $wd_components,
			'no_links'   => ! empty( $wd_template_args['no_links'] ),
        ),
        'content-classic',
        $wd_template_args
    ) );

	// Title and post meta
	$wd_show_title = get_the_title() != '';
	$wd_show_meta  = count( $wd_components ) > 0 && ! in_array( $wd_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $wd_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php

			// Post meta
			if ( apply_filters( 'wd_filter_show_blog_meta', $wd_show_meta, $wd_components, 'classic' ) ) {
				if ( count( $wd_components ) > 0 ) {
					do_action( 'wd_action_before_post_meta' );
					wd_show_post_meta(
						apply_filters(
							'wd_filter_post_meta_args', array(
							'components' => join( ',', $wd_components ),
							'seo'        => false,
							'echo'       => true,
						), $wd_blog_style[0], $wd_columns
						)
					);
					do_action( 'wd_action_after_post_meta' );
				}
			}

			// Post title
			if ( apply_filters( 'wd_filter_show_blog_title', true, 'classic' ) ) {
				do_action( 'wd_action_before_post_title' );
				if ( empty( $wd_template_args['no_links'] ) ) {
					the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
				} else {
					the_title( '<h4 class="post_title entry-title">', '</h4>' );
				}
				do_action( 'wd_action_after_post_title' );
			}

			if( !in_array( $wd_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
				// More button
				if ( apply_filters( 'wd_filter_show_blog_readmore', ! $wd_show_title || ! empty( $wd_template_args['more_button'] ), 'classic' ) ) {
					if ( empty( $wd_template_args['no_links'] ) ) {
						do_action( 'wd_action_before_post_readmore' );
						wd_show_post_more_link( $wd_template_args, '<div class="more-wrap">', '</div>' );
						do_action( 'wd_action_after_post_readmore' );
					}
				}
			}
			?>
		</div><!-- .entry-header -->
		<?php
	}

	// Post content
	if( in_array( $wd_post_format, array( 'quote', 'aside', 'link', 'status' ) ) ) {
		ob_start();
		if (apply_filters('wd_filter_show_blog_excerpt', empty($wd_template_args['hide_excerpt']) && wd_get_theme_option('excerpt_length') > 0, 'classic')) {
			wd_show_post_content($wd_template_args, '<div class="post_content_inner">', '</div>');
		}
		// More button
		if(! empty( $wd_template_args['more_button'] )) {
			if ( empty( $wd_template_args['no_links'] ) ) {
				do_action( 'wd_action_before_post_readmore' );
				wd_show_post_more_link( $wd_template_args, '<div class="more-wrap">', '</div>' );
				do_action( 'wd_action_after_post_readmore' );
			}
		}
		$wd_content = ob_get_contents();
		ob_end_clean();
		wd_show_layout($wd_content, '<div class="post_content entry-content">', '</div><!-- .entry-content -->');
	}
	?>

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
