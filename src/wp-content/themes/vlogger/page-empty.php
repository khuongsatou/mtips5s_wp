<?php
/*
Package: Vlogger
Template Name: Page Empty
*/
?>
<?php 
get_header(); 
?>
	<!-- ======================= MAIN SECTION  ======================= -->
	<div id="maincontent" <?php post_class("qt-main qt-paper"); ?>>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<!-- ======================= RELATED SECTION END ======================= -->
		<?php endwhile; // end of the loop. ?>
	</div>
	<!-- ======================= MAIN SECTION END ======================= -->
<?php get_footer(); ?>