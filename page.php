<?php
/**
 * Default Page Template
 *
 * @package WordPress
 * @since V0.1
 *
 */
get_header();
if (have_rows('page_layout')) {
    while (have_rows('page_layout')) {
        the_row();
        get_template_part('template-parts/page_layout');
    }
}
get_footer();