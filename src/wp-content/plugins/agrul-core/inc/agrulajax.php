<?php
/**
 * @Packge     : agrul
 * @Version    : 1.0
 * @Author     : agrul
 * @Author URI : https://themeforest.net/user/validthemes/portfolio
 *
 */


// Blocking direct access
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

function agrul_core_essential_scripts( ) {
    wp_enqueue_script('agrul-ajax',AGRUL_PLUGDIRURI.'assets/js/agrul.ajax.js',array( 'jquery' ),'1.0',true);
    wp_localize_script(
    'agrul-ajax',
    'agrulajax',
        array(
            'action_url' => admin_url( 'admin-ajax.php' ),
            'nonce'	     => wp_create_nonce( 'agrul-nonce' ),
        )
    );
}

add_action('wp_enqueue_scripts','agrul_core_essential_scripts');


// agrul Section subscribe ajax callback function
add_action( 'wp_ajax_agrul_subscribe_ajax', 'agrul_subscribe_ajax' );
add_action( 'wp_ajax_nopriv_agrul_subscribe_ajax', 'agrul_subscribe_ajax' );

function agrul_subscribe_ajax( ){
  $apiKey = agrul_opt('agrul_subscribe_apikey');
  $listid = agrul_opt('agrul_subscribe_listid');
   if( ! wp_verify_nonce($_POST['security'], 'agrul-nonce') ) {
    echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('You are not allowed.', 'agrul').'</div>';
   }else{
       if( !empty( $apiKey ) && !empty( $listid )  ){
           $MailChimp = new DrewM\MailChimp\MailChimp( $apiKey );

           $result = $MailChimp->post("lists/{$listid}/members",[
               'email_address'    => esc_attr( $_POST['sectsubscribe_email'] ),
               'status'           => 'subscribed',
           ]);
           if ($MailChimp->success()) {
               if( $result['status'] == 'subscribed' ){
                   echo '<div class="alert alert-success mt-2" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'agrul').'</div>';
               }
           }elseif( $result['status'] == '400' ) {
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('This Email address is already exists.', 'agrul').'</div>';
           }else{
               echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Sorry something went wrong.', 'agrul').'</div>';
           }
        }else{
           echo '<div class="alert alert-danger mt-2" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'agrul').'</div>';
        }
   }

   wp_die();

}