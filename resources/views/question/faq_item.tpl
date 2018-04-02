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
		<span>问题详情</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="banner">
		<img src="<{'static/img/self-report.png'|url}>">
	</div>
	<div class="noticeDtail">
		<p class="detail-tit"><{$_question.content}>
			<span><{$_question.created_at|date_format:"%Y-%m-%d"}></span>
		</p>
        <{if !empty($_question.childrens)}>
        <p class="detail-txt" style="padding: 3%;"><{$_question.childrens.content}>
        	<span style="float:right;font-size: 0.38rem;"><{$_question.childrens.created_at|date_format:"%Y-%m-%d"}></span>
        </p>	
        <{else}>
        <p class="detail-txt">没有回复,等待管理员回复.</p>
        <{/if}>
	</div>
	<{include file="home/footer.inc.tpl"}>	
<{/block}>