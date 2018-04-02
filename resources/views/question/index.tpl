<{extends file="extends/main.block.tpl"}>

<{block "head-styles-after"}>
  <link rel="stylesheet" type="text/css" href="<{'static/css/slick.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/base.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/style.css'|url}>"/>
  <link rel="stylesheet" type="text/css" href="<{'static/css/iconfont/iconfont.css'|url}>"/>
<{/block}>

<{block "head-scripts-plus"}>
	<script src="<{'static/js/slick.min.js'|url}>"></script>
	<script src="<{'static/js/basic.js'|url}>"></script>
	<script src="<{'static/js/rem.js'|url}>"></script>
<{/block}>

<{block "body-container"}>
	<div class="header">
		<span>咨询帮助</span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="banner">
		<{if !empty($_banner)}>
			<a <{if !empty($_banner.url)}> href="<{$_banner.url}>"<{/if}>><img src="<{'attachment/resize?id='|url}><{$_banner.cover}>"></a>
		<{else}>
			<img src="<{'static/img/self-report.png'|url}>">
		<{/if}>
	</div>
	<ul class="ask-box">
			<li class="ask-item">
				<a href="<{'question/common'|url}>">
					  <i class="iconfont icon-question"></i>
				    <span class="ask-word">常见问题</span>
				    <span class="goin"><i class="iconfont icon-right"></i></span>
				</a>
			</li>
			<li class="ask-item">
				<a href="<{'question/faq_list'|url}>">
					  <i class="iconfont icon-ask1"></i>
				    <span class="ask-word">咨询解答</span>
				    <span class="goin"><i class="iconfont icon-right"></i></span>
				</a>
			</li>
			<li class="ask-item">
				<a href="<{'question/my_faq'|url}>">
					  <i class="iconfont icon-ask"></i>
				    <span class="ask-word">我的提问</span>
				    <span class="goin"><i class="iconfont icon-right"></i></span>
				</a>
			</li>
			<li class="ask-item nobor">
				<a href="<{'question/ask_faq'|url}>">
					  <i class="iconfont icon-answer"></i>
				    <span class="ask-word">我要提问</span>
				    <span class="goin"><i class="iconfont icon-right"></i></span>
				</a>
			</li>
		</ul>
	<{include file="home/footer.inc.tpl"}>	
<{/block}>