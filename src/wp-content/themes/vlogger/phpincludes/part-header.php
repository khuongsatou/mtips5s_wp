<?php
/*
Package: Vlogger
*/

$paged = vlogger_get_paged();
$image = vlogger_header_image_url(null, false);
?>
<!-- HEADER CAPTION ========================= -->
<div class="qt-pageheader qt-negative <?php if($paged > 1) {?> qt-pageheader-short <?php } ?> <?php if(false == vlogger_header_image_url(null, false)){ ?>qt-pageheader-nopicture<?php } ?>">
	<div class="qt-headercontainer" >
		<div class="qt-container">
			<div data-200-top="opacity:1" data--250-top="opacity:0">
				<h1 class="qt-caption qt-spacer-s"><?php get_template_part('phpincludes/part-archivetitle' ); ?></h1>
			</div>
		</div>
	</div>
    <div class="qt-header-bg <?php if(vlogger_vertical_check()== true){ ?>qt-vert<?php } ?>" data-bgimage="<?php vlogger_header_image_url(); ?>" data-parallax="1">
    </div>
</div>
<!-- HEADER CAPTION END ========================= -->
