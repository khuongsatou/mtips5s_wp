<?php
	/**
	* Elementor Feature Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Feature_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Feature widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_feature';
	}

	/**
	* Get widget title.
	*
	* Retrieve Feature widget title.
	*
	* @since 1.0.0
	* @access public 
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Feature', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Feature widget icon.
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
	* Retrieve the list of categories the Feature widget belongs to.
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
			'feature_content',
			[
				'label'		=> esc_html__( 'Set Content','agrul-core' ),
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
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows'  		=> '2', 
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows'  		=> '4', 
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'			=> esc_html__( 'Add Image Icon','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'default' => [
		            'url' => \Elementor\Utils::get_placeholder_image_src(),
		        ],
			]
		);
		
		$repeater->add_control(
			'button_text', [
				'label' 		=> esc_html__( 'Button Text', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows'          =>'2',
				'default' => esc_html__( 'Button Text', 'agrul-core' ),
			]
		);

		$repeater->add_control(
			'button_url',
			[
				'label' 		=> esc_html__( 'Button URL', 'agrul-core' ),
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
			'feature_list',
			[
				'label' 	=> esc_html__( 'Feature List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Feature', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);		
		
		$this->end_controls_section();

	
		$this->start_controls_section(
			'funfact_style_option',
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
				'condition' 	=> ['style' => ['1']],
			]
		);
		
		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .feature-product-item h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .feature-product-item h2',
			]
		);

		$this->add_control(
			'content_option',
			[
				'label' 		=> esc_html__( 'Content Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' 		=> esc_html__( 'Content Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .feature-product-item ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'label' 		=> esc_html__( 'Content Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .feature-product-item ul li',
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
	$agrul_feature_output = $this->get_settings_for_display();
	$feature_list = $agrul_feature_output['feature_list'];
	if($agrul_feature_output['style'] == '1'):
	?>
	<!-- Start Fun Factor Area
    ============================================= -->
    <div class="feature-product-area default-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="feature-product-items">
						<?php 
							$counter = 1;
	                    	foreach ($feature_list as $single_feature):
	                    ?>
	                        <div class="feature-product-item" style="background-image: url(<?php echo esc_url($single_feature['image']['url']);?>);">
	                            <h2><?php echo htmlspecialchars_decode(esc_html($single_feature['title'],'agrul-core')); ?></h2>
	                           <?php echo htmlspecialchars_decode(esc_html($single_feature['content'],'agrul-core')); ?>
	                           <?php if(!empty($single_feature['button_text'])):?>
	                            	<a class="btn btn-theme btn-sm radius animation <?php echo esc_attr(('2' == $counter ? 'secondary' : '')); ?>" href="<?php echo esc_url($single_feature['button_url']['url']);?>"><?php echo esc_html($single_feature['button_text']);?></a>
	                        	<?php $counter++; endif;?>
	                        </div>
 						<?php
	                	    endforeach;
	                	?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Featured Product -->
   
	<?php 
	endif;
	}
}