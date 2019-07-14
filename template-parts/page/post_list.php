<?php
$text = get_sub_field('text');
$displayType = get_sub_field('display_type');
$postsNumber = (get_sub_field('posts_number') ? get_sub_field('posts_number') : 3);

if ($displayType == 'custom') {
    $posts = get_sub_field('posts');
} else {
    $my_posts = new WP_Query;
    $posts = $my_posts->query(array(
        'post_type' => 'post',
        'showposts' => $postsNumber,

    ));
}
if (get_sub_field('display_type')) {
    ?>
    <!--Start of blog-->
    <section id="blog">
        <div class="container">
            <?php echo ($text) ? sprintf('<div class="row"><div class="col-md-12"><div class="latest_blog text-center">%s</div></div></div>', $text) : ''; ?>
            <div class="row">
                <?php
                foreach ($posts as $index => $item) {
                    setup_postdata($item);
                    $link = get_permalink($item->ID);
                    $excerpt = get_the_excerpt($item->ID);
                    $commentsCount = get_comments_number($item->ID);
                    $author = get_the_author_meta('user_nicename');
                    $date = get_the_date('F j, Y', $item);
                    $authorUrl = get_author_posts_url($item->post_author, $author);
                    ?>
                    <div class="col-md-4">
                        <div class="blog_news">
                            <div class="single_blog_item">
                                <?php
                                if (has_post_thumbnail($item->ID)) { ?>
                                    <div class="blog_img">
                                        <?php echo get_the_post_thumbnail($item->ID, 'medium'); ?>
                                    </div>
                                <?php }
                                ?>
                                <div class="blog_content">
                                    <a href="<?php echo $link ?>"><h3><?php echo $item->post_title ?></h3></a>
                                    <div class="expert">
                                        <div class="left-side text-left">
                                            <p class="left_side">
                                                <span class="clock"><i class="fa fa-clock-o"></i></span>
                                                <span class="time"><?php echo $date ?></span>
                                                <?php echo ($author) ? sprintf('<a href="%1$s"><span class="admin"><i class="fa fa-user"></i> %2$s</span></a>', $authorUrl, $author) : ''; ?>
                                            </p>
                                            <p class="right_side text-right">
                                                <a href="#"><span class="right_msg text-right"><i class="fa fa-comments-o"></i></span>
                                                    <span class="count"><?php echo $commentsCount ?></span></a>
                                            </p>
                                        </div>
                                    </div>
                                    <?php echo ($excerpt) ? sprintf('<p class="blog_news_content">%s</p>', $excerpt) : ''; ?>
                                    <a href="<?php echo $link ?>" class="blog_link"><?php _e('read more', 'greenfair') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
            <!--End of row-->
        </div>
        <!--End of container-->
    </section>
    <!-- end of blog-->


<?php } ?>



