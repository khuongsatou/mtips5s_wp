<?php
	/**
	* Elementor Agrul Product Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Product_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Product widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_product';
	}

	/**
	* Get widget title.
	*
	* Retrieve Product Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Product', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Product Nav Tab widget icon.
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
	* Retrieve the list of categories the Product Nav Tab widget belongs to.
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
			'about_product_style',
			[
				'label'		=> esc_html__( 'About Product Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> __( 'Style', 'agrul' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'agrul' ),
					'2' 		=> __( 'Style Two', 'agrul' ),
				],
			]
		);

		
		$this->add_control(
			'heading', [
				'label' 		=> esc_html__( 'Heading', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition'		=> [ 'style' => [ '1' ] ],
			]
		);
		$this->add_control(
			'heading_bac_img',
			[
				'label'		=> esc_html__( 'Heading Background Image','agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'condition'		=> [ 'style' => [ '1' ] ],
			]
		);

		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition'		=> [ 'style' => [ '2' ] ],
			]
		);
		$this->add_control(
			'subtitle', [
				'label' 		=> esc_html__( 'Subtitle', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition'		=> [ 'style' => [ '2' ] ],
			]
		);
		$this->add_control(
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition'		=> [ 'style' => [ '2' ] ],
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
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'product_url',
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
			'product_list',
			[
				'label' 	=> esc_html__( 'Product List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Product', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'product_shape_one',
			[
				'label'			=> esc_html__( 'Background Shape','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
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

		$this->end_controls_section();
		
		$this->start_controls_section(
			'agrul_product_style_option',
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
				'condition' 	=> ['style' => ['2']],
			]
		);
		
		$this->add_control(
			'section_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading .title' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .site-heading .title',
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_control(
			'section_subtitle_option',
			[
				'label' 		=> esc_html__( 'Section SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['2']],
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
				'condition' 	=> ['style' => ['2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .sub-title',
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_control(
			'section_description_option',
			[
				'label' 		=> esc_html__( 'Section Description Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['2']],
			]
		);
		$this->add_control(
			'section_description_color',
			[
				'label' 		=> esc_html__( 'Description Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_description_typography',
				'label' 		=> esc_html__( 'Description Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .site-heading p',
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_control(
			'title_option',
			[
				'label' 		=> esc_html__( 'Title Options', 'agrul-core' ),
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
					'{{WRAPPER}} .product-list-item a h5, {{WRAPPER}} .product-list-item a h5' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .product-list-item a h5, {{WRAPPER}} .product-list-item a h5',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_product_output = $this->get_settings_for_display();
	if($agrul_product_output['style'] == '1'): 
	?>
	<!-- Start Product Style One
    ============================================= -->
    <div class="product-list-area text-center text-light">
    	<?php if($agrul_product_output['product_shape_one']['url']):?>
	        <div class="shape-bottom-right">
	            <img src="<?php echo esc_url($agrul_product_output['product_shape_one']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
	        </div>
    	<?php endif;?>
        <div class="container">
            <div class="row">
            	<?php
            	if($agrul_product_output['section_show'] == 'yes'): 
            	if($agrul_product_output['heading']):?>
	                <div class="col-xl-10 offset-xl-1 mb-50 mb-xs-30">
	                    <h2 class="mask-text" style="background-image: url(<?php echo esc_url($agrul_product_output['heading_bac_img']['url']);?>);"><?php echo esc_html($agrul_product_output['heading']);?></h2>
	                </div>
                <?php
				endif;
                endif;?>
                <div class="product-list-box">
                	<?php foreach($agrul_product_output['product_list'] as $single_product): ?>	
                    <!-- Single Item -->
                    <div class="product-list-item">
                        <a href="<?php echo esc_url($single_product['product_url']['url']);?>">
                        	<?php if(!empty($single_product['product_image']['url'])):?>
                            	<img src="<?php echo esc_url($single_product['product_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                            <?php endif;?>
                            <h5><?php echo esc_html($single_product['title']);?></h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Style Two -->
    <?php
    elseif ($agrul_product_output['style'] == '2'):
    ?>
    <!-- Start Product Style Two 
    ============================================= -->
    <div class="product-list-area box-layout default-padding bottom-less bg-gray text-center" style="background-image: url(<?php echo esc_url($agrul_product_output['product_shape_one']['url']);?>);">
    	<?php if($agrul_product_output['section_show'] == 'yes'): ?>
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-8 offset-lg-2">
	                    <div class="site-heading text-center">
	                    	<?php if(!empty($agrul_product_output['title'])):?>
	                        <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_product_output['title'],'agrul-core')); ?></h5>
	                    	<?php endif;?>
	                    	<?php if(!empty($agrul_product_output['subtitle'])):?>
	                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_product_output['subtitle'],'agrul-core')); ?></h2>
	                        <?php endif;?>
	                        <div class="devider"></div>
	                        <?php if(!empty($agrul_product_output['content'])):?>
	                        <p>
	                            <?php echo htmlspecialchars_decode(esc_html($agrul_product_output['content'],'agrul-core')); ?>
	                        </p>
	                        <?php endif;?>
	                    </div>
	                </div>
	            </div>
	        </div>
    	<?php endif;?>
        <div class="container">
            <div class="row">

                <div class="product-list-box">
                	<?php foreach($agrul_product_output['product_list'] as $single_product): ?>	
                    <!-- Single Item -->
                    <div class="product-list-item">
                        <a href="<?php echo esc_url($single_product['product_url']['url']);?>">
                        	<?php if(!empty($single_product['product_image']['url'])):?>
                            <div class="thumb">
                            	<img src="<?php echo esc_url($single_product['product_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                            </div>
                        	<?php endif;?>
                            <h5><?php echo esc_html($single_product['title']);?></h5>
                        </a>
                    </div>
                    <!-- End Single Item -->
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Style Two -->
    <?php 	
    endif;
    }
}