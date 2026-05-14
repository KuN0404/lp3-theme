/**
 * Module: Counter Animation
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.CounterAnimation = {
  init: function () {
    var counters = document.querySelectorAll('.stat-block__num, .hero__stat-num');
    if (!counters.length || !('IntersectionObserver' in window)) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el       = entry.target;
        var text     = el.textContent.trim();
        var numMatch = text.match(/(\d[\d,]*)/);
        if (!numMatch) return;

        var target   = parseInt(numMatch[1].replace(/,/g, ''));
        var suffix   = text.replace(/[\d,]+/, '');
        var duration = 1800;
        var step     = duration / 60;
        var inc      = target / (duration / step);
        var current  = 0;

        var timer = setInterval(function () {
          current += inc;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          el.textContent = Math.floor(current).toLocaleString('id-ID') + suffix;
        }, step);

        observer.unobserve(el);
      });
    }, { threshold: 0.5 });

    counters.forEach(function (el) { observer.observe(el); });
  }
};
