<?php
if (get_sub_field('form_id')) {
    $cf_id = get_sub_field('form_id'); ?>
    <div class="section  grayBG">
        <div class="container container-sm">
            <?php if (get_sub_field('text_1')) : ?>
                <div class="centerText">
                    <?php the_sub_field('text_1') ?>
                </div>
            <?php endif; ?>
            <div class="form form-flex">
                <?php echo do_shortcode('[contact-form-7 id="' . $cf_id->ID . ' title="' . $cf_id->post_title . '"]'); ?>
            </div>
            <?php if (get_sub_field('text_2')) : ?>
                <div class="centerText">
                    <?php the_sub_field('text_2') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php }



