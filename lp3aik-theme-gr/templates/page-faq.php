<?php
/**
 * Template Name: Halaman FAQ
 *
 * Halaman interaktif berkelas tinggi untuk Tanya Jawab Umum (FAQ) mengenai LP3AIK.
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

<section class="faq-section py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="faq-header text-center mb-5">
                    <div class="faq-badge mb-3"><i class="fa-solid fa-circle-question me-2"></i>Bantuan & Pusat Informasi</div>
                    <h2 class="faq-title font-heading fw-bold text-primary-dark">Pertanyaan Yang Sering Diajukan</h2>
                    <p class="text-muted">Temukan jawaban cepat untuk berbagai pertanyaan umum seputar program, sertifikasi, dan aktivitas di LP3AIK UMK.</p>
                </div>

                <div class="faq-container">
                    <?php
                    $faqs = [
                        [
                            'q' => 'Apa tugas dan peran utama dari LP3AIK UMK?',
                            'a' => 'LP3AIK (Lembaga Pengkajian dan Pengamalan Islam dan Kemuhammadiyahan) Universitas Muhammadiyah Kudus bertugas sebagai pusat pengembangan, pengkajian, dan pembinaan nilai-nilai Al-Islam dan Kemuhammadiyahan bagi seluruh civitas akademika baik mahasiswa, dosen, maupun tenaga kependidikan.'
                        ],
                        [
                            'q' => 'Bagaimana alur pendaftaran dan ujian Sertifikasi BTA (Baca Tulis Al-Qur\'an)?',
                            'a' => 'Mahasiswa dapat mengunduh formulir pendaftaran di menu Unduhan, melengkapi syarat administrasi, lalu mendaftar melalui portal akademik atau langsung ke kantor LP3AIK. Jadwal ujian akan diumumkan secara berkala di papan pengumuman digital dan halaman Berita situs ini.'
                        ],
                        [
                            'q' => 'Apakah kegiatan Baitul Arqom wajib diikuti seluruh mahasiswa?',
                            'a' => 'Ya, Baitul Arqom merupakan salah satu syarat kelulusan akademik utama di Universitas Muhammadiyah Kudus. Kegiatan ini bertujuan memperkuat karakter kepribadian Islam, kepemimpinan, dan militansi kemuhammadiyahan mahasiswa.'
                        ],
                        [
                            'q' => 'Bagaimana jika saya kehilangan sertifikat pembinaan AIK?',
                            'a' => 'Bagi mahasiswa yang kehilangan sertifikat (BTA/Mentoring/Baitul Arqom), Anda dapat mengajukan cetak ulang di kantor LP3AIK dengan membawa Surat Pernyataan Kehilangan dan fotokopi bukti kelulusan kegiatan terkait.'
                        ],
                        [
                            'q' => 'Di mana lokasi kantor operasional LP3AIK UMK?',
                            'a' => 'Kantor operasional LP3AIK UMK berlokasi di Gedung Rektorat/Pusat Lt. 2, Kampus Universitas Muhammadiyah Kudus. Jam pelayanan operasional kami aktif pada hari Senin - Sabtu, pukul 08.00 - 15.00 WIB.'
                        ]
                    ];

                    foreach ($faqs as $index => $faq):
                        $is_first = ($index === 0);
                    ?>
                        <div class="faq-card <?php echo $is_first ? 'active' : ''; ?>">
                            <button class="faq-trigger" aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>">
                                <span class="faq-q-text"><?php echo esc_html($faq['q']); ?></span>
                                <span class="faq-icon">
                                    <i class="fa-solid fa-plus"></i>
                                </span>
                            </button>
                            <div class="faq-content" style="<?php echo $is_first ? 'max-height: 500px; padding-bottom: 20px;' : ''; ?>">
                                <div class="faq-inner">
                                    <p><?php echo esc_html($faq['a']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="faq-footer text-center mt-5">
                    <div class="faq-footer-box p-4 border rounded-3 bg-white shadow-sm">
                        <h5 class="fw-bold mb-2">Masih memiliki pertanyaan lain?</h5>
                        <p class="text-muted mb-3">Jika Anda tidak menemukan jawaban di atas, silakan hubungi staf kami secara langsung.</p>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary rounded-pill px-4 py-2">
                            <i class="fa-solid fa-paper-plane me-2"></i>Hubungi Kami Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* FAQ Page Advanced Styles */
.faq-section {
    background-color: #f8fafc !important;
}
.faq-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(26, 122, 60, 0.08);
    color: var(--color-primary);
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}
.faq-title {
    font-size: 2.2rem;
    margin-bottom: 12px;
}

.faq-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.faq-card {
    background: var(--color-white);
    border: 1px solid rgba(0, 0, 0, 0.06);
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.faq-card:hover {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
}
.faq-card.active {
    border-color: var(--color-primary-light);
    box-shadow: 0 12px 35px rgba(26, 122, 60, 0.08);
}

.faq-trigger {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: none;
    border: none;
    padding: 22px 26px;
    cursor: pointer;
    text-align: left;
    outline: none;
    transition: all 0.3s ease;
}
.faq-q-text {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--color-primary-dark);
    padding-right: 20px;
    line-height: 1.4;
    transition: color 0.3s ease;
}
.faq-card.active .faq-q-text {
    color: var(--color-primary);
}

.faq-icon {
    width: 36px;
    height: 36px;
    background: #f1f5f9;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-muted);
    font-size: 0.9rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
}
.faq-card:hover .faq-icon {
    background: rgba(26, 122, 60, 0.08);
    color: var(--color-primary);
}
.faq-card.active .faq-icon {
    background: var(--color-primary);
    color: var(--color-white);
    transform: rotate(45deg); /* Converts plus to cross */
}

.faq-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s cubic-bezier(0.16, 1, 0.3, 1), padding 0.4s ease;
    padding: 0 26px;
}

.faq-inner {
    color: #64748b;
    font-size: 1rem;
    line-height: 1.7;
}
.faq-inner p {
    margin: 0;
}

.faq-footer-box {
    background: var(--color-white) !important;
    border: 1.5px dashed #e2e8f0 !important;
    border-radius: 20px !important;
}

/* Mobile Adjustments */
@media (max-width: 768px) {
    .faq-title {
        font-size: 1.75rem;
    }
    .faq-trigger {
        padding: 18px 20px;
    }
    .faq-q-text {
        font-size: 1rem;
    }
    .faq-content {
        padding: 0 20px;
    }
    .faq-icon {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqCards = document.querySelectorAll('.faq-card');

    faqCards.forEach(card => {
        const trigger = card.querySelector('.faq-trigger');
        const content = card.querySelector('.faq-content');

        trigger.addEventListener('click', () => {
            const isActive = card.classList.contains('active');

            // Close all other FAQs for smooth accordion accordion behavior
            faqCards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.remove('active');
                    otherCard.querySelector('.faq-trigger').setAttribute('aria-expanded', 'false');
                    otherCard.querySelector('.faq-content').style.maxHeight = '0';
                    otherCard.querySelector('.faq-content').style.paddingBottom = '0';
                }
            });

            // Toggle current FAQ
            if (isActive) {
                card.classList.remove('active');
                trigger.setAttribute('aria-expanded', 'false');
                content.style.maxHeight = '0';
                content.style.paddingBottom = '0';
            } else {
                card.classList.add('active');
                trigger.setAttribute('aria-expanded', 'true');
                content.style.maxHeight = content.scrollHeight + 30 + 'px'; // Buffer for padding
                content.style.paddingBottom = '20px';
            }
        });
    });
});
</script>

<?php get_footer(); ?>
