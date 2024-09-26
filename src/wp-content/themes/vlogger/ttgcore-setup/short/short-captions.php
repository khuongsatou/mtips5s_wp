<?php  
/*
Package: vlogger
Description: Captions shortcodes
Version: 1.2.2
Author: Themes2Go
Author URI: http://themes2go.xyz
*/


/**
 * 
 * Caption large
 * =============================================
 */
if(!function_exists('vlogger_caption_large')){
	function vlogger_caption_large ($atts){
		extract( shortcode_atts( array(
			'title' => '',
			'class' => '',
			'subtitle' => '',
			'link' => '',
			'link_anchor' => '',
			'size' => 'h1'
		), $atts ) );
		ob_start();
		?>
		<div class="qt-sectiontitle-inline">
			<h3 class="qt-inlinetitle <?php echo esc_attr( $class.' '.'qt-fontsize-'.$size ); ?>">
				<?php if($title){ ?>		
						<?php echo esc_attr($title); ?>
				<?php } ?>
				<?php if($link_anchor && $link){ ?>
					<a class="qt-inlinelink" href="<?php echo esc_url($link); ?>"><span><?php echo esc_attr($link_anchor ); ?></span></a>
				<?php } ?>
			</h3>
		</div>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("vlogger-caption-large","vlogger_caption_large");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_caption_large' );
if(!function_exists('vlogger_vc_caption_large')){
function vlogger_vc_caption_large() {
  vc_map( array(
	 "name" => esc_html__( "Caption large", "vlogger" ),
	 "base" => "vlogger-caption-large",
	 "icon" => get_template_directory_uri(). '/img/caption-large.png',
	 "description" => esc_html__( "Section caption", "vlogger" ),
	 "category" => esc_html__( "Theme shortcodes", "vlogger"),
	 "params" => array(

		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Text", "vlogger" ),
		   "param_name" => "title",
		   'value' => ''
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Link URL", "vlogger" ),
		   "param_name" => "link",
		   'value' => ''
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Link anchor text", "vlogger" ),
		   "param_name" => "link_anchor",
		   'value' => ''
		)
		,array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Class", "vlogger" ),
		   "param_name" => "class",
		   'value' => '',
		   'description' => 'add an extra class for styling with CSS'
		),

		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Size", "vlogger" ),
		   "param_name" => "size",
		   'value' => array("h1", "h2", "h3", "h4", "h5"),
		)

	 )
  ) );
}}


/**
 * 
 * Caption small
 * =============================================
 */
if(!function_exists('vlogger_caption_small')){
	function vlogger_caption_small ($atts){
		extract( shortcode_atts( array(
			'class' => '',
			'title' => ''
		), $atts ) );
		ob_start();
		?>
	  	<h5 class="qt-caption-small"><span><?php echo esc_attr($title); ?></span></h5>
		<?php
		return ob_get_clean();
	}
}
if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-caption-small","vlogger_caption_small");
}

/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_vlogger_caption_small' );
if(!function_exists('vlogger_vc_vlogger_caption_small')){
function vlogger_vc_vlogger_caption_small() {
  vc_map( array(
	 "name" => esc_html__( "Caption small", "vlogger" ),
	 "base" => "qt-caption-small",
	 "icon" => get_template_directory_uri(). '/img/caption-small.png',
	 "description" => esc_html__( "Section caption small", "vlogger" ),
	 "category" => esc_html__( "Theme shortcodes", "vlogger"),
	 "params" => array(
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Text", "vlogger" ),
		   "param_name" => "title",
		   'value' => ''
		)
		,array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Class", "vlogger" ),
		   "param_name" => "class",
		   'value' => '',
		   'description' => 'add an extra class for styling with CSS'
		)
	 )
  ) );
}}

