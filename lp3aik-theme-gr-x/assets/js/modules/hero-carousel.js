/**
 * Hero Carousel / Slider Module
 *
 * Auto-plays background image slides + text slides with smooth transitions.
 * Supports dot navigation and custom interval from data attribute.
 *
 * @package lp3aik-umk
 */
(function () {
  'use strict';

  const hero = document.querySelector('.hero[data-interval]');
  if (!hero) return;

  const bgSlides   = hero.querySelectorAll('.hero__slide');
  const textSlides = hero.querySelectorAll('.hero__text-slide');
  const dots       = hero.querySelectorAll('.hero__dot');
  const total      = bgSlides.length;

  if (total <= 1) return;

  const interval = parseInt(hero.dataset.interval, 10) || 6000;
  let current = 0;
  let timer = null;
  let isHovered = false;

  // Set CSS variable for dot progress animation
  hero.style.setProperty('--hero-interval', interval + 'ms');

  function goToSlide(index) {
    if (index === current && bgSlides[current].classList.contains('active')) return;

    // Deactivate current
    bgSlides[current].classList.remove('active');
    textSlides[current].classList.remove('active');
    if (dots[current]) dots[current].classList.remove('active');

    // Update current
    current = index;

    // Activate new
    bgSlides[current].classList.add('active');
    textSlides[current].classList.add('active');
    if (dots[current]) {
      dots[current].classList.remove('active');
      // Force reflow to restart animation
      void dots[current].offsetWidth;
      dots[current].classList.add('active');
    }
  }

  function nextSlide() {
    goToSlide((current + 1) % total);
  }

  function startAutoPlay() {
    stopAutoPlay();
    timer = setInterval(function () {
      if (!isHovered) {
        nextSlide();
      }
    }, interval);
  }

  function stopAutoPlay() {
    if (timer) {
      clearInterval(timer);
      timer = null;
    }
  }

  // Dot click handlers
  dots.forEach(function (dot, idx) {
    dot.addEventListener('click', function () {
      goToSlide(idx);
      startAutoPlay(); // Restart timer
    });
  });

  // Pause on hover (optional UX enhancement)
  hero.addEventListener('mouseenter', function () {
    isHovered = true;
  });
  hero.addEventListener('mouseleave', function () {
    isHovered = false;
  });

  // Touch swipe support
  let touchStartX = 0;
  let touchEndX = 0;

  hero.addEventListener('touchstart', function (e) {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  hero.addEventListener('touchend', function (e) {
    touchEndX = e.changedTouches[0].screenX;
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 50) {
      if (diff > 0) {
        // Swipe left → next
        goToSlide((current + 1) % total);
      } else {
        // Swipe right → prev
        goToSlide((current - 1 + total) % total);
      }
      startAutoPlay();
    }
  }, { passive: true });

  // Initialize: force first dot progress animation
  if (dots[0]) {
    dots[0].classList.remove('active');
    void dots[0].offsetWidth;
    dots[0].classList.add('active');
  }

  // Start autoplay
  startAutoPlay();

  // Pause when tab is not visible
  document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
      stopAutoPlay();
    } else {
      startAutoPlay();
    }
  });
})();
