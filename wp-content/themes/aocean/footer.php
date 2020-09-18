<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Modern WP Themes
 */
?>
	   	

		</div>
	<!-- #main --></div>

	<?php
		/* A sidebar in the footer? Yep. You can can customize
		 * your footer with up to four columns of widgets.
		 */
		get_sidebar( 'footer' );
	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="clearfix container">
			<div class="site-info">
              <?php if ( of_get_option( 'copyright' ) ): ?>
              	<span><?php echo of_get_option( 'copyright' ); ?></span>
					<?php else: ?>
				&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.
               <?php endif; ?> 
			</div><!-- .site-info -->

			<div class="site-credit">
               <a href="<?php echo esc_url( __( 'http://modernwpthemes.com/', 'modernwpthemes' ) ); ?>">
			</div><!-- .site-credit -->
		</div>
	<!-- #colophon --></footer>

<?php wp_footer(); ?>
</body>
</html>