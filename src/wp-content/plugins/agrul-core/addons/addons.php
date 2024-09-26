<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main agrul Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class Agrul_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}


	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

        // Register widget scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_widget_styles' ] );


        // category register
		add_action( 'elementor/elements/categories_registered',[ $this, 'Agrul_elementor_widget_categories' ] );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'agrul' ),
			'<strong>' . esc_html__( 'Agrul Core', 'agrul' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'agrul' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'agrul' ),
			'<strong>' . esc_html__( 'agrul Core', 'agrul' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'agrul' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'agrul' ),
			'<strong>' . esc_html__( 'agrul Core', 'agrul' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'agrul' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run Saasland Core.
		 *
		 * @since 1.7.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */
		
		public function enqueue_widget_styles() {
            wp_enqueue_style( 'agrul-flaticons', AGRUL_PLUGDIRURI .'assets/fonts/flaticon-set.css');
		}



	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		require_once( AGRUL_ADDONS. '/widgets/agrul-banner.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-about-image.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-about-content.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-service.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-product.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-accordian.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-choose-us.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-testimonial-carousel.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-gallery.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-funfact.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-contact-form.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-contact-info.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-farmers.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-farmer-info.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-personal-info.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-progressbar.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-service-list.php' );
		require_once( AGRUL_ADDONS. '/widgets/agrul-service-quick-contact.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-brand.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-project-feature.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-project-basic-info.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-header-topbar.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-el-header.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-blog.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-product-feature.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-subscribe-form.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-woo-product.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-offer.php');
		require_once( AGRUL_ADDONS. '/widgets/agrul-feature.php');

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register( new \Agrul_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_About_Image_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_About_Content_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Service_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Product_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Accordian_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Choose_Us_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Testomonial_Carousel_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Gallery_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Funfactor_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Contact_Form_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Contact_Info_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Farmer_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Farmer_Info_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Personal_Info_Widget() ); 
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Progressbar() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Service_List_Widget() ); 
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Service_Quick_Contact_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Brand_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Project_Feature_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Project_Basic_Info_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Header_Topbar_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Header_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Blog_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Product_Feature_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Agrul_Subscribe_Widgets() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Woo_Product_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Offer_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Agrul_Feature_Widget() );
	}

    public function widget_scripts() {
        wp_enqueue_script(
            'agrul-frontend-script',
            AGRUL_PLUGDIRURI . 'assets/js/agrul-frontend.js',
            array('jquery'),
            false,
            true
		);
	}
	

    function Agrul_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'agrul_elements',
            [
                'title' => __( 'Agrul', 'agrul' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
        $elements_manager->add_category(
            'agrul_footer_elements',
            [
                'title' => __( 'Agrul Footer Elements', 'agrul' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'agrul_header_elements',
            [
                'title' => __( 'Agrul Header Elements', 'agrul' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'agrul_service_elements',
            [
                'title' => __( 'Agrul Service Elements', 'agrul' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

	}

}

Agrul_Extension::instance();