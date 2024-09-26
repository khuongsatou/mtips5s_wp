<?php
/*
Package: Vlogger
*/


if(!function_exists('vlogger_carousel_series')) {
	function vlogger_carousel_series($atts){

		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'id' => false,
			'quantity' => 6,
			'posttype' => 'vlogger_serie',
			'category' => false,
			'offset' => 0
			
		), $atts ) );


		if(!is_numeric($quantity)) {
			$quantyty = 6;
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
			'ignore_sticky_posts' => 1
		);



		/**
		 * Add category parameters to query if any is set
		 */
		if (false !== $category && 'all' !== $category) {
			$args[ 'tax_query'] = array(
            		array(
                    'taxonomy' => 'vlogger_seriescategory',
                    'field' => 'slug',
                    'terms' => array(esc_attr($category)),
                    'operator'=> 'IN' //Or 'AND' or 'NOT IN'
             	)
            );
		}


		// ========== QUERY BY ID =================
		if($id){
			$idarr = explode(",",$id);
			if(count($idarr) > 0){
				$quantity = count($idarr);
				$args = array(
					'post__in'=> $idarr,
					'ignore_sticky_posts' => 1,
					'post_type' => 'vlogger_serie',
					'posts_per_page' => -1,
					'orderby' => 'post__in'
				); 
			}
		}




		// ========== QUERY BY ID END =================
		// 
		// wp_reset_query();

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
		<div class="qt-slickslider-container qt-slickslider-cards">
			<div class="qt-slickslider qt-invisible qt-animated qt-slickslider-multiple" data-slidestoshow="4" data-slidestoscroll="1" data-variablewidth="false" data-arrows="true" data-dots="true" data-infinite="true" data-centermode="false" data-pauseonhover="true" data-autoplay="false" data-arrowsmobile="false"  data-centermodemobile="false" data-dotsmobile="false"  data-slidestoshowmobile="1" data-variablewidthmobile="true" data-infinitemobile="false" data-slidestoshowipad="3">	
			<?php  
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
				/*$post = $wp_query->post;
				setup_postdata( $post );*/
				?>
				<div class="qt-item qt-item-card">
					<?php 
					get_template_part('phpincludes/part-archive-item-card-interactive'); 
					?>
				</div>
			<?php endwhile; ?>
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
	ttg_custom_shortcode("vlogger-carousel-series","vlogger_carousel_series");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_carousel_series' );
if(!function_exists('vlogger_vc_carousel_series')){
function vlogger_vc_carousel_series() {
  vc_map( array(
     "name" => esc_html__( "Series Carousel", "vlogger" ),
     "base" => "vlogger-carousel-series",
     "icon" => get_template_directory_uri(). '/img/series-carousel.png',
     "description" => esc_html__( "Carousel of interactive series cards on 4 columns", "vlogger" ),
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
           "type" => "textfield",
           "heading" => esc_html__( "Quantity", "vlogger" ),
           "param_name" => "quantity",
           "description" => esc_html__( "Number of series to display", "vlogger" )
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

