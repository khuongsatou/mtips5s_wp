<?php
/*
Package: Vlogger
*/



$post_id = get_the_ID();

?>
<!-- HEADER CAPTION ========================= -->
<div id="qtvideoheader" class="qt-pageheader qt-pageheader-video qt-negative qt-part-header-video">
	<div class="qt-headerpos">

		<div class="qt-video-placeholder">
			<div class="qt-container">
				<div class="qt-thevideoholder">
					<a href="#" class="qt-playbtn qt-fadein" data-videoactivator="#qtvideoheader"><i class="dripicons-media-play"></i></a>
					<div id="qtmainVideo" class="qt-video-customplayer">
						<?php 
						vlogger_featured_video($post_id); 
						?>
						<?php  
						$slot = 'vlogger_ads_video';
						$ad_content = get_theme_mod($slot.'_content');
						if($ad_content){
						?>
						<div id="qtVads" class="qt-videoad">
							<?php vlogger_ads_display('vlogger_ads_video'); ?>
					        <a href="#!" class="qt-close" data-removeitem="#qtVads"><i class="dripicons-cross"></i></a>
					        <a href="#!" class="qt-close" data-removeitem="#qtVads"><i class="dripicons-cross"></i></a>
					    </div>
					    <?php } ?>
					</div>
	 			</div>
			</div>
		</div>
		<div class="qt-headercontainer" >
			<div class="qt-container">
				<ul class="qt-tags">
					<?php  
					/**
					 * [$category Array of categories]
					 * @var [array]
					 * We want only the first category
					 */
					$category = get_the_category(); 
					$limit = 8;
					foreach($category as $i => $cat){
						if($i > $limit){
							continue;
						}
						echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a></li>';  
					}	
					?>
				</ul>
				<div data-200-top="opacity:1" data--250-top="opacity:0">
					<h1 class="qt-caption qt-spacer-s"><?php the_title(); ?></h1>
					<p class="qt-item-metas">
						<span class="qt-metas-left">
							<?php get_template_part('phpincludes/part-item-metas'); ?>
						</span>
						<?php 
						if(get_theme_mod('vlogger_reaktions_mods_videos_headerdata' )){
							?><span class="qt-reaktions-inline"><?php
							echo vlogger_do_shortcode('[ttg_reaktions-views]' ); 
							echo vlogger_do_shortcode('[ttg_reaktions-loveit-count]' ); 
							echo vlogger_do_shortcode('[ttg_reaktions-rating-count]' );
							?></span><?php  
						}
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
    <div class="qt-header-bg" data-bgimage="<?php vlogger_header_image_url(); ?>" data-parallax="1">
    </div>
</div>
<!-- HEADER CAPTION END ========================= -->


