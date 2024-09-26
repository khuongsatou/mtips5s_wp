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
			<?php  
			/**
			 * [$template parameter of the template for a category]
			 * @var string
			 */
			$show_sidebar = get_theme_mod('vlogger_series_sidebar', '0') || get_post_meta(get_the_id(), 'vlogger_series_sidebar_single', true);

			$column_classes = 's12 m12 l12';
			if($show_sidebar == "1"){
			    $column_classes = 's12 m12 l8';
			}
			?>
			<!-- ======================= HEADER SECTION ======================= -->
			<?php 
			if( get_post_meta( get_the_id(), 'vlogger_hide_header', true ) !== '1' ){
				get_template_part( 'phpincludes/part-header-serie');
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
			<div id="qtcontents">

				

				<?php  
				/**
				 * [$position choose to have playlist before or after contents]
				 * [$playlist_template coose list, grid or else]
				 * @var string
				 */
				$position = get_theme_mod('vlogger_series_playlist_position','after' );

			


				$playlist_template = get_theme_mod('vlogger_series_playlist_design','list' );

				$episodes_extration_args = array();
				if($playlist_template == 'grid'){
					$episodes_extration_args = array(
					"container_open" => '<div class="qt-container qt-vertical-padding-l"><div class="row">',
					"container_close" => '</div></div>'
					);
				}

				if($position === 'before'){
					vlogger_extract_serie_episodes(get_the_id(), null, $playlist_template, $episodes_extration_args);
				}

				/**
				 * Choose layout based on customizer options.
				 * Single series can override the parameter
				 */
				$layout = get_theme_mod( 'vlogger_series_global_layout', 'boxed' );

				$page_layout_override = get_post_meta(get_the_id(),'vlogger_content_layout', true );
				if($page_layout_override){
					/**
					 * This is a future update because it may trick the user into not understanding why Customizer settings are not working
					 */
					//$layout = $page_layout_override;
				}

				// spacing
				if(($position === 'before' && $playlist_template == 'list' && $layout !== 'unboxed' && $layout !== 'hidden')
					|| ($position === 'after' && $layout !== 'unboxed' && $layout !== 'hidden')

					){
					?>
					<hr class="qt-spacer-l">
					<?php
				}

				switch($layout){
					case "boxed-sidebar":
						?>
						<div class="qt-container">
							<div class="row">
								<div class="col s12 m12 l8">
									<div class="qt-the-content">
										<?php 
										/**
										 * ReAktions output
										 */
										if(get_theme_mod('vlogger_reaktions_mods_series_beforecontent' )){
											echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
											?>
											<hr class="qt-spacer-s">
											<?php 
										}
										?>
										<?php the_content(); ?>
										<?php 
										/**
										 * ReAktions output
										 */
										if(get_theme_mod('vlogger_reaktions_mods_series_aftercontent' )){
											?>
											<hr class="qt-spacer-s">
											<?php 
											echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
										}
										?>
									</div>
								</div>
								<div class="col s12 m12 l1">
									<hr class="qt-spacer-m">
								</div>
								<div class="qt-sidebar col s12 m12 l3">
									<div id="qtSidebar" class="qt-widgets qt-sidebar-main qt-content-aside row qt-masonry">
										<?php if(is_active_sidebar( 'vlogger-seriessidebar' ) ){ ?>
									        <?php dynamic_sidebar( 'vlogger-seriessidebar' ); ?>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<?php 
						break;

					case "unboxed":
						?>
						<div class="qt-the-content">
							<?php the_content(); ?>
						</div>
						<?php
						break;
					case "hidden":
						break;
					case "boxed":
					default:
						?>
						<div class="qt-container qt-the-content">

							
							<?php 
							/**
							 * ReAktions output
							 */
							if(get_theme_mod('vlogger_reaktions_mods_series_beforecontent' )){
								echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
								?>
								<hr class="qt-spacer-s">
								<?php 
							}
							?>
							<?php the_content(); ?>
							<?php 
							/**
							 * ReAktions output
							 */
							if(get_theme_mod('vlogger_reaktions_mods_series_aftercontent' )){
								?>
								<hr class="qt-spacer-s">
								<?php 
								echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
							}
							?>
						</div>
						<?php 
				}
				?>


				<?php  
				// spacing
				if(($position === 'before' || ($position === 'after' && $playlist_template == 'list') ) && $layout !== 'unboxed' && $layout !== 'hidden'){
					?>
					<hr class="qt-spacer-l">
					<?php
				}
				?>




				<?php 
				if($position === 'after'){
					vlogger_extract_serie_episodes(get_the_id(), null, $playlist_template, $episodes_extration_args);
				}
				?>
			</div>
			<!-- ======================= CONTENT SECTION END ======================= -->
			<!-- ======================= RELATED SECTION END ======================= -->
			<?php 
			get_template_part ('phpincludes/part-related' );  
			?>
		<?php endwhile; // end of the loop. ?>
	</div>
	<!-- ======================= MAIN SECTION END ======================= -->
	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>