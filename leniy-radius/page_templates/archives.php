<?php
/**
 * @package Leniy Radius
 *
 * Template Name: Archives(Only for Chinese users)
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

	<div class="page type-page">
			<?php zww_archives_list(); ?>
<script type="text/javascript">
jQuery(document).ready(function($){
     (function(){
         $('#al_expand_collapse,#zww_archives span.al_mon').css({cursor:"pointer"});
         $('#zww_archives span.al_mon').each(function(){
             var num=$(this).next().children('li').size();
             var text=$(this).text();
             $(this).html(text+'<em> ( '+num+' <?php _e('posts', 'leniyradius'); ?> )</em>');
         });
         var $al_post_list=$('#zww_archives ul.al_post_list'),
             $al_post_list_f=$('#zww_archives ul.al_post_list:first');
         $al_post_list.hide(1,function(){
             $al_post_list_f.show();
         });
         $('#zww_archives span.al_mon').click(function(){
             $(this).next().slideToggle(400);
             return false;
         });
         $('#al_expand_collapse').toggle(function(){
             $al_post_list.show();
         },function(){
             $al_post_list.hide();
         });
     })();
 });
</script>
<style>
#zww_archives h3,#zww_archives ul{margin-bottom:0;}
#al_expand_collapse{padding:5px 10px;color:#fff;text-decoration:none;background:linear-gradient(to bottom, #579322 20%, #3F6C18 80%) repeat scroll 0 0 transparent;}
#al_expand_collapse:hover{background:linear-gradient(to bottom, #65ad26 20%, #579322 80%) repeat scroll 0 0 transparent;}
#zww_archives em{font-size:12px;color:#777;}
#zww_archives .al_mon{font-size:14px;}
#zww_archives .al_mon em{font-size:12px;}
#zww_archives {font-size: 1.4em;margin: 20px 10px;}
</style>
	</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>