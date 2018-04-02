<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
  <link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>"/>
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/basic.js'|url}>"></script>
	<script src="<{'static/js/rem.js'|url}>"></script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>我的提问</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="banner">
		<{if !empty($_banner)}>
			<a <{if !empty($_banner.url)}> href="<{$_banner.url}>"<{/if}>><img src="<{'attachment/resize?id='|url}><{$_banner.cover}>"></a>
		<{else}>
			<img src="<{'static/img/self-report.png'|url}>">
		<{/if}>
	</div>
	<div class="contain">
				<div class="myanswer-box">
						<ul class="myanswer" id="container">
							<{foreach $_question_list as $question}>
							<a href="<{'question/faq_item?id='|url}><{$question.id}>">
							<li>
								<span class="route-icon"><i class="iconfont icon-zixun"></i></span>
								<span class="route-word"><{$question.content}><{if count($question->childrens)>0}><font color="green" style="font-size:12px;">(已回复)</font><{/if}></span>
								<span class="goin"><{$question.created_at|date_format:"%Y-%m-%d"}></span>
							</li>
							</a>
							<{foreachelse}>
							<li>
								<span class="route-icon"><!--i class="iconfont icon-zixun"></i--></span>
								<span class="route-word"><a href="<{'question/ask_faq'|url}>">你没有提问,请去提个问题吧！</a></span>
								<span class="goin"></span>
							</li>
							<{/foreach}>
						</ul>
					</div>
				</div>
	</div>
	<{include file="home/footer.inc.tpl"}>	
<script>
 var current_page = <{$_question_list->currentPage()}>;
 var last_page = <{$_question_list->lastPage()}>;
(function($) {
	$().ready(function(){
		$(window).scroll(function(){
			if(current_page >= last_page) return false;
			var $this =$(this),		
			viewH =$(this).height(),//可见高度		
			contentH =$(document.body).height(),//内容高度		
			scrollTop =$(this).scrollTop();//滚动高度
			if(contentH - viewH - scrollTop <= 2)  //到达底部2px时,加载新内容			
			{ 		
				$.post("<{'question/my_faq'|url}>",{page:++current_page},function(data){
					$('#container').append(data);
				},'html');
			}
		});
	});
})(jQuery);
</script>
<{/block}>