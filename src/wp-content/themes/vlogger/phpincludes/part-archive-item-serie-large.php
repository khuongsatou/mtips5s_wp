<?php
/*
Package: Vlogger
*/

$post = get_post(get_the_ID());
$user_id = $post->post_author;
$avatar = get_avatar_url($user_id );


?>


<!-- SERIE LARGE  ========================= -->
<div <?php post_class("qt-part-archive-item qt-part-archive-item-serie-large"); ?>>
	<div class="qt-container">
		<div class="row">
			<div class="col s12 m4 l4">
				<a class="qt-inlineimg" href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium', array("class" => "attachment-thumbnail size-thumbnail wp-post-image" ) ); ?>
					<i class="qticon-play"></i>
				</a>
			</div>
			<div class="col s12 m8 l8">
				
				<h4 class="qt-caption">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h4>

				<p class="qt-item-metas">
					<?php
					$time = get_post_meta(get_the_id(), "vlogger_video_duration", true);
					if(!$time || $time == ''){
						$time = vlogger_readingtime(get_the_id());
					}
					echo ' <strong>'.esc_html__("Duration", "vlogger").':</strong> '.esc_attr($time); 
					?>
					<?php  
					/**
					 * Views
					 * 
					 */
					echo vlogger_do_shortcode('[ttg_reaktions-views-raw]');
					?>
				</p>
				<div class="excerpt qt-medtext">
					<?php echo str_replace("\n", '<br>', get_the_excerpt()); ?>
				</div>
			</div>
		</div>	
	</div>
</div>
<!-- SERIE LARGE ========================= -->

