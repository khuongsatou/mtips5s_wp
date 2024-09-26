<?php
	/**
	* Elementor Agrul Personal Info Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Personal_Info_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Personal Info widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_personal_info';
	}

	/**
	* Get widget title.
	*
	* Retrieve Personal Info Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( ' Agrul Personal Info', 'agrul-core' );
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
			'ag_personal_info_style',
			[
				'label'		=> esc_html__( 'Personal Info Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
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
			'content',
			[
				'label' 	=> __( 'Content', 'agrul-core' ),
                'type' 		=> \Elementor\Controls_Manager::WYSIWYG,
			]
        );
        $this->add_control(
			'facebook_link',
			[
				'label' 		=> __( 'Facebook Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);
		$this->add_control(
			'twitter_link',
			[
				'label' 		=> __( 'Twitter Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);
		$this->add_control(
			'linkedin_link',
			[
				'label' 		=> __( 'Linkedin Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);
		$this->add_control(
			'instagram_link',
			[
				'label' 		=> __( 'Instagram Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);
		$this->add_control(
			'dribble_link',
			[
				'label' 		=> __( 'Dribbble Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);
		$this->add_control(
			'youtube_link',
			[
				'label' 		=> __( 'Youtube Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);
		$this->add_control(
			'pinterest_link',
			[
				'label' 		=> __( 'Pinterest Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'personal_info_style_option',
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
					'{{WRAPPER}} .personal-info h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .personal-info h2',		]
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
					'{{WRAPPER}} .personal-info p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'label' 		=> esc_html__( 'Description Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .personal-info p',
			]
		);

		$this->add_control(
			'contact_title_option',
			[
				'label' 		=> esc_html__( 'Contact Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'contact_title_color',
			[
				'label' 		=> esc_html__( 'Contact Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .personal-info ul li strong' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'contact_title_typography',
				'label' 		=> esc_html__( 'Contact Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .personal-info ul li strong',
			]
		);

		$this->add_control(
			'contact_info_option',
			[
				'label' 		=> esc_html__( 'Contact Info Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'contact_info_color',
			[
				'label' 		=> esc_html__( 'Contact Info Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .personal-info ul li' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'contact_info_typography',
				'label' 		=> esc_html__( 'Contact Info Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .personal-info ul li',
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_personal_info_output = $this->get_settings_for_display();
	?>
	<!-- Start Personal Info
    ============================================= -->
    <div class="bottom-info">
        <div class="personal-info">
            <h2 class="title"><?php echo esc_html($agrul_personal_info_output['title']);?></h2>
            <?php echo htmlspecialchars_decode(esc_html($agrul_personal_info_output['content'],'agrul-core')); ?>

            <ul class="social-info mt-25">
            	<?php if(!empty($agrul_personal_info_output['facebook_link']['url'])):?>
                    <li class="facebook">
                        <a href="<?php echo esc_url($agrul_personal_info_output['facebook_link']['url']);?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
            	<?php endif;?>
            	<?php if(!empty($agrul_personal_info_output['twitter_link']['url'])):?>
                    <li class="twitter">
                        <a href="<?php echo esc_url($agrul_personal_info_output['twitter_link']['url']);?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                <?php endif;?>
                <?php if(!empty($agrul_personal_info_output['youtube_link']['url'])):?>
                    <li class="youtube">
                        <a href="<?php echo esc_url($agrul_personal_info_output['youtube_link']['url']);?>">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                <?php endif;?>
                <?php if(!empty($agrul_personal_info_output['linkedin_link']['url'])):?>
                    <li class="linkedin">
                        <a href="<?php echo esc_url($agrul_personal_info_output['linkedin_link']['url']);?>">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </li>
                <?php endif;?>
                <?php if(!empty($agrul_personal_info_output['instagram_link']['url'])):?>
                    <li class="instagram">
                        <a href="<?php echo esc_url($agrul_personal_info_output['instagram_link']['url']);?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                <?php endif;?>
                <?php if(!empty($agrul_personal_info_output['dribble_link']['url'])):?>
                    <li class="dribbble">
                        <a href="<?php echo esc_url($agrul_personal_info_output['dribble_link']['url']);?>">
                            <i class="fab fa-dribbble"></i>
                        </a>
                    </li>
                <?php endif;?>
                <?php if(!empty($agrul_personal_info_output['pinterest_link']['url'])):?>
                    <li class="pinterest">
                        <a href="<?php echo esc_url($agrul_personal_info_output['pinterest_link']['url']);?>">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
    <!-- End Personal Info -->
    <?php 	
    }
}