<?php
/*
 * owlCarousel widget
 *
 * @author SABUJ
 */

class Cot_Owl_Carousel extends WP_Widget {

    function __construct() {
        // Instantiate the parent object
        parent::__construct(false, __('Cot Owl Carousel', 'cot'), array(
            'description' => __('A widget to create carousel slider', 'cot'),
            'panels_icon' => 'dashicons dashicons-slides',
            'panels_groups' => array('cot-theme')
                )
        );
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $data = array();

        foreach ($new_instance['owl_item'] as $item) {

            if (!empty($item['url'])) {
                array_push($data, array('text' => strip_tags($item['text']), 'url' => esc_url($item['url'])));
            }
        }
        $instance['owl_item'] = serialize($data);

        return $instance;
    }

    function widget($args, $instance) { // Widget output
        $owl_item = ( isset($instance['owl_item']) ) ? unserialize($instance['owl_item']) : array();
        ?>
        <div class="owl-carousel">
            <?php foreach ($owl_item as $key => $value) : ?>
                <div> <img  src="<?php if (!empty($value['url'])) echo $value['url']; ?>" /> </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    function form($instance) {
        // Output admin widget options form
        $owl_item = ( isset($instance['owl_item']) ) ? unserialize($instance['owl_item']) : array();
        ?>
        <div class="cot-row flex">
            <div class="postbox col-4">
                <div class="repeat" data-name="<?php echo $this->get_field_id('short_position'); ?>">
                    <div class="wrapper" width="100%">
                        <ul class="container">
                            <li class="template row">
                                <label for=""><?php _e("Text", 'cot'); ?></label>
                                <input type="text" class="widefat" name="<?php echo $this->get_field_name('owl_item'); ?>[{{row-count-placeholder}}][text]" />
                                <label for=""><?php _e("Image", 'cot'); ?></label>
                                <input type="text" class="widefat" name="<?php echo $this->get_field_name('owl_item'); ?>[{{row-count-placeholder}}][url]" />
                                <span class="remove btn btn-danger">Remove</span>
                            </li>
                            <?php foreach ($owl_item as $key => $value) : ?>
                               <li class="row">
                                    <label for=""><?php _e("Text", 'cot'); ?></label>
                                    <input type="text" class="widefat" 
                                           name="<?php echo $this->get_field_name('owl_item'); ?>[<?php echo absint($key); ?>][text]" 
                                           value="<?php if( !empty($value['text']) ) echo strip_tags($value['text']); ?>"/>
                                    <label for=""><?php _e("Image", 'cot'); ?></label>
                                    <input type="text" class="widefat" 
                                           name="<?php echo $this->get_field_name('owl_item'); ?>[<?php echo absint($key); ?>][url]"
                                           value="<?php if( !empty($value['url']) ) echo strip_tags($value['url']); ?>" />
                                    <span class="remove btn btn-danger">Remove</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div width="10%" colspan="4"><span class="btn-success btn add">Add</span></div>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }

}
