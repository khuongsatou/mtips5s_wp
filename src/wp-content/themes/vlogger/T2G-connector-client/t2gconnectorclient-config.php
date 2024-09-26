<?php
if(!class_exists("T2GConnectorConfig")){
class T2GConnectorConfig {
	public function __construct(){
		
	}
	///return $this->login_url.$this->client_id.'&redirect_uri='.$this->login_page;
	// This function needs to stay in the functions.php of the theme
	public function t2gconnector_product_sku() {
		return '20414115'; // if false we don't do check or auto updates of theme
	}
	// generic settings
	public function t2gconnector_settings(){
		$settings = array 
			(
				"dashboard_title" => "Vlogger",
				'logo' => get_template_directory_uri() . '/img/logo.png',
				'auto_update_theme' => false,
				'manual_url' => esc_url('http://themes2go.xyz/manuals/vlogger/'),
				'helpdesk_url' => esc_url('http://www.themes2go.xyz/helpdesk/forums/forum/vlogger-wp/'),
				'messageboard_top' => esc_url('https://themes2go.xyz/t2gconnector-comm/vlogger/vlogger_messageboard_top.php'),
				"deepcheck" => false,
				'icon' => get_template_directory_uri() . '/img/theme-icon.png',
			);
		return $settings;
	}
	// for auto plugin update
	public function t2gconnector_plugins_list(){
		$repo = esc_url('http://www.themes2go.xyz/plugins_repo/vlogger/');
		$folder = 'vlogger-20230119-PumPuP7H3V0LuM3/';
		$plugins = array(
			array(
				'name'      => esc_attr('T2G Theme Dashboard','vlogger'),
				'slug'      => 't2gconnectorclient',
				'version'	=> '1.3.7',
				'required'  => true,
				'source'             => $repo . 'static/' .'t2gconnectorclient-1.3.7.zip',
				'force_activation'   => false, 
				'force_deactivation' => false
			),
			array(
				'name'      		=> esc_attr('Theme Core Plugin','vlogger'),
				'slug'      		=> 'ttg-core',
				'version'			=> '1.3.4',
				'required'  		=> true,
				'source'             => $repo . $folder . 'ttg-core-1.3.4.zip',
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_attr('WPBakery Page Builder','vlogger'),
				'slug'               => 'js_composer',
				'source'             => $repo . $folder.'js_composer-7.3-1tg45.zip',
				'version'			 => '7.3',
				'required'           => true,
				'force_activation'   => false, 
				'force_deactivation' => false
			),
			array(
	            'name'     			 => esc_html__('Classic Editor', 'lifecoach' ),
	            'slug'     			 => 'classic-editor',
	            'required'           => true, 
				'force_activation'   => true,
				'force_deactivation' => false
			),
			array(
	            'name'     			 => esc_html__('Classic Widgets', 'lifecoach' ),
	            'slug'     			 => 'classic-widgets',
	            'required'           => true, 
				'force_activation'   => true,
				'force_deactivation' => false
			),
			array(
				'name'      => esc_attr('T2G Reaktions','vlogger'),
				'slug'      => 'ttg-reaktions',
				'version'	=> '3.0',
				'required'  => true,
				'source'             => $repo . $folder . 'ttg-reaktions-3.0-Jdoq93haNX.zip',
				'force_activation'   => false, 
				'force_deactivation' => false
			),
			array(
				'name'      => esc_attr('T2G Watch later','vlogger'),
				'slug'      => 'ttg-watchlater',
				'version'	=> '1.0.7',
				'required'  => true,
				'source'             => $repo . $folder . 'ttg-watchlater-1.0.7.zip',
				'force_activation'   => false, 
				'force_deactivation' => false
			),
			array(
				'name'      => esc_attr('T2G Chapters','vlogger'),
				'slug'      => 'ttg-chapters',
				'version'	=> '1.0.0',
				'required'  => true,
				'source'             => $repo . $folder . 'ttg-chapters.zip',
				'force_activation'   => false, 
				'force_deactivation' => false
			),
			array(
				'name'      => esc_attr('T2G Widgets','vlogger'),
				'slug'      => 'ttg-widgets',
				'version'	=> 'vlogger-1.0.5',
				'required'  => true,
				'source'             => $repo . $folder . 'ttg-widgets-1.0.5.zip',
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'      => esc_attr('Category Backgrounds','vlogger'),
				'slug'      => 'ttg-categorybg',
				'version'	=> '1.1.1',
				'required'  => false,
				'source'             => $repo . $folder . 'ttg-categorybg-1.1.1.zip',
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'      => esc_attr('Envato Market - One Click Theme Updater','vlogger'),
				'slug'      => 'envato-market',
				'version'	=> '2.0.6',
				'required'  => true,
				'source'             => $repo . $folder. 'envato-market-2.0.6.zip',
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'required' 	=> false,
			),
			array(
	            'name'     	=> 'MailChimp for WordPress', 
	            'required' 	=> true,
	            'slug'     	=> 'mailchimp-for-wp'
			)
		);
		return $plugins;
	}
	public function t2gconnector_demos_list(){
		$demos = array(
			'demo0' => array(
				'name'      	=> "Main demo",
				'folder'       	=>  '/T2G-connector-client/demo/demo0/',
				'screenshot'   	=>  '/T2G-connector-client/demo/demo0/screenshot.jpg', 
				'description'	=>	'Generic demo'
			),
			'demo1-food' => array(
				'name'      	=> "Food",
				'folder'       	=>  '/T2G-connector-client/demo/demo1-food/',
				'screenshot'   	=>  '/T2G-connector-client/demo/demo1-food/screenshot.jpg', 
				'description'	=>	'Food demo'
			),
			'demo2-travel' => array(
				'name'      	=> "Travel",
				'folder'       	=>  '/T2G-connector-client/demo/demo2-travel/',
				'screenshot'   	=>  '/T2G-connector-client/demo/demo2-travel/screenshot.jpg', 
				'description'	=>	'Food demo'
			),
			'demo3-diy' => array(
				'name'      	=> "Do It Yourself",
				'folder'       	=>  '/T2G-connector-client/demo/demo3-diy/',
				'screenshot'   	=>  '/T2G-connector-client/demo/demo3-diy/screenshot.jpg', 
				'description'	=>	'Fresh and engagind DIY vlogging demo'
			)
		);
		return $demos;
	}
}
}

