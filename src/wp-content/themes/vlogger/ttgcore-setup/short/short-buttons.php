<?php  
/*
Package: vlogger
Description: Buttons shortcode
Version: 1.2.2
Author: Themes2Go
Author URI: http://themes2go.xyz
*/

/**
 * 
 * Caption medium
 * =============================================
 */
if(!function_exists('vlogger_buttons_shortcode')){
	function vlogger_buttons_shortcode ($atts){
		extract( shortcode_atts( array(
			'text' => 'click',
			'link' => '#',
			'size' => 'qt-btn-s',
			'target' => '',
			'style' => 'qt-btn-default',
			'alignment' => '',
			'class' => ''
		), $atts ) );

		if(!function_exists('vc_param_group_parse_atts') ){
			return;
		}
		ob_start();
		?>
			<?php  
			if($alignment == 'aligncenter'){
			?>
			<p class="aligncenter">
			<?php
			}
			?>
			<a href="<?php echo esc_attr($link); ?>" <?php if($target == "_blank"){ ?> target="_blank" <?php } ?> class="qt-btn <?php  echo esc_attr($size.' '.$size.' '.$style.' '.$alignment); ?>"><?php echo esc_attr($text); ?></a>
			<?php  
				if($alignment == 'aligncenter'){
			?>
			</p>
			<?php
			}
			?>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("vlogger-button","vlogger_buttons_shortcode");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_buttons_shortcode' );
if(!function_exists('vlogger_vc_buttons_shortcode')){
function vlogger_vc_buttons_shortcode() {
  vc_map( array(
	"name" => esc_html__( "Button", "vlogger" ),
	"base" => "vlogger-button",
	"icon" => get_template_directory_uri(). '/img/button.png',
	"description" => esc_html__( "Add a button with link", "vlogger" ),
	"category" => esc_html__( "Theme shortcodes", "vlogger"),
	"params" => array(
			array(
				'type' => 'textfield',
				'value' => '',
				'heading' => 'Text',
				'param_name' => 'text',
			),
			array(
				'type' => 'textfield',
				'value' => '',
				'heading' => 'Link',
				'param_name' => 'link',
			),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Link target", "vlogger" ),
				"param_name" => "target",
				'value' => array( 
					esc_html__("Same window","vlogger") => "",
					esc_html__("New window","vlogger") => "_blank",
					)			
				),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Size", "vlogger" ),
				"param_name" => "size",
				'value' => array("Small" => "qt-btn-s","Medium" => "qt-btn-m","Large" => "qt-btn-l", "Extra large" => 'qt-btn-xl'),
				"description" => esc_html__( "Button size", "vlogger" )
			),

			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Button style", "vlogger" ),
				"param_name" => "style",
				'value' => array( 
					esc_html__("Default","vlogger") => "qt-btn-default",
					esc_html__("Primary","vlogger") => "qt-btn-primary",
					esc_html__("Secondary","vlogger") => "qt-btn-secondary",
					esc_html__("Ghost","vlogger") => "qt-btn-ghost",
					)			
				),
			array(
				"type" => "dropdown",
				"heading" => esc_html__( "Alignment", "vlogger" ),
				"param_name" => "alignment",
				'value' => array( 
								esc_html__("Default","vlogger") => "",
								esc_html__("Left","vlogger") => "alignleft",
								esc_html__("Right","vlogger") => "alignright",
								esc_html__("Center","vlogger") => "aligncenter",
								),
				"description" => esc_html__( "Button style", "vlogger" )
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__( "Class", "vlogger" ),
				"param_name" => "class",
				'value' => '',
				'description' => 'add an extra class for styling with CSS'
			)
		)
  	));
}}
