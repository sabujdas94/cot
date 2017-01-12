<?php
/*
 * cot list style widget
 *
 * @author SABUJ
 */

class Cot_List_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'cot_list_widget', // Base ID
                __('Cot List Widget', 'cot'), // Name
                array(
            'description' => __('Display custom list style', 'cot'),
            'panels_groups' => array('cot-theme'),
            'width' => 400,
            'height' => 350
                )
        );
    }

//end constructor

    public function widget($args, $instance) {
        $text = isset($instance['text']) ? $instance['text'] : '';
        $list = isset($instance['list']) ? $instance['list'] : '';
        $replace = '<ul class="cot-list-items"><li><i class="'.esc_attr($instance['icon']).'" aria-hidden="true"></i>$1</li></ul>';
        $list = preg_replace("/\^+(.*)?/i", $replace, $list);
        $replace = '/(\<\/ul\>\n(.*)\<ul class="cot-list-items"\>*)+/';
        $list = preg_replace($replace, "", $list);
        echo $args['before_widget'];
        ?>
        <div class="cot-list">
            <?php echo wpautop($text); ?>
            <?php echo $list; ?>
        </div>

        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $instance = wp_parse_args(
                (array) $instance, array(
            'list' => '',
            'text' => '',
            'icon' => ''
                )
        );
        $text = esc_textarea($instance['text']);
        $list = esc_textarea($instance['list']);
        $icon = esc_attr($instance['icon']);
        ?>
        <p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Add a bit of text here. It will be displayed above list.', 'cot'); ?></label>
            <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea></p>

        <p><label for="<?php echo $this->get_field_id('list'); ?>"><?php _e('Add your list items here. One item per row, start each row with <strong>^</strong>. Example: <strong>^ list item </strong>', 'cot'); ?></label>
            <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('list'); ?>" name="<?php echo $this->get_field_name('list'); ?>"><?php echo $list; ?></textarea></p>

        <p><label for="<?php echo $this->get_field_id('icon'); ?>"><?php _e('Custom list icon. Copy past the full icon class name:', 'cot'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo esc_attr($icon); ?>" /></p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['icon'] = strip_tags($new_instance['icon']);
        if (current_user_can('unfiltered_html')) {
            $instance['list'] = $new_instance['list'];
            $instance['text'] = $new_instance['text'];
        } else {
            $instance['list'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['list'])));
            $instance['text'] = stripslashes(wp_filter_post_kses(addslashes($new_instance['text'])));
        }
        return $instance;
    }

}
