# Product Requirements Document (PRD)
## WordPress Theme — LP3AIK Universitas Muhammadiyah Kotabumi

| Atribut | Detail |
|---|---|
| Versi Dokumen | 1.0 |
| Tanggal | 08 Mei 2026 |
| Klien / Unit | LP3AIK – Universitas Muhammadiyah Kotabumi |
| Status | Draft |

---

## 1. Latar Belakang & Konteks Organisasi

### 1.1 Tentang LP3AIK

**LP3AIK** adalah singkatan dari **Lembaga Pembinaan dan Pengembangan Pendidikan Al-Islam dan Kemuhammadiyahan**. Di lingkungan Universitas Muhammadiyah, lembaga ini merupakan satuan kerja yang bertanggung jawab atas:

- Pembinaan, pengembangan, dan pengkajian nilai-nilai **Al-Islam** di seluruh civitas akademika.
- Pengembangan dan internalisasi nilai-nilai **Kemuhammadiyahan** (ideologi, sejarah, dan gerakan Muhammadiyah).
- Koordinasi mata kuliah wajib AIK (Al-Islam & Kemuhammadiyahan) di semua program studi.
- Pelatihan, seminar, dan kegiatan keagamaan kampus.
- Penjaminan mutu nilai-nilai islami dalam tata kelola dan budaya kampus.

> **Catatan Nama:** Beberapa universitas Muhammadiyah menyebut lembaga ini sebagai **LP3I** (Lembaga Pembina dan Pengembang Pendidikan Islam) atau **LPIK**, namun fungsinya identik. Dokumen ini menggunakan nama resmi **LP3AIK** dan dapat disesuaikan dengan nama resmi di UM Kotabumi.

### 1.2 Nuansa Desain

Tema menggabungkan dua identitas:
1. **Kemuhammadiyahan** — Palet biru tua `#003C71` dan aksen emas/maroon, ornamen geometris islami, tipografi formal dan bermartabat.
2. **Akademis** — Tata letak bersih, whitespace memadai, hierarki konten jelas, kesan profesional dan terpercaya.

---

## 2. Tujuan Produk

1. Menyediakan website resmi LP3AIK UM Kotabumi yang representatif, informatif, dan mudah dikelola.
2. Membangun kepercayaan civitas akademika dan masyarakat melalui tampilan profesional bernuansa islami-akademis.
3. Memudahkan admin non-teknis mengelola konten melalui panel WordPress yang ramah pengguna.
4. Memastikan keamanan, performa, dan SEO yang baik sesuai standar WordPress modern.

---

## 3. Halaman & Template

### 3.1 Daftar Halaman

| No | Halaman | Template File | Keterangan |
|----|---------|---------------|------------|
| 1 | Beranda | `front-page.php` | Hero with carousel image, statistik, program unggulan, berita, galeri, CTA |
| 2 | Deskripsi Singkat | `page-deskripsi.php` | Profil & sejarah LP3AIK |
| 3 | Visi dan Misi | `page-visi-misi.php` | Visi, Misi, Tujuan lembaga |
| 4 | Struktur Organisasi | `page-struktur-organisasi.php` | Diagram + kartu anggota dari CPT |
| 5 | Program | `archive-lp3aik_program.php` | Grid program dengan filter kategori |
| 6 | Postingan/Berita | `home.php` / `archive.php` | Blog/berita standar WordPress |
| 7 | Galeri | `page-galeri.php` | Grid dengan filter kategori + lightbox |
| 8 | Unduhan | `page-unduhan.php` | Daftar file dengan filter kategori |
| 9 | FAQ | `page-faq.php` | Accordion Bootstrap 5 |
| 10 | Kontak (CTA) | `page-kontak.php` | Form kontak + peta + info kontak |

### 3.2 Detail Halaman Beranda

Seksi-seksi beranda dari atas ke bawah:
1. **Hero Section** — Headline, sub-headline, tagline islami, tombol CTA ganda.
2. **Tentang Kami Singkat** — Paragraf singkat + tombol "Selengkapnya".
3. **Statistik** — Counter animasi: jumlah mahasiswa, program, tahun berdiri, dll.
4. **Program Unggulan** — Grid 3 kolom (responsive) dari CPT Program yang ditandai featured.
5. **Berita Terbaru** — 3 postingan terbaru dengan gambar, tanggal, kategori, cuplikan.
6. **Galeri Terbaru** — 6 foto terbaru dengan overlay kategori.
7. **CTA Banner** — Banner ajakan dengan tombol menuju halaman kontak.

---

## 4. Custom Post Types (CPT) & Taxonomies

### 4.1 CPT: Struktur Organisasi

```
Post Type Slug  : lp3aik_org_structure
Publicly Queryable : false
Supports        : title, thumbnail (featured image = foto)
```

**Custom Fields (Meta Box):**

| Field | Key | Tipe | Keterangan |
|---|---|---|---|
| Jabatan | `_org_jabatan` | text | Contoh: Ketua, Sekretaris |
| Unit/Divisi | `_org_unit` | text | Contoh: Divisi Pengkajian |
| NIP/NIDN | `_org_nip` | text | Nomor Induk Pegawai/Dosen |
| Urutan Tampil | `_org_order` | number | Angka kecil tampil lebih dulu |

### 4.2 CPT: Program

```
Post Type Slug  : lp3aik_program
Rewrite         : ['slug' => 'program']
Supports        : title, editor, thumbnail, excerpt
```

**Custom Fields:**

| Field | Key | Tipe | Keterangan |
|---|---|---|---|
| Durasi Program | `_program_durasi` | text | Contoh: 16 Pertemuan/Semester |
| Target Peserta | `_program_target` | text | Contoh: Mahasiswa Baru |
| Ikon | `_program_icon` | text | Bootstrap Icons class, mis. `bi-book` |
| Program Unggulan | `_program_featured` | checkbox | Tampilkan di beranda |

**Taxonomy: Kategori Program**
```
Slug: kategori_program | Hierarchical: true
```

### 4.3 CPT: Galeri

```
Post Type Slug  : lp3aik_galeri
Publicly Queryable : false
Supports        : title, thumbnail
```

**Custom Fields:**

| Field | Key | Tipe |
|---|---|---|
| Deskripsi | `_galeri_deskripsi` | textarea |
| Tanggal Acara | `_galeri_tanggal` | date |

**Taxonomy: Kategori Galeri**
```
Slug: kategori_galeri | Hierarchical: true
```

### 4.4 CPT: Unduhan

```
Post Type Slug  : lp3aik_unduhan
Publicly Queryable : false
Supports        : title, excerpt
```

**Custom Fields:**

| Field | Key | Tipe | Keterangan |
|---|---|---|---|
| File Unduhan | `_unduhan_file` | file/media | Upload via Media Library |
| Tanggal Terbit | `_unduhan_tanggal` | date | |
| Ukuran File | `_unduhan_size` | text | Otomatis atau manual (mis. 2 MB) |

**Taxonomy: Kategori Unduhan**
```
Slug: kategori_unduhan | Hierarchical: true
```

### 4.5 Post Standar WordPress (Berita)

Menggunakan Post bawaan WordPress dengan taxonomy bawaan:
- **Kategori Post** (`category`) — Taxonomy hierarkis.
- **Tags Post** (`post_tag`) — Taxonomy datar.

---

## 5. Struktur File Tema

```
lp3aik-theme/
├── style.css
├── functions.php
├── index.php
├── front-page.php
├── page.php
├── archive.php
├── archive-lp3aik_program.php
├── single.php
├── single-lp3aik_program.php
├── header.php
├── footer.php
├── sidebar.php
├── 404.php
├── search.php
│
├── pages/
│   ├── page-deskripsi.php
│   ├── page-visi-misi.php
│   ├── page-struktur-organisasi.php
│   ├── page-galeri.php
│   ├── page-unduhan.php
│   ├── page-faq.php
│   ├── page-kontak.php
|
├── inc/
│   ├── setup.php
│   ├── enqueue.php
│   ├── cpt-org-structure.php
│   ├── cpt-program.php
│   ├── cpt-galeri.php
│   ├── cpt-unduhan.php
│   ├── meta-boxes.php
│   ├── security.php
│   ├── helpers.php
│   └── customizer.php
│
├── admin/
│   └── settings-page.php
│
├── template-parts/
│   ├── content.php
│   ├── content-program.php
│   ├── content-galeri.php
│   ├── content-unduhan.php
│   ├── content-org.php
│   ├── hero.php
│   ├── cta-banner.php
│   └── breadcrumb.php
│
└── assets/
    ├── css/
    │   ├── main.css
    │   └── admin.css
    ├── js/
    │   ├── main.js
    │   └── admin.js
    └── images/
        ├── logo.png
        └── logo-white.png
```

---

## 6. CSS Variables — Sistem Penamaan

> **Aturan:** Gunakan nama **general/semantik**, bukan nama warna spesifik.
> Benar: `--color-primary` | Salah: `--blue-muhammadiyah` atau `--green-primary`

```css
:root {
    /* === COLOR SYSTEM === */
    --color-primary:        #003C71;   /* Biru Muhammadiyah */
    --color-secondary:      #8B1A1A;   /* Maroon islami */
    --color-accent:         #C8A951;   /* Emas/aksen */
    --color-background:     #FFFFFF;
    --color-surface:        #F5F5F5;
    --color-surface-alt:    #EEF2F7;
    --color-text:           #1A1A1A;
    --color-text-muted:     #6B7280;
    --color-text-inverse:   #FFFFFF;
    --color-border:         #D1D5DB;
    --color-success:        #16A34A;
    --color-warning:        #D97706;
    --color-danger:         #DC2626;
    --color-info:           #0284C7;

    /* === TYPOGRAPHY === */
    --font-primary:         'Lato', 'Segoe UI', sans-serif;
    --font-heading:         'Merriweather', 'Georgia', serif;
    --font-arabic:          'Amiri', 'Traditional Arabic', serif;
    --font-size-base:       1rem;
    --font-size-sm:         0.875rem;
    --font-size-lg:         1.125rem;
    --font-size-xl:         1.25rem;
    --font-size-2xl:        1.5rem;
    --font-size-3xl:        1.875rem;
    --font-size-4xl:        2.25rem;
    --line-height-base:     1.6;
    --line-height-heading:  1.3;
    --font-weight-normal:   400;
    --font-weight-medium:   500;
    --font-weight-bold:     700;

    /* === SPACING === */
    --spacing-xs:           0.25rem;
    --spacing-sm:           0.5rem;
    --spacing-md:           1rem;
    --spacing-lg:           1.5rem;
    --spacing-xl:           2rem;
    --spacing-2xl:          3rem;
    --spacing-3xl:          4rem;
    --spacing-section:      5rem;

    /* === BORDER === */
    --border-radius-sm:     4px;
    --border-radius-md:     8px;
    --border-radius-lg:     12px;
    --border-radius-xl:     20px;
    --border-radius-full:   9999px;
    --border-width:         1px;

    /* === SHADOWS === */
    --shadow-sm:            0 1px 3px rgba(0,0,0,0.08);
    --shadow-md:            0 4px 12px rgba(0,0,0,0.10);
    --shadow-lg:            0 8px 24px rgba(0,0,0,0.12);
    --shadow-card:          0 2px 8px rgba(0, 60, 113, 0.10);

    /* === TRANSITIONS === */
    --transition-fast:      150ms ease;
    --transition-base:      250ms ease;
    --transition-slow:      400ms ease;

    /* === LAYOUT === */
    --container-max:        1200px;
    --header-height:        70px;
    --sidebar-width:        300px;

    /* === Z-INDEX === */
    --z-dropdown:           1000;
    --z-sticky:             1020;
    --z-overlay:            1040;
    --z-modal:              1060;
    --z-toast:              1080;
}
```

---

## 7. Enqueue Bootstrap 5 via CDN

```php
// inc/enqueue.php
function lp3aik_enqueue_assets() {
    // Bootstrap 5 CSS via CDN
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        [], '5.3.3'
    );

    // Bootstrap Icons
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        [], '1.11.3'
    );

    // Main Theme CSS (setelah Bootstrap)
    wp_enqueue_style(
        'lp3aik-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['bootstrap'], '1.0.0'
    );

    // Bootstrap 5 JS Bundle via CDN
    wp_enqueue_script(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [], '5.3.3', true
    );

    // Main Theme JS
    wp_enqueue_script(
        'lp3aik-main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['bootstrap'], '1.0.0', true
    );

    // Localize untuk AJAX
    wp_localize_script('lp3aik-main', 'lp3aikAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('lp3aik_nonce'),
    ]);
}
add_action('wp_enqueue_scripts', 'lp3aik_enqueue_assets');
```

---

## 8. Sistem Keamanan WordPress

### 8.1 Fungsi Keamanan di `inc/security.php`

```php
// 1. Sembunyikan versi WordPress
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// 2. Nonaktifkan XML-RPC
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// 3. Hapus informasi sensitif dari header
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

// 4. Nonaktifkan author enumeration
add_action('template_redirect', function() {
    if (is_author()) { wp_redirect(home_url()); exit; }
});

// 5. Batasi jenis file upload
add_filter('upload_mimes', function($mimes) {
    // Hanya izinkan tipe file yang diperlukan
    return array_intersect_key($mimes, array_flip([
        'jpg|jpeg', 'png', 'gif', 'webp', 'pdf', 'docx', 'xlsx'
    ]));
});
```

### 8.2 Di `wp-config.php` (Tambahkan Secara Manual)

```php
define('DISALLOW_FILE_EDIT', true);   // Nonaktifkan editor file
define('DISALLOW_FILE_MODS', false);  // Masih boleh install plugin/tema
define('WP_DEBUG', false);            // WAJIB false di production
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
```

### 8.3 Tambahan `.htaccess`

```apache
# Lindungi wp-config.php
<files wp-config.php>
  order allow,deny
  deny from all
</files>

# Blok PHP di folder uploads
<Directory /wp-content/uploads>
  <Files *.php>
    deny from all
  </Files>
</Directory>

# Nonaktifkan directory listing
Options -Indexes

# Proteksi .htaccess
<files .htaccess>
  order allow,deny
  deny from all
</files>
```

### 8.4 Aturan Keamanan Form & Kode

- **Nonce wajib** di setiap form admin dan public: `wp_nonce_field()` + `wp_verify_nonce()`.
- **Sanitasi input** wajib: `sanitize_text_field()`, `absint()`, `wp_kses_post()`, `sanitize_email()`.
- **Escape output** wajib: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`.
- **Capability check** di setiap handler: `if (!current_user_can('manage_options')) { wp_die(); }`.
- **Prepared statements** untuk query DB: `$wpdb->prepare()`.
- **Honeypot field** pada form kontak publik.
- **Prefix** semua fungsi, hook, global: `lp3aik_`.

### 8.5 Rekomendasi Plugin Keamanan

| Plugin | Fungsi |
|---|---|
| Wordfence Security | Firewall, malware scan, login protection |
| WPS Hide Login | Ubah URL login dari `/wp-admin` |
| Limit Login Attempts Reloaded | Blok brute force login |
| UpdraftPlus | Backup otomatis terjadwal |

---

## 9. Konfigurasi Permalink

Pengaturan: **`%postname%`** (Settings → Permalinks)

```php
// Flush rewrite rules otomatis saat aktivasi tema
register_activation_hook(__FILE__, function() {
    lp3aik_register_all_cpt();  // Daftarkan CPT dulu
    flush_rewrite_rules();       // Baru flush
});

// Flush juga saat deaktivasi
register_deactivation_hook(__FILE__, function() {
    flush_rewrite_rules();
});
```

**Slug CPT yang Terdampak:**
- Program: `yourdomain.com/program/nama-program/`
- Single post: `yourdomain.com/nama-berita/`

---

## 10. Admin Panel — Halaman Pengaturan Tema

Lokasi: **Appearance → Pengaturan LP3AIK**

| Pengaturan | Tipe | Keterangan |
|---|---|---|
| Logo Utama | Image Upload | Logo untuk header |
| Logo Putih | Image Upload | Logo untuk background gelap |
| Tagline/Slogan | Text | Tampil di hero/footer |
| Nomor Telepon | Text | Header & halaman kontak |
| Email | Email | Header & halaman kontak |
| Alamat | Textarea | Alamat lengkap |
| Google Maps Embed URL | Textarea | URL embed iframe peta |
| Link Instagram | URL | |
| Link Facebook | URL | |
| Link YouTube | URL | |
| Link WhatsApp | URL | Format: `https://wa.me/628xxx` |
| Teks Footer | Textarea | Copyright & disclaimer |
| Google Analytics ID | Text | Opsional untuk tracking |

---

## 11. Navigasi & Sidebar

### 11.1 Registrasi Menu

```php
register_nav_menus([
    'primary' => 'Menu Utama',
    'footer'  => 'Menu Footer',
    'topbar'  => 'Menu Topbar (Opsional)',
]);
```

**Struktur Menu Utama yang Disarankan:**
```
Beranda
Tentang LP3AIK
  ├── Deskripsi Singkat
  ├── Visi dan Misi
  └── Struktur Organisasi
Program
Berita
Galeri
Unduhan
FAQ
Kontak
```

### 11.2 Registrasi Sidebar

```php
register_sidebar(['id' => 'sidebar-berita',  'name' => 'Sidebar Berita']);
register_sidebar(['id' => 'footer-col-1',    'name' => 'Footer Kolom 1']);
register_sidebar(['id' => 'footer-col-2',    'name' => 'Footer Kolom 2']);
register_sidebar(['id' => 'footer-col-3',    'name' => 'Footer Kolom 3']);
```

---

## 12. Responsivitas (Breakpoint Bootstrap 5)

Utamakan Mobile View > Tablet View > Desktop View

| Breakpoint | Lebar | Perilaku Layout |
|---|---|---|
| xs | < 576px | 1 kolom, hamburger menu, hero compact |
| sm | ≥ 576px | 2 kolom konten, awal grid galeri |
| md | ≥ 768px | Navigasi penuh, sidebar muncul |
| lg | ≥ 992px | 3 kolom program/galeri, layout final |
| xl | ≥ 1200px | Container penuh, layout ideal |
| xxl | ≥ 1400px | Padding lebih lega |

---

## 13. Standar Koding

- Mengikuti **WordPress Coding Standards (WPCS)**.
- Semua fungsi, hook, variabel global diawali prefix: `lp3aik_`.
- Komentar kode konsisten (Bahasa Indonesia atau Inggris).
- Hindari query langsung DB; gunakan `WP_Query` dan `$wpdb->prepare()`.
- Tidak ada `var_dump()`, `print_r()`, atau `die()` di production.

---

## 14. Checklist Deployment

- [ ] Tes di localhost (XAMPP / Local by Flywheel)
- [ ] Validasi HTML W3C
- [ ] Uji responsivitas semua device via Chrome DevTools
- [ ] Uji semua form (keamanan & fungsi)
- [ ] Verifikasi semua CPT & taxonomy terdaftar
- [ ] Flush permalink setelah aktivasi
- [ ] Skor Lighthouse: Performance > 85, Accessibility > 90
- [ ] Pasang plugin keamanan (Wordfence, WPS Hide Login)
- [ ] Setup backup otomatis (UpdraftPlus)
- [ ] Set `WP_DEBUG = false` di production
- [ ] Buat halaman dengan slug sesuai tabel §3.1
- [ ] Set halaman beranda statis di Settings → Reading
- [ ] Isi semua pengaturan di Appearance → Pengaturan LP3AIK
- [ ] Buat & assign menu di Appearance → Menus

---

## 15. Timeline Pengembangan (Estimasi)

| Fase | Aktivitas | Estimasi |
|---|---|---|
| 1 | Setup tema, CPT, Taxonomy, Keamanan dasar | 3 hari |
| 2 | CSS variabel, header, footer, layout global | 2 hari |
| 3 | Template: Beranda, Deskripsi, Visi-Misi | 3 hari |
| 4 | Template: Struktur Org, Program, Galeri | 3 hari |
| 5 | Template: Unduhan, FAQ, Kontak | 2 hari |
| 6 | Admin panel, meta boxes, halaman pengaturan | 3 hari |
| 7 | Responsivitas, aksesibilitas, optimasi performa | 2 hari |
| 8 | Testing menyeluruh, bug fix, dokumentasi | 2 hari |
| **Total** | | **~20 hari kerja** |

---

*LP3AIK – Universitas Muhammadiyah Kotabumi*
*"Membangun Generasi Islami yang Akademis dan Berakhlak Mulia"*