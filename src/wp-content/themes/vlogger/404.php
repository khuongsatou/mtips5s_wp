<?php
/*
Package: Vlogger
*/


/**
 * [$paged current paged number]
 * @var [int]
 */
$paged = vlogger_get_paged();

get_header(); 
?>
	<?php  
	get_template_part( 'phpincludes/menu'); 
	?>
	<!-- ======================= MAIN SECTION  ======================= -->
	<div id="maincontent" class="qt-main qt-paper">



		<div class="qt-404-container qt-negative qt-content-primary">
			<div class="qt-vc">
				<div class="qt-vi">
					<div class="qt-container">
						<h1 class="qt-caption qt-spacer-s qt-center">
							<span class="qt-errorcode">404</span>
							<?php esc_html_e("PAGE NOT FOUND", "vlogger"); ?>
						</h1>
						<h4 class="qt-subtitle">
							<?php esc_html_e("Search for something else:", "vlogger"); ?>
						</h4>
						<?php get_template_part('searchform' ); ?>
						<p class="qt-center qt-spacer-s"><a class="qt-btn qt-btn-primary qt-btn-l" href="<?php echo get_home_url("/"); ?>"><?php esc_html_e("Home", "vlogger"); ?></a></p>
					</div>
				</div>
			</div>
		</div>


	</div>

	<!-- ======================= MAIN SECTION END ======================= -->
	<?php 
	get_template_part ('phpincludes/footerwidgets'); ?>
<?php get_footer(); ?>