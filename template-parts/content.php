<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cot_Multipurpose_Wp_theme
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <article class="blog-news-item wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
        <header class="entry-header">
            <?php if (is_sticky()) { ?>
                <i class="fa fa-thumb-tack cot_sticky_post" aria-hidden="true"></i>
            <?php
            }
            if (is_single()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            if ('post' === get_post_type()) :
                ?>
                <div class="entry-meta">
                    <?php cot_posted_on(); ?>
                    <?php cot_entry_footer(); ?>
                </div><!-- .entry-meta -->
                <?php endif;
            ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php //cot_entry_footer();
            echo '<div class="cot-theme-btn defult-btn"><a href="' . get_the_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . __('CONTINUE READING', 'cot') . '</a></div>';
            ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
</div>
