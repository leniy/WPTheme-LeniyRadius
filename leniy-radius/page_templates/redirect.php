<?php
/**
 * @package Leniy Radius
 *
 * Template Name: External links Redirect
 */
?>
<?php
if($url = $_SERVER['QUERY_STRING']) echo "<script>window.location.href='" . $url . "';</script>";
else _e( "This is external links redirect Page, don't open this directly.", 'leniyradius' );
?>