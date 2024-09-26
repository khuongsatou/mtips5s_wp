<?php
	/**
	* Elementor Agrul About Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Testomonial_Info_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve About widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_testimoanial_info';
	}

	/**
	* Get widget title.
	*
	* Retrieve About Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Testimoanial Info', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve About Nav Tab widget icon.
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
	* Retrieve the list of categories the About Nav Tab widget belongs to.
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
			'ag_testimoanial_info_style',
			[
				'label'		=> esc_html__( 'Testimonial Info Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'info_img',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'testimonail_info_list',
			[
				'label' 	=> esc_html__( 'Testimonial Info', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Testimonial Info', 'agrul-core' ),
					],
				],
			]
		);

		
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_testimonial_info_output = $this->get_settings_for_display();
	?>
	<!-- Start Testimonials Info
    ============================================= -->
    <div class="testimonial-info text-center">
        <h4>Testimonial</h4>
        <div class="thumb">
        	<?php foreach($agrul_testimonial_info_output['testimonail_info_list'] as $single_testimonail_info): ?>
            <?php
	        	if(!empty($single_testimonail_info['info_img']['url'])): 
		        	echo agrul_img_tag( array(
			            'url'   => esc_url( $single_testimonail_info['info_img']['url'] )
			    	) );
	        	endif;
		    ?>
            <?php endforeach;?>
        </div>
    </div>
    <!-- End Testimonials Info
    ============================================= -->
    <?php
    }
}