<?php

/*
 * Page Builder Widget Handining
 * @author_url https://github.com/sabujdas94
 * @package Cot_Multipurpose_Wp_theme
 */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );
        
if (!function_exists('cot_add_widget_tabs')) :

    function cot_add_widget_tabs($tabs) {
        $tabs[] = array(
            'title' => __('COT Theme Widget', 'cot'),
            'filter' => array(
                'groups' => array('cot-theme')
            )
        );

        return $tabs;
    }

endif;
add_filter('siteorigin_panels_widget_dialog_tabs', 'cot_add_widget_tabs', 20);

if (!function_exists('cot_custom_row_style_fields')) :

    function cot_custom_row_style_fields($fields) {
        $fields['padding'] = array(
            'name' => __('Top/bottom padding', 'cot'),
            'type' => 'measurement',
            'description' => __('Add a value in the field to change the top/bottom row padding, otherwise 100px will be applied by default', 'cot'),
            'priority' => 4,
            'group' => 'layout'
        );
        $fields['parallax'] = array(
            'name' => __('Parallax', 'siteorigin-panels'),
            'type' => 'checkbox',
            'group' => 'design',
            'description' => __('If enabled, the background image will have a parallax effect.', 'siteorigin-panels'),
            'priority' => 8,
        );
        $fields['overlay'] = array(
            'name' => __('Overlay', 'siteorigin-panels'),
            'type' => 'checkbox',
            'group' => 'design',
            'description' => __('If enabled, the background image will have a parallax effect.', 'siteorigin-panels'),
            'priority' => 8,
        );

        return $fields;
    }

endif;
add_filter('siteorigin_panels_row_style_fields', 'cot_custom_row_style_fields');

if (!function_exists('cot_custom_row_style_attributes')) :

    function cot_custom_row_style_attributes($attributes, $args) {

        if (isset($args['row_stretch']) && 'full' === $args['row_stretch']) {
            array_push($attributes['class'], 'container-fluid');
        } else {
            array_push($attributes['class'], 'container');
        }
        if (!empty($args['parallax'])) {
            array_push($attributes['class'], 'cot-paralax');
        }
        if (!empty($args['overlay'])) {
            array_push($attributes['class'], 'cot-overlay');
        }

        return $attributes;
    }

endif;
add_filter('siteorigin_panels_row_style_attributes', 'cot_custom_row_style_attributes', 10, 2);

add_filter('siteorigin_panels_row_style_fields', 'cot_remove_default_so_row_styles');
add_filter('siteorigin_premium_upgrade_teaser', '__return_false');


/* Filter for the styles */

function cot_row_styles_output($attr, $style) {
    //$attr['style'] = '';
    if (!empty($style['padding'])) {
        $attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
    } else {
        $attr['style'] .= 'padding: 100px 0; ';
    }
    if (empty($attr['style']))
        unset($attr['style']);
    
    return $attr;
    
}

add_filter('siteorigin_panels_row_style_attributes', 'cot_row_styles_output', 10, 2);
