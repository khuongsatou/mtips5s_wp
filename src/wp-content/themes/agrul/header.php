<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google-site-verification" content="1YDM_lF3ZKx7tM5U9Q_X-Ui6nt13RUuFNn3_ztNTcnU" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2840266145686616"
     crossorigin="anonymous"></script>
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>

<?php
    wp_body_open();

    /**
    *
    * Preloader
    *
    * Hook agrul_preloader_wrap
    *
    * @Hooked agrul_preloader_wrap_cb 10
    *
    */
    do_action( 'agrul_preloader_wrap' );

    /**
    *
    * agrul header
    *
    * Hook agrul_header
    *
    * @Hooked agrul_header_cb 10
    *
    */
    do_action( 'agrul_header' );