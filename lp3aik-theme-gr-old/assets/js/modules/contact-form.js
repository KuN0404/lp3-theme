/**
 * Module: Contact Form (AJAX)
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.ContactForm = {
  init: function () {
    var form = document.getElementById('lp3aik-contact-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var btn   = form.querySelector('[type="submit"]');
      var alert = form.querySelector('.form-alert');
      var data  = new FormData(form);

      if (!window.lp3aikData) return;
      data.append('action', 'lp3aik_contact');
      data.append('nonce',  window.lp3aikData.nonce);

      btn.disabled = true;
      btn.textContent = 'Mengirim...';
      if (alert) { alert.className = 'form-alert'; alert.textContent = ''; }

      fetch(window.lp3aikData.ajaxUrl, { method: 'POST', body: data })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          if (alert) {
            alert.className = 'alert ' + (res.success ? 'alert-success' : 'alert-info');
            alert.textContent = res.data ? res.data.message : (res.success ? 'Pesan terkirim!' : 'Terjadi kesalahan.');
          }
          if (res.success) form.reset();
        })
        .catch(function () {
          if (alert) { alert.className = 'alert alert-info'; alert.textContent = 'Koneksi gagal. Coba lagi.'; }
        })
        .finally(function () {
          btn.disabled = false;
          btn.textContent = 'Kirim Pesan';
        });
    });
  }
};
