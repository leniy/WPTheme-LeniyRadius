<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Leniy Radius
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="page type-page  error-404 not-found">
				<div class="page-content">
					<br /><br />
					<center style="font-size: 2em;border-bottom: 1px solid rgba(199, 203, 214, 0.5);padding: 0 0 5px 0;margin: 0 0 5px 0;">
						<?php _e( '404 Not Found', 'leniyradius' ); ?>
					</center>
					<center>
						CopyRight &copy; 2006-2014 LENIY.ORG
					</center>
					<br /><br />
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>