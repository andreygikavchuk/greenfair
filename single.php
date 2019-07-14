<?php
/**
 * Single Post Template
 *
 * @package WordPress
 * @since V0.1
 *
 */
get_header();
?>
<div class="box">
    <section role="main" class="content section">
        <div class="container">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('full');
            };
            while (have_posts()) : the_post();
                // Include the post-format specific template. If you want to use this in a child theme, then include a file called called content-___.php (where ___ is the post format) and that will be used instead.
                get_template_part('content', get_post_format());
            endwhile;

            echo('<footer>');
            the_tags();
            edit_post_link(__('Edit Post', 'greenfair'), '<p class="edit-link">', '</p>');

            // Previous/next navigation
            the_post_navigation(array(
                'next_text'          => '<span aria-hidden="true">&lsaquo;</span> %title',
                'prev_text'          => '%title <span aria-hidden="true">&rsaquo;</span>',
                'screen_reader_text' => __("Post Navigation", "greenfair"),
            ));

            // Load comment template If comments are open or we have at least one comment, load comment template
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            echo('</footer>'); ?>
        </div>
    </section>
</div>
<?php
if (have_rows('page_layout')) {
    while (have_rows('page_layout')) {
        the_row();
        get_template_part('template-parts/page_layout');
    }
}
get_footer(); ?>
