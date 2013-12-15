<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package EasyDevelopment
 * @subpackage Rainbow_strap
 * @since Rainbow strap 1.0
 */
?>

		</div><!-- #main -->
		<footer id="secondary" class="site-footer" role="contentinfo">
      <div class="container widget-area">
        <?php dynamic_sidebar( 'sidebar-2' ); ?>
      </div>
      <div class="container">
        <div class="site-info">
          <?php do_action( 'rainbowstrap_credits' ); ?>
          <a class="text-primary" href="<?php echo esc_url( __( 'http://wordpress.org/', 'rainbowstrap' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'rainbowstrap' ); ?>"><?php printf( __( 'Proudly powered by %s', 'rainbowstrap' ), 'WordPress' ); ?></a>
        </div><!-- .site-info -->
      </div>
    </footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>