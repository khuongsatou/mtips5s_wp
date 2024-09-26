<?php
	/**
	* Elementor Agrul Farmer Info Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Farmer_Info_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Farmer Info widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_farmer_info';
	}

	/**
	* Get widget title.
	*
	* Retrieve Farmer Info Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( ' Agrul Farmer Info', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Farmer Info Nav Tab widget icon.
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
			'ag_farmer_info_style',
			[
				'label'		=> esc_html__( 'Farmer Info Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'team_single_img',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'agrul-core' ),
                'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
			]
        );
        $this->add_control(
			'designation',
			[
				'label' 	=> __( 'Designation', 'agrul-core' ),
                'type' 		=> \Elementor\Controls_Manager::TEXTAREA,
			]
        );
		$this->add_control(
			'content',
			[
				'label' 	=> __( 'Content', 'agrul-core' ),
                'type' 		=> \Elementor\Controls_Manager::WYSIWYG,
			]
        );

		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'agrul_farmer_info_style_option',
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
					'{{WRAPPER}} .farmer-single-area .farmer-content-top .right-info h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .farmer-single-area .farmer-content-top .right-info h2',
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
					'{{WRAPPER}} .farmer-single-area .farmer-content-top .right-info span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .farmer-single-area .farmer-content-top .right-info span',
			]
		);

		$this->add_control(
			'feature_list_option',
			[
				'label' 		=> esc_html__( 'Feature List Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'feature_list_color',
			[
				'label' 		=> esc_html__( 'Feature List Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .farmer-single-area .right-info ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'feature_list_typography',
				'label' 		=> esc_html__( 'Feature List Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .farmer-single-area .right-info ul li',
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_farmer_info_output = $this->get_settings_for_display();
	?>
	<!-- Start Farmer Info
    ============================================= -->
    <div class="farmer-single-area bg-gray default-padding-top">
    	<div class="container">
		    <div class="farmer-content-top">
		        <div class="row">
		        	<?php
				        if(!empty($agrul_farmer_info_output['team_single_img']['url'])):
				    ?> 
		            <div class="col-lg-5 left-info">
		                <div class="thumb">
		                    <?php
					        	echo agrul_img_tag( array(
						            'url'   => esc_url( $agrul_farmer_info_output['team_single_img']['url'] )
						    	) );
					        ?>	
		                </div>
		            </div>
		            <?php 
	                	endif;
					?>
		            <div class="col-lg-7 right-info">
		            	<?php if(!empty($agrul_farmer_info_output['title'])):?>
		                	<h2><?php echo esc_html($agrul_farmer_info_output['title']);?></h2>
		            	<?php endif; ?>
		            	<?php if(!empty($agrul_farmer_info_output['designation'])):?>
		                	<span><?php echo esc_html($agrul_farmer_info_output['designation']);?></span>
		                <?php endif; ?>
		                <?php echo htmlspecialchars_decode(esc_html($agrul_farmer_info_output['content'],'agrul-core')); ?>
		            </div>
		        </div>
		    </div>
	    </div>
	</div>
    <!-- End Farmer Info -->
    <?php 	
    }
}