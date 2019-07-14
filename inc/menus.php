<?php
/**
 *  Navigation menus setup
 *
 * @package WordPress
 * @since V0.1
 *
 */

/**
 * Primary navigation walker
 */
class greenfair_Primary_Menu_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '<ul class="primaryNav__dropdown">';
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        if ($depth == 0) {
            $classes[] = 'primaryNav__item primaryNav__item-level' . $depth;
        } else {
            $classes[] = 'primaryNav__dropdownItem primaryNav__dropdownItem-level' . $depth;
        }
        if (array_search('menu-item-has-children', $item->classes)) {
            $classes[] = 'primaryNav__item-parent';
        }
        $parent = array_search('menu-item-has-children', $classes);

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $output .= '<li ' . $class_names . '>';
        // Rendering <a> elements:
        $classes = array();
        if ($depth == 0) {
            $classes[] = 'primaryNav__link';
        } else {
            $classes[] = 'primaryNav__dropdownLink';
        }
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= ($item->menu_order == 1) ? '<span class="sr-only"> (current)</span>' : '';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        $output .= '</li>';
    }
}