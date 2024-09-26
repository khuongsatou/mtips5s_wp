<?php
/*
Package: Vlogger
Template Name: Page Fullwidth
*/
?>
<?php 
get_header(); 
?>
	<?php  
	get_template_part( 'phpincludes/menu'); 
	?>
	<!-- ======================= MAIN SECTION  ======================= -->
	<div id="maincontent" <?php post_class("qt-main qt-paper"); ?>>
		<?php while ( have_posts() ) : the_post(); ?>
			<!-- ======================= HEADER SECTION ======================= -->
			<?php 
			if( get_post_meta(get_the_id(), 'vlogger_hide_header', true) !== "1"){
				get_template_part( 'phpincludes/part-header-page');
				/**
				 * ADS slot output
				 */
				vlogger_ads_display('vlogger_ads_under_header');
			}
			
			?>
				
			<!-- ======================= CONTENT SECTION ======================= -->
			<div id="qtcontents">
				<?php  
				/**
				 * ADS slot output
				 */
				vlogger_ads_display('vlogger_ads_before_page');
				?>
				
				<?php the_content(); ?>

				<?php  
				/**
				 * ADS slot output
				 */
				vlogger_ads_display('vlogger_ads_after_page');
				?>

			</div>
			<!-- ======================= CONTENT SECTION END ======================= -->
			<!-- ======================= RELATED SECTION END ======================= -->
		<?php endwhile; // end of the loop. ?>
	</div>
	<!-- ======================= MAIN SECTION END ======================= -->
	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>