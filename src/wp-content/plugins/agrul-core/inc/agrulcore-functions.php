<?php
/**
 * @Packge     : Agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

/**
 * Admin Custom Login Logo
 */
function agrul_custom_login_logo() {
  $logo = ! empty( agrul_opt( 'agrul_admin_login_logo', 'url' ) ) ? agrul_opt( 'agrul_admin_login_logo', 'url' ) : '' ;
  if( isset( $logo ) && !empty( $logo ) )
      echo '<style type="text/css">body.login div#login h1 a { background-image:url('.esc_url( $logo ).'); }</style>';
}
add_action( 'login_enqueue_scripts', 'agrul_custom_login_logo' );

/**
* Admin Custom css
*/

add_action( 'admin_enqueue_scripts', 'agrul_admin_styles' );

function agrul_admin_styles() {
  // $agrul_admin_custom_css = ! empty( agrul_opt( 'agrul_theme_admin_custom_css' ) ) ? agrul_opt( 'agrul_theme_admin_custom_css' ) : '';
  if ( ! empty( $agrul_admin_custom_css ) ) {
      $agrul_admin_custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $agrul_admin_custom_css);
      echo '<style rel="stylesheet" id="agrul-admin-custom-css" >';
              echo esc_html( $agrul_admin_custom_css );
      echo '</style>';
  }
}

 // share button code
 function agrul_social_sharing_buttons( ) {

  // Get page URL
  $URL = get_permalink();
  $Sitetitle = get_bloginfo('name');

  // Get page title
  $Title = str_replace( ' ', '%20', get_the_title());


  // Construct sharing URL without using any script

  $twitterURL = 'https://twitter.com/share?text='.esc_html( $Title ).'&url='.esc_url( $URL );
  $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
  $pinteresturl = 'http://pinterest.com/pin/create/link/?url='.esc_url( $URL ).'&media='.esc_url(get_the_post_thumbnail_url()).'&description='.wp_kses_post(get_the_title());
  $linkedin = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );


  // Add sharing button at the end of page/page content
$content = '';

  $content .= '<li><a class="facebook" href="'.esc_url( $facebookURL ).'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
  $content .= '<li><a class="twitter" href="'. esc_url( $twitterURL ) .'" target="_blank"><i class="fab fa-twitter"></i></a></li>';
  $content .= '<li><a class="pinterest" href="'.esc_url( $pinteresturl ).'" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>';
  $content .= '<li><a class="linkedin" href="'.esc_url( $linkedin ).'" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>';
  return $content;
};

//add SVG to allowed file uploads
function agrul_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['svgz'] = 'image/svgz+xml';
  $mimes['exe'] = 'program/exe';
  $mimes['dwg'] = 'image/vnd.dwg';
  return $mimes;
}
add_filter('upload_mimes', 'agrul_mime_types');

function agrul_wp_check_filetype_and_ext( $data, $file, $filename, $mimes ) {
    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext         = $wp_filetype['ext'];
    $type        = $wp_filetype['type'];
    $proper_filename = $data['proper_filename'];

    return compact( 'ext', 'type', 'proper_filename' );
}
add_filter('wp_check_filetype_and_ext','agrul_wp_check_filetype_and_ext',10,4);

if( ! function_exists('agrul_get_user_role_name') ){
    function agrul_get_user_role_name( $user_ID ){
        global $wp_roles;

        $user_data      = get_userdata( $user_ID );
        $user_role_slug = $user_data->roles[0];
        return translate_user_role( $wp_roles->roles[$user_role_slug]['name'] );
    }
}
//******--- Remove Font Awesome ---*****
//===============================
add_action( 'elementor/frontend/after_register_styles',function() {
  foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
    wp_deregister_style( 'elementor-icons-fa-' . $style );
  }
}, 20 );

add_image_size( 'agrul_80X80', 80, 80, true );
add_image_size( 'agrul_372X279', 372, 279, true );
add_image_size( 'agrul_598X355', 598, 355, true );
add_image_size( 'agrul_284X355', 355, 284, true );


remove_filter( 'render_block', 'wp_render_layout_support_flag', 10, 2 );
remove_filter( 'render_block', 'gutenberg_render_layout_support_flag', 10, 2 );