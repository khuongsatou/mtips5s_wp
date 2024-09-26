<?php
/*
Package: Vlogger
*/

if(!function_exists('vlogger_post_hero_sc')) {
	function vlogger_post_hero_sc($atts){
		extract( shortcode_atts( array(
			'id' => false,
			'posttype' => 'post',
			'category' => false,
			'offset' => 0,
			'height' => 'default',
			'orderby' => false,
			'template' => 'phpincludes/part-archive-item-compact',
			'order' => false,
			'quantity' => 1
		), $atts ) );
		
		if(!is_numeric($quantity)) {
			$quantity = 1;
		}
		if(!is_numeric($offset)) {
			$offset = 0;
		}
		ob_start();
		/**
		 *  Query for my content
		 */
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $quantity,
			'post_status' => 'publish',
			'paged' => 1,
			'suppress_filters' => false,
			'ignore_sticky_posts' => 1,
			'offset' => esc_attr($offset),
			'meta_key' => '_thumbnail_id'
		);

		if($orderby){
			if($orderby == 'rand' || $orderby == 'ID' || $orderby == 'author' || $orderby == 'title' || $orderby == 'date' || $orderby == 'comment_count' || $orderby == 'menu_order' ) {
				$args[ 'orderby'] = esc_attr($orderby);
			}
		}
		if($order){
			if($order == 'ASC' || $order == 'DESC'){
				$args[ 'order'] = esc_attr($order);
			} 
		}

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
		 * Loop start
		 */
		if ( $wp_query->have_posts() ) :
			?><div class="qt-short-post-grid <?php echo esc_attr($height); ?>"><?php  
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post = $wp_query->post;
					setup_postdata( $post );
					get_template_part ( 'phpincludes/part-archive-item-heropost'); 
				endwhile; 
			?></div><?php  
		endif;
		wp_reset_postdata();
		/**
		 * Loop end;
		 */
		return ob_get_clean();
	}
}

if(function_exists('ttg_custom_shortcode')) {
	ttg_custom_shortcode("vlogger-post-hero","vlogger_post_hero_sc");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_post_hero' );
if(!function_exists('vlogger_vc_post_hero')){
function vlogger_vc_post_hero() {
  vc_map( array(
	 "name" => esc_html__( "Post hero", "vlogger" ),
	 "base" => "vlogger-post-hero",
	"icon" => get_template_directory_uri(). '/img/post-grid.png',
	 "description" => esc_html__( "Hero post", "vlogger" ),
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
		   "heading" => esc_html__( "Height", "vlogger" ),
		   "param_name" => "height",
		   'value' => array(
				__("Default", "vlogger") => "default",
				__("Narrow", "vlogger")	 =>"narrow",
			)
		),
		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Quantity", "vlogger" ),
		   "param_name" => "quantity",
		   "std" => "1",
		   'value' => array("1","2","3","4","5","6"),
		   "description" => esc_html__( "Number of posts to display", "vlogger" )
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Filter by category (slug)", "vlogger" ),
		   "description" => esc_html__("Insert the slug of a category to filter the results","vlogger"),
		   "param_name" => "category"
		),
		array(
		   "type" => "textfield",
		   "heading" => esc_html__( "Offset (number)", "vlogger" ),
		   "description" => esc_html__("Number of posts to skip in the database query","vlogger"),
		   "param_name" => "offset"
		),

	 )
  ) );
}}