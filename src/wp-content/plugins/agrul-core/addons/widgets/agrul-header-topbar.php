<?php
	/**
	* Elementor Agrul Topbar Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Header_Topbar_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Topbar widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_header_topbar';
	}

	/**
	* Get widget title.
	*
	* Retrieve Topbar Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Topbar', 'agrul-core' );
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
		return [ 'agrul_header_elements' ];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'ag_topbar_style',
			[
				'label'		=> esc_html__( 'Topbar Style','agrul-core' ),
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
			'topbar_logo',
			[
				'label'			=> esc_html__( 'Topbar Logo','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' 	=> [
                    'style' 	=> '2'
                ]
			]
		);

		$this->add_control(
			'left_text', [
				'label' 		=> esc_html__( 'Left Text', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'info', [
				'label' 		=> esc_html__( 'Info', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'icon_style',
			[
				'label' 	=> esc_html__( 'Icon Style', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__( 'Flaticon', 'agrul-core' ),
					'3' 	=> esc_html__( 'Icon Image', 'agrul-core' ),
					'2'  	=> esc_html__( 'Custom Icon', 'agrul-core' ),
				],
			]
		);

		$repeater->add_control(
			'flat_icon',
			[
                'label'      => esc_html__('Icon One', 'cleanu-core'),
                'type'       => \Elementor\Controls_Manager::ICON,
                'options'    => agrul_flaticons(),
                'include'    => agrul_include_flaticons(),
                'default'    => 'flaticon-vegetables',
                'condition' => [
                    'icon_style' => '1'
                ]
            ]
		);

		$repeater->add_control(
			'custom_icon', [
				'label' 		=> esc_html__( 'Custom Icon', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows'  		=>'2',
				'condition' => [
                    'icon_style' => '2'
                ]
			]
		);


		$repeater->add_control(
			'icon_image',
			[
				'label'			=> esc_html__( 'Add Image Icon','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'icon_style' => '3'
                ]
			]
		);
		
		$this->add_control(
			'contact_info_list',
			[
				'label' 	=> esc_html__( 'Contact Info List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Contact Info', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ info }}}',
			]
		);

		$this->add_control(
			'facebook_link',
			[
				'label' 		=> __( 'Facebook Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);
		$this->add_control(
			'twitter_link',
			[
				'label' 		=> __( 'Twitter Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);
		$this->add_control(
			'linkedin_link',
			[
				'label' 		=> __( 'Linkedin Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);
		$this->add_control(
			'instagram_link',
			[
				'label' 		=> __( 'Instagram Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);
		$this->add_control(
			'dribble_link',
			[
				'label' 		=> __( 'Dribbble Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);
		$this->add_control(
			'youtube_link',
			[
				'label' 		=> __( 'Youtube Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);
		$this->add_control(
			'pinterest_link',
			[
				'label' 		=> __( 'Pinterest Link', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'topbar_style_section',
			[
				'label' 	=> __( 'TopBar Style', 'appku' ),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'topbar_right_green_color',
			[
				'label' 		=> __( 'Right Background Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .top-bar-area .container::after' => 'background-color: {{VALUE}};',
                ],
                'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
        );
        $this->add_control(
			'topbar_left_yelow_color',
			[
				'label' 		=> __( 'Left Background Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .top-bar-area .social' => 'background-color: {{VALUE}};',
                ],
                'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
        );

        $this->add_control(
			'topbar_icon_color',
			[
				'label' 		=> __( 'Icon Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .top-bar-area .social > ul > li > a' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'style' 	=> '1'
                ]
			]
        );

         $this->add_control(
			'topbar_icon_color_st2',
			[
				'label' 		=> __( 'Icon Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .top-style-one .info li i' => 'color: {{VALUE}}',
                ],
                'condition' 	=> [
                    'style' 	=> '2'
                ]
			]
        );

        $this->add_control(
			'topbar_icon_bac_color_st2',
			[
				'label' 		=> __( 'Icon Background Color', 'appku' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .top-style-one .info li i' => 'background-color: {{VALUE}};',
                ],
                'condition' 	=> [
                    'style' 	=> '2'
                ]
			]
        );

        $this->add_control(
			'contact_title_option',
			[
				'label' 		=> esc_html__( 'Contact Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> [
                    'style' 	=> '2'
                ]
			]
		);
		
		$this->add_control(
			'contact_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .text-light span, {{WRAPPER}} .top-bar-area p' => 'color: {{VALUE}}',
				],
				'condition' 	=> [
                    'style' 	=> ['2','1']
                ]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .text-light span, {{WRAPPER}} .top-bar-area p',
				'condition' 	=> [
                    'style' 	=> ['2','1']
                ]
			]
		);

		$this->add_control(
			'contact_info_option',
			[
				'label' 		=> esc_html__( 'Contact Info Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> [
                    'style' 	=> '2'
                ]
			]
		);
		
		$this->add_control(
			'contact_info_color',
			[
				'label' 		=> esc_html__( 'Contact Info Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .text-light a,{{WRAPPER}} .top-bar-area ul li' => 'color: {{VALUE}}',
				],
				'condition' 	=> [
                    'style' 	=> ['2','1']
                ]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'contact_info_typography',
				'label' 		=> esc_html__( 'Contact Info Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .text-light a,{{WRAPPER}} .top-bar-area ul li',
				'condition' 	=> [
                    'style' 	=> ['2','1']                ]
			]
		);

        $this->end_controls_section();
	}
	// Output For User
	protected function render(){	
	$agrul_topbar_output = $this->get_settings_for_display();
	if($agrul_topbar_output['style'] == '1'):
	?>
		<!-- Start Header Top 
	    ============================================= -->
	    <div class="top-bar-area text-light">
	        <div class="container">
	            <div class="row align-center">
	                <div class="col-lg-9">
	                    <div class="flex-item left">
	                    	<?php if(!empty($agrul_topbar_output['left_text'])):?>
	                        	<p><?php echo esc_html($agrul_topbar_output['left_text']);?>
	                        	</p>
	                    	<?php endif;?>
	                        <ul>
	                        	<?php foreach($agrul_topbar_output['contact_info_list'] as $single_contact_info):
	                        		if(!empty($single_contact_info['info'])):
	                        	?>
	                            <li>
	                                <?php if(!empty($single_contact_info['flat_icon'])):?>
				                        <i class="<?php echo esc_attr($single_contact_info['flat_icon']); ?>"></i>
				                    <?php endif;?>
				                    <?php if(!empty($single_contact_info['icon_image'])):?>
				                        <img src="<?php echo esc_url($single_contact_info['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
				                    <?php endif;?>
				                    <?php 
				                    if(!empty($single_contact_info['custom_icon'])):?>
				                        <i class="<?php echo esc_attr($single_contact_info['custom_icon']); ?>"></i>
				                    <?php endif;?> <?php echo htmlspecialchars_decode(esc_html($single_contact_info['info'],'agrul-core')); ?>
	                            </li>
	                        	<?php endif; endforeach;?>
	                        </ul>
	                    </div>
	                </div>
	                <div class="col-lg-3 text-end">
	                	<?php 
	                	if(!empty(
	                		$agrul_topbar_output['facebook_link']['url'] ||
	                		$agrul_topbar_output['twitter_link']['url'] || 
		                	$agrul_topbar_output['youtube_link']['url'] || 
		                	$agrul_topbar_output['linkedin_link']['url'] || 
		                	$agrul_topbar_output['instagram_link']['url'] || 
		                	$agrul_topbar_output['dribble_link']['url'] || 
		                	$agrul_topbar_output['pinterest_link']['url'] )):
		                ?>
	                    <div class="social">
	                        <ul>
					            <?php if(!empty($agrul_topbar_output['facebook_link']['url'])):?>
				                    <li class="facebook">
				                        <a href="<?php echo esc_url($agrul_topbar_output['facebook_link']['url']);?>">
				                            <i class="fab fa-facebook-f"></i>
				                        </a>
				                    </li>
				            	<?php endif;?>
				            	<?php if(!empty($agrul_topbar_output['twitter_link']['url'])):?>
				                    <li class="twitter">
				                        <a href="<?php echo esc_url($agrul_topbar_output['twitter_link']['url']);?>">
				                            <i class="fab fa-twitter"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_topbar_output['youtube_link']['url'])):?>
				                    <li class="youtube">
				                        <a href="<?php echo esc_url($agrul_topbar_output['youtube_link']['url']);?>">
				                            <i class="fab fa-youtube"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_topbar_output['linkedin_link']['url'])):?>
				                    <li class="linkedin">
				                        <a href="<?php echo esc_url($agrul_topbar_output['linkedin_link']['url']);?>">
				                            <i class="fab fa-linkedin"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_topbar_output['instagram_link']['url'])):?>
				                    <li class="instagram">
				                        <a href="<?php echo esc_url($agrul_topbar_output['instagram_link']['url']);?>">
				                            <i class="fab fa-instagram"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_topbar_output['dribble_link']['url'])):?>
				                    <li class="dribbble">
				                        <a href="<?php echo esc_url($agrul_topbar_output['dribble_link']['url']);?>">
				                            <i class="fab fa-dribbble"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
				                <?php if(!empty($agrul_topbar_output['pinterest_link']['url'])):?>
				                    <li class="pinterest">
				                        <a href="<?php echo esc_url($agrul_topbar_output['pinterest_link']['url']);?>">
				                            <i class="fab fa-pinterest"></i>
				                        </a>
				                    </li>
				                <?php endif;?>
	                        </ul>
	                    </div>
	                <?php endif;?>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- End Header Top -->
	<?php elseif($agrul_topbar_output['style'] == '2'):?>
		<!-- Start Header Top 
	    ============================================= -->
	    <div class="top-bar top-style-one text-light">
	        <div class="container">
	            <div class="row align-center">
	                <div class="col-xl-4 col-lg-4 col-md-4 info">
	                    <ul>
	                    	<?php 
	                    		$counter = 1;
	                    		foreach($agrul_topbar_output['contact_info_list'] as $single_contact_info):
	                        		if(!empty($single_contact_info['info'])):
	                        ?>
		                        <li>
		                            <div class="icon">
		                            <?php if(!empty($single_contact_info['flat_icon'])):?>
				                        <i class="<?php echo esc_attr($single_contact_info['flat_icon']); ?>"></i>
				                    <?php endif;?>
				                    <?php if(!empty($single_contact_info['icon_image'])):?>
				                        <img src="<?php echo esc_url($single_contact_info['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
				                    <?php endif;?>
				                    <?php 
				                    if(!empty($single_contact_info['custom_icon'])):?>
				                        <i class="<?php echo esc_attr($single_contact_info['custom_icon']); ?>"></i>
				                    <?php endif;?>
		                            </div>
		                            <div class="content">
		                                <?php echo htmlspecialchars_decode(esc_html($single_contact_info['info'],'agrul-core')); ?>
		                            </div>
		                        </li>
	                        <?php
	                         	endif; 
	                         	if($counter == 1){
		                        	break;
		                        } 
		                        $counter++; 
		                    	endforeach;
	                        ?>
	                    </ul>
	                </div>
	                <div class="col-xl-4 col-lg-4 col-md-4 logo">
	                	<?php if(!empty($agrul_topbar_output['topbar_logo']['url'])):?>
	                    	<a href="<?php echo esc_url(home_url());?>"><img src="<?php echo esc_url($agrul_topbar_output['topbar_logo']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
	                	<?php endif;?>
	                </div>
	                <div class="col-xl-4 col-lg-4 col-md-4 text-end info">
	                	<ul>
		                	<?php 
	                    		$counter = 1;
	                    		foreach($agrul_topbar_output['contact_info_list'] as $single_contact_info):
	                        		if($counter == 2):
	                        		if(!empty($single_contact_info['info'])):
	                        ?>
			                    <li>
			                        <div class="icon">
			                            <?php if(!empty($single_contact_info['flat_icon'])):?>
					                        <i class="<?php echo esc_attr($single_contact_info['flat_icon']); ?>"></i>
					                    <?php endif;?>
					                    <?php if(!empty($single_contact_info['icon_image'])):?>
					                        <img src="<?php echo esc_url($single_contact_info['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
					                    <?php endif;?>
					                    <?php 
					                    if(!empty($single_contact_info['custom_icon'])):?>
					                        <i class="<?php echo esc_attr($single_contact_info['custom_icon']); ?>"></i>
					                    <?php endif;?>
			                        </div>
			                        <div class="content">
			                            <?php echo htmlspecialchars_decode(esc_html($single_contact_info['info'],'agrul-core')); ?>
			                        </div>
			                    </li>
		                    <?php
		                    	endif; 
	                         	endif; 
		                        $counter++; 
		                    	endforeach;
	                        ?>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- End Header Top -->
    <?php 	
	endif;
    }
}