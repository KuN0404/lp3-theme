<?php
/**
 * Archive Template: Program / Layanan AIK
 *
 * Menampilkan daftar penuh semua Program AIK.
 * Mengikuti WordPress Template Hierarchy: archive-{post_type}.php
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php post_type_archive_title(); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section section--alt">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="grid-3">
            <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('template-parts/cards/card', 'program'); ?>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination mt-4">
            <?php
            echo paginate_links([
                'type'      => 'list',
                'prev_text' => '&lsaquo;',
                'next_text' => '&rsaquo;',
            ]);
            ?>
        </div>

        <?php else: ?>
        <?php
        // Default demo programs when no CPT data exists
        $default_programs = [
            ['fa-book-open',     'Pembinaan AIK Mahasiswa',  'Program pembinaan Al-Islam dan Kemuhammadiyahan wajib bagi seluruh mahasiswa baru.', 'Mahasiswa baru'],
            ['fa-mosque',        'Kajian Rutin Islami',       'Forum kajian keislaman mingguan yang terbuka untuk seluruh sivitas akademika.', 'Semua civitas'],
            ['fa-pen-to-square', 'Baitul Arqam Dosen',        'Program peningkatan pemahaman AIK khusus bagi dosen dan tenaga kependidikan.', 'Dosen & Tendik'],
            ['fa-graduation-cap','Wisuda AIK',                'Program sertifikasi dan pembekalan AIK bagi calon wisudawan universitas.', 'Calon wisudawan'],
            ['fa-handshake',     'Pengabdian Masyarakat AIK', 'Kegiatan pengabdian berbasis nilai Islam di lingkungan sekitar kampus.', 'Mahasiswa & dosen'],
            ['fa-book',          'Perpustakaan AIK',          'Pusat referensi literatur AIK dan Kemuhammadiyahan yang komprehensif.', 'Semua civitas'],
        ];
        ?>
        <div class="grid-3">
            <?php foreach ($default_programs as [$icon, $title, $desc, $sasaran]): ?>
            <div class="program-card">
                <div class="program-card__icon"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></div>
                <h3><?php echo esc_html($title); ?></h3>
                <p><?php echo esc_html($desc); ?></p>
                <div style="font-size:.8rem;color:var(--green-mid);margin-bottom:.75rem;">
                    <i class="fa-solid fa-user fa-sm"></i> <?php echo esc_html($sasaran); ?>
                </div>
                <span class="btn btn-outline btn-sm disabled"><?php _e('Detail Program','lp3aik-umk'); ?></span>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
