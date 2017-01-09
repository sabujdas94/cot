<?php
/*
 * Theme Footer
 * @author_url https://github.com/sabujdas94
 * @package Cot_Multipurpose_Wp_theme
 */


if (!function_exists('cot_footer_widget')) :

    function cot_footer_widget() {
        global $cot_opt;
        
        if(4 === absint($cot_opt['footer-top-layout'])){
            $class=" col-md-4";
        }else{
            $class=" col-md-3";
        }

        if (is_active_sidebar('footer-1')) {
            ?>
            <div class="footer-1 <?php echo ( '6l' === $cot_opt['footer-top-layout'] ) ? 'col-md-6' : $class; ?>">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
            <?php
        }
        if (is_active_sidebar('footer-2')) {
            ?>
            <div class="footer-2 <?php echo ( 4 === absint($cot_opt['footer-top-layout']) ) ? 'col-md-4':'col-md-3'; ?>">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
            <?php
        }
        if (is_active_sidebar('footer-3')) {
            ?>
            <div class="footer-3 <?php echo ( '6r' === $cot_opt['footer-top-layout'] ) ? 'col-md-6' : $class; ?>">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>
            <?php
        }
        if ( is_active_sidebar('footer-4') && 3 === absint($cot_opt['footer-top-layout']) ) {
            ?>
            <div class="footer-4 col-md-3">
                <?php dynamic_sidebar('footer-4'); ?>
            </div>
            <?php
        }
    }


endif;