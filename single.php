<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cot_Multipurpose_Wp_theme
 */
get_header();
?>

<div id="primary" class="content-area row">
    <main id="main" class="site-main col-md-9" role="main">

        <?php
        while (have_posts()) : the_post();

            get_template_part('template-parts/content-single', get_post_format());
            
            cot_post_navigation();
            
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->

<?php get_sidebar(); ?>
</div><!-- #primary -->
<?php get_footer();
