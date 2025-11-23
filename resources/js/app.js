import Swiper from 'swiper';
import { Navigation, Thumbs } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';

const isMobile = () => window.innerWidth <= 768;

let swiperThumbs = null;
let swiperMain = null;

const initSwipers = () => {

   // Destroi swipers existentes
   if (swiperThumbs) {
      swiperThumbs.destroy(true, true);
      swiperThumbs = null;
   }
   if (swiperMain) {
      swiperMain.destroy(true, true);
      swiperMain = null;
   }

   // Verifica se os elementos existem
   const thumbsEl = document.querySelector('.swiper-thumbnails');
   const mainEl = document.querySelector('.mySwiper2');

   // Inicializa thumbnails
   swiperThumbs = new Swiper('.swiper-thumbnails', {
      modules: [Navigation],
      direction: isMobile() ? 'horizontal' : 'vertical',
      spaceBetween: 10,
      slidesPerView: isMobile() ? 4.2 : 'auto', // 4.5 mostra parte do próximo slide
      freeMode: true,
      watchSlidesProgress: true,
      navigation: isMobile() ? false : { // Desabilita navegação no mobile
         nextEl: '.swiper-button-next-thumb',
         prevEl: '.swiper-button-prev-thumb',
      },
   });


   // Aguarda um tick antes de inicializar o principal
   setTimeout(() => {
      swiperMain = new Swiper('.mySwiper2', {
         modules: [Thumbs],
         spaceBetween: 10,
         thumbs: {
            swiper: swiperThumbs,
         },
      });


      // Ajusta altura no desktop
      if (!isMobile()) {
         setTimeout(() => {
            const mainHeight = mainEl.offsetHeight;
            if (mainHeight) {
               thumbsEl.style.height = `${mainHeight}px`;
               swiperThumbs.update();
            }
         }, 100);
      }
   }, 50);
};

// Inicializa
if (document.readyState === 'loading') {
   document.addEventListener('DOMContentLoaded', initSwipers);
} else {
   initSwipers();
}

// Resize
let resizeTimer;
window.addEventListener('resize', () => {
   clearTimeout(resizeTimer);
   resizeTimer = setTimeout(() => {
      if (swiperThumbs) {
         const wasVertical = swiperThumbs.params.direction === 'vertical';
         const shouldBeVertical = !isMobile();

         if (wasVertical !== shouldBeVertical) {
            initSwipers();
         }
      }
   }, 250);
});


if (document.querySelector('.swiper-product')) {
   new Swiper('.swiper-product', {
      slidesPerView: 1,
      spaceBetween: 24,
      loop: true,
      navigation: {
         nextEl: '.swiper-button-next-product',
         prevEl: '.swiper-button-prev-product',
      },
      breakpoints: {
         640: { slidesPerView: 2.25 },
         1024: { slidesPerView: 3.25 },
         1280: { slidesPerView: 4.25 },
      },
   });
}

if (document.querySelector('.swiper-category')) {
   new Swiper('.swiper-category', {
      modules: [Navigation], 
      slidesPerView: 1.25,
      spaceBetween: 24,
      loop: false,
      navigation: {
         nextEl: '.swiper-button-next-category',
         prevEl: '.swiper-button-prev-category',
      },
      breakpoints: {
         640: { slidesPerView: 2.25 },
         1024: { slidesPerView: 3.25 },
         1280: { slidesPerView: 4.25 },
      },
   });
}

if (document.querySelector('.swiper-segment')) {
   new Swiper('.swiper-segment', {
      modules: [Navigation], 
      slidesPerView: 1.25,
      spaceBetween: 24,
      loop: false,
      navigation: {
         nextEl: '.swiper-button-next-segment',
         prevEl: '.swiper-button-prev-segment',
      },
      breakpoints: {
         640: { slidesPerView: 2.25 },
         1024: { slidesPerView: 3.25 },
         1280: { slidesPerView: 4.25 },
      },
   });
}

document.addEventListener('alpine:init', () => {
   Alpine.data('navbarComponent', () => ({
      isMenuOpen: false,
      lastScrollY: 0,
      scrollThreshold: 100,
      isHidden: false,
      hasShadow: false,

      openMenu() {
         this.isMenuOpen = true;
      },

      closeMenu() {
         this.isMenuOpen = false;
      },

      handleScroll() {
         const currentY = window.scrollY;
         if (this.isMenuOpen) return;

         const delta = currentY - this.lastScrollY;

         if (currentY > this.scrollThreshold) {
            if (delta > 5) { // rolando pra baixo
               this.isHidden = true;
               this.hasShadow = false;
            } else if (delta < -5) { // rolando pra cima
               this.isHidden = false;
               this.hasShadow = true;
            }
         } else {
            this.isHidden = false;
            this.hasShadow = false;
         }

         this.lastScrollY = currentY;
      },

      init() {
         window.addEventListener('scroll', () => this.handleScroll());
      },
   }));
});

function setCookie(name, value, hours) {
  const date = new Date();
  date.setTime(date.getTime() + (hours * 60 * 60 * 1000));
  const expires = "expires=" + date.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
  const nameEQ = name + "=";
  const ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i].trim();
    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

const cookieName = "privacy-accepted";
const hasAcceptedCookies = getCookie(cookieName);
const modal = document.getElementById('privacy-modal');
const acceptButton = document.getElementById('accept-privacy');

// Mostrar modal
if (!hasAcceptedCookies) {
  modal.classList.add("opacity-100", "translate-y-0");
  modal.classList.remove("opacity-0", "translate-y-6", "pointer-events-none");
}

// Ao aceitar
acceptButton.addEventListener('click', () => {
  setCookie(cookieName, 'true', 24 * 30);

  modal.classList.add("opacity-0", "translate-y-6", "pointer-events-none");
  modal.classList.remove("opacity-100", "translate-y-0");
});
