<?php
/**
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
		<?php the_content('<p class="serif">' . __('Read More', 'leniyradius') . '</p>'); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'leniyradius' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
