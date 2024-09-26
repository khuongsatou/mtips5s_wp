<?php
	/**
	* Elementor Faq Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Accordian_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Faq widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_accordian_widget';
	}

	/**
	* Get widget title.
	*
	* Retrieve Faq widget title.
	*
	* @since 1.0.0
	* @access public 
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Accordian', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Faq widget icon.
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
	* Retrieve the list of categories the Faq widget belongs to.
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
			'accordian_content',
			[
				'label'		=> esc_html__( 'Set Accordian Content','agrul-core' ),
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
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=> esc_html__( 'Section Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> esc_html__( 'Type Your Title Here', 'agrul-core' ),
				'condition' => [
                    'style' => '1'
                ]
			]

		);

		$this->add_control(
			'subtitle',
			[
				'label' 		=> esc_html__( 'Section Subtitle', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' 	=> esc_html__( 'Type Your Subtitle Here', 'agrul-core' ),
				'condition' => [
                    'style' => '1'
                ]
			]

		);


		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'heading', [
				'label' 		=> esc_html__( 'Heading', 'agrul-core' ),
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

		$this->add_control(
			'accordian_list',
			[
				'label' 	=> esc_html__( 'Accordian', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Accordian', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ heading }}}',
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'accordian_style_option',
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
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .title',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'subtitle_option',
			[
				'label' 		=> esc_html__( 'SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1']],
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
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .sub-title',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'accordian_title_option',
			[
				'label' 		=> esc_html__( 'Accordian Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_control(
			'accordian_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .accordion-regular button.accordion-button' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'accordian_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .accordion-regular button.accordion-button',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'accordian_subtitle_option',
			[
				'label' 		=> esc_html__( 'Accordian SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_control(
			'accordian_subtitle_color',
			[
				'label' 		=> esc_html__( 'SubTitle Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .accordion-regular .accordion-item .accordion-body p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'accordian_subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .accordion-regular .accordion-item .accordion-body p',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->end_controls_section();

	}

	// Output For User
	protected function render(){
	$agrul_accordian_output = $this->get_settings_for_display();
	$accordian_lists = $agrul_accordian_output['accordian_list'];
	if($agrul_accordian_output['style'] == '1'):
	?>
    <!-- Start Accordian 
    ============================================= -->
    <?php if(!empty($agrul_accordian_output['subtitle'])):?>
    	<h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_accordian_output['subtitle'],'agrul-core')); ?></h5>
	<?php endif;?>
	<?php if(!empty($agrul_accordian_output['title'])):?>
    	<h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_accordian_output['title'],'agrul-core')); ?></h2>
    <?php endif;?>	
    <div class="choose-us-style-one mt-35">
        <div class="accordion accordion-regular" id="faqAccordion">
        	<?php
        		$counter=1;
        		foreach($accordian_lists as $single_accordian):
        	?>
	            <div class="accordion-item">
	                <h2 class="accordion-header" id="heading<?php echo esc_attr($counter);?>">
	                    <button class="accordion-button <?php if($counter == '1'){echo esc_attr__("");}else{echo esc_attr__("collapsed",'agrul-core');}?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($counter);?>" aria-expanded="true" aria-controls="collapse<?php echo esc_attr($counter);?>">
	                        <?php echo htmlspecialchars_decode(esc_html($single_accordian['heading'],'agrul-core')); ?>
	                    </button>
	                </h2>
	                <div id="collapse<?php echo esc_attr($counter);?>" class="accordion-collapse collapse <?php if($counter == '1'){echo esc_attr__("show");}else{echo esc_attr__("",'agrul-core');}?>" aria-labelledby="heading<?php echo esc_attr($counter);?>" data-bs-parent="#faqAccordion">
	                    <div class="accordion-body">
	                        <p>
	                            <?php echo htmlspecialchars_decode(esc_html($single_accordian['content'],'crysa-core')); ?>
	                        </p>
	                    </div>
	                </div>
	            </div>
           	<?php 
            	$counter++;
				endforeach;
			?>
        </div>
    </div>
    <!-- End Accordian -->
	<?php elseif ($agrul_accordian_output['style'] == '2'):?>
    <!-- Start Faq Area 
    ============================================= -->
    <div class="faq-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    
                    <div class="accordion accordion-regular" id="faqAccordion">
                    	 <?php
        		$counter=1;
        		foreach($accordian_lists as $single_accordian):
        	?>
	            <div class="accordion-item">
	                <h2 class="accordion-header" id="heading<?php echo esc_attr($counter);?>">
	                    <button class="accordion-button <?php if($counter == '1'){echo esc_attr__("");}else{echo esc_attr__("collapsed",'agrul-core');}?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo esc_attr($counter);?>" aria-expanded="true" aria-controls="collapse<?php echo esc_attr($counter);?>">
	                        <?php echo htmlspecialchars_decode(esc_html($single_accordian['heading'],'agrul-core')); ?>
	                    </button>
	                </h2>
	                <div id="collapse<?php echo esc_attr($counter);?>" class="accordion-collapse collapse <?php if($counter == '1'){echo esc_attr__("show");}else{echo esc_attr__("",'agrul-core');}?>" aria-labelledby="heading<?php echo esc_attr($counter);?>" data-bs-parent="#faqAccordion">
	                    <div class="accordion-body">
	                        <p>
	                            <?php echo htmlspecialchars_decode(esc_html($single_accordian['content'],'crysa-core')); ?>
	                        </p>
	                    </div>
	                </div>
	            </div>
           	<?php 
            	$counter++;
				endforeach;
			?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Faq Area -->
	<?php 
	endif;
	}
}