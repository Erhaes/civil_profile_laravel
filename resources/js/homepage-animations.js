/**
 * Homepage Animations
 */
import Swiper from 'swiper/bundle';

document.addEventListener('DOMContentLoaded', () => {

    // 1. Swiper.js Carousel for Homepage Hero Section
    const heroSwiperEl = document.querySelector('.homepage-hero-swiper');
    if (heroSwiperEl) {
        const heroSwiper = new Swiper(heroSwiperEl, { 
            loop: true,
            slidesPerView: 1,
            
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },

            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
            on: {
                'play-video': function () {
                    this.autoplay.stop();
                },
                slideChange: function () {
                    this.autoplay.start();
                }
            }
        });

        window.addEventListener('stopHeroCarousel', () => {
            if (heroSwiper && heroSwiper.autoplay) {
                heroSwiper.autoplay.stop();
            }
        });
    }

    // 1. Swiper.js Carousel for Homepage About Section
    const aboutSwiperEl = document.querySelector('.homepage-about-swiper');
    if (aboutSwiperEl) {
        new Swiper(aboutSwiperEl, {
            loop: true,
            autoplay: {
                delay: 2000,
                disableOnInteraction: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }
});