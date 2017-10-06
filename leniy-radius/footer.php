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
			<?php
				global $wpdb;
				$copyright_dates = $wpdb->get_results("
					SELECT 
						YEAR(min(post_date)) AS firstdate, 
						YEAR(max(post_date)) AS lastdate 
					FROM 
						$wpdb->posts
					WHERE post_status = 'publish'
				");
				if($copyright_dates) {
					$date = date('Y-m-d');
					$date = explode('-', $date);
					$copyright = "Copyright &copy; " . $copyright_dates[0]->firstdate;
					if($copyright_dates[0]->firstdate != $date[0]) {
						$copyright .= '-' . $date[0];
					}
					echo $copyright . " " . get_bloginfo('name');
				}
			?>
			<span class="sep"> | </span>
			<?php if( 'zh_CN' == get_option('WPLANG') ): ?>
			<?php _e('Lu ICP bei xxooxxoo hao', 'leniyradius' ); /* In China, a site must have an ICP id */?>
			<span class="sep"> | </span>
			<?php endif; ?>
			<?php printf( __( 'Theme: %1$s v%2$s by <a href="%3$s" rel="designer">%4$s</a>.', 'leniyradius' ),
					wp_get_theme(),
					wp_get_theme()->get( 'Version' ),
					wp_get_theme()->get( 'AuthorURI' ),
					wp_get_theme()->get( 'Author' )
					); ?>
			<span class="sep"> | </span>
			<?php echo get_num_queries(); ?> queries in <?php timer_stop(3); ?> seconds.
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>