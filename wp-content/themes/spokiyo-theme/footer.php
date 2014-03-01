<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Spokiyo_Theme
 * @since January 2014
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">

        
			<?php get_sidebar( 'main' ); ?>
			<!-- This line is commented out from the original -->
			<!--  <div class="site-info">
				<?php do_action( 'twentythirteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentythirteen' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentythirteen' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentythirteen' ), 'WordPress' ); ?></a>
			</div> --><!-- .site-info -->
			<!-- END:  This line is commented out from the original -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>