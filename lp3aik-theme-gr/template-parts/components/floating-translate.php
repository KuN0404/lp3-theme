<?php
/**
 * Component: Modern Floating Translate (Integrated)
 * Matches requested modern FAB + rounded card design, adapted for Active Theme.
 *
 * @package lp3aik-umk
 */
?>
<style>
.lp3aik-gt-wrapper {
    position: fixed;
    bottom: 2rem; /* Occupies the bottom-most slot (swapped!) */
    right: 2rem;
    z-index: 99999; /* Ensure supreme visibility */
    font-family: var(--font-base, sans-serif);
}
.lp3aik-gt-fab {
    width: 44px;  /* Matches exact back-to-top scale! */
    height: 44px; /* Matches exact back-to-top scale! */
    border-radius: 50%;
    background-color: var(--color-primary); /* Brand primary color */
    color: var(--color-white, white);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 20px rgba(26, 122, 60, 0.3); /* Scaled down shadow */
    cursor: pointer;
    border: none;
    outline: none;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    padding: 0;
}
.lp3aik-gt-fab:hover {
    transform: scale(1.1) rotate(5deg);
    background-color: var(--color-primary-dark);
    box-shadow: 0 8px 24px rgba(26, 122, 60, 0.4);
}
.lp3aik-gt-fab i {
    font-size: 1.1rem; /* Synced perfectly with back-to-top icon scale */
    line-height: 1;
}
.lp3aik-gt-panel {
    position: absolute;
    bottom: 56px; /* Snapped tighter since trigger button is shorter */
    right: 0;
    width: 270px;
    background: var(--color-white, white);
    border-radius: 24px; /* Rounded pill-design card */
    box-shadow: var(--shadow-lg, 0 15px 40px rgba(0,0,0,0.16));
    overflow: hidden;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px) scale(0.9);
    transform-origin: bottom right;
    pointer-events: none;
    transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid var(--color-border, rgba(0,0,0,0.05));
}
.lp3aik-gt-panel.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
    pointer-events: auto;
}
.lp3aik-gt-header {
    padding: 22px 24px 10px;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--color-text-muted, #8c97a8);
    letter-spacing: 1px;
}
.lp3aik-gt-list {
    list-style: none;
    padding: 0 0 16px 0;
    margin: 0;
}
.lp3aik-gt-list a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 24px;
    color: var(--color-text, #333);
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.2s ease;
    border: none !important;
}
.lp3aik-gt-list a:hover {
    background-color: var(--color-primary-subtle, #f0f8f3);
    color: var(--color-primary);
}
.lp3aik-gt-list img {
    width: 22px;
    height: 16px;
    object-fit: cover;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.15);
}

/* GTranslate Core Overrides for zero visual clutter */
#google_translate_element2, .skiptranslate, iframe.skiptranslate, .goog-te-banner-frame {
    display: none !important;
}
body {
    top: 0px !important;
}

/* Synchronized responsive positioning for both floating buttons */
@media (max-width: 768px) {
    .lp3aik-gt-wrapper {
        bottom: 1.25rem !important;
        right: 1.25rem !important;
    }
    .back-to-top {
        bottom: calc(1.25rem + 56px) !important; /* Perfectly stacks above Translate on mobile too */
        right: 1.25rem !important;
    }
}
</style>

<div class="lp3aik-gt-wrapper notranslate">
    <!-- Panel / Popup Card -->
    <div class="lp3aik-gt-panel" id="lp3aikGTPanel">
        <div class="lp3aik-gt-header"><?php esc_html_e('Pilih Bahasa', 'lp3aik-umk'); ?></div>
        <div class="lp3aik-gt-list">
            <a href="#" data-gt-lang="id"><img src="https://cdn.gtranslate.net/flags/svg/id.svg" alt="Indonesia"> Indonesia</a>
            <a href="#" data-gt-lang="en"><img src="https://cdn.gtranslate.net/flags/svg/en.svg" alt="English"> English</a>
            <a href="#" data-gt-lang="ar"><img src="https://cdn.gtranslate.net/flags/svg/ar.svg" alt="Arabic"> العربية (Arabic)</a>
            <a href="#" data-gt-lang="zh-CN"><img src="https://cdn.gtranslate.net/flags/svg/zh-CN.svg" alt="Chinese"> 中文 (Chinese)</a>
            <a href="#" data-gt-lang="ja"><img src="https://cdn.gtranslate.net/flags/svg/ja.svg" alt="Japanese"> 日本語 (Japanese)</a>
        </div>
    </div>
    
    <!-- Floating Action Button -->
    <button class="lp3aik-gt-fab" id="lp3aikGTFab" aria-label="<?php esc_attr_e('Buka Menu Bahasa', 'lp3aik-umk'); ?>">
        <i class="fa-solid fa-language"></i>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fab = document.getElementById('lp3aikGTFab');
    const panel = document.getElementById('lp3aikGTPanel');
    if (!fab || !panel) return;
    
    // Toggle panel visibility via class interaction
    fab.addEventListener('click', function(e) {
        e.stopPropagation();
        panel.classList.toggle('show');
    });
    
    // Close panel smoothly when clicking outside the component boundaries
    document.addEventListener('click', function(e) {
        if (!panel.contains(e.target) && !fab.contains(e.target)) {
            panel.classList.remove('show');
        }
    });
    
    // Ensure the panel auto-collapses once a selection has been registered
    panel.querySelectorAll('a[data-gt-lang]').forEach(link => {
        link.addEventListener('click', function() {
            setTimeout(() => panel.classList.remove('show'), 400);
        });
    });

    // Global GTranslate settings initialization
    window.gtranslateSettings = {
        "default_language": "id",
        "languages": ["id","en","ar","zh-CN","ja"],
        "url_structure": "none",
        "native_language_names": true,
        "wrapper_selector": ".lp3aik-gt-wrapper"
    };
    
    // Dynamically deploy GTranslate engine script tags async
    var gtScript = document.createElement('script');
    gtScript.src = "https://cdn.gtranslate.net/widgets/latest/base.js";
    gtScript.defer = true;
    document.body.appendChild(gtScript);
});
</script>
