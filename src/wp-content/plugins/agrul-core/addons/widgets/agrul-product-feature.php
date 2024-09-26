<?php
	/**
	* Elementor Agrul Product Feature Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Product_Feature_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Agrul Product Feature widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_product_feature';
	}

	/**
	* Get widget title.
	*
	* Retrieve Agrul Product Feature Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Product Feature', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Farmers Nav Tab widget icon.
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
		return [ 'agrul_elements' ];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'ag_product_feature_lf_content',
			[
				'label'		=> esc_html__( 'Product Feature Left Content','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'subtitle', [
				'label' 		=> esc_html__( 'Subtitle', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'button_text', [
				'label' 		=> esc_html__( 'Button Text', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'video_button_url',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'ag_product_feature_rt_content',
			[
				'label'		=> esc_html__( 'Product Feature Right Content','agrul-core' ),
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
			'product_image',
			[
				'label'			=> esc_html__( 'Product Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'feature_product_url',
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
		
		
		$this->add_control(
			'feature_product_list',
			[
				'label' 	=> esc_html__( 'Farmers List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Farmer', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'rounded_image',
			[
				'label'			=> esc_html__( 'Middle Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		
		$this->end_controls_section();
		
			$this->start_controls_section(
			'project_feature_style_option',
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
					'{{WRAPPER}} .product-feature-style-one h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-feature-style-one h2',		]
		);

		$this->add_control(
			'subtitle_option',
			[
				'label' 		=> esc_html__( 'SubTitle Options', 'agrul-core' ),
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
					'{{WRAPPER}} .sub-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .sub-title',
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
					'{{WRAPPER}} .product-feature-style-one p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'label' 		=> esc_html__( 'Description Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-feature-style-one p',
			]
		);

		$this->add_control(
			'video_title_option',
			[
				'label' 		=> esc_html__( 'Video Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'video_title_color',
			[
				'label' 		=> esc_html__( 'Video Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .video-play-button.with-text span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'video_title_typography',
				'label' 		=> esc_html__( 'Video Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .video-play-button.with-text span',
			]
		);

		$this->add_control(
			'feature_product_title_option',
			[
				'label' 		=> esc_html__( 'Feature Product Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'feature_product_title_color',
			[
				'label' 		=> esc_html__( 'Feature Product Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .product-feature-item a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'feature_product_title_typography',
				'label' 		=> esc_html__( 'Feature Product Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-feature-item a',
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_product_features_output = $this->get_settings_for_display();
	?>
	<!-- Start Product Features 
    ============================================= -->
    <div class="product-feature-style-one-area overflow-hidden default-padding">
        <div class="container">
            <div class="row align-center">
                <div class="col-lg-5 mb-xs-50 mb-md-120">
                    <div class="product-feature-style-one">
                        <div class="info">
                            <h4 class="sub-title"> <?php echo htmlspecialchars_decode(esc_html($agrul_product_features_output['subtitle'],'agrul-core')); ?></h4>
                            <h2 class="title mb-25"> <?php echo htmlspecialchars_decode(esc_html($agrul_product_features_output['title'],'agrul-core')); ?></h2>
                            <p>
                                 <?php echo htmlspecialchars_decode(esc_html($agrul_product_features_output['content'],'agrul-core')); ?>.
                            </p>
                            <?php if(!empty($agrul_product_features_output['video_button_url']['url'])):?>
	                            <a href="<?php echo esc_url($agrul_product_features_output['video_button_url']['url']); ?>" class="popup-youtube video-play-button with-text mt-15">
	                                <div class="effect"></div>
	                                <span><i class="fas fa-play"></i> <?php echo esc_html($agrul_product_features_output['button_text']);?></span>
	                            </a>
                        	<?php endif;?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="product-features-style-one pl-100 pl-md-15 pl-xs-15 pt-md-120">
                    	<?php if(!empty($agrul_product_features_output['rounded_image']['url'])): ?>
                        <div class="organic-badge">
                            <?php
					        	echo agrul_img_tag( array(
						            'url'   => esc_url( $agrul_product_features_output['rounded_image']['url'] )
						    	) );
						    ?>
                        </div>
                    	<?php endif; ?>
                        <?php foreach($agrul_product_features_output['feature_product_list'] as $single_feature_product):?>
                        <div class="product-feature-item">
                            <div class="thumb">
                               <?php
						        	if(!empty($single_feature_product['product_image']['url'])): 
							        	echo agrul_img_tag( array(
								            'url'   => esc_url( $single_feature_product['product_image']['url'] )
								    	) );
						        	endif;
							    ?>
                            </div>
                            <h4><a href="<?php echo esc_url($single_feature_product['feature_product_url']['url']);?>"><?php echo esc_html($single_feature_product['title']); ?></a></h4>
                        </div>
                       	<?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Features -->
    <?php 	
    }
}