<?php
/*
Package: Vlogger
Template Name: Blog Grid
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
		if( get_post_meta(get_the_id(), 'vlogger_hide_header', true) !== "1"){
		  get_template_part( 'phpincludes/part-header'); 
		}
		?>
		<!-- ======================= HEADER SECTION END ======================= -->
		<?php  
		/**
		 * ADS slot output
		 */
		vlogger_ads_display('vlogger_ads_under_header');
		?>


		<?php  
        if(is_page() &&  $paged == 1){
            if ( have_posts() ) : while ( have_posts() ) : the_post();
                the_content(); 
            endwhile; endif;
        } 
        ?>


        
		<!-- ======================= CONTENT SECTION ======================= -->
		<div id="qtcontents" class="qt-container qt-vertical-padding-l">
			

			<?php  
			if(is_page() && $paged > 1){
				?>
                <div class="qt-row">
                    <div class="col s12">
                        <h4><?php esc_html_e('Page','vlogger');?>: <?php esc_html_e($paged); ?></h4>
                    </div>
                </div>
                <hr class="qt-spacer-m">
	            <?php
			} 
			?>

			<?php  
			/**
			 * ADS slot output
			 */
			vlogger_ads_display('vlogger_ads_before_archive');
			?>


			<div class="row">
			<?php 
				/**
				 * [$args Query arguments]
				 * @var array
				 */
				$args = array(
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => '9',
					'suppress_filters' => false,
					'paged' => $paged,
					// 'post_format' => 'post-format-video',
				);
				/**
				 * [$wp_query execution of the query]
				 * @var WP_Query
				 */
				$wp_query = new WP_Query( $args );
				if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
					$post = $wp_query->post;
					setup_postdata( $post );
					?>
					<div class="col s12 m4 qt-spacer-s">
						<?php get_template_part (  'phpincludes/part-archive-item-medium' ); ?>
					</div>
					<?php
				endwhile; else: ?>
					<h3><?php esc_html_e("Sorry, nothing here","vlogger")?></h3>
				<?php endif;
				wp_reset_postdata();
			?>
			</div>
			<?php  
			/**
			 * ADS slot output
			 */
			vlogger_ads_display('vlogger_ads_after_archive');
			?>
			
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