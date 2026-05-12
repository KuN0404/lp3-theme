/**
 * LP3AIK UM Kotabumi — Main JavaScript Entry Point
 *
 * Loads all feature modules. Each module is self-contained
 * with its own init function.
 *
 * @version 2.0.0
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    LP3AIK.StickyHeader.init();
    LP3AIK.MobileMenu.init();
    LP3AIK.Tabs.init();
    LP3AIK.GalleryLightbox.init();
    LP3AIK.ContactForm.init();
    LP3AIK.BackToTop.init();
    LP3AIK.SearchModal.init();
    LP3AIK.CounterAnimation.init();
    LP3AIK.ScrollAnimations.init();
  });
})();
