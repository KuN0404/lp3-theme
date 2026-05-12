/**
 * Module: Sticky Header
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.StickyHeader = {
  init: function () {
    var header = document.getElementById('site-header');
    if (!header) return;

    function onScroll() {
      header.classList.toggle('scrolled', window.scrollY > 60);
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }
};
