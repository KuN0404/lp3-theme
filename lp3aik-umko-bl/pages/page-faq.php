<?php
/*
Template Name: FAQ
*/
get_header();
?>

<section class="lp3aik-page-section py-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
        <div class="text-center mb-5 reveal">
            <span class="section-label">Bantuan</span>
            <h1 class="page-heading" style="padding-bottom:16px;">Pertanyaan yang Sering Diajukan</h1>
        </div>

                <div class="accordion lp3aik-faq reveal" id="faqAccordion">
                    <?php
                    $faqs = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => -1,
                        'category_name'  => 'faq',
                    ]);

                    $i = 0;
                    if ($faqs->have_posts()) :
                        while ($faqs->have_posts()) : $faqs->the_post();
                            $i++;
                            $collapse_id = 'faq-' . $i;
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr($collapse_id); ?>">
                                        <i class="bi bi-question-circle-fill me-3 text-gold"></i> <?php the_title(); ?>
                                    </button>
                                </h2>
                                <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><?php the_content(); ?></div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;

                    $defaults = [
                        ['q' => 'Apa itu LP3AIK?', 'a' => 'LP3AIK adalah Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan di Universitas Muhammadiyah Kotabumi. Lembaga ini bertanggung jawab atas pembinaan nilai-nilai Al-Islam dan internalisasi Kemuhammadiyahan di seluruh civitas akademika.'],
                        ['q' => 'Apa saja program yang ditawarkan?', 'a' => 'LP3AIK menyelenggarakan berbagai program pembinaan Al-Islam dan Kemuhammadiyahan, termasuk mata kuliah AIK, pelatihan, seminar, kegiatan keagamaan kampus, dan program pengembangan karakter islami.'],
                        ['q' => 'Bagaimana cara menghubungi LP3AIK?', 'a' => 'Anda dapat menghubungi kami melalui halaman <a href="' . esc_url(home_url('/contact/')) . '">Kontak</a> atau datang langsung ke kantor LP3AIK di Universitas Muhammadiyah Kotabumi.'],
                        ['q' => 'Siapa saja yang dapat mengikuti program LP3AIK?', 'a' => 'Program LP3AIK terbuka untuk seluruh civitas akademika Universitas Muhammadiyah Kotabumi: mahasiswa, dosen, dan tenaga kependidikan.'],
                        ['q' => 'Apakah mata kuliah AIK wajib untuk semua mahasiswa?', 'a' => 'Ya, mata kuliah Al-Islam dan Kemuhammadiyahan (AIK) merupakan mata kuliah wajib universitas yang harus diikuti oleh seluruh mahasiswa di semua program studi.'],
                    ];

                    if ($i === 0) {
                        foreach ($defaults as $idx => $faq):
                            $i++;
                            $collapse_id = 'faq-' . $i;
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo $i > 1 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapse_id); ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
                                        <i class="bi bi-question-circle-fill me-3 text-gold"></i> <?php echo esc_html($faq['q']); ?>
                                    </button>
                                </h2>
                                <div id="<?php echo esc_attr($collapse_id); ?>" class="accordion-collapse collapse <?php echo $i === 1 ? 'show' : ''; ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><?php echo wp_kses_post($faq['a']); ?></div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
