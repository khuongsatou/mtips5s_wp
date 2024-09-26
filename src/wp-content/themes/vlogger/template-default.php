<?php
/*
Package: Vlogger
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
			get_template_part( 'phpincludes/part-header-caption'); 
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
							 * ReAktions output
							 */
							if(get_theme_mod('vlogger_reaktions_mods_posts_beforecontent' )){
								echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
								?>
								<hr class="qt-spacer-s">
								<?php 
							}
							?>

							<?php  
					        /**
					         * ADS slot output
					         */
					        vlogger_ads_display('vlogger_ads_before_post');
					        ?>
					        
							<?php the_content(); ?>




							<?php  
					        /**
					         * ADS slot output
					         */
					        vlogger_ads_display('vlogger_ads_after_post');
					        ?>


					        <?php wp_link_pages(); ?> 

							

							<?php
							/**
							 * ReAktions output
							 */
							if(get_theme_mod('vlogger_reaktions_mods_posts_aftercontent' )){
								?>
								<hr class="qt-spacer-s">
								<?php 
								echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
							}
							?>

					       	<?php the_tags('<div class="qt-item-metas qt-posttags"><hr class="qt-spacer-m"><span class="qt-title">'.esc_html__("Tagged as ", "vlogger").'</span>', ', ', '.</div>' ); ?> 

							<?php 
							get_template_part( 'phpincludes/part-post-author'); 
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

			<!-- ======================= UPCOMING POST SECTION ======================= -->
			<?php
			/**
			 * 
			 * Previous post link
			 *
			 * 
			 */
			$prev_post = get_previous_post();
			if (!empty( $prev_post )): 
				get_template_part ('phpincludes/part-archive-item-upcoming');
			endif; 
			?>
			<!-- ======================= UPCOMING POST SECTION END ======================= -->

			<!-- ======================= RELATED SECTION ======================= -->

			<?php 
			get_template_part ('phpincludes/part-related' );  
			?>
			
			<!-- ======================= RELATED SECTION END ======================= -->
		<?php endwhile; // end of the loop. ?>
	</div>
	<!-- ======================= MAIN SECTION END ======================= -->

	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>