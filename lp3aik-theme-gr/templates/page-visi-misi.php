<?php
/**
 * Template Name: Visi & Misi
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php the_title(); ?></h1>
        <div class="breadcrumb"><?php lp3aik_breadcrumb(); ?></div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">

                <!-- Visi -->
                <div class="visi-misi-block mb-5">
                    <div class="visi-misi-block__icon">
                        <i class="fa-solid fa-eye" aria-hidden="true"></i>
                    </div>
                    <div class="visi-misi-block__body">
                        <h2><?php _e('Visi', 'lp3aik-umk'); ?></h2>
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_visi',
                            __('Menjadi lembaga terdepan dalam pengkajian, pengembangan, dan pengamalan Al-Islam dan Kemuhammadiyahan di lingkungan Universitas Muhammadiyah Kotabumi guna mewujudkan sivitas akademika yang berakhlak mulia.', 'lp3aik-umk')
                        )); ?></p>
                    </div>
                </div>

                <!-- Misi -->
                <div class="visi-misi-block mb-5">
                    <div class="visi-misi-block__icon visi-misi-block__icon--accent">
                        <i class="fa-solid fa-bullseye" aria-hidden="true"></i>
                    </div>
                    <div class="visi-misi-block__body">
                        <h2><?php _e('Misi', 'lp3aik-umk'); ?></h2>
                        <ul class="misi-list">
                            <?php
                            $misi_raw = lp3aik_opt('lp3aik_misi', "Mengintegrasikan nilai AIK ke dalam seluruh program akademik\nMenyelenggarakan program pembinaan AIK secara terstruktur\nMembangun kerjasama dengan lembaga AIK Muhammadiyah\nMeningkatkan kualitas SDM pembina AIK");
                            foreach (explode("\n", $misi_raw) as $line):
                                $line = trim($line);
                                if ($line): ?>
                                <li><?php echo esc_html($line); ?></li>
                            <?php endif; endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Tujuan -->
                <div class="visi-misi-block">
                    <div class="visi-misi-block__icon visi-misi-block__icon--dark">
                        <i class="fa-solid fa-flag-checkered" aria-hidden="true"></i>
                    </div>
                    <div class="visi-misi-block__body">
                        <h2><?php _e('Tujuan', 'lp3aik-umk'); ?></h2>
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tujuan',
                            __('Terwujudnya sivitas akademika yang memiliki pemahaman dan pengamalan Al-Islam dan Kemuhammadiyahan dalam kehidupan sehari-hari.', 'lp3aik-umk')
                        )); ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
