<?php
	/**
	* Elementor Agrul Header Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Header_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Header widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_header';
	}

	/**
	* Get widget title.
	*
	* Retrieve Header Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Header', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Farmer Info Nav Tab widget icon.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget icon.
	*/
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	* Get widget categories.
	*
	* Retrieve the list of categories the Farmers Nav Tab widget belongs to.
	*
	* @since 1.0.0
	* @access public
	*
	* @return array Widget categories.
	*/
	public function get_categories() {
		return [ 'agrul_header_elements' ];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'ag_header_style',
			[
				'label'		=> esc_html__( 'Header Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__( 'Style One', 'agrul-core' ),
					'2' 	=> esc_html__( 'Style Two', 'agrul-core' ),
					'3' 	=> esc_html__( 'Style Three', 'agrul-core' ),
					'4' 	=> esc_html__( 'Style Four', 'agrul-core' ),
					'5' 	=> esc_html__( 'Style five', 'agrul-core' ),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'info', [
				'label' 		=> esc_html__( 'Info', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'icon_style',
			[
				'label' 	=> esc_html__( 'Icon Style', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__( 'Flaticon', 'agrul-core' ),
					'3' 	=> esc_html__( 'Icon Image', 'agrul-core' ),
					'2'  	=> esc_html__( 'Custom Icon', 'agrul-core' ),
				],
			]
		);

		$repeater->add_control(
			'flat_icon',
			[
                'label'      => esc_html__('Icon One', 'cleanu-core'),
                'type'       => \Elementor\Controls_Manager::ICON,
                'options'    => agrul_flaticons(),
                'include'    => agrul_include_flaticons(),
                'condition' => [
                    'icon_style' => '1'
                ]
            ]
		);

		$repeater->add_control(
			'custom_icon', [
				'label' 		=> esc_html__( 'Custom Icon', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows'  		=>'2',
				'condition' => [
                    'icon_style' => '2'
                ]
			]
		);


		$repeater->add_control(
			'icon_image',
			[
				'label'			=> esc_html__( 'Add Image Icon','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'icon_style' => '3'
                ]
			]
		);
		
		$this->add_control(
			'topbar_contact_info_list',
			[
				'label' 	=> esc_html__( 'Topbar Info List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Contact Info', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ info }}}',
				'condition' => [
                    'style' => ['5']
                ]
			]
		);

		$this->add_control(
			'facebook_link',
			[
				'label' 		=> __( 'Facebook Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '5'
                ]
			]
		);
		$this->add_control(
			'twitter_link',
			[
				'label' 		=> __( 'Twitter Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '5'
                ]
			]
		);
		$this->add_control(
			'linkedin_link',
			[
				'label' 		=> __( 'Linkedin Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '5'
                ]
			]
		);
		$this->add_control(
			'instagram_link',
			[
				'label' 		=> __( 'Instagram Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '5'
                ]
			]
		);
		$this->add_control(
			'dribble_link',
			[
				'label' 		=> __( 'Dribbble Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                   'style' 	=> '5'
                ]
			]
		);
		$this->add_control(
			'youtube_link',
			[
				'label' 		=> __( 'Youtube Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '5'
                ]
			]
		);
		$this->add_control(
			'pinterest_link',
			[
				'label' 		=> __( 'Pinterest Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '5'
                ]
			]
		);

		$this->add_control(
			'header_logo_desktop',
			[
				'label'			=> esc_html__( 'Header Logo Desktop','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'header_logo_dark',
			[
				'label'			=> esc_html__( 'Header Logo Dark','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => ['4']
                ]
			]
		);

		$this->add_control(
			'header_logo_mobile',
			[
				'label'			=> esc_html__( 'Header Logo Mobile','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->add_control(
			'shop_icon',
			[
				'label' => __( 'Shop Icon Show/Hide', 'agrul-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'agrul-core' ),
				'label_off' => __( 'Hide', 'agrul-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
                    'style' => ['1','3','4']
                ]
			]
		);
		
		$this->add_control(
			'wishlist_icon',
			[
				'label' => __( 'Wishlist Icon Show/Hide', 'agrul-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'agrul-core' ),
				'label_off' => __( 'Hide', 'agrul-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
                    'style' => ['1','3','4']
                ]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'info', [
				'label' 		=> esc_html__( 'Info', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'icon_style',
			[
				'label' 	=> esc_html__( 'Icon Style', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__( 'Flaticon', 'agrul-core' ),
					'3' 	=> esc_html__( 'Icon Image', 'agrul-core' ),
					'2'  	=> esc_html__( 'Custom Icon', 'agrul-core' ),
				],
			]
		);

		$repeater->add_control(
			'flat_icon',
			[
                'label'      => esc_html__('Icon One', 'cleanu-core'),
                'type'       => \Elementor\Controls_Manager::ICON,
                'options'    => agrul_flaticons(),
                'include'    => agrul_include_flaticons(),
                'condition' => [
                    'icon_style' => '1'
                ]
            ]
		);

		$repeater->add_control(
			'custom_icon', [
				'label' 		=> esc_html__( 'Custom Icon', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows'  		=>'2',
				'condition' => [
                    'icon_style' => '2'
                ]
			]
		);


		$repeater->add_control(
			'icon_image',
			[
				'label'			=> esc_html__( 'Add Image Icon','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'icon_style' => '3'
                ]
			]
		);
		
		$this->add_control(
			'header_contact_info_list',
			[
				'label' 	=> esc_html__( 'Header Contact Info List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Contact Info', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ info }}}',
				'condition' => [
                    'style' => ['2','5']
                ]
			]
		);

		

		$this->end_controls_section();

		$this->start_controls_section(
			'ag_header_style_section',
			[
				'label' 	=> __( 'Header Style', 'appku' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'ag_header_shop_icon_bg_color',
			[
				'label' 		=> __( 'Shop Icon Bg Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .attr-nav>ul>li>a i' => 'background-color: {{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'ag_header_shop_icon_color',
			[
				'label' 		=> __( 'Shop Icon Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .attr-nav>ul>li>a i' => 'color: {{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'ag_header_shop_icon_badge_color',
			[
				'label' 		=> __( 'Shop Icon Badge Bg Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .attr-nav>ul>li>a span.badge' => 'background-color: {{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'opening_hours_title_option',
			[
				'label' 		=> esc_html__( 'Opening Hours Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> [
                    'style' 	=> '2'
                ]
			]
		);
		
		$this->add_control(
			'opening_hours_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .navbar .attr-right .attr-nav li.opening-hours .call p' => 'color: {{VALUE}}!important',
				],
				'condition' 	=> [
                    'style' 	=> ['2']
                ]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'opening_hours_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .navbar .attr-right .attr-nav li.opening-hours .call p, {{WRAPPER}} .top-bar-area p',
				'condition' 	=> [
                    'style' 	=> ['2']
                ]
			]
		);

		$this->add_control(
			'opening_hours_date_option',
			[
				'label' 		=> esc_html__( 'Opening Hours Date Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> [
                    'style' 	=> '2'
                ]
			]
		);
		
		$this->add_control(
			'opening_hours_date_color',
			[
				'label' 		=> esc_html__( 'Date Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .navbar.validnavs.navbar-common .attr-right .attr-nav li .call h5' => 'color: {{VALUE}}',
				],
				'condition' 	=> [
                    'style' 	=> ['2']
                ]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'opening_hours_date_typography',
				'label' 		=> esc_html__( 'Date Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .navbar.validnavs.navbar-common .attr-right .attr-nav li .call h5, {{WRAPPER}} .top-bar-area p',
				'condition' 	=> [
                    'style' 	=> ['2']
                ]
			]
		);

        $this->end_controls_section();
        
        

	}
	// Output For User
	protected function render(){	
	$agrul_header_output = $this->get_settings_for_display();
	$url =   do_shortcode('[yith_wcwl_add_to_wishlist]');
	if($agrul_header_output['style'] == '1'):
	?>
	<!-- Header Style One
    ============================================= -->
    <header>
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav inc-shape navbar-common navbar-sticky navbar-default validnavs">

            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-xl">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container d-flex justify-content-between align-items-center">            
                

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php if(!empty($agrul_header_output['header_logo_desktop']['url'])):?>
                    <a class="navbar-brand" href="<?php echo esc_url(home_url());?>">
                        <img src="<?php echo esc_url($agrul_header_output['header_logo_desktop']['url']);?>" class="logo" alt="<?php echo get_bloginfo( 'name' ); ?>">
                    </a>
                	<?php endif;?>
                </div>
                <!-- End Header Navigation -->


                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                <?php if(!empty($agrul_header_output['header_logo_mobile']['url'])):?>	
                    <img src="<?php echo esc_url($agrul_header_output['header_logo_mobile']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                <?php endif;?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-times"></i>
                    </button>
                    
                    <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'primary-menu',
                            'container'       => 'ul',
                            'menu_class'      => 'nav navbar-nav navbar-right',
                            'fallback_cb'     => 'Agrul_Bootstrap_Navwalker::fallback',
                            'walker'          => new Agrul_Bootstrap_Navwalker(),
                            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>'
                        ));
                    ?>
                </div><!-- /.navbar-collapse -->

                <div class="attr-right">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            <?php if($agrul_header_output['wishlist_icon'] == 'yes'): ?>
                            	<li class="wishlist">
                                	<?php
                                    	if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
    	                                    echo do_shortcode( '[ti_wishlist_products_counter]' );
    	                                }
                                	?>
                                </li>
                            <?php endif; ?>
                            <?php if($agrul_header_output['shop_icon'] == 'yes'): ?>
                            	<li class="dropdown">
                            	    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="basket-item-count">
    	                                    <span class="cart-items-count"> 
    	                                        <?php
    	                                        	if (is_admin()) return false;
    	                                         	WC()->cart->get_cart_contents_count(); 
    	                                        ?>
    	                                    </span>
                                        </div>
                                    </a>
                                    <!-- End Atribute Navigation -->
                                    <div class="widget_shopping_cart_content">
                                       	<?php 
                                       		if (is_admin()) return false;
                                       		echo woocommerce_mini_cart();
                                       	?>
                                    </div>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- End Atribute Navigation -->

                </div>

            </div>   
            <!-- Overlay screen for menu -->
                <div class="overlay-screen"></div>
            <!-- End Overlay screen for menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Header Style One -->

	<?php elseif($agrul_header_output['style'] == '2'):?>

	<!-- Header Style Two 
    ============================================= -->
    <header>
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav less-logo navbar-common navbar-default validnavs navbar-sticky">

            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-xl">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container d-flex justify-content-between align-items-center">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>

                    <?php if(!empty($agrul_header_output['header_logo_desktop']['url'])):?>	
                        <a class="navbar-brand" href="<?php echo esc_url(home_url());?>"><img src="<?php echo esc_url($agrul_header_output['header_logo_desktop']['url']);?>" class="logo" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
                    <?php endif;?>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">

                    <?php if(!empty($agrul_header_output['header_logo_mobile']['url'])):?>	
                        <img src="<?php echo esc_url($agrul_header_output['header_logo_mobile']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                    <?php endif;?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-times"></i>
                    </button>
                    
                    <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'primary-menu',
                            'container'       => 'ul',
                            'menu_class'      => 'nav navbar-nav navbar-left',
                            'fallback_cb'     => 'Agrul_Bootstrap_Navwalker::fallback',
                            'walker'          => new Agrul_Bootstrap_Navwalker(),
                            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>'
                        ));
                    ?>
                </div><!-- /.navbar-collapse -->

                <div class="attr-right">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                        	<?php foreach($agrul_header_output['header_contact_info_list'] as $single_header_con_info):
                        		if(!empty($single_header_con_info['info'])):
                        	?>
                                <li class="opening-hours">
                                    <div class="call">
                                        <div class="icon">
                                            <?php if(!empty($single_header_con_info['flat_icon'])):?>
						                        <i class="<?php echo esc_attr($single_header_con_info['flat_icon']); ?>"></i>
						                    <?php endif;?>
						                    <?php if(!empty($single_header_con_info['icon_image'])):?>
						                        <img src="<?php echo esc_url($single_header_con_info['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
						                    <?php endif;?>
						                    <?php 
						                    if(!empty($single_header_con_info['custom_icon'])):?>
						                        <i class="<?php echo esc_attr($single_header_con_info['custom_icon']); ?>"></i>
						                    <?php endif;?>
                                        </div>
                                        <div class="info">
                                           <?php echo htmlspecialchars_decode(esc_html($single_header_con_info['info'],'agrul-core')); ?>
                                        </div>
                                    </div>
                                </li>
                        	<?php endif; endforeach;?>
                        </ul>
                    </div>
                    <!-- End Atribute Navigation -->

                </div>

            </div>  

            <!-- Overlay screen for menu -->
            <div class="overlay-screen"></div>
            <!-- End Overlay screen for menu -->

        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Header Style Two -->

    <?php elseif($agrul_header_output['style'] == '3'):?>

    <!-- Header Style Three
    ============================================= -->
    <header>
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav inc-shape navbar-common navbar-sticky navbar-default validnavs">

            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-xl">
                    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input name="s" type="text" class="form-control"  value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr__('Search','crysa'); ?>">
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container-full d-flex justify-content-between align-items-center">            
                

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php if(!empty($agrul_header_output['header_logo_desktop']['url'])):?>	
                        <a class="navbar-brand" href="<?php echo esc_url(home_url());?>"><img src="<?php echo esc_url($agrul_header_output['header_logo_desktop']['url']);?>" class="logo" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
                    <?php endif;?>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">

                    <?php if(!empty($agrul_header_output['header_logo_mobile']['url'])):?>	
                        <img src="<?php echo esc_url($agrul_header_output['header_logo_mobile']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                    <?php endif;?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-times"></i>
                    </button>
                    
                    <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'primary-menu',
                            'container'       => 'ul',
                            'menu_class'      => 'nav navbar-nav navbar-right',
                            'fallback_cb'     => 'Agrul_Bootstrap_Navwalker::fallback',
                            'walker'          => new Agrul_Bootstrap_Navwalker(),
                            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>'
                        ));
                    ?>
                </div><!-- /.navbar-collapse -->

                <div class="attr-right">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            <?php if($agrul_header_output['wishlist_icon'] == 'yes'): ?>
                               	<li class="wishlist">
                                	<?php
                                    	if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
    	                                    echo do_shortcode( '[ti_wishlist_products_counter]' );
    	                                }
                                	?>
                                </li>
                            <?php endif;?>
                            <?php if($agrul_header_output['shop_icon'] == 'yes'): ?>
                            	<li class="dropdown">
                            	    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="basket-item-count">
    	                                    <span class="cart-items-count"> 
    	                                        <?php
    	                                        	if (is_admin()) return false;
    	                                         	WC()->cart->get_cart_contents_count(); 
    	                                        ?>
    	                                    </span>
                                        </div>
                                    </a>
                                    <!-- End Atribute Navigation -->
                                    <div class="widget_shopping_cart_content">
                                       	<?php 
                                       		if (is_admin()) return false;
                                       		echo woocommerce_mini_cart();
                                       	?>
                                    </div>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>

                </div>
                <!-- Main Nav -->

            </div> 

            <!-- Overlay screen for menu -->
            <div class="overlay-screen"></div>
            <!-- End Overlay screen for menu -->
            
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Header Style Three -->

	<?php elseif($agrul_header_output['style'] == '4'):?>

	<header>
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav nav-blur navbar-sticky navbar-default validnavs white navbar-fixed no-background">

            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container-xl">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->

            <div class="container-full d-flex justify-content-between align-items-center">            
                

                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php if(!empty($agrul_header_output['header_logo_desktop']['url'])):?>
	                    <a class="navbar-brand" href="<?php echo esc_url(home_url());?>">
	                        <img src="<?php echo esc_url($agrul_header_output['header_logo_desktop']['url']);?>" class="logo logo-display" alt="<?php echo get_bloginfo( 'name' ); ?>">
	                        <img src="<?php echo esc_url($agrul_header_output['header_logo_dark']['url']);?>" class="logo logo-scrolled" alt="<?php echo get_bloginfo( 'name' ); ?>">
	                    </a>
                    <?php endif;?>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">

                  	<?php if(!empty($agrul_header_output['header_logo_mobile']['url'])):?>	
                        <img src="<?php echo esc_url($agrul_header_output['header_logo_mobile']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                    <?php endif;?>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-times"></i>
                    </button>
                    
                    <?php
                        wp_nav_menu(array(
                            'theme_location'  => 'primary-menu',
                            'container'       => 'ul',
                            'menu_class'      => 'nav navbar-nav navbar-right',
                            'fallback_cb'     => 'Agrul_Bootstrap_Navwalker::fallback',
                            'walker'          => new Agrul_Bootstrap_Navwalker(),
                            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>'
                        ));
                    ?>
                </div><!-- /.navbar-collapse -->

                <div class="attr-right">
                    <!-- Start Atribute Navigation -->
                    <div class="attr-nav">
                        <ul>
                            <?php if($agrul_header_output['wishlist_icon'] == 'yes'): ?>
                               	<li class="wishlist">
                                	<?php
                                    	if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
    	                                    echo do_shortcode( '[ti_wishlist_products_counter]' );
    	                                }
                                	?>
                                </li>
                            <?php endif;?>
                            <?php if($agrul_header_output['shop_icon'] == 'yes'): ?>
                            	<li class="dropdown">
                            	    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="basket-item-count">
    	                                    <span class="cart-items-count"> 
    	                                        <?php
    	                                        	if (is_admin()) return false;
    	                                         	WC()->cart->get_cart_contents_count(); 
    	                                        ?>
    	                                    </span>
                                        </div>
                                    </a>
                                    <!-- End Atribute Navigation -->
                                    <div class="widget_shopping_cart_content">
                                       	<?php 
                                       		if (is_admin()) return false;
                                       		echo woocommerce_mini_cart();
                                       	?>
                                    </div>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <!-- End Atribute Navigation -->

                </div>
                <!-- Main Nav -->

            </div> 

            <!-- Overlay screen for menu -->
            <div class="overlay-screen"></div>
            <!-- End Overlay screen for menu -->
            
        </nav>
        <!-- End Navigation -->
    </header>

	<?php elseif($agrul_header_output['style'] == '5'):?>

	<!-- Header five
    ============================================= -->
     <!-- Start Header Top 
    ============================================= -->
    <div class="top-bar-area top-bar-style-one bg-dark text-light">
        <div class="container">
            <div class="row align-center">
                <div class="col-xl-6 col-lg-8 offset-xl-3 pl-30 pl-md-15 pl-xs-15">
                    <ul class="item-flex">
                    	<?php foreach($agrul_header_output['topbar_contact_info_list'] as $single_header_con_info):
                        		if(!empty($single_header_con_info['info'])):
                        	?>
	                        <li>
	                            <?php if(!empty($single_header_con_info['flat_icon'])):?>
			                        <i class="<?php echo esc_attr($single_header_con_info['flat_icon']); ?>"></i>
			                    <?php endif;?>
			                    <?php if(!empty($single_header_con_info['icon_image'])):?>
			                        <img src="<?php echo esc_url($single_header_con_info['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
			                    <?php endif;?>
			                    <?php 
			                    if(!empty($single_header_con_info['custom_icon'])):?>
			                        <i class="<?php echo esc_attr($single_header_con_info['custom_icon']); ?>"></i>
			                    <?php endif;?>  <?php echo htmlspecialchars_decode(esc_html($single_header_con_info['info'],'agrul-core')); ?>
	                        </li>
                        <?php endif; endforeach;?>
                    </ul>
                </div>
                <?php 
                	if(!empty(
            		$agrul_header_output['facebook_link']['url'] ||
            		$agrul_header_output['twitter_link']['url'] || 
                	$agrul_header_output['youtube_link']['url'] || 
                	$agrul_header_output['linkedin_link']['url'] || 
                	$agrul_header_output['instagram_link']['url'] || 
                	$agrul_header_output['dribble_link']['url'] || 
                	$agrul_header_output['pinterest_link']['url'] )):
	            ?>
	                <div class="col-xl-3 col-lg-4 text-end">
	                    <div class="social">
	                        <ul>
	                             <?php if(!empty($agrul_header_output['facebook_link']['url'])):?>
				                    <li>
				                        <a href="<?php echo esc_url($agrul_header_output['facebook_link']['url']);?>">
				                            <i class="fab fa-facebook-f"></i>
				                        </a>
				                    </li>
				            	<?php endif;?>
				            	<?php if(!empty($agrul_header_output['twitter_link']['url'])):?>
				                    <li>
				                        <a href="<?php echo esc_url($agrul_header_output['twitter_link']['url']);?>">
				                            <i class="fab fa-twitter"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_header_output['youtube_link']['url'])):?>
				                    <li>
				                        <a href="<?php echo esc_url($agrul_header_output['youtube_link']['url']);?>">
				                            <i class="fab fa-youtube"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_header_output['linkedin_link']['url'])):?>
				                    <li>
				                        <a href="<?php echo esc_url($agrul_header_output['linkedin_link']['url']);?>">
				                            <i class="fab fa-linkedin"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_header_output['instagram_link']['url'])):?>
				                    <li>
				                        <a href="<?php echo esc_url($agrul_header_output['instagram_link']['url']);?>">
				                            <i class="fab fa-instagram"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_header_output['dribble_link']['url'])):?>
				                    <li>
				                        <a href="<?php echo esc_url($agrul_header_output['dribble_link']['url']);?>">
				                            <i class="fab fa-dribbble"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_header_output['pinterest_link']['url'])):?>
				                    <li>
				                        <a href="<?php echo esc_url($agrul_header_output['pinterest_link']['url']);?>">
				                            <i class="fab fa-pinterest"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
	                        </ul>
	                    </div>
	                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
    <!-- End Header Top -->
    <header>
        <!-- Start Navigation -->
        <nav class="navbar mobile-sidenav navbar-style-one navbar-sticky navbar-default validnavs white navbar-fixed no-background">

            <div class="container">
                <div class="row align-center">

                    <!-- Start Header Navigation -->
                    <div class="col-xl-2 col-lg-3 col-md-2 col-sm-1 col-1">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                <i class="fa fa-bars"></i>
                            </button>
                            <?php if(!empty($agrul_header_output['header_logo_desktop']['url'])):?>	
		                        <a class="navbar-brand" href="<?php echo esc_url(home_url());?>"><img src="<?php echo esc_url($agrul_header_output['header_logo_desktop']['url']);?>" class="logo" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
		                    <?php endif;?>
                        </div>
                    </div>
                    <!-- End Header Navigation -->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="col-xl-6 offset-xl-1 col-lg-6 col-md-4 col-sm-4 col-4">
                        <div class="collapse navbar-collapse" id="navbar-menu">

                            <?php if(!empty($agrul_header_output['header_logo_mobile']['url'])):?>	
		                        <img src="<?php echo esc_url($agrul_header_output['header_logo_mobile']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
		                    <?php endif;?>
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                                <i class="fa fa-times"></i>
                            </button>
                            
                            <?php
		                        wp_nav_menu(array(
		                            'theme_location'  => 'primary-menu',
		                            'container'       => 'ul',
		                            'menu_class'      => 'nav navbar-nav navbar-center',
		                            'fallback_cb'     => 'Agrul_Bootstrap_Navwalker::fallback',
		                            'walker'          => new Agrul_Bootstrap_Navwalker(),
		                            'items_wrap'      => '<ul data-in="fadeInDown" data-out="fadeOutUp" class="%2$s" id="%1$s">%3$s</ul>'
		                        ));
		                    ?>
                        </div>
                    </div>
                    <!-- /.navbar-collapse -->

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-7 col-7">
                        <div class="attr-right">
                            <!-- Start Atribute Navigation -->
                            <div class="attr-nav">
                                <ul>
                                	<?php foreach($agrul_header_output['header_contact_info_list'] as $single_header_con_info):
			                        		if(!empty($single_header_con_info['info'])):
			                        	?>
	                                    <li class="contact">
	                                        <div class="call">
	                                            <div class="icon">
	                                               <?php if(!empty($single_header_con_info['flat_icon'])):?>
								                        <i class="<?php echo esc_attr($single_header_con_info['flat_icon']); ?>"></i>
								                    <?php endif;?>
								                    <?php if(!empty($single_header_con_info['icon_image'])):?>
								                        <img src="<?php echo esc_url($single_header_con_info['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
								                    <?php endif;?>
								                    <?php 
								                    if(!empty($single_header_con_info['custom_icon'])):?>
								                        <i class="<?php echo esc_attr($single_header_con_info['custom_icon']); ?>"></i>
								                    <?php endif;?>
	                                            </div>
	                                            <div class="info">
	                                              <?php echo htmlspecialchars_decode(esc_html($single_header_con_info['info'],'agrul-core')); ?>
	                                            </div>
	                                        </div>
	                                    </li>
                                    <?php endif; endforeach;?>
                                </ul>
                            </div>
                            <!-- End Atribute Navigation -->
        
                        </div>
                    </div>

                </div>         
                <!-- Main Nav -->

                <!-- Overlay screen for menu -->
                <div class="overlay-screen"></div>
                <!-- End Overlay screen for menu -->
            </div>   
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Header -->
    <?php 	
	endif;
    }
}