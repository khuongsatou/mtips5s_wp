<?php
/*
Package: Vlogger
Template Name: Page Sidebar
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
				
			}
			?>
			<!-- ======================= HEADER SECTION END ======================= -->

			<?php  
			/**
			 * ADS slot output
			 */
			vlogger_ads_display('vlogger_ads_under_header');
			?>



			<!-- ======================= CONTENT SECTION ======================= -->
			<div id="qtcontents" class="qt-container qt-vertical-padding-l">
				<div class="row">
					<div class="col s12 m12 l8">
						<div class="qt-the-content">
							<?php  
							/**
							 * ADS slot output
							 */
							vlogger_ads_display('vlogger_ads_before_page');
							?>

							<?php 
							/**
							 * ReAktions output
							 */
							if(get_theme_mod('vlogger_reaktions_mods_pages_beforecontent' )){
								echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
								?>
								<hr class="qt-spacer-s">
								<?php 
							}
							?>
							
							<?php the_content(); ?>

							<?php  
							/**
							 * ADS slot output
							 */
							vlogger_ads_display('vlogger_ads_after_page');
							?>

							<?php 
							if(get_theme_mod('vlogger_reaktions_mods_pages_aftercontent' )){
								?>
								<hr class="qt-spacer-s">
								<?php 
								echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
								
							}
							?>
							
							<?php if ( comments_open() || '0' != get_comments_number() ){  ?>
								<hr class="qt-spacer-m">
								<?php  comments_template(); ?>
							<?php } ?>
						</div>
					</div>
					<div class="col s12 m12 l1">
						 <hr class="qt-spacer-m">
					</div>
					<div class="qt-sidebar col s12 m12 l3">
						<?php 
						get_template_part( 'phpincludes/sidebar'); 
						?>
					</div>
				</div>
			</div>
			<!-- ======================= CONTENT SECTION END ======================= -->

			<!-- ======================= RELATED SECTION END ======================= -->
		<?php endwhile; // end of the loop. ?>
	</div>
	<!-- ======================= MAIN SECTION END ======================= -->

	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>