<?php
	/**
	* Elementor Blog Widget.
	*
	* Elementor widget that inserts an embbedable content into the page, from any given URL.
	*
	* @since 1.0.0
	*/
class Elementor_Agrul_Blog_Widget extends \Elementor\Widget_Base {

	/**
	* Get widget name.
	*
	* Retrieve Blog widget name.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget name.
	*/
	public function get_name() {
		return 'agrul_blog';
	}

	/**
	* Get widget title.
	*
	* Retrieve Blog widget title.
	*
	* @since 1.0.0
	* @access public
	*
	* @return string Widget title.
	*/
	public function get_title() {
		return esc_html__( 'Agrul Blog', 'agrul-core' );
	}

	/**
	* Get widget icon.
	*
	* Retrieve Blog widget icon.
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
	* Retrieve the list of categories the Blog widget belongs to.
	*
	* @since 1.0.0
	* @access public
	*
	* @return array Widget categories.
	*/
	public function get_categories() {
		return [ 'agrul_elements' ];
	}

	
	protected function register_controls(){

		$this->start_controls_section(
			'blog_section_content',
			[
				'label'		=> esc_html__( 'Set Content','agrul-core' ),
				'tab'		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_from',
			[
				'label' 		=> esc_html__( 'Post From', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'default' 		=> 'all',
				'options' 		=> [
					'all'  			=> esc_html__( 'All', 'agrul-core' ),
					'categories' 	=> esc_html__( 'Categories', 'agrul-core' ),
				],
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

		$this->end_controls_section();
		
		$this->start_controls_section(
			'blog_style_option',
			[
				'label'			=> esc_html__( 'Content Style','agrul-core' ),
				'tab' 			=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_option',
			[
				'label' 		=> esc_html__( 'Title Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' 		=> esc_html__( 'Title Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-style-one .title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'label' 		=> esc_html__( 'Title Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .blog-style-one .title a',
			]
		);


		$this->add_control(
			'name_option',
			[
				'label' 		=> esc_html__( 'Meta Info Options', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'name_color',
			[
				'label' 		=> esc_html__( 'Meta Info Color', 'agrul-core' ),
				'type' 			=> \Elementor\Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .blog-area .info .meta ul li, .blog-area .info .meta ul li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 			=> 'name_typography',
				'label' 		=> esc_html__( 'Meta Info Typography', 'agrul-core' ),
				'selector' 		=> '{{WRAPPER}} .blog-area .info .meta ul li, .blog-area .info .meta ul li a',
			]
		);

		$this->end_controls_section();
		
	}


	protected function render(){
		
		$agrul_blog_output = $this->get_settings_for_display();
		global $post;
		$blog = array(
		   'post_type'         => 'post',
		   'posts_per_page'    => esc_attr( $agrul_blog_output['post_limit'] ),
		   'order'             => esc_attr( $agrul_blog_output['order'] ),
		   'orderby'           => esc_attr( $agrul_blog_output['order_by'] ),
	    );
	    $agrul_blog = new WP_Query( $blog );
	?>
    <!-- Start Blog Area
    ============================================= -->
    <div class="blog-area home-blog blog-grid default-padding bottom-less">
        <div class="container">
            <div class="row">

            	<?php 
            		$counter = 1;
            		while ( $agrul_blog->have_posts()) :
       				$agrul_blog->the_post();
					$full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'full');
					$resize_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'agrul_284X355');
       				
       			?>
                <div class="col-lg-<?php if($counter == 1){ echo esc_attr__("6");} else{echo "3";}?> col-md-<?php if($counter == 1){ echo esc_attr__("12");} else{echo "6";}?> mb-30">
                    <div class="blog-style-one">
                    	<?php if($counter == 1):?>
                    	<?php if(!empty($full_image_url[0])):?>
	                        <div class="thumb">
	                            <a href="<?php echo  esc_url( get_permalink() ); ?>"><img src="<?php echo esc_url($full_image_url[0]);?>" class="w-100" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
	                            <div class="date"><strong><?php the_time('j'); ?></strong> <span><?php the_time('M,y'); ?></span></div>
	                        </div>
                        <?php endif;?>
                        <?php else:?>
                        	<?php if(!empty($resize_image_url[0])):?>
	                        <div class="thumb">
	                            <a href="<?php echo  esc_url( get_permalink() ); ?>"><img src="<?php echo esc_url($resize_image_url[0]);?>" class="w-100" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
	                            <div class="date"><strong><?php the_time('j'); ?></strong> <span><?php the_time('M,y'); ?></span></div>
	                        </div>
                        <?php endif;?>
                        <?php endif;?>
                        <div class="info">
                            <div class="meta">
                                <ul>
                                    <li>
                                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) );?>"><i class="fas fa-user-circle"></i> <?php echo esc_html( ucwords( get_the_author() ) );?></a>
                                    </li>
                                    <li>
                                        <a href="<?php echo  esc_url( get_permalink() ); ?>"><i class="fas fa-comments"></i> <?php echo get_comments_number();?> <?php if(get_comments_number() > '1'){echo esc_html__("Comments", 'dustra' );}else{echo esc_html__("Comment", 'dustra' );} ?></a>
                                    </li>
                                </ul>
                            </div>
                            <h4 class="title">
                                <a href="<?php echo  esc_url( get_permalink() ); ?>"><?php echo esc_html(get_the_title());?></a>
                            </h4>
                        </div>
                    </div>
                </div>
                <?php $counter++; endwhile; wp_reset_postdata();?>
            </div>
        </div>
    </div>
    <!-- End Blog Area -->
    <?php 
	}
}
