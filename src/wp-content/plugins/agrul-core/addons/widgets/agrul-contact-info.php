<?php

/**
 * Elementor Contact Info Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Agrul_Contact_Info_Widget extends \Elementor\Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve Contact Info widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'agrul_contact_info';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Contact Info widget title.
	 *
	 * @since 1.0.0
	 * @access public 
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('Contact Info', 'agrul-core');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Contact Info widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Contact Info widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['agrul_elements'];
	}

	public function get_script_depends()
	{
		return array('main');
	}

	// Add The Input For User
	protected function register_controls()
	{


		$this->start_controls_section(
			'contact_info_content',
			[
				'label'		=> esc_html__('Set Content', 'agrul-core'),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=> esc_html__('Title', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'content',
			[
				'label' 		=> esc_html__('Content', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' 		=> esc_html__('Title', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'info',
			[
				'label' 		=> esc_html__('Info', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'contact_info_url',
			[
				'label' 		=> esc_html__('URL', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'agrul-core'),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
			]
		);

		$repeater->add_control(
			'icon_style',
			[
				'label' 	=> esc_html__('Icon Style', 'agrul-core'),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__('Flaticon', 'agrul-core'),
					'3' 	=> esc_html__('Icon Image', 'agrul-core'),
					'2'  	=> esc_html__('Custom Icon', 'agrul-core'),
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
			'custom_icon',
			[
				'label' 		=> esc_html__('Custom Icon', 'agrul-core'),
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
				'label'			=> esc_html__('Add Image Icon', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_style' => '3'
				]
			]
		);

		$this->add_control(
			'contact_info_list',
			[
				'label' 	=> esc_html__('Contact Info List', 'agrul-core'),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__('Add Contact Info', 'agrul-core'),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'contact_info_style_option',
			[
				'label'			=> esc_html__('Content Style', 'agrul-core'),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_option',
			[
				'label' 		=> esc_html__('Title Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__('Title Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-style-one-info h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__('Title Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .contact-style-one-info h2',
			]
		);

		$this->add_control(
			'subtitle_option',
			[
				'label' 		=> esc_html__('SubTitle Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> esc_html__('SubTitle Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-style-one-info p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__('SubTitle Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .contact-style-one-info p',
			]
		);

		$this->add_control(
			'info_title_option',
			[
				'label' 		=> esc_html__('Info Title Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'info_title_color',
			[
				'label' 		=> esc_html__('Info Title Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-style-one-info li h5' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'info_title_typography',
				'label' 		=> esc_html__('Info Title Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .contact-style-one-info li h5',
			]
		);

		$this->add_control(
			'info_content_option',
			[
				'label' 		=> esc_html__('Info Content Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'info_content_color',
			[
				'label' 		=> esc_html__('Info Content Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .contact-style-one-info li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'info_content_typography',
				'label' 		=> esc_html__('Info Content Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .contact-style-one-info li a',
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render()
	{
		$agrul_contact_info_output = $this->get_settings_for_display();
?>
		<!-- Start Contact Info Area
    ============================================= -->
		<div class="col-tact-stye-one">
			<div class="contact-style-one-info">
				<h2>
					<?php echo esc_html($agrul_contact_info_output['title']); ?>
				</h2>
				<p>
					<?php echo esc_html($agrul_contact_info_output['content']); ?>
				</p>
				<ul>
					<?php foreach ($agrul_contact_info_output['contact_info_list'] as $single_contact_info) : ?>
						<li class="wow fadeInUp">
							<div class="icon">
								<?php if (!empty($single_contact_info['flat_icon'])) : ?>
									<i class="<?php echo esc_attr($single_contact_info['flat_icon']); ?>"></i>
								<?php endif; ?>
								<?php if (!empty($single_contact_info['icon_image'])) : ?>
									<img src="<?php echo esc_url($single_contact_info['icon_image']['url']); ?>" alt="<?php echo get_bloginfo('name'); ?>">
								<?php endif; ?>
								<?php
								if (!empty($single_contact_info['custom_icon'])) : ?>
									<i class="<?php echo esc_attr($single_contact_info['custom_icon']); ?>"></i>
								<?php endif; ?>
							</div>
							<div class="content">
								<h5 class="title"><?php echo esc_html($single_contact_info['title']); ?></h5>
								<a href="<?php echo esc_url($single_contact_info['contact_info_url']['url']); ?>"><?php echo htmlspecialchars_decode(esc_html($single_contact_info['info'])); ?></a>
							</div>
						</li>
					<?php endforeach ?>

				</ul>
			</div>
		</div>
		<!-- End Contact Info  Area -->
<?php
	}
}
