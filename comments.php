<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cot_Multipurpose_Wp_theme
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">

    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
        ?>
        <div class="comments-title"><h3><?php
                printf(// WPCS: XSS OK.
                        esc_html(_nx('One thought', '%1$s thoughts', get_comments_number(), 'comments title', 'cot')), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'
                );
                ?></h3></div>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through?  ?>
            <nav id="comment-nav-below" class="comment-navigation clear" role="navigation">
                <h1 class="screen-reader-text"><?php _e('Comment navigation', 'cot'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('<i class="fa fa-arrow-circle-o-left"></i> Older Comments', 'cot')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments <i class="fa fa-arrow-circle-o-right"></i>', 'cot')); ?></div>
            </nav><!-- #comment-nav-below -->
            <?php
        endif; // Check for comment navigation.

    endif; // Check for have_comments().
// If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>

        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'cot'); ?></p>
        <?php
    endif;

    comment_form();
    ?>

</div><!-- #comments -->
