<?php
/*
Package: Vlogger
*/



if(!function_exists('vlogger_slideshow_3d')) {
	function vlogger_slideshow_3d($atts){
		/*
		 *	Defaults
		 * 	All parameters can be bypassed by same attribute in the shortcode
		 */
		extract( shortcode_atts( array(
			'id' => false,
			'quantity' => 4,
			'posttype' => 'post',
			'offset' => 0,
			'category' => false
			
		), $atts ) );
		if(!is_numeric($quantity)) {
			$quantity = 4;
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

	

		// ========== QUERY BY ID =================
		if($id){
			$idarr = explode(",",$id);
			if(count($idarr) > 0){
				$quantity = count($idarr);
				$args = array(
					'post__in'=> $idarr,
					'orderby' => 'post__in',
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
		<!-- SLIDESHOW POST ================================================== -->
		<div class="qt-slickslider-container qt-slideshow-3d">
			<div class="qt-slickslider qt-slickslider-single qt-slickslider-scalefx" data-variablewidth="true" data-arrows="true" data-dots="true" data-infinite="true" data-centermode="true" data-pauseonhover="true" data-autoplay="true" data-arrowsmobile="false" data-centermodemobile="true" data-dotsmobile="true" data-variablewidthmobile="true" data-centerpadding="60px">
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
					<div class="qt-slick-opacity-fx qt-slick-scale-fx qt-item ">
						<?php get_template_part('phpincludes/part-archive-item-slide'); ?>
					</div>
				<?php endwhile;  
				remove_filter( "excerpt_length", "vlogger_excerpt_length", 999 );
				?>
			</div>
		</div>
		<!-- SLIDESHOW PODCAST END ================================================== -->
		<?php else: 
			esc_html_e("Sorry, there is nothing for the moment.", "vlogger"); ?>
		<?php  
		endif; 
		wp_reset_postdata();
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("qt-slideshow3d","vlogger_slideshow_3d");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_slideshow_3d' );
if(!function_exists('vlogger_vc_slideshow_3d')){
function vlogger_vc_slideshow_3d() {
  vc_map( array(
	 "name" => esc_html__( "Slideshow 3D", "vlogger" ),
	 "base" => "qt-slideshow3d",
	 "icon" => get_template_directory_uri(). '/img/slideshow-3d.png',
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
		   'value' => array("4", "5", "6", "7", "8", "9", "10"),
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
