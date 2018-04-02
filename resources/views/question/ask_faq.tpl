<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
  <link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>"/>
  <style>#content-error{text-align:center;}</style>
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/basic.js'|url}>"></script>
	<script src="<{'static/js/rem.js'|url}>"></script>
	<script type="text/javascript">
	(function($){
		$().ready(function(){
			<{call validate selector='#form'}>
		});
	})(jQuery);
	</script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>我要提问</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="banner">
		<img src="<{'static/img/self-report.png'|url}>">
	</div>
	<div class="contain" style="background-color:#fff;">
		<form action="<{'question/save_faq'|url nofilter}>" id="form" method="post" autocomplete="off">
			<{csrf_field() nofilter}>
			<div class="reason">	
				<textarea id="content" name="content" placeholder="请输入的提问，我们尽快给你回复."></textarea>
			</div>
			<div class="step-btn">
				<button type="submit" class="ta-center db" style="cursor:pointer;">提交</button>
			</div>
		</form>	
	</div>
	
	<{include file="home/footer.inc.tpl"}>	
<{/block}>