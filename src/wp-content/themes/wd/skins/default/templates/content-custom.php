<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WD
 * @since WD 1.0.50
 */

$wd_template_args = get_query_var( 'wd_template_args' );
if ( is_array( $wd_template_args ) ) {
	$wd_columns    = empty( $wd_template_args['columns'] ) ? 2 : max( 1, $wd_template_args['columns'] );
	$wd_blog_style = array( $wd_template_args['type'], $wd_columns );
} else {
	$wd_blog_style = explode( '_', wd_get_theme_option( 'blog_style' ) );
	$wd_columns    = empty( $wd_blog_style[1] ) ? 2 : max( 1, $wd_blog_style[1] );
}
$wd_blog_id       = wd_get_custom_blog_id( join( '_', $wd_blog_style ) );
$wd_blog_style[0] = str_replace( 'blog-custom-', '', $wd_blog_style[0] );
$wd_expanded      = ! wd_sidebar_present() && wd_get_theme_option( 'expand_content' ) == 'expand';
$wd_components    = ! empty( $wd_template_args['meta_parts'] )
							? ( is_array( $wd_template_args['meta_parts'] )
								? join( ',', $wd_template_args['meta_parts'] )
								: $wd_template_args['meta_parts']
								)
							: wd_array_get_keys_by_value( wd_get_theme_option( 'meta_parts' ) );
$wd_post_format   = get_post_format();
$wd_post_format   = empty( $wd_post_format ) ? 'standard' : str_replace( 'post-format-', '', $wd_post_format );

$wd_blog_meta     = wd_get_custom_layout_meta( $wd_blog_id );
$wd_custom_style  = ! empty( $wd_blog_meta['scripts_required'] ) ? $wd_blog_meta['scripts_required'] : 'none';

if ( ! empty( $wd_template_args['slider'] ) || $wd_columns > 1 || ! wd_is_off( $wd_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $wd_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( ( wd_is_off( $wd_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $wd_custom_style ) ) . "-1_{$wd_columns}" );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $wd_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $wd_columns )
					. ' post_layout_' . esc_attr( $wd_blog_style[0] )
					. ' post_layout_' . esc_attr( $wd_blog_style[0] ) . '_' . esc_attr( $wd_columns )
					. ( ! wd_is_off( $wd_custom_style )
						? ' post_layout_' . esc_attr( $wd_custom_style )
							. ' post_layout_' . esc_attr( $wd_custom_style ) . '_' . esc_attr( $wd_columns )
						: ''
						)
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
	// Custom layout
	do_action( 'wd_action_show_layout', $wd_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $wd_template_args['slider'] ) || $wd_columns > 1 || ! wd_is_off( $wd_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
