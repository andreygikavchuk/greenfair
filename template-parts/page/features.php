<?php
$text = get_sub_field('text');
if (have_rows('rows')) {
    ?>
    <!--Start of welcome section-->
    <section id="welcome">
        <div class="container">
            <?php
            echo ($text) ? sprintf('<div class="row"><div class="col-md-12"><div class="wel_header">%s</div></div></div>', $text) : '';
            ?>
            <!--End of row-->
            <div class="row">
                <?php
                while (have_rows('rows')) {
                    the_row();
                    $icon = get_sub_field('icon');
                    ?>
                    <div class="col-md-3">
                        <div class="item">
                            <div class="single_item">
                                <div class="item_list">
                                    <?php
                                    echo ($icon) ? sprintf('<div class="welcome_icon"><i class="fa %s"></i></div>', $icon) : '';
                                    ?>
                                    <?php the_sub_field('text'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!--End of row-->
        </div>
        <!--End of container-->
    </section>
    <!--end of welcome section-->
    <?php
}