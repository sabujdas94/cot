<?php

/**
 * Portfolio widget
 *
 * @package Sydney
 */
class Cot_Portfolio extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'cot_post_grid_widget',
            'description' => __('Display your post in a grid.', 'cot'),
            'panels_icon' => 'dashicons dashicons-grid-view',
            'panels_groups' => array('cot-theme')
        );
        parent::__construct(false, $name = __('Cot Post Gird', 'cot'), $widget_ops);
        $this->alt_option_name = 'cot_post_grid_widget';
    }

    public function widget($args, $instance) {

        $source = !empty($instance['source']) ? strip_tags($instance['source']) : 'projects';
        $slugs = !empty($instance['slugs']) ? esc_attr( $instance['slugs'] ) : '';
        $total = !empty($instance['total']) ? absint($instance['total']) : 0;
        $filter = !empty($instance['filter']) ? 1 : 0;
        $showalltext = !empty($instance['showalltext']) ? strip_tags($instance['showalltext']) : 'All';
        $setting = !empty($instance['setting']) ? strip_tags($instance['setting']) : '';

        $cache = array();
        if (!$this->is_preview()) {
            $cache = wp_cache_get('cot_post_grid_widget', 'widget');
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

        if('post' === $source){
            $termstoshort  = 'category';
        }else{
            $termstoshort  = $source.'-category';
        }

        $options = array(
            'post_type' => $source,
            'posts_per_page' => $total
        );

        ob_start(); ?>
        <div class="row">
        <?php
        if( $filter ) : 
        $included_terms = explode(',', $slugs); 
        $output = '';
        $included_ids = array();

        foreach( $included_terms as $term ) {
           $term_obj = get_term_by( 'slug', $term, $termstoshort );
           if (is_object($term_obj)) {
              $term_id  = $term_obj->term_id;
              $included_ids[] = $term_id;
           }
       }

       $id_string = implode( ',', $included_ids );
       $terms = get_terms( $termstoshort , array( 'include' => $id_string ) );

       //Build the filter
       $output .= '<div class="portfolio-filter" id="filters">';
           $output .= '<a href="#" data-filter="*" class="current">' . $showalltext .'</a> ';
           $count = count($terms);
           if ( $count > 0 ){
               foreach ( $terms as $term ) {
                   $output .= "<a href='#' data-filter='.".$term->slug."'>" . $term->name . "</a> ";
               }
           }
       $output .= '</div>';
        echo $output;
        endif;
        echo '<div class="portfolio-grid">';
        $query = new WP_Query( $options );

        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
        <!-- post -->
        <?php $terms = wp_get_post_terms( get_the_ID(), $termstoshort );  ?>
        <div class="col-md-3 col-sm-6 nopadding <?php if ( !empty($terms) ) { foreach ($terms as $term) { echo $term->slug . ' '; } }?>">
            <div class="portfolio-item">
                <div class="hover-bg">
                    <a href="#">
                        <div class="hover-text">
                            <h5><?php if ( !empty($terms) ) echo( $terms[0]->name );?></h5>
                            <p class="lead"><?php the_title(); ?></p>
                            <div class="hline"></div>
                        </div>
                        <?php echo get_the_post_thumbnail( get_the_ID(), '', array( 'class' => 'img-responsive' ) ); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
        <!-- post navigation -->
        <?php wp_reset_postdata(); ?>
        <?php else: ?>
        <!-- no posts found -->
        <p class="alert alert-info"><?php _e( 'Sorry, no posts matched your criteria.', 'cot' ); ?></p>
        <?php endif; ?>
        </div>
        </div>
        <?php
        if (!$this->is_preview()) {
            $cache[$args['widget_id']] = ob_get_flush();
            wp_cache_set('cot_cover_section', $cache, 'widget');
        } else {
            ob_end_flush();
        }
        ?>
        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        
        $instance['source'] = strip_tags($new_instance['source']);
        $instance['slugs']  = $new_instance['slugs'] ;
        $instance['total']  = absint($new_instance['total']);
        $instance['filter'] = absint($new_instance['filter']);
        $instance['showalltext'] = strip_tags($new_instance['showalltext']);
        $instance['setting'] = strip_tags($new_instance['setting']);
        
        $alloptions = wp_cache_get('alloptions', 'options');
        if (isset($alloptions['cot_post_grid_widget']))
            delete_option('cot_post_grid_widget');
        return $instance;
    }

    function form($instance) {
        $source = !empty($instance['source']) ? strip_tags($instance['source']) : '';
        $slugs = !empty($instance['slugs']) ? esc_attr( $instance['slugs'] ) : '';
        $total = !empty($instance['total']) ? absint($instance['total']) : 0;
        $filter = !empty($instance['filter']) ? 1 : 0;
        $showalltext = !empty($instance['showalltext']) ? strip_tags($instance['showalltext']) : 'All';
        $setting = !empty($instance['setting']) ? strip_tags($instance['setting']) : '';
        ?>
        <div class="cot-row flex">
            <div class="postbox col-4">
                <h3><?php _e('General', 'cot') ?></h3>
                <hr>
                <p><label for="<?php echo $this->get_field_id('source'); ?>"><strong> <?php _e('Data Source', 'cot') ?> </strong></label>
                    <select class="widefat" name="<?php echo $this->get_field_name('source'); ?>" id="<?php echo $this->get_field_id('source') ?>">
                        <option <?php if ('post' === $source) echo 'selected' ?> value="post"><?php _e("Post", 'cot') ?></option>    
                        <option <?php if ('projects' === $source) echo 'selected' ?> value="projects"><?php _e("Project", 'cot') ?></option>
                    </select>
                    <i class="gray"><?php _e('Select content type for your grid.', 'cot'); ?></i></p>

                <p><label for="<?php echo $this->get_field_id('slugs'); ?>"><strong> <?php _e('Enter category slugs', 'cot') ?> </strong></label>
                    <input type="text" class="widefat" 
                           name="<?php echo $this->get_field_name('slugs'); ?>" 
                           id="<?php echo $this->get_field_id('slugs') ?>"
                           value="<?php echo $slugs; ?>"/>
                    <i class="gray"><?php _e('(comma separated) for your categories or leave empty to show all projects.', 'cot') ?></i></p>

                <p><label for="<?php echo $this->get_field_id('total'); ?>"><strong> <?php _e('Total items', 'cot') ?> </strong></label>
                    <input type="number" class="widefat" 
                           name="<?php echo $this->get_field_name('total'); ?>" 
                           id="<?php echo $this->get_field_id('total') ?>"
                           value="<?php echo $total; ?>"/>
                    <i class="gray"><?php _e('Set max limit for items in grid or leave blank or 0 to display all.', 'cot') ?></i></p>

                <p><label for="<?php echo $this->get_field_id('filter'); ?>"><strong> <?php _e('Show filter', 'cot') ?> </strong></label>
                    <br> <input type="checkbox" class="widefat" 
                                name="<?php echo $this->get_field_name('filter'); ?>" 
                                id="<?php echo $this->get_field_id('filter') ?>"
                                value="1"
                                <?php checked($filter); ?>
                                /> <?php _e('Yes, (Category slugs must be specified).', 'cot'); ?> <br>
                    <i class="gray"><?php _e('Append filter to grid.', 'cot') ?></i></p>
               
                <p><label for="<?php echo $this->get_field_id('showalltext'); ?>"><strong> <?php _e('Show all text', 'cot') ?> </strong></label>
                    <input type="text" class="widefat" 
                           name="<?php echo $this->get_field_name('showalltext'); ?>" 
                           id="<?php echo $this->get_field_id('showalltext') ?>"
                           value="<?php echo $showalltext; ?>"/>
                    </p>
            </div>
            <div class="postbox col-4">
                <h3><?php _e('Data Setting', 'cot') ?> </h3>
                <hr>
                <p><label for="<?php echo $this->get_field_id('setting'); ?>"><strong> <?php _e('Order by', 'cot') ?> </strong></label>
                    <select class="widefat" name="<?php echo $this->get_field_name('setting'); ?>" id="<?php echo $this->get_field_id('setting') ?>">
                        <option <?php if ('date' === $setting) echo 'selected' ?> value="date"><?php _e("Date", 'cot') ?></option>
                    </select>
                    <i class="gray"><?php _e('Select order type.', 'cot'); ?></i></p>
            </div>
        </div>
        <?php
    }

}
