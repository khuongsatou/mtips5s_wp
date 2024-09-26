<?php
/*
Package: Vlogger
*/

if(!function_exists('vlogger_short_carouesel_videos')){
function vlogger_short_carouesel_videos($atts){

	extract( shortcode_atts( array(
		'id' => false,
		'serie_id' => null,
		'classes' => null,
		'category' => false,
		'quantity' => 12,
		'offset' => 0,
		'current_video_id' => null
	), $atts ) );

	ob_start();

	$offset = (int)$offset;

	if(!is_numeric($offset)) {
		$offset = 0;
	}

	/**
	 * Query preparation
	 */
	if(null !== $serie_id && false !== $serie_id && '' !== $serie_id){
		/**
		 * Case 1: we extract the videos from a playlist
		 */
		$episodes = get_post_meta( $serie_id, 'vlogger_seriesvideos', true ); 
		$ep_id = array();
		foreach($episodes as $e){
			$ep_id[] = $e['vlogger_episodes'][0];
		}
		$argsList = array(
			'post__in'=> $ep_id,
			'posts_per_page' => (int)$quantity,
			'post__not_in' => $current_video_id,
			'offset' => $offset,

			'ignore_sticky_posts' => 1,
			 'meta_query' => array(
		        array(
		         'key' => '_thumbnail_id',
		         'compare' => 'EXISTS'
		        ),
		    )
		);  
	} else {
		/**
		 * Case 2: we extract similar videos, then other ones in order
		 */
		
		$argsList = array(
			'post_type' => 'post',
            'post_status' => 'publish',
            'suppress_filters' => false,
            'posts_per_page' => (int)$quantity,
            'paged' => 1,
            'offset' => $offset,
            //'post_format' => 'post-format-video',
			'post__not_in'=> array($current_video_id),
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
			$argsList[ 'tax_query'] = array(
					array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => array(esc_attr($category)),
					'operator'=> 'IN' //Or 'AND' or 'NOT IN'
				)
			);
		}

		$secondaryQuery = $argsList; // used if we have too few results


		/**
		 *
		 *  Check if we have a taxonomy result and add to query
		 *  
		 */
		$related_taxonomy = 'category';
		$terms = get_the_category( get_the_id() );

		$term_ids = false;
		if( !is_wp_error( $terms ) ) {
			if(is_array($terms)) {
				$term_ids = wp_list_pluck($terms,'term_id');
				if ($term_ids) {
					$argsList['tax_query'] =  array(
						array(
							'taxonomy' => $related_taxonomy,
							'field' => 'id',
							'terms' => $term_ids,
							'operator'=> 'IN'
						)
					);
				}
			}
		}
	}

	/**
	 * We want only stuff with a thumbnail otherwise it looks ugly
	 */
	$argsList[ 'meta_query'] = array(
        array(
         'key' => '_thumbnail_id',
         'compare' => 'EXISTS'
        )
    );


	// ========== QUERY BY ID =================
	if($id){
		$idarr = explode(",",$id);
		if(count($idarr) > 0){
			$quantity = count($idarr);
			$argsList = array(
				'post__in'=> $idarr,
				'orderby' => 'post__in',
				'ignore_sticky_posts' => 1
			);  
		}
	}


	// ========== QUERY BY ID END =================
	$custom_posts = new WP_Query($argsList);
	$total_results = $custom_posts->found_posts;
	$found_array = array( $current_video_id);

	if ( $custom_posts->have_posts() ) : 

		if(null !== $serie_id && false !== $serie_id && '' !== $serie_id){
			add_filter("the_permalink", $vlogger_filter_x = function( $url ) use ( $serie_id ){
				return add_query_arg("vlogger_serie_in", $serie_id, $url);
			}, 99, 2);
		}
		?>
		<!-- VIDEOS CAROUSEL ================================================== -->				
		<div class="">
			<div class="qt-slickslider-container qt-slickslider-videos">
				<div class="qt-slickslider qt-animated qt-invisible qt-slickslider-multiple" data-slidestoshow="5" data-slidestoscroll="1" data-variablewidth="false" data-arrows="true" data-dots="false" data-infinite="true" data-centermode="false" data-pauseonhover="true" data-autoplay="false" data-arrowsmobile="true"  data-centermodemobile="false" data-dotsmobile="false"  data-slidestoshowmobile="1" data-variablewidthmobile="true" data-infinitemobile="false" data-slidestoshowipad="3">		
					<?php 
					while ( $custom_posts->have_posts() ) : $custom_posts->the_post();


						$found_array[] = $custom_posts->post->ID;
						?>
						<!-- SLIDESHOW ITEM -->
						<div class="qt-item">
							<?php get_template_part ('phpincludes/part-archive-item-video' ); ?>
						</div>
						<!-- SLIDESHOW ITEM END -->
						<?php 

					endwhile; 
					if($total_results < $quantity){

						$secondaryQuery['post__not_in'] = $found_array;
						$secondaryQuery['posts_per_page'] = $quantity - $total_results;
						$secondaryQuery['ignore_sticky_posts'] = 1;
						$secondaryQuery[ 'meta_query'] = array(
					        array(
					         'key' => '_thumbnail_id',
					         'compare' => 'EXISTS'
					        )
					    );

						$the_query_other_series = new WP_Query($secondaryQuery);

						while ( $the_query_other_series->have_posts() ) : $the_query_other_series->the_post(); 
						 	?>
							<div class="qt-item">
								<?php get_template_part ('phpincludes/part-archive-item-video' ); ?>
							</div>
							<?php 
						endwhile;

					}
					?>
				</div>
			</div>
		</div>
		<!--  VIDEOS CAROUSEL END ================================================== -->
		<?php  
		if(isset($vlogger_filter_x))remove_filter("the_permalink", $vlogger_filter_x, 99);
	endif;

	wp_reset_postdata();
	return ob_get_clean();
}}



if(function_exists('ttg_custom_shortcode' ) ){
	ttg_custom_shortcode('vlogger-videocarousel', 'vlogger_short_carouesel_videos' );
}




/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_short_carouesel_videos' );
if(!function_exists('vlogger_vc_short_carouesel_videos')){
function vlogger_vc_short_carouesel_videos() {
  vc_map( array(
	 	"name" => esc_html__( "Video carousel", "vlogger" ),
	 	"base" => "vlogger-videocarousel",
		"icon" => get_template_directory_uri(). '/img/post-carousel.png',
	 	"description" => esc_html__( "Horizontal video carousel", "vlogger" ),
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
			   "heading" => esc_html__( "Filter by category (slug)", "vlogger" ),
			   "description" => esc_html__("Insert the slug of a category to filter the results","vlogger"),
			   "param_name" => "category"
			),
			array(
			   "type" => "textfield",
			   "heading" => esc_html__( "Serie ID", "vlogger" ),
			   "description" => esc_html__("Extract only videos contained in a specific serie. Integer number.","vlogger"),
			   "param_name" => "serie_id"
			),
			array(
			   "type" => "textfield",
			   "heading" => esc_html__( "Classes", "vlogger" ),
			   "description" => esc_html__("Add extra css classes","vlogger"),
			   "param_name" => "classes"
			),
			array(
			   "type" => "textfield",
			   "heading" => esc_html__( "Quantity (integer)", "vlogger" ),
			   "description" => esc_html__("Amount of items to display","vlogger"),
			   "param_name" => "quantity"
			),array(
			   "type" => "textfield",
			   "heading" => esc_html__( "Offset (number)", "vlogger" ),
			   "description" => esc_html__("Number of posts to skip in the database query","vlogger"),
			   "param_name" => "offset"
			)

	 	)
  ) );
}}

