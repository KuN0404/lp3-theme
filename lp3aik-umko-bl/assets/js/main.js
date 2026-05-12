/**
 * LP3AIK Theme — Main JavaScript v3
 * Islamic-Academic Nuanced Design
 */
(function ($) {
    'use strict';

    /* ==========================================================================
       Navbar: Transparan di beranda (top), solid saat scroll atau di halaman lain
       ========================================================================== */
    var header = document.getElementById('site-header');
    var isHomepage = document.body.classList.contains('home') || document.body.classList.contains('front-page');

    function updateNavbar() {
        if (!header) return;
        if (isHomepage) {
            if (window.scrollY > 60) {
                header.classList.add('scrolled');
                header.classList.remove('header-solid');
            } else {
                header.classList.remove('scrolled');
                header.classList.remove('header-solid');
            }
        } else {
            // Non-beranda: SELALU solid, tidak pernah transparan
            header.classList.add('header-solid');
            header.classList.remove('scrolled');
        }
    }

    // Jalankan langsung agar kondisi awal benar sebelum scroll
    updateNavbar();
    // Update saat scroll
    window.addEventListener('scroll', updateNavbar, { passive: true });
    // Update saat page show (back/forward navigation cache)
    window.addEventListener('pageshow', updateNavbar);


    /* ==========================================================================
       Search Overlay — Fullscreen Toggle
       ========================================================================== */
    var searchOverlay   = document.getElementById('searchOverlay');
    var closeSearchBtn  = document.getElementById('btn-close-search');
    var searchInput     = searchOverlay ? searchOverlay.querySelector('.search-overlay-input') : null;

    function openSearch() {
        if (!searchOverlay) return;
        // Close mobile drawer first if open
        closeMobileDrawer();
        searchOverlay.classList.add('active');
        searchOverlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        document.documentElement.style.overflow = 'hidden';
        if (searchInput) {
            setTimeout(function () { searchInput.focus(); }, 250);
        }
    }

    function closeSearch() {
        if (!searchOverlay) return;
        searchOverlay.classList.remove('active');
        searchOverlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
        // Return focus to the trigger button
        var trigger = document.getElementById('btn-search-nav');
        if (trigger) trigger.focus();
    }

    // Desktop search trigger only (mobile search removed)
    document.querySelectorAll('#btn-search-nav').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            openSearch();
        });
    });

    if (closeSearchBtn) {
        closeSearchBtn.addEventListener('click', closeSearch);
    }
    if (searchOverlay) {
        searchOverlay.addEventListener('click', function (e) {
            if (e.target === searchOverlay) closeSearch();
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            if (searchOverlay && searchOverlay.classList.contains('active')) closeSearch();
            closeMobileDrawer();
        }
    });

    /* ==========================================================================
       Mobile Fullscreen Drawer — Right Side
       ========================================================================== */
    var mobileDrawer        = document.getElementById('mobileDrawer');
    var mobileDrawerOverlay = document.getElementById('mobileDrawerOverlay');
    var btnOpenDrawer       = document.getElementById('btn-open-mobile-drawer');
    var btnCloseDrawer      = document.getElementById('btn-close-mobile-drawer');

    function openMobileDrawer() {
        if (!mobileDrawer) return;
        mobileDrawer.classList.add('open');
        if (mobileDrawerOverlay) mobileDrawerOverlay.classList.add('active');
        if (btnOpenDrawer) btnOpenDrawer.setAttribute('aria-expanded', 'true');
        // No body scroll lock — floating panel allows background scroll
    }

    function closeMobileDrawer() {
        if (!mobileDrawer) return;
        mobileDrawer.classList.remove('open');
        if (mobileDrawerOverlay) mobileDrawerOverlay.classList.remove('active');
        if (btnOpenDrawer) btnOpenDrawer.setAttribute('aria-expanded', 'false');
        // Reset all open dropdowns
        mobileDrawer.querySelectorAll('.dropdown-menu').forEach(function (menu) {
            menu.style.display = 'none';
        });
        mobileDrawer.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
            toggle.setAttribute('aria-expanded', 'false');
            toggle.classList.remove('active');
        });
    }

    // Hamburger = toggle (open if closed, close if open)
    if (btnOpenDrawer) btnOpenDrawer.addEventListener('click', function () {
        if (mobileDrawer && mobileDrawer.classList.contains('open')) {
            closeMobileDrawer();
        } else {
            openMobileDrawer();
        }
    });
    if (btnCloseDrawer) btnCloseDrawer.addEventListener('click', closeMobileDrawer);
    if (mobileDrawerOverlay) mobileDrawerOverlay.addEventListener('click', closeMobileDrawer);

    // Dropdown accordion inside drawer
    if (mobileDrawer) {
        mobileDrawer.querySelectorAll('.dropdown-toggle').forEach(function (toggle) {
            toggle.removeAttribute('data-bs-toggle');
            toggle.setAttribute('aria-expanded', 'false');
            toggle.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var parent = this.closest('.nav-item.dropdown') || this.closest('.dropdown') || this.parentElement;
                var menu   = parent ? parent.querySelector('.dropdown-menu') : null;
                if (!menu) return;
                var isOpen = menu.style.display === 'block';
                // Close all other open menus
                mobileDrawer.querySelectorAll('.dropdown-menu').forEach(function (m) { m.style.display = 'none'; });
                mobileDrawer.querySelectorAll('.dropdown-toggle').forEach(function (t) {
                    t.setAttribute('aria-expanded', 'false');
                    t.classList.remove('active');
                });
                if (!isOpen) {
                    menu.style.display = 'block';
                    this.setAttribute('aria-expanded', 'true');
                    this.classList.add('active');
                }
            });
        });

        // Auto-close drawer when a leaf link is clicked
        mobileDrawer.querySelectorAll('.mobile-nav-list .dropdown-item, .mobile-nav-list .nav-link:not(.dropdown-toggle)').forEach(function (link) {
            link.addEventListener('click', closeMobileDrawer);
        });
    }

    /* ==========================================================================
       Scroll To Top Button
       ========================================================================== */
    var scrollBtn = document.getElementById('scrollToTop');
    if (scrollBtn) {
        window.addEventListener('scroll', function () {
            scrollBtn.classList.toggle('visible', window.scrollY > 400);
        });
        scrollBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    /* ==========================================================================
       Smooth scroll for anchor links
       ========================================================================== */
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            if (href === '#') return;
            var target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                var offset = header ? header.offsetHeight + 20 : 20;
                var top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });

    /* ==========================================================================
       Scroll Reveal Animations (Intersection Observer)
       ========================================================================== */
    if ('IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');
                        revealObserver.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.05, rootMargin: '0px 0px -10px 0px' }
        );
        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(function (el) {
            revealObserver.observe(el);
        });
    } else {
        document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(function (el) {
            el.classList.add('revealed');
        });
    }

    /* ==========================================================================
       Counter Animation
       ========================================================================== */
    function animateCounter(el) {
        var $el = $(el);
        var countTo = parseInt($el.data('count'), 10) || 0;
        if (countTo === 0) return;
        $({ countNum: 0 }).animate({ countNum: countTo }, {
            duration: 2200, easing: 'swing',
            step: function () { $el.text(Math.floor(this.countNum)); },
            complete: function () { $el.text(this.countNum); },
        });
    }

    if ('IntersectionObserver' in window) {
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    $(entry.target).find('.stat-number').each(function () { animateCounter(this); });
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });
        document.querySelectorAll('.lp3aik-stats').forEach(function (el) { counterObserver.observe(el); });
    } else {
        $('.stat-number').each(function () { animateCounter(this); });
    }

    /* ==========================================================================
       Gallery Lightbox
       ========================================================================== */
    $('#galleryModal').on('show.bs.modal', function (e) {
        var link = $(e.relatedTarget);
        $('#galleryModalLabel').text(link.data('title') || 'Galeri LP3AIK');
        $('#galleryModalImg').attr('src', link.data('img')).attr('alt', link.data('title') || '');
        $('#galleryModalDesc').text(link.data('desc') || '');
    });

    /* ==========================================================================
       Category Filters (Gallery, Program, Unduhan)
       ========================================================================== */
    /* ==========================================================================
       Category Filters (Gallery, Program, Unduhan)
       ========================================================================== */
    function setupFilter(filterClass, itemSelector, categoryAttr) {
        $(filterClass).on('click', function () {
            var filter = $(this).data('filter');
            $(filterClass).removeClass('active');
            $(this).addClass('active');

            if (filter === 'all') {
                $(itemSelector).parent().fadeIn(400); // For grid columns
                $(itemSelector).fadeIn(400);          // For direct items
            } else {
                $(itemSelector).each(function () {
                    var cats = ($(this).attr('data-categories') || $(this).data(categoryAttr) || '').toString().split(' ');
                    var $target = $(this).parent().hasClass('col-md-6') || $(this).parent().hasClass('col-lg-4') ? $(this).parent() : $(this);
                    
                    if (cats.indexOf(filter) !== -1) {
                        $target.fadeIn(400);
                    } else {
                        $target.fadeOut(400);
                    }
                });
            }
        });
    }
    // Initialize filters
    setupFilter('.gallery-filter', '.gallery-grid-item', 'categories');
    setupFilter('.program-filter', '.program-grid-item', 'categories');
    setupFilter('.unduhan-filter', '.unduhan-grid-item', 'categories');

    /* ==========================================================================

       Hero parallax on scrolling
       ========================================================================== */
    var heroCarousel = document.querySelector('.lp3aik-hero-carousel');
    if (heroCarousel) {
        window.addEventListener('scroll', function () {
            var scroll = window.scrollY;
            if (scroll < window.innerHeight) {
                var decos = heroCarousel.querySelectorAll('.hero-deco-1, .hero-deco-2, .hero-deco-3');
                if (decos[0]) decos[0].style.transform = 'translateY(' + (scroll * 0.12) + 'px)';
                if (decos[1]) decos[1].style.transform = 'translateY(' + (scroll * -0.08) + 'px)';
                if (decos[2]) decos[2].style.transform = 'translateY(' + (scroll * 0.06) + 'px) scale(1.04)';
            }
        });
    }

    /* ==========================================================================
       AJAX Contact Form
       ========================================================================== */
    $('#lp3aik-contact-form').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this), $message = $form.find('.form-message'), $button = $form.find('button[type="submit"]');
        var honeypot = $form.find('#honeypot').val();
        if (honeypot) {
            $message.hide().removeClass('alert-success alert-danger');
            $message.addClass('alert alert-success').text('Pesan berhasil dikirim.').fadeIn();
            $form[0].reset(); return;
        }
        var formData = {
            action: 'lp3aik_contact_form', nonce: lp3aikAjax.nonce,
            name: $form.find('#contact-name').val().trim(),
            email: $form.find('#contact-email').val().trim(),
            subject: $form.find('#contact-subject').val().trim(),
            message: $form.find('#contact-message').val().trim(),
        };
        if (!formData.name || !formData.email || !formData.subject || !formData.message) {
            $message.hide().removeClass('alert-success alert-danger');
            $message.addClass('alert alert-warning').text('Semua kolom wajib diisi.').fadeIn();
            return;
        }
        $button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...');
        $.post(lp3aikAjax.ajaxurl, formData, function (response) {
            $button.prop('disabled', false).html('<i class="bi bi-send-fill me-2"></i>Kirim Pesan');
            $message.hide().removeClass('alert-success alert-danger alert-warning');
            if (response.success) {
                $message.addClass('alert alert-success').text(response.data.message).fadeIn();
                $form[0].reset();
                setTimeout(function () { $message.fadeOut(); }, 5000);
            } else {
                $message.addClass('alert alert-danger').text(response.data.message).fadeIn();
            }
        }).fail(function () {
            $button.prop('disabled', false).html('<i class="bi bi-send-fill me-2"></i>Kirim Pesan');
            $message.hide().removeClass('alert-success alert-danger alert-warning');
            $message.addClass('alert alert-danger').text('Terjadi kesalahan. Silakan coba lagi.').fadeIn();
        });
    });

    /* ==========================================================================
       Active nav item highlight (JS fallback for custom menus)
       ========================================================================== */
    var currentPath = window.location.pathname.replace(/\/$/, '');
    document.querySelectorAll('.navbar-nav .nav-link').forEach(function (link) {
        var href = link.getAttribute('href');
        if (!href) return;
        var linkPath = href.replace(/\/$/, '');
        if (linkPath && linkPath !== '/' && currentPath.indexOf(linkPath) !== -1) {
            link.classList.add('active');
            var parentDropdown = link.closest('.dropdown');
            if (parentDropdown) {
                parentDropdown.querySelector('.nav-link').classList.add('active');
            }
        } else if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });


// ADD
    /* ==========================================================================
       1. Gallery Lightbox - Modal Bootstrap 5
       Trigger dari tombol .gallery-card-btn (content-gallery.php)
       ========================================================================== */
 
    var galleryModal    = document.getElementById('galleryModal');
    var galleryModalImg = document.getElementById('galleryModalImg');
    var galleryModalLbl = document.getElementById('galleryModalLabel');
    var galleryModalDsc = document.getElementById('galleryModalDesc');
 
    if (galleryModal) {
        galleryModal.addEventListener('show.bs.modal', function (event) {
            var trigger = event.relatedTarget;
            if (!trigger) return;
 
            var imgSrc  = trigger.getAttribute('data-img')   || '';
            var title   = trigger.getAttribute('data-title')  || '';
            var desc    = trigger.getAttribute('data-desc')   || '';
 
            if (galleryModalImg) {
                galleryModalImg.src = imgSrc;
                galleryModalImg.alt = title;
            }
            if (galleryModalLbl) galleryModalLbl.textContent = title;
            if (galleryModalDsc) {
                galleryModalDsc.textContent = desc;
                galleryModalDsc.style.display = desc ? '' : 'none';
            }
        });
 
        // Reset src saat modal ditutup (cegah ghost load)
        galleryModal.addEventListener('hidden.bs.modal', function () {
            if (galleryModalImg) galleryModalImg.src = '';
        });
    }
 
 
    /* ==========================================================================
       2. Gallery & Unduhan Filter (isotope-less, pure JS)
       ========================================================================== */
 
    // Filters handled by setupFilter above
 
 
    /* ==========================================================================
       3. Contact Form — AJAX + Validasi Bootstrap 5
       ========================================================================== */
 
    var contactForm = document.getElementById('lp3aik-contact-form');
 
    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();
 
            // Bootstrap 5 validity check
            if (!contactForm.checkValidity()) {
                contactForm.classList.add('was-validated');
                return;
            }
 
            var submitBtn  = document.getElementById('contact-submit');
            var btnText    = submitBtn ? submitBtn.querySelector('.btn-text') : null;
            var btnLoading = submitBtn ? submitBtn.querySelector('.btn-loading') : null;
            var resultDiv  = document.getElementById('contact-form-result');
 
            // Loading state
            if (submitBtn) submitBtn.disabled = true;
            if (btnText)    btnText.classList.add('d-none');
            if (btnLoading) btnLoading.classList.remove('d-none');
            if (resultDiv)  resultDiv.className = 'alert d-none mb-4';
 
            var formData = new FormData(contactForm);
            formData.append('action', 'lp3aik_contact_form');
 
            fetch(lp3aikAjax.ajaxurl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
            })
            .then(function (resp) {
                if (!resp.ok) throw new Error('Network error');
                return resp.json();
            })
            .then(function (data) {
                if (resultDiv) {
                    resultDiv.className = 'alert mb-4 ' + (data.success ? 'alert-success' : 'alert-danger');
                    resultDiv.textContent = data.data && data.data.message
                        ? data.data.message
                        : (data.success ? 'Pesan berhasil dikirim!' : 'Terjadi kesalahan, coba lagi.');
                    resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
                if (data.success) {
                    contactForm.reset();
                    contactForm.classList.remove('was-validated');
                }
            })
            .catch(function () {
                if (resultDiv) {
                    resultDiv.className = 'alert alert-danger mb-4';
                    resultDiv.textContent = 'Gagal mengirim pesan. Periksa koneksi Anda dan coba lagi.';
                }
            })
            .finally(function () {
                if (submitBtn) submitBtn.disabled = false;
                if (btnText)    btnText.classList.remove('d-none');
                if (btnLoading) btnLoading.classList.add('d-none');
            });
        });
    }
 
 
    /* ==========================================================================
       4. (Legacy block — drawer logic moved above with Search Overlay)
       ========================================================================== */
 
 
    /* ==========================================================================
       5. Herocarousel: pastikan auto-slide berjalan setelah load
       ========================================================================== */
 
    var heroCarousel = document.getElementById('heroCarousel');
    if (heroCarousel && typeof bootstrap !== 'undefined') {
        var bsCarousel = bootstrap.Carousel.getInstance(heroCarousel);
        if (!bsCarousel) {
            var interval = parseInt(heroCarousel.getAttribute('data-bs-interval'), 10) || 6000;
            new bootstrap.Carousel(heroCarousel, {
                interval: interval,
                ride: 'carousel',
                wrap: true,
                touch: true,
            });
        }
    }
 
 
    /* ==========================================================================
       6. Pause carousel hover (aksesibilitas)
       ========================================================================== */
 
    if (heroCarousel) {
        heroCarousel.addEventListener('mouseenter', function () {
            var c = bootstrap.Carousel.getInstance(heroCarousel);
            if (c) c.pause();
        });
        heroCarousel.addEventListener('mouseleave', function () {
            var c = bootstrap.Carousel.getInstance(heroCarousel);
            if (c) c.cycle();
        });
    }

})(jQuery);