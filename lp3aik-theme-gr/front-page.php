<?php
/**
 * Front Page Template
 *
 * @package lp3aik-umk
 */

get_header();
get_template_part('template-parts/sections/section', 'hero');
get_template_part('template-parts/sections/section', 'about');
get_template_part('template-parts/sections/section', 'programs');
get_template_part('template-parts/sections/section', 'stats');
get_template_part('template-parts/sections/section', 'gallery');
get_template_part('template-parts/sections/section', 'news');
get_template_part('template-parts/components/lightbox');
get_footer();
