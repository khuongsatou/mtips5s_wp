<?php
	/**
	* Elementor Agrul Product Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Woo_Product_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Product widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_woo_products';
	}

	/**
	* Get widget title.
	*
	* Retrieve Product Nav Tab widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Woocommerce Product', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Product Nav Tab widget icon.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget icon.
	*/
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	* Get widget categories.
	*
	* Retrieve the list of categories the Product Nav Tab widget belongs to.
	*
	* @since 1.0.0
	* @access public
	*
	* @return array Widget categories.
	*/
	public function get_categories() {
		return [ 'agrul_elements' ];
	}
	
	// Add The Input For User
	protected function register_controls(){

		$this->start_controls_section(
			'agrul_woo_product_style',
			[
				'label'		=> esc_html__( 'Agrul Woocommerce Product Style','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> esc_html__( 'Style', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  	=> esc_html__( 'Style One', 'agrul-core' ),
					'2' 	=> esc_html__( 'Style Two', 'agrul-core' ),
					'3' 	=> esc_html__( 'Style Three', 'agrul-core' ),
				],
			]
		);

		$this->add_control(
			'title', [
				'label' 		=> esc_html__( 'Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'subtitle', [
				'label' 		=> esc_html__( 'Sub-Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'			=> esc_html__( 'Add Bg Image','agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::MEDIA,
				'condition' => [
                    'style' => '3'
                ]
			]
		);

		$this->add_control(
			'button_text', [
				'label' 		=> esc_html__( 'Button Text', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'rows'          =>'2',
				'default' => esc_html__( 'Button Text', 'agrul-core' ),
				'condition' => [
                    'style' => '3'
                ]
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' 		=> esc_html__( 'Button URL', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'agrul-core' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> true,
					'nofollow' 		=> true,
				],
				'condition' => [
                    'style' => '3'
                ]
			]
		);

		$this->add_control(
			'product_title', [
				'label' 		=> esc_html__( 'Product Title', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
				'label_block' 	=> true,
				'condition' => [
                    'style' => '3'
                ]
			]
		);

		$this->add_control(
			'product_filter',
			[
				'label' 		=> esc_html__( 'Filter Product', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'noraml',
				'options' 		=> [
					'noraml' 		=> esc_html__( 'Default', 'agrul-core' ),
					'best_sale'  	=> esc_html__( 'Best-selling', 'agrul-core' ),
					'on_sale' 		=> esc_html__( 'On Sale', 'agrul-core' ),
					'top_rated'  	=> esc_html__( 'Top Rated', 'agrul-core' ),
					'featured'  	=> esc_html__( 'Featured', 'agrul-core' ),
				],
				'condition' => [
                    'style' => ['1','3']
                ]
			]
		);

		$this->add_control(
			'post_limit',
			[
				'label' 		=> esc_html__( 'Post Limit', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::TEXT,
				'placeholder'	=> esc_html__( 'Only Number Work. Like 4 or 6', 'agrul-core' ),
			]
		);
		$this->add_control(
			'order',
			[
				'label' 		=> esc_html__( 'Order', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'ASC',
				'options' 		=> [
					'ASC'  			=> esc_html__( 'Ascending', 'agrul-core' ),
					'DESC' 			=> esc_html__( 'Descending', 'agrul-core' ),
				],
			]
		);
		$this->add_control(
			'order_by',
			[
				'label' 		=> esc_html__( 'Order By', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'date',
				'options' 		=> [
					'none'  		=> esc_html__( 'None', 'agrul-core' ),
					'type' 			=> esc_html__( 'Type', 'agrul-core' ),
					'title' 		=> esc_html__( 'Title', 'agrul-core' ),
					'name' 			=> esc_html__( 'Name', 'agrul-core' ),
					'date' 			=> esc_html__( 'Date', 'agrul-core' ),
				],
			]
		);

		$this->add_control(
			'product_column',
			[
				'label' 	=> esc_html__( 'Column Type', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> '4',
				'options' 	=> [
					'2' 	=> esc_html__( 'Two Column', 'agrul-core' ),
					'3'  	=> esc_html__( 'Three Column', 'agrul-core' ),
					'4' 	=> esc_html__( 'Four Column', 'agrul-core' ),
				],
			]
		);

		$this->add_control(
		    'show_filter',
		    [
		        'label' => __('Enable Filter', 'agrul-addon'),
		        'type' => \Elementor\Controls_Manager::SWITCHER,
		        'label_on' => __('Show', 'agrul-addon'),
		        'label_off' => __('Hide', 'agrul-addon'),
		        'return_value' => 'yes',
		        'default' => 'yes',
		        'condition' => [
                    'style' => '2'
                ]
		    ]
		);

		$this->add_control(
		    'select_product_category',
		    [
		        'label' => __('Product Category', 'agrul-addon'),
		        'type' => \Elementor\Controls_Manager::SELECT2,
		        'options' => agrul_get_taxonoy('product_cat'),
		        'multiple' => true,
		        'condition' => [
		            'show_filter' => 'yes',
		             'style' => '2'
		        ]
		    ]
		);

		$this->add_control(
			'shape',
			[
				'label' 	=> esc_html__( 'Shape', 'agrul-core' ),
				'type' 		=> \Elementor\Controls_Manager::MEDIA,
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'woo_product_style_option',
			[
				'label'			=> esc_html__( 'Content Style','agrul-core' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'section_title_option',
			[
				'label' 		=> esc_html__( 'Section Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'section_title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .site-heading .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .site-heading .title',
			]
		);

		$this->add_control(
			'section_subtitle_option',
			[
				'label' 		=> esc_html__( 'Section Sub-Title Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'section_subtitle_color',
			[
				'label' 		=> esc_html__( 'Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'section_subtitle_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .sub-title',
			]
		);

		$this->add_control(
			'product_title_option',
			[
				'label' 		=> esc_html__( 'Product Title Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'product_title_color',
			[
				'label' 		=> esc_html__( 'Product Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}}  .vt-products .product .product-contents .product-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'product_title_typography',
				'label' 		=> esc_html__( 'Product Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .vt-products .product .product-contents .product-title a',
			]
		);

		$this->add_control(
			'product_price_option',
			[
				'label' 		=> esc_html__( 'Product Price Options', 'agrul-core'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'product_price_color',
			[
				'label' 		=> esc_html__( 'Product Price Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .vt-products .product .product-caption .price span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'product_price_typography',
				'label' 		=> esc_html__( 'Product Price Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .vt-products .product .product-caption .price span',
			]
		);


		$this->add_control(
			'button_option',
			[
				'label' 		=> esc_html__( 'Button Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> esc_html__( 'Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' 		=> esc_html__( 'Background Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> esc_html__( 'Hover Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label' 		=> esc_html__( 'Hover Background Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme.secondary::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'label' 		=> esc_html__( 'Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .btn.btn-theme.secondary',
			]
		);

		$this->end_controls_section();
	}

	// Output For User
	protected function render(){	
	$agrul_woo_product_output = $this->get_settings_for_display();
	$product_category = $agrul_woo_product_output['select_product_category'];
	if($agrul_woo_product_output['style'] == '1'):
	?>
	<!-- Start Product 
    ============================================= -->
    <div class="product-style-one-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h5 class="sub-title"><?php echo esc_html($agrul_woo_product_output['subtitle'] ); ?></h5>
                        <h2 class="title"><?php echo esc_html($agrul_woo_product_output['title'] ); ?></h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <ul class="vt-products text-center columns-<?php echo esc_attr($agrul_woo_product_output['product_column']);?>">

                    <?php

                    	if($agrul_woo_product_output['product_filter'] == 'noraml'):
					        $args = array(
					            'post_type'   => 'product',
					            'post_status'    => 'publish',
					            'posts_per_page'   => esc_attr( $agrul_woo_product_output['post_limit'] ),
						        'orderby'     => esc_attr( $agrul_woo_product_output['order_by'] ),
						        'order'       => esc_attr( $agrul_woo_product_output['order'] ),
					        );
					    elseif($agrul_woo_product_output['product_filter'] == 'best_sale'):
					    	$args = array(
							    'post_type' => 'product',
							    'post_status'    => 'publish',
							    'meta_key' => 'total_sales',
							    'orderby' => 'meta_value_num',
							    'posts_per_page' => esc_attr( $agrul_woo_product_output['post_limit'] ),
							);
						elseif($agrul_woo_product_output['product_filter'] == 'on_sale'):
							$args = array(
							    'post_type'      => 'product',
							    'post_status'    => 'publish',
							    'order'       => esc_attr( $agrul_woo_product_output['order'] ),
							    'orderby'     => esc_attr( $agrul_woo_product_output['order_by'] ),
							    'posts_per_page' => esc_attr( $agrul_woo_product_output['post_limit'] ),
							    'meta_query'     => array(
							        'relation' => 'OR',
							        array( // Simple products type
							            'key'           => '_sale_price',
							            'value'         => 0,
							            'compare'       => '>',
							            'type'          => 'numeric'
							        ),
							        array( // Variable products type
							            'key'           => '_min_variation_sale_price',
							            'value'         => 0,
							            'compare'       => '>',
							            'type'          => 'numeric'
							        )
							    )
							);
						elseif($agrul_woo_product_output['product_filter'] == 'top_rated'):
							$args = array(
								'posts_per_page' => esc_attr( $agrul_woo_product_output['post_limit'] ),
								'no_found_rows'  => 1,
								'post_status'    => 'publish',
								'post_type'      => 'product',
								'meta_key'       => '_wc_average_rating',
								'orderby'        => 'meta_value_num',
								'order'          => esc_attr( $agrul_woo_product_output['order'] ),
								'meta_query'     => WC()->query->get_meta_query(),
								'tax_query'      => WC()->query->get_tax_query(),
							);
						elseif($agrul_woo_product_output['product_filter'] == 'featured'):	
							$args = array(
							    'post_type'           => 'product',
							    'posts_per_page'      =>  esc_attr( $agrul_woo_product_output['post_limit'] ),
							    'orderby'             => esc_attr( $agrul_woo_product_output['order_by'] ),
							    'order'               => esc_attr( $agrul_woo_product_output['order'] ),
							    'post__in'            => wc_get_featured_product_ids(),
							); 
					    endif;

				        $loop = new WP_Query( $args );
				        if ( $loop->have_posts() ) {
				            while ( $loop->have_posts() ) : $loop->the_post();
				                wc_get_template_part( 'content', 'product' );
				            endwhile;
				        } else {
				            echo __( 'No products found' );
				        }
				        wp_reset_postdata();
				    ?>

                </ul>
            </div>
        </div>
    </div>
    <!-- End Product -->
	<?php elseif($agrul_woo_product_output['style'] == '2'):?>
	 <!-- Start Mix Product
    ============================================= -->
    <div class="mix-product-area default-padding-bottom">
		<?php if(!empty($agrul_woo_product_output['shape']['url'])):?>
	        <div class="shape-left-top">
	           <?php 
	        	echo agrul_img_tag( array(
		            'url'   => esc_url( $agrul_woo_product_output['shape']['url'] )
		    	) );?>
	        </div>
		<?php endif;?>
        <?php if(!empty($agrul_woo_product_output['subtitle'] || $agrul_woo_product_output['title'])):?>
        <div class="container">
            <div class="site-heading">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="left-info">
                            <h5 class="sub-title"><?php echo esc_html($agrul_woo_product_output['subtitle'] ); ?></h5>
                            <h2 class="title"><?php echo esc_html($agrul_woo_product_output['title'] ); ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php endif;?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="mix-item-menu product-mix-menu text-center">
                        <button class="active" data-filter="*">All</button>
                        <?php
							foreach ($product_category as $category) :
								$cat = get_term_by('slug', $category, 'product_cat');
								$cat_slug = $cat->slug;
							?>
                        	<button data-filter=".<?php echo esc_attr($cat_slug); ?>"><?php echo esc_html($cat->name); ?></button>
                        <?php endforeach; ?>
                    </div>
                    <!-- End Mixitup Nav-->

                    <ul id="shop-masonary" class="vt-products text-center columns-4">
					<?php

					if (!empty($agrul_woo_product_output['select_product_category'])) :
						$shop_post_query = new \WP_Query(array(
							'post_type' => 'product',
							'posts_per_page' => $agrul_woo_product_output['post_limit'],
							'orderby' => 'menu_order title',
							'order'   => $agrul_woo_product_output['order'],
							'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									'terms' => $agrul_woo_product_output['select_product_category']
								)
							)
						));

					else :

						$shop_post_query = new \WP_Query(array(
							'post_type' => 'product',
							'posts_per_page' => $agrul_woo_product_output['post_limit'],
							'orderby' => 'menu_order title',
							'order'   => $agrul_woo_product_output['order'],
						));

					endif;
					$i = 1;
					while ($shop_post_query->have_posts()) :
						$shop_post_query->the_post();
						global $product;
						$price = get_post_meta(get_the_ID(), '_price', true);
						$product_category =  get_the_terms(get_the_ID(), 'product_cat');
					?>
                        <!-- Single product -->
                        <li class="product <?php if (is_array($product_category)) foreach ($product_category as $cat) { echo esc_attr(' ' . $cat->slug); } ?>">
                            <div class="product-contents">
                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                                     <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                                    </a>
                                    <div class="shop-action">
                                        <ul>
                                            <li class="cart">
                                               	<?php 
	                                               	if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
	                                    			echo do_shortcode( '[ti_wishlists_addtowishlist]' );
	                                				}
                                				?>
                                            </li>
                                            <li class="wishlist">
                                                <?php 
	                                               	if( class_exists( 'WPCleverWoosq' ) ){
					                                    echo do_shortcode('[woosq]');
					                                }
                                				?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="product-tags">
                                        <?php
                                        if (is_array($product_category)) 
	                                        foreach ($product_category as $cat){?>
	                                         <a href="<?php the_permalink(); ?>"><?php echo esc_html($cat->slug);?></a>
	                                     	<?php } 
                                     	?>
                                    </div>
                                    <h4 class="product-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <div class="review-count">
                                        <div class="rating">
                                           <?php echo woocommerce_template_loop_rating(); ?>
                                        </div>
                                    </div>
                                    <div class="price">
                                        <span><?php echo woocommerce_template_loop_price(); ?></span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Single product -->
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
                    </ul>
                	
                </div>
            </div>
        </div>
    </div>
    <!-- End Mix Product Area -->

	<?php elseif($agrul_woo_product_output['style'] == '3'):?>

    <!-- Start Product Style Three
    ============================================= -->
    <div class="top-selling-product-area overflow-hidden default-padding-bottom bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pr-50 pr-md-15 pr-xs-15">
                    <div class="best-selling-banner text-light" style="background-image: url(<?php echo esc_url($agrul_woo_product_output['bg_image']['url']); ?>);">
                        <h5 class="sub-title"><?php echo htmlspecialchars_decode(esc_html($agrul_woo_product_output['subtitle'],'agrul-core')); ?></h5>
                        <h2 class="title"><?php echo htmlspecialchars_decode(esc_html($agrul_woo_product_output['title'],'agrul-core')); ?></h2>
 						<?php if(!empty($agrul_woo_product_output['button_text'])):?>
                        	<a class="btn btn-theme secondary circle mt-20 btn-md animation" href="<?php echo esc_url($agrul_woo_product_output['button_url']['url']);?>"><?php echo esc_html($agrul_woo_product_output['button_text']);?></a>
 						<?php endif;?>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="content-heading pl-15 pr-15 mb-40">
                        <h2 class="title">
                            <?php echo htmlspecialchars_decode(esc_html($agrul_woo_product_output['product_title'],'agrul-core')); ?>
                        </h2>
                    </div>
                    <div class="top-selling-carousel swiper text-center vt-products">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
							<?php

							if (!empty($agrul_woo_product_output['select_product_category'])) :
								$shop_post_query = new \WP_Query(array(
									'post_type' => 'product',
									'posts_per_page' => $agrul_woo_product_output['post_limit'],
									'orderby' => 'menu_order title',
									'order'   => $agrul_woo_product_output['order'],
									'tax_query' => array(
										array(
											'taxonomy' => 'product_cat',
											'field' => 'slug',
											'terms' => $agrul_woo_product_output['select_product_category']
										)
									)
								));

							else :

								$shop_post_query = new \WP_Query(array(
									'post_type' => 'product',
									'posts_per_page' => $agrul_woo_product_output['post_limit'],
									'orderby' => 'menu_order title',
									'order'   => $agrul_woo_product_output['order'],
								));

							endif;
							$i = 1;
							while ($shop_post_query->have_posts()) :
								$shop_post_query->the_post();
								global $product;
								$price = get_post_meta(get_the_ID(), '_price', true);
								$product_category =  get_the_terms(get_the_ID(), 'product_cat');
							?>
	                            <!-- Single Item -->
	                            <div class="swiper-slide">
	                                <div class="product">
	                                    <div class="product-contents">
	                                        <div class="product-image">
	                                            <a href="<?php the_permalink(); ?>">
			                                     <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
			                                    </a>
	                                            <div class="shop-action">
	                                                <ul>
	                                                   <li class="cart">
			                                               	<?php 
				                                               	if( class_exists( 'TInvWL_Admin_TInvWL' ) ){
				                                    			echo do_shortcode( '[ti_wishlists_addtowishlist]' );
				                                				}
			                                				?>
			                                            </li>
			                                            <li class="wishlist">
			                                                <?php 
				                                               	if( class_exists( 'WPCleverWoosq' ) ){
								                                    echo do_shortcode('[woosq]');
								                                }
			                                				?>
			                                            </li>
	                                                </ul>
	                                            </div>
	                                        </div>
	                                        <div class="product-caption">
	                                            <div class="product-tags">
	                                               <?php
			                                        	if (is_array($product_category)) 
				                                        foreach ($product_category as $cat){?>
				                                         <a href="<?php the_permalink(); ?>"><?php echo esc_html($cat->slug);?></a>
				                                     	<?php } 
                                     				?>
	                                            </div>
	                                            <h4 class="product-title">
	                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	                                            </h4>
	                                            <div class="review-count">
	                                                <?php echo woocommerce_template_loop_rating(); ?>
	                                            </div>
	                                            <div class="price">
	                                                <span><?php echo woocommerce_template_loop_price(); ?></span>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <!-- End Single Item -->
	                        <?php endwhile; ?>
							<?php wp_reset_postdata(); ?>   
                        </div>

                        <!-- Navigation -->
                        <div class="top-selling-product-nav">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Top Selling Product -->
    <?php 	
	endif;
    }
}