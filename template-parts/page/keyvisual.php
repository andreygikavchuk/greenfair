<?php
if (have_rows('rows')) { ?>
    <!--Start of slider section-->
    <section id="slider">
        <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php
                while (have_rows('rows')) {
                    the_row();
                    $index = get_row_index() - 1;
                    $class = ($index == 1 ? 'active' : '');
                    printf('<li data-target="#carousel-example-generic" data-slide-to="%1$s" class="%2$s"></li>', $index, $class);
                }
                ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php
                while (have_rows('rows')) {
                    the_row();
                    $text = get_sub_field('text');
                    $button = get_sub_field('button');
                    $class = (get_row_index() == 1 ? 'item active' : 'item');
                    ?>
                    <div class="<?php echo $class ?>">
                        <div class="slider_overlay">
                            <?php echo wp_get_attachment_image(get_sub_field('image'), 'fullhd') ?>
                            <div class="carousel-caption">
                                <div class="slider_text">
                                    <?php
                                    the_sub_field('text');
                                    echo ($button) ? sprintf('<a href="%s" target="%s" class="custom_btn">%s</a>',
                                        $button['url'],
                                        ($button['target']) ? $button['target'] : '_self',
                                        $button['title']) : '';
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--End of Carousel Inner-->
        </div>
    </section>
    <!--end of slider section-->


<?php } ?>
