/**
 * LP3AIK UM Kotabumi — Main JavaScript Entry Point
 *
 * Loads all feature modules. Each module is self-contained
 * with its own init function.
 *
 * @version 2.1.0
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    if (LP3AIK.StickyHeader)      LP3AIK.StickyHeader.init();
    if (LP3AIK.MobileMenu)        LP3AIK.MobileMenu.init();
    if (LP3AIK.HeroCarousel)      LP3AIK.HeroCarousel.init();
    if (LP3AIK.Tabs)              LP3AIK.Tabs.init();
    if (LP3AIK.GalleryLightbox)   LP3AIK.GalleryLightbox.init();
    if (LP3AIK.ContactForm)       LP3AIK.ContactForm.init();
    if (LP3AIK.BackToTop)         LP3AIK.BackToTop.init();
    if (LP3AIK.SearchModal)       LP3AIK.SearchModal.init();
    if (LP3AIK.CounterAnimation)  LP3AIK.CounterAnimation.init();
    if (LP3AIK.ScrollAnimations)  LP3AIK.ScrollAnimations.init();
  });
})();
