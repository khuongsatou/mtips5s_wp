<?php
	/**
	* Elementor Agrul About Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Service_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve About widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_service';
	}

	/**
	* Get widget title.
	*
	* Retrieve About Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Service', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve About Nav Tab widget icon.
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
	* Retrieve the list of categories the About Nav Tab widget belongs to.
	*
	* @since 1.0.0
	* @access public
	*
	* @return array Widget categories.
	*/
	public function get_categories() {
		return [ 'agrul_elements' ];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'section_heading',
			[
				'label'		=> esc_html__( 'Section Heading','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'section_show',
			[
				'label' => __( 'Show/Hide Section Heading', 'agrul-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'agrul-core' ),
				'label_off' => __( 'Hide', 'agrul-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		
		$this->add_control(
			'section_title',
			[
				'label' 		=> esc_html__( 'Section Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]

		);

		$this->add_control(
			'section_subtitle',
			[
				'label' 		=> esc_html__( 'Section Subtitle', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]

		);
		$this->add_control(
			'section_description',
			[
				'label' 		=> esc_html__( 'Section Description', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]

		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> esc_html__( 'Button Text', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]

		);

		$this->add_control(
			'button_url',
			[
				'label' 		=> esc_html__( 'URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]
		);

		
		$this->end_controls_section();


		$this->start_controls_section(
			'agrul_service_style',
			[
				'label'		=> esc_html__( 'Service Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Service Style', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__( 'Style One', 'agrul-core' ),
					'2' 	=> esc_html__( 'Style Two', 'agrul-core' ),
					'3' 	=> esc_html__( 'Style Three', 'agrul-core' ),
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'service_url',
			[
				'label' 		=> esc_html__( 'URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);
		
		$repeater->add_control(
			'service_image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'service_list',
			[
				'label' 	=> esc_html__( 'Service', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Service', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
				'condition' => [
                    'style' => '1'
                ]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'service_image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'service_url',
			[
				'label' 		=> esc_html__( 'URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
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
                'default'    => 'flaticon-vegetables',
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
			'service_list_two',
			[
				'label' 	=> esc_html__( 'Service', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Service', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
				'condition' => [
                    'style' => '2'
                ]
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'service_image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'service_url',
			[
				'label' 		=> esc_html__( 'URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
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
                'default'    => 'flaticon-vegetables',
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
			'service_list_three',
			[
				'label' 	=> esc_html__( 'Service', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Service', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
				'condition' => [
                    'style' => '3'
                ]
			]
		);

		$this->add_control(
			'service_shape_one',
			[
				'label'			=> esc_html__( 'Background Shape','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'service_shape_two',
			[
				'label'			=> esc_html__( 'Background Shape Two','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => '2'
                ]

			]
		);

		
		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'service_style_option',
			[
				'label'			=> esc_html__( 'Content Style','agrul-core' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_option',
			[
				'label' 		=> esc_html__( 'Section Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .services-style-one-area h2,{{WRAPPER}} .site-heading .title' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .services-style-one-area h2,{{WRAPPER}} .site-heading .title',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'subtitle_option',
			[
				'label' 		=> esc_html__( 'Section Sub-Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> esc_html__( 'Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  .services-style-one-area .sub-title, {WRAPPER}} .sub-title' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .services-style-one-area .sub-title, {{WRAPPER}}  .sub-title',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'description_option',
			[
				'label' 		=> esc_html__( 'Section Description Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'descroption_color',
			[
				'label' 		=> esc_html__( 'Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .services-style-one-area .heading-left p,{{WRAPPER}} .site-heading p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'descroption_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .services-style-one-area .heading-left p, {{WRAPPER}} .site-heading p',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'button_option',
			[
				'label' 		=> esc_html__( 'Section Button Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> esc_html__( 'Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'background-color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> esc_html__( 'Hover Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme:hover' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' 		=> esc_html__( 'Hover Background Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme::after' => 'background-color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .btn.btn-theme',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'service_title_option',
			[
				'label' 		=> esc_html__( 'Service Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'service_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .services-style-one h5 a,{{WRAPPER}} .services-style-two-item .title a' => 'color: {{VALUE}}',
				],
			'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'service_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .services-style-one h5 a,{{WRAPPER}} .services-style-two-item .title a',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'service_subtitle_option',
			[
				'label' 		=> esc_html__( 'Service SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'service_subtitle_color',
			[
				'label' 		=> esc_html__( 'SubTitle Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .services-style-one p,{{WRAPPER}} .services-style-two-item p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'service_subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .services-style-one p,{{WRAPPER}} .services-style-two-item p',
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_service_output = $this->get_settings_for_display();
	if($agrul_service_output['style'] == '1'):
	?>
	<!-- Start Services Style One
    ============================================= -->
    <div class="services-style-one-area default-padding bg-gray half-bg-theme">
    	<?php if($agrul_service_output['service_shape_one']['url']):?>
        <div class="shape-extra">
            <img src="<?php echo esc_url($agrul_service_output['service_shape_one']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
        </div>
    	<?php endif;?>
    	<?php if($agrul_service_output['section_show'] == 'yes'): ?>
        <div class="container">
            <div class="heading-left">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="left-info">
                            <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_subtitle'],'agrul-core')); ?></h5>
                            <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_title'],'agrul-core')); ?></h2>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="right-info">
                            <?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_description'],'agrul-core')); ?> 
                            <?php if(!empty($agrul_service_output['button_text'])):?>
                            <a class="btn btn-theme btn-md radius animation" href="<?php echo esc_url($agrul_service_output['button_url']['url'])?>"><?php echo esc_html($agrul_service_output['button_text']);?></a>
                        	<?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="services-style-one-carousel swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                        <?php foreach($agrul_service_output['service_list'] as $single_service): ?>	
                            <!-- Single Item -->
                            <div class="swiper-slide">
                                <div class="services-style-one">
                                	<?php if(!empty($single_service['service_image'])):?>
                                    <div class="thumb">
                                        <img src="<?php echo esc_url($single_service['service_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                                    </div>
                                	<?php endif; ?>
                                    <h5><a href="<?php echo esc_url($single_service['service_url']['url']) ?>"><?php echo esc_html($single_service['title']);?></a></h5>
                                    <p>
                                        <?php echo esc_html($single_service['content']);?>
                                    </p>
                                    
                                </div>
                            </div>
                            <!-- End Single Item -->
                        <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services Style One-->

    <?php elseif($agrul_service_output['style'] == '2'): ?>

    <!-- Start Services style two
    ============================================= -->
    <div class="services-style-two-area  text-center">
        <?php if($agrul_service_output['service_shape_one']['url']):?>
	        <div class="shape-leaf">
	            <img src="<?php echo esc_url($agrul_service_output['service_shape_one']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
	        </div>
    	<?php endif;?>
    	<?php if($agrul_service_output['section_show'] == 'yes'): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_subtitle'],'agrul-core')); ?></h5>
                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_title'],'agrul-core')); ?></h2>
                        <div class="devider"></div>
                  		<?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_description'],'agrul-core')); ?>
                       
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="container">
            <div class="services-style-two-box relative">
            	<?php if($agrul_service_output['service_shape_two']['url']):?>
	                <div class="shape-box-right-top-animated">
	                    <img src="<?php echo esc_url($agrul_service_output['service_shape_two']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
	                </div>
                <?php endif;?>
                <div class="row">
                	<?php foreach($agrul_service_output['service_list_two'] as $single_service_two): ?>	
	                    <!-- Single Item -->
	                    <div class="services-style-two col-xl-3 col-md-6">
	                        <div class="services-style-two-item">
	                            <div class="info">
	                            	<?php if(!empty($single_service_two['service_image']['url'])):?>
	                                <div class="thumb">
	                                    <img src="<?php echo esc_url($single_service_two['service_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
	                                </div>
	                                <?php endif; ?>
	                                <p>
	                                    <?php echo esc_html($single_service_two['content']);?>
	                                </p>
	                            </div>
	                            <h5 class="title">
	                                <a href="<?php echo esc_url($single_service_two['service_url']['url']) ?>">
	                                	<?php if(!empty($single_service_two['flat_icon'])):?>
					                        <i class="<?php echo esc_attr($single_service_two['flat_icon']); ?>"></i>
					                    <?php endif;?>
					                    <?php if(!empty($single_service_two['icon_image'])):?>
					                        <img src="<?php echo esc_url($single_service_two['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
					                    <?php endif;?>
					                    <?php 
					                    if(!empty($single_service_two['custom_icon'])):?>
					                        <i class="<?php echo esc_attr($single_service_two['custom_icon']); ?>"></i>
					                    <?php endif;?>
					                    <?php echo esc_html($single_service_two['title']);?></a>
	                            </h5>
	                        </div>
	                    </div>
	                    <!-- End Single Item -->
                   	<?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Services style two -->

    <?php elseif($agrul_service_output['style'] == '3'): ?>

	<!-- Start Services style three -->
    <div class="services-style-three-area default-padding bg-gray half-bg-theme">
        <?php if($agrul_service_output['service_shape_one']['url']):?>
	        <div class="shape-extra">
	            <img src="<?php echo esc_url($agrul_service_output['service_shape_one']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
	        </div>
    	<?php endif;?>
        <?php if($agrul_service_output['section_show'] == 'yes'): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                       <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_subtitle'],'agrul-core')); ?></h5>
                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_service_output['section_title'],'agrul-core')); ?></h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
    	<?php endif;?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="services-style-three-carousel swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <?php foreach($agrul_service_output['service_list_three'] as $single_service_three): ?>	
                            <!-- Single Item -->
                            <div class="swiper-slide">
                                <div class="services-style-three" style="background-image: url(<?php echo esc_url($single_service_three['service_image']['url']); ?>);">
                                    <div class="content">
                                        <div class="icon">
                                           <?php if(!empty($single_service_three['flat_icon'])):?>
					                        <i class="<?php echo esc_attr($single_service_three['flat_icon']); ?>"></i>
						                    <?php endif;?>
						                    <?php if(!empty($single_service_three['icon_image'])):?>
						                        <img src="<?php echo esc_url($single_service_three['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
						                    <?php endif;?>
						                    <?php 
						                    if(!empty($single_service_three['custom_icon'])):?>
						                        <i class="<?php echo esc_attr($single_service_three['custom_icon']); ?>"></i>
						                    <?php endif;?>
                                        </div>
                                        <div class="info">
                                            <h4>
                                            	<a href="<?php echo esc_url($single_service_three['service_url']['url']) ?>"><?php echo esc_html($single_service_three['title']);?></a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Item -->
                           	<?php endforeach;?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- End Services style three -->

    <?php
	endif;
    }
}