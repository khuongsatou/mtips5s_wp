<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;

/**
 *
 * Banner Widget .
 *
 */
class Agrul_Banner extends Widget_Base
{

	public function get_name()
	{
		return 'agrulbanner';
	}

	public function get_title()
	{
		return __('Banner', 'agrul-core');
	}

	public function get_icon()
	{
		return 'eicon-code';
	}

	public function get_categories()
	{
		return ['agrul_header_elements'];
	}

	protected function register_controls()
	{

		$this->start_controls_section(
			'Banner_section',
			[
				'label' 	=> __('Banner', 'agrul-core'),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'banner_style',
			[
				'label' 		=> __('Banner Style', 'agrul-core'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __('Style One', 'agrul-core'),
					'2' 		=> __('Style Two', 'agrul-core'),
					'3' 		=> __('Style Three', 'agrul-core'),
					'4' 		=> __('Style Four', 'agrul-core'),
					'5' 		=> __('Style Five', 'agrul-core'),
				],
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' 		=> __('Title', 'agrul-core'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' 		=> __('Subtitle', 'agrul'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 3,
				'label_block' 	=> true,
			]
		);
		$repeater->add_control(
			'des',
			[
				'label' 		=> __('Description', 'agrul'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 4,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'slider_image',
			[
				'label' 		=> __('Slider Image', 'agrul'),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' 	=> __('Button Text', 'agrul'),
				'type' 		=> Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default'  	=> __('Button Text', 'agrul')
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label' 		=> __('Link', 'agrul'),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'agrul'),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->add_control(
			'sliders',
			[
				'label' 		=> __('Sliders', 'agrul'),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{{ title }}}',
				'condition' => [
					'banner_style' => ['1','5']
				]
			]
		);



		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' 		=> __('Title', 'evona'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'des',
			[
				'label' 		=> __('Description', 'evona'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 4,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'slider_image',
			[
				'label' 		=> __('Slider Image', 'agrul'),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' 	=> __('Button Text', 'agrul'),
				'type' 		=> Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default'  	=> __('Button Text', 'agrul')
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label' 		=> __('Link', 'agrul'),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'agrul'),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->add_control(
			'sliders_two',
			[
				'label' 		=> __('Sliders', 'agrul'),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{{ title }}}',
				'condition' => [
					'banner_style' => '2'
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' 		=> __('Title', 'evona'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'slider_image',
			[
				'label' 		=> __('Slider Image', 'agrul'),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' 	=> __('Button Text', 'agrul'),
				'type' 		=> Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default'  	=> __('Button Text', 'agrul')
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label' 		=> __('Link', 'agrul'),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'agrul'),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->add_control(
			'sliders_three',
			[
				'label' 		=> __('Sliders', 'agrul'),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{{ title }}}',
				'condition' => [
					'banner_style' => '3'
				]
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'bac_shape',
			[
				'label'			=> esc_html__('Add Shape', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'shape_list',
			[
				'label' 	=> esc_html__('Shape List', 'agrul-core'),
				'type' 		=> \Elementor\Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default' 	=> [
					[
						'list_title' => esc_html__('Add Shape', 'agrul-core'),
					],
				],
				'condition' => [
					'banner_style' => '2'
				]
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' 		=> __('Title', 'evona'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'subtitle',
			[
				'label' 		=> __('Subtitle', 'evona'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 3,
				'label_block' 	=> true,
			]
		);

		$repeater->add_control(
			'slider_image',
			[
				'label' 		=> __('Slider Image', 'agrul'),
				'type' 			=> Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label' 	=> __('Button Text', 'agrul'),
				'type' 		=> Controls_Manager::TEXTAREA,
				'rows' 		=> 2,
				'default'  	=> __('Button Text', 'agrul')
			]
		);
		$repeater->add_control(
			'button_link',
			[
				'label' 		=> __('Link', 'agrul'),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __('https://your-link.com', 'agrul'),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

		$this->add_control(
			'sliders_four',
			[
				'label' 		=> __('Sliders', 'agrul'),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{{ title }}}',
				'condition' => [
					'banner_style' => '4'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_style_option',
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
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__('Title Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .banner-style-one h2, {{WRAPPER}}  .banner-style-two .content h2,{{WRAPPER}} .banner-style-three h2' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__('Title Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .banner-style-one h2, {{WRAPPER}}  .banner-style-two .content h2, ,{{WRAPPER}} .banner-style-three h2',
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);

		$this->add_control(
			'highligted_title_option',
			[
				'label' 		=> esc_html__('Highligted Title Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['banner_style' => ['1', '2']],
			]
		);
		$this->add_control(
			'highligted_title_color',
			[
				'label' 		=> esc_html__('Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .banner-style-one h2 strong,{{WRAPPER}} .banner-style-two .content h2 strong' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['banner_style' => ['1', '2']],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'highligted_title_typography',
				'label' 		=> esc_html__('Title Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .banner-style-one h2 strong, {{WRAPPER}} .banner-style-two .content h2 strong',
				'condition' 	=> ['banner_style' => ['1', '2']],
			]
		);

		$this->add_control(
			'subtitle_option',
			[
				'label' 		=> esc_html__('Sub-Title Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['banner_style' => ['1', '2']],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' 		=> esc_html__('Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .banner-style-one h4,{{WRAPPER}} .banner-style-two .content p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['banner_style' => ['1', '2']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtitle_typography',
				'label' 		=> esc_html__('Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .banner-style-one h4,,{{WRAPPER}} .banner-style-two .content p',
				'condition' 	=> ['banner_style' => ['1', '2']],
			]
		);

		$this->add_control(
			'descroption_option',
			[
				'label' 		=> esc_html__('Descroption Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['banner_style' => ['1']],
			]
		);

		$this->add_control(
			'descroption_color',
			[
				'label' 		=> esc_html__('Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .banner-style-one p' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['banner_style' => ['1']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'descroption_typography',
				'label' 		=> esc_html__('Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .banner-style-one p',
				'condition' 	=> ['banner_style' => ['1']],
			]
		);

		$this->add_control(
			'button_option',
			[
				'label' 		=> esc_html__('Button Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> esc_html__('Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary,{{WRAPPER}} .banner-style-two .content .animated-btn' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
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
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> esc_html__('Hover Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .text-light .btn.btn-theme.secondary::after' => 'color: {{VALUE}}',
				],
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' 		=> esc_html__('Hover Background Color', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .text-light .btn.btn-theme.secondary::after' => 'background-color: {{VALUE}}',
				],
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> esc_html__('Typography', 'agrul-core'),
				'selector' 		=> '{{WRAPPER}} .btn.btn-theme.secondary',
				'condition' 	=> ['banner_style' => ['1', '2', '3']],
			]
		);


		$this->end_controls_section();
	}

	protected function render()
	{

		$agrul_sliders = $this->get_settings_for_display();

		if ($agrul_sliders['banner_style'] == '1') { ?>
			<!-- Start Banner Area One
	    ============================================= -->
			<div class="banner-area navigation-circle text-light banner-style-one zoom-effect overflow-hidden">
				<!-- Slider main container -->
				<div class="banner-fade">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<?php foreach ($agrul_sliders['sliders'] as $single_slider) : ?>
							<!-- Single Item -->
							<div class="swiper-slide banner-style-one">
								<div class="banner-thumb bg-cover shadow dark" style="background: url(<?php echo esc_url($single_slider['slider_image']['url']); ?>);"></div>
								<div class="container">
									<div class="row align-center">
										<div class="col-xl-7">
											<div class="content">
												<h4><?php echo htmlspecialchars_decode(esc_html($single_slider['title'], 'agrul-core')); ?></h4>
												<h2><?php echo htmlspecialchars_decode(esc_html($single_slider['subtitle'], 'agrul-core')); ?></h2>
												<p>
													<?php echo htmlspecialchars_decode(esc_html($single_slider['des'], 'agrul-core')); ?>
												</p>
												<?php if (!empty($single_slider['button_text'])) : ?>
													<div class="button">
														<a class="btn btn-theme secondary btn-md radius animation" href="<?php echo esc_url($single_slider['button_link']['url']); ?>"><?php echo esc_html($single_slider['button_text']); ?></a>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Item -->
						<?php endforeach; ?>

					</div>

					<!-- Navigation -->
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>

				</div>
			</div>
			<!-- End Main -->

		<?php } elseif ($agrul_sliders['banner_style'] == '2') { ?>

			<!-- Start Banner Area Style Two
	    ============================================= -->
			<div class="banner-area banner-style-two text-center navigation-custom-large zoom-effect overflow-hidden text-light">
				<!-- Slider main container -->
				<div class="banner-fade">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<?php foreach ($agrul_sliders['sliders_two'] as $single_slider) : ?>
							<!-- Single Item -->
							<div class="swiper-slide banner-style-two">
								<div class="banner-thumb bg-cover shadow dark" style="background: url(<?php echo esc_url($single_slider['slider_image']['url']); ?>);"></div>
								<div class="container">
									<div class="row align-center">
										<div class="col-lg-8 offset-lg-2">
											<div class="content">
												<h2><?php echo htmlspecialchars_decode(esc_html($single_slider['title'], 'agrul-core')); ?></h2>
												<p>
													<?php echo htmlspecialchars_decode(esc_html($single_slider['des'], 'agrul-core')); ?>
												</p>
												<div class="button">
													<a class="animated-btn" href="<?php echo esc_url($single_slider['button_link']['url']); ?>"><i class="fas fa-angle-right"></i><?php echo esc_html($single_slider['button_text']); ?></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="shape-animation">
									<?php foreach ($agrul_sliders['shape_list'] as $single_slider_two) :
										if (!empty($single_slider_two['bac_shape']['url'])) :
									?>
											<div class="item">
												<?php echo agrul_img_tag(array('url'   => esc_url($single_slider_two['bac_shape']['url'])));
												?>
											</div>
									<?php endif;
									endforeach; ?>
								</div>
							</div>
							<!-- End Single Item -->
						<?php endforeach; ?>
					</div>

					<!-- Pagination -->
					<div class="swiper-pagination"></div>

				</div>
			</div>
			<!-- End Banner Style Two-->
		<?php } elseif ($agrul_sliders['banner_style'] == '3') { ?>
			<!-- Start Banner Style Three
		    ============================================= -->
			<div class="banner-area navigation-circle text-light text-center banner-style-three-area zoom-effect overflow-hidden">
				<!-- Slider main container -->
				<div class="banner-fade">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<?php foreach ($agrul_sliders['sliders_three'] as $single_slider_three) : ?>
							<!-- Single Item -->
							<div class="swiper-slide banner-style-three">
								<div class="banner-thumb bg-cover shadow dark" style="background: url(<?php echo esc_url($single_slider_three['slider_image']['url']); ?>);"></div>
								<div class="container">
									<div class="row align-center">
										<div class="col-lg-10 offset-lg-1">
											<div class="content">
												<h2><?php echo htmlspecialchars_decode(esc_html($single_slider_three['title'], 'agrul-core')); ?></h2>
												<div class="button">
													<a class="btn btn-theme secondary btn-md radius animation" href="<?php echo esc_url($single_slider_three['button_link']['url']); ?>"><?php echo esc_html($single_slider_three['button_text']); ?></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Item -->
						<?php endforeach; ?>

					</div>

					<!-- Navigation -->
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>

				</div>
			</div>
			<!-- End Banner Style Three -->

		<?php } elseif ($agrul_sliders['banner_style'] == '4') { ?>

			<!-- Start Banner Style Four
   			============================================= -->
			<div class="banner-area banner-shop navigation-custom-large zoom-effect overflow-hidden text-light">
				<!-- Slider main container -->
				<div class="banner-fade">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
						<?php foreach ($agrul_sliders['sliders_four'] as $single_slider_four) : ?>

							<!-- Single Item -->
							<div class="swiper-slide banner-shop-item">
								<div class="banner-thumb bg-cover" style="background: url(<?php echo esc_url($single_slider_four['slider_image']['url']); ?>);"></div>
								<div class="container">
									<div class="row align-center">
										<div class="col-lg-7">
											<div class="content">
												<h4><?php echo htmlspecialchars_decode(esc_html($single_slider_four['subtitle'], 'agrul-core')); ?></h4>
												<h2><?php echo htmlspecialchars_decode(esc_html($single_slider_four['title'], 'agrul-core')); ?></h2>
												<?php if (!empty($single_slider_four['button_text'])) : ?>
													<div class="button">
														<a class="btn btn-theme secondary btn-sm radius animation" href="<?php echo esc_url($single_slider_four['button_link']['url']); ?>"><?php echo esc_html($single_slider_four['button_text']); ?> <i class="fas fa-arrow-right"></i></a>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Single Item -->

						<?php endforeach; ?>

					</div>

					<!-- Pagination -->
					<div class="swiper-pagination"></div>

				</div>
			</div>
			<!-- End Banner Style Four -->

		<?php } elseif ($agrul_sliders['banner_style'] == '5') { ?>

			<!-- Start Banner Area 
		    ============================================= -->
		    <div class="banner-area navigation-circle text-light zoom-effect overflow-hidden">
		        <!-- Slider main container -->
		        <div class="banner-fade">
		            <!-- Additional required wrapper -->
		            <div class="swiper-wrapper">
					<?php foreach ($agrul_sliders['sliders'] as $single_slider_five) : ?>
		                
		                <!-- Single Item -->
		                <div class="swiper-slide banner-style-four">
		                    <div class="banner-thumb bg-cover shadow dark" style="background: url(<?php echo esc_url($single_slider_five['slider_image']['url']); ?>);"></div>
		                    <div class="container">
		                        <div class="row align-center">
		                            <div class="col-xl-7 offset-xl-5">
		                                <div class="content">
		                                    <h4><?php echo htmlspecialchars_decode(esc_html($single_slider_five['subtitle'], 'agrul-core')); ?></h4>
		                                    <h2><?php echo htmlspecialchars_decode(esc_html($single_slider_five['title'], 'agrul-core')); ?></h2>
		                                    <p>
		                                        <?php echo htmlspecialchars_decode(esc_html($single_slider_five['des'], 'agrul-core')); ?>
		                                    </p>
		                                    <?php if (!empty($single_slider_five['button_text'])) : ?>
			                                    <div class="button">
			                                        <a class="btn btn-theme secondary btn-md radius animation" href="<?php echo esc_url($single_slider_five['button_link']['url']); ?>"><?php echo esc_html($single_slider_five['button_text']); ?></a>
			                                    </div>
		                                	<?php endif;?>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <!-- End Single Item -->

		            <?php endforeach; ?>

		            </div>

		            <!-- Navigation -->
		            <div class="swiper-button-prev"></div>
		            <div class="swiper-button-next"></div>

		        </div>        
		    </div>
		    <!-- End Banner -->
<?php
		}
	}
}
