<?php
	/**
	* Elementor Agrul Project Feature Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Project_Basic_Info_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Agrul Project Feature widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_project_basic_info';
	}

	/**
	* Get widget title.
	*
	* Retrieve Agrul Project Feature widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Project Basic Info', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Agrul project_feature widget icon.
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
	* Retrieve the list of categories the Agrul project_feature widget belongs to.
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
			'agrul_project_basic_info_content',
			[
				'label'		=> esc_html__( 'Set Project Basic Info Content','agrul-core'),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
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
			'content', [
				'label' 		=> esc_html__( 'Content', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'project_basic_info_list',
			[
				'label' 	=> esc_html__( 'Project Basic Info List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Project Basic Info', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		
		
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){
	$agrul_project_basic_info_content = $this->get_settings_for_display();
	$project_basic_info_list = $agrul_project_basic_info_content['project_basic_info_list'];
	?>
	<!-- Start project Basic Info
    ============================================= -->
   	<div class="project-info text-light">
        <div class="content">
            <ul class="project-basic-info">
            	<?php foreach($project_basic_info_list as $single_basic_info):?>
                <li>
                    <?php echo esc_html($single_basic_info['title']);?> <span><?php echo esc_html($single_basic_info['content']);?></span>
                </li>
                <?php endforeach?>
            </ul>
        </div>
    </div>
    <!-- End project Basic Info -->
	<?php
	}
}