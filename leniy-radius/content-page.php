<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Leniy Radius
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__( '%s', 'leniyradius' ), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a>
		</h1>
		<div class="entry-meta"><?php leniyradius_entry_meta(); ?></div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'leniyradius' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer"></footer>
</article><!-- #post-## -->
