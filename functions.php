<?php
/**
 * functions.php
 * @package WordPress
 * @since V0.1
 */

if (!function_exists('greenfair_theme_inc')) {
    function greenfair_theme_inc()
    {
        $template_dir = get_template_directory();
        require_once($template_dir . '/inc/init.php'); // Theme initialization and cleanup
        require_once($template_dir . '/inc/scripts.php'); // Register and enqueue scripts
        require_once($template_dir . '/inc/menus.php'); // Navigation menus
        require_once($template_dir . '/inc/cpt.php'); // CPT
        require_once($template_dir . '/inc/acf-setup.php'); // Setup for ACF plugin
    }

    add_action('after_setup_theme', 'greenfair_theme_inc');
}