<?php
	/**
	* Elementor Agrul Project Feature Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Project_Feature_Widget extends \Elementor\Widget_Base {

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
		return 'agrul_project_feature';
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
		return esc_html__( 'Agrul Project Feature', 'agrul-core' );
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
			'agrul_project_feature_content',
			[
				'label'		=> esc_html__( 'Set Project Feature Content','agrul-core'),
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
			'project_feature_list',
			[
				'label' 	=> esc_html__( 'Project Feature List', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__( 'Add Project Feature', 'agrul-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		
		
		$this->end_controls_section();
	}

	// Output For User
	protected function render(){
	$agrul_project_feature_content = $this->get_settings_for_display();
	$project_feature_list = $agrul_project_feature_content['project_feature_list'];
	?>
	<!-- Start project feature
    ============================================= -->
    <ul class="mt-40 display-grid colum-two">
    	<?php foreach($project_feature_list as $single_project_feature):?>
	        <li class="project-feature-list">
	            <div class="icon">
	                <?php if(!empty($single_project_feature['flat_icon'])):?>
                    <i class="<?php echo esc_attr($single_project_feature['flat_icon']); ?>"></i>
                    <?php endif;?>
                    <?php if(!empty($single_project_feature['icon_image'])):?>
                        <img src="<?php echo esc_url($single_project_feature['icon_image']['url']); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
                    <?php endif;?>
                    <?php 
                    if(!empty($single_project_feature['custom_icon'])):?>
                        <i class="<?php echo esc_attr($single_project_feature['custom_icon']); ?>"></i>
                    <?php endif;?>
	            </div>
	            <div class="content">
	                <h4><?php echo esc_html($single_project_feature['title']);?></h4>
	                <p>
	                    <?php echo esc_html($single_project_feature['content']); ?>
	                </p>
	            </div>
	        </li>
    	<?php endforeach;?>
        
    </ul>
    <!-- End project feature -->
	<?php
	}
}