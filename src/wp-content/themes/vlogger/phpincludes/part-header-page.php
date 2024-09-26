<?php
/*
Package: Vlogger
*/
$paged = vlogger_get_paged();

?>
<!-- HEADER CAPTION ========================= -->
<div class="qt-pageheader <?php if($paged > 1) {?> qt-pageheader-short <?php } ?> qt-negative <?php if(false == vlogger_header_image_url(null, false)){ ?>qt-pageheader-nopicture<?php } ?>" >
	<div class="qt-headercontainer" >
		<div class="qt-container">
			<div data-200-top="opacity:1" data--250-top="opacity:0">
				<h1 class="qt-caption qt-spacer-s"><?php get_template_part('phpincludes/part-archivetitle' ); ?></h1>
				
					<?php 
					if(get_theme_mod('vlogger_reaktions_mods_pages_headerdata' )){
						?>
						<p class="qt-item-metas">
							<span class="qt-reaktions-inline">
							<?php
							echo vlogger_do_shortcode('[ttg_reaktions-views]' ); 
							echo vlogger_do_shortcode('[ttg_reaktions-loveit-count]' ); 
							echo vlogger_do_shortcode('[ttg_reaktions-rating-count]' );
							?>
							</span>
						</p><?php  
					}
					?>
				
			</div>
		</div>
	</div>
    <div class="qt-header-bg" data-bgimage="<?php vlogger_header_image_url(); ?>" data-parallax="1">
    </div>
</div>
<!-- HEADER CAPTION END ========================= -->
