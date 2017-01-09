<?php

/*
 * Shortcode Register 
 * @author_url https://github.com/sabujdas94
 * @package Cot_Multipurpose_Wp_theme
 */

if (!function_exists('cot_row')) :

    function cot_row($atts, $content = null) {
        extract(shortcode_atts(array(
            'bgimage' => '',
            'type' => 'normal',
            'fullwidth' => 'no',
            'id' => '',
            'text-align' => 'center'
        ), $atts));

        $output = '<div class="cot-' . strip_tags($type).'"';
        if(!empty($bgimage))    $output .= ' style="background-image:url(' . esc_url($bgimage) . ')"';
        $output .= (!empty($id)) ? 'id="' . strip_tags($id) . '">' : '>';
        $output .= ( 'yes' === $fullwidth ) ? '<div class="container-fluid">' : '<div class="container">';
        $output .= '<div class="row">';
        $output .= do_shortcode($content);
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        // do shortcode actions here
        return balanceTags($output);
    }

endif;

if (!function_exists('cot_column')) :

    function cot_column($atts, $content = null) {
        extract(shortcode_atts(array(
            'class' => 'col-md-12'
        ), $atts));

        $output = '<div class="';
        $output .= strip_tags($class) . '">';
        $output .= do_shortcode($content);
        $output .= '</div>';

        // do shortcode actions here
        return balanceTags($output);
    }

endif;

//Title Shortcode
if (!function_exists('cot_title')):

    function cot_title($atts, $content = null) {
        extract(shortcode_atts(array(
            'class' => '',
            'font_size' => '',
            'color' => '',
            'align' => '',
            'tag'   => 'h1',
            'title' =>  ''
        ), $atts));

        $style = ' style="';
        if (!empty($font_size)) $style .= 'font-size:' . strip_tags($font_size) . ';';
        if (!empty($color)) $style .= 'color:' . strip_tags($color) . ';';
        if (!empty($align)) $style .= 'text-align:' . strip_tags($align) . ';';
        $style .= '"';

        $output = '<'. strip_tags($tag).' class="cot-title '. strip_tags($class).'"';
        if( !empty($title) ) $output .= ' title="'.strip_tags($title).'"';
        if (!empty($font_size) || !empty($color) || !empty($align)) {
            $output .= $style;
        }
        $output .= ' >';
        $output .= do_shortcode(strip_tags($content, '<span><strong>'));
        $output .= '</'. strip_tags($tag).'>';

        return balanceTags($output);
    }

endif;

//Sub Title Shortcode
if (!function_exists('cot_sub_title')):

    function cot_sub_title($atts, $content = null) {
        extract(shortcode_atts(array(
            'class' => '',
            'font_size' => '',
            'color' => '',
            'align' => '',
        ), $atts));

        $style = ' style="';
        if (!empty($font_size)) $style .= 'font-size:' . strip_tags($font_size) . ';';
        if (!empty($color)) $style .= 'color:' . strip_tags($color) . ';';
        if (!empty($align)) $style .= 'text-align:' . strip_tags($align) . ';';
        $style .= '"';

        $output = '<h4 class="cot-sub-title '. strip_tags($class).'"';
        if (!empty($font_size) || !empty($color) || !empty($align)) {
            $output .= $style;
        }
        $output .= ' >';
        $output .= do_shortcode(strip_tags($content, '<span><strong>'));
        $output .= '</h4>';

        return balanceTags($output);
    }

endif;
//Button shortcode

if (!function_exists('cot_btn')) :

    function cot_btn($atts) {
        extract(shortcode_atts(array(
            'class' => 'btn-primary page-scroll',
            'link'  => '',
            'align' =>  'text-left',
            'text'  =>  ''
        ), $atts));

        $output = '<div class="'. strip_tags($align).'">';
        $output .= '<a class="btn ' . strip_tags($class) . '"';
        $output .=' href="' . esc_url($link) . '">';
        $output .= strip_tags($text);
        $output .= '</a></div>';

        // do shortcode actions here
        return balanceTags($output);
    }

endif;

function cot_register_shortcodes() {
    add_shortcode('cot_row', 'cot_row');
    add_shortcode('cot_column', 'cot_column');
    add_shortcode('cot_title', 'cot_title');
    add_shortcode('cot_sub_title', 'cot_sub_title');
    add_shortcode('cot_btn', 'cot_btn');
}

remove_filter('the_content', 'wpautop');
add_action('init', 'cot_register_shortcodes');
add_filter('the_content', 'wpautop', 12);
