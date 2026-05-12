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
