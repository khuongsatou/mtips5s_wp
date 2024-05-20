<?php 
 // removing woocommerce default styles hook
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// shop main or archive content hook
add_action('agrul_shop_main_content','agrul_shop_main_content_cb',10);
// shop main or archive end hook
add_action('agrul_shop_main_content_end','agrul_shop_main_content_end_cb',10);

// shop main or archive  before shop hook
add_action('woocommerce_before_shop_loop','agrul_woocommerce_filter_wrapper',20);

//  woocommerce shop or archive product content wrapper
add_action('agrul_woocommerce_product_content', 'agrul_woocommerce_tab_content_wrapper_start', 10 );

add_action('agrul_woocommerce_product_content', 'agrul_grid_tab_content_cb', 10 );
add_action('agrul_woocommerce_product_content', 'agrul_list_tab_content_cb', 20 );
add_action('agrul_woocommerce_product_content', 'agrul_woocommerce_tab_content_wrapper_end', 30 );
//  woocommerce shop or archive product thumnail content
add_action( 'woocommerce_before_shop_loop_item', 'agrul_loop_product_thumbnail', 10 );

// single product before summary
add_action('woocommerce_before_single_product_summary', 'agrul_woocommerce_before_single_product_summary',10);

// single product tag and rating
add_action('woocommerce_single_product_summary', 'agrul_woocommerce_template_single_rating_and_tags', 5 );

// single product title
add_action('woocommerce_single_product_summary', 'agrul_woocommerce_single_product_title', 10 );

// single product price and rating
add_action('woocommerce_single_product_summary', 'agrul_woocommerce_single_product_price', 20 );

// single product availability
add_action( 'woocommerce_single_product_summary', 'agrul_woocommerce_single_product_availability', 20 );

// single product excerpt
add_action('woocommerce_single_product_summary', 'agrul_woocommerce_single_product_excerpt', 30 );

// single product add to cart button
add_action('woocommerce_single_product_summary','agrul_woocommerce_single_add_to_cart_button',40);
// single product meta hook
add_action('woocommerce_single_product_summary','agrul_woocommerce_single_meta',60);

// single product add to cart button
add_action('woocommerce_single_product_summary','agrul_woocommerce_product_estimate_delivary',50);

// Display Fields using WooCommerce Action Hook
add_action( 'woocommerce_product_options_shipping', 'woocom_shipping_product_delivery_duration' );

// Hook to save the data value from the custom fields
add_action( 'woocommerce_process_product_meta', 'woocom_save_general_proddata_custom_field');

// agrul shop loop hozrizontal product thumbnail hook
add_action( 'woocommerce_before_shop_horizontal_loop_item', 'agrul_loop_horiontal_product_thumbnail', 10 );
add_action('agrul_woocommerce_sidebar','agrul_woocommerce_get_sidebar',10);




//  woocommerce archive or shop page hooks
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);


// removing archive or shop page content product hooks
remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);

// removing single product hooks
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_sale_flash',10);
remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images',20);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_sharing',50);


// removing content product hooks
remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);

remove_action('woocommerce_sidebar','woocommerce_get_sidebar',10);