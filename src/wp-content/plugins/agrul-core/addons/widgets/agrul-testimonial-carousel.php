<?php
	/**
	* Elementor Agrul About Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Testomonial_Carousel_Widget extends \Elementor\Widget_Base {

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
		return 'agrul_testimoanial_carousel';
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
		return esc_html__( 'Testimoanial', 'agrul-core' );
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
			'ag_testimoanial_carousel_style',
			[
				'label'		=> esc_html__( 'About Content Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> __( 'Style', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'agrul-core' ),
					'2' 		=> __( 'Style Two', 'agrul-core' ),
				],
			]
		);

		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> '1', 		
				'label_block' 	=> true,
				'after'  => 'separator'
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label' 		=> esc_html__( 'Name', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> '2', 		
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'designation', [
				'label' 		=> esc_html__( 'Designation', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> '2', 
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

		$this->add_control(
			'testimonail_list',
			[
				'label' 	=> esc_html__( 'Testimonial', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Testimonial', 'agrul-core' ),
					],
				],
				'condition' => [
                    'style' => ['1']
                ],
				'title_field' => '{{{ name }}}',
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label' 		=> esc_html__( 'Name', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> '2', 		
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> '2', 		
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'designation', [
				'label' 		=> esc_html__( 'Designation', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> '2', 
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
		    'rating',
		    [
		        'label' => __('Average Rating', 'cleenhearts-addon'),
		        'type' => \Elementor\Controls_Manager::SLIDER,
		        'size_units' => ['count'],
		        'range' => [
		            'count' => [
		                'min' => 1,
		                'max' => 5,
		                'step' => 1,
		            ],
		        ],
		        'default' => [
		            'unit' => 'count',
		            'size' => 5,
		        ],
		    ]
		);

		$this->add_control(
			'testimonail_list_two',
			[
				'label' 	=> esc_html__( 'Testimonial', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Testimonial', 'agrul-core' ),
					],
				],
				'condition' => [
                    'style' => ['2']
                ],
				'title_field' => '{{{ name }}}',
			]
		);

		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'testimonail_style_option',
			[
				'label'			=> esc_html__( 'Content Style','agrul-core' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_option',
			[
				'label' 		=> esc_html__( 'Heading Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'heading_color',
			[
				'label' 		=> esc_html__( 'Heading Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-info h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'heading_typography',
				'label' 		=> esc_html__( 'Heading Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .testimonial-info h4',
			]
		);

		$this->add_control(
			'name_option',
			[
				'label' 		=> esc_html__( 'Name Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' 		=> esc_html__( 'Name Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-style-two h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'name_typography',
				'label' 		=> esc_html__( 'Name Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .testimonial-style-two h4',
			]
		);

		$this->add_control(
			'designation_option',
			[
				'label' 		=> esc_html__( 'Designation Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'designation_color',
			[
				'label' 		=> esc_html__( 'Designation Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-style-two span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'designation_typography',
				'label' 		=> esc_html__( 'Designation Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .testimonial-style-two span',
			]
		);

		$this->add_control(
			'description_option',
			[
				'label' 		=> esc_html__( 'Description Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' 		=> esc_html__( 'Description Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .testimonial-style-two p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'label' 		=> esc_html__( 'Description Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .testimonial-style-two p',
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_testimonial_carosel_output = $this->get_settings_for_display();
	if($agrul_testimonial_carosel_output['style'] == '1'):
	?>

     <!-- Start Testimonials 
    ============================================= -->
    <div class="testimonials-area">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-5">
                    <div class="testimonial-info text-center">
                        <?php if(!empty($agrul_testimonial_carosel_output['title'])):?>
					        <h4><?php echo esc_html($agrul_testimonial_carosel_output['title']);?></h4>
					    <?php endif;?>
				        <div class="thumb">
				        	<?php foreach($agrul_testimonial_carosel_output['testimonail_list'] as $single_testimonial): ?>
				            <?php
					        	if(!empty($single_testimonial['image']['url'])): 
						        	echo agrul_img_tag( array(
							            'url'   => esc_url( $single_testimonial['image']['url'] )
							    	) );
					        	endif;
						    ?>
				            <?php endforeach;?>
				        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="testimonial-carousel testimonial-style-one swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                        	<?php foreach($agrul_testimonial_carosel_output['testimonail_list'] as $single_testimonial):?>
                            <!-- Single item -->
                            <div class="swiper-slide">
                                <div class="testimonial-style-two">
                                    
                                    <div class="item">
                                        <div class="content">
                                            <p>
                                                <?php echo htmlspecialchars_decode(esc_html($single_testimonial['content'],'agrul-core')); ?>
                                            </p>
                                        </div>
                                        <div class="provider">
                                            <div class="info">
                                                <h4>
                                                	<?php echo htmlspecialchars_decode(esc_html($single_testimonial['name'],'agrul-core')); ?>
                                                </h4>
                                                <span>
                                                	<?php echo htmlspecialchars_decode(esc_html($single_testimonial['designation'],'agrul-core')); ?>
                                             	</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single item -->
                            <?php endforeach;?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonials -->
    <?php elseif($agrul_testimonial_carosel_output['style'] == '2'):?>

    <!-- Start Testimonial Two
    ============================================= -->
    <div class="testimonial-style-threea-rea text-center default-padding bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="testimonial-three-box">
                         <?php if(!empty($agrul_testimonial_carosel_output['title'])):?>
					        <h2 class="text-big"><?php echo esc_html($agrul_testimonial_carosel_output['title']);?></h2>
					    <?php endif;?>
                        <div class="testimonial-style-two-carousel swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">

                            	<?php foreach($agrul_testimonial_carosel_output['testimonail_list_two'] as $single_testimonial):?>
	                                <!-- Single item -->
	                                <div class="swiper-slide">
	                                    <div class="testimonial-style-three">
	                                        
	                                        <div class="item">
	                                            <div class="content">
	                                                <div class="rating">
	                                                    <?php for ($i = 0; $i < $single_testimonial['rating']['size']; $i++) : ?>
				                                            <i class="fas fa-star"></i>
				                                        <?php endfor; ?>
	                                                </div>
	                                                <h2><?php echo htmlspecialchars_decode(esc_html($single_testimonial['title'],'agrul-core')); ?></h2>
	                                                <p>
	                                                    <?php echo htmlspecialchars_decode(esc_html($single_testimonial['content'],'agrul-core')); ?>
	                                                </p>
	                                            </div>
	                                            <div class="provider">
	                                                <?php
											        	if(!empty($single_testimonial['image']['url'])): 
												        	echo agrul_img_tag( array(
													            'url'   => esc_url( $single_testimonial['image']['url'] )
													    	) );
											        	endif;
												    ?>
	                                                <div class="info">
	                                                    <h4><?php echo htmlspecialchars_decode(esc_html($single_testimonial['name'],'agrul-core')); ?></h4>
	                                                    <span><?php echo htmlspecialchars_decode(esc_html($single_testimonial['designation'],'agrul-core')); ?></span>
	                                                </div>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                                <!-- End Single item -->
                                <?php endforeach;?>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial -->

    <?php
	endif;
    }
}