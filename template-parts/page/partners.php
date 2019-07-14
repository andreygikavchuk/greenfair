<?php
$title = get_sub_field('title');

if (get_sub_field('partners')) :
    $partners = get_sub_field('partners');
    ?>
    <div class="section centerText">
        <div class="container">
            <?php echo ($title) ? sprintf('<h3>%s</h3>', $title) : ''; ?>
            <div class="retailersWrap">
                <?php
                foreach ($partners as $index => $partner) {
                    $link = get_field('partner_link', $partner);
                    $tag = ($link) ? 'a target="_blank" href="' . $link . '"' : 'div';
                    ?>
                    <div class="retailer">
                        <?php echo (has_post_thumbnail($partner)) ? sprintf('<%1$s class="retailer__link">%2$s</%1$s>',
                            $tag,
                            get_the_post_thumbnail($partner, 'phonesmall', array('class' => "retailer__img"))) : ''; ?>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>