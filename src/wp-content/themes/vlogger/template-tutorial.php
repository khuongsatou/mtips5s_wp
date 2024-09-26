<?php
/*
Package: Vlogger
*/

get_header(); 
?>

	<?php  
	get_template_part( 'phpincludes/menu'); 
	?>

	<!-- ======================= MAIN SECTION  ======================= -->
	<div id="maincontent" <?php post_class("qt-main qt-paper"); ?>>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="qt-main-video">

			<!-- ======================= HEADER SECTION ======================= -->
			<?php 
			get_template_part('phpincludes/part-header-tutorial'); 
			?>
			<!-- ======================= HEADER SECTION END ======================= -->
			

			<!-- ======================= CONTENT SECTION ======================= -->
			<span id="ttg_trigger_tabs"></span>
			<div id="qtcontents" class="qt-container qt-vertical-padding-l">
				<hr id="qtFlexibleTopSpacer" class="qt-spacer-xxl hide-on-large-and-down">
				<div class="row">
					<div class="col s12 m12 l8">
						<div class="qt-the-content">

							<!--
							/**
							 * Attention!!!!
							 * googleoff and google on are parameters to avoid duplicated H1 for SEO,
							 * means you can duplicate the tags without making bad seo
							 */
							-->

							<!--googleoff: index-->
							<div class="qt-inpage-caption">
								<ul class="qt-tags qt-spacer-s">
									<?php
									/**
									 * [$category Array of categories]
									 * @var [array]
									 * We want only the first category
									 */
									$category = get_the_category(); 
									$limit = 10;
									foreach($category as $i => $cat){
										if($i > $limit){
											continue;
										}
										echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a></li>';  
									}	
									?>
								</ul>
								<h2 class="qt-caption"><?php the_title(); ?></h2>
								<div class="qt-item-metas">
									<span class="qt-metas-left">
										<?php get_template_part('phpincludes/part-item-metas'); ?>
									</span>
									<?php 
									if(get_theme_mod('vlogger_reaktions_mods_tutorials_beforecontent' )){
										?><span class="qt-reaktions-inline"><?php
										echo vlogger_do_shortcode('[ttg_reaktions-views]' ); 
										echo vlogger_do_shortcode('[ttg_reaktions-loveit-count]' ); 
										echo vlogger_do_shortcode('[ttg_reaktions-rating-count]' );
										?></span><?php  
									}
									?>
								</div>
							</div>
							<!--googleon: index-->

							<?php 
							/**
							 * ReAktions output
							 */
							if(get_theme_mod('vlogger_reaktions_mods_tutorials_beforecontent' )){
								?>
								<hr class="qt-spacer-s">
								<div class="qt-clearfix">
								<?php 
								echo vlogger_do_shortcode('[ttg_reaktions-loveit-link]');	
								echo vlogger_do_shortcode('[ttg_reaktions-social]');
								if(wp_is_mobile()){
								?>
								<hr class="qt-spacer-s qt-clearfix show-on-small ">
								<?php
								}
								echo vlogger_do_shortcode('[ttg_reaktions-rating]');	
								?>
								</div>
								<hr class="qt-clearfix">
								<hr class="qt-spacer-m">
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

							$content = get_the_content();
							if( get_post_meta( get_the_ID(), 'vlogger_hide_embedded_video', true ) || get_theme_mod('vlogger_hide_first_video', '0' )){


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
							}
							if(isset($GLOBALS['wp_embed'])){
    							$content = $GLOBALS['wp_embed']->autoembed($content);
							}
							echo wpautop (do_shortcode($content));
							?>

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
							if(get_theme_mod('vlogger_reaktions_mods_tutorials_aftercontent' )){
								?>
								<div class="qt-vertical-padding-m">
								<?php 
								echo vlogger_do_shortcode('[ttg_reaktions-loveit-link]');	
								echo vlogger_do_shortcode('[ttg_reaktions-social]');	
								if(wp_is_mobile()){
								?>
								<hr class="qt-spacer-s qt-clearfix show-on-small ">
								<?php
								}
								echo vlogger_do_shortcode('[ttg_reaktions-rating]');	
								?>
								</div>
								<?php  
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
				</div>
			</div>
			<!-- ======================= CONTENT SECTION END ======================= -->


		</div>

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

		<?php endwhile; // end of the loop. ?>

	</div>
	<!-- ======================= MAIN SECTION END ======================= -->

	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>