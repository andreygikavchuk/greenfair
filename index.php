<?php
/**
 * Index Template
 *
 * @package WordPress
 * @since V0.1
 *
 */
get_header();
?>
<div class="box">
    <section role="main" id="content" class=" container section">
        <?php if (!is_front_page() && is_home()) : // Show only if index but not front page ?>
            <header>
                <h1 class="centerText" itemprop="headline"><?php echo get_the_title(get_option('page_for_posts')); ?></h1>
            </header>
        <?php endif; ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class() ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                <?php if (has_post_thumbnail()) : ?>
                <section itemprop="articleBody">
                    <?php else : ?>
                    <section class="full" itemprop="articleBody">
                        <?php endif;
                        the_title(sprintf('<h3><a class="post__titleLink" href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                        get_the_post_thumbnail("medium");
                        echo '<div class="excerpt"><p>' . get_the_excerpt() . '</p></div>';
                        printf('<p class="posted">%1$s <span class="author vcard"><a href="%2$s">%3$s</a></span></span> in %4$s</p>',
                            esc_attr__('By', 'greenfair'),
                            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                            get_the_author(),
                            get_the_category_list(', '));
                        echo '<p>' . get_the_date() . '</p>';
                        ?>
                    </section>
                    <div class="clear"></div>
                    <div class="line"></div>
            </article>
        <?php endwhile;
        endif;
       ?>
        <div class="centerText">
            <?php
            // Previous/next page navigation.
            the_posts_pagination(array(
                'prev_next' => false,
                'before_page_number' => '<span class="screen-reader-text">' . __('Page', 'greenfair') . ' </span>',
            )); ?>
        </div>
    </section>
    <div class="clear"></div>
</div>
<?php
get_footer();
?>
