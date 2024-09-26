<?php
	/**
	* Elementor Funfactor Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Funfactor_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Funfactor widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_funfactor';
	}

	/**
	* Get widget title.
	*
	* Retrieve Funfactor widget title.
	*
	* @since 1.0.0
	* @access public 
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Funfactor', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Funfactor widget icon.
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
	* Retrieve the list of categories the Funfactor widget belongs to.
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
			'funfactor_content',
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
					'2' 	=> esc_html__( 'Style Two', 'agrul-core' ),
					'3' 	=> esc_html__( 'Style Three', 'agrul-core' ),
					'4' 	=> esc_html__( 'Style Four', 'agrul-core' ),
				],
			]
		);

		$this->add_control(
			'funfact_column',
			[
				'label' 	=> esc_html__( 'Column Type', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '4',
				'options' 	=> [
					'6' 	=> esc_html__( 'Two Column', 'agrul-core' ),
					'4'  	=> esc_html__( 'Three Column', 'agrul-core' ),
					'3' 	=> esc_html__( 'Four Column', 'agrul-core' ),
				],
				'condition' => [
                    'style' => ['1','2','4']
                ]
			]
		);

		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' => [
                    'style' => ['1','2']
                ]
			]
		);

		$this->add_control(
			'subtitle', [
				'label' 		=> esc_html__( 'Sub-Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' => [
                    'style' => ['1','2']
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
			'number', [
				'label' 		=> esc_html__( 'Number', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'operator', [
				'label' 		=> esc_html__( 'Operator', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'label_block' 	=> true,
			]
		);
		
		$this->add_control(
			'funfact_list',
			[
				'label' 	=> esc_html__( 'Funfact List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Funfact', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		
		$this->add_control(
			'funfact_shape_one',
			[
				'label' 	=> esc_html__( 'Background Shape One', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => ['1','4']
                ]
			]
		);
		$this->add_control(
			'funfact_shape_two',
			[
				'label' 	=> esc_html__( 'Background Shape Two', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => '1'
                ]
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
					'{{WRAPPER}} .fun-fact-style-one h2' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .fun-fact-style-one h2',
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
					'{{WRAPPER}} .fun-fact-style-one .heading .sub-title' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .fun-fact-style-one .heading .sub-title',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'funfact_title_option',
			[
				'label' 		=> esc_html__( 'Funfact Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','3']],
			]
		);

		$this->add_control(
			'funfact_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .fun-fact-style-one .fun-fact .medium,{{WRAPPER}} .counter-list li:first-child .fun-fact .medium' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','3']],
			]
		);

		$this->add_control(
			'funfact_title_color_2',
			[
				'label' 		=> esc_html__( 'Title Color Seceond', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .counter-list .fun-fact .medium' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['3']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'funfact_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .fun-fact-style-one .fun-fact .medium,{{WRAPPER}} .counter-list li .fun-fact .medium',
				'condition' 	=> ['style' => ['1','3']],
			]
		);

		$this->add_control(
			'funfact_number_option',
			[
				'label' 		=> esc_html__( 'Number Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','3']],
			]
		);
		$this->add_control(
			'funfact_number_color',
			[
				'label' 		=> esc_html__( 'Number Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .fun-fact-style-one .fun-fact .counter,{{WRAPPER}} .counter-list .fun-fact .counter' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','3']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'funfact_number_typography',
				'label' 		=> esc_html__( 'Number Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .fun-fact-style-one .fun-fact .counter,{{WRAPPER}} .counter-list .fun-fact .counter',
				'condition' 	=> ['style' => ['1','3']],
			]
		);

		$this->end_controls_section();

	}

	// Output For User
	protected function render(){
	$agrul_funfact_output = $this->get_settings_for_display();
	$funfact_list = $agrul_funfact_output['funfact_list'];
	if($agrul_funfact_output['style'] == '1'):
	?>
	<!-- Start Fun Factor Area
    ============================================= -->
    <div class="fun-facts-area default-padding">
    	<?php if(!empty($agrul_funfact_output['funfact_shape_one']['url'])):?>
	        <div class="shape-left">
	            <?php 
	            	echo agrul_img_tag( array(
			            'url'   => esc_url( $agrul_funfact_output['funfact_shape_one']['url'] )
			    	) );
	            ?>
	        </div>
        <?php endif;?>
        <div class="container">
            <div class="item-inner">
            	<?php if(!empty($agrul_funfact_output['funfact_shape_two']['url'])):?>
	                <div class="shape-right">
	                    <?php 
			            	echo agrul_img_tag( array(
					            'url'   => esc_url( $agrul_funfact_output['funfact_shape_two']['url'] )
					    	) );
			            ?>
	                </div>
                <?php endif;?>
                <div class="row">
                	<?php if(!empty($agrul_funfact_output['subtitle'] || $agrul_funfact_output['title'])):?>
                    <div class="col-lg-4 fun-fact-style-one">
                        <div class="heading">
                            <div class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_funfact_output['subtitle'],'agrul-core')); ?></div>
                            <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_funfact_output['title'],'agrul-core')); ?></h2>
                        </div>
                    </div>
                	<?php endif;?>
                    <div class="col-lg-<?php if(!empty($agrul_funfact_output['subtitle'] || $agrul_funfact_output['title'])) { echo esc_attr("8");} else{ echo esc_attr("12"); }?> fun-fact-style-one text-end">
                        <div class="row">

                        	<?php 
		                    	foreach ($funfact_list as $single_funfact):
		                    ?>
                            <!-- Single item -->
                            <div class="col-lg-<?php echo esc_attr($agrul_funfact_output['funfact_column']);?> col-md-4 item">
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="<?php echo esc_attr($single_funfact['number']);?>" data-speed="2000"><?php echo esc_html($single_funfact['number']);?></div>
                                        <div class="operator"><?php echo esc_attr($single_funfact['operator']);?></div>
                                    </div>
                                    <span class="medium"><?php echo esc_attr($single_funfact['title']);?></span>
                                </div>
                            </div>
                            <!-- End Single item -->
                            <?php
		                	    endforeach;
		                	?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Factor Area -->
    <?php elseif($agrul_funfact_output['style'] == '2'):?>
    <!-- Start Fun Factor Area
    ============================================= -->
    <div class="fun-facts-area bg-dark text-light default-padding-bottom">
        <div class="container">
            <div class="item-inner">
                <div class="row align-center">
                	<?php if(!empty($agrul_funfact_output['subtitle'] || $agrul_funfact_output['title'])):?>
	                    <div class="col-lg-4 fun-fact-style-one">
	                        <div class="heading">
	                            <div class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_funfact_output['subtitle'],'agrul-core')); ?></div>
	                            <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_funfact_output['title'],'agrul-core')); ?></h2>
	                        </div>
	                    </div>
                    <?php endif;?>
                    <div class="col-lg-8 fun-fact-style-one text-end">
                        <div class="row">
                        	<?php 
		                    	foreach ($funfact_list as $single_funfact):
		                    ?>
                            <!-- Single item -->
                            <div class="col-lg-<?php echo esc_attr($agrul_funfact_output['funfact_column']);?> col-md-4 item">
                                <div class="fun-fact">
                                    <div class="counter">
                                        <div class="timer" data-to="<?php echo esc_attr($single_funfact['number']);?>" data-speed="2000"><?php echo esc_html($single_funfact['number']);?></div>
                                        <div class="operator"><?php echo esc_attr($single_funfact['operator']);?></div>
                                    </div>
                                    <span class="medium"><?php echo esc_attr($single_funfact['title']);?></span>
                                </div>
                            </div>
                            <!-- End Single item -->
                            <?php
		                	    endforeach;
		                	?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Factor Area -->
    <?php elseif($agrul_funfact_output['style'] == '3'):?>
    <!-- Start Fun Factor Area Three -->	
    <div class="about-style-two">
        <ul class="counter-list">
        	<?php 
            	foreach ($funfact_list as $single_funfact):
            ?>
	            <li>
	                <div class="fun-fact">
	                    <div class="counter">
	                       <div class="timer" data-to="<?php echo esc_attr($single_funfact['number']);?>" data-speed="2000"><?php echo esc_html($single_funfact['number']);?></div>
	                        <div class="operator"><?php echo esc_attr($single_funfact['operator']);?></div>
	                    </div>
	                    <span class="medium"><?php echo esc_attr($single_funfact['title']);?></span>
	                </div>
	            </li>
            <?php
        	    endforeach;
        	?>
        </ul>
    </div>
    <!-- End Fun Factor Area Three -->

	<?php elseif($agrul_funfact_output['style'] == '4'):?>

	<!-- Start Fun Factor Area
    ============================================= -->
    <div class="fun-factor-area default-padding-bottom">
        <!-- Illustration -->
        <?php if(!empty($agrul_funfact_output['funfact_shape_one']['url'])):?>
	        <div class="tree-illustration">
	            <?php 
	            	echo agrul_img_tag( array(
			            'url'   => esc_url( $agrul_funfact_output['funfact_shape_one']['url'] )
			    	) );
	            ?>
	        </div>
	    <?php endif;?>
        <!-- End Illustration -->
        <div class="container">
            <div class="fun-fact-items text-center">
                <div class="row">
					<?php 
		            	foreach ($funfact_list as $single_funfact):
		            ?>
                    <!-- Single item -->
                    <div class="col-lg-4 col-md-4 item">
                        <div class="fun-fact">
                            <div class="counter">
                                <div class="timer" data-to="<?php echo esc_attr($single_funfact['number']);?>" data-speed="2000"><?php echo esc_html($single_funfact['number']);?></div>
                                <div class="operator"><?php echo esc_attr($single_funfact['operator']);?></div>
                            </div>
                            <span class="medium"><?php echo esc_attr($single_funfact['title']);?></span>
                        </div>
                    </div>
                    <!-- End Single item -->
                    <?php
		        	    endforeach;
		        	?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Fun Factor Area -->
	<?php 
	endif;
	}
}