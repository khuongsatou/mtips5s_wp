<?php
/*
Package: Vlogger
*/

if(!function_exists('vlogger_slideshowfullscreen')) {
	function vlogger_slideshowfullscreen($atts){
		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'id' => false,
			'quantity' => 1,
			'posttype' => 'post',
			'offset' => 0,
			'category' => false
			
		), $atts ) );

		$quantity = (int)$quantity;
		if(!is_numeric($quantity)) {
			$quantity = 1;
		}
		
		if(!is_numeric($offset)) {
			$offset = 0;
		}
		/**
		 *  Query for my content
		 */
		$args = array(
			'post_type' =>  $posttype,
			'posts_per_page' => $quantity,
			'post_status' => 'publish',
			'paged' => 1,
			'suppress_filters' => false,
			'offset' => esc_attr($offset),
			'ignore_sticky_posts' => 1,
			 'meta_query' => array(
		        array(
		         'key' => '_thumbnail_id',
		         'compare' => 'EXISTS'
		        ),
		    )
		);

		/**
		 * Add category parameters to query if any is set
		 */
		if (false !== $category && 'all' !== $category) {
			$args[ 'tax_query'] = array(
					array(
					'taxonomy' => esc_attr( vlogger_get_type_taxonomy( $posttype ) ),
					'field' => 'slug',
					'terms' => array(esc_attr($category)),
					'operator'=> 'IN' //Or 'AND' or 'NOT IN'
				)
			);
		}

		// ========== EVENTS ONLY QUERY =================
		if($posttype == 'event'){
			$args['orderby'] = 'meta_value';
			$args['order']   = 'ASC';
			$args['meta_key'] = 'eventdate';
			$args['meta_query'] = array(
			array(
				'key' => 'eventdate',
				'value' => date('Y-m-d'),
				'compare' => '>=',
				'type' => 'date'
				 )
			);
		}
		// ========== END OF EVENTS ONLY QUERY =================
		
		

		// ========== QUERY BY ID =================
		if($id){
			$idarr = explode(",",$id);
			if(count($idarr) > 0){
				$quantity = count($idarr);
				$args = array(
					'post__in'=> $idarr,
					'post_type' =>  'any',
					'orderby' => 'post__in',
					'posts_per_page' => intval($quantity),
					'ignore_sticky_posts' => 1
				);  
			}
		}
		// ========== QUERY BY ID END =================

		/**
		 * [$wp_query execution of the query]
		 * @var WP_Query
		 */
		$wp_query = new WP_Query( $args );
		
		/**
		 * Output object start
		 */
		ob_start();
		if ( $wp_query->have_posts()  ) : 
			$numposts = $wp_query->found_posts;
			$slides = $quantity;
			$cols = 12 / $slides;
			?>

		 	<div class="slider qt-material-slider qt-hero-slider" data-timeout="4000">
				<ul class="slides">
					<?php
					add_filter( "excerpt_length", "vlogger_excerpt_length", 999 );

					while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
						setup_postdata( $post );
						/**
						 *  WE HAVE TO USE THE ARCHIVE ITEM FOR EACH SPECIFIC POSTTYPE
						 */
						$template_type = $posttype;
						if($posttype === 'post') {
							$template_type = 'post-vertical';
						}
						?>
							<li>
								<?php get_template_part('phpincludes/part-archive-item-slide'); ?>
							</li>
						<?php 
					endwhile;  
					
					?>


				</ul>
				<div class="row qt-nopadding qt-hero-slider-index">

					<?php

					if($quantity > 1){
						$n = 0;
						while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$post = $wp_query->post;
							setup_postdata( $post );
							
							?>
							<div class="col m<?php echo esc_attr($cols); ?> qt-hero-slider-index-item qt-negative qt-active">
								<div class="qt-vc">
									<div class="qt-vi">
										<ul class="qt-tags">
											<?php  
											/**
											 * [$category Array of categories]
											 * @var [array]
											 * We want only the first category
											 */
											$category = get_the_category(); 
											$limit = 0;
											foreach($category as $i => $cat){
												if($i > $limit){
													continue;
												}
												echo '<li><a class="category waves-effect" href="'.get_category_link($cat->term_id ).'">'.$cat->cat_name.'</a></li>';  
											}	
											?>
										</ul>
										<h5 class="qt-tit qt-ellipsis-2 qt-t"><?php the_title(); ?></h5>
									</div>
								</div>
								<a href="#" class="qt-hover" data-qtslidegoto="<?php echo esc_attr($n); ?>"></a>
								<div class="qt-bg" data-bgimage="<?php echo get_the_post_thumbnail_url(null,'medium'); ?>">
								</div>
							</div>
							<?php 
							$n = $n +1;
						endwhile; 
					}
					?>
					<?php remove_filter( "excerpt_length", "vlogger_excerpt_length", 999 ); ?>
				</div>
			</div>
			<?php  
		endif; 
		wp_reset_postdata();
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-slideshowfullscreen","vlogger_slideshowfullscreen");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_slideshow_fullscreen' );
if(!function_exists('vlogger_vc_slideshow_fullscreen')){
function vlogger_vc_slideshow_fullscreen() {
  vc_map( array(
	 "name" => esc_html__( "Slideshow Fullscreen", "vlogger" ),
	 "base" => "qt-slideshowfullscreen",
	 "icon" => get_template_directory_uri(). '/img/slideshow-fullscreen.png',
	 "description" => esc_html__( "Slideshow of post or custom posts", "vlogger" ),
	 "category" => esc_html__( "Theme shortcodes", "vlogger"),
	 "params" => array(

	 	array(
           "type" => "textfield",
           "heading" => esc_html__( "ID, comma separated list (123,345,7638)", "vlogger" ),
           "description" => esc_html__( "Display only the contents with these IDs. All other parameters will be ignored.", "vlogger" ),
           "param_name" => "id",
           'value' => ''
        ),


		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Post type", "vlogger" ),
		   "param_name" => "posttype",
		   'value' => array("post", "page", "vlogger_serie"),
		   "description" => esc_html__( "Number of posts to display", "vlogger" )
		),
		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Quantity", "vlogger" ),
		   "param_name" => "quantity",
		   'value' => array(1, 2, 3, 4, 6),
		   "description" => esc_html__( "Number of posts to display", "vlogger" )
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Filter by category (slug)", "vlogger" ),
		   "description" => esc_html__("Instert the slug of a category to filter the results","vlogger"),
		   "param_name" => "category"
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Offset (number)", "vlogger" ),
		   "description" => esc_html__("Number of posts to skip in the database query","vlogger"),
		   "param_name" => "offset"
		)
	 )
  ) );
}}
