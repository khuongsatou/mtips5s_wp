<?php
/*
Package: Vlogger
*/
$sticky = get_theme_mod('vlogger_sticky_sidebar', false );
?>
<!-- SIDEBAR ================================================== -->
<div id="qtSidebar" class="qt-widgets qt-sidebar-main qt-content-aside row qt-masonry">
	<div id="qtSidebarInner">
		<aside class="col s12 m3 l12 qt-content-aside">
			<?php  
			/**
			 * ADS slot output
			 */
			vlogger_ads_display('vlogger_ads_before_sidebar');
			?>
		</aside>
		<?php if(is_active_sidebar( 'vlogger-right-sidebar' ) ){ ?>
	        <?php dynamic_sidebar( 'vlogger-right-sidebar' ); ?>
		<?php } ?>
		<aside class="col s12 m3 l12 qt-content-aside">
			<?php  
			/**
			 * ADS slot output
			 */
			vlogger_ads_display('vlogger_ads_after_sidebar');
			?>
		</aside>
	</div>
</div>
<!-- SIDEBAR END ================================================== -->
