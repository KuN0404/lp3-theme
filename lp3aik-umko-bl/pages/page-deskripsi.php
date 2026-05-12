<?php
/**
 * Template: Deskripsi Singkat
 * Path: pages/page-deskripsi.php
 */
get_header(); 
?>

<!-- Page Hero (CTA Pattern Style) -->
<section class="lp3aik-cta-hero" style="background:linear-gradient(135deg, var(--color-primary-dark), var(--color-primary));">
    <div class="cta-pattern-overlay" aria-hidden="true"></div>
    <div class="container text-center position-relative">
        <div class="reveal">
            <span class="section-label text-white-50">Profil Lembaga</span>
            <h1 class="cta-heading text-white mb-3"><?php the_title(); ?></h1>
            <p class="text-white-75 mb-0 mx-auto" style="max-width:580px;">Mengenal lebih dekat lembaga pembinaan nilai keislaman dan kemuhammadiyahan secara terpadu.</p>
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
            <!-- Main Content Area -->
            <div class="col-lg-8 reveal">
                <div class="bg-white p-4 p-md-5 rounded-4 border h-100" style="box-shadow: 0 15px 40px rgba(0,0,0,0.07); border-color: #f0f0f0 !important;">
                    <?php while (have_posts()) : the_post(); ?>
                    
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                        <div class="p-3 rounded-circle" style="background-color: rgba(var(--color-primary-rgb), 0.1); color: var(--color-primary); width:60px;height:60px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-shield-check fs-3"></i>
                        </div>
                        <div>
                            <h2 class="h4 fw-bold text-primary mb-1">Tentang LP3AIK</h2>
                            <p class="text-muted small mb-0">Nilai Keislaman, Integritas & Kemuhammadiyahan</p>
                        </div>
                    </div>

                    <div class="page-content" style="line-height:1.8; color:var(--color-text); font-size:1.05rem;">
                        <?php if (!empty(trim(get_the_content()))): ?>
                            <?php the_content(); ?>
                        <?php else: ?>
                            <p class="lead text-secondary mb-4">Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan (LP3AIK) adalah jantung pembentukan karakter di lingkungan civitas akademika.</p>
                            
                            <p>LP3AIK merupakan satuan kerja khusus di lingkungan <strong>Universitas Muhammadiyah Kotabumi</strong> yang mengemban amanah strategis dalam melakukan pembinaan, pengembangan, serta internalisasi nilai-nilai islami secara menyeluruh.</p>
                            
                            <div class="row g-3 my-4">
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 border-top border-primary border-4 h-100 text-center shadow-sm">
                                        <i class="bi bi-journal-bookmark-fill fs-2 text-primary mb-2 d-block"></i>
                                        <h6 class="fw-bold">Akademik</h6>
                                        <p class="small mb-0">Koordinasi mata kuliah wajib AIK terpadu.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 border-top border-accent border-4 h-100 text-center shadow-sm">
                                        <i class="bi bi-people-fill fs-2 mb-2 d-block text-accent" style="color:var(--color-accent) !important;"></i>
                                        <h6 class="fw-bold">Pembinaan</h6>
                                        <p class="small mb-0">Kajian keislaman rutin civitas akademika.</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 border-top border-success border-4 h-100 text-center shadow-sm">
                                        <i class="bi bi-patch-check-fill fs-2 text-success mb-2 d-block"></i>
                                        <h6 class="fw-bold">Budaya</h6>
                                        <p class="small mb-0">Menjamin tata kelola bernuansa Islami.</p>
                                    </div>
                                </div>
                            </div>

                            <p>Lembaga ini menjembatani visi besar persyarikatan dengan kurikulum modern, memastikan bahwa setiap lulusan tidak hanya unggul secara intelektual, melainkan juga berintegritas tinggi dengan landasan akhlak mulia.</p>
                        <?php endif; ?>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Sidebar Navigation Area -->
            <div class="col-lg-4 mt-lg-0 reveal-right">
                <div class="lp3aik-news-sidebar position-sticky" style="top:100px;">
                    <div class="sidebar-widget border" style="box-shadow: 0 15px 40px rgba(0,0,0,0.07); border-color: #f0f0f0 !important;">
                        <h5 class="sidebar-widget-title">
                            <i class="bi bi-info-circle-fill"></i> Informasi Terkait
                        </h5>
                        <div class="sidebar-widget-body p-0">
                            <ul class="sidebar-cat-list">
                                <li>
                                    <a href="<?php echo esc_url(home_url('/vision-mission/')); ?>" class="p-3">
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="bi bi-eye-fill text-primary"></i> Visi dan Misi
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

                    <!-- Quick Contact Info Sidebar Banner -->
                    <div class="p-4 bg-primary text-white rounded-4 mt-4 position-relative overflow-hidden shadow">
                        <div style="position:absolute;right:-20px;bottom:-20px;opacity:0.1;font-size:8rem;">
                            <i class="bi bi-envelope-paper-fill"></i>
                        </div>
                        <h6 class="fw-bold mb-2">Punya Pertanyaan?</h6>
                        <p class="small opacity-75">Hubungi kontak resmi kami untuk informasi detail mengenai program kami.</p>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-light btn-sm fw-bold px-3">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
