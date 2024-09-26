<?php
/*
Package: Vlogger
*/


$post_id = get_the_ID();
/**
 * [$chapters_menu FALSE if no plugin or no chapters used]
 * @var boolean | HTML
 */
$chapters_menu = false;
if(function_exists('ttg_chapters_menu')){
	$chapters_menu = ttg_chapters_menu($post_id);
}


$customtab = get_post_meta( $post_id, 'vlogger_tutorial_customtab_content', true );

?>

<!-- HEADER CAPTION ========================= -->
<div id="qtvideoheader" class="qt-pageheader qt-pageheader-tutorial qt-scrollbarstyle qt-negative">
	<div class="qt-contents-layer">
		<div class="qt-video-placeholder">
			<div class="qt-container">
				<div class="qt-thevideoholder">
					<a href="#" class="qt-playbtn qt-fadein" data-videoactivator="#qtvideoheader"><i class="dripicons-media-play"></i></a>
					<div id="qtmainVideo" class="qt-video-customplayer">
						<?php vlogger_featured_video($post_id); ?>
						<?php  
						$slot = 'vlogger_ads_video';
						$ad_content = get_theme_mod($slot.'_content');
						if($ad_content){
						?>
						<div id="qtVads" class="qt-videoad">
							<?php vlogger_ads_display('vlogger_ads_video'); ?>
					        <a href="#!" class="qt-close" data-removeitem="#qtVads"><i class="dripicons-cross"></i></a>
					        <a href="#!" class="qt-close" data-removeitem="#qtVads"><i class="dripicons-cross"></i></a>
					    </div>
					    <?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="qt-scrolling-header">
			<div class="qt-container">
				<div class="qt-container-texts">
					<div class="qt-video-padder-DISABLED"></div>
					<div class="qt-video-headers">
						<ul class="qt-tags qt-spacer-s">
							<?php  
							/**
							 * [$category Array of categories]
							 * @var [array]
							 * We want only the first category
							 */
							$category = get_the_category(); 
							$limit = 4;
							foreach($category as $i => $cat){
								if($i > $limit){
									continue;
								}
								echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a></li>';  
							}	
							?>
						</ul>
						<h1 class="qt-caption qt-spacer-s"><?php the_title(); ?></h1>
						<p class="qt-item-metas">
							<span class="qt-metas-left">
								<?php get_template_part('phpincludes/part-item-metas'); ?>
							</span>
							<?php 
							if(get_theme_mod('vlogger_reaktions_mods_tutorials_headerdata' )){
								?><span class="qt-reaktions-inline"><?php
								echo vlogger_do_shortcode('[ttg_reaktions-views]' ); 
								echo vlogger_do_shortcode('[ttg_reaktions-loveit-count]' ); 
								echo vlogger_do_shortcode('[ttg_reaktions-rating-count]' );
								?></span><?php  
							}
							?>
						</p>
					</div>


					
					<div class="qt-videoheader-tabs">

						<?php  

						$vlogger_serie_in = get_query_var("vlogger_serie_in", false);

						/**
						 * [$have_tabs false or HTML class, to prevent hs error]
						 * @var boolean
						 */
						$have_tabs = false;
						if(false !== $chapters_menu
							|| $vlogger_serie_in
							||$customtab !== ''
						){ 
							$have_tabs = 'tabs';
						}

						?>

						<ul id="qt-tutorialtabs" class="tabs">
							
							<?php if(false !== $chapters_menu){ ?>
								<li class="tab col s3"><a href="#chapters" class="active"><h6><?php esc_html_e( "Chapters", 'vlogger' ); ?></h6></a></li>
							<?php } ?>
							


							<?php 
							/**
							 * Conditional in case we come from a serie or not.
							 * If not link to a tab that contains enclosing series OR random series
							 */
							if($vlogger_serie_in){ ?>
								<li class="tab col s3"><a href="#episodes"><h6><?php esc_html_e( "Episodes", 'vlogger' ); ?></h6></a></li>
								<li class="tab col s3"><a href="#related"><h6><?php esc_html_e( "Related", 'vlogger' ); ?></h6></a></li>
							<?php } else { ?>
								<li class="tab col s3"><a href="#related"><h6><?php esc_html_e( "Related", 'vlogger' ); ?></h6></a></li>
								<li class="tab col s3"><a href="#seriesother"><h6><?php esc_html_e( "Series", 'vlogger' ); ?></h6></a></li>
							<?php } ?>



							<?php 
								if($customtab !== ''){ 
								$custom_tab_title = get_post_meta($post_id, 'vlogger_tutorial_customtab_title', true);
								?>
								<li class="tab col s3"><a href="#custom"><h6><?php echo esc_attr( $custom_tab_title ); ?></h6></a></li>
							<?php } ?>
						</ul>



						<?php  if(false !== $chapters_menu){ ?>
							<div id="chapters" class="qt-tabcontent">
								<h5 class="qt-spacer-s">
									<?php esc_html_e("Chapters", "vlogger"); ?>
								</h5>
								<hr class="qt-spacer-s">
								<?php 
								echo ttg_chapters_menu($post_id);
								?>
							</div>
						<?php } ?>
						
						

						<?php if($vlogger_serie_in){ ?>
							
							<div id="episodes" class="qt-tabcontent">
								<h5 class="qt-spacer-s">
									<?php esc_html_e("Episodes", "vlogger" ); ?>
								</h5>
								<hr class="qt-spacer-s">
								<?php 
								vlogger_extract_serie_episodes($vlogger_serie_in, $post_id);
								?>
							</div>

							<div id="related" class="qt-tabcontent">
								<h5 class="qt-spacer-s">
									<?php esc_html_e("Related series", "vlogger" ); ?>
								</h5>
								<hr class="qt-spacer-s">
								<div class="row qt-lowpadding">
									<?php  
									vlogger_related_series_mini($vlogger_serie_in);
									?>	
								</div>
							</div>

						<?php 
						} else { 
						?>

							<div id="related" class="qt-tabcontent">
								<h5 class="qt-spacer-s">
									<?php esc_html_e("Related", "vlogger" ); ?>
								</h5>
								<hr class="qt-spacer-s">
								<?php 
								vlogger_related_videos_list( $post_id);
								?>
							</div>
							<div id="seriesother" class="qt-tabcontent">
								<h5 class="qt-spacer-s">
									<?php esc_html_e("Other series", "vlogger" ); ?>
								</h5>
								<hr class="qt-spacer-s">
								<div class="row qt-lowpadding">
									<?php  
									vlogger_related_series_mini(	);
									?>
								</div>
								
							</div>
						<?php } ?>
						
						
						<?php  if($customtab !== ''){ ?>
							<div id="custom" class="qt-tabcontent">
								<h5 class="qt-spacer-s">
									<?php echo esc_attr( $custom_tab_title ); ?>
								</h5>
								<hr class="qt-spacer-s">
								<div>
									<?php 
									$allowed = array(
										'a' => array(
											'href' 	=> array(),
											'class' => array(),
											'title' => array(),
											'rel' => array()
										),
										'img' 	=> array(
											'src' 	=> array(),
											'class' => array(),
											'alt' 	=> array()
										),
										'br' 	=> array(),
										'table' => array(),
										'tr' 	=> array(),
										'td' 	=> array(
											'width' 	=> array()
										),
										'th' 	=> array(),
										'p' 	=> array(),
										'em' 	=> array(),
										'strong'=> array(),
									);
									echo wpautop(do_shortcode(wp_kses($customtab, $allowed ))); ?>
								</div>
							</div>
						<?php } ?>
					</div> 
				</div>
			</div>
		</div>
	</div>


	<div class="qt-header-bg" data-bgimage="<?php vlogger_header_image_url(); ?>" data-parallax="0" data-bgattachment="local">
	</div>
	<a href="#" id="ttgSidebarBlock" data-state="open" class="qt-sidebarlock tooltipped btn-floating btn-large qt-btn qt-btn-xl qt-btn-secondary" data-position="left" data-delay="50" data-tooltip="<?php esc_html_e("Lock sidebar", "vlogger" ); ?>"><i class="material-icons">lock_open</i></a>


</div>
<!-- HEADER CAPTION END ========================= -->