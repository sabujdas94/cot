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
        $video_source = (!empty($instance['video_source']) ) ? strip_tags($instance['video_source']) : '';
        $video_url = (!empty($instance['video_url']) ) ? esc_url($instance['video_url']) : '';
        echo $args['before_widget'];
        echo '<div class="cot-video-button">';
        ?>
        <a class="popup-<?php echo $video_source; ?>" href="<?php echo $video_url; ?>"><button class="spin circle"><span class="fa fa-play"></button></a>
        <?php
        echo '</div>';
        echo $args['after_widget'];
    }

    public function form($instance) {
        $video_source = (!empty($instance['video_source']) ) ? strip_tags($instance['video_source']) : 'youtube';
        $video_url = (!empty($instance['video_url']) ) ? esc_url($instance['video_url']) : '#';
        ?>
        <p><label for="<?php echo $this->get_field_id('video_source') ?>"><strong><?php _e("Video Source:", 'cot'); ?></strong></label>
            <select id="<?php echo $this->get_field_id('video_source') ?>"
                    name="<?php echo $this->get_field_name('video_source') ?>">
                <option value="youtube" <?php if ('youtube' === $video_source) echo 'selected'; ?> >Youtube</option>
                <option <?php if ('vimeo' === $video_source) echo 'selected'; ?> value="vimeo" >Vimeo</option>
            </select></p>
        <p><label for="<?php echo $this->get_field_id('video_url'); ?>"><strong><?php _e('Video Url:', 'cot') ?></strong></label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('video_url'); ?>"
                   name="<?php echo $this->get_field_name('video_url') ?>"
                   value="<?php echo esc_url($video_url); ?>"/></p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['video_source'] = strip_tags($new_instance['video_source']);
        $instance['video_url'] = esc_url($new_instance['video_url']);
        return $instance;
    }

}
