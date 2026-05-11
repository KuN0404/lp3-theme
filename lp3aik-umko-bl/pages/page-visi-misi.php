<?php
/*
Template Name: Visi dan Misi
*/
get_header();
?>

<section class="lp3aik-page-section py-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php while (have_posts()) : the_post(); ?>

        <div class="reveal">

            <h1 class="section-title-bar">
                <?php the_title(); ?>
            </h1>

            <div class="page-content mt-4">

                <?php if (!empty(trim(get_the_content()))): ?>

                    <?php the_content(); ?>

                <?php else: ?>

                    <div class="visi-card p-4 mb-4 rounded"
                        style="background:var(--color-surface);border-left:4px solid var(--color-accent);">

                        <h3>
                            <i class="bi bi-eye-fill me-2 text-gold"></i>
                            Visi
                        </h3>

                        <p>
                            Menjadi lembaga unggulan dalam pembinaan dan pengembangan
                            pendidikan Al-Islam dan Kemuhammadiyahan yang melahirkan
                            civitas akademika berakhlak mulia, berkemajuan,
                            dan berdaya saing global.
                        </p>

                    </div>

                    <div class="misi-card p-4 rounded"
                        style="background:var(--color-surface);border-left:4px solid var(--color-primary);">

                        <h3>
                            <i class="bi bi-bullseye me-2 text-gold"></i>
                            Misi
                        </h3>

                        <ol class="mb-0">
                            <li class="mb-2">
                                Menyelenggarakan pembinaan AIK secara terpadu.
                            </li>

                            <li class="mb-2">
                                Mengembangkan kurikulum dan bahan ajar AIK.
                            </li>

                            <li class="mb-2">
                                Meningkatkan kualitas tenaga pengajar AIK.
                            </li>

                            <li class="mb-2">
                                Menyelenggarakan kegiatan keagamaan dan sosial.
                            </li>

                            <li>
                                Menjalin kerjasama pengembangan pendidikan AIK.
                            </li>
                        </ol>

                    </div>

                <?php endif; ?>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

    <!-- SIDEBAR -->
    <div class="col-lg-4 mt-5 mt-lg-0">

        <div class="lp3aik-sidebar">

            <div class="widget reveal">

                <h5 class="widget-title">
                    Informasi
                </h5>

                <ul>

                    <li>
                        <a href="<?php echo esc_url(home_url('/about/')); ?>">
                            <i class="bi bi-person me-2 text-gold"></i>
                            Tentang LP3AIK
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(home_url('/organization/')); ?>">
                            <i class="bi bi-diagram-3 me-2 text-gold"></i>
                            Struktur Organisasi
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo esc_url(home_url('/programs/')); ?>">
                            <i class="bi bi-book me-2 text-gold"></i>
                            Program
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>
    </div>
</section>

<?php get_footer(); ?>
