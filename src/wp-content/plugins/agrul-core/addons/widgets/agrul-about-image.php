<?php
	/**
	* Elementor Agrul About Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_About_Image_Widget extends \Elementor\Widget_Base {

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
		return 'agrul_about_image';
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
		return esc_html__( 'About Image', 'agrul-core' );
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
			'about_image_style',
			[
				'label'		=> esc_html__( 'About Image Style','agrul-core' ),
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
			'thumb_image_one',
			[
				'label' 	=> esc_html__( 'Thumb Image One', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'default' 	=> [
					'url' 		=> \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'thumb_image_two',
			[
				'label' 	=> esc_html__( 'Thumb Image Two', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
				'default' 	=> [
					'url' 		=> \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
                    'style' => '1'
                ]
			]
		);
		
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_about_image_output = $this->get_settings_for_display();
	if($agrul_about_image_output['style'] == '1'):
	?>
	<div class="about-style-one">
		<div class="thumb">
	        <?php
	        	if(!empty($agrul_about_image_output['thumb_image_one']['url'])): 
		        	echo agrul_img_tag( array(
			            'url'   => esc_url( $agrul_about_image_output['thumb_image_one']['url'] )
			    	) );
	        	endif;
		    ?>
		    <?php if(!empty($agrul_about_image_output['thumb_image_two']['url'])):?>
	        <div class="sub-item">
	            <?php 
	        	echo agrul_img_tag( array(
		            'url'   => esc_url( $agrul_about_image_output['thumb_image_two']['url'] )
		    	) );?>
	        </div>
	    	<?php endif; ?>
	    </div>
    </div>
    <?php elseif($agrul_about_image_output['style'] == '2'): ?>
     <div class="about-style-two">
        <div class="thumb">
            <?php
	        	if(!empty($agrul_about_image_output['thumb_image_one']['url'])): 
		        	echo agrul_img_tag( array(
			            'url'   => esc_url( $agrul_about_image_output['thumb_image_one']['url'] )
			    	) );
	        	endif;
		    ?>
        </div>
    </div>
    <?php
	endif;
    }
}