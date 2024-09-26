<?php
/*
Package: Vlogger
*/

if(!function_exists('vlogger_post_grid')) {
	function vlogger_post_grid($atts){
		extract( shortcode_atts( array(
			'id' => false,
			'posttype' => 'post',
			'category' => false,
			'offset' => 0,
			'orderby' => false,
			'template' => 'phpincludes/part-archive-item-compact',
			'order' => false,
			'itemsperrow' => 4,
			'quantity' => 4
		), $atts ) );
		
		if(!is_numeric($quantity)) {
			$quantity = 4;
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

		$classes="s12 m6 l3";
		switch($itemsperrow) {
			case "1":
				$classes="s12 m12";
				break;
			case "2":
				$classes="s12 m6 l6";
				break;
			case "3":
				$classes="s12 m4";
				break;
			case "4":
			default:
				$classes="s12 m6 l3";
				break;
		}


		/**
		 * Loop start
		 */
		if ( $wp_query->have_posts() ) :
			?><div class="row qt-short-post-grid"><?php  
				while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post = $wp_query->post;
					setup_postdata( $post );
					?>
						<div class="col <?php echo esc_attr($classes); ?>">
							<?php get_template_part ( $template); ?>
						</div>
					<?php
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
	ttg_custom_shortcode("vlogger-post-grid","vlogger_post_grid");
}


/**
 *  Visual Composer integration
 */
add_action( 'vc_before_init', 'vlogger_vc_post_grid' );
if(!function_exists('vlogger_vc_post_grid')){
function vlogger_vc_post_grid() {
  vc_map( array(
	 "name" => esc_html__( "Post Grid", "vlogger" ),
	 "base" => "vlogger-post-grid",
	"icon" => get_template_directory_uri(). '/img/post-grid.png',
	 "description" => esc_html__( "Grid of posts", "vlogger" ),
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
		   "std" => "4",
		   'value' => array("1","2","3","4","5","6","7", "8", "9","10", "12", "16", "20"),
		   "description" => esc_html__( "Number of posts to display", "vlogger" )
		),

		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Items per row", "vlogger" ),
		   "param_name" => "itemsperrow",
		   "std" => "4",
		   'value' => array("1","2","3","4"),
		   "description" => esc_html__( "Items per row", "vlogger" )
		),

		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Post template", "vlogger" ),
		   "param_name" => "template",
		   'value' => array(
				__("Compact", "vlogger")			=>"phpincludes/part-archive-item-compact",
				__("Inline", "vlogger")			=>"phpincludes/part-archive-item-inline",
				__("Medium", "vlogger")			=>"phpincludes/part-archive-item-medium",
				__("Large no text", "vlogger")	=>"phpincludes/part-archive-item-large-notext",
				__("Large with text", "vlogger")	=>"phpincludes/part-archive-item-large",
				__("Video", "vlogger")			=>"phpincludes/part-archive-item-video",
			),
		   "description" => esc_html__( "Choose the post template for the items", "vlogger" )
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
		array(
		   "type" => "dropdown",
		   "heading" => esc_html__( "Order by", "vlogger" ),
		   "param_name" => "orderby",
		   'value' => array(__("Default", "vlogger")=>"",
							__("Publish date", "vlogger")=>"date",
							// __("Menu order", "vlogger")=>"menu_order",
							__("Random", "vlogger")=>"rand"
							),
		   "description" => esc_html__( "Change the order of the posts", "vlogger" )
		),
		
	 )
  ) );
}}