<?php
function lp3aik_add_settings_page() {
    add_theme_page(
        'Pengaturan LP3AIK',
        'Pengaturan LP3AIK',
        'manage_options',
        'lp3aik-settings',
        'lp3aik_settings_page_callback'
    );
}
add_action('admin_menu', 'lp3aik_add_settings_page');

function lp3aik_settings_page_callback() {
    if (isset($_POST['lp3aik_save_settings'])) {
        if (!current_user_can('manage_options')) {
            wp_die(esc_html__('Anda tidak memiliki izin.', 'lp3aik'));
        }
        check_admin_referer('lp3aik_settings_nonce', 'lp3aik_settings_nonce_field');

        $settings = [];
        $fields = [
            'logo_header_light' => 'esc_url_raw',
            'logo_header_dark'  => 'esc_url_raw',
            'logo_header_type'  => 'sanitize_text_field',
            'logo_footer_umko'  => 'esc_url_raw',
            'hero_interval'     => 'absint',
            'tagline'           => 'sanitize_text_field',
            'phone'             => 'sanitize_text_field',
            'email'             => 'sanitize_email',
            'address'           => 'sanitize_textarea_field',
            'maps_embed'        => 'sanitize_textarea_field',
            'instagram'         => 'sanitize_text_field',
            'facebook'          => 'sanitize_text_field',
            'youtube'           => 'sanitize_text_field',
            'whatsapp'          => 'sanitize_text_field',
            'footer_text'       => 'sanitize_textarea_field',
            'about_image'       => 'esc_url_raw',
            'ga_id'             => 'sanitize_text_field',
        ];

        for ($i = 1; $i <= 5; $i++) {
            $fields['hero_slide_' . $i . '_img']   = 'esc_url_raw';
            $fields['hero_slide_' . $i . '_title'] = 'sanitize_text_field';
            $fields['hero_slide_' . $i . '_sub']   = 'sanitize_text_field';
            $fields['hero_slide_' . $i . '_btn']   = 'sanitize_text_field';
            $fields['hero_slide_' . $i . '_link']  = 'esc_url_raw';
        }

        foreach ($fields as $key => $sanitizer) {
            if (isset($_POST[$key])) {
                $settings[$key] = call_user_func($sanitizer, wp_unslash($_POST[$key]));
            } else {
                $settings[$key] = '';
            }
        }

        update_option('lp3aik_theme_settings', $settings);
        echo '<div class="notice notice-success is-dismissible"><p>Pengaturan berhasil disimpan.</p></div>';
    }

    $s = get_option('lp3aik_theme_settings', []);
    ?>
    <div class="wrap lp3aik-admin-wrap">
        <h1><?php echo esc_html__('Pengaturan LP3AIK', 'lp3aik'); ?></h1>
        <form method="post" action="">
            <?php wp_nonce_field('lp3aik_settings_nonce', 'lp3aik_settings_nonce_field'); ?>

            <h2 class="nav-tab-wrapper" style="margin-bottom:20px;">
                <a href="#" class="nav-tab nav-tab-active lp3aik-tab-link" data-tab="tab-logo">Logo</a>
                <a href="#" class="nav-tab lp3aik-tab-link" data-tab="tab-hero">Hero Carousel</a>
                <a href="#" class="nav-tab lp3aik-tab-link" data-tab="tab-contact">Kontak & Sosmed</a>
                <a href="#" class="nav-tab lp3aik-tab-link" data-tab="tab-other">Lainnya</a>
            </h2>

            <!-- TAB: LOGO -->
            <div class="lp3aik-tab-content" id="tab-logo" style="display:block;">
                <table class="form-table">
                    <tr>
                        <th><label for="logo_header_light">Logo Terang (Light)</label></th>
                        <td>
                            <div class="lp3aik-upload-group">
                                <input type="text" id="logo_header_light" name="logo_header_light" value="<?php echo esc_attr($s['logo_header_light'] ?? ''); ?>" class="regular-text lp3aik-img-input">
                                <button type="button" class="button lp3aik-upload-button" data-target="logo_header_light">Pilih Gambar</button>
                                <span class="lp3aik-preview-wrap"><?php if (!empty($s['logo_header_light'])): ?><img src="<?php echo esc_url($s['logo_header_light']); ?>" class="lp3aik-preview-thumb"><?php endif; ?></span>
                            </div>
                            <p class="description">Logo berwarna putih/terang untuk navbar transparan (saat berada di paling atas halaman).</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="logo_header_dark">Logo Gelap (Dark)</label></th>
                        <td>
                            <div class="lp3aik-upload-group">
                                <input type="text" id="logo_header_dark" name="logo_header_dark" value="<?php echo esc_attr($s['logo_header_dark'] ?? ''); ?>" class="regular-text lp3aik-img-input">
                                <button type="button" class="button lp3aik-upload-button" data-target="logo_header_dark">Pilih Gambar</button>
                                <span class="lp3aik-preview-wrap"><?php if (!empty($s['logo_header_dark'])): ?><img src="<?php echo esc_url($s['logo_header_dark']); ?>" class="lp3aik-preview-thumb"><?php endif; ?></span>
                            </div>
                            <p class="description">Logo berwarna/gelap untuk navbar berwarna putih (saat halaman di-scroll).</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="logo_header_type">Tipe Logo Navbar</label></th>
                        <td>
                            <select id="logo_header_type" name="logo_header_type">
                                <option value="full" <?php selected($s['logo_header_type'] ?? 'full', 'full'); ?>>Logo Full (Hanya Gambar)</option>
                                <option value="short" <?php selected($s['logo_header_type'] ?? 'full', 'short'); ?>>Logo Pendek (Gambar + Nama Situs)</option>
                            </select>
                            <p class="description">Pilih bagaimana logo ditampilkan di header navbar.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="logo_footer_umko">Logo UMKO &mdash; Footer</label></th>
                        <td>
                            <div class="lp3aik-upload-group">
                                <input type="text" id="logo_footer_umko" name="logo_footer_umko" value="<?php echo esc_attr($s['logo_footer_umko'] ?? ''); ?>" class="regular-text lp3aik-img-input">
                                <button type="button" class="button lp3aik-upload-button" data-target="logo_footer_umko">Pilih Gambar</button>
                                <span class="lp3aik-preview-wrap"><?php if (!empty($s['logo_footer_umko'])): ?><img src="<?php echo esc_url($s['logo_footer_umko']); ?>" class="lp3aik-preview-thumb"><?php endif; ?></span>
                            </div>
                            <p class="description">Logo Universitas Muhammadiyah Kotabumi untuk footer. Muncul di bawah logo LP3AIK.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- TAB: HERO CAROUSEL -->
            <div class="lp3aik-tab-content" id="tab-hero" style="display:none;">
                <table class="form-table">
                    <tr>
                        <th><label for="hero_interval">Interval Carousel (ms)</label></th>
                        <td>
                            <input type="number" id="hero_interval" name="hero_interval" value="<?php echo esc_attr($s['hero_interval'] ?? '6000'); ?>" class="small-text" min="1000" step="500">
                            <p class="description">Durasi tiap slide dalam milidetik (1000 ms = 1 detik). Default: 6000.</p>
                        </td>
                    </tr>
                </table>

                <hr>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                <h3 style="margin-top:24px;">Slide <?php echo $i; ?></h3>
                <table class="form-table">
                    <tr>
                        <th><label for="hero_slide_<?php echo $i; ?>_img">Gambar Slide</label></th>
                        <td>
                            <div class="lp3aik-upload-group">
                                <input type="text" id="hero_slide_<?php echo $i; ?>_img" name="hero_slide_<?php echo $i; ?>_img" value="<?php echo esc_attr($s['hero_slide_' . $i . '_img'] ?? ''); ?>" class="regular-text lp3aik-img-input">
                                <button type="button" class="button lp3aik-upload-button" data-target="hero_slide_<?php echo $i; ?>_img">Pilih Gambar</button>
                                <span class="lp3aik-preview-wrap"><?php if (!empty($s['hero_slide_' . $i . '_img'])): ?><img src="<?php echo esc_url($s['hero_slide_' . $i . '_img']); ?>" class="lp3aik-preview-thumb"><?php endif; ?></span>
                            </div>
                            <p class="description">Rekomendasi: 1920×800 px. Jika kosong, slide ini tidak ditampilkan.</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="hero_slide_<?php echo $i; ?>_title">Judul</label></th>
                        <td><input type="text" id="hero_slide_<?php echo $i; ?>_title" name="hero_slide_<?php echo $i; ?>_title" value="<?php echo esc_attr($s['hero_slide_' . $i . '_title'] ?? ''); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th><label for="hero_slide_<?php echo $i; ?>_sub">Subjudul / Deskripsi</label></th>
                        <td><input type="text" id="hero_slide_<?php echo $i; ?>_sub" name="hero_slide_<?php echo $i; ?>_sub" value="<?php echo esc_attr($s['hero_slide_' . $i . '_sub'] ?? ''); ?>" class="large-text"></td>
                    </tr>
                    <tr>
                        <th><label for="hero_slide_<?php echo $i; ?>_btn">Teks Tombol</label></th>
                        <td><input type="text" id="hero_slide_<?php echo $i; ?>_btn" name="hero_slide_<?php echo $i; ?>_btn" value="<?php echo esc_attr($s['hero_slide_' . $i . '_btn'] ?? ''); ?>" class="regular-text" placeholder="Selengkapnya"></td>
                    </tr>
                    <tr>
                        <th><label for="hero_slide_<?php echo $i; ?>_link">Link Tombol</label></th>
                        <td><input type="url" id="hero_slide_<?php echo $i; ?>_link" name="hero_slide_<?php echo $i; ?>_link" value="<?php echo esc_attr($s['hero_slide_' . $i . '_link'] ?? ''); ?>" class="large-text" placeholder="https://..."></td>
                    </tr>
                </table>
                <?php endfor; ?>
            </div>

            <!-- TAB: KONTAK & SOSMED -->
            <div class="lp3aik-tab-content" id="tab-contact" style="display:none;">
                <table class="form-table">
                    <tr><th><label for="tagline">Tagline / Slogan</label></th><td><input type="text" id="tagline" name="tagline" value="<?php echo esc_attr($s['tagline'] ?? ''); ?>" class="large-text"></td></tr>
                    <tr><th><label for="phone">Nomor Telepon</label></th><td><input type="text" id="phone" name="phone" value="<?php echo esc_attr($s['phone'] ?? ''); ?>" class="regular-text"></td></tr>
                    <tr><th><label for="email">Email</label></th><td><input type="email" id="email" name="email" value="<?php echo esc_attr($s['email'] ?? ''); ?>" class="regular-text"></td></tr>
                    <tr><th><label for="address">Alamat</label></th><td><textarea id="address" name="address" rows="3" class="large-text"><?php echo esc_textarea($s['address'] ?? ''); ?></textarea></td></tr>
                    <tr><th><label for="maps_embed">Google Maps Embed URL</label></th><td><textarea id="maps_embed" name="maps_embed" rows="3" class="large-text" placeholder="URL embed iframe dari Google Maps"><?php echo esc_textarea($s['maps_embed'] ?? ''); ?></textarea></td></tr>
                </table>
                <hr>
                <h3>Media Sosial</h3>
                <table class="form-table">
                    <tr><th><label for="instagram"><i class="bi bi-instagram"></i> Instagram</label></th><td><input type="url" id="instagram" name="instagram" value="<?php echo esc_attr($s['instagram'] ?? ''); ?>" class="regular-text"></td></tr>
                    <tr><th><label for="facebook"><i class="bi bi-facebook"></i> Facebook</label></th><td><input type="url" id="facebook" name="facebook" value="<?php echo esc_attr($s['facebook'] ?? ''); ?>" class="regular-text"></td></tr>
                    <tr><th><label for="youtube"><i class="bi bi-youtube"></i> YouTube</label></th><td><input type="url" id="youtube" name="youtube" value="<?php echo esc_attr($s['youtube'] ?? ''); ?>" class="regular-text"></td></tr>
                    <tr><th><label for="whatsapp"><i class="bi bi-whatsapp"></i> Nomor WhatsApp/HP</label></th><td><input type="text" id="whatsapp" name="whatsapp" value="<?php echo esc_attr($s['whatsapp'] ?? ''); ?>" class="regular-text" placeholder="Contoh: 628123456789 atau 08123456789"><p class="description">Masukkan nomor HP/WhatsApp (angka saja, tanpa tanda + atau spasi). Gunakan Shift+Enter di form nomor HP di atas untuk baris baru.</p></td></tr>
                </table>
            </div>

            <!-- TAB: LAINNYA -->
            <div class="lp3aik-tab-content" id="tab-other" style="display:none;">
                <table class="form-table">
                    <tr><th><label for="footer_text">Teks Footer</label></th><td><textarea id="footer_text" name="footer_text" rows="3" class="large-text"><?php echo esc_textarea($s['footer_text'] ?? ''); ?></textarea></td></tr>
                    <tr>
                        <th><label for="about_image">Gambar Section Tentang</label></th>
                        <td>
                            <div class="lp3aik-upload-group">
                                <input type="text" id="about_image" name="about_image" value="<?php echo esc_attr($s['about_image'] ?? ''); ?>" class="regular-text lp3aik-img-input">
                                <button type="button" class="button lp3aik-upload-button" data-target="about_image">Pilih Gambar</button>
                                <span class="lp3aik-preview-wrap"><?php if (!empty($s['about_image'])): ?><img src="<?php echo esc_url($s['about_image']); ?>" class="lp3aik-preview-thumb"><?php endif; ?></span>
                            </div>
                            <p class="description">Gambar untuk section "Tentang LP3AIK" di Beranda.</p>
                        </td>
                    </tr>
                    <tr><th><label for="ga_id">Google Analytics ID</label></th><td><input type="text" id="ga_id" name="ga_id" value="<?php echo esc_attr($s['ga_id'] ?? ''); ?>" class="regular-text" placeholder="G-XXXXXXXXXX"></td></tr>
                </table>
            </div>

            <p class="submit">
                <button type="submit" name="lp3aik_save_settings" class="button button-primary button-hero">Simpan Semua Pengaturan</button>
            </p>
        </form>
    </div>
    <?php
}
