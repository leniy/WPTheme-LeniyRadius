<?php
/**
 * @package Leniy Radius
 */
?>
<div class="author-info">
	<div class="clear"></div>
	<div class="author-avatar">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 74 ); ?>
	</div>
	<div class="author-description">
		<h2 class="author-title">
			<?php printf( __( 'Author: %s', 'leniyradius' ), get_the_author() ); ?>
		</h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>
	</div>
	<div class="clear"></div>
</div>