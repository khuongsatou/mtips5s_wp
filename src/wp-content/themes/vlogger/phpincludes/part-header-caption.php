<?php
/*
Package: Vlogger
*/
?>
<!-- HEADER CAPTION ========================= -->
<div class="qt-pageheader qt-negative <?php if(false == vlogger_header_image_url(null, false)){ ?>qt-pageheader-nopicture<?php } ?>">
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
					if(get_theme_mod('vlogger_reaktions_mods_posts_headerdata' )){
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
    <div class="qt-header-bg <?php if(vlogger_vertical_check()== true){ ?>qt-vert<?php } ?>" data-bgimage="<?php vlogger_header_image_url(); ?>" data-parallax="1">
    </div>
</div>
<!-- HEADER CAPTION END ========================= -->
