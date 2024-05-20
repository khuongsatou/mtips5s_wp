<?php
// Block direct access
if (!defined('ABSPATH')) {
    exit();
}
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

// enqueue css
function agrul_common_custom_css()
{
    wp_enqueue_style('agrul-color-schemes', get_template_directory_uri() . '/assets/css/color.schemes.css');

    $CustomCssOpt  = agrul_opt('agrul_css_editor');
    $preloader_display  =  agrul_opt('agrul_display_preloader');
    if ($CustomCssOpt) {
        $CustomCssOpt = $CustomCssOpt;
    } else {
        $CustomCssOpt = '';
    }

    $customcss = "";

    if (get_header_image()) {
        $agrul_header_bg =  get_header_image();
    } else {
        if (agrul_meta('page_breadcrumb_settings') == 'page' && is_page()) {
            if (!empty(agrul_meta('breadcumb_image'))) {
                $agrul_header_bg = agrul_meta('breadcumb_image');
            }
        }
    }

    if (!empty($agrul_header_bg)) {
        $customcss .= ".breadcrumb-area{
            background:url('{$agrul_header_bg}')!important;
            background-position: center center !important;
            background-size: cover !important;
        }";
    }
    if (!empty($preloader_display)) {
        $agrul_pre_img = agrul_opt('agrul_preloader_img', 'url');
        if (!empty(agrul_opt('agrul_preloader_img', 'url'))) {
            $customcss .= ".se-pre-con{
                background:url('{$agrul_pre_img}')!important;
                 background:url('{$agrul_pre_img}')!important;
                position: fixed;
                left: 0px;
                top: 0px;
                width: 100%;
                height: 100%;
                z-index: 999999;
                text-align: center;
                background-repeat: no-repeat !important;
                background-color: #ffffff !important;
                background-position: center !important;
                            }";
        }
    }

    // theme color
    $agrulthemecolor = agrul_opt('agrul_theme_color');

    list($r, $g, $b) = sscanf($agrulthemecolor, "#%02x%02x%02x");

    $agrul_real_color = $r . ',' . $g . ',' . $b;
    if (!empty($agrulthemecolor)) {
        $customcss .= ":root {
		  --color-primary: rgb({$agrul_real_color});
		}";
    }

    // theme color secendary
    $agrulthemecolor_sec = agrul_opt('agrul_theme_color_sec');

    list($r, $g, $b) = sscanf($agrulthemecolor_sec, "#%02x%02x%02x");

    $agrul_real_color_sec = $r . ',' . $g . ',' . $b;
    if (!empty($agrulthemecolor_sec)) {
        $customcss .= ":root {
          --color-secondary: rgb({$agrul_real_color_sec});
        }";
    }

    if (class_exists('ReduxFramework')) {
        // theme body font
        global $agrul_opt;

        if (!empty($agrul_opt['agrul_theme_body_typography']['font-family'])) {
            $agrulthemebodyfont = $agrul_opt['agrul_theme_body_typography']['font-family'];
        }

        if (!empty($agrulthemebodyfont)) {
            $customcss .= ":root {
              --font-default: $agrulthemebodyfont ;
            }";
        } else {
            $customcss .= ":root {
              --font-default: 'Manrope', sans-serif;
            }";
        }
    }

    if (!empty($CustomCssOpt)) {
        $customcss .= $CustomCssOpt;
    }

    wp_add_inline_style('agrul-color-schemes', $customcss);
}
add_action('wp_enqueue_scripts', 'agrul_common_custom_css', 100);
