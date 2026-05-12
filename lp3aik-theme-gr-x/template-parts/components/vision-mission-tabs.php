<?php
/**
 * Component: Vision & Mission Tabs
 *
 * @package lp3aik-umk
 */

defined('ABSPATH') || exit;
?>

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
