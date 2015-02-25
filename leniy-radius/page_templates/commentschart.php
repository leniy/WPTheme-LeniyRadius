<?php
/**
 * @package Leniy Radius
 *
 * Template Name: Comments Chart
 */

get_header(); ?>

	<div id="primary" class="fullwidth-content-area">
		<main id="main" class="fullwidth-site-main" role="main">

	<div class="page type-page">
			<?php $sourcepage = 'http://blog.leniy.org/wordpress-comment-chart.html'; ?>
			<p style="text-align:center"><?php _e('Want to leave a comments? Go here:', 'leniyradius' ); ?><a href="<?php echo $sourcepage; ?>" target="_blank"><?php echo $sourcepage; ?></a></p>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<h2><p style="text-align:center"><?php _e('Active Visitors Rank', 'leniyradius' ); ?></p></h2><div id="chart_user_div" style="width: 640px; height: 400px; margin: auto;"></div>
<h2><p style="text-align:center"><?php _e('Comments Chart', 'leniyradius' ); ?></p></h2><div id="chart_day_div" style="width: 640px; height: 500px; margin: auto;"></div>
<h2><p style="text-align:center"><?php _e('Comments Chart', 'leniyradius' ); ?></p></h2><div id="chart_month_div" style="width: 640px; height: 500px; margin: auto;"></div>
	<?php
	global $wpdb;
	$numbers_day   = 30;
	$numbers_month = 12;
	$numbers_user  = 8;
	$query_day  ="SELECT COUNT(*) AS `cnt` , DATE_FORMAT( `comment_date` , '%Y-%m-%d' ) AS d FROM $wpdb->comments GROUP BY d ORDER BY `d` DESC LIMIT 0 , " . $numbers_day;
	$query_month="SELECT COUNT(*) AS `cnt` , DATE_FORMAT( `comment_date` , '%Y-%m' )    AS d FROM $wpdb->comments GROUP BY d ORDER BY `d` DESC LIMIT 0 , " . $numbers_month;
	$query_user ="
		SELECT
			COUNT( comment_author_email ) AS number,
			comment_author_email,
			comment_author
		FROM (
			SELECT *
			FROM $wpdb->comments
			LEFT OUTER JOIN $wpdb->posts
			ON ( $wpdb->posts.ID = $wpdb->comments.comment_post_ID )
			WHERE
					comment_date > date_sub( NOW(), INTERVAL 180 DAY )
				AND user_id = '0'
				AND comment_approved =  '1'
			ORDER BY comment_ID DESC
		) AS tempcmt
		GROUP BY comment_author_email
		ORDER BY number DESC
		LIMIT {$numbers_user}";
	$output_day   = $wpdb->get_results($query_day);
	$output_month = $wpdb->get_results($query_month);
	$output_user  = $wpdb->get_results($query_user);
?>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart_day);
	google.setOnLoadCallback(drawChart_month);
	google.setOnLoadCallback(drawChart_user);
	function drawChart_day() {
		var data = google.visualization.arrayToDataTable([
		['date', 'comments'],
		<?php foreach (array_reverse($output_day) as $o) {echo "['" . $o->d . "'," . $o->cnt . "],";} ?>
		]);
		var options = {
			title: '<?php _e('Comments Chart by day', 'leniyradius' ); ?> by Leniy'
		};
		var chart = new google.visualization.LineChart(document.getElementById('chart_day_div'));
		chart.draw(data, options);
	}
	function drawChart_month() {
		var data = google.visualization.arrayToDataTable([
		['date', 'comments'],
		<?php foreach (array_reverse($output_month) as $o) {echo "['" . $o->d . "'," . $o->cnt . "],";} ?>
		]);
		var options = {
			title: '<?php _e('Comments Chart by Month', 'leniyradius' ); ?> by Leniy'
		};
		var chart = new google.visualization.ColumnChart(document.getElementById('chart_month_div'));
		chart.draw(data, options);
	}
	function drawChart_user() {
		var data = google.visualization.arrayToDataTable([
		['comment_author', 'comments'],
		<?php foreach ($output_user as $o) {echo "['" . $o->comment_author . "'," . $o->number . "],";} ?>
		]);
		var options = {
			title: '<?php _e('Active Visitors Rank in Six Months', 'leniyradius' ); ?> by Leniy'
		};
		var chart = new google.visualization.PieChart(document.getElementById('chart_user_div'));
		chart.draw(data, options);
	}
</script>
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>