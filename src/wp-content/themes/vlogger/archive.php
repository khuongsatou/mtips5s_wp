<?php
/*
Package: Vlogger
Template Name: Blog Sidebar
*/


/**
 * [$paged current paged number]
 * @var [int]
 */
$paged = vlogger_get_paged();

/**
 * [$template parameter of the template for a category]
 * @var string
 */
$template = '';
$column_classes = 's12 m12 l8';
if(is_category( )){
	$category = get_the_category();
	if(!empty( $category)){
		$catid =  $category[0]->cat_ID;
		$template =  get_term_meta($catid, 'qt_cat_template', true);
		if($template == "grid"){
			$column_classes = 's12 m12 l12';
		}
	}
}

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

        if(is_category()){
        	$desc = category_description();
        	if($desc){
        		?>
        		<div class="qt-container qt-spacer-l">
        			<?php echo category_description(); ?>
        		</div>
        		<?php
        	}
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
	                <hr class="qt-spacer-s">
	            <?php
	        } 
	        ?>
			<div class="row">
				<div class="col <?php echo esc_attr($column_classes ); ?>">
					<?php  
					/**
					 * ADS slot output
					 */
					vlogger_ads_display('vlogger_ads_before_archive');
					?>
					<div class="row">
						<?php 
						if(is_page()){
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
								?>
								<div class="col s12">
									<?php  
									if(is_sticky()){
										get_template_part (  'phpincludes/part-archive-item-large-sticky' );
									} else {
									   	get_template_part (  'phpincludes/part-archive-item-large' );
									}
									?> 
								</div>
								<?php  
							endwhile; else: ?>
								<h3><?php esc_html_e("Sorry, nothing here","vlogger")?></h3>
							<?php endif;
							wp_reset_postdata();
						} else {
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								setup_postdata( $post );
									if($template !== 'grid'){
										?>
										<div class="col s12">
											<?php  
												get_template_part (  'phpincludes/part-archive-item-large' );
											?>
										</div><?php  
									} else {
										?>
										<div class="col s12 m4 qt-spacer-s">
											<?php 
											if(is_sticky()){
												get_template_part (  'phpincludes/part-archive-item-large-sticky' );
											} else {
											   get_template_part (  'phpincludes/part-archive-item-compact' );
											}
											 ?>
										</div>
										<?php
									}
							endwhile; else: ?>
								<h3><?php esc_html_e("Sorry, nothing here","vlogger")?></h3>
							<?php endif;
						}
						?>


					</div>
					<?php  
					/**
					 * ADS slot output
					 */
					vlogger_ads_display('vlogger_ads_after_archive');
					?>
					
				</div>
				<?php  if($template !== "grid"){ ?>
				<div class="col s12 m12 l1">
					<hr class="qt-spacer-m">
				</div>
				<div class="qt-sidebar col s12 m12 l3">
					<?php 
					get_template_part( 'phpincludes/sidebar'); 
					?>
				</div>
				<?php } ?>
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