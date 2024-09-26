<?php
/*
Package: Vlogger
*/


?>
<!-- HEADER CAPTION ========================= -->
<div class="qt-pageheader qt-pageheader-serie qt-negative">
	<div class="qt-headercontainer" >
		<div class="qt-container">
			<ul class="qt-tags">
				<?php echo get_the_term_list( get_the_id(), 'vlogger_seriescategory', '<li>', '</li><li>', '</li>' );  ?>
			</ul>
			<div data-200-top="opacity:1" data--250-top="opacity:0">
				<h1 class="qt-caption qt-spacer-s"><?php get_template_part('phpincludes/part-archivetitle' ); ?></h1>
				<p class="qt-item-metas">
					<?php 
					$videos_quantity =  vlogger_get_ep_count(get_the_id()); 
					if(($videos_quantity && $videos_quantity > 0)){
						?>
						<span class="qt-metas-left">
							<i class="material-icons">video_library</i> <?php echo sprintf( _n( '%s Video', '%s Videos', $videos_quantity, 'vlogger' ), $videos_quantity ); ?>
						</span><?php
					}
					if(get_theme_mod('vlogger_reaktions_mods_series_headerdata' )){
						?><span class="qt-reaktions-inline"><?php
						echo vlogger_do_shortcode('[ttg_reaktions-views]' ); 
						echo vlogger_do_shortcode('[ttg_reaktions-loveit-count]' ); 
						echo vlogger_do_shortcode('[ttg_reaktions-rating-count]' );
						?></span><?php  
					}
					?>
				</p>
			</div>
			<?php  
			$intro = get_post_meta( get_the_id(), 'vlogger_series_intro' , true );
			if($intro){
			?>
			<div class="qt-intro qt-spacer-m">
				<?php echo apply_filters( 'the_content', $intro ); ?>
			</div>
			<?php } ?>
		</div>
	</div>
    <div class="qt-header-bg" data-bgimage="<?php vlogger_header_image_url(); ?>" data-parallax="1">
    </div>
</div>
<!-- HEADER CAPTION END ========================= -->
