<?php
/**
 * Template Name: Visi dan Misi
 * Path: pages/page-vision-mission.php
 */
get_header();
?>

<!-- Page Hero (CTA Pattern Style) -->
<section class="lp3aik-cta-hero" style="background:linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));">
    <div class="cta-pattern-overlay" aria-hidden="true"></div>
    <div class="container text-center position-relative">
        <div class="reveal">
            <span class="section-label text-white-50">Komitmen & Tujuan</span>
            <h1 class="cta-heading text-white mb-3"><?php the_title(); ?></h1>
            <p class="text-white-75 mb-0 mx-auto" style="max-width:580px;">Arah pandang strategis dan misi perjuangan nilai lembaga kami ke masa depan.</p>
        </div>
    </div>
    <div class="archive-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 55" preserveAspectRatio="none">
            <path d="M0,28 C300,56 900,0 1200,28 L1200,55 L0,55 Z" class="shape-fill"></path>
        </svg>
    </div>
</section>

<section class="lp3aik-page-section py-section" style="padding-top:3rem;">
    <div class="container">
        <div class="row g-4">
            
            <!-- Main Content -->
            <div class="col-lg-8 reveal">
                <div class="bg-white p-4 p-md-5 rounded-4 border h-100" style="box-shadow: 0 15px 40px rgba(0,0,0,0.07); border-color: #f0f0f0 !important;">
                    <?php while (have_posts()) : the_post(); ?>
                    
                    <div class="page-content">
                        <?php if (!empty(trim(get_the_content()))): ?>
                            <?php the_content(); ?>
                        <?php else: ?>
                            
                            <!-- Modern VISI Box -->
                            <div class="visi-card mb-5 position-relative">
                                <div class="p-4 rounded-4" style="background:linear-gradient(135deg, rgba(var(--color-accent-rgb), 0.08), rgba(var(--color-accent-rgb), 0.02)); border-left:6px solid var(--color-accent); box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="p-2 rounded-3" style="background-color: rgba(var(--color-accent-rgb), 0.25); color: var(--color-accent);">
                                            <i class="bi bi-eye-fill fs-3"></i>
                                        </div>
                                        <h3 class="fw-bold text-primary mb-0" style="letter-spacing:-0.5px;">VISI</h3>
                                    </div>
                                    <p class="lead mb-0 text-dark font-italic" style="line-height:1.7; font-style:italic; font-size:1.2rem;">
                                        "Menjadi lembaga unggulan dalam pembinaan dan pengembangan pendidikan Al-Islam dan Kemuhammadiyahan yang melahirkan civitas akademika berakhlak mulia, berkemajuan, dan berdaya saing global."
                                    </p>
                                </div>
                            </div>

                            <!-- Modern MISI Box -->
                            <div class="misi-card">
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    <div class="p-2 rounded-3" style="background-color: rgba(var(--color-primary-rgb), 0.1); color: var(--color-primary);">
                                        <i class="bi bi-bullseye fs-3"></i>
                                    </div>
                                    <h3 class="fw-bold text-primary mb-0" style="letter-spacing:-0.5px;">MISI</h3>
                                </div>
                                
                                <div class="row g-3">
                                    <?php 
                                    $misi_items = [
                                        'Menyelenggarakan pembinaan AIK secara terpadu.',
                                        'Mengembangkan kurikulum dan bahan ajar AIK.',
                                        'Meningkatkan kualitas tenaga pengajar AIK.',
                                        'Menyelenggarakan kegiatan keagamaan dan sosial.',
                                        'Menjalin kerjasama pengembangan pendidikan AIK.'
                                    ];
                                    foreach ($misi_items as $index => $item) : ?>
                                    <div class="col-12">
                                        <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 border border-opacity-10 hover-shadow transition-base" style="border: 1px solid rgba(0,0,0,0.05);">
                                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold" style="width:32px; height:32px; font-size:0.9rem;">
                                                <?php echo $index + 1; ?>
                                            </div>
                                            <div class="pt-1 fw-medium text-secondary" style="font-size:1.05rem;">
                                                <?php echo $item; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- SIDEBAR -->
            <div class="col-lg-4 mt-lg-0 reveal-right">
                <div class="lp3aik-news-sidebar position-sticky" style="top:100px;">
                    <div class="sidebar-widget border" style="box-shadow: 0 15px 40px rgba(0,0,0,0.07); border-color: #f0f0f0 !important;">
                        <h5 class="sidebar-widget-title">
                            <i class="bi bi-info-circle-fill"></i> Informasi Terkait
                        </h5>
                        <div class="sidebar-widget-body p-0">
                            <ul class="sidebar-cat-list">
                                <li>
                                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="p-3">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="bi bi-person-fill text-primary"></i> Deskripsi Lembaga
                                        </span>
                                        <i class="bi bi-chevron-right small text-muted"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/organization/')); ?>" class="p-3">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="bi bi-diagram-3-fill text-primary"></i> Struktur Organisasi
                                        </span>
                                        <i class="bi bi-chevron-right small text-muted"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/programs/')); ?>" class="p-3">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="bi bi-bookmark-star-fill text-primary"></i> Program Lembaga
                                        </span>
                                        <i class="bi bi-chevron-right small text-muted"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Decorative Banner below sidebar -->
                    <div class="p-4 bg-dark text-white rounded-4 mt-4 position-relative overflow-hidden shadow-sm" 
                         style="background: linear-gradient(rgba(var(--color-primary-rgb), 0.9), rgba(var(--color-primary-rgb), 0.95)), url('<?php echo get_template_directory_uri(); ?>/assets/img/pattern.png');">
                         <div style="position:absolute;right:-10px;top:-10px;opacity:0.15;font-size:6rem;transform:rotate(-15deg);">
                            <i class="bi bi-quote"></i>
                         </div>
                         <p class="font-italic mb-0 small" style="line-height:1.6;">"Bekerja keraslah di jalan Allah dengan landasan iman yang kuat, niscaya keberhasilan sejati menyertaimu."</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
