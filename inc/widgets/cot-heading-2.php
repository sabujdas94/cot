<?php
/*
 * display heading widget
 *
 * @author SABUJ
 */
if (!class_exists('Cot_Heading_Two')) :

    class Cot_Heading_Two extends WP_Widget {

        /**
         * Register widget with WordPress.
         */
        function __construct() {
            parent::__construct(false, __('Cot Heading 2', 'cot'), array(
                'description' => __('A widget to show heading with sub heading', 'cot'),
                'panels_icon' => 'dashicons dashicons-editor-insertmore',
                'panels_groups' => array('cot-theme')
                    )
            );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         * 
         */
        public function widget($args, $instance) {
            $title = !empty($instance['title']) ? strip_tags($instance['title'], '<span><strong>') : '';
            $content = !empty($instance['content']) ? strip_tags($instance['content'], '<span><strong><br>') : '';
            $alignment = (!empty($instance['alignment']) ) ? strip_tags($instance['alignment']) : 'left';

            echo $args['before_widget'];
            echo '<div class="cot-heading style2">';
            ?>

            <h2 class="text-<?php echo $alignment; ?>"><?php echo $title; ?></h2>
            <hr class="align<?php echo $alignment; ?>">
            <div class="clearfix text-<?php echo $alignment; ?>"><?php echo wpautop($content); ?></div>

            <?php
            echo ' </div>';
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance) {
            $title = !empty($instance['title']) ? $instance['title'] : '';
            $content = !empty($instance['content']) ? $instance['content'] : '';
            $alignment = !empty($instance['alignment']) ? $instance['alignment'] : 'left';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><strong><?php esc_attr_e('Title:', 'cot'); ?></strong></label> 
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><strong><?php esc_attr_e('Content:', 'cot'); ?></strong></label> 
                <textarea class="widefat" rows="8" cols="20" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo strip_tags($content, '<span><strong><br>'); ?></textarea> 
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('alignment')); ?>"><?php esc_attr_e('Alignment:', 'cot'); ?></label> 
                <select class="widefat" name="<?php echo esc_attr($this->get_field_name('alignment')) ?>" id="<?php echo esc_attr($this->get_field_id('alignment')); ?>">
                    <option <?php if ('left' === $alignment) echo 'selected'; ?> value="left"><?php _e('Left', 'cot'); ?></option>
                    <option <?php if ('center' === $alignment) echo 'selected'; ?> value="center"><?php _e('Center', 'cot'); ?></option>
                    <option <?php if ('right' === $alignment) echo 'selected'; ?> value="right"><?php _e('Right', 'cot'); ?></option>
                </select>
            </p>
            <?php
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title'], '<span><strong>') : '';
            $instance['content'] = (!empty($new_instance['content']) ) ? strip_tags($new_instance['content'], '<span><strong><br>') : '';
            $instance['alignment'] = (!empty($new_instance['alignment']) ) ? strip_tags($new_instance['alignment']) : '';


            $alloptions = wp_cache_get('alloptions', 'options');
            if (isset($alloptions['cot_heading']))
                delete_option('cot_heading');

            return $instance;
        }

    }

    

    

    
    
endif;