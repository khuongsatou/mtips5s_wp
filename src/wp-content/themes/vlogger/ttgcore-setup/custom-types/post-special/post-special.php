<?php  

/*
*	Post design
*	=============================================================
*/


if(!function_exists("vlogger_post_design_options")){
function vlogger_post_design_options() {
	$settings = array (

		array (
			'label' =>  esc_html__('Post template',"vlogger"),
			'id' =>  'vlogger_post_template',
			'default' => "default",
			'type' 	=> 'select',
			'options' => array (
				array('label' => __('Default',"vlogger"),'value' => 'default'),
				array('label' => __('Tutorial',"vlogger"),'value' => 'tutorial'),	
			)
		)
	);
	if(function_exists('custom_meta_box_field')){
		$main_box_video = new custom_add_meta_box('vlogger_post_design_options', 'Post design options', $settings, 'post', true );
	}
}}
add_action('init', 'vlogger_post_design_options');  





/*
*	Tutorial design settings
*	=============================================================
*/



if(!function_exists("vlogger_add_tutorial_special_fields")){
function vlogger_add_tutorial_special_fields() {
	$settings = array (
		array (
			'label' => esc_html__('Custom tab title',"vlogger"),
			'id' =>  'vlogger_tutorial_customtab_title',
			'type' => 'text'
		) ,
		array (
			'label' => esc_html__('Custom tab content',"vlogger"),
			'id' =>  'vlogger_tutorial_customtab_content',
			'type' => 'editor'
		) 

	);

	if(function_exists('custom_meta_box_field')){
		$main_box_video = new custom_add_meta_box('vlogger_tutorial_special_fields', 'Tutorial content settings', $settings, 'post', true );
	}

}}
add_action('init', 'vlogger_add_tutorial_special_fields');  




/*
*	Video settings
*	=============================================================
*/
if(!function_exists("vlogger_add_video_special_fields")){
function vlogger_add_video_special_fields() {
	$settings = array (
		array (
			'label' => esc_html__('Video duration',"vlogger"),
			'id' =>  'vlogger_video_duration',
			'type' => 'text'
		),
		array (
			'label' => esc_html__('Hide first embedded video',"vlogger"),
			'id' =>  'vlogger_hide_embedded_video',
			'type' => 'checkbox'
		)
	);
	if(function_exists('custom_meta_box_field')){
		$main_box_video = new custom_add_meta_box('vlogger_video_special_fields', 'Video settings', $settings, 'post', true );
	}
}}
add_action('init', 'vlogger_add_video_special_fields');  





