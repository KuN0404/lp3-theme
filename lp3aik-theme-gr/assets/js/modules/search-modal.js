/**
 * Module: Search Modal
 * Fully fixed: handles open/close toggle, close button, backdrop, keyboard, aria-expanded.
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.SearchModal = {
  modal:   null,
  toggle:  null,
  closeBtn: null,
  input:   null,

  init: function () {
    this.modal   = document.getElementById('search-modal');
    this.toggle  = document.getElementById('search-toggle');
    this.closeBtn = document.getElementById('search-close');
    if (!this.modal || !this.toggle) return;

    this.input = this.modal.querySelector('input[type="search"], input[name="s"]');

    var self = this;

    // Open modal
    this.toggle.addEventListener('click', function () {
      self.open();
    });

    // Close button inside modal
    if (this.closeBtn) {
      this.closeBtn.addEventListener('click', function () {
        self.close();
      });
    }

    // Clicking the backdrop (outside modal__box) closes it
    this.modal.addEventListener('click', function (e) {
      if (e.target === self.modal) self.close();
    });

    // Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && self.modal.classList.contains('open')) {
        self.close();
      }
    });

    // Mobile search trigger (in offcanvas footer)
    var mobileBtn = document.getElementById('mobile-search-trigger');
    if (mobileBtn) {
      mobileBtn.addEventListener('click', function () {
        var offcanvasEl = document.getElementById('mobileNavOffcanvas');
        if (offcanvasEl && window.bootstrap && bootstrap.Offcanvas) {
          var bsOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
          if (bsOffcanvas) bsOffcanvas.hide();
        }
        setTimeout(function () { self.open(); }, 320);
      });
    }

    // Site-wide intercept: Prevent submitting empty/whitespace queries on ALL search forms
    var searchForms = document.querySelectorAll('form[role="search"], .search-form');
    searchForms.forEach(function (form) {
      form.addEventListener('submit', function (e) {
        var inp = form.querySelector('input[type="search"], input[name="s"]');
        if (inp && !inp.value.trim()) {
          e.preventDefault();
          inp.value = ''; // Reset display to clear spaces
          inp.focus();
        }
      });
    });
  },

  open: function () {
    this.modal.classList.add('open');
    this.toggle && this.toggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('search-modal-open');
    var self = this;
    if (this.input) setTimeout(function () { self.input.focus(); }, 120);
  },

  close: function () {
    this.modal.classList.remove('open');
    this.toggle && this.toggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('search-modal-open');
    this.toggle && this.toggle.focus();
  }
};
