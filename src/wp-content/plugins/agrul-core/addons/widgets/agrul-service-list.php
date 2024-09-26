<?php
	/**
	* Elementor Agrul Service List Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Service_List_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Service List widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_service_list';
	}

	/**
	* Get widget title.
	*
	* Retrieve Service List Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( ' Agrul Service List', 'agrul-core' );
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
		return [ 'agrul_service_elements' ];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'ag_service_list_style',
			[
				'label'		=> esc_html__( 'Service List Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'widget_service_title', [
				'label' 		=> esc_html__( 'Service Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'widget_service_url', [
				'label' 		=> esc_html__( 'Service URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'label_block' 	=> true,
			]
		);
		
		$this->add_control(
			'widget_service_list',
			[
				'label' 	=> esc_html__( 'Service List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Service', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ widget_service_title }}}',
			]
		);
		

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_service_list_output = $this->get_settings_for_display();
	$page_id = get_the_ID();
	$curent_page_url = get_permalink($page_id);
	?>
	<!-- Single Service List Widget -->
    <div class="single-widget services-list-widget">
        <div class="content">
            <ul>
            	<?php foreach($agrul_service_list_output['widget_service_list'] as $single_service_wig_item):?>
                	<li class="<?php if($curent_page_url == $single_service_wig_item['widget_service_url']['url']){echo esc_attr("current-item");}?>"><a href="<?php echo esc_html($single_service_wig_item['widget_service_url']['url']);?>"><?php echo esc_html($single_service_wig_item['widget_service_title']);?></a></li>
            	<?php endforeach;?>
            </ul>
        </div>
    </div>
    <!-- End Service List Single Widget -->
    <?php 	
    }
}