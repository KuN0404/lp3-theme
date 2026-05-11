/**
 * Module: Search Modal
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.SearchModal = {
  init: function () {
    var modal  = document.getElementById('search-modal');
    var toggle = document.getElementById('search-toggle');
    if (!modal || !toggle) return;

    toggle.addEventListener('click', function () {
      modal.classList.add('active');
      var input = modal.querySelector('input[type="search"]');
      if (input) setTimeout(function () { input.focus(); }, 100);
    });

    modal.addEventListener('click', function (e) {
      if (e.target === modal) modal.classList.remove('active');
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') modal.classList.remove('active');
    });
  }
};
