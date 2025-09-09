/**
 * Homepage Animations
 */
import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

document.addEventListener('DOMContentLoaded', () => {

    // 1. Swiper.js Carousel for Homepage About Section
    const aboutSwiperEl = document.querySelector('.homepage-about-swiper');
    if (aboutSwiperEl) {
        new Swiper(aboutSwiperEl, {
            modules: [Swiper.Navigation, Swiper.Pagination, Swiper.Autoplay],
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
    if (testimonialContainer) {
        const columns = testimonialContainer.querySelectorAll('.testimonial-column');
        
        // Gandakan konten di setiap kolom untuk menciptakan ilusi tak terbatas
        columns.forEach(column => {
            const content = column.innerHTML;
            column.innerHTML += content;
        });

        // Tidak ada animasi di prefer-reduced-motion
        if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
            testimonialContainer.setAttribute("data-animated", "true");
        }
    }
});