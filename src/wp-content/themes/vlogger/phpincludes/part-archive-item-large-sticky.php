<?php
/*
Package: Vlogger
*/
?>
<!-- ITEM LARGE ========================= -->
<div <?php post_class("qt-part-archive-item qt-part-archive-item-large qt-card qt-negative qt-content-primary"); ?>>
	<div class="qt-part-archive-item-header qt-content-primary-dark" >
		<div class="qt-topmetas">
			<div class="qt-container">
				<p class="qt-item-metas qt-small">
					<span class="qt-posttype"><i class="<?php echo vlogger_format_icon_class( vlogger_universal_page_id() ); ?>"></i><?php echo vlogger_readingtime(); ?> <?php if(get_post_format( $id ) !== 'video') { esc_html_e("Read time", "vlogger"); } ?></span>
					<?php vlogger_watchlater(); ?>
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
						$category = get_the_category(); 
						$limit = 0;
						foreach($category as $i => $cat){
							if($i > $limit){
								continue;
							}
							echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.esc_attr($cat->cat_name).'</a></li>';  
						}	
						?>
					</ul>
					<div>
						<h3 class="qt-caption qt-spacer-s">
							<a href="<?php the_permalink(); ?>">
								<i class="dripicons-pin"></i> <?php the_title(); ?>
							</a>
						</h3>
						<p class="qt-item-metas qt-small">
							<span class="qt-reaktions-inline">
								<?php get_template_part('phpincludes/part-item-metas'); ?>
							</span>
							<a class="right" href="<?php the_permalink(); ?>">
								<?php esc_html_e("Read more", "vlogger" ); ?> <i class="dripicons-arrow-thin-right"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php echo vlogger_playicon(get_the_id()); ?>
		<?php if(has_post_thumbnail()){ ?>
	         <a href="<?php the_permalink(); ?>"  class="qt-header-bg <?php if(vlogger_vertical_check()== true){ ?>qt-vert<?php } ?>" data-bgimage="<?php the_post_thumbnail_url( 'large' ); ?>" data-parallax="0">
	        </a>
     	<?php } ?>
	</div>
	<div class="qt-itemcontents qt-spacer-s">
		<a href="<?php the_permalink(); ?>" class="qt-btn qt-readmore qt-btn-xl qt-btn-primary hide-on-small-and-down"><?php esc_html_e("Read more", "vlogger" ); ?></a>
		<p class="qt-ellipsis-3">
			<?php
			echo strip_shortcodes( get_the_excerpt() ); 
			?>
		</p>
	</div>
</div>
<!-- ITEM LARGE END ========================= -->
