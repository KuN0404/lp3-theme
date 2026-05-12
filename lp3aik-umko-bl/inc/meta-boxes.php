<?php
/**
 * Meta Boxes Admin - LP3AIK
 * Form admin untuk: Struktur Organisasi, Program, Galeri, Unduhan
 * Keamanan: nonce, sanitize, escape, capability check
 * Path: inc/meta-boxes.php
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ==========================================================================
   1. STRUKTUR ORGANISASI
   ========================================================================== */

function lp3aik_add_org_meta_boxes() {
    add_meta_box(
        'lp3aik_org_details',
        '<span class="dashicons dashicons-businessperson" style="margin-right:6px;"></span> Detail Anggota Organisasi',
        'lp3aik_org_meta_box_cb',
        'lp3aik_org_structure',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lp3aik_add_org_meta_boxes' );

function lp3aik_org_meta_box_cb( $post ) {
    wp_nonce_field( 'lp3aik_org_save', 'lp3aik_org_nonce' );

    $jabatan = get_post_meta( $post->ID, '_org_jabatan', true );
    $unit    = get_post_meta( $post->ID, '_org_unit', true );
    $nip     = get_post_meta( $post->ID, '_org_nip', true );
    $order   = get_post_meta( $post->ID, '_org_order', true );
    ?>
    <div class="lp3aik-metabox-wrap">
        <p class="lp3aik-meta-hint">
            <span class="dashicons dashicons-info"></span>
            Isi data detail anggota struktur organisasi. Foto diatur melalui <strong>Featured Image</strong> di sidebar kanan.
        </p>
        <table class="form-table lp3aik-meta-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="org_jabatan">Jabatan <span class="required">*</span></label>
                    </th>
                    <td>
                        <input type="text"
                               id="org_jabatan"
                               name="org_jabatan"
                               value="<?php echo esc_attr( $jabatan ); ?>"
                               class="regular-text"
                               placeholder="Contoh: Ketua LP3AIK"
                               maxlength="100">
                        <p class="description">Jabatan resmi dalam struktur organisasi.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="org_unit">Unit / Divisi</label>
                    </th>
                    <td>
                        <input type="text"
                               id="org_unit"
                               name="org_unit"
                               value="<?php echo esc_attr( $unit ); ?>"
                               class="regular-text"
                               placeholder="Contoh: Divisi Pengkajian"
                               maxlength="100">
                        <p class="description">Unit atau divisi tempat bertugas.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="org_nip">NIP / NIDN</label>
                    </th>
                    <td>
                        <input type="text"
                               id="org_nip"
                               name="org_nip"
                               value="<?php echo esc_attr( $nip ); ?>"
                               class="regular-text"
                               placeholder="Nomor Induk Pegawai/Dosen"
                               maxlength="30">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="org_order">Urutan Tampil</label>
                    </th>
                    <td>
                        <input type="number"
                               id="org_order"
                               name="org_order"
                               value="<?php echo esc_attr( $order !== '' ? $order : '0' ); ?>"
                               class="small-text"
                               min="0"
                               max="999"
                               step="1">
                        <p class="description">Angka lebih kecil tampil lebih dulu (0 = pertama).</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

function lp3aik_save_org_meta( $post_id ) {
    if ( ! isset( $_POST['lp3aik_org_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lp3aik_org_nonce'] ) ), 'lp3aik_org_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = [
        'org_jabatan' => '_org_jabatan',
        'org_unit'    => '_org_unit',
        'org_nip'     => '_org_nip',
    ];
    foreach ( $fields as $post_key => $meta_key ) {
        if ( isset( $_POST[ $post_key ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $post_key ] ) ) );
        }
    }

    // Order: angka saja
    if ( isset( $_POST['org_order'] ) ) {
        update_post_meta( $post_id, '_org_order', absint( $_POST['org_order'] ) );
    }
}
add_action( 'save_post_lp3aik_org_structure', 'lp3aik_save_org_meta' );


/* ==========================================================================
   2. PROGRAM
   ========================================================================== */

function lp3aik_add_program_meta_boxes() {
    add_meta_box(
        'lp3aik_program_details',
        '<span class="dashicons dashicons-welcome-learn-more" style="margin-right:6px;"></span> Detail Program',
        'lp3aik_program_meta_box_cb',
        'lp3aik_program',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lp3aik_add_program_meta_boxes' );

function lp3aik_program_meta_box_cb( $post ) {
    wp_nonce_field( 'lp3aik_program_save', 'lp3aik_program_nonce' );

    $featured = get_post_meta( $post->ID, '_program_featured', true );

    // Hitung berapa program unggulan yang sudah ada (selain post ini)
    $featured_others = get_posts( [
        'post_type'   => 'lp3aik_program',
        'numberposts' => -1,
        'exclude'     => [ $post->ID ],
        'meta_key'    => '_program_featured',
        'meta_value'  => '1',
        'fields'      => 'ids',
    ] );
    $featured_count = count( $featured_others );
    ?>
    <div class="lp3aik-metabox-wrap">
        <table class="form-table lp3aik-meta-table">
            <tbody>
                <tr>
                    <th scope="row">Program Unggulan</th>
                    <td>
                        <?php if ( $featured_count >= 3 && $featured !== '1' ) : ?>
                        <div class="notice notice-warning inline" style="margin:0 0 10px;padding:8px 12px;">
                            <p style="margin:0;">
                                <span class="dashicons dashicons-warning" style="color:#d97706;"></span>
                                <strong>Batas Maksimum:</strong> Sudah ada 3 program yang ditandai sebagai Unggulan.
                                Hapus tanda pada program lain terlebih dahulu untuk menambahkan yang baru.
                            </p>
                        </div>
                        <label style="opacity:.5;cursor:not-allowed;">
                            <input type="checkbox" name="program_featured" value="1" disabled>
                            <strong>Tampilkan sebagai Program Unggulan di Beranda</strong>
                        </label>
                        <?php else : ?>
                        <label for="program_featured" style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="checkbox"
                                   id="program_featured"
                                   name="program_featured"
                                   value="1"
                                   <?php checked( $featured, '1' ); ?>>
                            <strong>Tampilkan sebagai Program Unggulan di Beranda</strong>
                        </label>
                        <p class="description">
                            Program unggulan ditampilkan di section "Program Unggulan" halaman beranda.
                            <?php if ( $featured === '1' ) : ?>
                                <span style="color:#d97706;"><span class="dashicons dashicons-star-filled" style="font-size:14px;"></span> Saat ini sudah ditandai unggulan. (<?php echo esc_html( $featured_count ); ?>/3 slot terpakai)</span>
                            <?php else : ?>
                                <span style="color:#666;">(<?php echo esc_html( $featured_count ); ?>/3 slot sudah terpakai)</span>
                            <?php endif; ?>
                        </p>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

function lp3aik_save_program_meta( $post_id ) {
    if ( ! isset( $_POST['lp3aik_program_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lp3aik_program_nonce'] ) ), 'lp3aik_program_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Featured: checkbox dengan validasi maks 3
    $want_featured = isset( $_POST['program_featured'] ) && $_POST['program_featured'] === '1';

    if ( $want_featured ) {
        // Hitung yang sudah featured (selain post ini)
        $featured_others = get_posts( [
            'post_type'   => 'lp3aik_program',
            'numberposts' => -1,
            'exclude'     => [ $post_id ],
            'meta_key'    => '_program_featured',
            'meta_value'  => '1',
            'fields'      => 'ids',
        ] );

        if ( count( $featured_others ) >= 3 ) {
            // Sudah 3, tolak — simpan sebagai tidak featured
            update_post_meta( $post_id, '_program_featured', '0' );
            // Simpan flag notice
            set_transient( 'lp3aik_featured_limit_' . get_current_user_id(), true, 45 );
        } else {
            update_post_meta( $post_id, '_program_featured', '1' );
        }
    } else {
        update_post_meta( $post_id, '_program_featured', '0' );
    }
}
add_action( 'save_post_lp3aik_program', 'lp3aik_save_program_meta' );

// Admin notice jika melebihi batas 3 featured
function lp3aik_featured_limit_notice() {
    $screen = get_current_screen();
    if ( ! $screen || $screen->post_type !== 'lp3aik_program' ) {
        return;
    }
    if ( get_transient( 'lp3aik_featured_limit_' . get_current_user_id() ) ) {
        delete_transient( 'lp3aik_featured_limit_' . get_current_user_id() );
        echo '<div class="notice notice-error is-dismissible"><p>';
        echo '<strong>Program Unggulan Penuh:</strong> Sudah ada 3 program yang ditandai sebagai Unggulan. '
           . 'Hapus tanda unggulan pada program lain terlebih dahulu.';
        echo '</p></div>';
    }
}
add_action( 'admin_notices', 'lp3aik_featured_limit_notice' );


/* ==========================================================================
   3. GALERI - Meta Box: Deskripsi & Kategori
   ========================================================================== */

function lp3aik_add_galeri_meta_boxes() {
    add_meta_box(
        'lp3aik_galeri_details',
        '<span class="dashicons dashicons-format-gallery" style="margin-right:6px;"></span> Detail Foto Galeri',
        'lp3aik_galeri_meta_box_cb',
        'lp3aik_galeri',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lp3aik_add_galeri_meta_boxes' );

function lp3aik_galeri_meta_box_cb( $post ) {
    wp_nonce_field( 'lp3aik_galeri_save', 'lp3aik_galeri_nonce' );
    $keterangan = get_post_meta( $post->ID, '_galeri_keterangan', true );
    ?>
    <div class="lp3aik-metabox-wrap">
        <p class="lp3aik-meta-hint">
            <span class="dashicons dashicons-info"></span>
            <strong>Featured Image</strong> di sidebar kanan adalah foto yang akan ditampilkan di galeri.
            Pastikan ukuran foto minimal 800×600 px.
        </p>
        <table class="form-table lp3aik-meta-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="galeri_keterangan">Keterangan Foto</label>
                    </th>
                    <td>
                        <textarea id="galeri_keterangan"
                                  name="galeri_keterangan"
                                  rows="3"
                                  class="large-text"
                                  maxlength="500"
                                  placeholder="Deskripsi singkat foto ini..."><?php echo esc_textarea( $keterangan ); ?></textarea>
                        <p class="description">Keterangan ini tampil di bawah foto pada lightbox galeri.</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

function lp3aik_save_galeri_meta( $post_id ) {
    if ( ! isset( $_POST['lp3aik_galeri_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lp3aik_galeri_nonce'] ) ), 'lp3aik_galeri_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['galeri_keterangan'] ) ) {
        update_post_meta( $post_id, '_galeri_keterangan', sanitize_textarea_field( wp_unslash( $_POST['galeri_keterangan'] ) ) );
    }
}
add_action( 'save_post_lp3aik_galeri', 'lp3aik_save_galeri_meta' );


/* ==========================================================================
   4. UNDUHAN - Meta Box: File URL, Ukuran
   ========================================================================== */

function lp3aik_add_unduhan_meta_boxes() {
    add_meta_box(
        'lp3aik_unduhan_details',
        '<span class="dashicons dashicons-download" style="margin-right:6px;"></span> Detail File Unduhan',
        'lp3aik_unduhan_meta_box_cb',
        'lp3aik_unduhan',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'lp3aik_add_unduhan_meta_boxes' );

function lp3aik_unduhan_meta_box_cb( $post ) {
    wp_nonce_field( 'lp3aik_unduhan_save', 'lp3aik_unduhan_nonce' );
    $file_url = get_post_meta( $post->ID, '_unduhan_file', true );
    $file_size = get_post_meta( $post->ID, '_unduhan_size', true );
    ?>
    <div class="lp3aik-metabox-wrap">
        <table class="form-table lp3aik-meta-table">
            <tbody>
                <tr>
                    <th scope="row">
                        <label for="unduhan_file">File Unduhan <span class="required">*</span></label>
                    </th>
                    <td>
                        <div class="lp3aik-upload-group">
                            <div class="d-flex gap-2 align-items-start" style="display:flex;gap:8px;align-items:flex-start;">
                                <input type="url"
                                       id="unduhan_file"
                                       name="unduhan_file"
                                       value="<?php echo esc_attr( $file_url ); ?>"
                                       class="large-text"
                                       placeholder="https://... atau pilih dari Media Library">
                                <button type="button"
                                        class="button lp3aik-upload-button"
                                        data-target="unduhan_file"
                                        data-type="application">
                                    <span class="dashicons dashicons-upload" style="vertical-align:middle;"></span>
                                    Pilih File
                                </button>
                            </div>
                            <?php if ( $file_url ) : ?>
                            <div class="lp3aik-file-preview mt-2">
                                <a href="<?php echo esc_url( $file_url ); ?>"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="button button-small">
                                    <span class="dashicons dashicons-visibility" style="vertical-align:middle;"></span>
                                    Lihat File
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <p class="description">
                            Upload file ke <strong>Media Library</strong> lalu salin URL-nya, atau klik tombol "Pilih File" di atas.
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="unduhan_size">Ukuran File</label>
                    </th>
                    <td>
                        <input type="text"
                               id="unduhan_size"
                               name="unduhan_size"
                               value="<?php echo esc_attr( $file_size ); ?>"
                               class="regular-text"
                               placeholder="Contoh: 2.5 MB, 450 KB"
                               maxlength="20">
                        <p class="description">Isi secara manual ukuran file (opsional, ditampilkan di daftar unduhan).</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}

/**
 * Helper: Deteksi Ukuran File dari URL/Path Server Lokal
 */
function lp3aik_get_file_size_from_url( $url ) {
    if ( empty( $url ) ) return '';

    // Parse local file path from URL
    $upload_dir = wp_upload_dir();
    $base_url = $upload_dir['baseurl'];
    $base_dir = $upload_dir['basedir'];

    if ( strpos( $url, $base_url ) !== false ) {
        // File berada di server lokal (Uploads folder)
        $file_path = str_replace( $base_url, $base_dir, $url );
        if ( file_exists( $file_path ) ) {
            $bytes = filesize( $file_path );
            if ( $bytes >= 1048576 ) {
                $size = number_format( $bytes / 1048576, 2 ) . ' MB';
            } elseif ( $bytes >= 1024 ) {
                $size = number_format( $bytes / 1024, 1 ) . ' KB';
            } else {
                $size = $bytes . ' bytes';
            }
            return $size;
        }
    }
    return ''; // Return empty if external or not found
}

function lp3aik_save_unduhan_meta( $post_id ) {
    if ( ! isset( $_POST['lp3aik_unduhan_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['lp3aik_unduhan_nonce'] ) ), 'lp3aik_unduhan_save' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $file_url = '';
    if ( isset( $_POST['unduhan_file'] ) ) {
        $file_url = esc_url_raw( wp_unslash( $_POST['unduhan_file'] ) );
        update_post_meta( $post_id, '_unduhan_file', $file_url );
    }

    $custom_size = isset( $_POST['unduhan_size'] ) ? sanitize_text_field( wp_unslash( $_POST['unduhan_size'] ) ) : '';
    
    // Auto detect jika kosong dan ada file local
    if ( empty( $custom_size ) && !empty( $file_url ) ) {
        $custom_size = lp3aik_get_file_size_from_url( $file_url );
    }

    update_post_meta( $post_id, '_unduhan_size', $custom_size );
}
add_action( 'save_post_lp3aik_unduhan', 'lp3aik_save_unduhan_meta' );


/* ==========================================================================
   5. Admin Columns yang Berguna
   ========================================================================== */

// Kolom tambahan: Galeri - thumbnail + kategori
function lp3aik_galeri_columns( $cols ) {
    $new = [];
    foreach ( $cols as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['thumbnail']     = 'Foto';
            $new['kategori_galeri'] = 'Kategori';
        }
    }
    return $new;
}
add_filter( 'manage_lp3aik_galeri_posts_columns', 'lp3aik_galeri_columns' );

function lp3aik_galeri_columns_content( $col, $post_id ) {
    if ( $col === 'thumbnail' ) {
        $thumb = get_the_post_thumbnail( $post_id, [ 60, 60 ] );
        if ( $thumb ) {
            echo '<div style="width:60px;height:60px;overflow:hidden;border-radius:4px;">' . $thumb . '</div>';
        } else {
            echo '<span class="dashicons dashicons-format-image" style="color:#ccc;font-size:2rem;"></span>';
        }
    }
    if ( $col === 'kategori_galeri' ) {
        $terms = get_the_terms( $post_id, 'kategori_galeri' );
        if ( $terms && ! is_wp_error( $terms ) ) {
            $names = wp_list_pluck( $terms, 'name' );
            echo esc_html( implode( ', ', $names ) );
        } else {
            echo '<span class="text-muted">—</span>';
        }
    }
}
add_action( 'manage_lp3aik_galeri_posts_custom_column', 'lp3aik_galeri_columns_content', 10, 2 );

// Kolom tambahan: Unduhan - file status + kategori
function lp3aik_unduhan_columns( $cols ) {
    $new = [];
    foreach ( $cols as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['file_status']       = 'File';
            $new['kategori_unduhan']  = 'Kategori';
            $new['file_size_col']     = 'Ukuran';
        }
    }
    return $new;
}
add_filter( 'manage_lp3aik_unduhan_posts_columns', 'lp3aik_unduhan_columns' );

function lp3aik_unduhan_columns_content( $col, $post_id ) {
    if ( $col === 'file_status' ) {
        $url = get_post_meta( $post_id, '_unduhan_file', true );
        if ( $url ) {
            $ext = strtoupper( pathinfo( $url, PATHINFO_EXTENSION ) );
            echo '<span class="lp3aik-badge-file">' . esc_html( $ext ?: 'FILE' ) . '</span>';
            echo ' <a href="' . esc_url( $url ) . '" target="_blank" rel="noopener" title="Lihat File"><span class="dashicons dashicons-external"></span></a>';
        } else {
            echo '<span style="color:#dc2626;" title="File belum diupload"><span class="dashicons dashicons-warning"></span> Belum ada file</span>';
        }
    }
    if ( $col === 'kategori_unduhan' ) {
        $terms = get_the_terms( $post_id, 'kategori_unduhan' );
        if ( $terms && ! is_wp_error( $terms ) ) {
            echo esc_html( implode( ', ', wp_list_pluck( $terms, 'name' ) ) );
        } else {
            echo '—';
        }
    }
    if ( $col === 'file_size_col' ) {
        $size = get_post_meta( $post_id, '_unduhan_size', true );
        echo $size ? esc_html( $size ) : '—';
    }
}
add_action( 'manage_lp3aik_unduhan_posts_custom_column', 'lp3aik_unduhan_columns_content', 10, 2 );

// Kolom tambahan: Struktur Organisasi
function lp3aik_org_columns( $cols ) {
    $new = [];
    foreach ( $cols as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['org_photo']   = 'Foto';
            $new['org_jabatan'] = 'Jabatan';
            $new['org_unit']    = 'Unit/Divisi';
            $new['org_order']   = 'Urutan';
        }
    }
    return $new;
}
add_filter( 'manage_lp3aik_org_structure_posts_columns', 'lp3aik_org_columns' );

function lp3aik_org_columns_content( $col, $post_id ) {
    if ( $col === 'org_photo' ) {
        $thumb = get_the_post_thumbnail( $post_id, [ 50, 50 ] );
        echo $thumb
            ? '<div style="width:50px;height:50px;overflow:hidden;border-radius:50%;">' . $thumb . '</div>'
            : '<span class="dashicons dashicons-admin-users" style="font-size:2rem;color:#ccc;"></span>';
    }
    if ( $col === 'org_jabatan' ) {
        echo esc_html( get_post_meta( $post_id, '_org_jabatan', true ) ?: '—' );
    }
    if ( $col === 'org_unit' ) {
        echo esc_html( get_post_meta( $post_id, '_org_unit', true ) ?: '—' );
    }
    if ( $col === 'org_order' ) {
        echo esc_html( get_post_meta( $post_id, '_org_order', true ) !== '' ? get_post_meta( $post_id, '_org_order', true ) : '0' );
    }
}
add_action( 'manage_lp3aik_org_structure_posts_custom_column', 'lp3aik_org_columns_content', 10, 2 );

// Sortable kolom urutan org
function lp3aik_org_sortable_columns( $cols ) {
    $cols['org_order'] = 'org_order';
    return $cols;
}
add_filter( 'manage_edit-lp3aik_org_structure_sortable_columns', 'lp3aik_org_sortable_columns' );

// Kolom tambahan: Program - featured badge + kategori
function lp3aik_program_columns( $cols ) {
    $new = [];
    foreach ( $cols as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['program_thumb']     = 'Gambar';
            $new['program_featured']  = 'Unggulan';
            $new['kategori_program']  = 'Kategori';
        }
    }
    return $new;
}
add_filter( 'manage_lp3aik_program_posts_columns', 'lp3aik_program_columns' );

function lp3aik_program_columns_content( $col, $post_id ) {
    if ( $col === 'program_thumb' ) {
        $thumb = get_the_post_thumbnail( $post_id, [ 60, 60 ] );
        echo $thumb
            ? '<div style="width:60px;height:60px;overflow:hidden;border-radius:6px;">' . $thumb . '</div>'
            : '<span class="dashicons dashicons-welcome-learn-more" style="font-size:2rem;color:#ccc;"></span>';
    }
    if ( $col === 'program_featured' ) {
        $f = get_post_meta( $post_id, '_program_featured', true );
        echo $f === '1'
            ? '<span style="color:#d97706;" title="Program Unggulan"><span class="dashicons dashicons-star-filled"></span></span>'
            : '<span style="color:#ccc;"><span class="dashicons dashicons-star-empty"></span></span>';
    }
    if ( $col === 'kategori_program' ) {
        $terms = get_the_terms( $post_id, 'kategori_program' );
        echo ( $terms && ! is_wp_error( $terms ) )
            ? esc_html( implode( ', ', wp_list_pluck( $terms, 'name' ) ) )
            : '—';
    }
}
add_action( 'manage_lp3aik_program_posts_custom_column', 'lp3aik_program_columns_content', 10, 2 );