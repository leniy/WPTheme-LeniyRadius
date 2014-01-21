<?php
/**
 * @package Leniy Radius
 */
/*
Template Name: Random Post
*/
?>
<?php $rand_post=get_posts('numberposts=1&orderby=rand'); foreach($rand_post as $post) : ?>
<script> location="<?php the_permalink(); ?>";</script>
<?php endforeach; ?>
