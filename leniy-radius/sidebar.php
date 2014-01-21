<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Leniy Radius
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'leniyradius_sidebarupper' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>
			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'leniyradius' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>
		<?php endif; // end sidebar widget area ?>

		<?php if ( ! dynamic_sidebar( 'leniyradius_sidebarlower' ) ) : ?>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'leniyradius' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
