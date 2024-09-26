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
			if(get_theme_mod('vlogger_auto_video_header', '0' )){
				get_template_part( 'phpincludes/part-header-video'); 
			} else {
				get_template_part( 'phpincludes/part-header-caption'); 
			}
			?>
			<!-- ======================= HEADER SECTION END ======================= -->
			
			<?php 
			if ( shortcode_exists( 'vlogger-videocarousel' ) ) {
				echo do_shortcode('[vlogger-videocarousel serie_id="'.esc_html( get_query_var("vlogger_serie_in", null) ).'" current_video_id="'.get_the_id().'"]' );
			}
			?>
			
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
							if(get_theme_mod('vlogger_reaktions_mods_videos_beforecontent' )){
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


							<?php
							if( get_post_meta( get_the_ID(), 'vlogger_hide_embedded_video', true ) || get_theme_mod('vlogger_hide_first_video', '0' )){

								$content = get_the_content();
								
								/*
								* @since 2.5.1
								*/
								$content = preg_replace ( '/\[video(.*?)\]/s' , '' , $content );
								$content = preg_replace ( '/\[\/video(.*?)\]/s' , '' , $content );


								$search = '/(http(s)??\:\/\/)?(www\.)?((youtube\.com\/watch\?v=)|(youtu.be\/))([a-zA-Z0-9\-_])+/';
								$content = preg_replace($search, '',  $content, 1);
								$search = '/(http(s)??\:\/\/)?(www\.)?(vimeo\.com\/([0-9]{1,10}))+/';
								$content = preg_replace($search, '',  $content, 1);
								$search = '/(http(s)??\:\/\/)?(www\.)?(twitch\.tv\/videos\/([0-9]{1,10}))+/';
								$matches = preg_match($search, $content, $matches);
								$content = preg_replace($search, '',  $content, 1);

								if(isset($GLOBALS['wp_embed'])){
	    							$content = $GLOBALS['wp_embed']->autoembed($content);
								}
								echo wpautop (do_shortcode($content));
							} else {
								the_content();
							}
							?>

							<?php  
					        /**
					         * ADS slot output
					         */
					        vlogger_ads_display('vlogger_ads_after_post');
					        ?>

					        <?php wp_link_pages(); ?> 
					       	<?php the_tags('<div class="qt-item-metas qt-posttags"><hr class="qt-spacer-m"><span class="qt-title">'.esc_html__("Tagged as ", "vlogger").'</span>', ', ', '.</div>' ); ?> 

							<?php 
							if(get_theme_mod('vlogger_reaktions_mods_videos_aftercontent' )){
								?>
								<hr class="qt-spacer-s">
								<?php 
								echo vlogger_do_shortcode('[ttg_reaktions-full]' ); 
							}
							?>

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