/**
 * Homepage Animations
 *
 * This script initializes the Swiper.js carousel for the 'About' section
 * and handles the infinite scrolling animation for the 'Testimonial' section.
 */
import Swiper from 'swiper/bundle'; // Kita tetap butuh JS-nya

document.addEventListener('DOMContentLoaded', () => {

    // 1. Swiper.js Carousel for Homepage About Section
    const aboutSwiperEl = document.querySelector('.homepage-about-swiper');
    if (aboutSwiperEl) {
        new Swiper(aboutSwiperEl, {
            // Kita tidak perlu lagi mengimpor modul di sini karena 'swiper/bundle' sudah mencakup semuanya
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
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


    // 2. Infinite Scroller for Testimonials
    const testimonialContainer = document.getElementById('testimonial-container');
    if (testimonialContainer && !window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
        testimonialContainer.setAttribute("data-animated", "true");

        const columns = testimonialContainer.querySelectorAll('.testimonial-column');
        columns.forEach(column => {
            const content = column.innerHTML;
            column.innerHTML += content;
        });
    }
});