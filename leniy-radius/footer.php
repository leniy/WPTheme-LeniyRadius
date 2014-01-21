<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Leniy Radius
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'leniyradius_credits' ); ?>
			CopyRight &copy; 2006-2014 LENIY.ORG
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'leniyradius' ), 'Leniy Radius', '<a href="http://blog.leniy.org" rel="designer">Leniy</a>' ); ?>
			<span class="sep"> | </span>
			<?php echo get_num_queries(); ?> queries in <?php timer_stop(3); ?> seconds.
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>