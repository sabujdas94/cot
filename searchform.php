<?php /*
 * Replace default search form with this code
 * 
 * @author_url https://github.com/sabujdas94
 * 
 * @package Cot_Multipurpose_Wp_theme
 * 
 */ ?>

<div class="widget search-box">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <div class="form-group">
            <input type="search" name="s" value="" placeholder="<?php esc_html_e('Search', 'cot'); ?>">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </form>
</div>