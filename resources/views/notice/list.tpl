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
		<span>通知公告</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="banner">
		<{if !empty($_banner)}>
			<img src="<{"attachment?id="|url}><{$banner.cover}>"/>
		<{else}>
			<img src="<{'static/img/self-report.png'|url}>"/>
		<{/if}>
	</div>
	<div class="notice-box">
			<ul class="notice-content">
				<{foreach $_notices as $notice}>
				<a href="<{'notice/info?id='|url}><{$notice.id}>">
				<li class="notice-list">
					<h3 class="list-tit"><{$notice.created_at|date_format:"%Y-%m-%d"}></h3>
				    <p class="list-txt">
                        <{$notice.title}>
				    </p>
				</li>
				<span class="goin"><i class="iconfont icon-right"></i></span>
				</a>
				<{/foreach}>
			</ul>
	</div>
	<{include file="home/footer.inc.tpl"}>	
<{/block}>