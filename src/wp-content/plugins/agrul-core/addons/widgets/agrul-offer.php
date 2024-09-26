<?php
	/**
	* Elementor Offer Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Offer_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Offer widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_product_offer_widget';
	}

	/**
	* Get widget title.
	*
	* Retrieve Offer widget title.
	*
	* @since 1.0.0
	* @access public 
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Offer', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Offer widget icon.
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
	* Retrieve the list of categories the Offer widget belongs to.
	*
	* @since 1.0.0
	* @access public
	*
	* @return array Widget categories.
	*/
	public function get_categories() {
		return [ 'agrul_elements'];
	}

	public function get_script_depends() {
        return array('main');
    }

	// Add The Input For User
	protected function register_controls(){
		
		$this->start_controls_section(
			'offer_content',
			[
				'label'		=> esc_html__( 'Set Offer Content','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
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
			'subtitle', [
				'label' 		=> esc_html__( 'Subtitle', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows' 			=> 10,
			]
		);

		 $repeater->add_control(
			'bac_image',
			[
				'label' 		=> __( 'Image', 'agrul' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'offer_date_time', [
				'label' 		=> esc_html__( 'Date Time', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::DATE_TIME,
				'label_block' 	=> true,
				'rows' 			=> 10,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'agrul' ),
                'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Button Text', 'agrul' )
			]
        );
        $repeater->add_control(
			'button_link',
			[
				'label' 		=> __( 'Link', 'agrul' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'agrul' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->add_control(
			'offer_list',
			[
				'label' 	=> esc_html__( 'offer', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add offer', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'offer_style_option',
			[
				'label'			=> esc_html__( 'Content Style','agrul-core' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_option',
			[
				'label' 		=> esc_html__( 'Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-offer-item h2 a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-offer-item h2 a',		]
		);

		$this->add_control(
			'subtitle_option',
			[
				'label' 		=> esc_html__( 'Section SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> esc_html__( 'SubTitle Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-offer-item h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-offer-item h4',
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
					'{{WRAPPER}} .product-offer-item p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'label' 		=> esc_html__( 'Description Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-offer-item p',
			]
		);

		$this->add_control(
			'date_title_option',
			[
				'label' 		=> esc_html__( 'Date Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'date_title_color',
			[
				'label' 		=> esc_html__( 'Date Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-offer-item .counter-class .item-list .counter-item h5' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'date_title_typography',
				'label' 		=> esc_html__( 'Date Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-offer-item .counter-class .item-list .counter-item h5',
			]
		);

		$this->add_control(
			'date_option',
			[
				'label' 		=> esc_html__( 'Date Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'date_color',
			[
				'label' 		=> esc_html__( 'Date Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-offer-item .counter-class .item-list .counter-item span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'date_typography',
				'label' 		=> esc_html__( 'Date Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-offer-item .counter-class .item-list .counter-item span',
			]
		);

			$this->add_control(
			'button_option',
			[
				'label' 		=> esc_html__( 'Button Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
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
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .btn.btn-theme',
			]
		);

		$this->end_controls_section();

	}

	// Output For User
	protected function render(){
	$agrul_offer_output = $this->get_settings_for_display();
	$offer_lists = $agrul_offer_output['offer_list'];
	?>
    <!-- Start Shop Category
    ============================================= -->
    <div class="shop-category-area relative">
        <!-- Slider main container -->
        <div class="product-offer-carousel">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
            	<?php
	        		foreach($offer_lists as $single_offer):
	        	?>
	                <!-- Single Item -->
	                <div class="swiper-slide">
	                    <div class="shop-category-style-one default-padding-top bg-cover" style="background-image: url(<?php echo esc_url($single_offer['bac_image']['url']);?>);">
	                        <div class="container">
	                            <div class="row">
	                                <div class="col-lg-7">
	                                    <div class="product-offer-item">
	                                        <h4><?php echo esc_html($single_offer['subtitle']);?></h4>
	                                        <h2 class="mb-25"><a href="<?php echo esc_url($single_offer['button_link']['url']);?>"><?php echo esc_html($single_offer['title']);?></a></h2>
	                                        <p>
	                                           <?php echo esc_html($single_offer['content']);?>
	                                        </p>
	                                        <div class="counter-class" data-date="<?php echo esc_attr($single_offer['offer_date_time']);?>"><!-- Date Formate Input yyyy-mm-dd hh:mm:ss -->
	                                            <div class="item-list">
	                                                <div class="counter-item">
	                                                    <div class="item">
	                                                        <h5><span class="counter-days"></span> <?php echo esc_html__("Days",'agrul')?></h5>
	                                                    </div>
	                                                </div>
	                                                <div class="counter-item">
	                                                    <div class="item">
	                                                        <h5><span class="counter-hours"></span> <?php echo esc_html__("Hours",'agrul')?></h5>
	                                                    </div>
	                                                </div>
	                                                <div class="counter-item">
	                                                    <div class="item">
	                                                        <h5><span class="counter-minutes"></span> <?php echo esc_html__("Minutes",'agrul')?></h5>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                        </div>
	                                        <?php if(!empty($single_offer['button_text'])):?>
	                                        	<a class="btn btn-theme mt-15 btn-md radius animation" href="<?php echo esc_url($single_offer['button_link']['url']);?>"><i class="fas fa-shopping-cart"></i> <?php echo esc_html($single_offer['button_text']);?></a>
	                                    	<?php endif;?>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <!-- Single item -->
                <?php 
					endforeach;
				?>
            </div>

            <!-- Pagination -->
            <div class="product-offer-carousel-pagination"></div>

        </div>
    </div>
    <!-- End Shop Category -->
	<?php 
	}
}