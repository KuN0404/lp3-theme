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
