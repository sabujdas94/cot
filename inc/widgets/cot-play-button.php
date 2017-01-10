<?php
/*
 * video play widget
 *
 * @author SABUJ
 */

class Cot_Video_Button extends WP_Widget {

    public function __construct() {
        parent::__construct(
                'cot_video_button', // Base ID
                __('Cot Video Widget', 'cot'), // Name
                array(
            'description' => __('Display a videp from youtube, vimeo etc', 'cot'),
            'panels_groups' => array('cot-theme'),)
        );
    }

    public function widget($args, $instance) {
        ?>
        <?php echo $args['before_widget'];?>
        <div class="cot-video-button">
            <button class="spin circle"><span class="fa fa-play"></button>
        </div>
        <?php echo $args['after_widget']; ?>
        <?php
    }

    public function form($instance) {
        parent::form($instance);
    }

    public function update($new_instance, $old_instance) {
        parent::update($new_instance, $old_instance);
    }

}
