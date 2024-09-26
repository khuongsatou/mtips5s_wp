<?php
    /**
     * Class For Builder
     */
    class AgrulBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'agrul_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'agrul-core',AGRUL_PLUGDIRURI.'assets/js/agrul-core.js',array( 'jquery' ),'1.0',true );
		}


        public function agrul_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'agrul_header_option',
                [
                    'label'     => __( 'Header Option', 'agrul' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'agrul_header_style',
                [
                    'label'     => __( 'Header Option', 'agrul' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'agrul' ),
    					'header_builder'       => __( 'Header Builder', 'agrul' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'agrul_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'agrul' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->agrul_header_choose_option(),
                    'condition' => [ 'agrul_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'agrul_footer_option',
                [
                    'label'     => __( 'Footer Option', 'agrul' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'agrul_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'agrul' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'agrul' ),
    				'label_off'     => __( 'No', 'agrul' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'agrul_footer_style',
                [
                    'label'     => __( 'Footer Style', 'agrul' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'agrul' ),
    					'footer_builder'       => __( 'Footer Builder', 'agrul' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'agrul_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'agrul_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'agrul' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->agrul_footer_choose_option(),
                    'condition' => [ 'agrul_footer_style' => 'footer_builder','agrul_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Agrul Builder', 'agrul' ),
            	esc_html__( 'Agrul Builder', 'agrul' ),
				'manage_options',
				'agrul',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('agrul', esc_html__('Footer Builder', 'agrul'), esc_html__('Footer Builder', 'agrul'), 'manage_options', 'edit.php?post_type=agrul_footer');
			add_submenu_page('agrul', esc_html__('Header Builder', 'agrul'), esc_html__('Header Builder', 'agrul'), 'manage_options', 'edit.php?post_type=agrul_header');
            add_submenu_page('agrul', esc_html__('Tab Builder', 'agrul'), esc_html__('Tab Builder', 'agrul'), 'manage_options', 'edit.php?post_type=agrul_tab_builder');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','agrul' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'agrul' ),
				'singular_name'      => __( 'Footer', 'agrul' ),
				'menu_name'          => __( 'agrul Footer Builder', 'agrul' ),
				'name_admin_bar'     => __( 'Footer', 'agrul' ),
				'add_new'            => __( 'Add New', 'agrul' ),
				'add_new_item'       => __( 'Add New Footer', 'agrul' ),
				'new_item'           => __( 'New Footer', 'agrul' ),
				'edit_item'          => __( 'Edit Footer', 'agrul' ),
				'view_item'          => __( 'View Footer', 'agrul' ),
				'all_items'          => __( 'All Footer', 'agrul' ),
				'search_items'       => __( 'Search Footer', 'agrul' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'agrul' ),
				'not_found'          => __( 'No Footer found.', 'agrul' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'agrul' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'agrul_footer', $args );

			$labels = array(
				'name'               => __( 'Header', 'agrul' ),
				'singular_name'      => __( 'Header', 'agrul' ),
				'menu_name'          => __( 'agrul Header Builder', 'agrul' ),
				'name_admin_bar'     => __( 'Header', 'agrul' ),
				'add_new'            => __( 'Add New', 'agrul' ),
				'add_new_item'       => __( 'Add New Header', 'agrul' ),
				'new_item'           => __( 'New Header', 'agrul' ),
				'edit_item'          => __( 'Edit Header', 'agrul' ),
				'view_item'          => __( 'View Header', 'agrul' ),
				'all_items'          => __( 'All Header', 'agrul' ),
				'search_items'       => __( 'Search Header', 'agrul' ),
				'parent_item_colon'  => __( 'Parent Header:', 'agrul' ),
				'not_found'          => __( 'No Header found.', 'agrul' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'agrul' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'agrul_header', $args );

            $labels = array(
				'name'               => __( 'Tab Builder', 'agrul' ),
				'singular_name'      => __( 'Tab Builder', 'agrul' ),
				'menu_name'          => __( 'agrul Tab Builder', 'agrul' ),
				'name_admin_bar'     => __( 'Tab Builder', 'agrul' ),
				'add_new'            => __( 'Add New', 'agrul' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'agrul' ),
				'new_item'           => __( 'New Tab Builder', 'agrul' ),
				'edit_item'          => __( 'Edit Tab Builder', 'agrul' ),
				'view_item'          => __( 'View Tab Builder', 'agrul' ),
				'all_items'          => __( 'All Tab Builder', 'agrul' ),
				'search_items'       => __( 'Search Tab Builder', 'agrul' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'agrul' ),
				'not_found'          => __( 'No Tab Builder found.', 'agrul' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'agrul' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'agrul_tab_builder', $args );

		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'agrul_footer' == $post->post_type || 'agrul_header' == $post->post_type || 'agrul_tab_builder' == $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function agrul_footer_choose_option(){

			$agrul_post_query = new WP_Query( array(
				'post_type'			=> 'agrul_footer',
				'posts_per_page'	    => -1,
			) );

			$agrul_builder_post_title = array();
			$agrul_builder_post_title[''] = __('Select a Footer','agrul');

			while( $agrul_post_query->have_posts() ) {
				$agrul_post_query->the_post();
				$agrul_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $agrul_builder_post_title;

		}

		public function agrul_header_choose_option(){

			$agrul_post_query = new WP_Query( array(
				'post_type'			=> 'agrul_header',
				'posts_per_page'	    => -1,
			) );

			$agrul_builder_post_title = array();
			$agrul_builder_post_title[''] = __('Select a Header','agrul');

			while( $agrul_post_query->have_posts() ) {
				$agrul_post_query->the_post();
				$agrul_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $agrul_builder_post_title;

        }

    }

    $builder_execute = new AgrulBuilder();