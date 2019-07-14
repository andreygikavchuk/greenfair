<?php
$text = get_sub_field('text');
$displayType = get_sub_field('display_type');
$postsNumber = (get_sub_field('posts_number') ? get_sub_field('posts_number') : 3);

if ($displayType == 'custom') {
    $events = get_sub_field('events');
} else {
    $my_posts = new WP_Query;
    $events = $my_posts->query(array(
        'post_type' => 'event',
        'showposts' => $postsNumber,

    ));
}
if (get_sub_field('display_type')) {
    if (!empty($events)) {
        $left_events = array_slice($events, 0, 2);
        $right_events = array_slice($events, 2, count($events) - 2);
        ?>

        <!--start of event-->
        <section id="event">
            <div class="container">
                <?php echo ($text) ? sprintf('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="event_header text-center">%s</div></div></div>', $text) : ''; ?>
                <!--End of row-->
                <div class="row">
                    <div class="col-md-8">
                        <?php if ($left_events[0]) {
                            $link = get_permalink($left_events[0]->ID);
                            $date = get_field('date', $left_events[0]->ID);
                            $text = wp_trim_words($left_events[0]->post_content, 30);
                            ?>
                            <div class="row">

                                <?php
                                if (has_post_thumbnail($left_events[0]->ID)) { ?>
                                    <div class="col-md-6 zero_mp">
                                        <div class="event_item">
                                            <div class="event_img">
                                                <?php echo wp_get_attachment_image(get_post_thumbnail_id($left_events[0]->ID), 'medium');  ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                                <div class="col-md-6 zero_mp">
                                    <div class="event_item">
                                        <div class="event_text text-center">
                                            <a href="<?php echo $link ?>"><h4><?php echo $left_events[0]->post_title ?></h4></a>
                                            <?php echo ($date) ? sprintf('<h6>%s</h6>', $date) : ''; ?>
                                            <?php echo ($text) ? sprintf('<p>%s</p>', $text) : ''; ?>
                                            <a href="<?php echo $link ?>" class="event_btn"><?php _e('read more', 'greenfair') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($left_events[1]) {
                            $link = get_permalink($left_events[1]->ID);
                            $date = get_field('date', $left_events[1]->ID);
                            $text = wp_trim_words($left_events[1]->post_content, 25);
                            ?>
                            <div class="row">
                                <div class="col-md-6 zero_mp">
                                    <div class="event_item">
                                        <div class="event_text text-center">
                                            <a href="<?php echo $link ?>"><h4><?php echo $left_events[1]->post_title ?></h4></a>
                                            <?php echo ($date) ? sprintf('<h6>%s</h6>', $date) : ''; ?>
                                            <?php echo ($text) ? sprintf('<p>%s</p>', $text) : ''; ?>
                                            <a href="<?php echo $link ?>" class="event_btn"><?php _e('read more', 'greenfair') ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (has_post_thumbnail($left_events[1]->ID)) { ?>
                                    <div class="col-md-6 zero_mp">
                                        <div class="event_item">
                                            <div class="event_img">
                                                <?php echo wp_get_attachment_image(get_post_thumbnail_id($left_events[1]->ID), 'medium');  ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if (!empty($right_events)) { ?>
                        <div class="col-md-4">
                            <?php foreach ($right_events as $index => $right_event) {
                                $link = get_permalink($right_event->ID);
                                $text = wp_trim_words($right_event->post_content, 10);
                                ?>
                                <div class="event_news">
                                    <div class="event_single_item fix">
                                        <?php
                                        if (has_post_thumbnail($right_event->ID)) { ?>
                                            <div class="event_news_img floatleft">
                                                <?php echo wp_get_attachment_image(get_post_thumbnail_id($right_event->ID), 'medium');  ?>
                                            </div>
                                        <?php }
                                        ?>
                                        <div class="event_news_text">
                                            <a href="<?php echo $link ?>"><h4><?php echo $right_event->post_title ?></h4></a>
                                            <?php echo ($text) ? sprintf('<p>%s</p>', $text) : ''; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <!--End of col-md-4-->
                </div>
                <!--End of row-->
            </div>
            <!--End of container-->
        </section>
        <!--end of event-->

    <?php }
    ?>

<?php } ?>