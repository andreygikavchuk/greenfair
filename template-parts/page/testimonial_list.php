<?php
$text = get_sub_field('text');
$displayType = get_sub_field('display_type');
$postsNumber = (get_sub_field('posts_number') ? get_sub_field('posts_number') : 3);

if ($displayType == 'custom') {
    $testimonials = get_sub_field('testimonials');
} else {
    $my_posts = new WP_Query;
    $testimonials = $my_posts->query(array(
        'post_type' => 'testimonial',
        'showposts' => $postsNumber,

    ));
}

if (get_sub_field('display_type')) {
    if (!empty($testimonials)) {
        $testimonialsChunk = array_chunk($testimonials, 2);
        ?>
        <!--Start of testimonial-->
        <section id="testimonial">
            <div class="testimonial_overlay">
                <div class="container">
                    <?php echo ($text) ? sprintf('<div class="row"><div class="col-md-12"><div class="testimonial_header text-center">%s</div></div></div>', $text) : ''; ?>
                    <!--End of row-->
                    <section id="carousel">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                                        <!-- Carousel indicators -->

                                        <ol class="carousel-indicators">
                                            <?php
                                            foreach ($testimonialsChunk as $index => $testimonials) {
                                                $class = ($index == 0 ? 'active' : '');
                                                ?>
                                                <li data-target="#fade-quote-carousel" data-slide-to="<?php echo $index ?>" class="<?php echo $class ?>"></li>
                                                <?php
                                            }
                                            ?>
                                        </ol>
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <?php
                                            foreach ($testimonialsChunk as $index => $testimonials) {
                                                $class = ($index == 0 ? 'active item' : 'item');
                                                ?>
                                                <div class="<?php echo $class ?>">
                                                    <div class="row">
                                                        <?php
                                                        foreach ($testimonials as $i => $testimonial) {
                                                            $authorInfo = get_field('author_info', $testimonial->ID);
                                                            if (!empty($authorInfo)) { ?>
                                                                <div class="col-md-6">
                                                                    <?php
                                                                    echo ($authorInfo['image']) ? sprintf('<div class="profile-circle">%s</div>',
                                                                        wp_get_attachment_image($authorInfo['image'], 'thumbnail')) : '';
                                                                    echo ($testimonial->post_content) ? sprintf('<div class="testimonial_content"> <i class="fa fa-quote-left"></i>%s</div>',
                                                                        wpautop($testimonial->post_content)) : '';
                                                                    ?>
                                                                    <div class="testimonial_author">
                                                                        <?php
                                                                        echo ($authorInfo['name']) ? sprintf('<h5>%s</h5>', $authorInfo['name']) : '';
                                                                        echo ($authorInfo['position']) ? sprintf('<p>%s</p>', $authorInfo['position']) : '';
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End of row-->
                        </div>
                        <!--End of container-->
                    </section>
                    <!--End of carousel-->
                </div>
            </div>
            <!--End of container-->
        </section>
        <!--end of testimonial-->
    <?php }
    ?>

<?php } ?>