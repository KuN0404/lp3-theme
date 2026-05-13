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
        <?php 
        $quote_arabic = lp3aik_opt('lp3aik_quote_arabic', 'وَتَعَاوَنُوْا عَلَى الْبِرِّ وَالتَّقْوٰى');
        $quote_trans  = lp3aik_opt('lp3aik_quote_translation', '"Dan tolong-menolonglah kamu dalam (mengerjakan) kebajikan dan takwa"');
        $quote_source = lp3aik_opt('lp3aik_quote_source', 'QS. Al-Ma\'idah: 2');
        ?>
        <p class="arabic-text"><?php echo esc_html($quote_arabic); ?></p>
        <p class="translation"><?php echo wp_kses_post($quote_trans); ?></p>
        <p class="source"><?php echo esc_html($quote_source); ?></p>
    </div>
</section>