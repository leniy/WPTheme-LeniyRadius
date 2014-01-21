/*-------------------------------------------------*/
/*  为文章标题链接添加动态载入效果
/*-------------------------------------------------*/

jQuery(document).ready(function($) {
$(function() {
	$('.entry-title a').click(function(e) {
		e.preventDefault();
		var htm = 'Loading',
		i = 4,
		t = $(this).html(htm).unbind('click');
		(function ct() {
			i < 0 ? (i = 4, t.html(htm), ct()) : (t[0].innerHTML += '.', i--, setTimeout(ct, 150))
		})();
		window.location = this.href
	})
});
});





/*-------------------------------------------------*/
/*  在页面上单击时，出现积分的特效
/*-------------------------------------------------*/
jQuery(document).ready(function($) {
$("html,body").click(function(e){
	var n=Math.round(Math.random()*100);//随机数
	var $i=$("<b>").text("+"+n);//添加到页面的元素
	var x=e.pageX,y=e.pageY;//鼠标点击的位置
	$i.css({
		"z-index":99999,
		"top":y-20,
		"left":x,
		"position":"absolute",
		"color":"#E94F06"
	});
	$("body").append($i);
	$i.animate(
		{"top":y-180,"opacity":0},
		1500,
		function(){$i.remove();}
	);
	e.stopPropagation();
});
});





/*-------------------------------------------------*/
/*  侧边栏浮动，依赖sidebar-follow-jquery.js
/*-------------------------------------------------*/
if (document.body.scrollWidth > 960){
	(new SidebarFollow()).init({
		element: jQuery('.widget-area2'),
		distanceToTop: 15
	});
}



/*-------------------------------------------------*/
/*  返回顶部按钮，jquery-gotop.js
/*-------------------------------------------------*/
(new GoTop()).init({
	pageWidth		:980,
	nodeId			:'go-top',
	nodeWidth		:20,
	distanceToBottom	:125,
	hideRegionHeight	:130,
	text			:'返回顶部'
});