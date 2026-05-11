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
