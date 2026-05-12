# LP3AIK Theme Template Files Bundle

<!-- START FILE: 404.php -->
## File: `404.php`

```php
<?php
/**
 * 404 Template — Halaman Tidak Ditemukan
 *
 * @package lp3aik-umk
 */

get_header();
?>

<div class="page-hero">
    <div class="container">
        <h1><?php _e('Halaman Tidak Ditemukan', 'lp3aik-umk'); ?></h1>
        <div class="breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Beranda', 'lp3aik-umk'); ?></a>
            <span class="sep">›</span>
            <span><?php _e('404', 'lp3aik-umk'); ?></span>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center" style="max-width:540px;margin:0 auto;padding:3rem 0;">
            <div style="font-size:6rem;color:var(--green-pale);margin-bottom:1rem;line-height:1;">
                <i class="fa-solid fa-compass" style="animation:spin404 4s linear infinite;display:inline-block;"></i>
            </div>
            <h2 style="color:var(--green-dark);margin-bottom:1rem;"><?php _e('Oops! Halaman tidak ditemukan', 'lp3aik-umk'); ?></h2>
            <p style="color:var(--text-secondary);margin-bottom:2rem;">
                <?php _e('Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada. Silakan gunakan navigasi atau pencarian untuk menemukan yang Anda butuhkan.', 'lp3aik-umk'); ?>
            </p>
            <div class="d-flex justify-content-center flex-wrap gap-3">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <i class="fa-solid fa-home me-1"></i> <?php _e('Kembali ke Beranda', 'lp3aik-umk'); ?>
                </a>
                <button class="btn btn-outline" onclick="document.getElementById('search-toggle').click();">
                    <i class="fa-solid fa-magnifying-glass me-1"></i> <?php _e('Cari', 'lp3aik-umk'); ?>
                </button>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes spin404 { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

<?php get_footer(); ?>

```
<!-- END FILE: 404.php -->

---

<!-- START FILE: archive.php -->
## File: `archive.php`

```php
<?php
/**
 * Archive Template (Category, Tag, Date, Author)
 *
 * Menampilkan daftar post untuk arsip kategori, tag, tanggal, dan penulis.
 * Mengikuti WordPress Template Hierarchy: archive.php
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php the_archive_title(); ?></h1>
        <?php if (get_the_archive_description()): ?>
        <p style="color:rgba(255,255,255,.7);margin-top:.5rem;"><?php the_archive_description(); ?></p>
        <?php endif; ?>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <!-- Posts -->
            <main id="main-content">
                <?php if (have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while (have_posts()): the_post(); ?>
                    <article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card__image">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:180px;">
                                    <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card__body">
                            <?php if ($cats = get_the_category()): ?>
                                <div class="card__tag"><?php echo esc_html($cats[0]->name); ?></div>
                            <?php endif; ?>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <div class="card__meta">
                                <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
                                <span><i class="fa-solid fa-user-pen fa-sm"></i> <?php the_author(); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    echo paginate_links([
                        'type'      => 'list',
                        'prev_text' => '&lsaquo;',
                        'next_text' => '&rsaquo;',
                    ]);
                    ?>
                </div>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);"><i class="fa-solid fa-inbox"></i></div>
                    <h3><?php _e('Belum ada postingan','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);"><?php _e('Postingan atau berita tidak ditemukan.','lp3aik-umk'); ?></p>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside>
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru','lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5]);
                    while ($recent->have_posts()): $recent->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="news-item-small mb-3" style="display:flex;gap:1rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">
                        <div class="news-item-small__image" style="width:70px;height:60px;flex-shrink:0;">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;border-radius:4px;">
                                    <i class="fa-solid fa-newspaper fa-sm" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="news-item-small__title" style="font-size:0.85rem;font-weight:600;line-height:1.3;margin-bottom:0.25rem;"><?php the_title(); ?></div>
                            <div class="news-item-small__date" style="font-size:0.75rem;color:var(--text-muted);"><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
                        </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <div class="sidebar-widget">
                    <h4><?php _e('Kategori','lp3aik-umk'); ?></h4>
                    <ul class="footer-links" style="gap:.4rem;">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>

```
<!-- END FILE: archive.php -->

---

<!-- START FILE: footer.php -->
## File: `footer.php`

```php
</div><!-- #page -->

<?php get_template_part('template-parts/components/quote-banner'); ?>

<!-- SITE FOOTER -->
<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">

                <!-- Brand -->
                <div class="footer-brand">
                    <div class="site-logo mb-3">
                        <?php if (has_custom_logo()): the_custom_logo(); else: ?>
                            <div class="d-flex align-items-center justify-content-center" style="width:44px;height:44px;background:var(--green-primary);border-radius:50%;font-size:1.3rem;color:var(--white);">
                                <i class="fa-solid fa-mosque"></i>
                            </div>
                        <?php endif; ?>
                        <div class="logo-text-group">
                            <div class="logo-main">LP3AIK</div>
                            <div class="logo-sub">Universitas Muhammadiyah Kotabumi</div>
                        </div>
                    </div>
                    <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tagline', 'Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — berkomitmen membangun sivitas akademika yang berkarakter Islami.')); ?></p>

                    <!-- Social -->
                    <div class="footer-social">
                        <?php foreach (lp3aik_social_links() as $social): ?>
                            <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($social['label']); ?>">
                                <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Navigasi -->
                <div class="footer-col">
                    <h4><?php _e('Navigasi', 'lp3aik-umk'); ?></h4>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-1',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-links">';
                            $links = ['/' => 'Beranda', '/profil' => 'Profil', '/program' => 'Program', '/visi-misi' => 'Visi Misi', '/struktur-organisasi' => 'Struktur Organisasi'];
                            foreach ($links as $slug => $name) {
                                echo '<li><a href="' . esc_url(home_url($slug)) . '">' . esc_html($name) . '</a></li>';
                            }
                            echo '</ul>';
                        }
                    ]);
                    ?>
                </div>

                <!-- Program -->
                <div class="footer-col">
                    <h4><?php _e('Program AIK', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_program') ?: home_url('/program')); ?>"><?php _e('Semua Program','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/berita')); ?>"><?php _e('Berita & Pengumuman','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri')); ?>"><?php _e('Galeri Kegiatan','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_unduhan') ?: home_url('/unduhan')); ?>"><?php _e('Unduhan / File','lp3aik-umk'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/kontak')); ?>"><?php _e('Hubungi Kami','lp3aik-umk'); ?></a></li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="footer-col">
                    <h4><?php _e('Kontak', 'lp3aik-umk'); ?></h4>
                    <ul class="footer-links">
                        <?php if ($addr = lp3aik_opt('lp3aik_address')): ?>
                        <li style="color:rgba(255,255,255,.65);font-size:.85rem;line-height:1.6;margin-bottom:.5rem;">
                            <i class="fa-solid fa-location-dot fa-sm"></i> <?php echo esc_html($addr); ?>
                        </li>
                        <?php endif; ?>
                        <?php if ($email = lp3aik_opt('lp3aik_email','lp3aik@umkotabumi.ac.id')): ?>
                        <li><a href="mailto:<?php echo esc_attr($email); ?>"><i class="fa-solid fa-envelope fa-sm"></i> <?php echo esc_html($email); ?></a></li>
                        <?php endif; ?>
                        <?php if ($phone = lp3aik_opt('lp3aik_phone')): ?>
                        <li><a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><i class="fa-solid fa-phone fa-sm"></i> <?php echo esc_html($phone); ?></a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if (is_active_sidebar('footer-1')): ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="container">
        <div class="footer-bottom">
            <span>
                &copy; <?php echo date('Y'); ?>
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>.
                <?php _e('Universitas Muhammadiyah Kotabumi. Hak cipta dilindungi.','lp3aik-umk'); ?>
            </span>
            <span>
                <?php _e('Dibuat dengan','lp3aik-umk'); ?> <i class="fa-solid fa-heart" style="color:var(--gold-light);"></i> <?php _e('untuk kemajuan','lp3aik-umk'); ?>
                <a href="https://muhammadiyah.or.id" target="_blank" rel="noopener"><?php _e('Muhammadiyah','lp3aik-umk'); ?></a>
            </span>
        </div>
    </div>
</footer>

<?php get_template_part('template-parts/components/back-to-top'); ?>

<?php wp_footer(); ?>
</body>
</html>

```
<!-- END FILE: footer.php -->

---

<!-- START FILE: front-page.php -->
## File: `front-page.php`

```php
<?php
/**
 * Front Page Template
 *
 * Beranda hanya menampilkan Hero, Kegiatan (Galeri), dan Informasi (Berita/Pengumuman).
 * File ini HANYA digunakan untuk halaman depan (home URL).
 *
 * @package lp3aik-umk
 */

get_header();

get_template_part('template-parts/sections/section', 'hero');
get_template_part('template-parts/sections/section', 'gallery');
get_template_part('template-parts/sections/section', 'news');

get_template_part('template-parts/components/lightbox');

get_footer();

```
<!-- END FILE: front-page.php -->

---

<!-- START FILE: functions.php -->
## File: `functions.php`

```php
<?php
/**
 * LP3AIK UM Kotabumi — Functions & Theme Bootstrap.
 *
 * Slim loader that requires all modular include files.
 * Each domain lives in its own file under inc/.
 *
 * @package lp3aik-umk
 * @version 2.0.0
 */

defined('ABSPATH') || exit;

// ── Constants ───────────────────────────────────────────────
define('LP3AIK_VERSION', '2.0.0');
define('LP3AIK_DIR',     get_template_directory());
define('LP3AIK_URI',     get_template_directory_uri());

// ── Modular Includes ────────────────────────────────────────
$lp3aik_includes = [
    'inc/setup/theme-setup.php',
    'inc/enqueue/enqueue-assets.php',
    'inc/helpers/template-helpers.php',
    'inc/helpers/navigation.php',
    'inc/helpers/page-templates.php',
    'inc/post-types/register-post-types.php',
    'inc/post-types/register-taxonomies.php',
    'inc/meta-boxes/program-meta.php',
    'inc/meta-boxes/tim-meta.php',
    'inc/meta-boxes/unduhan-meta.php',
    'inc/customizer/customizer.php',
    'inc/ajax/contact-handler.php',
    'inc/admin/admin-columns.php',
    'inc/security/security.php',
    'inc/optimization/optimization.php',
];

foreach ($lp3aik_includes as $file) {
    $path = LP3AIK_DIR . '/' . $file;
    if (file_exists($path)) {
        require_once $path;
    }
}

```
<!-- END FILE: functions.php -->

---

<!-- START FILE: header.php -->
## File: `header.php`

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#1a7a3c">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php get_template_part('template-parts/navigation/topbar'); ?>

<?php get_template_part('template-parts/navigation/ticker'); ?>

<!-- SITE HEADER -->
<header class="site-header" id="site-header">
    <div class="header-inner container">

        <!-- LOGO -->
        <div class="site-logo-wrap" style="display:flex;align-items:center;gap:0.85rem;flex-shrink:0;">
            <?php if (has_custom_logo()): ?>
                <div class="custom-logo-wrapper" style="max-height:56px;display:flex;align-items:center;">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else: ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?>" style="text-decoration:none;">
                    <div class="d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:var(--green-primary);border-radius:50%;font-size:1.5rem;color:var(--white);">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                </a>
            <?php endif; ?>
            
            <div class="logo-text-group">
                <div class="logo-main site-title"><a href="<?php echo esc_url(home_url('/')); ?>" style="color:var(--green-dark);text-decoration:none;"><?php bloginfo('name'); ?></a></div>
                <div class="logo-sub site-description"><?php bloginfo('description'); ?></div>
            </div>
        </div>

        <!-- NAVIGATION -->
        <div id="mobile-menu-drawer" class="mobile-menu-drawer">
            <nav aria-label="<?php _e('Menu Utama','lp3aik-umk'); ?>">
                <?php
                wp_nav_menu([
                    'theme_location'  => 'primary',
                    'container'       => false,
                    'menu_class'      => 'primary-nav',
                    'fallback_cb'     => 'lp3aik_default_menu',
                    'depth'           => 3,
                ]);
                ?>
            </nav>
            <div class="mobile-drawer-footer d-md-none mt-4 border-top pt-4" style="padding: 0 1.5rem;">
                <button class="btn btn-outline w-100 d-flex align-items-center justify-content-center gap-2" aria-label="<?php _e('Cari','lp3aik-umk'); ?>" onclick="document.getElementById('nav-toggle').click(); setTimeout(function(){ document.getElementById('search-toggle').click(); }, 300);">
                    <i class="fa-solid fa-magnifying-glass"></i> <?php _e('Pencarian','lp3aik-umk'); ?>
                </button>
            </div>
        </div>

        <!-- HEADER ACTIONS -->
        <div class="header-actions" style="display:flex;align-items:center;gap:0.75rem;">
            <!-- SEARCH BUTTON (Desktop only) -->
            <button class="btn btn-outline btn-sm d-none d-md-flex align-items-center justify-content-center" id="search-toggle" aria-label="<?php _e('Cari','lp3aik-umk'); ?>" style="flex-shrink:0;padding:0.4rem 0.6rem;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="sr-only"><?php _e('Cari','lp3aik-umk'); ?></span>
            </button>

            <!-- HAMBURGER -->
            <button class="nav-toggle" id="nav-toggle" aria-controls="primary-nav" aria-expanded="false" aria-label="<?php _e('Buka menu','lp3aik-umk'); ?>" style="flex-shrink:0;">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</header>

<?php get_template_part('template-parts/navigation/search-modal'); ?>

<div id="page">

```
<!-- END FILE: header.php -->

---

<!-- START FILE: index.php -->
## File: `index.php`

```php
<?php
/**
 * Blog / Archive Template
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title(__('Tag: ','lp3aik-umk'));
            } elseif (is_search()) {
                printf(__('Hasil pencarian: "%s"','lp3aik-umk'), esc_html(get_search_query()));
            } elseif (is_archive()) {
                the_archive_title();
            } else {
                _e('Berita & Pengumuman','lp3aik-umk');
            }
        ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <!-- Posts -->
            <main id="main-content">
                <?php if (have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while (have_posts()): the_post(); ?>
                    <article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card__image">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:180px;">
                                    <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card__body">
                            <?php if ($cats = get_the_category()): ?>
                                <div class="card__tag"><?php echo esc_html($cats[0]->name); ?></div>
                            <?php endif; ?>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <div class="card__meta">
                                <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
                                <span><i class="fa-solid fa-user-pen fa-sm"></i> <?php the_author(); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    echo paginate_links([
                        'type'      => 'list',
                        'prev_text' => '&lsaquo;',
                        'next_text' => '&rsaquo;',
                    ]);
                    ?>
                </div>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);"><i class="fa-solid fa-inbox"></i></div>
                    <h3><?php _e('Belum ada postingan','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);"><?php _e('Postingan atau berita tidak ditemukan.','lp3aik-umk'); ?></p>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside>
                <!-- Recent Posts -->
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru','lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5]);
                    while ($recent->have_posts()): $recent->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="news-item-small mb-3" style="display:flex;gap:1rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">
                        <div class="news-item-small__image" style="width:70px;height:60px;flex-shrink:0;">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;border-radius:4px;">
                                    <i class="fa-solid fa-newspaper fa-sm" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="news-item-small__title" style="font-size:0.85rem;font-weight:600;line-height:1.3;margin-bottom:0.25rem;"><?php the_title(); ?></div>
                            <div class="news-item-small__date" style="font-size:0.75rem;color:var(--text-muted);"><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
                        </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori','lp3aik-umk'); ?></h4>
                    <ul class="footer-links" style="gap:.4rem;">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>

```
<!-- END FILE: index.php -->

---

<!-- START FILE: page.php -->
## File: `page.php`

```php
<?php
/**
 * Page Template — Fallback
 *
 * Tampilan standar untuk halaman WordPress yang TIDAK memiliki
 * custom page template. Halaman dengan template khusus (profil,
 * berita, kontak, dll.) ditangani langsung oleh template_include
 * filter di inc/helpers/page-templates.php.
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
        <div class="entry-content"
            style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);">
            <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
```
<!-- END FILE: page.php -->

---

<!-- START FILE: search.php -->
## File: `search.php`

```php
<?php
/**
 * Search Results Template
 *
 * Menampilkan hasil pencarian sesuai tema LP3AIK.
 * Mengikuti WordPress Template Hierarchy: search.php
 *
 * @package lp3aik-umk
 */

get_header();
?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1><?php printf(__('Hasil Pencarian: "%s"', 'lp3aik-umk'), esc_html(get_search_query())); ?></h1>
        <div class="breadcrumb">
            <?php lp3aik_breadcrumb(); ?>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="single-wrap">
            <!-- Search Results -->
            <main id="main-content">
                <?php if (have_posts()): ?>
                <p class="mb-4" style="color:var(--text-secondary);">
                    <?php printf(
                        _n('Ditemukan %d hasil', 'Ditemukan %d hasil', $wp_query->found_posts, 'lp3aik-umk'),
                        $wp_query->found_posts
                    ); ?>
                </p>
                <div class="grid-2 mb-4">
                    <?php while (have_posts()): the_post(); ?>
                    <article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card__image">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:180px;">
                                    <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card__body">
                            <?php
                            $post_type = get_post_type();
                            $pt_obj    = get_post_type_object($post_type);
                            if ($pt_obj && $post_type !== 'post'):
                            ?>
                            <div class="card__tag"><?php echo esc_html($pt_obj->labels->singular_name); ?></div>
                            <?php elseif ($cats = get_the_category()): ?>
                            <div class="card__tag"><?php echo esc_html($cats[0]->name); ?></div>
                            <?php endif; ?>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <div class="card__meta">
                                <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    echo paginate_links([
                        'type'      => 'list',
                        'prev_text' => '&lsaquo;',
                        'next_text' => '&rsaquo;',
                    ]);
                    ?>
                </div>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);"><i class="fa-solid fa-search"></i></div>
                    <h3><?php _e('Tidak ada hasil ditemukan','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);"><?php _e('Coba kata kunci lain atau kembali ke beranda.','lp3aik-umk'); ?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary mt-3">
                        <i class="fa-solid fa-home me-1"></i> <?php _e('Kembali ke Beranda','lp3aik-umk'); ?>
                    </a>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside>
                <?php get_template_part('template-parts/sidebar/sidebar', 'search'); ?>
                <div class="sidebar-widget">
                    <h4><?php _e('Cari Lagi','lp3aik-umk'); ?></h4>
                    <?php get_search_form(); ?>
                </div>
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori','lp3aik-umk'); ?></h4>
                    <ul class="footer-links" style="gap:.4rem;">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>

```
<!-- END FILE: search.php -->

---

<!-- START FILE: searchform.php -->
## File: `searchform.php`

```php
<?php
/**
 * Template untuk Form Pencarian (Search Form)
 *
 * @package lp3aik-umk
 */
?>
<form role="search" method="get" class="search-form d-flex gap-2 w-100" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" class="form-control" placeholder="<?php _e('Ketik kata kunci pencarian...', 'lp3aik-umk'); ?>" value="<?php echo get_search_query(); ?>" name="s" required>
    <button type="submit" class="btn btn-primary" style="padding: 0.5rem 1.25rem;">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</form>

```
<!-- END FILE: searchform.php -->

---

<!-- START FILE: single.php -->
## File: `single.php`

```php
<?php
/**
 * Single Post Template (Halaman Baca Berita)
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
        <div class="single-wrap">
            <!-- Konten Utama Berita -->
            <main id="main-content">
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <?php if (has_post_thumbnail()): ?>
                    <div class="entry-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" alt="<?php the_title_attribute(); ?>" style="width:100%;border-radius:var(--radius-lg);">
                    </div>
                    <?php endif; ?>
                    
                    <div class="entry-meta mb-4 d-flex gap-4 align-items-center flex-wrap" style="color:var(--text-secondary);font-size:0.9rem;border-bottom:1px solid var(--border);padding-bottom:1rem;">
                        <span><i class="fa-regular fa-calendar" style="color:var(--green-primary);"></i> <?php echo get_the_date('d M Y'); ?></span>
                        <span><i class="fa-solid fa-user-pen" style="color:var(--green-primary);"></i> <?php the_author(); ?></span>
                        <?php if ($cats = get_the_category()): ?>
                            <span><i class="fa-solid fa-folder-open" style="color:var(--green-primary);"></i> <?php echo esc_html($cats[0]->name); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="entry-content" style="font-size:1.05rem;line-height:1.8;">
                        <?php the_content(); ?>
                    </div>
                    
                </article>
                <?php endwhile; ?>
            </main>

            <!-- Sidebar (Sama dengan Index) -->
            <aside>
                <!-- Recent Posts -->
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru','lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => [get_the_ID()]]);
                    while ($recent->have_posts()): $recent->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="news-item-small mb-3" style="display:flex;gap:1rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">
                        <div class="news-item-small__image" style="width:70px;height:60px;flex-shrink:0;">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>" alt="" style="width:100%;height:100%;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;border-radius:4px;">
                                    <i class="fa-solid fa-newspaper fa-sm" style="color:var(--green-mid);"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="news-item-small__title" style="font-size:0.85rem;font-weight:600;line-height:1.3;margin-bottom:0.25rem;"><?php the_title(); ?></div>
                            <div class="news-item-small__date" style="font-size:0.75rem;color:var(--text-muted);"><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
                        </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori','lp3aik-umk'); ?></h4>
                    <ul class="footer-links" style="gap:.4rem;">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>

```
<!-- END FILE: single.php -->

---

<!-- START FILE: style.css -->
## File: `style.css`

```css
/*
Theme Name: LP3AIK UM Kotabumi
Theme URI: https://umkotabumi.ac.id
Author: LP3AIK UM Kotabumi
Author URI: https://umkotabumi.ac.id
Description: Theme resmi LP3AIK (Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan) Universitas Muhammadiyah Kotabumi. Tema ini dirancang untuk menampilkan program, kegiatan, dan informasi lembaga dengan nuansa Islami dan profesional.
Version: 2.0.0
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 8.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: lp3aik-umk
Tags: custom-menu, featured-images, custom-logo, full-width-template, post-formats, translation-ready, blog, education, islamic
*/

/* WordPress requires this file — all styles are in assets/css/app.css */

```
<!-- END FILE: style.css -->

---

<!-- START FILE: assets\css\app.css -->
## File: `assets\css\app.css`

```css
/**
 * LP3AIK UM Kotabumi — Master CSS Import
 *
 * Imports all modular CSS partials in correct cascade order.
 * Bootstrap 5.3 is loaded via CDN before this file.
 *
 * @version 2.0.0
 */

/* ── Base ──────────────────────────────────────────────────── */
@import url('base/_variables.css');
@import url('base/_reset.css');
@import url('base/_typography.css');

/* ── Layout ───────────────────────────────────────────────── */
@import url('layout/_container.css');
@import url('layout/_header.css');
@import url('layout/_footer.css');

/* ── Components ───────────────────────────────────────────── */
@import url('components/_buttons.css');
@import url('components/_cards.css');
@import url('components/_forms.css');
@import url('components/_badges.css');
@import url('components/_lightbox.css');
@import url('components/_search-modal.css');

/* ── Sections ─────────────────────────────────────────────── */
@import url('sections/_hero.css');
@import url('sections/_about.css');
@import url('sections/_stats.css');
@import url('sections/_news.css');
@import url('sections/_gallery.css');
@import url('sections/_ticker.css');
@import url('sections/_downloads.css');

/* ── Pages ────────────────────────────────────────────────── */
@import url('pages/_single.css');
@import url('pages/_archive.css');
@import url('pages/_pagination.css');

/* ── Utilities ────────────────────────────────────────────── */
@import url('utilities/_accessibility.css');
@import url('utilities/_wordpress.css');
@import url('utilities/_back-to-top.css');

/* ── Responsive (must be last) ────────────────────────────── */
@import url('_responsive.css');

```
<!-- END FILE: assets\css\app.css -->

---

<!-- START FILE: assets\css\_responsive.css -->
## File: `assets\css\_responsive.css`

```css
/* ============================================================
   RESPONSIVE BREAKPOINTS
   ============================================================ */
@media (max-width: 1024px) {
  .hero__inner { grid-template-columns: 1fr; text-align: center; gap: 2.5rem; }
  .hero__arabic, .hero__bismillah-label { text-align: center; }
  .hero__actions { justify-content: center; }
  .hero__tagline { margin: 0 auto; }
  .hero__indicators { justify-content: center; }
  .hero__text-carousel { min-height: 140px; }
  .hero__quick-links { grid-template-columns: repeat(4,1fr); }
  .about-grid { grid-template-columns: 1fr; }
  .about__image-wrap { max-width: 400px; margin: 0 auto; }
  .single-wrap { grid-template-columns: 1fr; }
  .contact-grid { grid-template-columns: 1fr; }
  .footer-grid { grid-template-columns: 1fr 1fr; }
  .news-featured { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: repeat(2,1fr); }
  .stats-grid .stat-block + .stat-block { border-left: none; border-top: 1px solid rgba(255,255,255,.1); }
}

@media (max-width: 768px) {
  :root { --section-py: 3.5rem; }
  .hero { min-height: 80vh; }
  .hero__inner { padding: 4rem 1.5rem 3rem; }
  .hero__text-carousel { min-height: 120px; }
  .grid-3, .grid-4 { grid-template-columns: 1fr 1fr; }
  .grid-2 { grid-template-columns: 1fr; }
  .mobile-menu-drawer {
      position: fixed;
      top: 0;
      right: -100%;
      width: 100%;
      height: 100vh;
      background: var(--white);
      z-index: 1000;
      display: flex;
      flex-direction: column;
      padding: 5rem 0 2rem;
      transition: right 0.3s ease-in-out;
      overflow-y: auto;
  }
  .mobile-menu-drawer.open { right: 0; }
  .primary-nav { display: flex; flex-direction: column; gap: 0; padding: 0 1.5rem; }
  .primary-nav > li > a { padding: 1rem 0; border-bottom: 1px solid var(--gray-200); font-size: 1.1rem; }
  .primary-nav .sub-menu { position: static; box-shadow: none; border: none; background: var(--gray-100); opacity: 1; visibility: visible; transform: none; display: none; padding: 0 0 0 1rem; border-radius: 0; }
  .primary-nav > li.open .sub-menu { display: block; }
  .nav-toggle, .site-logo-wrap { display: flex; position: relative; z-index: 1001; }
  .header-inner { position: relative; flex-wrap: nowrap; gap: 0.5rem; }
  .footer-grid { grid-template-columns: 1fr; }
  .gallery-masonry { columns: 2; }
  .hero__stat-cards { grid-template-columns: 1fr 1fr; }
  .form-row { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
  .footer-bottom { flex-direction: column; text-align: center; }
}

@media (max-width: 480px) {
  :root { --section-py: 2.5rem; }
  .hero { min-height: 70vh; }
  .hero__inner { padding: 3rem 1rem 2rem; }
  .hero__text-carousel { min-height: 100px; }
  .hero h1 { font-size: 1.6rem; }
  .grid-3, .grid-4 { grid-template-columns: 1fr; }
  .gallery-masonry { columns: 1; }
  .hero__quick-links { grid-template-columns: repeat(2,1fr); }
  .btn-lg { padding: .85rem 1.75rem; }
  .stats-grid { grid-template-columns: 1fr; }
}

```
<!-- END FILE: assets\css\_responsive.css -->

---

<!-- START FILE: assets\css\base\_reset.css -->
## File: `assets\css\base\_reset.css`

```css
/* ============================================================
   RESET & BASE
   Bootstrap handles box-sizing and basic resets, so we only
   add theme-specific overrides here.
   ============================================================ */
html { scroll-behavior: smooth; }

body {
  font-family: var(--font-body);
  font-size: 16px;
  line-height: 1.7;
  color: var(--text-primary);
  background: var(--bg-body);
  overflow-x: hidden;
}

img, video, svg { max-width: 100%; height: auto; display: block; }
a { color: inherit; text-decoration: none; }
ul, ol { list-style: none; padding-left: 0; }
button, input, textarea, select { font: inherit; }
h1,h2,h3,h4,h5,h6 {
  font-family: var(--font-heading);
  line-height: 1.25;
  font-weight: 700;
  color: var(--green-dark);
}

```
<!-- END FILE: assets\css\base\_reset.css -->

---

<!-- START FILE: assets\css\base\_typography.css -->
## File: `assets\css\base\_typography.css`

```css
/* ============================================================
   TYPOGRAPHY — Theme-specific text classes
   ============================================================ */
.section-eyebrow {
  display: inline-block;
  font-size: .75rem;
  font-weight: 700;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--green-mid);
  padding: .25rem .75rem;
  background: var(--green-pale);
  border-radius: 99px;
  margin-bottom: .75rem;
}
.section-title {
  font-size: clamp(1.75rem, 3.5vw, 2.75rem);
  margin-bottom: 1rem;
}
.section-subtitle {
  font-size: 1.05rem;
  color: var(--text-secondary);
  max-width: 600px;
  margin: 0 auto 2.5rem;
}
.arabic-text {
  font-family: var(--font-arabic);
  font-size: 1.5rem;
  color: var(--gold-primary);
  direction: rtl;
  line-height: 2;
}

```
<!-- END FILE: assets\css\base\_typography.css -->

---

<!-- START FILE: assets\css\base\_variables.css -->
## File: `assets\css\base\_variables.css`

```css
/* ============================================================
   CSS CUSTOM PROPERTIES - LP3AIK COLOR SYSTEM
   ============================================================ */
:root {
  /* Primary - Hijau Muhammadiyah */
  --green-dark:    #0a4a1e;
  --green-primary: #1a7a3c;
  --green-mid:     #2d9e54;
  --green-light:   #4fc072;
  --green-pale:    #e8f5ec;
  --green-ghost:   #f3fbf5;

  /* Accent - Emas Islami */
  --gold-primary: #c8972a;
  --gold-light:   #e8b94a;
  --gold-pale:    #fdf6e3;

  /* Neutral */
  --white:        #ffffff;
  --off-white:    #fafafa;
  --gray-100:     #f5f5f5;
  --gray-200:     #e8e8e8;
  --gray-400:     #a0a0a0;
  --gray-600:     #666666;
  --gray-800:     #333333;
  --black:        #111111;

  /* Semantic */
  --text-primary:   var(--gray-800);
  --text-secondary: var(--gray-600);
  --text-muted:     var(--gray-400);
  --bg-body:        var(--white);
  --bg-section:     var(--green-ghost);
  --border:         var(--gray-200);

  /* Typography */
  --font-heading: 'Poppins', sans-serif;
  --font-arabic: 'Amiri', 'Scheherazade New', Georgia, serif;
  --font-body:    'Plus Jakarta Sans', 'Noto Sans', sans-serif;
  --font-arabic:  'Amiri', 'Scheherazade New', serif;

  /* Spacing */
  --container:  1200px;
  --gap:        1.5rem;
  --section-py: 5rem;

  /* Shadows */
  --shadow-sm: 0 1px 4px rgba(0,0,0,.06);
  --shadow-md: 0 4px 16px rgba(0,0,0,.10);
  --shadow-lg: 0 12px 40px rgba(0,0,0,.14);

  /* Radius */
  --radius-sm: 6px;
  --radius-md: 12px;
  --radius-lg: 20px;
  --radius-xl: 32px;

  /* Transitions */
  --ease: cubic-bezier(.4,0,.2,1);
  --dur:  0.28s;
}

```
<!-- END FILE: assets\css\base\_variables.css -->

---

<!-- START FILE: assets\css\components\_badges.css -->
## File: `assets\css\components\_badges.css`

```css
/* ============================================================
   BADGES, ALERTS, ORNAMENT
   ============================================================ */
.badge {
  display: inline-block;
  padding: .2rem .7rem;
  border-radius: 99px;
  font-size: .75rem;
  font-weight: 700;
}
.badge-green { background: var(--green-pale); color: var(--green-dark); }
.badge-gold  { background: var(--gold-pale);  color: var(--gold-primary); }

.ornament {
  display: block;
  text-align: center;
  color: var(--gold-primary);
  opacity: .6;
  font-size: 1.5rem;
  letter-spacing: .5em;
  margin: 1rem 0;
}

.alert { padding: 1rem 1.25rem; border-radius: var(--radius-sm); border: 1px solid; margin-bottom: 1rem; font-size: .9rem; }
.alert-success { background: var(--green-pale); border-color: var(--green-light); color: var(--green-dark); }
.alert-info    { background: #e8f4fd; border-color: #90cdf4; color: #2c5282; }

```
<!-- END FILE: assets\css\components\_badges.css -->

---

<!-- START FILE: assets\css\components\_buttons.css -->
## File: `assets\css\components\_buttons.css`

```css
/* ============================================================
   BUTTONS — Theme-specific button styles
   Extends Bootstrap's .btn with theme colors.
   ============================================================ */
.btn {
  display: inline-flex;
  align-items: center;
  gap: .5rem;
  padding: .75rem 1.75rem;
  border-radius: var(--radius-md);
  font-weight: 600;
  font-size: .95rem;
  cursor: pointer;
  border: 2px solid transparent;
  transition: all var(--dur) var(--ease);
  white-space: nowrap;
}
.btn-primary {
  background: var(--green-primary);
  color: var(--white);
  border-color: var(--green-primary);
}
.btn-primary:hover {
  background: var(--green-dark);
  border-color: var(--green-dark);
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
  color: var(--white);
}
.btn-outline {
  background: transparent;
  color: var(--green-primary);
  border-color: var(--green-primary);
}
.btn-outline:hover {
  background: var(--green-primary);
  color: var(--white);
  transform: translateY(-2px);
}
.btn-gold {
  background: var(--gold-primary);
  color: var(--white);
  border-color: var(--gold-primary);
}
.btn-gold:hover {
  background: #a67a20;
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
  color: var(--white);
}
.btn-white {
  background: var(--white);
  color: var(--green-dark);
  border-color: var(--white);
}
.btn-white:hover {
  background: var(--green-pale);
  transform: translateY(-2px);
}
.btn-sm { padding: .5rem 1.25rem; font-size: .85rem; }
.btn-lg { padding: 1rem 2.25rem; font-size: 1.05rem; }

```
<!-- END FILE: assets\css\components\_buttons.css -->

---

<!-- START FILE: assets\css\components\_cards.css -->
## File: `assets\css\components\_cards.css`

```css
/* ============================================================
   CARDS — News card, Program card, Team card, Contact card
   ============================================================ */

/* --- Base Card --- */
.card {
  background: var(--white);
  border-radius: var(--radius-lg);
  overflow: hidden;
  box-shadow: var(--shadow-sm);
  border: 1px solid var(--border);
  transition: box-shadow var(--dur) var(--ease), transform var(--dur) var(--ease);
}
.card:hover {
  box-shadow: var(--shadow-lg);
  transform: translateY(-4px);
}
.card__image { aspect-ratio: 16/10; overflow: hidden; }
.card__image img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s var(--ease); }
.card:hover .card__image img { transform: scale(1.06); }
.card__body { padding: 1.5rem; }
.card__tag {
  font-size: .75rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .08em;
  color: var(--green-mid);
  margin-bottom: .5rem;
}
.card__title { font-size: 1.15rem; margin-bottom: .5rem; }
.card__excerpt { font-size: .9rem; color: var(--text-secondary); line-height: 1.6; margin-bottom: 1rem; }
.card__meta { font-size: .8rem; color: var(--text-muted); display: flex; gap: 1rem; flex-wrap: wrap; }
.card__meta span { display: flex; align-items: center; gap: .3rem; }

/* --- Program Card --- */
.program-card {
  background: var(--white);
  border-radius: var(--radius-lg);
  padding: 2rem;
  border: 1px solid var(--border);
  text-align: center;
  transition: all var(--dur) var(--ease);
  position: relative;
  overflow: hidden;
}
.program-card::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--green-primary), var(--gold-primary));
  transform: scaleX(0);
  transition: transform var(--dur) var(--ease);
}
.program-card:hover::before { transform: scaleX(1); }
.program-card:hover {
  box-shadow: var(--shadow-lg);
  transform: translateY(-6px);
}
.program-card__icon {
  width: 64px; height: 64px;
  border-radius: 50%;
  background: var(--green-pale);
  display: flex; align-items: center; justify-content: center;
  margin: 0 auto 1.25rem;
  font-size: 1.75rem;
  transition: background var(--dur);
  color: var(--green-primary);
}
.program-card:hover .program-card__icon { background: var(--green-primary); color: var(--white); }
.program-card h3 { font-size: 1.1rem; margin-bottom: .6rem; }
.program-card p { font-size: .875rem; color: var(--text-secondary); margin-bottom: 1.25rem; }

/* --- Team Card --- */
.team-card {
  text-align: center;
  padding: 1.75rem 1.25rem;
  background: var(--white);
  border-radius: var(--radius-lg);
  border: 1px solid var(--border);
  transition: all var(--dur);
}
.team-card:hover {
  box-shadow: var(--shadow-md);
  border-color: var(--green-light);
}
.team-card__avatar {
  width: 90px; height: 90px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto 1rem;
  border: 3px solid var(--green-pale);
  transition: border-color var(--dur);
}
.team-card:hover .team-card__avatar { border-color: var(--green-primary); }
.team-card__avatar img { width: 100%; height: 100%; object-fit: cover; }
.team-card__name { font-size: 1rem; font-weight: 700; margin-bottom: .2rem; }
.team-card__position { font-size: .8rem; color: var(--green-primary); font-weight: 600; margin-bottom: .4rem; }
.team-card__dept { font-size: .775rem; color: var(--text-muted); }

/* --- Contact Card --- */
.contact-card {
  display: flex;
  gap: 1rem;
  align-items: flex-start;
  padding: 1.25rem;
  background: var(--white);
  border-radius: var(--radius-md);
  border: 1px solid var(--border);
  box-shadow: var(--shadow-sm);
}
.contact-card__icon {
  width: 44px; height: 44px;
  border-radius: var(--radius-sm);
  background: var(--green-pale);
  display: flex; align-items: center; justify-content: center;
  font-size: 1.25rem;
  flex-shrink: 0;
  color: var(--green-primary);
}
.contact-card__label { font-size: .8rem; color: var(--text-muted); margin-bottom: .2rem; }
.contact-card__value { font-size: .9rem; font-weight: 600; }
.contact-card__value a { color: var(--green-primary); }
.contact-card__value a:hover { text-decoration: underline; }

```
<!-- END FILE: assets\css\components\_cards.css -->

---

<!-- START FILE: assets\css\components\_forms.css -->
## File: `assets\css\components\_forms.css`

```css
/* ============================================================
   FORM ELEMENTS
   ============================================================ */
.form-group { margin-bottom: 1.25rem; }
.form-label {
  display: block;
  font-weight: 600;
  font-size: .9rem;
  margin-bottom: .4rem;
  color: var(--text-primary);
}
.form-control {
  width: 100%;
  padding: .75rem 1rem;
  border: 1.5px solid var(--border);
  border-radius: var(--radius-sm);
  font-size: .95rem;
  background: var(--white);
  color: var(--text-primary);
  transition: border-color var(--dur) var(--ease), box-shadow var(--dur) var(--ease);
}
.form-control:focus {
  outline: none;
  border-color: var(--green-mid);
  box-shadow: 0 0 0 3px rgba(45,158,84,.15);
}
textarea.form-control { resize: vertical; min-height: 120px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.contact-grid { display: grid; grid-template-columns: 1fr 1.5fr; gap: 3rem; align-items: start; }
.contact-info { display: flex; flex-direction: column; gap: 1.25rem; }
.contact-form-wrap {
  background: var(--white);
  border-radius: var(--radius-xl);
  padding: 2.5rem;
  box-shadow: var(--shadow-md);
  border: 1px solid var(--border);
}
.contact-form-wrap h3 { font-size: 1.35rem; margin-bottom: .5rem; }
.contact-form-wrap .subtitle { font-size: .9rem; color: var(--text-secondary); margin-bottom: 1.5rem; }

/* Honeypot field — visually hidden */
.hp-field { position: absolute; left: -9999px; opacity: 0; height: 0; width: 0; overflow: hidden; }

```
<!-- END FILE: assets\css\components\_forms.css -->

---

<!-- START FILE: assets\css\components\_lightbox.css -->
## File: `assets\css\components\_lightbox.css`

```css
/* ============================================================
   LIGHTBOX
   ============================================================ */
.lightbox {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.92);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  visibility: hidden;
  transition: all .3s var(--ease);
}
.lightbox.active { opacity: 1; visibility: visible; }
.lightbox img { max-width: 90vw; max-height: 85vh; border-radius: var(--radius-md); }
.lightbox__close {
  position: absolute;
  top: 1.5rem; right: 1.5rem;
  background: rgba(255,255,255,.15);
  color: var(--white);
  border: none;
  width: 44px; height: 44px;
  border-radius: 50%;
  font-size: 1.25rem;
  cursor: pointer;
  transition: background var(--dur);
}
.lightbox__close:hover { background: rgba(255,255,255,.3); }

```
<!-- END FILE: assets\css\components\_lightbox.css -->

---

<!-- START FILE: assets\css\components\_search-modal.css -->
## File: `assets\css\components\_search-modal.css`

```css
/* ============================================================
   SEARCH MODAL
   ============================================================ */
.search-modal {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.7);
  z-index: 9000;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding-top: 10vh;
  opacity: 0;
  visibility: hidden;
  transition: all var(--dur);
}
.search-modal.active { opacity: 1; visibility: visible; }
.search-modal__box {
  background: var(--white);
  border-radius: var(--radius-lg);
  padding: 2rem;
  width: min(600px, 90vw);
  box-shadow: var(--shadow-lg);
}
.search-modal__input {
  width: 100%;
  padding: 1rem 1.25rem;
  font-size: 1.1rem;
  border: 2px solid var(--green-primary);
  border-radius: var(--radius-md);
  outline: none;
}

```
<!-- END FILE: assets\css\components\_search-modal.css -->

---

<!-- START FILE: assets\css\layout\_container.css -->
## File: `assets\css\layout\_container.css`

```css
/* ============================================================
   LAYOUT — Container override & section utilities
   Bootstrap container is used. These are theme-specific
   layout helpers that extend Bootstrap.
   ============================================================ */
.container {
  max-width: var(--container);
}
.section { padding: var(--section-py) 0; }
.section--alt { background: var(--bg-section); }
.section--dark { background: var(--green-dark); color: var(--white); }
.section--dark h2, .section--dark h3 { color: var(--gold-light); }

/* Theme-specific grids (extend Bootstrap's grid) */
.grid-2 { display: grid; grid-template-columns: repeat(2,1fr); gap: var(--gap); }
.grid-3 { display: grid; grid-template-columns: repeat(3,1fr); gap: var(--gap); }
.grid-4 { display: grid; grid-template-columns: repeat(4,1fr); gap: var(--gap); }

/* Flex helpers — use Bootstrap's d-flex, align-items-center, etc. where possible
   These remain for backward compatibility with existing templates */
.flex-between { display: flex; align-items: center; justify-content: space-between; }
.flex-center { display: flex; align-items: center; justify-content: center; }

```
<!-- END FILE: assets\css\layout\_container.css -->

---

<!-- START FILE: assets\css\layout\_footer.css -->
## File: `assets\css\layout\_footer.css`

```css
/* ============================================================
   FOOTER
   ============================================================ */
.site-footer {
  background: var(--green-dark);
  color: rgba(255,255,255,.8);
}
.footer-top {
  padding: 3.5rem 0 2.5rem;
  border-bottom: 1px solid rgba(255,255,255,.1);
}
.footer-grid {
  display: grid;
  grid-template-columns: 1.5fr 1fr 1fr 1fr;
  gap: 2.5rem;
}
.footer-brand .logo-main { color: var(--white); }
.footer-brand .logo-sub  { color: rgba(255,255,255,.6); }
.footer-brand p {
  font-size: .875rem;
  color: rgba(255,255,255,.65);
  margin-top: 1rem;
  line-height: 1.7;
}
.footer-social { display: flex; gap: .6rem; margin-top: 1.25rem; }
.footer-social a {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(255,255,255,.1);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: .875rem;
  transition: background var(--dur);
  color: var(--white);
}
.footer-social a:hover { background: var(--gold-primary); }
.footer-col h4 { font-size: .95rem; color: var(--gold-light); margin-bottom: 1rem; font-weight: 700; }
.footer-links { display: flex; flex-direction: column; gap: .5rem; }
.footer-links a {
  font-size: .85rem;
  color: rgba(255,255,255,.65);
  transition: color var(--dur);
}
.footer-links a:hover { color: var(--gold-light); }
.footer-bottom {
  padding: 1.25rem 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: .8rem;
  color: rgba(255,255,255,.45);
  flex-wrap: wrap;
  gap: .5rem;
}
.footer-bottom a { color: var(--gold-light); }
.footer-bottom a:hover { color: var(--white); }

/* QUOTE BANNER */
.quote-banner {
  background: linear-gradient(135deg, var(--green-dark), #0d5222);
  padding: 3.5rem 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.quote-banner::before {
  content: '\201C';
  position: absolute;
  top: 0;
  left: 2rem;
  font-size: 8rem;
  color: rgba(200,151,42,.1);
  line-height: 1;
  font-family: Georgia, serif;
}
.quote-banner .arabic-text { font-size: 2rem; margin-bottom: .5rem; }
.quote-banner .translation { color: rgba(255,255,255,.7); font-style: italic; font-size: 1rem; margin-bottom: .5rem; }
.quote-banner .source { font-size: .85rem; color: var(--gold-light); font-weight: 600; }

```
<!-- END FILE: assets\css\layout\_footer.css -->

---

<!-- START FILE: assets\css\layout\_header.css -->
## File: `assets\css\layout\_header.css`

```css
/* ============================================================
   HEADER — Topbar, Site Header, Primary Navigation
   ============================================================ */

/* TOP BAR */
.topbar {
  background: var(--green-dark);
  color: rgba(255,255,255,.8);
  font-size: .8rem;
  padding: .4rem 0;
  border-bottom: 2px solid var(--gold-primary);
}
.topbar a { color: var(--gold-light); }
.topbar a:hover { color: var(--white); }
.topbar__inner { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; }
.topbar__left, .topbar__right { display: flex; align-items: center; gap: 1.25rem; }
.topbar__item { display: flex; align-items: center; gap: .35rem; }

/* SITE HEADER */
.site-header {
  position: sticky;
  top: 0;
  z-index: 999;
  background: var(--white);
  box-shadow: var(--shadow-sm);
  border-bottom: 3px solid var(--green-primary);
  transition: box-shadow var(--dur) var(--ease);
}
.site-header.scrolled { box-shadow: var(--shadow-md); }

.header-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: .75rem 1.5rem;
  gap: 1rem;
}
.site-logo, .site-logo-wrap { display: flex; align-items: center; gap: .85rem; flex-shrink: 0; }
.site-logo img, .custom-logo-wrapper img { max-height: 56px; width: auto; object-fit: contain; }
.logo-text-group { line-height: 1.2; }
.logo-main {
  font-family: var(--font-heading);
  font-size: 1.35rem;
  font-weight: 700;
  color: var(--green-dark);
}
.logo-sub {
  font-size: .72rem;
  color: var(--text-secondary);
  font-weight: 500;
}

/* PRIMARY NAVIGATION */
.primary-nav { display: flex; align-items: center; gap: .25rem; }
.primary-nav > li { position: relative; }
.primary-nav > li > a {
  display: block;
  padding: .55rem .9rem;
  font-size: .9rem;
  font-weight: 600;
  color: var(--text-primary);
  border-radius: var(--radius-sm);
  transition: color var(--dur), background var(--dur);
}
.primary-nav > li > a:hover,
.primary-nav > li.current-menu-item > a,
.primary-nav > li.current-menu-ancestor > a {
  color: var(--green-primary);
  background: var(--green-pale);
}

/* Dropdown */
.primary-nav .sub-menu {
  position: absolute;
  top: calc(100% + 6px);
  left: 0;
  min-width: 220px;
  background: var(--white);
  border-radius: var(--radius-md);
  box-shadow: var(--shadow-lg);
  border: 1px solid var(--border);
  padding: .5rem;
  opacity: 0;
  visibility: hidden;
  transform: translateY(8px);
  transition: all var(--dur) var(--ease);
  z-index: 100;
}
.primary-nav > li:hover .sub-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}
.primary-nav .sub-menu li a {
  display: block;
  padding: .6rem .9rem;
  font-size: .875rem;
  font-weight: 500;
  border-radius: var(--radius-sm);
  transition: background var(--dur), color var(--dur);
}
.primary-nav .sub-menu li a:hover {
  background: var(--green-pale);
  color: var(--green-primary);
}

/* Hamburger */
.nav-toggle {
  display: none;
  flex-direction: column;
  gap: 5px;
  cursor: pointer;
  padding: .5rem;
  background: none;
  border: none;
}
.nav-toggle span {
  display: block;
  width: 26px;
  height: 2.5px;
  background: var(--green-dark);
  border-radius: 2px;
  transition: all .3s var(--ease);
}
.nav-toggle.active span:nth-child(1) { transform: rotate(45deg) translate(5.5px,5.5px); }
.nav-toggle.active span:nth-child(2) { opacity: 0; }
.nav-toggle.active span:nth-child(3) { transform: rotate(-45deg) translate(5.5px,-5.5px); }

```
<!-- END FILE: assets\css\layout\_header.css -->

---

<!-- START FILE: assets\css\pages\_archive.css -->
## File: `assets\css\pages\_archive.css`

```css
/* ============================================================
   PAGE HERO / ARCHIVE
   ============================================================ */
.page-hero {
  background: linear-gradient(135deg, var(--green-dark), var(--green-primary));
  padding: 4rem 0 3rem;
  text-align: center;
  color: var(--white);
  position: relative;
  overflow: hidden;
}
.page-hero::before {
  content: '';
  position: absolute; inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M30 0l30 30-30 30L0 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.page-hero h1 { color: var(--white); font-size: clamp(2rem, 4vw, 3rem); position: relative; }
.page-hero .breadcrumb {
  position: relative;
  display: flex; align-items: center; justify-content: center;
  gap: .5rem; font-size: .85rem;
  color: rgba(255,255,255,.7); margin-top: .75rem;
}
.page-hero .breadcrumb a { color: var(--gold-light); }
.page-hero .breadcrumb span { color: rgba(255,255,255,.4); }

```
<!-- END FILE: assets\css\pages\_archive.css -->

---

<!-- START FILE: assets\css\pages\_pagination.css -->
## File: `assets\css\pages\_pagination.css`

```css
/* ============================================================
   PAGINATION
   ============================================================ */
.pagination { display: flex; align-items: center; justify-content: center; gap: .5rem; padding: 2rem 0; }
.page-link {
  width: 40px; height: 40px;
  display: flex; align-items: center; justify-content: center;
  border-radius: var(--radius-sm);
  border: 1.5px solid var(--border);
  font-size: .9rem; font-weight: 600;
  color: var(--text-primary);
  transition: all var(--dur);
}
.page-link:hover, .page-link.current {
  background: var(--green-primary);
  color: var(--white);
  border-color: var(--green-primary);
}

```
<!-- END FILE: assets\css\pages\_pagination.css -->

---

<!-- START FILE: assets\css\pages\_single.css -->
## File: `assets\css\pages\_single.css`

```css
/* ============================================================
   SINGLE POST & SIDEBAR
   ============================================================ */
.single-wrap { display: grid; grid-template-columns: 1fr 320px; gap: 3rem; align-items: start; }
.single-content { min-width: 0; }
.entry-header { margin-bottom: 2rem; }
.entry-header h1 { font-size: clamp(1.75rem, 3vw, 2.5rem); margin-bottom: 1rem; }
.entry-meta {
  display: flex; align-items: center; flex-wrap: wrap;
  gap: 1rem; font-size: .85rem; color: var(--text-muted);
}
.entry-meta a { color: var(--green-primary); }
.entry-featured-image { border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 2rem; }
.entry-featured-image img { width: 100%; max-height: 500px; object-fit: cover; }
.entry-content { line-height: 1.85; }
.entry-content p { margin-bottom: 1.25rem; color: var(--text-primary); }
.entry-content h2 { font-size: 1.5rem; margin: 2rem 0 .75rem; }
.entry-content h3 { font-size: 1.25rem; margin: 1.5rem 0 .5rem; }
.entry-content ul, .entry-content ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
.entry-content li { margin-bottom: .4rem; }
.entry-content blockquote {
  border-left: 4px solid var(--gold-primary);
  padding: 1rem 1.5rem; margin: 1.5rem 0;
  background: var(--gold-pale);
  border-radius: 0 var(--radius-sm) var(--radius-sm) 0;
  font-style: italic; color: var(--text-secondary);
}
.entry-content img { border-radius: var(--radius-md); margin: 1.25rem 0; }
.sidebar-widget {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 1.5rem; margin-bottom: 1.5rem;
}
.sidebar-widget h4 {
  font-size: 1rem; margin-bottom: 1rem;
  padding-bottom: .75rem;
  border-bottom: 2px solid var(--green-pale);
  color: var(--green-dark);
}

```
<!-- END FILE: assets\css\pages\_single.css -->

---

<!-- START FILE: assets\css\sections\_about.css -->
## File: `assets\css\sections\_about.css`

```css
/* ============================================================
   ABOUT / PROFIL SECTION
   ============================================================ */
.about-grid {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 4rem;
  align-items: center;
}
.about__image-wrap { position: relative; }
.about__image-main {
  border-radius: var(--radius-xl);
  overflow: hidden;
  aspect-ratio: 4/5;
  box-shadow: var(--shadow-lg);
}
.about__image-main img { width: 100%; height: 100%; object-fit: cover; }
.about__badge-float {
  position: absolute;
  bottom: -1.5rem; right: -1.5rem;
  background: var(--gold-primary);
  color: var(--white);
  border-radius: var(--radius-lg);
  padding: 1.25rem 1.5rem;
  text-align: center;
  box-shadow: var(--shadow-md);
}
.about__badge-float .num { font-size: 2.5rem; font-weight: 800; line-height: 1; font-family: var(--font-heading); }
.about__badge-float .label { font-size: .75rem; opacity: .9; margin-top: .2rem; }
.about__content .section-eyebrow { margin-bottom: .75rem; }
.about__visi-misi { margin-top: 1.5rem; }
.visi-misi-tabs { display: flex; gap: .5rem; margin-bottom: 1rem; }
.tab-btn {
  padding: .45rem 1rem;
  border-radius: 99px;
  border: 1.5px solid var(--border);
  background: none;
  font-size: .85rem;
  font-weight: 600;
  cursor: pointer;
  transition: all var(--dur);
  color: var(--text-secondary);
}
.tab-btn.active {
  background: var(--green-primary);
  color: var(--white);
  border-color: var(--green-primary);
}
.tab-panel { display: none; }
.tab-panel.active { display: block; }
.tab-panel p { color: var(--text-secondary); font-size: .95rem; }
.misi-list { padding-left: 0; }
.misi-list li {
  padding: .5rem 0 .5rem 1.5rem;
  position: relative;
  font-size: .9rem;
  color: var(--text-secondary);
  border-bottom: 1px dashed var(--border);
}
.misi-list li::before {
  content: '\2726';
  position: absolute;
  left: 0;
  color: var(--gold-primary);
  font-size: .75rem;
  top: .6rem;
}

```
<!-- END FILE: assets\css\sections\_about.css -->

---

<!-- START FILE: assets\css\sections\_downloads.css -->
## File: `assets\css\sections\_downloads.css`

```css
/* ============================================================
   DOWNLOADS SECTION
   ============================================================ */
.file-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem 1.25rem;
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  margin-bottom: .75rem;
  transition: all var(--dur);
}
.file-item:hover { background: var(--green-ghost); border-color: var(--green-light); }
.file-item__icon { font-size: 1.75rem; flex-shrink: 0; color: var(--green-primary); }
.file-item__info { flex: 1; min-width: 0; }
.file-item__name { font-weight: 600; font-size: .95rem; margin-bottom: .15rem; }
.file-item__meta { font-size: .8rem; color: var(--text-muted); }

/* ORG CHART */
.org-chart { text-align: center; padding: 2rem 0; overflow-x: auto; }
.org-chart .level { display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem; position: relative; }
.org-node {
  background: var(--white);
  border: 2px solid var(--green-primary);
  border-radius: var(--radius-md);
  padding: .75rem 1.25rem;
  font-size: .85rem;
  font-weight: 600;
  min-width: 160px;
  position: relative;
  color: var(--green-dark);
}
.org-node.head { border-color: var(--gold-primary); background: var(--gold-pale); color: var(--gold-primary); }

```
<!-- END FILE: assets\css\sections\_downloads.css -->

---

<!-- START FILE: assets\css\sections\_gallery.css -->
## File: `assets\css\sections\_gallery.css`

```css
/* ============================================================
   GALLERY SECTION
   ============================================================ */
.gallery-masonry { columns: 3; column-gap: 1rem; }
.gallery-item {
  break-inside: avoid;
  margin-bottom: 1rem;
  border-radius: var(--radius-md);
  overflow: hidden;
  position: relative;
  cursor: pointer;
}
.gallery-item img { width: 100%; display: block; transition: transform .5s var(--ease); }
.gallery-item:hover img { transform: scale(1.05); }
.gallery-item__overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(10,74,30,.85) 0%, transparent 60%);
  opacity: 0;
  transition: opacity var(--dur);
  display: flex;
  align-items: flex-end;
  padding: 1rem;
  color: var(--white);
  font-size: .85rem;
  font-weight: 600;
}
.gallery-item:hover .gallery-item__overlay { opacity: 1; }

```
<!-- END FILE: assets\css\sections\_gallery.css -->

---

<!-- START FILE: assets\css\sections\_hero.css -->
## File: `assets\css\sections\_hero.css`

```css
/* ============================================================
   HERO SECTION — Carousel / Slider
   ============================================================ */
.hero {
  position: relative;
  min-height: 92vh;
  display: flex;
  align-items: center;
  overflow: hidden;
  background: var(--green-dark);
}

/* ── Background Carousel ─────────────────────────────────── */
.hero__carousel {
  position: absolute;
  inset: 0;
  z-index: 0;
}
.hero__slide {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-color: var(--green-dark);
  opacity: 0;
  transform: scale(1.08);
  transition: opacity 1.2s ease, transform 7s ease-out;
  will-change: opacity, transform;
}
.hero__slide.active {
  opacity: 1;
  transform: scale(1);
}
/* Default gradient when no image is set */
.hero__slide:not([style*="background-image"]),
.hero__slide[style*="background-image: url('');"] {
  background: linear-gradient(135deg, var(--green-dark) 0%, #0e5a26 50%, #1a7a3c 100%);
}
.hero__overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    135deg,
    rgba(10, 74, 30, 0.85) 0%,
    rgba(26, 122, 60, 0.6) 50%,
    rgba(10, 74, 30, 0.75) 100%
  );
  z-index: 1;
}

/* ── Decorative Pattern ──────────────────────────────────── */
.hero__bg-pattern {
  position: absolute;
  inset: 0;
  background-image:
    radial-gradient(circle at 20% 30%, rgba(200,151,42,.1) 0%, transparent 50%),
    radial-gradient(circle at 80% 70%, rgba(255,255,255,.04) 0%, transparent 50%),
    url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M30 0l30 30-30 30L0 30z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  z-index: 2;
  pointer-events: none;
}

/* ── Layout ──────────────────────────────────────────────── */
.hero__inner {
  position: relative;
  z-index: 3;
  display: grid;
  grid-template-columns: 1.1fr 0.9fr;
  gap: 4rem;
  align-items: center;
  padding: 5rem 1.5rem;
  max-width: var(--container);
  margin: 0 auto;
  width: 100%;
}

/* ── Text Content ────────────────────────────────────────── */
.hero__content { color: var(--white); }
.hero__arabic {
  font-family: var(--font-arabic);
  font-size: 2rem;
  color: var(--gold-light);
  direction: rtl;
  text-align: right;
  margin-bottom: .25rem;
  opacity: .9;
}
.hero__bismillah-label {
  font-size: .75rem;
  color: rgba(255,255,255,.5);
  text-align: right;
  margin-bottom: 1.5rem;
  letter-spacing: .05em;
}
.hero__eyebrow {
  display: inline-flex;
  align-items: center;
  gap: .5rem;
  font-size: .8rem;
  font-weight: 600;
  letter-spacing: .1em;
  text-transform: uppercase;
  color: var(--gold-light);
  margin-bottom: 1rem;
}
.hero__eyebrow::before {
  content: '';
  display: block;
  width: 24px;
  height: 2px;
  background: var(--gold-primary);
}

/* ── Text Carousel ───────────────────────────────────────── */
.hero__text-carousel {
  position: relative;
  min-height: 160px;
}
.hero__text-slide {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.7s ease, transform 0.7s ease;
  pointer-events: none;
}
.hero__text-slide.active {
  position: relative;
  opacity: 1;
  transform: translateY(0);
  pointer-events: auto;
}
.hero h1 {
  font-size: clamp(2rem, 4vw, 3.5rem);
  color: var(--white);
  margin-bottom: .5rem;
  line-height: 1.15;
}
.hero h1 em {
  color: var(--gold-light);
  font-style: normal;
}
.hero__tagline {
  font-size: 1.1rem;
  color: rgba(255,255,255,.75);
  margin-bottom: 0;
  max-width: 500px;
}
.hero__actions {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-top: 2rem;
}

/* ── Slide Indicators ────────────────────────────────────── */
.hero__indicators {
  display: flex;
  gap: 0.5rem;
  margin-top: 2rem;
}
.hero__dot {
  width: 36px;
  height: 4px;
  border: none;
  border-radius: 2px;
  background: rgba(255,255,255,.3);
  cursor: pointer;
  transition: all var(--dur) var(--ease);
  padding: 0;
  position: relative;
  overflow: hidden;
}
.hero__dot.active {
  background: var(--gold-light);
  width: 52px;
}
/* Progress bar animation inside active dot */
.hero__dot.active::after {
  content: '';
  position: absolute;
  inset: 0;
  background: var(--gold-primary);
  transform-origin: left;
  animation: hero-dot-progress var(--hero-interval, 6s) linear;
}
@keyframes hero-dot-progress {
  from { transform: scaleX(0); }
  to   { transform: scaleX(1); }
}
.hero__dot:hover {
  background: rgba(255,255,255,.5);
}

/* ── Visual Side ─────────────────────────────────────────── */
.hero__visual {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.hero__stat-cards {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: .75rem;
}
.hero__stat-card {
  background: rgba(255,255,255,.1);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255,255,255,.15);
  border-radius: var(--radius-lg);
  padding: 1.25rem;
  text-align: center;
  color: var(--white);
  transition: all var(--dur) var(--ease);
}
.hero__stat-card:hover {
  background: rgba(255,255,255,.18);
  transform: translateY(-2px);
}
.hero__stat-num {
  font-size: 2.25rem;
  font-weight: 800;
  color: var(--gold-light);
  font-family: var(--font-heading);
  line-height: 1;
}
.hero__stat-label {
  font-size: .8rem;
  color: rgba(255,255,255,.75);
  margin-top: .25rem;
}
.hero__quick-links {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: .5rem;
}
.hero__quick-link {
  background: rgba(255,255,255,.08);
  border: 1px solid rgba(255,255,255,.1);
  border-radius: var(--radius-md);
  padding: .75rem .5rem;
  text-align: center;
  color: var(--white);
  font-size: .75rem;
  font-weight: 500;
  transition: all var(--dur) var(--ease);
  cursor: pointer;
  text-decoration: none;
}
.hero__quick-link:hover {
  background: var(--gold-primary);
  border-color: var(--gold-primary);
  color: var(--white);
  transform: translateY(-2px);
}
.hero__quick-link .icon {
  font-size: 1.4rem;
  margin-bottom: .3rem;
}

```
<!-- END FILE: assets\css\sections\_hero.css -->

---

<!-- START FILE: assets\css\sections\_news.css -->
## File: `assets\css\sections\_news.css`

```css
/* ============================================================
   NEWS / BERITA SECTION
   ============================================================ */
.news-featured { display: grid; grid-template-columns: 1.4fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem; }
.news-featured .card:first-child .card__image { aspect-ratio: 16/9; }
.news-list { display: flex; flex-direction: column; gap: 1rem; }
.news-item-small {
  display: flex;
  gap: 1rem;
  padding: .75rem;
  border-radius: var(--radius-md);
  border: 1px solid var(--border);
  transition: all var(--dur);
}
.news-item-small:hover { background: var(--green-ghost); border-color: var(--green-light); }
.news-item-small__image {
  width: 88px; height: 72px;
  border-radius: var(--radius-sm);
  overflow: hidden;
  flex-shrink: 0;
}
.news-item-small__image img { width: 100%; height: 100%; object-fit: cover; }
.news-item-small__title { font-size: .875rem; font-weight: 600; line-height: 1.4; margin-bottom: .3rem; color: var(--text-primary); }
.news-item-small__date { font-size: .75rem; color: var(--text-muted); }

```
<!-- END FILE: assets\css\sections\_news.css -->

---

<!-- START FILE: assets\css\sections\_stats.css -->
## File: `assets\css\sections\_stats.css`

```css
/* ============================================================
   STATISTIK SECTION
   ============================================================ */
.stat-block { text-align: center; padding: 2rem; }
.stat-block__num {
  font-size: 3.5rem;
  font-weight: 800;
  font-family: var(--font-heading);
  color: var(--gold-light);
  line-height: 1;
  margin-bottom: .25rem;
}
.stat-block__label { font-size: .9rem; color: rgba(255,255,255,.75); }
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4,1fr);
}
.stats-grid .stat-block + .stat-block {
  border-left: 1px solid rgba(255,255,255,.1);
}

```
<!-- END FILE: assets\css\sections\_stats.css -->

---

<!-- START FILE: assets\css\sections\_ticker.css -->
## File: `assets\css\sections\_ticker.css`

```css
/* ============================================================
   TICKER SECTION
   ============================================================ */
.ticker {
  background: var(--green-primary);
  color: var(--white);
  padding: .6rem 0;
  overflow: hidden;
  position: relative;
}
.ticker__label {
  position: absolute;
  left: 0; top: 0;
  height: 100%;
  background: var(--gold-primary);
  display: flex;
  align-items: center;
  padding: 0 1rem;
  font-size: .8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .05em;
  z-index: 2;
  white-space: nowrap;
}
.ticker__track {
  display: flex;
  gap: 4rem;
  animation: ticker-scroll 40s linear infinite;
  padding-left: 180px;
}
.ticker__item {
  font-size: .85rem;
  white-space: nowrap;
  display: flex;
  align-items: center;
  gap: .5rem;
}
.ticker__item::before { content: '\25C6'; font-size: .5rem; color: var(--gold-light); }
@keyframes ticker-scroll {
  from { transform: translateX(0); }
  to   { transform: translateX(-50%); }
}

```
<!-- END FILE: assets\css\sections\_ticker.css -->

---

<!-- START FILE: assets\css\utilities\_accessibility.css -->
## File: `assets\css\utilities\_accessibility.css`

```css
/* ============================================================
   ACCESSIBILITY
   ============================================================ */
:focus-visible {
  outline: 3px solid var(--green-primary);
  outline-offset: 3px;
}
.sr-only {
  position: absolute;
  width: 1px; height: 1px;
  padding: 0; margin: -1px;
  overflow: hidden;
  clip: rect(0,0,0,0);
  white-space: nowrap;
  border-width: 0;
}

```
<!-- END FILE: assets\css\utilities\_accessibility.css -->

---

<!-- START FILE: assets\css\utilities\_back-to-top.css -->
## File: `assets\css\utilities\_back-to-top.css`

```css
/* ============================================================
   BACK TO TOP BUTTON
   ============================================================ */
.back-to-top {
  position: fixed;
  bottom: 2rem; right: 2rem;
  width: 44px; height: 44px;
  background: var(--green-primary);
  color: var(--white);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem;
  cursor: pointer;
  border: none;
  box-shadow: var(--shadow-md);
  opacity: 0; visibility: hidden;
  transform: translateY(12px);
  transition: all var(--dur);
  z-index: 100;
}
.back-to-top.visible { opacity: 1; visibility: visible; transform: translateY(0); }
.back-to-top:hover { background: var(--green-dark); }

```
<!-- END FILE: assets\css\utilities\_back-to-top.css -->

---

<!-- START FILE: assets\css\utilities\_wordpress.css -->
## File: `assets\css\utilities\_wordpress.css`

```css
/* ============================================================
   WORDPRESS CORE CLASSES
   ============================================================ */
.wp-caption { text-align: center; }
.wp-caption-text { font-size: .85rem; color: var(--text-muted); margin-top: .5rem; font-style: italic; }
.aligncenter { display: block; margin: 0 auto; }
.alignleft { float: left; margin: 0 1.5rem 1rem 0; }
.alignright { float: right; margin: 0 0 1rem 1.5rem; }
.gallery { display: grid; grid-template-columns: repeat(3,1fr); gap: 1rem; }
.sticky { background: var(--green-ghost); border-left: 3px solid var(--green-primary); padding-left: 1rem; }

```
<!-- END FILE: assets\css\utilities\_wordpress.css -->

---

<!-- START FILE: assets\js\app.js -->
## File: `assets\js\app.js`

```javascript
/**
 * LP3AIK UM Kotabumi — Main JavaScript Entry Point
 *
 * Loads all feature modules. Each module is self-contained
 * with its own init function.
 *
 * @version 2.0.0
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    LP3AIK.StickyHeader.init();
    LP3AIK.MobileMenu.init();
    LP3AIK.Tabs.init();
    LP3AIK.GalleryLightbox.init();
    LP3AIK.ContactForm.init();
    LP3AIK.BackToTop.init();
    LP3AIK.SearchModal.init();
    LP3AIK.CounterAnimation.init();
    LP3AIK.ScrollAnimations.init();
  });
})();

```
<!-- END FILE: assets\js\app.js -->

---

<!-- START FILE: assets\js\modules\back-to-top.js -->
## File: `assets\js\modules\back-to-top.js`

```javascript
/**
 * Module: Back to Top
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.BackToTop = {
  init: function () {
    var btn = document.getElementById('back-to-top');
    if (!btn) return;

    window.addEventListener('scroll', function () {
      btn.classList.toggle('visible', window.scrollY > 400);
    }, { passive: true });

    btn.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }
};

```
<!-- END FILE: assets\js\modules\back-to-top.js -->

---

<!-- START FILE: assets\js\modules\contact-form.js -->
## File: `assets\js\modules\contact-form.js`

```javascript
/**
 * Module: Contact Form (AJAX)
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.ContactForm = {
  init: function () {
    var form = document.getElementById('lp3aik-contact-form');
    if (!form) return;

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      var btn   = form.querySelector('[type="submit"]');
      var alert = form.querySelector('.form-alert');
      var data  = new FormData(form);

      if (!window.lp3aikData) return;
      data.append('action', 'lp3aik_contact');
      data.append('nonce',  window.lp3aikData.nonce);

      btn.disabled = true;
      btn.textContent = 'Mengirim...';
      if (alert) { alert.className = 'form-alert'; alert.textContent = ''; }

      fetch(window.lp3aikData.ajaxUrl, { method: 'POST', body: data })
        .then(function (r) { return r.json(); })
        .then(function (res) {
          if (alert) {
            alert.className = 'alert ' + (res.success ? 'alert-success' : 'alert-info');
            alert.textContent = res.data ? res.data.message : (res.success ? 'Pesan terkirim!' : 'Terjadi kesalahan.');
          }
          if (res.success) form.reset();
        })
        .catch(function () {
          if (alert) { alert.className = 'alert alert-info'; alert.textContent = 'Koneksi gagal. Coba lagi.'; }
        })
        .finally(function () {
          btn.disabled = false;
          btn.textContent = 'Kirim Pesan';
        });
    });
  }
};

```
<!-- END FILE: assets\js\modules\contact-form.js -->

---

<!-- START FILE: assets\js\modules\counter-animation.js -->
## File: `assets\js\modules\counter-animation.js`

```javascript
/**
 * Module: Counter Animation
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.CounterAnimation = {
  init: function () {
    var counters = document.querySelectorAll('.stat-block__num, .hero__stat-num');
    if (!counters.length || !('IntersectionObserver' in window)) return;

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el       = entry.target;
        var text     = el.textContent.trim();
        var numMatch = text.match(/(\d[\d,]*)/);
        if (!numMatch) return;

        var target   = parseInt(numMatch[1].replace(/,/g, ''));
        var suffix   = text.replace(/[\d,]+/, '');
        var duration = 1800;
        var step     = duration / 60;
        var inc      = target / (duration / step);
        var current  = 0;

        var timer = setInterval(function () {
          current += inc;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          el.textContent = Math.floor(current).toLocaleString('id-ID') + suffix;
        }, step);

        observer.unobserve(el);
      });
    }, { threshold: 0.5 });

    counters.forEach(function (el) { observer.observe(el); });
  }
};

```
<!-- END FILE: assets\js\modules\counter-animation.js -->

---

<!-- START FILE: assets\js\modules\gallery-lightbox.js -->
## File: `assets\js\modules\gallery-lightbox.js`

```javascript
/**
 * Module: Gallery Lightbox
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.GalleryLightbox = {
  init: function () {
    var lightbox = document.getElementById('lightbox');
    var lbImg    = document.getElementById('lightbox-img');
    var lbClose  = document.getElementById('lightbox-close');
    if (!lightbox || !lbImg) return;

    document.querySelectorAll('.gallery-item').forEach(function (item) {
      item.addEventListener('click', function () {
        var src = this.getAttribute('data-src') || (this.querySelector('img') ? this.querySelector('img').src : null);
        if (!src) return;
        lbImg.src = src;
        lbImg.alt = this.querySelector('.gallery-item__overlay') ? this.querySelector('.gallery-item__overlay').textContent : '';
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
      });
    });

    function closeLightbox() {
      lightbox.classList.remove('active');
      document.body.style.overflow = '';
      setTimeout(function () { lbImg.src = ''; }, 300);
    }

    if (lbClose) lbClose.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', function (e) {
      if (e.target === lightbox) closeLightbox();
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') closeLightbox();
    });
  }
};

```
<!-- END FILE: assets\js\modules\gallery-lightbox.js -->

---

<!-- START FILE: assets\js\modules\hero-carousel.js -->
## File: `assets\js\modules\hero-carousel.js`

```javascript
/**
 * Hero Carousel / Slider Module
 *
 * Auto-plays background image slides + text slides with smooth transitions.
 * Supports dot navigation and custom interval from data attribute.
 *
 * @package lp3aik-umk
 */
(function () {
  'use strict';

  const hero = document.querySelector('.hero[data-interval]');
  if (!hero) return;

  const bgSlides   = hero.querySelectorAll('.hero__slide');
  const textSlides = hero.querySelectorAll('.hero__text-slide');
  const dots       = hero.querySelectorAll('.hero__dot');
  const total      = bgSlides.length;

  if (total <= 1) return;

  const interval = parseInt(hero.dataset.interval, 10) || 6000;
  let current = 0;
  let timer = null;
  let isHovered = false;

  // Set CSS variable for dot progress animation
  hero.style.setProperty('--hero-interval', interval + 'ms');

  function goToSlide(index) {
    if (index === current && bgSlides[current].classList.contains('active')) return;

    // Deactivate current
    bgSlides[current].classList.remove('active');
    textSlides[current].classList.remove('active');
    if (dots[current]) dots[current].classList.remove('active');

    // Update current
    current = index;

    // Activate new
    bgSlides[current].classList.add('active');
    textSlides[current].classList.add('active');
    if (dots[current]) {
      dots[current].classList.remove('active');
      // Force reflow to restart animation
      void dots[current].offsetWidth;
      dots[current].classList.add('active');
    }
  }

  function nextSlide() {
    goToSlide((current + 1) % total);
  }

  function startAutoPlay() {
    stopAutoPlay();
    timer = setInterval(function () {
      if (!isHovered) {
        nextSlide();
      }
    }, interval);
  }

  function stopAutoPlay() {
    if (timer) {
      clearInterval(timer);
      timer = null;
    }
  }

  // Dot click handlers
  dots.forEach(function (dot, idx) {
    dot.addEventListener('click', function () {
      goToSlide(idx);
      startAutoPlay(); // Restart timer
    });
  });

  // Pause on hover (optional UX enhancement)
  hero.addEventListener('mouseenter', function () {
    isHovered = true;
  });
  hero.addEventListener('mouseleave', function () {
    isHovered = false;
  });

  // Touch swipe support
  let touchStartX = 0;
  let touchEndX = 0;

  hero.addEventListener('touchstart', function (e) {
    touchStartX = e.changedTouches[0].screenX;
  }, { passive: true });

  hero.addEventListener('touchend', function (e) {
    touchEndX = e.changedTouches[0].screenX;
    const diff = touchStartX - touchEndX;
    if (Math.abs(diff) > 50) {
      if (diff > 0) {
        // Swipe left → next
        goToSlide((current + 1) % total);
      } else {
        // Swipe right → prev
        goToSlide((current - 1 + total) % total);
      }
      startAutoPlay();
    }
  }, { passive: true });

  // Initialize: force first dot progress animation
  if (dots[0]) {
    dots[0].classList.remove('active');
    void dots[0].offsetWidth;
    dots[0].classList.add('active');
  }

  // Start autoplay
  startAutoPlay();

  // Pause when tab is not visible
  document.addEventListener('visibilitychange', function () {
    if (document.hidden) {
      stopAutoPlay();
    } else {
      startAutoPlay();
    }
  });
})();

```
<!-- END FILE: assets\js\modules\hero-carousel.js -->

---

<!-- START FILE: assets\js\modules\mobile-menu.js -->
## File: `assets\js\modules\mobile-menu.js`

```javascript
/**
 * Module: Mobile Menu
 */
window.LP3AIK = window.LP3AIK || {};

  LP3AIK.MobileMenu = {
    init: function () {
      var toggle = document.getElementById('nav-toggle');
      var drawer = document.getElementById('mobile-menu-drawer');
      var nav    = document.querySelector('.primary-nav');
      if (!toggle || !drawer || !nav) return;
  
      toggle.addEventListener('click', function () {
        var open = drawer.classList.toggle('open');
        toggle.classList.toggle('active', open);
        toggle.setAttribute('aria-expanded', open);
      });

    // Mobile dropdown toggle
    nav.querySelectorAll('.menu-item-has-children > a').forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (window.innerWidth <= 768) {
          e.preventDefault();
          this.parentElement.classList.toggle('open');
        }
      });
    });

    // Close nav on outside click
    document.addEventListener('click', function (e) {
      if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
        drawer.classList.remove('open');
        toggle.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }
};

```
<!-- END FILE: assets\js\modules\mobile-menu.js -->

---

<!-- START FILE: assets\js\modules\scroll-animations.js -->
## File: `assets\js\modules\scroll-animations.js`

```javascript
/**
 * Module: Scroll Animations
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.ScrollAnimations = {
  init: function () {
    if (!('IntersectionObserver' in window)) return;

    var style = document.createElement('style');
    style.textContent =
      '.anim-fade { opacity: 0; transform: translateY(24px); transition: opacity .6s ease, transform .6s ease; }' +
      '.anim-fade.visible { opacity: 1; transform: translateY(0); }';
    document.head.appendChild(style);

    var targets = document.querySelectorAll('.card, .program-card, .team-card, .stat-block, .contact-card');
    targets.forEach(function (el, i) {
      el.classList.add('anim-fade');
      el.style.transitionDelay = (i % 4) * 0.08 + 's';
    });

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });

    targets.forEach(function (el) { observer.observe(el); });
  }
};

```
<!-- END FILE: assets\js\modules\scroll-animations.js -->

---

<!-- START FILE: assets\js\modules\search-modal.js -->
## File: `assets\js\modules\search-modal.js`

```javascript
/**
 * Module: Search Modal
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.SearchModal = {
  init: function () {
    var modal  = document.getElementById('search-modal');
    var toggle = document.getElementById('search-toggle');
    if (!modal || !toggle) return;

    toggle.addEventListener('click', function () {
      modal.classList.add('active');
      var input = modal.querySelector('input[type="search"]');
      if (input) setTimeout(function () { input.focus(); }, 100);
    });

    modal.addEventListener('click', function (e) {
      if (e.target === modal) modal.classList.remove('active');
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') modal.classList.remove('active');
    });
  }
};

```
<!-- END FILE: assets\js\modules\search-modal.js -->

---

<!-- START FILE: assets\js\modules\sticky-header.js -->
## File: `assets\js\modules\sticky-header.js`

```javascript
/**
 * Module: Sticky Header
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.StickyHeader = {
  init: function () {
    var header = document.getElementById('site-header');
    if (!header) return;

    function onScroll() {
      header.classList.toggle('scrolled', window.scrollY > 60);
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }
};

```
<!-- END FILE: assets\js\modules\sticky-header.js -->

---

<!-- START FILE: assets\js\modules\tabs.js -->
## File: `assets\js\modules\tabs.js`

```javascript
/**
 * Module: Tabs (Visi Misi)
 */
window.LP3AIK = window.LP3AIK || {};

LP3AIK.Tabs = {
  init: function () {
    document.querySelectorAll('.tab-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var tabId  = this.getAttribute('data-tab');
        var parent = this.closest('.about__visi-misi') || this.closest('.tabs-wrapper') || document;

        parent.querySelectorAll('.tab-btn').forEach(function (b) { b.classList.remove('active'); });
        parent.querySelectorAll('.tab-panel').forEach(function (p) { p.classList.remove('active'); });

        this.classList.add('active');
        var panel = parent.querySelector('#tab-' + tabId);
        if (panel) panel.classList.add('active');
      });
    });
  }
};

```
<!-- END FILE: assets\js\modules\tabs.js -->

---

<!-- START FILE: inc\admin\admin-columns.php -->
## File: `inc\admin\admin-columns.php`

```php
<?php
/**
 * Admin Column Customizations.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Tim columns
add_filter('manage_lp3aik_tim_posts_columns', function (array $cols): array {
    return array_merge(['cb' => $cols['cb'], 'title' => $cols['title']], [
        'jabatan' => __('Jabatan', 'lp3aik-umk'),
        'nidn'    => __('NIDN',    'lp3aik-umk'),
        'email'   => __('Email',   'lp3aik-umk'),
        'order'   => __('Urutan',  'lp3aik-umk'),
    ], ['date' => $cols['date']]);
});

add_action('manage_lp3aik_tim_posts_custom_column', function (string $col, int $id): void {
    match($col) {
        'jabatan' => print esc_html(get_post_meta($id, '_tim_jabatan', true)),
        'nidn'    => print esc_html(get_post_meta($id, '_tim_nidn', true)),
        'email'   => print '<a href="mailto:' . esc_attr(get_post_meta($id, '_tim_email', true)) . '">' . esc_html(get_post_meta($id, '_tim_email', true)) . '</a>',
        'order'   => print esc_html(get_post_field('menu_order', $id)),
        default   => '',
    };
}, 10, 2);

```
<!-- END FILE: inc\admin\admin-columns.php -->

---

<!-- START FILE: inc\ajax\contact-handler.php -->
## File: `inc\ajax\contact-handler.php`

```php
<?php
/**
 * AJAX: Contact Form Handler with honeypot anti-spam.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('wp_ajax_lp3aik_contact',        'lp3aik_handle_contact');
add_action('wp_ajax_nopriv_lp3aik_contact', 'lp3aik_handle_contact');

function lp3aik_handle_contact(): void {
    check_ajax_referer('lp3aik_nonce', 'nonce');

    // Honeypot anti-spam — if this hidden field is filled, it's a bot
    if (!empty($_POST['website_url'] ?? '')) {
        wp_send_json_error(['message' => __('Spam terdeteksi.', 'lp3aik-umk')]);
    }

    $name    = sanitize_text_field($_POST['name']    ?? '');
    $email   = sanitize_email($_POST['email']        ?? '');
    $subject = sanitize_text_field($_POST['subject'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    if (!$name || !$email || !$message || !is_email($email)) {
        wp_send_json_error(['message' => __('Mohon lengkapi semua kolom dengan benar.', 'lp3aik-umk')]);
    }

    $to      = lp3aik_opt('lp3aik_email', get_option('admin_email'));
    $headers = ["Content-Type: text/html; charset=UTF-8", "From: {$name} <{$email}>", "Reply-To: {$email}"];
    $body    = "<b>Nama:</b> " . esc_html($name) . "<br>"
             . "<b>Email:</b> " . esc_html($email) . "<br>"
             . "<b>Perihal:</b> " . esc_html($subject) . "<br><br>"
             . "<b>Pesan:</b><br>" . nl2br(esc_html($message));

    $sent = wp_mail($to, "[LP3AIK] {$subject}", $body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => __('Pesan berhasil dikirim. Kami akan segera menghubungi Anda.', 'lp3aik-umk')]);
    } else {
        wp_send_json_error(['message' => __('Gagal mengirim pesan. Silakan coba lagi atau hubungi kami langsung.', 'lp3aik-umk')]);
    }
}

```
<!-- END FILE: inc\ajax\contact-handler.php -->

---

<!-- START FILE: inc\customizer\customizer.php -->
## File: `inc\customizer\customizer.php`

```php
<?php
/**
 * Customizer: Theme Options Panel.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('customize_register', function (WP_Customize_Manager $wp_customize) {

    // Panel: LP3AIK
    $wp_customize->add_panel('lp3aik_panel', [
        'title'    => __('LP3AIK Theme Options', 'lp3aik-umk'),
        'priority' => 10,
    ]);

    // ── Section: Identitas Lembaga ──────────────────────────
    $wp_customize->add_section('lp3aik_identity', [
        'title'    => __('Identitas Lembaga', 'lp3aik-umk'),
        'panel'    => 'lp3aik_panel',
    ]);

    $identity_fields = [
        'lp3aik_tagline'       => ['Tagline/Slogan',           'Membangun Generasi Islami dan Berkemuhammadiyahan'],
        'lp3aik_email'         => ['Email LP3AIK',             'lp3aik@umkotabumi.ac.id'],
        'lp3aik_phone'         => ['Telepon',                  '+62 ...'],
        'lp3aik_whatsapp'      => ['WhatsApp',                 '+62 ...'],
        'lp3aik_address'       => ['Alamat',                   'Jl. ...'],
        'lp3aik_facebook'      => ['URL Facebook',             ''],
        'lp3aik_instagram'     => ['URL Instagram',            ''],
        'lp3aik_youtube'       => ['URL YouTube',              ''],
        'lp3aik_ticker'        => ['Running Text (pisahkan dgn |)', 'Selamat datang di LP3AIK UM Kotabumi | Pendaftaran program terbuka'],
    ];

    foreach ($identity_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($id, ['label' => __($label,'lp3aik-umk'), 'section' => 'lp3aik_identity', 'type' => 'text']);
    }

    // ── Section: Hero Slider / Carousel ─────────────────────
    $wp_customize->add_section('lp3aik_hero', [
        'title'       => __('Hero Slider (Beranda)', 'lp3aik-umk'),
        'panel'       => 'lp3aik_panel',
        'description' => __('Kelola slider/carousel pada bagian hero di beranda. Maksimal 5 slide.', 'lp3aik-umk'),
    ]);

    // Jumlah slide aktif
    $wp_customize->add_setting('lp3aik_hero_slide_count', [
        'default'           => '3',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('lp3aik_hero_slide_count', [
        'label'   => __('Jumlah Slide Aktif', 'lp3aik-umk'),
        'section' => 'lp3aik_hero',
        'type'    => 'select',
        'choices' => ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'],
    ]);

    // Auto-play interval
    $wp_customize->add_setting('lp3aik_hero_interval', [
        'default'           => '6000',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('lp3aik_hero_interval', [
        'label'       => __('Interval Auto-play (ms)', 'lp3aik-umk'),
        'description' => __('Durasi setiap slide dalam milidetik. Default: 6000 (6 detik)', 'lp3aik-umk'),
        'section'     => 'lp3aik_hero',
        'type'        => 'number',
        'input_attrs' => ['min' => 2000, 'max' => 15000, 'step' => 500],
    ]);

    // Overlay opacity
    $wp_customize->add_setting('lp3aik_hero_overlay', [
        'default'           => '55',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('lp3aik_hero_overlay', [
        'label'       => __('Overlay Gelap (%)', 'lp3aik-umk'),
        'description' => __('Tingkat kegelapan overlay di atas gambar. 0 = tanpa overlay, 100 = hitam penuh.', 'lp3aik-umk'),
        'section'     => 'lp3aik_hero',
        'type'        => 'range',
        'input_attrs' => ['min' => 0, 'max' => 100, 'step' => 5],
    ]);

    // Per-slide settings (5 slides max)
    for ($i = 1; $i <= 5; $i++) {
        // Separator
        $wp_customize->add_setting("lp3aik_hero_sep_{$i}", ['sanitize_callback' => 'sanitize_text_field']);
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "lp3aik_hero_sep_{$i}", [
            'label'   => sprintf(__('── Slide %d ──', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
            'type'    => 'hidden',
        ]));

        // Background image
        $wp_customize->add_setting("lp3aik_hero_slide_{$i}_image", [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "lp3aik_hero_slide_{$i}_image", [
            'label'   => sprintf(__('Slide %d — Gambar Background', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
        ]));

        // Title
        $defaults_title = [
            1 => 'Membangun Generasi <em>Islami</em> yang Unggul',
            2 => 'Pengkajian <em>Al-Islam</em> & Kemuhammadiyahan',
            3 => 'Mengabdi dengan <em>Ilmu</em> & Akhlak',
            4 => 'Program Pembinaan <em>AIK</em> Terstruktur',
            5 => 'Bersama Membangun <em>Kampus Islami</em>',
        ];
        $wp_customize->add_setting("lp3aik_hero_slide_{$i}_title", [
            'default'           => $defaults_title[$i] ?? '',
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("lp3aik_hero_slide_{$i}_title", [
            'label'   => sprintf(__('Slide %d — Judul', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
            'type'    => 'text',
        ]);

        // Subtitle
        $defaults_sub = [
            1 => 'Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — mendidik dengan nilai, mengabdi dengan ilmu.',
            2 => 'Mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.',
            3 => 'Membentuk sivitas akademika yang berakhlak mulia dan bersemangat Kemuhammadiyahan.',
            4 => 'Program terstruktur untuk seluruh mahasiswa, dosen, dan tenaga kependidikan.',
            5 => 'Universitas Muhammadiyah Kotabumi — kampus yang berlandaskan nilai-nilai Islam.',
        ];
        $wp_customize->add_setting("lp3aik_hero_slide_{$i}_subtitle", [
            'default'           => $defaults_sub[$i] ?? '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("lp3aik_hero_slide_{$i}_subtitle", [
            'label'   => sprintf(__('Slide %d — Subjudul', 'lp3aik-umk'), $i),
            'section' => 'lp3aik_hero',
            'type'    => 'textarea',
        ]);
    }

    // ── Section: Statistik ──────────────────────────────────
    $wp_customize->add_section('lp3aik_stats', [
        'title' => __('Statistik / Capaian', 'lp3aik-umk'),
        'panel' => 'lp3aik_panel',
    ]);

    $stat_fields = [
        'lp3aik_stat_1_num'   => ['Statistik 1 — Angka',  '500+'],
        'lp3aik_stat_1_label' => ['Statistik 1 — Label',  'Mahasiswa Terdidik'],
        'lp3aik_stat_2_num'   => ['Statistik 2 — Angka',  '12'],
        'lp3aik_stat_2_label' => ['Statistik 2 — Label',  'Program AIK'],
        'lp3aik_stat_3_num'   => ['Statistik 3 — Angka',  '20+'],
        'lp3aik_stat_3_label' => ['Statistik 3 — Label',  'Tahun Berdiri'],
        'lp3aik_stat_4_num'   => ['Statistik 4 — Angka',  '30+'],
        'lp3aik_stat_4_label' => ['Statistik 4 — Label',  'Tenaga Pengajar'],
    ];

    foreach ($stat_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($id, ['label' => __($label,'lp3aik-umk'), 'section' => 'lp3aik_stats', 'type' => 'text']);
    }

    // ── Section: Profil / About ─────────────────────────────
    $wp_customize->add_section('lp3aik_about', [
        'title' => __('Profil / Tentang Kami', 'lp3aik-umk'),
        'panel' => 'lp3aik_panel',
    ]);

    // About image
    $wp_customize->add_setting('lp3aik_about_image', ['default' => '', 'sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'lp3aik_about_image', [
        'label'   => __('Gambar Profil', 'lp3aik-umk'),
        'section' => 'lp3aik_about',
    ]));

    $about_fields = [
        'lp3aik_about_text'  => ['Deskripsi Profil (paragraf 1)', 'LP3AIK (Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan) adalah unit lembaga di Universitas Muhammadiyah Kotabumi.'],
        'lp3aik_about_text2' => ['Deskripsi Profil (paragraf 2)', 'Kami berkomitmen mencetak generasi yang unggul secara intelektual dan berakhlak mulia.'],
        'lp3aik_visi'        => ['Visi', 'Menjadi lembaga terdepan dalam pengkajian, pengembangan, dan pengamalan Al-Islam dan Kemuhammadiyahan.'],
        'lp3aik_misi'        => ['Misi (pisahkan baris baru)', "Mengintegrasikan nilai AIK ke dalam seluruh program akademik\nMenyelenggarakan program pembinaan AIK secara terstruktur"],
        'lp3aik_tujuan'      => ['Tujuan', 'Terwujudnya sivitas akademika yang memiliki pemahaman dan pengamalan Al-Islam dan Kemuhammadiyahan.'],
    ];

    foreach ($about_fields as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'wp_kses_post', 'transport' => 'refresh']);
        $wp_customize->add_control($id, ['label' => __($label,'lp3aik-umk'), 'section' => 'lp3aik_about', 'type' => 'textarea']);
    }
});

```
<!-- END FILE: inc\customizer\customizer.php -->

---

<!-- START FILE: inc\enqueue\enqueue-assets.php -->
## File: `inc\enqueue\enqueue-assets.php`

```php
<?php
/**
 * Enqueue Scripts & Styles.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('wp_enqueue_scripts', function () {

    // ── CDN: Bootstrap 5.3 ──────────────────────────────────
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true);

    // ── CDN: Font Awesome 6.5 ───────────────────────────────
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', [], '6.5.2');

    // ── Google Fonts ────────────────────────────────────────
    wp_enqueue_style('lp3aik-fonts', 'https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap', [], null);

    // ── WordPress-required style.css ────────────────────────
    wp_enqueue_style('lp3aik-style', get_stylesheet_uri(), ['bootstrap', 'fontawesome', 'lp3aik-fonts'], LP3AIK_VERSION);

    // ── Modular app.css ─────────────────────────────────────
    wp_enqueue_style('lp3aik-app', LP3AIK_URI . '/assets/css/app.css', ['lp3aik-style'], LP3AIK_VERSION);

    // ── JS Modules (loaded before app.js) ───────────────────
    $js_modules = [
        'sticky-header',
        'mobile-menu',
        'tabs',
        'hero-carousel',
        'gallery-lightbox',
        'contact-form',
        'back-to-top',
        'search-modal',
        'counter-animation',
        'scroll-animations',
    ];

    foreach ($js_modules as $module) {
        wp_enqueue_script(
            "lp3aik-{$module}",
            LP3AIK_URI . "/assets/js/modules/{$module}.js",
            ['bootstrap-js'],
            LP3AIK_VERSION,
            true
        );
    }

    // ── Main app.js (init, loaded last) ─────────────────────
    wp_enqueue_script('lp3aik-main', LP3AIK_URI . '/assets/js/app.js', array_map(fn($m) => "lp3aik-{$m}", $js_modules), LP3AIK_VERSION, true);

    // ── Localize script data ────────────────────────────────
    wp_localize_script('lp3aik-main', 'lp3aikData', [
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('lp3aik_nonce'),
        'siteUrl'  => get_site_url(),
        'themeUri' => LP3AIK_URI,
    ]);

    // ── Comment reply ───────────────────────────────────────
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
});

```
<!-- END FILE: inc\enqueue\enqueue-assets.php -->

---

<!-- START FILE: inc\helpers\navigation.php -->
## File: `inc\helpers\navigation.php`

```php
<?php
/**
 * Navigation Helpers.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

/**
 * Fallback navigation when no menu is assigned via Appearance > Menus.
 * Menampilkan contoh Dropdown menu sesuai instruksi.
 */
function lp3aik_default_menu(): void {
    $request_path = rtrim(wp_parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
    
    // Fungsi bantuan untuk deteksi halaman aktif
    $is_active = function(string $path) use ($request_path): bool {
        if ($path === '/' && ($request_path === '' || $request_path === '/')) return true;
        if ($path !== '/' && str_contains($request_path, $path)) return true;
        return false;
    };

    // Resolve CPT archive URLs
    $program_url  = get_post_type_archive_link('lp3aik_program') ?: home_url('/program');
    $galeri_url   = get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri');
    $unduhan_url  = get_post_type_archive_link('lp3aik_unduhan') ?: home_url('/unduhan');
    ?>
    <ul class="primary-nav">
        <!-- Beranda -->
        <li class="<?php echo $is_active('/') ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Beranda', 'lp3aik-umk'); ?></a>
        </li>
        
        <!-- Dropdown: Tentang Kami -->
        <li class="menu-item-has-children <?php echo ($is_active('/profil') || $is_active('/struktur') || $is_active('/visi-misi')) ? 'current-menu-ancestor' : ''; ?>">
            <a href="#"><?php _e('Tentang Kami', 'lp3aik-umk'); ?> <i class="fa-solid fa-chevron-down fa-2xs ms-1"></i></a>
            <ul class="sub-menu">
                <li><a href="<?php echo esc_url(home_url('/profil')); ?>"><?php _e('Profil', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/visi-misi')); ?>"><?php _e('Visi & Misi', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/struktur-organisasi')); ?>"><?php _e('Struktur Organisasi', 'lp3aik-umk'); ?></a></li>
            </ul>
        </li>
        
        <!-- Program -->
        <li class="<?php echo $is_active('/program') ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url($program_url); ?>"><?php _e('Program', 'lp3aik-umk'); ?></a>
        </li>
        
        <!-- Dropdown: Informasi -->
        <li class="menu-item-has-children <?php echo ($is_active('/berita') || $is_active('/galeri') || $is_active('/unduhan')) ? 'current-menu-ancestor' : ''; ?>">
            <a href="#"><?php _e('Informasi', 'lp3aik-umk'); ?> <i class="fa-solid fa-chevron-down fa-2xs ms-1"></i></a>
            <ul class="sub-menu">
                <li><a href="<?php echo esc_url(home_url('/berita')); ?>"><?php _e('Berita & Pengumuman', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url($galeri_url); ?>"><?php _e('Galeri Kegiatan', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url($unduhan_url); ?>"><?php _e('Unduhan / File', 'lp3aik-umk'); ?></a></li>
            </ul>
        </li>
        
        <!-- Kontak -->
        <li class="<?php echo $is_active('/kontak') ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/kontak')); ?>"><?php _e('Hubungi Kami', 'lp3aik-umk'); ?></a>
        </li>
    </ul>
    <?php
}

```
<!-- END FILE: inc\helpers\navigation.php -->

---

<!-- START FILE: inc\helpers\page-templates.php -->
## File: `inc\helpers\page-templates.php`

```php
<?php
/**
 * Page Template Registration, Routing & Auto-Create Pages.
 *
 * Menangani semua routing template di luar WordPress Template Hierarchy standar:
 * - CPT archives & singles dari folder /templates/
 * - Page templates by slug (profil, berita, kontak, dll.)
 * - Auto-create halaman WordPress saat theme diaktifkan
 * - Virtual page fallback jika halaman belum ada di database
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// =====================================================================
// CONSTANTS: Mapping slug → template file
// =====================================================================
define('LP3AIK_PAGE_TEMPLATES', [
    'profil'                => 'templates/page-profil.php',
    'visi-misi'             => 'templates/page-visi-misi.php',
    'struktur-organisasi'   => 'templates/page-struktur-organisasi.php',
    'berita'                => 'templates/page-berita.php',
    'kontak'                => 'templates/page-kontak.php',
]);

define('LP3AIK_PAGE_TITLES', [
    'profil'                => 'Profil LP3AIK',
    'visi-misi'             => 'Visi & Misi',
    'struktur-organisasi'   => 'Struktur Organisasi',
    'berita'                => 'Berita & Pengumuman',
    'kontak'                => 'Hubungi Kami',
]);

// =====================================================================
// 1) REGISTER PAGE TEMPLATES (wp-admin dropdown)
// =====================================================================
add_filter('theme_page_templates', function (array $templates): array {
    foreach (LP3AIK_PAGE_TEMPLATES as $slug => $file) {
        $templates[$file] = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst($slug);
    }
    return $templates;
});

// =====================================================================
// 2) MASTER TEMPLATE ROUTER — template_include filter
//    Handles ALL custom routing: CPT archives, CPT singles, page slugs.
// =====================================================================
add_filter('template_include', function (string $template): string {
    $tpl_dir = get_template_directory() . '/templates/';

    // ── CPT Archives ────────────────────────────────────────
    $cpt_archives = [
        'lp3aik_program' => 'archive-lp3aik_program.php',
        'lp3aik_galeri'  => 'archive-lp3aik_galeri.php',
        'lp3aik_unduhan' => 'archive-lp3aik_unduhan.php',
    ];
    foreach ($cpt_archives as $post_type => $file) {
        if (is_post_type_archive($post_type)) {
            $custom = $tpl_dir . $file;
            if (file_exists($custom)) return $custom;
        }
    }

    // ── CPT Singles ─────────────────────────────────────────
    $cpt_singles = [
        'lp3aik_program' => 'single-lp3aik_program.php',
        'lp3aik_galeri'  => 'single-lp3aik_galeri.php',
        'lp3aik_unduhan' => 'single-lp3aik_unduhan.php',
    ];
    foreach ($cpt_singles as $post_type => $file) {
        if (is_singular($post_type)) {
            $custom = $tpl_dir . $file;
            if (file_exists($custom)) return $custom;
        }
    }

    // ── WordPress Pages — by slug ───────────────────────────
    // If WordPress found a page, route to its template
    if (is_page()) {
        $page_obj = get_queried_object();
        $slug = $page_obj->post_name ?? '';

        if (isset(LP3AIK_PAGE_TEMPLATES[$slug])) {
            $custom = get_template_directory() . '/' . LP3AIK_PAGE_TEMPLATES[$slug];
            if (file_exists($custom)) return $custom;
        }

        // Also check _wp_page_template meta
        $meta_template = get_post_meta($page_obj->ID, '_wp_page_template', true);
        if ($meta_template && $meta_template !== 'default') {
            $custom = get_template_directory() . '/' . $meta_template;
            if (file_exists($custom)) return $custom;
        }
    }

    // ── Virtual Page Fallback — when pages don't exist in DB ──
    // If WordPress returned 404 but the URL matches a known slug,
    // load the template anyway and set proper headers.
    if (is_404()) {
        $request_path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH), '/');
        // Remove any WordPress subdirectory prefix
        $home_path = trim(parse_url(home_url(), PHP_URL_PATH) ?? '', '/');
        if ($home_path && strpos($request_path, $home_path) === 0) {
            $request_path = trim(substr($request_path, strlen($home_path)), '/');
        }
        $slug = sanitize_title($request_path);

        if (isset(LP3AIK_PAGE_TEMPLATES[$slug])) {
            $custom = get_template_directory() . '/' . LP3AIK_PAGE_TEMPLATES[$slug];
            if (file_exists($custom)) {
                // Override 404 status
                global $wp_query;
                status_header(200);
                $wp_query->is_404 = false;
                $wp_query->is_page = true;

                // Create a virtual post object for the_title() etc.
                $virtual_post = new stdClass();
                $virtual_post->ID = 0;
                $virtual_post->post_title = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst($slug);
                $virtual_post->post_name = $slug;
                $virtual_post->post_content = '';
                $virtual_post->post_excerpt = '';
                $virtual_post->post_status = 'publish';
                $virtual_post->post_type = 'page';
                $virtual_post->post_date = current_time('mysql');
                $virtual_post->post_author = 1;
                $virtual_post->comment_status = 'closed';
                $virtual_post->ping_status = 'closed';
                $virtual_post->filter = 'raw';

                $wp_query->posts = [new WP_Post($virtual_post)];
                $wp_query->post_count = 1;
                $wp_query->found_posts = 1;
                $wp_query->post = $wp_query->posts[0];

                $GLOBALS['post'] = $wp_query->post;
                setup_postdata($GLOBALS['post']);

                return $custom;
            }
        }
    }

    return $template;
}, 99); // Priority 99 to run after other filters

// =====================================================================
// 3) AUTO-CREATE PAGES ON THEME ACTIVATION
// =====================================================================
add_action('after_switch_theme', 'lp3aik_create_theme_pages');

/**
 * Create required WordPress pages with correct template meta.
 * Also runs once on first load via init hook.
 */
function lp3aik_create_theme_pages(): void {
    foreach (LP3AIK_PAGE_TEMPLATES as $slug => $template_file) {
        $title = LP3AIK_PAGE_TITLES[$slug] ?? ucfirst($slug);

        // Check if page exists by slug
        $existing = get_page_by_path($slug);
        if ($existing) {
            // Ensure template is assigned
            update_post_meta($existing->ID, '_wp_page_template', $template_file);
            continue;
        }

        // Create the page
        $page_id = wp_insert_post([
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ]);

        if ($page_id && !is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', $template_file);
        }
    }

    flush_rewrite_rules();
}

// Run once on first load if pages haven't been created yet or to force URL cleanup
add_action('init', function () {
    if (!get_option('lp3aik_theme_pages_v4')) {
        // 1. Force permalink structure to absolutely clean Post Name
        global $wp_rewrite;
        update_option('permalink_structure', '/%postname%/');
        $wp_rewrite->set_permalink_structure('/%postname%/');
        
        // 2. Create pages
        lp3aik_create_theme_pages();
        
        // 3. Flush rewrite rules immediately
        flush_rewrite_rules(true); // pass true to also recreate .htaccess
        
        update_option('lp3aik_theme_pages_v4', true);
    }
}, 20);

// =====================================================================
// 4) PROPER ARCHIVE TITLES (remove "Archives:" prefix)
// =====================================================================
add_filter('get_the_archive_title', function (string $title): string {
    if (is_post_type_archive('lp3aik_program')) return __('Program & Layanan AIK', 'lp3aik-umk');
    if (is_post_type_archive('lp3aik_galeri'))  return __('Galeri Kegiatan', 'lp3aik-umk');
    if (is_post_type_archive('lp3aik_unduhan')) return __('Unduhan / File', 'lp3aik-umk');
    if (is_category()) return single_cat_title('', false);
    if (is_tag())      return single_tag_title('', false);
    if (is_author())   return get_the_author();
    return $title;
});

// =====================================================================
// 5) ADJUST CPT ARCHIVE QUERIES
// =====================================================================
add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query()) return;

    if (is_post_type_archive('lp3aik_galeri')) {
        $query->set('posts_per_page', -1);
    }
    if (is_post_type_archive('lp3aik_unduhan')) {
        $query->set('posts_per_page', -1);
    }
    if (is_post_type_archive('lp3aik_program')) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');
    }
});

// =====================================================================
// 6) CATEGORY & TAXONOMY: Use slug-based permalinks
// =====================================================================
add_filter('category_link', function (string $link, int $cat_id): string {
    $category = get_category($cat_id);
    if ($category && !is_wp_error($category)) {
        return home_url('/category/' . $category->slug . '/');
    }
    return $link;
}, 10, 2);

add_filter('tag_link', function (string $link, int $tag_id): string {
    $tag = get_tag($tag_id);
    if ($tag && !is_wp_error($tag)) {
        return home_url('/tag/' . $tag->slug . '/');
    }
    return $link;
}, 10, 2);

// =====================================================================
// 7) FLUSH REWRITE ON THEME SWITCH
// =====================================================================
add_action('after_switch_theme', 'flush_rewrite_rules');
add_action('switch_theme', 'flush_rewrite_rules');

// End of file

```
<!-- END FILE: inc\helpers\page-templates.php -->

---

<!-- START FILE: inc\helpers\template-helpers.php -->
## File: `inc\helpers\template-helpers.php`

```php
<?php
/**
 * Template Helper Functions.
 *
 * Reusable helper functions for templates.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

/**
 * Get theme mod with a convenient wrapper.
 */
function lp3aik_opt(string $key, string $default = ''): string {
    return get_theme_mod($key, $default);
}

/**
 * Render section header (eyebrow + title + subtitle).
 */
function lp3aik_section_header(string $eyebrow, string $title, string $subtitle = '', bool $center = true): void {
    if ($center) echo '<div class="text-center">';
    echo '<span class="section-eyebrow">' . esc_html($eyebrow) . '</span>';
    echo '<h2 class="section-title">' . wp_kses_post($title) . '</h2>';
    if ($subtitle) echo '<p class="section-subtitle">' . esc_html($subtitle) . '</p>';
    if ($center) echo '</div>';
}

/**
 * Get post thumbnail URL with fallback.
 */
function lp3aik_thumb(int $post_id, string $size = 'lp3aik-card', string $fallback = ''): string {
    if (has_post_thumbnail($post_id)) {
        return get_the_post_thumbnail_url($post_id, $size);
    }
    return $fallback ?: LP3AIK_URI . '/assets/img/placeholder.jpg';
}

/**
 * Breadcrumb generator.
 */
function lp3aik_breadcrumb(): void {
    if (is_front_page()) return;

    $crumbs = ['<a href="' . home_url() . '">' . esc_html__('Beranda', 'lp3aik-umk') . '</a>'];

    if (is_singular()) {
        $post_type = get_post_type();

        // CPT single: add archive link as parent
        if ($post_type && !in_array($post_type, ['post', 'page'])) {
            $pt_obj = get_post_type_object($post_type);
            if ($pt_obj && $pt_obj->has_archive) {
                $archive_url = get_post_type_archive_link($post_type);
                $crumbs[] = '<a href="' . esc_url($archive_url) . '">' . esc_html($pt_obj->labels->name) . '</a>';
            }
        } elseif ($post_type === 'post') {
            // Regular post: add category
            if ($cat = get_the_category()) {
                $crumbs[] = '<a href="' . get_category_link($cat[0]->term_id) . '">' . esc_html($cat[0]->name) . '</a>';
            }
        }

        $crumbs[] = '<span>' . esc_html(get_the_title()) . '</span>';
    } elseif (is_post_type_archive()) {
        $crumbs[] = '<span>' . post_type_archive_title('', false) . '</span>';
    } elseif (is_category()) {
        $crumbs[] = '<span>' . single_cat_title('', false) . '</span>';
    } elseif (is_tag()) {
        $crumbs[] = '<span>' . single_tag_title('', false) . '</span>';
    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $crumbs[] = '<a href="' . get_permalink($post->post_parent) . '">' . esc_html(get_the_title($post->post_parent)) . '</a>';
        }
        $crumbs[] = '<span>' . esc_html(get_the_title()) . '</span>';
    } elseif (is_search()) {
        $crumbs[] = '<span>' . sprintf(esc_html__('Pencarian: "%s"', 'lp3aik-umk'), esc_html(get_search_query())) . '</span>';
    } elseif (is_archive()) {
        $crumbs[] = '<span>' . get_the_archive_title() . '</span>';
    }

    echo implode('<span class="sep">›</span>', $crumbs);
}

/**
 * Social links array (filtered for non-empty URLs).
 */
function lp3aik_social_links(): array {
    return array_filter([
        'facebook'  => ['url' => lp3aik_opt('lp3aik_facebook'), 'icon' => 'fa-brands fa-facebook-f', 'label' => 'Facebook'],
        'instagram' => ['url' => lp3aik_opt('lp3aik_instagram'), 'icon' => 'fa-brands fa-instagram',  'label' => 'Instagram'],
        'youtube'   => ['url' => lp3aik_opt('lp3aik_youtube'),   'icon' => 'fa-brands fa-youtube',    'label' => 'YouTube'],
    ], fn($s) => !empty($s['url']));
}

/**
 * Render a Font Awesome icon. Falls back gracefully for old emoji data.
 */
function lp3aik_icon(string $icon_class, string $fallback_emoji = ''): string {
    if (str_starts_with($icon_class, 'fa-')) {
        return '<i class="fa-solid ' . esc_attr($icon_class) . '"></i>';
    }
    // Legacy emoji fallback
    if ($icon_class) {
        return '<i class="fa-solid fa-book-open"></i>';
    }
    return $fallback_emoji ? '<i class="fa-solid fa-book-open"></i>' : '';
}

```
<!-- END FILE: inc\helpers\template-helpers.php -->

---

<!-- START FILE: inc\meta-boxes\program-meta.php -->
## File: `inc\meta-boxes\program-meta.php`

```php
<?php
/**
 * Meta Box: Program Detail.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', function () {
    add_meta_box(
        'lp3aik_program_meta',
        __('Detail Program', 'lp3aik-umk'),
        'lp3aik_program_meta_cb',
        'lp3aik_program',
        'normal',
        'high'
    );
});

/**
 * Render program meta box fields.
 */
function lp3aik_program_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_program_meta', 'lp3aik_program_nonce');

    $icon    = get_post_meta($post->ID, '_program_icon',       true);
    $durasi  = get_post_meta($post->ID, '_program_durasi',     true);
    $sasaran = get_post_meta($post->ID, '_program_sasaran',    true);
    $link    = get_post_meta($post->ID, '_program_link_daftar', true);
    ?>
    <table class="form-table">
        <tr>
            <th><?php _e('Ikon (Font Awesome class)', 'lp3aik-umk'); ?></th>
            <td><input name="_program_icon" value="<?php echo esc_attr($icon); ?>" class="regular-text" placeholder="fa-book-open"></td>
        </tr>
        <tr>
            <th><?php _e('Durasi', 'lp3aik-umk'); ?></th>
            <td><input name="_program_durasi" value="<?php echo esc_attr($durasi); ?>" class="regular-text" placeholder="1 Semester"></td>
        </tr>
        <tr>
            <th><?php _e('Sasaran Peserta', 'lp3aik-umk'); ?></th>
            <td><input name="_program_sasaran" value="<?php echo esc_attr($sasaran); ?>" class="regular-text" placeholder="Mahasiswa baru, dosen ..."></td>
        </tr>
        <tr>
            <th><?php _e('Link Pendaftaran', 'lp3aik-umk'); ?></th>
            <td><input name="_program_link_daftar" value="<?php echo esc_attr($link); ?>" type="url" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

/**
 * Save program meta data with proper nonce verification.
 */
add_action('save_post_lp3aik_program', function (int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_program_nonce']) || !wp_verify_nonce($_POST['lp3aik_program_nonce'], 'lp3aik_program_meta')) return;

    $fields = ['_program_icon', '_program_durasi', '_program_sasaran'];
    foreach ($fields as $key) {
        if (isset($_POST[$key])) {
            update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
        }
    }

    // URL field gets esc_url_raw
    if (isset($_POST['_program_link_daftar'])) {
        update_post_meta($post_id, '_program_link_daftar', esc_url_raw($_POST['_program_link_daftar']));
    }
});

```
<!-- END FILE: inc\meta-boxes\program-meta.php -->

---

<!-- START FILE: inc\meta-boxes\tim-meta.php -->
## File: `inc\meta-boxes\tim-meta.php`

```php
<?php
/**
 * Meta Box: Tim / Pengurus Detail.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', function () {
    add_meta_box('lp3aik_tim_meta', __('Detail Anggota Tim','lp3aik-umk'), 'lp3aik_tim_meta_cb', 'lp3aik_tim', 'normal', 'high');
});

function lp3aik_tim_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_tim_meta', 'lp3aik_tim_nonce');
    $nidn    = get_post_meta($post->ID, '_tim_nidn',    true);
    $email   = get_post_meta($post->ID, '_tim_email',   true);
    $prodi   = get_post_meta($post->ID, '_tim_prodi',   true);
    ?>
    <p><em><?php _e('Catatan: Untuk mengatur Jabatan (Ketua, Anggota, dll), silakan gunakan kotak <strong>Jabatan</strong> di sebelah kanan layar.', 'lp3aik-umk'); ?></em></p>
    <table class="form-table">
        <tr><th><?php _e('NIDN/NIM','lp3aik-umk'); ?></th><td><input name="_tim_nidn" value="<?php echo esc_attr($nidn); ?>" class="regular-text"></td></tr>
        <tr><th><?php _e('Program Studi','lp3aik-umk'); ?></th><td><input name="_tim_prodi" value="<?php echo esc_attr($prodi); ?>" class="regular-text"></td></tr>
        <tr><th><?php _e('Email','lp3aik-umk'); ?></th><td><input name="_tim_email" value="<?php echo esc_attr($email); ?>" type="email" class="regular-text"></td></tr>
    </table>
    <?php
}

add_action('save_post_lp3aik_tim', function (int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_tim_nonce']) || !wp_verify_nonce($_POST['lp3aik_tim_nonce'], 'lp3aik_tim_meta')) return;

    foreach (['_tim_nidn', '_tim_prodi'] as $key) {
        if (isset($_POST[$key])) update_post_meta($post_id, $key, sanitize_text_field($_POST[$key]));
    }
    if (isset($_POST['_tim_email'])) {
        update_post_meta($post_id, '_tim_email', sanitize_email($_POST['_tim_email']));
    }
});

```
<!-- END FILE: inc\meta-boxes\tim-meta.php -->

---

<!-- START FILE: inc\meta-boxes\unduhan-meta.php -->
## File: `inc\meta-boxes\unduhan-meta.php`

```php
<?php
/**
 * Meta Box: Unduhan / File Download.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('add_meta_boxes', function () {
    add_meta_box('lp3aik_unduhan_meta', __('File Unduhan','lp3aik-umk'), 'lp3aik_unduhan_meta_cb', 'lp3aik_unduhan', 'normal', 'high');
});

// Enqueue media script
add_action('admin_enqueue_scripts', function($hook) {
    global $post_type;
    if ($post_type === 'lp3aik_unduhan' && in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_media();
    }
});

function lp3aik_unduhan_meta_cb(WP_Post $post): void {
    wp_nonce_field('lp3aik_unduhan_meta', 'lp3aik_unduhan_nonce');
    $url    = get_post_meta($post->ID, '_unduhan_url',    true);
    $ukuran = get_post_meta($post->ID, '_unduhan_ukuran', true);
    $tipe   = get_post_meta($post->ID, '_unduhan_tipe',   true);
    ?>
    <table class="form-table">
        <tr>
            <th><?php _e('Pilih / Upload File','lp3aik-umk'); ?></th>
            <td>
                <input type="url" id="_unduhan_url" name="_unduhan_url" value="<?php echo esc_attr($url); ?>" class="large-text" placeholder="https://..." style="margin-bottom:8px;">
                <button type="button" class="button" id="lp3aik_upload_file_btn"><?php _e('Pilih File dari Media', 'lp3aik-umk'); ?></button>
                <p class="description"><?php _e('Klik tombol di atas untuk mengunggah file (PDF, Word, dll), atau masukkan link eksternal (Google Drive, dll).', 'lp3aik-umk'); ?></p>
            </td>
        </tr>
        <tr><th><?php _e('Ukuran File','lp3aik-umk'); ?></th><td><input name="_unduhan_ukuran" value="<?php echo esc_attr($ukuran); ?>" class="regular-text" placeholder="2.4 MB"></td></tr>
        <tr><th><?php _e('Tipe File','lp3aik-umk'); ?></th>
            <td><select name="_unduhan_tipe">
                <?php foreach(['PDF','DOCX','XLSX','PPT','ZIP','Lainnya'] as $t): ?>
                    <option value="<?php echo $t; ?>" <?php selected($tipe,$t); ?>><?php echo $t; ?></option>
                <?php endforeach; ?>
            </select></td></tr>
    </table>
    
    <script>
    jQuery(document).ready(function($){
        var mediaUploader;
        $('#lp3aik_upload_file_btn').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Pilih File Unduhan',
                button: { text: 'Gunakan File Ini' },
                multiple: false
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#_unduhan_url').val(attachment.url);
            });
            mediaUploader.open();
        });
    });
    </script>
    <?php
}

add_action('save_post_lp3aik_unduhan', function (int $post_id): void {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (!isset($_POST['lp3aik_unduhan_nonce']) || !wp_verify_nonce($_POST['lp3aik_unduhan_nonce'], 'lp3aik_unduhan_meta')) return;

    if (isset($_POST['_unduhan_url']))    update_post_meta($post_id, '_unduhan_url', esc_url_raw($_POST['_unduhan_url']));
    if (isset($_POST['_unduhan_ukuran'])) update_post_meta($post_id, '_unduhan_ukuran', sanitize_text_field($_POST['_unduhan_ukuran']));
    if (isset($_POST['_unduhan_tipe']))   update_post_meta($post_id, '_unduhan_tipe', sanitize_text_field($_POST['_unduhan_tipe']));
});

```
<!-- END FILE: inc\meta-boxes\unduhan-meta.php -->

---

<!-- START FILE: inc\optimization\optimization.php -->
## File: `inc\optimization\optimization.php`

```php
<?php
/**
 * Optimization & Miscellaneous.
 *
 * Excerpt settings, template redirects, rewrite flush.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Excerpt length & more
add_filter('excerpt_length', fn() => 20);
add_filter('excerpt_more',   fn() => '...');

// Template redirect for CPT archives
add_filter('template_include', function (string $template): string {
    $map = [
        'lp3aik_galeri'  => 'templates/archive-galeri.php',
        'lp3aik_program' => 'templates/archive-program.php',
        'lp3aik_unduhan' => 'templates/archive-unduhan.php',
    ];

    foreach ($map as $post_type => $tpl) {
        if (is_post_type_archive($post_type)) {
            $located = locate_template($tpl);
            return $located ?: $template;
        }
    }

    return $template;
});

// Flush rewrite on theme activation
add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});

```
<!-- END FILE: inc\optimization\optimization.php -->

---

<!-- START FILE: inc\post-types\register-post-types.php -->
## File: `inc\post-types\register-post-types.php`

```php
<?php
/**
 * Register Custom Post Types.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('init', function () {

    // ── PROGRAM / LAYANAN ───────────────────────────────────
    register_post_type('lp3aik_program', [
        'labels' => [
            'name'               => __('Program',           'lp3aik-umk'),
            'singular_name'      => __('Program',           'lp3aik-umk'),
            'add_new'            => __('Tambah Program',    'lp3aik-umk'),
            'add_new_item'       => __('Tambah Program Baru','lp3aik-umk'),
            'edit_item'          => __('Edit Program',      'lp3aik-umk'),
            'view_item'          => __('Lihat Program',     'lp3aik-umk'),
            'all_items'          => __('Semua Program',     'lp3aik-umk'),
            'search_items'       => __('Cari Program',      'lp3aik-umk'),
            'menu_name'          => __('Program',           'lp3aik-umk'),
        ],
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-book-alt',
        'menu_position'      => 5,
        'supports'           => ['title','editor','excerpt','thumbnail','custom-fields'],
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'program'],
        'show_in_nav_menus'  => true,
    ]);

    // ── TIM / PENGURUS ──────────────────────────────────────
    register_post_type('lp3aik_tim', [
        'labels' => [
            'name'          => __('Tim / Pengurus',      'lp3aik-umk'),
            'singular_name' => __('Anggota Tim',         'lp3aik-umk'),
            'add_new'       => __('Tambah Anggota',      'lp3aik-umk'),
            'add_new_item'  => __('Tambah Anggota Baru', 'lp3aik-umk'),
            'edit_item'     => __('Edit Anggota',        'lp3aik-umk'),
            'all_items'     => __('Semua Anggota',       'lp3aik-umk'),
            'menu_name'     => __('Tim',                 'lp3aik-umk'),
        ],
        'public'         => true,
        'show_in_rest'   => true,
        'menu_icon'      => 'dashicons-groups',
        'menu_position'  => 6,
        'supports'       => ['title','editor','thumbnail','custom-fields','page-attributes'],
        'has_archive'    => false,
        'rewrite'        => ['slug' => 'tim'],
        'show_in_nav_menus' => false,
    ]);

    // ── GALERI ──────────────────────────────────────────────
    register_post_type('lp3aik_galeri', [
        'labels' => [
            'name'          => __('Galeri',           'lp3aik-umk'),
            'singular_name' => __('Foto Galeri',      'lp3aik-umk'),
            'add_new'       => __('Tambah Foto',      'lp3aik-umk'),
            'add_new_item'  => __('Tambah Foto Baru', 'lp3aik-umk'),
            'edit_item'     => __('Edit Foto',        'lp3aik-umk'),
            'all_items'     => __('Semua Foto',       'lp3aik-umk'),
            'menu_name'     => __('Galeri',           'lp3aik-umk'),
        ],
        'public'         => true,
        'show_in_rest'   => true,
        'menu_icon'      => 'dashicons-format-gallery',
        'menu_position'  => 7,
        'supports'       => ['title','thumbnail','editor','custom-fields'],
        'has_archive'    => true,
        'rewrite'        => ['slug' => 'galeri'],
    ]);

    // ── UNDUHAN / FILE ──────────────────────────────────────
    register_post_type('lp3aik_unduhan', [
        'labels' => [
            'name'          => __('Unduhan',           'lp3aik-umk'),
            'singular_name' => __('File Unduhan',      'lp3aik-umk'),
            'add_new'       => __('Tambah File',       'lp3aik-umk'),
            'add_new_item'  => __('Tambah File Baru',  'lp3aik-umk'),
            'edit_item'     => __('Edit File',         'lp3aik-umk'),
            'all_items'     => __('Semua File',        'lp3aik-umk'),
            'menu_name'     => __('Unduhan',           'lp3aik-umk'),
        ],
        'public'         => true,
        'show_in_rest'   => true,
        'menu_icon'      => 'dashicons-download',
        'menu_position'  => 8,
        'supports'       => ['title','editor','thumbnail','custom-fields'],
        'has_archive'    => true,
        'rewrite'        => ['slug' => 'unduhan'],
    ]);

    // =====================================================================
    // REGISTER TAXONOMIES (KATEGORI KHUSUS)
    // =====================================================================

    // ── KATEGORI GALERI (Album) ─────────────────────────────
    register_taxonomy('album_galeri', ['lp3aik_galeri'], [
        'labels' => [
            'name'          => __('Album Galeri', 'lp3aik-umk'),
            'singular_name' => __('Album', 'lp3aik-umk'),
            'search_items'  => __('Cari Album', 'lp3aik-umk'),
            'all_items'     => __('Semua Album', 'lp3aik-umk'),
            'edit_item'     => __('Edit Album', 'lp3aik-umk'),
            'update_item'   => __('Update Album', 'lp3aik-umk'),
            'add_new_item'  => __('Tambah Album Baru', 'lp3aik-umk'),
            'new_item_name' => __('Nama Album Baru', 'lp3aik-umk'),
            'menu_name'     => __('Album', 'lp3aik-umk'),
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'album'],
        'show_in_rest'      => true,
    ]);

    // ── JABATAN TIM ─────────────────────────────────────────
    register_taxonomy('jabatan_tim', ['lp3aik_tim'], [
        'labels' => [
            'name'          => __('Jabatan', 'lp3aik-umk'),
            'singular_name' => __('Jabatan', 'lp3aik-umk'),
            'search_items'  => __('Cari Jabatan', 'lp3aik-umk'),
            'all_items'     => __('Semua Jabatan', 'lp3aik-umk'),
            'edit_item'     => __('Edit Jabatan', 'lp3aik-umk'),
            'update_item'   => __('Update Jabatan', 'lp3aik-umk'),
            'add_new_item'  => __('Tambah Jabatan Baru', 'lp3aik-umk'),
            'new_item_name' => __('Nama Jabatan Baru', 'lp3aik-umk'),
            'menu_name'     => __('Jabatan', 'lp3aik-umk'),
        ],
        'hierarchical'      => true, // Seperti kategori (bukan tag) agar mudah dipilih via checkbox
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'jabatan'],
        'show_in_rest'      => true,
    ]);

});

```
<!-- END FILE: inc\post-types\register-post-types.php -->

---

<!-- START FILE: inc\post-types\register-taxonomies.php -->
## File: `inc\post-types\register-taxonomies.php`

```php
<?php
/**
 * Register Custom Taxonomies.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('init', function () {

    register_taxonomy('kategori_program', ['lp3aik_program'], [
        'label'        => __('Kategori Program', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'kategori-program'],
    ]);

    register_taxonomy('jabatan', ['lp3aik_tim'], [
        'label'        => __('Jabatan', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'jabatan'],
    ]);

    register_taxonomy('album_galeri', ['lp3aik_galeri'], [
        'label'        => __('Album', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'album'],
    ]);

    register_taxonomy('jenis_unduhan', ['lp3aik_unduhan'], [
        'label'        => __('Jenis File', 'lp3aik-umk'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'jenis-unduhan'],
    ]);
});

```
<!-- END FILE: inc\post-types\register-taxonomies.php -->

---

<!-- START FILE: inc\security\security.php -->
## File: `inc\security\security.php`

```php
<?php
/**
 * Security Hardening.
 *
 * Nonce helpers, header hardening, spam protection utilities.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

// Remove WordPress version from head for security
remove_action('wp_head', 'wp_generator');

// Disable XML-RPC if not needed
add_filter('xmlrpc_enabled', '__return_false');

// Remove unnecessary header info
add_action('init', function () {
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
});

// Add security headers
add_action('send_headers', function () {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
});

```
<!-- END FILE: inc\security\security.php -->

---

<!-- START FILE: inc\setup\theme-setup.php -->
## File: `inc\setup\theme-setup.php`

```php
<?php
/**
 * Theme Setup — after_setup_theme hooks.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

add_action('after_setup_theme', function () {

    load_theme_textdomain('lp3aik-umk', LP3AIK_DIR . '/languages');

    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('editor-color-palette', [
        ['name' => __('Hijau Utama','lp3aik-umk'),   'slug' => 'green-primary', 'color' => '#1a7a3c'],
        ['name' => __('Hijau Gelap','lp3aik-umk'),   'slug' => 'green-dark',    'color' => '#0a4a1e'],
        ['name' => __('Emas','lp3aik-umk'),           'slug' => 'gold',          'color' => '#c8972a'],
        ['name' => __('Putih','lp3aik-umk'),          'slug' => 'white',         'color' => '#ffffff'],
    ]);

    add_theme_support('custom-logo', [
        'height'               => 80,
        'width'                => 200,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => ['site-title','site-description'],
        'unlink-homepage-logo' => false,
    ]);

    // Custom image sizes
    add_image_size('lp3aik-card',      800,  500, true);
    add_image_size('lp3aik-gallery',   600,  450, true);
    add_image_size('lp3aik-team',      300,  300, true);
    add_image_size('lp3aik-hero',      1600, 800, true);
    add_image_size('lp3aik-thumb-sm',  200,  160, true);

    // Navigation menus
    register_nav_menus([
        'primary'  => __('Menu Utama',    'lp3aik-umk'),
        'footer-1' => __('Menu Footer 1', 'lp3aik-umk'),
        'footer-2' => __('Menu Footer 2', 'lp3aik-umk'),
    ]);
});

// ============================================================
// WIDGETS / SIDEBARS
// ============================================================
add_action('widgets_init', function () {
    $defaults = [
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ];

    register_sidebar(array_merge($defaults, [
        'name' => __('Sidebar Blog',       'lp3aik-umk'),
        'id'   => 'sidebar-blog',
        'description' => __('Widget di sidebar halaman blog/berita.', 'lp3aik-umk'),
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Sidebar Halaman',    'lp3aik-umk'),
        'id'   => 'sidebar-page',
        'description' => __('Widget di sidebar halaman statis.', 'lp3aik-umk'),
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Kolom 1',     'lp3aik-umk'),
        'id'   => 'footer-1',
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Kolom 2',     'lp3aik-umk'),
        'id'   => 'footer-2',
    ]));
    register_sidebar(array_merge($defaults, [
        'name' => __('Footer Kolom 3',     'lp3aik-umk'),
        'id'   => 'sidebar-footer-3',
    ]));
});

```
<!-- END FILE: inc\setup\theme-setup.php -->

---

<!-- START FILE: template-parts\cards\card-news-small.php -->
## File: `template-parts\cards\card-news-small.php`

```php
<?php
/**
 * Template Part: Card — News Small (sidebar list item)
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<a href="<?php the_permalink(); ?>" class="news-item-small">
    <div class="news-item-small__image">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-thumb-sm')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else: ?>
            <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;">
                <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
            </div>
        <?php endif; ?>
    </div>
    <div>
        <div class="news-item-small__title"><?php the_title(); ?></div>
        <div class="news-item-small__date"><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
    </div>
</a>

```
<!-- END FILE: template-parts\cards\card-news-small.php -->

---

<!-- START FILE: template-parts\cards\card-news.php -->
## File: `template-parts\cards\card-news.php`

```php
<?php
/**
 * Template Part: Card — News (large featured)
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<article class="card">
    <div class="card__image">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        <?php else: ?>
            <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:200px;">
                <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="card__body">
        <div class="card__tag"><?php _e('Berita Utama','lp3aik-umk'); ?></div>
        <h3 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
        <div class="card__meta">
            <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
            <?php if ($cat = get_the_category()): ?>
                <span><i class="fa-solid fa-tag fa-sm"></i> <?php echo esc_html($cat[0]->name); ?></span>
            <?php endif; ?>
        </div>
    </div>
</article>

```
<!-- END FILE: template-parts\cards\card-news.php -->

---

<!-- START FILE: template-parts\cards\card-program.php -->
## File: `template-parts\cards\card-program.php`

```php
<?php
/**
 * Template Part: Card — Program
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$icon_raw = get_post_meta(get_the_ID(), '_program_icon', true) ?: 'fa-book-open';
$icon_class = str_starts_with($icon_raw, 'fa-') ? $icon_raw : 'fa-book-open';
?>
<div class="program-card">
    <div class="program-card__icon">
        <i class="fa-solid <?php echo esc_attr($icon_class); ?>"></i>
    </div>
    <h3><?php the_title(); ?></h3>
    <p><?php echo esc_html(get_the_excerpt() ?: wp_trim_words(get_the_content(), 20)); ?></p>
    <?php if ($sasaran = get_post_meta(get_the_ID(), '_program_sasaran', true)): ?>
        <div style="font-size:.8rem;color:var(--green-mid);margin-bottom:.75rem;">
            <i class="fa-solid fa-user fa-sm"></i> <?php echo esc_html($sasaran); ?>
        </div>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>" class="btn btn-outline btn-sm"><?php _e('Detail Program','lp3aik-umk'); ?></a>
</div>

```
<!-- END FILE: template-parts\cards\card-program.php -->

---

<!-- START FILE: template-parts\cards\card-team.php -->
## File: `template-parts\cards\card-team.php`

```php
<?php
/**
 * Template Part: Card — Team Member
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="team-card">
    <div class="team-card__avatar">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-team')); ?>" alt="<?php the_title_attribute(); ?>">
        <?php else: ?>
            <div class="d-flex align-items-center justify-content-center" style="width:100%;height:100%;background:var(--green-pale);font-size:2.5rem;">
                <i class="fa-solid fa-user" style="color:var(--green-mid);"></i>
            </div>
        <?php endif; ?>
    </div>
    <div class="team-card__name"><?php the_title(); ?></div>
    <div class="team-card__position"><?php echo esc_html(get_post_meta(get_the_ID(), '_tim_jabatan', true)); ?></div>
    <?php if ($prodi = get_post_meta(get_the_ID(), '_tim_prodi', true)): ?>
        <div class="team-card__dept"><?php echo esc_html($prodi); ?></div>
    <?php endif; ?>
</div>

```
<!-- END FILE: template-parts\cards\card-team.php -->

---

<!-- START FILE: template-parts\components\back-to-top.php -->
## File: `template-parts\components\back-to-top.php`

```php
<?php
/**
 * Template Part: Back to Top Button
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<button class="back-to-top" id="back-to-top" aria-label="<?php _e('Kembali ke atas', 'lp3aik-umk'); ?>">
    <i class="fa-solid fa-chevron-up"></i>
</button>

```
<!-- END FILE: template-parts\components\back-to-top.php -->

---

<!-- START FILE: template-parts\components\lightbox.php -->
## File: `template-parts\components\lightbox.php`

```php
<?php
/**
 * Template Part: Lightbox Overlay
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="lightbox" id="lightbox" role="dialog" aria-label="<?php _e('Tampilan gambar besar', 'lp3aik-umk'); ?>">
    <button class="lightbox__close" id="lightbox-close" aria-label="<?php _e('Tutup', 'lp3aik-umk'); ?>">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <img src="" alt="" id="lightbox-img">
</div>

```
<!-- END FILE: template-parts\components\lightbox.php -->

---

<!-- START FILE: template-parts\components\quote-banner.php -->
## File: `template-parts\components\quote-banner.php`

```php
<?php
/**
 * Template Part: Quote Banner
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<section class="quote-banner">
    <div class="container">
        <p class="arabic-text">وَتَعَاوَنُوا عَلَى الْبِرِّ وَالتَّقْوَىٰ</p>
        <p class="translation"><?php _e('"Dan tolong-menolonglah kamu dalam (mengerjakan) kebajikan dan takwa"', 'lp3aik-umk'); ?></p>
        <p class="source"><?php _e('QS. Al-Ma\'idah: 2', 'lp3aik-umk'); ?></p>
    </div>
</section>

```
<!-- END FILE: template-parts\components\quote-banner.php -->

---

<!-- START FILE: template-parts\navigation\search-modal.php -->
## File: `template-parts\navigation\search-modal.php`

```php
<?php
/**
 * Template Part: Search Modal
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<div class="search-modal" id="search-modal" role="dialog" aria-label="<?php _e('Pencarian', 'lp3aik-umk'); ?>">
    <div class="search-modal__box">
        <h3 class="mb-3" style="font-size:1.1rem;"><?php _e('Cari di LP3AIK', 'lp3aik-umk'); ?></h3>
        <?php get_search_form(); ?>
    </div>
</div>

```
<!-- END FILE: template-parts\navigation\search-modal.php -->

---

<!-- START FILE: template-parts\navigation\ticker.php -->
## File: `template-parts\navigation\ticker.php`

```php
<?php
/**
 * Template Part: Announcement Ticker
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$ticker_raw   = lp3aik_opt('lp3aik_ticker', 'Selamat datang di LP3AIK Universitas Muhammadiyah Kotabumi | Kami hadir untuk melayani pengkajian, pengembangan, dan pengamalan AIK');
$ticker_items = explode('|', $ticker_raw);
?>
<div class="ticker" aria-live="polite">
    <span class="ticker__label"><i class="fa-solid fa-bullhorn me-1"></i> <?php _e('Pengumuman', 'lp3aik-umk'); ?></span>
    <div class="ticker__track" aria-hidden="true">
        <?php for ($r = 0; $r < 3; $r++): ?>
            <?php foreach ($ticker_items as $item): ?>
                <span class="ticker__item"><?php echo esc_html(trim($item)); ?></span>
            <?php endforeach; ?>
        <?php endfor; ?>
    </div>
</div>

```
<!-- END FILE: template-parts\navigation\ticker.php -->

---

<!-- START FILE: template-parts\navigation\topbar.php -->
## File: `template-parts\navigation\topbar.php`

```php
<?php
/**
 * Template Part: Topbar
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$email = lp3aik_opt('lp3aik_email', 'lp3aik@umkotabumi.ac.id');
$phone = lp3aik_opt('lp3aik_phone', '');
?>
<div class="topbar">
    <div class="container">
        <div class="topbar__inner">
            <div class="topbar__left">
                <span class="topbar__item">
                    <i class="fa-solid fa-envelope fa-sm"></i>
                    <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                </span>
                <?php if ($phone): ?>
                <span class="topbar__item">
                    <i class="fa-solid fa-phone fa-sm"></i>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^+0-9]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                </span>
                <?php endif; ?>
            </div>
            <div class="topbar__right">
                <span class="topbar__item"><i class="fa-solid fa-mosque fa-sm"></i> LP3AIK - Universitas Muhammadiyah Kotabumi</span>
                <?php $socials = lp3aik_social_links(); ?>
                <?php if ($socials): ?>
                <span class="topbar__item" style="gap:.5rem;">
                    <?php foreach ($socials as $social): ?>
                        <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($social['label']); ?>">
                            <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                        </a>
                    <?php endforeach; ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

```
<!-- END FILE: template-parts\navigation\topbar.php -->

---

<!-- START FILE: template-parts\sections\section-about.php -->
## File: `template-parts\sections\section-about.php`

```php
<?php
/**
 * Template Part: About / Profil Singkat
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>
<section class="section" id="profil">
    <div class="container">
        <div class="about-grid">
            <div class="about__image-wrap">
                <div class="about__image-main">
                    <?php $about_img = get_theme_mod('lp3aik_about_image'); ?>
                    <?php if ($about_img): ?>
                        <img src="<?php echo esc_url($about_img); ?>" alt="<?php _e('Gedung LP3AIK UM Kotabumi','lp3aik-umk'); ?>" loading="lazy">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center" style="width:100%;height:100%;background:linear-gradient(135deg,var(--green-pale),var(--green-ghost));min-height:350px;">
                            <div class="text-center" style="color:var(--green-primary);">
                                <div style="font-size:5rem;margin-bottom:.5rem;"><i class="fa-solid fa-mosque"></i></div>
                                <div style="font-size:.9rem;font-weight:600;">LP3AIK UM Kotabumi</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="about__badge-float">
                    <div class="num"><?php echo esc_html(lp3aik_opt('lp3aik_stat_3_num','20+')); ?></div>
                    <div class="label"><?php _e('Tahun<br>Berdiri','lp3aik-umk'); ?></div>
                </div>
            </div>

            <div class="about__content">
                <span class="section-eyebrow"><?php _e('Tentang Kami','lp3aik-umk'); ?></span>
                <h2 class="section-title"><?php _e('LP3AIK UM Kotabumi','lp3aik-umk'); ?></h2>
                <p style="color:var(--text-secondary);margin-bottom:1rem;">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text',
                        'LP3AIK (Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan) adalah unit lembaga di Universitas Muhammadiyah Kotabumi yang bertugas mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.'
                    )); ?>
                </p>
                <p style="color:var(--text-secondary);margin-bottom:1.5rem;">
                    <?php echo wp_kses_post(lp3aik_opt('lp3aik_about_text2',
                        'Kami berkomitmen mencetak generasi yang tidak hanya unggul secara intelektual, tetapi juga memiliki akhlak mulia dan semangat Kemuhammadiyahan yang kuat.'
                    )); ?>
                </p>

                <!-- Tab Visi Misi -->
                <div class="about__visi-misi">
                    <div class="visi-misi-tabs">
                        <button class="tab-btn active" data-tab="visi"><?php _e('Visi','lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="misi"><?php _e('Misi','lp3aik-umk'); ?></button>
                        <button class="tab-btn" data-tab="tujuan"><?php _e('Tujuan','lp3aik-umk'); ?></button>
                    </div>
                    <div class="tab-panel active" id="tab-visi">
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_visi', 'Menjadi lembaga terdepan dalam pengkajian, pengembangan, dan pengamalan Al-Islam dan Kemuhammadiyahan di lingkungan Universitas Muhammadiyah Kotabumi guna mewujudkan sivitas akademika yang berakhlak mulia.')); ?></p>
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
                        <p><?php echo wp_kses_post(lp3aik_opt('lp3aik_tujuan', 'Terwujudnya sivitas akademika Universitas Muhammadiyah Kotabumi yang memiliki pemahaman, penghayatan, dan pengamalan Al-Islam dan Kemuhammadiyahan secara konsisten dan berkelanjutan.')); ?></p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?php echo esc_url(home_url('/profil')); ?>" class="btn btn-primary">
                        <?php _e('Selengkapnya tentang LP3AIK','lp3aik-umk'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

```
<!-- END FILE: template-parts\sections\section-about.php -->

---

<!-- START FILE: template-parts\sections\section-gallery.php -->
## File: `template-parts\sections\section-gallery.php`

```php
<?php
/**
 * Template Part: Galeri Cuplikan
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$gallery = new WP_Query([
    'post_type'      => 'lp3aik_galeri',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);

$placeholder_icons = ['fa-mosque','fa-book-open','fa-graduation-cap','fa-handshake','fa-pen-to-square','fa-moon'];
?>
<section class="section section--alt" id="galeri">
    <div class="container">
        <div class="flex-between mb-4" style="flex-wrap:wrap;gap:1rem;">
            <div>
                <span class="section-eyebrow"><?php _e('Dokumentasi','lp3aik-umk'); ?></span>
                <h2 class="section-title mb-0"><?php _e('Galeri Kegiatan','lp3aik-umk'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri')); ?>" class="btn btn-outline">
                <?php _e('Lihat Semua','lp3aik-umk'); ?>
            </a>
        </div>

        <?php if ($gallery->have_posts()): ?>
        <div class="gallery-masonry" id="homepage-gallery">
            <?php while ($gallery->have_posts()): $gallery->the_post(); ?>
            <div class="gallery-item" data-src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>">
                <?php if (has_post_thumbnail()): ?>
                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);aspect-ratio:4/3;font-size:2rem;color:var(--green-mid);">
                        <i class="fa-solid fa-image"></i>
                    </div>
                <?php endif; ?>
                <div class="gallery-item__overlay"><?php the_title(); ?></div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="gallery-masonry">
            <?php for ($i = 0; $i < 6; $i++): ?>
            <div class="gallery-item">
                <div class="d-flex align-items-center justify-content-center" style="background:linear-gradient(135deg,var(--green-pale),var(--green-ghost));font-size:2.5rem;aspect-ratio:<?php echo ($i % 3 === 2) ? '1/1' : '4/3'; ?>;color:var(--green-mid);">
                    <i class="fa-solid <?php echo esc_attr($placeholder_icons[$i]); ?>"></i>
                </div>
                <div class="gallery-item__overlay"><?php printf(__('Kegiatan LP3AIK %d','lp3aik-umk'), $i + 1); ?></div>
            </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

```
<!-- END FILE: template-parts\sections\section-gallery.php -->

---

<!-- START FILE: template-parts\sections\section-hero.php -->
## File: `template-parts\sections\section-hero.php`

```php
<?php
/**
 * Template Part: Hero Section — Carousel / Slider
 *
 * Menampilkan hero slider dengan background gambar yang dapat diganti admin
 * melalui Customizer (LP3AIK Theme Options > Hero Slider).
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$slide_count = (int) lp3aik_opt('lp3aik_hero_slide_count', '3');
$interval    = (int) lp3aik_opt('lp3aik_hero_interval', '6000');
$overlay     = (int) lp3aik_opt('lp3aik_hero_overlay', '55');

// Build slides data
$slides = [];
for ($i = 1; $i <= $slide_count; $i++) {
    $slides[] = [
        'image'    => lp3aik_opt("lp3aik_hero_slide_{$i}_image", ''),
        'title'    => lp3aik_opt("lp3aik_hero_slide_{$i}_title", $i === 1 ? 'Membangun Generasi <em>Islami</em> yang Unggul' : ($i === 2 ? 'Pengkajian <em>Al-Islam</em> & Kemuhammadiyahan' : 'Mengabdi dengan <em>Ilmu</em> & Akhlak')),
        'subtitle' => lp3aik_opt("lp3aik_hero_slide_{$i}_subtitle", $i === 1 ? 'Lembaga Pengkajian, Pengembangan, dan Pengamalan Al-Islam dan Kemuhammadiyahan — mendidik dengan nilai, mengabdi dengan ilmu.' : ($i === 2 ? 'Mengintegrasikan nilai-nilai Al-Islam dan Kemuhammadiyahan dalam seluruh aspek kehidupan akademik.' : 'Membentuk sivitas akademika yang berakhlak mulia dan bersemangat Kemuhammadiyahan.')),
    ];
}

$stats = [
    [lp3aik_opt('lp3aik_stat_1_num','500+'), lp3aik_opt('lp3aik_stat_1_label','Mahasiswa Terdidik')],
    [lp3aik_opt('lp3aik_stat_2_num','12'),   lp3aik_opt('lp3aik_stat_2_label','Program AIK')],
    [lp3aik_opt('lp3aik_stat_3_num','20+'),  lp3aik_opt('lp3aik_stat_3_label','Tahun Berdiri')],
    [lp3aik_opt('lp3aik_stat_4_num','30+'),  lp3aik_opt('lp3aik_stat_4_label','Tenaga Pengajar')],
];

$quick_links = [
    ['fa-mosque',    __('Profil','lp3aik-umk'),  home_url('/profil')],
    ['fa-list-check',__('Program','lp3aik-umk'), get_post_type_archive_link('lp3aik_program') ?: home_url('/program')],
    ['fa-newspaper', __('Berita','lp3aik-umk'),  home_url('/berita')],
    ['fa-images',    __('Galeri','lp3aik-umk'),  get_post_type_archive_link('lp3aik_galeri') ?: home_url('/galeri')],
];
?>
<section class="hero" id="beranda" data-interval="<?php echo esc_attr($interval); ?>">

    <!-- Carousel Background Slides -->
    <div class="hero__carousel" aria-hidden="true">
        <?php foreach ($slides as $idx => $slide): ?>
        <div class="hero__slide <?php echo $idx === 0 ? 'active' : ''; ?>"
            <?php if ($slide['image']): ?>
            style="background-image: url('<?php echo esc_url($slide['image']); ?>');"
            <?php endif; ?>>
        </div>
        <?php endforeach; ?>
        <div class="hero__overlay" style="opacity: <?php echo esc_attr($overlay / 100); ?>;"></div>
    </div>

    <!-- Decorative Pattern -->
    <div class="hero__bg-pattern" aria-hidden="true"></div>

    <div class="hero__inner container">
        <div class="hero__content">
            <p class="hero__arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <p class="hero__bismillah-label">Bismillahirrahmanirrahim</p>
            <span class="hero__eyebrow">LP3AIK — UM Kotabumi</span>

            <!-- Carousel Text Content -->
            <div class="hero__text-carousel">
                <?php foreach ($slides as $idx => $slide): ?>
                <div class="hero__text-slide <?php echo $idx === 0 ? 'active' : ''; ?>" data-slide="<?php echo $idx; ?>">
                    <h1><?php echo wp_kses_post($slide['title']); ?></h1>
                    <p class="hero__tagline"><?php echo esc_html($slide['subtitle']); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="hero__actions">
                <a href="<?php echo esc_url(get_post_type_archive_link('lp3aik_program') ?: home_url('/program')); ?>" class="btn btn-gold btn-lg">
                    <i class="fa-solid fa-layer-group"></i>
                    <?php _e('Lihat Program AIK','lp3aik-umk'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/kontak')); ?>" class="btn btn-white btn-lg">
                    <?php _e('Hubungi Kami','lp3aik-umk'); ?>
                </a>
            </div>

            <!-- Slide Indicators -->
            <?php if (count($slides) > 1): ?>
            <div class="hero__indicators">
                <?php for ($i = 0; $i < count($slides); $i++): ?>
                <button class="hero__dot <?php echo $i === 0 ? 'active' : ''; ?>"
                    data-slide="<?php echo $i; ?>"
                    aria-label="<?php printf(__('Slide %d','lp3aik-umk'), $i + 1); ?>"></button>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="hero__visual">
            <div class="hero__stat-cards">
                <?php foreach ($stats as [$num, $label]): ?>
                <div class="hero__stat-card">
                    <div class="hero__stat-num"><?php echo esc_html($num); ?></div>
                    <div class="hero__stat-label"><?php echo esc_html($label); ?></div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="hero__quick-links">
                <?php foreach ($quick_links as [$icon, $label, $url]): ?>
                <a href="<?php echo esc_url($url); ?>" class="hero__quick-link">
                    <div class="icon"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></div>
                    <?php echo esc_html($label); ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

```
<!-- END FILE: template-parts\sections\section-hero.php -->

---

<!-- START FILE: template-parts\sections\section-news.php -->
## File: `template-parts\sections\section-news.php`

```php
<?php
/**
 * Template Part: Berita Terbaru
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$posts = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'orderby'        => 'date',
    'order'          => 'DESC',
]);
?>
<section class="section" id="berita">
    <div class="container">
        <div class="flex-between mb-4" style="flex-wrap:wrap;gap:1rem;">
            <div>
                <span class="section-eyebrow"><?php _e('Info Terbaru','lp3aik-umk'); ?></span>
                <h2 class="section-title mb-0"><?php _e('Berita & Pengumuman','lp3aik-umk'); ?></h2>
            </div>
            <a href="<?php echo esc_url(home_url('/berita')); ?>" class="btn btn-outline">
                <?php _e('Semua Berita','lp3aik-umk'); ?>
            </a>
        </div>

        <div class="news-featured">
            <?php if ($posts->have_posts()): $posts->the_post(); ?>
                <?php get_template_part('template-parts/cards/card', 'news'); ?>
            <?php endif; ?>

            <div class="news-list">
                <?php while ($posts->have_posts()): $posts->the_post(); ?>
                    <?php get_template_part('template-parts/cards/card-news', 'small'); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</section>

```
<!-- END FILE: template-parts\sections\section-news.php -->

---

<!-- START FILE: template-parts\sections\section-stats.php -->
## File: `template-parts\sections\section-stats.php`

```php
<?php
/**
 * Template Part: Statistik / Capaian
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$stat_items = [
    [lp3aik_opt('lp3aik_stat_1_num','500+'), lp3aik_opt('lp3aik_stat_1_label','Mahasiswa Terdidik'),  'fa-graduation-cap'],
    [lp3aik_opt('lp3aik_stat_2_num','12'),   lp3aik_opt('lp3aik_stat_2_label','Program AIK'),        'fa-book-open'],
    [lp3aik_opt('lp3aik_stat_3_num','20+'),  lp3aik_opt('lp3aik_stat_3_label','Tahun Berdiri'),      'fa-building-columns'],
    [lp3aik_opt('lp3aik_stat_4_num','30+'),  lp3aik_opt('lp3aik_stat_4_label','Tenaga Pengajar'),    'fa-chalkboard-user'],
];
?>
<section class="section section--dark" id="statistik">
    <div class="container">
        <div class="text-center mb-4">
            <span class="section-eyebrow" style="background:rgba(200,151,42,.2);color:var(--gold-light);">
                <?php _e('Capaian Kami','lp3aik-umk'); ?>
            </span>
            <h2 class="section-title"><?php _e('LP3AIK dalam Angka','lp3aik-umk'); ?></h2>
        </div>
        <div class="stats-grid">
            <?php foreach ($stat_items as [$num, $label, $icon]): ?>
            <div class="stat-block">
                <div style="font-size:2rem;margin-bottom:.5rem;"><i class="fa-solid <?php echo esc_attr($icon); ?>"></i></div>
                <div class="stat-block__num"><?php echo esc_html($num); ?></div>
                <div class="stat-block__label"><?php echo esc_html($label); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

```
<!-- END FILE: template-parts\sections\section-stats.php -->

---

<!-- START FILE: template-parts\sections\section-team.php -->
## File: `template-parts\sections\section-team.php`

```php
<?php
/**
 * Template Part: Tim / Pengurus
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

$team = new WP_Query([
    'post_type'      => 'lp3aik_tim',
    'posts_per_page' => 8,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

$demo_tim = [
    ['Ketua LP3AIK',               'Dr. H. Ahmad, M.Ag'],
    ['Sekretaris',                  'Drs. Mahmud, M.Pd'],
    ['Bendahara',                   'Hj. Siti Aminah, S.E'],
    ['Koordinator Bid. Akademik',   'Ustadz Ridwan, M.Ag'],
];
?>
<section class="section" id="tim">
    <div class="container">
        <?php lp3aik_section_header(
            __('Pengurus Kami','lp3aik-umk'),
            __('Struktur Pengurus LP3AIK','lp3aik-umk'),
            __('Para pengurus yang berdedikasi dalam menjalankan amanah pembinaan AIK.','lp3aik-umk')
        ); ?>

        <?php if ($team->have_posts()): ?>
        <div class="grid-4">
            <?php while ($team->have_posts()): $team->the_post(); ?>
                <?php get_template_part('template-parts/cards/card', 'team'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo esc_url(home_url('/struktur-organisasi')); ?>" class="btn btn-outline">
                <?php _e('Lihat Struktur Lengkap','lp3aik-umk'); ?>
            </a>
        </div>
        <?php else: ?>
        <div class="grid-4">
            <?php foreach ($demo_tim as [$jabatan, $nama]): ?>
            <div class="team-card">
                <div class="team-card__avatar">
                    <div class="d-flex align-items-center justify-content-center" style="width:100%;height:100%;background:var(--green-pale);font-size:2.5rem;">
                        <i class="fa-solid fa-user" style="color:var(--green-mid);"></i>
                    </div>
                </div>
                <div class="team-card__name"><?php echo esc_html($nama); ?></div>
                <div class="team-card__position"><?php echo esc_html($jabatan); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

```
<!-- END FILE: template-parts\sections\section-team.php -->

---

<!-- START FILE: templates\archive-lp3aik_galeri.php -->
## File: `templates\archive-lp3aik_galeri.php`

```php
<?php
/**
 * Archive Template: Galeri Kegiatan
 *
 * Menampilkan daftar penuh semua foto Galeri Kegiatan.
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
        <div class="gallery-masonry" id="full-gallery">
            <?php while (have_posts()): the_post(); ?>
            <div class="gallery-item"
                data-src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>">
                <?php if (has_post_thumbnail()): ?>
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>"
                    alt="<?php the_title_attribute(); ?>" loading="lazy">
                <?php else: ?>
                <div class="d-flex align-items-center justify-content-center"
                    style="background:var(--green-pale);aspect-ratio:4/3;font-size:2rem;color:var(--green-mid);">
                    <i class="fa-solid fa-image"></i>
                </div>
                <?php endif; ?>
                <div class="gallery-item__overlay"><?php the_title(); ?></div>
            </div>
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
        <div class="text-center p-5">
            <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                <i class="fa-solid fa-images"></i>
            </div>
            <h3><?php _e('Belum ada galeri','lp3aik-umk'); ?></h3>
            <p style="color:var(--text-secondary);">
                <?php _e('Belum ada foto kegiatan yang ditambahkan. Silakan tambahkan melalui menu "Galeri" di dashboard WordPress.','lp3aik-umk'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_template_part('template-parts/components/lightbox'); ?>
<?php get_footer(); ?>

```
<!-- END FILE: templates\archive-lp3aik_galeri.php -->

---

<!-- START FILE: templates\archive-lp3aik_program.php -->
## File: `templates\archive-lp3aik_program.php`

```php
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

```
<!-- END FILE: templates\archive-lp3aik_program.php -->

---

<!-- START FILE: templates\archive-lp3aik_unduhan.php -->
## File: `templates\archive-lp3aik_unduhan.php`

```php
<?php
/**
 * Archive Template: Unduhan / File Download
 *
 * Menampilkan daftar penuh semua file Unduhan.
 * Mengikuti WordPress Template Hierarchy: archive-{post_type}.php
 *
 * @package lp3aik-umk
 */

get_header();

$tipe_icons = [
    'PDF'      => 'fa-file-pdf',
    'DOCX'     => 'fa-file-word',
    'XLSX'     => 'fa-file-excel',
    'PPT'      => 'fa-file-powerpoint',
    'ZIP'      => 'fa-file-zipper',
    'Lainnya'  => 'fa-file',
];
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

<section class="section">
    <div class="container">
        <?php if (have_posts()): ?>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive"
                    style="background:var(--white);border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);overflow:hidden;">
                    <table class="table table-borderless mb-0">
                        <thead style="background:var(--green-primary);color:var(--white);">
                            <tr>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Nama File','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Tipe','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Ukuran','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Tanggal','lp3aik-umk'); ?></th>
                                <th scope="col" style="padding:1rem 1.5rem;font-weight:600;">
                                    <?php _e('Aksi','lp3aik-umk'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while (have_posts()): the_post();
                                $url    = get_post_meta(get_the_ID(), '_unduhan_url', true);
                                $ukuran = get_post_meta(get_the_ID(), '_unduhan_ukuran', true);
                                $tipe   = get_post_meta(get_the_ID(), '_unduhan_tipe', true) ?: 'PDF';
                                $icon   = $tipe_icons[$tipe] ?? 'fa-file';
                            ?>
                            <tr style="border-bottom:1px solid var(--border);transition:background .15s;"
                                onmouseover="this.style.background='var(--green-ghost)'"
                                onmouseout="this.style.background='transparent'">
                                <td style="padding:1rem 1.5rem;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div
                                            style="width:40px;height:40px;background:var(--green-pale);border-radius:8px;display:flex;align-items:center;justify-content:center;color:var(--green-primary);font-size:1.2rem;flex-shrink:0;">
                                            <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight:600;font-size:0.95rem;"><?php the_title(); ?></div>
                                            <?php if (get_the_excerpt()): ?>
                                            <div style="font-size:0.8rem;color:var(--text-secondary);">
                                                <?php echo get_the_excerpt(); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding:1rem 1.5rem;">
                                    <span class="badge"
                                        style="background:var(--green-pale);color:var(--green-primary);font-weight:500;">
                                        <?php echo esc_html($tipe); ?>
                                    </span>
                                </td>
                                <td style="padding:1rem 1.5rem;color:var(--text-secondary);font-size:0.9rem;">
                                    <?php echo esc_html($ukuran ?: '-'); ?>
                                </td>
                                <td style="padding:1rem 1.5rem;color:var(--text-secondary);font-size:0.85rem;">
                                    <i class="fa-regular fa-calendar fa-sm me-1"></i>
                                    <?php echo get_the_date('d M Y'); ?>
                                </td>
                                <td style="padding:1rem 1.5rem;">
                                    <?php if ($url): ?>
                                    <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-download"></i> <?php _e('Unduh','lp3aik-umk'); ?>
                                    </a>
                                    <?php else: ?>
                                    <span class="btn btn-outline btn-sm disabled">
                                        <i class="fa-solid fa-ban"></i> <?php _e('Tidak tersedia','lp3aik-umk'); ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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
            </div>
        </div>
        <?php else: ?>
        <div class="text-center p-5">
            <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h3><?php _e('Belum ada file unduhan','lp3aik-umk'); ?></h3>
            <p style="color:var(--text-secondary);">
                <?php _e('Belum ada file yang tersedia untuk diunduh. Silakan tambahkan melalui menu "Unduhan" di dashboard WordPress.','lp3aik-umk'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>

```
<!-- END FILE: templates\archive-lp3aik_unduhan.php -->

---

<!-- START FILE: templates\page-berita.php -->
## File: `templates\page-berita.php`

```php
<?php
/**
 * Template Name: Halaman Berita
 *
 * Halaman penuh daftar Berita & Pengumuman.
 * Menggantikan index.php untuk halaman /berita.
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
        <div class="single-wrap">
            <!-- Posts -->
            <main id="main-content">
                <?php
                $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                $posts_query = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 8,
                    'paged'          => $paged,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);
                ?>
                <?php if ($posts_query->have_posts()): ?>
                <div class="grid-2 mb-4">
                    <?php while ($posts_query->have_posts()): $posts_query->the_post(); ?>
                    <article class="card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card__image">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-card')); ?>"
                                alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center"
                                style="background:var(--green-pale);width:100%;height:100%;font-size:3rem;min-height:180px;">
                                <i class="fa-solid fa-newspaper" style="color:var(--green-mid);"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="card__body">
                            <?php if ($cats = get_the_category()): ?>
                            <div class="card__tag"><?php echo esc_html($cats[0]->name); ?></div>
                            <?php endif; ?>
                            <h2 class="card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="card__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <div class="card__meta">
                                <span><i class="fa-regular fa-calendar fa-sm"></i>
                                    <?php echo get_the_date('d M Y'); ?></span>
                                <span><i class="fa-solid fa-user-pen fa-sm"></i> <?php the_author(); ?></span>
                            </div>
                        </div>
                    </article>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    echo paginate_links([
                        'total'     => $posts_query->max_num_pages,
                        'type'      => 'list',
                        'prev_text' => '&lsaquo;',
                        'next_text' => '&rsaquo;',
                    ]);
                    ?>
                </div>

                <?php else: ?>
                <div class="sidebar-widget text-center p-5">
                    <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                    <h3><?php _e('Belum ada berita','lp3aik-umk'); ?></h3>
                    <p style="color:var(--text-secondary);">
                        <?php _e('Belum ada berita atau pengumuman yang dipublikasikan.','lp3aik-umk'); ?>
                    </p>
                </div>
                <?php endif; ?>
            </main>

            <!-- Sidebar -->
            <aside>
                <!-- Recent Posts -->
                <div class="sidebar-widget">
                    <h4><?php _e('Berita Terbaru','lp3aik-umk'); ?></h4>
                    <?php
                    $recent = new WP_Query(['post_type' => 'post', 'posts_per_page' => 5]);
                    while ($recent->have_posts()): $recent->the_post();
                    ?>
                    <a href="<?php the_permalink(); ?>" class="news-item-small mb-3"
                        style="display:flex;gap:1rem;padding-bottom:0.75rem;border-bottom:1px solid var(--border);">
                        <div class="news-item-small__image" style="width:70px;height:60px;flex-shrink:0;">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>" alt=""
                                style="width:100%;height:100%;object-fit:cover;border-radius:4px;">
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center"
                                style="background:var(--green-pale);width:100%;height:100%;border-radius:4px;">
                                <i class="fa-solid fa-newspaper fa-sm" style="color:var(--green-mid);"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <div class="news-item-small__title"
                                style="font-size:0.85rem;font-weight:600;line-height:1.3;margin-bottom:0.25rem;">
                                <?php the_title(); ?></div>
                            <div class="news-item-small__date" style="font-size:0.75rem;color:var(--text-muted);"><i
                                    class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></div>
                        </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

                <!-- Categories -->
                <div class="sidebar-widget">
                    <h4><?php _e('Kategori','lp3aik-umk'); ?></h4>
                    <ul class="footer-links" style="gap:.4rem;">
                        <?php wp_list_categories(['show_count' => true, 'title_li' => '', 'hide_empty' => false]); ?>
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php get_footer(); ?>
```
<!-- END FILE: templates\page-berita.php -->

---

<!-- START FILE: templates\page-kontak.php -->
## File: `templates\page-kontak.php`

```php
<?php
/**
 * Template Name: Halaman Kontak
 *
 * Halaman penuh Kontak / Hubungi Kami dengan UI Card modern.
 *
 * @package lp3aik-umk
 */

get_header();

// Ambil data opsi
$email = lp3aik_opt('lp3aik_email', 'lp3aik@umkotabumi.ac.id');
$addr  = lp3aik_opt('lp3aik_address', 'Jl. Hasan Kepala Ratu No. 1052, Sindangsari, Kotabumi, Lampung Utara, Provinsi Lampung, 34517.');
?>

<!-- Page Hero -->
<div class="page-hero" style="display: flex; align-items: center; text-align: center;">
    <div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;background:rgba(255,255,255,.15);border-radius:50%;margin-bottom:1.5rem;color:var(--white);font-size:1.8rem;">
            <i class="fa-solid fa-headset"></i>
        </div>
        <h1 style="margin-bottom:0.5rem;font-size:2.5rem;font-weight:700;"><?php the_title(); ?></h1>
        <p style="color:rgba(255,255,255,.8);max-width:550px;font-size:1.1rem;margin:0 auto;">
            <?php _e('Kami siap membantu Anda jika memiliki kendala dalam proses layanan, konsultasi, maupun pendaftaran program AIK.', 'lp3aik-umk'); ?>
        </p>
    </div>
</div>

<section class="section" style="background:#f8f9fa;">
    <div class="container">
        <div class="row g-4">
            
            <!-- KOLOM KIRI: Informasi Kontak -->
            <div class="col-lg-7">
                <div style="background:var(--white);padding:2.5rem;border-radius:1rem;border:1px solid #eaeaea;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);height:100%;">
                    <h3 style="color:var(--green-dark);margin-bottom:2rem;font-size:1.4rem;font-weight:700;">
                        <?php _e('Informasi Kontak','lp3aik-umk'); ?>
                    </h3>

                    <!-- Email -->
                    <?php if ($email): ?>
                    <div class="d-flex gap-4 mb-4 pb-4" style="border-bottom:1px solid #f3f4f6;">
                        <div style="width:48px;height:48px;background:var(--green-pale);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--green-primary);font-size:1.25rem;flex-shrink:0;">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.75rem;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><?php _e('EMAIL','lp3aik-umk'); ?></div>
                            <div style="font-weight:500;color:#1f2937;font-size:1rem;"><?php echo esc_html($email); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Alamat -->
                    <?php if ($addr): ?>
                    <div class="d-flex gap-4 mb-5 pb-4" style="border-bottom:1px solid #f3f4f6;">
                        <div style="width:48px;height:48px;background:rgba(200, 151, 42, 0.1);border-radius:12px;display:flex;align-items:center;justify-content:center;color:var(--gold-primary);font-size:1.25rem;flex-shrink:0;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.75rem;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><?php _e('ALAMAT','lp3aik-umk'); ?></div>
                            <div style="font-weight:500;color:#1f2937;font-size:0.95rem;line-height:1.6;"><?php echo esc_html($addr); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Media Sosial -->
                    <h5 style="font-size:0.95rem;font-weight:700;color:#4b5563;margin-bottom:1rem;"><?php _e('Media Sosial','lp3aik-umk'); ?></h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <?php 
                        // Jika ada link tersimpan di theme options, gunakan itu. Kosongkan jika tidak ada.
                        $fb = lp3aik_opt('lp3aik_facebook', '');
                        $ig = lp3aik_opt('lp3aik_instagram', '');
                        $yt = lp3aik_opt('lp3aik_youtube', '');
                        ?>
                        
                        <?php if (!empty($fb)): ?>
                        <a href="<?php echo esc_url($fb); ?>" target="_blank" rel="noopener" class="btn" style="background:#1877F2;color:white;border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.5rem 1.25rem;border:none;">
                            <i class="fa-brands fa-facebook me-1"></i> Facebook
                        </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($ig)): ?>
                        <a href="<?php echo esc_url($ig); ?>" target="_blank" rel="noopener" class="btn" style="background:linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);color:white;border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.5rem 1.25rem;border:none;">
                            <i class="fa-brands fa-instagram me-1"></i> Instagram
                        </a>
                        <?php endif; ?>
                        
                        <?php if (!empty($yt)): ?>
                        <a href="<?php echo esc_url($yt); ?>" target="_blank" rel="noopener" class="btn" style="background:#FF0000;color:white;border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.5rem 1.25rem;border:none;">
                            <i class="fa-brands fa-youtube me-1"></i> YouTube
                        </a>
                        <?php endif; ?>
                        
                        <?php if (empty($fb) && empty($ig) && empty($yt)): ?>
                        <div style="font-size:0.85rem;color:#9ca3af;">
                            <em><?php _e('Media sosial belum diatur di Customizer.','lp3aik-umk'); ?></em>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: Cards Layanan -->
            <div class="col-lg-5">
                <div class="d-flex flex-column gap-4">
                    
                    <!-- Card 1: Jam Layanan -->
                    <div style="background:var(--white);padding:2rem;border-radius:1rem;border:1px solid #eaeaea;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div style="width:36px;height:36px;background:rgba(200, 151, 42, 0.1);color:var(--gold-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <h4 style="margin:0;font-size:1.1rem;font-weight:700;color:var(--green-dark);"><?php _e('Jam Layanan', 'lp3aik-umk'); ?></h4>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3" style="border-bottom:1px solid #f3f4f6;">
                            <span style="font-weight:600;font-size:0.9rem;color:#4b5563;">Senin – Kamis</span>
                            <span style="color:var(--green-primary);font-weight:700;font-size:0.9rem;">08:00 – 16:00 WIB</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center pb-3 mb-3" style="border-bottom:1px solid #f3f4f6;">
                            <span style="font-weight:600;font-size:0.9rem;color:#4b5563;">Jumat</span>
                            <span style="color:var(--green-primary);font-weight:700;font-size:0.9rem;">08:00 – 11:30 WIB</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="font-weight:600;font-size:0.9rem;color:#4b5563;">Sabtu – Minggu</span>
                            <span style="color:#ef4444;font-weight:700;font-size:0.9rem;">Libur</span>
                        </div>
                    </div>

                    <!-- Card 2: Layanan Online -->
                    <div style="background:var(--green-pale);padding:1.5rem 1.5rem;border-radius:1rem;border:1px solid rgba(10, 74, 30, 0.1);">
                        <div class="d-flex align-items-start gap-3">
                            <div style="width:40px;height:40px;background:rgba(10, 74, 30, 0.1);color:var(--green-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div>
                                <h5 style="margin:0 0 0.25rem 0;font-size:1rem;font-weight:700;color:var(--green-dark);">Layanan Online 24/7</h5>
                                <p style="margin:0;font-size:0.85rem;color:var(--green-primary);line-height:1.5;">Pendaftaran online dan pengunggahan dokumen dapat dilakukan kapan saja melalui portal ini.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Program Kami -->
                    <div style="background:var(--white);padding:1.5rem;border-radius:1rem;border:1px solid #eaeaea;box-shadow:0 4px 6px -1px rgba(0,0,0,0.05);">
                        <div class="d-flex align-items-center gap-3">
                            <div style="width:40px;height:40px;background:rgba(200, 151, 42, 0.1);color:var(--gold-primary);border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa-solid fa-book-open"></i>
                            </div>
                            <div style="flex-grow:1;">
                                <h5 style="margin:0 0 0.25rem 0;font-size:1rem;font-weight:700;color:var(--green-dark);">Program Kami</h5>
                                <p style="margin:0;font-size:0.85rem;color:#6b7280;">Lihat program AIK yang tersedia</p>
                            </div>
                            <div>
                                <a href="<?php echo esc_url(home_url('/program')); ?>" class="btn" style="border:1px solid var(--green-primary);color:var(--green-primary);border-radius:50rem;font-size:0.85rem;font-weight:600;padding:0.4rem 1.25rem;background:transparent;">
                                    Program Kami
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
```
<!-- END FILE: templates\page-kontak.php -->

---

<!-- START FILE: templates\page-profil.php -->
## File: `templates\page-profil.php`

```php
<?php
/**
 * Template Name: Halaman Profil
 *
 * Halaman penuh untuk Profil LP3AIK, Visi Misi, Statistik, dan Tim.
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

<?php
get_template_part('template-parts/sections/section', 'about');
get_template_part('template-parts/sections/section', 'stats');
get_template_part('template-parts/sections/section', 'team');
?>

<?php get_footer(); ?>
```
<!-- END FILE: templates\page-profil.php -->

---

<!-- START FILE: templates\page-struktur-organisasi.php -->
## File: `templates\page-struktur-organisasi.php`

```php
<?php
/**
 * Template Name: Halaman Struktur Organisasi
 *
 * Halaman penuh Struktur Organisasi / Tim LP3AIK.
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
        <!-- Konten dari WP Editor -->
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if (get_the_content()) : ?>
        <div class="entry-content"
            style="background:var(--white);padding:2rem 3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);margin-bottom:2.5rem;">
            <?php the_content(); ?>
        </div>
        <?php endif; ?>
        <?php endwhile; endif; ?>

        <?php
        $team = new WP_Query([
            'post_type'      => 'lp3aik_tim',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);
        ?>

        <?php if ($team->have_posts()): ?>
        <h3 class="text-center mb-4" style="color:var(--green-dark);">
            <i class="fa-solid fa-users me-2"></i><?php _e('Seluruh Pengurus LP3AIK','lp3aik-umk'); ?>
        </h3>
        <div class="grid-4">
            <?php while ($team->have_posts()): $team->the_post(); ?>
            <?php get_template_part('template-parts/cards/card', 'team'); ?>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else: ?>
        <div class="text-center p-5">
            <div style="font-size:3rem;margin-bottom:1rem;color:var(--green-mid);">
                <i class="fa-solid fa-users-slash"></i>
            </div>
            <h3><?php _e('Belum ada data pengurus','lp3aik-umk'); ?></h3>
            <p style="color:var(--text-secondary);">
                <?php _e('Silakan tambahkan data tim/pengurus melalui menu "Tim" di dashboard WordPress.','lp3aik-umk'); ?>
            </p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
```
<!-- END FILE: templates\page-struktur-organisasi.php -->

---

<!-- START FILE: templates\page-visi-misi.php -->
## File: `templates\page-visi-misi.php`

```php
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
```
<!-- END FILE: templates\page-visi-misi.php -->

---

<!-- START FILE: templates\single-lp3aik_galeri.php -->
## File: `templates\single-lp3aik_galeri.php`

```php
<?php
/**
 * Single Template: Galeri Kegiatan
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
            <div class="col-lg-8">
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()): ?>
                    <div class="entry-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                            alt="<?php the_title_attribute(); ?>"
                            style="width:100%;border-radius:var(--radius-lg);box-shadow:var(--shadow-md);">
                    </div>
                    <?php endif; ?>

                    <div class="entry-meta mb-4 d-flex gap-4 align-items-center flex-wrap"
                        style="color:var(--text-secondary);font-size:0.9rem;border-bottom:1px solid var(--border);padding-bottom:1rem;">
                        <span><i class="fa-regular fa-calendar" style="color:var(--green-primary);"></i> <?php echo get_the_date('d M Y'); ?></span>
                        <?php $albums = get_the_terms(get_the_ID(), 'album_galeri');
                        if ($albums && !is_wp_error($albums)): ?>
                        <span><i class="fa-solid fa-folder-open" style="color:var(--green-primary);"></i> <?php echo esc_html($albums[0]->name); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if (get_the_content()): ?>
                    <div class="entry-content" style="background:var(--white);padding:2rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);margin-bottom:2rem;">
                        <?php the_content(); ?>
                    </div>
                    <?php endif; ?>
                </article>
                <?php endwhile; ?>

                <div class="mt-5">
                    <h3 style="color:var(--green-dark);margin-bottom:1.5rem;">
                        <i class="fa-solid fa-images me-2"></i><?php _e('Galeri Lainnya','lp3aik-umk'); ?>
                    </h3>
                    <?php
                    $related = new WP_Query([
                        'post_type'      => 'lp3aik_galeri',
                        'posts_per_page' => 6,
                        'post__not_in'   => [get_the_ID()],
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ]);
                    if ($related->have_posts()): ?>
                    <div class="gallery-masonry">
                        <?php while ($related->have_posts()): $related->the_post(); ?>
                        <div class="gallery-item" data-src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>">
                            <?php if (has_post_thumbnail()): ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'lp3aik-gallery')); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center" style="background:var(--green-pale);aspect-ratio:4/3;font-size:2rem;color:var(--green-mid);"><i class="fa-solid fa-image"></i></div>
                            <?php endif; ?>
                            <div class="gallery-item__overlay"><?php the_title(); ?></div>
                        </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/components/lightbox'); ?>
<?php get_footer(); ?>

```
<!-- END FILE: templates\single-lp3aik_galeri.php -->

---

<!-- START FILE: templates\single-lp3aik_program.php -->
## File: `templates\single-lp3aik_program.php`

```php
<?php
/**
 * Single Template: Program / Layanan AIK
 *
 * Menampilkan detail satu Program AIK.
 * Mengikuti WordPress Template Hierarchy: single-{post_type}.php
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
            <div class="col-lg-8">
                <?php while (have_posts()): the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <?php if (has_post_thumbnail()): ?>
                    <div class="entry-featured-image mb-4">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                            alt="<?php the_title_attribute(); ?>"
                            style="width:100%;border-radius:var(--radius-lg);">
                    </div>
                    <?php endif; ?>

                    <?php
                    $icon_class = get_post_meta(get_the_ID(), '_program_icon', true);
                    $sasaran    = get_post_meta(get_the_ID(), '_program_sasaran', true);
                    ?>

                    <?php if ($sasaran): ?>
                    <div class="mb-4 d-flex align-items-center gap-2"
                        style="color:var(--green-primary);font-size:0.9rem;">
                        <i class="fa-solid fa-users"></i>
                        <span><strong><?php _e('Sasaran:','lp3aik-umk'); ?></strong> <?php echo esc_html($sasaran); ?></span>
                    </div>
                    <?php endif; ?>

                    <div class="entry-content"
                        style="background:var(--white);padding:3rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);font-size:1.05rem;line-height:1.8;">
                        <?php the_content(); ?>
                    </div>

                    <!-- Navigasi Program Lain -->
                    <div class="mt-5">
                        <h3 style="color:var(--green-dark);margin-bottom:1.5rem;">
                            <i class="fa-solid fa-layer-group me-2"></i><?php _e('Program Lainnya','lp3aik-umk'); ?>
                        </h3>
                        <?php
                        $related = new WP_Query([
                            'post_type'      => 'lp3aik_program',
                            'posts_per_page' => 3,
                            'post__not_in'   => [get_the_ID()],
                            'orderby'        => 'menu_order',
                            'order'          => 'ASC',
                        ]);
                        if ($related->have_posts()):
                        ?>
                        <div class="grid-3">
                            <?php while ($related->have_posts()): $related->the_post(); ?>
                            <?php get_template_part('template-parts/cards/card', 'program'); ?>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

```
<!-- END FILE: templates\single-lp3aik_program.php -->

---

<!-- START FILE: templates\single-lp3aik_unduhan.php -->
## File: `templates\single-lp3aik_unduhan.php`

```php
<?php
/**
 * Single Template: Unduhan / File Download
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
            <div class="col-lg-8">
                <?php while (have_posts()): the_post();
                    $url    = get_post_meta(get_the_ID(), '_unduhan_url', true);
                    $ukuran = get_post_meta(get_the_ID(), '_unduhan_ukuran', true);
                    $tipe   = get_post_meta(get_the_ID(), '_unduhan_tipe', true) ?: 'PDF';
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div style="background:var(--white);padding:2.5rem;border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);border:1px solid var(--border);">
                        <div class="d-flex align-items-center gap-3 mb-4 pb-4" style="border-bottom:1px solid var(--border);">
                            <div style="width:60px;height:60px;background:var(--green-pale);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;color:var(--green-primary);font-size:1.8rem;flex-shrink:0;">
                                <i class="fa-solid fa-file-<?php echo $tipe === 'PDF' ? 'pdf' : ($tipe === 'DOCX' ? 'word' : ($tipe === 'XLSX' ? 'excel' : 'lines')); ?>"></i>
                            </div>
                            <div>
                                <div style="font-weight:700;font-size:1.1rem;"><?php the_title(); ?></div>
                                <div class="d-flex gap-3 mt-1" style="font-size:.85rem;color:var(--text-secondary);">
                                    <span><i class="fa-solid fa-tag fa-sm"></i> <?php echo esc_html($tipe); ?></span>
                                    <?php if ($ukuran): ?>
                                    <span><i class="fa-solid fa-weight-scale fa-sm"></i> <?php echo esc_html($ukuran); ?></span>
                                    <?php endif; ?>
                                    <span><i class="fa-regular fa-calendar fa-sm"></i> <?php echo get_the_date('d M Y'); ?></span>
                                </div>
                            </div>
                        </div>

                        <?php if (get_the_content()): ?>
                        <div class="entry-content mb-4" style="line-height:1.8;">
                            <?php the_content(); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ($url): ?>
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-download me-1"></i> <?php _e('Download File','lp3aik-umk'); ?>
                        </a>
                        <?php else: ?>
                        <span class="btn btn-outline btn-lg disabled">
                            <i class="fa-solid fa-ban me-1"></i> <?php _e('File tidak tersedia','lp3aik-umk'); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

```
<!-- END FILE: templates\single-lp3aik_unduhan.php -->

---

