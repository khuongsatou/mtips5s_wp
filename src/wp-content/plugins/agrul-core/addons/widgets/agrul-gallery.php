<?php
	/**
	* Elementor Agrul Gallery Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Gallery_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Gallery widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_gallery';
	}

	/**
	* Get widget title.
	*
	* Retrieve Gallery Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Gallery', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Gallery Nav Tab widget icon.
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
	* Retrieve the list of categories the Gallery Nav Tab widget belongs to.
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
			'ag_gallery_style',
			[
				'label'		=> esc_html__( 'Gallery Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> __( 'Style', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'agrul-core' ),
					'2' 		=> __( 'Style Two', 'agrul-core' ),
					'3' 		=> __( 'Style Three', 'agrul-core' ),
				],
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
			'category', [
				'label' 		=> esc_html__( 'Category', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'gallery_image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'gallery_url',
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
			'gallery_list',
			[
				'label' 	=> esc_html__( 'Gallery List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Gallery', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'gallery_style_option',
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
				'condition' 	=> ['style' => ['1','2']],
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
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .site-heading .title',
				'condition' 	=> ['style' => ['1','2']],			]
		);

		$this->add_control(
			'section_subtitle_option',
			[
				'label' 		=> esc_html__( 'Section SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
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
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .sub-title',
				'condition' 	=> ['style' => ['1','2']],
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
					'{{WRAPPER}} .gallery-style-one .overlay a,{{WRAPPER}} .gallery-style-two h4 a' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .gallery-style-one .overlay a,{{WRAPPER}} .gallery-style-two h4 a',
				'condition' 	=> ['style' => ['1','2']],
			]
		);

		$this->add_control(
			'subtitle_option',
			[
				'label' 		=> esc_html__( 'SubTitle Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> esc_html__( 'SubTitle Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .gallery-style-one .overlay span,{{WRAPPER}} .gallery-style-two span' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__( 'SubTitle Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .gallery-style-one .overlay span,{{WRAPPER}} .gallery-style-two span',
				'condition' 	=> ['style' => ['1','2']],
			]
		);
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_gallery_output = $this->get_settings_for_display();
	if($agrul_gallery_output['style'] == '1'): 
	?>
	<!-- Start Gallery Style One
    ============================================= -->
    <div class="gallery-style-one-area">
    	<?php if($agrul_gallery_output['section_show'] == 'yes'): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_gallery_output['subtitle'],'agrul-core')); ?></h5>
                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_gallery_output['title'],'agrul-core')); ?></h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
    	<?php endif;?>
        <div class="container container-stage">
            <div class="row">
                <div class="col-xl-12">
                    <div class="carousel-stage-right carousel-style-one swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                        	<?php foreach($agrul_gallery_output['gallery_list'] as $single_gallery): ?>
	                            <!-- Single Item -->
	                            <div class="swiper-slide">
	                                <div class="gallery-style-one">
	                                    <?php
								        	if(!empty($single_gallery['gallery_image']['url'])): 
									        	echo agrul_img_tag( array(
										            'url'   => esc_url( $single_gallery['gallery_image']['url'] )
										    	) );
								        	endif;
									    ?>
	                                    <div class="overlay">
	                                        <span><?php echo esc_html($single_gallery['category']);?></span>
	                                        <h4><a href="<?php echo esc_url($single_gallery['gallery_url']['url'])?>"><?php echo esc_html($single_gallery['title']);?></a></h4>
	                                    </div>
	                                </div>
	                            </div>
	                            <!-- End Single Item -->
                        	<?php endforeach;?>
                            
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>

                    </div>
                </div>
            </div>
        </div>        
    </div>
    <!-- End Gallery Style One -->
    <?php elseif($agrul_gallery_output['style'] == '2'): ?>
    <!-- Start Gallery Style Two
    ============================================= -->
    <div class="gallery-area">
    	<?php if($agrul_gallery_output['section_show'] == 'yes'): ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_gallery_output['subtitle'],'agrul-core')); ?></h5>
                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_gallery_output['title'],'agrul-core')); ?></h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 gallery-content">
                    <div class="magnific-mix-gallery masonary">
                        <div id="portfolio-grid" class="gallery-items colums-2">
                        	<?php foreach($agrul_gallery_output['gallery_list'] as $single_gallery): ?>

	                            <!-- Single Item -->
	                            <div class="pf-item">
	                                <div class="gallery-style-two">
	                                    <?php
								        	if(!empty($single_gallery['gallery_image']['url'])): 
									        	echo agrul_img_tag( array(
										            'url'   => esc_url( $single_gallery['gallery_image']['url'] )
										    	) );
								        	endif;
									    ?>
	                                    <div class="overlay">
	                                        <span><?php echo esc_html($single_gallery['category']);?></span>
	                                        <h4><a href="<?php echo esc_url($single_gallery['gallery_url']['url'])?>"><?php echo esc_html($single_gallery['title']);?></a></h4>
	                                    </div>
	                                    <a class="link" href="<?php echo esc_url($single_gallery['gallery_url']['url'])?>"><i class="fas fa-arrow-right"></i></a>
	                                </div>
	                            </div>
	                            <!-- End Single Item -->

                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Gallery Style Two -->

    <?php elseif($agrul_gallery_output['style'] == '3'): ?>

     <!-- Start Gallery 
    ============================================= -->
    <div class="gallery-style-two-area default-padding">
    	<?php if($agrul_gallery_output['section_show'] == 'yes'): ?>
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-8 offset-lg-2">
	                    <div class="site-heading text-center">
	                        <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_gallery_output['subtitle'],'agrul-core')); ?></h5>
	                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_gallery_output['title'],'agrul-core')); ?></h2>
	                        <div class="devider"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
        <?php endif;?>
        <div class="container container-stage">
            <div class="row">
                <div class="col-xl-12">
                    <div class="carousel-stage-right-two carousel-style-one swiper">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                        	<?php foreach($agrul_gallery_output['gallery_list'] as $single_gallery): ?>
	                            <!-- Single Item -->
	                            <div class="swiper-slide">
	                                <div class="gallery-style-one">
	                                    <?php
								        	if(!empty($single_gallery['gallery_image']['url'])): 
									        	echo agrul_img_tag( array(
										            'url'   => esc_url( $single_gallery['gallery_image']['url'] )
										    	) );
								        	endif;
									    ?>
	                                    <div class="overlay">
	                                        <span><?php echo esc_html($single_gallery['category']);?></span>
	                                        <h4><a href="<?php echo esc_url($single_gallery['gallery_url']['url'])?>"><?php echo esc_html($single_gallery['title']);?></a></h4>
	                                    </div>
	                                </div>
	                            </div>
	                            <!-- End Single Item -->
                            <?php endforeach;?>
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>

                    </div>
                </div>
            </div>
        </div>        
    </div>
    <!-- End Gallery -->

    <?php 	
    endif;
    }
}