<?php
	/**
	* Elementor Contact Form Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Contact_Form_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Contact Form widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_contact_form';
	}

	/**
	* Get widget title.
	*
	* Retrieve Contact Form widget title.
	*
	* @since 1.0.0
	* @access public 
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Contact Form', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve contact_formor widget icon.
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
	* Retrieve the list of categories the contact_formor widget belongs to.
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
			'contact_form_content',
			[
				'label'		=> esc_html__( 'Set Content','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'default' => __('Send us a Massage', 'agrul-core'),
			]
		);

		$this->add_control(
			'subtitle', [
				'label' 		=> esc_html__( 'Sub-Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'default' => __('Have Questions?', 'agrul-core'),
			]
		);

		$this->add_control(
			'contact_shortcode',
			[
				'label' 		=> esc_html__( 'Contact Form Shortcode', 'cleanu-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'placeholder' 	=> esc_html__( 'Put your shortcode Here', 'cleanu-core' ),
			]

		);

		$this->end_controls_section();
		$this->start_controls_section(
			'contact_form_style_option',
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
					'{{WRAPPER}} .contact-form-style-one .heading' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .contact-form-style-one .heading',
			]
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
					'{{WRAPPER}} .contact-form-style-one button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-form-style-one button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> esc_html__( 'Hover Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-form-style-one button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' 		=> esc_html__( 'Hover Background Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-form-style-one button::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .contact-form-style-one button',
			]
		);
		
		$this->end_controls_section();

		
	}

	// Output For User
	protected function render(){
	$agrul_contact_form_output = $this->get_settings_for_display();
	?>
	<!-- Start Contact Form Area
    ============================================= -->
   	<div class="col-tact-stye-one">
        <div class="contact-form-style-one mb-md-50">
            <h5 class="sub-title"><?php echo esc_html($agrul_contact_form_output['subtitle']); ?></h5>
            <h2 class="heading"><?php echo esc_html($agrul_contact_form_output['title']); ?></h2>
            <?php echo do_shortcode($agrul_contact_form_output['contact_shortcode']);?>
        </div>
    </div>
    <!-- End Contact Form  Area -->
	<?php 
	}
}