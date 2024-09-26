<?php
/*
Package: Vlogger
*/
?>
<!doctype html>
<html class="no-js"  <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">		
		<?php wp_head(); ?>
	</head>
	<body id="vloggerBody" <?php body_class(); ?>>

		
		<?php
		$header_extra_classes = array("qt-parentcontainer", vlogger_get_universal_header_transparency());
		if(get_theme_mod("vlogger_secondary_header", "0") == "1"){
			$header_extra_classes[] = "qt-menu-secondary-enabled";
			
			if(get_theme_mod("vlogger_secondary_header_hideonscroll", "0") == "1"){
				$header_extra_classes[] = "qt-menu-secondary-hideonscroll";
			}
		}
		$header_extra_classes_string = implode(" ", $header_extra_classes);	
		?>
		<div id="qtMasterContainter" class="qt-notscrolled <?php echo esc_attr($header_extra_classes_string); ?>" 
		data-0="@class:qt-notscrolled <?php echo esc_attr($header_extra_classes_string); ?>" 
		data-20="@class:qt-scrolled  <?php echo esc_attr($header_extra_classes_string); ?>">

