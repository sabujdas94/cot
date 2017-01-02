<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cot_Multipurpose_Wp_theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
            <div class="container">
                <div class="footer-border"></div>
                <div class="footer-copyright">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cot' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'cot' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'cot' ), 'Cot', '<a href="'. esc_url('https://www.facebook.com/sabujdas94','cot').'" rel="designer">Sabuj Das</a>' ); ?>
		</div><!-- .site-info -->
            </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
