<?php  

/*
*	Page special attributes
*	=============================================================
*/

if(!function_exists("vlogger_add_special_fields")){
function vlogger_add_special_fields() {
	$qt_design_settings = array (
		array (
			'label' =>  esc_html__('Transparent header',"vlogger"),
			'id' =>  'vlogger_header_transparent',
			'default' => "default",
			'type' 	=> 'select',
			'options' => array (
				array('label' => __('Default',"vlogger"),'value' => ''),
				array('label' => __('Opaque',"vlogger"),'value' => '0'),	
				array('label' => __('Transparent',"vlogger"),'value' => '1')
			)
		),
		array (
			'label' => esc_html__('Header',"vlogger"),
			'id' =>  'vlogger_hide_header',
			'desc'  => esc_html__('Hide header', 'vlogger'),
			'type' => 'checkbox'
		),
		
	);
	if(post_type_exists('page')){
		if(function_exists('custom_meta_box_field')){
			$main_box = new custom_add_meta_box('vlogger_design_settings', 'Custom page settings', $qt_design_settings, 'page', true );
		}
	}
}}

add_action('init', 'vlogger_add_special_fields');  