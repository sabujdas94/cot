<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cot_Multipurpose_Wp_theme
 */
if (!function_exists('cot_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function cot_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
                esc_html_x('On %s', 'post date', 'cot'), '<a href="' . esc_url(get_permalink()) . '" rel="bookmark"><span class="post date">' . $time_string . '</span></a>'
        );

        $byline = sprintf(
                esc_html_x('By %s', 'post author', 'cot'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline">' . $byline . '</span><span class="posted-on"> ' . $posted_on . '</span>'; // WPCS: XSS OK.

        if (!post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link(
                    sprintf(__('Leave a Comment<span class="screen-reader-text"> on %s</span>'), get_the_title()), '<i class="fa fa-comments-o" aria-hidden="true"></i> 1', '<i class="fa fa-comments-o" aria-hidden="true"></i> %'
            );
            echo '</span>';
        }
    }

endif;

if (!function_exists('cot_entry_footer')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function cot_entry_footer($cat_echo = true, $tag_echo = false, $edit_echo = true) {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            if ($cat_echo) {
                $categories_list = get_the_category_list(esc_html__(', ', 'cot'));
                if ($categories_list && cot_categorized_blog()) {
                    printf('<span class="cat-links"><span class="catagory_list">' . esc_html__('Posted in %1$s', 'cot') . '</span></span>', $categories_list); // WPCS: XSS OK.
                }
            }
            if ($tag_echo) {
                /* translators: used between list items, there is a space after the comma  */
                $tags_list = get_the_tag_list('<ul><li><i class="fa fa-tag" aria-hidden="true"></i> ', '</li><li><i class="fa fa-tag" aria-hidden="true"></i> ', '</li></ul>');
                if ($tags_list) {
                    printf('<div class="tags-links">%1$s</div>', $tags_list);
                }
            }
        }

        if ($edit_echo) {
            edit_post_link(
                    sprintf(
                            /* translators: %s: Name of current post */
                            esc_html__('%s Edit %s', 'cot'), '<i class="fa fa-pencil" aria-hidden="true"></i>', the_title('<span class="screen-reader-text">"', '"</span>', false)
                    ), '<span class="edit-link">', '</span>'
            );
        }
    }

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function cot_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('cot_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('cot_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so cot_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so cot_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in cot_categorized_blog.
 */
function cot_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('cot_categories');
}

add_action('edit_category', 'cot_category_transient_flusher');
add_action('save_post', 'cot_category_transient_flusher');

/*
 * Page navigation function
 * return pagination in list
 */
if (!function_exists('cot_the_pagination')) :

    function cot_the_pagination() {
        global $wp_query, $wp_rewrite;

        // Don't print empty markup if there's only one page.
        if ($wp_query->max_num_pages < 2) {
            return;
        }

        $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
        $pagenum_link = html_entity_decode(get_pagenum_link());
        $query_args = array();
        $url_parts = explode('?', $pagenum_link);

        if (isset($url_parts[1])) {
            wp_parse_str($url_parts[1], $query_args);
        }

        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
        $pagenum_link = trailingslashit($pagenum_link) . '%_%';

        $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';


        $links = paginate_links(array(
            'base' => $pagenum_link,
            'format' => $format,
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'next_text' => '&raquo;',
            'prev_text' => '&laquo;',
            'type' => 'list',
            'add_args' => false
        ));

        if ($links)
            echo str_replace("<ul class='page-numbers'", '<ul class="pagination"', $links);
    }

endif;

if (!function_exists('cot_post_navigation')) :

    /**
     * Display navigation to next/previous post when applicable.
     *
     * @return void
     */
    function cot_post_navigation() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
        $next = get_adjacent_post(false, '', false);

        if (!$next && !$previous) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <div class="post-nav-box clearfix">
                <h1 class="screen-reader-text"><?php _e('Post navigation', 'my-simone'); ?></h1>
                <div class="nav-links">
                    <?php
                    previous_post_link('<div class="nav-previous"><div class="nav-indicator">' . _x('Previous Post:', 'Previous post', 'cot') . '</div><h3>%link</h3></div>', '%title');
                    next_post_link('<div class="nav-next"><div class="nav-indicator">' . _x('Next Post:', 'Next post', 'cot') . '</div><h3>%link</h3></div>', '%title');
                    ?>
                </div><!-- .nav-links -->
            </div><!-- .post-nav-box -->
        </nav><!-- .navigation -->
        <?php
    }
endif;