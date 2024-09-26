<?php
/*
Package: Vlogger
*/

?>
<!-- CARD SIMPLE ========================= -->
<div class="qt-part-archive-item qt-part-archive-item-card-interactive qt-interactivecard qt-paper">
	<div class="qt-part-archive-item-header qt-content-primary-dark">
		<div class="qt-topmetas">
			<div class="qt-container">
				<p class="qt-item-metas qt-small">
					<span class="qt-posttype"><i class="material-icons">video_library</i> <?php esc_html_e("Series", "vlogger"); ?></span>
					<a class="right qt-activate-card qt-closecard" href="#" >
						<i class="dripicons-cross"></i>
					</a>
				</p>
			</div>
		</div>
		<div class="qt-vc qt-titles qt-negative">
			<div class="qt-vi-bottom">
				<div class="qt-container">
					<ul class="qt-tags ">
						<?php  echo get_the_term_list( $post->ID, 'vlogger_seriescategory', '<li>', '</li><li>', '</li>' );  ?>
					</ul>
					<h4 class="qt-title qt-spacer-s">
						<a href="<?php the_permalink(); ?>" class="qt-activate-card">
							<?php the_title(); ?>
						</a>
					</h4>
					<p class="qt-small qt-details qt-spacer-s qt-item-metas">
						<?php 
						$videos_quantity =  vlogger_get_ep_count(get_the_id()); 
						if(($videos_quantity && $videos_quantity > 0)){
							echo sprintf( _n( '%s Video', '%s Videos', $videos_quantity, 'vlogger' ), $videos_quantity );
						}
						?>
						<a class="right qt-activate-card" href="#!" >
							<?php esc_html_e("Read more", "vlogger"); ?> <i class="dripicons-arrow-thin-right"></i>
						</a>
					</p>
					<p class="qt-actionpart">
						<a href="<?php the_permalink(); ?>" class="qt-btn qt-btn-primary">
							<?php esc_html_e("Start now", "vlogger"); ?>
						</a>
					</p>
				</div>
			</div>
		</div>
		<?php if (has_post_thumbnail()){ ?>
	        <a href="#!" class="qt-header-bg qt-activate-card" data-bgimage="<?php the_post_thumbnail_url( 'large' ); ?>" data-parallax="0">
	        </a>
     	<?php } ?>
	</div>


	<div class="qt-part-archive-item-morecontents qt-cardtabs">
		<ul class="tabs qt-nopadding">
			<li class="tab col s3"><a href="#" data-activatetab="details"><h6><?php esc_html_e("Details", "vlogger"); ?></h6></a></li>
			<li class="tab col s3"><a href="#" data-activatetab="episodes"><h6><?php esc_html_e("Episodes", "vlogger"); ?></h6></a></li>
			<li class="tab col s3"><a href="#" data-activatetab="related"><h6><?php esc_html_e("Related", "vlogger"); ?></h6></a></li>
		</ul>
		<div class="col s12 qt-the-content" data-details>
			<div class="qt-container">
				<h4 class="qt-spacer-m">
					<?php the_title(); ?>
				</h4>
				<div class="qt-medtext qt-spacer-s">
					<?php 
					$text = get_post_field('post_content', get_the_id());
					$text = strip_shortcodes($text);
					$text = apply_filters('the_content', $text);

					$allowed_tags = array(
						'a' => array(
					        'href' => array(),
					        'target' => array(),
						),
						'<br>',
						'</strong>'
					);
					$text = wp_kses_post($text);
					$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);

					$excerpt_length = 110;
					$words = explode(' ', $text, $excerpt_length + 1);
					if (count($words)> $excerpt_length) {
						array_pop($words);
						array_push($words, '[...]');
						$text = implode(' ', $words);
					}
					echo wpautop( $text, true);
					?>
				</div>
			</div>
		</div>
		<div class="col s12 qt-the-content qt-hidden" data-episodes>
			<div class="qt-container">
				<h4 class="qt-spacer-m">
					<?php 
					$videos_quantity =  vlogger_get_ep_count(get_the_id()); 
					if(($videos_quantity && $videos_quantity > 0)){
						?><span class="qt-iconcaption"><?php
						echo sprintf( _n( '%s Video', '%s Videos', $videos_quantity, 'vlogger' ), $videos_quantity );
						?></span><?php
					}
					?>
				</h4>
				<hr class="qt-spacer-s">
				<?php 
				vlogger_extract_serie_episodes(get_the_id());
				?>
			</div>
		</div>
		<div class="col s12 qt-the-content qt-hidden" data-related>
			<div class="qt-container">
				<h4 class="qt-spacer-m">
					<?php esc_html_e("Related series", "vlogger"); ?>
				</h4>
				<hr class="qt-spacer-s">
				<div class="row qt-lowpadding">
					<?php 
					vlogger_related_series_mini( get_the_id() );
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- CARD SIMPLE ========================= -->
