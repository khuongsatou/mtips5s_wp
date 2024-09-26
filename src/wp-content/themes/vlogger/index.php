<?php
/*
Package: Vlogger
*/


/**
 * [$paged current paged number]
 * @var [int]
 */
$paged = vlogger_get_paged();


?>
<?php 
get_header(); 

?>

	<?php  
	get_template_part( 'phpincludes/menu'); 
	?>

	<!-- ======================= MAIN SECTION  ======================= -->
	<div id="maincontent" class="qt-main qt-paper">
	
		<!-- ======================= HEADER SECTION ======================= -->
		<?php 
		get_template_part( 'phpincludes/part-header'); 
		?>
		<!-- ======================= HEADER SECTION END ======================= -->

		<?php  
        /**
         * ADS slot output
         */
        vlogger_ads_display('vlogger_ads_under_header');
        ?>
        
		<!-- ======================= CONTENT SECTION ======================= -->
		<div id="qtcontents" class="qt-container qt-vertical-padding-l">
			<div class="row">
				<div class="col s12 m12 l8">
					
					<?php 

					//include 'phpincludes/'); 
					?>
					<?php 
					/**
					 * [$args Query arguments]
					 * @var array
					 */
					$args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'suppress_filters' => false,
						'paged' => $paged
					);
					/**
					 * [$wp_query execution of the query]
					 * @var WP_Query
					 */
					$wp_query = new WP_Query( $args );
					if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
						$post = $wp_query->post;
						setup_postdata( $post );
						if(is_sticky()){
							get_template_part (  'phpincludes/part-archive-item-large-sticky' );
						} else {
							get_template_part (  'phpincludes/part-archive-item-large' );
						}
						?>
						<?php
					endwhile; else: ?>
						<h3><?php esc_html_e("Sorry, nothing here","vlogger")?></h3>
					<?php 
					endif;
					wp_reset_postdata();
					?>
					<hr class="qt-spacer-s qt-clearfix">
				
				</div>
				<div class="col s12 m12 l1">
					 <hr class="qt-spacer-m">
				</div>
				<div class="qt-sidebar col s12 m12 l3">
					<?php 
					get_template_part( 'phpincludes/sidebar'); 
					?>
				</div>
			</div>
			
		</div>
		<!-- ======================= CONTENT SECTION END ======================= -->
	</div>
	<?php 
	get_template_part( 'phpincludes/part-pagination'); 
	?> 
	<!-- ======================= MAIN SECTION END ======================= -->
	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>