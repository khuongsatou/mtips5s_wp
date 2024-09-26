<?php
/**
 * Add custom control for Elementor.
 *
 * @package ThemeREX Addons
 * @since v2.30.0
 */

namespace TrxAddons\ElementorTemplates;

use Elementor\Base_Data_Control;

/**
 * Action class.
 */
class Action extends Base_Data_Control {
	/**
	 * Get control type.
	 * Retrieve the control type.
	 *
	 * @access public
	 */
	public function get_type() {
		return 'trx_addons_elementor_extension_action';
	}

	/**
	 * Get data control value.
	 * Retrieve the value of the data control from a specific Controls_Stack settings.
	 *
	 * @param array $control  Control.
	 * @param array $settings Element settings.
	 *
	 * @access public
	 *
	 * @return bool
	 */
	public function get_value( $control, $settings ) {
		return false;
	}

	/**
	 * Get data control default value.
	 *
	 * Retrieve the default value of the data control. Used to return the default
	 * values while initializing the data control.
	 *
	 * @access public
	 * @return string Control default value.
	 */
	public function get_default_value() {
		return '';
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @return void
	 */
	public function enqueue() {

		// wp_enqueue_style( 'hint-css', trx_addons_get_file_url( TRX_ADDONS_PLUGIN_ADDONS . 'elementor-templates/css/hint.min.css', array(), '2.5.1' );

		// wp_enqueue_script( 'cssbeautify', trx_addons_get_file_url( TRX_ADDONS_PLUGIN_ADDONS . 'elementor-templates/js/cssbeautify.min.js' ), array(), null, false );
		// wp_enqueue_script( 'trx_addons_elementor_extension_action', trx_addons_get_file_url( TRX_ADDONS_PLUGIN_ADDONS . 'elementor-templates/js/action.js' ), array( 'jquery', 'cssbeautify' ), null, false );

		wp_enqueue_script( 'trx_addons_elementor_extension_action', trx_addons_get_file_url( TRX_ADDONS_PLUGIN_ADDONS . 'elementor-templates/js/action.js' ), array( 'jquery' ), null, false );

		$schemes = trx_addons_get_theme_color_schemes();
		if ( empty( $schemes ) || ! is_array( $schemes ) ) {
			$schemes = array();
		}
		
		wp_localize_script( 'trx_addons_elementor_extension_action', 'TRX_ADDONS_ELEMENTOR_EXTENSION_ACTION', array(
				//'saveToken'       => rest_url( 'agwp/v1/tokens/save' ),
				'cssDir'          => \Elementor\Core\Files\Base::get_base_uploads_url() . \Elementor\Core\Files\Base::DEFAULT_FILES_DIR,
				'globalKit'       => get_option( 'elementor_active_kit' ),
				'schemes'         => $schemes,
				'translate'       => array(
					'resetHeader'                  => __( 'Are you sure?', 'trx_addons' ),
					'resetGlobalColorsMessage'     => __( 'This will revert the color palette and the color labels to their defaults. You can undo this action from the revisions tab.', 'trx_addons' ),
					// 'resetGlobalFontsMessage'      => __( 'This will revert the global font labels & values to their defaults. You can undo this action from the revisions tab.', 'trx_addons' ),

					// 'resetMessage'                 => __( 'This will clean-up all the values from the current Theme Style kit. If you need to revert, you can do so at the Revisions tab.', 'trx_addons' ),
					// 'saveToken'                    => __( 'Clone Style Kit', 'trx_addons' ),
					// 'saveToken2'                   => __( 'Save', 'trx_addons' ),
					// 'cancel'                       => __( 'Cancel', 'trx_addons' ),
					// 'enterTitle'                   => __( 'Style Kit name', 'trx_addons' ),
					// 'insertToken'                  => __( 'Insert Style Kit', 'trx_addons' ),
					// 'tokenWarning'                 => __( 'Please select a Style Kit first.', 'trx_addons' ),
					// 'selectKit'                    => __( '— Select a Style Kit —', 'trx_addons' ),
					// 'tokenUpdated'                 => __( 'Style Kit Updated.', 'trx_addons' ),
					// 'selectToken'                  => __( 'Please select a Style Kit first.', 'trx_addons' ),
					// 'updateKit'                    => __( 'Update Style Kit', 'trx_addons' ),
					// 'updateMessage'                => __( 'This action will update the Style Kit with the latest changes, and will affect all the pages that the style kit is used on. Do you wish to proceed?', 'trx_addons' ),
					// 'sk_header'                    => __( 'Meet Style Kits for Elementor', 'trx_addons' ),
					// 'sk_message'                   => sprintf(
					// 	/* translators: %s: Link to Style Kits documentation. */
					// 	__( 'Take control of your design in the macro level, with local or global settings for typography and spacing. %s.', 'trx_addons' ),
					// 	/* translators: %s: Link text */
					// 	sprintf( '<a href = "https://analogwp.com/style-kits-for-elementor/?utm_medium=plugin&utm_source=elementor&utm_campaign=style+kits" target="_blank">%s</a>', __( 'Learn more', 'trx_addons' ) )
					// ),
					// 'sk_learn'                     => __( 'View Styles', 'trx_addons' ),
					// 'pageStyles'                   => __( 'Style Kits', 'trx_addons' ),
					// 'exportCSS'                    => __( 'Export CSS', 'trx_addons' ),
					// 'copyCSS'                      => __( 'Copy CSS', 'trx_addons' ),
					// 'cssCopied'                    => __( 'CSS copied', 'trx_addons' ),
					// 'skUpdate'                     => __( 'Style Kit Update Detected', 'trx_addons' ),
					// 'skUpdateDesc'                 => __( '<p>The Style kit used by this page has been updated, click ‘Apply Changes’ to apply the latest changes.</p><p>Click Discard to keep your current page styles and detach the page from the Style Kit</p>', 'trx_addons' ),
					// 'discard'                      => __( 'Discard', 'trx_addons' ),
					// 'apply'                        => __( 'Apply Changes', 'trx_addons' ),
					// 'got_it'                       => __( 'Ok, got it.', 'trx_addons' ),
					// 'gotoPageStyle'                => __( 'Go to Page Style', 'trx_addons' ),
					// 'pageStyleHeader'              => __( 'This template offers global typography and spacing control, through the Page Style tab.', 'trx_addons' ),
					// 'pageStyleDesc'                => __( 'Typography, column gaps and more, are controlled layout-wide at Page Styles Panel, giving you the flexibility you need over the design of this template. You can save the styles and apply them to any other page. <a href="#" target="_blank">Learn More.</a>', 'trx_addons' ),
					// 'cssVariables'                 => __( 'CSS Variables', 'trx_addons' ),
					// 'cssSelector'                  => __( 'Remove Page ID from the CSS', 'trx_addons' ),
					// 'resetContainerPaddingMessage' => __( 'This will revert the container preset labels & values to their defaults. You can undo this action from the revisions tab.', 'trx_addons' ),
					// 'resetShadowsDesc'             => __( 'This will revert the box shadow presets to their defaults. You can undo this action from the revisions tab.', 'trx_addons' ),
					// 'kitSwitcherNotice'            => __( 'All good. The new Style Kit has been applied on this page!', 'trx_addons' ),
					// 'kitSwitcherSKSwitch'          => __( 'Switch Style Kit', 'trx_addons' ),
					// 'kitSwitcherEditorSwitch'      => __( 'Back to Editor', 'trx_addons' ),
				)
			)
		);
	}

	/**
	 * Get default control settings.
	 *
	 * @since 1.6.0
	 * @return array
	 */
	protected function get_default_settings() {
		return array(
			'button_type' => 'success',
		);
	}

	/**
	 * Control Content template.
	 *
	 * {@inheritDoc}
	 *
	 * @since 1.6.0 Added data.button_type class to button.
	 * @return void
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<button
					data-action="{{ data.action }}"
					style="padding:7px 10px"
					class="elementor-button elementor-button-{{{ data.button_type }}}"
				>
				{{{ data.action_label }}}</button>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
