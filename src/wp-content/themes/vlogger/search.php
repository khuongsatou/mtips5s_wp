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

		<!-- ======================= CONTENT SECTION ======================= -->
		<div id="qtcontents" class="qt-container qt-vertical-padding-l">
			<h1><?php get_template_part('phpincludes/part-archivetitle' ); ?></h1>
			<hr class="qt-spacer-m">
			<div class="row">
				<div class="col s12 m12 l8">
					
					<?php get_template_part('searchform' ); ?>

					<?php 
					add_filter( "excerpt_length", "vlogger_excerpt_length", 999 );

					 if ( have_posts() ) : while ( have_posts() ) : the_post();
						setup_postdata( $post );
						?>
						<div class="qt-result-entry qt-clearfix qt-paper  qt-spacer-s qt-vertical-padding-s">
							
							<div class="qt-texts">
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p><?php echo strip_shortcodes( get_the_excerpt() ); ?></p>
								<p class="qt-spacer-s"><a href="<?php the_permalink(); ?>" class="qt-btn qt-btn qt-btn-primary waves-effect"><?php esc_html_e("Read more", "vlogger"); ?></a></p>
							</div>
							<?php 
							if(has_post_thumbnail()){ 
								?>
								<a href="<?php the_permalink(); ?>" class="qt-thumbnail hide-on-med-and-down	">
								<?php
								the_post_thumbnail(  "thumbnail");
								?></a><?php  
							} 
							?>
						</div>

						<?php
						
					endwhile; endif;
					remove_filter( "excerpt_length", "vlogger_excerpt_length", 999 );

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