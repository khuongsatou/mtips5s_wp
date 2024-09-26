<?php
/*
Package: Vlogger
*/

if (!function_exists('vlogger_short_customcard_sc')){
function vlogger_short_customcard_sc($atts){
	
	

	extract( shortcode_atts( array(
		'title' => false,
		'subtitle' => false,
		'link' => false,
		'linktitle' => false,
		'image' => false,
		'thumbsize' => 'large'
		
	), $atts ) );



	ob_start();
	?>
	<!-- CARD SIMPLE ========================= -->
	<div class="qt-part-archive-item qt-part-archive-item-customcard qt-negative">
		<div class="qt-part-archive-item-header">
			<div class="qt-vc">
				<div class="qt-headercontainer qt-vi-bottom" >
					<div class="qt-container">
						<div>
							<?php if($title){ ?>
							<h3 class="qt-caption qt-spacer-s">
								<?php 
								if ($link){ ?><a href="<?php echo esc_url($link); ?>"><?php } ?>
									<?php echo esc_attr($title); ?>
								<?php if ($link){ ?></a><?php } ?>
							</h3>
							<?php } ?>
							<?php if($subtitle){ ?>
							<p class="qt-item-metas qt-small">
								<?php echo esc_attr($subtitle); ?>
								<?php if ($link && $linktitle){ ?><a class="right" href="<?php echo esc_url($link); ?>"><?php } ?>
									<?php if($linktitle){ ?><?php echo esc_attr($linktitle); ?> <i class="dripicons-arrow-thin-right"></i><?php } ?>
								<?php if ($link && $linktitle){ ?></a><?php } ?>
							</p>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php 
				if($image){ 
					$image = wp_get_attachment_image_src($image, $thumbsize); 
					if($image && is_array($image)){
					?>
					<div class="qt-header-bg" data-bgimage="<?php echo esc_url( $image[0]); ?>" data-parallax="0" data-attachment="relative">
					</div>
					<?php } ?>
			<?php } ?>
		</div>
	</div>
	<!-- CARD SIMPLE END ========================= -->
	<?php
	return ob_get_clean();
}}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode('vlogger-customcard', 'vlogger_short_customcard_sc' );
}




/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_short_customcard_sc' );
if(!function_exists('vlogger_vc_short_customcard_sc')){
function vlogger_vc_short_customcard_sc() {
  vc_map( array(
	 "name" => esc_html__( "Custom card", "vlogger" ),
	 "base" => "vlogger-customcard",
	 "icon" => get_template_directory_uri(). '/img/custom-card.png',
	 "description" => esc_html__( "Customizable full size card with photo background", "vlogger" ),
	 "category" => esc_html__( "Theme shortcodes", "vlogger"),
	 "params" => array(
		


		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Title", "vlogger" ),
		   "param_name" => "title"
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Subtitle", "vlogger" ),
		   "param_name" => "subtitle"
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Link", "vlogger" ),
		   "param_name" => "link"
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Link anchor text", "vlogger" ),
		   "param_name" => "linktitle"
		),
		array(
		   "type" => "attach_image",
		   "heading" => esc_html__( "Image", "vlogger" ),
		   "param_name" => "image"
		),
		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Image size", "vlogger" ),
		   "param_name" => "thumbsize",
		   "std" => "large",
		   'value' => array(
				__("Thumbnail", "vlogger")	=>"thumbnail",
				__("Medium", "vlogger")		=>"medium",
				__("Large", "vlogger")		=>"large",
				__("Full", "vlogger")		=> "full"
			),
		   "description" => esc_html__( "Choose the post template for the items", "vlogger" )
		),
		
	 )
  ) );
}}
