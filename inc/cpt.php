<?php
/**
 * Custom Post Type definitions
 *
 * @package WordPress
 * @since V0.1
 *
 */

// Fire all CPT's up
if (!function_exists('greenfair_cpt_init')) {
    function greenfair_cpt_init()
    {
        add_action('init', 'greenfair_cpt_testimonial');
        add_action('init', 'greenfair_cpt_event');
        add_action('init', 'greenfair_cpt_portfolio');
        add_action('init', 'greenfair_ct_portfolio_tag');
    }

    add_action('after_setup_theme', 'greenfair_cpt_init', 20);
}

// CPT
if (!function_exists('greenfair_cpt_testimonial')) {
    function greenfair_cpt_testimonial()
    {
        register_post_type('testimonial',
            array(
                'labels'              => array(
                    'name'          => __('All testimonials', 'greenfair'),
                    'singular_name' => __('Testimonial', 'greenfair'),
                ),
                'description'         => __('Description', 'greenfair'),
                'public'              => false,
                'publicly_queryable'  => true,
                'exclude_from_search' => false,
                'show_ui'             => true,
                'query_var'           => true,
                'has_archive'         => false,
                'capability_type'     => 'post',
                'menu_icon'     => 'dashicons-testimonial',
                'hierarchical'        => false,
                'supports'            => array(
                    'title',
                    'editor',
                    'author',
                    'page-attributes',
                    'revisions'
                )
            ));
    }
}

if (!function_exists('greenfair_cpt_event')) {
    function greenfair_cpt_event()
    {
        register_post_type('event',
            array(
                'labels'              => array(
                    'name'          => __('All events', 'greenfair'),
                    'singular_name' => __('Event', 'greenfair'),
                ),
                'description'         => __('Description', 'greenfair'),
                'public'              => true,
                'publicly_queryable'  => true,
                'exclude_from_search' => false,
                'show_ui'             => true,
                'query_var'           => true,
                'has_archive'         => false,
                'capability_type'     => 'post',
                'menu_icon'     => 'dashicons-clipboard',
                'hierarchical'        => false,
                'supports'            => array(
                    'title',
                    'editor',
                    'author',
                    'thumbnail',
                    'page-attributes',
                    'revisions'
                )
            ));
    }
}


if (!function_exists('greenfair_cpt_portfolio')) {
    function greenfair_cpt_portfolio()
    {
        register_post_type('portfolio',
            array(
                'labels'              => array(
                    'name'          => __('All portfolio', 'greenfair'),
                    'singular_name' => __('Portfolio', 'greenfair'),
                ),
                'description'         => __('Description', 'greenfair'),
                'public'              => true,
                'publicly_queryable'  => true,
                'exclude_from_search' => false,
                'show_ui'             => true,
                'query_var'           => true,
                'has_archive'         => false,
                'capability_type'     => 'post',
                'menu_icon'     => 'dashicons-portfolio',
                'hierarchical'        => false,
                'supports'            => array(
                    'title',
                    'editor',
                    'author',
                    'thumbnail',
                    'page-attributes',
                    'revisions'
                )
            ));
    }
}



if (!function_exists(' greenfair_ct_portfolio_tag')) {
    function greenfair_ct_portfolio_tag()
    {
        $labels = array(
            'name'          => _x('Portfolio Tag', 'taxonomy general name', 'greenfair'),
            'singular_name' => _x('Tag', 'taxonomy singular name', 'greenfair'),
            'menu_name'     => __('Tags', 'greenfair'),
        );
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true
        );
        register_taxonomy('portfolio_tag', array('portfolio'), $args);
    }
}
