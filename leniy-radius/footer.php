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
				$begin = $wpdb->get_results("SELECT MIN(post_date) AS MIM_d FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
				$begin = date('Y', strtotime($begin[0]->MIM_d));
				$last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
				$last = date('Y', strtotime($last[0]->MAX_m));
				echo "CopyRight &copy; " . $begin . "-" . $last . " " . get_bloginfo('name');
			?>
			<span class="sep"> | </span>
			<?php if( 'zh_CN' == constant('WPLANG') ): ?>
			<?php _e('Lu ICP bei xxooxxoo hao', 'leniyradius' ); /* In China, a site must have a ICP id */?>
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