<?php
	/**
	* Elementor Agrul Service Quick Contact Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Service_Quick_Contact_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Service Quick Contact widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_service_quick_contact';
	}

	/**
	* Get widget title.
	*
	* Retrieve Service Quick Contact  Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( ' Agrul Service Quick Contact', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Service Quick Contact Nav Tab widget icon.
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
		return [ 'agrul_service_elements' ];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'ag_service_quick_contact_style',
			[
				'label'	=> esc_html__( 'Service Quick Contact Style','agrul-core' ),
				'tab'	=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'quick_con_img',
			[
				'label'			=> esc_html__( 'Background Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'quick_contact', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'quick_mail', [
				'label' 		=> esc_html__( 'Mail', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'quick_btn', [
				'label' 		=> esc_html__( 'Button Text', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$this->add_control(
			'quick_btn_url',
			[
				'label' 		=> esc_html__( 'Button URL', 'agrul-core' ),
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

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_service_quick_contact_output = $this->get_settings_for_display();

	?>
	<!-- Single Service List Widget -->
    <div class="single-widget quick-contact-widget text-light" style="background-image: url(<?php echo esc_url($agrul_service_quick_contact_output['quick_con_img']['url']);?>);">
        <div class="content">
           <?php echo htmlspecialchars_decode(esc_html($agrul_service_quick_contact_output['quick_contact'],'agrul-core')); ?>
           	<?php if(!empty($agrul_service_quick_contact_output['quick_mail'])):?>
            	<h4><a href="mailto:<?php echo esc_attr($agrul_service_quick_contact_output['quick_mail']);?>"><?php echo esc_html($agrul_service_quick_contact_output['quick_mail']);?></a></h4>
            <?php endif;?>
            <?php if(!empty($agrul_service_quick_contact_output['quick_btn'])):?>
            	<a class="btn mt-30 circle btn-theme animation btn-md" href="<?php echo esc_url($agrul_service_quick_contact_output['quick_btn_url']['url']);?>"><?php echo esc_html($agrul_service_quick_contact_output['quick_btn']);?></a>
            <?php endif;?>
        </div>
    </div>
    <!-- End Service List Single Widget -->
    <?php 	
    }
}