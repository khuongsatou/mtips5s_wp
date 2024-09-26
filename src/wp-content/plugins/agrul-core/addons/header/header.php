<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Header Widget .
 *
 */
class Agrul_Header extends Widget_Base {

	public function get_name() {
		return 'agrulheader';
	}

	public function get_title() {
		return __( 'Header', 'agrul' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'agrul_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'header_section',
			[
				'label' 	=> __( 'Header', 'agrul' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'header_style',
			[
				'label' 		=> __( 'Header Style', 'agrul' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'agrul' ),
					'2' 		=> __( 'Style Two', 'agrul' ),
				],
			]
		);
		$this->add_control(
			'logo_image',
			[
				'label' 		=> __( 'Upload Logo Light Image', 'agrul' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'logo_image_dark',
			[
				'label' 		=> __( 'Upload Logo Dark Image', 'agrul' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'header_style' => [ '1'] ],
			]
		);
		$this->add_control(
			'logo_image_mobile',
			[
				'label' 		=> __( 'Upload Logo For Mobile Device', 'agrul' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'header_style' => [ '1'] ],
			]
		);
        $this->add_control(
			'logo_link',
			[
				'label' 		=> __( 'Logo Link', 'sasoft' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'sasoft' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'sasoft' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> __( 'Button Text', 'sasoft' ),
                'condition'		=> [ 'header_style' => [ '1'] ],
			]
        );

		$this->add_control(
			'button_link',
			[
				'label' 		=> __( 'Link', 'sasoft' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'sasoft' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'header_style' => [ '1'] ],
			]
		);

		$menus = $this->agrul_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'agrul_menu_select',
				[
					'label'     	=> __( 'Select agrul Menu', 'agrul' ),
					'type'      	=> Controls_Manager::SELECT,
					'options'   	=> $menus,
					'description' 	=> sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'agrul' ), admin_url( 'nav-menus.php' ) ),
					'condition'		=> [ 'header_style' => [ '1'] ],
				]
			);
		}else {
			$this->add_control(
				'no_menu',
				[
					'type' 				=> Controls_Manager::RAW_HTML,
					'raw' 				=> '<strong>' . __( 'There are no menus in your site.', 'agrul' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'agrul' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' 		=> 'after',
					'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
					'condition'		=> [ 'header_style' => [ '1'] ],
				]
			);
		}

        $this->end_controls_section();

		//---------------------------------------MenuBar Style---------------------------------------//

		$this->start_controls_section(
			'menubar_style_section',
			[
				'label' 	=> __( 'MenuBar Style', 'agrul' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'menubar_color',
			[
				'label' 		=> __( 'Menubar Background Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} nav.navbar.validnavs.no-background' => 'background-color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_control(
			'sticky_menubar_color',
			[
				'label' 		=> __( 'Sticky Menubar Background Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} nav.navbar.validnavs' => 'background-color: {{VALUE}}!important;',
                ],
			]
        );
        $this->end_controls_section();

        //---------------------------------------Menu Style---------------------------------------//


		$this->start_controls_section(
			'section_con_styling',
			[
				'label' 	=> __( 'Menu Control', 'agrul' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs3'
		);


		$this->start_controls_tab(
			'style_normal_tab3',
			[
				'label' => esc_html__( 'Menu', 'agrul' ),
			]
		);
         $this->add_control(
			'menu_color',
			[
				'label' 		=> __( 'Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .no-background ul.nav > li > a' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'menu_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .no-background ul.nav > li > a:hover' => 'color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 's_title_typography',
		 		'label' 		=> __( 'Typography', 'agrul' ),
		 		'selector' 	=> '{{WRAPPER}} nav.navbar ul.nav > li > a',
			]
		);

        
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'submenu_normal_tab3',
			[
				'label' => esc_html__( 'Submenu', 'agrul' ),
			]
		);
         $this->add_control(
			'submenu_menu_color',
			[
				'label' 		=> __( 'Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} nav.navbar.validnavs ul li.dropdown ul.dropdown-menu li a' => 'color: {{VALUE}}',
                ],
			]
        );
        $this->add_control(
			'submenu_menu_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} nav.navbar.validnavs ul li.dropdown ul.dropdown-menu li a:hover' => 'color: {{VALUE}}!important;',
                ],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'submenu_title_typography',
		 		'label' 		=> __( 'Typography', 'agrul' ),
		 		'selector' 	=> '{{WRAPPER}} nav.navbar.validnavs ul li.dropdown ul.dropdown-menu li a',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();


        //---------------------------------------Button Style---------------------------------------//

		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'agrul' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'button_text!' =>  ''  ],
			]
        );

        $this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .attr-nav > ul > li.button > a' => 'color: {{VALUE}}',
                ],
			]
        );


        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'agrul' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .navbar .attr-right .attr-nav li.button a,{{WRAPPER}} .navbar .attr-right .attr-nav li.button a:focus' => '--color-primary:{{VALUE}}!important;',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Border', 'agrul' ),
                'selector' 	=> '{{WRAPPER}} .attr-nav > ul > li.button > a',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'agrul' ),
                'selector' 	=> '{{WRAPPER}} .attr-nav > ul > li.button > a',
			]
        );

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Button Margin', 'agrul' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .attr-nav > ul > li.button > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Button Padding', 'agrul' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .attr-nav > ul > li.button > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Button Border Radius', 'agrul' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .attr-nav > ul > li.button > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'agrul' ),
				'selector' => '{{WRAPPER}} .attr-nav > ul > li.button > a',
			]
		);
        $this->end_controls_section();


    }

    public function agrul_menu_select(){
	    $agrul_menu = wp_get_nav_menus();
	    $menu_array  = array();
		$menu_array[''] = __( 'Select A Menu', 'agrul' );
	    foreach( $agrul_menu as $menu ){
	        $menu_array[ $menu->slug ] = $menu->name;
	    }
	    return $menu_array;
	}

	protected function render() {

        $settings = $this->get_settings_for_display();
        $agrul_avaiable_menu   = $this->agrul_menu_select();

		if( ! $agrul_avaiable_menu ){
			return;
		}

		$args = [
			'menu'  => $settings['agrul_menu_select'],
            'container'       => 'ul',
            'menu_class'      => 'nav navbar-nav navbar-right',
            'fallback_cb'     => 'agrul_Bootstrap_Navwalker::fallback',
            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>',
            'walker'          => new agrul_Bootstrap_Navwalker(),
		];

        if($settings['header_style'] == 1) {
	        echo '<!-- Start Navigation -->';
	        echo '<nav class="navbar mobile-sidenav attr-border navbar-sticky navbar-default validnavs navbar-fixed dark no-background onepage-nav">';


	            echo '<div class="container d-flex justify-content-between align-items-center">   ';         

	                echo '<!-- Start Header Navigation -->';
	                echo '<div class="navbar-header">';
	                    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i class="fa fa-bars"></i></button>';

	                    echo '<a class="navbar-brand" href="'.esc_url( $settings['logo_link']['url'] ).'">';
	                    	if( ! empty( $settings['logo_image_dark']['url'] ) ){
	                    		$class_logo = 'logo logo-display';
	                    	}else{
	                    		$class_logo = 'logo';
	                    	}

	                    	if( ! empty( $settings['logo_image']['url'] ) ){
	                    		echo agrul_img_tag( array(
									'url'	=> esc_url( $settings['logo_image']['url'] ),
									'class' => $class_logo
								) );
	                    	}
	                    	if( ! empty( $settings['logo_image_dark']['url'] ) ){
	                    		echo agrul_img_tag( array(
									'url'	=> esc_url( $settings['logo_image_dark']['url'] ),
									'class' => 'logo logo-scrolled'
								) );
	                    	}
	                    echo '</a>';

	                echo '</div>';
	                echo '<!-- End Header Navigation -->';

	                echo '<!-- Collect the nav links, forms, and other content for toggling -->';
	                echo '<div class="collapse navbar-collapse" id="navbar-menu">';

	                    if( ! empty( $settings['logo_image_mobile']['url'] ) ){
	                		echo agrul_img_tag( array(
								'url'	=> esc_url( $settings['logo_image_mobile']['url'] ),
							) );
	                	}
	                    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i class="fa fa-times"></i></button>';

	                    if( ! empty( $settings['agrul_menu_select'] ) ){
							wp_nav_menu( $args );
						}
	                echo '</div><!-- /.navbar-collapse -->';
	                if( ! empty( $settings['button_text'] ) ) {
	            		if( ! empty( $settings['button_link']['nofollow'] ) ) {
				            $this->add_render_attribute( 'button', 'rel', 'nofollow' );
				        }

				        if( ! empty( $settings['button_link']['is_external'] ) ) {
				            $this->add_render_attribute( 'button', 'target', '_blank' );
				        }
				        if( ! empty( $settings['button_link']['url'] ) ) {
				            $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );
				        }
		                echo '<div class="attr-right">';
		                    echo '<!-- Start Atribute Navigation -->';
		                    echo '<div class="attr-nav">';
		                        echo '<ul>';
		                            echo '<li class="button"><a '.$this->get_render_attribute_string('button').'>'.esc_html( $settings['button_text'] ).'</a></li>';
		                        echo '</ul>';
		                    echo '</div>';
		                    echo '<!-- End Atribute Navigation -->';
		                echo '</div>';
		            }

	                echo '<!-- Main Nav -->';
	            echo '</div>';   
	            echo '<!-- Overlay screen for menu -->';
	            echo '<div class="overlay-screen"></div>';
	            echo '<!-- End Overlay screen for menu -->';
	       	echo '</nav>';
	    }else{
			 echo '<nav class="navbar mobile-sidenav attr-border navbar-sticky navbar-default validnavs navbar-fixed dark no-background">';
				 echo '<div class="container-medium d-flex justify-content-between align-items-center">';
					echo '<!-- Start Header Navigation -->';
					echo '<div class="navbar-header">';
					echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i class="fa fa-bars"></i></button>';
						 echo '<a class="navbar-brand" href="'.esc_url( $settings['logo_link']['url'] ).'">';
	                    	if( ! empty( $settings['logo_image']['url'] ) ){
	                    		echo agrul_img_tag( array(
									'url'	=> esc_url( $settings['logo_image']['url'] ),
									'class' => 'logo'
								) );
	                    	}
	                    echo '</a>';
					 echo '</div>';
					 echo '<!-- End Header Navigation -->';
					 echo '<!-- Main Nav -->';
					 echo '<div class="main-nav-content">';
						 echo '<!-- Collect the nav links, forms, and other content for toggling -->';
						 echo '<div class="collapse navbar-collapse" id="navbar-menu">';
							 if( ! empty( $settings['logo_image']['url'] ) ){
	                    		echo agrul_img_tag( array(
									'url'	=> esc_url( $settings['logo_image']['url'] ),
								) );
	                    	}
							 echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><i class="fa fa-times"></i></button>';
								if( has_nav_menu('primary-menu') ) {
			                        wp_nav_menu( array(
			                            'theme_location'  => 'primary-menu',
			                            'container'       => 'ul',
			                            'menu_class'      => 'nav navbar-nav navbar-right dropdown-left',
			                            'fallback_cb'     => 'agrul_Bootstrap_Navwalker::fallback',
			                            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>',
			                            'walker'          => new agrul_Bootstrap_Navwalker(),
			                        ) );
			                    }
							echo '</ul>';
						echo '</div><!-- /.navbar-collapse -->';
							 echo '<!-- Overlay screen for menu -->';
							 echo '<div class="overlay-screen"></div>';
							 echo '<!-- End Overlay screen for menu -->';
					 echo '</div>';
						 echo '<!-- Main Nav -->';
				 echo '</div>';
			 echo '</nav>';
	    }
	}

}