<?php
namespace TrxAddons\ElementorTemplates\Globals;

defined( 'ABSPATH' ) || exit;

use TrxAddons\ElementorTemplates\Utils;
// use TrxAddons\ElementorTemplates\Options;

use Elementor\Core\Base\Module;
use Elementor\Controls_Stack;

// use Elementor\Controls_Manager;
// use Elementor\Core\Kits\Controls\Repeater as Global_Style_Repeater;
// use Elementor\Core\Settings\Manager;
// use Elementor\Element_Base;
// use Elementor\Repeater;

/**
 * Class Colors.
 */
class ColorsEditor extends Module {

	var $color_prefix = 'theme_color_';		// Elementor is don't support the defis in the global names
	var $scheme_prefix = 'trx_addons_global_colors_scheme_';
	var $elementor_kit_settings_meta_key = '_elementor_page_settings';
	var $elementor_kit_css_meta_key = '_elementor_css';

	/**
	 * Colors constructor.
	 */
	public function __construct() {

		add_action( 'elementor/element/kit/section_buttons/after_section_end', array( $this, 'register_global_colors' ), 10, 2 );
		add_filter( 'elementor/documents/ajax_save/return_data', array( $this, 'save_global_colors' ), 10, 2 );

		// Uncomment to reset global colors (dev only)
		// add_action( 'init', array( $this, 'reset_global_colors' ) );

		$theme_slug = str_replace( '-', '_', get_template() );

		if ( trx_addons_exists_elementor() ) {
			// Add CSS variables to the theme styles
			// add_filter( "{$theme_slug}_filter_get_css", array( $this, 'add_css_vars' ), 10, 2 );

			// Update global colors after theme options save
			add_action( "{$theme_slug}_action_just_save_options", array( $this, 'update_global_colors_after_theme_options_save' ), 10, 1 );
		}



		// Legacy feature ( Accent Colors ) - deprecated to be removed.
		// add_action( 'elementor/element/kit/section_buttons/after_section_end', array( $this, 'register_color_settings' ), 300, 2 );
		
		// Tweak default Elementor widgets.
		// add_action( 'elementor/element/divider/section_divider_style/before_section_end', array( $this, 'tweak_divider_style' ) );
		// add_action( 'elementor/element/icon-box/section_style_content/before_section_end', array( $this, 'tweak_icon_box' ) );
		// add_action( 'elementor/element/image-box/section_style_content/before_section_end', array( $this, 'tweak_image_box' ) );
		// add_action( 'elementor/element/heading/section_title_style/before_section_end', array( $this, 'tweak_heading' ) );
		// add_action( 'elementor/element/nav-menu/section_style_main-menu/before_section_end', array( $this, 'tweak_nav_menu' ) );
		// add_action( 'elementor/element/kit/section_buttons/after_section_end', array( $this, 'tweak_theme_style_button' ), 20, 2 );
		// add_action( 'elementor/element/kit/section_typography/after_section_end', array( $this, 'tweak_theme_style_typography' ), 20, 2 );
	}

	/**
	 * Get module name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'trx-addons-colors';
	}

	/**
	 * Get label tooltip.
	 *
	 * @param string $text  Tooltip text.
	 *
	 * @return string  Tooltip HTML.
	 */
	protected function get_tooltip( $text ) {
		return ' <span class="hint--top-right hint--medium" aria-label="' . $text . '"><i class="fa fa-info-circle"></i></span>';
	}

	/**
	 * Register Global Color controls for theme-specific color schemes.
	 *
	 * @param Controls_Stack $element Controls object.
	 * @param string         $section_id Section ID.
	 */
	public function register_global_colors( Controls_Stack $element, $section_id ) {

		if ( ! is_object( $element ) ) {
			return;
		}
		
		// Get the theme options
		$schemes = trx_addons_get_theme_color_schemes();
		if ( empty( $schemes ) || ! is_array( $schemes ) ) {
			return;
		}
		$default_scheme = trx_addons_get_theme_option( 'color_scheme', 'default' );

		$element->start_controls_section( 'trx_addons_global_colors_section', array(
			'label' => esc_html__( 'Theme Colors', 'trx_addons' ),
			'tab'   => 'global-colors',
		) );

		$element->add_control( 'trx_addons_global_colors_description', array(
			'raw'             => __( 'You can edit color schemes also in adminmenu "Theme Panel - Theme Options - Colors" or in "Appearance - Сustomizer".', 'trx_addons' ),
			'type'            => \Elementor\Controls_Manager::RAW_HTML,
			'content_classes' => 'elementor-descriptor',
		) );

		$element->start_controls_tabs( 'trx_addons_global_colors_section_tabs', array(
			'separator' => 'before',
		) );

		foreach( $schemes as $scheme => $data ) {

			// Show colors for the current scheme only
			if ( $scheme != $default_scheme ) {
				continue;
			}

			$element->start_controls_tab(
				'trx_addons_tab_global_colors_' . $scheme,
				array( 'label' => $data['title'] )
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control( 'title', array(
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'required'    => true,
			) );

			// Color Value
			$repeater->add_control( 'color', array(
				'type'        => \Elementor\Controls_Manager::COLOR,
				'label_block' => true,
				'dynamic'     => array(),
				'selectors'   => array(
					'{{WRAPPER}}' => '--e-global-color-{{_id.VALUE}}: {{VALUE}}',
//					'{{WRAPPER}}' => '--{{_id.VALUE}}: {{VALUE}}',
				),
				'global'      => array(
					'active' => false,
				),
			) );

			// Scheme Colors
			$scheme_colors = array();
			foreach ( $data['colors'] as $key => $value ) {
				$scheme_colors[] = array(
					'_id'   => $this->color_prefix . $key,
					'title' => ucfirst( str_replace( '_', ' ', $key ) ),
					'color' => $value,
				);
			}

			$element->add_control( $this->scheme_prefix . $scheme, array(
				'type'         => \Elementor\Core\Kits\Controls\Repeater::CONTROL_TYPE,
				'fields'       => $repeater->get_controls(),
				'default'      => $scheme_colors,
				'item_actions' => array(
					'add'    => false,
					'remove' => false,
					'sort'   => false,

				),
				'separator'    => 'after',
			) );

			$element->end_controls_tab();
		}

		$element->end_controls_tabs();

		$element->add_control( 'trx_addons_global_reset_colors', array(
			'label' => __( 'Reset labels & colors', 'trx_addons' ),
			'type'  => 'button',
			'text'  => __( 'Reset', 'trx_addons' ),
			'event' => 'trx_addons_elementor_extension:resetGlobalColors',
		) );

		$element->end_controls_section();
	}

	// Save Page Options via AJAX from Elementor Editor
	// (called when any option is changed)
	public function save_global_colors( $response_data, $document ) {
		$post_id = $document->get_main_id();
		if ( $post_id > 0 ) {
			$actions = json_decode( basekit_get_value_gp( 'actions' ), true );
			if ( is_array( $actions ) && isset( $actions['save_builder']['data']['settings'] ) && is_array( $actions['save_builder']['data']['settings'] ) ) {
				$settings = $actions['save_builder']['data']['settings'];
				if ( is_array( $settings ) ) {
					$schemes = trx_addons_get_theme_color_schemes();
					$updated = false;
					if ( ! empty( $schemes ) && is_array( $schemes ) ) {
						foreach( $schemes as $scheme => $data ) {
							if ( ! empty( $data['colors'] ) && is_array( $data['colors'] ) && isset( $settings[ $this->scheme_prefix . $scheme ] ) && is_array( $settings[ $this->scheme_prefix . $scheme ] ) ) {
								foreach ( $settings[ $this->scheme_prefix . $scheme ] as $color ) {
									$color_id = str_replace( $this->color_prefix, '', $color['_id'] );
									if ( isset( $color['color'] ) && isset( $data['colors'][ $color_id ] ) && $color['color'] != $data['colors'][ $color_id ] ) {
										$schemes[ $scheme ]['colors'][ $color_id ] = $color['color'];
										$updated = true;
									}
								}
							}
						}
						// If the colors were updated - save them in the theme options
						if ( $updated ) {
							$options = trx_addons_get_theme_options();
							$options['scheme_storage'] = serialize( $schemes );
							trx_addons_update_theme_options( $options, true );
						}
					}			
				}
			}
		}
		return $response_data;
	}

	// Add Elementor-specific colors to the theme custom CSS
	function add_css_vars( $css, $args ) {
		if ( isset( $css['colors'] ) && isset( $args['colors'] ) ) {
			$colors = $args['colors'];
			if ( is_array( $colors ) && count( $colors ) > 0 ) {
				$tmp = ".scheme_{$args['scheme']}, body.scheme_{$args['scheme']} {\n";
				foreach ( $colors as $color => $value ) {
					$tmp .= "--e-global-color-{$this->color_prefix}{$color}: {$value};\n";
				}
				$css['colors'] = $tmp . "\n}\n" . $css['colors'];
			}
		}
		return $css;
	}

	/**
	 * Reset global colors in the default Elementor's kit
	 */
	public function reset_global_colors() {
		$remove_keys = array(
			'ang_global_',
			'trx_addons_global_',
		);
		$kit_id = \Elementor\Plugin::instance()->kits_manager->get_active_id();
		if ( ! empty( $kit_id ) ) {
			$meta = get_post_meta( $kit_id, $this->elementor_kit_settings_meta_key, true );
			if ( is_array( $meta ) ) {
				foreach ( $meta as $k => $v ) {
					foreach ( $remove_keys as $key ) {
						if ( strpos( $k, $key ) === 0 ) {
							unset( $meta[ $k ] );
						}
					}
				}
				update_post_meta( $kit_id, $this->elementor_kit_settings_meta_key, $meta );
			}
		}
	}

	/**
	 * Update global colors after theme options save
	 * 
	 * @hooked trx_addons_action_just_save_options
	 *
	 * @param array $values Theme options.
	 */
	public function update_global_colors_after_theme_options_save( $values ) {
		if ( ! empty( $values['scheme_storage'] ) ) {
			$schemes = trx_addons_unserialize( $values['scheme_storage'] );
			$default_scheme = ! empty( $values['color_scheme'] ) ? $values['color_scheme'] : 'default';
			if ( ! empty( $schemes[ $default_scheme ] ) ) {
				// Get the colors from the theme options and prepare them for the Elementor
				$new_colors = array();
				foreach ( $schemes[ $default_scheme ]['colors'] as $key => $value ) {
					$new_colors[] = array(
						'_id'   => $this->color_prefix . $key,
						'title' => ucfirst( str_replace( '_', ' ', $key ) ),
						'color' => $value,
					);
				}
				// Get the default Elementor's kit.
				// In this point we can't use the \Elementor\Plugin::instance()->kits_manager->get_active_id()
				// because the theme options are saved before the Elementor's kit is activated.
				$kit_id = Utils::get_active_kit_id();
				if ( ! empty( $kit_id ) ) {
					// Get settings from the default Elementor's kit
					$meta = get_post_meta( $kit_id, $this->elementor_kit_settings_meta_key, true );
					if ( isset( $meta[ $this->scheme_prefix . $default_scheme ] ) && is_array( $meta[ $this->scheme_prefix . $default_scheme ] ) ) {
						// If the settings are contain the global colors - update them
						$updated = false;
						foreach ( $new_colors as $color ) {
							foreach ( $meta[ $this->scheme_prefix . $default_scheme ] as $k => $v ) {
								if ( $color['_id'] == $v['_id'] ) {
									if ( $color['color'] != $v['color'] ) {
										$meta[ $this->scheme_prefix . $default_scheme ][ $k ] = $color;
										$updated = true;
									}
									break;
								}
							}
						}
					} else {
						// Add the new colors to the default Elementor's kit
						$meta[ $this->scheme_prefix . $default_scheme ] = $new_colors;
						$updated = true;
					}
					if ( $updated ) {
						// Save the updated settings
						update_post_meta( $kit_id, $this->elementor_kit_settings_meta_key, $meta );
						// Clear a kit CSS to apply the new colors
						update_post_meta( $kit_id, $this->elementor_kit_css_meta_key, '' );
					}
				}
			}
		}
	}

	/**
	 * Register Analog Color controls.
	 *
	 * @param Controls_Stack $element Elementor element.
	 * @param string         $section_id Section ID.
	 */
	// public function register_color_settings( Controls_Stack $element, $section_id ) {
	// 	$element->start_controls_section(
	// 		'ang_colors',
	// 		array(
	// 			'label' => _x( 'Accent Colors', 'Section Title', 'ang' ),
	// 			'tab'   => Utils::get_kit_settings_tab(),
	// 		)
	// 	);

	// 	$element->add_control(
	// 		'ang_colors_description',
	// 		array(
	// 			/* translators: %1$s: Link to documentation, %2$s: Link text. */
	// 			'raw'             => __( 'Set the accent colors of your layout.', 'ang' ) . sprintf( ' <a href="%1$s" target="_blank">%2$s</a>', 'https://analogwp.com/docs/style-kit-global-colors/', __( 'Learn more.', 'ang' ) ),
	// 			'type'            => Controls_Manager::RAW_HTML,
	// 			'content_classes' => 'elementor-descriptor',
	// 		)
	// 	);

	// 	$primary_accent_color_selectors = array(
	// 		'{{WRAPPER}} .sk-accent-1',
	// 		'{{WRAPPER}} .elementor-view-default .elementor-icon-box-icon .elementor-icon',
	// 		'{{WRAPPER}} .elementor-view-framed .elementor-icon-box-icon .elementor-icon',
	// 		'{{WRAPPER}} .elementor-icon-list-icon',
	// 		'{{WRAPPER}} .elementor-view-framed .elementor-icon',
	// 		'{{WRAPPER}} .elementor-view-default .elementor-icon',
	// 		'{{WRAPPER}} .sk-primary-accent',
	// 		'{{WRAPPER}} .sk-primary-accent.sk-primary-accent h1',
	// 		'{{WRAPPER}} .sk-primary-accent.sk-primary-accent h2',
	// 		'{{WRAPPER}} .sk-primary-accent.sk-primary-accent h3',
	// 		'{{WRAPPER}} .sk-primary-accent.sk-primary-accent h4',
	// 		'{{WRAPPER}} .sk-primary-accent.sk-primary-accent h5',
	// 		'{{WRAPPER}} .sk-primary-accent.sk-primary-accent h6',
	// 		'{{WRAPPER}} *:not(.menu-item):not(.elementor-tab-title):not(.elementor-image-box-title):not(.elementor-icon-box-title):not(.elementor-icon-box-icon):not(.elementor-post__title):not(.elementor-heading-title) > a:not(:hover):not(:active):not(.elementor-item-active):not([role="button"]):not(.button):not(.elementor-button):not(.elementor-post__read-more):not(.elementor-post-info__terms-list-item):not([role="link"])',
	// 		'{{WRAPPER}} a:not([class])',
	// 		'{{WRAPPER}} .elementor-tab-title.elementor-active',
	// 		'{{WRAPPER}} .elementor-post-info__terms-list-item',
	// 		'{{WRAPPER}} .elementor-post__title',
	// 		'{{WRAPPER}} .elementor-post__title a',
	// 		'{{WRAPPER}} .elementor-heading-title a',
	// 		'{{WRAPPER}} .elementor-post__read-more',
	// 		'{{WRAPPER}} .elementor-image-box-title a',
	// 		'{{WRAPPER}} .elementor-icon-box-icon a',
	// 		'{{WRAPPER}} .elementor-icon-box-title a',
	// 		'{{WRAPPER}} .elementor-nav-menu--main .elementor-nav-menu a:not(.elementor-sub-item)',
	// 		'{{WRAPPER}} .elementor-nav-menu--main .elementor-nav-menu .elementor-sub-item:not(:hover) a',
	// 		'{{WRAPPER}} .elementor-nav-menu--dropdown a',
	// 	);

	// 	$primary_accent_background_selectors = array(
	// 		'{{WRAPPER}} .elementor-view-stacked .elementor-icon',
	// 		'{{WRAPPER}} .elementor-progress-bar',
	// 		'{{WRAPPER}} .comment-form input#submit',
	// 		'{{WRAPPER}} .sk-primary-bg:not(.elementor-column)',
	// 		'{{WRAPPER}} .elementor-nav-menu--dropdown .elementor-item:hover',
	// 		'{{WRAPPER}} .elementor-nav-menu--dropdown .elementor-item.elementor-item-active',
	// 		'{{WRAPPER}} .elementor-nav-menu--dropdown .elementor-item.highlighted',
	// 		'{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item:before',
	// 		'{{WRAPPER}} .elementor-nav-menu--main:not(.e--pointer-framed) .elementor-item:after',
	// 		'{{WRAPPER}} .elementor-sub-item:hover',
	// 		'{{WRAPPER}} .sk-primary-bg.elementor-column > .elementor-element-populated',
	// 	);

	// 	$primary_accent_color_selectors      = implode( ',', $primary_accent_color_selectors );
	// 	$primary_accent_background_selectors = implode( ',', $primary_accent_background_selectors );

	// 	$selectors = array(
	// 		'{{WRAPPER}}'                           => '--ang_color_accent_primary: {{VALUE}};',
	// 		'{{WRAPPER}} .elementor-view-framed .elementor-icon, {{WRAPPER}} .elementor-view-default .elementor-icon' => 'border-color: {{VALUE}};',
	// 		'.theme-hello-elementor .comment-form input#submit' => 'color: #fff; border: none;',
	// 		'{{WRAPPER}} .elementor-tab-title a'    => 'color: inherit;',
	// 		'{{WRAPPER}} .e--pointer-framed .elementor-item:before,{{WRAPPER}} .e--pointer-framed .elementor-item:after' => 'border-color: {{VALUE}};',
	// 		'{{WRAPPER}} .elementor-sub-item:hover' => 'color: #fff;',
	// 		'{{WRAPPER}} .dialog-message'           => 'font-size:inherit;line-height:inherit;',

	// 		$primary_accent_color_selectors         => 'color: {{VALUE}};',
	// 		$primary_accent_background_selectors    => 'background-color: {{VALUE}};',
	// 	);

	// 	$tooltip = __( 'The primary accent color applies on links, icons, and other elements. You can also define the text link color in the Typography panel.', 'ang' );
	// 	$element->add_control(
	// 		'ang_color_accent_primary',
	// 		array(
	// 			'label'     => __( 'Primary Accent', 'ang' ) . $this->get_tooltip( $tooltip ),
	// 			'type'      => Controls_Manager::COLOR,
	// 			'variable'  => 'ang_color_accent_primary',
	// 			'selectors' => $selectors,
	// 		)
	// 	);

	// 	$accent_secondary_selectors = array(
	// 		'{{WRAPPER}} .sk-secondary-accent',
	// 		'{{WRAPPER}} .sk-secondary-accent.sk-secondary-accent h1',
	// 		'{{WRAPPER}} .sk-secondary-accent.sk-secondary-accent h2',
	// 		'{{WRAPPER}} .sk-secondary-accent.sk-secondary-accent h3',
	// 		'{{WRAPPER}} .sk-secondary-accent.sk-secondary-accent h4',
	// 		'{{WRAPPER}} .sk-secondary-accent.sk-secondary-accent h5',
	// 		'{{WRAPPER}} .sk-secondary-accent.sk-secondary-accent h6',
	// 	);

	// 	$accent_secondary_selectors = implode( ',', $accent_secondary_selectors );

	// 	$tooltip = __( 'The default button color. You can also define button colors under the Buttons panel, and individually for each button size under Buttons Sizes panel.', 'ang' );
	// 	$element->add_control(
	// 		'ang_color_accent_secondary',
	// 		array(
	// 			'label'     => __( 'Secondary Accent', 'ang' ) . $this->get_tooltip( $tooltip ),
	// 			'type'      => Controls_Manager::COLOR,
	// 			'variable'  => 'ang_color_accent_secondary',
	// 			'selectors' => array(
	// 				'{{WRAPPER}}'               => '--ang_color_accent_secondary: {{VALUE}};',
	// 				'{{WRAPPER}} .elementor-button, {{WRAPPER}} .button, {{WRAPPER}} button, {{WRAPPER}} .sk-accent-2' => 'background-color: {{VALUE}}',
	// 				$accent_secondary_selectors => 'color: {{VALUE}}',
	// 				'{{WRAPPER}} .sk-secondary-bg:not(.elementor-column)' => 'background-color: {{VALUE}}',
	// 				'{{WRAPPER}} .sk-secondary-bg.elementor-column > .elementor-element-populated' => 'background-color: {{VALUE}};',
	// 			),
	// 		)
	// 	);

	// 	$element->end_controls_section();
	// }

	/**
	 * Tweak default Divider color to be SKs Primary accent color.
	 *
	 * @param Element_Base $element Element base.
	 */
	// public function tweak_divider_style( Element_Base $element ) {
	// 	$page_settings_manager = Manager::get_settings_managers( 'page' );
	// 	$page_settings_model   = $page_settings_manager->get_model( get_the_ID() );

	// 	$default_color = null;

	// 	$kit_id = $page_settings_model->get_settings( 'ang_action_tokens' );
	// 	if ( '' !== $kit_id ) {
	// 		$kit_model     = $page_settings_manager->get_model( $kit_id );
	// 		$default_color = $kit_model->get_settings( 'ang_color_accent_primary' );
	// 	}

	// 	if ( $default_color ) {
	// 		$element->update_control(
	// 			'color',
	// 			array(
	// 				'default' => $default_color,
	// 			)
	// 		);
	// 	}
	// }

	/**
	 * Tweak Elementor Icon Box widget.
	 *
	 * @param Element_Base $element Element base.
	 */
	// public function tweak_icon_Box( Element_Base $element ) {
	// 	$element->update_control(
	// 		'title_color',
	// 		array(
	// 			'selectors' => array(
	// 				'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title, {{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title a' => 'color: {{VALUE}};',
	// 			),
	// 		)
	// 	);
	// }

	/**
	 * Tweak Elementor Image Box widget.
	 *
	 * @param Element_Base $element Element base.
	 */
	// public function tweak_image_Box( Element_Base $element ) {
	// 	$element->update_control(
	// 		'title_color',
	// 		array(
	// 			'selectors' => array(
	// 				'{{WRAPPER}} .elementor-image-box-content .elementor-image-box-title, {{WRAPPER}} .elementor-image-box-content .elementor-image-box-title a' => 'color: {{VALUE}};',
	// 			),
	// 		)
	// 	);
	// }

	/**
	 * Tweak Elementor Heading widget.
	 *
	 * @param Element_Base $element Element base.
	 */
	// public function tweak_heading( Element_Base $element ) {
	// 	$element->update_control(
	// 		'title_color',
	// 		array(
	// 			'selectors' => array(
	// 				'{{WRAPPER}}.elementor-widget-heading .elementor-heading-title, {{WRAPPER}}.elementor-widget-heading .elementor-heading-title.elementor-heading-title a' => 'color: {{VALUE}};',
	// 			),
	// 		)
	// 	);
	// }

	/**
	 * Tweak Elementor Nav Menu widget.
	 *
	 * @param Element_Base $element Element base.
	 */
	// public function tweak_nav_menu( Element_Base $element ) {
	// 	$element->update_control(
	// 		'color_menu_item',
	// 		array(
	// 			'selectors' => array(
	// 				'{{WRAPPER}} .elementor-nav-menu--main .elementor-item.elementor-item' => 'color: {{VALUE}}',
	// 			),
	// 		)
	// 	);
	// }

	/**
	 * Tweak default theme style button bg color - increases class priority.
	 *
	 * @param Controls_Stack $element Elementor element.
	 * @param string         $section_id Section ID.
	 */
	// public function tweak_theme_style_button( Controls_Stack $element, $section_id ) {
	// 	$button_selectors = array(
	// 		'{{WRAPPER}} button',
	// 		'{{WRAPPER}} input[type="button"]',
	// 		'{{WRAPPER}} input[type="submit"]',
	// 		'{{WRAPPER}} .elementor-button.elementor-button',
	// 	);

	// 	$button_selector = implode( ',', $button_selectors );

	// 	$element->update_control(
	// 		'button_background_color',
	// 		array(
	// 			'selectors' => array(
	// 				$button_selector => 'background-color: {{VALUE}};',
	// 			),
	// 		)
	// 	);
	// }

	/**
	 * Tweak default theme style typography.
	 *
	 * @param Controls_Stack $element Elementor element.
	 * @param string         $section_id Section ID.
	 */
	// public function tweak_theme_style_typography( Controls_Stack $element, $section_id ) {
	// 	$link_selectors = array(
	// 		'{{WRAPPER}} .elementor-widget-container *:not(.menu-item):not(.elementor-tab-title):not(.elementor-image-box-title):not(.elementor-icon-box-title):not(.elementor-icon-box-icon):not(.elementor-post__title):not(.elementor-heading-title) > a:not(:hover):not(:active):not(.elementor-item-active):not([role="button"]):not(.button):not(.elementor-button):not(.elementor-post__read-more):not(.elementor-post-info__terms-list-item):not([role="link"])',
	// 		'{{WRAPPER}} .elementor-widget-container a:not([class])',
	// 	);

	// 	$link_hover_selectors = array(
	// 		'{{WRAPPER}} .elementor-widget-container a:hover:not([class])',
	// 	);

	// 	$link_selectors       = implode( ',', $link_selectors );
	// 	$link_hover_selectors = implode( ',', $link_hover_selectors );

	// 	$element->update_control(
	// 		'link_normal_color',
	// 		array(
	// 			'selectors' => array(
	// 				$link_selectors => 'color: {{VALUE}};',
	// 			),
	// 		)
	// 	);

	// 	$element->update_control(
	// 		'link_hover_color',
	// 		array(
	// 			'selectors' => array(
	// 				$link_hover_selectors => 'color: {{VALUE}};',
	// 			),
	// 		)
	// 	);
	// }
}
