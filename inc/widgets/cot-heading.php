<?php
/*
 * display heading widget
 *
 * @author SABUJ
 */
if (!class_exists('Cot_Heading')) :

    class Cot_Heading extends WP_Widget {

        /**
         * Register widget with WordPress.
         */
        function __construct() {
            parent::__construct(false, __('Cot Heading', 'cot'), array(
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
            echo $args['before_widget'];
            if ( !empty($instance['title']) ) {
                echo '<div class="cot-heading">';
                
                if ('before' === $instance['position']) {
                    echo '<h4>'.strip_tags($instance['subtitle'],'<span><span>').'</h4><h2>'. strip_tags($instance['title'], '<span><strong>').'</h2><hr>';
                } else {
                    echo '<h2>'. strip_tags($instance['title'], '<span><strong>').'</h2><h4>'.strip_tags($instance['subtitle'],'<span><span>').'</h4><hr>';
                }

                echo '<div class="clearfix"></div></div>';
            }
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
            $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Main Title', 'cot');
            $subtitle = !empty($instance['subtitle']) ? $instance['subtitle'] : esc_html__('Subtitle', 'cot');
            $position = !empty($instance['position']) ? $instance['position'] : 'before';
            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Main Title:', 'cot'); ?></label> 
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php esc_attr_e('Subtitle:', 'cot'); ?></label> 
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>">
            </p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('position')); ?>"><?php esc_attr_e('Subtitle Position:', 'cot'); ?></label> 
                <select class="widefat" name="<?php echo esc_attr($this->get_field_name('position')) ?>" id="<?php echo esc_attr($this->get_field_id('position')); ?>">
                    <option <?php if ('before' === $position) echo 'selected'; ?> value="before"><?php _e('Before', 'cot'); ?></option>
                    <option <?php if ('after' === $position) echo 'selected'; ?> value="after"><?php _e('After', 'cot'); ?></option>
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
            $instance['subtitle'] = (!empty($new_instance['subtitle']) ) ? strip_tags($new_instance['subtitle'], '<span><strong>') : '';
            $instance['position'] = (!empty($new_instance['position']) ) ? strip_tags($new_instance['position']) : '';


            $alloptions = wp_cache_get('alloptions', 'options');
            if (isset($alloptions['cot_heading']))
                delete_option('cot_heading');

            return $instance;
        }

    }

    

    

    

    

        

    

    
endif;