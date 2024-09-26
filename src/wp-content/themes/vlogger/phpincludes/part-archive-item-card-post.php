<?php
/*
Package: Vlogger
*/
?>
<!-- ITEM LARGE NOTEXT ========================= -->
<div class="qt-part-archive-item qt-part-archive-item-large  qt-part-archive-item-card-post">
	<div class="qt-part-archive-item-header qt-content-primary-dark">
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
							echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a></li>';  
						}	
						?>
					</ul>
					<div>
						<h4 class="qt-caption qt-spacer-s">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h4>
						<p class="qt-item-metas qt-small">
							<?php get_template_part('phpincludes/part-item-metas'); ?>
							<a class="right qt-readmore-small" href="<?php the_permalink(); ?>">
								<?php esc_html_e('Read more', 'vlogger' ); ?> <i class="dripicons-arrow-thin-right"></i>
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php if (has_post_thumbnail()){ ?>
	        <a href="<?php the_permalink(); ?>" class="qt-header-bg" data-bgimage="<?php the_post_thumbnail_url( 'medium' ); ?>" data-parallax="0" data-attachment="local">
	        </a>
     	<?php } ?>
	</div>
</div>
<!-- ITEM LARGE NOTEXT END ========================= -->
