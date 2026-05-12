window.LP3AIK = window.LP3AIK || {};

LP3AIK.MobileMenu = {
  init: function () {
    var mobileDrawer        = document.getElementById('mobileDrawer');
    var mobileDrawerOverlay = document.getElementById('mobileDrawerOverlay');
    var btnOpenDrawer       = document.getElementById('btn-open-mobile-drawer');
    var btnCloseDrawer      = document.getElementById('btn-close-mobile-drawer');

    if (!mobileDrawer) return;

    // ── Icon Mapping ─────────────────────────────────────────
    var iconMap = {
      'Beranda': 'fa-house',
      'Tentang': 'fa-graduation-cap',
      'Informasi': 'fa-calendar-days',
      'Program': 'fa-briefcase',
      'Galeri': 'fa-images',
      'Unduhan': 'fa-download',
      'Hubungi': 'fa-phone',
      'Profil': 'fa-user-tie',
      'Visi': 'fa-eye',
      'Struktur': 'fa-sitemap',
      'Berita': 'fa-newspaper'
    };

    mobileDrawer.querySelectorAll('.mobile-nav-list > li > a, .primary-nav > li > a').forEach(function (link) {
      var text = link.textContent.trim();
      // Only add if no icon exists
      if (!link.querySelector('i.fa-solid')) {
        for (var key in iconMap) {
          if (text.toLowerCase().includes(key.toLowerCase())) {
            var icon = document.createElement('i');
            icon.className = 'fa-solid ' + iconMap[key] + ' me-3';
            link.prepend(icon);
            break;
          }
        }
      }
    });

    function openMobileDrawer() {
      mobileDrawer.classList.add('open');
      if (mobileDrawerOverlay) mobileDrawerOverlay.classList.add('active');
      if (btnOpenDrawer) {
        btnOpenDrawer.setAttribute('aria-expanded', 'true');
        btnOpenDrawer.classList.add('active');
      }
      document.body.style.overflow = 'hidden';
    }

    function closeMobileDrawer() {
      mobileDrawer.classList.remove('open');
      if (mobileDrawerOverlay) mobileDrawerOverlay.classList.remove('active');
      if (btnOpenDrawer) {
        btnOpenDrawer.setAttribute('aria-expanded', 'false');
        btnOpenDrawer.classList.remove('active');
      }
      document.body.style.overflow = '';
      
      // Reset all open dropdowns
      mobileDrawer.querySelectorAll('.sub-menu').forEach(function (menu) {
        menu.style.display = 'none';
      });
      mobileDrawer.querySelectorAll('.menu-item-has-children').forEach(function (li) {
        li.classList.remove('open');
      });
    }

    if (btnOpenDrawer) {
      btnOpenDrawer.addEventListener('click', function (e) {
        e.preventDefault();
        if (mobileDrawer.classList.contains('open')) {
          closeMobileDrawer();
        } else {
          openMobileDrawer();
        }
      });
    }

    if (btnCloseDrawer) btnCloseDrawer.addEventListener('click', closeMobileDrawer);
    if (mobileDrawerOverlay) mobileDrawerOverlay.addEventListener('click', closeMobileDrawer);

    // ── Dropdown accordion inside drawer ─────────────────────
    mobileDrawer.querySelectorAll('.menu-item-has-children > a').forEach(function (link) {
      // Add arrow indicator if not already there
      if (!link.querySelector('.submenu-arrow')) {
        var arrow = document.createElement('span');
        arrow.className = 'submenu-arrow';
        arrow.innerHTML = '<i class="fa-solid fa-chevron-down fa-2xs"></i>';
        link.appendChild(arrow);
      }

      link.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        var parent = this.parentElement;
        var menu   = parent.querySelector('.sub-menu');
        if (!menu) return;

        var isOpen = parent.classList.contains('open');

        // Close all other open menus at the same level
        var siblings = parent.parentElement.children;
        for (var i = 0; i < siblings.length; i++) {
          if (siblings[i] !== parent && siblings[i].classList.contains('open')) {
            siblings[i].classList.remove('open');
            var siblingMenu = siblings[i].querySelector('.sub-menu');
            if (siblingMenu) siblingMenu.style.display = 'none';
          }
        }

        if (isOpen) {
          parent.classList.remove('open');
          menu.style.display = 'none';
        } else {
          parent.classList.add('open');
          menu.style.display = 'block';
        }
      });
    });

    // Auto-close drawer when a leaf link is clicked
    mobileDrawer.querySelectorAll('.mobile-nav-list a:not(.menu-item-has-children > a), .primary-nav a:not(.menu-item-has-children > a), .btn-mobile-login').forEach(function (link) {
      link.addEventListener('click', closeMobileDrawer);
    });
    
    // Close on Escape
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeMobileDrawer();
    });
  }
};
