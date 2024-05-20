<?php 

// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}

// agrul shop main content hook functions
if( !function_exists('agrul_shop_main_content_cb') ) {
    function agrul_shop_main_content_cb( ) {

        if( is_shop() || is_product_category() || is_product_tag() ) {
            echo '<div class="validtheme-shop-area default-padding">';
            	echo '<div class="container">';
        }elseif(is_product()){
            echo '<div class="validtheme-shop-single-area default-padding">';
                echo '<div class="container">';
                    echo '<div class="product-details">';
                        echo '<div class="row">';
        }else {
            echo '<div class="validtheme-shop-single-area default-padding">';
                echo '<div class="container">';
                    echo '<div class="row">';
        }
    }
}

// agrul shop main content hook function
if( !function_exists('agrul_shop_main_content_end_cb') ) {
    function agrul_shop_main_content_end_cb( ) {
            

        if( is_shop() || is_product_category() || is_product_tag() ) {
            echo '</div>';
                echo '</div>';
        }elseif(is_product()){
            echo '</div>';
                echo '</div>';
                    echo '</div>';
                        echo '</div>';
        } else {
            echo '</div>';
                echo '</div>';
                    echo '</div>';
        }
    }
}

// woocommerce filter wrapper hook function
if( ! function_exists('agrul_woocommerce_filter_wrapper') ) {
    function agrul_woocommerce_filter_wrapper( ) {
        echo '<div class="shop-listing-contentes">';
            echo '<div class="row item-flex center">';

            echo '<div class="col-lg-8 col-md-9 text-left">';
                    echo woocommerce_catalog_ordering();
                    echo woocommerce_result_count();
                echo '</div>';

                echo '<div class="col-lg-4 col-md-3 text-right">';
                    echo '<div class="content">';
                        echo '<!-- Tab Nav -->';
                        echo '<nav>';
                            echo '<div class="nav nav-tabs" id="nav-tab" role="tablist">';
                                echo '<button class="nav-link active" id="grid-tab-control" data-bs-toggle="tab" data-bs-target="#grid-tab" type="button" role="tab" aria-controls="grid-tab" aria-selected="true">';
                                    echo '<i class="fas fa-th-large"></i>';
                                echo '</button>';

                                echo '<button class="nav-link" id="list-tab-control" data-bs-toggle="tab" data-bs-target="#list-tab" type="button" role="tab" aria-controls="list-tab" aria-selected="false">';
                                    echo '<i class="fas fa-th-list"></i>';
                                echo '</button>';
                            echo '</div>';
                        echo '</nav>';
                        echo '<!-- End Tab Nav -->';
                    echo '</div>';
                echo '</div>';

            echo '</div>';
        echo '</div>';
    }
}

// woocommerce tab content wrapper start hook function
if( ! function_exists('agrul_woocommerce_tab_content_wrapper_start') ) {
    function agrul_woocommerce_tab_content_wrapper_start( ) {
        echo '<!-- Tab Content -->';
        echo '<div class="row"><div class="col-lg-12"><div class="tab-content tab-content-info text-center" id="shop-tabContent">';
    }
}

// woocommerce tab content wrapper start hook function
if( ! function_exists('agrul_woocommerce_tab_content_wrapper_end') ) {
    function agrul_woocommerce_tab_content_wrapper_end( ) {
        echo '</div></div></div>';
        echo '<!-- End Tab Content -->';
    }
}

// agrul grid tab content hook function
if( !function_exists('agrul_grid_tab_content_cb') ) {
    function agrul_grid_tab_content_cb( ) {
        echo '<!-- Strt Product Grid Vies -->';
            echo '<div class="tab-pane fade show active" id="grid-tab" role="tabpanel" aria-labelledby="grid-tab-control">';
            echo '<ul class="vt-products columns-'.esc_attr( wc_get_loop_prop( 'columns' ) ).'">';
            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action( 'woocommerce_shop_loop' );

                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end(); 
            echo '</ul>';
        echo '</div>';
        echo '<!-- End Grid -->';
    }
}

// agrul list tab content hook function
if( !function_exists('agrul_list_tab_content_cb') ) {
    function agrul_list_tab_content_cb( ) {
        echo '<!-- List -->';
        echo '<div class="tab-pane fade" id="list-tab" role="tabpanel" aria-labelledby="list-tab-control">';
            echo '<ul class="vt-products colums-2">';
                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content-horizontal', 'product' );
                    }
                    wp_reset_postdata();
                }
                woocommerce_product_loop_end();
            echo '</ul>';
        echo '</div>';
        echo '<!-- End List -->';
    }
}


// agrul loop horizontal product thumbnail hook function
if( !function_exists('agrul_loop_horiontal_product_thumbnail') ) {
    function agrul_loop_horiontal_product_thumbnail( ) {

    global $product;

    echo '<div class="product-contents">';
        echo '<div class="row align-center">';
            echo '<div class="col-lg-5">';
                echo '<div class="product-image">';
                    if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {
      
                    $regular_price  = get_post_meta( $product->get_id(), '_regular_price', true ); 
                    $sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
                 
                     if( !empty($sale_price) ) {
              
                        $amount_saved = $regular_price - $sale_price;
                        $currency_symbol = get_woocommerce_currency_symbol();
                        $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

                        echo "<span class='onsale'>" . number_format($percentage,0, '', '') .esc_html__('% Off', 'agrul'). "</span>";
                    }
                }
                    echo '<a href="'.esc_url( get_permalink() ).'">';
                    echo '<img src="'.esc_url( get_the_post_thumbnail_url() ).'" alt="Product">';
                    echo '</a>';
                    echo '<div class="shop-action">';
                        echo '<ul>';
                            echo '<li class="wishlist">';
                                if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
                                    echo do_shortcode( '[ti_wishlists_addtowishlist]' );
                                }
                            echo '</li>';
                            echo '<li class="quick-view">';
                                if( class_exists( 'WPCleverWoosq' ) ){
                                    echo do_shortcode('[woosq]');
                                }
                            echo '</li>';
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="col-lg-7">';
                echo '<div class="product-caption">';
                    if(is_product_tag()):
                        echo '<div class="tags">';
                            echo '<a href="#">'.wc_get_product_tag_list($product->get_id(), ',', '', '').'</a>';
                        echo '</div>';
                    endif;
                    echo '<h4 class="product-title">';
                       echo '<a href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title() ).'</a>';
                    echo '</h4>';
                    echo '<div class="review-count">';
                        echo woocommerce_template_loop_rating();
                        $rating_count = $product->get_rating_count();
                        echo '<span>(' .$rating_count.' Riview)</span>';
                    echo '</div>';
                    echo '<div class="price">';
                        echo woocommerce_template_loop_price();
                    echo '</div>';
                    if ($product->is_type('variable')) {
                    echo sprintf(
                        '<a href="%s" class="%s">%s</a>',
                        esc_url($product->add_to_cart_url()),
                        esc_attr(implode(' ', array_filter(array(
                            'button', 'product_type_' . $product->get_type(),
                            'btn btn-theme secondary btn-sm radius animation ajax_add_to_cart add_to_cart_button'
                        )))),
                        '<i class="fas fa-shopping-cart"></i><span>'.esc_html($product->add_to_cart_text()).'</span>',
                        
                    );
                    }else{
                        echo '<a href="'.$product->add_to_cart_url().'"  class="btn btn-theme secondary btn-sm radius animation ajax_add_to_cart add_to_cart_button" data-product_id="'.get_the_ID().'" data-product_sku="'.esc_attr($product->get_sku()).'" >';
                            echo '<i class="fas fa-shopping-cart"></i>';
                            echo '<span>'.esc_html($product->add_to_cart_text()).'</span>';
                    echo '</a>';
                    }                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
    }
}


// agrul loop product thumbnail hook function
if( !function_exists('agrul_loop_product_thumbnail') ) {
    function agrul_loop_product_thumbnail( ) {
        global $product;
        echo '<div class="product-contents">';
            echo '<div class="product-image">';
                if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {
      
                    $regular_price  = get_post_meta( $product->get_id(), '_regular_price', true ); 
                    $sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
                 
                     if( !empty($sale_price) ) {
              
                        $amount_saved = $regular_price - $sale_price;
                        $currency_symbol = get_woocommerce_currency_symbol();
                        $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

                        echo "<span class='onsale'>" . number_format($percentage,0, '', '') .esc_html__('% Off', 'agrul'). "</span>";
                    }
                }
                echo '<a href="'.esc_url( get_permalink() ).'">';
                    echo '<img src="'.esc_url( get_the_post_thumbnail_url() ).'" alt="Product">';
                echo '</a>';
                echo '<div class="shop-action">';
                    echo '<ul>';
                        echo '<li class="wishlist">';
                            if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
                                echo do_shortcode( '[ti_wishlists_addtowishlist]' );
                            }
                        echo '</li>';
                        echo '<li class="quick-view">';
                            if( class_exists( 'WPCleverWoosq' ) ){
                                echo do_shortcode('[woosq]');
                            }
                        echo '</li>';
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
            echo '<div class="product-caption">';
                echo '<h4 class="product-title">';
                    echo '<a href="'.esc_url( get_permalink() ).'">'.esc_html( get_the_title() ).'</a>';
                echo '</h4>';
                echo '<div class="review-count">';
                    echo '<div class="rating">';
                       echo woocommerce_template_loop_rating();
                    echo '</div>';
                    $rating_count = $product->get_rating_count();
                    echo '<span>(' .$rating_count.' Riview)</span>';
                echo '</div>';
                echo '<div class="price">';
                    echo woocommerce_template_loop_price();
                echo '</div>';
                if ($product->is_type('variable')) {
                    echo sprintf(
                        '<a href="%s" class="%s">%s</a>',
                        esc_url($product->add_to_cart_url()),
                        esc_attr(implode(' ', array_filter(array(
                            'button', 'product_type_' . $product->get_type(),
                            'btn btn-theme secondary btn-sm radius animation ajax_add_to_cart add_to_cart_button'
                        )))),
                        '<i class="fas fa-shopping-cart"></i><span>'.esc_html($product->add_to_cart_text()).'</span>',
                        
                    );
                }else{
                    echo '<a href="'.$product->add_to_cart_url().'"  class="btn btn-theme secondary btn-sm radius animation ajax_add_to_cart add_to_cart_button" data-product_id="'.get_the_ID().'" data-product_sku="'.esc_attr($product->get_sku()).'" >';
                        echo '<i class="fas fa-shopping-cart"></i>';
                        echo '<span>'.esc_html($product->add_to_cart_text()).'</span>';
                echo '</a>';
                }
            echo '</div>';
        echo '</div>';
    }
}

// add to cart button
function woocommerce_template_loop_add_to_cart( $args = array() ) {
    global $product;

        if ( $product ) {
            $defaults = array(
                'quantity'   => 1,
                'class'      => implode(
                    ' ',
                    array_filter(
                        array(
                            'cart-button icon-btn btn',
                            'product_type_' . $product->get_type(),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                        )
                    )
                ),
                'attributes' => array(
                    'data-product_id'  => $product->get_id(),
                    'data-product_sku' => $product->get_sku(),
                    'aria-label'       => $product->add_to_cart_description(),
                    'rel'              => 'nofollow',
                    'title'            => 'add to cart',
                ),
            );

            $args = wp_parse_args( $args, $defaults );

            if ( isset( $args['attributes']['aria-label'] ) ) {
                $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
            }
        }

        echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'btn cart-button icon-btn btn' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            '<i class="fas fa-shopping-cart"></i> <span>'.esc_html__('Add to cart', 'agrul').'</span>'
        );
}

// before single product summary hook
if( ! function_exists('agrul_woocommerce_before_single_product_summary') ) {
    function agrul_woocommerce_before_single_product_summary( ) {
        global $post,$product;
        $attachments = $product->get_gallery_image_ids();
        echo '<div class="col-lg-6">';
            echo '<div class="product-thumb">';
                if( $attachments ){
                echo '<div id="timeline-carousel" class="carousel slide" data-bs-ride="carousel">';

                    echo '<div class="carousel-inner item-box">';

                        $x = 0;
                        foreach( $attachments as $single_slide_image ){
                            $x++;
                            $active_class = ($x == 1) ? 'active' : '';

                            echo '<div class="carousel-item '.esc_attr( $active_class ).' product-item">';
                                echo '<a href="'.esc_url( wp_get_attachment_image_url( $single_slide_image, 'full') ).'" class="item popup-gallery">';
                                    echo '<img src="'.esc_url( wp_get_attachment_image_url( $single_slide_image, 'full' ) ).'" alt="Thumb">';
                                echo '</a>';
                                if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {
      
                                        $regular_price  = get_post_meta( $product->get_id(), '_regular_price', true ); 
                                        $sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
                                     
                                        if( !empty($sale_price) ) {
                                  
                                            $amount_saved = $regular_price - $sale_price;
                                            $currency_symbol = get_woocommerce_currency_symbol();
                                            $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

                                            echo "<span class='onsale theme'>-" . number_format($percentage,0, '', '') . "%</span>";
                                        }
                                }
                            echo '</div>';

                        }
                    echo '</div>';

                    echo '<!-- Carousel Indicators -->';
                    echo '<div class="carousel-indicators">';
                        echo '<div class="product-gallery-carousel swiper">';
                            echo '<!-- Additional required wrapper -->';
                            echo '<div class="swiper-wrapper">';

                                $x = 0;
                                foreach( $attachments as $single_slide_image ){
                                    
                                $active2_class = ($x !== 1) ? 'active' : '';
                                echo '<div class="swiper-slide">';
                                    echo '<div class="item '.esc_attr( $active2_class ).'" data-bs-target="#timeline-carousel" data-bs-slide-to="'.esc_attr( $x ).'" aria-current="true">';
                                        echo '<img src="'.esc_url( wp_get_attachment_image_url( $single_slide_image, 'full' ) ).'" alt="">';
                                    echo '</div>';
                                echo '</div>';
                                $x++;
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                    echo '<!-- End Carousel Content -->';
                }elseif( has_post_thumbnail() ){
                    echo '<div class="item-box">';
                        echo '<div class="product-item">';

                            echo '<a href="'.esc_url( get_the_post_thumbnail_url() ).'" class="item popup-gallery">';
                                echo '<img src="'.esc_url( get_the_post_thumbnail_url() ).'" alt="Thumb">';
                            echo '</a>';
                            if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ) {

                                $regular_price  = get_post_meta( $product->get_id(), '_regular_price', true ); 
                                $sale_price     = get_post_meta( $product->get_id(), '_sale_price', true );
                             
                                 if( !empty($sale_price) ) {
                          
                                    $amount_saved = $regular_price - $sale_price;
                                    $currency_symbol = get_woocommerce_currency_symbol();
                                    $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );

                                    echo "<span class='onsale theme'>-" . number_format($percentage,0, '', '') . "%</span>";
                                }
                            }
                        echo '</div>';
                    echo '</div>';
                }   
            echo '</div>';
        echo '</div>';
    }
}

// woocommerce single products tag and ratting hook function
if( ! function_exists('agrul_woocommerce_template_single_rating_and_tags') ) {
    function agrul_woocommerce_template_single_rating_and_tags( ) {
        global $product;
        $review_count = $product->get_review_count();
        if(!empty(wc_get_product_tag_list($product->get_id())) || ( $review_count > 0 )):
            echo '<div class="summary-top-box">';
                    if(!empty(wc_get_product_tag_list($product->get_id()))):
                        echo '<div class="tags">';
                            echo wc_get_product_tag_list($product->get_id(), ',', '', ''); 
                        echo '</div>';
                    endif;
                $review_count = $product->get_review_count();
                if ( $review_count > 0 ) : 
                    echo '<div class="review-count">';
                        echo '<div class="rating">';
                            echo woocommerce_template_loop_rating();
                            $rating_count = $product->get_rating_count();
                            echo '<span>(' .$rating_count.' Riview)</span>';
                        echo '</div>';
                    echo '</div>';
                endif;
            echo '</div>';
        endif;
    }
}

// woocommerce single products title
if( ! function_exists('agrul_woocommerce_single_product_title') ) {
    function agrul_woocommerce_single_product_title( ) {
        echo '<h2 class="product-title">'.esc_html( get_the_title() ).'</h2>';
    }
}

// woocommerce single products price
if( ! function_exists('agrul_woocommerce_single_product_price') ) {
    function agrul_woocommerce_single_product_price( ) {
        echo '<div class="price">';
            echo woocommerce_template_loop_price();
        echo '</div>';

    }
}

// single product availability hook function
if( !function_exists('agrul_woocommerce_single_product_availability') ) {
    function agrul_woocommerce_single_product_availability( ) {
        global $product;
        $availability = $product->get_availability();

        if( $availability['class'] != 'out-of-stock' ) {
            if( $product->get_stock_quantity() ){
                echo '<div class="product-stock validthemes-in-stock">';
                    echo '<div class="product-quantity">'.esc_html( $product->get_stock_quantity() ).' '.esc_html__( ' items availabe', 'agrul' ).'</div>';
                echo '</div>';
            }else{
                echo '<div class="product-stock validthemes-in-stock">';
                echo '<span>'.esc_html__( 'In Stock', 'agrul' ).'</span>';
            echo '</div>';
            }
            
        }else{
            echo '<div class="product-stock validthemes-in-stock">';
                echo '<span>'.esc_html__( 'Out Of Stock', 'agrul' ).'</span>';
            echo '</div>';
        }
    }
}


// single product excerpt hook function
if( !function_exists('agrul_woocommerce_single_product_excerpt') ) {
    function agrul_woocommerce_single_product_excerpt( ) {
        woocommerce_template_single_excerpt();
    }
}

// single product add to cart fuunction
if( !function_exists('agrul_woocommerce_single_add_to_cart_button') ) {
    function agrul_woocommerce_single_add_to_cart_button( ) {
        woocommerce_template_single_add_to_cart();    
    }
}

// single product ,eta hook function
if( !function_exists('agrul_woocommerce_single_meta') ) {
    function agrul_woocommerce_single_meta( ) {
        global $product;

        echo '<div class="product-meta">';
            if( ! empty( $product->get_sku() ) ){
                echo '<span class="sku">';
                    echo '<strong>'.esc_html__( 'SKU:', 'agrul' ).'</strong> '.$product->get_sku().'';
                echo '</span>';
            }
            echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n('<strong>'.__("Category:",'agrul').'</strong>', 'Categories:', count( $product->get_category_ids() ), 'agrul' ) .' ', '</span>' );
        echo '</div>';
    }
}

if( !function_exists('woocom_shipping_product_delivery_duration') ) {
    function woocom_shipping_product_delivery_duration() {
    global $woocommerce, $post;
        // shipping date max or min doration
        
        woocommerce_wp_text_input( 
            array( 
                'id'                => '_agrul_shipping_durations', 
                'label'             => __( 'Dalivery Time (in days)', 'agrul' ), 
                'desc_tip'          => 'true',
                'description'       => __( 'How many days you need to deliver this product?', 'agrul' ),
            )
        );
        woocommerce_wp_text_input( 
            array( 
              'id'              => '_delivery_text', 
              'label'           => __( 'Delivery Text', 'agrul' ), 
              'placeholder'     => __('Speedy and reliable parcel delivery!', 'agrul'),
              'desc_tip'        => 'true',
              'description' => __( 'This text will shown on sigle product page after the delivery date text', 'agrul' ) 
            )
        );
    }
}

if( !function_exists('woocom_save_general_proddata_custom_field') ) {

    /** Hook callback function to save custom fields information */
    function woocom_save_general_proddata_custom_field( $post_id ) {

        // days
        $agrul_shipping_durations = $_POST['_agrul_shipping_durations'];
        if( ! empty( $agrul_shipping_durations ) ) {
            update_post_meta( $post_id, '_agrul_shipping_durations', esc_attr( $agrul_shipping_durations ) );
        }
        // text for showing adter the duration 
        $day_duration_text = $_POST['_delivery_text'];
        if( ! empty( $day_duration_text ) ) {
            update_post_meta( $post_id, '_delivery_text', esc_attr( $day_duration_text ) );
        }
    }
}

// estimate delivery
if( !function_exists('agrul_woocommerce_product_estimate_delivary') ) {
    function agrul_woocommerce_product_estimate_delivary( ) {
        global $product;
        $delivery_durations = get_post_meta( get_the_ID(), '_agrul_shipping_durations', true );
        $day_duration_text = get_post_meta( get_the_ID(), '_delivery_text', true );

        $constant_days = 2;
        $conditional_day = 1;

        if(!empty($delivery_durations)){
            
            echo '<div class="product-estimate-delivary"><i class="fas fa-box-open"></i>';

                echo '<strong> '.esc_html( $delivery_durations ).''.esc_html__(' day Delivery', 'agrul').'</strong>';
                $note = !empty($day_duration_text) ? $day_duration_text : __( 'Speedy and reliable parcel delivery!', 'agrul' );
                echo '<span>'.esc_html($note).'</span>';
            echo '</div>';
        }   
    }
}

add_filter( 'woocommerce_add_to_cart_fragments', 'agrul_cart_count_fragments', 10, 1 );

function agrul_cart_count_fragments( $fragments ) {
    
    $fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
    
    return $fragments;
    
}
add_action( 'woocommerce_after_quantity_input_field', 'agrul_display_quantity_plus' );
  
function agrul_display_quantity_plus() {
   echo '<button type="button" class="plus">+</button>';
}
  
add_action( 'woocommerce_before_quantity_input_field', 'agrul_display_quantity_minus' );
  
function agrul_display_quantity_minus() {
   echo '<button type="button" class="minus">-</button>';
}
  
if ( class_exists( 'WooCommerce' ) ) {
//  update quantity script
  
add_action( 'wp_footer', 'agrul_add_cart_quantity_plus_minus' );
  
function agrul_add_cart_quantity_plus_minus() {
 
   wc_enqueue_js( "   
           
      $(document).on( 'click', 'button.plus, button.minus', function() {
  
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
        if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
        } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
        }
 
      });
        
   " );
    }
}

remove_action( 'woosq_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woosq_product_summary', 'agrul_woosq_template_single_rating', 10 );

function agrul_woosq_template_single_rating() {
    global $product;
    $review_count = $product->get_review_count();
    if ( $review_count > 0 ) : 
        echo '<div class="review-count">';
            echo '<div class="rating">';
                echo woocommerce_template_loop_rating();
            echo '</div>';
        echo '</div>';
    endif;
}

// agrul woocommerce get sidebar hook function
if( ! function_exists('agrul_woocommerce_get_sidebar') ) {
    function agrul_woocommerce_get_sidebar( ) {
        echo '<div class="col-lg-3 shop-left-sidebar">';
            dynamic_sidebar( 'agrul-shop-sidebar' );
        echo '</div>';
    }
}