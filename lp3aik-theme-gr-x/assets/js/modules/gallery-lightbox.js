/**
 * Module: Gallery Lightbox
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.GalleryLightbox = {
  init: function () {
    var lightbox = document.getElementById('lightbox');
    var lbImg    = document.getElementById('lightbox-img');
    var lbClose   = document.getElementById('lightbox-close');
    var lbTitle   = document.getElementById('lightbox-title');
    var lbDesc    = document.getElementById('lightbox-desc');
    var lbCaption = document.getElementById('lightbox-caption');
    
    if (!lightbox || !lbImg) return;

    document.querySelectorAll('.gallery-item').forEach(function (item) {
      item.addEventListener('click', function () {
        var src = this.getAttribute('data-src') || (this.querySelector('img') ? this.querySelector('img').src : null);
        if (!src) return;
        
        lbImg.src = src;
        lbImg.alt = this.querySelector('.gallery-item__overlay') ? this.querySelector('.gallery-item__overlay').textContent : '';
        
        // Set Title & Description Caption
        var title = this.getAttribute('data-title') || '';
        var desc  = this.getAttribute('data-desc') || '';
        
        if (lbTitle) lbTitle.textContent = title;
        if (lbDesc) lbDesc.textContent = desc;
        
        if (lbCaption) {
          if (title || desc) {
            lbCaption.style.display = 'block';
          } else {
            lbCaption.style.display = 'none';
          }
        }
        
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
      });
    });

    function closeLightbox() {
      lightbox.classList.remove('active');
      document.body.style.overflow = '';
      setTimeout(function () { 
        lbImg.src = ''; 
        if (lbTitle) lbTitle.textContent = '';
        if (lbDesc) lbDesc.textContent = '';
      }, 300);
    }

    if (lbClose) lbClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeLightbox();
    });
  }
};
