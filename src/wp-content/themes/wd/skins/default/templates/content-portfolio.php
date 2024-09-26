<?php
/**
 * The Portfolio template to display the content
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

$wd_post_format = get_post_format();
$wd_post_format = empty( $wd_post_format ) ? 'standard' : str_replace( 'post-format-', '', $wd_post_format );

?><div class="
<?php
if ( ! empty( $wd_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( wd_is_blog_style_use_masonry( $wd_blog_style[0] ) ? 'masonry_item masonry_item-1_' . esc_attr( $wd_columns ) : esc_attr( $wd_columns_class ));
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $wd_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $wd_columns )
		. ( 'portfolio' != $wd_blog_style[0] ? ' ' . esc_attr( $wd_blog_style[0] )  . '_' . esc_attr( $wd_columns ) : '' )
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

	$wd_hover   = ! empty( $wd_template_args['hover'] ) && ! wd_is_inherit( $wd_template_args['hover'] )
								? $wd_template_args['hover']
								: wd_get_theme_option( 'image_hover' );

	if ( 'dots' == $wd_hover ) {
		$wd_post_link = empty( $wd_template_args['no_links'] )
								? ( ! empty( $wd_template_args['link'] )
									? $wd_template_args['link']
									: get_permalink()
									)
								: '';
		$wd_target    = ! empty( $wd_post_link ) && false === strpos( $wd_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$wd_components = ! empty( $wd_template_args['meta_parts'] )
							? ( is_array( $wd_template_args['meta_parts'] )
								? $wd_template_args['meta_parts']
								: explode( ',', $wd_template_args['meta_parts'] )
								)
							: wd_array_get_keys_by_value( wd_get_theme_option( 'meta_parts' ) );

	// Featured image
	wd_show_post_featured( apply_filters( 'wd_filter_args_featured',
        array(
			'hover'         => $wd_hover,
			'no_links'      => ! empty( $wd_template_args['no_links'] ),
			'thumb_size'    => ! empty( $wd_template_args['thumb_size'] )
								? $wd_template_args['thumb_size']
								: wd_get_thumb_size(
									wd_is_blog_style_use_masonry( $wd_blog_style[0] )
										? (	strpos( wd_get_theme_option( 'body_style' ), 'full' ) !== false || $wd_columns < 3
											? 'masonry-big'
											: 'masonry'
											)
										: (	strpos( wd_get_theme_option( 'body_style' ), 'full' ) !== false || $wd_columns < 3
											? 'square'
											: 'square'
											)
								),
			'thumb_bg' => wd_is_blog_style_use_masonry( $wd_blog_style[0] ) ? false : true,
			'show_no_image' => true,
			'meta_parts'    => $wd_components,
			'class'         => 'dots' == $wd_hover ? 'hover_with_info' : '',
			'post_info'     => 'dots' == $wd_hover
										? '<div class="post_info"><h5 class="post_title">'
											. ( ! empty( $wd_post_link )
												? '<a href="' . esc_url( $wd_post_link ) . '"' . ( ! empty( $target ) ? $target : '' ) . '>'
												: ''
												)
												. esc_html( get_the_title() ) 
											. ( ! empty( $wd_post_link )
												? '</a>'
												: ''
												)
											. '</h5></div>'
										: '',
            'thumb_ratio'   => 'info' == $wd_hover ?  '100:102' : '',
        ),
        'content-portfolio',
        $wd_template_args
    ) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!