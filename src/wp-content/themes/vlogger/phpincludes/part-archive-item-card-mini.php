<?php
/*
Package: Vlogger
*/
?>



<!-- CARD MINI ========================= -->
<a href="<?php the_permalink(); ?>" <?php post_class("qt-part-archive-item qt-part-archive-item-card-mini"); ?>>
	<div class="qt-featured" data-bgimage="<?php the_post_thumbnail_url( 'medium' ); ?>" data-parallax="0">
	</div>
	<h6 class="qt-ellipsis-3 qt-t qt-small">
		<?php the_title(); ?>
	</h6>
</a>
<!-- CARD MINI END ========================= -->
