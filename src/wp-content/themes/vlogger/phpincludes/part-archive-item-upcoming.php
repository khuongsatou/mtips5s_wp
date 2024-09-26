<?php
/*
Package: Vlogger
*/
?>
<?php  
$next_post = get_previous_post();
?>
<!-- HEADER CAPTION ========================= -->
<div <?php post_class("qt-part-archive-item qt-part-archive-item-upcoming qt-negative"); ?>>
	<div class="qt-part-archive-item-header">
		<div class="qt-archive-item-topmetas">
			<div class="qt-container">
				<p class="qt-item-metas qt-small">
					<span class="qt-posttype"><i class="<?php echo vlogger_format_icon_class( $next_post->ID ); ?>"></i> <?php echo vlogger_readingtime($next_post->ID); ?></span>
				</p>
			</div>
		</div>
		<div class="qt-vc">
			<div class="qt-headercontainer qt-vi-bottom" >
				<div class="qt-container">
					<ul class="qt-tags">
						<?php  
						/**
						 * [$category Array of categories]
						 * @var [array]
						 * We want only the first category
						 */
						$category = get_the_category( $next_post->ID ); 
						$limit = 0;
						foreach($category as $i => $cat){
							if($i > $limit){
								continue;
							}
							echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a></li>';  
						}	
						?>
					</ul>
					<div>
						<h3 class="qt-caption qt-spacer-s">
							<a href="<?php echo get_permalink( $next_post->ID ); ?>">
								<?php echo get_the_title($next_post->ID); ?>
							</a>
						</h3>
						<p class="qt-item-metas qt-small">
							<?php
							$post = get_post(get_the_ID());
							$user_id = $next_post->post_author;
							$avatar = get_avatar_url($next_post->post_author);
							?>
							<?php if('' !== $avatar){ ?>
							<a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-author-thumb"><img src="<?php echo  esc_url($avatar); ?>" alt="<?php echo esc_attr("Avatar", "vlogger"); ?>"></a> 
							<?php } ?>
							<a href="<?php echo esc_attr( get_author_posts_url( $user_id ) ); ?>" class="qt-authorurl"><?php the_author_meta( 'display_name', $user_id ); ?></a> | <?php echo vlogger_international_date(); ?>
							<a class="right qt-readmore-small" href="<?php echo get_permalink( $next_post->ID ); ?>">
								<?php esc_html_e("Read more", "vlogger" ); ?> <i class="dripicons-arrow-thin-right"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
        <div class="qt-header-bg" data-bgimage="<?php echo get_the_post_thumbnail_url(  $next_post->ID, 'full' ); ?>" data-parallax="0" data-attachment="local">
           
        </div>
	</div>
</div>
<!-- HEADER CAPTION END ========================= -->
