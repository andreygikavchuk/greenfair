<?php
$text = get_sub_field('text');
$query = new WP_Query;
$portfolio = $query->query(array(
    'post_type' => 'portfolio',
    'showposts' => -1,

));
if (!empty($portfolio)) { ?>
    <!--Start of portfolio-->
    <section id="portfolio" class="text-center">
        <?php echo ($text) ? sprintf('<div class="col-md-12"><div class="portfolio_title">%s</div></div>', $text) : ''; ?>
        <!--End of col-md-2-->

        <div class="colum">
            <?php
            $terms = get_terms( array(
                'taxonomy'      => array( 'portfolio_tag' ),
            ) );
            if (!empty($terms)) { ?>
                <div class="container">
                    <div class="row">
                        <form action="/">
                            <ul id="portfolio_menu" class="menu portfolio_custom_menu">
                                <li><button data-filter="*" class="my_btn btn_active"><?php _e('Show All','greenfair') ?></button></li>
                                <?php

                                foreach( $terms as $index => $term ){
                                    echo '<li><button data-filter=".'. $term->slug .'" class="my_btn">'.$term->name.'</button></li>';
                                }
                                ?>
                            </ul>
                            <!--End of portfolio_menu-->
                        </form>
                        <!--End of Form-->
                    </div>
                    <!--End of row-->
                </div>
           <?php  }
            ?>

            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="notes">
                            <?php
                            foreach ($portfolio as $index => $item) {
                                $term_list = '';
                                $termList = wp_get_post_terms($item->ID, 'portfolio_tag');
                                foreach ($termList as $i => $term) {
                                    $term_list .= $term->slug . ' ';
                                }
                                ?>
                                <div class="note <?php echo $term_list ?>">
                                    <div class="img_overlay">
                                        <p><?php echo $item->post_title ?></p>
                                    </div>
                                    <?php
                                    if (has_post_thumbnail($item->ID)) {
                                        echo wp_get_attachment_image(get_post_thumbnail_id($item->ID), 'medium');
                                    }
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                        <!--End of notes-->
                    </div>
                    <!--End of col-lg-12-->
                </div>
                <!--End of row-->
            </div>
            <!--End of container-->
        </div>
        <!--End of colum-->
    </section>
    <!--end of portfolio-->
<?php }