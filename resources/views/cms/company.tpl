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
		<span><{$_company_info.title}></span>
		<a href="javascript:window.history.go(-1);" class="back"><i class="iconfont icon-left"></i></a>
	</div>
	<div class="banner">
		<img src="<{'attachment/resize?id='|url}><{$_company_info.pic_id}>">
	</div>
	<div class="noticeDtail">
		<p class="detail-tit"><{$_company_info.title}>
		<span><{$_company_info.created_at|date_format:"%Y-%m-%d"}></span>
		</p>
		<p class="detail-txt"><{$_company_info.contents}></p>
	</div>
	<{include file="home/footer.inc.tpl"}>	
<{/block}>