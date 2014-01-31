<?php
/**
 * @package Leniy Radius
 *
 * Template Name: One hundred new comments
 */

get_header(); ?>
	<div id="primary" class="fullwidth-content-area">
		<main id="main" class="fullwidth-site-main" role="main">


	<article class="page type-page">
		<h2>
			<p style="text-align:center"><?php _e('One hundred new comments', 'leniyradius' ); ?></p>
		</h2>
		<?php
			$query_sel = "SELECT * FROM $wpdb->comments WHERE `comment_approved` LIKE '1' AND `user_id` = 0 AND `comment_author_email` NOT LIKE 'api@postlinks.com' ORDER BY comment_date DESC LIMIT 100";
			$output = $wpdb->get_results($query_sel);
		?>
		<style type="text/css">
			.leniycomment {
				width: 98%;
				margin-left: auto;
				margin-right: auto;
				font: normal 12px/150% Arial, Helvetica, sans-serif;
				overflow: hidden;
				border: 1px solid #006699;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
			}
			.leniycomment table,
			.leniycomment td,
			.leniycomment th{
				border: 1px solid #006699;
				border-collapse:collapse;
			}
		</style>
		<div class="leniycomment">
			<table>
				<col span="1" />
				<col span="1" style="width: 125px;" />
				<col span="1" />
				<tr>
					<th>Author</th>
					<th>Date</th>
					<th>Content</th>
				</tr>
				<?php
				foreach ($output as $o) {
					echo "<tr>";
					echo "<td>" . $o->comment_author . "</td>";
					echo "<td>" . $o->comment_date . "</td>";
					echo "<td>" . $o->comment_content . "</td>";
					echo "</tr>";
				}
				?>
			</table>
		</div>
	</article>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>