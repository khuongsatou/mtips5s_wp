<?php
/*
Package: Vlogger
*/

if(!function_exists('vlogger_carousel_post')) {
	function vlogger_carousel_post($atts){

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'id' => false,
			'quantity' => 6,
			'posttype' => 'post',
			'category' => false,
			'offset' => 0,
			'template' => 'phpincludes/part-archive-item-card-post'
			
		), $atts ) );


		if(!is_numeric($quantity)) {
			$quantyty = 6;
		}

		$offset = (int)$offset;
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
			'ignore_sticky_posts' => 1
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
					'orderby' => 'post__in',
					'posts_per_page' => -1,
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
		if ( $wp_query->have_posts() ) : 
		?>
			<div class="qt-slickslider-container qt-slickslider-posts qt-carousel-post-shortcode">
				<div class="qt-slickslider qt-invisible qt-animated qt-slickslider-multiple" data-slidestoshow="3" data-slidestoscroll="1" data-variablewidth="false" data-arrows="true" data-dots="true" data-infinite="true" data-centermode="false" data-pauseonhover="true" data-autoplay="false" data-arrowsmobile="false"  data-arrowsipad="false" data-centermodemobile="false" data-dotsmobile="true" data-slidestoshowmobile="1" data-variablewidthmobile="true" data-infinitemobile="false" data-slidestoshowipad="2">		
					<?php
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
						<div class="qt-item">
							<?php get_template_part ( $template); ?>
						</div>
					<?php endwhile;  ?>
				</div>
			</div>
		<?php else: 
			esc_html_e("Sorry, there is nothing for the moment.", "vlogger"); ?>
		<?php  
		endif; 
		wp_reset_postdata();
		/**
		 * Loop end;
		 */
		
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("vlogger-carousel-post","vlogger_carousel_post");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_carousel_short' );
if(!function_exists('vlogger_vc_carousel_short')){
function vlogger_vc_carousel_short() {
  vc_map( array(
     "name" => esc_html__( "Post Carousel", "vlogger" ),
     "base" => "vlogger-carousel-post",
     "icon" => get_template_directory_uri(). '/img/post-carousel.png',
     "description" => esc_html__( "Carousel of posts on 3 columns", "vlogger" ),
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
           "heading" => esc_html__( "Quantity", "vlogger" ),
           "param_name" => "quantity",
           'value' => array("6", "9", "12", "15"),
           "description" => esc_html__( "Number of posts to display", "vlogger" )
        ),
        array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Post template", "vlogger" ),
		   "param_name" => "template",
		   'value' => array(
		   		__("Default", "vlogger")			=>"phpincludes/part-archive-item-card-post",
				__("Compact", "vlogger")			=>"phpincludes/part-archive-item-compact",
			 	// __("Inline", "vlogger")			=>"phpincludes/part-archive-item-inline",
				__("Medium", "vlogger")			=>"phpincludes/part-archive-item-medium",
				__("Large no text", "vlogger")	=>"phpincludes/part-archive-item-large-notext",
				// __("Large with text", "vlogger")	=>"phpincludes/part-archive-item-large",
				__("Simplified", "vlogger")			=>"phpincludes/part-archive-item-video",
			),
		   "description" => esc_html__( "Choose the post template for the items", "vlogger" )
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

