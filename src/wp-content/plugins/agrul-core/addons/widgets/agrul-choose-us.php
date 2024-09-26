<?php
	/**
	* Elementor Agrul About Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Choose_Us_Widget extends \Elementor\Widget_Base {

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
		return 'agrul_choose_us';
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
		return esc_html__( 'Choose Us', 'agrul-core' );
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
			'choose_us_style',
			[
				'label'		=> esc_html__( 'Content Style','agrul-core' ),
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
					'5' 	=> esc_html__( 'Style Five', 'agrul-core' ),
				],
			]
		);

		$this->add_control(
			'choose_image',
			[
				'label'			=> esc_html__( 'Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => ['1','3','4','5']
                ]
			]
		);

		$this->add_control(
			'choose_image_two',
			[
				'label'			=> esc_html__( 'Image Two','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => ['3']
                ]
			]
		);

		$this->add_control(
			'bac_shape',
			[
				'label'			=> esc_html__( 'Background Shape','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => ['1']
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
			'funfact_number', [
				'label' 		=> esc_html__( 'Number', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'funfact_operator', [
				'label' 		=> esc_html__( 'Operator', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
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
			'funfact_list',
			[
				'label' 	=> esc_html__( 'Fun Fact', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Fun Fact', 'agrul-core' ),
					],
				],
				'condition' => [
                    'style' => ['1']
                ],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' => [
                    'style' => ['3','5']
                ]
			]
		);
		$this->add_control(
			'subtitle', [
				'label' 		=> esc_html__( 'Subtitle', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' => [
                    'style' => ['3','5']
                ]
			]
		);

		$this->add_control(
			'summary', [
				'label' 		=> esc_html__( 'Summary', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' => [
                    'style' => ['3','5']
                ]
			]
		);

		$this->add_control(
			'choose_video_url',
			[
				'label' 		=> esc_html__( 'Video URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
				'condition' => [
                    'style' => ['1','2','3']
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
			'feature_list',
			[
				'label' 	=> esc_html__( 'Feature List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'condition' => [
                    'style' => ['3','4']
                ],
                'prevent_empty' => 'false',
				'title_field' => '{{{ title }}}',
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
			'layout_five_choose_list',
			[
				'label' 	=> esc_html__( 'Choose List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'condition' => [
                    'style' => ['5']
                ],
                'prevent_empty' => 'false',
				'title_field' => '{{{ title }}}',
			]
		);

		
		$this->end_controls_section();

		$this->start_controls_section(
			'choose_left_content',
			[
				'label'		=> esc_html__( 'Choose Left Content','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' 	=> ['style' => '2'],
			]
		);

		$this->add_control(
			'left_title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		
		$this->add_control(
			'left_content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'left_image',
			[
				'label'			=> esc_html__( 'Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'choose_right_content',
			[
				'label'		=> esc_html__( 'Choose Right Content','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' 	=> ['style' => '2'],
			]
		);

		$this->add_control(
			'right_title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'right_image',
			[
				'label'			=> esc_html__( 'Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
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
			'funfact_number', [
				'label' 		=> esc_html__( 'Number', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'funfact_operator', [
				'label' 		=> esc_html__( 'Operator', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'funfact_list_two',
			[
				'label' 	=> esc_html__( 'Fun Fact', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Fun Fact', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);


		$this->end_controls_section();
		
		$this->start_controls_section(
			'choose_us_style_option',
			[
				'label'			=> esc_html__( 'Content Style','agrul-core' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_title_option',
			[
				'label' 		=> esc_html__( 'Section Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['3','2']],
			]
		);
		
		$this->add_control(
			'section_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .choose-us-style-three-info h2,{{WRAPPER}}  .choose-us-style-two .title' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['3','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .choose-us-style-three-info h2, {{WRAPPER}} .choose-us-style-two .title',
				'condition' 	=> ['style' => ['3','2']],
			]
		);

		$this->add_control(
			'section_subtitle_option',
			[
				'label' 		=> esc_html__( 'Section SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['3']],
			]
		);
		$this->add_control(
			'section_subtitle_color',
			[
				'label' 		=> esc_html__( 'SubTitle Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .sub-title' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['3']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .sub-title',
				'condition' 	=> ['style' => ['3']],
			]
		);

		$this->add_control(
			'section_description_option',
			[
				'label' 		=> esc_html__( 'Section Description Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['3']],
			]
		);
		$this->add_control(
			'section_description_color',
			[
				'label' 		=> esc_html__( 'Description Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .choose-us-style-three-info p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['3']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_description_typography',
				'label' 		=> esc_html__( 'Description Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .choose-us-style-three-info p',
				'condition' 	=> ['style' => ['3']],
			]
		);


		$this->add_control(
			'feature_title_option',
			[
				'label' 		=> esc_html__( 'Feature Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['3','2']],
			]
		);
		$this->add_control(
			'feature_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} ul.list-heading-title li h4, {{WRAPPER}} .list-grid li' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['3','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'feature_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} ul.list-heading-title li h4, , {{WRAPPER}} .list-grid li',
				'condition' 	=> ['style' => ['3','2']],
			]
		);

		$this->add_control(
			'feature_subtitle_option',
			[
				'label' 		=> esc_html__( 'Feature Subtitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['3']],
			]
		);
		$this->add_control(
			'feature_subtitle_color',
			[
				'label' 		=> esc_html__( 'Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} ul.list-heading-title li p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['3']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'feature_subtitle_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} ul.list-heading-title li p',
				'condition' 	=> ['style' => ['3']],
			]
		);

		$this->add_control(
			'counter_title_option',
			[
				'label' 		=> esc_html__( 'Counter Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_control(
			'counter_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-produce .counter,{{WRAPPER}} .fun-fact-style-one .fun-fact .counter' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'counter_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-produce .counter,{{WRAPPER}} .fun-fact-style-one .fun-fact .counter',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'counter_subtitle_option',
			[
				'label' 		=> esc_html__( 'Counter SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_control(
			'counter_subtitle_color',
			[
				'label' 		=> esc_html__( 'SubTitle Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-produce .medium,{{WRAPPER}} .fun-fact-style-one .fun-fact .medium' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'counter_subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-produce .medium,{{WRAPPER}} .fun-fact-style-one .fun-fact .medium',
				'condition' 	=> ['style' => ['1','2']],
			]
		);


		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_choose_us_output = $this->get_settings_for_display();
	if($agrul_choose_us_output['style'] == '1'):
	?>
	<div class="choose-us-style-one">
        <div class="thumb">

            <?php 
            	if($agrul_choose_us_output['choose_image']['url']):
		        	echo agrul_img_tag( array(
			            'url'   => esc_url( $agrul_choose_us_output['choose_image']['url'] )
			    	) );
	        	endif;
		    ?>
		    <?php 
		    	 if($agrul_choose_us_output['bac_shape']['url']): ?>
	            <div class="shape">
	                <img class="wow fadeInDown" src="<?php echo esc_url($agrul_choose_us_output['bac_shape']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
	            </div>
        	<?php endif; ?>
        	<?php foreach($agrul_choose_us_output['funfact_list'] as $single_funfact):
        		if(!empty($single_funfact['title'] || $single_funfact['funfact_number']|| $single_funfact['funfact_operator'])):
        	?>
	            <div class="product-produce">
	                <div class="icon">
	                    <?php if(!empty($single_funfact['flat_icon'])):?>
                        <i class="<?php echo esc_attr($single_funfact['flat_icon']); ?>"></i>
	                    <?php endif;?>
	                    <?php if(!empty($single_funfact['icon_image'])):?>
	                        <img src="<?php echo esc_url($single_funfact['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
	                    <?php endif;?>
	                    <?php 
	                    if(!empty($single_funfact['custom_icon'])):?>
	                        <i class="<?php echo esc_attr($single_funfact['custom_icon']); ?>"></i>
	                    <?php endif;?>
	                </div>
	                <div class="fun-fact">
	                    <div class="counter">
	                    	<?php if(!empty($single_funfact['funfact_number'])):?>
	                        <div class="timer" data-to="<?php echo esc_attr( $single_funfact['funfact_number']);?>" data-speed="2000"><?php echo esc_html($single_funfact['funfact_number']);?></div>
	                        <?php endif;?>
	                        <?php if(!empty($single_funfact['funfact_operator'])):?>
	                        <div class="operator"><?php echo esc_html($single_funfact['funfact_operator']);?></div>
	                        <?php endif;?>
	                    </div>
	                    <?php if(!empty($single_funfact['title'])):?>
	                    <span class="medium"><?php echo esc_html($single_funfact['title']);?></span>
	                	<?php endif;?>
	                </div>
	            </div>
        	<?php 
        	endif;
        	endforeach;?>
        </div>
    </div>
    <?php elseif($agrul_choose_us_output['style'] == '2'):?>
    <!-- Start Why Choose Us Style Two
    ============================================= -->
    <div class="choose-us-style-two-area half-bg-light default-padding">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-5">
                    <div class="choose-us-style-two">
                      	<?php 
			            	if($agrul_choose_us_output['left_image']['url']):
					        	echo agrul_img_tag( array(
						            'url'   => esc_url( $agrul_choose_us_output['left_image']['url'] )
						    	) );
				        	endif;
					    ?>
                        <h3 class="title mt-30"><?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['left_title']));?></h3>
                        <div class="content">
                            <?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['left_content']));?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 offset-lg-1 mt-80 mt-xs-0">
                    <div class="choose-us-style-two">

                        <h2 class="title mb-30 mt-xs-30"><?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['right_title']));?></h2>
                        <div class="fun-fact-style-one mb-50">
                        	<?php foreach($agrul_choose_us_output['funfact_list_two'] as $single_funfact_two):
				        		if(!empty($single_funfact_two['title'] || $single_funfact_two['funfact_number']|| $single_funfact_two['funfact_operator'])):
				        	?>
                            <div class="fun-fact">
                                <div class="counter">
                                    <div class="timer" data-to="<?php echo esc_attr( $single_funfact_two['funfact_number']);?>" data-speed="2000"><?php echo esc_html( $single_funfact_two['funfact_number']);?></div>
                                    <div class="operator"><?php echo esc_html($single_funfact_two['funfact_operator']);?></div>
                                </div>
                                <span class="medium"><?php echo esc_html($single_funfact_two['title']);?></span>
                            </div>
                            <?php 
					        	endif;
					        	endforeach;
					        ?>
                            
                        </div>

                        <?php 
			            	if($agrul_choose_us_output['right_image']['url']):
					        	echo agrul_img_tag( array(
						            'url'   => esc_url( $agrul_choose_us_output['right_image']['url'] )
						    	) );
				        	endif;
					    ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Choose Us Style Two -->

	<?php elseif($agrul_choose_us_output['style'] == '3'):?>
	    <!-- Start Why Choose Us
	    ============================================= -->
	    <div class="choose-us-style-three-area default-padding">
	        <div class="container">
	            <div class="row align-center">
	                <div class="col-lg-6 choose-us-style-three-thumb">
	                    <?php 
			            	if($agrul_choose_us_output['choose_image']['url']):
					        	echo agrul_img_tag( array(
						            'url'   => esc_url( $agrul_choose_us_output['choose_image']['url'] )
						    	) );
				        	endif;
					    ?>
	                    <div class="video">
	                        <?php 
			            	if($agrul_choose_us_output['choose_image_two']['url']):
					        	echo agrul_img_tag( array(
						            'url'   => esc_url( $agrul_choose_us_output['choose_image_two']['url'] )
						    	) );
				        	endif;
					    ?>
					    <?php if(!empty($agrul_choose_us_output['choose_video_url']['url'])):?>
	                        <a href="<?php echo esc_url($agrul_choose_us_output['choose_video_url']['url']);?>" class="video-play-button popup-youtube">
	                            <i class="fas fa-play"></i>
	                            <div class="effect"></div>
	                        </a>
	                    <?php endif;?>
	                    </div>
	                </div>
	                <div class="col-lg-5 offset-lg-1 choose-us-style-three-info">
	                    <h4 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['subtitle']));?></h4>
	                    <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['title']));?></h2>
	                    <p>
	                       <?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['summary']));?>
	                    </p>
	                    <ul class="list-heading-title">
							<?php foreach($agrul_choose_us_output['feature_list'] as $single_feature):
        					?>
	                        <li>
	                            <div class="icon">
	                                <?php if(!empty($single_feature['flat_icon'])):?>
			                        <i class="<?php echo esc_attr($single_feature['flat_icon']); ?>"></i>
				                    <?php endif;?>
				                    <?php if(!empty($single_feature['icon_image'])):?>
				                        <img src="<?php echo esc_url($single_feature['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
				                    <?php endif;?>
				                    <?php 
				                    if(!empty($single_feature['custom_icon'])):?>
				                        <i class="<?php echo esc_attr($single_feature['custom_icon']); ?>"></i>
				                    <?php endif;?>
	                            </div>
	                            <div class="info">
	                                <h4><?php echo htmlspecialchars_decode(esc_html($single_feature['title']));?></h4>
	                                <p>
	                                    <?php echo htmlspecialchars_decode(esc_html($single_feature['content']));?>
	                                </p>
	                            </div>
	                        </li>
	                        <?php endforeach; ?>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- End Why Choose Us -->

	<?php elseif($agrul_choose_us_output['style'] == '4'):?>

		<!-- Start Why Choose Us
	    ============================================= -->
	    <div class="choose-us-style-four-area bg-gradient text-light default-padding bottom-less">
	        <div class="shape-left-top">
	           <?php 
	            	if($agrul_choose_us_output['choose_image']['url']):
			        	echo agrul_img_tag( array(
				            'url'   => esc_url( $agrul_choose_us_output['choose_image']['url'] )
				    	) );
		        	endif;
			    ?>
	        </div>
	        <div class="container">
	            <div class="row">
					<?php foreach($agrul_choose_us_output['feature_list'] as $single_feature):
        					?>
		                <!-- Single Item -->
		                <div class="choose-us-four-single col-xl-4 col-lg-6 col-md-6 mb-30">
		                    <div class="choose-us-four-item">
		                        <div class="titles">
		                           <?php if(!empty($single_feature['flat_icon'])):?>
			                        <i class="<?php echo esc_attr($single_feature['flat_icon']); ?>"></i>
				                    <?php endif;?>
				                    <?php if(!empty($single_feature['icon_image'])):?>
				                        <img src="<?php echo esc_url($single_feature['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
				                    <?php endif;?>
				                    <?php 
				                    if(!empty($single_feature['custom_icon'])):?>
				                        <i class="<?php echo esc_attr($single_feature['custom_icon']); ?>"></i>
				                    <?php endif;?>
		                            <h4><?php echo htmlspecialchars_decode(esc_html($single_feature['title']));?></h4>
		                        </div>
		                        <p>
		                            <?php echo htmlspecialchars_decode(esc_html($single_feature['content']));?>
		                        </p>
		                    </div>
		                </div>
		                <!-- End Single Item -->
	                <?php endforeach; ?>
	            </div>
	        </div>
	    </div>
    <!-- End Why Choose Us -->

    <?php elseif($agrul_choose_us_output['style'] == '5'):?>

   	<!-- Start Choose Us
    ============================================= -->
    <div class="choose-us-style-five-area default-padding-bottom">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-6">
                    <div class="thumb-style-four">
                       <?php 
			            	if($agrul_choose_us_output['choose_image']['url']):
					        	echo agrul_img_tag( array(
						            'url'   => esc_url( $agrul_choose_us_output['choose_image']['url'] )
						    	) );
				        	endif;
					    ?>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="info-style-four">
                        <h4 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['subtitle']));?></h4>
	                    <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['title']));?></h2>
	                    <p>
	                       <?php echo htmlspecialchars_decode(esc_html($agrul_choose_us_output['summary']));?>
                        <ul class="list-two">
							<?php foreach($agrul_choose_us_output['layout_five_choose_list'] as $single_choose):
        					?>
	                            <li>
	                            	<?php if(!empty($single_choose['flat_icon'])):?>
			                        <i class="<?php echo esc_attr($single_choose['flat_icon']); ?>"></i>
				                    <?php endif;?>
				                    <?php if(!empty($single_choose['icon_image'])):?>
				                        <img src="<?php echo esc_url($single_choose['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
				                    <?php endif;?>
				                    <?php 
				                    if(!empty($single_choose['custom_icon'])):?>
				                        <i class="<?php echo esc_attr($single_choose['custom_icon']); ?>"></i>
				                    <?php endif;?> <?php echo htmlspecialchars_decode(esc_html($single_choose['title']));?>
	                            </li>
                             <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Choose Us -->

    <?php
	endif;
    }
}