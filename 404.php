<?php
/**
 * 404 Page Template
 *
 * @package WordPress
 * @since V0.1
 *
 */
get_header();
?>
<section role="main" class="container">
    <div class="error404">
        <h1 class="error404__title"><?php esc_attr_e('Page not found', 'greenfair'); ?></h1>
        <p class="error404__desc"><?php esc_attr_e('Unfortunately the requested page was not found. Please use the navigation or the search function.', 'greenfair'); ?></p>
    </div>
</section>
<?php
get_footer();
?>
