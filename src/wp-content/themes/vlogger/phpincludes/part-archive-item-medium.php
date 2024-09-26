<?php
/*
Package: Vlogger
*/
?>


<!-- ITEM MEDIUM  ========================= -->
<div <?php post_class("qt-part-archive-item qt-part-archive-item-medium"); ?>>

	<div class="qt-part-archive-item-header qt-content-primary-dark" >
		<div class="qt-topmetas">
			<p class="qt-item-metas qt-small">
				<span class="qt-posttype"><i class="<?php echo vlogger_format_icon_class( vlogger_universal_page_id() ); ?>"></i><?php echo vlogger_readingtime(); ?> <?php if(get_post_format( $id ) !== 'video') { esc_html_e("Read time", "vlogger"); } ?></span>
				<?php vlogger_watchlater(); ?>
			</p>
		</div>

		<ul class="qt-tags qt-bottommetas">
			<?php  
			/**
			 * [$category Array of categories]
			 * @var [array]
			 * We want only the first category
			 */
			$category = get_the_category(); 
			$limit = 0;
			foreach($category as $i => $cat){
				if($i > $limit){
					continue;
				}
				echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a></li>';  
			}	
			?>
		</ul>

		<?php echo vlogger_playicon(get_the_id()); ?>

		
		<?php if (has_post_thumbnail()){ ?>
	         <a href="<?php the_permalink(); ?>"  class="qt-header-bg" data-bgimage="<?php the_post_thumbnail_url( 'medium' ); ?>" data-parallax="0" data-attachment="local">
	        </a>
     	<?php } ?>
	</div>
	<div class="qt-itemcontents">
		<p class="qt-small qt-details qt-item-metas"><?php get_template_part('phpincludes/part-item-metas'); ?></p>
		<h5 class="qt-title qt-ellipsis-2 qt-t ">
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h5>
	</div>
</div>
<!-- ITEM MEDIUM END ========================= -->
