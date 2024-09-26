<?php
/*
Package: Vlogger
*/
$vlogger_menu_layout = get_theme_mod('vlogger_menu_layout', 0 );
?>
<!-- ================================ MENU  ================================================================ -->
<div id="qtmenucontainers" class="qt-headermenu-container">
	<!-- QT MENUBAR  ================================ -->
	<nav class="qt-menubar nav-wrapper qt-content-primary">
		<!-- QT MENUBAR SECONDARY  ================================ -->
		<?php 
		/**
		 *  Secondary Menu
		 *  SInce 1.2.0
		 */
		if(get_theme_mod("vlogger_secondary_header", "0") == "1"){
		?>
		<ul class="qt-menu-secondary qt-content-primary-light hide-on-xl-and-down">
			<?php  
			/**
			 * Call to action
			 */
			$cta_text = get_theme_mod( 'vlogger_header_cta_text', false );
			$cta_link = get_theme_mod( 'vlogger_header_cta_link', false );
			$cta_anchor = get_theme_mod( 'vlogger_header_cta_anchor', false );
			if($cta_text){
			?>
			<li>
				<?php echo esc_attr($cta_text); ?> 
				<?php if($cta_link && $cta_anchor){ ?>
						<a href="<?php echo esc_url($cta_link); ?>" class="qt-btn qt-btn-s qt-btn-ghost"><?php echo esc_attr($cta_anchor); ?></a>
				<?php } ?>
			</li>
			<?php
			} 
			?>


			<?php  
			/**
			 * Youtbe follow button
			 */
			
			$yt_channel = get_theme_mod( 'vlogger_yt_channel', false );
			if($yt_channel){
			?>
			<li class="qt-ytchannel right">
				<div class="g-ytsubscribe" data-channelid="<?php echo esc_attr($yt_channel); ?>" data-layout="default" data-count="default"></div>
			</li>
			<?php
			} 
			?>


			<?php  
			/**
			 * Youtbe follow button
			 */
			
			$yt_user = get_theme_mod( 'vlogger_yt_user', false );
			if($yt_user){
			?>
			<li class="qt-ytchannel right">
				<div class="g-ytsubscribe" data-channel="<?php echo esc_attr($yt_user); ?>" data-layout="default" data-count="default"></div>
			</li>
			<?php
			} 
			?>

			<?php  
			get_template_part('phpincludes/part-social' );
			?>

			
			<?php
				/**
				 * Secondary menu
				 */
				if(has_nav_menu( 'vlogger_menu_secondary' )){
					wp_nav_menu( 
						array(
							'theme_location' => 'vlogger_menu_secondary',
							'depth' => 1,
							'container' => false,	
							'items_wrap' => '%3$s'
						)
					);
				}
			?>


		</ul>
		<?php } ?>
		<!-- QT MENUBAR SECONDARY END  ================================ -->

		<!-- desktop menu  HIDDEN IN MOBILE AND TABLETS -->
		<ul class="qt-desktopmenu hide-on-xl-and-down">
			<?php if (2 == $vlogger_menu_layout || 3 == $vlogger_menu_layout){

				?>
				<li class="qt-menubutton"><a href="#" data-activates="qt-mobile-menu" class="button-collapse qt-menu-switch qt-btn waves-effect waves-light btn qt-btn qt-btn-primary"><i class="dripicons-menu"></i></a></li>
				<?php

			} ?>
			<li id="qtLogoContainer" class="qt-logo-link qt-logo-layout-<?php echo esc_attr($vlogger_menu_layout ); ?>">
				<a href="<?php echo get_home_url("/"); ?>" class="brand-logo qt-logo-text">
					<?php
					/**  Logo or title
					 *  ============================================= */
					$logo = get_theme_mod("vlogger_logo_header","");
					if($logo != ''){
						echo '<img src="'.esc_attr($logo).'" alt="'.esc_attr__("Home","vlogger").'">';
					}else{
						echo get_bloginfo('name');
					}
					?>
				</a>
			</li>

			<li class="qt-ads-slot-menu right">
			<?php  
	        /**
	         * ADS slot output
	         */
	        vlogger_ads_display('vlogger_ads_menubar');
	        ?>
	        </li>
			<?php
			switch ($vlogger_menu_layout){
				case 1:
					?>
					<li class="qt-menubutton"><a href="#" data-activates="qt-mobile-menu" class="button-collapse qt-menu-switch qt-btn waves-effect waves-light btn"><i class="dripicons-menu"></i></a></li>
					<?php
					break;
				case 2:
				case 3:
					/**
					 *  IMPORTANT: Do nothing here, case 2 is above
					 */
					break;
				case 0:
				default:
				/**
				* 
				*
				*  Primary menu
				*  =============================================
				*/
				if ( has_nav_menu( 'vlogger_menu_primary' ) ) {
					wp_nav_menu( array(
						'theme_location' => 'vlogger_menu_primary',
						'depth' => 3,
						'container' => false,
						'items_wrap' => '%3$s'
					));
				}
			}
			?> 
			<?php do_action("qt_menu_actions"); ?>
			
		</ul>
		<!-- mobile menu icon and logo VISIBLE ONLY TABLET AND MOBILE-->
		<ul class="qt-desktopmenu qt-menubar-mobile hide-on-xl-only ">
			<li><a href="#" data-activates="qt-mobile-menu" class="button-collapse qt-menu-switch qt-btn qt-btn-primary qt-btn-m"><i class="dripicons-menu"></i></a></li>
			<li>
			<li id="qtLogoContainerSidebar" class="qt-logo-layout-<?php echo esc_attr($vlogger_menu_layout ); ?>">
			<a  href="<?php echo get_home_url("/"); ?>" class="brand-logo qt-logo-text">
				<?php
				/**  Logo or title
				 *  ============================================= */
				$logo = get_theme_mod("vlogger_logo_header","");
				if($logo != ''){
					echo '<img src="'.esc_attr($logo).'" alt="'.esc_attr__("Home","vlogger").'">';
				}else{
					echo get_bloginfo('name');
				}
				?>
			</a>
			</li>
			<?php do_action("qt_menu_mobile_actions"); ?>
		</ul>
	</nav>

	<!-- MENU MOBILE -->
	<div id="qt-mobile-menu" class="side-nav qt-content-primary">
		<ul class="qt-side-nav">
			<li class=""><a href="#" data-activates="qt-mobile-menu" class=" qt-navmenu-close qt-menu-switch qt-btn qt-btn-primary qt-btn-m"><i class="dripicons-cross"></i> CLOSE</a>
			</li>




			<li data-bgimage="<?php echo esc_url(get_theme_mod('vlogger_offcanvas_bg')); ?>" data-parallax="0" data-attachment="local" class="qt-offcanvas-header">
				<a href="<?php echo get_home_url("/"); ?>" class="brand-logo qt-logo-text qt-center" data-background="<?php echo esc_url(get_theme_mod('vlogger_offcanvas_bg')); ?>" data-parallax="0" data-attachment="local">
					<?php
					/**  Logo or title
					 *  ============================================= */
					$logo = get_theme_mod("vlogger_logo_header","");
					if($logo != ''){
						echo '<img src="'.esc_attr($logo).'" alt="'.esc_attr__("Home","vlogger").'">';
					}else{
						echo get_bloginfo('name');
					}
					?>
				</a>
			</li>



		

		
			<?php
			/**
			* 
			*
			*  Primary menu
			*  ============================================= */
			if ( has_nav_menu( 'vlogger_menu_primary' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'vlogger_menu_primary',
					'depth' => 3,
					'container' => false,
					'items_wrap' => '%3$s'
				));
			}
			?> 
		</ul>
		
	</div>

	<!-- ================================ MENU END  ================================================================ -->
</div>