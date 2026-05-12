<?php
/**
 * Navigation Helpers.
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;

/**
 * Fallback navigation when no menu is assigned via Appearance > Menus.
 * Renders a structured menu matching the site's page structure.
 */
function lp3aik_default_menu(): void {
    global $wp;
    $current_url  = home_url(add_query_arg([], $wp->request));
    $request_path = '/' . ltrim($wp->request ?? '', '/');

    $is_active = function (string $path) use ($request_path): bool {
        if ($path === '/' && ($request_path === '/' || $request_path === '')) return true;
        if ($path !== '/' && str_starts_with($request_path, $path)) return true;
        return false;
    };

    // Resolve CPT archive URLs natively
    $program_url = get_post_type_archive_link('lp3aik_program') ?: home_url('/program/');
    $galeri_url  = get_post_type_archive_link('lp3aik_galeri')  ?: home_url('/galeri/');
    $unduhan_url = get_post_type_archive_link('lp3aik_unduhan') ?: home_url('/unduhan/');

    // Resolve page URLs by slug (English slugs now)
    $get_page_url = function (string $slug): string {
        $page = get_page_by_path($slug);
        return $page ? get_permalink($page->ID) : home_url('/' . $slug . '/');
    };
    ?>
    <ul class="primary-nav">
        <!-- Home -->
        <li class="<?php echo $is_active('/') && $request_path === '/' ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Beranda', 'lp3aik-umk'); ?></a>
        </li>

        <!-- About Us (Dropdown) -->
        <li class="menu-item-has-children <?php echo ($is_active('/profile') || $is_active('/vision-mission') || $is_active('/org-structure')) ? 'current-menu-ancestor' : ''; ?>">
            <a href="#"><?php esc_html_e('Tentang Kami', 'lp3aik-umk'); ?> <i class="fa-solid fa-chevron-down fa-2xs ms-1"></i></a>
            <ul class="sub-menu">
                <li><a href="<?php echo esc_url($get_page_url('profile')); ?>"><?php esc_html_e('Profil', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url($get_page_url('vision-mission')); ?>"><?php esc_html_e('Visi & Misi', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url($get_page_url('org-structure')); ?>"><?php esc_html_e('Struktur Organisasi', 'lp3aik-umk'); ?></a></li>
            </ul>
        </li>

        <!-- Program -->
        <li class="<?php echo $is_active('/program') ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url($program_url); ?>"><?php esc_html_e('Program', 'lp3aik-umk'); ?></a>
        </li>

        <!-- Information (Dropdown) -->
        <li class="menu-item-has-children <?php echo ($is_active('/news') || $is_active('/galeri') || $is_active('/unduhan')) ? 'current-menu-ancestor' : ''; ?>">
            <a href="#"><?php esc_html_e('Informasi', 'lp3aik-umk'); ?> <i class="fa-solid fa-chevron-down fa-2xs ms-1"></i></a>
            <ul class="sub-menu">
                <li><a href="<?php echo esc_url($get_page_url('news')); ?>"><?php esc_html_e('Berita & Pengumuman', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url($galeri_url); ?>"><?php esc_html_e('Galeri Kegiatan', 'lp3aik-umk'); ?></a></li>
                <li><a href="<?php echo esc_url($unduhan_url); ?>"><?php esc_html_e('Unduhan / File', 'lp3aik-umk'); ?></a></li>
            </ul>
        </li>

        <!-- Contact -->
        <li class="<?php echo $is_active('/contact') ? 'current-menu-item' : ''; ?>">
            <a href="<?php echo esc_url($get_page_url('contact')); ?>"><?php esc_html_e('Hubungi Kami', 'lp3aik-umk'); ?></a>
        </li>
    </ul>
    <?php
}
