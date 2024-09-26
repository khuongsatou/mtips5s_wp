<?php
/*
Package: Vlogger
*/
?>

<!--  FOOTER CONTENTS  ================================================================ -->
<div class="qt-ads-slot-footer qt-paper">
	<?php  
	/**
	 * ADS slot output
	 */
	vlogger_ads_display('vlogger_ads_before_footer');
	?>
</div>
<div id="qtFooterfxcontainer">
	<?php if(get_theme_mod('vlogger_footer_widgets', '0' ) == '1' && is_active_sidebar( 'vlogger-footersidebar' )){ ?>
	<div id="qtFooterwidgets" class="qt-footer qt-negative qt-content-aside qt-relative" >
		<div class="qt-footer-widgets qt-vertical-padding-l qt-content-primary-light" >
			<div class="qt-container">
				<div id="vlogger-maronsy-widgets" class="qt-widgets qt-widgets-footer row qt-masonry">
			        <?php dynamic_sidebar( 'vlogger-footersidebar' ); ?>
				</div>
			</div>
			<div class="qt-header-bg" data-bgimage="<?php echo esc_url(get_theme_mod( 'vlogger_footer_backgroundimage' )); ?>" data-parallax="0" data-bgattachment="local">
			</div>
		</div>
	</div>
	<?php } ?>
	<div id="qtFooterCopy" class="qt-extrafooter qt-footerbar qt-content-primary-dark qt-negative qt-content-aside qt-caps qt-small">
		<div class="qt-container">
			<ul class="qt-extrafooter-menu">
				<li>
					<?php echo wp_kses_post(get_theme_mod('vlogger_footer_text')); ?>
				</li>
				<?php
				/**
				* 
				*
				*  Footer menu
				* 
				*/
				if ( has_nav_menu( 'vlogger_menu_footer' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'vlogger_menu_footer',
						'depth' => 1,
						'container' => false,
						'items_wrap' => '%3$s'
					) );
				}
				?>
			</ul>
		</div>
		<a href="#qtMasterContainter" class="qt-scrollupbtn qt-btn qt-btn-xl qt-btn-secondary right qt-smoothscroll "><i class="dripicons-chevron-up"></i></a>
	</div>
</div>


<?php if(get_theme_mod('vlogger_ads_flyout_content' ) && get_theme_mod('vlogger_ads_flyout_content' ) != ''): ?>
<div id="qtFlyOutAd" class="qt-ads-slot-flyout hide-on-med-and-down " data-top="@class:qt-ads-slot-flyout show hide-on-med-and-down active" data-100="@class:qt-ads-slot-flyout hide-on-med-and-down" data-100-end="@class:qt-ads-slot-flyout hide-on-med-and-down">
	<?php  
	/**
	 * ADS slot output
	 */
	vlogger_ads_display('vlogger_ads_flyout');
	?>
	<a href="#!" class="qt-close" data-removeitem="#qtFlyOutAd" ><i class="dripicons-cross"></i></a>
</div>
<?php endif; ?>
<!--  FOOTER CONTENTS END ================================================================ -->
