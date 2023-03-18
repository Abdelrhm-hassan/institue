"use strict"

$(function (){

    AOS.init();

    const swiper = new Swiper('.swiper', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        slidesPerView: 1,
        spaceBetween: 10,

        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            // when window width is >= 640px
            640: {
                slidesPerView: 4,
                spaceBetween: 40
            }
        }
    });
    const swiperComments = new Swiper('.swiper_comments', {
        loop: true,
        direction:'horizontal',
        navigation: {
            nextEl: '.comment-button-next',
            prevEl: '.comment-button-prev',
        },
        slidesPerView: 1,
        spaceBetween: 10,
    });
    const ourCustomer = new Swiper('.our_customers', {
        loop: true,
        direction:'horizontal',
        navigation: {
            nextEl: '.customer_next',
            prevEl: '.customer_prev',
        },
        slidesPerView: 1,
        spaceBetween: 10,
        centerInsufficientSlides:true,

        breakpoints: {
            // when window width is >= 320px
            320: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            // when window width is >= 480px
            480: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            // when window width is >= 640px
            640: {
                slidesPerView: 4,
                spaceBetween: 40
            }
        }
    });

    $('.count-animate').each(function () {
        var $this = $(this);
        jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
            duration: 2000,
            easing: 'swing',
            step: function () {
                $this.text(Math.ceil(this.Counter));
            }
        });
    });
});
