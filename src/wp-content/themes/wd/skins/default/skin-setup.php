<?php
/**
 * Skin Setup
 *
 * @package WD
 * @since WD 1.76.0
 */


//--------------------------------------------
// SKIN DEFAULTS
//--------------------------------------------

// Return theme's (skin's) default value for the specified parameter
if ( ! function_exists( 'wd_theme_defaults' ) ) {
	function wd_theme_defaults( $name='', $value='' ) {
		$defaults = array(
			'page_width'          => 1290,
			'page_boxed_extra'  => 60,
			'page_fullwide_max' => 1920,
			'page_fullwide_extra' => 60,
			'sidebar_width'       => 410,
			'sidebar_gap'       => 40,
			'grid_gap'          => 30,
			'rad'               => 0
		);
		if ( empty( $name ) ) {
			return $defaults;
		} else {
			if ( $value === '' && isset( $defaults[ $name ] ) ) {
				$value = $defaults[ $name ];
			}
			return $value;
		}
	}
}


// WOOCOMMERCE SETUP
//--------------------------------------------------

// Allow extended layouts for WooCommerce
if ( ! function_exists( 'wd_skin_woocommerce_allow_extensions' ) ) {
	add_filter( 'wd_filter_load_woocommerce_extensions', 'wd_skin_woocommerce_allow_extensions' );
	function wd_skin_woocommerce_allow_extensions( $allow ) {
		return false;
	}
}


// Theme init priorities:
// Action 'after_setup_theme'
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options. Attention! After this step you can use only basic options (not overriden)
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
// Action 'wp_loaded'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)


//--------------------------------------------
// SKIN SETTINGS
//--------------------------------------------
if ( ! function_exists( 'wd_skin_setup' ) ) {
	add_action( 'after_setup_theme', 'wd_skin_setup', 1 );
	function wd_skin_setup() {

		$GLOBALS['WD_STORAGE'] = array_merge( $GLOBALS['WD_STORAGE'], array(

			// Key validator: market[env|loc]-vendor[axiom|ancora|themerex]
			'theme_pro_key'       => 'env-ancora',

			'theme_doc_url'       => '//wd.ancorathemes.com/doc',

			'theme_demofiles_url' => '//demofiles.ancorathemes.com/wd/',
			
			'theme_rate_url'      => '//themeforest.net/download',

			'theme_custom_url'    => '//themerex.net/offers/?utm_source=offers&utm_medium=click&utm_campaign=themeinstall',

			'theme_support_url'   => '//themerex.net/support/',

			'theme_download_url'  => '',        // Ancora

			'theme_video_url'     => '//www.youtube.com/channel/UCdIjRh7-lPVHqTTKpaf8PLA',   // Ancora

			'theme_privacy_url'   => '//ancorathemes.com/privacy-policy/',                   // Ancora

			'portfolio_url'       => '//themeforest.net/user/ancorathemes/portfolio',        // Ancora

			// Comma separated slugs of theme-specific categories (for get relevant news in the dashboard widget)
			// (i.e. 'children,kindergarten')
			'theme_categories'    => '',
		) );
	}
}


// Add/remove/change Theme Settings
if ( ! function_exists( 'wd_skin_setup_settings' ) ) {
	add_action( 'after_setup_theme', 'wd_skin_setup_settings', 1 );
	function wd_skin_setup_settings() {
		// Example: enable (true) / disable (false) thumbs in the prev/next navigation
		wd_storage_set_array( 'settings', 'thumbs_in_navigation', false );
		wd_storage_set_array2( 'required_plugins', 'the-events-calendar', 'install', false);
	}
}



//--------------------------------------------
// SKIN FONTS
//--------------------------------------------
if ( ! function_exists( 'wd_skin_setup_fonts' ) ) {
	add_action( 'after_setup_theme', 'wd_skin_setup_fonts', 1 );
	function wd_skin_setup_fonts() {
		// Fonts to load when theme start
		// It can be:
		// - Google fonts (specify name, family and styles)
		// - Adobe fonts (specify name, family and link URL)
		// - uploaded fonts (specify name, family), placed in the folder css/font-face/font-name inside the skin folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		wd_storage_set(
			'load_fonts', array(
				// Google font
				array(
					'name'   => 'DM Sans',
					'family' => 'sans-serif',
					'link'   => '',
					'styles' => 'ital,wght@0,400;0,500;0,700;1,400;1,500;1,700',     // Parameter 'style' used only for the Google fonts
				),
			)
		);

		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		wd_storage_set( 'load_fonts_subset', 'latin,latin-ext' );

        // Settings of the main tags.
        // Default value of 'font-family' may be specified as reference to the array $load_fonts (see above)
        // or as comma-separated string.
        // In the second case (if 'font-family' is specified manually as comma-separated string):
        //    1) Font name with spaces in the parameter 'font-family' will be enclosed in the quotes and no spaces after comma!
        //    2) If font-family inherit a value from the 'Main text' - specify 'inherit' as a value
        // example:
        // Correct:   'font-family' => basekit_get_load_fonts_family_string( $load_fonts[0] )
        // Correct:   'font-family' => 'Roboto,sans-serif'
        // Correct:   'font-family' => '"PT Serif",sans-serif'
        // Incorrect: 'font-family' => 'Roboto, sans-serif'
        // Incorrect: 'font-family' => 'PT Serif,sans-serif'

		$font_description = esc_html__( 'Font settings for the %s of the site. To ensure that the elements scale properly on mobile devices, please use only the following units: "rem", "em" or "ex"', 'wd' );

		wd_storage_set(
			'theme_fonts', array(
				'p'       => array(
					'title'           => esc_html__( 'Main text', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'main text', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '1rem',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.647em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0em',
					'margin-bottom'   => '1.57em',
				),
				'post'    => array(
					'title'           => esc_html__( 'Article text', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'article text', 'wd' ) ),
					'font-family'     => '',			// Example: '"PR Serif",serif',
					'font-size'       => '',			// Example: '1.286rem',
					'font-weight'     => '',			// Example: '400',
					'font-style'      => '',			// Example: 'normal',
					'line-height'     => '',			// Example: '1.75em',
					'text-decoration' => '',			// Example: 'none',
					'text-transform'  => '',			// Example: 'none',
					'letter-spacing'  => '',			// Example: '',
					'margin-top'      => '',			// Example: '0em',
					'margin-bottom'   => '',			// Example: '1.4em',
				),
				'h1'      => array(
					'title'           => esc_html__( 'Heading 1', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H1', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '3.353em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-1.8px',
					'margin-top'      => '1.12em',
					'margin-bottom'   => '0.4em',
				),
				'h2'      => array(
					'title'           => esc_html__( 'Heading 2', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H2', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '2.765em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.021em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-1.4px',
					'margin-top'      => '0.79em',
					'margin-bottom'   => '0.45em',
				),
				'h3'      => array(
					'title'           => esc_html__( 'Heading 3', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H3', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '2.059em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.086em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-1px',
					'margin-top'      => '1.15em',
					'margin-bottom'   => '0.63em',
				),
				'h4'      => array(
					'title'           => esc_html__( 'Heading 4', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H4', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '1.529em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.214em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.5px',
					'margin-top'      => '1.44em',
					'margin-bottom'   => '0.62em',
				),
				'h5'      => array(
					'title'           => esc_html__( 'Heading 5', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H5', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '1.412em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.208em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.5px',
					'margin-top'      => '1.55em',
					'margin-bottom'   => '0.8em',
				),
				'h6'      => array(
					'title'           => esc_html__( 'Heading 6', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'tag H6', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '1.118em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.474em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '-0.6px',
					'margin-top'      => '1.75em',
					'margin-bottom'   => '1.1em',
				),
				'logo'    => array(
					'title'           => esc_html__( 'Logo text', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'text of the logo', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '1.7em',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '1.25em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'button'  => array(
					'title'           => esc_html__( 'Buttons', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'buttons', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '15px',
					'font-weight'     => '700',
					'font-style'      => 'normal',
					'line-height'     => '21px',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'input'   => array(
					'title'           => esc_html__( 'Input fields', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'input fields, dropdowns and textareas', 'wd' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '16px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',     // Attention! Firefox don't allow line-height less then 1.5em in the select
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0.1px',
				),
				'info'    => array(
					'title'           => esc_html__( 'Post meta', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'post meta (author, categories, publish date, counters, share, etc.)', 'wd' ) ),
					'font-family'     => 'inherit',
					'font-size'       => '13px',  // Old value '13px' don't allow using 'font zoom' in the custom blog items
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
					'margin-top'      => '0.4em',
					'margin-bottom'   => '',
				),
				'menu'    => array(
					'title'           => esc_html__( 'Main menu', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'main menu items', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '17px',
					'font-weight'     => '500',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'submenu' => array(
					'title'           => esc_html__( 'Dropdown menu', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'dropdown menu items', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
					'font-size'       => '14px',
					'font-weight'     => '400',
					'font-style'      => 'normal',
					'line-height'     => '1.5em',
					'text-decoration' => 'none',
					'text-transform'  => 'none',
					'letter-spacing'  => '0px',
				),
				'other' => array(
					'title'           => esc_html__( 'Other', 'wd' ),
					'description'     => sprintf( $font_description, esc_html__( 'specific elements', 'wd' ) ),
					'font-family'     => '"DM Sans",sans-serif',
				),
			)
		);

		// Font presets
		wd_storage_set(
			'font_presets', array(
				'karla' => array(
								'title'  => esc_html__( 'Karla', 'wd' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Dancing Script',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
													// Google font
													array(
														'name'   => 'Sansita Swashed',
														'family' => 'fantasy',
														'link'   => '',
														'styles' => '300,400,700',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Dancing Script",fantasy',
														'font-size'       => '1.25rem',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
														'font-size'       => '4em',
													),
													'h2'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h3'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h4'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h5'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'h6'      => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'logo'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'button'  => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
													'submenu' => array(
														'font-family'     => '"Sansita Swashed",fantasy',
													),
												),
							),
				'roboto' => array(
								'title'  => esc_html__( 'Roboto', 'wd' ),
								'load_fonts' => array(
													// Google font
													array(
														'name'   => 'Noto Sans JP',
														'family' => 'serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
													// Google font
													array(
														'name'   => 'Merriweather',
														'family' => 'sans-serif',
														'link'   => '',
														'styles' => '300,300italic,400,400italic,700,700italic',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Noto Sans JP",serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Merriweather,sans-serif',
													),
												),
							),
				'garamond' => array(
								'title'  => esc_html__( 'Garamond', 'wd' ),
								'load_fonts' => array(
													// Adobe font
													array(
														'name'   => 'Europe',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
													// Adobe font
													array(
														'name'   => 'Sofia Pro',
														'family' => 'sans-serif',
														'link'   => 'https://use.typekit.net/qmj1tmx.css',
														'styles' => '',
													),
												),
								'theme_fonts' => array(
													'p'       => array(
														'font-family'     => '"Sofia Pro",sans-serif',
													),
													'post'    => array(
														'font-family'     => '',
													),
													'h1'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h2'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h3'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h4'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h5'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'h6'      => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'logo'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'button'  => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'input'   => array(
														'font-family'     => 'inherit',
													),
													'info'    => array(
														'font-family'     => 'inherit',
													),
													'menu'    => array(
														'font-family'     => 'Europe,sans-serif',
													),
													'submenu' => array(
														'font-family'     => 'Europe,sans-serif',
													),
												),
							),
			)
		);
	}
}


//--------------------------------------------
// COLOR SCHEMES
//--------------------------------------------
if ( ! function_exists( 'wd_skin_setup_schemes' ) ) {
	add_action( 'after_setup_theme', 'wd_skin_setup_schemes', 1 );
	function wd_skin_setup_schemes() {

		// Theme colors for customizer
		// Attention! Inner scheme must be last in the array below
		wd_storage_set(
			'scheme_color_groups', array(
				'main'    => array(
					'title'       => esc_html__( 'Main', 'wd' ),
					'description' => esc_html__( 'Colors of the main content area', 'wd' ),
				),
				'alter'   => array(
					'title'       => esc_html__( 'Alter', 'wd' ),
					'description' => esc_html__( 'Colors of the alternative blocks (sidebars, etc.)', 'wd' ),
				),
				'extra'   => array(
					'title'       => esc_html__( 'Extra', 'wd' ),
					'description' => esc_html__( 'Colors of the extra blocks (dropdowns, price blocks, table headers, etc.)', 'wd' ),
				),
				'inverse' => array(
					'title'       => esc_html__( 'Inverse', 'wd' ),
					'description' => esc_html__( 'Colors of the inverse blocks - when link color used as background of the block (dropdowns, blockquotes, etc.)', 'wd' ),
				),
				'input'   => array(
					'title'       => esc_html__( 'Input', 'wd' ),
					'description' => esc_html__( 'Colors of the form fields (text field, textarea, select, etc.)', 'wd' ),
				),
			)
		);

		wd_storage_set(
			'scheme_color_names', array(
				'bg_color'    => array(
					'title'       => esc_html__( 'Background color', 'wd' ),
					'description' => esc_html__( 'Background color of this block in the normal state', 'wd' ),
				),
				'bg_hover'    => array(
					'title'       => esc_html__( 'Background hover', 'wd' ),
					'description' => esc_html__( 'Background color of this block in the hovered state', 'wd' ),
				),
				'bd_color'    => array(
					'title'       => esc_html__( 'Border color', 'wd' ),
					'description' => esc_html__( 'Border color of this block in the normal state', 'wd' ),
				),
				'bd_hover'    => array(
					'title'       => esc_html__( 'Border hover', 'wd' ),
					'description' => esc_html__( 'Border color of this block in the hovered state', 'wd' ),
				),
				'text'        => array(
					'title'       => esc_html__( 'Text', 'wd' ),
					'description' => esc_html__( 'Color of the text inside this block', 'wd' ),
				),
				'text_dark'   => array(
					'title'       => esc_html__( 'Text dark', 'wd' ),
					'description' => esc_html__( 'Color of the dark text (bold, header, etc.) inside this block', 'wd' ),
				),
				'text_light'  => array(
					'title'       => esc_html__( 'Text light', 'wd' ),
					'description' => esc_html__( 'Color of the light text (post meta, etc.) inside this block', 'wd' ),
				),
				'text_link'   => array(
					'title'       => esc_html__( 'Link', 'wd' ),
					'description' => esc_html__( 'Color of the links inside this block', 'wd' ),
				),
				'text_hover'  => array(
					'title'       => esc_html__( 'Link hover', 'wd' ),
					'description' => esc_html__( 'Color of the hovered state of links inside this block', 'wd' ),
				),
				'text_link2'  => array(
					'title'       => esc_html__( 'Accent 2', 'wd' ),
					'description' => esc_html__( 'Color of the accented texts (areas) inside this block', 'wd' ),
				),
				'text_hover2' => array(
					'title'       => esc_html__( 'Accent 2 hover', 'wd' ),
					'description' => esc_html__( 'Color of the hovered state of accented texts (areas) inside this block', 'wd' ),
				),
				'text_link3'  => array(
					'title'       => esc_html__( 'Accent 3', 'wd' ),
					'description' => esc_html__( 'Color of the other accented texts (buttons) inside this block', 'wd' ),
				),
				'text_hover3' => array(
					'title'       => esc_html__( 'Accent 3 hover', 'wd' ),
					'description' => esc_html__( 'Color of the hovered state of other accented texts (buttons) inside this block', 'wd' ),
				),
			)
		);

		// Default values for each color scheme
		$schemes = array(

			// Color scheme: 'default'
			'default' => array(
				'title'    => esc_html__( 'Default', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#F6F5ED',
					'bd_color'         => '#D1D0C8',

					// Text and links colors
					'text'             => '#83827F',
					'text_light'       => '#A7A7A7',  
					'text_dark'        => '#181818',
					'text_link'        => '#EDC701',
					'text_hover'       => '#D7B400',
					'text_link2'       => '#835C40',
					'text_hover2'      => '#65462F',
					'text_link3'       => '#275BB2',
					'text_hover3'      => '#0949B1',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#FFFFFF',
					'alter_bg_hover'   => '#EAEAEA',
					'alter_bd_color'   => '#D1D0C8',
					'alter_bd_hover'   => '#BFBFC1',
					'alter_text'       => '#83827F',
					'alter_light'      => '#A7A7A7',
					'alter_dark'       => '#181818',
					'alter_link'       => '#EDC701',
					'alter_hover'      => '#D7B400',
					'alter_link2'      => '#835C40',
					'alter_hover2'     => '#65462F',
					'alter_link3'      => '#275BB2',
					'alter_hover3'     => '#0949B1',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#DDDDDD',
					'extra_light'      => '#A7A7A7',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#EDC701',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent',
					'input_bg_hover'   => 'transparent',
					'input_bd_color'   => '#D1D0C8',
					'input_bd_hover'   => '#BFBFC1',
					'input_text'       => '#83827F',
					'input_light'      => '#A7A7A7',
					'input_dark'       => '#181818',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#181818',
					'inverse_link'     => '#181818',
					'inverse_hover'    => '#FFFFFF',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'dark'
			'dark'    => array(
				'title'    => esc_html__( 'Dark', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#141414',
					'bd_color'         => '#3C3F47',

					// Text and links colors
					'text'             => '#D1D1D1',
					'text_light'       => '#B1B1B1',
					'text_dark'        => '#FFFFFF',
					'text_link'        => '#EDC701',
					'text_hover'       => '#D7B400',
					'text_link2'       => '#835C40',
					'text_hover2'      => '#65462F',
					'text_link3'       => '#275BB2',
					'text_hover3'      => '#0949B1',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#1D1D1D',
					'alter_bg_hover'   => '#282D39',
					'alter_bd_color'   => '#333846',
					'alter_bd_hover'   => '#404655',
					'alter_text'       => '#D1D1D1',
					'alter_light'      => '#B1B1B1',
					'alter_dark'       => '#FFFFFF',
					'alter_link'       => '#EDC701',
					'alter_hover'      => '#D7B400',
					'alter_link2'      => '#835C40',
					'alter_hover2'     => '#65462F',
					'alter_link3'      => '#275BB2',
					'alter_hover3'     => '#0949B1',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#D1D1D1',
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#EDC701',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => '#transparent',
					'input_bg_hover'   => '#transparent',
					'input_bd_color'   => '#333846',
					'input_bd_hover'   => '#404655',
					'input_text'       => '#D1D1D1',
					'input_light'      => '#B1B1B1',
					'input_dark'       => '#FFFFFF',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#e36650',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#181818',
					'inverse_light'    => '#6f6f6f',
					'inverse_dark'     => '#181818',
					'inverse_link'     => '#181818',
					'inverse_hover'    => '#FFFFFF',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

            // Color scheme: 'light'
            'light' => array(
                'title'    => esc_html__( 'Light', 'wd' ),
                'internal' => true,
                'colors'   => array(

                    // Whole block border and background
                    'bg_color'         => '#FFFFFF',
                    'bd_color'         => '#D1D0C8',

                    // Text and links colors
                    'text'             => '#83827F',
                    'text_light'       => '#A7A7A7',
                    'text_dark'        => '#181818',
                    'text_link'        => '#EDC701',
                    'text_hover'       => '#D7B400',
                    'text_link2'       => '#835C40',
                    'text_hover2'      => '#65462F',
                    'text_link3'       => '#275BB2',
                    'text_hover3'      => '#0949B1',

                    // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                    'alter_bg_color'   => '#F6F5ED',
                    'alter_bg_hover'   => '#FFFFFF',
                    'alter_bd_color'   => '#D1D0C8',
                    'alter_bd_hover'   => '#BFBFC1',
                    'alter_text'       => '#83827F',
                    'alter_light'      => '#A7A7A7',
                    'alter_dark'       => '#181818',
                    'alter_link'       => '#EDC701',
                    'alter_hover'      => '#D7B400',
                    'alter_link2'      => '#835C40',
                    'alter_hover2'     => '#65462F',
                    'alter_link3'      => '#275BB2',
                    'alter_hover3'     => '#0949B1',

                    // Extra blocks (submenu, tabs, color blocks, etc.)
                    'extra_bg_color'   => '#272727',
                    'extra_bg_hover'   => '#2E2E2E',
                    'extra_bd_color'   => '#313131',
                    'extra_bd_hover'   => '#575757',
                    'extra_text'       => '#DDDDDD',
                    'extra_light'      => '#afafaf',
                    'extra_dark'       => '#FFFFFF',
                    'extra_link'       => '#EDC701',
                    'extra_hover'      => '#FFFFFF',
                    'extra_link2'      => '#80d572',
                    'extra_hover2'     => '#8be77c',
                    'extra_link3'      => '#ddb837',
                    'extra_hover3'     => '#eec432',

                    // Input fields (form's fields and textarea)
                    'input_bg_color'   => 'transparent',
                    'input_bg_hover'   => 'transparent',
                    'input_bd_color'   => '#D1D0C8',
                    'input_bd_hover'   => '#BFBFC1',
                    'input_text'       => '#83827F',
                    'input_light'      => '#A7A7A7',
                    'input_dark'       => '#181818',

                    // Inverse blocks (text and links on the 'text_link' background)
                    'inverse_bd_color' => '#67bcc1',
                    'inverse_bd_hover' => '#5aa4a9',
                    'inverse_text'     => '#1d1d1d',
                    'inverse_light'    => '#333333',
                    'inverse_dark'     => '#181818',
                    'inverse_link'     => '#181818',
                    'inverse_hover'    => '#FFFFFF',

                    // Additional (skin-specific) colors.
                    // Attention! Set of colors must be equal in all color schemes.
                    //---> For example:
                    //---> 'new_color1'         => '#rrggbb',
                    //---> 'alter_new_color1'   => '#rrggbb',
                    //---> 'inverse_new_color1' => '#rrggbb',
                ),
            ),

			// Color scheme: 'blue_default'
			'blue_default' => array(
				'title'    => esc_html__( 'Blue Default', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#F5F8FC',
					'bd_color'         => '#CAD1D9',

					// Text and links colors
					'text'             => '#7F8183',
					'text_light'       => '#A7A7A7',
					'text_dark'        => '#011E70',
					'text_link'        => '#FFC500',
					'text_hover'       => '#D8A700',
					'text_link2'       => '#0757DB',
					'text_hover2'      => '#0246B5',
					'text_link3'       => '#F96304',
					'text_hover3'      => '#CE5000',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#FFFFFF',
					'alter_bg_hover'   => '#EAEAEA',
					'alter_bd_color'   => '#CAD1D9',
					'alter_bd_hover'   => '#BFBFC1',
					'alter_text'       => '#7F8183',
					'alter_light'      => '#A7A7A7',
					'alter_dark'       => '#011E70',
					'alter_link'       => '#FFC500',
					'alter_hover'      => '#D8A700',
					'alter_link2'      => '#0757DB',
					'alter_hover2'     => '#0246B5',
					'alter_link3'      => '#F96304',
					'alter_hover3'     => '#CE5000',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#DDDDDD',
					'extra_light'      => '#A7A7A7',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#FFC500',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent',
					'input_bg_hover'   => 'transparent',
					'input_bd_color'   => '#CAD1D9',
					'input_bd_hover'   => '#BFBFC1',
					'input_text'       => '#7F8183',
					'input_light'      => '#A7A7A7',
					'input_dark'       => '#011E70',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#011E70',
					'inverse_link'     => '#011E70',
					'inverse_hover'    => '#FFFFFF',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'blue_dark'
			'blue_dark'    => array(
				'title'    => esc_html__( 'Blue Dark', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#141414',
					'bd_color'         => '#3F3F3F',

					// Text and links colors
					'text'             => '#D1D1D1',
					'text_light'       => '#B1B1B1',
					'text_dark'        => '#FFFFFF',
					'text_link'        => '#FFC500',
					'text_hover'       => '#D8A700',
					'text_link2'       => '#0757DB',
					'text_hover2'      => '#0246B5',
					'text_link3'       => '#F96304',
					'text_hover3'      => '#CE5000',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#1D1D1D',
					'alter_bg_hover'   => '#282D39',
					'alter_bd_color'   => '#333846',
					'alter_bd_hover'   => '#404655',
					'alter_text'       => '#D1D1D1',
					'alter_light'      => '#B1B1B1',
					'alter_dark'       => '#FFFFFF',
					'alter_link'       => '#FFC500',
					'alter_hover'      => '#D8A700',
					'alter_link2'      => '#0757DB',
					'alter_hover2'     => '#0246B5',
					'alter_link3'      => '#F96304',
					'alter_hover3'     => '#CE5000',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#D1D1D1',
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#FFC500',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => '#transparent',
					'input_bg_hover'   => '#transparent',
					'input_bd_color'   => '#333846',
					'input_bd_hover'   => '#404655',
					'input_text'       => '#D1D1D1',
					'input_light'      => '#B1B1B1',
					'input_dark'       => '#FFFFFF',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#e36650',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#011E70',
					'inverse_light'    => '#6f6f6f',
					'inverse_dark'     => '#011E70',
					'inverse_link'     => '#011E70',
					'inverse_hover'    => '#FFFFFF',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

            // Color scheme: 'blue_light'
            'blue_light' => array(
                'title'    => esc_html__( 'Blue Light', 'wd' ),
                'internal' => true,
                'colors'   => array(

                    // Whole block border and background
                    'bg_color'         => '#FFFFFF',
                    'bd_color'         => '#CAD1D9',

                    // Text and links colors
                    'text'             => '#7F8183',
                    'text_light'       => '#A7A7A7',
                    'text_dark'        => '#011E70',
                    'text_link'        => '#FFC500',
                    'text_hover'       => '#D8A700',
                    'text_link2'       => '#0757DB',
                    'text_hover2'      => '#0246B5',
                    'text_link3'       => '#F96304',
                    'text_hover3'      => '#CE5000',

                    // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                    'alter_bg_color'   => '#F5F8FC',
                    'alter_bg_hover'   => '#FFFFFF',
                    'alter_bd_color'   => '#CAD1D9',
                    'alter_bd_hover'   => '#BFBFC1',
                    'alter_text'       => '#7F8183',
                    'alter_light'      => '#A7A7A7',
                    'alter_dark'       => '#011E70',
                    'alter_link'       => '#FFC500',
                    'alter_hover'      => '#D8A700',
                    'alter_link2'      => '#0757DB',
                    'alter_hover2'     => '#0246B5',
                    'alter_link3'      => '#F96304',
                    'alter_hover3'     => '#CE5000',

                    // Extra blocks (submenu, tabs, color blocks, etc.)
                    'extra_bg_color'   => '#272727',
                    'extra_bg_hover'   => '#2E2E2E',
                    'extra_bd_color'   => '#313131',
                    'extra_bd_hover'   => '#575757',
                    'extra_text'       => '#D1D1D1',
                    'extra_light'      => '#afafaf',
                    'extra_dark'       => '#FFFFFF',
                    'extra_link'       => '#FFC500',
                    'extra_hover'      => '#FFFFFF',
                    'extra_link2'      => '#80d572',
                    'extra_hover2'     => '#8be77c',
                    'extra_link3'      => '#ddb837',
                    'extra_hover3'     => '#eec432',

                    // Input fields (form's fields and textarea)
                    'input_bg_color'   => 'transparent',
                    'input_bg_hover'   => 'transparent',
                    'input_bd_color'   => '#CAD1D9',
                    'input_bd_hover'   => '#BFBFC1',
                    'input_text'       => '#7F8183',
                    'input_light'      => '#A7A7A7',
                    'input_dark'       => '#011E70',

                    // Inverse blocks (text and links on the 'text_link' background)
                    'inverse_bd_color' => '#67bcc1',
                    'inverse_bd_hover' => '#5aa4a9',
                    'inverse_text'     => '#1d1d1d',
                    'inverse_light'    => '#333333',
                    'inverse_dark'     => '#011E70',
                    'inverse_link'     => '#011E70',
                    'inverse_hover'    => '#FFFFFF',

                    // Additional (skin-specific) colors.
                    // Attention! Set of colors must be equal in all color schemes.
                    //---> For example:
                    //---> 'new_color1'         => '#rrggbb',
                    //---> 'alter_new_color1'   => '#rrggbb',
                    //---> 'inverse_new_color1' => '#rrggbb',
                ),
            ),

			// Color scheme: 'brown_default'
			'brown_default' => array(
				'title'    => esc_html__( 'Brown Default', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#FCF8F5',
					'bd_color'         => '#DED4CC',

					// Text and links colors
					'text'             => '#83817F',
					'text_light'       => '#A7A7A7',
					'text_dark'        => '#02164E',
					'text_link'        => '#935833',
					'text_hover'       => '#774423',
					'text_link2'       => '#2750AD',
					'text_hover2'      => '#0246B5',
					'text_link3'       => '#CC6523',
					'text_hover3'      => '#AC4E13',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#FFFFFF',
					'alter_bg_hover'   => '#EAEAEA',
					'alter_bd_color'   => '#DED4CC',
					'alter_bd_hover'   => '#BFBFC1',
					'alter_text'       => '#83817F',
					'alter_light'      => '#A7A7A7',
					'alter_dark'       => '#02164E',
					'alter_link'       => '#935833',
					'alter_hover'      => '#774423',
					'alter_link2'      => '#2750AD',
					'alter_hover2'     => '#0246B5',
					'alter_link3'      => '#CC6523',
					'alter_hover3'     => '#AC4E13',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#DDDDDD',
					'extra_light'      => '#A7A7A7',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#935833',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent',
					'input_bg_hover'   => 'transparent',
					'input_bd_color'   => '#DED4CC',
					'input_bd_hover'   => '#BFBFC1',
					'input_text'       => '#83817F',
					'input_light'      => '#A7A7A7',
					'input_dark'       => '#02164E',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#02164E',
					'inverse_link'     => '#FFFFFF',
					'inverse_hover'    => '#FFFFFF',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'brown_dark'
			'brown_dark'    => array(
				'title'    => esc_html__( 'Brown Dark', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#141414',
					'bd_color'         => '#3F3F3F',

					// Text and links colors
					'text'             => '#D1D1D1',
					'text_light'       => '#B1B1B1',
					'text_dark'        => '#FFFFFF',
					'text_link'        => '#935833',
					'text_hover'       => '#774423',
					'text_link2'       => '#2750AD',
					'text_hover2'      => '#0246B5',
					'text_link3'       => '#CC6523',
					'text_hover3'      => '#AC4E13',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#1D1D1D',
					'alter_bg_hover'   => '#282D39',
					'alter_bd_color'   => '#333846',
					'alter_bd_hover'   => '#404655',
					'alter_text'       => '#D1D1D1',
					'alter_light'      => '#B1B1B1',
					'alter_dark'       => '#FFFFFF',
					'alter_link'       => '#935833',
					'alter_hover'      => '#774423',
					'alter_link2'      => '#2750AD',
					'alter_hover2'     => '#0246B5',
					'alter_link3'      => '#CC6523',
					'alter_hover3'     => '#AC4E13',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#D1D1D1',
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#935833',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => '#transparent',
					'input_bg_hover'   => '#transparent',
					'input_bd_color'   => '#333846',
					'input_bd_hover'   => '#404655',
					'input_text'       => '#D1D1D1',
					'input_light'      => '#B1B1B1',
					'input_dark'       => '#FFFFFF',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#e36650',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#02164E',
					'inverse_light'    => '#6f6f6f',
					'inverse_dark'     => '#02164E',
					'inverse_link'     => '#FFFFFF',
					'inverse_hover'    => '#02164E',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

            // Color scheme: 'brown_light'
            'brown_light' => array(
                'title'    => esc_html__( 'Brown Light', 'wd' ),
                'internal' => true,
                'colors'   => array(

                    // Whole block border and background
                    'bg_color'         => '#FFFFFF',
                    'bd_color'         => '#DED4CC',

                    // Text and links colors
                    'text'             => '#83817F',
                    'text_light'       => '#A7A7A7',
                    'text_dark'        => '#02164E',
                    'text_link'        => '#935833',
                    'text_hover'       => '#774423',
                    'text_link2'       => '#2750AD',
                    'text_hover2'      => '#0246B5',
                    'text_link3'       => '#CC6523',
                    'text_hover3'      => '#AC4E13',

                    // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                    'alter_bg_color'   => '#FCF8F5',
                    'alter_bg_hover'   => '#FFFFFF',
                    'alter_bd_color'   => '#DED4CC',
                    'alter_bd_hover'   => '#BFBFC1',
                    'alter_text'       => '#83817F',
                    'alter_light'      => '#A7A7A7',
                    'alter_dark'       => '#02164E',
                    'alter_link'       => '#935833',
                    'alter_hover'      => '#774423',
                    'alter_link2'      => '#2750AD',
                    'alter_hover2'     => '#0246B5',
                    'alter_link3'      => '#CC6523',
                    'alter_hover3'     => '#AC4E13',

                    // Extra blocks (submenu, tabs, color blocks, etc.)
                    'extra_bg_color'   => '#272727',
                    'extra_bg_hover'   => '#2E2E2E',
                    'extra_bd_color'   => '#313131',
                    'extra_bd_hover'   => '#575757',
                    'extra_text'       => '#D1D1D1',
                    'extra_light'      => '#afafaf',
                    'extra_dark'       => '#FFFFFF',
                    'extra_link'       => '#935833',
                    'extra_hover'      => '#FFFFFF',
                    'extra_link2'      => '#80d572',
                    'extra_hover2'     => '#8be77c',
                    'extra_link3'      => '#ddb837',
                    'extra_hover3'     => '#eec432',

                    // Input fields (form's fields and textarea)
                    'input_bg_color'   => 'transparent',
                    'input_bg_hover'   => 'transparent',
                    'input_bd_color'   => '#DED4CC',
                    'input_bd_hover'   => '#BFBFC1',
                    'input_text'       => '#83817F',
                    'input_light'      => '#A7A7A7',
                    'input_dark'       => '#02164E',

                    // Inverse blocks (text and links on the 'text_link' background)
                    'inverse_bd_color' => '#67bcc1',
                    'inverse_bd_hover' => '#5aa4a9',
                    'inverse_text'     => '#1d1d1d',
                    'inverse_light'    => '#333333',
                    'inverse_dark'     => '#02164E',
                    'inverse_link'     => '#FFFFFF',
                    'inverse_hover'    => '#FFFFFF',

                    // Additional (skin-specific) colors.
                    // Attention! Set of colors must be equal in all color schemes.
                    //---> For example:
                    //---> 'new_color1'         => '#rrggbb',
                    //---> 'alter_new_color1'   => '#rrggbb',
                    //---> 'inverse_new_color1' => '#rrggbb',
                ),
            ),

			// Color scheme: 'gold_default'
			'gold_default' => array(
				'title'    => esc_html__( 'Gold Default', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#F8F7F5',
					'bd_color'         => '#DDDAD7',

					// Text and links colors
					'text'             => '#817870',
					'text_light'       => '#A7A7A7',
					'text_dark'        => '#1A0C01',
					'text_link'        => '#C19A5B',
					'text_hover'       => '#A27C3F',
					'text_link2'       => '#C1AD5B',
					'text_hover2'      => '#A79449',
					'text_link3'       => '#CC6523',
					'text_hover3'      => '#AC4E13',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#FFFFFF',
					'alter_bg_hover'   => '#EAEAEA',
					'alter_bd_color'   => '#DDDAD7',
					'alter_bd_hover'   => '#BFBFC1',
					'alter_text'       => '#817870',
					'alter_light'      => '#A7A7A7',
					'alter_dark'       => '#1A0C01',
					'alter_link'       => '#C19A5B',
					'alter_hover'      => '#A27C3F',
					'alter_link2'      => '#C1AD5B',
					'alter_hover2'     => '#A79449',
					'alter_link3'      => '#CC6523',
					'alter_hover3'     => '#AC4E13',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#DDDDDD',
					'extra_light'      => '#A7A7A7',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#C19A5B',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => 'transparent',
					'input_bg_hover'   => 'transparent',
					'input_bd_color'   => '#DDDAD7',
					'input_bd_hover'   => '#BFBFC1',
					'input_text'       => '#817870',
					'input_light'      => '#A7A7A7',
					'input_dark'       => '#1A0C01',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#67bcc1',
					'inverse_bd_hover' => '#5aa4a9',
					'inverse_text'     => '#1d1d1d',
					'inverse_light'    => '#333333',
					'inverse_dark'     => '#1A0C01',
					'inverse_link'     => '#FFFFFF',
					'inverse_hover'    => '#FFFFFF',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

			// Color scheme: 'gold_dark'
			'gold_dark'    => array(
				'title'    => esc_html__( 'Gold Dark', 'wd' ),
				'internal' => true,
				'colors'   => array(

					// Whole block border and background
					'bg_color'         => '#141414',
					'bd_color'         => '#3F3F3F',

					// Text and links colors
					'text'             => '#D1D1D1',
					'text_light'       => '#B1B1B1',
					'text_dark'        => '#FFFFFF',
					'text_link'        => '#C19A5B',
					'text_hover'       => '#A27C3F',
					'text_link2'       => '#C1AD5B',
					'text_hover2'      => '#A79449',
					'text_link3'       => '#CC6523',
					'text_hover3'      => '#AC4E13',

					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'   => '#1D1D1D',
					'alter_bg_hover'   => '#282D39',
					'alter_bd_color'   => '#333846',
					'alter_bd_hover'   => '#404655',
					'alter_text'       => '#D1D1D1',
					'alter_light'      => '#B1B1B1',
					'alter_dark'       => '#FFFFFF',
					'alter_link'       => '#C19A5B',
					'alter_hover'      => '#A27C3F',
					'alter_link2'      => '#C1AD5B',
					'alter_hover2'     => '#A79449',
					'alter_link3'      => '#CC6523',
					'alter_hover3'     => '#AC4E13',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'   => '#272727',
					'extra_bg_hover'   => '#2E2E2E',
					'extra_bd_color'   => '#313131',
					'extra_bd_hover'   => '#575757',
					'extra_text'       => '#D1D1D1',
					'extra_light'      => '#afafaf',
					'extra_dark'       => '#FFFFFF',
					'extra_link'       => '#C19A5B',
					'extra_hover'      => '#FFFFFF',
					'extra_link2'      => '#80d572',
					'extra_hover2'     => '#8be77c',
					'extra_link3'      => '#ddb837',
					'extra_hover3'     => '#eec432',

					// Input fields (form's fields and textarea)
					'input_bg_color'   => '#transparent',
					'input_bg_hover'   => '#transparent',
					'input_bd_color'   => '#333846',
					'input_bd_hover'   => '#404655',
					'input_text'       => '#D1D1D1',
					'input_light'      => '#B1B1B1',
					'input_dark'       => '#FFFFFF',

					// Inverse blocks (text and links on the 'text_link' background)
					'inverse_bd_color' => '#e36650',
					'inverse_bd_hover' => '#cb5b47',
					'inverse_text'     => '#1A0C01',
					'inverse_light'    => '#6f6f6f',
					'inverse_dark'     => '#1A0C01',
					'inverse_link'     => '#FFFFFF',
					'inverse_hover'    => '#1A0C01',

					// Additional (skin-specific) colors.
					// Attention! Set of colors must be equal in all color schemes.
					//---> For example:
					//---> 'new_color1'         => '#rrggbb',
					//---> 'alter_new_color1'   => '#rrggbb',
					//---> 'inverse_new_color1' => '#rrggbb',
				),
			),

            // Color scheme: 'gold_light'
            'gold_light' => array(
                'title'    => esc_html__( 'Gold Light', 'wd' ),
                'internal' => true,
                'colors'   => array(

                    // Whole block border and background
                    'bg_color'         => '#FFFFFF',
                    'bd_color'         => '#DDDAD7',

                    // Text and links colors
                    'text'             => '#817870',
                    'text_light'       => '#A7A7A7',
                    'text_dark'        => '#1A0C01',
                    'text_link'        => '#C19A5B',
                    'text_hover'       => '#A27C3F',
                    'text_link2'       => '#C1AD5B',
                    'text_hover2'      => '#A79449',
                    'text_link3'       => '#CC6523',
                    'text_hover3'      => '#AC4E13',

                    // Alternative blocks (sidebar, tabs, alternative blocks, etc.)
                    'alter_bg_color'   => '#F8F7F5',
                    'alter_bg_hover'   => '#FFFFFF',
                    'alter_bd_color'   => '#DDDAD7',
                    'alter_bd_hover'   => '#BFBFC1',
                    'alter_text'       => '#817870',
                    'alter_light'      => '#A7A7A7',
                    'alter_dark'       => '#1A0C01',
                    'alter_link'       => '#C19A5B',
                    'alter_hover'      => '#A27C3F',
                    'alter_link2'      => '#C1AD5B',
                    'alter_hover2'     => '#A79449',
                    'alter_link3'      => '#CC6523',
                    'alter_hover3'     => '#AC4E13',

                    // Extra blocks (submenu, tabs, color blocks, etc.)
                    'extra_bg_color'   => '#272727',
                    'extra_bg_hover'   => '#2E2E2E',
                    'extra_bd_color'   => '#313131',
                    'extra_bd_hover'   => '#575757',
                    'extra_text'       => '#D1D1D1',
                    'extra_light'      => '#afafaf',
                    'extra_dark'       => '#FFFFFF',
                    'extra_link'       => '#C19A5B',
                    'extra_hover'      => '#FFFFFF',
                    'extra_link2'      => '#80d572',
                    'extra_hover2'     => '#8be77c',
                    'extra_link3'      => '#ddb837',
                    'extra_hover3'     => '#eec432',

                    // Input fields (form's fields and textarea)
                    'input_bg_color'   => 'transparent',
                    'input_bg_hover'   => 'transparent',
                    'input_bd_color'   => '#DDDAD7',
                    'input_bd_hover'   => '#BFBFC1',
                    'input_text'       => '#817870',
                    'input_light'      => '#A7A7A7',
                    'input_dark'       => '#1A0C01',

                    // Inverse blocks (text and links on the 'text_link' background)
                    'inverse_bd_color' => '#67bcc1',
                    'inverse_bd_hover' => '#5aa4a9',
                    'inverse_text'     => '#1d1d1d',
                    'inverse_light'    => '#333333',
                    'inverse_dark'     => '#1A0C01',
                    'inverse_link'     => '#FFFFFF',
                    'inverse_hover'    => '#FFFFFF',

                    // Additional (skin-specific) colors.
                    // Attention! Set of colors must be equal in all color schemes.
                    //---> For example:
                    //---> 'new_color1'         => '#rrggbb',
                    //---> 'alter_new_color1'   => '#rrggbb',
                    //---> 'inverse_new_color1' => '#rrggbb',
                ),
            ),
		);
		wd_storage_set( 'schemes', $schemes );
		wd_storage_set( 'schemes_original', $schemes );

		// Add names of additional colors
		//---> For example:
		//---> wd_storage_set_array( 'scheme_color_names', 'new_color1', array(
		//---> 	'title'       => __( 'New color 1', 'wd' ),
		//---> 	'description' => __( 'Description of the new color 1', 'wd' ),
		//---> ) );


		// Additional colors for each scheme
		// Parameters:	'color' - name of the color from the scheme that should be used as source for the transformation
		//				'alpha' - to make color transparent (0.0 - 1.0)
		//				'hue', 'saturation', 'brightness' - inc/dec value for each color's component
		wd_storage_set(
			'scheme_colors_add', array(
				'bg_color_0'        => array(
					'color' => 'bg_color',
					'alpha' => 0,
				),
				'bg_color_02'       => array(
					'color' => 'bg_color',
					'alpha' => 0.2,
				),
				'bg_color_07'       => array(
					'color' => 'bg_color',
					'alpha' => 0.7,
				),
				'bg_color_08'       => array(
					'color' => 'bg_color',
					'alpha' => 0.8,
				),
				'bg_color_09'       => array(
					'color' => 'bg_color',
					'alpha' => 0.9,
				),
				'alter_bg_color_07' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.7,
				),
				'alter_bg_color_04' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.4,
				),
				'alter_bg_color_00' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0,
				),
				'alter_bg_color_02' => array(
					'color' => 'alter_bg_color',
					'alpha' => 0.2,
				),
				'alter_bd_color_02' => array(
					'color' => 'alter_bd_color',
					'alpha' => 0.2,
				),
                'alter_dark_015'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.15,
                ),
                'alter_dark_02'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.2,
                ),
                'alter_dark_05'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.5,
                ),
                'alter_dark_08'     => array(
                    'color' => 'alter_dark',
                    'alpha' => 0.8,
                ),
				'alter_link_02'     => array(
					'color' => 'alter_link',
					'alpha' => 0.2,
				),
				'alter_link_07'     => array(
					'color' => 'alter_link',
					'alpha' => 0.7,
				),
				'extra_bg_color_05' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.5,
				),
				'extra_bg_color_07' => array(
					'color' => 'extra_bg_color',
					'alpha' => 0.7,
				),
				'extra_link_02'     => array(
					'color' => 'extra_link',
					'alpha' => 0.2,
				),
				'extra_link_07'     => array(
					'color' => 'extra_link',
					'alpha' => 0.7,
				),
                'text_dark_003'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.03,
                ),
                'text_dark_005'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.05,
                ),
                'text_dark_008'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.08,
                ),
				'text_dark_015'      => array(
					'color' => 'text_dark',
					'alpha' => 0.15,
				),
				'text_dark_02'      => array(
					'color' => 'text_dark',
					'alpha' => 0.2,
				),
                'text_dark_03'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.3,
                ),
                'text_dark_05'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.5,
                ),
				'text_dark_07'      => array(
					'color' => 'text_dark',
					'alpha' => 0.7,
				),
                'text_dark_08'      => array(
                    'color' => 'text_dark',
                    'alpha' => 0.8,
                ),
                'text_link_007'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.07,
                ),
				'text_link_02'      => array(
					'color' => 'text_link',
					'alpha' => 0.2,
				),
                'text_link_03'      => array(
                    'color' => 'text_link',
                    'alpha' => 0.3,
                ),
				'text_link_04'      => array(
					'color' => 'text_link',
					'alpha' => 0.4,
				),
				'text_link_07'      => array(
					'color' => 'text_link',
					'alpha' => 0.7,
				),
				'text_link2_08'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.8,
                ),
                'text_link2_007'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.07,
                ),
				'text_link2_02'      => array(
					'color' => 'text_link2',
					'alpha' => 0.2,
				),
                'text_link2_03'      => array(
                    'color' => 'text_link2',
                    'alpha' => 0.3,
                ),
				'text_link2_05'      => array(
					'color' => 'text_link2',
					'alpha' => 0.5,
				),
                'text_link3_007'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.07,
                ),
				'text_link3_02'      => array(
					'color' => 'text_link3',
					'alpha' => 0.2,
				),
                'text_link3_03'      => array(
                    'color' => 'text_link3',
                    'alpha' => 0.3,
                ),
                'inverse_text_03'      => array(
                    'color' => 'inverse_text',
                    'alpha' => 0.3,
                ),
                'inverse_link_08'      => array(
                    'color' => 'inverse_link',
                    'alpha' => 0.8,
                ),
                'inverse_hover_08'      => array(
                    'color' => 'inverse_hover',
                    'alpha' => 0.8,
                ),
				'text_dark_blend'   => array(
					'color'      => 'text_dark',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'text_link_blend'   => array(
					'color'      => 'text_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
				'alter_link_blend'  => array(
					'color'      => 'alter_link',
					'hue'        => 2,
					'saturation' => -5,
					'brightness' => 5,
				),
			)
		);

		// Simple scheme editor: lists the colors to edit in the "Simple" mode.
		// For each color you can set the array of 'slave' colors and brightness factors that are used to generate new values,
		// when 'main' color is changed
		// Leave 'slave' arrays empty if your scheme does not have a color dependency
		wd_storage_set(
			'schemes_simple', array(
				'text_link'        => array(),
				'text_hover'       => array(),
				'text_link2'       => array(),
				'text_hover2'      => array(),
				'text_link3'       => array(),
				'text_hover3'      => array(),
				'alter_link'       => array(),
				'alter_hover'      => array(),
				'alter_link2'      => array(),
				'alter_hover2'     => array(),
				'alter_link3'      => array(),
				'alter_hover3'     => array(),
				'extra_link'       => array(),
				'extra_hover'      => array(),
				'extra_link2'      => array(),
				'extra_hover2'     => array(),
				'extra_link3'      => array(),
				'extra_hover3'     => array(),
			)
		);

		// Parameters to set order of schemes in the css
		wd_storage_set(
			'schemes_sorted', array(
				'color_scheme',
				'header_scheme',
				'menu_scheme',
				'sidebar_scheme',
				'footer_scheme',
			)
		);

		// Color presets
		wd_storage_set(
			'color_presets', array(
				'autumn' => array(
								'title'  => esc_html__( 'Autumn', 'wd' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	),
												'dark' => array(
																	'text_link'  => '#d83938',
																	'text_hover' => '#f2b232',
																	)
												)
							),
				'green' => array(
								'title'  => esc_html__( 'Natural Green', 'wd' ),
								'colors' => array(
												'default' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	),
												'dark' => array(
																	'text_link'  => '#75ac78',
																	'text_hover' => '#378e6d',
																	)
												)
							),
			)
		);
	}
}


//Activation methods
if ( ! function_exists( 'wd_skin_filter_activation_methods2' ) ) {
    add_filter( 'trx_addons_filter_activation_methods', 'wd_skin_filter_activation_methods2', 11, 1 );
    function wd_skin_filter_activation_methods2( $args ) {
        $args['elements_key'] = true;
        return $args;
    }
}


//Enqueue skin-specific scripts
if ( ! function_exists( 'wd_skin_upgrade_style' ) ) {
	add_action( 'wp_enqueue_scripts', 'wd_skin_upgrade_style', 2060 );
	function wd_skin_upgrade_style() {
		$wd_url = wd_get_file_url( wd_skins_get_current_skin_dir() . 'skin-upgrade-style.css' );	
		if ( '' != $wd_url ) {
			wp_enqueue_style( 'wd-skin-upgrade-style' . esc_attr( wd_skins_get_current_skin_name() ), $wd_url, array(), null );
		}
	}
}