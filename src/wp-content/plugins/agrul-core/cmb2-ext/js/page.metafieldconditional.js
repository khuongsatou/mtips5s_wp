(function($){
    "use strict";
    
    let $agrul_page_breadcrumb_area      = $("#_agrul_page_breadcrumb_area");
    let $agrul_page_settings             = $("#_agrul_page_breadcrumb_settings");
    let $agrul_page_breadcrumb_image     = $("#_agrul_breadcumb_image");
    let $agrul_page_title                = $("#_agrul_page_title");
    let $agrul_page_title_settings       = $("#_agrul_page_title_settings");

    if( $agrul_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--agrul-page-breadcrumb-settings").show();
        if( $agrul_page_settings.val() == 'global' ) {
            $(".cmb2-id--agrul-breadcumb-image").hide();
            $(".cmb2-id--agrul-page-title").hide();
            $(".cmb2-id--agrul-page-title-settings").hide();
            $(".cmb2-id--agrul-custom-page-title").hide();
            $(".cmb2-id--agrul-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--agrul-breadcumb-image").show();
            $(".cmb2-id--agrul-page-title").show();
            $(".cmb2-id--agrul-page-breadcrumb-trigger").show();
    
            if( $agrul_page_title.val() == '1' ) {
                $(".cmb2-id--agrul-page-title-settings").show();
                if( $agrul_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--agrul-custom-page-title").hide();
                } else {
                    $(".cmb2-id--agrul-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--agrul-page-title-settings").hide();
                $(".cmb2-id--agrul-custom-page-title").hide();
    
            }
        }
    } else {
        $agrul_page_breadcrumb_area.parents('.cmb2-id--agrul-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $agrul_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--agrul-page-breadcrumb-settings").show();
            if( $agrul_page_settings.val() == 'global' ) {
                $(".cmb2-id--agrul-breadcumb-image").hide();
                $(".cmb2-id--agrul-page-title").hide();
                $(".cmb2-id--agrul-page-title-settings").hide();
                $(".cmb2-id--agrul-custom-page-title").hide();
                $(".cmb2-id--agrul-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--agrul-breadcumb-image").show();
                $(".cmb2-id--agrul-page-title").show();
                $(".cmb2-id--agrul-page-breadcrumb-trigger").show();
        
                if( $agrul_page_title.val() == '1' ) {
                    $(".cmb2-id--agrul-page-title-settings").show();
                    if( $agrul_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--agrul-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--agrul-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--agrul-page-title-settings").hide();
                    $(".cmb2-id--agrul-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--agrul-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $agrul_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--agrul-page-title-settings").show();
            if( $agrul_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--agrul-custom-page-title").hide();
            } else {
                $(".cmb2-id--agrul-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--agrul-page-title-settings").hide();
            $(".cmb2-id--agrul-custom-page-title").hide();

        }
    });

    //page settings
    $agrul_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--agrul-breadcumb-image").hide();
            $(".cmb2-id--agrul-page-title").hide();
            $(".cmb2-id--agrul-page-title-settings").hide();
            $(".cmb2-id--agrul-custom-page-title").hide();
            $(".cmb2-id--agrul-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--agrul-breadcumb-image").show();
            $(".cmb2-id--agrul-page-title").show();
            $(".cmb2-id--agrul-page-breadcrumb-trigger").show();
    
            if( $agrul_page_title.val() == '1' ) {
                $(".cmb2-id--agrul-page-title-settings").show();
                if( $agrul_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--agrul-custom-page-title").hide();
                } else {
                    $(".cmb2-id--agrul-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--agrul-page-title-settings").hide();
                $(".cmb2-id--agrul-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $agrul_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--agrul-custom-page-title").hide();
        } else {
            $(".cmb2-id--agrul-custom-page-title").show();
        }
    });
    
})(jQuery);