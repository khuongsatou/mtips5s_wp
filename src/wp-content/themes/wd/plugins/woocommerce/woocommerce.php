<?php
/* WooCommerce support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 0 - include theme-specific extensions
if ( ! function_exists( 'wd_woocommerce_theme_setup0' ) ) {
	add_action( 'after_setup_theme', 'wd_woocommerce_theme_setup0', 0 );
	function wd_woocommerce_theme_setup0() {
		// Check if theme/skin needs for extended functionality of WooCommerce
		if ( apply_filters( 'wd_filter_load_woocommerce_extensions', false ) ) {
			$extensions_file = wd_get_file_dir( 'plugins/woocommerce/woocommerce-extensions.php' );
			if ( ! empty( $extensions_file ) ) {
				require_once $extensions_file;
			}
		}
	}
}

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if ( ! function_exists( 'wd_woocommerce_theme_setup1' ) ) {
	add_action( 'after_setup_theme', 'wd_woocommerce_theme_setup1', 1 );
	function wd_woocommerce_theme_setup1() {
		// Add new sidebar for WooCommerce
		add_filter( 'wd_filter_list_sidebars', 'wd_woocommerce_list_sidebars' );

		// Add 'product' to the list with supported post types
		add_filter( 'wd_filter_list_posts_types', 'wd_woocommerce_list_post_types' );

		// 'Product Grid' feature (need before theme-init priority 3)
		add_theme_support( 'wc-product-grid-enable', wd_woocommerce_detect_product_grid_support() );
	}
}


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'wd_woocommerce_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'wd_woocommerce_theme_setup9', 9 );
	function wd_woocommerce_theme_setup9() {

		if ( wd_exists_woocommerce() ) {

			// Theme-specific parameters for WooCommerce
			//---------------------------------------------
			add_theme_support(
				'woocommerce', array(
					// Image width for thumbnails gallery
					'gallery_thumbnail_image_width' => 150,

					// Image width for the catalog images: 'thumbnail_image_width' => 300,
					// Attention! If you set this parameter - WooCommerce hide relative control from Customizer

					// Image width for the single product image: 'single_image_width' => 600,
					// Attention! If you set this parameter - WooCommerce hide relative control from Customizer
				)
			);

			// Next setting from the WooCommerce 3.0+ enable built-in image slider on the single product page
			add_theme_support( 'wc-product-gallery-slider' );

			// Next setting from the WooCommerce 3.0+ enable built-in image zoom on the single product page
			add_theme_support( 'wc-product-gallery-zoom' );

			// Next setting from the WooCommerce 3.0+ enable built-in image lightbox on the single product page
			add_theme_support( 'wc-product-gallery-lightbox' );

			// Disable WooCommerce ads
			add_filter( 'woocommerce_allow_marketplace_suggestions', '__return_false' );

			// Theme-specific handlers for WooCommerce
			//---------------------------------------------
			add_action( 'wp_enqueue_scripts', 'wd_woocommerce_frontend_scripts', 1100 );
			add_action( 'trx_addons_action_load_scripts_front_woocommerce', 'wd_woocommerce_frontend_scripts', 10, 1 );
			add_action( 'wp_enqueue_scripts', 'wd_woocommerce_frontend_scripts_responsive', 2000 );
			add_action( 'trx_addons_action_load_scripts_front_woocommerce', 'wd_woocommerce_frontend_scripts_responsive', 10, 1 );
			add_filter( 'wd_filter_merge_styles', 'wd_woocommerce_merge_styles' );
			add_filter( 'wd_filter_merge_styles_responsive', 'wd_woocommerce_merge_styles_responsive' );
			add_filter( 'wd_filter_merge_scripts', 'wd_woocommerce_merge_scripts' );
			add_filter( 'wd_filter_get_post_info', 'wd_woocommerce_get_post_info' );
			add_filter( 'wd_filter_post_type_taxonomy', 'wd_woocommerce_post_type_taxonomy', 10, 2 );
			add_action( 'wd_action_override_theme_options', 'wd_woocommerce_override_theme_options' );
			add_filter( 'wd_filter_detect_blog_mode', 'wd_woocommerce_detect_blog_mode' );
			add_filter( 'wd_filter_get_post_categories', 'wd_woocommerce_get_post_categories', 10, 2 );
			add_filter( 'wd_filter_allow_override_header_image', 'wd_woocommerce_allow_override_header_image' );
			add_filter( 'wd_filter_get_blog_title', 'wd_woocommerce_get_blog_title' );
			add_action( 'wd_action_before_post_meta', 'wd_woocommerce_action_before_post_meta' );

			if ( ! is_admin() ) {
				add_action( 'pre_get_posts', 'wd_woocommerce_pre_get_posts' );
				add_filter( 'wd_filter_sidebar_control_text', 'wd_woocommerce_sidebar_control_text' );
				add_filter( 'wd_filter_sidebar_control_title', 'wd_woocommerce_sidebar_control_title' );
			}

			// Add wrappers and classes to the standard WooCommerce output
			//---------------------------------------------------------------

			// Remove WOOC sidebar
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

			// Remove link around product item
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

			// Move buttons 'Add to Wishlist', 'Compare' and 'Quick View' to the single wrapper
			add_action( 'woocommerce_after_shop_loop_item', 'wd_woocommerce_add_wishlist_wrap', 19 );
			add_action( 'woocommerce_after_shop_loop_item', 'wd_woocommerce_add_wishlist_link', 20 );

			// Remove link around product category
			remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
			remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );

			// Detect we are inside subcategory
			add_action( 'woocommerce_before_subcategory', 'wd_woocommerce_before_subcategory', 1 );
			add_action( 'woocommerce_after_subcategory', 'wd_woocommerce_after_subcategory', 9999 );

			// Open main content wrapper - <article>
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			add_action( 'woocommerce_before_main_content', 'wd_woocommerce_wrapper_start', 10 );
			// Close main content wrapper - </article>
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			add_action( 'woocommerce_after_main_content', 'wd_woocommerce_wrapper_end', 10 );

			// Close header section
			add_action( 'woocommerce_after_main_content', 'wd_woocommerce_archive_description', 1 );
			add_action( 'woocommerce_before_shop_loop', 'wd_woocommerce_archive_description', 5 );
			add_action( 'woocommerce_no_products_found', 'wd_woocommerce_archive_description', 5 );

			// Add theme specific search form
			add_filter( 'get_product_search_form', 'wd_woocommerce_get_product_search_form' );
			add_filter( 'wd_filter_search_form_url', 'wd_woocommerce_search_form_url' );

			// Change text on 'Add to cart' button
			add_filter( 'woocommerce_product_add_to_cart_text', 'wd_woocommerce_add_to_cart_text' );
			add_filter( 'woocommerce_product_single_add_to_cart_text', 'wd_woocommerce_add_to_cart_text' );

			// Wrap 'Add to cart' button
			add_filter( 'woocommerce_loop_add_to_cart_link', 'wd_woocommerce_add_to_cart_link', 10, 3 );

			// Add list mode buttons
			add_action( 'woocommerce_before_shop_loop', 'wd_woocommerce_before_shop_loop', 10 );

			// Show 'No products' if no search results and display mode 'both'
			add_action( 'woocommerce_after_shop_loop', 'wd_woocommerce_after_shop_loop', 1 );

			// Set columns number for the products loop
			if ( ! get_theme_support( 'wc-product-grid-enable' ) ) {
				add_filter( 'loop_shop_columns', 'wd_woocommerce_loop_shop_columns' );
				add_filter( 'post_class', 'wd_woocommerce_loop_shop_columns_class' );
				add_filter( 'product_cat_class', 'wd_woocommerce_loop_shop_columns_class', 10, 3 );
			}

			// Set size of the thumbnail in the products loop
			add_filter( 'single_product_archive_thumbnail_size', 'wd_woocommerce_single_product_archive_thumbnail_size' );
			
			// Add 'with-thumbs' or 'without-thumbs' class to the single product gallery
			add_filter( 'woocommerce_single_product_image_gallery_classes', 'wd_woocommerce_add_thumbs_present_class' );

			// Open product/category item wrapper
			add_action( 'woocommerce_before_subcategory_title', 'wd_woocommerce_item_wrapper_start', 9 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_woocommerce_item_wrapper_start', 9 );
			// Close featured image wrapper and open title wrapper
			add_action( 'woocommerce_before_subcategory_title', 'wd_woocommerce_title_wrapper_start', 20 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_woocommerce_title_wrapper_start', 20 );

			// Add tags before a title
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_woocommerce_title_tags', 30 );

			// Wrap a product title with a link
			add_filter( 'the_title', 'wd_woocommerce_the_title' );
			// Wrap a category title with a link (from WooCommerce 3.2.2+ )
			add_action( 'woocommerce_before_subcategory_title', 'wd_woocommerce_before_subcategory_title', 22, 1 );
			add_action( 'woocommerce_after_subcategory_title', 'wd_woocommerce_after_subcategory_title', 2, 1 );

			// Close a title wrapper and add a description in the list mode
			add_action( 'woocommerce_after_shop_loop_item_title', 'wd_woocommerce_title_wrapper_end', 7 );
			add_action( 'woocommerce_after_subcategory_title', 'wd_woocommerce_title_wrapper_end2', 10 );
			// Close a product/category item wrapper
			add_action( 'woocommerce_after_subcategory', 'wd_woocommerce_item_wrapper_end', 20 );
			add_action( 'woocommerce_after_shop_loop_item', 'wd_woocommerce_item_wrapper_end', 20 );

			// Add product ID into product meta section (after categories and tags)
			add_action( 'woocommerce_product_meta_end', 'wd_woocommerce_show_product_id', 10 );

			// Set columns number for the product's thumbnails
			add_filter( 'woocommerce_product_thumbnails_columns', 'wd_woocommerce_product_thumbnails_columns' );

			// Wrap price (WooCommerce use priority 10 to output price)
			add_action( 'woocommerce_after_shop_loop_item_title', 'wd_woocommerce_price_wrapper_start', 9 );
			add_action( 'woocommerce_after_shop_loop_item_title', 'wd_woocommerce_price_wrapper_end', 11 );

			// Decorate price
			add_filter( 'woocommerce_get_price_html', 'wd_woocommerce_get_price_html' );

			// Add 'Out of stock' label
			add_action( 'wd_action_woocommerce_item_featured_link_start', 'wd_woocommerce_add_out_of_stock_label' );

			// Decorate 'Sale' label
			add_filter( 'woocommerce_sale_flash', 'wd_woocommerce_add_sale_percent', 10, 3 );

			// Add custom paginations to the loop
			add_action( 'woocommerce_after_shop_loop', 'wd_woocommerce_pagination', 9 );

			// Add WooCommerce-specific classes
			add_filter( 'body_class', 'wd_woocommerce_add_body_classes' );

			// Search theme-specific templates in the skin dir (if exists)
			add_filter( 'woocommerce_locate_template', 'wd_woocommerce_locate_template', 100, 3 );
			add_filter( 'wc_get_template_part', 'wd_woocommerce_get_template_part', 100, 3 );

			// Add theme-specific layouts of products for the shop page and shortcodes
			add_filter( 'trx_addons_filter_woocommerce_products_layouts', 'wd_woocommerce_add_product_layouts' );

			// Detect current shop mode
			if ( ! is_admin() ) {
				$shop_mode = wd_get_value_gp( 'shop_mode' );
				if ( empty( $shop_mode ) ) {
					$shop_mode = wd_get_value_gpc( 'wd_shop_mode' );
				}
				if ( empty( $shop_mode ) && wd_check_theme_option( 'shop_mode' ) ) {
					$shop_mode = wd_get_theme_option( 'shop_mode' );
				}
				if ( empty( $shop_mode ) ) {
					$shop_mode = 'thumbs';
				}
				wd_storage_set( 'shop_mode', $shop_mode );
			}

			// Redirect theme-specific filters to the plugin
			if ( wd_exists_trx_addons() ) {
				add_filter( 'wd_filter_woocommerce_show_breadcrumbs', 'wd_woocommerce_trx_addons_show_breadcrumbs' );
				add_filter( 'wd_filter_woocommerce_show_title', 'wd_woocommerce_trx_addons_show_title' );
				add_filter( 'wd_filter_woocommerce_show_description', 'wd_woocommerce_trx_addons_show_description' );
			}
		}

		if ( is_admin() ) {
			add_filter( 'wd_filter_tgmpa_required_plugins', 'wd_woocommerce_tgmpa_required_plugins' );
			add_filter( 'trx_addons_filter_export_options', 'wd_woocommerce_export_options');
		}
	}
}

// Theme init priorities:
// Action 'wp'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)
if ( ! function_exists( 'wd_woocommerce_theme_setup_wp' ) ) {
	add_action( 'wp', 'wd_woocommerce_theme_setup_wp' );
	function wd_woocommerce_theme_setup_wp() {
		if ( wd_exists_woocommerce() ) {
			// Set columns number for the related products
			if ( (int)wd_get_theme_option( 'show_related_posts' ) == 0 || (int)wd_get_theme_option( 'related_posts' ) == 0 ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			} else {
				add_filter( 'woocommerce_output_related_products_args', 'wd_woocommerce_output_related_products_args' );
				add_filter( 'woocommerce_related_products_columns', 'wd_woocommerce_related_products_columns' );
				add_filter( 'woocommerce_cross_sells_columns', 'wd_woocommerce_related_products_columns' );
				add_filter( 'woocommerce_upsells_columns', 'wd_woocommerce_related_products_columns' );
			}
			// Decorate breadcrumbs
			add_filter( 'woocommerce_breadcrumb_defaults', 'wd_woocommerce_breadcrumb_defaults' );
		}
	}
}

// Move buttons 'Add to Wishlist', 'Compare' and 'Quick View' to the single wrapper
if ( ! function_exists( 'wd_woocommerce_theme_setup_init' ) ) {
	add_action( 'init', 'wd_woocommerce_theme_setup_init', 20 );
	function wd_woocommerce_theme_setup_init() {
		if ( wd_exists_woocommerce() ) {
			if ( function_exists( 'trx_addons_remove_action' ) && apply_filters( 'wd_filter_woocommerce_yith_group_buttons', false ) ) {
				$old_cb = trx_addons_remove_action( 'woocommerce_after_shop_loop_item', 'yith_add_quick_view_button', 'YITH_WCQV_Frontend' );
				if ( ! empty( $old_cb['callback']['function'] ) ) {
					add_action( 'wd_action_woocommerce_yith_button_quick_view', $old_cb['callback']['function'] );
				}
				$old_cb = trx_addons_remove_action( 'woocommerce_after_shop_loop_item', 'add_compare_link', 'YITH_Woocompare_Frontend' );
				if ( ! empty( $old_cb['callback']['function'] ) ) {
					add_action( 'wd_action_woocommerce_yith_button_compare', $old_cb['callback']['function'] );
				}
				$old_cb = trx_addons_remove_action( 'woocommerce_after_shop_loop_item', 'print_button', 'YITH_WCWL_Frontend' );
				if ( ! empty( $old_cb['callback']['function'] ) ) {
					add_action( 'wd_action_woocommerce_yith_button_wishlist', $old_cb['callback']['function'] );
				}
				$old_cb = trx_addons_remove_action( 'woocommerce_before_shop_loop_item', 'print_button', 'YITH_WCWL_Frontend' );
				if ( ! empty( $old_cb['callback']['function'] ) ) {
					add_action( 'wd_action_woocommerce_yith_button_wishlist', $old_cb['callback']['function'] );
				}
			}
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'wd_woocommerce_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('wd_filter_tgmpa_required_plugins',	'wd_woocommerce_tgmpa_required_plugins');
	function wd_woocommerce_tgmpa_required_plugins( $list = array() ) {
		if ( wd_storage_isset( 'required_plugins', 'woocommerce' ) && wd_storage_get_array( 'required_plugins', 'woocommerce', 'install' ) !== false ) {
			$list[] = array(
				'name'     => wd_storage_get_array( 'required_plugins', 'woocommerce', 'title' ),
				'slug'     => 'woocommerce',
				'required' => false,
			);
		}
		return $list;
	}
}


// Theme init priorities:
// 3 - add/remove Theme Options elements
if ( ! function_exists( 'wd_woocommerce_theme_setup3' ) ) {
	add_action( 'after_setup_theme', 'wd_woocommerce_theme_setup3', 3 );
	function wd_woocommerce_theme_setup3() {
		if ( wd_exists_woocommerce() ) {

			// Panel 'Shop' with theme-specific options
			wd_storage_set_array_before(
				'options', 'fonts', array_merge(
					array(
						'shop'               => array(
							'title'      => esc_html__( 'Shop', 'wd' ),
							'desc'       => wp_kses_data( __( 'Select theme-specific parameters to display the shop pages', 'wd' ) ),
							'priority'   => 80,
							'expand_url' => esc_url( wd_woocommerce_get_shop_page_link() ),
							'icon'       => 'icon-cart-2',
							'type'       => 'panel',
						),
					),
					
					// Section 'Common settings'
					array(
						'shop_general'       => array(
							'title'      => esc_html__( 'General', 'wd' ),
							'desc'       => wp_kses_data( __( 'Common settings for both - product catalog and single product pages', 'wd' ) ),
							'icon'       => 'icon-settings',
							'type'       => 'section',
						),
					),
					wd_options_get_list_cpt_options_body( 'shop', esc_html__( 'Product', 'wd' ) ),
					wd_options_get_list_cpt_options_widgets( 'shop', esc_html__( 'Product', 'wd' ) ),

					// Section 'Product list'
					array(
						'shop_list'          => array(
							'title'      => esc_html__( 'Product list', 'wd' ),
							'desc'       => wp_kses_data( __( 'Settings for product catalog', 'wd' ) ),
							'icon'       => 'icon-blog',
							'type'       => 'section',
						),
					),
					array(
						'products_info_shop' => array(
							'title'  => esc_html__( 'Product list', 'wd' ),
							'desc'   => '',
							'qsetup' => esc_html__( 'General', 'wd' ),
							'type'   => 'info',
						),
						'shop_mode'          => array(
							'title'   => esc_html__( 'Shop style', 'wd' ),
							'desc'    => wp_kses_data( __( 'Select style for the products list. Attention! If the visitor has already selected the list type at the top of the page - his choice is saved and has priority over this option', 'wd' ) ),
							'std'     => 'thumbs',
							'options' => array(
								'thumbs' => array(
												'title' => esc_html__( 'Grid', 'wd' ),
												'icon'  => 'images/theme-options/shop/grid.png',
												),
								'list'   => array(
												'title' => esc_html__( 'List', 'wd' ),
												'icon'  => 'images/theme-options/shop/list.png',
												),
							),
							'qsetup'  => esc_html__( 'General', 'wd' ),
							'type'    => 'choice',
						),
					),
					! get_theme_support( 'wc-product-grid-enable' )
					? array(
						'posts_per_page_shop' => array(
							'title' => esc_html__( 'Products per page', 'wd' ),
							'desc'  => wp_kses_data( __( 'How many products should be displayed on the shop page. If empty - use global value from the menu Settings - Reading', 'wd' ) ),
							'std'   => '',
							'type'  => 'text',
						),
						'blog_columns_shop'   => array(
							'title'      => esc_html__( 'Grid columns', 'wd' ),
							'desc'       => wp_kses_data( __( 'How many columns should be used for the shop products in the grid view (from 2 to 4)?', 'wd' ) ),
							'dependency' => array(
								'shop_mode' => array( 'thumbs' ),
							),
							'std'        => 2,
							'options'    => wd_get_list_range( 2, 4 ),
							'type'       => 'select',
						),
					)
					: array(),
					array(
						'blog_animation_shop' => array(
							'title' => esc_html__( 'Product animation (shop page)', 'wd' ),
							'desc' => wp_kses_data( __( 'Select product animation for the shop page. Attention! Do not use any animation on pages with the "wheel to the anchor" behaviour!', 'wd' ) ),
							'std' => 'none',
							'options' => array(),
							'type' => 'select',
						),
						'shop_hover'              => array(
							'title'   => esc_html__( 'Hover style', 'wd' ),
							'desc'    => wp_kses_data( __( 'Hover style on the products in the shop archive', 'wd' ) ),
							'std'     => 'shop_buttons',
							'options' => apply_filters(
								'wd_filter_shop_hover',
								array(
									'none'         => esc_html__( 'None', 'wd' ),
									'shop'         => esc_html__( 'Icons', 'wd' ),
									'shop_buttons' => esc_html__( 'Buttons', 'wd' ),
								)
							),
							'qsetup'  => esc_html__( 'General', 'wd' ),
							'type'    => 'select',
						),
						'shop_pagination'         => array(
							'title'   => esc_html__( 'Pagination style', 'wd' ),
							'desc'    => wp_kses_data( __( 'Pagination style in the shop archive', 'wd' ) ),
							'std'     => 'numbers',
							'options' => apply_filters(
								'wd_filter_shop_pagination',
								array(
									'pages'    => array(
														'title' => esc_html__( 'Page numbers', 'wd' ),
														'icon'  => 'images/theme-options/pagination/page-numbers.png',
														),
									'more'     => array(
														'title' => esc_html__( 'Load more', 'wd' ),
														'icon'  => 'images/theme-options/pagination/load-more.png',
														),
									'infinite' => array(
														'title' => esc_html__( 'Infinite scroll', 'wd' ),
														'icon'  => 'images/theme-options/pagination/infinite-scroll.png',
														),
								)
							),
							'qsetup'  => esc_html__( 'General', 'wd' ),
							'type'    => 'choice',
						),
					),
					wd_options_get_list_cpt_options_header( 'shop', esc_html__( 'Product', 'wd' ), 'list' ),
					wd_options_get_list_cpt_options_sidebar( 'shop', esc_html__( 'Product', 'wd' ), 'list' ),
					wd_options_get_list_cpt_options_footer( 'shop', esc_html__( 'Product', 'wd' ), 'list' ),

					// Section 'Single product'
					array(
						'shop_single'             => array(
							'title'      => esc_html__( 'Single product', 'wd' ),
							'desc'       => wp_kses_data( __( 'Settings for product catalog', 'wd' ) ),
							'icon'       => 'icon-posts-page',
							'type'       => 'section',
						),
					),
					array(
						'single_info_shop'        => array(
							'title' => esc_html__( 'Single product', 'wd' ),
							'desc'  => '',
							'type'  => 'info',
						),
						'single_product_gallery_thumbs' => array(
							'title'      => esc_html__( 'Gallery thumbs position', 'wd' ),
							'desc'       => wp_kses_data( __( 'Specify the thumbs position on the single product page gallery.', 'wd' ) ),
							'std'        => 'bottom',
							'override'   => array(
								'mode'    => 'product',
								'section' => esc_html__( 'Content', 'wd' ),
							),
							'options'    => apply_filters(
															'wd_filter_woocommerce_single_product_gallery_thumbs',
															array(
																'bottom' => esc_html__( 'Bottom', 'wd' ),
																'left'   => esc_html__( 'Left', 'wd' ),
															)
														),
							'type'       => 'select',
						),
						'show_related_posts_shop' => array(
							'title'  => esc_html__( 'Show related products', 'wd' ),
							'desc'   => wp_kses_data( __( "Show 'Related posts' section on single product page", 'wd' ) ),
							'std'    => 1,
							'type'   => 'switch',
						),
						'related_posts_shop'      => array(
							'title'      => esc_html__( 'Related products', 'wd' ),
							'desc'       => wp_kses_data( __( 'How many related products should be displayed on the single product page?', 'wd' ) ),
							'dependency' => array(
								'show_related_posts_shop' => array( 1 ),
							),
							'std'        => 3,
							'options'    => wd_get_list_range( 1, 12 ),
							'type'       => 'select',
						),
						'related_columns_shop'    => array(
							'title'      => esc_html__( 'Related columns', 'wd' ),
							'desc'       => wp_kses_data( __( 'How many columns should be used to output related products on the single product page?', 'wd' ) ),
							'dependency' => array(
								'show_related_posts_shop' => array( 1 ),
							),
							'std'        => 3,
							'options'    => wd_get_list_range( 2, 6 ),
							'type'       => 'select',
						),
					),
					wd_options_get_list_cpt_options_header( 'shop', esc_html__( 'Product', 'wd' ), 'single' ),
					wd_options_get_list_cpt_options_sidebar( 'shop', esc_html__( 'Product', 'wd' ), 'single' ),
					wd_options_get_list_cpt_options_footer( 'shop', esc_html__( 'Product', 'wd' ), 'single' )
				)
			);
			// Set 'WooCommerce Sidebar' as default for all shop pages
			wd_storage_set_array2( 'options', 'sidebar_widgets_shop', 'std', 'woocommerce_widgets' );
		}
	}
}

// Add section 'Products' to the Front Page option
if ( ! function_exists( 'wd_woocommerce_front_page_options' ) ) {
	if ( ! WD_THEME_FREE ) {
		add_filter( 'wd_filter_front_page_options', 'wd_woocommerce_front_page_options' );
	}
	function wd_woocommerce_front_page_options( $options ) {
		if ( wd_exists_woocommerce() ) {
			$options['front_page_sections']['std']    .= ( ! empty( $options['front_page_sections']['std'] ) ? '|' : '' ) . 'woocommerce=1';
			$options['front_page_sections']['options'] = array_merge(
				$options['front_page_sections']['options'],
				array(
					'woocommerce' => esc_html__( 'Products', 'wd' ),
				)
			);
			$options                                   = array_merge(
				$options, array(

					// Front Page Sections - WooCommerce
					'front_page_woocommerce'                     => array(
						'title'    => esc_html__( 'Products', 'wd' ),
						'desc'     => '',
						'priority' => 200,
						'type'     => 'section',
					),
					'front_page_woocommerce_layout_info'         => array(
						'title' => esc_html__( 'Layout', 'wd' ),
						'desc'  => '',
						'type'  => 'info',
					),
					'front_page_woocommerce_fullheight'          => array(
						'title'   => esc_html__( 'Full height', 'wd' ),
						'desc'    => wp_kses_data( __( 'Stretch this section to the window height', 'wd' ) ),
						'std'     => 0,
						'refresh' => false,
						'type'    => 'switch',
					),
					'front_page_woocommerce_stack'               => array(
						'title'      => esc_html__( 'Stack this section', 'wd' ),
						'desc'       => wp_kses_data( __( 'Add the behavior of "a stack" for this section to fix it when you scroll to the top of the screen.', 'wd' ) ),
						'std'        => 0,
						'refresh'    => false,
						'dependency' => array(
							'front_page_woocommerce_fullheight' => array( 1 ),
						),
						'type'       => 'switch',
					),
					'front_page_woocommerce_paddings'            => array(
						'title'   => esc_html__( 'Paddings', 'wd' ),
						'desc'    => wp_kses_data( __( 'Select paddings inside this section', 'wd' ) ),
						'std'     => 'medium',
						'options' => wd_get_list_paddings(),
						'refresh' => false,
						'type'    => 'choice',
					),
					'front_page_woocommerce_heading_info'        => array(
						'title' => esc_html__( 'Title', 'wd' ),
						'desc'  => '',
						'type'  => 'info',
					),
					'front_page_woocommerce_caption'             => array(
						'title'   => esc_html__( 'Section title', 'wd' ),
						'desc'    => '',
						'refresh' => false, // To refresh part of the page: '.front_page_section_woocommerce .front_page_section_woocommerce_caption',
						'std'     => wp_kses_data( __( 'This text can be changed in the section "Products"', 'wd' ) ),
						'type'    => 'text',
					),
					'front_page_woocommerce_description'         => array(
						'title'   => esc_html__( 'Description', 'wd' ),
						'desc'    => wp_kses_data( __( "Short description after the section's title", 'wd' ) ),
						'refresh' => false, // To refresh part of the page: '.front_page_section_woocommerce .front_page_section_woocommerce_description',
						'std'     => wp_kses_data( __( 'This text can be changed in the section "Products"', 'wd' ) ),
						'type'    => 'textarea',
					),
					'front_page_woocommerce_products_info'       => array(
						'title' => esc_html__( 'Products parameters', 'wd' ),
						'desc'  => '',
						'type'  => 'info',
					),
					'front_page_woocommerce_products'            => array(
						'title'   => esc_html__( 'Type of the products', 'wd' ),
						'desc'    => '',
						'std'     => 'products',
						'options' => array(
							'recent_products'       => esc_html__( 'Recent products', 'wd' ),
							'featured_products'     => esc_html__( 'Featured products', 'wd' ),
							'top_rated_products'    => esc_html__( 'Top rated products', 'wd' ),
							'sale_products'         => esc_html__( 'Sale products', 'wd' ),
							'best_selling_products' => esc_html__( 'Best selling products', 'wd' ),
							'product_category'      => esc_html__( 'Products from categories', 'wd' ),
							'products'              => esc_html__( 'Products by IDs', 'wd' ),
						),
						'type'    => 'select',
					),
					'front_page_woocommerce_products_categories' => array(
						'title'      => esc_html__( 'Categories', 'wd' ),
						'desc'       => esc_html__( 'Comma separated category slugs. Used only with "Products from categories"', 'wd' ),
						'dependency' => array(
							'front_page_woocommerce_products' => array( 'product_category' ),
						),
						'std'        => '',
						'type'       => 'text',
					),
					'front_page_woocommerce_products_per_page'   => array(
						'title' => esc_html__( 'Per page', 'wd' ),
						'desc'  => wp_kses_data( __( 'How many products will be displayed on the page. Attention! For "Products by IDs" specify comma separated list of the IDs', 'wd' ) ),
						'std'   => 3,
						'type'  => 'text',
					),
					'front_page_woocommerce_products_columns'    => array(
						'title' => esc_html__( 'Columns', 'wd' ),
						'desc'  => wp_kses_data( __( 'How many columns will be used', 'wd' ) ),
						'std'   => 3,
						'type'  => 'text',
					),
					'front_page_woocommerce_products_orderby'    => array(
						'title'   => esc_html__( 'Order by', 'wd' ),
						'desc'    => wp_kses_data( __( 'Not used with Best selling products', 'wd' ) ),
						'std'     => 'date',
						'options' => array(
							'date'  => esc_html__( 'Date', 'wd' ),
							'title' => esc_html__( 'Title', 'wd' ),
						),
						'type'    => 'radio',
					),
					'front_page_woocommerce_products_order'      => array(
						'title'   => esc_html__( 'Order', 'wd' ),
						'desc'    => wp_kses_data( __( 'Not used with Best selling products', 'wd' ) ),
						'std'     => 'desc',
						'options' => array(
							'asc'  => esc_html__( 'Ascending', 'wd' ),
							'desc' => esc_html__( 'Descending', 'wd' ),
						),
						'type'    => 'radio',
					),
					'front_page_woocommerce_color_info'          => array(
						'title' => esc_html__( 'Colors and images', 'wd' ),
						'desc'  => '',
						'type'  => 'info',
					),
					'front_page_woocommerce_scheme'              => array(
						'title'   => esc_html__( 'Color scheme', 'wd' ),
						'desc'    => wp_kses_data( __( 'Color scheme for this section', 'wd' ) ),
						'std'     => 'inherit',
						'options' => array(),
						'refresh' => false,
						'type'    => 'radio',
					),
					'front_page_woocommerce_bg_image'            => array(
						'title'           => esc_html__( 'Background image', 'wd' ),
						'desc'            => wp_kses_data( __( 'Select or upload background image for this section', 'wd' ) ),
						'refresh'         => '.front_page_section_woocommerce',
						'refresh_wrapper' => true,
						'std'             => '',
						'type'            => 'image',
					),
					'front_page_woocommerce_bg_color_type'       => array(
						'title'   => esc_html__( 'Background color', 'wd' ),
						'desc'    => wp_kses_data( __( 'Background color for this section', 'wd' ) ),
						'std'     => WD_THEME_FREE ? 'custom' : 'none',
						'refresh' => false,
						'options' => array(
							'none'            => esc_html__( 'None', 'wd' ),
							'scheme_bg_color' => esc_html__( 'Scheme bg color', 'wd' ),
							'custom'          => esc_html__( 'Custom', 'wd' ),
						),
						'type'    => 'radio',
					),
					'front_page_woocommerce_bg_color'            => array(
						'title'      => esc_html__( 'Custom color', 'wd' ),
						'desc'       => wp_kses_data( __( 'Custom background color for this section', 'wd' ) ),
						'std'        => WD_THEME_FREE ? '#000' : '',
						'refresh'    => false,
						'dependency' => array(
							'front_page_woocommerce_bg_color_type' => array( 'custom' ),
						),
						'type'       => 'color',
					),
					'front_page_woocommerce_bg_mask'             => array(
						'title'   => esc_html__( 'Background mask', 'wd' ),
						'desc'    => wp_kses_data( __( 'Use Background color as section mask with specified opacity. If 0 - mask is not used', 'wd' ) ),
						'std'     => 1,
						'max'     => 1,
						'step'    => 0.1,
						'refresh' => false,
						'type'    => 'slider',
					),
					'front_page_woocommerce_anchor_info'         => array(
						'title' => esc_html__( 'Anchor', 'wd' ),
						'desc'  => wp_kses_data( __( 'You can select icon and/or specify a text to create anchor for this section and show it in the side menu (if selected in the section "Header - Menu".', 'wd' ) )
									. '<br>'
									. wp_kses_data( __( 'Attention! Anchors available only if plugin "ThemeREX Addons is installed and activated!', 'wd' ) ),
						'type'  => 'info',
					),
					'front_page_woocommerce_anchor_icon'         => array(
						'title' => esc_html__( 'Anchor icon', 'wd' ),
						'desc'  => '',
						'std'   => '',
						'type'  => 'icon',
					),
					'front_page_woocommerce_anchor_text'         => array(
						'title' => esc_html__( 'Anchor text', 'wd' ),
						'desc'  => '',
						'std'   => '',
						'type'  => 'text',
					),
				)
			);
		}
		return $options;
	}
}


// Check if WooCommerce installed and activated
if ( ! function_exists( 'wd_exists_woocommerce' ) ) {
	function wd_exists_woocommerce() {
		return class_exists( 'Woocommerce' );
	}
}

// Return true, if current page is any woocommerce page
if ( ! function_exists( 'wd_is_woocommerce_page' ) ) {
	function wd_is_woocommerce_page() {
		$rez = false;
		if ( wd_exists_woocommerce() ) {
			$rez = is_woocommerce() || is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		}
		return $rez;
	}
}

// Detect current blog mode
if ( ! function_exists( 'wd_woocommerce_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'wd_filter_detect_blog_mode', 'wd_woocommerce_detect_blog_mode' );
	function wd_woocommerce_detect_blog_mode( $mode = '' ) {
		if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
			$mode = 'shop';
		} elseif ( is_product() || is_cart() || is_checkout() || is_account_page() ) {
			$mode = 'shop'; // 'shop_single' if using separate parameters for shop and product pages
		}
		return $mode;
	}
}

// Detect if WooCommerce support 'Product Grid' feature
if ( ! function_exists( 'wd_woocommerce_detect_product_grid_support' ) ) {
	function wd_woocommerce_detect_product_grid_support() {
		$product_grid = function_exists( 'wc_get_theme_support' ) ? wc_get_theme_support( 'product_grid' ) : false;
		return isset( $product_grid['min_columns'] ) && isset( $product_grid['max_columns'] );
	}
}

// Search skin-specific templates in the skin dir (if exists)
if ( ! function_exists( 'wd_woocommerce_locate_template' ) ) {
	//Handler of the add_filter( 'woocommerce_locate_template', 'wd_woocommerce_locate_template', 100, 3 );
	function wd_woocommerce_locate_template( $template, $template_name, $template_path ) {
		$folders = apply_filters( 'wd_filter_woocommerce_locate_template_folders', array(
			$template_path,
			'plugins/woocommerce/templates'
		) );
		foreach ( $folders as $f ) {
			$theme_dir = apply_filters( 'wd_filter_get_theme_file_dir', '', trailingslashit( wd_esc( $f ) ) . $template_name );
			if ( '' != $theme_dir ) {
				$template = $theme_dir;
				break;
			}
		}
		return $template;
	}
}


// Search skin-specific templates parts in the skin dir (if exists)
if ( ! function_exists( 'wd_woocommerce_get_template_part' ) ) {
	//Handler of the add_filter( 'wc_get_template_part', 'wd_woocommerce_get_template_part', 100, 3 );
	function wd_woocommerce_get_template_part( $template, $slug, $name ) {
		$folders = apply_filters( 'wd_filter_woocommerce_get_template_part_folders', array(
			'woocommerce',
			'plugins/woocommerce/templates'
		) );
		foreach ( $folders as $f ) {
			$theme_dir = apply_filters( 'wd_filter_get_theme_file_dir', '', trailingslashit( wd_esc( $f ) ) . "{$slug}-{$name}.php" );
			if ( '' != $theme_dir ) {
				$template = $theme_dir;
				break;
			}
			$theme_dir = apply_filters( 'wd_filter_get_theme_file_dir', '', trailingslashit( wd_esc( $f ) ) . "{$slug}.php" );
			if ( '' != $theme_dir ) {
				$template = $theme_dir;
				break;
			}
		}
		return $template;
	}
}


// Add skin-specific layouts of products for the shop page and shortcodes
if ( ! function_exists( 'wd_woocommerce_add_product_layouts' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_woocommerce_products_layouts', 'wd_woocommerce_add_product_layouts' );
	function wd_woocommerce_add_product_layouts( $list ) {
		return apply_filters( 'wd_filter_woocommerce_products_layouts', $list );
	}
}


// Move section 'Shop' inside the section 'WooCommerce' in the Customizer (if WooCommerce 3.3+ is installed)
if ( ! function_exists( 'wd_woocommerce_customizer_register_controls' ) ) {
	add_action( 'customize_register', 'wd_woocommerce_customizer_register_controls', 100 );
	function wd_woocommerce_customizer_register_controls( $wp_customize ) {
	    // Disable moving - leave separate panel 'Shop' at top level of theme options
		if ( false && wd_exists_woocommerce() ) {
			$panel = $wp_customize->get_panel( 'woocommerce' );
			$sec   = $wp_customize->get_section( 'shop' );
			if ( is_object( $panel ) && is_object( $sec ) ) {
				$sec->panel    = 'woocommerce';
				$sec->title    = esc_html__( 'Theme-specific options', 'wd' );
				$sec->priority = 100;
			}
		}
	}
}


// Set theme-specific default columns number in the new WooCommerce after switch theme
if ( ! function_exists( 'wd_woocommerce_action_switch_theme' ) ) {
	add_action( 'after_switch_theme', 'wd_woocommerce_action_switch_theme' );
	function wd_woocommerce_action_switch_theme() {
		if ( wd_exists_woocommerce() ) {
			update_option( 'woocommerce_catalog_columns', apply_filters( 'wd_filter_woocommerce_columns', 3 ) );
		}
	}
}


// Set theme-specific default columns number in the new WooCommerce after plugin activation
if ( ! function_exists( 'wd_woocommerce_action_activated_plugin' ) ) {
	add_action( 'activated_plugin', 'wd_woocommerce_action_activated_plugin', 10, 2 );
	function wd_woocommerce_action_activated_plugin( $plugin, $network_activation ) {
		if ( 'woocommerce/woocommerce.php' == $plugin ) {
			update_option( 'woocommerce_catalog_columns', apply_filters( 'wd_filter_woocommerce_columns', 3 ) );
		}
	}
}


// Check if meta box is allowed
if ( ! function_exists( 'wd_woocommerce_allow_override_options' ) ) {
	if ( ! WD_THEME_FREE ) {
		add_filter( 'wd_filter_allow_override_options', 'wd_woocommerce_allow_override_options', 10, 2);
	}
	function wd_woocommerce_allow_override_options( $allow, $post_type ) {
		return $allow || 'product' == $post_type;
	}
}


// Override options with stored page meta on 'Shop' pages
if ( ! function_exists( 'wd_woocommerce_override_theme_options' ) ) {
	//Handler of the add_action( 'wd_action_override_theme_options', 'wd_woocommerce_override_theme_options');
	function wd_woocommerce_override_theme_options() {
		// Remove ' || is_product()' from the condition in the next row
		// if you don't need to override theme options from the page 'Shop' on single products
		if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_product() ) {
			$id = wd_woocommerce_get_shop_page_id();
			if ( 0 < $id ) {
				// Get Theme Options from the shop page
				$shop_meta = get_post_meta( $id, 'wd_options', true );
				if ( ! is_array( $shop_meta ) ) {
					$shop_meta = array();
				}
				// Add (override) with current post (product) options
				if ( wd_storage_isset( 'options_meta' ) ) {
					$options_meta = wd_storage_get( 'options_meta' );
					if ( is_array( $options_meta ) ) {
						$shop_meta = array_merge( $shop_meta, $options_meta );
					}
				}
				wd_storage_set( 'options_meta', $shop_meta );
			}
		}
	}
}

// Add WooCommerce-specific classes to the body
if ( ! function_exists( 'wd_woocommerce_add_body_classes' ) ) {
	//Handler of the add_filter( 'body_class', 'wd_woocommerce_add_body_classes' );
	function wd_woocommerce_add_body_classes( $classes ) {
		if ( is_product() ) {
			$classes[] = 'single_product_gallery_thumbs_' . wd_get_theme_option( 'single_product_gallery_thumbs' );
		}
		return $classes;
	}
}

// Add class 'woocommerce-product-gallery--with-thumbs' to the WooCommerce gallery if gallery images present for the current product
if ( ! function_exists( 'wd_woocommerce_add_thumbs_present_class' ) ) {
	//Handler of the add_filter( 'woocommerce_single_product_image_gallery_classes', 'wd_woocommerce_add_thumbs_present_class' );
	function wd_woocommerce_add_thumbs_present_class( $classes ) {
		global $product;
		if ( is_object( $product ) ) {
			$attachment_ids = $product->get_gallery_image_ids();
			$classes[] = 'woocommerce-product-gallery--' . ( is_array( $attachment_ids ) && count( $attachment_ids ) > 0 ? 'with' : 'without' ) . '-thumbs';
		}
		return $classes;
	}
}


// Return current page title
if ( ! function_exists( 'wd_woocommerce_get_blog_title' ) ) {
	//Handler of the add_filter( 'wd_filter_get_blog_title', 'wd_woocommerce_get_blog_title');
	function wd_woocommerce_get_blog_title( $title = '' ) {
		if ( ! wd_exists_trx_addons() && wd_exists_woocommerce() && wd_is_woocommerce_page() && is_shop() ) {
			$id    = wd_woocommerce_get_shop_page_id();
			$title = $id ? get_the_title( $id ) : esc_html__( 'Shop', 'wd' );
		}
		return $title;
	}
}


// Return taxonomy for current post type
if ( ! function_exists( 'wd_woocommerce_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'wd_filter_post_type_taxonomy',	'wd_woocommerce_post_type_taxonomy', 10, 2 );
	function wd_woocommerce_post_type_taxonomy( $tax = '', $post_type = '' ) {
		if ( 'product' == $post_type ) {
			$tax = 'product_cat';
		}
		return $tax;
	}
}

// Return true if page title section is allowed
if ( ! function_exists( 'wd_woocommerce_allow_override_header_image' ) ) {
	//Handler of the add_filter( 'wd_filter_allow_override_header_image', 'wd_woocommerce_allow_override_header_image' );
	function wd_woocommerce_allow_override_header_image( $allow = true ) {
		return is_product() ? false : $allow;
	}
}

// Return shop page ID
if ( ! function_exists( 'wd_woocommerce_get_shop_page_id' ) ) {
	function wd_woocommerce_get_shop_page_id() {
		return get_option( 'woocommerce_shop_page_id' );
	}
}

// Return shop page link
if ( ! function_exists( 'wd_woocommerce_get_shop_page_link' ) ) {
	function wd_woocommerce_get_shop_page_link() {
		$url = '';
		$id  = wd_woocommerce_get_shop_page_id();
		if ( $id ) {
			$url = get_permalink( $id );
		}
		return $url;
	}
}

// Return categories of the current product
if ( ! function_exists( 'wd_woocommerce_get_post_categories' ) ) {
	//Handler of the add_filter( 'wd_filter_get_post_categories', 'wd_woocommerce_get_post_categories', 10, 2 );
	function wd_woocommerce_get_post_categories( $cats = '', $args = array() ) {
		if ( get_post_type() == 'product' ) {
			$cat_sep = apply_filters(
									'wd_filter_post_meta_cat_separator',
									'<span class="post_meta_item_cat_separator">' . ( ! isset( $args['cat_sep'] ) || ! empty( $args['cat_sep'] ) ? ', ' : ' ' ) . '</span>',
									$args
									);
			$cats = wd_get_post_terms( $cat_sep, get_the_ID(), 'product_cat' );
		}
		return $cats;
	}
}

// Add 'product' to the list of the supported post-types
if ( ! function_exists( 'wd_woocommerce_list_post_types' ) ) {
	//Handler of the add_filter( 'wd_filter_list_posts_types', 'wd_woocommerce_list_post_types');
	function wd_woocommerce_list_post_types( $list = array() ) {
		$list['product'] = esc_html__( 'Products', 'wd' );
		return $list;
	}
}

// Show price of the current product in the widgets and search results
if ( ! function_exists( 'wd_woocommerce_get_post_info' ) ) {
	//Handler of the add_filter( 'wd_filter_get_post_info', 'wd_woocommerce_get_post_info');
	function wd_woocommerce_get_post_info( $post_info = '' ) {
		if ( get_post_type() == 'product' ) {
			global $product;
			$price_html = $product->get_price_html();
			if ( ! empty( $price_html ) ) {
				$post_info = '<div class="post_price product_price price">' . trim( $price_html ) . '</div>' . $post_info;
			}
		}
		return $post_info;
	}
}

// Show price of the current product in the search results streampage
if ( ! function_exists( 'wd_woocommerce_action_before_post_meta' ) ) {
	//Handler of the add_action( 'wd_action_before_post_meta', 'wd_woocommerce_action_before_post_meta');
	function wd_woocommerce_action_before_post_meta() {
		if ( ! wd_is_single() && get_post_type() == 'product' ) {
			global $product;
			$price_html = $product->get_price_html();
			if ( ! empty( $price_html ) ) {
				?><div class="post_price product_price price"><?php wd_show_layout( $price_html ); ?></div>
				<?php
			}
		}
	}
}

// Change text of the sidebar control
if ( ! function_exists( 'wd_woocommerce_sidebar_control_text' ) ) {
	//Handler of the add_filter( 'wd_filter_sidebar_control_text', 'wd_woocommerce_sidebar_control_text' );
	function wd_woocommerce_sidebar_control_text( $text ) {
		if ( ! empty( $text ) && wd_exists_woocommerce() && wd_is_woocommerce_page() ) {
			$text = wp_kses_data( __( 'Filters', 'wd' ) );
		}
		return $text;
	}
}

// Change title of the sidebar control
if ( ! function_exists( 'wd_woocommerce_sidebar_control_title' ) ) {
	//Handler of the add_filter( 'wd_filter_sidebar_control_title', 'wd_woocommerce_sidebar_control_title' );
	function wd_woocommerce_sidebar_control_title( $title ) {
		if ( ! empty( $title ) && wd_exists_woocommerce() && wd_is_woocommerce_page() ) {
			$title = wp_kses_data( __( 'Filters', 'wd' ) );
		}
		return $title;
	}
}

// Enqueue WooCommerce custom styles
if ( ! function_exists( 'wd_woocommerce_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'wd_woocommerce_frontend_scripts', 1100 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_woocommerce', 'wd_woocommerce_frontend_scripts', 10, 1 );
	function wd_woocommerce_frontend_scripts( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && wd_need_frontend_scripts( 'woocommerce' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$wd_url = wd_get_file_url( 'plugins/woocommerce/woocommerce.css' );
			if ( '' != $wd_url ) {
				wp_enqueue_style( 'wd-woocommerce', $wd_url, array(), null );
			}
			$wd_url = wd_get_file_url( 'plugins/woocommerce/woocommerce.js' );
			if ( '' != $wd_url ) {
				wp_enqueue_script( 'wd-woocommerce', $wd_url, array( 'jquery' ), null, true );
			}
		}
	}
}

// Enqueue WooCommerce responsive styles
if ( ! function_exists( 'wd_woocommerce_frontend_scripts_responsive' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'wd_woocommerce_frontend_scripts_responsive', 2000 );
	//Handler of the add_action( 'trx_addons_action_load_scripts_front_woocommerce', 'wd_woocommerce_frontend_scripts_responsive', 10, 1 );
	function wd_woocommerce_frontend_scripts_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts' && wd_need_frontend_scripts( 'woocommerce' )
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			$wd_url = wd_get_file_url( 'plugins/woocommerce/woocommerce-responsive.css' );
			if ( '' != $wd_url ) {
				wp_enqueue_style( 'wd-woocommerce-responsive', $wd_url, array(), null, wd_media_for_load_css_responsive( 'woocommerce' ) );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'wd_woocommerce_merge_styles' ) ) {
	//Handler of the add_filter( 'wd_filter_merge_styles', 'wd_woocommerce_merge_styles' );
	function wd_woocommerce_merge_styles( $list ) {
		$list[ 'plugins/woocommerce/woocommerce.css' ] = false;
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'wd_woocommerce_merge_styles_responsive' ) ) {
	//Handler of the add_filter( 'wd_filter_merge_styles_responsive', 'wd_woocommerce_merge_styles_responsive' );
	function wd_woocommerce_merge_styles_responsive( $list ) {
		$list[ 'plugins/woocommerce/woocommerce-responsive.css' ] = false;
		return $list;
	}
}

// Merge custom scripts
if ( ! function_exists( 'wd_woocommerce_merge_scripts' ) ) {
	//Handler of the add_filter( 'wd_filter_merge_scripts', 'wd_woocommerce_merge_scripts' );
	function wd_woocommerce_merge_scripts( $list ) {
		$list[ 'plugins/woocommerce/woocommerce.js' ] = false;
		return $list;
	}
}



// Add WooCommerce specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( ! function_exists( 'wd_woocommerce_list_sidebars' ) ) {
	//Handler of the add_filter( 'wd_filter_list_sidebars', 'wd_woocommerce_list_sidebars' );
	function wd_woocommerce_list_sidebars( $list = array() ) {
		$list['woocommerce_widgets'] = array(
			'name'        => esc_html__( 'WooCommerce Widgets', 'wd' ),
			'description' => esc_html__( 'Widgets to be shown on the WooCommerce pages', 'wd' ),
		);
		return $list;
	}
}




// Decorate WooCommerce output: Loop
//------------------------------------------------------------------------

// Add query vars to set products per page
if ( ! function_exists( 'wd_woocommerce_pre_get_posts' ) ) {
	//Handler of the add_action( 'pre_get_posts', 'wd_woocommerce_pre_get_posts' );
	function wd_woocommerce_pre_get_posts( $query ) {
		if ( ! $query->is_main_query() ) {
			return;
		}
		if ( $query->get( 'wc_query' ) == 'product_query' ) {
			$ppp = get_theme_mod( 'posts_per_page_shop', 0 );
			if ( $ppp > 0 ) {
				$query->set( 'posts_per_page', $ppp );
			}
		}
	}
}


// Add custom paginations to the loop
if ( ! function_exists( 'wd_woocommerce_pagination' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop', 'wd_woocommerce_pagination', 9 );
	function wd_woocommerce_pagination() {
		$pagination = wd_get_theme_option('shop_pagination');
		if ( in_array( $pagination, array( 'more', 'infinite' ) ) ) {
			wd_show_pagination(
				array(
					'pagination'   => $pagination,
					'class_prefix' => 'woocommerce'
				)
			);
		}
	}
}


// Before main content
if ( ! function_exists( 'wd_woocommerce_wrapper_start' ) ) {
	//Handler of the add_action('woocommerce_before_main_content', 'wd_woocommerce_wrapper_start', 10);
	function wd_woocommerce_wrapper_start() {
		if ( is_product() || is_cart() || is_checkout() || is_account_page() ) {
			?>
			<article class="<?php echo esc_attr( join( ' ', apply_filters( 'wd_filter_single_product_wrapper_class', array(
				'post_item_single',
				'post_type_product'
			) ) ) ); ?>">
			<?php
		} else {
			?>
			<div class="<?php echo esc_attr( join( ' ', apply_filters( 'wd_filter_list_products_wrapper_class', array(
				'list_products',
				'shop_mode_' . ( ! wd_storage_empty( 'shop_mode' ) ? wd_storage_get( 'shop_mode' ) : 'thumbs' )
			) ) ) ); ?>">
				<?php

				do_action( 'wd_action_before_list_products_header' );

				if ( apply_filters( 'wd_filter_woocommerce_show_breadcrumbs', true )
					|| apply_filters( 'wd_filter_woocommerce_show_title', true )
					|| apply_filters( 'wd_filter_woocommerce_show_description', true )
				) {
					?>
					<div class="list_products_header">
					<?php
				}
				wd_storage_set( 'woocommerce_list_products_header', true );
		}
	}
}

// After main content
if ( ! function_exists( 'wd_woocommerce_wrapper_end' ) ) {
	//Handler of the add_action('woocommerce_after_main_content', 'wd_woocommerce_wrapper_end', 10);
	function wd_woocommerce_wrapper_end() {
		if ( is_product() || is_cart() || is_checkout() || is_account_page() ) {
			?>
			</article>
			<?php
		} else {
			?>
			</div>
			<?php
		}
	}
}

// Close header section
if ( ! function_exists( 'wd_woocommerce_archive_description' ) ) {
	//Handler of the add_action('woocommerce_after_main_content',	'wd_woocommerce_archive_description', 1);
	//Handler of the add_action( 'woocommerce_before_shop_loop',	'wd_woocommerce_archive_description', 5 );
	//Handler of the add_action( 'woocommerce_no_products_found',	'wd_woocommerce_archive_description', 5 );
	function wd_woocommerce_archive_description() {
		if ( wd_storage_get( 'woocommerce_list_products_header' ) ) {
			if ( apply_filters( 'wd_filter_woocommerce_show_breadcrumbs', true )
				|| apply_filters( 'wd_filter_woocommerce_show_title', true )
				|| apply_filters( 'wd_filter_woocommerce_show_description', true )
			) {
				?>
				</div>
				<?php
			}
			do_action( 'wd_action_after_list_products_header' );
			wd_storage_set( 'woocommerce_list_products_header', false );
			remove_action( 'woocommerce_after_main_content', 'wd_woocommerce_archive_description', 1 );
		} elseif ( ! wd_is_singular() && did_action('woocommerce_before_main_content' ) ) {
			get_template_part( apply_filters( 'wd_filter_get_template_part', 'templates/content', 'none-search' ), 'none-search' );
		}
	}
}

// Redirect filter 'woocommerce_show_breadcrumbs' to the plugin
if ( ! function_exists( 'wd_woocommerce_trx_addons_show_breadcrumbs' ) ) {
	//Handler of the add_filter( 'wd_filter_woocommerce_show_breadcrumbs', 'wd_woocommerce_trx_addons_show_breadcrumbs' );
	function wd_woocommerce_trx_addons_show_breadcrumbs( $show = true ) {
		return apply_filters( 'trx_addons_filter_woocommerce_show_breadcrumbs', $show );
	}
}

// Redirect filter 'woocommerce_show_title' to the plugin
if ( ! function_exists( 'wd_woocommerce_trx_addons_show_title' ) ) {
	//Handler of the add_filter( 'wd_filter_woocommerce_show_title', 'wd_woocommerce_trx_addons_show_title' );
	function wd_woocommerce_trx_addons_show_title( $show = true ) {
		return apply_filters( 'trx_addons_filter_woocommerce_show_title', $show );
	}
}

// Redirect filter 'woocommerce_show_description' to the plugin
if ( ! function_exists( 'wd_woocommerce_trx_addons_show_description' ) ) {
	//Handler of the add_filter( 'wd_filter_woocommerce_show_description', 'wd_woocommerce_trx_addons_show_description' );
	function wd_woocommerce_trx_addons_show_description( $show = true ) {
		return apply_filters( 'trx_addons_filter_woocommerce_show_description', $show );
	}
}

// Add list mode buttons
if ( ! function_exists( 'wd_woocommerce_before_shop_loop' ) ) {
	//Handler of the add_action( 'woocommerce_before_shop_loop', 'wd_woocommerce_before_shop_loop', 10 );
	function wd_woocommerce_before_shop_loop() {
		?>
		<div class="wd_shop_mode_buttons"><form action="<?php echo esc_url( wd_get_current_url() ); ?>" method="post"><input type="hidden" name="wd_shop_mode" value="<?php echo esc_attr( wd_storage_get( 'shop_mode' ) ); ?>" /><a href="#" class="woocommerce_thumbs icon-th" title="<?php esc_attr_e( 'Show products as thumbs', 'wd' ); ?>"></a><a href="#" class="woocommerce_list icon-th-list" title="<?php esc_attr_e( 'Show products as list', 'wd' ); ?>"></a></form></div>
		<?php
	}
}

// Show 'No products' if no search results and display mode 'both'
if ( ! function_exists( 'wd_woocommerce_after_shop_loop' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop', 'wd_woocommerce_after_shop_loop', 1 );
	function wd_woocommerce_after_shop_loop() {
		global $woocommerce_loop;
		if ( empty( $woocommerce_loop['is_shortcode'] )
			&& empty( $woocommerce_loop['total'] )
			&& ! have_posts()
			&& function_exists( 'woocommerce_get_loop_display_mode' ) && 'products' != woocommerce_get_loop_display_mode()
			&& function_exists( 'wc_get_template' )
		) {
			wc_get_template( 'loop/no-products-found.php' );
		}
	}
}

// Number of columns for the shop streampage
if ( ! function_exists( 'wd_woocommerce_loop_shop_columns' ) ) {
	//Handler of the add_filter( 'loop_shop_columns', 'wd_woocommerce_loop_shop_columns' );
	function wd_woocommerce_loop_shop_columns( $cols ) {
		return max( 2, min( 4, wd_get_theme_option( 'blog_columns' ) ) );
	}
}

// Add column class into product item in shop streampage
if ( ! function_exists( 'wd_woocommerce_loop_shop_columns_class' ) ) {
	//Handler of the add_filter( 'post_class', 'wd_woocommerce_loop_shop_columns_class' );
	//Handler of the add_filter( 'product_cat_class', 'wd_woocommerce_loop_shop_columns_class', 10, 3 );
	function wd_woocommerce_loop_shop_columns_class( $classes, $class = '', $cat = '' ) {
		global $woocommerce_loop;
		if ( is_product() ) {
			if ( ! empty( $woocommerce_loop['columns'] ) ) {
				$classes[] = ' column-1_' . esc_attr( $woocommerce_loop['columns'] );
			}
		} elseif ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
			$classes[] = ' column-1_' . esc_attr( max( 2, min( 4, wd_get_theme_option( 'blog_columns' ) ) ) );
		}
		return $classes;
	}
}

// Set size of the thumbnail in the products loop
if ( ! function_exists( 'wd_woocommerce_single_product_archive_thumbnail_size' ) ) {
	//Handler of the add_filter( 'single_product_archive_thumbnail_size', 'wd_woocommerce_single_product_archive_thumbnail_size' );
	function wd_woocommerce_single_product_archive_thumbnail_size( $size = 'woocommerce_thumbnail' ) {
		static $subst = array();
		if ( isset( $subst[ $size ] ) ) {
			$size = $subst[ $size ];
		} else {
			$subst[ $size ] = $size;
			$cols           = max( 1, wc_get_loop_prop( 'columns' ) );
			$cols_gap       = apply_filters( 'wd_filter_grid_gap', 30 );
			$width          = round( ( wd_get_content_width() - ( $cols - 1 ) * $cols_gap ) / $cols );
			$new_size = wd_get_closest_thumb_size( $size, array( 'width' => $width, 'height' => $width ) );
			if ( ! empty( $new_size ) ) {
				$subst[ $size ] = $new_size;
				$size           = $new_size;
			}
		}
		return $size;
	}
}

// Detect when we are in a subcategory: start category
if ( ! function_exists( 'wd_woocommerce_before_subcategory' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory', 'wd_woocommerce_before_subcategory', 1 );
	function wd_woocommerce_before_subcategory( $cat = '' ) {
		wd_storage_set( 'in_product_category', $cat );
	}
}

// Detect when we are in a subcategory: end category
if ( ! function_exists( 'wd_woocommerce_after_subcategory' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory', 'wd_woocommerce_after_subcategory', 9999 );
	function wd_woocommerce_after_subcategory( $cat = '' ) {
		wd_storage_set( 'in_product_category', false );
	}
}
	

// Open item wrapper for categories and products
if ( ! function_exists( 'wd_woocommerce_item_wrapper_start' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'wd_woocommerce_item_wrapper_start', 9 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'wd_woocommerce_item_wrapper_start', 9 );
	function wd_woocommerce_item_wrapper_start( $cat = '' ) {
		wd_storage_set( 'in_product_item', true );
		$hover = wd_get_theme_option( 'shop_hover' );
		?>
		<div class="post_item post_layout_<?php
			echo esc_attr( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()
				? wd_storage_get( 'shop_mode' )
				: 'thumbs'
			);
			?>"
			<?php wd_add_blog_animation(); ?>
		>
			<div class="post_featured hover_<?php echo esc_attr( $hover ); ?>">
				<?php do_action( 'wd_action_woocommerce_item_featured_start' ); ?>
				<a href="<?php echo esc_url( is_object( $cat ) ? get_term_link( $cat->slug, 'product_cat' ) : get_permalink() ); ?>">
				<?php
				do_action( 'wd_action_woocommerce_item_featured_link_start' );
	}
}

// Open item wrapper for categories and products
if ( ! function_exists( 'wd_woocommerce_title_wrapper_start' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'wd_woocommerce_title_wrapper_start', 20 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'wd_woocommerce_title_wrapper_start', 20 );
	function wd_woocommerce_title_wrapper_start( $cat = '' ) {
				do_action( 'wd_action_woocommerce_item_featured_link_end' );
				?>
				</a>
				<?php
				$hover = wd_get_theme_option( 'shop_hover' );
				if ( 'none' != $hover ) {
					?>
					<div class="mask"></div>
					<?php
					wd_hovers_add_icons( $hover, array( 'cat' => $cat ) );
				}
				do_action( 'wd_action_woocommerce_item_featured_end' );
				?>
			</div>
			<div class="post_data">
				<div class="post_data_inner">
					<div class="post_header entry-header">
					<?php
					do_action( 'wd_action_woocommerce_item_header_start' );
	}
}


// Display product's tags before the title
if ( ! function_exists( 'wd_woocommerce_title_tags' ) ) {
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'wd_woocommerce_title_tags', 30 );
	function wd_woocommerce_title_tags() {
		global $product;
		if ( apply_filters( 'wd_filter_show_woocommerce_title', true ) ) {
			wd_show_layout( wc_get_product_tag_list( $product->get_id(), ', ', '<div class="post_tags product_tags">', '</div>' ) );
		}
	}
}

// Wrap product title to the link
if ( ! function_exists( 'wd_woocommerce_the_title' ) ) {
	//Handler of the add_filter( 'the_title', 'wd_woocommerce_the_title' );
	function wd_woocommerce_the_title( $title ) {
		if ( wd_storage_get( 'in_product_item' ) && get_post_type() == 'product' ) {
			$title = '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( $title ) . '</a>';
		}
		return $title;
	}
}

// Wrap category title to the link: open tag
if ( ! function_exists( 'wd_woocommerce_before_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'wd_woocommerce_before_subcategory_title', 10, 1 );
	function wd_woocommerce_before_subcategory_title( $cat ) {
		if ( wd_storage_get( 'in_product_item' ) && is_object( $cat ) ) {
			?>
			<a href="<?php echo esc_url( get_term_link( $cat->slug, 'product_cat' ) ); ?>">
			<?php
		}
	}
}

// Wrap category title to the link: close tag
if ( ! function_exists( 'wd_woocommerce_after_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory_title', 'wd_woocommerce_after_subcategory_title', 10, 1 );
	function wd_woocommerce_after_subcategory_title( $cat ) {
		if ( wd_storage_get( 'in_product_item' ) && is_object( $cat ) ) {
			?>
			</a>
			<?php
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( ! function_exists( 'wd_woocommerce_title_wrapper_end' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop_item_title', 'wd_woocommerce_title_wrapper_end', 7);
	function wd_woocommerce_title_wrapper_end() {
			do_action( 'wd_action_woocommerce_item_header_end' );
			?>
			</div>
		<?php
		if ( wd_storage_get( 'shop_mode' ) == 'list' && ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) && ! is_product() ) {
			?>
			<div class="post_content entry-content"><?php wd_show_layout( get_the_excerpt() ); ?></div>
			<?php
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( ! function_exists( 'wd_woocommerce_title_wrapper_end2' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory_title', 'wd_woocommerce_title_wrapper_end2', 10 );
	function wd_woocommerce_title_wrapper_end2( $category ) {
			do_action( 'wd_action_woocommerce_item_header_end' );
			?>
			</div>
		<?php
		if ( wd_storage_get( 'shop_mode' ) == 'list' && is_shop() && ! is_product() ) {
			?>
			<div class="post_content entry-content"><?php wd_show_layout( $category->description ); ?></div>
			<?php
		}
	}
}

// Close item wrapper for categories and products
if ( ! function_exists( 'wd_woocommerce_item_wrapper_end' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory', 'wd_woocommerce_item_wrapper_end', 20 );
	//Handler of the add_action( 'woocommerce_after_shop_loop_item', 'wd_woocommerce_item_wrapper_end', 20 );
	function wd_woocommerce_item_wrapper_end( $cat = '' ) {
				?>
				</div>
			</div>
		</div>
		<?php
		wd_storage_set( 'in_product_item', false );
	}
}

// Change text on 'Add to cart' button to 'Buy now'
if ( ! function_exists( 'wd_woocommerce_add_to_cart_text' ) ) {
	//Handler of the add_filter( 'woocommerce_product_add_to_cart_text',       'wd_woocommerce_add_to_cart_text' );
	//Handler of the add_filter( 'woocommerce_product_single_add_to_cart_text','wd_woocommerce_add_to_cart_text' );
	function wd_woocommerce_add_to_cart_text( $text = '' ) {
		global $product;
		return is_object( $product )
				&& $product->is_in_stock()
				&& $product->is_purchasable()
				&& 'grouped' !== $product->get_type()
				&& ( 'external' !== $product->get_type() || $product->get_button_text() == '' )
					? esc_html__( 'Buy now', 'wd' )
					: $text;
	}
}

// Wrap 'Add to cart' button
if ( ! function_exists( 'wd_woocommerce_add_to_cart_link' ) ) {
	//Handler of the add_filter( 'woocommerce_loop_add_to_cart_link', 'wd_woocommerce_add_to_cart_link', 10, 2 );
	function wd_woocommerce_add_to_cart_link( $html, $product = false, $args = array() ) {
		return wd_is_off( wd_get_theme_option( 'shop_hover' ) )
				? sprintf( '<div class="add_to_cart_wrap">%s</div>', $html )
				: $html;
	}
}


// Add wrap for buttons 'Compare' and 'Add to wishlist'
if ( ! function_exists( 'wd_woocommerce_add_wishlist_wrap' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop_item', 'wd_woocommerce_add_wishlist_wrap' ), 19 );
	function wd_woocommerce_add_wishlist_wrap() {
		ob_start();
	}
}

// Add button 'Add to wishlist'
if ( ! function_exists( 'wd_woocommerce_add_wishlist_link' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop_item', 'wd_woocommerce_add_wishlist_link' ), 20 );
	function wd_woocommerce_add_wishlist_link() {

		$group_buttons = function_exists( 'trx_addons_remove_action' ) && apply_filters( 'wd_filter_woocommerce_yith_group_buttons', false );

		$quickview = apply_filters( 'wd_filter_woocommerce_show_quick_view',
									function_exists( 'YITH_WCQV' ) && 'yes' == get_option( 'yith-wcqv-enable' )
								);
		if ( $quickview ) {
			if ( $group_buttons ) {
				do_action( 'wd_action_woocommerce_yith_button_quick_view' );
			} else {
				// In this case we can out button manually: wd_show_layout( do_shortcode( '[yith_quick_view]' ) );
			}
		}

		$compare = apply_filters( 'wd_filter_woocommerce_show_compare',
									defined( 'YITH_WOOCOMPARE_VERSION' ) && 'yes' == get_option( 'yith_woocompare_compare_button_in_products_list' )
								);
		if ( $compare ) {
			if ( $group_buttons ) {
				do_action( 'wd_action_woocommerce_yith_button_compare' );
			} else {
				//  In this case we can out button manually: wd_show_layout( do_shortcode( '[yith_compare_button]' ) );
			}
		}

		$wishlist = apply_filters( 'wd_filter_woocommerce_show_wishlist',
									function_exists( 'YITH_WCWL' ) && 'yes' == get_option( 'yith_wcwl_show_on_loop' )	// && 'before_image' == get_option( 'yith_wcwl_loop_position' )
								);
		if ( $wishlist ) {
			if ( $group_buttons ) {
				do_action( 'wd_action_woocommerce_yith_button_wishlist' );
			} else {
				// In this case we can out button manually: wd_show_layout( do_shortcode( '[yith_wcwl_add_to_wishlist]' ) );
			}
		}

		$output = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $output )
			|| ( ! $group_buttons
				&& ( $quickview || $compare || $wishlist )
				)
		) {
			?><div class="yith_buttons_wrap"><?php
				wd_show_layout( $output );
			?></div><?php
		}
	}
}


// Add label 'out of stock'
if ( ! function_exists( 'wd_woocommerce_add_out_of_stock_label' ) ) {
	//Handler of the add_action( 'wd_action_woocommerce_item_featured_link_start', 'wd_woocommerce_add_out_of_stock_label' );
	function wd_woocommerce_add_out_of_stock_label() {
		global $product;
		$cat = wd_storage_get( 'in_product_category' );
		if ( empty($cat) || ! is_object($cat) ) {
			if ( is_object( $product ) && ! $product->is_in_stock() ) {
				?>
				<span class="outofstock_label"><?php esc_html_e( 'Out of stock', 'wd' ); ?></span>
				<?php
			}
		}
	}
}


// Add label with sale percent instead standard 'Sale'
if ( ! function_exists( 'wd_woocommerce_add_sale_percent' ) ) {
	//Handler of the add_filter( 'woocommerce_sale_flash', 'wd_woocommerce_add_sale_percent', 10, 3 );
	function wd_woocommerce_add_sale_percent( $label, $post = '', $product = '' ) {
		$percent = '';
		if ( is_object( $product ) ) {
			if ( 'variable' === $product->get_type() ) {
				$prices  = $product->get_variation_prices();
				if ( ! is_array( $prices['regular_price'] ) && ! is_array( $prices['sale_price'] ) && $prices['regular_price'] > $prices['sale_price'] ) {
					$percent = round( ( $prices['regular_price'] - $prices['sale_price'] ) / $prices['regular_price'] * 100 );
				} else if ( is_array( $prices['regular_price'] ) && is_array( $prices['sale_price'] ) ) {
					$max_percent = 0;
					foreach ( $prices['sale_price'] as $id => $sale_price ) {
						if ( ! empty( $prices['regular_price'][ $id ] ) && $prices['regular_price'][ $id ] > $sale_price ) {
							$cur_percent = round( ( $prices['regular_price'][ $id ] - $sale_price ) / $prices['regular_price'][ $id ] * 100 );
							if ( $cur_percent > $max_percent ) {
								$max_percent = $cur_percent;
							}
						}
					}
					if ( $max_percent > 0 ) {
						$percent = $max_percent;
					}
				}
			} else {
				$price = $product->get_price_html();
				$prices = explode( '<ins', $price );
				if ( count( $prices ) > 1 ) {
					$prices[1] = '<ins' . $prices[1];
					$price_old = wd_parse_num( $prices[0] );
					$price_new = wd_parse_num( $prices[1] );
					if ( $price_old > 0 && $price_old > $price_new ) {
						$percent = round( ( $price_old - $price_new ) / $price_old * 100 );
					}
				}
			}
		}
		return ! empty( $percent )
					// Compatible skins can catch this filter
					// and return a layout with the label 'Up to' before the percent value for variable products.
					// For example: <span class="onsale"><span class="onsale_up">Up to -25%</span></span>
					? apply_filters( 'wd_filter_woocommerce_sale_flash',
										'<span class="onsale">-' . esc_html( $percent ) . '%</span>',
										$percent,
										$product
									)
					: $label;
	}
}


// Wrap price - start (WooCommerce use priority 10 to output price)
if ( ! function_exists( 'wd_woocommerce_price_wrapper_start' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop_item_title',	'wd_woocommerce_price_wrapper_start', 9);
	function wd_woocommerce_price_wrapper_start() {
		if ( wd_storage_get( 'shop_mode' ) == 'thumbs' && ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) && ! is_product() ) {
			global $product;
			$price_html = $product->get_price_html();
			if ( '' != $price_html ) {
				?>
				<div class="price_wrap">
				<?php
			}
		}
	}
}


// Wrap price - start (WooCommerce use priority 10 to output price)
if ( ! function_exists( 'wd_woocommerce_price_wrapper_end' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop_item_title',	'wd_woocommerce_price_wrapper_end', 11);
	function wd_woocommerce_price_wrapper_end() {
		if ( wd_storage_get( 'shop_mode' ) == 'thumbs' && ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) && ! is_product() ) {
			global $product;
			$price_html = $product->get_price_html();
			if ( '' != $price_html ) {
				?>
				</div>
				<?php
			}
		}
	}
}


// Decorate price
if ( ! function_exists( 'wd_woocommerce_get_price_html' ) ) {
	//Handler of the add_filter(    'woocommerce_get_price_html',	'wd_woocommerce_get_price_html' );
	function wd_woocommerce_get_price_html( $price = '' ) {
		if ( ! is_admin() && ! empty( $price ) ) {
			$sep = get_option( 'woocommerce_price_decimal_sep' );
			if ( empty( $sep ) ) {
				$sep = '.';
			}
			$price = preg_replace( '/([0-9,]+)(\\' . trim( $sep ) . ')([0-9]{2})/', '\\1<span class="decimals_separator">\\2</span><span class="decimals">\\3</span>', $price );
		}
		return $price;
	}
}


// Decorate breadcrumbs
if ( ! function_exists( 'wd_woocommerce_breadcrumb_defaults' ) ) {
	//Handler of the add_filter( 'woocommerce_breadcrumb_defaults', 'wd_woocommerce_breadcrumb_defaults' );
	function wd_woocommerce_breadcrumb_defaults( $args ) {
		$args['delimiter'] = '<span class="woocommerce-breadcrumb-delimiter"></span>';
		$args['before']    = '<span class="woocommerce-breadcrumb-item">';
		$args['after']     = '</span>';
		return $args;
	}
}

		



// Decorate WooCommerce output: Single product
//------------------------------------------------------------------------

// Add Product ID for the single product
if ( ! function_exists( 'wd_woocommerce_show_product_id' ) ) {
	//Handler of the add_action( 'woocommerce_product_meta_end', 'wd_woocommerce_show_product_id', 10);
	function wd_woocommerce_show_product_id() {
		$authors = wp_get_post_terms( get_the_ID(), 'pa_product_author' );
		if ( is_array( $authors ) && count( $authors ) > 0 ) {
			echo '<span class="product_author">' . esc_html__( 'Author: ', 'wd' );
			$delim = '';
			foreach ( $authors as $author ) {
				echo  esc_html( $delim ) . '<span>' . esc_html( $author->name ) . '</span>';
				$delim = ', ';
			}
			echo '</span>';
		}
		echo '<span class="product_id">' . esc_html__( 'Product ID: ', 'wd' ) . '<span>' . get_the_ID() . '</span></span>';
	}
}

// Number columns for the product's thumbnails
if ( ! function_exists( 'wd_woocommerce_product_thumbnails_columns' ) ) {
	//Handler of the add_filter( 'woocommerce_product_thumbnails_columns', 'wd_woocommerce_product_thumbnails_columns' );
	function wd_woocommerce_product_thumbnails_columns( $cols ) {
		return 4;
	}
}

// Set products number for the related products
if ( ! function_exists( 'wd_woocommerce_output_related_products_args' ) ) {
	//Handler of the add_filter( 'woocommerce_output_related_products_args', 'wd_woocommerce_output_related_products_args' );
	function wd_woocommerce_output_related_products_args( $args ) {
		$args['posts_per_page'] = (int) wd_get_theme_option( 'show_related_posts' )
										? max( 0, min( 12, wd_get_theme_option( 'related_posts' ) ) )
										: 0;
		$args['columns']        = max( 1, min( 6, wd_get_theme_option( 'related_columns' ) ) );
		return $args;
	}
}

// Set columns number for the related products
if ( ! function_exists( 'wd_woocommerce_related_products_columns' ) ) {
	//Handler of the add_filter( 'woocommerce_related_products_columns', 'wd_woocommerce_related_products_columns' );
	//Handler of the add_filter( 'woocommerce_cross_sells_columns', 'wd_woocommerce_related_products_columns' );
	//Handler of the add_filter( 'woocommerce_upsells_columns', 'wd_woocommerce_related_products_columns' );
	function wd_woocommerce_related_products_columns( $columns = 0 ) {
		$columns = max( 1, min( 6, wd_get_theme_option( 'related_columns' ) ) );
		return $columns;
	}
}


// Decorate WooCommerce output: Widgets
//------------------------------------------------------------------------

// Search form
if ( ! function_exists( 'wd_woocommerce_get_product_search_form' ) ) {
	//Handler of the add_filter( 'get_product_search_form', 'wd_woocommerce_get_product_search_form' );
	function wd_woocommerce_get_product_search_form( $form ) {
		return '
		<form role="search" method="get" class="search_form" action="' . esc_url( home_url( '/' ) ) . '">
			<input type="text" class="search_field" placeholder="' . esc_attr__( 'Search for products &hellip;', 'wd' ) . '" value="' . get_search_query() . '" name="s" /><button class="search_button" type="submit">' . esc_html__( 'Search', 'wd' ) . '</button>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}


// Return URL to main shop page for the search form
if ( ! function_exists( 'wd_woocommerce_search_form_url' ) ) {
	//Handler of the add_filter( 'wd_filter_search_form_url', 'wd_woocommerce_search_form_url' );
	function wd_woocommerce_search_form_url( $url ) {
		if ( wd_exists_woocommerce() && wd_is_woocommerce_page() && is_shop() ) {
			$shop_url = wd_woocommerce_get_shop_page_link();
			if ( ! empty( $shop_url ) ) {
				$url = $shop_url;
			}
		}
		return $url;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if ( wd_exists_woocommerce() ) {
	require_once wd_get_file_dir( 'plugins/woocommerce/woocommerce-style.php' );
}


// One-click import support
//----------------------------------------------------------------------------

// Disable theme-specific fields in the exported options
if ( ! function_exists( 'wd_woocommerce_export_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_export_options', 'wd_woocommerce_export_options');
	function wd_woocommerce_export_options( $options ) {
		if ( ! empty( $options['woocommerce_paypal_settings'] ) ) {
			$options['woocommerce_paypal_settings']['email']          = '';
			$options['woocommerce_paypal_settings']['receiver_email'] = '';
			$options['woocommerce_paypal_settings']['identity_token'] = '';
		}
		return $options;
	}
}
