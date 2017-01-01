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
            <?php 
            if(has_post_thumbnail() ) : ?>
                <figure class="image-box">
                    <a href="<?php echo esc_url(get_permalink(get_the_id()));?>"><?php the_post_thumbnail('cot_1200x320', array('class' => 'img-responsive'));?></a>
                    <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" class="author"><?php the_author();?></a>
                </figure>
                
            <?php  endif;
            
            the_title('<h3 class="entry-title">', '</h3>');

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
            <?php 
                the_content( sprintf(
                /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'cot' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
                ) );
                wp_link_pages( array(
                    'before'        =>  '<div class="paginate-links clearfix">' . esc_html__( 'Pages:', 'cot' ),
                    'after'         =>  '</div>',
                    'link_before'   =>  '<span>',
                    'link_after'    =>  '</span>'
                ) );
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php cot_entry_footer( false, true, false ); ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-## -->
</div>
