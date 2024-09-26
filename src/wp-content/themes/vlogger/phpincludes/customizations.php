<?php
/*
Package: vlogger
*/




if(!function_exists('vlogger_hex2rgba')){
function vlogger_hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
		  return $default; 
 
	//Sanitize $color if "#" is provided 
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}
 
		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}
 
		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);
 
		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}
 
		//Return rgb(a) color string
		return $output;
}}


function vlogger_clean_output($content){
	return $content;
}

add_action('wp_head','vlogger_css_customizations',1000);
if(!function_exists('vlogger_css_customizations')){
function vlogger_css_customizations(){
	ob_start();
	/**
	 * Colors from customizer
	 * ==========================
	 */
	


	$qt_primary_color= get_theme_mod( 'vlogger_primary_color', "#0e1d29");
	$qt_primary_color_light= get_theme_mod( 'vlogger_primary_color_light', "#192935");
	$qt_primary_color_dark= get_theme_mod( 'vlogger_primary_color_dark', "#091219");
	$qt_color_accent= get_theme_mod( 'vlogger_color_accent', "#01dfba");
	$qt_color_accent_hover= get_theme_mod( 'vlogger_color_accent_hover', "#01b799");
	$qt_color_secondary= get_theme_mod( 'vlogger_color_secondary', "#EF4763");
	$qt_color_secondary_hover= get_theme_mod( 'vlogger_color_secondary_hover', "#ef5f77");
	$qt_color_background= get_theme_mod( 'vlogger_color_background', "#fafefd");
	$qt_color_paper= get_theme_mod( 'vlogger_color_paper', "#ffffff");
	$qt_textcolor_original = get_theme_mod( 'vlogger_textcolor_original', "#000");


	$vlogger_ads_under_header_background = get_theme_mod( 'vlogger_ads_under_header_background', "#000");
	$vlogger_ads_before_footer_background = get_theme_mod( 'vlogger_ads_before_footer_background', "#000");


	/**
	 * Derivated colors (calculated from the originals by alpha change following material design principles)
	 * ==========================
	 */
	$qt_text_color= vlogger_hex2rgba($qt_textcolor_original, 0.87);
	$qt_text_color_secondary= vlogger_hex2rgba($qt_textcolor_original, 0.65);
	$qt_titles_color= vlogger_hex2rgba($qt_textcolor_original, 0.75);
	$qt_text_color_aside= vlogger_hex2rgba($qt_textcolor_original, 0.65);
	$qt_text_color_divider_and_hints= vlogger_hex2rgba($qt_textcolor_original, 0.38);
	$qt_backgorund_lightcolor= vlogger_hex2rgba($qt_textcolor_original, 0.1);
	$qt_text_color_negative= $qt_color_paper;
	$qt_text_color_negative_light= vlogger_hex2rgba($qt_color_paper, 0.65);
	$qt_textcolor_on_buttons = '#fff';
?>

<!-- SETTINGS DEBUG INFO   ================================
qt_primary_color: <?php echo esc_attr($qt_primary_color); ?>
qt_primary_color_light: <?php echo esc_attr($qt_primary_color_light); ?>
qt_primary_color_dark: <?php echo  esc_attr($qt_primary_color_dark); ?>
qt_color_accent: <?php echo esc_attr($qt_color_accent); ?>
qt_color_accent_hover: <?php echo esc_attr($qt_color_accent_hover); ?>
qt_color_secondary: <?php echo esc_attr($qt_color_secondary); ?>
qt_color_secondary_hover: <?php echo esc_attr($qt_color_secondary_hover); ?>
qt_color_background: <?php echo esc_attr($qt_color_background); ?>
qt_color_paper: <?php echo esc_attr($qt_color_paper); ?>
qt_textcolor_original: <?php echo esc_attr($qt_textcolor_original); ?>
===================================================== -->

<!-- QT STYLES DYNAMIC CUSTOMIZATIONS ========================= -->
<style type="text/css">
<?php  

echo "
body, html, .qt-content-main,  .qt-paper, .qt-card   {
	color: $qt_text_color; }
.qt-text-secondary{
	color: $qt_text_color_secondary; }
.qt-color-secondary {
	color: $qt_color_secondary; }
*::placeholder {
	color: $qt_text_color; }
a, ul.qt-list-featured li::before , .qt-sectiontitle-inline .qt-inlinelink { 
	color: $qt_color_accent; }
.qt-herobox { 
	text-shadow: 0 4px 0 $qt_color_accent; }
a:hover { 
	color: $qt_color_accent_hover; }
h1, h2, h3, h4, h5, h6 {
	color: $qt_titles_color; }
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
	color: $qt_titles_color; }
.qt-content-main a, a.qt-logo-text span {
	color: $qt_color_accent; }
.qt-content-aside {
	color: $qt_text_color_aside; }
.qt-content-aside a { 
	color: $qt_color_secondary; }
.qt-text-secondary a, .qt-footerwidgets a {
	color: $qt_color_secondary; }
.qt-mobile-menu, .qt-menu-social a, .qt-menubar-top a  {
	color: $qt_text_color_negative_light; }
.qt-negative .qt-btn-ghost, .qt-text-neg  {
	color: $qt_text_color_negative; }
.qt-paper, .qt-card, .qt-card-s, input:not([type]), input[type=text], input[type=password], input[type=email], input[type=url], input[type=time], input[type=date], input[type=datetime], input[type=datetime-local], input[type=tel], input[type=number], input[type=search], textarea.materialize-textarea {
	color: $qt_text_color; }
/*.qt-negative .qt-paper, .qt-card, .qt-negative .qt-card-s, .qt-negative input:not([type]), .qt-negative input[type=text], .qt-negative input[type=password], .qt-negative input[type=email], .qt-negative input[type=url], .qt-negative input[type=time], .qt-negative input[type=date], .qt-negative input[type=datetime], .qt-negative input[type=datetime-local], .qt-negative input[type=tel], .qt-negative input[type=number], .qt-negative input[type=search], .qt-negative textarea.materialize-textarea  {
	color: $qt_text_color_negative; }*/


body, html, .qt-body{
	background-color: $qt_color_background; }
.qt-content-desk {
	background-color:$qt_color_background !important; }
.qt-paper, .qt-card, .qt-card-s {
	background-color: $qt_color_paper; }
.qt-desktopmenu li li a {
	background-color: $qt_primary_color_light; }
.qt-content-primary, .qt-menubar-top  {
	background-color: $qt_primary_color !important; }
.qt-content-primary-dark, .qt-mobile-menu, .qt-mobile-menu .sub-menu, .qt-side-nav li li a {
	background-color: $qt_primary_color_dark !important; }
.qt-content-primary-light{
	background-color: $qt_primary_color_light;}
ul.qt-side-nav li.current-menu-item>a {
	background-color: $qt_primary_color_light !important;}
.qt-accent, .qt-btn-primary, .btn-primary, nav.qt-menubar ul.qt-desktopmenu li li a:hover, .qt-sharepage a:hover,.qt-btn-primary, .qt-menubar ul.qt-desktopmenu > li > a::after, .qt-btn-ghost:hover,  .qt-tags.qt-tags-accent li a, .qt-menubar ul.qt-desktopmenu > li > a:not(.qt-btn-ghost):not(.qt-logo-text)::after, .pagination li.active, .qt-herolist h3.qt-herolist-title::before, .qt-heroindex-indicator, .slider .indicators .indicator-item.active, .qt-sectiontitle-inline .qt-inlinelink::before,.qt-chapters li a::before, .qt-caption-small::after, #qtmenucontainers ::-webkit-scrollbar-thumb, #qtmenucontainers ::-webkit-scrollbar-thumb:hover, .tabs .indicator  {
	background-color: $qt_color_accent;}
a.qt-link-layer, .qt-menubar ul.qt-desktopmenu > li > a:hover:not(.qt-btn-ghost)::after, .qt-menubar ul.qt-desktopmenu > li > li > a:hover:not(.qt-btn-ghost) {
	background-color: $qt_color_accent_hover; }
.qt-secondary, .qt-btn-secondary, .btn-secondary, .slick-slider .slick-dots li.slick-active button, .qt-tags li a,.qt-widget .qt-widget-title::after {
	background-color: $qt_color_secondary; }
.qt-btn-primary, input[type='submit'] {
	background: -moz-linear-gradient(left,  $qt_color_accent_hover 0%, $qt_color_accent_hover 50%, $qt_color_accent 50%, $qt_color_accent 100%); 
	background: -webkit-linear-gradient(left,  $qt_color_accent_hover 0%,$qt_color_accent_hover 50%, $qt_color_accent 50%,$qt_color_accent 100%);
	background: linear-gradient(to right,  $qt_color_accent_hover 0%,$qt_color_accent_hover 50%, $qt_color_accent 50%, $qt_color_accent 100%); 
	background-repeat: no-repeat;
	background-size: 200% 100%;
    background-position-x: 98%;}
.qt-btn-secondary {
	background: -moz-linear-gradient(left,  $qt_color_secondary_hover 0%, $qt_color_secondary_hover 50%, $qt_color_secondary 50%, $qt_color_secondary 100%);
	background: -webkit-linear-gradient(left,  $qt_color_secondary_hover 0%,$qt_color_secondary_hover 50%, $qt_color_secondary 50%,$qt_color_secondary 100%);
	background: linear-gradient(to right,  $qt_color_secondary_hover 0%,$qt_color_secondary_hover 50%, $qt_color_secondary 50%, $qt_color_secondary 100%);
	background-repeat: no-repeat;
	background-size: 200% 100%;
    background-position-x: 98%;}


.qt-inline-textdeco::after {
	border-color:$qt_text_color;}
.qt-negative .qt-inline-textdeco::after,.qt-menubar ul.qt-desktopmenu > li::after, .qt-menubar ul.qt-desktopmenu > li > a::after,.qt-menubar ul.qt-desktopmenu > li > a::before ,.qt-menubar ul.qt-desktopmenu > li.current_page_item:hover::after, .qt-menubar ul.qt-desktopmenu > li.current_page_item:hover > a::after,.qt-menubar ul.qt-desktopmenu > li.current_page_item:hover > a::before,.qt-negative .qt-btn-ghost{
	border-color: $qt_text_color_negative;}
.qt-decor-side::after {
	background-color: $qt_text_color !important; /* $qt_color_accent !important; */}
dl dd, dl dt {
	border-color: $qt_color_accent;
}


input:not([type]):focus:not([readonly]), input[type=text]:focus:not([readonly]), input[type=password]:focus:not([readonly]), input[type=email]:focus:not([readonly]), input[type=url]:focus:not([readonly]), input[type=time]:focus:not([readonly]), input[type=date]:focus:not([readonly]), input[type=datetime]:focus:not([readonly]), input[type=datetime-local]:focus:not([readonly]), input[type=tel]:focus:not([readonly]), input[type=number]:focus:not([readonly]), input[type=search]:focus:not([readonly]), textarea.materialize-textarea:focus:not([readonly])

 {
	border-bottom: $qt_color_accent;box-shadow: 0 1px 0 0 $qt_color_accent;}

.qt-widget .qt-widget-title {
	border-color: $qt_color_secondary;}


.vlogger_ads_before_footer { background-color: $vlogger_ads_before_footer_background; }
.vlogger_ads_under_header{ background-color: $vlogger_ads_under_header_background; }

@media only screen and (min-width: 1201px) {
	.qt-tags li a:hover, .qt-menubar-top a:hover, .qt-btn-secondary:hover, .btn-secondary:hover, .qt-btn-secondary:hover  {
		background-color: $qt_color_secondary_hover;}
	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .qt-menubar a:hover, .qt-tags.qt-tags-accent li a:hover, .qt-menu-social a:hover, .qt-part-archive-item .qt-item-header .qt-header-mid .qt-title a:hover,.qt-negative h1 a:hover, .qt-negative h2 a:hover, .qt-negative h3 a:hover, .qt-negative h4 a:hover, .qt-negative h5 a:hover, .qt-negative h6 a:hover, .qt-part-archive-item .qt-headercontainer a:hover {
		color: $qt_color_accent_hover;}
	.qt-btn-primary:hover, .btn-primary:hover, .qt-tags.qt-tags-accent li a:hover, .pagination li a:hover {
		background-color: $qt_color_accent_hover;}
	.qt-text-secondary a:hover, .qt-footerwidgets a:hover, .qt-content-aside a:not(.qt-btn):hover, .qt-content-aside h1 a:hover,.qt-content-aside h2 a:hover,.qt-content-aside h3 a:hover,.qt-content-aside h4 a:hover,.qt-content-aside h5 a:hover,.qt-content-aside h6 a:hover {
		color: $qt_color_secondary_hover;}
}";




		/**
		 * ===================================================================================================================
		 * WooCommerce customizations
		 * ===================================================================================================================
		 */
		if ( class_exists( 'WooCommerce' ) ) {
			echo '
			.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.products li.product .price {color: '.$qt_color_secondary.' !important; }
			.qt-body.woocommerce li.product{ background-color: '.$qt_color_paper.' !important; }
			.qt-body.woocommerce div.product .woocommerce-tabs ul.tabs li.active, .qt-accent, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { background-color: '.$qt_color_accent.' !important; color: '.$qt_textcolor_on_buttons.';  }
			.woocommerce span.onsale, .woocommerce #respond input#submit.alt .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color: '.$qt_color_secondary.' !important }
			.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-tabs ul.tabs li:hover { background-color:'.$qt_color_accent_hover.' !important; color: '.$qt_textcolor_on_buttons.';  }

		    ';
		}
		/**
		 * ===================================================================================================================
		 * WooCommerce end
		 * ===================================================================================================================
		 */

?>

</style>

<?php  
$output = ob_get_clean();
$output = str_replace("\n", " ", $output);
$output = str_replace("  ", " ", $output);
$output .= "\n<!-- QT STYLES DYNAMIC CUSTOMIZATIONS END ========= -->\n";
echo vlogger_clean_output($output) ;
}}






