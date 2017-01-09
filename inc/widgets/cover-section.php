<?php
/*
 * welcome cover-section widget
 *
 * @author SABUJ
 */

class Cot_Cover_Section extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct(false, __('Cot Welcome Cover', 'cot'), array(
            'description' => __('A widget to display welcome cover', 'cot'),
            'panels_icon' => 'dashicons dashicons-welcome-view-site',
            'panels_groups' => array('cot-theme')
                )
        );
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title'], '<span>');
        $instance['subtitle'] = strip_tags($new_instance['subtitle'], '<span><strong>');
        $instance['button'] = strip_tags($new_instance['button']);
        $instance['link'] = esc_url($new_instance['link']);
        $instance['scroll'] = esc_url($new_instance['scroll']);

        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['cot_cover_section']))
            delete_option('cot_cover_section');

        return $instance;
    }

    function widget($args, $instance) { // Widget output
        $cache = array();
        if (!$this->is_preview()) {
            $cache = wp_cache_get('cot_cover_section', 'widget');
        }
        if (!is_array($cache)) {
            $cache = array();
        }
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        if (isset($cache[$args['widget_id']])) {
            echo $cache[$args['widget_id']];
            return;
        }

        ob_start();

        extract($args);

        $title = ( isset($instance['title']) ) ? $instance['title'] : 'Cot Cover Title';
        $subtitle = (isset($instance['subtitle'])) ? strip_tags($instance['subtitle'], '<span><strong>') : 'Cot Cover Body Test';
        $button = (isset($instance['button'])) ? esc_attr($instance['button']) : 'COT THEME';
        $link = (isset($instance['link'])) ? esc_url($instance['link']) : '#';
        $scroll = (isset($instance['scroll'])) ? esc_url($instance['scroll']) : '#';

        if (isset($instance['scroll'])) {
            $scroll_class = 'scroll-button';
        } else {
            $scroll_class = '';
        }
        echo $before_widget;
        ?>
        <h1 class="text-center cot-title"><?php echo strip_tags($title, '<span>'); ?></h1>
        <h4 class="text-center sub-title"><?php echo esc_attr($subtitle); ?></h4>
        <div class="text-center"><a href="<?php echo $link; ?>" class="btn btn-primary"><?php echo $button; ?></a></div>
        <div class="text-center"><a href="<?php echo $scroll; ?>" class="text-center btn fa fa-angle-down btn-black <?php echo $scroll_class; ?>"> <span class="screen-reader-text">Scroll Down</span></a></div>
        <?php
        echo $after_widget;

        if (!$this->is_preview()) {
            $cache[$args['widget_id']] = ob_get_flush();
            wp_cache_set('cot_cover_section', $cache, 'widget');
        } else {
            ob_end_flush();
        }
    }

    function form($instance) {
        // Output admin widget options form
        $title = ( isset($instance['title']) ) ? esc_html($instance['title']) : '';
        $subtitle = (isset($instance['subtitle'])) ? strip_tags($instance['subtitle'], '<span><strong>') : '';
        $button = (isset($instance['button'])) ? esc_attr($instance['button']) : '';
        $link = (isset($instance['link'])) ? esc_url($instance['link']) : '';
        $scroll = (isset($instance['scroll'])) ? esc_url($instance['scroll']) : '';
        ?>
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'cot'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   value="<?php echo $title; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle:', 'cot'); ?></label>
            <textarea type="text" class="widefat" id="<?php echo $this->get_field_id('subtitle'); ?>"
                      name="<?php echo $this->get_field_name('subtitle'); ?>"><?php echo $subtitle; ?></textarea></p>

        <p><label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button Text:', 'cot'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('button'); ?>"
                   name="<?php echo $this->get_field_name('button'); ?>"
                   value="<?php echo $button; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Button Link:', 'cot'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('link'); ?>"
                   name="<?php echo $this->get_field_name('link'); ?>"
                   value="<?php echo $link; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('scroll'); ?>"><?php _e('Scroll Anchor:', 'cot'); ?></label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('scroll'); ?>"
                   name="<?php echo $this->get_field_name('scroll'); ?>"
                   value="<?php echo $scroll; ?>" /></p>

        <?php
    }

}
