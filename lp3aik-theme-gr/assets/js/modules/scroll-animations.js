/**
 * Module: Scroll Animations
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.ScrollAnimations = {
  init: function () {
    if (!('IntersectionObserver' in window)) return;

    var style = document.createElement('style');
    style.textContent =
      '.anim-fade { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }' +
      '.anim-fade.visible { opacity: 1; transform: translateY(0); }';
    document.head.appendChild(style);

    var targets = document.querySelectorAll('.card, .program-card, .team-card, .stat-block, .contact-card');
    targets.forEach(function (el, i) {
      el.classList.add('anim-fade');
      el.style.transitionDelay = (i % 4) * 0.08 + 's';
    });

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    targets.forEach(function (el) { observer.observe(el); });
  }
};
