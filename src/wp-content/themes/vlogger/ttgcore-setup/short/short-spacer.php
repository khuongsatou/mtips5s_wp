<?php
/*
Package: Vlogger
*/

/**
 * 
 * Spacer
 * =============================================
 */
if(!function_exists('vlogger_spacer')){
	function vlogger_spacer ($atts){
		extract( shortcode_atts( array(
			'size' => 's',
		), $atts ) );
		if($size !== 's' && $size !== 'm' && $size !== 'l') {
			$size = 's';
		}
		ob_start();
		?>
			<hr class="qt-spacer-<?php echo esc_attr($size); ?>">
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("vlogger-spacer","vlogger_spacer");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_spacer' );
if(!function_exists('vlogger_vc_spacer')){
function vlogger_vc_spacer() {
  	vc_map( 
	  	array(
		 	"name" => esc_html__( "Spacer", "vlogger" ),
		 	"base" => "vlogger-spacer",
		 	"icon" => get_template_directory_uri(). '/img/spacer.png',
		 	"description" => esc_html__( "Spacer", "vlogger" ),
		 	"category" => esc_html__( "Theme shortcodes", "vlogger"),
		 	"params" => array(
				array(
				   "type" => "dropdown",
				   "heading" => esc_html__( "Size", "vlogger" ),
				   "param_name" => "size",
				   'value' => array("s", "m", "l"),
				   "description" => esc_html__( "Empty spacer separator", "vlogger" )
				)
			)
		)
  	);
}}