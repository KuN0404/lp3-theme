<?php
/**
 * Template Name: Halaman Visi Misi
 *
 * Halaman penuh Visi, Misi, dan Tujuan LP3AIK.
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Konten dari WP Editor -->
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="entry-content"
                    style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);margin-bottom:2rem;">
                    <?php the_content(); ?>
                </div>
                <?php endwhile; endif; ?>

                <!-- Visi Misi Tabs -->
                <div class="about__visi-misi"
                    style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                    <div class="visi-misi-tabs">
                        <button class="tab-btn active" data-tab="visi"><?php _e('Visi','lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="misi"><?php _e('Misi','lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="tujuan"><?php _e('Tujuan','lp3aik-umk'); ?></button>
                    </div>
                    <div class="tab-panel active" id="tab-visi">
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_visi', 'Menjadi lembaga terdepan dalam pengkajian, pengembangan, dan pengamalan Al-Islam dan Kemuhammadiyahan di lingkungan Universitas Muhammadiyah Kotabumi guna mewujudkan sivitas akademika yang berakhlak mulia.')); ?>
                        </p>
                    </div>
                    <div class="tab-panel" id="tab-misi">
                        <ul class="misi-list">
                            <?php
                            $misi = lp3aik_opt('lp3aik_misi', "Mengintegrasikan nilai AIK ke dalam seluruh program akademik\nMenyelenggarakan program pembinaan AIK secara terstruktur\nMengembangkan kajian Islam yang moderat dan berkemajuan\nMemperkuat pengamalan nilai Kemuhammadiyahan dalam kehidupan kampus\nMembangun kerjasama dengan lembaga AIK Persyarikatan");
                            foreach (explode("\n", trim($misi)) as $item):
                                if (trim($item)):
                            ?>
                            <li><?php echo esc_html(trim($item)); ?></li>
                            <?php endif; endforeach; ?>
                        </ul>
                    </div>
                    <div class="tab-panel" id="tab-tujuan">
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tujuan', 'Terwujudnya sivitas akademika Universitas Muhammadiyah Kotabumi yang memiliki pemahaman, penghayatan, dan pengamalan Al-Islam dan Kemuhammadiyahan secara konsisten dan berkelanjutan.')); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>