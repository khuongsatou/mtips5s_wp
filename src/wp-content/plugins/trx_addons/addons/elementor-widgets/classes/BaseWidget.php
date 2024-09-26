<?php
/**
 * Base Widget for Elementor
 *
 * @package ThemeREX Addons
 * @since v2.30.0
 */

namespace TrxAddons\ElementorWidgets;

use TrxAddons\ElementorWidgets\ElementorWidgets;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Common Widget
 */
abstract class BaseWidget extends Widget_Base {

	protected $module_class = '';
	protected $widget_class = '';

	/**
	 * Widget base constructor.
	 *
	 * Initializing the widget base class.
	 *
	 * @param array       $data  Widget data. Default is an empty array.
	 * @param array|null  $args  Optional. Widget default arguments. Default is null.
	 */
	public function __construct( $data = [], $args = null ) {
		// Get the module and widget class names before calling the parent constructor to use them in the widget settings
		$class = explode( '\\', get_class( $this ) );
		$this->widget_class = end( $class );
		$this->module_class = str_replace( 'Widget', '', $this->widget_class );

		parent::__construct( $data, $args );
	}

	/**
	 * Get categories
	 */
	public function get_categories() {
		return ['trx_addons-elements'];
	}

	/**
	 * Get widget name
	 * 
	 * @return string  Widget name.
	 */
	public function get_name() {
		return ElementorWidgets::instance()->widget_data( $this->module_class, 'name' );
	}

	/**
	 * Get widget title
	 * 
	 * @return string  Widget title.
	 */
	public function get_title() {
		return ElementorWidgets::instance()->widget_data( $this->module_class, 'title' );
	}

	/**
	 * Get widget icon
	 * 
	 * @return string  Widget icon.
	 */
	public function get_icon() {
		return ElementorWidgets::instance()->widget_data( $this->module_class, 'icon' );
	}

	/**
	 * Get widget keywords
	 *
	 * @param string $widget Module class.
	 */
	public function get_keywords() {
		return ElementorWidgets::instance()->widget_data( $this->module_class, 'keywords' );
	}

	/**
	 * Register Help Docs Controls in Content tab.
	 * 
	 * This method has a public access to allow use it in the skin classes.
	 * 
	 * @access public
	 */
	public function register_content_help_docs_controls() {

		$help_docs = ElementorWidgets::instance()->widget_data( $this->module_class, 'help_docs' );

		if ( ! empty( $help_docs ) && is_array( $help_docs ) ) {

			/**
			 * Content Tab: Help Docs
			 */
			$this->start_controls_section(
				'section_help_docs',
				array(
					'label' => __( 'Help Docs', 'trx_addons' ),
				)
			);

			$hd_counter = 1;
			foreach ( $help_docs as $hd_title => $hd_link ) {
				$this->add_control(
					'help_doc_' . $hd_counter,
					array(
						'type'            => Controls_Manager::RAW_HTML,
						'raw'             => sprintf( '%1$s ' . $hd_title . ' %2$s', '<a href="' . $hd_link . '" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'trx-addons-editor-doc-links',
					)
				);

				$hd_counter++;
			}

			$this->end_controls_section();
		}
	}

	/**
	 * Add a placeholder for the widget in the elementor editor
	 */
	public function render_editor_placeholder( $args = array() ) {

		if ( ! \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			return;
		}

		$defaults = [
			'title' => $this->get_title(),
			'body'  => __( 'This is a placeholder for this widget and is visible only in the editor.', 'trx_addons' ),
		];

		$args = wp_parse_args( $args, $defaults );

		$this->add_render_attribute( array(
			'wrapper' => [
				'class' => 'trx_addons_elementor_editor_placeholder',
			],
			'title' => [
				'class' => 'trx_addons_elementor_editor_placeholder_title',
			],
			'content' => [
				'class' => 'trx_addons_elementor_editor_placeholder_content',
			],
		) );

		?><div <?php echo wp_kses_post( $this->get_render_attribute_string( 'wrapper' ) ); ?>>
			<h4 <?php echo wp_kses_post( $this->get_render_attribute_string( 'title' ) ); ?>>
				<?php echo esc_html( $args['title'] ); ?>
			</h4>
			<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'content' ) ); ?>>
				<?php echo esc_html( $args['body'] ); ?>
			</div>
		</div><?php
	}

	/**
	 * Get swiper slider settings
	 */
	public function get_swiper_slider_settings( $settings, $new = true ) {
		$pagination = ( $new ) ? $settings['pagination'] : $settings['dots'];

		$effect = ( isset( $settings['carousel_effect'] ) && ( $settings['carousel_effect'] ) ) ? $settings['carousel_effect'] : 'slide';

		$slider_options = [
			'direction'     => 'horizontal',
			'effect'        => $effect,
			'speed'         => ( '' !== $settings['slider_speed']['size'] ) ? $settings['slider_speed']['size'] : 400,
			'slidesPerView' => ( '' !== $settings['items']['size'] ) ? absint( $settings['items']['size'] ) : 3,
			'spaceBetween'  => ( '' !== $settings['margin']['size'] ) ? absint( $settings['margin']['size'] ) : 10,
			'grabCursor'    => ( 'yes' === $settings['grab_cursor'] ),
			'autoHeight'    => ( 'yes' === $settings['adaptive_height'] ),
			'loop'          => ( 'yes' === $settings['infinite_loop'] ),
		];

		$autoplay_speed = 999999;

		if ( 'yes' === $settings['autoplay'] ) {
			if ( isset( $settings['autoplay_speed']['size'] ) ) {
				$autoplay_speed = $settings['autoplay_speed']['size'];
			} elseif ( $settings['autoplay_speed'] ) {
				$autoplay_speed = $settings['autoplay_speed'];
			}
		}

		$slider_options['autoplay'] = [
			'delay'                => $autoplay_speed,
			'disableOnInteraction' => ( 'yes' === $settings['pause_on_interaction'] ),
		];

		if ( 'yes' === $pagination ) {
			$slider_options['pagination'] = [
				'el'        => '.swiper-pagination-' . esc_attr( $this->get_id() ),
				'type'      => $settings['pagination_type'],
				'clickable' => true,
			];
		}

		if ( 'yes' === $settings['arrows'] ) {
			$slider_options['navigation'] = [
				'nextEl' => '.swiper-button-next-' . esc_attr( $this->get_id() ),
				'prevEl' => '.swiper-button-prev-' . esc_attr( $this->get_id() ),
			];
		}

		$elementor_bp_lg = get_option( 'elementor_viewport_lg' );
		$elementor_bp_md = get_option( 'elementor_viewport_md' );
		$bp_desktop      = ! empty( $elementor_bp_lg ) ? $elementor_bp_lg : 1025;
		$bp_tablet       = ! empty( $elementor_bp_md ) ? $elementor_bp_md : 768;
		$bp_mobile       = 320;

		$items        = ( isset( $settings['items']['size'] ) && '' !== $settings['items']['size'] ) ? absint( $settings['items']['size'] ) : 3;
		$items_tablet = ( isset( $settings['items_tablet']['size'] ) && '' !== $settings['items_tablet']['size'] ) ? absint( $settings['items_tablet']['size'] ) : 2;
		$items_mobile = ( isset( $settings['items_mobile']['size'] ) && '' !== $settings['items_mobile']['size'] ) ? absint( $settings['items_mobile']['size'] ) : 1;

		$margin        = ( isset( $settings['margin']['size'] ) && '' !== $settings['margin']['size'] ) ? absint( $settings['margin']['size'] ) : 10;
		$margin_tablet = ( isset( $settings['margin_tablet']['size'] ) && '' !== $settings['margin_tablet']['size'] ) ? absint( $settings['margin_tablet']['size'] ) : 10;
		$margin_mobile = ( isset( $settings['margin_mobile']['size'] ) && '' !== $settings['margin_mobile']['size'] ) ? absint( $settings['margin_mobile']['size'] ) : 10;

		$slider_options['breakpoints'] = [
			$bp_desktop => [
				'slidesPerView' => $items,
				'spaceBetween'  => $margin,
			],
			$bp_tablet  => [
				'slidesPerView' => $items_tablet,
				'spaceBetween'  => $margin_tablet,
			],
			$bp_mobile  => [
				'slidesPerView' => $items_mobile,
				'spaceBetween'  => $margin_mobile,
			],
		];

		return $slider_options;
	}

	/**
	 * Get swiper slider settings for content_template function
	 */
	public function get_swiper_slider_settings_js() {
		$elementor_bp_tablet    = get_option( 'elementor_viewport_lg' );
		$elementor_bp_mobile    = get_option( 'elementor_viewport_md' );
		$elementor_bp_lg        = get_option( 'elementor_viewport_lg' );
		$elementor_bp_md        = get_option( 'elementor_viewport_md' );
		$bp_desktop             = ! empty( $elementor_bp_lg ) ? $elementor_bp_lg : 1025;
		$bp_tablet              = ! empty( $elementor_bp_md ) ? $elementor_bp_md : 768;
		$bp_mobile              = 320;
		?>
		<#
			function get_slider_settings( settings ) {
		   
				if (typeof settings.effect !== 'undefined') {
					var $effect = settings.effect;
				} else {
					var $effect = 'slide';
				}

				var $items          = ( settings.items.size !== '' || settings.items.size !== undefined ) ? settings.items.size : 3,
					$items_tablet   = ( settings.items_tablet.size !== '' || settings.items_tablet.size !== undefined ) ? settings.items_tablet.size : 2,
					$items_mobile   = ( settings.items_mobile.size !== '' || settings.items_mobile.size !== undefined ) ? settings.items_mobile.size : 1,
					$margin         = ( settings.margin.size !== '' || settings.margin.size !== undefined ) ? settings.margin.size : 10,
					$margin_tablet  = ( settings.margin_tablet.size !== '' || settings.margin_tablet.size !== undefined ) ? settings.margin_tablet.size : 10,
					$margin_mobile  = ( settings.margin_mobile.size !== '' || settings.margin_mobile.size !== undefined ) ? settings.margin_mobile.size : 10,
					$autoplay       = ( settings.autoplay == 'yes' && settings.autoplay_speed.size != '' ) ? settings.autoplay_speed.size : 999999;

				return {
					direction:              "horizontal",
					speed:                  ( settings.slider_speed.size !== '' || settings.slider_speed.size !== undefined ) ? settings.slider_speed.size : 400,
					effect:                 $effect,
					slidesPerView:          $items,
					spaceBetween:           $margin,
					grabCursor:             ( settings.grab_cursor === 'yes' ) ? true : false,
					autoHeight:             ( settings.adaptive_height === 'yes' ) ? true : false,,
					loop:                   ( settings.infinite_loop === 'yes' ),
					autoplay: {
						delay: $autoplay,
						disableOnInteraction: ( settings.disableOnInteraction === 'yes' ),
					},
					pagination: {
						el: '.swiper-pagination',
						type: settings.pagination_type,
						clickable: true,
					},
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					breakpoints: {
						<?php echo esc_attr( $bp_desktop ); ?>: {
							slidesPerView:  $items,
							spaceBetween:   $margin
						},
						<?php echo esc_attr( $bp_tablet ); ?>: {
							slidesPerView:  $items_tablet,
							spaceBetween:   $margin_tablet
						},
						<?php echo esc_attr( $bp_mobile ); ?>: {
							slidesPerView:  $items_mobile,
							spaceBetween:   $margin_mobile
						}
					}
				};
			};
		#>
		<?php
	}
}
