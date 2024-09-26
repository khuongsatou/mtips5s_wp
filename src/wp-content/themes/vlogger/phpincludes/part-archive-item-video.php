<?php
/*
Package: Vlogger
*/
?>



<!-- VIDEO ========================= -->
<div <?php post_class( 'qt-part-archive-item qt-part-archive-item-video qt-negative', get_the_id() ); ?> >
	<a href="<?php the_permalink(); ?>"  data-bgimage="<?php the_post_thumbnail_url( 'medium' ); ?>" data-parallax="0" data-attachment="local">
		<h5 class="qt-caption">
			<?php the_title(); ?>
		</h5>
		<i class="qticon-play"></i>
	</a>
	
</div>
<!-- VIDEO ========================= -->
