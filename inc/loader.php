<?php

/*
 * Include file declaration file
 * @author_url https://github.com/sabujdas94
 * @package Cot_Multipurpose_Wp_theme
 */

/**
 * Load wp-bootstrap-navwalker
 */
include_once get_template_directory() . '/inc/menu/wp_bootstrap_navwalker.php';

/*
 * Load icon attribute add class file
 */
include_once get_template_directory() . '/inc/menu/icon-menu.php';

/*
 * footer widget file
 */
include_once get_template_directory() . '/inc/modules/footer_widget.php';

/*
 * Load TGM_Plugin_Activation class
 */

include_once get_template_directory() . '/inc/helpers/tgm-plugin-activation/plugin.php';

/**
 * Load the front page widgets.
 */
include_once get_template_directory() . '/inc/page-builder.php';

if ( function_exists('siteorigin_panels_activate') ) {
    include_once get_template_directory() . "/inc/widgets/cover-section.php";
    include_once get_template_directory() . "/inc/widgets/cot-heading.php";
    include_once get_template_directory() . "/inc/widgets/cot-heading-2.php";
    include_once get_template_directory() . "/inc/widgets/cot-list.php";
    include_once get_template_directory() . "/inc/widgets/cot-play-button.php";
}
