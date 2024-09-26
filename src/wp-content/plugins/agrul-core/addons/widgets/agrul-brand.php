<?php
	/**
	* Elementor Agrul Brand Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Brand_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Agrul Brand widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_brand';
	}

	/**
	* Get widget title.
	*
	* Retrieve Agrul Brand widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Brand', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Agrul Brand widget icon.
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
	* Retrieve the list of categories the Agrul Brand widget belongs to.
	*
	* @since 1.0.0
	* @access public
	*
	* @return array Widget categories.
	*/
	public function get_categories() {
		return [ 'agrul_elements'];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'agrul_brand_content',
			[
				'label'		=> esc_html__( 'Set Brand Content','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'brand_image',
			[
				'label'			=> esc_html__( 'Add Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'brand_image_list',
			[
				'label' 	=> esc_html__( 'Brand', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Brand Image', 'agrul-core' ),
					],
				],
			]
		);
		
		
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){
	$agrul_brand_content = $this->get_settings_for_display();
	$brand_list = $agrul_brand_content['brand_image_list'];
	?>
	<!-- Start Brand
    ============================================= -->
    <div class="brand-style-one-area text-center">
        <div class="container">
            <div class="brand-style-one">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="brand5col swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                            	<?php foreach($brand_list as $single_brand):
                            		if(!empty($single_brand['brand_image']['url'])):
                            	?>

                                <!-- Single Item -->
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($single_brand['brand_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                                </div>
                                <!-- End Single Item -->
                                <?php endif; endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Brand -->
            </div>
        </div>
    </div>
    <!-- End Brand -->
	<?php
	}
}