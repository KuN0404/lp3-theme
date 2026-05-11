/**
 * Module: Mobile Menu
 */
window.LP3AIK = window.LP3AIK || {};

  LP3AIK.MobileMenu = {
    init: function () {
      var toggle = document.getElementById('nav-toggle');
      var drawer = document.getElementById('mobile-menu-drawer');
      var nav    = document.querySelector('.primary-nav');
      if (!toggle || !drawer || !nav) return;
  
      toggle.addEventListener('click', function () {
        var open = drawer.classList.toggle('open');
        toggle.classList.toggle('active', open);
        toggle.setAttribute('aria-expanded', open);
      });

    // Mobile dropdown toggle
    nav.querySelectorAll('.menu-item-has-children > a').forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          this.parentElement.classList.toggle('open');
        }
      });
    });

    // Close nav on outside click
    document.addEventListener('click', function (e) {
      if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
        drawer.classList.remove('open');
        toggle.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }
};
