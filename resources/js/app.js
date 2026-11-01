import "./bootstrap";
import Alpine from "alpinejs";
import Swiper from "swiper";
import { Autoplay, Navigation, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

window.Alpine = Alpine;
Alpine.start();

/**
 * Hero Carousel (Swiper) - Berita Utama halaman depan
 * Elemen: <div class="hero-swiper"> ... </div>
 */
document.addEventListener("DOMContentLoaded", () => {
    const heroEl = document.querySelector(".hero-swiper");
    if (heroEl) {
        new Swiper(heroEl, {
            modules: [Autoplay, Navigation, Pagination],
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".hero-next",
                prevEl: ".hero-prev",
            },
            pagination: {
                el: ".hero-pagination",
                clickable: true,
            },
            speed: 600,
        });
    }

    // Breaking news ticker (marquee otomatis berjalan, murni CSS animation di app.css)

    // Native lazy loading fallback observer (untuk browser lama tanpa loading="lazy")
    if (!("loading" in HTMLImageElement.prototype)) {
        const lazyImages = document.querySelectorAll("img[data-src]");
        const imgObserver = new IntersectionObserver((entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute("data-src");
                    obs.unobserve(img);
                }
            });
        });
        lazyImages.forEach((img) => imgObserver.observe(img));
    }
});
