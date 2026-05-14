/**
 * Module: Tabs (Visi Misi)
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.Tabs = {
  init: function () {
    document.querySelectorAll('.tab-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var tabId  = this.getAttribute('data-tab');
        var parent = this.closest('.about__visi-misi') || this.closest('.tabs-wrapper') || document;

        parent.querySelectorAll('.tab-btn').forEach(function (b) { b.classList.remove('active'); });
        parent.querySelectorAll('.tab-panel').forEach(function (p) { p.classList.remove('active'); });

        this.classList.add('active');
        var panel = parent.querySelector('#tab-' + tabId);
        if (panel) panel.classList.add('active');
      });
    });
  }
};
