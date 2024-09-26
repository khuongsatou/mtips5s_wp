<?php

/**
 * Elementor Agrul About Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Agrul_About_Content_Widget extends \Elementor\Widget_Base
{

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
	public function get_name()
	{
		return 'agrul_about_content';
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
	public function get_title()
	{
		return esc_html__('About Content', 'agrul-core');
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
	public function get_icon()
	{
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
	public function get_categories()
	{
		return ['agrul_elements'];
	}

	// Add The Input For User
	protected function register_controls()
	{

		$this->start_controls_section(
			'about_content_style',
			[
				'label'		=> esc_html__('About Content Style', 'agrul-core'),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__('Style', 'agrul-core'),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__('Style One', 'agrul-core'),
					'2' 	=> esc_html__('Style Two', 'agrul-core'),
					'3' 	=> esc_html__('Style Three', 'agrul-core'),
				],
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
			'subtitle',
			[
				'label' 		=> esc_html__('Sub-Title', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' => [
					'style' => '1'
				]
			]
		);

		$this->add_control(
			'content',
			[
				'label' 		=> esc_html__('Content', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::WYSIWYG,
				'label_block' 	=> true,
				'rows' 			=> 7,
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
			'subtitle',
			[
				'label' 		=> esc_html__('Subtitle', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'feature_url',
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
			'feature_list',
			[
				'label' 	=> esc_html__('Feature', 'agrul-core'),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__('Add Feature', 'agrul-core'),
					],
				],
				'title_field' => '{{{ title }}}',
				'condition' => [
					'style' => '1'
				]
			]
		);

		$tab_list = new \Elementor\Repeater();

		$tab_list->add_control(
			'title',
			[
				'label' 		=> esc_html__('Tab Title', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$tab_list->add_control(
			'content',
			[
				'label' 		=> esc_html__('Content', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$tab_list->add_control(
			'icon_style',
			[
				'label' 	=> esc_html__('Contact Icon Style', 'agrul-core'),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__('Flaticon', 'agrul-core'),
					'3' 	=> esc_html__('Icon Image', 'agrul-core'),
					'2'  	=> esc_html__('Custom Icon', 'agrul-core'),
				],
			]
		);

		$tab_list->add_control(
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

		$tab_list->add_control(
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


		$tab_list->add_control(
			'icon_image',
			[
				'label'			=> esc_html__('Add Image Icon', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_style' => '3'
				]
			]
		);

		$tab_list->add_control(
			'contact_info',
			[
				'label' 		=> esc_html__('Contact Info', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'tab_list',
			[
				'label' 	=> esc_html__('Tab List', 'agrul-core'),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $tab_list->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__('Add Tab List', 'agrul-core'),
					],
				],
				'title_field' => '{{{ title }}}',
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'experinace_title',
			[
				'label' 		=> esc_html__('Experinace Text', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows'          => '2',
				'default' => esc_html__('Experinace Text', 'agrul-core'),
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'layout_three_bg_one',
			[
				'label'			=> esc_html__('Background Image One', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'layout_three_bg_two',
			[
				'label'			=> esc_html__('Background Image Two', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'layout_three_shape',
			[
				'label'			=> esc_html__('Shape One', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' 		=> esc_html__('Button Text', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows'          => '2',
				'default' => esc_html__('Button Text', 'agrul-core'),
				'condition' => [
					'style' => '2'
				]
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' 		=> esc_html__('Button URL', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'agrul-core'),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
				'condition' => [
					'style' => '2'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'about_style_option',
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
				'condition' 	=> ['style' => ['1', '2']],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__('Title Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .heading, {{WRAPPER}} .about-style-two h2' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1', '2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__('Title Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .heading,{{WRAPPER}} .about-style-two h2',
				'condition' 	=> ['style' => ['1', '2']],
			]
		);

		$this->add_control(
			'description_option',
			[
				'label' 		=> esc_html__('Description Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1', '2']],
			]
		);
		$this->add_control(
			'description_color',
			[
				'label' 		=> esc_html__('Description Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .about-style-one p, {{WRAPPER}} .about-style-two p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1', '2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'label' 		=> esc_html__('Description Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .about-style-one p,{{WRAPPER}} .about-style-two p',
				'condition' 	=> ['style' => ['1', '2']],
			]
		);

		$this->add_control(
			'check_list_option',
			[
				'label' 		=> esc_html__('Check List Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1', '2']],
			]
		);
		$this->add_control(
			'check_list_color',
			[
				'label' 		=> esc_html__('Check List Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .check-solid-list li,{{WRAPPER}} .about-style-two .info li' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1', '2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'check_list_typography',
				'label' 		=> esc_html__('Check List Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .check-solid-list li,{{WRAPPER}} .about-style-two .info li',
				'condition' 	=> ['style' => ['1', '2']],
			]
		);

		$this->add_control(
			'feature_title_option',
			[
				'label' 		=> esc_html__('Feature Title Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_control(
			'feature_title_color',
			[
				'label' 		=> esc_html__('Feature Title Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .top-product-item a' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'feature_title_typography',
				'label' 		=> esc_html__('Feature Title Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .top-product-item a',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'feature_content_option',
			[
				'label' 		=> esc_html__('Feature Content Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_control(
			'feature_content_color',
			[
				'label' 		=> esc_html__('Feature Content Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .top-product-item p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['1']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'feature_content_typography',
				'label' 		=> esc_html__('Feature Content Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .top-product-item p',
				'condition' 	=> ['style' => ['1']],
			]
		);

		$this->add_control(
			'button_option',
			[
				'label' 		=> esc_html__('Button Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> esc_html__('Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' 		=> esc_html__('Background Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary' => 'background-color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> esc_html__('Hover Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary:hover' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' 		=> esc_html__('Hover Background Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary::after' => 'background-color: {{VALUE}}',
				],
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> esc_html__('Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .btn.btn-theme.secondary',
				'condition' 	=> ['style' => ['2']],
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render()
	{
		$agrul_about_content_output = $this->get_settings_for_display();
		if ($agrul_about_content_output['style'] == '1') :
?>
			<div class="about-style-one">
				<div class="row align-center">
					<div class="col-xl-7 col-lg-12">
						<?php if ($agrul_about_content_output['title']) : ?>
							<h2 class="heading"><?php echo htmlspecialchars_decode(esc_html($agrul_about_content_output['title'], 'agrul-core')); ?></h2>
						<?php endif; ?>
						<?php if ($agrul_about_content_output['subtitle']) : ?>
							<p>
								<?php echo htmlspecialchars_decode(esc_html($agrul_about_content_output['subtitle'], 'agrul-core')); ?>
							</p>
						<?php endif; ?>
						<?php if ($agrul_about_content_output['content']) : ?>
							<?php echo htmlspecialchars_decode(esc_html($agrul_about_content_output['content'], 'agrul-core')); ?>
						<?php endif; ?>
					</div>

					<div class="col-xl-5 col-lg-12 pl-50 pl-md-15 pl-xs-15">
						<?php foreach ($agrul_about_content_output['feature_list'] as $single_feature) : ?>
							<div class="top-product-item">
								<?php if (!empty($single_feature['flat_icon'])) : ?>
									<i class="<?php echo esc_attr($single_feature['flat_icon']); ?>"></i>
								<?php endif; ?>
								<?php if (!empty($single_feature['icon_image'])) : ?>
									<img src="<?php echo esc_url($single_feature['icon_image']['url']); ?>" alt="<?php echo get_bloginfo('name'); ?>">
								<?php endif; ?>
								<?php
								if (!empty($single_feature['custom_icon'])) : ?>
									<i class="<?php echo esc_attr($single_feature['custom_icon']); ?>"></i>
								<?php endif; ?>
								<h5><a href="#"><?php echo esc_html($single_feature['title']); ?></a></h5>
								<p>
									<?php echo esc_html($single_feature['subtitle']); ?>
								</p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php elseif ($agrul_about_content_output['style'] == '2') : ?>
			<div class="about-style-two">
				<div class="info">
					<?php if ($agrul_about_content_output['title']) : ?>
						<h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_about_content_output['title'], 'agrul-core')); ?></h2>
					<?php endif; ?>
					<?php if ($agrul_about_content_output['content']) : ?>
						<?php echo htmlspecialchars_decode(esc_html($agrul_about_content_output['content'], 'agrul-core')); ?>
					<?php endif; ?>
					<?php if (!empty($agrul_about_content_output['button_text'])) : ?>
						<a class="btn btn-theme mt-30 secondary btn-md radius animation" href="<?php echo esc_url($agrul_about_content_output['button_url']['url']); ?>"><?php echo esc_html($agrul_about_content_output['button_text']); ?></a>
					<?php endif; ?>

				</div>
			</div>

		<?php elseif ($agrul_about_content_output['style'] == '3') : ?>

			<!-- Start About Five 
    ============================================= -->
			<div class="about-style-four-area default-padding" style="background-image: url(<?php echo esc_url($agrul_about_content_output['layout_three_shape']['url']); ?>);">
				<div class="container">
					<div class="row align-center">
						<div class="col-lg-6">
							<div class="about-four-thumb">
								<?php
								if (!empty($agrul_about_content_output['layout_three_bg_one']['url'])) :
									echo agrul_img_tag(array(
										'url'   => esc_url($agrul_about_content_output['layout_three_bg_one']['url'])
									));
								endif;
								if (!empty($agrul_about_content_output['layout_three_bg_one']['url'])) :
									echo agrul_img_tag(array(
										'url'   => esc_url($agrul_about_content_output['layout_three_bg_two']['url'])
									));
								endif;
								?>
								<div class="experience">
									<h2> <?php echo htmlspecialchars_decode(esc_html($agrul_about_content_output['experinace_title'], 'agrul-core')); ?></h2>
								</div>
							</div>
						</div>
						<div class="col-lg-5 offset-lg-1">
							<div class="about-four-info">
								<h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_about_content_output['title'], 'agrul-core')); ?></h2>

								<!-- Tab Nav -->
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
									<?php
									$counter = 1;
									foreach ($agrul_about_content_output['tab_list'] as $single_tab) : ?>
										<button class="nav-link <?php if ($counter == '1') {
																	echo esc_attr("active");
																} ?>" id="<?php echo esc_attr($single_tab['title']); ?>-tab-control" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr($single_tab['title']); ?>-tab" type="button" role="tab" aria-controls="<?php echo esc_attr($single_tab['title']); ?>-tab" aria-selected="true">
											<?php echo htmlspecialchars_decode(esc_html($single_tab['title'], 'agrul-core')); ?>
										</button>
									<?php $counter++;
									endforeach; ?>
								</div>
								<!-- End Tab Nav -->

								<!-- Start Tab Content -->
								<div class="tab-content about-tab-items" id="myTabContent">

									<?php
									$counter = 1;
									foreach ($agrul_about_content_output['tab_list'] as $single_tab) : ?>
										<!-- Tab Single -->
										<div class="tab-pane fade <?php if ($counter == '1') {
																		echo esc_attr("show active");
																	} ?>" id="<?php echo esc_attr($single_tab['title']); ?>-tab" role="tabpanel" aria-labelledby="<?php echo esc_attr($single_tab['title']); ?>-tab-control">
											<div class="row">
												<div class="col-lg-12">
													<?php echo htmlspecialchars_decode(esc_html($single_tab['content'], 'agrul-core')); ?>
													<div class="call-us">
														<div class="icon">
															<?php if (!empty($single_tab['flat_icon'])) : ?>
																<i class="<?php echo esc_attr($single_tab['flat_icon']); ?>"></i>
															<?php endif; ?>
															<?php if (!empty($single_tab['icon_image'])) : ?>
																<img src="<?php echo esc_url($single_tab['icon_image']['url']); ?>" alt="<?php echo get_bloginfo('name'); ?>">
															<?php endif; ?>
															<?php
															if (!empty($single_tab['custom_icon'])) : ?>
																<i class="<?php echo esc_attr($single_tab['custom_icon']); ?>"></i>
															<?php endif; ?>
														</div>
														<div class="info">
															<?php echo htmlspecialchars_decode(esc_html($single_tab['contact_info'], 'agrul-core')); ?>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- End Single -->
									<?php $counter++;
									endforeach; ?>
								</div>
								<!-- End Tab Content -->

							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End About Five -->
<?php
		endif;
	}
}
