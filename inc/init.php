<?php
/**
 *  Theme Initialisation
 *
 * @package WordPress
 * @since V0.1
 *
 */

// Check WP Version, Swiss Business Theme requires WP 4.1 or later
if (version_compare($GLOBALS['wp_version'], '4.1-alpha', '<')) {
    require_once get_template_directory() . '/inc/back-compat.php';
}

// Firing initial functions at start
if (!function_exists('greenfair_init')) {
    function greenfair_init()
    {
        // launching operation cleanup
        add_action('init', 'greenfair_head_cleanup');
        // remove WP version from RSS
        add_filter('the_generator', 'greenfair_rss_version');
        // remove pesky injected css for recent comments widget
        add_filter('wp_head', 'greenfair_remove_wp_widget_recent_comments_style', 1);
        // clean up comment styles in the head
        add_action('wp_head', 'greenfair_remove_recent_comments_style', 1);
        // adding sidebars to Wordpress
//        add_action('widgets_init', 'greenfair_register_sidebars');
        // cleaning up random code around images!!!
        add_filter('the_content', 'greenfair_filter_ptags_on_images');
        // launching this stuff after theme setup
        //        disable wp emoji
        greenfair_theme_support();
    }

    add_action('after_setup_theme', 'greenfair_init', 16);
}

// Clean WP Head
if (!function_exists('greenfair_head_cleanup')) {
    function greenfair_head_cleanup()
    {
        // category feeds
        remove_action('wp_head', 'feed_links_extra', 3);
        // post and comment feeds
        remove_action('wp_head', 'feed_links', 2);
        // EditURI link
        remove_action('wp_head', 'rsd_link');
        // windows live writer
        remove_action('wp_head', 'wlwmanifest_link');
        // index link
        remove_action('wp_head', 'index_rel_link');
        // previous link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0);
        // start link
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        // links for adjacent posts
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        // WP version
        remove_action('wp_head', 'wp_generator');
        // remove WP version from css
        add_filter('style_loader_src', 'greenfair_remove_wp_ver_css_js', 9999);
        // remove Wp version from scripts
        add_filter('script_loader_src', 'greenfair_remove_wp_ver_css_js', 9999);
    }
}

// Remove WP version from RSS
if (!function_exists('greenfair_rss_version')) {
    function greenfair_rss_version()
    {
        return '';
    }
}

// Remove WP version from scripts
if (!function_exists('greenfair_remove_wp_ver_css_js')) {
    function greenfair_remove_wp_ver_css_js($src)
    {
        if (strpos($src, 'ver=')) {
            $src = remove_query_arg('ver', $src);
        }
        return $src;
    }
}

// Remove injected CSS for recent comments widget
if (!function_exists('greenfair_remove_wp_widget_recent_comments_style')) {
    function greenfair_remove_wp_widget_recent_comments_style()
    {
        if (has_filter('wp_head', 'wp_widget_recent_comments_style')) {
            remove_filter('wp_head', 'wp_widget_recent_comments_style');
        }
    }
}

// Remove injected CSS from recent comments widget
if (!function_exists('greenfair_remove_recent_comments_style')) {
    function greenfair_remove_recent_comments_style()
    {
        global $wp_widget_factory;
        if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
            remove_action('wp_head',
                array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
        }
    }
}

// Add WP 3+ Functions & Theme Support
if (!function_exists('greenfair_theme_support')) {
    function greenfair_theme_support()
    {
        add_theme_support('title-tag');
        // ready for translations
        load_theme_textdomain('greenfair', get_template_directory() . '/languages');
        // support rss
        add_theme_support('automatic-feed-links');
        // support thumbnails
        add_theme_support('post-thumbnails');
        // support  excerpt
        add_post_type_support('page', 'excerpt');
        // support WooCommerce
        add_theme_support('woocommerce',
            array(
                'thumbnail_image_width' => 150,
                'single_image_width'    => 300,

                'product_grid' => array(
                    'default_rows'    => 3,
                    'min_rows'        => 3,
                    'max_rows'        => 8,
                    'default_columns' => 4,
                    'min_columns'     => 3,
                    'max_columns'     => 5,
                ),
            ));
        // Post type support for attachments
        add_post_type_support('attachment', 'page-attributes');
        // support custom logo
        add_theme_support('custom-logo',
            array(
                'height'      => 80,
                'width'       => 160,
                'flex-width'  => true,
                'flex-height' => true,
            ));
        add_image_size('fullhd', 1920, 9999);
        add_image_size('hd', 1280, 9999);
        // support custom backgrounds
        $defaults = array(
            'default-color'      => 'FFFFFF',
            'default-image'      => '',
            'default-repeat'     => 'no-repeat',
            'default-attachment' => 'fixed',
        );
        add_theme_support('custom-background', $defaults);
        // register menus
        register_nav_menus(array(
            'primary' => __('Primary navigation', 'greenfair'),
        ));
        // valid html5 for search form, comment form, comments
        add_theme_support('html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ));
        // support for post formats
        add_theme_support('post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'status',
                'audio',
                'chat',
            ));

        greenfair_register_sidebars();
        greenfair_filter_excerpt_more();
    }
}

// Register Sidebars & Widgetized Areas
if (!function_exists('greenfair_register_sidebars')) {
    function greenfair_register_sidebars()
    {
        register_sidebar(array(
            'name'          => esc_html__('Footer left sidebar', 'greenfair'),
            'id'            => 'footer-sidebar-left',
            'before_widget' => '<div class="col-md-6">',
            'after_widget'  => '</div>'
        ));


        register_sidebar(array(
            'name'          => esc_html__('Footer right sidebar', 'greenfair'),
            'id'            => 'footer-sidebar-right',
            'before_widget' => '<div class="col-md-6">',
            'after_widget'  => '</div>'
        ));

    }
}

// remove the p fro m around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
if (!function_exists('greenfair_filter_ptags_on_images')) {
    function greenfair_filter_ptags_on_images($content)
    {
        return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    }
}


// ADMIN STUFF
// Custom Admin Menu Order, place Pages right after dashboard
if (!function_exists('greenfair_admin_menu_order')) {
    function greenfair_admin_menu_order($menu_ord)
    {
        return array(
            'index.php',
            'edit.php?post_type=page',
            'edit.php'
        );
    }

    add_filter('custom_menu_order', '__return_true');
    add_filter('menu_order', 'greenfair_admin_menu_order');
}

if (!function_exists('greenfair_clean_script_tag')) {
    add_filter('script_loader_tag', 'greenfair_clean_script_tag');
    function greenfair_clean_script_tag($src)
    {
        return str_replace("type='text/javascript'", '', $src);
    }
}


if (!function_exists('greenfair_filter_excerpt_more')) {
    function greenfair_filter_excerpt_more()
    {
        return '...';
    }

    add_filter('excerpt_more', 'greenfair_filter_excerpt_more', 11);
};


if (!function_exists('greenfair_logo')) {
    function greenfair_logo()
    {

        $logo = '<img src="' . get_template_directory_uri() . '/img/logo.png">';

        $custom_logo_id = get_theme_mod("custom_logo");
        if (!empty($custom_logo_id)) {
            $logo = wp_get_attachment_image($custom_logo_id, 'medium');
        }
        echo ($logo) ? sprintf('<a class="navbar-brand custom_navbar-brand" href="%1$s">%2$s</a>', get_home_url(), $logo) : '';
    }
}

if (!function_exists('greenfair_excerpt_length')) {
    add_filter( 'excerpt_length', 'greenfair_excerpt_length' );
    function greenfair_excerpt_length( $number ){
        return 30;
    }
}
