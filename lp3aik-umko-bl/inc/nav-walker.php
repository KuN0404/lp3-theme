<?php
class LP3AIK_Nav_Walker extends Walker_Nav_Menu {

    private static $icon_map = [
        'beranda'            => 'bi-house',
        'berita'             => 'bi-newspaper',
        'program'            => 'bi-book',
        'galeri'             => 'bi-images',
        'unduhan'            => 'bi-download',
        'faq'                => 'bi-question-circle',
        'kontak'             => 'bi-envelope',
        'hubungi'            => 'bi-telephone',
        'tentang'            => 'bi-building',
        'deskripsi'          => 'bi-info-circle',
        'visi'               => 'bi-eye',
        'misi'               => 'bi-bullseye',
        'struktur'           => 'bi-diagram-3',
        'organisasi'         => 'bi-people',
        'profil'             => 'bi-person-badge',
        'sejarah'            => 'bi-clock-history',
    ];

    private static function get_icon($title) {
        $slug = sanitize_title($title);
        $lower = strtolower($title);
        foreach (self::$icon_map as $key => $icon) {
            if (strpos($slug, $key) !== false || strpos($lower, $key) !== false) {
                return $icon;
            }
        }
        return 'bi-chevron-right';
    }

    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $class = ($depth === 0) ? 'dropdown-menu shadow border-0' : 'sub-menu';
        $output .= "\n$indent<ul class=\"$class\" style=\"border-radius:var(--border-radius-md);\">\n";
    }

    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        $indent = str_repeat("\t", $depth);
        $classes = empty($data_object->classes) ? [] : (array) $data_object->classes;
        $has_children = in_array('menu-item-has-children', $classes);
        $is_current = in_array('current-menu-item', $classes) || in_array('current_page_item', $classes);

        if ($depth === 0) {
            $classes[] = 'nav-item';
            if ($has_children) {
                $classes[] = 'dropdown';
            }
        }

        $class_names = join(' ', array_filter($classes));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $output .= $indent . '<li' . $class_names . '>';

        $atts = [];
        $atts['title']  = !empty($data_object->attr_title) ? $data_object->attr_title : '';
        $atts['target'] = !empty($data_object->target) ? $data_object->target : '';
        $atts['rel']    = !empty($data_object->xfn) ? $data_object->xfn : '';
        $atts['href']   = !empty($data_object->url) ? $data_object->url : '';

        $link_class = ($depth === 0) ? 'nav-link' : 'dropdown-item py-2';
        if ($depth === 0 && $has_children) {
            $link_class .= ' dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
        }
        if ($is_current && $depth === 0) {
            $link_class .= ' active';
        }
        $atts['class'] = $link_class;

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value) || $attr === 'href') {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $data_object->title, $data_object->ID);
        $icon = self::get_icon($title);

        $output .= '<a' . $attributes . '>';
        if ($depth === 0) {
            $output .= '<i class="bi ' . esc_attr($icon) . ' me-1"></i>';
        } else {
            $output .= '<i class="bi ' . esc_attr($icon) . ' me-2"></i>';
        }
        $output .= esc_html($title) . '</a>';
    }
}
