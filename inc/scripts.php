<?php
/**
 *  Register & Enqueue Scripts
 *
 * @package WordPress
 * @since V0.1
 *
 */
if (!function_exists('greenfair_scripts_and_styles')) {
    function greenfair_scripts_and_styles()
    {
        if (is_admin()) {
            return null;
        }

        $theme_dir = get_template_directory_uri();


        wp_register_style('greenfair_font',
            'https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800',
            array(),
            '',
            'all');

        wp_register_style('greenfair_font_awesome',
            $theme_dir . '/css/font-awesome.min.css',
            array(),
            '',
            'all');


        wp_register_style('greenfair_animate',
            $theme_dir . '/css/animate.min.css',
            array(),
            '',
            'all');

        wp_register_style('greenfair_bootstrap',
            $theme_dir . '/css/bootstrap.min.css',
            array(),
            '',
            'all');


        wp_register_style('greenfair_carousel',
            $theme_dir . '/css/carousel.css',
            array(),
            '',
            'all');


        wp_register_style('greenfair_isotope',
            $theme_dir . '/css/isotope/style.css',
            array(),
            '',
            'all');


        wp_register_style('greenfair_style',
            $theme_dir . '/css/style.css',
            array(),
            '',
            'all');


        wp_register_style('greenfair_responsive',
            $theme_dir . '/css/responsive.css',
            array(),
            '',
            'all');


        wp_deregister_script('jquery-migrate');
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-core');
        wp_register_script('jquery-core', $theme_dir . '/js/jquery-1.12.3.min.js', false, null, true);
        wp_register_script('jquery', false, array('jquery-core'), null, true);

        wp_register_script('greenfair_waypoints', $theme_dir . '/js/waypoints.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_counterup', $theme_dir . '/js/jquery.counterup.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_gmaps', $theme_dir . '/js/gmaps.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_google_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBjxvF9oTfcziZWw--3phPVx1ztAsyhXL4', array('jquery'), null, true);
        wp_register_script('greenfair_isotope_scripts', $theme_dir . '/js/isotope/min/scripts-min.js', array('jquery'), null, true);
        wp_register_script('greenfair_isotope_cells', $theme_dir . '/js/isotope/cells-by-row.js', array('jquery'), null, true);
        wp_register_script('greenfair_isotope_pkgd', $theme_dir . '/js/isotope/isotope.pkgd.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_isotope_packery', $theme_dir . '/js/isotope/packery-mode.pkgd.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_isotope_scripts_js', $theme_dir . '/js/isotope/scripts.js', array('jquery'), null, true);
        wp_register_script('greenfair_backtotop', $theme_dir . '/js/backtotop.js', array('jquery'), null, true);
        wp_register_script('greenfair_local_scroll', $theme_dir . '/js/jquery.localScroll.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_scroll_to', $theme_dir . '/js/jquery.scrollTo.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_wow', $theme_dir . '/js/wow.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_bootstrap', $theme_dir . '/js/bootstrap.min.js', array('jquery'), null, true);
        wp_register_script('greenfair_main', $theme_dir . '/js/main.js', array('jquery'), null, true);


        wp_enqueue_style('greenfair_font');
        wp_enqueue_style('greenfair_font_awesome');
        wp_enqueue_style('greenfair_animate');
        wp_enqueue_style('greenfair_bootstrap');
        wp_enqueue_style('greenfair_carousel');
        wp_enqueue_style('greenfair_isotope');
        wp_enqueue_style('greenfair_style');
        wp_enqueue_style('greenfair_responsive');

        wp_enqueue_script('jquery-core');
        wp_enqueue_script('jquery');
        wp_enqueue_script('greenfair_waypoints');
        wp_enqueue_script('greenfair_counterup');
        wp_enqueue_script('greenfair_gmaps');
        wp_enqueue_script('greenfair_google_maps');
        wp_enqueue_script('greenfair_isotope_scripts');
        wp_enqueue_script('greenfair_isotope_cells');
        wp_enqueue_script('greenfair_isotope_pkgd');
        wp_enqueue_script('greenfair_isotope_packery');
        wp_enqueue_script('greenfair_isotope_scripts_js');
        wp_enqueue_script('greenfair_backtotop');
        wp_enqueue_script('greenfair_local_scroll');
        wp_enqueue_script('greenfair_scroll_to');
        wp_enqueue_script('greenfair_wow');
        wp_enqueue_script('greenfair_bootstrap');
        wp_enqueue_script('greenfair_main');

    }
}
add_action('wp_enqueue_scripts', 'greenfair_scripts_and_styles', 99);


if (!function_exists('greenfair_footer_styles')) {
    function greenfair_footer_styles()
    {
        ?>
        <script>
            var map;
            $(document).ready(function () {
                map = new GMaps({
                    el: '#map',
                    lat: 23.6911078,
                    lng: 90.5112799,
                    zoomControl: true,
                    zoomControlOpt: {
                        style: 'SMALL',
                        position: 'LEFT_BOTTOM'
                    },
                    panControl: false,
                    streetViewControl: false,
                    mapTypeControl: false,
                    overviewMapControl: false,
                    scrollwheel: false,
                });


                map.addMarker({
                    lat: 23.6911078,
                    lng: 90.5112799,
                    title: 'Office',
                    details: {
                        database_id: 42,
                        author: 'Foysal'
                    },
                    click: function (e) {
                        if (console.log)
                            console.log(e);
                        alert('You clicked in this marker');
                    },
                    mouseover: function (e) {
                        if (console.log)
                            console.log(e);
                    }
                });
            });
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
            new WOW().init();
        </script>
        <?php
    }
    add_action('wp_footer', 'greenfair_footer_styles', 100);
}