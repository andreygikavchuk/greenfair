<?php
/**
 * Header Template
 *
 * @package WordPress
 * @since V0.1
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
    <!--[if lt IE 9]>
    <script type="text/javascript">
        window.location = "http://browsehappy.com/";
    </script>
    <![endif]-->
    <meta http-equiv="content-type" content="text/html; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="robots" content="index, follow">
    <meta name="author" content="<?php bloginfo('name'); ?>">
    <meta name="copyright" content="<?php bloginfo('name'); ?>, all rights reserved">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-spy="scroll" data-target="#header">
<?php
$address = get_field('address', 'option');
$phone = get_field('phone', 'option');
$socials = get_field('socials', 'option');
?>
<!--Start Hedaer Section-->
<section id="header">
    <div class="header-area">
        <div class="top_header">
            <div class="container">
                <div class="row">
                    <?php
                    echo ($address) ? sprintf('<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 zero_mp"><div class="address"><i class="fa fa-home floatleft"></i><p>%s</p></div></div>', $address) : '';
                    echo ($phone) ? sprintf('<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 zero_mp"><div class="phone"><i class="fa fa-phone floatleft"></i></i><a href="tel:%1$s">%2$s</div></a></div>',
                        preg_replace('#\D+#', '', $phone),
                        $phone) : '';
                    if (!empty($socials)) { ?>
                        <div class="col-md-4">
                            <div class="social_icon text-right">
                                <?php foreach ($socials as $index => $social) {
                                    echo ($social) ? sprintf(' <a target="_blank" href="%1$s"><i class="fa %2$s"></i></a>', $social['url'], $social['icon']) : '';
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!--End of row-->
            </div>
            <!--End of container-->
        </div>
        <!--End of top header-->
        <div class="header_menu text-center" data-spy="affix" data-offset-top="50" id="nav">
            <div class="container">
                <nav class="navbar navbar-default zero_mp ">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only"><?php _e('Toggle navigation', 'greenfair') ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <?php
                        if (function_exists('greenfair_logo')) {
                            greenfair_logo();
                        }
                        ?>
                    </div>
                    <!--End of navbar-header-->

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse zero_mp" id="bs-example-navbar-collapse-1">
                        <?php
                        wp_nav_menu(array(
                            'walker'         => new greenfair_Primary_Menu_Walker(),
                            'container'      => false,
                            'items_wrap'     => '<ul id="primaryNav" class="nav navbar-nav navbar-right main_menu">%3$s</ul>',
                            'menu_class'     => '',
                            'theme_location' => 'primary',
                            'fallback_cb'    => false
                        ));
                        ?>
                    </div>
                    <!-- /.navbar - collapse-->
                </nav>
                <!--End of nav-->
            </div>
            <!--End of container-->
        </div>
        <!--End of header menu-->
    </div>
    <!--end of header area-->
</section>
<!--End of Hedaer Section-->