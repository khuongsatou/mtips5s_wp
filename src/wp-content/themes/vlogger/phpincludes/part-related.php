<?php
/*
Package: Vlogger
*/

$related_posttype = get_post_type( get_the_id());
$related_taxonomy = esc_attr( vlogger_get_type_taxonomy( $related_posttype ) );
$link = get_post_type_archive_link($related_posttype);

$related_post_per_page = 9;

/**
 *
 *  Basic query preparation
 *  
 */
$argsList = array(
	'posts_per_page' => $related_post_per_page ,
	'paged' => 1,
	'ignore_sticky_posts' => true,
	'post_type' => $related_posttype,
	'orderby' => array(  'menu_order' => 'ASC' ,    'post_date' => 'DESC'),
	'post_status' => 'publish',
	'post__not_in'=>array(get_the_id()),
	'ignore_sticky_posts' => 1
);  

$argsList[ 'meta_query'] = array(
    array(
     'key' => '_thumbnail_id',
     'compare' => 'EXISTS'
    )
);

$secondaryQuery = $argsList; // used if we have too few results


/**
 *
 *  Check if we have a taxonomy result and add to query
 *  
 */

if('category' == $related_taxonomy){
	$terms = get_the_category( get_the_id() );
} else {
	$terms = get_the_terms( get_the_id()  , $related_taxonomy);
}


$term_ids = false;
if( !is_wp_error( $terms ) ) {
	if(is_array($terms)) {
		
		$term_ids = wp_list_pluck($terms,'term_id');
		if ($term_ids) {
			// calculate the url for first taxonomy
			$termid = (int)$terms[0]->term_id;
			$temp_link = get_term_link($termid, $related_taxonomy);
			if(!is_wp_error( $temp_link )){
				$link = $temp_link;
			}
			// add tax to query
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

/**
 * 
 * Execute query
 * 
 */
$the_query = new WP_Query($argsList);

$total_results = $the_query->found_posts;
$found_array = array( get_the_id() );

$count = $total_results;

/**
 * Secondary query to warranty a minimum amount of contents
 */

$have_alternative = false;
if($total_results < $related_post_per_page){
	$secondaryQuery['post__not_in'] =  array_merge($found_array, array(get_the_id()));
	$secondaryQuery['posts_per_page'] = $related_post_per_page - $total_results;
	$secondaryQuery['ignore_sticky_posts'] = 1;
	$secondaryQuery[ 'meta_query'] = array(
        array(
         'key' => '_thumbnail_id',
         'compare' => 'EXISTS'
        )
    );
	

	$the_query_secondary = new WP_Query($secondaryQuery);
	if($the_query_secondary->have_posts()){
		$have_alternative = true;	
		$count =  $count + $the_query_secondary->found_posts;
	}
	
	
}



if ( $the_query->have_posts() || $have_alternative ) :
	$count =  $the_query->post_count;
	switch ($related_posttype){
		case "vlogger_serie": 
			$template = 'phpincludes/part-archive-item-card-simple';
			break;
		default:
			$template = 'phpincludes/part-archive-item-medium';
	}
	?>
	<div class="qt-content-primary qt-negative qt-related-section qt-vertical-padding-l">
		<div class="qt-container">
			<div class="qt-sectiontitle-inline">
				<h3 class="qt-inlinetitle">
					<?php 
					/**
					 * Get the correct label for this post type
					 * @var [ob]
					 */
					$post_type = get_post_type_object($related_posttype);
					esc_html_e( 'Related', 'vlogger' ). ' '.esc_attr(strtolower($post_type->labels->name)); ?> <a class="qt-inlinelink" href="<?php echo esc_url($link); ?>"><span><?php esc_html_e( 'View More', 'vlogger' ); ?></span></a>
				</h3>
				<hr class="qt-clearfix  qt-spacer-s hide-on-med-and-up">
				<?php if($count >3){ ?>
				<span class="qt-carouselcontrols">
					<a class="qt-roundicon-circle" data-slickprev="#relatedslider">
						<i class="dripicons-chevron-left"></i>
					</a>
					<a class="qt-roundicon-circle" data-slicknext="#relatedslider">
						<i class="dripicons-chevron-right"></i>
					</a>
				</span>
				<?php } ?>
			</div>
			<hr class="qt-spacer-m">
			<div id="relatedslider">
				<!-- POSTS CAROUSEL ================================================== -->				
				<div class="row">
					<div class="qt-slickslider-container qt-slickslider-externalarrows">
						<div class="qt-slickslider qt-invisible qt-animated qt-slickslider-multiple" data-slidestoshow="3" data-variablewidth="false" data-arrows="false" data-dots="false" data-infinite="true" data-centermode="false" data-pauseonhover="true" data-autoplay="false" data-arrowsmobile="false"  data-centermodemobile="false" data-dotsmobile="false"  data-slidestoshowmobile="1" data-variablewidthmobile="true"  data-infinitemobile="false">	
							<?php 
							if ( $the_query->have_posts() ) :
								while ( $the_query->have_posts() ) : $the_query->the_post(); 
									$found_array[] = $the_query->post->ID;
									?>
									<!-- SLIDESHOW ITEM -->
									<div class="qt-item col s12 m4">
										<?php get_template_part($template); ?>
									</div>
									<!-- SLIDESHOW ITEM END -->
									<?php 

								endwhile; 
							endif;

							/**
							 * Secondary results
							 */
							if(isset($the_query_secondary)){
								if ($the_query_secondary->have_posts() ) :
									while ( $the_query_secondary->have_posts() ) : $the_query_secondary->the_post(); 
									 	?>
										<!-- SLIDESHOW ITEM -->
										<div class="qt-item col s12 m4">
											<?php get_template_part($template); ?>
										</div>
										<!-- SLIDESHOW ITEM END -->
										<?php 
									endwhile;
								endif;
							}


							?>
						</div>
					</div>
				</div>
				<!--  POSTS CAROUSEL END ================================================== -->
			</div>
		</div>
	</div>
	<?php  
endif; wp_reset_query(); 