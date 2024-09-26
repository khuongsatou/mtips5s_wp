<?php
/*
Package: Vlogger
*/
?>
<div class="qt-part-archive-item qt-part-archive-item-medium qt-compact">
	<div class="qt-part-archive-item-header qt-content-primary-dark">
		<div class="qt-topmetas">
			<p class="qt-item-metas qt-small">
				
				<?php vlogger_watchlater(); ?>
			</p>
		</div>

		<?php echo vlogger_playicon(get_the_id()); ?>

		
		<?php if (has_post_thumbnail()){ ?>
	         <a href="<?php the_permalink(); ?>" class="qt-header-bg"  data-bgimage="<?php the_post_thumbnail_url( 'medium' ); ?>" data-parallax="0">
	        </a>
     	<?php } ?>
	</div>
	<div class="qt-itemcontents">
		<h5 class="qt-title qt-ellipsis-2 qt-t ">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h5>		
	</div>
</div>
