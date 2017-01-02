<?php

/*
 * Adding icon attribute to the menu.
 * @author_url https://github.com/sabujdas94
 * @package Cot_Multipurpose_Wp_theme
 */

class cot_theme_menu_attr {
    /* --------------------------------------------*
     * Constructor
     * -------------------------------------------- */

    function __construct() {

        // add custom menu fields to menu
        add_filter('wp_setup_nav_menu_item', array($this, 'cot_theme_add_custom_nav_fields'));

        // save menu custom fields
        add_action('wp_update_nav_menu_item', array($this, 'cot_theme_update_custom_nav_fields'), 10, 3);

        // edit menu walker
        add_filter('wp_edit_nav_menu_walker', array($this, 'cot_theme_edit_walker'), 10, 2);
    }

// end constructor

    /**
     * Add custom fields to $item nav object
     * in order to be used in custom Walker
     *
     * @access      public
     * @since       1.0 
     * @return      void
     */
    function cot_theme_add_custom_nav_fields($menu_item) {
        
        $menu_item->icon = get_post_meta($menu_item->ID, '_menu_item_icon', true);
        
        $menu_item->iinline = get_post_meta($menu_item->ID, '_menu_item_iinline', true);
        
        return $menu_item;
    }

    /**
     * Save menu custom fields
     *
     * @access      public
     * @since       1.0 
     * @return      void
     */
    function cot_theme_update_custom_nav_fields($menu_id = 0, $menu_item_db_id, $args) {
        
        $menu_id = (int)$menu_id;
        
        $menu_item_db_id = (int) $menu_item_db_id;
        
        // Check if element is properly sent
           if ( is_array( $_REQUEST['menu-item-icon']) ) {
               
               $icon_value = $_REQUEST['menu-item-icon'][$menu_item_db_id];
               
               update_post_meta( $menu_item_db_id, '_menu_item_icon', strip_tags( $icon_value ) );
           }
          
           
        // Check if element is properly sent
        if (isset($_REQUEST['menu-item-iinline'])) {
           
            if (is_array($_REQUEST['menu-item-iinline'])) {
            
                if (!empty($_REQUEST['menu-item-iinline'][$menu_item_db_id])) {
                
                    $iinline_value = 1;
                    
                } else {
                    
                    $iinline_value = 0;
                    
                }
                
                update_post_meta($menu_item_db_id, '_menu_item_iinline', (int) $iinline_value);
                
            }
            
        }else{
           
           update_post_meta($menu_item_db_id, '_menu_item_iinline', (int) 0 );
           
        }
    }

    /**
     * Define new Walker edit
     *
     * @access      public
     * @since       1.0 
     * @return      void
     */
    function cot_theme_edit_walker($walker, $menu_id) {

        return 'Walker_Nav_Menu_Edit_Custom';
    }

}

// Instantiate menu attribute class
$GLOBALS['cot_theme_menu_attr'] = new cot_theme_menu_attr();
include_once( 'edit_custom_walker.php' );
