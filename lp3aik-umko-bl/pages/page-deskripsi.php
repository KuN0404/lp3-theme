<?php get_header(); ?>

<section class="lp3aik-page-section py-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php while (have_posts()) : the_post(); ?>
                <div class="reveal">
                    <h1 class="section-title-bar"><?php the_title(); ?></h1>
                    <div class="page-content mt-4">
                        <?php if (!empty(get_the_content())): ?>
                            <?php the_content(); ?>
                        <?php else: ?>
                            <p>LP3AIK (Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan) adalah satuan kerja di lingkungan Universitas Muhammadiyah Kotabumi yang bertanggung jawab atas pembinaan, pengembangan, dan pengkajian nilai-nilai Al-Islam serta internalisasi nilai-nilai Kemuhammadiyahan di seluruh civitas akademika.</p>
                            <p>Lembaga ini mengkoordinasi mata kuliah wajib AIK (Al-Islam &amp; Kemuhammadiyahan) di semua program studi, menyelenggarakan pelatihan, seminar, dan kegiatan keagamaan kampus, serta menjamin mutu nilai-nilai islami dalam tata kelola dan budaya kampus.</p>
                            <p>Beberapa universitas Muhammadiyah menyebut lembaga ini sebagai LP3I (Lembaga Pembina dan Pengembang Pendidikan Islam) atau LPIK, namun fungsinya identik. Dokumen ini menggunakan nama resmi LP3AIK dan dapat disesuaikan dengan nama resmi di UM Kotabumi.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="lp3aik-sidebar">
                    <div class="widget reveal">
                        <h5 class="widget-title">Informasi</h5>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/vision-mission/')); ?>"><i class="bi bi-eye me-2 text-gold"></i> Visi dan Misi</a></li>
                            <li><a href="<?php echo esc_url(home_url('/organization/')); ?>"><i class="bi bi-diagram-3 me-2 text-gold"></i> Struktur Organisasi</a></li>
                            <li><a href="<?php echo esc_url(home_url('/programs/')); ?>"><i class="bi bi-book me-2 text-gold"></i> Program</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
