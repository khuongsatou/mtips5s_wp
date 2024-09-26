<?php
/*
Package: Vlogger
*/
?>
<!-- CARD SIMPLE ========================= -->
<div <?php post_class("qt-part-archive-item qt-part-archive-item-card-simple"); ?>>
	<div class="qt-part-archive-item-header qt-content-primary-dark" >
		<div class="qt-topmetas">
			<p class="qt-item-metas qt-small">
				<span class="qt-posttype"><i class="material-icons">video_library</i> <?php esc_html_e("Series", "vlogger" ); ?></span>
			</p>
		</div>
		<div class="qt-vc qt-titles qt-negative">
			<div class="qt-vi-bottom">
				<ul class="qt-tags ">
					<?php  
					/**
					 * [$category Array of categories]
					 * @var [array]
					 * We want only the first category
					 */
					// $category = get_the_terms(get_the_id(), 'vlogger_seriescategory'); 
					// $limit = 0;
					// if(is_array($category)){
					// 	foreach($category as $i => $cat){
					// 		if($i > $limit){	
					// 			continue;
					// 		}
					// 		echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->name.'</a></li>';  
					// 	}	
					// }
					?>
				</ul>
				<h5 class="qt-title qt-ellipsis-2 qt-t qt-spacer-s">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h5>
				<p class="qt-item-metas qt-details">
					<?php  
					$videos_quantity =  vlogger_get_ep_count(get_the_id()); 
					if(($videos_quantity && $videos_quantity > 0)){
						?>
						<span class="qt-metas-left">
							<i class="dripicons-media-play"></i> <?php echo sprintf( _n( '%s Video', '%s Videos', $videos_quantity, 'vlogger' ), $videos_quantity ); ?>
						</span><?php
					}
					?>
				</p>
			</div>
		</div>
		<?php if (has_post_thumbnail()){ ?>
	        <a class="qt-header-bg" href="<?php the_permalink(); ?>" data-bgimage="<?php the_post_thumbnail_url( 'large' ); ?>" data-parallax="0" data-attachment="local">
	            
	        </a>
     	<?php } ?>
	</div>
</div>
<!-- CARD SIMPLE ========================= -->
