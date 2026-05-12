<?php
/**
 * Component: Modern Floating Translate
 * Matches requested modern FAB + rounded card design.
 */
?>
<style>
.lp3aik-gt-wrapper {
    position: fixed;
    bottom: 25px;
    right: 25px;
    z-index: 99999; /* Ensure supreme visibility */
    font-family: 'Inter', 'Lato', 'Segoe UI', sans-serif;
}
.lp3aik-gt-fab {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background-color: var(--color-primary); /* Menggunakan warna brand utama */
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 24px rgba(var(--color-primary-rgb), 0.35);
    cursor: pointer;
    border: none;
    outline: none;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    padding: 0;
}
.lp3aik-gt-fab:hover {
    transform: scale(1.1) rotate(5deg);
    background-color: var(--color-primary-dark);
    box-shadow: 0 10px 30px rgba(var(--color-primary-rgb), 0.45);
}
.lp3aik-gt-fab i {
    font-size: 24px;
    line-height: 1;
}
.lp3aik-gt-panel {
    position: absolute;
    bottom: 75px;
    right: 0;
    width: 270px;
    background: white;
    border-radius: 24px; /* Ultra rounded like screenshot */
    box-shadow: 0 15px 40px rgba(0,0,0,0.16);
    overflow: hidden;
    opacity: 0;
    visibility: hidden;
    transform: translateY(15px) scale(0.9);
    transform-origin: bottom right;
    pointer-events: none;
    transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
    border: 1px solid rgba(0,0,0,0.03);
}
.lp3aik-gt-panel.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
    pointer-events: auto;
}
.lp3aik-gt-header {
    padding: 22px 24px 10px;
    font-size: 12px;
    font-weight: 800;
    text-transform: uppercase;
    color: #8c97a8;
    letter-spacing: 0.8px;
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
    color: #333;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.2s ease;
    border: none !important; /* Clean styling */
}
.lp3aik-gt-list a:hover {
    background-color: var(--color-surface-alt);
    color: var(--color-primary);
}
.lp3aik-gt-list img {
    width: 22px;
    height: 16px;
    object-fit: cover;
    border-radius: 3px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.15);
}
/* GTranslate Core Overrides for zero visual clutter */
#google_translate_element2, .skiptranslate, iframe.skiptranslate {
    display: none !important;
}
body {
    top: 0px !important;
}
</style>

<div class="lp3aik-gt-wrapper">
    <!-- Panel / Popup -->
    <div class="lp3aik-gt-panel" id="lp3aikGTPanel">
        <div class="lp3aik-gt-header">TERJEMAHKAN KE</div>
        <div class="lp3aik-gt-list">
            <a href="#" data-gt-lang="id" class="notranslate"><img src="https://cdn.gtranslate.net/flags/svg/id.svg" alt="Indonesia"> Bahasa Indonesia</a>
            <a href="#" data-gt-lang="en" class="notranslate"><img src="https://cdn.gtranslate.net/flags/svg/en.svg" alt="English"> English</a>
            <a href="#" data-gt-lang="ar" class="notranslate"><img src="https://cdn.gtranslate.net/flags/svg/ar.svg" alt="Arabic"> العربية (Arabic)</a>
            <a href="#" data-gt-lang="zh-CN" class="notranslate"><img src="https://cdn.gtranslate.net/flags/svg/zh-CN.svg" alt="Chinese"> 中文 (Mandarin)</a>
            <a href="#" data-gt-lang="ja" class="notranslate"><img src="https://cdn.gtranslate.net/flags/svg/ja.svg" alt="Japanese"> 日本語 (Japanese)</a>
        </div>
    </div>
    
    <!-- Floating Action Button -->
    <button class="lp3aik-gt-fab" id="lp3aikGTFab" aria-label="Buka Menu Terjemahan">
        <i class="bi bi-translate"></i>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fab = document.getElementById('lp3aikGTFab');
    const panel = document.getElementById('lp3aikGTPanel');
    
    // Interaksi Buka/Tutup Panel
    fab.addEventListener('click', function(e) {
        e.stopPropagation();
        panel.classList.toggle('show');
    });
    
    // Tutup jika klik sembarang di luar komponen
    document.addEventListener('click', function(e) {
        if (!panel.contains(e.target) && !fab.contains(e.target)) {
            panel.classList.remove('show');
        }
    });
    
    // Tutup panel setelah memilih bahasa
    panel.querySelectorAll('a[data-gt-lang]').forEach(link => {
        link.addEventListener('click', function() {
            setTimeout(() => panel.classList.remove('show'), 500);
        });
    });

    // Inisialisasi konfigurasi internal GTranslate 
    window.gtranslateSettings = {
        "default_language": "id",
        "languages": ["id","en","ar","zh-CN","ja"],
        "url_structure": "none",
        "native_language_names": true,
        "wrapper_selector": ".lp3aik-gt-wrapper"
    };
    
    // Memuat script internal engine milik GTranslate secara dinamis
    var gtScript = document.createElement('script');
    gtScript.src = "https://cdn.gtranslate.net/widgets/latest/base.js";
    gtScript.defer = true;
    document.body.appendChild(gtScript);
});
</script>
