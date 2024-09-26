<div class=""></div><div class="qt-part-archive-item qt-part-archive-item-heropost qt-negative">
	<div class="qt-part-archive-item-header">
		<div class="qt-contents-overlay" >
			<div class="qt-container">
				<ul class="qt-tags">
					<?php
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
				<h2 class="qt-fontsize-h2 qt-caption"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<a href="<?php the_permalink(); ?>" class="qt-btn qt-readmore qt-btn-xl qt-btn-primary hide-on-small-and-down left"><?php esc_html_e("Read more", "vlogger" ); ?></a>
				<p class="hide-on-med-and-down">

					<?php 
					echo vlogger_shorten(strip_shortcodes( get_the_excerpt() ), 170) ; 
					?>
				</p>
			</div>
		</div>

		<?php echo vlogger_playicon(get_the_id()); ?>

		
		<?php if (has_post_thumbnail()){ ?>
	        <div class="qt-header-bg" data-bgimage="<?php the_post_thumbnail_url( 'full' ); ?>" data-parallax="0" data-attachment="local">
	        </div>
	 	<?php } ?>
	</div>
</div>