<?php
/**
 *  ACF Setup
 *
 * @package WordPress
 * @since V0.1
 *
 */

/**
 * Options page
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => __('Theme options', 'greenfair'),
        'capability' => 'edit_posts',
        'position'   => '15.54',
        'post_id'    => 'options',
        'icon_url'   => 'dashicons-schedule',
        'redirect'   => false
    ));
}