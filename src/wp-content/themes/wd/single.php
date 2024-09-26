<?php
/**
 * The template to display single post
 *
 * @package WD
 * @since WD 1.0
 */

// Full post loading
$full_post_loading          = wd_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = wd_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = wd_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$wd_related_position   = wd_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$wd_posts_navigation   = wd_get_theme_option( 'posts_navigation' );
$wd_prev_post          = false;
$wd_prev_post_same_cat = wd_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( wd_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	wd_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'wd_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $wd_posts_navigation ) {
		$wd_prev_post = get_previous_post( $wd_prev_post_same_cat );  // Get post from same category
		if ( ! $wd_prev_post && $wd_prev_post_same_cat ) {
			$wd_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $wd_prev_post ) {
			$wd_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $wd_prev_post ) ) {
		wd_sc_layouts_showed( 'featured', false );
		wd_sc_layouts_showed( 'title', false );
		wd_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $wd_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/content', 'single-' . wd_get_theme_option( 'single_style' ) ), 'single-' . wd_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $wd_related_position, 'inside' ) === 0 ) {
		$wd_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'wd_action_related_posts' );
		$wd_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $wd_related_content ) ) {
			$wd_related_position_inside = max( 0, min( 9, wd_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $wd_related_position_inside ) {
				$wd_related_position_inside = mt_rand( 1, 9 );
			}

			$wd_p_number         = 0;
			$wd_related_inserted = false;
			$wd_in_block         = false;
			$wd_content_start    = strpos( $wd_content, '<div class="post_content' );
			$wd_content_end      = strrpos( $wd_content, '</div>' );

			for ( $i = max( 0, $wd_content_start ); $i < min( strlen( $wd_content ) - 3, $wd_content_end ); $i++ ) {
				if ( $wd_content[ $i ] != '<' ) {
					continue;
				}
				if ( $wd_in_block ) {
					if ( strtolower( substr( $wd_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$wd_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $wd_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $wd_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$wd_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $wd_content[ $i + 1 ] && in_array( $wd_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$wd_p_number++;
					if ( $wd_related_position_inside == $wd_p_number ) {
						$wd_related_inserted = true;
						$wd_content = ( $i > 0 ? substr( $wd_content, 0, $i ) : '' )
											. $wd_related_content
											. substr( $wd_content, $i );
					}
				}
			}
			if ( ! $wd_related_inserted ) {
				if ( $wd_content_end > 0 ) {
					$wd_content = substr( $wd_content, 0, $wd_content_end ) . $wd_related_content . substr( $wd_content, $wd_content_end );
				} else {
					$wd_content .= $wd_related_content;
				}
			}
		}

		wd_show_layout( $wd_content );
	}

	// Comments
	do_action( 'wd_action_before_comments' );
	comments_template();
	do_action( 'wd_action_after_comments' );

	// Related posts
	if ( 'below_content' == $wd_related_position
		&& ( 'scroll' != $wd_posts_navigation || wd_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || wd_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'wd_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $wd_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $wd_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $wd_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $wd_prev_post ) ); ?>"
			<?php do_action( 'wd_action_nav_links_single_scroll_data', $wd_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
