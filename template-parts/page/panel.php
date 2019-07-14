<?php
$title = get_sub_field('title');
$text = get_sub_field('text');
$button = get_sub_field('button');
$buttonAction = get_sub_field('button_action');
$bgClass = (get_sub_field('background_color')) ? get_sub_field('background_color') . 'BG' : false;
$buttonClass = ($bgClass == 'secondaryBG' || $bgClass == 'primaryBG') ? 'btn-secondary' : 'btn-primary';
$partners = get_sub_field('product_partners');
if ($text) {
    ?>
    <section class="section centerText <?php echo ($bgClass) ? $bgClass : ''; ?>">
        <div class="container">
            <?php
            echo ($title) ? sprintf('<h3>%s</h3>', $title) : '';
            echo ($text) ? sprintf('<p>%s</p>', nl2br(strip_tags($text, '<strong><a><br>'))) : '';
            $btnLink = $button['url'];
            if ($buttonAction == 'randomPost') {
                $posts = get_posts(array(
                    'numberposts' => 1,
                    'orderby'     => 'rand',
                    'post_type'   => 'post',
                ));
                $btnLink = get_permalink($posts[0]->ID);
                wp_reset_postdata();
            }
            if ($partners && !empty($partners)) {
                ?>
                <div class="availablePartners__wrap">
                    <?php echo ($button) ? sprintf('<a href="%s" target="%s" %s class="btn btn-lg %s">%s</a>',
                        $btnLink,
                        $button['target'],
                        ($buttonAction) ? 'data-' . $buttonAction : '',
                        $buttonClass,
                        $button['title']) : ''; ?>
                    <div class="availablePartners availablePartners-sm">
                        <div id="productPreviewPartners" class="availablePartners__slider">
                            <?php
                            foreach ($partners as $partner) {
                                echo (has_post_thumbnail($partner)) ? sprintf('<div class="availablePartners__item">%s</div>', get_the_post_thumbnail($partner, 'thumbnail')) : '';
                            }
                            ?>
                        </div>
                        <div class="availablePartners__dropdown">
                            <h5><?php _e('Available at:', 'instax'); ?></h5>
                            <div class="availablePartners__list">
                                <?php
                                foreach ($partners as $partner) {
                                    $link = get_field('partner_link', $partner);
                                    $products = get_field('partner_products', $partner);
                                    foreach ($products as $row) {
                                        if ($row['product'] == get_the_ID()) {
                                            $link = $row['link'];
                                        }
                                    }
                                    $tag = ($link) ? 'a href="' . $link . '"' : 'div';
                                    echo (has_post_thumbnail($partner)) ? sprintf('<%1$s class="availablePartners__item">%2$s</%1$s>', $tag, get_the_post_thumbnail($partner, 'thumbnail')) : '';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo ($button) ? sprintf('<a href="%s" target="%s" %s class="btn %s">%s</a>',
                    $btnLink,
                    $button['target'],
                    ($buttonAction) ? 'data-' . $buttonAction : '',
                    $buttonClass,
                    $button['title']) : '';
            }
            ?>
        </div>
    </section>
    <?php
}
?>