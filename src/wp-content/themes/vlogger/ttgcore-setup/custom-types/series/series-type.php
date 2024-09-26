<?php

add_action('init', 'vlogger_serie_register_type');  
if(!function_exists('vlogger_serie_register_type')){
function vlogger_serie_register_type() {
	$labelsserie = array(
		'name' => esc_html__("Series","vlogger"),
		'singular_name' => esc_html__("Serie","vlogger"),
		'add_new' => esc_html__("Add new","vlogger"),
		'add_new_item' => esc_html__("Add new serie","vlogger"),
		'edit_item' => esc_html__("Edit serie","vlogger"),
		'new_item' => esc_html__("New serie","vlogger"),
		'all_items' => esc_html__("All series","vlogger"),
		'view_item' => esc_html__("View serie","vlogger"),
		'search_items' => esc_html__("Search serie","vlogger"),
		'not_found' => esc_html__("No series found","vlogger"),
		'not_found_in_trash' => esc_html__("No series found in trash","vlogger"),
		'menu_name' => esc_html__("Series","vlogger")
	);
	$args = array(
		'labels' => $labelsserie,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'series'),
		'capability_type' => 'page',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 30,
		'page-attributes' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => true,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-playlist-video',
		'supports' => array('title', 'thumbnail','editor','page-attributes' )
	);

	if(function_exists('ttg_custom_post_type')){
		ttg_custom_post_type( "vlogger_serie" , $args );
	}

	/* ============= create custom taxonomy for the series ==========================*/
	$labels = array(
		'name' => esc_html__( 'Series categories',"vlogger" ),
		'singular_name' => esc_html__( 'Categories',"vlogger" ),
		'search_items' =>  esc_html__( 'Search by category',"vlogger" ),
		'popular_items' => esc_html__( 'Popular categories',"vlogger" ),
		'all_items' => esc_html__( 'All categories',"vlogger" ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => esc_html__( 'Edit category',"vlogger" ), 
		'update_item' => esc_html__( 'Update category',"vlogger" ),
		'add_new_item' => esc_html__( 'Add new category',"vlogger" ),
		'new_item_name' => esc_html__( 'New category name',"vlogger" ),
		'separate_items_with_commas' => esc_html__( 'Separate categories with commas',"vlogger" ),
		'add_or_remove_items' => esc_html__( 'Add or remove categories',"vlogger" ),
		'choose_from_most_used' => esc_html__( 'Choose from the most used series categories',"vlogger" ),
		'menu_name' => esc_html__( 'Series categories',"vlogger" ),
	); 
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'seriescategory' )
	);
	if(function_exists('ttg_custom_taxonomy')){
		ttg_custom_taxonomy('vlogger_seriescategory','vlogger_serie', $args );
	}
}}




$serie_tab_custom = array(

  	
	array (
		'label' => esc_html__('Header',"vlogger"),
		'id' =>  'vlogger_hide_header',
		'desc'  => esc_html__('Hide header', 'vlogger'),
		'type' => 'checkbox'
	),
	array (
		'label' =>  esc_html__('Menu opacity',"vlogger"),
		'id' =>  'vlogger_header_transparent',
		'default' => "default",
		'desc'  => esc_html__('Override Customizer settings', 'vlogger'),
		'type'  => 'select',
		'options' => array (
			array('label' => __('Default',"vlogger"),'value' => ''),
			array('label' => __('Opaque',"vlogger"),'value' => '0'),    
			array('label' => __('Transparent',"vlogger"),'value' => '1')
		)
	),
	array (
		'label' => esc_html__('Presentation',"vlogger"),
		'id' =>  'vlogger_series_intro',
		'type' => 'editor'
	),	
	array(
		'label' => esc_html__('Episodes', "vlogger"), // <label>
		'desc'  => '',// description
		'id'    => 'vlogger_seriesvideos', // field id and name
		'type'  => 'repeatable', // type of field
		'sanitizer' => array( // array of sanitizers with matching kets to next array
			'featured' => 'meta_box_santitize_boolean',
			'title' => 'sanitize_text_field',
			'desc' => 'wp_kses_data'
		),
		'repeatable_fields' => array ( // array of fields to be repeated
			'vlogger_episodes' => array(
				'label' => esc_html__('Episode', "vlogger"),
				'desc'  => '',
				'id' => 'vlogger_episodes',
				'type' => 'post_chosen'
			),
		)
	) 
);
if (class_exists('custom_add_meta_box')){
	$serie_tab_custom_box = new custom_add_meta_box( 'serie_customtab', esc_html__('Settings', "vlogger"), $serie_tab_custom, 'vlogger_serie', true );
}
