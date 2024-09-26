<?php
	/**
	* Elementor Agrul Farmers Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Farmer_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Farmers widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_farmers';
	}

	/**
	* Get widget title.
	*
	* Retrieve Farmers Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Farmer', 'agrul-core' );
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
			'ag_farmer_style',
			[
				'label'		=> esc_html__( 'Farmers Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'section_show',
			[
				'label' => __( 'Show/Hide Section Heading', 'cleanu-core' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'cleanu-core' ),
				'label_off' => __( 'Hide', 'cleanu-core' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]
		);
		$this->add_control(
			'subtitle', [
				'label' 		=> esc_html__( 'Subtitle', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]
		);
		$this->add_control(
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition'		=> [ 'section_show'	=>	'yes' ],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' 		=> esc_html__( 'Name', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'designation', [
				'label' 		=> esc_html__( 'Designation', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'farmer_image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'farmer_url',
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
		$repeater->add_control(
			'facebook_url',
			[
				'label' 		=> esc_html__( 'Facebook URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
			]
		);
		$repeater->add_control(
			'twitter_url',
			[
				'label' 		=> esc_html__( 'Twitter URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
			]
		);
		$repeater->add_control(
			'linkedin_url',
			[
				'label' 		=> esc_html__( 'Linkedin URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
			]
		);
		$repeater->add_control(
			'instagram_url',
			[
				'label' 		=> esc_html__( 'Instagram URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
			]
		);
		$repeater->add_control(
			'dribbble_url',
			[
				'label' 		=> esc_html__( 'Dribbble URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
			]
		);
		$repeater->add_control(
			'youtube_url',
			[
				'label' 		=> esc_html__( 'Youtube URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
			]
		);
		
		$this->add_control(
			'farmer_list',
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

		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'farmer_style_option',
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
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .site-heading .title',		]
		);

		$this->add_control(
			'section_subtitle_option',
			[
				'label' 		=> esc_html__( 'Section SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
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
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .sub-title',
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
					'{{WRAPPER}} .farmer-style-one-item .info h4 a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'name_typography',
				'label' 		=> esc_html__( 'Name Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .farmer-style-one-item .info h4 a',
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
					'{{WRAPPER}} .farmer-style-one-item .info span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'designation_typography',
				'label' 		=> esc_html__( 'Designation Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .farmer-style-one-item .info span',
			]
		);
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_farmer_output = $this->get_settings_for_display();
	?>
	 <!-- Start Farmer 
    ============================================= -->
    <div class="farmer-area">
    	<?php if($agrul_farmer_output['section_show'] == 'yes'): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_farmer_output['subtitle'],'agrul-core')); ?></h5>
                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_farmer_output['title'],'agrul-core')); ?></h2>
                        <div class="devider"></div>
                        <p>
                           <?php echo htmlspecialchars_decode(esc_html($agrul_farmer_output['content'],'agrul-core')); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="row">
                    	<?php foreach($agrul_farmer_output['farmer_list'] as $single_farmer): ?>
                        <!-- Single Item -->
                        <div class="col-lg-4 col-md-6 farmer-stye-one">
                            <div class="farmer-style-one-item">
                                <div class="thumb">
                                    <?php
							        	if(!empty($single_farmer['farmer_image']['url'])): 
								        	echo agrul_img_tag( array(
									            'url'   => esc_url( $single_farmer['farmer_image']['url'] )
									    	) );
							        	endif;
								    ?>
								    <?php if(!empty($single_farmer['facebook_url']['url'] || $single_farmer['twitter_url']['url'] || $single_farmer['linkedin_url']['url'] || $single_farmer['instagram_url']['url'] || $single_farmer['dribbble_url']['url'] || $single_farmer['youtube_url']['url'])): ?>
                                    <div class="social">
                                        <i class="fas fa-share-alt"></i>
                                        <ul>
                                        	<?php if(!empty($single_farmer['facebook_url']['url'])):?>
	                                            <li class="facebook">
	                                                <a href="<?php echo esc_url($single_farmer['facebook_url']['url']);?>">
	                                                    <i class="fab fa-facebook-f"></i>
	                                                </a>
	                                            </li>
                                        	<?php endif;?>
                                        	<?php if(!empty($single_farmer['twitter_url']['url'])):?>
	                                            <li class="twitter">
	                                                <a href="<?php echo esc_url($single_farmer['twitter_url']['url']);?>">
	                                                    <i class="fab fa-twitter"></i>
	                                                </a>
	                                            </li>
                                            <?php endif;?>
                                            <?php if(!empty($single_farmer['linkedin_url']['url'])):?>
	                                            <li class="linkedin">
	                                                <a href="<?php echo esc_url($single_farmer['linkedin_url']['url']);?>">
	                                                    <i class="fab fa-linkedin-in"></i>
	                                                </a>
	                                            </li>
                                            <?php endif;?>
                                            <?php if(!empty($single_farmer['instagram_url']['url'])):?>
	                                            <li class="instagram">
	                                                <a href="<?php echo esc_url($single_farmer['instagram_url']['url']);?>">
	                                                    <i class="fab fa-instagram"></i>
	                                                </a>
	                                            </li>
                                            <?php endif;?>
                                            <?php if(!empty($single_farmer['dribbble_url']['url'])):?>
	                                            <li class="dribbble">
	                                                <a href="<?php echo esc_url($single_farmer['dribbble_url']['url']);?>">
	                                                    <i class="fab fa-dribbble"></i>
	                                                </a>
	                                            </li>
                                            <?php endif;?>
                                            <?php if(!empty($single_farmer['youtube_url']['url'])):?>
	                                            <li class="youtube">
	                                                <a href="<?php echo esc_url($single_farmer['youtube_url']['url']);?>">
	                                                    <i class="fab fa-youtube"></i>
	                                                </a>
	                                            </li>
                                            <?php endif;?>

                                        </ul>
                                    </div>
                                <?php endif;?>
                                </div>
                                <div class="info">
                                    <span><?php echo esc_html($single_farmer['designation']);?></span>
                                    <h4><a href="<?php echo esc_url($single_farmer['farmer_url']['url']);?>"><?php echo esc_html($single_farmer['title']);?></a></h4>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Item -->
                        <?php endforeach;?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Farmer -->
    <?php 	
    }
}