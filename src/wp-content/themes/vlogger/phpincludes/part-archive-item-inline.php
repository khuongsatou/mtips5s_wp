<?php
/*
Package: Vlogger
*/
?>


<!-- ITEM INLINE  ========================= -->
<div <?php post_class("qt-part-archive-item qt-part-archive-item-inline"); ?>>
	<a href="<?php the_permalink(); ?>">
		<?php if(has_post_thumbnail( )) {?>
		<img width="150" height="150" src="<?php echo get_the_post_thumbnail_url(null, "post-thumbnail"); ?>" class="qt-inlineimg" alt="<?php the_title(); ?>">
		<?php } ?>
		
		<h6 class="qt-title qt-ellipsis qt-t">
			<?php 
			$title = get_the_title();
			echo esc_attr(vlogger_shorten($title, 70) ); 
			if(strlen($title) > 70) { ?>...<?php }
			?>
		</h6>
		<p class="qt-details qt-item-metas">

			<?php
			/**
			 * Reading time
			 * 
			 */
			$time = get_post_meta(get_the_id(), "vlogger_video_duration", true);
			if(!$time || $time == ''){
				$time  = vlogger_readingtime(get_the_id());
			}
			if($time){
				?><i class="<?php echo vlogger_format_icon_class(get_the_id()); ?>"></i><?php echo esc_attr($time); 	
			}
			
			/**
			 * Views
			 * 
			 */
			echo vlogger_do_shortcode('[ttg_reaktions-views-raw]');

			/**
			 * Likes
			 * 
			 */
			echo vlogger_do_shortcode('[ttg_reaktions-loveit-raw]');
			
			/**
			 * Rating
			 * 
			 */
			echo vlogger_do_shortcode('[ttg_reaktions-rating-raw]');

			?>
		</p>
	</a>
</div>
<!-- ITEM INLINE END ========================= -->
