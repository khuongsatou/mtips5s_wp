;(function($) {
    'use strict';
    $(window).on( 'elementor/frontend/init', function() {

        // Features
        elementorFrontend.hooks.addAction('frontend/element_ready/agrul_service.default',function($scope) {
            const ServicesStyleOne = new Swiper(".services-style-one-carousel", {
                // Optional parameters
                loop: true,
                slidesPerView: 1,
                spaceBetween: 30,
                autoplay: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                // Navigation arrows
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                    1199: {
                        slidesPerView: 4,
                    }
                },
            });
        });


        // Gallery
        elementorFrontend.hooks.addAction('frontend/element_ready/agrul_gallery.default',function($scope) {
               /* ==================================================
                # Project Carousel
            ===============================================*/
            const swiperStageRight = new Swiper(".carousel-stage-right", {
                // Optional parameters
                loop: true,
                freeMode: true,
                grabCursor: true,
                slidesPerView: 1,
                spaceBetween: 15,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                // Navigation arrows
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                    },
                    1300: {
                        slidesPerView: 2.5,
                    },
                },
            });
        });

         // Features
        elementorFrontend.hooks.addAction('frontend/element_ready/agrul_progressbar.default',function($scope) {
            var ProgressBar = (function () {
                "use strict";
                var t = function () {
                    jQuery(document).ready(function () {
                        jQuery(".progress").each(function () {
                            jQuery(this).appear(function () {
                                jQuery(this).animate({ opacity: 1, left: "0px" }, 800);
                                var t = jQuery(this).find(".progress-bar").attr("data-width"),
                                    r = jQuery(this).find(".progress-bar").attr("data-height");
                                jQuery(this)
                                    .find(".progress-bar")
                                    .animate({ width: t + "%", height: r + "%" }, 100, "linear");
                            });
                        });
                    });
                };
                return {
                    init: function () {
                        t();
                    },
                };
            })();
            jQuery(document).ready(function () {
                ProgressBar.init();
            });
        });

         // Testimonial
        elementorFrontend.hooks.addAction('frontend/element_ready/agrul_testimoanial_carousel.default',function($scope) {
            const testimonialCarousel = new Swiper(".testimonial-carousel", {
                // Optional parameters
                direction: "horizontal",
                loop: true,
                autoplay: true,

                // And if we need scrollbar
                /*scrollbar: {
                el: '.swiper-scrollbar',
              },*/
            });
        });

    });
}(jQuery));