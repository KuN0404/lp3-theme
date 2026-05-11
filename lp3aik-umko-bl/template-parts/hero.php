<?php
$tagline = lp3aik_get_setting('tagline');
?>
<section id="hero" class="lp3aik-hero">
    <div class="hero-deco hero-deco-1"></div>
    <div class="hero-deco hero-deco-2"></div>
    <div class="hero-deco hero-deco-3"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8 reveal">
                <span class="hero-bismillah">بسم الله الرحمن الرحيم</span>
                <h1 class="hero-heading">
                    <span class="highlight">LP3AIK</span><br>
                    <?php bloginfo('name'); ?>
                </h1>
                <p class="hero-sub">Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan — Universitas Muhammadiyah Kotabumi</p>
                <?php if ($tagline): ?>
                <p class="hero-tagline"><i class="bi bi-quote"></i> <?php echo esc_html($tagline); ?></p>
                <?php endif; ?>
                <div class="hero-buttons">
                    <a href="#program-unggulan" class="btn btn-accent btn-lg"><i class="bi bi-book me-2"></i> Program Kami</a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline-light btn-lg"><i class="bi bi-telephone me-2"></i> Hubungi Kami</a>
                </div>
                <div class="hero-stats-row">
                    <div class="hero-stat-item">
                        <div class="hero-stat-num">500+</div>
                        <div class="hero-stat-label">Mahasiswa Aktif</div>
                    </div>
                    <div class="hero-stat-item">
                        <div class="hero-stat-num">15</div>
                        <div class="hero-stat-label">Program</div>
                    </div>
                    <div class="hero-stat-item">
                        <div class="hero-stat-num">50+</div>
                        <div class="hero-stat-label">Dosen Pengajar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
