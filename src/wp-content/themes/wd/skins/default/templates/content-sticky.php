<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WD
 * @since WD 1.0
 */

$wd_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$wd_post_format = get_post_format();
$wd_post_format = empty( $wd_post_format ) ? 'standard' : str_replace( 'post-format-', '', $wd_post_format );

?><div class="column-1_<?php echo esc_attr( $wd_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $wd_post_format ) );
	wd_add_blog_animation( $wd_template_args );
	?>
>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	wd_show_post_featured(
		array(
			'thumb_size' => wd_get_thumb_size( 1 == $wd_columns ? 'big' : ( 2 == $wd_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $wd_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			wd_show_post_meta( apply_filters( 'wd_filter_post_meta_args', array(), 'sticky', $wd_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
